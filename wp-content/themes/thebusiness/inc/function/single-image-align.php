<?php 
/*image alignment single post*/

if( ! function_exists( 'thebusiness_single_post_image_align' ) ) :
    /**
     * theBusiness default layout function
     *
     * @since  theBusiness 1.0.0
     *
     * @param int
     * @return string
     */
    function thebusiness_single_post_image_align( $post_id = null ){
        global $thebusiness_customizer_all_values,$post;
        if( null == $post_id && isset ( $post->ID ) ){
            $post_id = $post->ID;
        }
        $thebusiness_single_post_image_align = $thebusiness_customizer_all_values['thebusiness-single-post-image-align'];
        $thebusiness_single_post_image_align_meta = get_post_meta( $post_id, 'thebusiness-single-post-image-align', true );

        if( false != $thebusiness_single_post_image_align_meta ) {
            $thebusiness_single_post_image_align = $thebusiness_single_post_image_align_meta;
        }
        return $thebusiness_single_post_image_align;
    }
endif;