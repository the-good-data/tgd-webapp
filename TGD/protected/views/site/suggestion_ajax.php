  				
				<?php $form=$this->beginWidget('CActiveForm', array(
					'action'=>$this->createAbsoluteUrl('suggestion'.$actionSufix),
					'id'=>'suggestion-form'/*,
					'enableClientValidation'=>true,
					'clientOptions'=>array(
						'validateOnSubmit'=>true,
					)*/)
					); ?>
					
					<div class="row">
						<div class="form-group col-sm-16"> 
						<?php echo $form->textField($model,'email',array('class'=>'form-control', 'placeholder'=>$model->getAttributeLabel('email'))); ?>
						<?php echo $form->error($model,'email'); ?>
						</div>
					</div>

					<div class="row">
						<div class="form-group col-sm-16">
						<?php echo $form->textArea($model,'body',array('class'=>'form-control','rows'=>6,'placeholder'=>'Type your feedback here..')); ?>
						<?php echo $form->error($model,'body'); ?>
						</div>
					</div>

					<div class="row">
						<div class=" col-sm-16">
						<?php echo CHtml::htmlButton('Submit',array('id'=>'suggestion-submit', 'class'=>"btn btn-primary")); ?>
						</div>
					</div>

				<?php $this->endWidget(); ?>
