<?php

class HHModuleCode extends CCodeModel
{
	public $moduleID;
	public $moduleName;
	public $moduleDescription;
	public $moduleKeywords;
	public $moduleVersion;

	public function rules()
	{
		return array_merge(parent::rules(), array(
			array('moduleID,moduleName', 'filter', 'filter'=>'trim'),
			array('moduleID', 'required'),
			array('moduleName,moduleDescription,moduleKeywords', 'safe'),
			array('moduleVersion','match', 'pattern'=>'/^\d+(\.\d+)*$/', 'message'=>'{attribute} should only contain numbers and dots.'),
			array('moduleID', 'match', 'pattern'=>'/^\w+$/', 'message'=>'{attribute} should only contain word characters.'),
		));
	}

	public function attributeLabels()
	{
		return array_merge(parent::attributeLabels(), array(
			'moduleID'=>'Module ID',
			'moduleName'=>'Module Name',
			'moduleDescription'=>'Module Description',
			'moduleKeywords'=>'Module Keywords',
			'moduleVersion'=>'Module Version'
		));
	}

	public function successMessage()
	{
		if(Yii::app()->hasModule($this->moduleID))
			return 'The module has been generated successfully. You may '.CHtml::link('try it now', Yii::app()->createUrl($this->moduleID), array('target'=>'_blank')).'.';

		$output=<<<EOD
<p>The module has been generated successfully.</p>
<p>To access the module, you need to modify the application configuration as follows:</p>
EOD;
		$code=<<<EOD
<?php
return array(
    'modules'=>array(
        '{$this->moduleID}'
    ),
    ......
);
EOD;

		return $output.highlight_string($code,true);
	}

	public function prepare()
	{
		$this->files=array();
		$templatePath=$this->templatePath;
		$modulePath=$this->modulePath;
		$templates = array(
			'autostart'=>$templatePath.DIRECTORY_SEPARATOR.'autostart.php',
			'module-json'=>$templatePath.DIRECTORY_SEPARATOR.'module-json.php',
			'module'=>$templatePath.DIRECTORY_SEPARATOR.'module.php'
		);

		$this->files[]=new CCodeFile(
			$modulePath.'/'.$this->getModuleClass().'.php',
			$this->render($templates['module'])
		);

		$this->files[]=new CCodeFile(
			$modulePath.'/autostart.php',
			$this->render($templates['autostart'])
		);

		$this->files[]=new CCodeFile(
			$modulePath.'/module.json',
			$this->render($templates['module-json'])
		);

		$files=CFileHelper::findFiles($templatePath,array(
			'exclude'=>array(
				'.svn',
				'.gitignore',
				'.DS_Store'
			),
		));

		foreach($files as $file){
			if(!in_array($file,array_values($templates))){
				if(CFileHelper::getExtension($file)==='php')
					$content=$this->render($file);
				elseif(basename($file)==='.yii')  {
					$file=dirname($file);
					$content=null;
				} else $content=file_get_contents($file);

				$this->files[]=new CCodeFile(
					$modulePath.substr($file,strlen($templatePath)),
					$content
				);
			}
		}
	}

	public function getModuleClass()
	{
		return ucfirst($this->moduleID).'Module';
	}

	public function getModulePath()
	{
		return Yii::app()->modulePath.DIRECTORY_SEPARATOR.$this->moduleID;
	}
}
