// JavaScript Document
$(document).ready(function(){
	
	
	$.configureBoxes();
	$('span[id!=tab1Tab]', 'div[class=content]').hide();
	
	$('#menu li a').click(function(){
							var id = $(this).parent().attr('class');
							$('#'+id, 'div[class=content]').show();
							$('span[id!='+id+']', 'div[class=content]').hide();
							$('#menu li a').removeClass('active');
							$(this).addClass('active');
						});
						   
						   
	$( "#addForm" ).dialog({
		autoOpen: false,
		modal: true
	});
	
	
	$("#deleteHotel").dialog({
		autoOpen: false,
		modal: true,
		buttons: [ {	
				  		text: "Delete", 
				  		click: function(){ 
							var id = $('#deleteHotel .id').html();
							$.get('http://www.appleseedinteractive.com/tripreviewer/index.php/review/delete/' + id, function(){
																									$(this).dialog('close');
																									location.reload(true);
																													   });
						}
					}, 
					{
						text: "Cancel", 
						click: function(){ $(this).dialog('close'); }  
					}]
	});
	
	function removeHotel(id, name){
		alert(id + ' ' + name);
	}
	
	$(".deleteHotel").click(function(){
		var id = $(this).attr('id');
		var name = $(this).prev('a').html();
		$('#deleteHotel .message').html( name + ' ' + 'is about to be deleted.' + id);
		$('#deleteHotel .id').html(id);
		$('#deleteHotel .name').html(name);
		$('#deleteHotel').dialog("open");
		return false;
	});
	
	$('#add').click(function(){
		$('#addForm').dialog("open");
		return false;
	});
	
	$('#flash').hide();					   
	$('#hform').submit(function(){
		var url = $('#hform input[type=text]').val();
		var mgt = $('#hform option:selected').val();
		var action = $('#hform input[name=formAction]').val();
		var hotel_id = $('#hform input[name=hotel_id]').val();
		var orbitz_url = $('#hform input[name=orbitz_url]').val();
		var priceline_url = $('#hform input[name=priceline_url]').val();
		if (url == ''){
				$('#flash').addClass('nFailure').html('You need to specify the url').show(100).delay(2000).hide(100);
				//$('#flash').removeClass('error');
			}
		switch(action){
			case "add":
				$.post('http://www.appleseedinteractive.com/tripreviewer/index.php/review/add', 
				   {hotel_url: url, management: mgt, orbitz_url: orbitz_url, priceline_url: priceline_url}, 
				   function(data){
					if(data.result){
					if ($('#flash').hasClass('nFailure')){
							$('#flash').removeClass('nFailure');
						}
					$('#flash').addClass('nSuccess').html('Hotel Added!').show(100);
					setTimeout("location.reload(true)", 3000);
					}
				});
			break;
			
			
			}	
		
			
		return false;
	});


	$('#compForm').submit(function(){
			var hotel_id = $('#compForm input[name=hotel_id]').val();
			var FormOptions = $('select#box2View').children();
			FormOptions.each(function(){
					$.post('http://www.appleseedinteractive.com/tripreviewer/index.php/review/comp', 
				   {hotel_id: hotel_id, comp: $(this).val()});
			});
		$('#flash').addClass('nSuccess').html('Hotel Added!').show(100);
		setTimeout("location.reload(true)", 3000);	
		return false;
	});


})