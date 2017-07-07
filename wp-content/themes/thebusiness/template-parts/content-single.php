<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package theBusiness
 */

?>
	<div class="entry-content">
		<?php
		$thebusiness_single_post_image_align = thebusiness_single_post_image_align(get_the_ID());
		if( 'no-image' != $thebusiness_single_post_image_align ){
			if( 'left' == $thebusiness_single_post_image_align ){
				echo "<div class='image-left'>";
				the_post_thumbnail('medium');
			}
			elseif( 'right' == $thebusiness_single_post_image_align ){
				echo "<div class='image-right'>";
				the_post_thumbnail('medium');
			}
			else{
				echo "<div class='image-full'>";
				the_post_thumbnail('full');
			}
			echo "</div>";/*div end*/
		}
		?>

		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'thebusiness' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php thebusiness_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

