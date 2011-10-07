<?php
define("MODPATH", './modules/');

class modules{
	private static $modules = array();

	public static function run(){
		modules::init();
		foreach(modules::$modules as $module){
			modules::runModule($module);
		}
	}
	
	private function runModule($moduleName){
		@include(MODPATH."$moduleName/$moduleName.module");
		if(class_exists($moduleName)){
			try{
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
}

?>