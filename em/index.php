<?php
	session_start();
	$page_title="Login"; 
	$username=isset($_SESSION['user_name']) ? $_SESSION['user_name'] : "";
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
				$("#user_name").focus();
			}
		);
		
		function log_in_click()
		{
			if(document.getElementById("user_name").value=="")
			{
				alert("Please enter username!");
				document.getElementById("user_name").focus();
				return null;
			}
			
			if(document.getElementById("pass_word").value=="")
			{
				alert("Please enter password!");
				document.getElementById("pass_word").focus();
				return null;
			}
			document.getElementById("myform").submit();
			
		
		}
	</script>
    
     <?php 
	if(isset($_SESSION['message']))
	{
		?>
        	<p class="<?php echo $_SESSION['messagetype']; ?>"><?php echo $_SESSION['message']; ?></p>
        <?php
		unset($_SESSION['message'], $_SESSION['messagetype']);
	}
 ?>
 
    <form action="login.php" method="post" id="myform">
    	<table align="center" cellpadding="10px" cellspacing="1px" id="data_table">
        	<tr>
            	<td>username</td>
                <td><input name="user_name" type="text" id="user_name" value="<?php echo $username ?>" autocomplete="off" /></td>
            </tr>
            
            <tr>
            	<td>password</td>
                <td><input name="pass_word" type="password" id="pass_word" /></td>
            </tr>
            
            <tr>
                <td colspan="2" align="center"><input type="button" value="Login" onclick="log_in_click()"/></td>
            </tr>
        </table>
    </form>
  <!-- InstanceEndEditable --></div>
</body>
<!-- InstanceEnd --></html>