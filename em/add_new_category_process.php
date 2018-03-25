<?php
	session_start();
	require_once("db_connect.php");
	
	$cname=isset($_POST['category_name']) ?trim($_POST['category_name']) : "";
	$cdis=isset($_POST['category_discripton']) ?trim($_POST['category_discripton']) : "";
	$status=isset($_POST['status']) ?trim($_POST['status']) : "";
	
	$_SESSION['category_name']=$cname;
	$_SESSION['category_discripton']=$cdis;
	$_SESSION['status']=$status;
	
	if($cname=="" || $cdis=="" || $status=="")
	{
		$_SESSION['message']="please make sure all fields are filled!";
		$_SESSION['messagetype']="error";
		header("location: add_new_category.php");
		exit();
	}
	
	//check if there is a category with the name
	$check_cat=mysql_query("select * from categories where (category_name='$cname' and created_by='".$_SESSION['current_user']."')");
	if($check_cat==FALSE)
	{
		$_SESSION['message']="An error occured selecting category! ".mysql_error();
		$_SESSION['messagetype']="error";
		header("location: add_new_category.php");
		exit();
	}
	
	$total_check_category=mysql_num_rows($check_cat);
	if($total_check_category>0)
	{
		$_SESSION['message']="There already exists a category with the category name ($cname). Please choose another category name ";
		$_SESSION['messagetype']="error";
		header("location: add_new_category.php");
		exit();
	}
?>
<?php
	$insert_sql=mysql_query("insert into categories set category_name='$cname', category_discription='$cdis', status='$status', created_by='".$_SESSION['current_user']."'");
	if($insert_sql==FALSE)
	{
		$_SESSION['message']="An error occured! ".mysql_error();
		$_SESSION['messagetype']="error";
		header("location: add_new_category.php");
		exit();
	}
	
	else
	{
		unset($_SESSION['category_name'], $_SESSION['category_discripton'], $_SESSION['status']);
		$_SESSION['message']="category ($cname) has been successfully added";
		$_SESSION['messagetype']="success";
		header("location: Manage_category.php");
		exit();
	}
?>
