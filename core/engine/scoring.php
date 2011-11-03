<?php
/*
* Exponential decay model - weight 2 is 1/2 of weight 1, 3 is 1/2 of 2, etc
*/

class score{
	private static $score = array();

	public static function getFormattedGrades(){
		$finalScore = score::calculateScores();
		$return = array();
		
		foreach($finalScore as $key=>$value){
			$tmp = number_format($finalScore[$key]);
			$return[$key] = $tmp . '/100';
		}
		return $return;
	}
	
	private static function calculateScores($silent = false){
		score::cleanScores();
		
		$grpScores = score::groupScores();
		
		// Add all weights used to array
		$weightsUsed = array();
		foreach(score::$score as $key=>$category)
			foreach($category as $record){
				if(!isset($weightsUsed[$key]))
					$weightsUsed[$key] = array();
							
				array_push($weightsUsed[$key], $record['weight']);
			}
			
		// Filter to unique values
		foreach($weightsUsed as $key=>$category){
			$weightsUsed[$key] = array_unique($weightsUsed[$key]);
		}
		
		// Calculate our potential sum if all values are 100%
		$potentialSums = array();
		foreach($weightsUsed as $key=>$categories){
			foreach($categories as $weight){
				$potentialSums[$key] += 100/$weight;
			}
		}
		
		if(DEBUGMODE && !$silent){
			foreach(score::$score as $key=>&$category){
				foreach($category as &$record){
					$weight = $record['weight'];
					$totalSum = $potentialSums[$key];
					$weightSum = 100/$weight;
					$record['effect_on_score'] = number_format(($weightSum/$totalSum) * (100/$grpScores[$key][$weight]['qty']), 1) . '%';
				}
			}
			
			echo '[SCORE REPORT]';
			print_r(score::$score);
		}
		

		// Calculate actual score
		$finalSums = array();
		foreach($grpScores as $key=>$category){
			foreach($category as $index=>$score){
				$finalSums[$key] += ($score['sum']/$score['qty']) * (1/$index);
			}
		}
		
		// Convert from decimal to pretty-print
		$finalScores = array();
		foreach($finalSums as $key=>$value){
			$score =  ($finalSums[$key]/$potentialSums[$key]) * 100;
			$finalScores[$key] = $score;
			
			if(!$silent)
				logging::addRecord('status', 'score', $key, $score);
		}
		
		//$finalScore = ($finalSum/$potentialSum) * 100;
		
		return $finalScores;
	}
		
	public static function getGradeLetters(){
		$scores = score::calculateScores(true);
		$return = array();
		
		foreach($scores as $key=>$num){
			$num = number_format($num);
			switch($num){
				case $num >= 90:
					$return[$key] = 'A';
					break;
				case $num >= 80:
					$return[$key] = 'B';
					break;
				case $num >= 70:
					$return[$key] = 'C';
					break;
				case $num >= 60:
					$return[$key] = 'D';
					break;
				default:
					$return[$key] = 'F';
					break;
			}
		}
		
		return $return;
		
	}
	
	private static function groupScores(){
		$tmp = array();
		
		foreach(score::$score as $key=>$category){
			foreach($category as $record){
				$weight = $record['weight'];
				
				if(isset($tmp[$key][$weight])){
					$tmp[$key][$weight]['sum'] = ($tmp[$key][$weight]['sum'] + $record['value']);
					$tmp[$key][$weight]['qty']++;
				}else{
					if(!isset($tmp[$key]))
						$tmp[$key] = array();
						
					$tmp[$key][$weight]['sum'] = $record['value'];
					$tmp[$key][$weight]['qty'] = 1;
				}
			}
		}
		
		return $tmp;
	}
	
	private static function cleanScores(){
		foreach(score::$score as &$category){
			foreach($category as &$record){
				if($record['value'] > 100)
					$record['value'] = 100;
			
				if($record['value'] < 0)
					$record['value'] = 0;
			
				if($record['weight'] < 1)
					$record['weight'] = 1;
			}
		}
	}
	
	public static function add($value, $weight, $category = 'default', $module = ''){
		if(!isset(score::$score[$category])){
			score::$score[$category] = array();
		}
	
		$tmp = array();
		$tmp['value'] = $value;
		$tmp['weight'] = $weight;
		$tmp['module'] = $module;
		
		array_push(score::$score[$category], $tmp);
	}
}

?>