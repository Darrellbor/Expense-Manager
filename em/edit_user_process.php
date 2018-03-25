<?php
	session_start();
	require_once("db_connect.php");
	$page_title=""; 
	
	$username=isset($_POST['username']) ? trim($_POST['username']) : "";
	$fullname=isset($_POST['fullname']) ? trim($_POST['fullname']) : "";
	$password=isset($_POST['password']) ? ($_POST['password']) : "";
	$category=isset($_POST['category']) ? trim($_POST['category']) : "";
	$status=isset($_POST['status']) ? trim($_POST['status']) : "";
	
	$_SESSION['username']="$username";
	$_SESSION['fullname']="$fullname";
	$_SESSION['password']="$password";
	$_SESSION['category']="$category";
	$_SESSION['status']="$status";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/templates.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title><?php echo $page_title; ?> :: expense manager</title>
<!-- InstanceEndEditable -->
<link href="mystyles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="scripts/jquery-1.4.2.min.js"> </script>
<script language="javascript" src="scripts/functions.js"> </script>
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>
<div id="heading">
Expense manager
</div>
<div id="content">
<?php
	if(isset($_SESSION['current_user_full_name']) && $page_title!="Login")
	{
		?>
        	<p align="right" style="font-size:11px;"><b>Logged In:</b> <?php echo $_SESSION['current_user_full_name'];?> (<?php echo $_SESSION['current_user'];?>) - <a href="log_out.php">Log Out</a></p>
        <?php
	}
?>
<h1>
    	<?php echo $page_title; ?>
    </h1>
    
    <?php
		if(isset($_SESSION['message']))
		{
			?>
            <p class="<?php echo $_SESSION['messagetype']; ?>"><?php echo $_SESSION['message']; ?></p>
            <?php
			unset($_SESSION['message'], $_SESSION['messagetype']);
		}
	?>
	<!-- InstanceBeginEditable name="mycontents" -->
    <?php
	
		$update_users=mysql_query("update users set Username='$username', Full_name='$fullname', Password='$password', User_category='$category', Status='$status' where username=('$username')"); 
		
		if($update_users==FALSE)
		{
			$_SESSION['message']="Error encountered updating users record!".mysql_error();
			$_SESSION['messagetype']="error";
			header("location: edit_users.php");
			exit();
		}
		
		else
		{
			unset($_SESSION['username'], $_SESSION['fullname'], $_SESSION['password'], $_SESSION['category'], $_SESSION['status']);
			$_SESSION['message']="user ($username) record was succesfully updated";
			$_SESSION['messagetype']="success1";
			header("location: manage_users.php");
			exit();
		}
	?>
    
    user successfully updated. <a href="manage_users.php">View Users</a> <!-- InstanceEndEditable --></div>
</body>
<!-- InstanceEnd --></html>