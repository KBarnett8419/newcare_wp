<?php
/*
  Plugin Name: BPMContext - Intranet Plus
  Plugin URI: https://bpmcontext.com
  Description: Add an intranet dashboard to facilitate team communications and collaboration with Intranet Plus by BPMContext, a dynamic, extendable plugin for WordPress. Go to Settings -> Intranet Plus to add Intranet Plus to your site.
  Version: 3.1.9
  Author: BPMContext
  Author URI: https://bpmcontext.com
  License: GPLv2+
  Text Domain: bpmcontext
*/

if ( ! function_exists( 'add_action' ) ) {
    die( 'Invalid function call' );
}

global $bpm_sdk_version , $bpm_server_info;

$bpm_server_info['bpm_server']      = 'bpm.bpmcontext.com';
$bpm_server_info['bpm_api']         = 'api_v3_1_9';
$bpm_server_info['bpm_marketing']   = 'bpmcontext.com';
$bpm_this_sdk_version = 319;

if( $bpm_this_sdk_version > $bpm_sdk_version ) $bpm_sdk_version = $bpm_this_sdk_version ;

update_option('bpmcontext-intranet-plus-sdk',$bpm_this_sdk_version);

add_action('admin_init', 'bpm_intranet_plus_load_sdk' , 1 );
add_action('init', 'bpm_intranet_plus_load_sdk' , 1 );

function bpm_intranet_plus_load_sdk(){

    if ( ! function_exists( 'get_plugins' ) ) {
        require_once ABSPATH . 'wp-admin/includes/plugin.php';
    }

    $plugins = get_plugins();

    if( is_plugin_active( 'bpmcontext/bpmcontext.php' ) ) {
        if (isset($plugins['bpmcontext/bpmcontext.php'])) {
            $version = $plugins['bpmcontext/bpmcontext.php']['Version'];
            $version = explode('.',$version);

            if($version[0] < 3){
                //add message to the user
                deactivate_plugins('bpmcontext/bpmcontext.php');

            }
        }
    }

    global $bpm_sdk_version, $bpm_sdk;

    $bpm_this_sdk_version = get_option('bpmcontext-intranet-plus-sdk');

    if($bpm_this_sdk_version >=  $bpm_sdk_version) {

        require_once 'includes/bpm-sdk/start.php';

        if( ! $bpm_sdk ) {

            $bpm_sdk = new bpmcontext_sdk_manager();
            $bpm_sdk->bpm_load_actions();
        }

    }

}

/**
 * start of bpmcontext sdk setup
 */
global $bpm_solution_sets;
$bpm_solution_sets['intranet_plus'] = 7;

global $bpm_plugin_name;
$bpm_plugin_name = 'Intranet Plus';

global $bpm_right_boxes;
$bpm_right_boxes['event_data']  = array('name'=>'event_data');
$bpm_right_boxes['contactform'] = array('name'=>'contactform');
$bpm_right_boxes['infobox']     = array('name'=>'infobox');
$bpm_right_boxes['tutorial']    = array('name'=>'tutorial');
$bpm_right_boxes['workspace_map']    = array('name'=>'workspace_map');
$bpm_right_boxes['cust_supp']   = array('name'=>'cust_supp');
$bpm_right_boxes['subscribers'] = array('name'=>'subscribers');
$bpm_right_boxes['history']     = array('name'=>'history');
$bpm_right_boxes['sharing']     = array('name'=>'sharing');
$bpm_right_boxes['changelog']   = array('name'=>'changelog');

global $bpm_home_page_widgets;
$bpm_home_page_widgets['promoted']      = array('name'=>'promoted', 'title' => 'Newsfeed');
$bpm_home_page_widgets['calendar']      = array('name'=>'calendar', 'title' => 'Calendar');
$bpm_home_page_widgets['directory']     = array('name'=>'directory', 'width'=>2, 'title'=>'Employee Directory');
$bpm_home_page_widgets['recent']        = array('name'=>'recent', 'width'=>1, 'title'=>'Recent Changes');
$bpm_home_page_widgets['notifications'] = array('name'=>'notifications', 'width'=>1 , 'title'=>'Notifications');
$bpm_home_page_widgets['bookmarks']     = array('name'=>'bookmarks', 'width'=>1 , 'title' => 'Bookmarks');
$bpm_home_page_widgets['subscriptions'] = array('name'=>'subscriptions', 'width'=>1 , 'title'=>'Subscriptions');
$bpm_home_page_widgets['myhistory']     = array('name'=>'myhistory', 'width'=>1, 'title'=>'My History');

global $bpm_site_type_token;
$bpm_site_type_token = 'f990d185-e7bf-11e4-b43f-878390a1d9ca0';

global $bpm_left_menu;

global $bpm_onboarding;

global $admin_menu_items;

global $bpm_first_redirect;
$bpm_first_redirect = 'bpm_options';
/**
 * end of bpmcontext sdk setup
 */

// Add settings link on plugin page
$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_$plugin", 'bpm_settings_link' );
function bpm_settings_link($links) {

    $settings_link = '<a href="https://support.bpmcontext.com" target="_blank">'.__('Support Site', 'bpm_intranet_plus').'</a>';
    array_unshift($links, $settings_link);
    $settings_link = '<a href="admin.php?page=bpm_options">'.__('Settings', 'bpm_intranet_plus').'</a>';
    array_unshift($links, $settings_link);

    return $links;
}

//load localization files for Intranet Plus
add_action( 'init', 'bpm_intranet_plus_load_textdomain' );
function bpm_intranet_plus_load_textdomain() {
    load_plugin_textdomain('bpmcontext', false, dirname(plugin_basename(__FILE__)) . '/includes/bpm-sdk/Languages');
}

add_action( 'admin_init', 'bpm_redirect');

//Activate then redirect to the contact plus page
register_activation_hook( __FILE__, 'bpm_activate' );
function bpm_activate() {
    global $bpm_first_redirect;

	update_option( 'bpm_activation_redirect', true );
    update_option('reactivate', 1);
    update_option('bpm_redirect_to', $bpm_first_redirect);

}

function bpm_redirect() {
    if (get_option('bpm_activation_redirect', false)) {
        delete_option('bpm_activation_redirect');
        if ( ! is_multisite() ) {
            wp_redirect("admin.php?page=bpm_options");
            exit;
        }
    }
}
?>