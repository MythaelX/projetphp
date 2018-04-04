var GALLERY_MARGE_OBJS = 10;
var GALLERY_INTERVAL = false;
var GALLERY_INITIATED = false;
var GALLERY_INTERVAL_INITIATED;
var GALLERY;

function initGalleries(val){
	var galleries = document.getElementsByClassName("gallery");
	
	for(var i = 0; i < galleries.length; ++i){
		var g = galleries[i];
		
		createGallery(g);
	}
}

function createGallery(g){
	/* Initialisation de la gallery externe */
		GALLERY = g;
		
		g.style.display = "inline-block";
	
		g.style.position = "relative";
		g.style.left = "50%";
	
		g.style.width = "80%";
		g.style.transform = "translateX(-50%)";
		
		g.style.border = "2px black solid";
	
		g.style.overflow = "hidden";
		
		g.setAttribute("onmouseover", "showArrows(this);");
		g.setAttribute("onmouseout", "hideArrows(this);");
		g.setAttribute("contain", "0");
	/****************************************/
	
	var gContent = document.createElement("div");
	
	if(!getWidth(g)){
		return;
	}

	var children = g.childNodes;
	var length = g.childNodes.length;
	var childW = 0;
	
	var bodyW = getWidth(document.getElementsByTagName("body")[0]);
	var askedW = parseInt(g.style.width) / 100;
	var rectCoef = 1 - (5/100);
	
	var parentWidth = parseInt(bodyW * askedW * rectCoef);
	var wantedWidth = parseInt(g.getAttribute("width")) / 100;
	wantedWidth *= parentWidth;
	
	for(var i = length-1; i >= 0; --i){
		var childContainer = document.createElement("div");
		var child = children[i];
		if(!child)
			continue;
		
		/* Vérifications */
			if(child.toString() === "[object Text]" || child.toString() === "[object Comment]"){
				continue;
			}
			//<img> [object HTMLImageElement]
			
			childContainer.style.display = "inline-block";
			child.style.display = "inline-block";
			if(!getWidth(child) || !getHeight(child)){
				return;
			}
		/******************/
		/* Modifications de l'enfant */
			//console.log(child.src + " -> " + getWidth(child) + " >? " + getHeight(child));
			if(getWidth(child) > getHeight(child)){
				child.style.width = "100%";
			} else {
				child.style.height = "100%";
			}
		/*****************************/
		/* Modifications du conteneur de l'enfant */
			childContainer.style.height = "100%";
			childContainer.style.width = wantedWidth + "px";
			childContainer.style.verticalAlign = "top";
			childContainer.style.textAlign = "center";
			
			if(i-1 >= 0){
				childContainer.style.marginRight = GALLERY_MARGE_OBJS + "px";
			}
		/*****************************/
		childW += getWidth(child);
		childContainer.appendChild(child);
		gContent.appendChild(childContainer);
	}
	g.setAttribute("contains", gContent.childNodes.length);
	childW += 30;
	
	/* Ajout d'un enfant intermédiaire */
		gContent.style.display = "inline-block";
		
		if(!childW){
			gContent.style.width = "auto";
			return;
		} else {
			gContent.style.width = (gContent.childNodes.length * (wantedWidth + GALLERY_MARGE_OBJS)) + "px";
			GALLERY_INITIATED = true;
			clearInterval(GALLERY_INTERVAL_INITIATED);
		}
		gContent.style.height = "100%";
		
		gContent.style.position = "absolute";
		gContent.style.top = "0";
		gContent.style.left = "0";
		
		g.innerHTML = "";
		g.appendChild(gContent);
	/***********************************/
	/* Création des flèches */
		var right = document.createElement("div");
		var left = document.createElement("div");
		
		var gradients = "rgba(255, 255, 255, 0.1), rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.9)";
		
		/* Left arrow */
			var lArrow = document.createElement("p");
			lArrow.innerHTML = "&#9664;";
			
			left.style.left = "0";
			left.style.backgroundImage = "linear-gradient(to left, " + gradients + ")";
			left.className = "left_arrow";
			
			createGalleryArrow(left, lArrow);
		/**************/
		/* Right arrow */
			var rArrow = document.createElement("p");
			rArrow.innerHTML = "&#9654;";
			
			right.style.right = "0";
			right.style.backgroundImage = "linear-gradient(to right, " + gradients + ")";
			right.className = "right_arrow";
			
			createGalleryArrow(right, rArrow);
		/***************/
		
		g.appendChild(right);
		g.appendChild(left);
	/************************/
	
	/* Vérifications en cas de liens */
		var galleryLinks = gContent.getElementsByTagName("a");
		
		for(var i = galleryLinks.length-1; i >= 0; --i){
			var link = galleryLinks[i];
			if(!link)
				continue;
				
			var children = link.childNodes;
			
			for(var j = children.length-1; j >= 0; --j){
				var child = children[j];
				
				/* Vérifications */
					if(child.toString() !== "[object HTMLImageElement]"){
						continue;
					}
				/*****************/
			
				child.style.width = "100%";
				child.style.height = "100%";
			}
		}
	/*********************************/
}

function createGalleryArrow(parent, arrow){
	arrow.style.display = "inline-block";
			
	arrow.style.margin = "0";
	arrow.style.padding = "0";
	
	arrow.style.fontWeight = "bold";
	arrow.style.fontSize = "2em";
	
	arrow.style.position = "absolute";
	arrow.style.top = "50%";
	arrow.style.left = "50%";
	
	arrow.style.transform = "translate(-50%, -50%)";
	
	arrow.style.opacity = "0.8";
	
	parent.appendChild(arrow);
	
	parent.style.display = "none";
	
	parent.style.position = "absolute";
	parent.style.top = "0";
	
	parent.style.height = "100%";
	parent.style.paddingLeft = "2em";
	parent.style.paddingRight = "2em";
	
	parent.style.zIndex = "666";
	
	parent.style.color = "white";
	
	parent.style.cursor = "pointer";
	
	parent.setAttribute("onclick", "moveGallery(this);");
}

function showArrows(el){
	var divs = el.getElementsByTagName("div");
	
	var ra = divs[divs.length-1];
	var la = divs[divs.length-2];
	
	ra.style.display = "inline-block";
	la.style.display = "inline-block";
}

function hideArrows(el){
	var divs = el.getElementsByTagName("div");
	
	var ra = divs[divs.length-1];
	var la = divs[divs.length-2];
	
	ra.style.display = "none";
	la.style.display = "none";
}

function moveGallery(el){
	var className = el.className;
	var g = el.parentNode;
	var content = g.getElementsByTagName("div")[0];
	var objs = content.childNodes;
	var index = parseInt(g.getAttribute("contain"));
	
	var acto = objs[index];
	var timer = 0;
	var adder = 2;
	
	if(className == "right_arrow"){
		/*if(index + 2 >= objs.length){
			return;
		}*/
		
		console.log(content + " -> " + onWindowLeft(content) + " + " + getWidth(content) + " = " + (onWindowLeft(content) + getWidth(content)) + " =? " + getWidth(g));
		
		if((parseInt(content.offsetLeft) + parseInt(getWidth(content))) <= parseInt(getWidth(g))){
			return;
		}
		
		if(GALLERY_INTERVAL){
			return;
		} else {
			GALLERY_INTERVAL = true;
		}
		
		var i = acto.offsetLeft;
		var lim = parseInt(acto.offsetLeft) + parseInt(getWidth(acto)) + GALLERY_MARGE_OBJS;
		
		var inter = setInterval(galleryGoTo, timer);
		g.setAttribute("contain", (index+1));
		
		function galleryGoTo(){
			if(i > lim){
				clearInterval(inter);
				GALLERY_INTERVAL = false;
			}
			
			content.style.left = "-" + i + "px";
			i += adder;
		}
	} else {
		if(index <= 0){
			if(GALLERY_INTERVAL){
				clearInterval(inter);
				GALLERY_INTERVAL = false;
			}
			
			return;
		}
		
		if(parseInt(content.style.left) >= 0){
			if(GALLERY_INTERVAL){
				clearInterval(inter);
				GALLERY_INTERVAL = false;
			}
			
			return;
		}
		
		if(GALLERY_INTERVAL){
			return;
		} else {
			GALLERY_INTERVAL = true;
		}
		
		var preco = objs[index-1];
		
		var i = acto.offsetLeft;
		var lim = parseInt(acto.offsetLeft) - GALLERY_MARGE_OBJS;
		
		if(index > 0){
			lim -= parseInt(objs[index-1].offsetWidth);
		}
		
		var inter = setInterval(galleryGoTo, timer);
		g.setAttribute("contain", (index-1));
		
		function galleryGoTo(){
			if(i < lim){
				clearInterval(inter);
				GALLERY_INTERVAL = false;
			}
			
			content.style.left = "-" + i + "px";
			i -= adder;
		}
	}
}

GALLERY_INTERVAL_INITIATED = setInterval(initGalleries, 100);
initGalleries();
//setTimeout(initGalleries, 500);
