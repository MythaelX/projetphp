/*****************************************************************************************************************
**																												**
**							Implémentation d'un chat sur le site												**
**																												**
**							Un objet avec l'id tchat															**
**							Attributs ;																			**
**								textbefore -> placeholder du input text											**
**								buttonvalue -> valeur du bouton d'envoie										**
**																												**
*****************************************************************************************************************/

'use strict';

var tchatContainer;
var tchatTextZone;
	var tchatChildType = "li";
var tchatSendZone;
	var tchatTextToSend;
	var tchatButton;
	
function tchatChildCreator(text){
	var child = document.createElement(tchatChildType);
	child.innerHTML = text;
	
	return child;
}

function tchatAddAnswer(text){
	var tchatChild = tchatChildCreator(text);
	
	tchatChild.setAttribute("class", "bot");
	
	putTchatChild(tchatChild);
}

function tchatAddQuestion(text){
	var tchatChild = tchatChildCreator(text);
	
	tchatChild.setAttribute("class", "human");
	
	putTchatChild(tchatChild);
}

function putTchatChild(child){
	tchatTextZone.appendChild(child);
	scrollToEnd(tchatTextZone);
}

function initTchat(){
	/* Initialisation des variables */
	tchatContainer = document.getElementById("tchat");
	
	tchatContainer.innerHTML = "";
	
	tchatTextZone = document.createElement("ul");
		tchatTextZone.style.overflowY = "scroll";
	tchatSendZone = document.createElement("div");
		tchatSendZone.style.textAlign = "center";
		tchatTextToSend = document.createElement("input");
			tchatTextToSend.style.width = "75%";
			tchatTextToSend.style.margin = "0";
		tchatButton = document.createElement("button");
			tchatButton.style.width = "20%";
			tchatButton.style.margin = "0";
	
	/* Création des variables */
	tchatTextZone.id = "tchat_text_zone";
	
	tchatSendZone.id = "tchat_send_zone";
	
		tchatButton.innerHTML = tchatContainer.getAttribute("buttonvalue");
		tchatButton.setAttribute("onclick", "tchatSend();");
		tchatButton.id = "tchat_button";
	
		tchatTextToSend.placeholder = tchatContainer.getAttribute("textbefore");
		tchatTextToSend.setAttribute("onkeypress", "if(event.keyCode == 13){ tchatSend(); }");
		tchatTextToSend.setAttribute("autofocus", "");
		tchatTextToSend.id = "tchat_text_to_send";
	
	/* Mise en place des enfants */
	tchatContainer.appendChild(tchatTextZone);
	tchatContainer.appendChild(tchatSendZone);
		tchatSendZone.appendChild(tchatTextToSend);
		tchatSendZone.appendChild(tchatButton);
	
	/* Affichage du bonjour */
	ajaxRequest("GET", "PHPClass/tchat.php/start", function(val){
		tchatAddAnswer(val);
	});
}

function tchatSend(){
	var tchatText = tchatTextToSend.value;
	tchatTextToSend.value = "";
	
	if(tchatText == "")
		return;
	
	tchatAddQuestion(tchatText);
	ajaxRequest("POST", "PHPClass/tchat.php/talk", function(val){
		tchatAddAnswer(val);
	}, "text="+tchatText);
}

initTchat();
