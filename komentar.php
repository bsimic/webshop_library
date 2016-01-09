<?php

	session_start();
	
	//error_reporting(E_ALL ^ E_NOTICE);
	
	$komentar = $_GET['komentar'];
	$idKnjiga = $_GET['idKnjiga'];
	$username = $_SESSION['login_user'];
	
	
	//spajanje na bazu
	@mysql_connect("localhost", "root", "vertrigo");
	@mysql_select_db("webshop");
	
	//uzimanje id korisnika iz baze
	$query = "SELECT idKorisnik FROM korisnik WHERE username='" . $username . "'";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result, MYSQL_NUM);
	$idKorisnik = $row[0];
	
	//provjera da li je korisnik ocjenio knjigu
	$query = "SELECT * FROM ocjena WHERE idKorisnik='" . $idKorisnik . "' AND idKnjiga='" . $idKnjiga . "'";
	$result = mysql_query($query);
	//ako je
	if(mysql_num_rows($result) > 0){
		//update zapisa
		$query = "UPDATE ocjena SET komentar='" . $komentar . "' WHERE idKorisnik='" . $idKorisnik . "' AND idKnjiga='" . $idKnjiga . "'";
		$result = mysql_query($query);
		if($result){
			//uspjesan upis
			mysql_close();
			header("Location: knjiga.php?idKnjiga=" . $idKnjiga . "");
			}
		else{
			mysql_close();
			header("Location: knjiga.php?error=true&idKnjiga=" . $idKnjiga . "");
		}
	}
	else{
		$query = "INSERT INTO ocjena(idKorisnik, idKnjiga, komentar) VALUES
					('" . $idKorisnik . "','" . $idKnjiga . "','" .  $komentar . "')";
		$result = mysql_query($query);
		
		
		if($result){
			//uspjesan upis
			mysql_close();
			header("Location: knjiga.php?idKnjiga=" . $idKnjiga . "");
			}
		else{
			mysql_close();
			header("Location: knjiga.php?error=true&idKnjiga=" . $idKnjiga . "");
		}
	}
	
?>