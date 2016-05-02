$(document).ready(function() {
    $(document).on('click', '#save-changes', function() {
    	        	$("#error-msg").text("");
        var t = $(this);
	var parent = $(this).parent();
        var newpass= $('#new-password').val();
        var confirmpass = $('#confirm-password').val();
        var currentpass = $('#current-password').val();
        var newemail = $('#new-email').val();
        
        if (newemail != "" || confirmpass != "" || currentpass != "" || newpass != "") { 
	        if (newpass != confirmpass) {
	        	$("#error-msg").text("New password doesn't match confirm password");
	        }
	        else {        
		        $.post("update_preferences.php", {
		                newpass : newpass,
		                curpass: currentpass,
		                newemail : newemail
		                }, 
		                function(data) {
		                    if (data != "") {
		                       $("#error-msg").text(data);
		                    }
		                    else {
		                    	  $("#error-msg").text("Changes Saved");
		                    }
		        });
	        }
        }
	});
});