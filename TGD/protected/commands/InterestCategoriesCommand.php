<?php
//    * 01 * * * /usr/bin/php /var/www/tgd/protected/yiic.php interestCategories SitesCategories
//    * 02 * * * /usr/bin/php /var/www/tgd/protected/yiic.php interestCategories SitesCategoriesCounts
//    * 02 * * * /usr/bin/php /var/www/tgd/protected/yiic.php interestCategories SitesUsersCategoriesCounts
class InterestCategoriesCommand extends CConsoleCommand
{
    public function actionSitesCategories(){

        $categories = InterestCategoriesSites::model()->findAll('status = 0');

        foreach($categories as $cat){
            $categorySite = InterestCategoriesSites::model()->findByPk($cat['id']);
            $alexa_categories = $this->alexa_categories($categorySite->site);

            $site = $categorySite->site;

            if(!empty($alexa_categories)){
                foreach($alexa_categories as $key => $alexa_category){
                    if($key > 0){
                        $categorySite = new InterestCategoriesSites;
                    }
                    $categorySite->site = $site;
                    $categorySite->category_id = 0;
                    $categorySite->status = 1;

                    $url = str_replace('Top/', '', $alexa_category);
                    $count = substr_count($url, '/');
                    for($i = 0; $i <= $count; $i++){
                        $search_category = InterestCategories::model()->findByAttributes(array('url'=> $url));
                        if($search_category){
                            $categorySitePrev = InterestCategoriesSites::model()->findByAttributes(array('site'=> $site, 'category_id' => $search_category['id']));
                            if(!$categorySitePrev){
                                $categorySite->category_id = $search_category['id'];
                                $categorySite->save();
                            }
                            break;
                        }
                        $urls = explode('/', $url);
                        $url = str_replace('/'.end($urls),'', $url);

                    }
                }
            }else{
                $categorySite->category_id = 0;
                $categorySite->status = 1;
                $categorySite->save();
            }
        }
    }

    protected function alexa_categories($url){
        $xml = simplexml_load_file("http://data.alexa.com/data?cli=10&url=".$url);
        $categories = array();
        if(isset($xml->DMOZ->SITE->CATS->CAT)) {
            foreach($xml->DMOZ->SITE->CATS->CAT as $cat){
                $categories[] = current($cat->attributes()->ID);
            }
        }
        return $categories;
    }

    public function actionSitesCategoriesCounts(){
        $counts = Yii::app()->db->createCommand(
            "SELECT SUM(cc.counter) as counter, cs.category_id
                FROM tbl_interest_categories_sites cs
                JOIN tbl_interest_categories_counts cc ON cs.site=cc.site
                WHERE cc.date_visit >= (now() - '7 days'::interval) AND cc.date_visit <=  now()
                GROUP BY cs.category_id"
            )->queryAll();

        InterestCategories::model()->updateAll(array('counter'=>0));

        foreach($counts as $count){
            $this->saveParentCategoriesCounts($count['category_id'], $count['counter']);
        }


        // set cache key for this data
        $cacheKey="InterestCategories7DayAvg";
//        $result=Yii::app()->cache->get($cacheKey);

        $categories = InterestCategories::model()->categoriesAllCounts();

        Yii::app()->cache->set($cacheKey, $categories, Yii::app()->params['cacheLifespanOneDay']);

    }

    public function actionSitesUsersCategoriesCounts(){

        $startdate = date('Y-m-d', strtotime("-7 days"));
        $categoriesCounts = InterestCategoriesCounts::model()->findAll(array('select'=>'distinct(member_id)', 'condition'=>"DATE(date_visit) >= '$startdate' AND member_id > 0"));

        if(!empty($categoriesCounts)){
            foreach($categoriesCounts as $cat){
                $cacheKey="InterestCategories7DayAvgMember".$cat['member_id'];

                $categories = InterestCategories::model()->categoriesCounts($cat['member_id']);

                Yii::app()->cache->set($cacheKey, $categories, Yii::app()->params['cacheLifespanOneDay']);
            }
        }
    }

    protected function saveParentCategoriesCounts($parent_id, $count){
        if(!empty($parent_id)) {
            $category = InterestCategories::model()->findByPk($parent_id);
            if (!empty($category)) {
                $category->counter = (int)$category->counter + (int)$count;
                if ($category->save()) {
                    $this->saveParentCategoriesCounts($category['parent_id'], $count);
                }
            }
        }
    }
}