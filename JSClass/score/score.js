function polarToCartesian(centerX, centerY, radius, angleInDegrees) {
	var angleInRadians = (angleInDegrees-90) * Math.PI / 180.0;

	return {
		x: centerX + (radius * Math.cos(angleInRadians)),
		y: centerY + (radius * Math.sin(angleInRadians))
	};
}

var svgNS = "http://www.w3.org/2000/svg";

var danger = "#F16328";
var warning = "#F6BB45";
var info = "#68B3C8";
var success = "#0f0";

function createBackScore(el, w, h, deg){
	deg = parseInt(deg);
	var sa = 180 + ((360 - deg) / 2);
	var ea = 180 + ((360 + deg) / 2);
	
	var we = 8;
	
	var r = w / 2 - we;
	
	var x = w / 2 + we/4;
	var y = h / 2 - we/2;
	
	var start = polarToCartesian(x, y, r, sa);
    var end = polarToCartesian(x, y, r, ea);
    var largeArcFlag = ea - sa <= 180 ? "0" : "1";
    
    var d = [
        "M", start.x, start.y, 
        "A", r, r, 0, largeArcFlag, 1, end.x, end.y
    ].join(" ");
    
    var path = document.createElementNS(svgNS, "path");
    
    path.setAttribute("d", d);
    path.setAttribute("fill", "none");
    path.setAttribute("stroke", "#F0F0F0");
    path.setAttribute("stroke-width", we+2);
    
    el.appendChild(path);
}

function createRound(el, w, h, min, max, n, deg){
	deg = parseInt(deg);
	var sa = 180 + ((360 - deg) / 2);
	var ea = 180 + ((360 + deg) / 2);
	
	var r = (n / max);
	var ca = (ea - sa) * r + sa;
	
	var we = 8;
	
	var rad = w / 2 - we;
	
	var x = w / 2 + we/4;
	var y = h / 2 - we/2;
	
	var start = polarToCartesian(x, y, rad, ca);
    var end = polarToCartesian(x, y, rad, sa);
    var largeArcFlag = ca - sa <= 180 ? "0" : "1";
    
    var d = [
        "M", start.x, start.y, 
        "A", rad, rad, 0, largeArcFlag, 0, end.x, end.y
    ].join(" ");
    
    var color;
    
    if(r <= 0.3){
    	color = danger;
    } else if(r <= 0.5){
    	color = warning;
    } else if(r < 0.85){
    	color = info;
    } else {
    	color = success;
    }
    
    var path = document.createElementNS(svgNS, "path");
    
    path.setAttribute("d", d);
    path.setAttribute("fill", "none");
    path.setAttribute("stroke", color);
    path.setAttribute("stroke-width", we);
    
    el.appendChild(path);
}

function createScore(el, w, h, min, max, n, r, d){
	el.style.position = "relative";
	el.style.width = w + "px";
	el.style.height = h + "px";
	
	/* SVG */
		var svg = document.createElementNS(svgNS, "svg");
	
		svg.setAttribute("width", w);
		svg.setAttribute("height", h);
		
		svg.style.position = "absolute";
		svg.style.top = "50%";
		svg.style.left = "50%";
		
		svg.style.transform = "translate(-50%, -50%)";
		
		createBackScore(svg, w, h, d);
		createRound(svg, w, h, min, max, n, d);
		
		el.appendChild(svg);
	/*******/
	/* P */
		var p = document.createElement("p");
	
		p.style.display = "intline-block";
		
		p.style.margin = "0";
		p.style.padding = "0";
	
		p.style.fontSize = (w/5) + "px";
	
		p.style.position = "absolute";
		p.style.top = "50%";
		p.style.left = "50%";
		
		p.style.transform = "translate(-50%, -50%)";
	
		if(r <= 0.3) {
			p.style.color = danger;
		} else if(r <= 0.5) {
			p.style.color = warning;
		} else if(r < 0.85) {
			p.style.color = info;
		} else {
			p.style.color = success;
		}
		
		p.innerHTML = n + "/" + max;
		
		el.appendChild(p);
	/*****/
}

function initScore(){
	var scores = document.getElementsByClassName("score");
	
	if(!scores){
		return;
	}
	
	for(var i = 0; i < scores.length; ++i){
		var score = scores[i];
		
		var w = score.getAttribute("width");
		var h = score.getAttribute("height");
		
		var min = score.getAttribute("min");
		var max = score.getAttribute("max");
		var note = score.getAttribute("note");
		var ratio = note / (max - min);
		
		var deg = score.getAttribute("degre");
		
		createScore(score, w, h, min, max, note, ratio, deg);
	}
}

initScore();
