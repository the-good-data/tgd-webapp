<div class="wide form">

<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model, 'id'); ?>
		<?php echo $form->textField($model, 'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'user_id'); ?>
		<?php echo $form->textField($model, 'user_id', array('maxlength' => 255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'member_id'); ?>
		<?php echo $form->textField($model, 'member_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'adtracks_sources_id'); ?>
		<?php echo $form->dropDownList($model, 'adtracks_sources_id', GxHtml::listDataEx(AdtracksSources::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'domain'); ?>
		<?php echo $form->textField($model, 'domain', array('maxlength' => 255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'url'); ?>
		<?php echo $form->textArea($model, 'url'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'usertime'); ?>
		<?php echo $form->textField($model, 'usertime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'status'); ?>
		<?php echo $form->textField($model, 'status', array('maxlength' => 255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'created_at'); ?>
		<?php echo $form->textField($model, 'created_at'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'updated_at'); ?>
		<?php echo $form->textField($model, 'updated_at'); ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
