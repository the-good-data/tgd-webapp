<?php

class LoansStatusController extends GxController {
    
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
			'model' => $this->loadModel($id, 'LoansStatus'),
		));
	}

	public function actionCreate() {
		$model = new LoansStatus;

        // set title
        $this->pageTitle = " - Create Loan Status";

		if (isset($_POST['LoansStatus'])) {
			$model->setAttributes($_POST['LoansStatus']);

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
		$model = $this->loadModel($id, 'LoansStatus');


		if (isset($_POST['LoansStatus'])) {
			$model->setAttributes($_POST['LoansStatus']);

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
			$this->loadModel($id, 'LoansStatus')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		// } else
		// 	throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('LoansStatus');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		// add js specific for this page
        Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/admin.js', CClientScript::POS_END);

        // set title
        $this->pageTitle = " - Manage Loan Status";

		$model = new LoansStatus('search');
		$model->unsetAttributes();

		if (isset($_GET['LoansStatus']))
			$model->setAttributes($_GET['LoansStatus']);

		$columns = $this->_getTableColumns('loans_status');
		$this->render('admin', array(
			'model' => $model,
			'columns' => $columns,
		));
	}

	public function actionExcel() {
		if(isset($_GET['cols'])){
			$cols = explode('|', $_GET['cols']);
		}
		
      	ExcelHelper::sendData('loans_status', $cols);
    }
    

}