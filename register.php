<?php
	//preuzimanje poslanih vrijednosti post metodom
	$username = $_POST['username'];
	$password = $_POST['password'];
	$passwordConfirm = $_POST['passwordConfirm'];
	$email = $_POST['email'];
	$ime = $_POST['ime'];
	$prezime = $_POST['prezime'];
	
	//spajanje na bazu
	@mysql_connect("localhost", "root", "vertrigo");
	@mysql_select_db("webshop");
	
	//trazenje korisnika sa tim imenom
	$query = "SELECT username FROM korisnik WHERE username='" . $username . "'";
	$result = mysql_query($query);
	
	if(mysql_num_rows($result) > 0){
		mysql_close();
		header("Location: index.php?a=register&error=user");
	}
	else{
		//provjera dali je mail valjan
		$isEmailValid = filter_var( $email, FILTER_VALIDATE_EMAIL );
		
		//ako je password dobro potvrđen
		if($password == $passwordConfirm){
			//mail valjan
			if($isEmailValid != false){
				//upisivanje korisnika u bazu
				
				$query = "INSERT INTO korisnik (username, password, eMail, ime, prezime) VALUES 
							('" . $username . "','" . md5($password) . "','" .  $email . "','" . $ime . "','" . $prezime . "')";
				$result = mysql_query($query);
				if($result){
					//uspjesan upis
					mysql_close();
					header("Location: index.php?a=register&error=false");
				}
				else{
					//neuspjesan upis
					mysql_close();
					header("Location: index.php?a=register&error=baza");
				}
			}
			else{
				//mail nije valjan
				mysql_close();
				header("Location: index.php?a=register&error=mail");
			}
		}
		//ako pass nije dobro potvrđen
		else{
			//povratak na login formu
			mysql_close();
			header("Location: index.php?a=register&error=password");
		}
	
	}
		
	
?>