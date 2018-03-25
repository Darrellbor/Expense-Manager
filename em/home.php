<?php
	include_once("time_check.php");
	$page_title="Home"; 
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
    <p>
      <script language="javascript">
	$(document).ready(
		function()
		{
			shade_input_table("home_table");
		}
	);
      </script>
    
    <table align="center" cellpadding="10px" cellspacing="1px" id="home_table">
    <?php
		if(isset($_SESSION['current_user_category']) && $_SESSION['current_user_category']=="Administrative")
		{
			?>
            	<tr>
                    <td width="38"><a href="manage_users.php?status=Active"><img src="images/user too.jpg" width="30" /> </a></td>
                    <td width="74"><a href="manage_users.php?status=Active"> Manage Users</a></td>
    			</tr>
           	<?php
		}
	?>
        
        <tr>
        	<td><a href="Manage_category.php?status=Active"><img src="images/categories too .jpg" width="30" /> </a></td>
            <td><a href="Manage_category.php?status=Active"> Manage Category</a></td>
    	</tr>
        <tr>
        	<td><a href="manage_accounts.php?status=Active"><img src="images/account .jpg" width="30" /> </a></td>
            <td><a href="manage_accounts.php?status=Active"> Manage Accounts</a></td>
    	</tr>
        <tr>
        	<td><a href="manage_transactions.php?status=Active"><img src="images/transaction .jpg" width="30" /> </a></td>
            <td><a href="manage_transactions.php?status=Active"> Manage Transactions</a></td>
    	</tr>
        <tr>
        	<td><a href="change_password.php"><img src="images/change password .jpg" width="30" /> </a></td>
            <td><a href="change_password.php">Change Password</a></td>
    	</tr>
        <tr>
        	<td><a href="log_out.php"><img src="images/exit .jpg" width="30" /> </a></td>
            <td><a href="log_out.php">Log Out</a></td>
    	</tr>
    </table>
<!-- InstanceEndEditable --></div>
</body>
<!-- InstanceEnd --></html>