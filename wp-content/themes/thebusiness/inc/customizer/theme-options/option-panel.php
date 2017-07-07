<?php
global $thebusiness_panels;
/*creating panel for fonts-setting*/
$thebusiness_panels['thebusiness-theme-options'] =
    array(
        'title'          => __( 'Theme Options', 'thebusiness' ),
        'priority'       => 200
    );

/*layout options */
require get_template_directory().'/inc/customizer/theme-options/layout-options.php';

/*footer options */
require get_template_directory().'/inc/customizer/theme-options/footer.php';

/*Breadcrumb section */
require get_template_directory().'/inc/customizer/theme-options/breadcrumb.php';

/*Back to top */
require get_template_directory().'/inc/customizer/theme-options/back-to-top.php';
