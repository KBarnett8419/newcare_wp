<?php
if ( ! function_exists( 'thebusiness_featured_slider_array' ) ) :
    /**
     * Featured Slider array creation
     *
     * @since theBusiness Pro 1.0.0
     *
     * @param string $from_slider
     * @return array
     */
    function thebusiness_featured_slider_array( $from_slider ){
        global $thebusiness_customizer_all_values;
        $thebusiness_feature_slider_number = absint( $thebusiness_customizer_all_values['thebusiness-featured-slider-number'] );
        $thebusiness_feature_slider_single_words = absint( $thebusiness_customizer_all_values['thebusiness-fs-single-words'] );
        $thebusiness_feature_slider_contents_array[0]['thebusiness-feature-slider-title'] = __('Welcome to The Digital Media','thebusiness');
        $thebusiness_feature_slider_contents_array[0]['thebusiness-feature-slider-content'] = __("Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type",'thebusiness');
        $thebusiness_feature_slider_contents_array[0]['thebusiness-feature-slider-link'] = '#';
        $thebusiness_feature_slider_contents_array[0]['thebusiness-feature-slider-image'] = get_template_directory_uri()."/assets/img/placeholder-banner.png";
        $repeated_page = array('thebusiness-fs-pages-ids');
        $thebusiness_feature_slider_args = array();

        if ( 'from-category' ==  $from_slider ){
            $thebusiness_feature_slider_category = $thebusiness_customizer_all_values['thebusiness-featured-slider-category'];
            if( 0 != $thebusiness_feature_slider_category ){
                $thebusiness_feature_slider_args =    array(
                    'post_type' => 'post',
                    'cat' => absint($thebusiness_feature_slider_category),
                    'ignore_sticky_posts' => true
                );
            }
        }
        else{
            $thebusiness_feature_slider_posts = salient_customizer_get_repeated_all_value(3 , $repeated_page);
            $thebusiness_feature_slider_posts_ids = array();
            if( null != $thebusiness_feature_slider_posts ) {
                foreach( $thebusiness_feature_slider_posts as $thebusiness_feature_slider_post ) {
                    if( 0 != $thebusiness_feature_slider_post['thebusiness-fs-pages-ids'] ){
                        $thebusiness_feature_section_posts_ids[] = $thebusiness_feature_slider_post['thebusiness-fs-pages-ids'];
                    }
                }

                if( !empty( $thebusiness_feature_section_posts_ids )){
                    $thebusiness_feature_slider_args =    array(
                        'post_type' => 'page',
                        'post__in' => array_map( 'absint', $thebusiness_feature_section_posts_ids ),
                        'posts_per_page' => absint($thebusiness_feature_slider_number),
                        'orderby' => 'post__in'
                    );
                }

            }
        }
        if( !empty( $thebusiness_feature_slider_args )){
            // the query
            $thebusiness_fature_section_post_query = new WP_Query( $thebusiness_feature_slider_args );

            if ( $thebusiness_fature_section_post_query->have_posts() ) :
                $i = 0;
                while ( $thebusiness_fature_section_post_query->have_posts() ) : $thebusiness_fature_section_post_query->the_post();
                    $url ='';
                    if(has_post_thumbnail()){
                        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'thebusiness-main-banner' );
                        $url = $thumb['0'];
                    }
                    $thebusiness_feature_slider_contents_array[$i]['thebusiness-feature-slider-title'] = get_the_title();
                    if (has_excerpt()) {
                        $thebusiness_feature_slider_contents_array[$i]['thebusiness-feature-slider-content'] = get_the_excerpt();
                    }
                    else {
                        $thebusiness_feature_slider_contents_array[$i]['thebusiness-feature-slider-content'] = thebusiness_words_count( $thebusiness_feature_slider_single_words ,get_the_content());
                    }
                    $thebusiness_feature_slider_contents_array[$i]['thebusiness-feature-slider-link'] = get_permalink();
                    $thebusiness_feature_slider_contents_array[$i]['thebusiness-feature-slider-image'] = $url;
                    if ($i == 0) {
                        $thebusiness_feature_slider_contents_array[$i]['thebusiness-slider-class'] = 'active';
                    }
                    else{
                        $thebusiness_feature_slider_contents_array[$i]['thebusiness-slider-class'] = 'inactive';
                    }
                    $i++;
                endwhile;
                wp_reset_postdata();
            endif;
        }
        return $thebusiness_feature_slider_contents_array;
    }
endif;

if ( ! function_exists( 'thebusiness_featured_home_slider' ) ) :
    /**
     * Featured Slider
     *
     * @since thebusiness 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function thebusiness_featured_home_slider() {
        global $thebusiness_customizer_all_values;

        if( 1 != $thebusiness_customizer_all_values['thebusiness-feature-slider-enable'] ){
            return null;
        }
        $thebusiness_feature_slider_selection_options = $thebusiness_customizer_all_values['thebusiness-featured-slider-selection'];
        $thebusiness_slider_arrays = thebusiness_featured_slider_array( $thebusiness_feature_slider_selection_options );


        if( is_array( $thebusiness_slider_arrays )){
        $thebusiness_feature_slider_number = absint( $thebusiness_customizer_all_values['thebusiness-featured-slider-number'] );
        $thebusiness_feature_enable_arrow = $thebusiness_customizer_all_values['thebusiness-fs-enable-arrow'];
        $thebusiness_feature_enable_button = $thebusiness_customizer_all_values['thebusiness-fs-enable-button'];
        $thebusiness_feature_button_text = $thebusiness_customizer_all_values['thebusiness-fs-button-text'];
    ?>
    <div class="dm-banner-section">
        <div id="dm-banner-slider" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <?php
                $i = 1;
                foreach( $thebusiness_slider_arrays as $thebusiness_slider_array ){
                    if( $thebusiness_feature_slider_number < $i){
                        break;
                    }
                    if(empty($thebusiness_slider_array['thebusiness-feature-slider-image'])){
                        $thebusiness_feature_slider_image = get_template_directory_uri().'/assets/img/no-image-1260_530.png';
                    }
                    else{
                        $thebusiness_feature_slider_image =$thebusiness_slider_array['thebusiness-feature-slider-image'];
                    }
                    ?>
                        <div class="item <?php echo esc_attr($thebusiness_slider_array['thebusiness-slider-class']); ?>" style="background-image: url('<?php echo esc_url( $thebusiness_feature_slider_image )?>');" >
                            <div class="carousel-caption">
                                <h1><a href="<?php echo esc_url( $thebusiness_slider_array['thebusiness-feature-slider-link'] );?>"><?php echo esc_html( $thebusiness_slider_array['thebusiness-feature-slider-title'] );?></a></h1>
                                <p><?php echo wp_kses_post( $thebusiness_slider_array['thebusiness-feature-slider-content'] );?> </p>
                                <?php if ( 1 == $thebusiness_feature_enable_button){ ?>
                                    <a href="<?php echo esc_url( $thebusiness_slider_array['thebusiness-feature-slider-link'] );?>" class="btn-c btn-blue white-border">
                                        <?php echo esc_html( $thebusiness_customizer_all_values['thebusiness-fs-button-text'] );?>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                        <?php
                    $i++;
                    }
                    ?>
            </div><!-- .carousel inner -->
            <!-- Controls -->
            <?php if( 1 == $thebusiness_feature_enable_arrow){ ?>
                <a class="left control" href="#dm-banner-slider" role="button" data-slide="prev">
                    <svg width="30" height="56" viewBox="0 0 30 56">
                    <path class="left-arrow" data-name="Rectangle 1 copy" class="cls-1" d="M28.443-.386l1.115,1.12-28,27.886L0.441,27.5Zm-0.558,56.4L29,54.891,1.115,27,0,28.125Z"/>
                    </svg>
                </a>
                <a class="right control" href="#dm-banner-slider" role="button" data-slide="next">
                    <svg width="30" height="56" viewBox="0 0 30 56">
                    <path id="Rectangle_1_copy" data-name="Rectangle 1 copy" class="cls-1" d="M1.136-.011L0,1.1,28.42,28.8l1.132-1.113ZM1.7,56.011L0.575,54.9,28.869,27.2,30,28.31Z"/>
                    </svg>
                </a>
            <?php }  ?>
            
        </div><!-- .dm banner slider -->
    </div><!-- .dm banner section -->
    <?php
        }
    }
endif;
add_action( 'thebusiness_homepage', 'thebusiness_featured_home_slider', 10 );