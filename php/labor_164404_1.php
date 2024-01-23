//stare zadanie z laba4

<?php
	$nr_indeksu = '164404';
	$nrGrupy = '1';
	
	echo'Łukasz Łuckiewicz '.$nr_indeksu.' grupa '.$nrGrupy.'<br><br>';
	
	echo'Zastosowanie metody include()<br/>';
	
	echo'wartość zmiennej przed include(): '.$zmienna.'<br>';
	include('inny_plik.php');
	echo'wartość zmiennej po include(): '.$zmienna.'<br><br>';
	
	echo'Zastosowanie if, else, elseif, switch<br/>';
	
	if($zmienna == 'idk'){
		echo'nie wiem';
	}
	elseif($zmienna == "hah"){
		echo'hahaha';
	}
	else{
		echo'niewiadomo';
	}
	echo'<br><br>';
	
	echo'Zastosowanie pętli<br/>';
	
	$i = 0;
	while($i<=10){
		echo $i.'<br>';
		$i++;
	}
	for($x=10;$x>0;$x--){
		echo $x.'<br>';
	}
	
	echo'Zastosowanie $_GET, $_POST i $_SESSION<br/>';
	
	echo'Witaj '.htmlspecialchars($_GET['imie']).'<br>';
	
	echo'dostalem '.htmlspecialchars($_POST['imie']).'<br>';
?>