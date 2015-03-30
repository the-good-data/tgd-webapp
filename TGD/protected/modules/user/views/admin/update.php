<?php
$this->breadcrumbs=array(
	(UserModule::t('Users'))=>array('admin'),
	$model->username=>array('view','id'=>$model->id),
	(UserModule::t('Update')),
);

if (!UserModule::isAdmin())
	$this->menu_admin=array();
	
$this->menu=array(
    //array('label'=>UserModule::t('Create Member'), 'url'=>array('create')),
    array('label'=>UserModule::t('View Member'), 'url'=>array('view','id'=>$model->id)),
    array('label'=>UserModule::t('Manage Members'), 'url'=>array('admin')),
    array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('profileField/admin')),
    array('label'=>UserModule::t('List Member'), 'url'=>array('/user')),
);
?>

<h1><?php echo  UserModule::t('Update User')." ".$model->id; ?></h1>

<?php
	echo $this->renderPartial('_form', array('model'=>$model,'profile'=>$profile));
?>
