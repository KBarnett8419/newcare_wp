<?php
global $thebusiness_sections;
global $thebusiness_settings_controls;
global $thebusiness_repeated_settings_controls;
global $thebusiness_customizer_defaults;

/*defaults values*/
$thebusiness_customizer_defaults['thebusiness-enable-back-to-top'] = 1;

$thebusiness_sections['thebusiness-back-to-top-options'] =
    array(
        'priority'       => 80,
        'title'          => __( 'Back To Top Options', 'thebusiness' ),
        'panel'          => 'thebusiness-theme-options'
    );

$thebusiness_settings_controls['thebusiness-enable-back-to-top'] =
    array(
        'setting' =>     array(
            'default'              => $thebusiness_customizer_defaults['thebusiness-enable-back-to-top'],
        ),
        'control' => array(
            'label'                 =>  __( 'Enable Back To Top', 'thebusiness' ),
            'section'               => 'thebusiness-back-to-top-options',
            'type'                  => 'checkbox',
            'priority'              => 50,
        )
    );