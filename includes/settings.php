<?php
	$option = get_option('IndotUnderSettings');
	if(isset($_POST['indot_under_submit'])){
		// Under
		($_POST['indot_under_active'] == "true") ? update_option('IndotUnderActive',true) : update_option('IndotUnderActive',false);
		$option['pagetitle']['text'] = $_POST['indot_under_pagetitle'];
		$option['favicon']['display'] = ($_POST['indot_under_favicon_active'] == "yes") ? true : false;
		$option['favicon']['url'] = $_POST['indot_under_favicon_url'];
		$option['favicon']['format'] = $_POST['indot_under_favicon_subtype'];
		$option['logo']['display'] = ($_POST['indot_under_logo_active'] == "yes") ? true : false;
		$option['logo']['url'] = $_POST['indot_under_logo_url'];
		$option['logo']['id'] = $_POST['indot_under_logo_id'];
		$option['title']['display'] = ($_POST['indot_under_title_show'] == "yes") ? true : false;
		$option['title']['text'] = $_POST['indot_under_title'];
		$option['description']['display'] = ($_POST['indot_under_description_show'] == "yes") ? true : false;
		$option['description']['text'] = $_POST['indot_under_description'];
		// Count Down
		$option['counter']['display'] = ($_POST['indot_under_count_show'] == "yes") ? true : false;
		$option['counter']['language'] = $_POST['indot_under_count_lang'];
		$option['counter']['date'] = $_POST['indot_under_count_date'];
		$option['counter']['time'] = "T".$_POST['indot_under_count_time'];
		$option['counter']['cron'] = ($_POST['indot_under_count_cron'] == "yes") ? true : false;
		if($_POST['indot_under_count_cron'] == "yes"){
			$date = explode("-",$_POST['indot_under_count_date']);
			$time = explode(":",$_POST['indot_under_count_time']);
			$timestamp =  mktime($time[0],$time[1],$time[2],$date[1],$date[2],$date[0]);
			wp_schedule_single_event($timestamp, 'indot_under_timer_action' );
		}
		else{
			if(wp_next_scheduled( 'my_schedule_hook' )){
				wp_unschedule_event( wp_next_scheduled( 'indot_under_timer_action' ), 'indot_under_timer_action');
			}
		}
		// About
		$option['about']['display'] = ($_POST['indot_under_about_show'] == "yes") ? true : false;
		$option['about']['text'] = $_POST['indot_under_about'];
		// Footer
		$option['footer']['display'] = ($_POST['indot_under_footer_show'] == "yes") ? true : false;
		$option['footer']['text'] = $_POST['indot_under_footer'];
		// Whitelist
		$option['whitelist']['enable'] = ($_POST['indot_under_whitelist_enable'] == "yes") ? true : false;
		$ipList = array();
		if(!empty($_POST['indot_under_whitelist_iplist'])){
			foreach ($_POST['indot_under_whitelist_iplist'] as $selectedOption)
				array_push($ipList, $selectedOption);
		}
		$option['whitelist']['iplist'] = $ipList;
		$roleList = array();
		if(!empty($_POST['indot_under_whitelist_role'])){
			foreach ($_POST['indot_under_whitelist_role'] as $selectedOption)
				array_push($roleList, $selectedOption);
		}
		$option['whitelist']['rolelist'] = $roleList;
		// Status Code
		$option['statuscode']['enable'] = ($_POST['indot_under_statuscode_enable'] == "yes") ? true : false;
		$option['statuscode']['code'] = $_POST['indot_under_statuscode_code'][0];
		if($_POST['indot_under_statuscode_code'][0] == 301){
			$option['statuscode']['redirect'] = $_POST['indot_under_statuscode_redirect'];
		}
		// SEO
		$option['seo']['enable'] = ($_POST['indot_under_seo_enable'] == "yes") ? true : false;
		$option['seo']['title'] = $_POST['indot_under_seo_title'];
		$option['seo']['description'] = $_POST['indot_under_seo_description'];
		$option['seo']['keywords'] = $_POST['indot_under_seo_keywords'];
		$option['seo']['author'] = $_POST['indot_under_seo_author'];

		update_option('IndotUnderSettings',$option);
	}
?>
	<div class='wrap'>
		<div id="icon-indot-under-settings" class="icon32"></div>
		<h2>Indot Under Settings</h2>
		<br />
		<div id="firstContainer">
		<div id="tabs">
		<form name='indot_under_settings_form' id='indot_under_settings_form' method='post' action='<?php echo $_SERVER['REQUEST_URI'] ?>'>
		
		<input type="hidden" value="<?php if(isset($_POST['indot_under_selected_tab'])){ echo $_POST['indot_under_selected_tab']; } else{echo 0;} ?>" name="indot_under_selected_tab" id="indot_under_selected_tab" />
		
			<ul>
				<li><a href="#tabs-1">Under</a></li>
				<li><a href="#tabs-2">Count Down</a></li>
				<li><a href="#tabs-3">About</a></li>
				<li><a href="#tabs-4">Footer</a></li>
				<li><a href="#tabs-5">Whitelist</a></li>
				<li><a href="#tabs-6">Status Code</a></li>
				<li><a href="#tabs-7">SEO</a></li>
			</ul>
			<div id="tabs-1">
				<table class="form-table">
				<tr>
					<th>
					<label for="indot_under_active">Activate Under</label>
					</th>
					<td>
					<select name="indot_under_active">
						<option value="true" <?php if(get_option('IndotUnderActive')){echo "selected";}?>>On</option>
						<option value="false" <?php if(!get_option('IndotUnderActive')){echo "selected";}?>>Off</option>
					</select>
					</td>
				</tr>
				<tr style="border-bottom: 1px solid #C6C6C6;"><th></th><td></td></tr>
				<tr><th></th><td></td></tr>
				<tr>
					<th>
					<label for="indot_under_pagetitle">Page Title</label>
					</th>
					<td>
						<input type="text" name="indot_under_pagetitle" value="<?php echo $option['pagetitle']['text']; ?>" size="50"/>
					</td>
				</tr>
				<tr style="border-bottom: 1px solid #C6C6C6;"><th></th><td></td></tr>
				<tr><th></th><td></td></tr>
				<tr>
					<th>
					<label for="indot_under_favicon_active">Display Page Favicon</label>
					</th>
					<td>
					<select name="indot_under_favicon_active">
						<option value="yes" <?php if($option['favicon']['display']){echo "selected";}?>>Yes</option>
						<option value="no" <?php if(!$option['favicon']['display']){echo "selected";}?>>No</option>
					</select>
					</td>
				</tr>
				<tr>
					<th>
					<label for="indot_under_favicon">Page Favicon</label>
					</th>
					<td>
						<input type="submit" class='button-primary' id="indot_under_favicon" name="indot_under_favicon" value="Select Favicon"/>
						<input type="hidden" name="indot_under_favicon_url" id="indot_under_favicon_url" value="<?php echo $option['favicon']['url']; ?>"/>
						<input type="hidden" name="indot_under_favicon_subtype" id="indot_under_favicon_subtype" value="<?php echo $option['favicon']['format']; ?>"/>
					</td>
				</tr>
				<tr>
					<th>
					<label for="indot_under_favicon_img">Page Favicon Preview</label>
					</th>
					<td>
						<img id="indot_under_favicon_img" src="<?php echo $option['favicon']['url']; ?>" />
					</td>
				</tr>
				<tr style="border-bottom: 1px solid #C6C6C6;"><th></th><td></td></tr>
				<tr><th></th><td></td></tr>
				<tr>
					<th>
					<label for="indot_under_logo_active">Display Page Logo</label>
					</th>
					<td>
					<select name="indot_under_logo_active">
						<option value="yes" <?php if($option['logo']['display']){echo "selected";}?>>Yes</option>
						<option value="no" <?php if(!$option['logo']['display']){echo "selected";}?>>No</option>
					</select>
					</td>
				</tr>
				<tr>
					<th>
					<label for="indot_under_logo">Page Logo</label>
					</th>
					<td>
						<input type="submit" class='button-primary' id="indot_under_logo" name="indot_under_logo" value="Select Logo"/>
						<input type="hidden" name="indot_under_logo_url" id="indot_under_logo_url" value="<?php echo $option['logo']['url']; ?>"/>
						<input type="hidden" name="indot_under_logo_id" id="indot_under_logo_id" value="<?php echo $option['logo']['id']; ?>"/>
					</td>
				</tr>
				<tr>
					<th>
					<label for="indot_under_logo_img">Page Logo Preview</label>
					</th>
					<td>
						<img id="indot_under_logo_img" src="<?php echo $option['logo']['url']; ?>" />
					</td>
				</tr>
				<tr style="border-bottom: 1px solid #C6C6C6;"><th></th><td></td></tr>
				<tr><th></th><td></td></tr>
				<tr>
					<th>
					<label for="indot_under_title_show">Display Page Content Title</label>
					</th>
					<td>
					<select name="indot_under_title_show">
						<option value="yes" <?php if($option['title']['display']){ echo "selected";} ?>>Yes</option>
						<option value="no" <?php if(!$option['title']['display']){ echo "selected";} ?>>No</option>
					</select>
					</td>
				</tr>
				<tr>
					<th>
					<label for="indot_under_title">Page Content Title</label>
					</th>
					<td>
					<input type="text" name="indot_under_title" value="<?php echo $option['title']['text']; ?>" size="50"/>
					</td>
				</tr>
				<tr style="border-bottom: 1px solid #C6C6C6;"><th></th><td></td></tr>
				<tr><th></th><td></td></tr>
				<tr>
					<th>
					<label for="indot_under_description_show">Display Page Content Description</label>
					</th>
					<td>
					<select name="indot_under_description_show">
						<option value="yes" <?php if($option['description']['display']){ echo "selected";} ?>>Yes</option>
						<option value="no" <?php if(!$option['description']['display']){ echo "selected";} ?>>No</option>
					</select>
					</td>
				</tr>
				<tr>
					<th>
					<label for="indot_under_description">Page Content Description</label>
					</th>
					<td>
					<textarea name="indot_under_description" rows="4" cols="50"><?php echo $option['description']['text']; ?></textarea>
					</td>
				</tr>
				<tr style="border-bottom: 1px solid #C6C6C6;"><th></th><td></td></tr>
				<tr><th></th><td></td></tr>
				</table>
			</div>
			<div id="tabs-2">
				<table class="form-table">
				<tr>
					<th>
					<label for="indot_under_count_show">Display Count Down</label>
					</th>
					<td>
					<select name="indot_under_count_show">
						<option value="yes"  <?php if($option['counter']['display']){ echo "selected";} ?>>Yes</option>
						<option value="no"  <?php if(!$option['counter']['display']){ echo "selected";} ?>>No</option>
					</select>
					</td>
				</tr>
				<tr>
					<th>
					<label for="indot_under_count_important">Important:</label>
					</th>
					<td>
					<label name="indot_under_count_important">Please set your Timezone <a href="<?php echo site_url().'/wp-admin/options-general.php'; ?>">here</a></label>
					</td>
				</tr>
				<tr>
					<th>
					<label for="indot_under_count_lang">Language</label>
					</th>
					<td>
					<select name="indot_under_count_lang">
						<option value="en" <?php if($option['counter']['language'] == 'en'){ echo "selected";} ?>>EN</option>
						<option value="pt" <?php if($option['counter']['language'] == 'pt'){ echo "selected";} ?>>PT</option>
						<option value="es" <?php if($option['counter']['language'] == 'es'){ echo "selected";} ?>>ES</option>
						<option value="fr" <?php if($option['counter']['language'] == 'fr'){ echo "selected";} ?>>FR</option>
						<option value="de" <?php if($option['counter']['language'] == 'de'){ echo "selected";} ?>>DE</option>
						<option value="it" <?php if($option['counter']['language'] == 'it'){ echo "selected";} ?>>IT</option>
					</select>
					</td>
				</tr>
				<tr>
					<th>
					<label for="indot_under_count_date">Date</label>
					</th>
					<td>
					<input type="hidden" value="<?php echo $option['counter']['date']; ?>" id="indot_under_count_date_h"/>
					<input type="text" name="indot_under_count_date" id="indot_under_count_date" />
					</td>
				</tr>
				<tr>
					<th>
					<label for="indot_under_count_time">Time</label>
					</th>
					<td>
					<input name="indot_under_count_time" id="indot_under_count_time" value="<?php echo ltrim ($option['counter']['time'],'T'); ?>"/>
					</td>
				</tr>
				<tr>
					<th>
					<label for="indot_under_count_cron">Deactivate Under on Time Set</label>
					</th>
					<td>
					<select name="indot_under_count_cron">
						<option value="yes"  <?php if($option['counter']['cron']){ echo "selected";} ?>>Yes</option>
						<option value="no"  <?php if(!$option['counter']['cron']){ echo "selected";} ?>>No</option>
					</select>
					</td>
				</tr>
				<tr style="border-bottom: 1px solid #C6C6C6;"><th></th><td></td></tr>
				<tr><th></th><td></td></tr>
				</table>
			</div>
			<div id="tabs-3">
				<table class="form-table">
				<tr>
					<th>
					<label for="indot_under_about_show">Display About</label>
					</th>
					<td>
					<select name="indot_under_about_show">
						<option value="yes" <?php if($option['about']['display']){ echo "selected";} ?>>Yes</option>
						<option value="no" <?php if(!$option['about']['display']){ echo "selected";} ?>>No</option>
					</select>
					</td>
				</tr>
				<tr>
					<th>
					<label for="indot_under_about">About Content</label>
					</th>
					<td>
					<textarea name="indot_under_about" rows="4" cols="50"/><?php echo $option['about']['text']; ?></textarea>
					</td>
				</tr>
				<tr style="border-bottom: 1px solid #C6C6C6;"><th></th><td></td></tr>
				<tr><th></th><td></td></tr>
				</table>
			</div>
			<div id="tabs-4">
				<table class="form-table">
				<tr>
					<th>
					<label for="indot_under_footer_show">Display Footer</label>
					</th>
					<td>
					<select name="indot_under_footer_show">
						<option value="yes" <?php if($option['footer']['display']){ echo "selected";} ?>>Yes</option>
						<option value="no" <?php if(!$option['footer']['display']){ echo "selected";} ?>>No</option>
					</select>
					</td>
				</tr>
				<tr>
					<th>
					<label for="indot_under_footer">Footer Text</label>
					</th>
					<td>
					<textarea name="indot_under_footer" rows="4" cols="50"/><?php echo $option['footer']['text']; ?></textarea>
					</td>
				</tr>
				<tr style="border-bottom: 1px solid #C6C6C6;"><th></th><td></td></tr>
				<tr><th></th><td></td></tr>
				</table>
			</div>
			<div id="tabs-5">
				<table class="form-table">
				<tr>
					<th>
					<label for="indot_under_whitelist_enable">Enable Whitelist</label>
					</th>
					<td>
					<select name="indot_under_whitelist_enable">
						<option value="yes" <?php if($option['whitelist']['enable']){ echo "selected";} ?>>Yes</option>
						<option value="no" <?php if(!$option['whitelist']['enable']){ echo "selected";} ?>>No</option>
					</select>
					</td>
				</tr>
				<tr style="border-bottom: 1px solid #C6C6C6;"><th></th><td></td></tr>
				<tr><th></th><td></td></tr>
				<tr>
					<th>
					<label name="indot_under_whitelist_localip">External IP</label>
					</th>
					<td>
					<label id="indot_under_whitelist_myip_label" myip="<?php echo $_SERVER['REMOTE_ADDR']; ?>"><?php echo $_SERVER['REMOTE_ADDR']; ?></label>
					<input type="submit" class='button-primary' name="indot_under_whitelist_addmyip" id="indot_under_whitelist_addmyip" value="Add My IP"/>
					</td>
				</tr>
				<tr>
					<th>
					<label for="indot_under_whitelist_iplist">IP List</label>
					</th>
					<td>
					<select name="indot_under_whitelist_iplist[]" id="indot_under_whitelist_iplist" size="10" style="width: 150px;" multiple="multiple">
					<?php 
						for($x = 0; $x < count($option['whitelist']['iplist']); $x++){
							echo "<option value='".$option['whitelist']['iplist'][$x]."'>".$option['whitelist']['iplist'][$x]."</option>";
						}
					?>
					</select>
					<input type="submit" class='button-primary' name="indot_under_whitelist_remove" id="indot_under_whitelist_remove" value="remove" />
					</td>
				</tr>
				<tr >
					<th>
					<label for="indot_under_whitelist_add_text">Add new IP</label>
					</th>
					<td>
					<input type="text" name="indot_under_whitelist_add_text" id="indot_under_whitelist_add_text"/>
					<input type="submit" class='button-primary' name="indot_under_whitelist_add" id="indot_under_whitelist_add" value="Add"/>
					</td>
				</tr>
				<tr style="border-bottom: 1px solid #C6C6C6;"><th></th><td></td></tr>
				<tr><th></th><td></td></tr>
				<tr>
					<th>
					<label for="indot_under_whitelist_add_text_role">Role List</label>
					</th>
					<td>
					<?php 
						global $wp_roles;
    					$all_roles = $wp_roles->get_names();
    					foreach($all_roles as $r){
					?>
						<input 
							type="checkbox" 
							name="indot_under_whitelist_role[]" 
							id="indot_under_whitelist_role_<?php echo $r; ?>" 
							<?php
								if(in_array($r, $option['whitelist']['rolelist']))
									echo "checked";
							?>
							value="<?php echo $r; ?>"
						/>
							<label><?php echo $r; ?></label>
					<?php } ?>
					</td>
				</tr>
				<tr style="border-bottom: 1px solid #C6C6C6;"><th></th><td></td></tr>
				<tr><th></th><td></td></tr>
				</table>
			</div>
			<div id="tabs-6">
				<table class="form-table">
				<tr>
					<th>
					<label for="indot_under_statuscode_enable">Enable Status Code</label>
					</th>
					<td>
					<select name="indot_under_statuscode_enable">
						<option value="yes" <?php if($option['statuscode']['enable']){ echo "selected";} ?>>Yes</option>
						<option value="no" <?php if(!$option['statuscode']['enable']){ echo "selected";} ?>>No</option>
					</select>
					</td>
				</tr>
				<tr style="border-bottom: 1px solid #C6C6C6;"><th></th><td></td></tr>
				<tr><th></th><td></td></tr>
				<tr>
					<th>
					<label for="indot_under_statuscode_code">200 OK</label>
					</th>
					<td>
					<input type="radio" name="indot_under_statuscode_code[]" value="200" group="indot_under_statuscode_code" <?php if($option['statuscode']['code'] == 200){ echo "checked";} ?>/>
					</td>
				</tr>
				<tr style="border-bottom: 1px solid #C6C6C6;"><th></th><td></td></tr>
				<tr><th></th><td></td></tr>
				<tr>
					<th>
					<label for="indot_under_statuscode_code">301 Moved Permanently</label>
					</th>
					<td>
					<input type="radio" name="indot_under_statuscode_code[]" value="301" group="indot_under_statuscode_code" <?php if($option['statuscode']['code'] == 301){ echo "checked";} ?>/>
					</td>
				</tr>
				<tr>
					<th>
					<label for="indot_under_statuscode_redirect">Redirect URL</label>
					</th>
					<td>
						<input type="text" name="indot_under_statuscode_redirect" value="<?php echo $option['statuscode']['redirect']; ?>" size="50"/>
					</td>
				</tr>
				<tr style="border-bottom: 1px solid #C6C6C6;"><th></th><td></td></tr>
				<tr><th></th><td></td></tr>
				<tr>
					<th>
					<label for="indot_under_statuscode_code">503 Services Unavailable</label>
					</th>
					<td>
					<input type="radio" name="indot_under_statuscode_code[]" value="503" group="indot_under_statuscode_code" <?php if($option['statuscode']['code'] == 503){ echo "checked";} ?>/>
					</td>
				</tr>
				<tr style="border-bottom: 1px solid #C6C6C6;"><th></th><td></td></tr>
				<tr><th></th><td></td></tr>
				</table>
			</div>
			<div id="tabs-7">
				<table class="form-table">
				<tr>
					<th>
					<label for="indot_under_seo_enable">Enable SEO</label>
					</th>
					<td>
					<select name="indot_under_seo_enable">
						<option value="yes" <?php if($option['seo']['enable']){ echo "selected";} ?>>Yes</option>
						<option value="no" <?php if(!$option['seo']['enable']){ echo "selected";} ?>>No</option>
					</select>
					</td>
				</tr>
				<tr>
					<th>
					<label for="indot_under_seo_title">Title Meta Tag</label>
					</th>
					<td>
					<input type="text" name="indot_under_seo_title" value="<?php echo $option['seo']['title']; ?>" size="50"/>
					</td>
				</tr>
				<tr>
					<th>
					<label for="indot_under_seo_description">Description Meta Tag</label>
					</th>
					<td>
					<textarea name="indot_under_seo_description" rows="4" cols="50"/><?php echo $option['seo']['description']; ?></textarea>
					</td>
				</tr>
				<tr>
					<th>
					<label for="indot_under_seo_keywords">Keywords Meta Tag</label>
					</th>
					<td>
					<textarea name="indot_under_seo_keywords" rows="4" cols="50"/><?php echo $option['seo']['keywords']; ?></textarea>
					</td>
				</tr>
				<tr>
					<th>
					<label for="indot_under_seo_author">Author Meta Tag</label>
					</th>
					<td>
					<input type="text" name="indot_under_seo_author" value="<?php echo $option['seo']['author']; ?>" size="50"/>
					</td>
				</tr>
				<tr style="border-bottom: 1px solid #C6C6C6;"><th></th><td></td></tr>
				<tr><th></th><td></td></tr>
				</table>
			</div>
			<div style="margin-left: 25px;">
			<input type="submit" class='button-primary' name="indot_under_submit" id="indot_under_submit" value="Save" />
			</div>
			<br />
			</form>
		</div>
		</div>
		<div id="secondContainer">
			<div id="donations">
				<h3>Love our Plugin?</h3>
				<div>
					<label>Buy us a Beer! :)</label>
					<br /><br />
					<div style="text-align: center;">
						<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
						<input type="hidden" name="cmd" value="_s-xclick">
						<input type="hidden" name="hosted_button_id" value="7KG6KTTFEV4RS">
						<input type="image" src="https://www.paypalobjects.com/en_US/GB/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online.">
						<img alt="" border="0" src="https://www.paypalobjects.com/pt_PT/i/scr/pixel.gif" width="1" height="1">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>