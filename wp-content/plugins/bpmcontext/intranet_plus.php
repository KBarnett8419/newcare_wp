<?php

/**
 * Setup connection to Intranet Plus
 * NOTE:  THIS MUST BE PLACED ON THE MAIN PHP PAGE OF YOUR PLUGIN
 */



/**
 * Add a dismissible tip and recommended Plugins link to the plugins page
 */

if ( !class_exists('bpm_intranet_plus_recommended_plugin') ) {

    class bpm_intranet_plus_recommended_plugin
    {

        public $plugin_information;

        function __construct(){

        }

        public function bpm_load_recommendations(){
            add_action('admin_init', array($this, 'bpm_nag_ignore'));
            add_action('admin_notices', array($this, 'bpm_admin_notice'));
            add_filter('plugin_row_meta', array($this, 'bpm_settings_link') , 10 , 2);
        }

        function bpm_settings_link($links, $file)
        {

            //if the admin has installed Intranet Plus already then this link will not be displayed. otherwise we can show them the readme with an option to install the plugin
            $is_installed = false;
            if (is_plugin_active('bpmcontext/bpmcontext.php')) $is_installed = true;

            if (!$is_installed) {
                if (strpos( $this->plugin_information['plugin_file'] , plugin_dir_path($file) ) !== false) {
                    $path = network_admin_url( 'plugin-install.php' );
                    $links[] = __('<a class="thickbox" data-title="Intranet Plus Integration" aria-label="More information about Intranet Plus Integration" href="'.$path.'?tab=plugin-information&plugin=bpmcontext&TB_iframe=true&width=772&height=847">Recommended Plugin</a>');
                }
            }

            return $links;
        }

        /**
         * add a dismissible tip to tell the admin that this plugin is compatible with Intranet Plus
         */

        function bpm_admin_notice()
        {

            global $current_user , $pagenow;

            $user_id = $current_user->ID;
            if ($pagenow == 'plugins.php' && !get_user_meta($user_id, $this->plugin_information['plugin_prefix'].'_bpm_ignore_notice')) {
                $path = network_admin_url( 'plugin-install.php' );
                echo '<div class="updated"><p>';
                printf(__($this->plugin_information['plugin_name'].' Recommended Plugin: <a class="thickbox" data-title="Intranet Plus Integration" aria-label="More information about Intranet Plus Integration" href="%1$s" style="text-decoration: underline">Intranet Plus</a> with Form-to-Lead Management can help you track and manage contact inquiries. Messages are captured using Intranet Plus to organize leads and improve follow up. | <a href="?'.$this->plugin_information['plugin_prefix'].'_bpm_nag_ignore=0">Hide Notice</a>'), $path.'?tab=plugin-information&plugin=bpmcontext&TB_iframe=true&width=772&height=847');
                echo '</p></div>';
            }
        }

        /**
         * clear the dismissible tip
         */

        function bpm_nag_ignore()
        {

            global $current_user;
            $user_id = $current_user->ID;
            if (isset($_GET[$this->plugin_information['plugin_prefix'].'_bpm_nag_ignore']) && '0' == $_GET[$this->plugin_information['plugin_prefix'].'_bpm_nag_ignore']) {
                add_user_meta($user_id, $this->plugin_information['plugin_prefix'].'_bpm_ignore_notice', 'true', true);
            }
        }
    }
}
?>