<?php
/**
 * salient themes Theme Customizer
 *
 * @package salient themes
 * @subpackage thebusiness
 * @since thebusiness 1.0.0
 */
add_filter('salient_customizer_framework_url', 'thebusiness_customizer_framework_url');

if( ! function_exists( 'thebusiness_customizer_framework_url' ) ):

    function thebusiness_customizer_framework_url(){
        return trailingslashit( get_template_directory_uri() ) . 'inc/frameworks/salient-customizer/';
    }

endif;

add_filter('salient_customizer_framework_path', 'thebusiness_customizer_framework_path');

if( ! function_exists( 'thebusiness_customizer_framework_path' ) ):
    function thebusiness_customizer_framework_path(){
        return trailingslashit( get_template_directory() ) . 'inc/frameworks/salient-customizer/';
    }
endif;

/*define constant for coder-customizer-constant*/
if(!defined('salient_CUSTOMIZER_NAME')){
    define('salient_CUSTOMIZER_NAME','thebusiness-options');
}


/**
 * reset options
 * @param  array $reset_options
 * @return void
 *
 * @since thebusiness 1.0
 */
if ( ! function_exists( 'thebusiness_reset_options' ) ) :
    function thebusiness_reset_options( $reset_options ) {
        set_theme_mod( salient_CUSTOMIZER_NAME, $reset_options );
    }
endif;
/**
 * Customizer framework added.
 */
require get_template_directory().'/inc/frameworks/salient-customizer/salient-customizer.php';

global $thebusiness_panels;
global $thebusiness_sections;
global $thebusiness_settings_controls;
global $thebusiness_repeated_settings_controls;
global $thebusiness_customizer_defaults;

/******************************************
Featured Slider options
 *******************************************/
require get_template_directory().'/inc/customizer/featured-slider/slider-panel.php';

/******************************************
Home Service options
 *******************************************/
require get_template_directory().'/inc/customizer/home-service/service-panel.php';

/******************************************
Home About options 
 *******************************************/
require get_template_directory().'/inc/customizer/home-about/home-about-panel.php';

/******************************************
Home Testimonial options 
 *******************************************/
require get_template_directory().'/inc/customizer/home-testimonial/testimonial-panel.php';

/******************************************
Home Blog options 
 *******************************************/
require get_template_directory().'/inc/customizer/home-blog/home-blog-panel.php';

/******************************************
Home team options 
 *******************************************/
require get_template_directory().'/inc/customizer/home-team/team-panel.php';

/******************************************
Theme options panel
 *******************************************/
require get_template_directory().'/inc/customizer/theme-options/option-panel.php';
/******************************************
Removing section setting control
 *******************************************/

$thebusiness_remove_sections =
    array(
        'header_image' 
    );
$thebusiness_remove_settings_controls =
    array(
        'display_header_text'
    );

$thebusiness_customizer_args = array(
    'panels'            => $thebusiness_panels, /*always use key panels */
    'sections'          => $thebusiness_sections,/*always use key sections*/
    'settings_controls' => $thebusiness_settings_controls,/*always use key settings_controls*/
    'repeated_settings_controls' => $thebusiness_repeated_settings_controls,/*always use key sections*/
    'remove_sections'   => $thebusiness_remove_sections,/*always use key remove_sections*/
    'remove_settings_controls' => $thebusiness_remove_settings_controls/*always use key remove_settings_controls*/
);

/*registering panel section setting and control start*/
function thebusiness_add_panels_sections_settings() {
    global $thebusiness_customizer_args;
    return $thebusiness_customizer_args;
}
add_filter( 'salient_customizer_panels_sections_settings', 'thebusiness_add_panels_sections_settings' );
/*registering panel section setting and control end*/

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function thebusiness_customize_register( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'thebusiness_customize_register' );
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function thebusiness_customize_preview_js() {
    wp_enqueue_script( 'thebusiness-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20160105', true );
}
add_action( 'customize_preview_init', 'thebusiness_customize_preview_js' );



/**
 * get all saved options
 * @param  null
 * @return array saved options
 *
 * @since thebusiness 1.0
 */
if ( ! function_exists( 'thebusiness_get_all_options' ) ) :
    function thebusiness_get_all_options( $merge_default = 0 ) {
        $thebusiness_customizer_saved_values = salient_customizer_get_all_values( );
        if( 1 == $merge_default ){
            global $thebusiness_customizer_defaults;
            if(is_array( $thebusiness_customizer_saved_values )){
                $thebusiness_customizer_saved_values = array_merge($thebusiness_customizer_defaults, $thebusiness_customizer_saved_values );
            }
            else{
                $thebusiness_customizer_saved_values = $thebusiness_customizer_defaults;
            }
        }
        return $thebusiness_customizer_saved_values;
    }
endif;