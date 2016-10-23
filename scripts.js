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
	$videos.each(function(){
		$(this).hide(250);
	});
	
	if(elem=='all'){
	$videos.each(function(){
		$(this).show(250);
	});	}
	
	var $element = $('.'+elem);
	$element.show(250);
	
	}
	
	
	
	function filterDate(text){
		
	var $showsElements = $('.categorie');
	$showsElements.each(function(){
		alert($(this).attr('data-timestamp'));
		$(this).show(250);
	});		
	
	}
	
	