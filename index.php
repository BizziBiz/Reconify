<?php
include('core/includes/phpQuery/phpQuery.php');
include('core/engine/engine.php');
include('core/engine/modules.php');
include('core/engine/pdf.php');
include('core/engine/scoring.php');
include('core/engine/themes.php');
include('core/engine/email.php');

define('GENERATE_PDF', false);
define('DOCRAPTOR_API', 'hT80Up8AaqmHQvAspL7');
define('DOCRAPTOR_TEST' , true);
define('DEBUGMODE', true);

if(isset($_GET['download'])){
	pdf::download($_GET['download']);
}else if(isset($_POST['email'])){
	email::sendMail($_POST);
}else{
	engine::init();
	modules::run();
	theme::loadTemplate('bizzibiz');
}
?>