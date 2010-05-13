<?php
$user="root";
$password="jack";
$database="sdstudio_system";
mysql_connect("localhost",$user,$password);
mysql_select_db($database) or die( "Unable to select database");
?>
