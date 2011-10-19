<!DOCTYPE html>
<html lang="en-US">
<head>
	<base href="http://scan.dev50.com/themes/bizzibiz/" />
	<meta charset=utf-8>
	<title>Results</title>
	<link rel="shortcut icon" href="favicon.ico" type="image/vnd.microsoft.icon" />
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
	<link rel="stylesheet" href="css/960.css" type="text/css" media="screen">
	<link rel="stylesheet" href="css/print.css" type="text/css" media="print">
	<link href='http://fonts.googleapis.com/css?family=Volkhov:400italic' rel='stylesheet' type='text/css'>
	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
	<script language="javascript" src="http://www.google.com/jsapi"></script>
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
				<div id="results_url">{$url}</div>
				<div id="results_grade">
					<div class="label">grade</div>
					<div class="value">{$grade}</div>
				</div>
				<div id="results_score">
					<div class="label">score</div>
					<div class="value">{$score}</div>
				</div>
			</div>
			
		</div>
	</div>
	<div class="clear"></div>
	<div class="links">
		<div class="email">
			<a id="email_popup_link">Email<img src="css/images/email_icon.png" /></a>
		</div>
		<div class="download">
			<a href="/index.php?download={$pdf}">Download<img src="css/images/download_icon.png" /></a>
		</div>
		<div class="print">
			<a href="/{$pdfpath}" target="_blank">Print<img src="css/images/print_icon.png" /></a>
		</div>
	</div>
	<div class="clear"></div>
	<div id="body" class="grid_12">
		{$body}
	</div>
	<div id="footer">
		Copyright (C) 2011. Bizzibiz. All rights reserved.
	</div>
	<div id="overlay">
			<div id="email_form">
				<div class="left">
					<form action="index.php" method="post">
						<label>To:</label><input type="text" name="to" id="email_to" />
						<label>From:</label><input type="text" name="from" id="email_from" />
						<textarea name="email_message"></textarea>
						<input type="button" value="Send" id="email_send"/>
					</form>
				</div>
				<div class="right">
					<h3>Send an email</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nibh sem, ullamcorper nec molestie quis, vehicula eu velit. In hac habitasse platea dictumst. Aliquam eu magna eu dolor lacinia convallis a sit amet magna. Fusce viverra, lorem ac molestie iaculis, nunc nisl sagittis ipsum, sed tempor nunc lacus vitae ligula.</p>
				</div>
				<div class="overlay_close">x</div>
			</div>
	</div>
	
</div>
</body>
</html>