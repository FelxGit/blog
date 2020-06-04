//https://www.toddlahman.com/prevent-duplicate-form-submissions-with-jquery/

//these will only work for non-ajax request
$(document).ready(function(){
   
   $('input[type="submit"]').click(function(){
   	$(this).attr('disabled','disabled');
   });
   
});

jQuery(function() {
  $("form").submit(function() {
		// submit more than once return false
		$(this).submit(function() {
			return false;
		});
		// submit once return true
		return true;
	});
});

/* or */

jQuery('form').submit(function(){
$(this).find(':submit').attr( 'disabled','disabled' );
});



