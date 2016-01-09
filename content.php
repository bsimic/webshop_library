<link rel="stylesheet" type="text/css" href="style.css">
<div id="content">

<?php
	error_reporting(E_ALL ^ E_NOTICE);
	
	$brojStranice = $_GET['stranica'];
	if(!isset($brojStranice))	$brojStranice = 1;
	
	$searchRadio = $_GET['searchRadio'];
	$search = $_GET['search'];

	@mysql_connect("localhost", "root", "vertrigo");
	@mysql_select_db("webshop");
	
	
	
	
	
	if(isset($searchRadio) && isset($search)){
	
		if($searchRadio == "title"){
			$query = "SELECT COUNT(*) FROM knjiga WHERE naziv LIKE '%" . $search . "%'";
			$result = mysql_query($query);
			$row = mysql_fetch_array($result, MYSQL_NUM);
			$ukupanBrojKnjiga = $row[0];
			mysql_free_result($result);
		
			$query = "SELECT * FROM knjiga WHERE naziv LIKE '%" . $search . "%'";
			$result = mysql_query($query);
			
			
		}
		
		else if($searchRadio == "author"){
			$query = "SELECT COUNT(*) FROM knjiga WHERE autorIme LIKE '%" . $search . "%'";
			$result = mysql_query($query);
			$row = mysql_fetch_array($result, MYSQL_NUM);
			$ukupanBrojKnjiga = $row[0];
			mysql_free_result($result);
		
			$query = "SELECT * FROM knjiga WHERE autorIme LIKE '%" . $search . "%'";
			$result = mysql_query($query);
			
			
		}
		else if($searchRadio == "genre"){
			$query = "SELECT COUNT(*) FROM knjiga WHERE zanr LIKE '%" . $search . "%'";
			$result = mysql_query($query);
			$row = mysql_fetch_array($result, MYSQL_NUM);
			$ukupanBrojKnjiga = $row[0];
			mysql_free_result($result);		
		
			$query = "SELECT * FROM knjiga WHERE zanr LIKE '%" . $search . "%'";
			$result = mysql_query($query);
			
		}
		
	}
	else{
		$query = "SELECT COUNT(*) FROM knjiga";
		$result = mysql_query($query);
		$row = mysql_fetch_array($result, MYSQL_NUM);
		$ukupanBrojKnjiga = $row[0];
		mysql_free_result($result);
		
		$query = "SELECT * FROM knjiga";
		$result = mysql_query($query);
		
	}
	
	//preskakanje knjiga koje netreba prikazati
	for ($i=0; $i< ($brojStranice-1)*5; $i++)
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
	
	
	print("<table id='contentTable' border='5' style=\"border-color : brown; font-family: Pristina; font-size:20px;\"");
	for($i=($brojStranice-1)*5; $i<$brojStranice*5; $i++){
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		if($row){
			$idKnjiga = $row['idKnjiga'];
			
			$ocjenaQuery = "SELECT ROUND( avg(ocjena), 2) FROM korisnik JOIN ocjena JOIN knjiga WHERE ocjena.idKnjiga='" . $idKnjiga ."'";
			$ocjenaResult = mysql_query($ocjenaQuery);
			$ocjenaRow = mysql_fetch_array($ocjenaResult, MYSQL_NUM);
			
			print("<tr>");
			print("<td id='tdSlika' rowspan='5' width='300' align='center'>");
			print("<a href='knjiga.php?idKnjiga=" . $idKnjiga . "'><img src=\"dohvatiSliku.php?id=" . $row["idKnjiga"] . "\" height='300' width='200'></a></td>");
			print("</td>");
			print("<td width ='600'><b>" . $row["naziv"] . "<b/></td></tr>");
			print("<tr><td width ='600'> <i>" . $row["autorIme"] . "<i/></td></tr>");
			print("<tr><td width ='600'>" . $row["zanr"] . "</td></tr>");
			print("<tr><td width ='600'><u>" . $row["cijena"] . "<u/></td></tr>");
			print("<tr><td width ='600'>Average score: ". $ocjenaRow[0] ."</td></tr>");
			print("<tr><td height='20' colspan='2'></td></tr>");	
			
			
		}
	}
	
	// Prikaz stranicnih linkova:
	print("<tr><td colspan='2' align='center'><i> Page: </i>&nbsp; &nbsp;");
	for($i=1; $i<= ceil($ukupanBrojKnjiga/5); $i++){
		if ($i != $brojStranice){
			print("<a href=\"index.php?stranica=" . $i . "\">" .$i . "</a>&nbsp; &nbsp;");
		} else {
			print($i . "&nbsp; &nbsp;");
		}
	}
	
	print("</table>");
	
?>



</div>