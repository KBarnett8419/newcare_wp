<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function thebusiness_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'thebusiness' ),
        'id'            => 'sidebar-1',
        'description'   => '',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    $thebusiness_get_all_options = thebusiness_get_all_options(1);
    $thebusiness_footer_widgets_number = $thebusiness_get_all_options['thebusiness-footer-sidebar-number'];

    if( $thebusiness_footer_widgets_number > 0 ){
        register_sidebar(array(
            'name' => __('Footer Column One', 'thebusiness'),
            'id' => 'footer-col-one',
            'description' => __('Displays items on footer section.','thebusiness'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title'  => '<h1 class="widget-title">',
            'after_title'   => '</h1>',
        ));
        if( $thebusiness_footer_widgets_number > 1 ){
            register_sidebar(array(
                'name' => __('Footer Column Two', 'thebusiness'),
                'id' => 'footer-col-two',
                'description' => __('Displays items on footer section.','thebusiness'),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title'  => '<h1 class="widget-title">',
                'after_title'   => '</h1>',
            ));
        }
    }
}
add_action( 'widgets_init', 'thebusiness_widgets_init' );