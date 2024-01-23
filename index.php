<?php
	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
	
	ini_set( 'error_reporting', E_ALL );
	ini_set( 'display_errors', true );
	/* po tym komentarzu będzie kod do dynamicznego ładowania stron */
	$strona = 'html/main.html';
    include('php/cfg.php');
    include('php/showpage.php');

// ||--------------Stare Funkcje Otwierające Statyczne Strony--------------||
//    if(isset($_GET['idp'])){
//        if($_GET['idp'] == '') $strona = 'html/main.html';
//        if($_GET['idp'] == 'historia') $strona = 'html/historia.html';
//        if($_GET['idp'] == 'zolwie') $strona = 'html/sukcesy.html';
//        if($_GET['idp'] == 'pielengnacja') $strona = 'html/dbanie.html';
//        if($_GET['idp'] == 'sukcesy') $strona = 'html/sukcesy.html';
//        if($_GET['idp'] == 'galeria') $strona = 'html/zdjecia.html';
//        if($_GET['idp'] == 'kontakt') $strona = 'html/kontakt.html';
//    }
//	
//	
//	include($strona);
    
// ||--------------Strony Otwierane Z Bazy Danych--------------||
    $conn = GetConn();
    if(isset($_GET['id'])){
        echo PokazPodstrone($_GET['id'],$conn);
    }
    else{
        // Przy braku podanego id wczytaj stronę główną (id 1)
        echo PokazPodstrone(1,$conn);
    }
	$nr_indeksu = '164404';
	$nrGrupy = '1';
	
	echo('Autor: Łukasz Łuckiewicz '.$nr_indeksu.' grupa '.$nrGrupy.' <br /><br />');

function Podstrony(){
    $conn = GetConn();
    $query="SELECT * FROM page_list where status = 1 LIMIT 100";
    $result = mysqli_query($conn,$query);
    $lista = [];
    while($row = mysqli_fetch_array($result)){
        $lista[] = [$row['id'], $row['page_title']];
    }
    return $lista;
}
?>

<html>
	<head>
		<title>żółwie wodne moją pasją</title>
		<link rel="icon" type="image/png" href="img/icon.png">
		<meta name="keywords" content="żółwie">
		<meta name="author" content="Łukasz Łuckiewicz">
		<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Language" content="pl" />
        <meta name="version" content="1.8">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="js/kodzik.js" type="text/javascript"></script>
	</head>
	<body>
	<?php
        // ||--------------Template Strony Do Wypełnienia--------------||
        echo '<script>
        const lista = [';
        $text = "";
        foreach(Podstrony() as $strona){
            $text .= '['.$strona[0].', "'.$strona[1].'"],';
        }
        $text = substr_replace($text ,"",-1);
        echo $text,']
            loadsite(lista)</script>
            </script>';
	?>
	</body>
</html>

