<?php
	$page_title="Add new account";
	require_once("time_check.php"); 
	
	$account_id=isset($_SESSION['account_id']) ? ($_SESSION['account_id']) : "";
	$account_name=isset($_SESSION['account_name']) ? ($_SESSION['account_name']) : "";
	$account_discription=isset($_SESSION['account_discription']) ? ($_SESSION['account_discription']) : "";
	$status=isset($_SESSION['status']) ? ($_SESSION['status']) : "";
	
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
     <script language="javascript">
	$(document).ready(
		function()
		{
			shade_input_table("data_table");
		}
	);
	</script>
    <p align="center"><a href="manage_accounts.php">Back to manage accounts</a> | <a href="home.php">Home</a></p>
    
    <form action="add_new_account_process.php" method="post" id="myform">
    	<table align="center" cellpadding="10px" cellspacing="1px" id="data_table">
        	<tr>
            	<td>Account id</td>
                <td><input name="account_id" type="text" id="account_id" autocomplete="off" class="width_200" value="<?php echo $account_id; ?>" /> </td>
            </tr>
            
            <tr>
            	<td>Account name</td>
                <td><input name="account_name" type="text" id="account_name" autocomplete="off" class="width_200" value="<?php echo $account_name; ?>" /> </td>
            </tr>
            
            <tr>
            	<td>Account discription</td>
                <td><textarea name="account_discription" id="account_discription" class="width_200" rows="4px"></textarea> </td>
            </tr>
            
            <tr>
        	<td>Status</td>
            <td>
            <select name="status" id="status" class="width_200">
            	<option value=""></option>
                <option value="Active" <?php if($status=="Active") { echo "selected='selected'";} ?>>Active</option>
                <option value="Inactive" <?php if($status=="Inactive") { echo "selected='selected'";} ?>>Inactive</option>
            </select>
          </td>
        </tr>
        
        <tr>
        	<td align="center" colspan="2"><input type="button" value="Add new account" onclick="add_new_account_click()" /></td>
        </tr>
        
        <script language="javascript">
			function add_new_account_click()
			{
				if(document.getElementById("account_id").value=="")
				{
					alert("Please make sure to fill the account id section!");
					document.getElementById("account_id").focus();
					return null;
				}
				
				if(document.getElementById("account_name").value=="")
				{
					alert("Please provide an account name!");
					document.getElementById("account_name").focus();
					return null;
				}
				
				if(document.getElementById("account_discription").value=="")
				{
					alert("Please provide a brief discription of the account!");
					document.getElementById("account_discription").focus();
					return null;
				}
				
				if(document.getElementById("status").value=="")
				{
					alert("Please make sure the status section is filled!");
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