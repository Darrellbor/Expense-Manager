<?php
	$page_title="Add new category"; 
	require_once("time_check.php");
	
	$category_name=isset($_SESSION['category_name']) ? ($_SESSION['category_name']) : "";
	$category_discription=isset($_SESSION['category_discription']) ? ($_SESSION['category_discription']) : "";
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
    <p align="center"><a href="Manage_category.php">Back to manage category</a> | <a href="home.php">Home</a></p>
    
    <?php 
	if(isset($_SESSION['message']))
	{
		?>
   	<p class="<?php echo $_SESSION['messagetype']; ?>"><?php echo $_SESSION['message']; ?></p>
        <?php
		unset($_SESSION['message'], $_SESSION['messagetype']);
	}
 ?>
 <form action="add_new_category_process.php" method="post" id="myform">
 	<table align="center" cellpadding="10px" cellspacing="1px" id="data_table">
    	<tr>
        	<td>Category name</td>
            <td><input name="category_name" type="text" id="category_name" autocomplete="off" value="<?php echo $category_name; ?>" class="width_200" /></td>
        </tr>
        
        <tr>
        	<td>Category discription</td>
            <td> <textarea name="category_discripton" id="category_discripton" class="width_200" rows="4px"></textarea></td>
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
        	<td align="center" colspan="2"><input type="button" value="Add new category" onclick="add_new_category_click()" /></td>
        </tr>
        <script language="javascript">
			function add_new_category_click()
			{
				if(document.getElementById('category_name').value=="")
				{
					alert("Please make sure a name is provided!");
					document.getElementById('category_name').focus();
					return null;
				}
				
				if(document.getElementById('category_discripton').value=="")
				{
					alert("Please discribe your category!");
					document.getElementById('category_discripton').focus();
					return null;
				}
				
				if(document.getElementById('status').value=="")
				{
					alert("Please make sure a status is selected!");
					document.getElementById('status').focus();
					return null;
				}
				
				document.getElementById('myform').submit();
			}
		</script>
    </table>
 </form>
  <!-- InstanceEndEditable --></div>
</body>
<!-- InstanceEnd --></html>