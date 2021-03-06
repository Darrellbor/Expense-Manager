<?php
	include_once("time_check.php");
	include_once("db_connect.php");
	$page_title="Manage users"; 
	
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
    <p align="center"><a href="home.php">Home</a> | <a href="add_new_user.php">Add new User</a></p>
    <?php
		$select_users=mysql_query("SELECT * FROM `users` where(status='$status')");
		if($select_users==FALSE)
		{
			die("Error selecting users! ".mysql_error());
		}
		
		$total_selected_users=mysql_num_rows($select_users);
		if($total_selected_users<=0)
		{
			?>
			<p class="error">No user record found!<?php echo mysql_error(); ?></p>
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
				document.getElementById("myform").action="manage_users.php?status="+document.getElementById("status").value;
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
        
        <table align="center" cellspacing="1px" cellpadding="10px">
        	<tr align="center" class="tableheading">
            	<td>Profile picture</td>
            	<td> Username </td>
                <td> Full name </td>
                <td> User category </td>
                <td> Status </td>
                <td> Date created </td>
            </tr>
          <script language="javascript">
				function delete_record_click(username,fullname)
				{
					var r=confirm("Deleting record... click ok to continue");
					if(r)
					{
						document.getElementById("myform").action="delete_user.php?username="+username+"&name="+name;
						document.getElementById("myform").submit();
					}
				}
			</script>
            
            <?php
			$bg_color="";
			while($row_select_users=mysql_fetch_assoc($select_users))
			{
				$bg_color=($bg_color=="#efefef") ? "#cdcdcd" : "#efefef";
				$filename="images/" . $row_select_users['Username'] .".jpg";
				?>
                	<tr bgcolor="<?php echo $bg_color; ?>">
                    	<td align="center"><img src="<?php echo $filename; ?>" width="80" /></td>
                   	  <td> <?php echo $row_select_users['Username']; ?><br />
                       <span class="small"><a href="edit_users.php?username=<?php echo $row_select_users['Username']; ?>">Edit</a>
<?php
							if($status=="Active")
							{
								?>
                                	| <a href="Javascript:void(0)" onclick="delete_record_click('<?php echo $row_select_users['Username']; ?>','<?php echo $row_select_users['Full_name']; ?>')">Delete</a>
<?php 
							}
						?>
                       </span>
                   	    </td>
                        <td> <?php echo $row_select_users['Full_name']; ?></td>
                        <td> <?php echo $row_select_users['User_category']; ?></td>
                        <td> <?php echo $row_select_users['Status']; ?></td>
                        <td> <?php echo $row_select_users['Date_created']; ?></td>
                    </tr>
                <?php
			}
			?>
        </table>
    </form>
  <!-- InstanceEndEditable --></div>
</body>
<!-- InstanceEnd --></html>