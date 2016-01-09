<?php
	session_start();
	error_reporting(E_ALL ^ E_NOTICE);
?>

<link rel="stylesheet" type="text/css" href="style.css">

<center>
<?php
	$idKnjiga = $_GET['idKnjiga'];
	$naziv = $_GET['naziv'];
	$action = $_GET['action'];
	
	if(isset($action)){
		print("Zapis uspijesno izbrisan");
	}
	else{
	print("Jeste li sigurni da zelite izbrisati<br><b>"
			. $naziv . "</b>?<br>
			<input type='button' class='button' value='Ne' onClick='javaspript:window.close()'/>
			&nbsp&nbsp&nbsp
			<input type='button' class='button' value='Da' onClick=\"location.href='brisiKnjigu.php?idKnjiga=" . $idKnjiga ."'\" />");
	}
?>
</center>