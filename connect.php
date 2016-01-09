<?php
//connect.php
$server = 'localhost';
$username   = 'root';
$password   = 'vertrigo';
$database   = 'webshop';
$con=mysql_connect ($server,$username,$password);
if(!$con)
{
    exit('Error: could not establish database connection');
}
if(!mysql_select_db($database))
{
    exit('Error: could not select the database');
}
?>