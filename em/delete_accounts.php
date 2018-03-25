<?php
	session_start();
	require_once("db_connect.php");
	
	$account_name=isset($_GET['account_name']) ? trim($_GET['account_name']) : "";
	
	$_SESSION['account_name']=$account_name;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<?php
	
	$del_acct=mysql_query("update accounts set status='Inactive' where account_name='$account_name'");
	if($del_acct==FALSE)
	{
		$_SESSION['message']="Error deleting account! ".mysql_error();
		$_SESSION['messagetype']="error";
		header("location: manage_accounts.php");
		exit();
	}
	else
	{
		unset($_SESSION['account_name']);
		$_SESSION['message']="account ($account_name) successfully deleted";
		$_SESSION['messagetype']="success2";
		header("location: manage_accounts.php");
		exit();
	}
?>
<?php echo $account_name; ?> record was successfully deleted. <a href="manage_accounts.php"><strong>view accounts.</strong></a>
</body>
</html>