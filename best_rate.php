
<?php
	//spajanje na bazu
	@mysql_connect("localhost", "root", "vertrigo");
	@mysql_select_db("webshop");
	
	$query = "SELECT k.idKnjiga, k.naziv, AVG(o.ocjena) AS srednja_ocjena
			FROM knjiga k
			INNER JOIN ocjena o
  			ON k.idKnjiga = o.idKnjiga
			GROUP BY o.idKnjiga
			ORDER BY srednja_ocjena DESC
			LIMIT 5";
	$result = mysql_query($query);

	print("<table id='bestRated' border='1'  style=\"border-color : brown; font-family: Pristina; font-size:20px;\">");
	print("<tr><th> Knjiga </th><th> Ocjena </th></tr>");

	while($row = mysql_fetch_array($result, MYSQL_BOTH)){
			
		print("<tr><td>" . $row["naziv"] . "</td><td>"  . $row["srednja_ocjena"]."</td></tr>");

	}
	print("</table>");
	mysql_close();
?>

