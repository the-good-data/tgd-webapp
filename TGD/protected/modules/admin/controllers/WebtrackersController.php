<?php

class WebtrackersController extends AdminModuleController
{

    /**
     * Manages all models.
     */
    public function actionIndex()
    {
        $file1 = file_get_contents("https://raw.github.com/disconnectme/disconnect/master/firefox/content/disconnect.safariextension/opera/chrome/data/services.json");
        $file2 = file_get_contents("https://raw.githubusercontent.com/thegooddata/extension/94d49837a68c5c9382b2c8e20b59d36c7d0d6fea/chrome/data/services.json");

        $file1 = json_decode($file1, true);
        unset($file1['license']);

        $file2 = json_decode($file2, true);
        unset($file2['license']);

        $trackers = array();

        foreach($file1['categories'] as $index => $arr) {
            foreach ($arr as $k => $value) {
                foreach ($value as $key => $val)
                    $file1['categories'][$index][$key] = $val;
                unset($file1['categories'][$index][$k]);
            }
        }

        foreach($file2['categories'] as $index => $arr) {
            foreach ($arr as $k => $value) {
                foreach ($value as $key => $val)
                    $file2['categories'][$index][$key] = $val;
                unset($file2['categories'][$index][$k]);
            }
        }

        $trackers = $this->arrayRecursiveDiff($file1['categories'], $file2['categories']);

        foreach($trackers as $index => $arr) {
            foreach ($arr as $k => $value) {
                foreach ($value as $key => $val)
                    $trackers[$index][][$key] = array_values($val);
                unset($trackers[$index][$k]);
            }
        }
        $trackers = json_encode($trackers, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

        $this->render('index',array('trackers'=>$trackers));
    }

    protected function arrayRecursiveDiff($aArray1, $aArray2) {
        $aReturn = array();

        foreach ($aArray1 as $mKey => $mValue) {
            if (isset($aArray2[$mKey])) {
                if (is_array($mValue)) {
                    $aRecursiveDiff = $this->arrayRecursiveDiff($mValue, $aArray2[$mKey]);
                    if (count($aRecursiveDiff)) { $aReturn[$mKey] = $aRecursiveDiff; }
                } else {
                    if ($mValue != $aArray2[$mKey]) {
                        $aReturn[$mKey] = $mValue;
                    }
                }
            } else {
                $aReturn[$mKey] = $mValue;
            }
        }
        return $aReturn;
    }
}
