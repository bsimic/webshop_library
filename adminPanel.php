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
	<title>Bookstore</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	
<script type="text/javascript">
	function popitup(url) {
	newwindow=window.open(url,'name','height=500,width=500');
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
		<input type="button" class="Abutton" onClick=location.href='index.php' value="Return">
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
			</li>
		</ul>
		</div>
		<td id="body" width="700">
			<br/><br/><br/><br/>
		<?php
			include("adminPopisKnjiga.php");
		}	
		?>
		
		
</center>
</body>

</html>