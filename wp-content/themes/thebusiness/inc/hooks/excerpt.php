<?php
if( ! function_exists( 'thebusiness_excerpt_length' ) ) :

    /**
     * Excerpt length
     *
     * @since  theBusiness 1.0.0
     *
     * @param null
     * @return int
     */
    function thebusiness_excerpt_length( $length ){
        global $thebusiness_customizer_all_values;
        $excerpt_length = $thebusiness_customizer_all_values['thebusiness-number-of-words'];
        if ( empty( $excerpt_length) ) {
            $excerpt_length = $length;
        }
        return absint( $excerpt_length );

    }

endif;
add_filter( 'excerpt_length', 'thebusiness_excerpt_length', 999 );