<?php

class score{
	private static $score = 13;

	public static function get(){
		return score::$score;
	}
	
	public static function add($value, $weight){
		score::$score++;
	}
}

?>