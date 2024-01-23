<?php
	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
	
	ini_set( 'error_reporting', E_ALL );
	ini_set( 'display_errors', true );
	/* po tym komentarzu będzie kod do dynamicznego ładowania stron */
	$strona = 'html/main.html';
	if($_GET['idp'] == '') $strona = 'html/main.html';
	if($_GET['idp'] == 'historia') $strona = 'html/historia.html';
	if($_GET['idp'] == 'zolwie') $strona = 'html/sukcesy.html';
	if($_GET['idp'] == 'pielengnacja') $strona = 'html/dbanie.html';
	if($_GET['idp'] == 'sukcesy') $strona = 'html/sukcesy.html';
	if($_GET['idp'] == 'galeria') $strona = 'html/zdjecia.html';
	if($_GET['idp'] == 'kontakt') $strona = 'html/kontakt.html';
	
	
	include($strona);
	$nr_indeksu = '164404';
	$nrGrupy = '1';
	
	echo('Autor: Łukasz Łuckiewicz '.$nr_indeksu.' grupa '.$nrGrupy.' <br /><br />');
?>

<html>
	<head>
		<title>żółwie wodne moją pasją</title>
		<link rel="icon" type="image/png" href="img/icon.png">
		<meta name="keywords" content="żółwie">
		<meta name="author" content="Łukasz Łuckiewicz">
		<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Language" content="pl" />
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="js/kodzik.js" type="text/javascript"></script>
	</head>
	<body>
	<?php
		echo("<script>loadsite()</script>");
	?>
	</body>
</html>

