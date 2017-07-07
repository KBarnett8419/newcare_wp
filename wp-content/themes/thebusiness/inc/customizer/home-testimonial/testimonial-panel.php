<?php
global $thebusiness_panels;
global $thebusiness_sections;
global $thebusiness_settings_controls;
global $thebusiness_repeated_settings_controls;
global $thebusiness_customizer_defaults;

/*defaults values feature portfolio options*/
$thebusiness_customizer_defaults['thebusiness-home-testimonial-enable'] = 0;
$thebusiness_customizer_defaults['thebusiness-home-testimonial-main-title'] =  __('VOICE OF CLIENTS','thebusiness');
$thebusiness_customizer_defaults['thebusiness-home-testimonial-number'] = 4;
$thebusiness_customizer_defaults['thebusiness-home-testimonial-single-words'] = 30;
$thebusiness_customizer_defaults['thebusiness-home-testimonial-selection'] = 'from-page';
$thebusiness_customizer_defaults['thebusiness-home-testimonial-slider-mode'] = 'fade';
$thebusiness_customizer_defaults['thebusiness-home-testimonial-slider-time'] = 2;
$thebusiness_customizer_defaults['thebusiness-home-testimonial-slider-pause-time'] = 7;
$thebusiness_customizer_defaults['thebusiness-home-testimonial-enable-control'] = 1;
$thebusiness_customizer_defaults['thebusiness-home-testimonial-enable-autoplay'] = 0;
$thebusiness_customizer_defaults['thebusiness-home-testimonial-pages'] = 0;


/*creating panel for fonts-setting*/

$thebusiness_sections['thebusiness-home-testimonial'] =
    array(
        'title'          => __( 'Home Testimonial Section', 'thebusiness' ),
        'priority'       => 190
   	);

$thebusiness_settings_controls['thebusiness-home-testimonial-enable'] =
    array(
        'setting' =>     array(
            'default'              => $thebusiness_customizer_defaults['thebusiness-home-testimonial-enable']
        ),
        'control' => array(
            'label'                 =>  __( 'Enable Testimonial', 'thebusiness' ),
            'description'           => __( 'Enable "Testimonial selection" on checked', 'thebusiness' ),
            'section'               => 'thebusiness-home-testimonial',
            'type'                  => 'checkbox',
            'priority'              => 2,
            'active_callback'       => ''
        )
    );



/*Testimonial Title control*/
$thebusiness_settings_controls['thebusiness-home-testimonial-main-title'] =
array(
    'setting' =>     array(
        'default'              => $thebusiness_customizer_defaults['thebusiness-home-testimonial-main-title']
    ),
    'control' => array(
        'label'                 =>  __( 'Main Title', 'thebusiness' ),
        'section'               => 'thebusiness-home-testimonial',
        'type'                  => 'text',
        'priority'              => 5,
        'active_callback'       => ''
    )
);

/*No of Testimonial needed*/
$thebusiness_settings_controls['thebusiness-home-testimonial-number'] =
    array(
        'setting' =>     array(
            'default'              => $thebusiness_customizer_defaults['thebusiness-home-testimonial-number']
        ),
        'control' => array(
            'label'                 =>  __( 'Number Of Testimonial/s', 'thebusiness' ),
            'description'           => __( 'Choose number of Testimonial to be displayed', 'thebusiness' ),
            'section'               => 'thebusiness-home-testimonial',
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

/*String in max to be appear as description on testimonial*/
$thebusiness_settings_controls['thebusiness-home-testimonial-single-words'] =
    array(
        'setting' =>     array(
            'default'              => $thebusiness_customizer_defaults['thebusiness-home-testimonial-single-words']
        ),
        'control' => array(
            'label'                 =>  __( 'Single Testimonial- Number Of Words', 'thebusiness' ),
            'description'           =>  __( 'If you do not have selected from - Custom', 'thebusiness' ),
            'section'               => 'thebusiness-home-testimonial',
            'type'                  => 'number',
            'input_attrs' => array( 'min' => 1, 'max' => 200),
            'priority'              => 20,
            'active_callback'       => ''
        )
    );
$thebusiness_settings_controls['thebusiness-home-testimonial-enable-control'] =
    array(
        'setting' =>     array(
            'default'              => $thebusiness_customizer_defaults['thebusiness-home-testimonial-enable-control']
        ),
        'control' => array(
            'label'                 =>  __( 'Enable Control', 'thebusiness' ),
            'section'               => 'thebusiness-home-testimonial',
            'type'                  => 'checkbox',
            'priority'              => 70,
            'active_callback'       => ''
        )
    );

$thebusiness_settings_controls['thebusiness-home-testimonial-enable-autoplay'] =
    array(
        'setting' =>     array(
            'default'              => $thebusiness_customizer_defaults['thebusiness-home-testimonial-enable-autoplay']
        ),
        'control' => array(
            'label'                 =>  __( 'Enable Autoplay', 'thebusiness' ),
            'section'               => 'thebusiness-home-testimonial',
            'type'                  => 'checkbox',
            'priority'              => 80,
            'active_callback'       => ''
        )
    );

/*creating setting control for thebusiness-home-testimonial-page start*/
$thebusiness_repeated_settings_controls['thebusiness-home-testimonial-pages'] =
    array(
        'repeated' => 3,
        'thebusiness-home-testimonial-pages-ids' => array(
            'setting' =>     array(
                'default'              => $thebusiness_customizer_defaults['thebusiness-home-testimonial-pages'],
            ),
            'control' => array(
                'label'                 =>  __( 'Select Page For Testimonial %s', 'thebusiness' ),
                'section'               => 'thebusiness-home-testimonial',
                'type'                  => 'dropdown-pages',
                'priority'              => 90,
                'description'           => ''
            )
        ),
        'thebusiness-home-testimonial-pages-divider' => array(
            'control' => array(
                'section'               => 'thebusiness-home-testimonial',
                'type'                  => 'message',
                'priority'              => 90,
                'description'           => '<hr />'
            )
        )
    );

