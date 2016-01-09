<?php
	session_start();
	
	$idKnjiga = $_POST['idKnjiga'];
	$naziv = $_POST['naziv'];
	$autorIme = $_POST['autorIme'];
	$zanr = $_POST['zanr'];
	$brojPrimjeraka = $_POST['brojPrimjeraka'];
	$cijena = $_POST['cijena'];
	
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
		$query = "UPDATE knjiga SET
		          naziv='" . $naziv ."',
				  autorIme='" . $autorIme . "',
				  zanr='" . $zanr . "',
				  brojPrimjeraka='" . $brojPrimjeraka . "',
				  cijena='" . $cijena . "'
				  WHERE idKnjiga='" . $idKnjiga ."'";

	} 
	// UPDATE sa slikom!
	else {
		$query = "UPDATE knjiga SET
		          naziv='" . $naziv ."',
				  autorIme='" . $autorIme . "',
				  zanr='" . $zanr . "',
				  brojPrimjeraka='" . $brojPrimjeraka . "',
				  cijena='" . $cijena . "',
				  slika='" . $data . "' WHERE idKnjiga='" . $idKnjiga ."'";
	}
	
	$result = mysql_query($query);
	mysql_close();
	
	if($result){
		header("Location: updateKnjigaForm.php?action='azurirano'");
	} else {
		print("Greska!");
	}
	
?>