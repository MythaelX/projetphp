var complete;

function showEntry(id){
	ajaxRequest("POST", "./php/request.php/show", function(val){}, "id_param="+id, false);
	
	location.reload();
}

function editEntry(id){
	ajaxRequest("POST", "./php/request.php/edit", function(val){}, "id_param="+id+"&action=update", false);
	
	location.reload();
}

function deleteEntry(id){
	var r = window.confirm("Êtes-vous sûr de vouloir supprimer ce Paramètre ?");
	if(r == false){
		return;
	}
	
	ajaxRequest("POST", "./php/request.php/delete", function(val){}, "id_param="+id, false);
	
	location.reload();
}

function unsetSession(){
	ajaxRequest("POST", "./php/request.php/unset", function(){}, "", false);
}

function completeForm(){
	if(!isset(complete)){ return; }
	if(complete != true){ return; }
	
	$("#libelle").val(libelle);
	$("#corde").val(corde);
	$("#tmax").val(tmax);
	$("#fmax").val(fmax);
	$("#nb_points").val(nbpts);
}

addOnload(completeForm);
