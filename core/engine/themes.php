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
	
	
	/* REFACTOR THIS */
	public static function lineItem($status, $title, $value, $long = ''){
		$tooltip = '';
		if($long != '')
			$tooltip = "<a class='tooltip'><img src='css/images/q.png' width='20px' /><span>$long</span></a>";
		

		return "<table class='lineitem'><tr class='$status'><td class='status'><img src='css/images/$status.png' alt='$status'></td><td class='title'>$title $tooltip</td><td class='value'>$value</td></tr></table>";
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
		$tpl['grade'] = score::getGrade();
		$tpl['score'] = score::display();
		$tpl['body'] = theme::display();
		$tpl['pdf'] = pdf::getPDFName();
		$tpl['pdfpath'] = pdf::getPDFPath();
	
		return theme::render(THEMEPATH."/$templatename/template.php", $tpl);
	}
	
	public static function display(){
		$output = '';
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