<?php
	require_once("db_connect.php");
	require_once("time_check.php");
	
	$current_password=isset($_POST['current_pass']) ? ($_POST['current_pass']) : "";
	$new_password1=isset($_POST['new_pass1']) ? ($_POST['new_pass1']) : "";
	$new_password2=isset($_POST['new_pass2']) ? ($_POST['new_pass2']) : "";
	
	if($current_password=="" || $new_password1=="" || $new_password2=="")
	{
		$_SESSION['message']="Please enter all passwords";
		$_SESSION['messagetype']="error";
		header("location: change_password.php");
		exit();
	}
	
	//to check if the currnet password entered matches the one in the database
	
	$get_user=mysql_query("select * from users where (username='".$_SESSION['current_user']."' and password='$current_password')");
	
	if($get_user==FALSE)
	{
		$_SESSION['message']="Error encountered assessing user information! ".mysql_error();
		$_SESSION['messagetype']="error";
		header("location: change_password.php");
		exit();
	}
	
	$total_get_user=mysql_num_rows($get_user);
	
	if($total_get_user<=0)
	{
		$_SESSION['message']="The current password you entered is incorrect!";
		$_SESSION['messagetype']="error";
		header("location: change_password.php");
		exit();
	}
	
	//if we reach this point, it means the password entered is correct. so go ahead and comfirm that the two new passwords entered matches. if yes go anead and updated it in the database
	
	if($new_password1!=$new_password2)
	{
		$_SESSION['message']="The passwords you entered do not match!";
		$_SESSION['messagetype']="error";
		header("location: change_password.php");
		exit();
	}
	
	$update_password=mysql_query("update users set password='$new_password1' where (username='".$_SESSION['current_user']."')");
	
	if($update_password==FALSE)
	{
		$_SESSION['message']="You encountered an error updating user\'s password! ".mysql_error();
		$_SESSION['messagetype']="error";
		header("location: change_password.php");
		exit();
	}
	
		$_SESSION['message']="Your password has been successfully changed!";
		$_SESSION['messagetype']="success1";
		header("location: home.php");
		exit();
	
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