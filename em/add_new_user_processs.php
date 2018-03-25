<?php
	session_start();
	$page_title=""; 
	require_once("db_connect.php");
	
	$username=isset($_POST['username']) ? trim($_POST['username']) : "";
	$fullname=isset($_POST['fullname']) ? trim($_POST['fullname']) : "";
	$password=isset($_POST['password']) ? ($_POST['password']) : "";
	$category=isset($_POST['category']) ? trim($_POST['category']) : "";
	$status=isset($_POST['status']) ? trim($_POST['status']) : "";
	$date=date("Y-m-d H:i:s");
	
	$_SESSION['username']="$username";
	$_SESSION['fullname']="$fullname";
	$_SESSION['password']="$password";
	$_SESSION['category']="$category";
	$_SESSION['status']="$status";
	
	if($username=="" || $fullname=="" || $password=="" || $category=="" || $status=="")
	{
		$_SESSION['message']="Please enter/select all fields before you can add a new user";
		$_SESSION['messagetype']="error";
		header("location: add_new_user.php");
		exit();
	}
	
	//check if username already exists
	$check_user=mysql_query("select * from users where (username='$username')");
	
	if($check_user==FALSE)
	{
		$_SESSION['message']="Error encountered accessing user information! ".mysql_error();
		$_SESSION['messagetype']="error";
		header("location: add_new_user.php");
		exit();
	}
	
	$total_check_user=mysql_num_rows($check_user);
	
	if($total_check_user>0)
	{
		$_SESSION['message']="There already exists a user with the username ($username). Please choose another username. ";
		$_SESSION['messagetype']="error";
		header("location: add_new_user.php");
		exit();
	}
	
	if(is_uploaded_file($_FILES['picture']['tmp_name']))
	{
		$new_filename="images/" . $username . ".jpg";
		move_uploaded_file($_FILES['picture']['tmp_name'], $new_filename);
	}
?>
 <?php
    $insert_sql=mysql_query("insert into users set Username='$username', Full_name='$fullname', Password='$password', User_category='$category', Status='$status', Date_created='$date'");
		
		if($insert_sql==FALSE)
	{
		$_SESSION['message']="Error encountered adding user!".mysql_error();
		$_SESSION['messagetype']="error";
		header("location: add_new_user.php");
		exit();
	}
	
	else
	
	{
		unset($_SESSION['username'], $_SESSION['fullname'], $_SESSION['password'], $_SESSION['category'], $_SESSION['status']);
		$_SESSION['message']="user ($username) has been successfully added!";
		$_SESSION['messagetype']="success";
		header("location: manage_users.php");
		exit();
	}
		?>