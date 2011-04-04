$(document).ready(function(){
	var user_id = $("#user_id").val();
	var ajaxURL = "./action/ajax.php?userID="+user_id;
	
	$("#signup_username").change(function(){
		$("#user_error").load(ajaxURL+"&command=checkname&n="+$("#signup_username").val());
	});
	
	$("#signout_btn").html("<button>sign out</button>");
	$("#todolist").load(ajaxURL+"&command=loadList&todo=todo");
	$("#hasdonelist").load(ajaxURL+"&command=loadList");
	
	$("#addform").attr("action","javascript:void(0)");
	
	$("#addbtn").click(function(){
		$.ajax({
			url:ajaxURL+"&command=add",
			type:"post",
			data:"txt="+$("#addtolist").val(),
			success:function(response){$("#todolist").html(response);$("#addtolist").val("");}
		});
	});
	
	$("#todolist,#hasdonelist").delegate("button","click",function(){
		var f = $(this).attr("name").split(',');
		var command = f[0];
		var id = f[1];
		var cb = function(response){
			$("#todolist").html(response.todo);
			$("#hasdonelist").html(response.hasdone);
		};
		if (command=="delete"){
			$.ajax({url:ajaxURL+"&command=delete&id="+id,success:cb, dataType:"json"});
		} else {
			var newMessage = prompt("Enter New Message:",$(this).val());
			if (newMessage){
				$.ajax({
					url:ajaxURL+"&command=edit&id="+id,
					type:"post",
					data:"txt="+newMessage,
					success:cb,
					dataType:'json'
				});
				
			}
			
		}
	});
	
	$("#todolist,#hasdonelist").delegate("input","change",function(){
		var cb = function(response){
			$("#todolist").html(response.todo);
			$("#hasdonelist").html(response.hasdone);
		};
		$.ajax({
			url:ajaxURL+"&command=toggle&check="+$(this).attr('checked')+"&id="+$(this).val(),
			success:cb,
			dataType:'json'
		});
	});
});