/********************************************************************************/
/*                                                                              */
/*      Créé par Mathias Cabioch-Delalande le 11/02/2018                        */
/*      Au chargement de la page, ajoute des étoiles pour choisir une note      */
/*      La valeur des étoiles est dans un input hidden                          */
/*         avec pour id starInput et pour name stars                            */
/*                                                                              */
/********************************************************************************/

var starParent;
var stars;
var input;
var path;

function initStars(){
	starParent = document.getElementById("stars");
	
	if(!starParent){
		return;
	}
	
	var scripts = document.getElementsByTagName("script");
	
	for(var i = 0; i < scripts.length; i++){
		var script = scripts[i];
		var pos;
		
		if((pos = (script.src).search("stars/stars.js")) != -1){
			path = (script.src).substring(0, pos);
		}
	}
	
	createStars();
	input = document.getElementById("starInput");
}

function createStars(){
	var link = document.createElement("link");
	var head = document.getElementsByTagName("head")[0];
	
	link.rel = "stylesheet";
	link.href = path+"stars/stars.css";
	
	head.appendChild(link);
	
	var code = "";
	
	for(var i = 0; i < 5; i++){
		var a = i+0.5;
		var b = i+1;
		
		code += "<img src=\""+path+"stars/img/starLV.png\" alt=\"left star "+b+"\" onmouseover=\"enlight("+a+");\" onmouseout=\"envoid();\" onclick=\"choose("+a+");\" class=\"starChoice\" />";
		code += "<img src=\""+path+"stars/img/starRV.png\" alt=\"right star "+b+"\" onmouseover=\"enlight("+b+");\" onmouseout=\"envoid();\" onclick=\"choose("+b+");\" class=\"starChoice\" />";
	}
	
	code += "\n<input type=\"hidden\" value=0 name=\"stars\" id=\"starInput\" />";
	
	starParent.innerHTML = code;
	
	listImgs();
}

var change = 1;

function listImgs(){
	var imgs = document.getElementsByTagName("img");
	stars = new Array();
	
	for(var i = 0; i < imgs.length; i++){
		if(imgs[i].className == "starChoice"){
			stars[stars.length] = imgs[i];
		}
	}
}

function enlight(val){
	var index = (val * 2);
	
	for(var i = 0; i < index; i++){
		stars[i].src = (stars[i].src).replace("V", "P");
	}
	
	change = 1;
}

function envoid(){
	if(change){
		for(var i = 0; i < stars.length; i++){
			stars[i].src = (stars[i].src).replace("P", "V");
		}
	}
}

function choose(val){
	var index = (val * 2);
	
	for(var i = 0; i < index; i++){
		stars[i].src = (stars[i].src).replace("V", "P");
	}
	
	input.value = val;
	
	change = 0;
}

initStars();
