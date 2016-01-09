<?php
	session_start();
?>

<link rel="stylesheet" type="text/css" href="style.css">
<div id="content">

<head>


<?php

	error_reporting(E_ALL ^ E_NOTICE);
	
	$username = $_SESSION['login_user'];
	$error = $_GET['error'];
	
	@mysql_connect("localhost", "root", "vertrigo");
	@mysql_select_db("webshop");
	
	//uzimanje id korisnika iz baze
	$query = "SELECT idKorisnik FROM korisnik WHERE username='" . $username . "'";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result, MYSQL_NUM);
	$idKorisnik = $row[0];
	
	
	//include("preporuka.php");
	
	
	$query = "SELECT * FROM korisnik WHERE idKorisnik = '" . $idKorisnik . "'";
	$result = mysql_query($query);
	
	print("<table id='profileTable' border='5'>");
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
			
			$adresa = $row['adresa'];
			$brojTel = $row['brojTel'];
			$about = $row['about'];
			
			print("<tr>");
			print("<td id='tdSlika' rowspan='1' width='400' align='center'>");
			print("<img <img src=\"dohvatiSlikuKorisnik.php?id=" . $row["idKorisnik"] . "\" height='150' width='200'></td>");
			print("<td width ='400' height='100' align='center'><b>Hello <a style=' color:#330000;' href='profil.php'>" . $user_check ."</b></td></tr>");
			print("<tr><td width ='400' height='100' align='center'><b>Username: </td><td width ='400' align='center'>" . $row["username"] . "<b/></td></tr>");
			print("<tr><td width ='400' height='100' align='center'> <i>E-mail: </td><td width ='400' align='center'>" . $row["eMail"] . "<i/></td></tr>");
			print("<tr><td width ='400' height='100' align='center'> Name: </td><td width ='400' align='center'>" . $row["ime"] . "</td></tr>");
			print("<tr><td width ='400' height='100' align='center'><b>Surname: </td><td width ='400' align='center'>" . $row["prezime"] . "<b/></td></tr>");
			if($adresa != NULL) print("<tr><td width ='400' height='100' align='center'><b>Adress: </td><td width ='400' align='center'>" . $adresa . "<b/></td></tr>");
			if($brojTel != NULL) print("<tr><td width ='400' height='100' align='center'><b>Tel, number: </td><td width ='400' align='center'>" . $brojTel . "<b/></td></tr>");
			if($about != NULL) print("<tr><td width ='400' height='100' align='center'><b>About me: </td><td width ='400' align='center'>" . $about . "<b/></td></tr>");
			
			print("<tr><td colspan='2' height='20'></td></td>");
			
			
			$queryKupnjaCount = "SELECT COUNT(*) FROM knjiga JOIN kupio JOIN korisnik WHERE knjiga.idKnjiga=kupio.idKnjiga AND kupio.idKorisnik=korisnik.idKorisnik AND korisnik.idKorisnik='" . $idKorisnik ."'";
			$resultKupnjaCount = mysql_query($queryKupnjaCount);
			$rowKupnjaCount = mysql_fetch_array($resultKupnjaCount, MYSQL_NUM);
			$ukupnoKupljenih = $rowKupnjaCount[0];
			
			$queryKupnja = "SELECT naziv FROM knjiga JOIN kupio JOIN korisnik WHERE knjiga.idKnjiga=kupio.idKnjiga AND kupio.idKorisnik=korisnik.idKorisnik AND korisnik.idKorisnik='" . $idKorisnik ."'";
			$resultKupnja = mysql_query($queryKupnja);
			
			print("<tr><td colspan='2'><b>Purchase history: </b></td></tr>");
			for($i=0; $i<$ukupnoKupljenih; $i++){
				$rowKupnja = mysql_fetch_array($resultKupnja, MYSQL_ASSOC);
				if($rowKupnja){
					print("<tr><td colspan='2'>" . $rowKupnja['naziv'] . "</td></tr>");
				}
			}
			
			print("</table>");
			
	
	
?>



</div>