<?php
	session_start();// Starting Session
?>


<link rel="stylesheet" type="text/css" href="style.css">

<?php 
	
	// Establishing Connection with Server by passing server_name, user_id and password as a parameter
	@mysql_connect("localhost", "root", "vertrigo");
	// Selecting Database
	@mysql_select_db("webstore", $connection);
	
	// Storing Session
	if(isset($_SESSION['login_admin'])){
		$admin_check=$_SESSION['login_admin'];
	}
	
?>


<html>

<head>
<meta http-equiv="Content-Language"
		content="hr">
	<meta http-equiv="content-type"
	content="text/html; charset=windows-1250">
	<meta http-equiv="content-type"
	content="text/html; charset=iso-8859-2">

	<title>Bookstore</title>

	
<script type="text/javascript">
	function popitup(url) {
	newwindow=window.open(url,'name','height=500,width=500');
	if (window.focus) {newwindow.focus()}
	return false;
	}	
	
	function popitupConfirm(url) {
	newwindow=window.open(url,'name','height=200,width=500');
	if (window.focus) {newwindow.focus()}
	return false;
	}	

</script>
	
<?php
	error_reporting(E_ALL ^ E_NOTICE);
	$error = $_GET['error'];
?>

</head>
<body>
<center>

	<?php 
		if(!isset($_SESSION['login_admin'])){
	?>
	<div id="top">
			<section class="loginform cf">
			<form name="loginAdmin" action="loginAdmin.php" method="post" accept-charset="utf-8">
				<ul>
					<li>
					<input type="username" name="username" placeholder="Username:" required>
					</li>
					<li>
					<input type="password" name="password" placeholder="Password:" required>
					</li>
					<li>
					<input type="submit" class="button" value="Log in!">
					</li>

				</ul>
			</form>
			</section>
		</div>
			<br><br><br><br><br><br><br><br><br>
		<p> This is the admin panel. If you're not an admin please click the button below to return to the main page.<br>
		<input type="button" class="Abutton" onClick=location.href='index.php' value="Povratak">
	</p>
	<?php	
			if(isset($error) && $error=="login") { 
					print("<font color='red'>Error: Invalid login. Try again</font>"); 
				}
			if(isset($error) && $error=="nevazece") { 
					print("<font color='red'>Error: Please log-in.</font>"); 
				}
		}
		else
		{	
			print ("<div id='top'>");
			print ("<p style='font-size: 25px; font-family: Verdana; color:#F6F6CC;'>Welcome ") .$admin_check;
			print("<input type='button' style='float: right;' class='Abutton' onClick=location.href='logout.php' value='Log Out'>");
			print ("</p></div>");
			
	if(isset($_SESSION['login_admin'])){
		?>
		<div id="adminmenu">
		<ul>
			<li>
			<form id="knjige" action="adminPanel.php">
				<input type= "button" class="button" onClick="location.href='adminPanel.php'" value="Pregled knjiga">
			</form>
			</li>
			<li>
			<form id="dodajKnjigu" action="dodajKnjigu.php">
				<input type= "button" class="button" onClick=javascript:popitup("dodajKnjiguForm.php") value="Dodaj Knjigu">
			</form>
			</li>
			<li>
			<form id="korisnici" action="adminPopisKorisnika.php">
				<input type= "button" class="button" onClick="location.href='adminPopisKorisnika.php'" value="Pregled korisnika">
			</form>
		</ul>
		</div>
		<?php
			}
		?>
		<td id="body" width="700">
			<br/><br/><br/><br/>
			<?php ; 
				

			?>


<div id="content">
	
<?php


	@mysql_connect("localhost", "root", "vertrigo");
	@mysql_select_db("webshop");

	$query = "SELECT COUNT(*) FROM korisnik";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result, MYSQL_NUM);
	$ukupanBrojKnjiga = $row[0];
	mysql_free_result($result);

	$query = "SELECT * FROM korisnik";
	$result = mysql_query($query);
	
	$brojStranice = $_GET['stranica'];
	if(!isset($brojStranice))	$brojStranice = 1;
	
	//preskakanje knjiga koje netreba prikazati
	for ($i=0; $i< ($brojStranice-1)*10; $i++)
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
	
	
	print("<table id='bookList' border='5' style=\"border-color : brown; font-family: Times New Roman; font-size:15px;\"");
	print("<tr><td width ='200'><b>Username: <b/></td>
			<td width ='200'><b>E-mail: <b/></td>
			<td width ='100'><b>Ime: <b/></td>
			<td width ='100'><b>Prezime: <b/></td>
			<td width ='100'><b>Adresa: <b/></td>
			<td width ='100'><b>Broj Tel: <b/></td></tr>");
	for($i=($brojStranice-1)*10; $i<$brojStranice*10; $i++){
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		if($row){
			$idKorisnik = $row['idKorisnik'];
				
			print("<tr>");
			print("<td width ='200'><b>" . $row["username"] . "<b/></td>");
			print("<td width ='200'> <i>" . $row["eMail"] . "<i/></td>");
			print("<td width ='100'>" . $row["ime"] . "</td>");
			print("<td width ='100'>" . $row["prezime"] . "</td>");
			print("<td width ='100'>" . $row["adresa"] . "</td>");
			print("<td width ='100'>" . $row["brojTel"] . "</td>");
			print("<td><input type='button' class='Abutton' onClick=\"javascript:popitup('updateKorisnikForm.php?idKorisnik=" . $idKorisnik . "')\" value='Uredi'></td>");	
			print("<td><input type='button' class='Abutton' onClick=\"javascript:popitupConfirm('confirmDeleteKorisnik.php?idKorisnik=" . $idKorisnik . "&username=" . $row['username'] . "')\" value='Obrisi'></td></tr>");	
			
		}
	}
	
	// Prikaz stranicnih linkova:
	print("<tr><td colspan='8' align='center'><i> Page: </i>&nbsp; &nbsp;");
	for($i=1; $i<= ceil($ukupanBrojKnjiga/10); $i++){
		if ($i != $brojStranice){
			print("<a href=\"adminPopisKorisnika.php?stranica=" . $i . "\">" .$i . "</a>&nbsp; &nbsp;");
		} else {
			print($i . "&nbsp; &nbsp;");
		}
	}
	
	print("</table>");
		}?>
</div>		
</center>
</body>

</html>


