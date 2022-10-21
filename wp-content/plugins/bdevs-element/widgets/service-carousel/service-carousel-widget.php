<?php

namespace BdevsElement\Widget;

use \Elementor\Group_Control_Background;
use \Elementor\Repeater;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Utils;

defined('ABSPATH') || die();

class Service_Carousel extends BDevs_El_Widget
{

    /**
     * Get widget name.
     *
     * Retrieve Bdevs Element widget name.
     *
     * @return string Widget name.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_name()
    {
        return 'service-carousel';
    }

    /**
     * Get widget title.
     *
     * @return string Widget title.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_title()
    {
        return __('Service Carousel', 'bdevs-element');
    }

    public function get_custom_help_url()
    {
        return 'http://elementor.bdevs.net//widgets/slider/';
    }

    /**
     * Get widget icon.
     *
     * @return string Widget icon.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_icon()
    {
        return 'eicon-blockquote';
    }

    public function get_keywords()
    {
        return ['slider', 'testimonial', 'gallery', 'carousel'];
    }

    protected function register_content_controls()
    {


        $this->start_controls_section(
            '_section_design_title',
            [
                'label' => __('Design Style', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'design_style',
            [
                'label' => __('Design Style', 'bdevs-element'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __('Style 1', 'bdevs-element')
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();


        // section title
        $this->start_controls_section(
            '_section_title',
            [
                'label' => __('Title & Description', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' => __('Sub Title', 'bdevs-element'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __('bdevs Info Box Sub Title', 'bdevs-element'),
                'placeholder' => __('Type Info Box Sub Title', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_1']
                ]
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'bdevs-element'),
                'label_block' => true,
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('bdevs Info Box Title', 'bdevs-element'),
                'placeholder' => __('Type Info Box Title', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __('Description', 'bdevs-element'),
                'description' => bdevs_element_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('bdevs info box description goes here', 'bdevs-element'),
                'placeholder' => __('Type info box description', 'bdevs-element'),
                'rows' => 5,
                'condition' => [
                    'design_style' => ['style_11']
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => __('Title HTML Tag', 'bdevs-element'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => __('H1', 'bdevs-element'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => __('H2', 'bdevs-element'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => __('H3', 'bdevs-element'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => __('H4', 'bdevs-element'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => __('H5', 'bdevs-element'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => __('H6', 'bdevs-element'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h3',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __('Alignment', 'bdevs-element'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'bdevs-element'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'bdevs-element'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'bdevs-element'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();


        // Testimonial Video Info
        $this->start_controls_section(
                '_section_title_video',
                [
                    'label' => __('Testimonial Video Info', 'bdevs-element'),
                    'tab' => Controls_Manager::TAB_CONTENT,
                    'condition' => [
                        'design_style' => ['style_20']
                    ]
                ]
            );
        
            $this->add_control(
                'video_title',
                [
                    'label' => __('Video Title', 'bdevs-element'),
                    'label_block' => true,
                    'type' => Controls_Manager::TEXTAREA,
                    'default' => __('bdevs video Title', 'bdevs-element'),
                    'placeholder' => __('Type video Title', 'bdevs-element'),
                    'dynamic' => [
                        'active' => true,
                    ]
                ]
            );
    
            $this->add_control(
                'video_description',
                [
                    'label' => __('Video Description', 'bdevs-element'),
                    'description' => bdevs_element_get_allowed_html_desc('intermediate'),
                    'type' => Controls_Manager::TEXTAREA,
                    'default' => __('bdevs video description goes here', 'bdevs-element'),
                    'placeholder' => __('Type video description', 'bdevs-element'),
                    'rows' => 5,
                    'dynamic' => [
                        'active' => true,
                    ]
                ]
            );
            $this->add_control(
                'video_url',
                [
                    'label' => __( 'Video URL', 'bdevs-element' ),
                    'description' => bdevs_element_get_allowed_html_desc( 'intermediate' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'https://www.youtube.com/embed/Rr0uFzAOQus', 'bdevs-element' ),
                    'placeholder' => __( 'Set Video URL', 'bdevs-element' ),
                    'label_block' => true,
                    'dynamic' => [
                        'active' => true,
                    ]
                ]
            );
        
        $this->end_controls_section();


        // Images

        $this->start_controls_section(
            '_section_image',
            [
                'label' => __('Image', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'type' => 'icon',
                    'field_condition' => ['style_10'],
                ]
            ]
        );

        $this->add_control(
            'image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __('Image', 'bdevs-element'),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->end_controls_section();

        // Slides
        $this->start_controls_section(
            '_section_slides',
            [
                'label' => __('Slides', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'field_condition',
            [
                'label' => __('Field condition', 'bdevs-element'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __('Style 1', 'bdevs-element')
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );
        $repeater->add_control(
            'service_slug',
            [
                'label' => __('Service Slug', 'bdevs-element'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __('bdevs Service Slug', 'bdevs-element'),
                'placeholder' => __('Type Service Slug', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'field_condition' => ['style_1']
                ]
            ]
        );
        $repeater->add_control(
            'image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __('Service Image', 'bdevs-element'),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'field_condition' => ['style_1'],
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $repeater->add_control(
            'image_2',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __('Service Image 2', 'bdevs-element'),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'field_condition' => ['style_1'],
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $repeater->add_control(
            'regular_price',
            [
                'label' => __('Regular Price', 'bdevs-element'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __('$44.00', 'bdevs-element'),
                'placeholder' => __('Type Regular Price', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'field_condition' => ['style_1']
                ]
            ]
        );
        $repeater->add_control(
            'new_price',
            [
                'label' => __('New Price', 'bdevs-element'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __('$33.00', 'bdevs-element'),
                'placeholder' => __('Type New Price', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'field_condition' => ['style_1']
                ]
            ]
        );
        $repeater->add_control(
            'slide_title',
            [
                'label' => __('Title', 'bdevs-element'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __('bdevs Title', 'bdevs-element'),
                'placeholder' => __('Type Title', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'field_condition' => ['style_1']
                ]
            ]
        );
        $repeater->add_control(
            'slide_time',
            [
                'label' => __('Time', 'bdevs-element'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __('01:25 Min', 'bdevs-element'),
                'placeholder' => __('Type Time', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'field_condition' => ['style_1']
                ]
            ]
        );
        $repeater->add_control(
            'button_text',
            [
                'label' => __( 'Text', 'bdevs-element' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Button Text',
                'placeholder' => __( 'Type button text here', 'bdevs-element' ),
                'label_block' => true,
                'condition' => [
                    'field_condition' => ['style_1'],
                ], 
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'button_link',
            [
                'label' => __( 'Link', 'bdevs-element' ),
                'type' => Controls_Manager::URL,
                'placeholder' => 'http://elementor.bdevs.net/',
                'condition' => [
                    'field_condition' => ['style_1'],
                ], 
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        if ( bdevs_element_is_elementor_version( '<', '2.6.0' ) ) {
            $repeater->add_control(
                'button_icon',
                [
                    'label' => __( 'Icon', 'bdevs-element' ),
                    'label_block' => true,
                    'type' => Controls_Manager::ICON,
                    'options' => bdevs_element_get_bdevs_element_icons(),
                    'default' => 'fa fa-angle-right',
                ]
            );

            $condition = ['button_icon!' => ''];
        } else {
            $repeater->add_control(
                'button_selected_icon',
                [
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'button_icon',
                    'label_block' => true,
                ]
            );
            $condition = ['button_selected_icon[value]!' => ''];
        }

        $repeater->add_control(
            'button_icon_position',
            [
                'label' => __( 'Icon Position', 'bdevs-element' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'before' => [
                        'title' => __( 'Before', 'bdevs-element' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'after' => [
                        'title' => __( 'After', 'bdevs-element' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'before',
                'toggle' => false,
                'condition' => $condition,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'button_icon_spacing',
            [
                'label' => __( 'Icon Spacing', 'bdevs-element' ),
                'type' => Controls_Manager::SLIDER,
                'condition' => $condition,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn--icon-before .bdevs-el-btn-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .bdevs-el-btn--icon-after .bdevs-el-btn-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'slides',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(slide_title || "Carousel Item"); #>',
                'default' => [
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'medium_large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->end_controls_section();
        // Slides
        $this->start_controls_section(
            '_section_slide_lists',
            [
                'label' => __('Slide Lists', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control(
            'field_condition_2',
            [
                'label' => __('Field condition', 'bdevs-element'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __('Style 1', 'bdevs-element')
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );
        $repeater->add_control(
            'service_slug_2',
            [
                'label' => __('Service Slug', 'bdevs-element'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __('bdevs Service Slug', 'bdevs-element'),
                'placeholder' => __('Type Service Slug', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'field_condition_2' => ['style_1']
                ]
            ]
        );
        $repeater->add_control(
            'service_list_text',
            [
                'label' => __('Service List Text', 'bdevs-element'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __('Service List Text', 'bdevs-element'),
                'placeholder' => __('Type Service List Text', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'field_condition_2' => ['style_1']
                ]
            ]
        );
         $this->add_control(
            'slide_lists',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(service_slug_2 || "Carousel Item"); #>',
                'default' => [
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                ]
            ]
        );
        $this->end_controls_section();

        // Settings
        $this->start_controls_section(
            '_section_settings',
            [
                'label' => __( 'Settings', 'bdevs-element' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

       $this->add_control(
            'ts_slider_autoplay',
            [
                'label' => esc_html__( 'Autoplay', 'bdevs-element' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'bdevs-element' ),
                'label_off' => esc_html__( 'No', 'bdevs-element' ),
                'return_value' => 'yes',
                'default' => 'no'
            ]
        );

        $this->add_control(
            'ts_slider_speed',
            [
               'label' => esc_html__( 'Slider Speed', 'bdevs-element' ),
               'type' => Controls_Manager::NUMBER,
               'placeholder' => esc_html__( 'Enter Slider Speed', 'bdevs-element' ),
               'default' => '5000',
               // 'default' => 5000,
               'condition' => ["ts_slider_autoplay" => ['yes']],
            ]
          );

        $this->add_control(
        'ts_slider_nav_show',
            [
            'label' => esc_html__( 'Nav show', 'bdevs-element' ),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Yes', 'bdevs-element' ),
            'label_off' => esc_html__( 'No', 'bdevs-element' ),
            'return_value' => 'yes',
            'default' => 'yes'
            ]
        );
        $this->add_control(
         'ts_slider_dot_nav_show',
             [
             'label' => esc_html__( 'Dot nav', 'bdevs-element' ),
             'type' => Controls_Manager::SWITCHER,
             'label_on' => esc_html__( 'Yes', 'bdevs-element' ),
             'label_off' => esc_html__( 'No', 'bdevs-element' ),
             'return_value' => 'yes',
             'default' => 'yes'
             ]
         );

        $this->end_controls_section();


    }

    protected function register_style_controls(){
        $this->start_controls_section(
            '_section_style_content',
            [
                'label' => __( 'Title / Content', 'bdevs-element' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_responsive_control(
            'content_padding',
            [
                'label' => __( 'Content Padding', 'bdevs-element' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'content_background',
                'selector' => '{{WRAPPER}} .bdevs-el-content',
                'exclude' => [
                    'image'
                ]
            ]
        );
        
        // Title
        $this->add_control(
            '_heading_title',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Title', 'bdevs-element' ),
                'separator' => 'before'
            ]
        );
        
        $this->add_responsive_control(
            'title_spacing',
            [
                'label' => __( 'Bottom Spacing', 'bdevs-element' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'title_color',
            [
                'label' => __( 'Text Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title',
                'selector' => '{{WRAPPER}} .bdevs-el-title',
                'scheme' => Typography::TYPOGRAPHY_2,
            ]
        );
        
        // Subtitle    
        $this->add_control(
            '_heading_subtitle',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Subtitle', 'bdevs-element' ),
                'separator' => 'before'
            ]
        );
        
        $this->add_responsive_control(
            'subtitle_spacing',
            [
                'label' => __( 'Bottom Spacing', 'bdevs-element' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'subtitle_color',
            [
                'label' => __( 'Text Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-subtitle' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle',
                'selector' => '{{WRAPPER}} .bdevs-el-subtitle',
                'scheme' => Typography::TYPOGRAPHY_3,
            ]
        );
        
        // description
        $this->add_control(
            '_content_description',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Description', 'bdevs-element' ),
                'separator' => 'before'
            ]
        );
        
        $this->add_responsive_control(
            'description_spacing',
            [
                'label' => __( 'Bottom Spacing', 'bdevs-element' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-content p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'description_color',
            [
                'label' => __( 'Text Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-content p' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description',
                'selector' => '{{WRAPPER}} .bdevs-el-content p',
                'scheme' => Typography::TYPOGRAPHY_4,
            ]
        );
        
        
        $this->end_controls_section();


    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        // ================
        $show_navigation   =   $settings["ts_slider_nav_show"]=="yes"?true:false;
        $auto_nav_slide    =   $settings['ts_slider_autoplay'];
        $dot_nav_show      =   $settings['ts_slider_dot_nav_show'];
        $ts_slider_speed   =   $settings['ts_slider_speed'] ? $settings['ts_slider_speed'] : '5000';

        $slide_controls    = [
            'show_nav'=>$show_navigation, 
            'dot_nav_show'=>$dot_nav_show, 
            'auto_nav_slide'=>$auto_nav_slide, 
            'ts_slider_speed'=>$ts_slider_speed, 
        ];
   
        $slide_controls = \json_encode($slide_controls); 
        // ================


        if (empty($settings['slides'])) {
            return;
        }

        $title = bdevs_element_kses_basic($settings['title']);
        ?>
        <?php if ($settings['design_style'] == 'style_4'): ?>
        <section class="testimonial_section sec_ptb_130 bg_gray clearfix">
            <div class="container">
                <?php if (!empty($settings['title'])): ?>
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-7 col-sm-9">
                            <div class="section_title text-center mb_30 wow fadeInUp22" data-wow-delay=".1s">
                                <?php if ($settings['sub_title']) : ?>
                                    <h4 class="small_title"><?php echo bdevs_element_kses_intermediate($settings['sub_title']); ?></h4>
                                <?php endif; ?>
                                <?php printf('<%1$s %2$s>%3$s<span>.</span></%1$s>',
                                    tag_escape($settings['title_tag']),
                                    $this->get_render_attribute_string('title'),
                                    $title
                                ); ?>
                                <?php if ($settings['big_title']) : ?>
                                    <span class="biggest_title"><?php echo bdevs_element_kses_intermediate($settings['big_title']); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="testimonial_carousel column_3_carousel owl-carousel owl-theme wow fadeInUp22"
                     data-wow-delay=".3s">
                    <?php foreach ($settings['slides'] as $slide) :
                        // image
                        $image = wp_get_attachment_image_url($slide['image']['id'], $settings['thumbnail_size']);
                        // bg_image
                        $bg_image = wp_get_attachment_image_url($slide['bg_image']['id'], 'full');
                        ?>
                        <div class="item">
                            <div class="testimonial_primary">
                                <div class="content_wrap">
                                    <?php if (!empty($slide['message'])): ?>
                                        <p><?php echo bdevs_element_kses_intermediate($slide['message']); ?></p>
                                    <?php endif; ?>
                                    <?php if (!empty($bg_image)): ?>
                                        <span class="quote_icon">
                                    <img src="<?php print esc_url($slide['bg_image']['url']); ?>" alt="icon_not_found">
                                </span>
                                    <?php endif; ?>
                                </div>
                                <div class="hero_info_wrap">
                                    <?php if (!empty($image)): ?>
                                        <div class="hero_thumbnail">
                                            <img src="<?php print esc_url($slide['image']['url']); ?>"
                                                 alt="icon_not_found">
                                        </div>
                                    <?php endif; ?>
                                    <div class="hero_info">
                                        <?php if ($slide['client_name']): ?>
                                            <h3 class="hero_name"><?php echo bdevs_element_kses_basic($slide['client_name']); ?></h3>
                                        <?php endif; ?>
                                        <?php if ($slide['designation_name']): ?>
                                            <span class="hero_title"><?php echo bdevs_element_kses_basic($slide['designation_name']); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php elseif ($settings['design_style'] == 'style_3'): 

        $this->add_inline_editing_attributes( 'title', 'basic' );
        $this->add_render_attribute( 'title', 'class', 'title_text mb-0 bdevs-el-title' );

        ?>

        <section class="testimonial_section">
            <div class="container">

              <div class="row justify-content-center">
                <div class="col col-lg-6">
                  <div class="section_title text-center">
                    <?php if ($settings['sub_title']) : ?>
                    <h2 class="sub_title bdevs-el-subtitle">
                      <?php echo bdevs_element_kses_intermediate($settings['sub_title']); ?>
                    </h2>
                    <?php endif; ?>
                    <?php
                        if ( $settings['title' ] ) :
                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['title_tag'] ),
                                $this->get_render_attribute_string( 'title' ),
                                 $settings['title' ]
                                );
                        endif;
                    ?>
                  </div>
                </div>
              </div>

              <div class="testimonial_carousel_3" data-slick='{"arrows": false}'>
                <div class="common_carousel_3col">
                 <?php foreach ($settings['slides'] as $slide) :
                        if (!empty($slide['image']['id'])) {
                            $image = wp_get_attachment_image_url($slide['image']['id'], $settings['thumbnail_size']);
                        }
                  ?>
                  <div class="carousel_item">
                    <div class="testimonial_item_3">
                      <i class="quote_icon flaticon-quotation-right-mark"></i>
                      <div class="hero_wrap">
                        <div class="hero_image">
                        <?php if (!empty($image)): ?>
                          <img src="<?php print esc_url($slide['image']['url']); ?>" alt="Model Image">
                          <?php endif; ?>

                        </div>
                        <div class="hero_content">
                          <?php if ($slide['client_name']): ?>
                          <h3 class="hero_name"><?php echo bdevs_element_kses_basic($slide['client_name']); ?></h3>
                          <?php endif; ?>
                          <?php if ($slide['designation_name']): ?>
                          <span class="hero_designation"><?php echo bdevs_element_kses_basic($slide['designation_name']); ?></span>
                          <?php endif; ?>
                          <ul class="reting_star ul_li">
                            <li class="active"><i class="flaticon-star"></i></li>
                            <li class="active"><i class="flaticon-star"></i></li>
                            <li class="active"><i class="flaticon-star"></i></li>
                            <li class="active"><i class="flaticon-star"></i></li>
                            <li class="active"><i class="flaticon-star"></i></li>
                          </ul>
                        </div>
                      </div>
                      <?php if ($slide['message']): ?>
                      <p>
                        <?php echo bdevs_element_kses_basic($slide['message']); ?>
                      </p>
                      <?php endif; ?>
                    </div>
                  </div>
                  <?php endforeach ?>
                </div>
              </div>

            </div>
        </section>

    <?php elseif ($settings['design_style'] == 'style_2'): 
        $this->add_inline_editing_attributes( 'title', 'basic' );
        $this->add_render_attribute( 'title', 'class', 'title_text bdevs-el-title' );
        
    ?>

        <section class="testimonial_section pt-135 pb-90 decoration_wrap">
            <div class="half_bg_top" data-bg-color="#F5F7F8"></div>
            <div class="container">

              <div class="row justify-content-center">
                <div class="col col-lg-6">
                  <div class="section_title text-center">
                    <?php if ($settings['sub_title']) : ?>
                    <h2 class="sub_title bdevs-el-subtitle" data-text-color="#74C138">
                      <?php echo bdevs_element_kses_intermediate($settings['sub_title']); ?>
                      <span class="icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo/favourite_icon_3.png" alt="Logo Icon">
                      </span>
                    </h2>
                    <?php endif; ?>
                    <?php
                        if ( $settings['title' ] ) :
                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['title_tag'] ),
                                $this->get_render_attribute_string( 'title' ),
                                 $settings['title' ]
                                );
                         endif;
                    ?>
                  </div>
                </div>
              </div>
              <div class="testimonial_carousel_2 carousel_style_2">
                <div class="row common_carousel_2col" data-slick='{"arrows": false}'>
                 <?php foreach ($settings['slides'] as $slide) :
                    if (!empty($slide['image']['id'])) {
                        $image = wp_get_attachment_image_url($slide['image']['id'], $settings['thumbnail_size']);
                    }
                  ?>
                  <div class="col carousel_item">
                    <div class="testimonial_item_2" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/shapes/shape_4.png');">
                      <div class="quote_icon text-end">
                        <span>
                          <i class="flaticon-quotation-right-mark"></i>
                        </span>
                      </div>
                      <div class="content_wrap">
                        <?php if ($slide['client_name']): ?>
                        <h3 class="hero_name"><?php echo bdevs_element_kses_basic($slide['client_name']); ?></h3>
                        <?php endif; ?>
                        <?php if ($slide['designation_name']): ?>
                        <span class="hero_designation"><?php echo bdevs_element_kses_basic($slide['designation_name']); ?></span>
                        <?php endif; ?>
                        <?php if ($slide['message']): ?>
                        <p>
                          <?php echo bdevs_element_kses_basic($slide['message']); ?>
                        </p>
                        <?php endif; ?>
                        <ul class="reting_star ul_li">
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                        </ul>
                      </div>
                      <div class="thumbnail_wrap">
                        <?php if (!empty($image)): ?>
                        <img src="<?php print esc_url($slide['image']['url']); ?>" alt="Avatar Image">
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                  <?php endforeach; ?>
                </div>
              </div>

            </div>
        </section>

        <?php else:

        $this->add_inline_editing_attributes( 'title', 'basic' );
        $this->add_render_attribute( 'title', 'class', 'title_text bdevs-el-title' );  
        ?>

        <!-- Package Section - Start
        ================================================== -->
      <section class="package_section">
        <div class="container">
          <div class="row">
            <div class="col col-lg-6">
              <div class="section_title">
                <?php if ($settings['sub_title']) : ?>
                <h2 class="sub_title bdevs-el-subtitle"><?php echo bdevs_element_kses_intermediate($settings['sub_title']); ?></h2>
                <?php endif; ?>
                <?php
                if ( $settings['title' ] ) :
                    printf( '<%1$s %2$s>%3$s</%1$s>',
                        tag_escape( $settings['title_tag'] ),
                        $this->get_render_attribute_string( 'title' ),
                         $settings['title' ]
                        );
                 endif;
                ?>
              </div>
            </div>
          </div>
          <div class="service_package_carousel arrow_top_right">
            <div class="row common_carousel_1col" data-slick='{"dots": false}'>
                <?php foreach ($settings['slides'] as $key => $slide) :
                    if (!empty($slide['image']['id'])) {
                        $image = wp_get_attachment_image_url($slide['image']['id'], $settings['thumbnail_size']);
                    }
                    if (!empty($slide['image_2']['id'])) {
                        $image_2 = wp_get_attachment_image_url($slide['image_2']['id'], $settings['thumbnail_size']);
                    }
                    $this->add_render_attribute( 'button_'. $key, 'class', 'btn btn_danger bdevs-el-btn' );
                    if(!empty($slide['button_link']['url'])) {
                        $this->add_render_attribute( 'button_'. $key, 'href', $slide['button_link']['url'] );
                    }
                ?>
                <div class="col carousel_item">
                    <div class="service_package_item">
                      <div class="image_wrap">
                        <div class="beforeAfter">
                           <?php if (!empty($image)): ?>
                            <img src="<?php print esc_url($slide['image']['url']); ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($image), '_wp_attachment_image_alt', true); ?>">
                            <?php endif; ?>
                          <?php if (!empty($image_2)): ?>
                            <img src="<?php print esc_url($slide['image_2']['url']); ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($image_2), '_wp_attachment_image_alt', true); ?>">
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="content_wrap">
                        <div class="item_price">
                            <?php if(!empty($slide['new_price'])) : ?>
                                <span><?php echo bdevs_element_kses_intermediate($slide['new_price']); ?></span>
                            <?php endif; ?>
                            <?php if(!empty($slide['regular_price'])) : ?>
                                <del><?php echo bdevs_element_kses_intermediate($slide['regular_price']); ?></del>
                            <?php endif; ?>
                        </div>
                        <?php if(!empty($slide['slide_title'])) : ?>
                        <h3 class="item_title">
                          <?php echo bdevs_element_kses_intermediate($slide['slide_title']); ?>
                        </h3>
                        <?php endif; ?>
                        <?php if(!empty($slide['slide_time'])) : ?>
                        <span class="post_date"><i class="far fa-clock"></i> <?php echo bdevs_element_kses_intermediate($slide['slide_time']); ?></span>
                        <?php endif; ?>
                        <ul class="info_list ul_li_block">
                            <?php
                            foreach($settings['slide_lists'] as $list) {
                                if ($slide['service_slug'] === $list['service_slug_2']) {
                                    echo '<li><i class="fas fa-check-square"></i> '.$list['service_list_text'].'</li>';
                                }
                            }
                            ?>

                        </ul>
                        <?php if(!empty($slide['button_text'])) : ?>
                            <?php if ( $slide['button_text'] && ( ( empty( $slide['button_selected_icon'] ) || empty( $slide['button_selected_icon']['value'] ) ) && empty( $slide['button_icon'] ) ) ) :
                                    printf( '<a %1$s>%2$s</a>',
                                        $this->get_render_attribute_string('button_'. $key ),
                                        esc_html( $slide['button_text'] )
                                        );
                                elseif ( empty( $slide['button_text'] ) && ( ( !empty( $slide['button_selected_icon'] ) || empty( $slide['button_selected_icon']['value'] ) ) || !empty( $slide['button_icon'] ) ) ) : ?>
                                    <a <?php $this->print_render_attribute_string( 'button_'. $key ); ?>><?php bdevs_element_render_icon( $slide, 'button_icon', 'button_selected_icon' ); ?></a>
                                <?php elseif ( $slide['button_text'] && ( ( !empty( $slide['button_selected_icon'] ) || empty( $slide['button_selected_icon']['value'] ) ) || !empty($slide['button_icon']) ) ) :
                                    if ( $slide['button_icon_position'] === 'before' ): ?>
                                        <a <?php $this->print_render_attribute_string( 'button_'. $key ); ?>><span><?php bdevs_element_render_icon( $slide, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon'] ); ?></span> <?php echo esc_html($slide['button_text']); ?></a>
                                        <?php
                                    else: ?>
                                        <a <?php $this->print_render_attribute_string( 'button_'. $key ); ?>><?php echo esc_html($slide['button_text']); ?> <span><?php bdevs_element_render_icon( $slide, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon'] ); ?></span></a>
                                    <?php
                                    endif;
                            endif; ?> 
                        <?php endif; ?>
                      </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="carousel_arrow">
              <button type="button" class="cc1c_left_arrow"><i class="fal fa-angle-left"></i></button>
              <button type="button" class="cc1c_right_arrow"><i class="fal fa-angle-right"></i></button>
            </div>
          </div>
        </div>
      </section>
      <!-- Package Section - End
        ================================================== -->
    <?php endif; ?>
        <?php
    }
}
