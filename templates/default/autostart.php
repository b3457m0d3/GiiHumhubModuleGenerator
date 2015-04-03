<?php echo "<?php\n"; ?>

Yii::app()->moduleManager->register(array(
	'id' => '<? echo $this->moduleID; ?>',
	'class' => 'application.modules.<? echo $this->moduleID; ?>.<? echo ucfirst($this->moduleID); ?>Module',
	'import' => array(
		'application.modules.<? echo $this->moduleID; ?>.*',
	),
	/* Events to Catch
		'events' => array(
			array('class' => 'TopMenuWidget', 'event' => 'onInit', 'callback' => array('<? echo ucfirst($this->moduleID); ?>Module', 'onTopMenuInit')),
		),
	*/
	)
);
<? echo "\n?>"; ?>
