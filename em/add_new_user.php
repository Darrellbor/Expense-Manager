<?php
	$page_title="Add New User"; 
	require_once("time_check.php");
	
	$username=isset($_SESSION['username']) ? ($_SESSION['username']) : "";
	$fullname=isset($_SESSION['fullname']) ? ($_SESSION['fullname']) : "";
	$password=isset($_SESSION['password']) ? ($_SESSION['password']) : "";
	$category=isset($_SESSION['category']) ? ($_SESSION['category']) : "";
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
    <p align="center">&nbsp; </p>
    <p align="center"><a href="manage_users.php">Back to manage users</a> | <a href="home.php">Home</a></p>
    <?php 
	if(isset($_SESSION['message']))
	{
		?>
        	<p class="<?php echo $_SESSION['messagetype']; ?>"><?php echo $_SESSION['message']; ?></p>
        <?php
		unset($_SESSION['message'], $_SESSION['messagetype']);
	}
 ?>
    
    <form action="add_new_user_processs.php" method="post" enctype="multipart/form-data" id="myform">
    	<table align="center" cellpadding="10px" cellspacing="1px" id="data_table">
        	<tr>
            	<td>Upload Picture</td>
                <td><input name="picture" type="file" id="picture" />
                	<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
                </td>
            </tr>
        	<tr>
            	
                <td> Username </td>
                <td> <input name="username" type="text" id="username" autocomplete="off" value="<?php echo $username ?>" class="width_200" /></td>
            </tr>
            
            <tr>
            	
                <td> Full Name </td>
                <td> <input name="fullname" type="text" id="fullname" autocomplete="off" value="<?php echo $fullname ?>"  class="width_200"/></td>
            </tr>
            
            <tr>
            	
                <td> Password </td>
                <td> <input name="password" type="password" id="password" value="<?php echo $password ?>" class="width_200" /></td>
            </tr>
            
            <tr>
            	
                <td> User Category </td>
                <td><select name="category" id="category" class="width_200">
                		<option value=""></option>
                        <option value="Administrative"<?php if($category=="Administrative") { echo "selected='selected'";} ?>>Administrative</option>
                        <option value="Normal"<?php if($category=="Normal") { echo "selected='selected'";} ?>>Normal</option>
                	</select>
                </td>
            </tr>
            
            <tr>
            	
                <td> Status </td>
                <td> <select name="status" id="status" class="width_200">
                		<option value=""></option>
                        <option value="Active"<?php if($status=="Active") { echo "selected='selected'";} ?>>Active</option>
                        <option value="Inactive"<?php if($status=="Inactive") { echo "selected='selected'";} ?>>Inactive</option>
                	</select>
                </td>
            </tr>
            
            <tr>
                <td align="center" colspan="2"> <input type="button" value="Add new user" onclick="add_new_user_click()"/></td>
            </tr>
            	<script language="javascript">
				function add_new_user_click()
				{
					if(document.getElementById("username").value=="")
					{
						alert("Please enter your username!");
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
					
					if(document.getElementById("picture").value!="")
					{
						var filename=(document.getElementById("picture").value);
						var mylength=filename.length;
						//alert("filename length = "+ mylength );
						var ext=filename.substr(mylength-4,4);
						
						//alert("filename is "+ filename + ". \n\nExtension is "+ ext );
						ext=ext.toLowerCase();
						alert("filename is "+ filename + ". \n\nExtension is "+ ext );
						if(ext!=".jpg" && ext!=".JPG")
						{
							alert("You uploaded a '"+ ext +"' file. Please choose a .jpg file to upload!");
							return null;
						}
					}
					
					document.getElementById("myform").submit();
				}
				</script>
        </table>
    </form>
  <!-- InstanceEndEditable --></div>
</body>
<!-- InstanceEnd --></html>