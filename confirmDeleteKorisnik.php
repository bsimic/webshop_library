<?php
	session_start();
	error_reporting(E_ALL ^ E_NOTICE);
?>

<link rel="stylesheet" type="text/css" href="style.css">

<center>
<?php
	$idKorisnik = $_GET['idKorisnik'];
	$username = $_GET['username'];
	$action = $_GET['action'];
	
	if(isset($action)){
		print("Zapis uspijesno izbrisan");
	}
	else{
	print("Jeste li sigurni da zelite izbrisati korisnika<br><b>"
			. $username . "</b>?<br>
			<input type='button' class='button' value='Ne' onClick='javaspript:window.close()'/>
			&nbsp&nbsp&nbsp
			<input type='button' class='button' value='Da' onClick=\"location.href='brisiKorisnika.php?idKorisnik=" . $idKorisnik ."'\" />");
	}
?>
</center>