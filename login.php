<?php
	session_start();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<script type="text/javascript" src="js/index.js"></script>
	<title>无标题</title>
</head>
<body>
	<form action="index.php" method="post">
		<input name="userid" type="text" id="txtUserid"/>
		<input name="userpwd" type="password" id="txtUserPwd"/>
		<input type="submit" value="登录" />
	</form>
<?php
	$info = isset($_GET["error"])?$_GET["error"]:"";
	$logout = isset($_GET["logout"])?$_GET["logout"]:"";
	if ($info == "wrongpwd") {
		echo "<script>tan();</script>";
	}
	if ($logout =="yes") {
		unset($_SESSION["wodeid"]);
		unset($_SESSION["wodenicheng"]);
	}
?>
</body>
</html>