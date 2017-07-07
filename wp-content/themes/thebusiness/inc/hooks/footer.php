<?php
if ( ! function_exists( 'thebusiness_before_footer' ) ) :
    /**
     * Footer content
     *
     * @since theBusiness 1.0.0
     *
     * @param null
     * @return false | void
     *
     */
    function thebusiness_before_footer() {
    ?>
    <?php if (  is_front_page() && !is_home() ) { ?>
        </main><!-- #main -->
            </div><!-- #primary -->
    <?php } ?>

        <!-- *****************************************
             Footer section starts
    ****************************************** -->
    <footer id="colophon" class="wrapper site-footer" role="contentinfo">
    <?php
    }
endif;
add_action( 'thebusiness_action_before_footer', 'thebusiness_before_footer', 10 );

if ( ! function_exists( 'thebusiness_widget_before_footer' ) ) :
    /**
     * Footer content
     *
     * @since thebusiness 1.0.0
     *
     * @param null
     * @return false | void
     *
     */
    function thebusiness_widget_before_footer() {
        global $thebusiness_customizer_all_values;
        $thebusiness_footer_widgets_number = $thebusiness_customizer_all_values['thebusiness-footer-sidebar-number'];
        if( $thebusiness_footer_widgets_number <= 0 ){
            return false;
        }
        if( !is_active_sidebar( 'footer-col-one' ) && !is_active_sidebar( 'footer-col-two' ) && !is_active_sidebar( 'footer-col-three' ) && !is_active_sidebar( 'footer-col-four' )){
            return false;
        }
        if( 1 == $thebusiness_footer_widgets_number ){
                $col = 'col-md-12';
            }
        elseif( 2 == $thebusiness_footer_widgets_number ){
            $col = 'col-md-6';
        }
        elseif( 3 == $thebusiness_footer_widgets_number ){
            $col = 'col-md-4';
        }
        elseif( 4 == $thebusiness_footer_widgets_number ){
            $col = 'col-md-3';
        }
        else{
            $col = 'col-md-3';
        }
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <?php if( is_active_sidebar( 'footer-col-one' ) && $thebusiness_footer_widgets_number > 0 ) : ?>
                            <div class="contact-list <?php echo esc_attr( $col );?>">
                                <?php dynamic_sidebar( 'footer-col-one' ); ?>
                            </div>
                        <?php endif; ?>
                        <?php if( is_active_sidebar( 'footer-col-two' ) && $thebusiness_footer_widgets_number > 1 ) : ?>
                            <div class="contact-list <?php echo esc_attr( $col );?>">
                                <?php dynamic_sidebar( 'footer-col-two' ); ?>
                            </div>
                        <?php endif; ?>
                        <?php if( is_active_sidebar( 'footer-col-three' ) && $thebusiness_footer_widgets_number > 2 ) : ?>
                            <div class="contact-list <?php echo esc_attr( $col );?>">
                                <?php dynamic_sidebar( 'footer-col-three' ); ?>
                            </div>
                        <?php endif; ?>
                        <?php if( is_active_sidebar( 'footer-col-four' ) && $thebusiness_footer_widgets_number > 3 ) : ?>
                            <div class="contact-list <?php echo esc_attr( $col );?>">
                                <?php dynamic_sidebar( 'footer-col-four' ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
    <?php
    }
endif;
add_action( 'thebusiness_action_widget_before_footer', 'thebusiness_widget_before_footer', 10 );

if ( ! function_exists( 'thebusiness_footer' ) ) :
    /**
     * Footer content
     *
     * @since theBusiness 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function thebusiness_footer() {
        global $thebusiness_customizer_all_values;
        ?>
                 <div class="clearfix"></div>
                <div class="col-md-12">
                    <div class="social-links-n-copy-right text-center">
                    <?php
                        if( has_nav_menu( 'social' ) ){
                    ?>
                        <div class="social-widget salient-social-section social-icon-only top-tooltip">
                            <?php
                                wp_nav_menu( array( 'theme_location' => 'social', 'link_before' => '<span>',
                                    'link_after'=>'</span>' , 'menu_id' => 'primary-menu','fallback_cb' => false, ) );
                            ?>
                        </div>
                    <?php
                        }
                    ?>
                    <!-- footer site info -->
                        <div class="copy-right text-center">
                            <?php
                            if(isset($thebusiness_customizer_all_values['thebusiness-copyright-text'])){
                                echo wp_kses_post( $thebusiness_customizer_all_values['thebusiness-copyright-text'] );
                            }
                            ?>
                            <?php
                             if( 1 == $thebusiness_customizer_all_values['thebusiness-enable-theme-name']){
                                ?>
                            <span class="sep"> | </span>
                            <?php printf( esc_html__( 'Theme: %1$s by %2$s', 'thebusiness' ), 'theBusiness', '<a href="http://salientthemes.com/" target = "_blank" rel="designer">salientthemes </a>' ); ?>
                            <?php
                            }
                            ?>
                        </div>
                    </div><!-- .social-links-n-copy-right -->
                </div><!-- .col-md-12 -->
            </div>
        </div>
    </footer><!-- #colophon -->
    <!-- *****************************************
             Footer section ends
    ****************************************** -->
    <?php
    }
endif;
add_action( 'thebusiness_action_footer', 'thebusiness_footer', 10 );

if ( ! function_exists( 'thebusiness_page_end' ) ) :
    /**
     * Page end
     *
     * @since theBusiness 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function thebusiness_page_end() {
    global $thebusiness_customizer_all_values;
        ?>
        </div><!-- #page -->
    <?php
     if( isset( $thebusiness_customizer_all_values['thebusiness-enable-back-to-top'] )  && 1 == $thebusiness_customizer_all_values['thebusiness-enable-back-to-top']) {
        ?>
            <a id="gotop" class="back-tonav" href="#page"><i class="fa fa-angle-up"></i></a>
        <?php
        }
    }
endif;
add_action( 'thebusiness_action_after', 'thebusiness_page_end', 10 );