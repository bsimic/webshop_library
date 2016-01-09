<?php
	session_start();
	error_reporting(E_ALL ^ E_NOTICE);
?>
<link rel="stylesheet" type="text/css" href="style.css">
<?php

	if(count($_SESSION['cart_items'])>0){
		
		// get the product ids
		foreach($_SESSION['cart_items'] as $id=>$value){
			$ids = $ids . $id . ",";
		}
		$ids = rtrim($ids, ',');
		$id = explode("," ,$ids);
		
		//$kolicina = array();
		$kolicina = implode("", $_SESSION['cart_items']);
		
		
		//spajanje na bazu
		@mysql_connect("localhost", "root", "vertrigo");
		@mysql_select_db("webshop");
		
		
		$ukupnaCijena = 0;
		print("<center>");
		print("<div id='cart' width='auto' height='auto'>");
		print("<br><br><br><br><br><br>");
		print("<table border='0' style=\"border-color : brown; font-family: Pristina; font-size:20px;\">
				<tr><td align='center' width='250'><b>Items in your list: </b></td><td align='center'  width='250'><b>Price: </b></td><td align='center'  width='50'><b>Quantity; </b></td></tr>");
		
		for($i=0; $i<count($_SESSION['cart_items']); $i++){
			$query = "SELECT idKnjiga, naziv, cijena FROM knjiga WHERE idKnjiga='" . $id[$i] ."'";
			$result = mysql_query($query);
			$row = mysql_fetch_array($result, MYSQL_ASSOC);
			if($row){
				print( "<tr><td align='center'>" . $row["naziv"] . "</td>
							<td align='center'>" . $row["cijena"] . " </td>
							<td align='center'>" . $kolicina[$i] . " </td>
						<td align='right'><input type='button' class='button' value='Remove' onClick=\"location.href='izbrisiIzKosarice.php?idKnjiga=" . $row['idKnjiga'] ."'\"></td></tr>");
				$ukupnaCijena+=($row['cijena'] * $kolicina[$i]);
			}
		}

		print("<tr><td align='center' ><b>Total price: </b></td><td align='center'>" . $ukupnaCijena . ",00 kn</td></tr>
				<tr><td colspan='4' align='right' ><input type='button' class='button' value='Checkout' onClick=\"location='checkout.php?ids=" . $ids . "&kolicina=" . $kolicina ."'\"></td></tr>
				<tr><td colspan='4' align='right' ><input type='button' class='button' value='Continue shoping' onClick=\"location='index.php'\"></td></tr>");
		
		
		print("</table>");
		print("</div>");
		print("</center>");
	
	}
	else{
		print("No products found in your cart!
				<tr><td><input type='button' class='button' value='Continue shoping' onClick=\"location='index.php'\">");
		
	}
?>