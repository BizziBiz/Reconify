<?php

class engine{
	private static $start;
	private static $finish;
	private static $loadtime;

	public static function init(){
		set_time_limit(180);
		
		$url = $_POST['url'];
		if (preg_match('|^https*://|', $url) === 0){
        	$url = 'http://' . $url;
    	}
    	
		define("URL", $url);
		define("CLEANURL", engine::cleanURL($url));
		
		$site = engine::loadURL(URL);
		
		if($site){
			define("PAGE", phpQuery::newDocumentHTML($site));
			logging::addRecord('status', 'engine', 'site_loaded', 'true');
		}else{
			logging::addRecord('status', 'engine', 'site_loaded', 'false');
			die("Site could not be loaded");
		}
	}
	
	private static function cleanURL($url){
	    // Strip prefix
		$bizname = substr($url, strpos($url, '//') + 2);
		$rem = strpos($bizname, '/');
		
		// Strip Folders & directories, if applicable
		if(isset($rem) && $rem != 0){
			$bizname = substr($bizname, 0, $rem);
		}
	
		return $bizname;
	}
	
	public static function loadURL($url, $timeout = 10, $post = false){
		$header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,"; 
		$header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5"; 
		$header[] = "Cache-Control: max-age=0"; 
		$header[] = "Connection: keep-alive"; 
		$header[] = "Keep-Alive: 300"; 
		$header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7"; 
		$header[] = "Accept-Language: en-us,en;q=0.5"; 
		$header[] = "Pragma: ";

		$curl = curl_init();
		
		curl_setopt($curl, CURLOPT_URL, $url); 
		curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.2.3) Gecko/20100401 Firefox/3.6.3'); 
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header); 
		curl_setopt($curl, CURLOPT_REFERER, 'http://www.google.com'); 
		curl_setopt($curl, CURLOPT_ENCODING, 'gzip,deflate'); 
		curl_setopt($curl, CURLOPT_AUTOREFERER, true); 
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true); 
		
		if($post){
		    curl_setopt($curl, CURLOPT_POST, true );
		    curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
		}
				
		$return = curl_exec($curl);
		curl_close($curl);

		return $return;
	}
	
	public static function startTimer(){
		$time = microtime();
		$time = explode(' ', $time);
		$time = $time[1] + $time[0];
		return $time;
	}
	
	public static function stopTimer($start){
		$time = microtime();
		$time = explode(' ', $time);
		$time = $time[1] + $time[0];		
		return round(($time - $start), 4);
	}
}
?>