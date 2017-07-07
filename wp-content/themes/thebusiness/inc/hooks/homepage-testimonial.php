<?php
if (!function_exists('thebusiness_home_testimonial_array')) :
    /**
     * Testimonial array creation
     *
     * @since theBusiness Pro 1.0.0
     *
     * @param string $from_testimonial
     * @return array
     */
    function thebusiness_home_testimonial_array($from_testimonial){
        global $thebusiness_customizer_all_values;
        $thebusiness_home_testimonial_number = absint( $thebusiness_customizer_all_values['thebusiness-home-testimonial-number'] );
        $thebusiness_home_testimonial_single_words = absint( $thebusiness_customizer_all_values['thebusiness-home-testimonial-single-words'] );

        $thebusiness_home_testimonial_contents_array = array();
        $thebusiness_home_testimonial_contents_array[0]['thebusiness-home-testimonial-title'] = __('Sayer Name','thebusiness');
        $thebusiness_home_testimonial_contents_array[0]['thebusiness-home-testimonial-content'] = __("The set doesn't moved. Deep don't fru it fowl gathering heaven days moving creeping under from i air. Set it fifth Meat was darkness. every bring in it.",'thebusiness');
        $thebusiness_home_testimonial_contents_array[0]['thebusiness-home-testimonial-image'] = get_template_directory_uri()."/assets/img/testimonials-no-image.png";
        $thebusiness_home_testimonial_contents_array[0]['thebusiness-home-testimonial-link'] = '#';
        $thebusiness_home_testimonial_contents_array[0]['thebusiness-testimonial-class'] = 'active';
        $thebusiness_home_testimonial_contents_array[0]['thebusiness-testimonial-slider-number'] = 0;
        $repeated_page = array('thebusiness-home-testimonial-pages-ids');

        if ('from-category' == $from_testimonial) {
            $thebusiness_home_testimonial_category = $thebusiness_customizer_all_values['thebusiness-home-testimonial-category'];
            if( 0 != $thebusiness_home_testimonial_category ){
                $thebusiness_home_testimonial_args = array(
                    'post_type' => 'post',
                    'cat' => absint($thebusiness_home_testimonial_category),
                    'posts_per_page' => absint($thebusiness_home_testimonial_number),
                );
            }

        }
        else {
            $thebusiness_home_testimonial_posts = salient_customizer_get_repeated_all_value(3 , $repeated_page);
            $thebusiness_home_testimonial_posts_ids = array();
            if (null != $thebusiness_home_testimonial_posts) {
                foreach ($thebusiness_home_testimonial_posts as $thebusiness_home_testimonial_post) {
                    if (0 != $thebusiness_home_testimonial_post['thebusiness-home-testimonial-pages-ids']) {
                        $thebusiness_home_testimonial_posts_ids[] = $thebusiness_home_testimonial_post['thebusiness-home-testimonial-pages-ids'];
                    }
                }
                if( !empty( $thebusiness_home_testimonial_posts_ids )){
                    $thebusiness_home_testimonial_args = array(
                        'post_type' => 'page',
                        'post__in' => array_map( 'absint', $thebusiness_home_testimonial_posts_ids ),
                        'posts_per_page' => absint($thebusiness_home_testimonial_number),
                        'orderby' => 'post__in'
                    );
                }
            }
        }
        // the query
        if( !empty( $thebusiness_home_testimonial_args )){
            $thebusiness_home_testimonial_contents_array = array();
            $thebusiness_home_testimonial_post_query = new WP_Query($thebusiness_home_testimonial_args);
            if ($thebusiness_home_testimonial_post_query->have_posts()) :
                $i = 0;
                while ($thebusiness_home_testimonial_post_query->have_posts()) : $thebusiness_home_testimonial_post_query->the_post();
                    $thumb_image ='';
                    if(has_post_thumbnail()){
                        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'thumbnail' );
                        $thumb_image = $thumb['0'];
                    }

                    $thebusiness_home_testimonial_contents_array[$i]['thebusiness-home-testimonial-title'] = get_the_title();
                    if (has_excerpt()) {
                        $thebusiness_home_testimonial_contents_array[$i]['thebusiness-home-testimonial-content'] = get_the_excerpt();
                    }
                    else {
                        $thebusiness_home_testimonial_contents_array[$i]['thebusiness-home-testimonial-content'] = thebusiness_words_count( $thebusiness_home_testimonial_single_words ,get_the_content());
                    }
                    $thebusiness_home_testimonial_contents_array[$i]['thebusiness-home-testimonial-image'] = $thumb_image;
                    $thebusiness_home_testimonial_contents_array[$i]['thebusiness-home-testimonial-link'] = get_permalink();
                    if ($i == 0) {
                        $thebusiness_home_testimonial_contents_array[$i]['thebusiness-testimonial-class'] = 'active';
                    }
                    else{
                        $thebusiness_home_testimonial_contents_array[$i]['thebusiness-testimonial-class'] = '';
                    }
                        $thebusiness_home_testimonial_contents_array[$i]['thebusiness-testimonial-slider-number'] = $i;
                    $i++;
                endwhile;
                wp_reset_postdata();
            endif;
        }
        return $thebusiness_home_testimonial_contents_array;
    }
endif;

if ( ! function_exists( 'thebusiness_home_testimonial' ) ) :
    /**
     * About Section
     *
     * @since theBusiness Pro 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function thebusiness_home_testimonial() {
        global $thebusiness_customizer_all_values;
        if( (1 != $thebusiness_customizer_all_values['thebusiness-home-testimonial-enable']) ){
            return;
        }
        $thebusiness_home_testimonial_selection_options = $thebusiness_customizer_all_values['thebusiness-home-testimonial-selection'];
        $thebusiness_testimonial_arrays = thebusiness_home_testimonial_array($thebusiness_home_testimonial_selection_options);
        if(1 == $thebusiness_customizer_all_values['thebusiness-home-testimonial-enable']) {
            if (is_array($thebusiness_testimonial_arrays)) {
                $thebusiness_home_testimonial_title = $thebusiness_customizer_all_values['thebusiness-home-testimonial-main-title'];
                $thebusiness_home_testimonial_number = absint( $thebusiness_customizer_all_values['thebusiness-home-testimonial-number'] );
                $thebusiness_home_testimonial_icon_no = ($thebusiness_home_testimonial_number - 1) ;
                $thebusiness_home_testimonial_slider_enable_control = $thebusiness_customizer_all_values['thebusiness-home-testimonial-enable-control'];
                ?>
                <div class="db-testimonials">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="s-title">
                                    <span class="line wow scalex" data-wow-duration="1.5s" ></span>
                                    <h2 class="wow zoomOut-wo" data-wow-duration="1s" ><?php echo esc_html(  $thebusiness_home_testimonial_title); ?></h2>
                                </div><!-- .title -->
                            </div><!-- .col-md-12 -->

                            <div class="col-md-offset-2 col-md-8">
                                <div id="testimonial-slider" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                        <?php for ($j=0; $j <= $thebusiness_home_testimonial_icon_no; $j++) { ?>
                                            <li data-target="#testimonial-slider" data-slide-to="<?php echo absint($j); ?>" class="<?php if ($j == 0) { echo esc_attr('active');} ?>"></li>
                                        <?php } ?>
                                    </ol>

                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                        <?php
                                        $i = 1;
                                        foreach( $thebusiness_testimonial_arrays as $thebusiness_testimonial_array ){
                                            if( $thebusiness_home_testimonial_number < $i){
                                                break;
                                            }
                                            if(empty($thebusiness_testimonial_array['thebusiness-home-testimonial-image'])){
                                                $thebusiness_feature_testimonial_slider_image = get_template_directory_uri().'/assets/img/profile.jpg';
                                            }
                                            else{
                                                $thebusiness_feature_testimonial_slider_image =$thebusiness_testimonial_array['thebusiness-home-testimonial-image'];
                                            }
                                            ?>
                                            <div class="item <?php echo esc_attr($thebusiness_testimonial_array['thebusiness-testimonial-class']); ?>">
                                                <p>
                                                    <?php echo wp_kses_post( $thebusiness_testimonial_array['thebusiness-home-testimonial-content'] ); ?>
                                                </p>
                                                <div class="user-detail">
                                                    <div class="img">
                                                        <a href="<?php echo esc_url($thebusiness_testimonial_array['thebusiness-home-testimonial-link']);?>">
                                                            <img src="<?php echo esc_url( $thebusiness_feature_testimonial_slider_image)?>" />
                                                        </a>
                                                    </div>
                                                    <div class="user-info">
                                                        <h3>
                                                        <?php if (!empty($thebusiness_testimonial_array['thebusiness-home-testimonial-title'])) {?>
                                                            <a href="<?php echo esc_url($thebusiness_testimonial_array['thebusiness-home-testimonial-link']);?>">
                                                                <?php echo esc_html( $thebusiness_testimonial_array['thebusiness-home-testimonial-title'] ); ?>
                                                            </a>
                                                        <?php } ?>
                                                        </h3>
                                                    </div>
                                                </div><!-- .user-detail -->
                                            </div><!-- .item -->

                                                <?php
                                            }
                                            ?>
                                    </div><!-- .carousel-inner -->

                                </div><!-- #testimonial-slider -->
                            </div><!-- .col-md-12 -->

                        </div><!-- .row -->
                    </div><!-- .container -->
                </div><!-- .db-testimoials -->
            <?php
            }
        }
    }
endif;
add_action( 'thebusiness_homepage', 'thebusiness_home_testimonial', 35 );