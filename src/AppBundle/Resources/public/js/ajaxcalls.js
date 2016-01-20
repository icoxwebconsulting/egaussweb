$(document).ready(function(){	
	// Ajax for news list / events list / altitude add
	function ajaxNewsEventsAltitude(form, replacementHolder, type) {
		if ($(form).length > 0){
			var ajaxRequest;
			$(form).live('submit', function(e) {
				e.preventDefault();
				if (ajaxRequest) ajaxRequest.abort();
		        ajaxRequest = $.ajax({
		            url: $(this).attr('action'),
		            data: $(this).serialize() + '&type=' + type,
		            dataType: "HTML",
		            type: "POST",
		 			beforeSend: function(){
		                $(replacementHolder).addClass('loading');
					},            
		            success: function(response){
		            	$(replacementHolder).removeClass('loading');
		            	if (response) $(replacementHolder).html(response);
		            }
		        });
			});

			$(form + ' a.btn-primary').live('click', function(e) {
					e.preventDefault();
					$(form + ' input#page').val(1);
					$(form).submit();
			});
		}
	}

	// call ajax function for the following forms
	ajaxNewsEventsAltitude("form#formNews", ".results-holder", "112232145");
	ajaxNewsEventsAltitude("form#formEvents", ".results-holder", "112232146");
	ajaxNewsEventsAltitude("form#formAltitude", ".altitudeBox", "112232147");

	// ajax call for countries click
	if ($('.ajaxCountry ul.linksList a').length > 0) {
		var ajaxRequest;
		$('.ajaxCountry ul.linksList a').click(function(e){
			e.preventDefault();
			if (ajaxRequest) ajaxRequest.abort();

			ajaxRequest = $.ajax({
				url: $(this).attr('href'),
				data: 'type=112232148',
				dataType: "HTML",
	            type: "POST",		
	            beforeSend: function(){
	            	$('.TabContainer').addClass('loading');
	            },
	            success: function(response){
	            	$('.TabContainer').removeClass('loading');
	            	if (response) {
	            		$('.TabContainer .contentTab1').html($(response).filter('.contentTab1').html());
	            		$('.TabContainer .contentTab2').html($(response).filter('.contentTab2').html());
	            	}
	            }
			});
		});
	}
});
