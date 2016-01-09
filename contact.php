
<html>
<?php
	session_start();// Starting Session
	// Establishing Connection with Server by passing server_name, user_id and password as a parameter
	@mysql_connect("localhost", "root", "vertrigo");
	// Selecting Database
	@mysql_select_db("webshop", $connection);
	
	// Storing Session
	if(isset($_SESSION['login_user'])){
		$user_check=$_SESSION['login_user'];
	}
	
?>

<head>
	<title>Bookstore</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	
<script type="text/javascript">
<!--
    function toggle_visibility(id) {
       var e = document.getElementById(id);
       if(e.style.display == 'block')
          e.style.display = 'none';
       else
          e.style.display = 'block';
    }
//-->
</script>

<?php
	error_reporting(E_ALL ^ E_NOTICE);
	$error = $_GET['error'];
	$akcija = $_GET['a'];
?>

</head>

<body>
<center>
				<?php if($akcija=='register'){ ?>
					<div id="registerB" class="pposition" style="display:block;">
					<div id="pwrapper">
						<div id="pcontainer">
						<?php include("registerForm.php"); ?>
						<a href="javascript:void(0)" onClick="toggle_visibility('registerB');">
							<input type= "button"  class="button"  value="Back">
						</a>
						</div>
					</div>
				</div>
				<?php }
				else{
				?>
					<div id="registerB" class="pposition" style="display:none;">
						<div id="pwrapper">
							<div id="pcontainer">
					<?php include("registerForm.php"); ?>
							<a href="javascript:void(0)" onClick="toggle_visibility('registerB');">
								<input type= "button"  class="button"  value="Back">
							</a>
							</div>
						</div>
					</div>
				<?php }
				?>
				
				
				<?php if($akcija=='kosarica'){ ?>
					<div id="cartB" class="pposition" style="display:block;">
						<div id="pwrapper">
							<div id="pcontainer">
					<?php include("kosarica.php"); ?>
							<a href="javascript:void(0)" onClick="toggle_visibility('cartB');">
								<input type= "button" class="button"  value="Back">
							</a>
							</div>
						</div>
					</div>
				
				<?php }
				else{
				?>
					<div id="cartB" class="pposition" style="display:none;">
						<div id="pwrapper">
							<div id="pcontainer">
					<?php include("kosarica.php"); ?>
							<a href="javascript:void(0)" onClick="toggle_visibility('cartB');">
								<input type= "button" class="button"  value="Back">
							</a>
							</div>
						</div>
					</div>
				<?php }
				?>
				<div id="topRated" class="pposition" style="display:none;">
					<div id="pwrapper">
						<div id="pcontainer">
				<?php include("best_rate.php"); ?>
						<a href="javascript:void(0)" onClick="toggle_visibility('topRated');">
							<input type= "button" class="button"  value="Back">
						</a>
						</div>
					</div>
				</div>
	<?php 
		if(!isset($_SESSION['login_user'])){
	?>
			<div id="top">
				<ul>
				<li>
				<div id="loginForm">
		<?php include("loginForm.php"); 
				if(isset($error) && $error=="login") { 
					print("<font color='red'>Error: Invalid login. Try again</font>"); 
				}
				if(isset($error) && $error=="nevazece") { 
					print("<font color='red'>Error: Please log-in.</font>"); 
				}
		?>
				</div>
				</li>
				<li align="right">
				<input type= "button"  class="button" onClick="toggle_visibility('registerB');" value="Register!">
				</li>
				</ul>
			</div>
	<?php 
		}
		else
		{
	?>
	
	<div id="loggedin">
			<b id="welcome">Welcome : <i><?php print("<a style=' color:#F6F6CC;' href='profil.php'>" . $user_check . "</a>"); ?></i></b>
			<input type= "button"  class="button" onClick="toggle_visibility('cartB');" value="Cart!">
			<input type='button' class='button' onClick=location.href='logout.php' value='Log Out'>
			
	</div>
	<?php
		}
	?>

<table border="0" width="800" cellspacing="0" align="center" >
<!-- HEADER -->
<tr>
	<img src="header.jpg" width="800">
</tr>
	<!-- Menu -->
<tr>
<!--
	<div id="menu">
		<ul>
		<li><a class="button"href="index.php">Home</a></li>
		<li><a class="button" href="services.html">Bring in da noise</a></li>
		<li><a class="button" href="contactus.html">Forum</a></li>
		<li><a class="button" href="contact.html">Contact</a></li>
		<li><a class="button" href="contactus.html">Admin</a></li>
		</ul>
	</div>
</tr>

	<input type="radio" name="group1" value="Milk"> Milk<br>
<input type="radio" name="group1" value="Butter" checked> Butter<br>
<input type="radio" name="group1" value="Cheese"> Cheese

-->
	<!-- search forma -->
<tr><td">
			<div id='cssmenu'>
				<ul>
				<li><a href='index.php'><span>Home</span></a></li>
				<li><a href='index_forum.php'><span>Forum</span></a></li>
				<li><a  href="#" onClick="toggle_visibility('topRated');"><span>Top Rated</span></a></li>
				<li><a href='contact.php'><span>Contact</span></a></li>
				<li><a href='adminPanel.php'><span>Admin</span></a></li>
				</ul>
				<ul>
					<li class='active has-sub'><a href='#'><span>Search by:</span></a>
						<ul>
						<li><input type="radio" name="search1" value="title"><span> Title </span</li>
						<li><input type="radio" name="search1" value="author" ><span> Author </span></li>
						<li><input type="radio" name="search1" value="Genre" ><span> Genre</span></li>
						</ul>
				<li>
					<form id="searchbox" action="">
					  <input id="search" type="text" placeholder="Pretraga">
					  <input class="button" type="submit" value="Search">
					  </form>
				</li>
				</ul>
			<div>
	</td></tr>

<tr>
	<!-- content part -->

	<td id="body" width="700" height="400">
	<table>
			<tr><td style='color:#F6F6CC' colspan="2"><p> If there has been an inconvenience or you are just more curious about our book store , please contact us at: </p></td></tr>
			<tr><td style='color:#F6F6CC'>Contact e-mail:</td><td style='color:#F6F6CC'>BestbookstoreEver@gmail.com</td></tr>
			<tr><td style='color:#F6F6CC'>Support e-mail</td><td style='color:#F6F6CC'>BestbookstoreEverSupport@gmail.com</td></tr>
	</table>
	</td>
	
</tr> 

	
</table>
</center>
</body>
</html>