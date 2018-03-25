<?php
	require_once("time_check.php");
	$page_title="Change Password"; 
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
    <p align="center"><a href="home.php">Back to home</a></p>
    	<form action="change_password_process.php" method="post" id="myform">
        	<table align="center" cellpadding="10px" cellspacing="1px" id="data_table">
            	<tr>
                	<td><strong>Enter Current Password:</strong></td>
                    <td><input name="current_pass" type="password" id="current_pass" /></td>
                </tr>
                <tr>
                	<td><strong>Enter New Password:</strong></td>
                    <td><input name="new_pass1" type="password" id="new_pass1" /></td>
                </tr>
                <tr>
                	<td><strong>Re-enter New Password:</strong></td>
                    <td><input name="new_pass2" type="password" id="new_pass2" /></td>
                </tr>
                <tr>
                	<td align="center" colspan="2"><input type="button" value="Change Password" onclick="change_pass_click()" /></td>
                </tr>
                	<script language="javascript">
						function change_pass_click()
						{
							if(document.getElementById("current_pass").value=="")
							{
								alert("Please enter current password!");
								document.getElementById("current_pass").focus();
								return null;
							}
							
							if(document.getElementById("new_pass1").value=="")
							{
								alert("Please enter new password!");
								document.getElementById("new_pass1").focus();
								return null;
							}
							
							if(document.getElementById("new_pass2").value=="")
							{
								alert("Please re-enter new password!");
								document.getElementById("new_pass2").focus();
								return null;
							}
							
							if(document.getElementById("new_pass1").value!=document.getElementById("new_pass2").value)
							{
								alert("The two passwords you entered do not match!");
								document.getElementById("new_pass1").value=""
								document.getElementById("new_pass2").value=""
								document.getElementById("new_pass1").focus();
								return null;
							}
							
							var total_xtar=(document.getElementById("new_pass1").value).length;
							
							if(total_xtar<8 || total_xtar>32)
							{
								alert("The new password cannot be less than 8 characters and cannot be more than 32 characters");
								document.getElementById("new_pass1").value=""
								document.getElementById("new_pass2").value=""
								document.getElementById("new_pass1").focus();
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