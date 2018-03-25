<?php
	session_start();
	require_once("db_connect.php");
	
	$category_name=isset($_GET['category_name']) ? trim($_GET['category_name']) : "";
	
	$_SESSION['category_name']=$category_name;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="mystyles.css" rel="stylesheet" type="text/css" />
</head>

<body>

<?php
	
	$del_cat=mysql_query("update categories set status='Inactive' where category_name='$category_name'");
	if($del_cat==FALSE)
	{
		$_SESSION['message']="Error deleting category! ".mysql_error();
		$_SESSION['messagetype']="error";
		header("location: Manage_category.php");
		exit();
	}
	else
	{
		unset($_SESSION['category_name']);
		$_SESSION['message']="category ($category_name) successfully deleted";
		$_SESSION['messagetype']="success2";
		header("location: Manage_category.php");
		exit();
	}
?>
<?php echo $category_name; ?> category has been successfully deleted. <a href="Manage_category.php"><strong>view category</strong></a>
</body>
</html>