$(function(){
	friListClick();
});

function tan(){
	alert("login fail, please try again!");
}

function friListClick(){
	$(".friendLi").click(function(){
		var isopen=$(this).attr("isopen");
		if (isopen=="yes") {
			return;
		};
		$(".friendLi").attr("isopen","no");
		$(this).attr("isopen","yes");
		var friendNoteName=$(this).attr("friendNoteName");
		var friendid=$(this).attr("friendid");
		$("#chatTitle").html( ""+ friendNoteName + "");
		$("#chatArea").show();
		$(".btnSend").attr("friendid");
	});

	$(".btnSend").click(function(){
		var msg=$(".chatinput").val();
		if (msg=="") {
			return;
		};
		//将消息插入到数据库
		var receiverid=$(this).parent().parent().prev().find("#offlineFriendList").find(".friendLi").attr("friendid");
		var senderid=$(".info").attr("senderid");
		$.ajax({
			type:"POST",
			url:"include/ajax.php",
			data:{flag:'sendmsg',msg:msg,senderid:senderid,receiverid:receiverid},
			success:function(res){
				alert(res);
			}
		});
	});
	
}


