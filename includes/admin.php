<?php
/**
 * Admin functions
 **/
 
 add_action('admin_menu', 'indot_under_admin_menu_setup'); 

 
 /* Register menu item */
 function indot_under_admin_menu_setup()
 {
	$page_title = 'Indot Under';
	$menu_title = 'Indot Under';
	$capability = 'manage_options';
	$menu_slug = 'indot-under-settings';
	$function = 'indot_under_settings';
	add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function);
		
	$sub_menu_title = 'Under';
	add_submenu_page($menu_slug, $page_title, $sub_menu_title, $capability, $menu_slug, $function);
 }
 
 
 function indot_under_settings() 
 {
    if (!current_user_can('manage_options'))
	{
        wp_die('You do not have sufficient permissions to access this page.');
    }
	else
	{
		require(INDOT_UNDER_DIR.'includes/settings.php');
	}
}

add_action( 'admin_notices', 'indot_under_admin_notices' );
function indot_under_admin_notices() {
	// If a newer version is available, add the update

 	$screen_id = get_current_screen()->id;
 	if ($screen_id == 'toplevel_page_indot-under-settings' && indot_under_check_update_version()) {
    	printf( '<div class="updated"> 
    		<p> A <strong>new version</strong> has been released! Click <strong><a href="'.indot_under_download_update_version().'">here</a></strong> to update!<br /> Feel free to support the development of this plugin! (hint: you can buy us a beer!) </p> </div>');
 	}
}
 
function indot_under_check_update_version(){
	$payload = array(
	  'action' => 'plugin_information',
	  'request' => serialize(
	    (object)array(
	        'slug' => 'indot-under',
	        'fields' => array('description' => true)
	     )
	   )
	);
	$body = wp_remote_post( 'http://api.wordpress.org/plugins/info/1.0/', array( 'body' => $payload) );
	if(!isset($body->WP_Error)){
		if (version_compare(INDOT_UNDER_VERSION, unserialize($body['body'])->version, '<')) {
    		return true;
		}
	}
	else{
		return false;
	}
}

function indot_under_download_update_version(){
	$payload = array(
	  'action' => 'plugin_information',
	  'request' => serialize(
	    (object)array(
	        'slug' => 'indot-under',
	        'fields' => array('description' => true)
	     )
	   )
	);
	$body = wp_remote_post( 'http://api.wordpress.org/plugins/info/1.0/', array( 'body' => $payload) );
	if(!isset($body->WP_Error)){
		return unserialize($body['body'])->download_link;
	}
	else{
		return false;
	}
}

?>