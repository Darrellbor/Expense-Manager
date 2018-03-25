<?php
	$page_title="Manage Accounts"; 
	require_once("db_connect.php");
	require_once("time_check.php");
	
	$status=isset($_GET['status']) ? ($_GET['status']) : "Active";
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
    <p align="center"><a href="home.php">Home</a> | <a href="add_new_account.php">Add new account</a></p>
    
    <?php
		$select_account=mysql_query("SELECT * FROM `accounts` where(status='$status' and created_by='".$_SESSION['current_user']."')");
		if($select_account==FALSE)
		{
			die("Error selecting accounts!. ".mysql_error());
		}
		
		$total_selected_accounts=mysql_num_rows($select_account);
		if($total_selected_accounts<=0)
		{
			?>
   	<p class="error">No accounts found!<?php echo mysql_error(); ?></p>
            <?php
			die();
		}
	?>
    
    
    </p>
    <form method="post" id="myform">
     <p align="center">&nbsp; </p>
        <p align="center">
        	<b>Status: </b>
            <select name="status" id="status" onchange="status_change()">
            	<option value="Active" <?php if($status=="Active") { echo "selected='selected'";} ?>>Active</option>
                <option value="Inactive" <?php if($status=="Inactive") { echo "selected='selected'";} ?>>Inactive</option>
            </select>
      </p>
      <script language="javascript">
			function status_change()
			{
				document.getElementById("myform").action="manage_accounts.php?status="+document.getElementById("status").value;
				document.getElementById("myform").submit();
			}
		</script>
        <hr />
    
     <?php 
	if(isset($_SESSION['message']))
	{
		?>
        	<p class="<?php echo $_SESSION['messagetype']; ?>"><?php echo $_SESSION['message']; ?></p>
        <?php
		unset($_SESSION['message'], $_SESSION['messagetype']);
	}
 ?>
 
    	<table align="center" cellpadding="10px" cellspacing="1px">
        	<tr class="tableheading">
            	<td>Account Id</td>
                <td>Account Name </td>
				<td>Account Discription </td>
                <td>Status </td>
            </tr>
            
            <script language="javascript">
			function delete_record_click(account_name)
			{
				var r=confirm("Deleting record... Please click on ok to continue.");
				if(r)
				{
					document.getElementById("myform").action="delete_accounts.php?account_name="+account_name;
					document.getElementById("myform").submit();
				}
			}
			</script>
            
            <?php
			$bg_color="";
			while($row_selected_accounts=mysql_fetch_assoc($select_account))
			{
				$bg_color=($bg_color=="#efefef") ? "#cdcdcd" : "#efefef";
				?>
                <tr bgcolor="<?php echo $bg_color; ?>">
                	<td><?php echo $row_selected_accounts['account_id']; ?><br />
                    <?php
						if($status=="Active")
						{
					?>
                   		 <span class="small"><a href="javascript:void(0)" onclick="delete_record_click('<?php echo $row_selected_accounts['account_name']; ?>')">Delete</a></span>
                    <?php
						}
					?>
                    </td>
                    <td><?php echo $row_selected_accounts['account_name']; ?></td>
                    <td><?php echo $row_selected_accounts['account_discription']; ?></td>
                    <td><?php echo $row_selected_accounts['status']; ?></td>
                </tr>
                <?php
			}
			?>
        </table>
    </form>
  <!-- InstanceEndEditable --></div>
</body>
<!-- InstanceEnd --></html>