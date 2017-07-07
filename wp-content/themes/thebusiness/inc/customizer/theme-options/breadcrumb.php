<?php
global $thebusiness_sections;
global $thebusiness_settings_controls;
global $thebusiness_repeated_settings_controls;
global $thebusiness_customizer_defaults;

/*defaults values*/
$thebusiness_customizer_defaults['thebusiness-enable-breadcrumb'] = 1;

$thebusiness_sections['thebusiness-breadcrumb-options'] =
    array(
        'priority'       => 30,
        'title'          => __( 'Breadcrumb Options', 'thebusiness' ),
        'panel'          => 'thebusiness-theme-options',
    );

$thebusiness_settings_controls['thebusiness-enable-breadcrumb'] =
    array(
        'setting' =>     array(
            'default'              => $thebusiness_customizer_defaults['thebusiness-enable-breadcrumb'],
        ),
        'control' => array(
            'label'                 =>  __( 'Enable Breadcrumb', 'thebusiness' ),
            'section'               => 'thebusiness-breadcrumb-options',
            'type'                  => 'checkbox',
            'priority'              => 10,
        )
    );