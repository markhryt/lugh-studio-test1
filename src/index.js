import "./index.css";
import "./reset.css";

(function($) {
    $(document).ready(function() {
		
        $("#contactbutton").click( function(e) {
            e.preventDefault();

            // Serialize the form data
            var formData = $('#contactus').serialize();

            // Add the action and nonce to the data
            formData += '&action=my_ajax_action&nonce=' + OBJ.nonce;
            $.ajax({
                type : "post",
                dataType : "json",
                url : OBJ.ajaxurl,
                data : formData,
                success: function(response) {
                    if( response.type == "success" ) {
                        // Success Message
                        window.alert("Your e-mail was successfully sent. Thank you!");
                    }
                    else {
                        // Error on Failure.
                        window.alert("An Error occurred!");
                    }
                }
            });
        });
    });
})(jQuery);
