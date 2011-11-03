<?php
include('core/includes/phpQuery/phpQuery.php');
include('core/engine/engine.php');
include('core/engine/logging.php');
include('core/engine/modules.php');
include('core/engine/pdf.php');
include('core/engine/scoring.php');
include('core/engine/themes.php');
include('core/engine/email.php');

define('GENERATE_PDF', true);
define('DOCRAPTOR_API', 'hT80Up8AaqmHQvAspL7');
define('DOCRAPTOR_TEST' , true);

define('MYSQL_DB', '');
define('MYSQL_USR', '');
define('MYSQL_PASS', '');
define('MYSQL_HOST', '');

define('DEBUGMODE', false);

set_time_limit(180);

if(isset($_GET['download'])){
	pdf::download($_GET['download']);
}else if(isset($_POST['email'])){
	email::sendMail($_POST);
}else{
	logging::init();
	engine::init();
	modules::run();
	theme::loadTemplate('bizzibiz');
}
?>