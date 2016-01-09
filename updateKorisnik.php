<?php
	session_start();
	
	$idKorisnik = $_POST['idKorisnik'];
	$username = $_POST['username'];
	$eMail = $_POST['eMail'];
	$ime = $_POST['ime'];
	$prezime = $_POST['prezime'];
	$adresa = $_POST['adresa'];
	$brojTel = $_POST['brojTel'];
	$about = $_POST['about'];
	
	//ako je odabrana nova slika
	if ($_FILES['slika']['name']!=""){
		$BASEDIR = "images/";
		if (!file_exists($BASEDIR)) mkdir($BASEDIR, 755);

		$_FILES['slika']['name'] = explode(' ', $_FILES['slika']['name']);
		$_FILES['slika']['name'] = implode('_', $_FILES['slika']['name']);

		if (!file_exists($BASEDIR.$_FILES['slika']['name'])) {
			move_uploaded_file($_FILES['slika']['tmp_name'], $BASEDIR.$_FILES['slika']['name']);
		}
		$filename= $BASEDIR.$_FILES['slika']['name'];
		$data = addslashes(fread(fopen($filename, "r"), filesize($filename)));
	}
	
	@mysql_connect("localhost", "root", "vertrigo");
	@mysql_select_db("webshop");
	
	// UPDATE bez slike
	
	if ($_FILES['slika']['name']==""){
		$query = "UPDATE korisnik SET
		          username='" . $username ."',
				  eMail='" . $eMail . "',
				  ime='" . $ime . "',
				  prezime='" . $prezime . "',
				  adresa='" . $adresa . "',
				  brojTel='" . $brojTel . "',
				  about='" . $about . "'
				  WHERE idKorisnik='" . $idKorisnik ."'";

	} 
	// UPDATE sa slikom!
	else {
		$query = "UPDATE korisnik SET
		          username='" . $username ."',
				  eMail='" . $eMail . "',
				  ime='" . $ime . "',
				  prezime='" . $prezime . "',
				  adresa='" . $adresa . "',
				  brojTel='" . $brojTel . "',
				  about='" . $about . "',
				  slika='" . $data . "' WHERE idKorisnik='" . $idKorisnik ."'";
	}
	
	$result = mysql_query($query);
	mysql_close();
	
	if($result){
		header("Location: updateKorisnikForm.php?action='azurirano'");
	} else {
		print("Greska!");
	}
	
?>