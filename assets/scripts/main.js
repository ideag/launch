
/***********************************************************************************
  
Animations
  
************************************************************************************/

jQuery(document).ready(function($) {
	$(function() {
		$('#header').delay(100).fadeIn(1000);
		$('#intro').delay(300).fadeIn(500);
	});
});

/***********************************************************************************
  
Mailchimp
  
************************************************************************************/

var emailfilter=/^\w+[\+\.\w-]*@([\w-]+\.)*\w+[\w-]*\.([a-z]{2,4}|\d+)$/i;

$(function() {
    if ($('form').length > 0) {
        $('form').submit(function(e) {
            var $this = $(this);
            var isValid = true;
            $('.error').removeClass('error');

            // Email Id Validation
            if (emailfilter.test($("#email").val()) == false) {
                $("#email").addClass('error');
                isValid = false;
            }

            if (isValid) {
                // If email is is valid, submit form through ajax
                $.ajax({
                    type: "GET",
                    url: $this.attr('action'),
                    data: $this.serialize(),
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
                            $('#pre-subscribe').fadeOut(500);
                            $('#post-subscribe').delay(500).fadeIn(500);
                        }
                    }
                });
            }

            return false;
        });
    }
});