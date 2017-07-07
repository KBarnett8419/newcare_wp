<?php
if ( ! function_exists( 'thebusiness_home_about_array' ) ) :
    /**
     * about Section array creation
     *
     * @since thebusiness 1.0.0
     *
     * @param string $from_about
     * @return array
     */
    function thebusiness_home_about_array( $from_about ){
        global $thebusiness_customizer_all_values;
        $thebusiness_home_about_number = absint($thebusiness_customizer_all_values['thebusiness-home-about-number']);
        $thebusiness_home_about_single_words = absint($thebusiness_customizer_all_values['thebusiness-home-about-single-words']);

        $thebusiness_home_about_contents_array = array();

        $thebusiness_home_about_contents_array[1]['thebusiness-home-about-title'] = __('Title', 'thebusiness');
        $thebusiness_home_about_contents_array[1]['thebusiness-home-about-content'] = __("Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.", 'thebusiness');
        $thebusiness_home_about_contents_array[1]['thebusiness-home-about-link'] = '#';
        $thebusiness_home_about_contents_array[1]['thebusiness-home-about-page-link-text'] = __('Know More','thebusiness');

        $thebusiness_home_about_page = array('thebusiness-home-about-pages-ids');

        if ( 'from-category' ==  $from_about ){
            $thebusiness_home_about_category = $thebusiness_customizer_all_values['thebusiness-home-about-category'];
            if( 0 != $thebusiness_home_about_category ){
                $thebusiness_home_about_args =    array(
                    'post_type' => 'post',
                    'cat' => absint($thebusiness_home_about_category),
                    'posts_per_page' => absint($thebusiness_home_about_number)
                );
            }
        }else {
                $thebusiness_home_about_posts = salient_customizer_get_repeated_all_value(3 , $thebusiness_home_about_page);
                $thebusiness_home_about_posts_ids = array();
                if( null != $thebusiness_home_about_posts ) {
                    foreach( $thebusiness_home_about_posts as $thebusiness_home_about_post ) {
                        if( 0 != $thebusiness_home_about_post['thebusiness-home-about-pages-ids'] ){
                            $thebusiness_home_about_posts_ids[] = $thebusiness_home_about_post['thebusiness-home-about-pages-ids'];
                        }
                    }
                    if( !empty( $thebusiness_home_about_posts_ids )){
                        $thebusiness_home_about_args =    array(
                            'post_type' => 'page',
                            'post__in' => array_map( 'absint', $thebusiness_home_about_posts_ids ),
                            'posts_per_page' => absint($thebusiness_home_about_number),
                            'orderby' => 'post__in'
                        );
                    }
                }
            }
        // the query
        if( !empty( $thebusiness_home_about_args )){

            $thebusiness_home_about_contents_array = array(); /*again empty array*/
            $thebusiness_home_about_post_query = new WP_Query( $thebusiness_home_about_args );
            if ( $thebusiness_home_about_post_query->have_posts() ) :
                $i = 1;
                while ( $thebusiness_home_about_post_query->have_posts() ) : $thebusiness_home_about_post_query->the_post();
                    $thebusiness_home_about_contents_array[$i]['thebusiness-home-about-title'] = get_the_title();
                    if (has_excerpt()) {
                        $thebusiness_home_about_contents_array[$i]['thebusiness-home-about-content'] = get_the_excerpt();
                    }
                    else {
                        $thebusiness_home_about_contents_array[$i]['thebusiness-home-about-content'] = thebusiness_words_count( $thebusiness_home_about_single_words ,get_the_content());
                    }
                    $thebusiness_home_about_contents_array[$i]['thebusiness-home-about-link'] = get_permalink();
                    $thebusiness_home_about_contents_array[$i]['thebusiness-home-about-page-link-text'] = __('Know More','thebusiness');

                    $i++;
                endwhile;
                wp_reset_postdata();
            endif;
        }
        return $thebusiness_home_about_contents_array;
    }
endif;

if ( ! function_exists( 'thebusiness_home_about' ) ) :
    /**
     * about Section
     *
     * @since thebusiness 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function thebusiness_home_about() {
        global $thebusiness_customizer_all_values;
        if( 1 != $thebusiness_customizer_all_values['thebusiness-home-about-enable'] ){
            return null;
        }
        $thebusiness_home_about_selection_options = $thebusiness_customizer_all_values['thebusiness-home-about-selection'];
        $thebusiness_about_arrays = thebusiness_home_about_array( $thebusiness_home_about_selection_options );
        if( is_array( $thebusiness_about_arrays )){
            $thebusiness_home_about_number = absint($thebusiness_customizer_all_values['thebusiness-home-about-number']);
            $thebusiness_home_about_title = $thebusiness_customizer_all_values['thebusiness-home-about-title'];
            $thebusiness_home_about_sub_title = $thebusiness_customizer_all_values['thebusiness-home-about-sub-title'];
            $thebusiness_home_about_feature_image = $thebusiness_customizer_all_values['thebusiness-home-about-image'];
            $thebusiness_home_about_button_text = $thebusiness_customizer_all_values['thebusiness-home-about-button-text'];
            ?>          
            <div class="db-premium-media">
                <div class="container">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="s-title clearfix">
                                <span class="line wow scalex" data-wow-duration="1.5s"></span>
                                    <?php if(!empty( $thebusiness_home_about_title ) ){ ?>
                                        <h2 class="wow zoomOut-wo" data-wow-duration="1s"><?php echo esc_html(  $thebusiness_home_about_title); ?></h2>
                                    <?php } ?>
                            </div><!-- .title -->
                        </div><!-- .col-md-12 -->

                        <div class="col-sm-12 img-with-cap">
                            <?php if(!empty( $thebusiness_home_about_sub_title ) ){ ?>
                            <p class="wow fadeInUp">
                                <?php echo esc_html(  $thebusiness_home_about_sub_title); ?>
                            </p>
                            <?php } ?>
                        </div>

                        <div class="col-md-6 col-md-push-6">
                            <section class="img-with-cap-img">
                                <img src="<?php echo esc_url($thebusiness_home_about_feature_image); ?>" class="c-img-responsive wow zoomOut"/>
                            </section><!-- .img with cap -->
                        </div><!-- .col-md-12 -->

                        <div class="col-md-6 col-md-pull-6">
                            <div class="medias row">
                                <?php
                                $i = 1;
                                foreach( $thebusiness_about_arrays as $thebusiness_about_array ){
                                    if( $thebusiness_home_about_number < $i){
                                        break;
                                    }
                                    ?>
                                        <div class="col-sm-12 wow fadeInLeft">
                                            <section>
                                                <div class="icon-n-title">
                                                    <div class="title"><?php echo esc_html( $thebusiness_about_array['thebusiness-home-about-title'] );?></div>
                                                </div>
                                                <p><?php echo wp_kses_post( $thebusiness_about_array['thebusiness-home-about-content'] );?>
                                                </p>
                                            </section>
                                        </div><!-- .col-sm-4 -->
                                    <?php
                                    $i++;
                                    }
                                    ?>
                            </div><!-- .medias -->
                        </div>


                        <div class="clearfix"></div>
                        <?php
                        if(!empty( $thebusiness_home_about_button_text ) ){
                            ?>
                                <a class="btn-c btn-blue-border fadeInUp" data-wow-duration="2.1s" href="<?php echo esc_url( $thebusiness_customizer_all_values['thebusiness-home-about-button-link'] );?>">
                                    <?php echo esc_html( $thebusiness_home_about_button_text );?>
                                </a>
                            <?php
                        }
                        ?>

                    </div><!-- .row -->
                </div><!-- .container -->
            </div><!-- .db premium media -->
            <?php
        }
    }
endif;
add_action( 'thebusiness_homepage', 'thebusiness_home_about', 20 );