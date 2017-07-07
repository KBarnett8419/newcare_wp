<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 *
 * @package salient themes
 * @subpackage theBusiness Pro
 * @since theBusiness 1.0.0
 */


/**
 * thebusiness_action_after_content hook
 * @since theBusiness 1.0.0
 *
 * @hooked null
 */
do_action( 'thebusiness_action_after_content' );

/**
 * thebusiness_action_before_footer hook
 * @since theBusiness 1.0.0
 *
 * @hooked thebusiness_before_footer - 10
 */
do_action( 'thebusiness_action_before_footer' );

/**
 * thebusiness_action_widget_before_footer hook
 * @since theBusiness 1.0.0
 *
 * @hooked thebusiness_widget_before_footer - 10
 */
do_action( 'thebusiness_action_widget_before_footer' );

/**
 * thebusiness_action_footer hook
 * @since theBusiness 1.0.0
 *
 * @hooked thebusiness_footer - 10
 */
do_action( 'thebusiness_action_footer' );

/**
 * thebusiness_action_after_footer hook
 * @since theBusiness 1.0.0
 *
 * @hooked null
 */
do_action( 'thebusiness_action_after_footer' );

/**
 * thebusiness_action_after hook
 * @since theBusiness 1.0.0
 *
 * @hooked thebusiness_page_end - 10
 */
do_action( 'thebusiness_action_after' );
?>
<?php wp_footer(); ?>
</body>
</html>