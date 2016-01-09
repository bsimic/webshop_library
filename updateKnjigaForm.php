<?php
	session_start();

?>

<link rel="stylesheet" type="text/css" href="style.css">
<?php
	error_reporting(E_ALL ^ E_NOTICE);
	$idKnjiga = $_GET['idKnjiga'];
	$action = $_GET['action'];
	@mysql_connect("localhost", "root", "vertrigo");
	@mysql_select_db("webshop");
	
	$query = "SELECT * FROM knjiga WHERE idKnjiga='" .$idKnjiga . "'";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	
	if(isset($action)){
		print("Zapis uspijesno azuriran");
	}
	else{
	
	if($row){
?>

		<form name="updateKnjiga" action="updateKnjiga.php" method="POST" enctype="multipart/form-data" accept-charset="utf-8">
		<table border="0" id="tabela1">
		<input type="hidden" name="idKnjiga" value='<?php print($row['idKnjiga']); ?>'>
		<tr><td> 
			Naziv knjige:
			</td><td>
			<input type="text" name="naziv" value='<?php print($row['naziv']); ?>' required>
			</td>
		</tr>
		<tr><td>
			Ime autora:
			</td><td>
			<input type="text" name="autorIme" value='<?php print($row['autorIme']); ?>' required>
			</td>
		</tr>
		<tr><td>
			Zanr:
			</td><td>
			<input type="text" name="zanr" value='<?php print($row['zanr']); ?>' required>
			</td>
		</tr>
		<tr><td>
		<tr><td>
			Broj Primjeraka:
			</td><td>
			<input type="number" name="brojPrimjeraka" value='<?php print($row['brojPrimjeraka']); ?>' required>
			</td>
		</tr>
		<tr><td>
			Cijena:
			</td><td>
			<input type="text" name="cijena" value='<?php print($row['cijena']); ?>' required>
			</td>
		</tr>
		<tr><td>
			Slika:
			</td><td>
			<?php print("<img src=\"dohvatiSliku.php?id=" . $idKnjiga . "\" height='100' width='75'>"); ?>
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
