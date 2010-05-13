<?php 
	session_start(); 
	if(! isset($_SESSION["user"])){
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = 'login.php';
		header("Location: http://$host$uri/$extra");
		exit;
	}
?>
