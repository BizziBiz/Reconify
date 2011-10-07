<?php

define("THEMEPATH", './themes/');

/*

themes.php (group - title/weight/description, lineitem - result/title/value, table - 2dimensionalarray/colrow/headerrow)
template.php ($content, variableArray, $score)


// module
	$theme->addGroup->addGroup->addLineItem();

//

*/


class theme{
	private static $content;
	private static $template;
	
	public static function display($tmp){
		theme::$content .= $tmp.'<br />';
	}
	
	public static function loadTemplate($templatename){
		theme::$template = file_get_contents(THEMEPATH."/$templatename/template.php");
	}
	
	public static function render(){
		eval("?>".theme::$template."<?");
	}
	
	public static function getContent(){
		return theme::$content;
	}
}

?>