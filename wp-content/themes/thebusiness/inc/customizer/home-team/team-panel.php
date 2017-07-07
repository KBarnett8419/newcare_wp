<?php
global $thebusiness_panels;
global $thebusiness_sections;
global $thebusiness_settings_controls;
global $thebusiness_repeated_settings_controls;
global $thebusiness_customizer_defaults;

/*defaults values feature portfolio options*/
$thebusiness_customizer_defaults['thebusiness-home-team-enable'] = 0;
$thebusiness_customizer_defaults['thebusiness-home-team-title'] = __('Our Teams','thebusiness');
$thebusiness_customizer_defaults['thebusiness-home-team-button-text'] = __('Browse more','thebusiness');
$thebusiness_customizer_defaults['thebusiness-home-team-button-link'] = esc_url( home_url( '/teams' ) );
$thebusiness_customizer_defaults['thebusiness-home-team-selection'] = 'from-page';
$thebusiness_customizer_defaults['thebusiness-home-team-number'] = 4;
$thebusiness_customizer_defaults['thebusiness-home-team-pages'] = 0;

/*creating panel for fonts-setting*/

$thebusiness_sections['thebusiness-home-team'] =
    array(
        'title'          => __( 'Home Team Section', 'thebusiness' ),
        'priority'       => 185
   	);


$thebusiness_settings_controls['thebusiness-home-team-enable'] =
    array(
        'setting' =>     array(
            'default'              => $thebusiness_customizer_defaults['thebusiness-home-team-enable']
        ),
        'control' => array(
            'label'                 =>  __( 'Enable Team', 'thebusiness' ),
            'section'               => 'thebusiness-home-team',
            'type'                  => 'checkbox',
            'priority'              => 10,
            'active_callback'       => ''
        )
    );


$thebusiness_settings_controls['thebusiness-home-team-title'] =
    array(
        'setting' =>     array(
            'default'              => $thebusiness_customizer_defaults['thebusiness-home-team-title']
        ),
        'control' => array(
            'label'                 =>  __( 'Main Title', 'thebusiness' ),
            'section'               => 'thebusiness-home-team',
            'type'                  => 'text',
            'priority'              => 15,
            'active_callback'       => ''
        )
    );
    
$thebusiness_settings_controls['thebusiness-home-team-button-link'] =
    array(
        'setting' =>     array(
            'default'              => $thebusiness_customizer_defaults['thebusiness-home-team-button-link']
        ),
        'control' => array(
            'label'                 =>  __( 'Browse All Button Link', 'thebusiness' ),
            'section'               => 'thebusiness-home-team',
            'type'                  => 'url',
            'priority'              => 70,
            'active_callback'       => ''
        )
    );

/*creating setting control for thebusiness-home-team-page start*/
$thebusiness_repeated_settings_controls['thebusiness-home-team-pages'] =
    array(
        'repeated' => 4,
        'thebusiness-home-team-pages-ids' => array(
            'setting' =>     array(
                'default'              => $thebusiness_customizer_defaults['thebusiness-home-team-pages'],
            ),
            'control' => array(
                'label'                 =>  __( 'Select Page For Team %s', 'thebusiness' ),
                'section'               => 'thebusiness-home-team',
                'type'                  => 'dropdown-pages',
                'priority'              => 60,
                'description'           => ''
            )
        ),
    );