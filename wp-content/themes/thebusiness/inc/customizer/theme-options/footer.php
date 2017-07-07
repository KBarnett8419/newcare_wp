<?php
global $thebusiness_sections;
global $thebusiness_settings_controls;
global $thebusiness_repeated_settings_controls;
global $thebusiness_customizer_defaults;

/*defaults values*/
$thebusiness_customizer_defaults['thebusiness-footer-sidebar-number'] = 2;
$thebusiness_customizer_defaults['thebusiness-copyright-text'] = __('Copyright &copy; All right reserved','thebusiness');
$thebusiness_customizer_defaults['thebusiness-enable-theme-name'] = 1;

$thebusiness_sections['thebusiness-footer-options'] =
    array(
        'priority'       => 60,
        'title'          => __( 'Footer Options', 'thebusiness' ),
        'panel'          => 'thebusiness-theme-options'
    );

    $thebusiness_settings_controls['thebusiness-footer-sidebar-number'] =
        array(
            'setting' =>     array(
                'default'              => $thebusiness_customizer_defaults['thebusiness-footer-sidebar-number'],
            ),
            'control' => array(
                'label'                 =>  __( 'Number of Sidebars In Footer Area', 'thebusiness' ),
                'section'               => 'thebusiness-footer-options',
                'type'                  => 'select',
                'choices'               => array(
                    0 => __( 'Disable footer sidebar area', 'thebusiness' ),
                    1 => __( '1', 'thebusiness' ),
                    2 => __( '2', 'thebusiness' ),
                ),
                'priority'              => 10,
                'description'           => '',
                'active_callback'       => ''
            )
        );



$thebusiness_settings_controls['thebusiness-copyright-text'] =
    array(
        'setting' =>     array(
            'default'              => $thebusiness_customizer_defaults['thebusiness-copyright-text'],
        ),
        'control' => array(
            'label'                 =>  __( 'Copyright Text', 'thebusiness' ),
            'section'               => 'thebusiness-footer-options',
            'type'                  => 'text_html',
            'priority'              => 20,
        )
    );