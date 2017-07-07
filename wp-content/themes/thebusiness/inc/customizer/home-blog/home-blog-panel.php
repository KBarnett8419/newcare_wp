<?php
global $thebusiness_panels;
global $thebusiness_sections;
global $thebusiness_settings_controls;
global $thebusiness_repeated_settings_controls;
global $thebusiness_customizer_defaults;


$thebusiness_customizer_defaults['thebusiness-home-blog-enable'] = 0;
$thebusiness_customizer_defaults['thebusiness-home-blog-title'] = __('FROM OUR BLOG','thebusiness');
$thebusiness_customizer_defaults['thebusiness-home-blog-sub-title'] = __('Stay update with us','thebusiness');
$thebusiness_customizer_defaults['thebusiness-home-blog-single-words'] = 30;
$thebusiness_customizer_defaults['thebusiness-home-blog-category'] = 0;
$thebusiness_customizer_defaults['thebusiness-home-blog-button-text'] = __('Browse more','thebusiness');
$thebusiness_customizer_defaults['thebusiness-home-blog-button-link'] = home_url( '/blog' );

$thebusiness_sections['thebusiness-home-blog-panel'] =
    array(
        'priority'       => 190,
        'title'          => __( 'Home blog Section', 'thebusiness' ),
   	);

$thebusiness_settings_controls['thebusiness-home-blog-enable'] =
    array(
        'setting' =>     array(
            'default'              => $thebusiness_customizer_defaults['thebusiness-home-blog-enable']
        ),
        'control' => array(
            'label'                 =>  __( 'Enable Blog', 'thebusiness' ),
            'description'           => __( 'Enable "Blog Section" on checked' , 'thebusiness' ),
            'section'               => 'thebusiness-home-blog-panel',
            'type'                  => 'checkbox',
            'priority'              => 10,
            'active_callback'       => ''
        )
    );


$thebusiness_settings_controls['thebusiness-home-blog-title'] =
    array(
        'setting' =>     array(
            'default'              => $thebusiness_customizer_defaults['thebusiness-home-blog-title']
        ),
        'control' => array(
            'label'                 =>  __( 'Main Title', 'thebusiness' ),
            'section'               => 'thebusiness-home-blog-panel',
            'type'                  => 'text',
            'priority'              => 20,
            'active_callback'       => ''
        )
    );

$thebusiness_settings_controls['thebusiness-home-blog-sub-title'] =
    array(
        'setting' =>     array(
            'default'              => $thebusiness_customizer_defaults['thebusiness-home-blog-sub-title']
        ),
        'control' => array(
            'label'                 =>  __( 'Sub Title', 'thebusiness' ),
            'section'               => 'thebusiness-home-blog-panel',
            'type'                  => 'text',
            'priority'              => 30,
            'active_callback'       => ''
        )
    );


    /*String in max to be appear as description on blog*/
    $thebusiness_settings_controls['thebusiness-home-blog-single-words'] =
        array(
            'setting' =>     array(
                'default'              => $thebusiness_customizer_defaults['thebusiness-home-blog-single-words']
            ),
            'control' => array(
                'label'                 =>  __( 'Number Of Words', 'thebusiness' ),
                'description'           =>  __( 'Give number of words you wish to be appear on home page blog section sticky post/ feature post', 'thebusiness' ),
                'section'               => 'thebusiness-home-blog-panel',
                'type'                  => 'number',
                'priority'              => 40,
                'input_attrs' => array( 'min' => 1, 'max' => 200),
                'active_callback'       => ''
            )
        );

/*creating setting control for thebusiness-fs-Category start*/
$thebusiness_settings_controls['thebusiness-home-blog-category'] =
    array(
        'setting' =>     array(
            'default'              => $thebusiness_customizer_defaults['thebusiness-home-blog-category']
        ),
        'control' => array(
            'label'                 =>  __( 'Select Category For Blog', 'thebusiness' ),
            'description'           =>  __( 'Blog will only displayed from this category', 'thebusiness' ),
            'section'               => 'thebusiness-home-blog-panel',
            'type'                  => 'category_dropdown',
            'priority'              => 60,
            'active_callback'       => ''
        )
    );


    $thebusiness_settings_controls['thebusiness-home-blog-button-text'] =
        array(
            'setting' =>     array(
                'default'              => $thebusiness_customizer_defaults['thebusiness-home-blog-button-text']
            ),
            'control' => array(
                'label'                 =>  __( 'Browse All Button Text', 'thebusiness' ),
                'section'               => 'thebusiness-home-blog-panel',
                'type'                  => 'text',
                'priority'              => 70,
                'active_callback'       => ''
            )
        );

    $thebusiness_settings_controls['thebusiness-home-blog-button-link'] =
        array(
            'setting' =>     array(
                'default'              => $thebusiness_customizer_defaults['thebusiness-home-blog-button-link']
            ),
            'control' => array(
                'label'                 =>  __( 'Browse All Button Link', 'thebusiness' ),
                'section'               => 'thebusiness-home-blog-panel',
                'type'                  => 'url',
                'priority'              => 80,
                'active_callback'       => ''
            )
        );