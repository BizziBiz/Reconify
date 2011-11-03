<?php
define("THEMEPATH", './themes/');

class theme{
	private static $content = array();
	private static $template;
	
	public static function createBlock($id, $title='', $desc='', $class=''){
		if(theme::blockExists($id))
			return;
			
		theme::$content[$id] = array();
		theme::$content[$id]['header'] = "<div id='$id' class='block $class'>";
		theme::$content[$id]['footer'] = "</div>";
				
		theme::$content[$id]['title'] = "<div class='blockTitle'>$title</div>";
		theme::$content[$id]['title_raw'] = $title;	
		
		theme::$content[$id]['desc'] = "<div class='blockDesc'>$desc</div>";
		theme::$content[$id]['desc_raw'] = $desc;	
	}
	
	public static function addToBlock($id, $content){
		theme::$content[$id]['content'] .= $content;
	}
	
	public static function lineItem($status, $title, $value, $long = ''){
		$tooltip = '';
		if($long != '')
			$tooltip = theme::addTooltip($long);
		
		return "<table class='lineitem'><tr class='$status'><td class='status'><img src='css/images/$status.png' alt='$status'></td><td class='title'>$title $tooltip</td><td class='value'>$value</td></tr></table>";
	}
	
	public static function addTooltip($description){
		return "<a class='tooltip'><img src='css/images/q.png' width='20px' /><span>$description</span></a>";
	}
	
	public static function addLabel($title, $value = ''){
		return "<div class='textlabel'><span class='orange'>$title</span>$value</div>";
	}
	
	public static function createTable($colTitles = array(), $values = array()){
		$output = '<table class="table_generic"><thead><tr>';
		foreach($colTitles as $title){
			$output .= "<td>$title</td>";
		}
		
		$output .= '</tr></thead><tbody>';
		foreach($values as $row){
			$output .= '<tr>';
			foreach($row as $cell){
				$output .= "<td>$cell</td>";
			}
			$output .= '</tr>';
		}
		$output .= '</tbody></table>';
		return $output;
	}
	
	public static function createSubblock($values){
		$output = '<table class="table_subblock"><tbody>';
		foreach($values as $row){
			$output .= '<tr>';
			$output .= '<td class="label">'.$row[0].'</td>';
			$output .= '<td class="value">'.$row[1].'</td>';
			$output .= '</tr>';	
		}
		$output .= '</tbody></table>';
		return $output;
	}
	
	private static function blockExists($id){
		return isset(theme::$content[$id]);
	}

	private static function render ($file, $vars)
	{
	    $renderedHtml = '';
	    $rawHtml = addcslashes (file_get_contents($file),'"\\');
	    extract ($vars, EXTR_SKIP);
	    eval('$renderedHtml = "'.$rawHtml.'";');
	
	    return $renderedHtml;
	}
	
	public static function loadTemplate($templatename){
		$renderedHTML = theme::loadHTML($templatename);
		if(GENERATE_PDF)
			pdf::generatePDF($renderedHTML);
		echo $renderedHTML;
	}
	
	public static function loadHTML($templatename){
		$tpl = array();
		$tpl['url'] = URL;
		$tpl['cleanurl'] = CLEANURL;
		
		foreach(score::getGradeLetters() as $key=>$value){
			$tpl['grade_'.$key] = $value;	
		}

		foreach(score::getFormattedGrades() as $key=>$value){
			$tpl['score_'.$key] = $value;
		}
		
		$tpl['body'] = theme::display();
		$tpl['pdf'] = pdf::getPDFName();
		$tpl['pdfpath'] = pdf::getPDFPath();
	
		return theme::render(THEMEPATH."/$templatename/template.php", $tpl);
	}
	
	public static function display(){
		$output = '';
		
		ksort(theme::$content, SORT_STRING);
		
		foreach(theme::$content as $block){
			$output .= $block['header'];
			$output .= $block['title'];
			$output .= $block['desc'];
			$output .= '<div class="blockInner">'.$block['content'].'</div>';
			$output .= $block['footer'];
		}
		
		return $output;
	}
}

?>