<?php
global $thebusiness_sections;
global $thebusiness_settings_controls;
global $thebusiness_repeated_settings_controls;
global $thebusiness_customizer_defaults;

/*defaults values*/
$thebusiness_customizer_defaults['thebusiness-enable-static-page'] = 1;

$thebusiness_customizer_defaults['thebusiness-default-layout'] = 'right-sidebar';
$thebusiness_customizer_defaults['thebusiness-number-of-words'] = 30;
$thebusiness_customizer_defaults['thebusiness-single-post-image-align'] = 'full';
$thebusiness_customizer_defaults['thebusiness-single-post-image'] = '';



$thebusiness_sections['thebusiness-layout-options'] =
    array(
        'priority'       => 20,
        'title'          => __( 'Layout Options', 'thebusiness' ),
        'panel'          => 'thebusiness-theme-options',
    );


/*home page static page display*/
$thebusiness_settings_controls['thebusiness-enable-static-page'] =
    array(
        'setting' =>     array(
            'default'              => $thebusiness_customizer_defaults['thebusiness-enable-static-page'],
        ),
        'control' => array(
            'label'                 =>  __( 'Enable Static Front Page', 'thebusiness' ),
            'description'           =>  __( 'If you disable this the static page will be disappera form the home page and other section from customizer will reamin as it is', 'thebusiness' ),
            'section'               => 'thebusiness-layout-options',
            'type'                  => 'checkbox',
            'priority'              => 10,
        )
    );
    
/*layout-options option responsive lodader start*/
$thebusiness_settings_controls['thebusiness-default-layout'] =
    array(
        'setting' =>     array(
            'default'              => $thebusiness_customizer_defaults['thebusiness-default-layout'],
        ),
        'control' => array(
            'label'                 =>  __( 'Default Layout', 'thebusiness' ),
            'description'           =>  __( 'Layout for all archives, single posts and pages', 'thebusiness' ),
            'section'               => 'thebusiness-layout-options',
            'type'                  => 'select',
            'choices'               => array(
                'right-sidebar' => __( 'Content - Primary Sidebar', 'thebusiness' ),
                'left-sidebar' => __( 'Primary Sidebar - Content', 'thebusiness' ),
                'no-sidebar' => __( 'No Sidebar', 'thebusiness' )
            ),
            'priority'              => 30,
            'active_callback'       => ''
        )
    );


$thebusiness_settings_controls['thebusiness-number-of-words'] =
    array(
        'setting' =>     array(
            'default'              => $thebusiness_customizer_defaults['thebusiness-number-of-words']
        ),
        'control' => array(
            'label'                 =>  __( 'Number Of Words For Excerpt', 'thebusiness' ),
            'description'           =>  __( 'This will controll the excerpt length on listing page', 'thebusiness' ),
            'section'               => 'thebusiness-layout-options',
            'type'                  => 'number',
            'input_attrs' => array( 'min' => 1, 'max' => 200),
            'priority'              => 40,
            'active_callback'       => ''
        )
    );


$thebusiness_settings_controls['thebusiness-single-post-image-align'] =
    array(
        'setting' =>     array(
            'default'              => $thebusiness_customizer_defaults['thebusiness-single-post-image-align'],
        ),
        'control' => array(
            'label'                 =>  __( 'Alignment Of Image In Single Post/Page', 'thebusiness' ),
            'section'               => 'thebusiness-layout-options',
            'type'                  => 'select',
            'choices'               => array(
                'full' => __( 'Full', 'thebusiness' ),
                'right' => __( 'Right', 'thebusiness' ),
                'left' => __( 'Left', 'thebusiness' ),
                'no-image' => __( 'No image', 'thebusiness' )
            ),
            'priority'              => 50,
            'description'           =>  __( 'Please note that this setting can be override from individual post/page', 'thebusiness' ),
        )
    );