<?php
class logging{
	private static $dbObj;
	
	/*
	* $type = status, error
	* $category = score, time, 
	*/
	public static function addRecord($type = 'status', $category, $key, $value){
		$time = time();
		$url = CLEANURL;
		mysql_query("INSERT INTO logging VALUES ('', '$url', '$type', '$category', '$key', '$value', '$time')", logging::$dbObj);
	}
	
	public static function addTimeRecord($module, $reported_time){
		$time = time();
		$url = CLEANURL;
		mysql_query("INSERT INTO time_report VALUES ('', '$url', '$module', '$reported_time', '$time')", logging::$dbObj);
	}
	
	public static function init(){
		logging::$dbObj = mysql_connect(MYSQL_HOST, MYSQL_USR, MYSQL_PASS);
		if(!logging::$dbObj)
			die('Could not connect to logging database. ' . mysql_error());
		mysql_select_db(MYSQL_DB);
	}
	
	public function __destruct(){
		mysql_close(logging::$dbObj);
	}	
}
?>