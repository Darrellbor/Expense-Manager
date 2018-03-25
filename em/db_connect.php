<?php

$username="root";
$password="";
$db_name="EM";
$db_host="localhost";

$connection=mysql_connect("$db_host","$username","$password");
if($connection==FALSE)
{
	die("Error making connection to the server!".mysql_error());
}

$select_db=mysql_select_db("$db_name");
if($select_db==FALSE)
{
	die("Error selecting database!".mysql_error());
}
?>
