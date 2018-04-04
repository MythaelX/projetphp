'use strict';

var errorDiv = document.getElementById("errors");
var divErrorsClass = "container";

function httpErrors(errorNumber, errorText){
	var out = "<b>Error</b> : ";
	
	if(!errorDiv){
		errorDiv = document.createElement("div");
		document.getElementsByTagName("body")[0].insertAdjacentElement("afterbegin", errorDiv);
	}
	errorDiv.style.display = "inline-block";
	
	out += errorNumber + " - " + errorText;
	switch(errorNumber){
		case 401:
		case 403:
		case 405:
		case 406:
		case 500:
		case 501:
		case 520:
			errorDiv.style.backgroundImage = "";
			errorDiv.style.color = "";
			errorDiv.setAttribute("class", divErrorsClass+" alert alert-danger");
			break;
		case 418:
			errorDiv.style.backgroundImage = "linear-gradient(#ff72c4, #ff3697)";
			errorDiv.style.color = "yellow";
			errorDiv.setAttribute("class", divErrorsClass+" alert");
			break;
		default:
			errorDiv.style.backgroundImage = "";
			errorDiv.style.color = "";
			errorDiv.setAttribute("class", divErrorsClass+" alert alert-warning");
			break;
	}
	errorDiv.innerHTML = out;
}

function httpSuccess(){
	if(!errorDiv){
		errorDiv = document.createElement("div");
		document.getElementsByTagName("body")[0].insertAdjacentElement("afterbegin", errorDiv);
	}
	errorDiv.style.display = "none";
}

function ajaxRequest(type, request, callback, data = null, async = true){
	if((type == "POST" || type == "PUT") && data == null){
		console.log("Please put datas to be sended with this protocol");
		return;
	}
	
	var xhr;
	var auth = 0;
	xhr = new XMLHttpRequest();
	
	if(type == "AUTH"){
		type = "GET";
		auth = 1;
	}
	
	if((type == "GET" || type == "DELETE") && data != null){
		if(!auth){
			request += "?" + data;
		}
	}
	
	xhr.open(type, request, async);
	xhr.setRequestHeader('Authorization', 'Bearer ' + Cookies.get('token'));
	
	if(type == "POST" || type == "PUT"){
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	}
	if(auth){
		if(Cookies.get('token')){} else {
			xhr.setRequestHeader('Authorization', 'Basic ' + btoa(data));
		}
	}
	
	xhr.onload = function(){
		switch(xhr.status){
			case 200:
			case 201:
				httpSuccess();
				callback(xhr.responseText);
				break;
			default:
				httpErrors(xhr.status, xhr.statusText);
		}
	};
	
	if(type == "GET" || type == "DELETE"){
		xhr.send(null);
	} else if(type == "POST" || type == "PUT"){
		xhr.send(data);
	}
}
