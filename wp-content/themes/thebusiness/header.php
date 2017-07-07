<?php
/**
 * The default template for displaying header
 *
 * @package salient themes
 * @subpackage theBusiness
 * @since theBusiness 1.0.0
 */

/**
 * thebusiness_action_before_head hook
 * @since theBusiness 1.0.0
 *
 * @hooked thebusiness_set_global -  0
 * @hooked thebusiness_doctype -  10
 */
do_action( 'thebusiness_action_before_head' );?>



<head>

	<?php
	/**
	 * thebusiness_action_before_wp_head hook
	 * @since theBusiness 1.0.0
	 *
	 * @hooked thebusiness_before_wp_head -  10
	 */
	do_action( 'thebusiness_action_before_wp_head' );

	wp_head();

	/**
	 * thebusiness_action_after_wp_head hook
	 * @since theBusiness 1.0.0
	 *
	 * @hooked null
	 */
	do_action( 'thebusiness_action_after_wp_head' );
	?>

</head>

<body <?php body_class(); ?>>

<?php
/**
 * thebusiness_action_before hook
 * @since theBusiness 1.0.0
 *
 * @hooked thebusiness_page_start - 15
 */
do_action( 'thebusiness_action_before' );

/**
 * thebusiness_action_before_header hook
 * @since theBusiness 1.0.0
 *
 * @hooked thebusiness_skip_to_content - 10
 */
do_action( 'thebusiness_action_before_header' );

/**
 * thebusiness_action_header hook
 * @since theBusiness 1.0.0
 *
 * @hooked thebusiness_after_header - 10
 */
do_action( 'thebusiness_action_header' );

/**
 * thebusiness_action_before_content hook
 * @since theBusiness 1.0.0
 *
 * @hooked null
 */
do_action( 'thebusiness_action_before_content' );
?>
