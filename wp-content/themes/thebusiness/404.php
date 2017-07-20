<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package thebusiness
 */

get_header(); ?>
<div id="content" class="site-content page404 container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">
					<section class="error-404 not-found">
					<h1 class="err-404">4O4</h1>
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'thebusiness' ); ?></p>
					<div class="search-form 404"><?php get_search_form();?></div>
						
					</section><!-- .error-404 -->

				</main><!-- #main -->
			</div><!-- #primary -->
		</div>
	</div>
</div>

<?php
get_footer();
