<?php
if ( ! function_exists( 'thebusiness_home_team_array' ) ) :
    /**
     * Team section array creation
     *
     * @since thebusiness 1.0.0
     *
     * @param string $from_team
     * @return array
     */
    function thebusiness_home_team_array( $from_team ){
        global $thebusiness_customizer_all_values;
        $thebusiness_home_team_number = absint($thebusiness_customizer_all_values['thebusiness-home-team-number']);
        $thebusiness_home_team_contents_array = array();

        $thebusiness_home_team_contents_array[1]['thebusiness-home-team-title'] = __('John Doe', 'thebusiness');
        $thebusiness_home_team_contents_array[1]['thebusiness-home-team-link'] = '#';
        $thebusiness_home_team_contents_array[1]['thebusiness-home-team-page-image'] = get_template_directory_uri().'/assets/img/no-image-team.png';
        $repeated_page = array('thebusiness-home-team-pages-ids');

        $thebusiness_home_team_args = array();

        if ( 'from-category' ==  $from_team ){
            $thebusiness_home_team_category = $thebusiness_customizer_all_values['thebusiness-home-team-category'];
            if( $thebusiness_home_team_category  > 0 ){
                $thebusiness_home_team_args =    array(
                    'post_type' => 'post',
                    'posts_per_page' => absint($thebusiness_home_team_number),
                    'cat' => absint($thebusiness_home_team_category),
                );
            }
        }else {
                $thebusiness_home_team_posts = salient_customizer_get_repeated_all_value(4 , $repeated_page);
                $thebusiness_home_team_posts_ids = array();
                if( null != $thebusiness_home_team_posts ) {
                    foreach( $thebusiness_home_team_posts as $thebusiness_home_team_post ) {
                        if( $thebusiness_home_team_post['thebusiness-home-team-pages-ids']  > 0 ){
                            $thebusiness_home_team_posts_ids[] = $thebusiness_home_team_post['thebusiness-home-team-pages-ids'];
                        }
                    }
                    if( !empty( $thebusiness_home_team_posts_ids )){
                        $thebusiness_home_team_args =    array(
                            'post_type' => 'page',
                            'post__in' => array_map( 'absint', $thebusiness_home_team_posts_ids ),
                            'posts_per_page' => absint($thebusiness_home_team_number),
                            'orderby' => 'post__in'
                        );
                    }
                }
            }
        // the query
        if( !empty( $thebusiness_home_team_args )){

            $thebusiness_home_team_contents_array = array(); /*again empty array*/
            $thebusiness_home_team_post_query = new WP_Query( $thebusiness_home_team_args );
            if ( $thebusiness_home_team_post_query->have_posts() ) :
                $i = 1;
                while ( $thebusiness_home_team_post_query->have_posts() ) : $thebusiness_home_team_post_query->the_post();
                    $thebusiness_home_team_contents_array[$i]['thebusiness-home-team-title'] = get_the_title();
                    $url ='';
                    if(has_post_thumbnail()){
                        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'thebusiness-team-image' );
                        $url = $thumb['0'];
                    }
                    else{
                      $url = NULL;
                    }
                    $thebusiness_home_team_contents_array[$i]['thebusiness-home-team-page-image'] = $url;

                    $i++;
                endwhile;
                wp_reset_postdata();
            endif;
        }
        return $thebusiness_home_team_contents_array;
    }
endif;

if ( ! function_exists( 'thebusiness_home_team' ) ) :
    /**
     * Team section
     *
     * @since thebusiness 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function thebusiness_home_team() {
        global $thebusiness_customizer_all_values;
        if( 1 != $thebusiness_customizer_all_values['thebusiness-home-team-enable'] ){
            return null;
        }
        $thebusiness_home_team_selection_options = $thebusiness_customizer_all_values['thebusiness-home-team-selection'];
        $thebusiness_team_arrays = thebusiness_home_team_array( $thebusiness_home_team_selection_options );

        if( is_array( $thebusiness_team_arrays )){
            $thebusiness_home_team_number = absint($thebusiness_customizer_all_values['thebusiness-home-team-number']);
            $thebusiness_home_team_title = $thebusiness_customizer_all_values['thebusiness-home-team-title'];
            $thebusiness_home_team_button_text = $thebusiness_customizer_all_values['thebusiness-home-team-button-text'];
            $thebusiness_home_team_button_link = $thebusiness_customizer_all_values['thebusiness-home-team-button-link'];
            ?>

        <div class="db-meet-our-team">
            <div class="container">
                <div class="row">

                    <div class="col-md-12">
                        <div class="s-title">
                            <span class="line wow scalex" data-wow-duration="1.5s"></span>
                            <h2 class="wow zoomOut-wo" data-wow-duration="1s"><?php echo esc_html( $thebusiness_home_team_title );?></h2>
                        </div><!-- .title -->
                    </div><!-- .col-md-12 -->

                    <div class="team-members">
                        <?php
                        $i = 1;
                        foreach( $thebusiness_team_arrays as $thebusiness_team_array ){
                            if( $thebusiness_home_team_number < $i){
                                break;
                            }
                            ?>
                            <div class="col-sm-6 col-md-3">
                                <section>
                                    <div class="img-wrapper wow zoomIn">
                                        <?php if(empty($thebusiness_team_array['thebusiness-home-team-page-image'])){
                                            $thebusiness_team_image = get_template_directory_uri().'/assets/img/no-image-250-250.jpg';
                                        }
                                        else{
                                            $thebusiness_team_image =$thebusiness_team_array['thebusiness-home-team-page-image'];
                                        }
                                        ?>
                                        <a>
                                            <img src="<?php echo esc_url($thebusiness_team_image); ?>">
                                        </a>
                                    </div>
                                    <a>
                                        <h2 class="wow fadeInUp" data-wow-duration="1.2s"><?php echo wp_kses_post( $thebusiness_team_array['thebusiness-home-team-title'] );?></h2>
                                    </a>
                                </section>
                            </div>


                            <?php
                        }
                        ?>
                    </div><!-- .team-members -->
                    <?php
                    if( !empty( $thebusiness_home_team_button_link ) && !empty( $thebusiness_home_team_button_text ) ){
                        ?>
                            <a class="btn-c btn-blue wow fadeInUp" href="<?php echo esc_url( $thebusiness_home_team_button_link );?>">
                                <?php echo esc_html( $thebusiness_home_team_button_text );?>
                            </a>
                        <?php
                    }
                    ?>
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .db-latest-news -->
       <?php
        }
    }
endif;
add_action( 'thebusiness_homepage', 'thebusiness_home_team', 30 );