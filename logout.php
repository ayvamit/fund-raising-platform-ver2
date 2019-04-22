<?php
/*
Author: Javed Ur Rehman
Website: http://www.allphptricks.com/
*/

session_start();
if(session_destroy()) // Destroying All Sessions
{
	$_SESSION['logged_in'] = false;
header("Location: index.php"); // Redirecting To Home Page
}
?>