<?php
include 'connect.php';
session_start();
unset ($_SESSION['signed_in']);
session_destroy();
header("location: index_forum.php");
mysql_close($con);
exit ();
?>