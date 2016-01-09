<?php
session_start();
if(session_destroy()) // Destroying All Sessions
{
header("Location: index_forum.php"); // Redirecting To Home Page
}
?>