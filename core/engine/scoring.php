<?php
/*
* Exponential decay model - weight 2 is 1/2 of weight 1, 3 is 1/2 of 2, etc
*/

class score{
	private static $score = array();

	public static function display(){
		$finalScore = score::calculateScore();
		$finalScore = number_format($finalScore);
		return $finalScore . '/100';
	}
	
	private static function calculateScore(){
		score::cleanScores();
		$grpScores = score::groupScores();
		
		//print_r(score::$score);
		// Add all weights used to array
		$weightsUsed = array();
		foreach(score::$score as $record)
			array_push($weightsUsed, $record['weight']);
		
		// Filter to unique values
		$weightsUsed = array_unique($weightsUsed);
		
		// Calculate our potential sum if all values are 100%
		$potentialSum = 0;
		foreach($weightsUsed as $weight){
			$potentialSum += 100/$weight;
		}

		// Calculate actual score
		$finalSum = 0;
		foreach($grpScores as $index=>$score){
			$finalSum += ($score['sum']/$score['qty']) * (1/$index);
		}
		
		// Convert from decimal to pretty-print
		$finalScore = ($finalSum/$potentialSum) * 100;
		
		return $finalScore;
	}
	
	public static function getGrade(){
		$num = score::calculateScore();
		switch($num){
			case $num > 90:
				return 'A';
				break;
			case $num > 80:
				return 'B';
				break;
			case $num > 70:
				return 'C';
				break;
			case $num > 60:
				return 'D';
				break;
			default:
				return 'F';
				break;
		}
	}
	
	private static function groupScores(){
		$tmp = array();
		
		foreach(score::$score as $record){
			$weight = $record['weight'];

			if(isset($tmp[$weight])){
				$tmp[$weight]['sum'] = ($tmp[$weight]['sum'] + $record['value']);
				$tmp[$weight]['qty']++;
			}else{
				$tmp[$weight]['sum'] = $record['value'];
				$tmp[$weight]['qty'] = 1;
			}
		}
		
		return $tmp;
	}
	
	private static function cleanScores(){
		foreach(score::$score as &$record){
			if($record['value'] > 100)
				$record['value'] = 100;
			
			if($record['value'] < 0)
				$record['value'] = 0;
			
			if($record['weight'] < 1)
				$record['weight'] = 1;
		}
	}
	
	public static function add($value, $weight){
		$tmp = array();
		$tmp['value'] = $value;
		$tmp['weight'] = $weight;
		
		array_push(score::$score, $tmp);
	}
}

?>