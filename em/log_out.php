<?php
	session_start();
	
	unset($_SESSION['current_user_category'], $_SESSION['current_user_full_name'], $_SESSION['current_user'], $_SESSION['start_time']);
	session_destroy();
	header("location: index.php");
	exit();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>