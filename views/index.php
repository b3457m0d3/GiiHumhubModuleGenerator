<h1>Module Generator</h1>

<p>This generator helps you to generate the skeleton code needed by a Humhub module.</p>

<?php $form=$this->beginWidget('CCodeForm', array('model'=>$model)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'moduleID'); ?>
		<?php echo $form->textField($model,'moduleID',array('size'=>65)); ?>
		<div class="tooltip">
			Module ID is case-sensitive. It should only contain word characters.
			The generated module class will be named after the module ID.
			For example, a module ID <code>forum</code> will generate the module class
			<code>ForumModule</code>.
		</div>
		<?php echo $form->error($model,'moduleID'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'moduleName'); ?>
		<?php echo $form->textField($model,'moduleName',array('size'=>65)); ?>
		<div class="tooltip">
			Choose the name users will see in the module marketplace
		</div>
		<?php echo $form->error($model,'moduleName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'moduleDescription'); ?>
		<?php echo $form->textArea($model,'moduleDescription',array('cols'=>56)); ?>
		<div class="tooltip">
			Write a short description of the module for the marketplace
		</div>
		<?php echo $form->error($model,'moduleDescription'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'moduleKeywords'); ?>
		<?php echo $form->textField($model,'moduleKeywords',array('size'=>65)); ?>
		<div class="tooltip">
			Enter keywords, separated by commas - for use in the marketplace
		</div>
		<?php echo $form->error($model,'moduleKeywords'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'moduleVersion'); ?>
		<?php echo $form->textField($model,'moduleVersion',array('size'=>65)); ?>
		<div class="tooltip">
			What version of the module is this?
		</div>
		<?php echo $form->error($model,'moduleVersion'); ?>
	</div>

<?php $this->endWidget(); ?>
