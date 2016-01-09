<?php
	session_start();
	
	$idKorisnik = $_GET['idKorisnik'];
	
	@mysql_connect("localhost", "root", "vertrigo");
	@mysql_select_db("webshop");
	
	$query = "DELETE FROM korisnik WHERE idKorisnik='" . $idKorisnik . "'";
	
	$result = mysql_query($query);
	mysql_close();
	
	if($result){
		header("Location: confirmDeleteKorisnik.php?action='izbrisano'");
	} else {
		print("Greska!");
	}
	
?>