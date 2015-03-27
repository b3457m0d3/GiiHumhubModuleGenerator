{
	"id": "<? echo $this->moduleID; ?>",
	"name": "<? echo (isset($this->moduleName)) ? ucfirst($this->moduleName) : ucfirst($this->moduleId); ?>",
	"description": "<? echo $this->moduleDescription; ?>",
	"keywords": [
	<?
		$keywords = explode(',',$this->moduleKeywords);
		$last = array_pop($keywords);
		foreach($keywords as $kw){
			echo '"'.$kw.'",';
		}
		echo '"'.$last.'"';
	?>
	],
	"version": "<? echo $this->moduleVersion; ?>"
}
