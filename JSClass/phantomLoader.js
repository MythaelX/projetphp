var page = require('webpage').create();

var system = require('system');
var args = system.args;

if(args.length === 1){
	console.log('Try to pass some arguments when invoking this script!');
	phantom.exit();
}

function pageGetter(){
	return document.getElementsByTagName('body')[0].textContent;
}

function pageTreatment(status){
	
	if(status !== "success") {
		console.log('Unable to load the page');
		phantom.exit();
	}
	
	var code = page.evaluate(pageGetter);
	console.log(code);
	
	phantom.exit();
}

page.open(args[1], pageTreatment);
