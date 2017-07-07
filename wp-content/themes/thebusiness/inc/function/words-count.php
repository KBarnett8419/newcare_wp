<?php
/**
* Returns word count of the sentences.
*
* @since @since thebusiness 1.0.0
*/
if ( ! function_exists( 'thebusiness_words_count' ) ) :
	function thebusiness_words_count( $length = 25, $thebusiness_content = null ) {
		$length = absint( $length );
		$source_content = preg_replace( '`\[[^\]]*\]`', '', $thebusiness_content );
		$trimmed_content = wp_trim_words( $source_content, $length, '...' );
		return $trimmed_content;
	}
endif;