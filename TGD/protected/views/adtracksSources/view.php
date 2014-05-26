<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	GxHtml::valueEx($model),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('update', 'id' => $model->id)),
	array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('admin')),

	array('label'=>Yii::t('app', 'Manage') . ' ' . 'Webtrack Types', 'url' => array('adtracksTypes/admin')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . 'Webtrack Whitelist', 'url' => array('whitelists/admin')),
);
?>

<h1><?php echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
'id',
array(
			'name' => 'adtrackType',
			'type' => 'raw',
			'value' => $model->adtrackType !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->adtrackType)), array('adtracksTypes/view', 'id' => GxActiveRecord::extractPkValue($model->adtrackType, true))) : null,
			),
'name',
'url',
'created_at',
'updated_at',
	),
)); ?>

<h2><?php echo GxHtml::encode($model->getRelationLabel('adtracks')); ?></h2>
<?php

	// var_dump($model->adtracks);die;

	$model_adtracks = new adtracks();

	$adtracksItemsDataProvider = new CArrayDataProvider($model->adtracks);

	$this->widget('zii.widgets.grid.CGridView', array(
		'id' => 'adtracks-grid',
		'dataProvider' => $adtracksItemsDataProvider,
		'filter' => $model_adtracks,
		'columns' => array(
			'id',
			'user_id',
			 'member_id',
			 array(
					'name'=>'adtracks_sources_id',
					'value'=>'GxHtml::valueEx($data->adtracksSources)',
					'filter'=>GxHtml::listDataEx(AdtracksSources::model()->findAllAttributes(null, true)),
					),
			'domain',
			'status',
			'url',

			/*
			'usertime',
			
			'created_at',
			'updated_at',
			*/
			array(
				'class' => 'CButtonColumn',
			),
		),
	)); 

	// echo GxHtml::openTag('ul');
	// foreach($model->adtracks as $relatedModel) {
	// 	echo GxHtml::openTag('li');
	// 	echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('adtracks/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
	// 	echo GxHtml::closeTag('li');
	// }
	// echo GxHtml::closeTag('ul');
?><h2><?php echo GxHtml::encode($model->getRelationLabel('whitelists')); ?></h2>
<?php
	echo GxHtml::openTag('ul');
	foreach($model->whitelists as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('whitelists/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
?>