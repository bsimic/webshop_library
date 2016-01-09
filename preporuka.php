<?php
	session_start();
	
	@mysql_connect("localhost", "root", "vertrigo");
	@mysql_select_db("webshop");
	
	$preporuka = "SELECT DISTINCT knjiga.idKnjiga, naziv, autorIme, zanr, cijena FROM knjiga JOIN ocjena WHERE zanr IN (SELECT zanr FROM knjiga WHERE idKnjiga IN ( SELECT  idKnjiga FROM kupio WHERE idKorisnik = '" .$idKorisnik . "'))  ORDER BY ocjena DESC LIMIT 3";
	$preporuka_result = mysql_query($preporuka);
	if ($preporuka_result != NULL){
		print("<table id='contentTable' border='5' style=\"border-color : brown; font-family: Pristina; font-size:20px;\"");
		for($i=0; $i<3; $i++){
			$row = mysql_fetch_array($preporuka_result, MYSQL_ASSOC);
			if($row){
				$idKnjiga = $row['idKnjiga'];
				
				$ocjenaQuery = "SELECT ROUND( avg(ocjena), 2) FROM korisnik JOIN ocjena JOIN knjiga WHERE ocjena.idKnjiga='" . $idKnjiga ."'";
				$ocjenaResult = mysql_query($ocjenaQuery);
				$ocjenaRow = mysql_fetch_array($ocjenaResult, MYSQL_NUM);
				
				print("<tr>");
				print("<td id='tdSlika' rowspan='5' width='300' align='center'>");
				print("<a href='knjiga.php?idKnjiga=" . $idKnjiga . "'><img src=\"dohvatiSliku.php?id=" . $idKnjiga . "\" height='300' width='200'></a></td>");
				print("</td>");
				print("<td width ='600'><b>" . $row["naziv"] . "<b/></td></tr>");
				print("<tr><td width ='600'> <i>" . $row["autorIme"] . "<i/></td></tr>");
				print("<tr><td width ='600'>" . $row["zanr"] . "</td></tr>");
				print("<tr><td width ='600'><u>" . $row["cijena"] . "<u/></td></tr>");
				print("<tr><td width ='600'>Average score: ". $ocjenaRow[0] ."</td></tr>");
				print("<tr><td height='20' colspan='2'></td></tr>");		
			}
		}
	}
	

	
?>