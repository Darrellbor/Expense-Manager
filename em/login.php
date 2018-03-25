<?php
	session_start();
	require_once("db_connect.php");

	$username=isset($_POST['user_name']) ? trim($_POST['user_name']) : "";
	$password=isset($_POST['pass_word']) ? ($_POST['pass_word']) : "";

	$_SESSION['user_name']=$username;

	if($username=="" || $password=="")
	{
		$_SESSION['message']="Invalid username or password";
		$_SESSION['messagetype']="error";
		header("location: index.php");
		exit();

	}

	$check_user=mysql_query("SELECT * FROM users WHERE (Username='$username' and Password='$password')");

	if($check_user==FALSE)
	{
		$_SESSION['message']="Error encountered accessing information. ".mysql_error();
		$_SESSION['messagetype']="error";
		header("location: index.php");
		exit();
	}

	$total_user=mysql_num_rows($check_user);

		if($total_user<=0)
	{
		$_SESSION['message']="Invalid username or password";
		$_SESSION['messagetype']="error";
		header("location: index.php");
		exit();
	}

	mysql_data_seek($check_user,0);
	$row=mysql_fetch_assoc($check_user);

	if($row['Status']!="Active")
	{
		$_SESSION['message']="Your account is inactive, please contact the system administrator!";
		$_SESSION['messagetype']="error";
		header("location: index.php");
		exit();
	}

	$_SESSION['current_user_category']=$row['User_category'];
	$_SESSION['current_user_full_name']=$row['Full_name'];
	$_SESSION['current_user']=$username;
	$_SESSION['start_time']=time();

	unset($_SESSION['user_name']);

	header("location: home.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>
