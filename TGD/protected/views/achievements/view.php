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

	array('label'=>Yii::t('app', 'Manage') . ' ' . 'Announcement Types', 'url' => array('achievementsTypes/admin')),
);
?>

<h1><?php echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
'id',
array(
			'name' => 'achievementType',
			'type' => 'raw',
			'value' => $model->achievementType !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->achievementType)), array('achievementsTypes/view', 'id' => GxActiveRecord::extractPkValue($model->achievementType, true))) : null,
			),
'title',
'link_en',
'link_es',
'text_en',
'text_es',
'achievements_start',
'achievements_finish',
/* START UPLOADED FILE */
 array(
    'name' => 'image',
    'type'=>'raw',
    'width'=>'200',
    'alt'=>'hi images',
    'value'=> CHtml::image(file_exists(Yii::app()->getBasePath()."/../uploads/".$model->id."-".$model->image) ? 
        Yii::app()->baseUrl."/uploads/".$model->id."-".$model->image : 
        (file_exists(Yii::app()->getBasePath()."/../uploads/".$model->image) ? 
                Yii::app()->baseUrl."/uploads/".$model->image :
                ''
        ),'',array("style"=>"width:250px;")),
),
/* END UPLOADED FILE */            
'created_at',
'updated_at',
	),
)); ?>

