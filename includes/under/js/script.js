jQuery( document ).ready(function() {
	var dateTime = jQuery('#valueDateTime').val().replace(/-/g,"/");
	console.log(dateTime);
	var targetTime = new Date(dateTime);
	console.log(targetTime);
    jQuery('#timer').countdown({
    	until: new Date(targetTime)
	});
});