<?php
include('core/includes/phpQuery/phpQuery.php');
include('core/engine/engine.php');
include('core/engine/modules.php');
include('core/engine/scoring.php');
include('core/engine/themes.php');

engine::init();
modules::run();
theme::loadTemplate('bizzibiz');
theme::render();

?>