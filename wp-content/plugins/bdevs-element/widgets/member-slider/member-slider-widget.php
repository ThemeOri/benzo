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

defined( 'ABSPATH' ) || die();

class Member_Slider extends BDevs_El_Widget {

    /**
     * Get widget name.
     *
     * Retrieve Bdevs Element widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'member_slider';
    }

    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Member Slider', 'bdevs-element' );
    }

    public function get_custom_help_url() {
        return 'http://elementor.bdevs.net//widgets/slider/';
    }

    /**
     * Get widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-lock-user';
    }

    public function get_keywords() {
        return [ 'slider', 'memeber', 'gallery', 'carousel' ];
    }


    protected function register_content_controls() {


        $this->start_controls_section(
            '_section_design_titles',
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
                    'style_1' => __('Style 1', 'bdevs-element'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();

        // member icon switch
        $this->start_controls_section(
            '_member_more_icon',
            [
                'label' => __( 'Team Link Switch', 'bdevs-element' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_10'],
                ],
            ]
        );

        $this->add_control(
            'team_more_switch',
            [
                'label' => __( 'Team More Show', 'bdevs-element' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'bdevs-element' ),
                'label_off' => __( 'Hide', 'bdevs-element' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'style_transfer' => true,
                'condition' => [
                    'design_style' => ['style_10'],
                ],
            ]
        );

        $this->add_control(
            'team_slide_url',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => false,
                'placeholder' => __( 'Type link here', 'bdevs-element' ),
                'default' => __( '#', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->end_controls_section();

        // Background Overlay
        $this->start_controls_section(
            '_section_background_overlay',
            [
                'label' => __( 'Background Overlay', 'elementor' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_10'],
                ], 
            ]
        );
        
        $this->start_controls_tabs( 'tabs_background_overlay' );

        $this->start_controls_tab(
            'tab_background_overlay_normal',
            [
                'label' => __( 'Normal', 'elementor' ),
                
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => __( 'Background', 'bdevs-element' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .zt-item',
            ]
        );

        $this->add_control(
            'background_overlay_opacity',
            [
                'label' => __( 'Opacity', 'elementor' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => .5,
                ],
                'range' => [
                    'px' => [
                        'max' => 1,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}  .zt-item' => 'opacity: {{SIZE}};',
                ],
                // 'condition' => [
                //     'background_overlay_background' => [ 'classic', 'gradient' ],
                // ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_background_overlay_hover',
            [
                'label' => __( 'Hover', 'elementor' ),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background_hover',
                'label' => __( 'Background', 'bdevs-element' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .zt-item:hover::after',
            ]
        );

        $this->add_control(
            'background_hover_overlay_opacity',
            [
                'label' => __( 'Opacity', 'elementor' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => .5,
                ],
                'range' => [
                    'px' => [
                        'max' => 1,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .zt-item:hover::after' => 'opacity: {{SIZE}};',
                ],
                // 'condition' => [
                //     'background_overlay_background' => [ 'classic', 'gradient' ],
                // ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        // overlay end


        // member list
        $this->start_controls_section(
            '_section_slides',
            [
                'label' => __( 'Members List', 'bdevs-element' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->start_controls_tabs(
            '_tab_style_member_box_slider'
        );

        $repeater->start_controls_tab(
            '_tab_member_info',
            [
                'label' => __( 'Information', 'bdevs-element' ),
            ]
        );

        $repeater->add_control(
            'image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Image', 'bdevs-element' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );                      

        $repeater->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Title', 'bdevs-element' ),
                'default' => __( 'BDevs Member Title', 'bdevs-element' ),
                'placeholder' => __( 'Type title here', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'designation',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'label' => __( 'Job Title', 'bdevs-element' ),
                'default' => __( 'BDevs Officer', 'bdevs-element' ),
                'placeholder' => __( 'Type designation here', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );   

        $repeater->add_control(
            'slide_url',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => false,
                'placeholder' => __( 'Type link here', 'bdevs-element' ),
                'default' => __( '#', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            '_tab_member_links',
            [
                'label' => __( 'Links', 'bdevs-element' ),
            ]
        );

        $repeater->add_control(
            'show_social',
            [
                'label' => __( 'Show Options?', 'bdevs-element' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'bdevs-element' ),
                'label_off' => __( 'No', 'bdevs-element' ),
                'return_value' => 'yes',
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'web_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Website Address', 'bdevs-element' ),
                'placeholder' => __( 'Add your profile link', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'email_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Email', 'bdevs-element' ),
                'placeholder' => __( 'Add your email link', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );           

        $repeater->add_control(
            'phone_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Phone', 'bdevs-element' ),
                'placeholder' => __( 'Add your phone link', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'facebook_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Facebook', 'bdevs-element' ),
                'default' => __( '#', 'bdevs-element' ),
                'placeholder' => __( 'Add your facebook link', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );                

        $repeater->add_control(
            'twitter_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Twitter', 'bdevs-element' ),
                'default' => __( '#', 'bdevs-element' ),
                'placeholder' => __( 'Add your twitter link', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'instagram_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Instagram', 'bdevs-element' ),
                'default' => __( '#', 'bdevs-element' ),
                'placeholder' => __( 'Add your instagram link', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );       

        $repeater->add_control(
            'linkedin_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'LinkedIn', 'bdevs-element' ),
                'default' => __( '#', 'bdevs-element' ),
                'placeholder' => __( 'Add your linkedin link', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'youtube_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Youtube', 'bdevs-element' ),
                'placeholder' => __( 'Add your youtube link', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'googleplus_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Google Plus', 'bdevs-element' ),
                'placeholder' => __( 'Add your Google Plus link', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'flickr_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Flickr', 'bdevs-element' ),
                'placeholder' => __( 'Add your flickr link', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'vimeo_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Vimeo', 'bdevs-element' ),
                'placeholder' => __( 'Add your vimeo link', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'behance_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Behance', 'bdevs-element' ),
                'placeholder' => __( 'Add your hehance link', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'dribble_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Dribbble', 'bdevs-element' ),
                'placeholder' => __( 'Add your dribbble link', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'pinterest_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Pinterest', 'bdevs-element' ),
                'placeholder' => __( 'Add your pinterest link', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'gitub_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Github', 'bdevs-element' ),
                'placeholder' => __( 'Add your github link', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        ); 

        $repeater->end_controls_tab();
        $repeater->end_controls_tabs();

        // REPEATER
        $this->add_control(
            'slides',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(title || "Carousel Item"); #>',
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
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ]
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

        $this->add_control(
            'title_tag',
            [
                'label' => __( 'Title HTML Tag', 'bdevs-element' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1'  => [
                        'title' => __( 'H1', 'bdevs-element' ),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2'  => [
                        'title' => __( 'H2', 'bdevs-element' ),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3'  => [
                        'title' => __( 'H3', 'bdevs-element' ),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4'  => [
                        'title' => __( 'H4', 'bdevs-element' ),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5'  => [
                        'title' => __( 'H5', 'bdevs-element' ),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6'  => [
                        'title' => __( 'H6', 'bdevs-element' ),
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
                'label' => __( 'Alignment', 'bdevs-element' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'bdevs-element' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'bdevs-element' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'bdevs-element' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .single-carousel-item' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_settings',
            [
                'label' => __( 'Settings', 'bdevs-element' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_10']
                ],
            ]
        );

        $this->add_control(
            'slider_active',
            [
                'label' => __( 'Slider active on/off', 'bdevs-element' ),
                'type' => Controls_Manager::SWITCHER,
                'default' =>true,
            ]
        );
        $this->add_control(
            'animation_speed',
            [
                'label' => __( 'Animation Speed', 'bdevs-element' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 100,
                'step' => 10,
                'max' => 10000,
                'default' => 300,
                'description' => __( 'Slide speed in milliseconds', 'bdevs-element' ),
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => __( 'Autoplay?', 'bdevs-element' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'bdevs-element' ),
                'label_off' => __( 'No', 'bdevs-element' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label' => __( 'Autoplay Speed', 'bdevs-element' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 100,
                'step' => 100,
                'max' => 10000,
                'default' => 3000,
                'description' => __( 'Autoplay speed in milliseconds', 'bdevs-element' ),
                'condition' => [
                    'autoplay' => 'yes',
                    'design_style' => ['style_10']
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'loop',
            [
                'label' => __( 'Infinite Loop?', 'bdevs-element' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'bdevs-element' ),
                'label_off' => __( 'No', 'bdevs-element' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'vertical',
            [
                'label' => __( 'Vertical Mode?', 'bdevs-element' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'bdevs-element' ),
                'label_off' => __( 'No', 'bdevs-element' ),
                'return_value' => 'yes',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'navigation',
            [
                'label' => __( 'Navigation', 'bdevs-element' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => __( 'None', 'bdevs-element' ),
                    'arrow' => __( 'Arrow', 'bdevs-element' ),
                    'dots' => __( 'Dots', 'bdevs-element' ),
                    'both' => __( 'Arrow & Dots', 'bdevs-element' ),
                ],
                'default' => 'arrow',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();


    }

    protected function register_style_controls() {
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

    protected function render() {
        $settings = $this->get_settings_for_display();

        $this->add_inline_editing_attributes( 'title', 'basic' );
        $this->add_render_attribute( 'title', 'class', 'team-title bdevs-el-title' );
        $this->add_render_attribute( 'name', 'class', 'name' );

        $this->add_inline_editing_attributes( 'description', 'intermediate' );
        $this->add_render_attribute( 'description', 'class', 'bdevs-card-text' );

        if (!empty($title)) {
            $title = bdevs_element_kses_basic( $settings['title' ] );
        }
        
        if ( empty( $settings['slides'] ) ) {
            return;
        }
        ?>

    <?php if ( $settings['design_style'] === 'style_1' ): 
        $this->add_render_attribute( 'title', 'class', 'name_text bdevs-el-title' );
        // bg_image
        if (!empty($settings['bg_shape_image']['id'])) {
            $bg_shape_image = wp_get_attachment_image_url( $settings['bg_shape_image']['id'], $settings['shape_size'] );
            if ( ! $bg_shape_image ) {
                $bg_shape_image = $settings['bg_shape_image']['url'];
            }  
        }  

        $slider_active = !empty($settings['slider_active']) ? 'team1__carousel owl-carousel' : '';
    ?>
      <section class="team_section">
        <div class="container">
          <div class="row">
            <?php foreach ( $settings['slides'] as $slide ) :
                $title = bdevs_element_kses_basic( $slide['title' ] );
                $slide_url = esc_url($slide['slide_url']);
                
                if (!empty($slide['image']['id'])) {
                    $image = wp_get_attachment_image_url( $slide['image']['id'], $settings['thumbnail_size'] );
                    if ( ! $image ) {
                        $image = !empty($slide['image']['url']) ? $slide['image']['url'] : '' ;
                    }  
                }          
            ?>
            <div class="col col-lg-4 col-md-6 col-sm-6 mb-30">
              <div class="team_item">

                <?php if( !empty( $image ) ) : ?>
                <a class="item_image" href="<?php echo esc_url($slide_url); ?>">
                  <img src="<?php print esc_url($image); ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($image), '_wp_attachment_image_alt', true); ?>">
                </a>
                <?php endif; ?>

                <div class="item_content">

                    <?php printf( '<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
                        tag_escape( $settings['title_tag'] ),
                        $this->get_render_attribute_string( 'title' ),
                        $title,
                        $slide_url
                    ); ?>

                  <?php if( !empty( $slide['designation'] ) ) : ?>
                  <h4 class="designation_text"><?php echo bdevs_element_kses_basic( $slide['designation'] ); ?></h4>
                  <?php endif; ?>

                  <?php if( !empty($slide['show_social'] ) ) : ?>
                  <ul class="social_icon ul_li_center">
                        <?php if( !empty($slide['web_title'] ) ) : ?>
                        <li>
                            <a href="<?php echo esc_url( $slide['web_title'] ); ?>">
                                <i class="far fa-globe"></i>
                            </a>
                        </li>
                        <?php endif; ?>

                        <?php if( !empty($slide['email_title'] ) ) : ?>
                        <li>    
                            <a href="mailto:<?php echo esc_url( $slide['email_title'] ); ?>">
                                <i class="fal fa-envelope"></i>
                            </a>
                        </li>
                        <?php endif; ?>  

                        <?php if( !empty($slide['phone_title'] ) ) : ?>
                        <li>    
                            <a href="tell:<?php echo esc_url( $slide['phone_title'] ); ?>">
                                <i class="fas fa-phone"></i>
                            </a>
                        </li>
                        <?php endif; ?>  

                        <?php if( !empty($slide['facebook_title'] ) ) : ?>
                        <li>    
                            <a href="<?php echo esc_url( $slide['facebook_title'] ); ?>">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        <?php endif; ?>

                        <?php if( !empty($slide['twitter_title'] ) ) : ?>
                        <li>    
                            <a href="<?php echo esc_url( $slide['twitter_title'] ); ?>">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                        <?php endif; ?>

                        <?php if( !empty($slide['instagram_title'] ) ) : ?>
                        <li>     
                            <a href="<?php echo esc_url( $slide['instagram_title'] ); ?>">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                        <?php endif; ?>

                        <?php if( !empty($slide['linkedin_title'] ) ) : ?>
                        <li>    
                            <a href="<?php echo esc_url( $slide['linkedin_title'] ); ?>">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </li>
                        <?php endif; ?>

                        <?php if( !empty($slide['youtube_title'] ) ) : ?>
                        <li>    
                            <a href="<?php echo esc_url( $slide['youtube_title'] ); ?>">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </li>
                        <?php endif; ?>

                        <?php if( !empty($slide['googleplus_title'] ) ) : ?>
                        <li>    
                            <a href="<?php echo esc_url( $slide['googleplus_title'] ); ?>">
                                <i class="fab fa-google-plus-g"></i>
                            </a>
                        </li>
                        <?php endif; ?>

                        <?php if( !empty($slide['flickr_title'] ) ) : ?>
                        <li>    
                            <a href="<?php echo esc_url( $slide['flickr_title'] ); ?>">
                                <i class="fab fa-flickr"></i>
                            </a>
                        <?php endif; ?>

                        <?php if( !empty($slide['vimeo_title'] ) ) : ?>
                        <li>    
                            <a href="<?php echo esc_url( $slide['vimeo_title'] ); ?>">
                                <i class="fab fa-vimeo-v"></i>
                            </a>
                        </li>
                        <?php endif; ?>

                        <?php if( !empty($slide['behance_title'] ) ) : ?>
                        <li>    
                            <a href="<?php echo esc_url( $slide['behance_title'] ); ?>">
                                <i class="fab fa-behance"></i>
                            </a>
                        </li>
                        <?php endif; ?>

                        <?php if( !empty($slide['dribble_title'] ) ) : ?>
                        <li>    
                            <a href="<?php echo esc_url( $slide['dribble_title'] ); ?>">
                                <i class="fab fa-dribbble"></i>
                            </a>
                        </li>
                        <?php endif; ?>

                        <?php if( !empty($slide['pinterest_title'] ) ) : ?>
                        <li>    
                            <a href="<?php echo esc_url( $slide['pinterest_title'] ); ?>">
                                <i class="fab fa-pinterest-p"></i>
                            </a>
                        </li>
                        <?php endif; ?>

                        <?php if( !empty($slide['gitub_title'] ) ) : ?>
                        <li>   
                            <a href="<?php echo esc_url( $slide['gitub_title'] ); ?>">
                                <i class="fab fa-github"></i>
                            </a>
                        </li>
                        <?php endif; ?>
                  </ul>
                  <?php endif; ?>
                </div>
              </div>
            </div>
            <?php endforeach; ?>

          </div>

        </div>
      </section>


    <!-- style 2 -->
    <?php elseif ( $settings['design_style'] === 'style_2' ): ?>
    <section class="team1">
        <div class="container">
            <div class="row">
                <?php foreach ( $settings['slides'] as $slide ) :
                    $title = bdevs_element_kses_basic( $slide['title' ] );
                    $slide_url = esc_url($slide['slide_url']);
                    
                    if (!empty($slide['image']['id'])) {
                        $image = wp_get_attachment_image_url( $slide['image']['id'], $settings['thumbnail_size'] );
                        if ( ! $image ) {
                            $image = !empty($slide['image']['url']) ? $slide['image']['url'] : '' ;
                        }  
                    }          
                ?>
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="team1__item mb-50">
                        <?php if( !empty( $image ) ) : ?>
                        <div class="team1__thumb">
                            <a href="<?php echo esc_url($slide_url); ?>"><img src="<?php print esc_url($image); ?>" alt="img"></a>
                        </div>
                        <?php endif; ?>
                        <!-- socials -->
                        <?php if( !empty($slide['show_social'] ) ) : ?>
                        <div class="team1__social text-center">
                            <?php if( !empty($slide['web_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['web_title'] ); ?>"><i class="far fa-globe"></i></a>
                            <?php endif; ?>  

                            <?php if( !empty($slide['email_title'] ) ) : ?>
                            <a href="mailto:<?php echo esc_url( $slide['email_title'] ); ?>"><i class="fal fa-envelope"></i></a>
                            <?php endif; ?>  

                            <?php if( !empty($slide['phone_title'] ) ) : ?>
                            <a href="tell:<?php echo esc_url( $slide['phone_title'] ); ?>"><i class="fas fa-phone"></i></a>
                            <?php endif; ?>  

                            <?php if( !empty($slide['facebook_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['facebook_title'] ); ?>"><i class="fab fa-facebook-f"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['twitter_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['twitter_title'] ); ?>"><i class="fab fa-twitter"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['instagram_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['instagram_title'] ); ?>"><i class="fab fa-instagram"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['linkedin_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['linkedin_title'] ); ?>"><i class="fab fa-linkedin-in"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['youtube_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['youtube_title'] ); ?>"><i class="fab fa-youtube"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['googleplus_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['googleplus_title'] ); ?>"><i class="fab fa-google-plus-g"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['flickr_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['flickr_title'] ); ?>"><i class="fab fa-flickr"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['vimeo_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['vimeo_title'] ); ?>"><i class="fab fa-vimeo-v"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['behance_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['behance_title'] ); ?>"><i class="fab fa-behance"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['dribble_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['dribble_title'] ); ?>"><i class="fab fa-dribbble"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['pinterest_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['pinterest_title'] ); ?>"><i class="fab fa-pinterest-p"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['gitub_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['gitub_title'] ); ?>"><i class="fab fa-github"></i></a>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                        <div class="team1__content text-center">
                            <?php printf( '<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
                                tag_escape( $settings['title_tag'] ),
                                $this->get_render_attribute_string( 'title' ),
                                $title,
                                $slide_url
                            ); ?>
                            <?php if( !empty( $slide['designation'] ) ) : ?>
                            <p class="m-0"><?php echo bdevs_element_kses_basic( $slide['designation'] ); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

        <!-- style 2 -->
    <?php elseif ( $settings['design_style'] === 'style_3' ): ?>
    <section class="our-expert-area our-expert-area-2 our-expert-area-3">
        <div class="container">
            <div class="row mt-none-30 team-center-active">
                <?php foreach ( $settings['slides'] as $slide ) :
                    $title = bdevs_element_kses_basic( $slide['title' ] );
                    $slide_url = esc_url($slide['slide_url']);

                    $image = wp_get_attachment_image_url( $slide['image']['id'], $settings['thumbnail_size'] );
                    if ( ! $image ) {
                        $image = $slide['image']['url'];
                    }            

                ?>
                <div class="col-xl-4 col-lg-6 col-sm-12 mt-30">
                    <div class="single-carousel-item">
                        <?php if(!empty($settings['background_overlay_opacity'])) : ?>
                        <div class="elementor-background-overlay"></div>
                        <?php endif;?>
                        <div class="thumb">
                            <?php if( !empty($image) ) : ?>
                            <img src="<?php print esc_url($image); ?>" alt="">
                            <?php endif; ?>

                            <?php if( !empty($badge_image) ) : ?>
                            <span class="icon">
                                <img src="<?php print esc_url($badge_image); ?>" alt="">
                            </span>
                            <?php endif; ?>
                        </div>
                        <div class="content">
                            <?php printf( '<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
                                tag_escape( $settings['title_tag'] ),
                                $this->get_render_attribute_string( 'title' ),
                                $title,
                                $slide_url
                            ); ?>
                            <span class="sub-title"><?php echo bdevs_element_kses_basic( $slide['designation'] ); ?></span>
                            <p><?php echo bdevs_element_kses_basic( $slide['description'] ); ?></p>
                        </div>                        
                        <!-- socials -->
                        <?php if( !empty($slide['show_social'] ) ) : ?>
                        <div class="social-links">
                            <?php if( !empty($slide['web_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['web_title'] ); ?>"><i class="far fa-globe"></i></a>
                            <?php endif; ?>  

                            <?php if( !empty($slide['email_title'] ) ) : ?>
                            <a href="mailto:<?php echo esc_url( $slide['email_title'] ); ?>"><i class="fal fa-envelope"></i></a>
                            <?php endif; ?>  

                            <?php if( !empty($slide['phone_title'] ) ) : ?>
                            <a href="tell:<?php echo esc_url( $slide['phone_title'] ); ?>"><i class="fas fa-phone"></i></a>
                            <?php endif; ?>  

                            <?php if( !empty($slide['facebook_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['facebook_title'] ); ?>"><i class="fab fa-facebook-f"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['twitter_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['twitter_title'] ); ?>"><i class="fab fa-twitter"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['instagram_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['instagram_title'] ); ?>"><i class="fab fa-instagram"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['linkedin_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['linkedin_title'] ); ?>"><i class="fab fa-linkedin-in"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['youtube_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['youtube_title'] ); ?>"><i class="fab fa-youtube"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['googleplus_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['googleplus_title'] ); ?>"><i class="fab fa-google-plus-g"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['flickr_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['flickr_title'] ); ?>"><i class="fab fa-flickr"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['vimeo_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['vimeo_title'] ); ?>"><i class="fab fa-vimeo-v"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['behance_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['behance_title'] ); ?>"><i class="fab fa-behance"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['dribble_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['dribble_title'] ); ?>"><i class="fab fa-dribbble"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['pinterest_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['pinterest_title'] ); ?>"><i class="fab fa-pinterest-p"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['gitub_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['gitub_title'] ); ?>"><i class="fab fa-github"></i></a>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>    

        <?php
    }
}
