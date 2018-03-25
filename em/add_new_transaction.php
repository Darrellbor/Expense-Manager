<?php
	require_once("time_check.php");
	require_once("db_connect.php");
	$page_title="Add new Transaction"; 
	
	$transaction_date=isset($_SESSION['date']) ? trim($_SESSION['date']) : date("Y-m-d");
	$transaction_account=isset($_SESSION['accounts']) ? trim($_SESSION['accounts']) : "";
	$transaction_category=isset($_SESSION['category']) ? trim($_SESSION['category']) : "";
	$transaction_type=isset($_SESSION['type']) ? trim($_SESSION['type']) : "";
	$transaction_description=isset($_SESSION['description']) ? trim($_SESSION['description']) : "";
	$transaction_amount=isset($_SESSION['amount']) ? trim($_SESSION['amount']) : "";
	$status=isset($_SESSION['status']) ? trim($_SESSION['status']) : "";

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
			shade_input_table("home_table");
		}
	);
      </script>
    <p align="center"><a href="home.php">Home</a> | <a href="manage_transactions.php">Back to manage transactions</a></p>
    <?php
		$get_account=mysql_query("select * from accounts where (status='Active') order by account_name");
		if($get_account==FALSE)
		{
			?>
            	<p align="center" class="error">Error encountered accessing accounts records<?php echo mysql_error(); ?></p>
            <?php
			die();
		}
		$total_get_account=mysql_num_rows($get_account);
		
		$get_category=mysql_query("select * from categories where (status='Active') order by category_name");
		if($get_category==FALSE)
		{
			?>
   	<p align="center" class="error">Error encountered accessing categories records<?php echo mysql_error(); ?></p>
            <?php
			die();
		}
		$total_get_categories=mysql_num_rows($get_category);
	?>
    
    <form action="add_new_transaction_process.php" method="post" id="myform">
    	<table align="center" cellpadding="10px" cellspacing="1px" id="home_table">
        	<tr>
            	<td><b>Date:</b></td>
                <td><input name="date" type="date" class="width_200" id="date" autocomplete="off" value="<?php echo $transaction_date; ?>" /></td>
            </tr>
            <tr>
            	<td><b>Accounts:</b></td>
                <td>
                <select name="accounts" class="width_200" id="accounts">
                	<option value=""></option>
                    <?php
						if($total_get_account>0)
						{
							for($count_get_account=0; $count_get_account<$total_get_account; $count_get_account++)
							{
								mysql_data_seek($get_account,$count_get_account);
								$row_get_accounts=mysql_fetch_assoc($get_account);
								?>
                                	<option value="<?php echo $row_get_accounts['account_name']; ?>" <?php if($transaction_account==$row_get_accounts['account_name']) { echo "selected='selected'"; } ?>><?php echo $row_get_accounts['account_name']; ?></option>
                                <?php
							}
						}
					?>
                </select>
                </td>
            </tr>
            <tr>
            	<td><b>Category:</b></td>
                <td>
                <select name="category" class="width_200" id="category">
                	<option value=""></option>
                    <?php
						if($total_get_categories>0)
						{
							for($count_get_category=0; $count_get_category<$total_get_categories; $count_get_category++ )
							{
								mysql_data_seek($get_category,$count_get_category);
								$row_get_category=mysql_fetch_assoc($get_category);
								?>
                                	<option value="<?php echo $row_get_category['category_name']; ?>" <?php if($transaction_category==$row_get_category['category_name']) { echo "selected='selected'"; } ?>> <?php echo $row_get_category['category_name']; ?></option>
                                <?php
							}
						}
					?>
                </select>
                </td>
            </tr>
            <tr>
              <td><strong>Transaction type:</strong></td>
              <td>
              	<select name="type" class="width_200" id="type">
                	<option value=""></option>
                    <option value="Income" <?php if($transaction_type=="Income") { echo "selected='selected'"; } ?>>Income</option>
                    <option value="Expense" <?php if($transaction_type=="Expense") { echo "selected='selected'"; } ?>>Expense</option>


                </select>
              </td>
            </tr>
            <tr>
              <td><strong>Transaction description:</strong></td>
              <td><input name="description" type="text" class="width_200" id="description" autocomplete="off" value="<?php echo $transaction_description; ?>" /></td>
            </tr>
            <tr>
              <td><strong>Transaction Amount:</strong></td>
              <td><input name="amount" type="text" class="width_200" id="amount" autocomplete="off" value="<?php echo $transaction_amount; ?>" /></td>
            </tr>
            <tr>
            	<td><strong>Status:</strong></td>
                <td><select name="status" class="width_200" id="status">
                	<option value=""></option>
                    <option value="Active"<?php if($status=="Active") { echo "selected='selected'"; } ?>>Active</option>
                    <option value="Inactive"<?php if($status=="Inactive") { echo "selected='selected'"; } ?>>Inactive</option>
                </select>
              </td>
            </tr>
            <tr>
              <td colspan="2" align="center"><input type="button" value="Add Transaction" onclick="add_new_transaction_click()" /></td>
            </tr>
            <script language="javascript">
				function add_new_transaction_click()
				{
				$(document).ready(
					function ()
					{
						val_date_click(document.getElementById("date").value);
					}
				);
					if(document.getElementById("accounts").value=="")
					{
						alert("Please make sure the accounts is filled!");
						document.getElementById("accounts").focus();
						return null;	
					}
					if(document.getElementById("category").value=="")
					{
						alert("Please make sure the category is filled!");
						document.getElementById("category").focus();
						return null;	
					}
					if(document.getElementById("type").value=="")
					{
						alert("Please make sure the transaction type is filled!");
						document.getElementById("type").focus();
						return null;	
					}
					if(document.getElementById("description").value=="")
					{
						alert("Please make sure the transaction description is filled!");
						document.getElementById("description").focus();
						return null;	
					}
					if(document.getElementById("amount").value=="" || isNaN(document.getElementById("amount").value))
					{
						alert("Please make sure the transaction amount is filled and is numeric!");
						document.getElementById("amount").focus();
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