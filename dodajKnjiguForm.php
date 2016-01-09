<?php
	session_start();
?>

<link rel="stylesheet" type="text/css" href="style.css">
<?php
	error_reporting(E_ALL ^ E_NOTICE);
	$error = $_GET['error'];
?>

<form name="dodajKnjigu" action="dodajKnjigu.php" method="POST" enctype="multipart/form-data" accept-charset="utf-8">
<table border="0" id="tabela1">
<tr><td> 
	Naziv knjige:
	</td><td>
	<input type="text" name="naziv" placeholder="Naziv" required>
	</td>
</tr>
<tr><td>
	Ime autora:
	</td><td>
	<input type="text" name="autorIme" placeholder="Ime autora" required>
	</td>
</tr>
<tr><td>
	Zanr:
	</td><td>
	<input type="text" name="zanr" placeholder="Zanr" required>
	</td>
</tr>
<tr><td>
<tr><td>
	Broj Primjeraka:
	</td><td>
	<input type="number" name="brojPrimjeraka" placeholder="Broj Primjeraka" required>
	</td>
</tr>
<tr><td>
	Cijena:
	</td><td>
	<input type="text" name="cijena" placeholder="Cijena" required>
	</td>
</tr>

<tr><td>
	Slika:
	</td><td>
	<input type="file" name="slika" required>
	</td>
</tr>

<tr><td> <input type="submit" class="button" name="submit" value="Potvrdi"> </td> </tr>
<tr><td colspan="2"> <?php 	if(isset($error) && $error=="naziv") print("<font color='red'>Knjiga s tim imenom vec postoji. Upisite ponovno</font>");
							else if (isset($error) && $error=="baza") print("<font color='red'>Error while writing to database. Please try again</font>");
							else if(isset($error) && $error=="false") print("Unos knjige uspjesan"); ?> </td></tr>
</table>
</form>
