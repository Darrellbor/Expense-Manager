<?php
	session_start();
	require_once("db_connect.php");
	
	$transaction_id=isset($_GET['transaction_id']) ? trim($_GET['transaction_id']) : "";
	
	$_SESSION['transaction_id']=$transaction_id;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<?php
	$del_trans=mysql_query("update transactions set status='Inactive' where transaction_id='$transaction_id'");
	if($del_trans==FALSE)
	{
		$_SESSION['message']="Error deleting transaction! ".mysql_error();
		$_SESSION['messagetype']="error";
		header("location: manage_transactions.php");
		exit();
	}
	
	else
	{
		unset($_SESSION['transaction_id']);
		$_SESSION['message']="Transaction ($transaction_id) was successfully deleted";
		$_SESSION['messagetype']="success2";
		header("location: manage_transactions.php");
		exit();
	}
?>
</body>
</html>