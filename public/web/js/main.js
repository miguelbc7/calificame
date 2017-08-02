$(document).ready(function() {
	$("#preloader").delay(3000).fadeOut("slow");

	setTimeout(function() {
 	 document.body.style.overflowY= "visible";// despueés de cargar le devolvemos el scroll
}, 4000);
});

