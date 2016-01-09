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
<html>

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
						<div id="Tcontainer">
							<?php include("best_rate.php"); ?>
						<a href="javascript:void(0)" onClick="toggle_visibility('topRated');">
							<input type= "button" class="button"  value="Back">
						</a>
						</div>
					</div>
				</div>
				<!--popups-->
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
	
<tr>

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
					<form id="searchbox" action="index.php" method="GET">
						<ul>
						<li><input type="radio" name="searchRadio" value="title"><span><b> Title</b> </span></li>
						<li><input type="radio" name="searchRadio" value="author" ><span><b> Author</b> </span></li>
						<li><input type="radio" name="searchRadio" value="genre" ><span><b> Genre <b/></span></li>
						</ul>
				<li>
					
					  <input id="search" type="text" placeholder="Pretraga" name="search">
					  <input class="button" type="submit" value="Search">
				</form>
				</li>
				
				</ul>
			<div>
	</td></tr>

<tr>
	<!-- content part -->
	<td id="body" width="700">
		<br/><br/><br/><br/>
		<?php include("knjiga_profil.php"); ?>
	</td>
</tr> 

	
</table>
</center>
</body>
</html>