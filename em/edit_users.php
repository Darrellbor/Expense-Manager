
<?php
	require_once("time_check.php");
	require_once("db_connect.php");
	$page_title="Edit Users"; 
	
	$username=isset($_GET['username']) ? trim($_GET['username']) : "";
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
		$select_users=mysql_query("SELECT * FROM `users` where (username='$username')"); 
		if($select_users==FALSE)
		{
			?>
            	<p style="#F00"> Error encountered selecting user! <?php echo mysql_error(); ?></p>
            <?php
			die();
		}
		
		$total_selected_users=mysql_num_rows($select_users);
		
		if($total_selected_users<=0)
		{
			?>
            <p style="color:#F00"> No record found! </p>
            <p>
            <?php
		}
		
		mysql_data_seek($select_users,0);
		$row_select_users=mysql_fetch_assoc($select_users);
		
		$username=$row_select_users['Username'];
		$fullname=$row_select_users['Full_name'];
		$password=$row_select_users['Password'];
		$category=$row_select_users['User_category'];
		$status=$row_select_users['Status'];
		
	?>
    
    <p align="center"> <a href="manage_users.php">View Users</a> | <a href="home.php">Home</a></p>
    <?php 
	if(isset($_SESSION['message']))
	{
		?>
        	<p class="<?php echo $_SESSION['messagetype']; ?>"><?php echo $_SESSION['message']; ?></p>
        <?php
		unset($_SESSION['message'], $_SESSION['messagetype']);
	}
 ?>
    
    
    <script language="javascript">
	$(document).ready(
		function()
		{
			shade_input_table("data_table");
		}
	);
	</script>
    <form action="edit_user_process.php" method="post" id="myform">
    	<table align="center" cellpadding="10px" cellspacing="1px" id="data_table">
        	<tr>
            	
                <td> Username </td>
                <td> <input name="username" type="text" id="username" value="<?php echo $username ?>" readonly="readonly" autocomplete="off" /></td>
            </tr>
            
            <tr>
            	
                <td> Full Name </td>
                <td> <input name="fullname" type="text" id="fullname" autocomplete="off" value="<?php echo $fullname ?>" /></td>
            </tr>
            
            <tr>
            	
                <td> Password </td>
                <td> <input name="password" type="password" id="password" value="<?php echo $password ?>" /></td>
            </tr>
            
            <tr>
            	
                <td> User Category </td>
                <td><select name="category" id="category">
                		<option value=""></option>
                        <option value="Administrative"<?php if($category=="Administrative") { echo "selected='selected'";} ?>>Administrative</option>
                        <option value="Normal"<?php if($category=="Normal") { echo "selected='selected'";} ?>>Normal</option>
                	</select>
                </td>
            </tr>
            
            <tr>
            	
                <td> Status </td>
                <td> <select name="status" id="status">
                		<option value=""></option>
                        <option value="Active"<?php if($status=="Active") { echo "selected='selected'";} ?>>Active</option>
                        <option value="Inactive"<?php if($status=="Inactive") { echo "selected='selected'";} ?>>Inactive</option>
                	</select>
                </td>
            </tr>
            
            <tr>
                <td align="center" colspan="2"> <input type="button" value="Apply Changes" onclick="add_new_user_click()"/></td>
            </tr>
            	<script language="javascript">
				function add_new_user_click()
				{
					if(document.getElementById("username").value=="")
					{
						alert("Please enter your unique username!");
						document.getElementById("username").focus();
						return null;
					}
					
					if(document.getElementById("fullname").value=="")
					{
						alert("Please enter your name!");
						document.getElementById("fullname").focus();
						return null;
					}
					
					if(document.getElementById("password").value=="" || (document.getElementById("password").value).length<8)
					{
						alert("Please enter a password not less than 8 characters!");
						document.getElementById("password").focus();
						return null;
					}
					
					if(document.getElementById("category").value=="")
					{
						alert("Please specify what category you belong to!");
						document.getElementById("category").focus();
						return null;
					}
					
					if(document.getElementById("status").value=="")
					{
						alert("Please pick a status option from the options provided!");
						document.getElementById("status").focus();
						return null;
					}
					
					document.getElementById("myform").submit();
				}
				</script>
        </table>
    </form>
  <!-- InstanceEndEditable --></div>
</body>
<!-- InstanceEnd --></html>