<?php
	require_once("db_connect.php");
	require_once("time_check.php");
	$page_title="Manage Category"; 
	
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
   <p align="center"> <a href="home.php">Home</a> | <a href="add_new_category.php">Add new category</a></p>
    
    <?php
	$select_category=mysql_query("SELECT * FROM `categories` where(status='$status' and created_by='".$_SESSION['current_user']."')");
	if($select_category==FALSE)
	{
		die("Error selecting categories!. ".mysql_error());
	}
	
	$total_selected_category=mysql_num_rows($select_category);
	if($total_selected_category<=0)
	{
			?>
	<p class="error">No category record found!<?php echo mysql_error(); ?></p>
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
				document.getElementById("myform").action="Manage_category.php?status="+document.getElementById("status").value;
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
            	<td>Category name</td>
                <td>Category discription</td>
                <td>Status</td>
            </tr>
            
            <script language="javascript">
				function delete_category_click(category_name)
				{
					var r=confirm("Deleting record... please click ok to continue");
					if(r)
					{
						document.getElementById("myform").action="delete_category.php?category_name="+category_name;
						document.getElementById("myform").submit();
					}
				}
			</script>
            
           <?php
		   $bg_color="";
		   	while($row_selected_category=mysql_fetch_assoc($select_category))
			{
				$bg_color=($bg_color=="#efefef") ? "#cdcdcd" : "#efefef";
				?>
						<tr bgcolor="<?php echo $bg_color; ?>">
                     	<td><?php echo $row_selected_category['category_name']; ?><br />
                        <?php
                        if($status=="Active")
                        {
							?>
                        <span class="small"><a href="Javascript:void(0)" onclick="delete_category_click ('<?php echo $row_selected_category['category_name']; ?>')">Delete</a></span>
</td>
<?php
}
?>
                        <td><?php echo $row_selected_category['category_discription']; ?></td>
                        <td><?php echo $row_selected_category['status']; ?></td>
            		</tr>
                <?php
			}
		   ?>
            
        </table>
    </form>
    			

	<!-- InstanceEndEditable --></div>
</body>
<!-- InstanceEnd --></html>