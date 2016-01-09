<?php
	session_start();
	
	$idKnjiga = $_GET['idKnjiga'];
	
	@mysql_connect("localhost", "root", "vertrigo");
	@mysql_select_db("webshop");
	
	$query = "DELETE FROM knjiga WHERE idKnjiga='" . $idKnjiga . "'";
	
	$result = mysql_query($query);
	mysql_close();
	
	if($result){
		header("Location: confirmDelete.php?action='izbrisano'");
	} else {
		print("Greska!");
	}
	
?>