<?php
$wp_customize->add_setting( 'amaz_store_disable_category_slide_sec', array(
                'default'               => false,
                'sanitize_callback'     => 'amaz_store_sanitize_checkbox',
            ) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'amaz_store_disable_category_slide_sec', array(
                'label'                 => esc_html__('Disable Section', 'amaz-store'),
                'type'                  => 'checkbox',
                'section'               => 'amaz_store_cat_slide_section',
                'settings'              => 'amaz_store_disable_category_slide_sec',
            ) ) );

// section heading
$wp_customize->add_setting('amaz_store_cat_slider_heading', array(
        'default' => __('Woo Category','amaz-store'),
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'amaz_store_sanitize_text',
        'transport'         => 'postMessage',
));
$wp_customize->add_control( 'amaz_store_cat_slider_heading', array(
        'label'    => __('Section Heading', 'amaz-store'),
        'section'  => 'amaz_store_cat_slide_section',
         'type'       => 'text',
));
/*****************/
// category layout
/*****************/
if(class_exists('amaz_store_WP_Customize_Control_Radio_Image')){
        $wp_customize->add_setting(
            'amaz_store_cat_slide_layout', array(
                'default'           => 'cat-layout-3',
                'sanitize_callback' => 'amaz_store_sanitize_radio',
            )
        );
$wp_customize->add_control(
            new amaz_store_WP_Customize_Control_Radio_Image(
                $wp_customize, 'amaz_store_cat_slide_layout', array(
                    'label'    => esc_html__( 'Category Layout', 'amaz-store' ),
                    'section'  => 'amaz_store_cat_slide_section',
                    'choices'  => array(
                        'cat-layout-1'   => array(
                            'url' => amaz_store_CAT_SLIDER_LAYOUT_1,
                        ),
                        'cat-layout-2'   => array(
                            'url' => amaz_store_CAT_SLIDER_LAYOUT_2,
                        ),
                        'cat-layout-3' => array(
                            'url' => amaz_store_CAT_SLIDER_LAYOUT_3,
                        ),
                              
                    ),
                )
            )
        );
} 
//= Choose All Category  =   
    if (class_exists( 'amaz_store_Customize_Control_Checkbox_Multiple')) {
   $wp_customize->add_setting('amaz_store_category_slide_list', array(
        'default'           => '',
        'sanitize_callback' => 'amaz_store_checkbox_explode'
    ));
    $wp_customize->add_control(new amaz_store_Customize_Control_Checkbox_Multiple(
            $wp_customize,'amaz_store_category_slide_list', array(
        'settings'=> 'amaz_store_category_slide_list',
        'label'   => __( 'Choose Categories To Show', 'amaz-store' ),
        'section' => 'amaz_store_cat_slide_section',
        'choices' => amaz_store_get_category_list(array('taxonomy' =>'product_cat'),true),
        ) 
    ));

}  
    // $wp_customize->add_setting('amaz_store_cat_item_no', array(
    //         'default'           => 5,
    //         'capability'        => 'edit_theme_options',
    //         'sanitize_callback' =>'amaz_store_sanitize_number',
    //     )
    // );
    // $wp_customize->add_control('amaz_store_cat_item_no', array(
    //         'type'        => 'number',
    //         'section'     => 'amaz_store_cat_slide_section',
    //         'label'       => __( 'No. of Column to show', 'amaz-store' ),
    //         'input_attrs' => array(
    //             'min'  => 1,
    //             'step' => 1,
    //             'max'  => 10,
    //         ),
    //     )
    // ); 
// Add an option to disable the logo.
  $wp_customize->add_setting( 'amaz_store_category_slider_optn', array(
    'default'           => false,
    'sanitize_callback' => 'amaz_store_sanitize_checkbox',
  ) );
  $wp_customize->add_control( new amaz_store_Toggle_Control( $wp_customize, 'amaz_store_category_slider_optn', array(
    'label'       => esc_html__( 'Slide Auto Play', 'amaz-store' ),
    'section'     => 'amaz_store_cat_slide_section',
    'type'        => 'toggle',
    'settings'    => 'amaz_store_category_slider_optn',
  ) ) );
  $wp_customize->add_setting('amaz_store_category_slider_speed', array(
        'default' =>'3000',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'amaz_store_sanitize_number',
   ));
   $wp_customize->add_control( 'amaz_store_category_slider_speed', array(
            'label'       => __('Speed', 'amaz-store'),
            'description' =>__('Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000','amaz-store'),
            'section'     => 'amaz_store_cat_slide_section',
             'type'       => 'number',
    ));


  $wp_customize->add_setting('amaz_store_category_slider_doc', array(
    'sanitize_callback' => 'amaz_store_sanitize_text',
    ));
$wp_customize->add_control(new amaz_store_Misc_Control( $wp_customize, 'amaz_store_category_slider_doc',
            array(
        'section'    => 'amaz_store_cat_slide_section',
        'type'      => 'doc-link',
        'url'       => 'https://themehunk.com/docs/amaz-store/#woo-category',
        'description' => esc_html__( 'To know more go with this', 'amaz-store' ),
        'priority'   =>100,
    )));