<?php
if ( ! function_exists( 'thebusiness_home_service_array' ) ) :
    /**
     * Service Section array creation
     *
     * @since thebusiness 1.0.0
     *
     * @param string $from_service
     * @return array
     */
    function thebusiness_home_service_array( $from_service ){
        global $thebusiness_customizer_all_values;
        $thebusiness_home_service_number = absint($thebusiness_customizer_all_values['thebusiness-home-service-number']);
        $thebusiness_home_service_single_words = absint($thebusiness_customizer_all_values['thebusiness-home-page-service-single-words']);

        $thebusiness_home_service_contents_array = array();

        $thebusiness_home_service_contents_array[1]['thebusiness-home-service-title'] = __('Clean Designs', 'thebusiness');
        $thebusiness_home_service_contents_array[1]['thebusiness-home-service-content'] = __("Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.", 'thebusiness');
        $thebusiness_home_service_contents_array[1]['thebusiness-home-service-link'] = '#';
        $thebusiness_home_service_contents_array[1]['thebusiness-home-service-page-icon'] = 'fa-desktop';
        $thebusiness_home_service_contents_array[1]['thebusiness-home-service-page-link-text'] = __('Know More','thebusiness');

        $thebusiness_icons_array = array('thebusiness-home-service-page-icon');
        $thebusiness_home_service_page = array('thebusiness-home-service-pages-ids');

        $thebusiness_icons_arrays = salient_customizer_get_repeated_all_value(3 , $thebusiness_icons_array);

        if ( 'from-category' ==  $from_service ){
            $thebusiness_home_service_category = $thebusiness_customizer_all_values['thebusiness-home-service-category'];
            if( 0 != $thebusiness_home_service_category ){
                $thebusiness_home_service_args =    array(
                    'post_type' => 'post',
                    'cat' => absint($thebusiness_home_service_category),
                    'posts_per_page' => absint($thebusiness_home_service_numbe)
                );
            }
        }else {
                $thebusiness_home_service_posts = salient_customizer_get_repeated_all_value(3 , $thebusiness_home_service_page);
                $thebusiness_home_service_posts_ids = array();
                if( null != $thebusiness_home_service_posts ) {
                    foreach( $thebusiness_home_service_posts as $thebusiness_home_service_post ) {
                        if( 0 != $thebusiness_home_service_post['thebusiness-home-service-pages-ids'] ){
                            $thebusiness_home_service_posts_ids[] = $thebusiness_home_service_post['thebusiness-home-service-pages-ids'];
                        }
                    }
                    if( !empty( $thebusiness_home_service_posts_ids )){
                        $thebusiness_home_service_args =    array(
                            'post_type' => 'page',
                            'post__in' => array_map( 'absint', $thebusiness_home_service_posts_ids ),
                            'posts_per_page' => absint($thebusiness_home_service_number),
                            'orderby' => 'post__in'
                        );
                    }
                }
            }
        // the query
        if( !empty( $thebusiness_home_service_args )){

            $thebusiness_home_service_contents_array = array(); /*again empty array*/
            $thebusiness_home_service_post_query = new WP_Query( $thebusiness_home_service_args );
            if ( $thebusiness_home_service_post_query->have_posts() ) :
                $i = 1;
                while ( $thebusiness_home_service_post_query->have_posts() ) : $thebusiness_home_service_post_query->the_post();
                    $thebusiness_home_service_contents_array[$i]['thebusiness-home-service-title'] = get_the_title();
                    if (has_excerpt()) {
                        $thebusiness_home_service_contents_array[$i]['thebusiness-home-service-content'] = get_the_excerpt();
                    }
                    else {
                        $thebusiness_home_service_contents_array[$i]['thebusiness-home-service-content'] = thebusiness_words_count( $thebusiness_home_service_single_words ,get_the_content());
                    }
                    $thebusiness_home_service_contents_array[$i]['thebusiness-home-service-link'] = get_permalink();
                    if(isset( $thebusiness_icons_arrays[$i] )){
                        $thebusiness_home_service_contents_array[$i]['thebusiness-home-service-page-icon'] = $thebusiness_icons_arrays[$i]['thebusiness-home-service-page-icon'];
                    }
                    else{
                        $thebusiness_home_service_contents_array[$i]['thebusiness-home-service-page-icon'] = 'fa-desktop';
                    }
                    $thebusiness_home_service_contents_array[$i]['thebusiness-home-service-page-link-text'] = __('Know More','thebusiness');

                    $i++;
                endwhile;
                wp_reset_postdata();
            endif;
        }
        return $thebusiness_home_service_contents_array;
    }
endif;

if ( ! function_exists( 'thebusiness_home_service' ) ) :
    /**
     * Service Section
     *
     * @since thebusiness 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function thebusiness_home_service() {
        global $thebusiness_customizer_all_values;
        if( 1 != $thebusiness_customizer_all_values['thebusiness-home-service-enable'] ){
            return null;
        }
        $thebusiness_home_service_selection_options = $thebusiness_customizer_all_values['thebusiness-home-service-selection'];
        $thebusiness_service_arrays = thebusiness_home_service_array( $thebusiness_home_service_selection_options );
        if( is_array( $thebusiness_service_arrays )){
            $thebusiness_home_service_number = absint($thebusiness_customizer_all_values['thebusiness-home-service-number']);
            $thebusiness_home_service_title = $thebusiness_customizer_all_values['thebusiness-home-service-title'];
            $thebusiness_home_service_button_text = $thebusiness_customizer_all_values['thebusiness-home-service-button-text'];
            ?>          
            <div class="db-our-service">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="s-title">
                                <span class="line wow scalex" accesskey="data-wow-duration="1.5s""></span>
                                <?php if(!empty( $thebusiness_home_service_title ) ){ ?>
                                    <h2 class="wow zoomOut-wo" data-wow-duration="1s"><?php echo esc_html(  $thebusiness_home_service_title); ?></h2>
                                <?php } ?>
                            </div><!-- .title -->
                        </div><!-- .col-md-12 -->
                        <div class="icons-n-titles-coll">
                            
                            <?php
                            $i = 1;
                            foreach( $thebusiness_service_arrays as $thebusiness_service_array ){
                                if( $thebusiness_home_service_number < $i){
                                    break;
                                }
                                ?>
                            <div class="col-sm-6 col-md-4">
                                <div class="wrapper">
                                    <div class="icon wow zoomIn">
                                        <i class="fa <?php echo esc_attr( $thebusiness_service_array['thebusiness-home-service-page-icon'] ); ?>"></i>
                                    </div><!-- .icon -->
                                    <section>
                                        <h3 class="fadeInUp" data-wow-duration="1.5s"><?php echo esc_html( $thebusiness_service_array['thebusiness-home-service-title'] );?></h3>
                                        <p class="fadeInUp" data-wow-duration="1.8s"><?php echo wp_kses_post( $thebusiness_service_array['thebusiness-home-service-content'] );?></p>
                                        <?php
                                        if(!empty( $thebusiness_home_service_button_text ) ){
                                            ?>
                                                <a class="btn-c btn-blue-border fadeInUp" data-wow-duration="2.1s" href="<?php echo esc_url( $thebusiness_service_array['thebusiness-home-service-link'] );?>">
                                                    <?php echo esc_html( $thebusiness_home_service_button_text );?>
                                                </a>
                                            <?php
                                        }
                                        ?>
                                    </section>
                                </div><!-- .wrapper -->
                            </div><!-- .col-md-4 -->
                            <?php
                            $i++;
                            }
                            ?>
                        </div><!-- .icons n titles coll -->
                    </div><!-- .row -->
                </div><!-- .container -->
            </div><!-- .db-our-service -->
            <?php
        }
    }
endif;
add_action( 'thebusiness_homepage', 'thebusiness_home_service', 15 );