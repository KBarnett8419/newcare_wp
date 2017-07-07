<?php
if ( ! function_exists( 'thebusiness_set_global' ) ) :
/**
 * Setting global values for all saved customizer values
 *
 * @since theBusiness 1.0.0
 *
 * @param null
 * @return null
 *
 */
function thebusiness_set_global() {
    /*Getting saved values start*/
    $GLOBALS['thebusiness_customizer_all_values'] = thebusiness_get_all_options(1);
}
endif;
add_action( 'thebusiness_action_before_head', 'thebusiness_set_global', 0 );

if ( ! function_exists( 'thebusiness_doctype' ) ) :
/**
 * Doctype Declaration
 *
 * @since theBusiness 1.0.0
 *
 * @param null
 * @return null
 *
 */
function thebusiness_doctype() {
    ?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?>>
<?php
}
endif;
add_action( 'thebusiness_action_before_head', 'thebusiness_doctype', 10 );

if ( ! function_exists( 'thebusiness_before_wp_head' ) ) :
/**
 * Before wp head codes
 *
 * @since theBusiness 1.0.0
 *
 * @param null
 * @return null
 *
 */
function thebusiness_before_wp_head() {
    ?>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<?php
}
endif;
add_action( 'thebusiness_action_before_wp_head', 'thebusiness_before_wp_head', 10 );

if( ! function_exists( 'thebusiness_default_layout' ) ) :
    /**
     * theBusiness default layout function
     *
     * @since  theBusiness 1.0.0
     *
     * @param int
     * @return string
     */
    function thebusiness_default_layout( $post_id = null ){

        global $thebusiness_customizer_all_values,$post;
        $thebusiness_default_layout = $thebusiness_customizer_all_values['thebusiness-default-layout'];
        if( is_home()){
            $post_id = get_option( 'page_for_posts' );
        }
        if( null == $post_id && isset ( $post->ID ) ){
            $post_id = $post->ID;
        }
        $thebusiness_default_layout_meta = get_post_meta( $post_id, 'thebusiness-default-layout', true );

        if( false != $thebusiness_default_layout_meta ) {
            $thebusiness_default_layout = $thebusiness_default_layout_meta;
        }
        return $thebusiness_default_layout;
    }
endif;

if ( ! function_exists( 'thebusiness_body_class' ) ) :
/**
 * add body class
 *
 * @since theBusiness 1.0.0
 *
 * @param null
 * @return null
 *
 */
function thebusiness_body_class( $thebusiness_body_classes ) {
    if(!is_front_page() || ( is_front_page())){
        $thebusiness_default_layout = thebusiness_default_layout();
        if( !empty( $thebusiness_default_layout ) ){
            if( 'left-sidebar' == $thebusiness_default_layout ){
                $thebusiness_body_classes[] = 'salient-left-sidebar';
            }
            elseif( 'right-sidebar' == $thebusiness_default_layout ){
                $thebusiness_body_classes[] = 'salient-right-sidebar';
            }
            elseif( 'both-sidebar' == $thebusiness_default_layout ){
                $thebusiness_body_classes[] = 'salient-both-sidebar';
            }
            elseif( 'no-sidebar' == $thebusiness_default_layout ){
                $thebusiness_body_classes[] = 'salient-no-sidebar';
            }
            else{
                $thebusiness_body_classes[] = 'salient-right-sidebar';
            }
        }
        else{
            $thebusiness_body_classes[] = 'salient-right-sidebar';
        }
    }
    return $thebusiness_body_classes;

}
endif;
add_action( 'body_class', 'thebusiness_body_class', 10, 1);

if ( ! function_exists( 'thebusiness_before_page_start' ) ) :
/**
 * intro loader
 *
 * @since theBusiness 1.0.0
 *
 * @param null
 * @return null
 *
 */
function thebusiness_before_page_start() {
    global $thebusiness_customizer_all_values;
    /*intro loader*/
}
endif;
add_action( 'thebusiness_action_before', 'thebusiness_before_page_start', 10 );

if ( ! function_exists( 'thebusiness_page_start' ) ) :
/**
 * page start
 *
 * @since theBusiness 1.0.0
 *
 * @param null
 * @return null
 *
 */
function thebusiness_page_start() {
?>
    <div id="page" class="site">
<?php
}
endif;
add_action( 'thebusiness_action_before', 'thebusiness_page_start', 15 );

if ( ! function_exists( 'thebusiness_skip_to_content' ) ) :
/**
 * Skip to content
 *
 * @since theBusiness 1.0.0
 *
 * @param null
 * @return null
 *
 */
function thebusiness_skip_to_content() {
    ?>
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'thebusiness' ); ?></a>
<?php
}
endif;
add_action( 'thebusiness_action_before_header', 'thebusiness_skip_to_content', 10 );

if ( ! function_exists( 'thebusiness_header' ) ) :
/**
 * Main header
 *
 * @since theBusiness 1.0.0
 *
 * @param null
 * @return null
 *
 */
function thebusiness_header() {
    global $thebusiness_customizer_all_values;
    global $wp_version;
    global $post;
    ?>
        <header id="masthead" class="wrapper site-header" role="banner">
                <div class="container">
                    <div class="row">
                        <!-- site branding -->
                        <div class="col-xs-9 col-sm-10 col-md-4">
                            <div class="site-branding">
                                        <?php thebusiness_the_custom_logo(); ?>
                                        <?php if ( is_front_page() && is_home() ) : ?>
                                            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                                        <?php else : ?>
                                            <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                                        <?php endif;

                                        $description = get_bloginfo( 'description', 'display' );
                                        if ( $description || is_customize_preview() ) : ?>
                                            <h2 class="site-description"><?php echo esc_html($description); ?></h2>
                                        <?php endif;
                                ?>
                            </div><!-- .site-branding -->
                        </div><!-- .col-md-3 -->

                        <div class="col-xs-3 col-sm-2 col-md-8">
                            <button id="tbNavToggle" class="menu-toggle"><span></span><span></span><span></span></button>
                            <div class="navigation">
                                <!-- site navigation -->
                                <nav id="site-navigation" class="main-navigation sidenav" role="navigation">
                                    <a href="javascript:void(0)" class="closebtn">&times;</a>
                                    <?php wp_nav_menu(array('theme_location' => 'primary', 'menu_id' => 'primary-menu')); ?>
                                </nav><!-- #site-navigation -->
                            </div><!-- /.navigation -->
                           
                        </div><!-- .col-md-9 -->
                    </div>
            </div>
        </header>
    <?php if (  is_front_page() && !is_home() ) { ?>
    <div id="content" class="site-content">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
    <?php } 
    else {
        do_action('thebusiness-page-inner-title');
    }
    ?>

<?php 
}
endif;
add_action( 'thebusiness_action_header', 'thebusiness_header', 10 );

if( ! function_exists( 'thebusiness_add_breadcrumb' ) ) :

/**
 * Breadcrumb
 *
 * @since theBusiness 1.0.0
 *
 * @param null
 * @return null
 *
 */
    function thebusiness_add_breadcrumb(){
        global $thebusiness_customizer_all_values;
        // Bail if Breadcrumb disabled
        $breadcrumb_enable_breadcrumb = $thebusiness_customizer_all_values['thebusiness-enable-breadcrumb' ];
        if ( 1 != $breadcrumb_enable_breadcrumb ) {
            return;
        }
        // Bail if Home Page
        if ( is_front_page() || is_home() ) {
            return;
        }
        echo '<div id="breadcrumb" class="breadcrumb-wrap">';
         thebusiness_simple_breadcrumb();
        echo '</div><!-- #breadcrumb -->';
    }
endif;
add_action( 'thebusiness_action_after_title', 'thebusiness_add_breadcrumb', 10 );


