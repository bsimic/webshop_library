<?php

$id = $_GET["id"];

if($id) {

	@mysql_connect("localhost", "root", "vertrigo");
	@mysql_select_db("webshop");
	
	$query = "SELECT slika FROM korisnik WHERE idKorisnik='" . $id ."'";
	$result = mysql_query($query);
	
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	$data = $row["slika"];
	
	Header("Content-type: image/jpeg");
	echo $data;
	mysql_close();

}

?>