<?php
define("MODPATH", './modules/');

class modules{
	private static $modules = array();

	public static function run(){
		modules::init();
		$debug = array();
		
		foreach(modules::$modules as $module){
			$timer = NULL;
			$timer = engine::startTimer();
			
			modules::runModule($module);
			
			$totalTime = engine::stopTimer($timer);
			$debug[$module] = $totalTime;			
			logging::addTimeRecord($module, $totalTime);
		}
		
		if(DEBUGMODE){
			echo '[TIME REPORT]';
			print_r($debug);
		}
	}
	
	private function runModule($moduleName){
		@include(MODPATH."$moduleName/$moduleName.module");
		if(class_exists($moduleName)){
			try{
				define(strtoupper($moduleName).'_KEY', serialize(modules::loadKeyfile(MODPATH."$moduleName/$moduleName.key")));
				$init = new $moduleName();
			}catch(Exception $e){
				die("Error in module $moduleName - $e");
			}
		}else{
			die("Incorrect config in module $moduleName\n");
		}
	}
	
	private static function init(){
		$od = opendir(MODPATH);
		while(false !== ($file=readdir($od))){
			if(is_dir(MODPATH.$file)){
				$ignore = array('.','..');
				if(!in_array($file, $ignore))
					array_push(modules::$modules, $file);
			}
		} 
		closedir($od);
	}
	
	private function loadKeyfile($path){
		$content = @file_get_contents($path);
		if(!$content)
			return;
			
		// encode and decode to to prevent illegal values
		return json_decode(json_encode((array) simplexml_load_string($content)),1);
	}
}

?>