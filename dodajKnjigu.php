<?php
	session_start();
	
	//preuzimanje poslanih vrijednosti post metodom
	$naziv = $_POST['naziv'];
	$zanr = $_POST['zanr'];
	$brojPrimjeraka = $_POST['brojPrimjeraka'];
	$autorIme = $_POST['autorIme'];
	$cijena = $_POST['cijena'];
	
	$BASEDIR = "images/";
	if (!file_exists($BASEDIR)) mkdir($BASEDIR, 755);
	
	$_FILES['slika']['name'] = explode(' ', $_FILES['slika']['name']);
	$_FILES['slika']['name'] = implode('_', $_FILES['slika']['name']);
	
	if (!file_exists($BASEDIR.$_FILES['slika']['name'])) {
		move_uploaded_file($_FILES['slika']['tmp_name'], $BASEDIR.$_FILES['slika']['name']);
	}
	
	$filename= $BASEDIR.$_FILES['slika']['name'];
	
	$data = addslashes(fread(fopen($filename, "r"), filesize($filename)));
	
	
	//spajanje na bazu
	@mysql_connect("localhost", "root", "vertrigo");
	@mysql_select_db("webshop");
	
	//trazenje knjige sa tim imenom
	$query = "SELECT naziv FROM knjiga WHERE naziv='" . $naziv . "'";
	$result = mysql_query($query);
	
	if(mysql_num_rows($result) > 0){
		mysql_close();
		header("Location:dodajKnjiguForm.php?error=user");
	}
	else {
				
				$query = "INSERT INTO knjiga (idKnjiga, naziv, zanr, brojPrimjeraka, autorIme, cijena, slika) VALUES 
							('null', '" . $naziv . "','" . $zanr . "','" .  $brojPrimjeraka . "','" . $autorIme . "','" . $cijena . "','" . $data . "')";
				$result = mysql_query($query);
				if($result){
					//uspjesan upis
					mysql_close();
					header("Location: dodajKnjiguForm.php?error=false");
				}
				else{
					//neuspjesan upis
					mysql_close();
					header("Location: dodajKnjiguForm.php?error=baza");
				}
			}
		
	
?>