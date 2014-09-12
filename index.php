<?php
	include_once "include/ez_sql_core.php";
	include_once "include/ez_sql_mysql.php";
	session_start();
	$userid =isset($_POST["userid"])?$_POST["userid"]:"";
	$userpwd =isset($_POST["userpwd"])?$_POST["userpwd"]:"";
	if($userid != "" && $userpwd != ""){
		$db = new ezSQL_mysql();
		$sql = "select * from userinfo where id= '" . $userid . "' and userpwd= '" . $userpwd . "' ";
		$res = $db->get_row($sql);
		if (!$res) {
			header("location:login.php?error=wrongpwd");
			die();
		}
		else{
			//写入session
			$_SESSION["wodeid"] = $userid;
			$_SESSION["wodenicheng"] = $res->userNickname;
			//echo "welcome" . $res->userNickname;
		}
	}

	$curid =isset($_SESSION["wodeid"])?$_SESSION["wodeid"]:"";
	$curnicheng =isset($_SESSION["wodenicheng"])?$_SESSION["wodenicheng"]:"";
	if ($curid == "") {
		//header("location:login.php?error=needlogin");
		//die();
	}else{
		echo "welcome" . $curnicheng;
	}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<link rel="stylesheet" type="text/css" href="css/index.css">
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/index.js"></script>
	<title>无标题</title>
</head>
<body>
	<a class="logout" href="login.php?logout=yes">logout</a>
	<div id="friendList">
		<ul id="onlineFriendList">
			<?php
				$db = new ezSQL_mysql();
				$res=$db->get_results("select * from userinfo,friendsinfo where userinfo.id=friendsinfo.friendid and friendsinfo.userid=$curid");
				$onlineHtml="";
				$offlineHtml="";
				if ($res) {
					foreach ($res as $friend) {
						$headimgurl=$friend->userHeadImage;
						$friendnicheng=$friend->friendNoteName;
						if ($friend->userState=="online") {
							$onlineHtml .="<li friendid=$friend->id friendNoteName=$friendnicheng class='friendLi'><img src='$headimgurl' class='friendImg' /><a class='friendnicheng'>$friendnicheng</a></li>";
						}else{
							$offlineHtml .="<li friendid=$friend->id friendNoteName=$friendnicheng class='friendLi'><img src='$headimgurl' class='friendImg offlinePic' /><a class='friendnicheng'>$friendnicheng</a></li>";
						}
					}
				}
				echo $onlineHtml;
			?>
		</ul>
		<ul id="offlineFriendList">
			<?php
				echo $offlineHtml;
			?>
		</ul>
	</div>
	<div id="chatArea">
		<div id="chatTitle"></div>
		<div id="chatHistory"></div>
		<div id="chatBar">
			<input class="chatinput" maxlength="4000" />
			<div class="btnSend">send</div>
		</div>
	</div>
	<div class="info" senderid="<?php echo $curid;?>"></div>

	
</body>
</html>

