
	$(document).ready(function(){
	
	
	$('form').submit(function(event){
		event.preventDefault();
		var $password_video = $(this).find('input').val();
		var $elem = $(this);
		var $id = $(this).find('input').attr('data-idv');
		var $opts = [];
		$opts['pass'] = $password_video;
		$opts['id'] = $id;
		$.ajax({
			url:'pass_load.php',
			type:'GET',
			data:'pass='+$password_video+'&id='+$id,
			dataType:'html',
			success:function(result){
				
				alert(result);
			$elem.parent().hide();
			$('body').prepend(result);
			}
			
		});
	});
	
	
	var iframe=$('iframe');
	var setPassword=$('.setPassword');
	iframe.each(function(){
		$(this).parent().css('position','relative');
	});
	
	setPassword.each(function(){
		$(this).css('position','absolute');
		$(this).css('top','0');
		$(this).css('left','0');
		$(this).css('right','0');
		$(this).css('bottom','0');
		$(this).css('background','black');
		
	});




	
	
		console.log('jquerychargé');
	
		var $filterDiv = $('#filterDiv');
		$filterDiv.css('background','lightgrey');
		var $descs = $('.description');
		var $categorie = $('.categorie');
		
		$descs.each(function(){
			$(this).hide();
		});
		
		$(':input[name="search"]').blur(function(){
			
				var $this = $(this);
				var $html= $this.val();
				var $contentVideos = $('#contentVideos');
				
				if($html.length >=4){
			
				$categorie.each(function(){
					$(this).hide();
				});
				
					$.ajax({
						url: 'ajax.php',
						type: 'GET',
						data: 'url='+$html,
					    // dataType : 'html',
						success: function(result){
							$contentVideos.html(result);
						}
				});
				}
		});
	});
		


	//MONTRER INFOS
	function show(elem,btn)
	{
	var $element = $('#'+elem);
	var $btn = $(btn);
	if($btn.html()==="MASQUER"){
		$btn.html("voir plus d'infos");
		$element.fadeOut(500);
	}else{
	$btn.html("MASQUER");
	$element.fadeIn(500);
	}
	
	}
	
	//FILTRER PAR CATEGORIE
	function filterCat(elem)
	{
	var $videos = $(".categorie");
	//on cache tout
	$videos.each(function(){
		$(this).hide(500);
	});
	//si click = all 
	if(elem=='all'){
	$videos.each(function(){
		$(this).show(500);
	});
	}else{
	var $element = $('.'+elem);
	$element.show(500);
	}

	}
	
	
	//FILTRER PAR DATE
	function filterDate(text,button)
	{
	var ordre = text;
	var $btn= $(button);
	var $videos = $(".categorie:visible");
	var $categorie = $videos.attr('data-categorie');
	var $contentVideos = $('#contentVideos');
	$videos.each(function(){
		$(this).hide(500);
	});
	if(text=='ASC'){
		$.ajax({
			url:'ajax_ordre.php',
			type:'GET',
			data:{'ordre':ordre,'categorie_id':$categorie},
			success:function(result){
				$contentVideos.html(result);
			}
		})

	}
	else if(text=='DESC')
	{
		$.ajax({
			url:'ajax_ordre.php',
			type:'GET',
			data:{'ordre':ordre,'categorie_id':$categorie},
			success:function(result){
				$contentVideos.html(result);
			}
		})

	}
	

	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	