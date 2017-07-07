<?php

get_header(); ?>

<section class="home-page">
	<div class="site-content">
		<?php while ( have_posts() ) : the_post(); ?>
			<div class='homepage-hero'>
				<?php the_content(); ?>
				<a class="button" href="<?php echo home_url(); ?>/blog">View Our Work</a>
			</div>
		<?php endwhile; // end of the loop. ?>
	</div><!-- .container -->
</section><!-- .home-page -->

<section class="recent-posts">
 <div class="site-content">
  <div class="blog-post">
   <h4>From the Blog</h4>
    <?php query_posts('posts_per_page=1'); ?>
     <?php while ( have_posts() ) : the_post(); ?>
       <h2><?php the_title(); ?></h2>
       <?php the_excerpt(); ?>
       <a class="read-more-link" href="<?php the_permalink(); ?>">Read More <span>&rsaquo;</span></a>
     <?php endwhile; ?>
    <?php wp_reset_query(); ?>
   </div>
  </div>
</section>

<?php get_footer(); ?>
