// Ajax Helpers
function getAjax(){
	if (window.XMLHttpRequest) {
	  return new XMLHttpRequest();
	}
	else {
	  return new ActiveXObject("Microsoft.XMLHTTP");
	}
}

function setAjaxSuccess(ajax, func){
	ajax.onreadystatechange=function(){
		  if (ajax.readyState==4 && ajax.status==200){
			  var response = eval('(' + ajax.responseText + ')');
			  if (response.status == "ok"){
				  func(response);
			  } else {
				  alert(response.message);
			  }
		  }
	}
}

// Adding new item to Todo list
var addbtn = document.getElementById("addbtn");

function addNewTodo(){
	var txt = document.getElementById("addtolist");
	
	addbtn.disabled=true;
	ajax = getAjax();
	
	var params = "command=add&text="+txt.value;
	ajax.open("POST", "ajax.php", true);

	ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajax.setRequestHeader("Content-length", params.length);
	ajax.setRequestHeader("Connection", "close");
	
	setAjaxSuccess(ajax, function(response){
		document.getElementById("todolist").innerHTML = response.todolist;
		document.getElementById("addtolist").value = "";
		addbtn.disabled=false;
	} );
	
	ajax.send(params);
}
	
if (addbtn.addEventListener)
	addbtn.addEventListener("click", addNewTodo,false);
else
	addbtn.attachEvent("onclick",addNewTodo);


// Change the "done" status of item
function doItem(id, value){
	ajax = getAjax(); 
	
	setAjaxSuccess(ajax, function(response){
		document.getElementById("todolist").innerHTML = response.todolist;
  		document.getElementById("hasdonelist").innerHTML = response.hasdonelist;
	} );
	
	ajax.open("GET","ajax.php?command=doitem&id="+id+"&value="+value,true);
	ajax.send();
}


// Delete Todo Item
function deleteItem(id){
	if (confirm("Are you sure you want to delete this item?")){
		ajax = getAjax(); 
		
		setAjaxSuccess(ajax, function(response){
			document.getElementById("todolist").innerHTML = response.todolist;
	  		document.getElementById("hasdonelist").innerHTML = response.hasdonelist;
		} );
		ajax.open("GET","ajax.php?command=deleteitem&id="+id,true);
		ajax.send();
	}
}

// Edit Todo Item
function editItem(id, message){
	var newMessage = prompt("Please Enter New Message:", message)
	if (newMessage){
		ajax = getAjax(); 
		
		var params = "command=edit&text="+newMessage+"&id="+id;
		ajax.open("POST", "ajax.php", true);
	
		ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajax.setRequestHeader("Content-length", params.length);
		ajax.setRequestHeader("Connection", "close");
		
		setAjaxSuccess(ajax, function(response){
			document.getElementById("todolist").innerHTML = response.todolist;
	  		document.getElementById("hasdonelist").innerHTML = response.hasdonelist;
		} );
		ajax.send(params);
	}
}


