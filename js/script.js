'use strict';

function placeFooter(){
	var footer = document.getElementsByTagName("footer")[0];
	var main = document.getElementsByTagName("main")[0];
	
	main.style.marginBottom = (getHeight(footer)*2) + "px";
}

addOnload(placeFooter);
