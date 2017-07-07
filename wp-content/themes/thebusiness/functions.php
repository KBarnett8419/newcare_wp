<?php
/**
 * thebusiness functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package thebusiness
 */

/**
 * Get the path for the file ( to support child theme )
 *
 * @since thebusiness 1.0.0
 *
 * @param string $file_path, path from the theme
 * @return string full path of file inside theme
 *
 */
if( !function_exists('thebusiness_file_directory') ){
	function thebusiness_file_directory( $file_path ){

		if( file_exists( trailingslashit( get_stylesheet_directory() ) . $file_path) ){
			return trailingslashit( get_stylesheet_directory() ) . $file_path;
		}
		else{
			return trailingslashit( get_template_directory() ) . $file_path;
		}
	}
}

/**
 * require thebusiness int.
 */
require get_template_directory() . '/inc/init.php';

if ( ! function_exists( 'thebusiness_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function thebusiness_setup() {

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );


	/*
	 * Enable support for image sizes on posts and pages.
	 *
	 * @link https://developer.wordpress.org/reference/functions/add_image_size/
	 */
	add_image_size( 'thebusiness-main-banner', 1370, 650, true );
	add_image_size( 'thebusiness-about-image', 600, 400, true );
	add_image_size( 'thebusiness-team-image', 400, 600, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'thebusiness' ),
		'social' => esc_html__( 'Social Menu', 'thebusiness' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'thebusiness_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	/*implimenting new feature from 4.5*/
	add_theme_support( 'custom-logo', array(
	   'header-text' => array( 'site-title', 'site-description' ),
	   'height'      => 50,
	   'width'       => 165,
	   'flex-width' => true
	) );
	
}
endif;
add_action( 'after_setup_theme', 'thebusiness_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function thebusiness_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'thebusiness_content_width', 640 );
}
add_action( 'after_setup_theme', 'thebusiness_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */


function thebusiness_scripts() {
		wp_enqueue_style( 'thebusiness-style', get_stylesheet_uri() );
		/*google fonts*/
		wp_enqueue_style( 'thebusiness-google-fonts', '//fonts.googleapis.com/css?family=Merriweather:300,400,700' );
	 	//  VARIABLES AND ARRAY
        $assets_url = get_template_directory_uri() .'/assets/';
        $style_deps = array( 'bootstrap', 'dm-font-awesome' );
        $script_deps = array('jquery', 'bootstrap', 'nicescroll', 'gsap', 'wow', 'thebusiness-custom-plugin' );
        
        // REGISTER STYLE
	wp_register_style( 'bootstrap', $assets_url.'css/vendor/bootstrap.min.css', array(), 'v3.3.6' );
	wp_register_style( 'dm-font-awesome', $assets_url.'font-awesome/css/font-awesome.min.css', array(), '4.6.3' );
        
        // REGISTER SCRIPT
        wp_register_script( 'bootstrap', $assets_url.'js/vender/bootstrap.min.js', array(), 'v3.3.6', true );
        wp_register_script( 'nicescroll', $assets_url.'js/vender/nicescroll.js', array(), 'v3.6.6', true );
        wp_register_script( 'gsap', $assets_url.'js/vender/gsap.min.js', array(), '1.18.4', true );
        wp_register_script( 'wow', $assets_url.'js/vender/wow.min.js', array(), '1.1.3', true );
        wp_register_script( 'thebusiness-custom-plugin', $assets_url.'js/cus-plugin.js', array(), '1.1.3', true );
        
        //ENQUEUE
        wp_enqueue_style( 'thebusiness-main', $assets_url.'css/main.css', $style_deps );
        wp_enqueue_script( 'thebusiness-main', $assets_url.'js/main.js', $script_deps, null, true );
        
	wp_enqueue_script( 'navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'thebusiness_scripts' );



/*added admin css for meta*/
function thebusiness_admin_style($hook) {
	if ( in_array( $hook, array( 'post.php', 'post-new.php' ) ) ) {
        wp_register_style( 'thebusiness-admin-meta-css', get_template_directory_uri() . '/assets/css/custom-meta.css',array(), ''  );
        wp_enqueue_style( 'thebusiness-admin-meta-css' );
    }
}
add_action( 'admin_enqueue_scripts', 'thebusiness_admin_style' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/*breadcrum function*/

if ( ! function_exists( 'thebusiness_simple_breadcrumb' ) ) :

	/**
	 * Simple breadcrumb.
	 *
	 * @since 1.0.0
	 */
	function thebusiness_simple_breadcrumb() {

		if ( ! function_exists( 'breadcrumb_trail' ) ) {
			require_once get_template_directory() . '/assets/breadcrumbs/breadcrumbs.php';
		}

		$breadcrumb_args = array(
			'container'   => 'div',
			'show_browse' => false,
		);
		breadcrumb_trail( $breadcrumb_args );

	}

endif;


/*update to pro added*/
require_once( trailingslashit( get_template_directory() ) . 'trt-customize-pro/thebusiness/class-customize.php' );