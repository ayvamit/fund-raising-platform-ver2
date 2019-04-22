<?php
define('DBHOST','localhost');
define('DBNAME','charity');
define('DBUSER','root');
define('DBPASS','');
	
$con=mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);

$error= mysqli_connect_error();
if ($error !=null){
	$output="<p>Unable to connect to database<p>" .$error;
	exit($output);
}

?>
