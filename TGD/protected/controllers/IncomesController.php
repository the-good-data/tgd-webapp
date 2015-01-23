<?php

class IncomesController extends GxController {

	public $displayMenu = true;

	public function filters()
    {
        return array( 'accessControl' ); // perform access control for CRUD operations
    }
 
    public function accessRules()
    {
        return array(
            array('allow',  
				'expression'=>'Yii::app()->user->isAdmin()',
			),
            array('deny'),
        );
    }
    
	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Incomes'),
		));
	}

	public function actionCreate() {
		$model = new Incomes;
        // set title
        $this->pageTitle = " - Create Income";

                // set currency to default one.
                $model->currency=Currencies::getDefaultCurrencyModel()->id;

		if (isset($_POST['Incomes'])) {
			$model->setAttributes($_POST['Incomes']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'Incomes');


		if (isset($_POST['Incomes'])) {
			$model->setAttributes($_POST['Incomes']);

			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		// if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'Incomes')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		// } else
		// 	throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('Incomes');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		// add js specific for this page
        Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/admin.js', CClientScript::POS_END);
        // set title
        $this->pageTitle = " - Manage Income";

		$model = new Incomes('search');
		$model->unsetAttributes();

		if (isset($_GET['Incomes']))
			$model->setAttributes($_GET['Incomes']);

		$columns = $this->_getTableColumns('incomes');
		$this->render('admin', array(
			'model' => $model,
			'columns' => $columns,
		));
	}

	public function actionExcel() {
		if(isset($_GET['cols'])){
			$columns = explode('|', $_GET['cols']);
		}
		
      	ExcelHelper::sendData('incomes', $columns);
    }
}