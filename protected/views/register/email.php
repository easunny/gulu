<div class="form"><?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'register-nick-form-email-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="note">Fields with <span class="required">*</span> are
required.</p>

<?php echo $form->errorSummary($model); ?>

<div class="row"><?php echo $form->labelEx($model,'nick'); ?> <?php echo $form->textField($model,'nick'); ?>
<?php echo $form->error($model,'nick'); ?></div>


<div class="row buttons"><?php echo CHtml::submitButton('Submit'); ?></div>

<?php $this->endWidget(); ?></div>
<!-- form -->
