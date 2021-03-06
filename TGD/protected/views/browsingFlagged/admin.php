<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Manage'),
);

$this->menu = array(
		array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),

		array('label'=>Yii::t('app', 'Manage') . ' ' . 'Browsing', 'url' => array('browsing/admin')),
	);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('browsing-flagged-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('app', 'Manage') . ' ' . GxHtml::encode($model->label(2)); ?></h1>

<p>
You may optionally enter a comparison operator (&lt;, &lt;=, &gt;, &gt;=, &lt;&gt; or =) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo GxHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button')); ?> | 
<?php echo GxHtml::link(Yii::t('app', 'Export'), array('#'),array('id'=>'toggle-export')); ?>
<?php $count = count($columns);
	if($count > 0): ?>
	<div class="alert alert-block alert-info fade in"  id="select-fields">
	<h4>Choose fields to export</h4>
	<p>
		<form>
			<div class="row">
				<div class="span8">
				<?php for($i=0; $i < $count; $i++): ?>
					<?php if($i%3 == 0): ?>
						<label><input type="checkbox" name="<?='columns['.$i.']';?>" value="<?=$columns[$i];?>"> <?=$columns[$i];?></label></br>
					<?php endif; ?>
				<?php endfor; ?>
				</div>
				<div class="span8">
				<?php for($i=0; $i < $count; $i++): ?>
					<?php if($i%3 == 1): ?>
						<label><input type="checkbox" name="<?='columns['.$i.']';?>" value="<?=$columns[$i];?>"> <?=$columns[$i];?></label></br>
					<?php endif; ?>
				<?php endfor; ?>
				</div>
				<div class="span8">
				<?php for($i=0; $i < $count; $i++): ?>
					<?php if($i%3 == 2): ?>
						<label><input type="checkbox" name="<?='columns['.$i.']';?>" value="<?=$columns[$i];?>"> <?=$columns[$i];?></label></br>
					<?php endif; ?>
				<?php endfor;?>
				</div>
			</div>
		</form>
	</p>
	<p id="select-fields-buttons" class="clearfix">
        <?php echo CHtml::link('Export!',array('/browsingFlagged/excel'), array('id'=>'export', 'class' => 'btn btn-success')); ?>
        <a id="select-all" class="btn btn-link" href="#">Select all</a>
        <a id="unselect-all" class="btn btn-link" href="#">Unselect all</a>
    </p>
	</div>
<?php endif;?>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search', array(
	'model' => $model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'browsing-flagged-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
        'id',
        array(
            'name'=>'member_id',
            'type'=>'raw',
            'value'=> function($data){
                $member = Members::model()->findByPk($data->member_id);
                return ($member) ? CHtml::link(CHtml::encode($member->username), array('user/admin/view/','id'=>$data->member_id)) : 'For All';
            },
        ),
        'domain',
        'url',
        'usertime',
		/*
		'usertime',
		'language_support',
		'created_at',
		'updated_at',
		*/
		array(
			'class' => 'CButtonColumn',
		),
	),
)); ?>