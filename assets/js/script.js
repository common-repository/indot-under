jQuery( document ).ready(function() {
	jQuery(function() {
		jQuery( "#tabs" ).tabs({active: jQuery("#indot_under_selected_tab").val()});
	});

  jQuery(function() {
    jQuery( "#donations" ).accordion({
      collapsible: true,
      heightStyle: "content"
    });
  });

	jQuery(function() {
    var dateTime = jQuery('#indot_under_count_date_h').val();
		jQuery( "#indot_under_count_date" ).datepicker();
		jQuery( "#indot_under_count_date" ).datepicker( "option", "dateFormat", "yy-mm-dd");
    jQuery( "#indot_under_count_date" ).datepicker( "setDate", dateTime);
	});

  jQuery('#indot_under_count_time').timepicker({
    showSecond: true,
    timeFormat: 'HH:mm:ss'
  });

  jQuery("#indot_under_whitelist_remove").click(function(e){
    e.preventDefault();
    jQuery("#indot_under_whitelist_iplist option:selected").remove();
  });

  jQuery("#indot_under_whitelist_add").click(function(e){
    e.preventDefault();
    jQuery("#indot_under_whitelist_iplist").append('<option value="'+jQuery("#indot_under_whitelist_add_text").val()+'">'+jQuery("#indot_under_whitelist_add_text").val()+'</option>');
  });

  jQuery("#indot_under_whitelist_addmyip").click(function(e){
    e.preventDefault();
    jQuery("#indot_under_whitelist_iplist").append('<option value="'+jQuery("#indot_under_whitelist_myip_label").attr("myip")+'">'+jQuery("#indot_under_whitelist_myip_label").attr("myip")+'</option>');
  });

  jQuery("#indot_under_submit").click(function(e){
    jQuery('#indot_under_whitelist_iplist option').prop('selected', 'selected');
  });

  jQuery("#tabs ul li").click(function(){
    jQuery("#indot_under_selected_tab").val(jQuery(this).index());
  });

  jQuery("#indot_under_logo").click(function(e){
    e.preventDefault();
    var custom_file_frame;
    if (typeof(custom_file_frame)!=="undefined") {
         custom_file_frame.close();
      }
 
      //Create WP media frame.
      custom_file_frame = wp.media.frames.customHeader = wp.media({
         //Title of media manager frame
         title: "Indot Under - Choose Logo",
         library: {
            type: 'image'
         },
         button: {
            //Button text
            text: "Select Logo"
         },
         //Do not allow multiple files, if you want multiple, set true
         multiple: false
      });
 
      //callback for selected image
      custom_file_frame.on('select', function() {
         var attachment = custom_file_frame.state().get('selection').first().toJSON();
         jQuery("#indot_under_logo_img").attr("src", attachment.sizes.thumbnail.url);
         jQuery("#indot_under_logo_url").val(attachment.sizes.thumbnail.url);
         jQuery("#indot_under_logo_id").val(attachment.id);
      });
 
      //Open modal
      custom_file_frame.open();
  });

jQuery("#indot_under_favicon").click(function(e){
    e.preventDefault();
    var custom_file_frame;
    if (typeof(custom_file_frame)!=="undefined") {
         custom_file_frame.close();
      }
 
      //Create WP media frame.
      custom_file_frame = wp.media.frames.customHeader = wp.media({
         //Title of media manager frame
         title: "Indot Under - Choose Favicon",
         library: {
            type: 'image'
         },
         button: {
            //Button text
            text: "Select Favicon"
         },
         //Do not allow multiple files, if you want multiple, set true
         multiple: false
      });
 
      //callback for selected image
      custom_file_frame.on('select', function() {
         var attachment = custom_file_frame.state().get('selection').first().toJSON();
         jQuery("#indot_under_favicon_img").attr("src", attachment.url);
         jQuery("#indot_under_favicon_url").val(attachment.url);
         jQuery("#indot_under_favicon_subtype").val(attachment.subtype);
      });
 
      //Open modal
      custom_file_frame.open();
  });
});