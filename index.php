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
define('DOCRAPTOR_API', '');
define('DOCRAPTOR_TEST' , false);

/*
 * Database Connection Info
 */
define('MYSQL_DB', '');
define('MYSQL_USR', '');
define('MYSQL_PASS', '');
define('MYSQL_HOST', '');

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