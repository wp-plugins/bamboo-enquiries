/**************************************************************************************************/

     function queryString()
     {
         var vars = [], hash;
         var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
         for(var i = 0; i < hashes.length; i++)
         {
             hash = hashes[i].split('=');
             vars.push(hash[0]);
             vars[hash[0]] = hash[1];
         }
         return vars;
     }

/**************************************************************************************************/

	jQuery(document).ready(function(){

		if(queryString()==="sent") {
			jQuery('.bamboo_enquiry').empty();
			jQuery('.bamboo_enquiry').append('<div class="bamboo_enquiry_confirm"><h3>Thank you for your enquiry</h3><h4>We will get back to you as soon as possible</h4></div>');
		}

		jQuery('.bamboo_enquiry.auto_labels input[type="text"], .bamboo_enquiry.auto_labels textarea').each(function(){

			var input = jQuery(this);
			var label = input.prev();
			var prompt = label.html();

			input.val(prompt);
			label.hide();

			input.blur(function(){
				if(input.val()==='') {
					input.val(prompt);
				}
			});

			input.focus(function(){
				if(input.val()===prompt) {
					input.val('');
					input.removeClass('error');
				}
			});

		});

		jQuery('.bamboo_enquiry').each(function(){
			jQuery(this).submit(function(){

				jQuery('.bamboo_enquiry.auto_labels input[type="text"], .bamboo_enquiry.auto_labels textarea').each(function(){

					var input = jQuery(this);
					var label = input.prev();
					var text = input.val();
					var prompt = label.html();
					if (text===prompt) {
						input.val('');
						text = '';
					}
				});

				jQuery('.bamboo_enquiry input[type="text"], .bamboo_enquiry textarea').each(function(){
					var input = jQuery(this);
					var label = input.siblings('label[for="' + input.attr('name') + '"]');
					var text = input.val();
					var prompt = label.html();
					var promptLastChar = prompt.substr(prompt.length-1);
					if('*'===promptLastChar) {
						if(''===text) {
							input.addClass('error');
						} else {
							input.removeClass('error');
						}
					}
				});

				if(jQuery('.bamboo_enquiry .error').length>0) {
					return false;
				}

				return true;

			});
		});

	});

/**************************************************************************************************/