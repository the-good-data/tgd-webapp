<?php

class QueriesController extends GxController {

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
			'model' => $this->loadModel($id, 'Queries'),
		));
	}

	public function actionCreate() {
		$model = new Queries;


		if (isset($_POST['Queries'])) {
			$model->setAttributes($_POST['Queries']);

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
		$model = $this->loadModel($id, 'Queries');


		if (isset($_POST['Queries'])) {
			$model->setAttributes($_POST['Queries']);

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
			$this->loadModel($id, 'Queries')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		// } else
		// 	throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('Queries');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new Queries('search');
		$model->unsetAttributes();

        // set title
        $this->pageTitle = " - Manage Queries";

		if (isset($_GET['Queries']))
			$model->setAttributes($_GET['Queries']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}