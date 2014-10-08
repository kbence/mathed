var click = false;
var cursorX;
var cursorY;

document.onmousemove = function(e){
	cursorX = e.pageX;
	cursorY = e.pageY;
	if (click) {
		var document_width = document.getElementById("wl_document").clientWidth;
		var sub = (document.body.clientWidth - document_width) / 2;
		
		if ((cursorX > sub) && (cursorX < (sub + document_width))) {
			widht_percent = (cursorX - sub) / document_width * 100;
	  		document.getElementById("wl_editor").style.width = widht_percent  + "%";
	  		document.getElementById("wl_divider").style.left = widht_percent + "%";
	  		document.getElementById("wl_preview").style.width = 100 - widht_percent + "%";
		}	
		else {
			click = false;
		}
	}
}

function moveDividerOut(){
	click = false;
}

function moveDividerClick(){ 
	click = true;
}
