<?php
	session_start();
	
	$start_time=isset($_SESSION['start_time']) ? ($_SESSION['start_time']) : 600000000000000000;
	$now_time=time();
	
	if(abs($now_time-$start_time)>(15*60))
	{
		$_SESSION['message']="Time out! Please login again to continue!";
		$_SESSION['messagetype']="error";
		header("location: index.php");
		exit();
	}
	
	$_SESSION['start_time']=time();
?>