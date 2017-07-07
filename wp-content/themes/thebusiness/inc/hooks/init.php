<?php
/**
 * Implement Editor Styles
 *
 * @since theBusiness 1.0.0
 *
 * @param null
 * @return null
 *
 */
add_action( 'init', 'thebusiness_add_editor_styles' );

if ( ! function_exists( 'thebusiness_add_editor_styles' ) ) :
    function thebusiness_add_editor_styles() {
        add_editor_style( 'editor-style.css' );
    }
endif;