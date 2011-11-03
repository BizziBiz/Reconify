<?php
/*
 * External Library Includes
 */
include('core/includes/phpQuery/phpQuery.php');
include('core/includes/DocRaptor/DocRaptor.class.php');

/*
 * Core Engine Includes
 */
include('core/engine/engine.php');
include('core/engine/logging.php');
include('core/engine/modules.php');
include('core/engine/pdf.php');
include('core/engine/scoring.php');
include('core/engine/themes.php');
include('core/engine/email.php');

/*
 * Configuration Variables
 */
define('GENERATE_PDF', true);
define('PDF_DIR', 'files/'); 
define('DEBUGMODE', false);

/*
 * Only Required if PDF Generation is true
 */
define('DOCRAPTOR_API', 'hT80Up8AaqmHQvAspL7');
define('DOCRAPTOR_TEST' , true);

/*
 * Database Connection Info
 */
define('MYSQL_DB', 'quickreport');
define('MYSQL_USR', 'qr');
define('MYSQL_PASS', 'P8A2EDet');
define('MYSQL_HOST', '192.168.1.2');

/*
 * Direct Traffic
 */
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