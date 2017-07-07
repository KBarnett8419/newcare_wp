<?php
if ( ! function_exists( 'thebusiness_home_blog' ) ) :
    /**
     * Blog Section
     *
     * @since theBusiness Pro 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function thebusiness_home_blog() {
        global $thebusiness_customizer_all_values;
        global $post;
        $author_id=$post->post_author;
        $thebusiness_home_blog_title = $thebusiness_customizer_all_values['thebusiness-home-blog-title'];
        $thebusiness_home_blog_sub_title = $thebusiness_customizer_all_values['thebusiness-home-blog-sub-title'];
        $thebusiness_home_blog_button_text = $thebusiness_customizer_all_values['thebusiness-home-blog-button-text'];
        $thebusiness_home_blog_button_link = $thebusiness_customizer_all_values['thebusiness-home-blog-button-link'];
        $thebusiness_home_blog_single_words = absint( $thebusiness_customizer_all_values['thebusiness-home-blog-single-words'] );
        
        $thebusiness_home_blog_category = $thebusiness_customizer_all_values['thebusiness-home-blog-category'];
        if( 1 != $thebusiness_customizer_all_values['thebusiness-home-blog-enable'] ){
            return null;
        }
        ?>
        <div class="db-latest-news">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="s-title">
                            <span class="line wow scalex" data-wow-duration="1.5s"></span>
                            <h2 class="wow zoomOut-wo" data-wow-duration="1s"><?php echo esc_html( $thebusiness_home_blog_title );?></h2>
                            <h3><?php echo esc_html( $thebusiness_home_blog_sub_title );?></h3>
                        </div><!-- .title -->
                    </div><!-- .col-md-12 -->
                    <div class="news-coll">
                        <?php
                        $thebusiness_home_blog_args = array(
                            'post_type' => 'post',
                            'posts_per_page' => 3,
                            'cat'           => absint($thebusiness_home_blog_category),
                        );
                        $thebusiness_home_about_post_query = new WP_Query($thebusiness_home_blog_args);
                        if ($thebusiness_home_about_post_query->have_posts()) :
                            while ($thebusiness_home_about_post_query->have_posts()) : $thebusiness_home_about_post_query->the_post();
                                if(has_post_thumbnail()){
                                    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'medium' );
                                    $url = $thumb['0'];
                                }
                                else{
                                    $url = get_template_directory_uri().'/assets/img/no-image-about.png';
                                } ?>

                                <div class="col-sm-6 col-md-4">
                                    <section class="wow fadeInLeft">
                                        <div class="img-n-des">
                                            <div class="img-wrapper">
                                                <a href="<?php the_permalink();?>">
                                                    <img src="<?php echo esc_url( $url); ?>" alt="<?php the_title();?>">
                                                </a>    
                                            </div><!-- .img-wrapper -->
                                            <h2><a href="<?php the_permalink();?>">
                                                <?php the_title(); ?>
                                            </a></h2>
                                            <p>
                                                <?php
                                                if ( has_excerpt() ) {
                                                    the_excerpt();
                                                } else {
                                                    $content_blog = get_the_content();
                                                    echo wp_kses_post(thebusiness_words_count( $thebusiness_home_blog_single_words, $content_blog ));
                                                } ?>
                                            </p>
                                        </div><!-- .img-n-des -->

                                        <div class="detail">
                                            <div class="user">
                                                <a href="<?php echo esc_url( get_author_posts_url( $author_id ) )?>" ><i class="fa fa-user"></i><span><?php echo esc_html( get_the_author_meta( 'user_nicename', $author_id )); ?></span> </a>
                                            </div>
                                            <div class="date">
                                                <span>
                                                    <?php
                                                    $archive_day   = get_the_time('d');
                                                    ?>
                                                    <a href="<?php echo get_day_link('', '', $archive_day); ?>"><i class="fa fa-calendar"></i> <?php echo get_the_date('M j, Y');?></a>
                                                </span>
                                            </div>
                                        </div><!-- .detail -->
                                    </section><!-- section -->
                                </div><!-- .col-md-4 -->

                            <?php endwhile; 
                            wp_reset_postdata();
                        endif;
                        ?>
                    </div><!-- .news-coll -->

                    <div class="clearfix"></div>
                    <?php
                        if( !empty ( $thebusiness_home_blog_button_text ) ){
                            ?>
                                <a class="btn-c btn-blue wow fadeInUp" href="<?php echo esc_url( $thebusiness_home_blog_button_link );?>">
                                    <?php echo esc_html( $thebusiness_home_blog_button_text );?>
                                </a>
                            <?php
                        }
                    ?>
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .db premium media -->
        <?php
    }
endif;
add_action( 'thebusiness_homepage', 'thebusiness_home_blog', 25 );