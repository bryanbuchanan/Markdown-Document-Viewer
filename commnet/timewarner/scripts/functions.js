/* Javascript Functions */


/* Define new namespace to avoid conflicts
-------------------------------------------------- */


	var rsn = new Object();


/* Debug Logger
------------------------------------------------ */


	rsn.log = function(message) {
	
		if (window.console && window.console.log) {
		
			console.log(message);
			
		}

	};
	

/* Rendering Engine Detector
-------------------------------------------------- */


	rsn.browserDetect = function() {
	
		if ($.browser.mozilla) var browser = "mozilla";
		if ($.browser.webkit) var browser = "webkit";
		if ($.browser.msie) var browser = "msie";
		$('body').addClass(browser);
	
	};


/* Form Placeholder Values
------------------------------------------------ */
	
	
	rsn.placeholder = function() {
		
		if (navigator.userAgent.match('MSIE')) {
	
			$('input[type="text"]').each(function() {
		
				try {
						
					if (!$(this).parent().hasClass('error') && $(this).attr('placeholder').length > 0) {
										
						var placeholder = $(this).attr('placeholder');
						
						if (!$(this).val()) $(this).val(placeholder).addClass('placeholder_text');
									
						$(this).focus(function() {
						
							if ($(this).val() == placeholder) $(this).val('').removeClass('placeholder_text');
						
						});
						
						$(this).blur(function() {
						
							if (!$(this).val()) $(this).val(placeholder).addClass('placeholder_text');
						
						});
					
					}
					
				} catch(error) { }
			
			});
		
			$('form').submit(function() {
			
				$('input.placeholder_text').val('');
			
			});

		}
		
	};
	
	
/* Validate Form Input
-------------------------------------------------- */


	rsn.validate = function() {
			
		$(this).find('.alert').remove();
		$(this).find('.error').removeClass('error');
	
		$(this).find('label.required').find('input, select').each(function() {
		
			if ($(this).val() == "") $(this).addClass('error');
			
		});
		
		if ($(this).find('.error').length > 0) {
		
			$(this).find('input, textarea').each(function() { $(this).blur(); });
			return false;
			
		}
	
	};


/* Timeline
-------------------------------------------------- */


	$(document).ready(function() {
	
		rsn.browserDetect();
		rsn.placeholder();
		$('form').submit(rsn.validate);
	
	});
	
	$(window).load(function() {
	
	
	
	});