<?php
/**
 * thebusiness Custom Metabox
 *
 * @package thebusiness
 */
$thebusiness_post_types = array(
    'post',
    'page'
);

add_action('add_meta_boxes', 'thebusiness_add_layout_metabox');
function thebusiness_add_layout_metabox() {
    global $post;
    $frontpage_id = get_option('page_on_front');
    if( $post->ID == $frontpage_id ){
        return;
    }

    global $thebusiness_post_types;
    foreach ( $thebusiness_post_types as $post_type ) {
        add_meta_box(
            'thebusiness_layout_options', // $id
            __( 'Layout options', 'thebusiness' ), // $title
            'thebusiness_layout_options_callback', // $callback
            $post_type, // $page
            'normal', // $context
            'high'// $priority
        );
    }

}
/* thebusiness sidebar layout */
$thebusiness_default_layout_options = array(
    'left-sidebar' => array(
        'value'     => 'left-sidebar',
        'thumbnail' => get_template_directory_uri() . '/inc/images/left-sidebar.png'
    ),
    'right-sidebar' => array(
        'value' => 'right-sidebar',
        'thumbnail' => get_template_directory_uri() . '/inc/images/right-sidebar.png'
    ),
    'no-sidebar' => array(
        'value'     => 'no-sidebar',
        'thumbnail' => get_template_directory_uri() . '/inc/images/no-sidebar.png'
    )
);
/* thebusiness featured layout */
$thebusiness_single_post_image_align_options = array(
    'full' => array(
        'value' => 'full',
        'label' => __( 'Full', 'thebusiness' )
    ),
    'right' => array(
        'value' => 'right',
        'label' => __( 'Right ', 'thebusiness' ),
    ),
    'left' => array(
        'value'     => 'left',
        'label' => __( 'Left', 'thebusiness' ),
    ),
    'no-image' => array(
        'value'     => 'no-image',
        'label' => __( 'No Image', 'thebusiness' )
    )
);

function thebusiness_layout_options_callback() {

    global $post , $thebusiness_default_layout_options, $thebusiness_single_post_image_align_options;
    $thebusiness_customizer_saved_values = thebusiness_get_all_options(1);

    /*thebusiness-single-post-image-align*/
    $thebusiness_single_post_image_align = $thebusiness_customizer_saved_values['thebusiness-single-post-image-align'];

    /*thebusiness default layout*/
    $thebusiness_single_sidebar_layout = $thebusiness_customizer_saved_values['thebusiness-default-layout'];

    wp_nonce_field( basename( __FILE__ ), 'thebusiness_layout_options_nonce' );
    ?>
    <table class="form-table page-meta-box">
        <!--Image alignment-->
        <tr>
            <td colspan="4"><em class="f13"><?php _e( 'Choose Sidebar Template', 'thebusiness' ); ?></em></td>
        </tr>
        <tr>
            <td>
                <?php
                $thebusiness_single_sidebar_layout_meta = get_post_meta( $post->ID, 'thebusiness-default-layout', true );
                if( false != $thebusiness_single_sidebar_layout_meta ){
                   $thebusiness_single_sidebar_layout = $thebusiness_single_sidebar_layout_meta;
                }
                foreach ($thebusiness_default_layout_options as $field) {
                    ?>
                    <div class="hide-radio radio-image-wrapper" style="float:left; margin-right:30px;">
                        <input id="<?php echo esc_attr( $field['value'] ); ?>" type="radio" name="thebusiness-default-layout"
                               value="<?php echo esc_attr( $field['value'] ); ?>"
                            <?php checked( $field['value'], $thebusiness_single_sidebar_layout ); ?>/>
                        <label class="description" for="<?php echo esc_attr( $field['value'] ); ?>">
                            <img src="<?php echo esc_url( $field['thumbnail'] ); ?>" />
                        </label>
                    </div>
                <?php } // end foreach
                ?>
                <div class="clear"></div>
            </td>
        </tr>
        <tr>
            <td><em class="f13"><?php _e( 'You can set up the sidebar content', 'thebusiness' ); ?> <a href="<?php echo esc_url( admin_url('/widgets.php') ); ?>"><?php _e( 'here', 'thebusiness' ); ?></a></em></td>
        </tr>
        <!--Image alignment-->
        <tr>
            <td colspan="4"><?php _e( 'Featured Image Alignment', 'thebusiness' ); ?></td>
        </tr>
        <tr>
            <td>
                <?php
                $thebusiness_single_post_image_align_meta = get_post_meta( $post->ID, 'thebusiness-single-post-image-align', true );
                if( false != $thebusiness_single_post_image_align_meta ){
                    $thebusiness_single_post_image_align = $thebusiness_single_post_image_align_meta;
                }
                foreach ($thebusiness_single_post_image_align_options as $field) {
                    ?>
                    <input id="<?php echo esc_attr( $field['value'] ); ?>" type="radio" name="thebusiness-single-post-image-align" value="<?php echo esc_attr( $field['value'] ); ?>" <?php checked( $field['value'], $thebusiness_single_post_image_align ); ?>/>
                    <label class="description" for="<?php echo esc_attr( $field['value'] ); ?>">
                        <?php echo esc_html( $field['label'] ); ?>
                    </label>
                <?php } // end foreach
                ?>
                <div class="clear"></div>
            </td>
        </tr>
    </table>

<?php }

/**
 * save the custom metabox data
 * @hooked to save_post hook
 */
function thebusiness_save_sidebar_layout( $post_id ) {
    global $post;
    // Verify the nonce before proceeding.
    if ( !isset( $_POST[ 'thebusiness_layout_options_nonce' ] ) || !wp_verify_nonce( $_POST[ 'thebusiness_layout_options_nonce' ], basename( __FILE__ ) ) ) {
        return;
    }

    // Stop WP from clearing custom fields on autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( !current_user_can( 'edit_page', $post_id ) ) {
        return $post_id;
    }
    
    if(isset($_POST['thebusiness-default-layout'])){
        $old = get_post_meta( $post_id, 'thebusiness-default-layout', true);
        $new = sanitize_text_field($_POST['thebusiness-default-layout']);
        if ($new && $new != $old) {
            update_post_meta($post_id, 'thebusiness-default-layout', $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id,'thebusiness-default-layout', $old);
        }
    }

    /*image align*/
    if(isset($_POST['thebusiness-single-post-image-align'])){
        $old = get_post_meta( $post_id, 'thebusiness-single-post-image-align', true);
        $new = sanitize_text_field($_POST['thebusiness-single-post-image-align']);
        if ($new && $new != $old) {
            update_post_meta($post_id, 'thebusiness-single-post-image-align', $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id,'thebusiness-single-post-image-align', $old);
        }
    }
}
add_action('save_post', 'thebusiness_save_sidebar_layout');
