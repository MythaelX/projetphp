function showEntry(id){
	ajaxRequest("POST", "./php/request.php/show", function(val){
		console.log(val);
	}, "id_param="+id, false);
	
	location.reload();
}

function editEntry(id){
	ajaxRequest("POST", "./php/request.php/edit", function(val){
		console.log(val);
	}, "id_param="+id, false);
	
	location.reload();
}

function deleteEntry(id){
	ajaxRequest("POST", "./php/request.php/delete", function(val){
		console.log(val);
	}, "id_param="+id, false);
	
	location.reload();
}

function unsetSession(){
	ajaxRequest("POST", "./php/request.php/unset", function(){}, "", false);
}

function completeForm(){
	if(complete != true){ return; }
	
	console.log(libelle + " et " + corde + " et " + tmax + " et " + fmax + " et " + nbpts + " et " + inter);
	
}

completeForm();
