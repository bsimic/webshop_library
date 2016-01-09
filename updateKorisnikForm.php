<?php
	session_start();

?>

<link rel="stylesheet" type="text/css" href="style.css">
<?php
	error_reporting(E_ALL ^ E_NOTICE);
	$idKorisnik = $_GET['idKorisnik'];
	$action = $_GET['action'];
	@mysql_connect("localhost", "root", "vertrigo");
	@mysql_select_db("webshop");
	
	$query = "SELECT * FROM korisnik WHERE idKorisnik='" .$idKorisnik . "'";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	
	if(isset($action)){
		print("Zapis uspijesno azuriran");
	}
	else{
	
	if($row){
?>

		<form name="updateKorisnik" action="updateKorisnik.php" method="POST" enctype="multipart/form-data" accept-charset="utf-8">
		<table border="0" id="tabela1">
		<input type="hidden" name="idKorisnik" value='<?php print($row['idKorisnik']); ?>'>
		<tr><td> 
			Username:
			</td><td>
			<input type="text" name="username" value='<?php print($row['username']); ?>' required>
			</td>
		</tr>
		<tr><td>
			E-mail:
			</td><td>
			<input type="text" name="eMail" value='<?php print($row['eMail']); ?>' required>
			</td>
		</tr>
		<tr><td>
		<tr><td>
			Ime:
			</td><td>
			<input type="text" name="ime" value='<?php print($row['ime']); ?>' required>
			</td>
		</tr>
		<tr><td>
			Prezime:
			</td><td>
			<input type="text" name="prezime" value='<?php print($row['prezime']); ?>' required>
			</td>
		</tr>
		<tr><td>
			Adresa:
			</td><td>
			<input type="text" name="adresa" value='<?php print($row['adresa']); ?>'>
			</td>
		</tr>
		<tr><td>
			Broj Telefona:
			</td><td>
			<input type="text" name="brojTel" value='<?php print($row['brojTel']); ?>'>
			</td>
		</tr>
		<tr><td>
			About:
			</td><td>
			<input type="text" name="about" value='<?php print($row['about']); ?>'>
			</td>
		</tr>
		
		<tr><td>
			Slika:
			</td><td>
			<?php print("<img src=\"dohvatiSlikuKorisnik.php?id=" . $idKorisnik . "\" height='100' width='75'>"); ?>
			</td>
		</tr>
		<tr><td>
			Slika(nova):
			</td><td>
			<input type="file" name="slika">
			</td>
		</tr>

		<tr><td> <input type="submit" class="button" name="submit" value="Potvrdi"> </td> </tr>
		<tr><td colspan="2"> <?php 	if(isset($error) && $error=="naziv") print("<font color='red'>Knjiga s tim imenom vec postoji. Upisite ponovno</font>");
									else if (isset($error) && $error=="baza") print("<font color='red'>Error while writing to database. Please try again</font>");
									else if(isset($error) && $error=="false") print("Unos knjige uspjesan"); ?> </td></tr>
</table>
</form>

<?php }
}
?>
