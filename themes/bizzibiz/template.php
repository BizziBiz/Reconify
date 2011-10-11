<!DOCTYPE html>
<html lang="en-US">
<head>
	<base href="/themes/bizzibiz/" />
	<meta charset=utf-8>
	<title>Results</title>
	<link rel="shortcut icon" href="favicon.ico" type="image/vnd.microsoft.icon" />
	<link rel="stylesheet" href="css/960.css" type="text/css">
	<link rel="stylesheet" href="css/style.css" type="text/css">
	<link rel="stylesheet" href="css/print.css" type="text/css" media="print">
	<link href='http://fonts.googleapis.com/css?family=Volkhov:400italic' rel='stylesheet' type='text/css'>
</head>
<body>

<div id="content" class="container_12">
	<div id="header">
		<div id="header_left" class="grid_6">
			<div class="logo"><img src="css/images/logo.png"/></div>
			<div class="subtext">Quick Report</div>
		</div>
		<div id="header_right" class="grid_6">
			<div id="results">
				<div id="results_url"><?=URL?></div>
				<div id="results_grade">
					<div class="label">grade</div>
					<div class="value"><?=score::getGrade()?></div>
				</div>
				<div id="results_score">
					<div class="label">score</div>
					<div class="value"><?=score::display()?></div>
				</div>
			</div>
			
		</div>
	</div>
	<div class="clear"></div>
	<div id="body" class="grid_12">
		<?=theme::display()?>
	</div>
	<div id="footer">
		Copyright © 2011. Bizzibiz. All rights reserved.
	</div>
</div>
</body>
</html>
