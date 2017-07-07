<?php
global $thebusiness_panels;
global $thebusiness_sections;
global $thebusiness_settings_controls;
global $thebusiness_repeated_settings_controls;
global $thebusiness_customizer_defaults;

/*defaults values feature portfolio options*/
$thebusiness_customizer_defaults['thebusiness-home-service-enable'] = 0;
$thebusiness_customizer_defaults['thebusiness-home-service-title'] = __('OUR SERVICES','thebusiness');
$thebusiness_customizer_defaults['thebusiness-home-page-service-single-words'] = 30;
$thebusiness_customizer_defaults['thebusiness-home-service-button-text'] = __('View More','thebusiness');
$thebusiness_customizer_defaults['thebusiness-home-service-selection'] = 'from-page';
$thebusiness_customizer_defaults['thebusiness-home-service-number'] = 3;
$thebusiness_customizer_defaults['thebusiness-home-service-page-icon'] = 'fa-desktop';
$thebusiness_customizer_defaults['thebusiness-home-service-pages'] = 0;


/*creating panel for fonts-setting*/

$thebusiness_sections['thebusiness-home-service'] =
    array(
        'title'          => __( 'Home Service Section', 'thebusiness' ),
        'priority'       => 160
   	);

$thebusiness_settings_controls['thebusiness-home-service-enable'] =
    array(
        'setting' =>     array(
            'default'              => $thebusiness_customizer_defaults['thebusiness-home-service-enable']
        ),
        'control' => array(
            'label'                 =>  __( 'Enable Service', 'thebusiness' ),
            'section'               => 'thebusiness-home-service',
            'type'                  => 'checkbox',
            'priority'              => 10,
            'active_callback'       => ''
        )
    );


$thebusiness_settings_controls['thebusiness-home-service-title'] =
    array(
        'setting' =>     array(
            'default'              => $thebusiness_customizer_defaults['thebusiness-home-service-title']
        ),
        'control' => array(
            'label'                 =>  __( 'Main Title', 'thebusiness' ),
            'section'               => 'thebusiness-home-service',
            'type'                  => 'text',
            'priority'              => 20,
            'active_callback'       => ''
        )
    );

$thebusiness_settings_controls['thebusiness-home-page-service-single-words'] =
    array(
        'setting' =>     array(
            'default'              => $thebusiness_customizer_defaults['thebusiness-home-page-service-single-words']
        ),
        'control' => array(
            'label'                 =>  __( 'Number Of Words in Single Column Content', 'thebusiness' ),
            'description'           =>  __( 'If you do not have selected from - Custom', 'thebusiness' ),
            'section'               => 'thebusiness-home-service',
            'type'                  => 'number',
            'priority'              => 30,
            'input_attrs' => array( 'min' => 1, 'max' => 200),
            'active_callback'       => ''
        )
    );

$thebusiness_repeated_settings_controls['thebusiness-home-service-font-icon'] =
    array(
        'repeated' => 3,
        'thebusiness-home-service-page-icon' => array(
            'setting' =>     array(
                'default'              => $thebusiness_customizer_defaults['thebusiness-home-service-page-icon'],
            ),
            'control' => array(
                'label'                 =>  __( 'Icon %s', 'thebusiness' ),
                'section'               => 'thebusiness-home-service',
                'type'                  => 'text',
                'priority'              => 40,
                'description'           => sprintf( __( 'Use font awesome icon: Eg: %s. %sSee more here%s', 'thebusiness' ), 'fa-desktop','<a href="'.esc_url('http://fontawesome.io/cheatsheet/').'" target="_blank">','</a>' ),
            )
        ),
    );


/*creating setting control for thebusiness-home-service-page start*/
$thebusiness_repeated_settings_controls['thebusiness-home-service-pages'] =
    array(
        'repeated' => 3,
        'thebusiness-home-service-pages-ids' => array(
            'setting' =>     array(
                'default'              => $thebusiness_customizer_defaults['thebusiness-home-service-pages'],
            ),
            'control' => array(
                'label'                 =>  __( 'Select Page For Service %s', 'thebusiness' ),
                'section'               => 'thebusiness-home-service',
                'type'                  => 'dropdown-pages',
                'priority'              => 60,
                'description'           => ''
            )
        ),
    );