<?php

$this->breadcrumbs = array(
	Achievements::label(2),
	Yii::t('app', 'Index'),
);

$this->menu = array(
	array('label'=>Yii::t('app', 'Create') . ' ' . Achievements::label(), 'url' => array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . Achievements::label(2), 'url' => array('admin')),

	array('label'=>'Manage Achievement Types', 'url'=>array('/achievementsTypes/admin')),
);
?>

<h1><?php echo GxHtml::encode(Achievements::label(2)); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 