<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('type')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->type0)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('source_name')); ?>:
	<?php echo GxHtml::encode($data->source_name); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('gross_amount')); ?>:
	<?php echo GxHtml::encode($data->gross_amount); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('expenses')); ?>:
	<?php echo GxHtml::encode($data->expenses); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('income_date')); ?>:
	<?php echo GxHtml::encode($data->income_date); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('currency')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->currency0)); ?>
	<br />
	<?php /*

	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('loan_reserved')); ?>:
	<?php echo GxHtml::encode($data->loan_reserved); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('created_at')); ?>:
	<?php echo GxHtml::encode($data->created_at); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('updated_at')); ?>:
	<?php echo GxHtml::encode($data->updated_at); ?>
	<br />
	*/ ?>

</div>