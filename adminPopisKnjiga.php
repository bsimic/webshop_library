<?php
	session_start();
?>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<script type="text/javascript">
	function popitupConfirm(url) {
	newwindow=window.open(url,'name','height=200,width=500');
	if (window.focus) {newwindow.focus()}
	return false;
	}	

</script>
</head>
<div id="content">
	
<?php
	error_reporting(E_ALL ^ E_NOTICE);

	$brojStranice = $_GET['stranica'];
	if(!isset($brojStranice))	$brojStranice = 1;
	
	/*
	$searchRadio = $_GET['searchRadio'];
	$search = $_GET['search'];
	*/
	
	@mysql_connect("localhost", "root", "vertrigo");
	@mysql_select_db("webshop");
	
	
	$query = "SELECT COUNT(*) FROM knjiga";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result, MYSQL_NUM);
	$ukupanBrojKnjiga = $row[0];
	mysql_free_result($result);
	
	/*
	if(isset($searchRadio) && isset($search)){
	
		if($searchRadio == "title"){
			$query = "SELECT * FROM knjiga WHERE naziv LIKE '%" . $search . "%'";
			$result = mysql_query($query);
		}
		
		else if($searchRadio == "author"){
			$query = "SELECT * FROM knjiga WHERE autorIme LIKE '%" . $search . "%'";
			$result = mysql_query($query);
		}
		else if($searchRadio == "genre"){
			$query = "SELECT * FROM knjiga WHERE zanr LIKE '%" . $search . "%'";
			$result = mysql_query($query);
		}
		
	}
	*/

	$query = "SELECT * FROM knjiga";
	$result = mysql_query($query);
	
	
	//preskakanje knjiga koje netreba prikazati
	for ($i=0; $i< ($brojStranice-1)*10; $i++)
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
	
	
	print("<table id='bookList' border='5' style=\"border-color : brown; font-family: Times New Roman; font-size:15px;\"");
	print("<tr><td width ='300'><b>Naslov: <b/></td>
			<td width ='300'><b>Autor: <b/></td>
			<td width ='300'><b>Zanr: <b/></td>
			<td width ='100'><b>Broj primjeraka: <b/></td></tr>");
	for($i=($brojStranice-1)*10; $i<$brojStranice*10; $i++){
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		if($row){
			$idKnjiga = $row['idKnjiga'];
				
			print("<tr>");
			print("<td width ='300'><b>" . $row["naziv"] . "<b/></td>");
			print("<td width ='300'> <i>" . $row["autorIme"] . "<i/></td>");
			print("<td width ='300'>" . $row["zanr"] . "</td>");
			print("<td width ='100'>" . $row["brojPrimjeraka"] . "</td>");
			print("<td><input type='button' class='Abutton' onClick=\"javascript:popitup('updateKnjigaForm.php?idKnjiga=" . $idKnjiga . "')\" value='Uredi' ></td>");	
			print("<td><input type='button' class='Abutton' onClick=\"javascript:popitupConfirm('confirmDelete.php?idKnjiga=" . $idKnjiga . "&naziv=" . $row['naziv'] . "')\" value='Obrisi'></td></tr>");	
			
			
		}
	}
	
	// Prikaz stranicnih linkova:
	print("<tr><td colspan='7' align='center'><i> Page: </i>&nbsp; &nbsp;");
	for($i=1; $i<= ceil($ukupanBrojKnjiga/10); $i++){
		if ($i != $brojStranice){
			print("<a href=\"adminPanel.php?stranica=" . $i . "\">" .$i . "</a>&nbsp; &nbsp;");
		} else {
			print($i . "&nbsp; &nbsp;");
		}
	}
	
	print("</table>");
	
?>



</div>