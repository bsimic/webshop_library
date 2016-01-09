<link rel="stylesheet" type="text/css" href="style.css">

<?php
	error_reporting(E_ALL ^ E_NOTICE);
	$error = $_GET['error'];
?>

<form name="register" action="register.php" method="post" accept-charset="utf-8">
<table border="0" id="tabela">
<tr><td> 
	Username:
	</td><td>
	<input type="username" name="username" placeholder="Username:" required>
	</td>
</tr>
<tr><td>
	Password:
	</td><td>
	<input type="password" name="password" placeholder="Password:" required>
	</td>
</tr>
<tr><td>
<tr><td>
	Confirm password:
	</td><td>
	<input type="password" name="passwordConfirm" placeholder="Confirm password:" required>
	</td>
</tr>
<tr><td>
	E-mail:
	</td><td>
	<input type="text" name="email" placeholder="E-mail" required>
	</td>
</tr>
<tr><td>
	First name:
	</td><td>
	<input type="text" name="ime" placeholder="First name" required>
	</td>
</tr>
<tr><td>
	Last name:
	</td><td>
	<input type="text" name="prezime" placeholder="Last name" required>
	</td>
</tr>
<tr><td align="center" colspan="2"> <input type="submit" class="button" name="submit" value="Register!"> </td> </tr>
<tr><td colspan="2"> <?php 	if(isset($error) && $error=="user") print("<font color='red'>Username already exists. Please try again</font>");
							else if(isset($error) && $error=="password") print("<font color='red'>Error: Password and Confirm password fields are not the same. Please try again</font>"); 
							else if (isset($error) && $error=="mail") print("<font color='red'>Error: Mail not valid. Please try again</font>");
							else if (isset($error) && $error=="baza") print("<font color='red'>Error while writing to database. Please try again</font>");
							else if(isset($error) && $error=="false") print("Registration successful"); ?> </td></tr>
</table>
</form>