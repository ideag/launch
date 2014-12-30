
/***********************************************************************************
  
Animations
  
************************************************************************************/

jQuery(document).ready(function(jQuery) {
	jQuery(function() {
		jQuery('#header').delay(100).fadeIn(1000);
		jQuery('#intro').delay(300).fadeIn(500);
	});
});

/***********************************************************************************
  
Mailchimp
  
************************************************************************************/

var emailfilter=/^\w+[\+\.\w-]*@([\w-]+\.)*\w+[\w-]*\.([a-z]{2,4}|\d+)jQuery/i;

jQuery(function() {
    if (jQuery('form').length > 0) {
        jQuery('form').submit(function(e) {
            var jQuerythis = jQuery(this);
            var isValid = true;
            jQuery('.error').removeClass('error');

            // Email Id Validation
            if (emailfilter.test(jQuery("#email").val()) == false) {
                jQuery("#email").addClass('error');
                isValid = false;
            }

            if (isValid) {
                // If email is is valid, submit form through ajax
                jQuery.ajax({
                    type: "GET",
                    url: jQuerythis.attr('action'),
                    data: jQuerythis.serialize(),
                    dataType: 'json',
                    contentType: "application/json; charset=utf-8",
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert("Could not connect to the registration server.");
                    },
                    success: function(data) {
                        if (data.result != "success") {
                            // Something went wrong, parse data.msg string and display message
                            alert("Sorry, something went wrong... try again.");
                        } else {
                            jQuery('#pre-subscribe').fadeOut(500);
                            jQuery('#post-subscribe').delay(500).fadeIn(500);
                        }
                    }
                });
            }

            return false;
        });
    }
});