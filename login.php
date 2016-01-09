<?php
	session_start(); // Starting Session
	$error=''; // Variable To Store Error Message
	
		if (empty($_POST['username']) || empty($_POST['password'])) {
			$error = "Username or Password is invalid";
		}
		else
		{
		// Define $username and $password
		$username=$_POST['username'];
		$password=$_POST['password'];
		
		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		@mysql_connect("localhost", "root", "vertrigo");
		
		// To protect MySQL injection for Security purpose
		$username = stripslashes($username);
		$password = stripslashes($password);
		$username = mysql_real_escape_string($username);
		$password = mysql_real_escape_string($password);
		
		// Selecting Database
		@mysql_select_db("webshop");
		

		
		// SQL query to fetch information of registerd users and finds user match.
		$query = "SELECT * FROM korisnik WHERE username='" . $username . "' AND password='" . md5($password) . "'";
		$result = mysql_query($query);
		$row = mysql_num_rows($result);
		if ($row == 1) {
			$_SESSION['login_user']=$username; // Initializing Session
			header("location: index.php"); // Redirecting To Other Page
		} else {
			header("location: index.php?error=login");
		}
			mysql_close(); // Closing Connection
		}
	
?>