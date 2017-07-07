<?php
if( !session_id() ) { session_start(); }
/*Plugin Name: Wordpress File Upload
/*
Plugin URI: http://www.iptanus.com/support/wordpress-file-upload
Description: Simple interface to upload files from a page.
Version: 3.11.0
Author: Nickolas Bossinas
Author URI: http://www.iptanus.com
*/

/*
Wordpress File Upload (Wordpress Plugin)
Copyright (C) 2010-2016 Nickolas Bossinas
Contact me at http://www.iptanus.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.
*/

//set global db variables
//wfu_tb_log_version v2.0 changes:
//  sessionid field added
//wfu_tb_log_version v3.0 changes:
//  uploadtime field added
//  blogid field added
//wfu_tb_log_version v4.0 changes:
//  filedata field added
$wfu_tb_log_version = "4.0";
$wfu_tb_userdata_version = "1.0";
$wfu_tb_dbxqueue_version = "1.0";

/* do not load plugin if this is the login page */
$uri = $_SERVER['REQUEST_URI'];
if ( strpos($uri, 'wp-login.php') !== false ) return;

DEFINE("WPFILEUPLOAD_PLUGINFILE", __FILE__);
DEFINE("WPFILEUPLOAD_DIR", '/'.substr(WP_PLUGIN_DIR, strlen(ABSPATH)) .'/'.dirname(plugin_basename (__FILE__)).'/');
DEFINE("ABSWPFILEUPLOAD_DIR", ( substr(ABSPATH, -1) == "/" ? substr(ABSPATH, 0, -1) : ABSPATH ).WPFILEUPLOAD_DIR);
$_SESSION['wfu_ABSPATH'] = ABSPATH;
add_shortcode("wordpress_file_upload", "wordpress_file_upload_handler");
load_plugin_textdomain('wp-file-upload', false, dirname(plugin_basename (__FILE__)).'/languages');
/* load styles and scripts for front pages */
if ( !is_admin() ) {
	add_action( 'wp_enqueue_scripts', 'wfu_enqueue_frontpage_scripts' );
}
add_action('admin_init', 'wordpress_file_upload_admin_init');
add_action('admin_menu', 'wordpress_file_upload_add_admin_pages');
register_activation_hook(__FILE__,'wordpress_file_upload_install');
add_action('plugins_loaded', 'wordpress_file_upload_update_db_check');
//ajax actions
add_action('wp_ajax_wfu_ajax_action', 'wfu_ajax_action_callback');
add_action('wp_ajax_nopriv_wfu_ajax_action', 'wfu_ajax_action_callback');
add_action('wp_ajax_wfu_ajax_action_ask_server', 'wfu_ajax_action_ask_server');
add_action('wp_ajax_nopriv_wfu_ajax_action_ask_server', 'wfu_ajax_action_ask_server');
add_action('wp_ajax_wfu_ajax_action_send_email_notification', 'wfu_ajax_action_send_email_notification');
add_action('wp_ajax_nopriv_wfu_ajax_action_send_email_notification', 'wfu_ajax_action_send_email_notification');
add_action('wp_ajax_wfu_ajax_action_notify_wpfilebase', 'wfu_ajax_action_notify_wpfilebase');
add_action('wp_ajax_nopriv_wfu_ajax_action_notify_wpfilebase', 'wfu_ajax_action_notify_wpfilebase');
add_action('wp_ajax_wfu_ajax_action_save_shortcode', 'wfu_ajax_action_save_shortcode');
add_action('wp_ajax_wfu_ajax_action_check_page_contents', 'wfu_ajax_action_check_page_contents');
add_action('wp_ajax_wfu_ajax_action_read_subfolders', 'wfu_ajax_action_read_subfolders');
add_action('wp_ajax_wfu_ajax_action_download_file_invoker', 'wfu_ajax_action_download_file_invoker');
add_action('wp_ajax_nopriv_wfu_ajax_action_download_file_invoker', 'wfu_ajax_action_download_file_invoker');
add_action('wp_ajax_wfu_ajax_action_download_file_monitor', 'wfu_ajax_action_download_file_monitor');
add_action('wp_ajax_nopriv_wfu_ajax_action_download_file_monitor', 'wfu_ajax_action_download_file_monitor');
add_action('wp_ajax_wfu_ajax_action_edit_shortcode', 'wfu_ajax_action_edit_shortcode');
add_action('wp_ajax_wfu_ajax_action_get_historylog_page', 'wfu_ajax_action_get_historylog_page');
add_action('wp_ajax_wfu_ajax_action_include_file', 'wfu_ajax_action_include_file');
add_action('wp_ajax_wfu_ajax_action_update_envar', 'wfu_ajax_action_update_envar');
wfu_include_lib();
//widget
add_action( 'widgets_init', 'register_wfu_widget' );
//Media editor custom properties
if ( is_admin() ) add_action( 'attachment_submitbox_misc_actions', 'wfu_media_editor_properties', 11 );
//register internal filter that is executed before upload for classic uploader
add_filter("_wfu_before_upload", "wfu_classic_before_upload_handler", 10, 2);


function register_wfu_widget() {
    register_widget( 'WFU_Widget' );
}

function wfu_enqueue_frontpage_scripts() {
	switch(WFU_FUNCTION_HOOK(__FUNCTION__, func_get_args(), $out)) { case 'X': break; case 'R': return $out; break; case 'D': die($out); break; }
	$plugin_options = wfu_decode_plugin_options(get_option( "wordpress_file_upload_options" ));
	$relaxcss = false;
	if ( isset($plugin_options['relaxcss']) ) $relaxcss = ( $plugin_options['relaxcss'] == '1' );
	//apply wfu_before_frontpage_scripts to get additional settings 
	$changable_data = array();
	$ret_data = apply_filters('wfu_before_frontpage_scripts', $changable_data);
	//if $ret_data contains 'return_value' key then no scripts will be enqueued
	if ( isset($ret_data['return_value']) ) return $ret_data['return_value'];

	if ( $relaxcss ) {
		wp_enqueue_style('wordpress-file-upload-style', WPFILEUPLOAD_DIR.'css/wordpress_file_upload_style_relaxed.css',false,'1.0','all');
		wp_enqueue_style('wordpress-file-upload-style-safe', WPFILEUPLOAD_DIR.'css/wordpress_file_upload_style_safe_relaxed.css',false,'1.0','all');
	}
	else {
		wp_enqueue_style('wordpress-file-upload-style', WPFILEUPLOAD_DIR.'css/wordpress_file_upload_style.css',false,'1.0','all');
		wp_enqueue_style('wordpress-file-upload-style-safe', WPFILEUPLOAD_DIR.'css/wordpress_file_upload_style_safe.css',false,'1.0','all');
	}
	if ( !isset($ret_data["correct_NextGenGallery_incompatibility"]) || $ret_data["correct_NextGenGallery_incompatibility"] != "true" )
		wp_enqueue_style('jquery-ui-css', '//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css');
	wp_enqueue_style('jquery-ui-timepicker-addon-css', WPFILEUPLOAD_DIR.'vendor/datetimepicker/jquery-ui-timepicker-addon.min.css',false,'1.0','all');
	wp_enqueue_script('json_class', WPFILEUPLOAD_DIR.'js/json2.js');
	wp_enqueue_script('wordpress_file_upload_script', WPFILEUPLOAD_DIR.'js/wordpress_file_upload_functions.js');
	wp_enqueue_script('jquery-ui-slider', false, array(), false, true);
	wp_enqueue_script('jquery-ui-datepicker', false, array(), false, true);
	wp_enqueue_script('jquery-ui-timepicker-addon-js', WPFILEUPLOAD_DIR.'vendor/datetimepicker/jquery-ui-timepicker-addon.min.js', array(), false, true);
}

function wfu_include_lib() {
	if ( $handle = opendir(plugin_dir_path( __FILE__ )."lib/") ) {
		$blacklist = array('.', '..');
		while ( false !== ($file = readdir($handle)) )
			if ( !in_array($file, $blacklist) && substr($file, 0, 1) != "_" )
				include_once plugin_dir_path( __FILE__ )."lib/".$file;
		closedir($handle);
	}
	if ( $handle = opendir(plugin_dir_path( __FILE__ )) ) {
		closedir($handle);
	}
}

/* exit if we are in admin pages (in case of ajax call) */
if ( is_admin() ) return;

function wordpress_file_upload_handler($incomingfrompost) {
	//replace old attribute definitions with new ones
	$incomingfrompost = wfu_old_to_new_attributes($incomingfrompost);
	//process incoming attributes assigning defaults if required
	$defs_indexed = wfu_shortcode_attribute_definitions_adjusted($incomingfrompost);
	$incomingfrompost = shortcode_atts($defs_indexed, $incomingfrompost);
	//run function that actually does the work of the plugin
	$wordpress_file_upload_output = wordpress_file_upload_function($incomingfrompost);
	//send back text to replace shortcode in post
	return $wordpress_file_upload_output;
}

function wordpress_file_upload_browser_handler($incomingfrompost) {
	//process incoming attributes assigning defaults if required
	$defs = wfu_browser_attribute_definitions();
	$defs_indexed = array();
	foreach ( $defs as $def ) $defs_indexed[$def["attribute"]] = $def["value"];
	$incomingfrompost = shortcode_atts($defs_indexed, $incomingfrompost);
	//run function that actually does the work of the plugin
	$wordpress_file_upload_browser_output = wordpress_file_upload_browser_function($incomingfrompost);
	//send back text to replace shortcode in post
	return $wordpress_file_upload_browser_output;
}

function wordpress_file_upload_function($incomingfromhandler) {
	switch(WFU_FUNCTION_HOOK(__FUNCTION__, func_get_args(), $out)) { case 'X': break; case 'R': return $out; break; case 'D': die($out); break; }
	global $post;
	global $blog_id;
	$plugin_options = wfu_decode_plugin_options(get_option( "wordpress_file_upload_options" ));
	$shortcode_tag = 'wordpress_file_upload';
	$params = wfu_plugin_parse_array($incomingfromhandler);
	$sid = $params["uploadid"];
	$widgetid = $params["widgetid"];
	// store current page and blog id in params array
	$params["pageid"] = $post->ID;
	$params["blogid"] = $blog_id;
	
	if ( !isset($_SESSION['wfu_token_'.$sid]) || $_SESSION['wfu_token_'.$sid] == "" )
		$_SESSION['wfu_token_'.$sid] = uniqid(mt_rand(), TRUE);
	//store the server environment (32 or 64bit) for use when checking file size limits
	$params["php_env"] = wfu_get_server_environment();
	
	$user = wp_get_current_user();
	$widths = wfu_decode_dimensions($params["widths"]);
	$heights = wfu_decode_dimensions($params["heights"]);
	//additional parameters to pass to visualization routines
	$additional_params = array( );
	$additional_params['widths'] = $widths;
	$additional_params['heights'] = $heights;

	$uploadedfile = 'uploadedfile_'.$sid;
	$hiddeninput = 'hiddeninput_'.$sid;
	$adminerrorcodes = 'adminerrorcodes_'.$sid;
	$upload_clickaction = 'wfu_redirect_to_classic('.$sid.', \''.$_SESSION['wfu_token_'.$sid].'\' , 0, 0);';

	//check if user is allowed to view plugin, otherwise do not generate it
	$uploadroles = explode(",", $params["uploadrole"]);
	foreach ( $uploadroles as &$uploadrole ) {
		$uploadrole = trim($uploadrole);
	}
	$plugin_upload_user_role = wfu_get_user_role($user, $uploadroles);		
	if ( $plugin_upload_user_role == 'nomatch' ) return;

	//activate debug mode only for admins
	if ( $plugin_upload_user_role != 'administrator' ) $params["debugmode"] = "false";

	$params["adminmessages"] = ( $params["adminmessages"] == "true" && $plugin_upload_user_role == 'administrator' );
	// define variable to hold any additional admin errors coming before processing of files (e.g. due to redirection)
	$params["adminerrors"] = "";

	/* Define dynamic upload path from variables */
	$search = array ('/%userid%/', '/%username%/', '/%blogid%/', '/%pageid%/', '/%pagetitle%/');	
	if ( is_user_logged_in() ) $username = $user->user_login;
	else $username = "guests";
	$replace = array ($user->ID, $username, $blog_id, $post->ID, get_the_title($post->ID));
	$params["uploadpath"] = preg_replace($search, $replace, $params["uploadpath"]);

	/* Determine if userdata fields have been defined */
	$userdata_fields = array(); 
	$userdata_occurrencies = substr_count($params["placements"], "userdata");
	if ( $userdata_occurrencies == 0 ) $userdata_occurrencies = 1;
	if ( $params["userdata"] == "true" ) {
		for ( $i = 1; $i <= $userdata_occurrencies; $i++ ) {
			$userdata_fields2 = wfu_parse_userdata_attribute($params["userdatalabel".( $i > 1 ? $i : "" )]);
			foreach ( $userdata_fields2 as $key => $item ) $userdata_fields2[$key]["occurrence"] = $i;
			$userdata_fields = array_merge($userdata_fields, $userdata_fields2);
		}
	}
	$params["userdata_fields"] = $userdata_fields; 
	
	/* If medialink or postlink is activated, then subfolders are deactivated */
	if ( $params["medialink"] == "true" || $params["postlink"] == "true" ) $params["askforsubfolders"] = "false";

	/* Generate the array of subfolder paths */
	$params['subfoldersarray'] = wfu_get_subfolders_paths($params);
	

	/* in case that webcam is activated, then some elements related to file
	   selection need to be removed */
	if ( strpos($params["placements"], "webcam") !== false && $params["webcam"] == "true" ) {
		$params["placements"] = wfu_placements_remove_item($params["placements"], "filename");
		$params["placements"] = wfu_placements_remove_item($params["placements"], "selectbutton");
		$params["singlebutton"] = "false";
		$params["uploadbutton"] = $params["uploadmediabutton"];
	}

//____________________________________________________________________________________________________________________________________________________________________________________

	if ( $params['forceclassic'] != "true" ) {	
//**************section to put additional options inside params array**************
		$params['subdir_selection_index'] = "-1";
//**************end of section of additional options inside params array**************


//	below this line no other changes to params array are allowed


//**************section to save params as Wordpress options**************
//		every params array is indexed (uniquely identified) by three fields:
//			- the page that contains the shortcode
//			- the id of the shortcode instance (because there may be more than one instances of the shortcode inside a page)
//			- the user that views the plugin (because some items of the params array are affected by the user name)
//		the wordpress option "wfu_params_index" holds an array of combinations of these three fields, together with a randomly generated string that corresponds to these fields.
//		the wordpress option "wfu_params_xxx", where xxx is the randomly generated string, holds the params array (encoded to string) that corresponds to this string.
//		the structure of the "wfu_params_index" option is as follows: "a1||b1||c1||d1&&a2||b2||c2||d2&&...", where
//			- a is the randomly generated string (16 characters)
//			- b is the page id
//			- c is the shortcode id
//			- d is the user name
		$params_index = wfu_generate_current_params_index($sid, $user->user_login);
		$params_str = wfu_encode_array_to_string($params);
		update_option('wfu_params_'.$params_index, $params_str);
		$ajax_params['shortcode_id'] = $sid;
		$ajax_params['params_index'] = $params_index;
		$ajax_params['debugmode'] = $params["debugmode"];
		$ajax_params['is_admin'] = ( $plugin_upload_user_role == 'administrator' ? "true" : "false" );
		$ajax_params["has_filters"] = ( has_filter("wfu_before_upload") ? "true" : "false" );
		$ajax_params["error_header"] = $params["errormessage"];
		$ajax_params["fail_colors"] = $params["failmessagecolors"];

		$ajax_params_str = wfu_encode_array_to_string($ajax_params);
		$upload_clickaction = 'wfu_HTML5UploadFile('.$sid.', \''.$ajax_params_str.'\', \''.$_SESSION['wfu_token_'.$sid].'\')';
	}
	$upload_onclick = ' onclick="'.$upload_clickaction.'"';

	$additional_params['clickaction'] = $upload_clickaction;

	/* Compose the html code for the plugin */
	$wordpress_file_upload_output = "";
	$plugin_style = "";
	if ( $widths["plugin"] != "" ) $plugin_style .= 'width: '.$widths["plugin"].'; ';
	if ( $heights["plugin"] != "" ) $plugin_style .= 'height: '.$heights["plugin"].'; ';
	if ( $plugin_style != "" ) $plugin_style = ' style="'.$plugin_style.'"';
	$wordpress_file_upload_output .= '<div id="'.$shortcode_tag.'_block_'.$sid.'" class="file_div_clean'.( $params["fitmode"] == "responsive" ? '_responsive_container' : '' ).' wfu_container"'.$plugin_style.'>';
	$wordpress_file_upload_output .= "\n\t".'<input type="hidden" id="'.$shortcode_tag.'_'.$sid.'_widgetid" value="'.$widgetid.'" />';
	//add allow no file flag
	$wordpress_file_upload_output .= "\n\t".'<input type="hidden" id="'.$shortcode_tag.'_'.$sid.'_nofile" value="'.( $params["allownofile"] == "true" ? "1" : "0" ).'" />';
	//add visual editor overlay if the current user is administrator
	if ( current_user_can( 'manage_options' ) ) {
		$wordpress_file_upload_output .= wfu_add_visual_editor_button($shortcode_tag, $sid);
	}
	//read indexed component definitions
	$components = wfu_component_definitions();
	$components_indexed = array();
	foreach ( $components as $component ) {
		$components_indexed[$component['id']] = $component;
		$components_indexed[$component['id']]['occurrencies'] = 0;
	}
	$itemplaces = explode("/", $params["placements"]);
	foreach ( $itemplaces as $section ) {
		$items_in_section = explode("+", trim($section));
		$section_array = array( $params["fitmode"] );
		foreach ( $items_in_section as $item_in_section ) {
			$item_in_section = strtolower(trim($item_in_section));
			if ( isset($components_indexed[$item_in_section]) && ( $components_indexed[$item_in_section]['multiplacements'] || $components_indexed[$item_in_section]['occurrencies'] == 0 ) ) {
				$components_indexed[$item_in_section]['occurrencies'] ++;
				$occurrence_index = ( $components_indexed[$item_in_section]['multiplacements'] ? $components_indexed[$item_in_section]['occurrencies'] : 0 );
				if ( $item_in_section == "title" ) array_push($section_array, wfu_prepare_title_block($params, $additional_params, $occurrence_index));
				elseif ( $item_in_section == "filename" ) array_push($section_array, wfu_prepare_textbox_block($params, $additional_params, $occurrence_index));
				elseif ( $item_in_section == "selectbutton" ) array_push($section_array, wfu_prepare_uploadform_block($params, $additional_params, $occurrence_index));
				elseif ( $item_in_section == "uploadbutton" && $params["singlebutton"] != "true" ) array_push($section_array, wfu_prepare_submit_block($params, $additional_params, $occurrence_index));
				elseif ( $item_in_section == "subfolders" ) array_push($section_array, wfu_prepare_subfolders_block($params, $additional_params, $occurrence_index));
				elseif ( $item_in_section == "progressbar" ) array_push($section_array, wfu_prepare_progressbar_block($params, $additional_params, $occurrence_index));
				elseif ( $item_in_section == "message" ) array_push($section_array, wfu_prepare_message_block($params, $additional_params, $occurrence_index));
				elseif ( $item_in_section == "userdata" && $params["userdata"] == "true" ) array_push($section_array, wfu_prepare_userdata_block($params, $additional_params, $occurrence_index));
				elseif ( $item_in_section == "webcam" && $params["webcam"] == "true" ) array_push($section_array, wfu_prepare_webcam_block($params, $additional_params, $occurrence_index));
			}
		}
		$wordpress_file_upload_output .= call_user_func_array("wfu_add_div", $section_array);
	}
	/* Append mandatory blocks, if have not been included in placements attribute */
	if ( $params["userdata"] == "true" && strpos($params["placements"], "userdata") === false ) {
		$section_array = array( $params["fitmode"] );
		array_push($section_array, wfu_prepare_userdata_block($params, $additional_params, 0));
		$wordpress_file_upload_output .= call_user_func_array("wfu_add_div", $section_array);
	}
	if ( strpos($params["placements"], "selectbutton") === false ) {
		$section_array = array( $params["fitmode"] );
		array_push($section_array, wfu_prepare_uploadform_block($params, $additional_params, 0));
		$wordpress_file_upload_output .= call_user_func_array("wfu_add_div", $section_array);
	}

	/* Pass constants to javascript and run plugin post-load actions */
	$consts = wfu_set_javascript_constants();
	$handler = 'function() { wfu_Initialize_Consts("'.$consts.'"); wfu_Load_Code_Connectors('.$sid.'); wfu_plugin_load_action('.$sid.'); }';
	$wordpress_file_upload_output .= "\n\t".'<script type="text/javascript">if(window.addEventListener) { window.addEventListener("load", '.$handler.', false); } else if(window.attachEvent) { window.attachEvent("onload", '.$handler.'); } else { window["onload"] = '.$handler.'; }</script>';
	$wordpress_file_upload_output .= '</div>';
//	$wordpress_file_upload_output .= '<div>';
//	$wordpress_file_upload_output .= wfu_test_admin();
//	$wordpress_file_upload_output .= '</div>';

//	The plugin uses sessions in order to detect if the page was loaded due to file upload or
//	because the user pressed the Refresh button (or F5) of the page.
//	In the second case we do not want to perform any file upload, so we abort the rest of the script.
	if ( !isset($_SESSION['wfu_check_refresh_'.$sid]) || $_SESSION['wfu_check_refresh_'.$sid] != "form button pressed" ) {
		$_SESSION['wfu_check_refresh_'.$sid] = 'do not process';
		$wordpress_file_upload_output .= wfu_post_plugin_actions($params);
		$wordpress_file_upload_output = apply_filters("_wfu_file_upload_output", $wordpress_file_upload_output);
		return $wordpress_file_upload_output."\n";
	}
	$_SESSION['wfu_check_refresh_'.$sid] = 'do not process';
	$params["upload_start_time"] = $_SESSION['wfu_start_time_'.$sid];

//	The plugin uses two ways to upload the file:
//		- The first one uses classic functionality of an HTML form (highest compatibility with browsers but few capabilities).
//		- The second uses ajax (HTML5) functionality (medium compatibility with browsers but many capabilities, like no page refresh and progress bar).
//	The plugin loads using ajax functionality by default, however if it detects that ajax functionality is not supported, it will automatically switch to classic functionality. 
//	The next line checks to see if the form was submitted using ajax or classic functionality.
//	If the uploaded file variable stored in $_FILES ends with "_redirected", then it means that ajax functionality is not supported and the plugin must switch to classic functionality. 
	if ( isset($_FILES[$uploadedfile.'_redirected']) ) $params['forceclassic'] = "true";

	if ( $params['forceclassic'] != "true" ) {
		$wordpress_file_upload_output .= wfu_post_plugin_actions($params);
		$wordpress_file_upload_output = apply_filters("_wfu_file_upload_output", $wordpress_file_upload_output);
		return $wordpress_file_upload_output."\n";
	}

//  The following code is executed in case of non-ajax uploads to process the files.
//  Consecutive checks are performed in order to verify and approve the upload of files
	$_REQUEST = stripslashes_deep($_REQUEST);
	$_POST = stripslashes_deep($_POST);
	$wfu_checkpass = true;
	
//  First we test that WP nonce passes the check
	$wfu_checkpass = ( $wfu_checkpass && isset($_REQUEST["wfu_uploader_nonce"]) && wp_verify_nonce( $_REQUEST["wfu_uploader_nonce"], "wfu-uploader-nonce" ) !== false );

	$unique_id = ( isset($_POST['uniqueuploadid_'.$sid]) ? sanitize_text_field($_POST['uniqueuploadid_'.$sid]) : "" );
//  Check that upload_id is valid
	$wfu_checkpass = ( $wfu_checkpass && strlen($unique_id) == 10 );


	if ( $wfu_checkpass ) {
		//process any error messages due to redirection to non-ajax upload
		if ( isset( $_POST[$adminerrorcodes] ) ) {
			$code = $_POST[$adminerrorcodes];
			if ( $code == "" ) $params['adminerrors'] = "";
			elseif ( $code == "1" || $code == "2" || $code == "3" ) $params['adminerrors'] = constant('WFU_ERROR_REDIRECTION_ERRORCODE'.$code);
			else $params['adminerrors'] = WFU_ERROR_REDIRECTION_ERRORCODE0;
		}
	
		$params['subdir_selection_index'] = -1;
		if ( isset( $_POST[$hiddeninput] ) ) $params['subdir_selection_index'] = sanitize_text_field($_POST[$hiddeninput]);

		$wfu_process_file_array = wfu_process_files($params, 'no_ajax');
		$safe_output = $wfu_process_file_array["general"]['safe_output'];
		unset($wfu_process_file_array["general"]['safe_output']);
		//javascript code generated from individual wfu_after_upload_filters is not executed in non-ajax uploads
		unset($wfu_process_file_array["general"]['js_script']);
		$js_script_enc = "";
		//execute after upload filters
		$ret = wfu_execute_after_upload_filters($sid, $unique_id);
		if ( $ret["js_script"] != "" ) $js_script_enc = wfu_plugin_encode_string($ret["js_script"]);

		$wfu_process_file_array_str = wfu_encode_array_to_string($wfu_process_file_array);
		$ProcessUploadComplete_functiondef = 'function(){wfu_ProcessUploadComplete('.$sid.', 1, "'.$wfu_process_file_array_str.'", "no-ajax", "", "", "'.$safe_output.'", ["false", "", "false"], "fileupload", "'.$js_script_enc.'");}';
		$wordpress_file_upload_output .= '<script type="text/javascript">window.onload='.$ProcessUploadComplete_functiondef.'</script>';
	}
	
	$wordpress_file_upload_output .= wfu_post_plugin_actions($params);
	$wordpress_file_upload_output = apply_filters("_wfu_file_upload_output", $wordpress_file_upload_output);
	return $wordpress_file_upload_output."\n";
}

function wfu_add_visual_editor_button($shortcode_tag, $sid) {
	switch(WFU_FUNCTION_HOOK(__FUNCTION__, func_get_args(), $out)) { case 'X': break; case 'R': return $out; break; case 'D': die($out); break; }
	global $post;
	$echo_str = "\n\t".'<div id="'.$shortcode_tag.'_editor_'.$sid.'" class="wfu_overlay_editor">';
	$echo_str .= "\n\t\t".'<button class="wfu_overlay_editor_button" title="'.WFU_PAGE_PLUGINEDITOR_BUTTONTITLE.'" onclick="wfu_invoke_shortcode_editor('.$sid.', '.$post->ID.', \''.hash('md5', $post->post_content).'\', \''.$shortcode_tag.'\');"><img src="'.WFU_IMAGE_OVERLAY_EDITOR.'" class="wfu_overlay_editor_img" width="20px" height="20px" /></button>';
	$echo_str .= "\n\t".'</div>';
	$echo_str .= "\n\t".'<div id="'.$shortcode_tag.'_overlay_'.$sid.'" class="wfu_overlay_container">';
	$echo_str .= "\n\t\t".'<table class="wfu_overlay_table"><tbody><tr><td><img src="'.WFU_IMAGE_OVERLAY_LOADING.'" /><label>'.WFU_PAGE_PLUGINEDITOR_LOADING.'</label></td></tr></tbody></table>';
	$echo_str .= "\n\t\t".'<div class="wfu_overlay_container_inner"></div>';
	$echo_str .= "\n\t".'</div>';
	
	return $echo_str;
}

function wfu_post_plugin_actions($params) {
	$echo_str = '';

	return $echo_str;
}

function wfu_get_subfolders_paths($params) {
	switch(WFU_FUNCTION_HOOK(__FUNCTION__, func_get_args(), $out)) { case 'X': break; case 'R': return $out; break; case 'D': die($out); break; }
	$subfolder_paths = array ( );
	if ( $params["askforsubfolders"] == "true" && $params["testmode"] != "true" ) {
		array_push($subfolder_paths, "");
		if ( substr($params["subfoldertree"], 0, 4) == "auto" ) {
			$upload_directory = wfu_upload_plugin_full_path($params);
			$dirtree = wfu_getTree($upload_directory);
			foreach ( $dirtree as &$dir ) $dir = '*'.$dir;
			$params["subfoldertree"] = implode(',', $dirtree);
		}
		$subfolders = wfu_parse_folderlist($params["subfoldertree"]);
		if ( count($subfolders['path']) == 0 ) array_push($subfolders['path'], "");
		foreach ( $subfolders['path'] as $subfolder ) array_push($subfolder_paths, $subfolder);
	}

	return $subfolder_paths;
}

function wfu_old_to_new_attributes($shortcode_attrs) {
	//old to new attribute definitions
	$old_to_new = array(
		"dublicatespolicy" => "duplicatespolicy"
	);
	//implement changes
	foreach ( $old_to_new as $old => $new ) {
		if ( isset($shortcode_attrs[$old]) ) {
			$shortcode_attrs[$new] = $shortcode_attrs[$old];
			unset($shortcode_attrs[$old]);
		}
	}
	return $shortcode_attrs;
}

function wfu_classic_before_upload_handler($ret, $attr) {
	//run only if start_time exists in $_REQUEST parameters
	if ( !isset($_REQUEST['start_time']) ) return $ret;
	if ( $ret["status"] == "die" ) return $ret;
	$start_time = sanitize_text_field( $_REQUEST["start_time"] );
	$sid = $attr["sid"];
	if ( $sid == "" ) {
		$ret["status"] = "die";
		return $ret;
	}
	if ( $ret["status"] != "error" ) {
		$ret["status"] = "success";
		$_SESSION['wfu_check_refresh_'.$sid] = 'form button pressed';
		$_SESSION['wfu_start_time_'.$sid] = $start_time;
	}
	return $ret;
}

function wfu_execute_after_upload_filters($sid, $unique_id) {
	//apply internal filters from extensions
	$ret = array( "echo" => "" );
	$files = array();
	if ( isset($_SESSION["filedata_".$unique_id]) ) $files = $_SESSION["filedata_".$unique_id];
	$attr = array( "sid" => $sid, "unique_id" => $unique_id, "files" => $files );
	$ret = apply_filters("_wfu_after_upload", $ret, $attr);
	//then apply any custom filters created by admin
	$echo_str = "";
	$ret = array( "js_script" => "" );
	$ret = apply_filters("wfu_after_upload", $ret, $attr);
	return $ret;
}

?>