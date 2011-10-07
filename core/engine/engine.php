<?php


class engine{
	public static function init(){
		$url = $_POST['url'];
		if (preg_match('|^https*://|', $url) === 0){
        	$url = 'http://' . $url;
    	}

		define("URL", $url);
			
		$site = @file_get_contents(URL);
		if($site){
			define("PAGE", phpQuery::newDocumentHTML($site));
		}else{
			die("Site could not be loaded");
		}
	}
}

?>