/************************************************************************************/
/*																					*/
/*					File : _script.js												*/
/*						Created by Mathias CABIOCH-DELALANDE						*/
/*							Last modification : 21/04/2018							*/
/*																					*/
/*						Authorization : use only									*/
/*																					*/
/************************************************************************************/

'use strict';

/* Selector as in JQuery */
var $ = function(selector){
	return document.querySelector(selector);
}

/* Adding a css stylesheet to the page */
function addCss(script, css){
	var link = document.createElement("link");
	var head = document.getElementsByTagName("head")[0];
	
	link.rel = "stylesheet";
	link.href = getPath(script)+css;
	
	head.appendChild(link);
}

/* Getting the path of the page with the path written in the script tag */
function getPath(shape){
	var scripts = document.getElementsByTagName("script");
	var path = "";
	
	for(var i = 0; i < scripts.length; i++){
		var script = scripts[i];
		var pos;
		
		if((pos = (script.src).search(shape)) != -1){
			path = (script.src).substring(0, pos);
		}
	}
	
	return path;
}

/* Creat a random string of the specified size */
var randStr = function randStr(nb){
    var list = new Array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z", "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z","0","1","2","3","4","5","6","7","8","9", " ", "", ".", ",", "?", "!", ":", ";");
    var str ='';
    for(var i = 0; i < nb; i++)
    	str = str + list[Math.floor(Math.random()*list.length)];
    	
    return str;
}

/* Get the dimensions of elements */
	/* Get the dimensions of the window */
		function windowHeight(){
			var w = window,
				d = document,
				e = d.documentElement,
				g = d.getElementsByTagName('body')[0],
				y = parseInt(w.innerHeight || e.clientHeight || g.clientHeight);
	
			if(isNaN(y))
				return 0;
	
			return y;
		}
		function windowWidth(){
			var w = window,
				d = document,
				e = d.documentElement,
				g = d.getElementsByTagName('body')[0],
				x = parseInt(w.innerWidth || e.clientWidth || g.clientWidth);
	
			if(isNaN(x))
				return 0;
	
			return x;
		}
	/************************************/

	/* Get an element dimension */
	function getHeight(e){
		var out = parseInt(e.clientHeight || e.offsetHeight);
		return (isNaN(out))?0:out;
	}
	function getWidth(e){
		var out = parseInt(e.clientWidth || e.offsetWidth);
		return (isNaN(out))?0:out;
	}
	/************************************/
/**********************************/

/* Get the positions of an element */
	function getTop(e){
		var out = parseInt(e.clientTop || e.offsetTop);
		return (isNaN(out))?0:out;
	}
	function getBottom(e){
		var out = parseInt(e.clientBottom || e.offsetBottom);
		return (isNaN(out))?0:out;
	}

	function getLeft(e){
		var out = parseInt(e.clientLeft || e.offsetLeft);
		return (isNaN(out))?0:out;
	}
	function getRight(e){
		var out = parseInt(e.clientRight || e.offsetRight);
		return (isNaN(out))?0:out;
	}
/***********************************/

/* Get the positions of an element from the window */
	function onWindowTop(e){
		if(!e){
			return 0;
		}
		return getTop(e) + onWindowTop(e.parentNode);
	}
	function onWindowBottom(e){
		if(!e){
			return 0;
		}
		return getBottom(e) + onWindowBottom(e.parentNode);
	}

	function onWindowLeft(e){
		if(!e){
			return 0;
		}
		return getLeft(e) + onWindowLeft(e.parentNode);
	}
	function onWindowRight(e){
		if(!e){
			return 0;
		}
		return getRight(e) + onWindowRight(e.parentNode);
	}
/***************************************************/

/* Function to verify the scroll position of an element */
	function getScrollTop(){
		return parseInt(document.documentElement.scrollTop || document.body.scrollTop);
	}
	function getScrollLeft(){
		return parseInt(document.documentElement.scrollLeft || document.body.scrollLeft)
	}
/********************************************************/

/* Add an ease-out effect to scroll to a position where a link point to */
	document.addEventListener('DOMContentLoaded', function() {
		var links = document.querySelectorAll('a[href*="#"]');
		for(var i = 0, len = links.length; i < len; ++i) {
			links[i].onclick = function(){
				if(location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
					var target = this.getAttribute("href").slice(1);
					if(target.length) {
						scrollTo(getOffsetTop(document.getElementById(target)), 1500);
						return false;
					}
				}
			};
		}
	});
/************************************************************************/

/* Function to simulate a scroll */
	function scrollTo(el, duration) {
		var e = document.documentElement;
	
		if(getScrollTop() === 0){
			var t = getScrollTop();
			++e.scrollTop;
			e = t+1 === e.scrollTop--?e:document.body;
		}
	
		scrollToC(e, e.scrollTop, el, duration);
	}

	function scrollToC(el, from, to, duration) {
		if (duration < 0) return;
		if(typeof from === "object") from = from.offsetTop;
		if(typeof to === "object") to = to.offsetTop;
	
		scrollToX(el, from, to, 0, 1/duration, 20, easeOutCuaic);
	}

	function scrollToX(el, x1, x2, t, v, step, operacion) {
		if (t < 0 || t > 1 || v <= 0) return;
	
		el.scrollTop = x1 - (x1-x2)*operacion(t);
		t += v * step;
	
		setTimeout(function() {
			scrollToX(el, x1, x2, t, v, step, operacion);
		}, step);
	}

	function easeOutCuaic(t){
		t--;
		return t*t*t+1;
	}

	function getOffsetTop(e){
		var pos = 0;

		do {
			pos += e.offsetTop;
			e = e.offsetParent;
		} while(e != null);
	
		return pos;
	}

	function scrollToEnd(el){
		el.scrollTop = el.scrollHeight;
	}
/*********************************/

/* Function that create a struct object with as fields, the ones that were pass in argument */
function createStruct(fields) {
	var fields = fields.split(' ');
	var nbFields = fields.length;
	
	function constructor() {
		for (var i = 0; i < nbFields; ++i) {
			this[fields[i]] = arguments[i];
		}
	}
	
	return constructor;
}

/* Function to know if a variable exist */
function isset(){
	var a = arguments;
	var l = a.length;
	
	for(var i = 0; i < l; ++i){
		if(typeof a[i] === "undefined" || a[i] === null){ return false; }
	}
	
	return true;
}

/* Functions that will be launched at the window onload event */
	var onloadFunctions = new Array;
	var onloadLine = createStruct("f args");

	/* Add a function to the onloadFunction array and save the arguments */
	function addOnload(funct){
		var args = new Array;
		for(var i = 1; i < arguments.length; ++i){
			args.push(arguments[i]);
		}
	
		var line = new onloadLine(funct, args);
		var length = onloadFunctions.length;
	
		onloadFunctions.push(line);
	}

	/* Launch the functions in the array with the arguments passed */
	window.onload = function(){
		for(var i = 0; i < onloadFunctions.length; ++i){
			onloadFunctions[i].f.apply(null, onloadFunctions[i].args);
		}
	}
/**************************************************************/
