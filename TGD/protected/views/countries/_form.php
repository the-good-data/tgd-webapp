<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'countries-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'name_en'); ?>
		<?php echo $form->textField($model, 'name_en', array('maxlength' => 255)); ?>
		<?php echo $form->error($model,'name_en'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'name_es'); ?>
		<?php echo $form->textField($model, 'name_es', array('maxlength' => 255)); ?>
		<?php echo $form->error($model,'name_es'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'code'); ?>
		<?php echo $form->textField($model, 'code', array('maxlength' => 255)); ?>
		<?php echo $form->error($model,'code'); ?>
		</div><!-- row -->

		<label><?php echo GxHtml::encode($model->getRelationLabel('membersPiis')); ?></label>
		<?php echo $form->checkBoxList($model, 'membersPiis', GxHtml::encodeEx(GxHtml::listDataEx(MembersPii::model()->findAllAttributes(null, true)), false, true)); ?>
		<label><?php echo GxHtml::encode($model->getRelationLabel('loans')); ?></label>
		<?php echo $form->checkBoxList($model, 'loans', GxHtml::encodeEx(GxHtml::listDataEx(Loans::model()->findAllAttributes(null, true)), false, true)); ?>

<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->