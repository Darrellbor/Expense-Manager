<?php
	session_start();
	require_once("db_connect.php");
	
	$aid=isset($_POST['account_id']) ?trim($_POST['account_id']) : "";
	$aname=isset($_POST['account_name']) ?trim($_POST['account_name']) : "";
	$adis=isset($_POST['account_discription']) ?trim($_POST['account_discription']) : "";
	$status=isset($_POST['status']) ?trim($_POST['status']) : "";
	
	$_SESSION['account_id']=$aid;
	$_SESSION['account_name']=$aname;
	$_SESSION['account_discription']=$adis;
	$_SESSION['status']=$status;
	
	if($aid=="" || $aname=="" || $adis=="" || $status=="")
	{
		$_SESSION['message']="please make sure all fields are filled!";
		$_SESSION['messagetype']="error";
		header("location: add_new_account.php");
		exit();
	}
	
	//check if there is an account with the name
	$check_acc=mysql_query("select * from accounts where (account_name='$aname' and created_by='".$_SESSION['current_user']."')");
	if($check_acc==FALSE)
	{
		$_SESSION['message']="An error occured selecting accounts! ".mysql_error();
		$_SESSION['messagetype']="error";
		header("location: add_new_account.php");
		exit();
	}
	
	$total_check_accounts=mysql_num_rows($check_acc);
	if($total_check_accounts>0)
	{
		$_SESSION['message']="There already exists an account with the account name ($aname). Please choose another category name ";
		$_SESSION['messagetype']="error";
		header("location: add_new_account.php");
		exit();
	}
	
?>
<?php
	$insert_sql=mysql_query("insert into accounts set account_id='$aid', account_name='$aname', account_discription='$adis', status='$status', created_by='".$_SESSION['current_user']."'");
	if($insert_sql==FALSE)
	{
		$_SESSION['message']="An error occured! ".mysql_error();
		$_SESSION['messagetype']="error";
		header("location: add_new_account.php");
		exit();
	}
	
	else
	{
		unset($_SESSION['account_id'], $_SESSION['account_name'], $_SESSION['account_discripton'], $_SESSION['status']);
		$_SESSION['message']="account ($aname) has been successfully added";
		$_SESSION['messagetype']="success";
		header("location: manage_accounts.php");
		exit();
	}
?>
