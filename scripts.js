$(document).ready(function(){
	
	
	var $descs = $('.description');
	$descs.hide();

	
});	

	
	function show(elem){

	
	var $element = $('#'+elem);
	var $html = $element.html();

	$element.show();
	
	}
	
	function filterCat(elem){
	var $videos = $(".categorie");
	$videos.hide(250);
	if(elem=='all'){
	$videos.show(250);

	}
	var $element = $('.'+elem);
	$element.show(250);
	}
	function filterDate(text){
		alert(text);
	}