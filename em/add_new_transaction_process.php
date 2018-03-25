<?php
	require_once("db_connect.php");
	require_once("time_check.php");
	
	$transaction_date=isset($_POST['date']) ? trim($_POST['date']) : "";
	$transaction_account=isset($_POST['accounts']) ? trim($_POST['accounts']) : "";
	$transaction_category=isset($_POST['category']) ? trim($_POST['category']) : "";
	$transaction_type=isset($_POST['type']) ? trim($_POST['type']) : "";
	$transaction_description=isset($_POST['description']) ? trim($_POST['description']) : "";
	$transaction_amount=isset($_POST['amount']) ? trim($_POST['amount']) : "";
	$status=isset($_POST['status']) ? trim($_POST['status']) : "";
	
	$_SESSION['date']=$transaction_date;
	$_SESSION['accounts']=$transaction_account;
	$_SESSION['category']=$transaction_category;
	$_SESSION['type']=$transaction_type;
	$_SESSION['description']=$transaction_description;
	$_SESSION['amount']=$transaction_amount;
	$_SESSION['status']=$status;
	
	if($transaction_date=="" || $transaction_account=="" || $transaction_category=="" || $transaction_type=="" || $transaction_description=="" || $transaction_amount=="" || $status=="")
	{
		$_SESSION['message']="Please enter all fields!";
		$_SESSION['messagetype']="error";
		header("location: add_new_transaction.php");
		exit();
	}
	
	$transaction_id="T000001";
	
	$get_transaction_id=mysql_query("select * from transactions order by transaction_id desc and created_by='".$_SESSION['current_user']."'");
	if($get_transaction_id==FALSE)
	{
		$_SESSION['message']="Error encountered accessing transaction!";
		$_SESSION['messagetype']="error";
		header("location: add_new_transaction.php");
		exit();
	}
	if(mysql_num_rows($get_transaction_id)>0)
	{
		mysql_data_seek($get_transaction_id,0);
		$row_get_transaction_id=mysql_fetch_assoc($get_transaction_id);
		$last_transaction_id=$row_get_transaction_id['transaction_id'];
		
		$last_id=intval(substr($last_transaction_id,1,6));
		$new_id=strval($last_id+1);
		
		while(strlen($new_id)<6)
		{
			$new_id="0" . $new_id;
		}
		$transaction_id="T" . $new_id;
	}
	
	$insert_transaction=mysql_query("insert into transactions set transaction_id='$transaction_id', transaction_date='$transaction_date', transaction_account='$transaction_account', transaction_category='$transaction_category', transaction_type='$transaction_type', transaction_description='$transaction_description', transaction_amount='$transaction_amount', status='$status',created_by='".$_SESSION['current_user']."'");
	if($insert_transaction==FALSE)
	{
		$_SESSION['message']="Error encountered adding transaction!".mysql_error();
		$_SESSION['messagetype']="error";
		header("location: add_new_transaction.php");
		exit();
	}
	
	unset($_SESSION['date'],$_SESSION['accounts'],$_SESSION['category'],$_SESSION['type'],$_SESSION['description'],$_SESSION['amount'], $_SESSION['status']);
	$_SESSION['message']="Transaction has been successfully added!";
	$_SESSION['messagetype']="success";
	header("location: manage_transactions.php");
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