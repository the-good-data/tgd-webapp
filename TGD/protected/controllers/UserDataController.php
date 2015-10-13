<?php

class UserDataController extends Controller {

        // set title
    public $pageTitle = " - Your data";

    public $bodyId = 'tgd-user-data';
    
    public $displayMenu = true;

    public function filters() {
        return array('accessControl'); // perform access control for CRUD operations
    }

    public function accessRules() {
        return array(
            array('allow', // allow authenticated users to access all actions
                'users' => array('@'),
            ),
            array('deny'),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function visualizar() {
        // set layout
        $this->layout = '//layouts/column1';

        $user_id = Yii::app()->user->id;

        // ------------ intialize pagination data for queries tab

        $queries_pag = 1;
        $queries_pag_size = 10;

        if (isset($_GET['queries_pag']))
            $queries_pag = $_GET['queries_pag'];

        // get amount of data
        $queries = Yii::app()->db->createCommand()
                ->setFetchMode(PDO::FETCH_OBJ)
                ->select('count(*)')
                ->from('tbl_queries q')
                ->where(
                    array(
                        'and',
                        'q.member_id = :value'
                    ), 
                    array(':value' => $user_id)
                )
                ->queryAll();

        $queries_total = $queries[0]->count;
        
        // build pagination: set total queries, page size, page variable and params
        $queries_pages = new CPagination($queries_total);
        $queries_pages->pageSize=$queries_pag_size; // 10
        $queries_pages->pageVar='queries_pag';
        $queries_pages->params=  array_merge($_GET, array('tab'=>'queries'));

        $queries = Yii::app()->db->createCommand()
                ->setFetchMode(PDO::FETCH_OBJ)
                ->select('*')
                ->from('tbl_queries q')
                ->where(
                    array(
                        'and',
                        'q.member_id = :value'), 
                    array(':value' => $user_id)
                )
                ->order('created_at desc')
                ->limit($queries_pag_size)
                ->offset(($queries_pag-1) * $queries_pag_size)
                ->queryAll();

        // ------------ intialize pagination data for browsing tab

        $browsing_pag = 1;
        $browsing_pag_size = 10;

        if (isset($_GET['browsing_pag']))
            $browsing_pag = $_GET['browsing_pag'];

        // get amount of data
        $browsing = Yii::app()->db->createCommand()
                ->setFetchMode(PDO::FETCH_OBJ)
                ->select('sum(value)')
                ->from('tbl_usage_data_domain q')
                ->where(
                    array(
                        'and',
                        'q.member_id = :value',
                        "q.name = 'browsing'"

                    ), 
                    array(':value' => $user_id)
                )
                ->group('domain')
                ->queryAll();

        $browsing_total = count($browsing);

        // build pagination: set total queries, page size, page variable and params
        $browsing_pages=new CPagination($browsing_total);
        $browsing_pages->pageSize=$browsing_pag_size;
        $browsing_pages->pageVar='browsing_pag';
        $browsing_pages->params=  array_merge($_GET, array('tab'=>'browsing'));

        $browsing = Yii::app()->db->createCommand()
                ->setFetchMode(PDO::FETCH_OBJ)
                ->select('domain, value as count')
                ->from('tbl_usage_data_domain q')
                ->where(
                    array(
                        'and',
                        'q.member_id = :user_id',
                        "q.name = 'browsing'"
                    ),
                    array(':user_id' => $user_id)
                )
                ->order('count desc')
                ->group('domain, count')
                ->limit($browsing_pag_size)
                ->offset(($browsing_pag-1) * $browsing_pag_size)
                ->queryAll();

        $browsing_details = array();

        foreach ($browsing as $browse) {
            $domain = $browse->domain;

            $browsing_details[$domain] = Yii::app()->db->createCommand()
                    ->setFetchMode(PDO::FETCH_OBJ)
                    ->select('*')
                    ->from('tbl_usage_data_domain as q')
                    ->where(
                        array(
                            'and',
                            'q.member_id = :user_id',
                            'q.domain = :domain',
                            "q.name = 'browsing'"
                        ),
                        array(
                            ':user_id' => $user_id,
                            ':domain' => $domain
                        )
                    )
                    ->order('created_at desc')
                    ->limit(1)
                    ->queryAll();
        }

        //COUNT QUERIES
        $member_id = $user_id;

        $startdate = date('Y-m-d', strtotime("-1 month"));
        $datas = Yii::app()->db->createCommand()
                ->setFetchMode(PDO::FETCH_OBJ)
                ->select('count(*)')
                ->from('tbl_queries')
                ->where(
                    array(
                        'and',
                        'member_id = :member_id'
                    ),
                    array(
                        'member_id' => $member_id
                    )
                )
                ->andWhere("daydate >= '$startdate'")
                ->queryAll();

        $queries_count = $datas[0]->count;

        //PERCENTILE
        $member_id = $user_id;
        $queries_percentile_data = ADbHelper::getSeniorityLevelAndPercentile($member_id);


        $seniority_levels = array(
            'count' => '',
            'levels' => ''
        );
        $seniority_levels_temp = SeniorityLevels::model()->findAll();
        if(!empty($seniority_levels)){
            $seniority_levels['count'] = count($seniority_levels_temp);
            foreach($seniority_levels_temp as $level){
                $seniority_levels['levels'] .= ' ' . $level['level'] . ',';
            }
            $seniority_levels['levels'] = rtrim($seniority_levels['levels'], ',');
        }


        // $loans = Yii::app()->db->createCommand()
        //            ->setFetchMode(PDO::FETCH_OBJ)
        //            ->select('*')
        //            ->from('tbl_queries q')
        //            ->where(array(
        //                        'and',
        //                        'q.member_id = :value'),
        //                array(
        //                        ':value'=>$user_id)
        //                )
        //            ->queryAll();


        $this->render('index', array(
            'queries' => $queries,
            'queries_size' => $queries_pag_size,
            'queries_total' => $queries_total,
            'queries_pag' => $queries_pag,
            'queries_pages' => $queries_pages,
            'browsing' => $browsing,
            'browsing_details' => $browsing_details,
            'browsing_size' => $browsing_pag_size,
            'browsing_total' => $browsing_total,
            'browsing_pag' => $browsing_pag,
            'browsing_pages' => $browsing_pages,
            'queries_count' => $queries_count,
            'queries_percentile_data' => $queries_percentile_data,
            'seniority_levels' => $seniority_levels,
                )
        );
    }

    public function actionDeleteQuery() {


        $id_query = $_GET['id_query'];
        $model = Queries::model()->findByPk($id_query);

        if ($model != null)
        {
            $flagger=new QueriesFlagged();
            $flagger->provider = $model->provider;
            $flagger->data= $model->data;
            $flagger->query= $model->query;
            $flagger->lang= $model->lang;
            $flagger->share= $model->share;
            $flagger->usertime= $model->usertime;
            $flagger->language_support= $model->language_support;
            $flagger->save();

            $model->delete();
        }

        $this->redirect(array('userData/index','queries_pag'=>$_GET['queries_pag']));
    }

    public function actionDeleteBrowse() {


        $browse_domain = $_GET['browse_domain'];
        $model = Browsing::model()->findByAttributes(array('member_id' => Yii::app()->user->id, 'domain' => $browse_domain));

        if ($model != null)
        {
            $flagger = new BrowsingFlagged();
            $flagger->member_id = $model->member_id;
            $flagger->domain = $model->domain;
            $flagger->url= $model->url;
            $flagger->usertime= $model->usertime;
            $flagger->save();

            InterestCategoriesSites::model()->deleteAll("site = :site", array(':site' => $model->domain));
            InterestCategoriesCounts::model()->deleteAll("site = :site", array(':site' => $model->domain));

            Browsing::model()->deleteAllByAttributes(array('member_id' => Yii::app()->user->id, 'domain' => $browse_domain));
        }

        $this->redirect(array('userData/index','browsing_pag'=>$_GET['browsing_pag']));
    }

    public function actionIndex() {
        $this->visualizar();

        $this->pageTitle = " - Your Data";
    }

    public function actionDeleteAllQueries(){
        $member_id = Yii::app()->user->id;
        Queries::model()->deleteAll('member_id IN (' . $member_id . ')');
        Browsing::model()->deleteAll('member_id IN (' . $member_id . ')');
        $this->redirect(array('userData/index','queries_pag'=>$_GET['queries_pag']));
    }

    public function actionDeleteQueries() {
        $member_id = Yii::app()->user->id;

        Queries::model()->deleteAll('member_id IN (' . $member_id . ')');
        $this->redirect(array('userData/index','queries_pag'=>$_GET['queries_pag']));
    }

    public function actionDeleteBrowsing() {
        $member_id = Yii::app()->user->id;

        Browsing::model()->deleteAll('member_id IN (' . $member_id . ')');
        $this->redirect(array('userData/index','tab'=>'browsing','browsing_pag'=>$_GET['browsing_pag']));
    }

    public function actionExportBrowsing() {

        Yii::import('ext.ECSVExport');

        $user_id = Yii::app()->user->id;

        //id,member_id,user_id,domain,url,usertime,created_at,updated_at
        $cmd = Yii::app()->db->createCommand("SELECT domain,url,usertime FROM tbl_browsing where member_id='" . $user_id . "' ");
        $csv = new ECSVExport($cmd);
        $content = $csv->toCSV();
        Yii::app()->getRequest()->sendFile('browsing.csv', $content, "text/csv", false);
    }

    public function actionExportQueries() {

        Yii::import('ext.ECSVExport');

        $user_id = Yii::app()->user->id;

        //id,member_id,user_id,provider,data,query,lang,share,usertime,created_at,updated_at
        $cmd = Yii::app()->db->createCommand("SELECT provider,data,query,lang,share,usertime FROM tbl_queries where member_id='" . $user_id . "' ");
        $csv = new ECSVExport($cmd);
        $content = $csv->toCSV();
        Yii::app()->getRequest()->sendFile('queries.csv', $content, "text/csv", false);
    }

}
