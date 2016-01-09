<link rel="stylesheet" type="text/css" href="style.css">
<div id="content">

<?php

function debug_to_console( $data ) {

    if ( is_array( $data ) )
        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
    else
        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

    echo $output;
}
	error_reporting(E_ALL ^ E_NOTICE);
	

	
	$action = $_GET['action'];
	$idKnjiga = $_GET['idKnjiga'];
	$username = $_SESSION['login_user'];
	$error = $_GET['error'];
	
	@mysql_connect("localhost", "root", "vertrigo");
	@mysql_select_db("webshop");
	
	//uzimanje id korisnika iz baze
	$query = "SELECT idKorisnik FROM korisnik WHERE username='" . $username . "'";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result, MYSQL_NUM);
	$idKorisnik = $row[0];
	
	//provjera da li je korisnik vec ocjenio knjigu
	$query = "SELECT ocjena FROM ocjena WHERE idKorisnik='" . $idKorisnik . "' AND idKnjiga='" . $idKnjiga . "'";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result, MYSQL_NUM);
	if($row[0] != NULL) $ocjenjeno = true;
	$ocjenaKorisnika = $row[0];
	
	//provjera da li je korisnik vec komentirao knjigu
	$query = "SELECT komentar FROM ocjena WHERE idKorisnik='" . $idKorisnik . "' AND idKnjiga='" . $idKnjiga . "'";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result, MYSQL_NUM);
	if($row[0] != NULL) $komentirano = true;
	$komentarKorisnika = $row[0];
	
	//korisnikova ocjena ako je ocjenio
	//$query = "SELECT ocjena FROM ocjena WHERE idKorisnik='" . $idKorisnik . "' AND idKnjiga='" . $idKnjiga . "'";
	//$result = mysql_query($query);
	
	
	$query = "SELECT * FROM knjiga WHERE idKnjiga = '" . $idKnjiga . "'";
	$result = mysql_query($query);
	
	
	print("<table id='bookTable' border='5' style=\"border-color : brown; font-family: Pristina; font-size:20px;\"");
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		if($row){
			$naziv = $row["naziv"];
			$brojPrimjeraka = $row['brojPrimjeraka'];
			$ocjenaQuery = "SELECT ROUND (avg(ocjena), 2) FROM korisnik JOIN ocjena JOIN knjiga WHERE ocjena.idKnjiga='" . $idKnjiga ."'";
			$ocjenaResult = mysql_query($ocjenaQuery);
			$ocjenaRow = mysql_fetch_array($ocjenaResult, MYSQL_NUM);
		
			print("<tr>");
			print("<td id='tdSlika' rowspan='5' width='300' align='center'>");
			print("<img src=\"dohvatiSliku.php?id=" . $row["idKnjiga"] . "\" height='300' width='200'></td>");
			//print("</td>");
			print("<td width ='600'><b>Title: " . $row["naziv"] . "<b/></td></tr>");
			print("<tr><td width ='600'> <i>Author: " . $row["autorIme"] . "<i/></td></tr>");
			print("<tr><td width ='600'> Genre: " . $row["zanr"] . "</td></tr>");
			print("<tr><td width ='600'><u>Price: " . $row["cijena"] . "<u/></td></tr>");
			print("<tr><td width ='600'>Average score: ". $ocjenaRow[0] ."</td></tr>");
			if(isset($_SESSION['login_user'])){
				print("<tr><td width ='600' height='20' colspan='2'> ");
				if($ocjenjeno == true)	print ("<center>Your Grade: " . $ocjenaKorisnika . "</center>");
				else{
					print("<div id='ocjenaRadio' >
					<form name='ocjena' method='GET' action=ocijeni.php>
						<ul align = 'center'>Rate book:<br>
						<li style='display:inline' ><input type='radio' name='ocjenaRadio' value='1'><span><b> 1</b> </span></li>
						<li style='display:inline' ><input type='radio' name='ocjenaRadio' value='2'><span><b> 2</b> </span></li>
						<li style='display:inline' ><input type='radio' name='ocjenaRadio' value='3'><span><b> 3</b> </span></li>
						<li style='display:inline' ><input type='radio' name='ocjenaRadio' value='4'><span><b> 4</b> </span></li>
						<li style='display:inline' ><input type='radio' name='ocjenaRadio' value='5'><span><b> 5</b> </span></li>
						<input type='hidden' name='idKnjiga' value='" . $idKnjiga . "'/>
						&nbsp&nbsp&nbsp<input type='submit' value='Rate' class='button'>
						<li>");
						if(isset($error) && $error=="true") print("<font color='red'>Error! Please try again!</font>");
						print("</li>
						</ul>
					</form>
					</div>");	
					}
				print("</td></tr>");
				
				print("<tr><td width ='600' colspan='2' align='right'>");
				if($komentirano == true)	print ("<center>Your comment: " . $komentarKorisnika . "</center>");
				else{
						print("<div id='komentarText'>
						 <form name='komentar' method='GET' action='komentar.php'>
							<textarea name='komentar' rows='3' cols='90'></textarea>
							<input type='hidden' name='idKnjiga' value='" . $idKnjiga . "'/>
							<input type='submit' value='Comment' class='button'>
						</form>");
						if(isset($error) && $error=="true") print("<font color='red'>Error! Please try again!</font>");
						print("</div></td></tr>");
				}
			print("<tr><td height='20' colspan='2' align='right'>
					<form name='kosarica' action='dodajUKosaricu.php' method='GET'>
						<input type='hidden' name='idKnjiga' value='" . $idKnjiga . "' />
						<input type='hidden' name='naziv' value='" . $naziv . "' />
						Quantity: <input type='number' name='kolicina' size='1' min='0' max='" . $brojPrimjeraka . "'>
						<input type='submit' value='Add to cart' class='button'>
						
						
						
					</form>
					</td></tr>");
					
			
			
			
			if($action=='added'){
				print( "<tr><td height='20' colspan='2' align='center'>" . $naziv . " was added to your cart! </td></tr>");
				}
			if($action=='exists'){
				print( "<tr><td height='20' colspan='2' align='center'>" . $naziv . " already exists in your cart! </td></tr>");
				}
			if($action=='kolicina'){
				print( "<tr><td height='20' colspan='2' align='center'><font color='red'>Enter quantity! </font></td></tr>");
				}
			}
		}
		
		print("<tr><td colspan='2'></td></tr>");
		print("<tr><td colspan='2' align='center'>Komentari korisnika: </td></tr>");
		//ispis komentara
			$query = "SELECT COUNT(*) FROM ocjena WHERE idKnjiga =" . $idKnjiga . " AND ocjena IN ( SELECT ocjena FROM ocjena ORDER BY ocjena DESC ) AND komentar IS NOT NULL  LIMIT 5";
			$result = mysql_query($query);
			$row = mysql_fetch_array($result, MYSQL_NUM);
			$brojKomentara = $row[0];
			
			$query = "SELECT komentar FROM ocjena WHERE idKnjiga =" . $idKnjiga . " AND ocjena IN ( SELECT ocjena FROM ocjena ORDER BY ocjena DESC ) AND komentar IS NOT NULL ORDER BY ocjena DESC LIMIT 5";
			$result = mysql_query($query);
			
			for($i=0; $i<$brojKomentara; $i++){
				$row = mysql_fetch_array($result, MYSQL_ASSOC);
				$queryKorisnik = "SELECT username FROM korisnik JOIN ocjena WHERE korisnik.idKorisnik=ocjena.idKorisnik AND komentar='" . $row['komentar'] . "'";
				$resultKorisnik = mysql_query($queryKorisnik);
				$rowKorisnik = mysql_fetch_array($resultKorisnik, MYSQL_ASSOC);
				print("<tr><td width='300' align='center' style='color:#F6F6CC'>" . $rowKorisnik['username'] . "</td>");
				print("<td width='600'>" . $row['komentar'] . "</td></tr>");
			}

	
	print("</table>");
	
?>



</div>