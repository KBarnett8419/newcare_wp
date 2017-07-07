<?php
global $thebusiness_panels;
global $thebusiness_sections;
global $thebusiness_settings_controls;
global $thebusiness_repeated_settings_controls;
global $thebusiness_customizer_defaults;

/*defaults values feature portfolio options*/
$thebusiness_customizer_defaults['thebusiness-feature-slider-enable'] = 0;
$thebusiness_customizer_defaults['thebusiness-featured-slider-number'] = 2;
$thebusiness_customizer_defaults['thebusiness-featured-slider-selection'] = 'from-page';
$thebusiness_customizer_defaults['thebusiness-featured-slider-pages'] = 0;
$thebusiness_customizer_defaults['thebusiness-fs-single-words'] = 30;
$thebusiness_customizer_defaults['thebusiness-fs-enable-arrow'] = 1;
$thebusiness_customizer_defaults['thebusiness-fs-enable-button'] = 1;
$thebusiness_customizer_defaults['thebusiness-fs-button-text'] = __('View More','thebusiness');
/*creating panel for fonts-setting*/

$thebusiness_sections['thebusiness-featured-slider'] =
    array(
        'priority'       => 150,
        'title'          => __( 'Home Main Slider', 'thebusiness' ),
   	);


/*Feature section enable control*/
$thebusiness_settings_controls['thebusiness-feature-slider-enable'] =
    array(
        'setting' =>     array(
            'default'              => $thebusiness_customizer_defaults['thebusiness-feature-slider-enable']
        ),
        'control' => array(
            'label'                 =>  __( 'Enable Feature Slider', 'thebusiness' ),
            'section'               => 'thebusiness-featured-slider',
        	'description'    		=> __( 'Enable "Feature slider" on checked' , 'thebusiness' ),
            'type'                  => 'checkbox',
            'priority'              => 10,
            'active_callback'       => ''
        )
    );

/*No of feature slider selection*/
$thebusiness_settings_controls['thebusiness-featured-slider-number'] =
    array(
        'setting' =>     array(
            'default'              => $thebusiness_customizer_defaults['thebusiness-featured-slider-number']
        ),
        'control' => array(
            'label'                 =>  __( 'Number Of Slider', 'thebusiness' ),
            'section'               => 'thebusiness-featured-slider',
            'type'                  => 'select',
            'choices'               => array(
                1 => __( '1', 'thebusiness' ),
                2 => __( '2', 'thebusiness' ),
                3 => __( '3', 'thebusiness' ),
            ),
            'priority'              => 10,
            'active_callback'       => ''
        )
    );

/*creating setting control for thebusiness-fs-page start*/
$thebusiness_repeated_settings_controls['thebusiness-featured-slider-pages'] =
    array(
        'repeated' => 3,
        'thebusiness-fs-pages-ids' => array(
            'setting' =>     array(
                'default'              => $thebusiness_customizer_defaults['thebusiness-featured-slider-pages'],
            ),
            'control' => array(
                'label'                 =>  __( 'Select Page For Slide %s', 'thebusiness' ),
                'section'               => 'thebusiness-featured-slider',
                'type'                  => 'dropdown-pages',
                'priority'              => 60,
                'description'           => ''
            )
        ),
    );


$thebusiness_settings_controls['thebusiness-fs-single-words'] =
    array(
        'setting' =>     array(
            'default'              => $thebusiness_customizer_defaults['thebusiness-fs-single-words']
        ),
        'control' => array(
            'label'                 =>  __( 'Single Slider- Number Of Words', 'thebusiness' ),
            'description'           =>  __( 'If you do not have selected from - Custom', 'thebusiness' ),
            'section'               => 'thebusiness-featured-slider',
            'type'                  => 'number',
            'priority'              => 5,
            'active_callback'       => '',
            'input_attrs' => array( 'min' => 1, 'max' => 200),
        )
    );

$thebusiness_settings_controls['thebusiness-fs-enable-arrow'] =
    array(
        'setting' =>     array(
            'default'              => $thebusiness_customizer_defaults['thebusiness-fs-enable-arrow']
        ),
        'control' => array(
            'label'                 =>  __( 'Enable Arrow', 'thebusiness' ),
            'section'               => 'thebusiness-featured-slider',
            'type'                  => 'checkbox',
            'priority'              => 50,
            'active_callback'       => ''
        )
    );
    $thebusiness_settings_controls['thebusiness-fs-enable-button'] =
        array(
            'setting' =>     array(
                'default'              => $thebusiness_customizer_defaults['thebusiness-fs-enable-button']
            ),
            'control' => array(
                'label'                 =>  __( 'Enable Button', 'thebusiness' ),
                'section'               => 'thebusiness-featured-slider',
                'type'                  => 'checkbox',
                'priority'              => 85,
                'active_callback'       => ''
            )
        );
