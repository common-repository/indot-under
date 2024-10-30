<?php
/**
 * Uninstall functionality
 **/
function indot_under_uninstall(){
		delete_option('IndotUnderActive');
		delete_option('IndotUnderSettings');
}
indot_under_uninstall();
?>