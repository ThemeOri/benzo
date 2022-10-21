<?php
namespace BdevsElement\Widget;

use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Group_Control_Text_Shadow;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Control_Media;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;



defined( 'ABSPATH' ) || die();

class Featured_List extends BDevs_El_Widget {

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
        return 'featured_list';
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
        return __( 'Featured List', 'bdevs-element' );
    }

    public function get_custom_help_url() {
        return 'http://elementor.bdevs.net//widgets/icon-box/';
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
        return 'eicon-editor-list-ul';
    }

    public function get_keywords() {
        return [ 'featured', 'list', 'icon' ];
    }

    protected function register_content_controls() {

        $this->start_controls_section(
            '_section_design_title',
            [
                'label' => __( 'Design Style', 'bdevs-element' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'design_style',
            [
                'label' => __( 'Design Style', 'bdevs-element' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __( 'Style 1', 'bdevs-element' ),
                    'style_2' => __( 'Style 2', 'bdevs-element' ),
                    'style_3' => __( 'Style 3', 'bdevs-element' ),
                    'style_4' => __( 'Style 4', 'bdevs-element' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
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
                    'design_style' => ['style_123'],
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
                'selector' => '{{WRAPPER}} .elementor-background-overlay',
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
                    '{{WRAPPER}}  .elementor-background-overlay' => 'opacity: {{SIZE}};',
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
                'selector' => '{{WRAPPER}} .zf-item:hover .elementor-background-overlay',
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
                    '{{WRAPPER}} .zf-item:hover .elementor-background-overlay' => 'opacity: {{SIZE}};',
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

        $this->start_controls_section(
            '_section_title_desc',
            [
                'label' => __( 'Title & Description', 'bdevs-element' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_1','style_2','style_3']
                ]
            ]
        );
        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'bdevs-element' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __( 'Features Title', 'bdevs-element' ),
                'placeholder' => __( 'Type Icon Box Title', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_1']
                ]
            ]
        );
        $this->add_control(
            'title_tag',
            [
                'label' => __( 'Title HTML Tag', 'bdevs-element' ),
                'type' => Controls_Manager::CHOOSE,
                'separator' => 'before',
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
                'condition' => [
                    'design_style' => ['style_1']
                ]
            ]
        );
        $this->add_control(
            'back_title',
            [
                'label' => __( 'Back Title', 'bdevs-element' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __( 'Shape Title', 'bdevs-element' ),
                'placeholder' => __( 'Type Shape Title', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_1', 'style_2']
                ]
            ]
        );
        $this->add_control(
            'shape_switcher',
            [
                'label' => __('Shape Switcher', 'bdevs-element'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevs-element'),
                'label_off' => __('Hide', 'bdevs-element'),
                'return_value' => 'yes',
                'condition' => [
                    'design_style' => ['style_1', 'style_2']
                ], 
                'default' => '',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            '_section_image',
            [
                'label' => __( 'Image', 'bdevs-element' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_1','style_2','style_3']
                ]
            ]
        );
        $this->add_control(
            'image',
            [
                'label' => __( 'Image', 'bdevs-element' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'design_style' => ['style_1']
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            '_section_icon',
            [
                'label' => __( 'Featured List', 'bdevs-element' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'field_condition',
            [
                'label' => __( 'Field condition', 'bdevs-element' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __( 'Style 1', 'bdevs-element' ),
                    'style_2' => __( 'Style 2', 'bdevs-element' ),
                    'style_3' => __( 'Style 3', 'bdevs-element' )
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );
        $repeater->add_control(
            'featured_icon_color',
            [
                'label' => __( 'Icon Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#d42222',
                'frontend_available' => true,
                'selectors' => [
                     '{{WRAPPER}}  {{CURRENT_ITEM}} .item_icon i' => 'color: {{VALUE}};',
                     '{{WRAPPER}}  {{CURRENT_ITEM}} .bdevs-btn-icon i' => 'color: {{VALUE}};'
                ],
                'style_transfer' => true,
                'frontend_available' => true,
                'condition' => [
                    'field_condition' => ['style_1', 'style_2']
                ]
            ]
        );  
        $repeater->add_control(
            'image_2',
            [
                'label' => __( 'Image', 'bdevs-element' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'field_condition' => ['style_2']
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $repeater->add_control(
            'type',
            [
                'label' => __( 'Media Type', 'bdevs-element' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'icon' => [
                        'title' => __( 'Icon', 'bdevs-element' ),
                        'icon' => 'fa fa-smile-o',
                    ],
                    'image' => [
                        'title' => __( 'Image', 'bdevs-element' ),
                        'icon' => 'fa fa-image',
                    ],
                ],
                'default' => 'icon',
                'toggle' => false,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => __( 'Image', 'bdevs-element' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'type' => 'image'
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'medium_large',
                'separator' => 'none',
                'exclude' => [
                    'full',
                    'custom',
                    'large',
                    'shop_catalog',
                    'shop_single',
                    'shop_thumbnail'
                ],
                'condition' => [
                    'type' => 'image'
                ]
            ]
        );

        if ( bdevs_element_is_elementor_version( '<', '2.6.0' ) ) {
            $repeater->add_control(
                'icon',
                [
                    'label' => __( 'Icon', 'bdevs-element' ),
                    'label_block' => true,
                    'type' => Controls_Manager::ICON,
                    'options' => bdevs_element_get_bdevs_element_icons(),
                    'default' => 'fa fa-smile-o',
                    'condition' => [
                        'type' => 'icon'
                    ]
                ]
            );
        } 
        else {
            $repeater->add_control(
                'selected_icon',
                [
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fas fa-smile-wink',
                        'library' => 'fa-solid',
                    ],
                    'condition' => [
                        'type' => 'icon'
                    ]
                ]
            );
        }
        $repeater->add_control(
            'title',
            [
                'label' => __( 'Title', 'bdevs-element' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __( 'Features Title', 'bdevs-element' ),
                'placeholder' => __( 'Type Icon Box Title', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'field_condition' => ['style_1', 'style_2', 'style_3']
                ]
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => __( 'Description', 'bdevs-element' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => __( 'bdevs description', 'bdevs-element' ),
                'placeholder' => __( 'Description here', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'field_condition' => ['style_1', 'style_2', 'style_3']
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
                    'field_condition' => ['style_10'],
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
                    'field_condition' => ['style_10'],
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
                    'condition' => [
                        'field_condition' => ['style_10'],
                    ], 
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
                    'condition' => [
                        'field_condition' => ['style_10'],
                    ], 
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
                'condition' => [
                    'field_condition' => ['style_10'],
                ], 
                'selectors' => [
                    '{{WRAPPER}} .bdevs-btn--icon-before .bdevs-btn-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .bdevs-btn--icon-after .bdevs-btn-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

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
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'medium_large',
                'separator' => 'none',
                'exclude' => [
                    'full',
                    'custom',
                    'large',
                    'shop_catalog',
                    'shop_single',
                    'shop_thumbnail'
                ]
            ]
        );

        $this->add_responsive_control(
            'align_slide',
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
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};'
                ]
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            '_section_video_link',
            [
                'label' => __( 'Video Link', 'bdevs-element' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_2'],
                ]
            ]
        );
        $this->add_control(
            'video_link',
            [
                'label' => __( 'Link', 'bdevs-element' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => 'http://elementor.bdevs.net/',
                'dynamic' => [
                    'active' => true,
                ]
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
        // video
         $this->add_control(
            'video_icon_color',
            [
                'label' => __( 'Video Icon Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .popup_video i' => 'color: {{VALUE}}',
                ],
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

    /**
     * Render widget output on the frontend.
     *
     * Used to generate the final HTML displayed on the frontend.
     *
     * Note that if skin is selected, it will be rendered by the skin itself,
     * not the widget.
     *
     * @since 1.0.0
     * @access public
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        $this->add_inline_editing_attributes( 'title', 'basic' );
        $this->add_render_attribute( 'title', 'class', 'heading_text mb-0 bdevs-el-title' );
        if ( !empty($settings['image']['id']) ) {
            $image = wp_get_attachment_image_url( $settings['image']['id'], $settings['thumbnail_size'] );
        }
        ?>

        <?php if ( $settings['design_style'] === 'style_4' ): ?>

        <div class="policy_section r_top_spacee_2">
            <div class="container">
              <div class="policy_wrap m-0">
                <?php foreach ( $settings['slides'] as $slide ):
                  if ( !empty($slide['image_2']['id']) ) {
                      $image = wp_get_attachment_image_url( $slide['image_2']['id'], 'full' );
                      if ( ! $image ) {
                          $image = $slide['image_2']['url'];
                      }
                  }
                ?>
                <div class="policy_item_3">
                  <div class="item_icon">
                    <?php if( !empty($slide['selected_icon']) ): ?>
                      <?php bdevs_element_render_icon( $slide, 'icon', 'selected_icon', ['class' => 'bdevs-btn-icon'] ); ?>
                      <?php else: ?>
                          <img src="<?php echo esc_url($image); ?>" alt="icon" />
                    <?php endif; ?>
                  </div>
                  <?php if( $slide['title'] ) : ?>
                  <h3 class="item_title"><?php echo bdevs_element_kses_basic( $slide['title'] ); ?></h3>
                  <?php endif; ?>
                  <?php if( $slide['description'] ) : ?>
                  <p>
                    <?php echo bdevs_element_kses_basic( $slide['description'] ); ?>
                  </p>
                  <?php endif; ?>
                </div>
                <?php endforeach; ?>
              </div>
            </div>
        </div>


        <?php elseif ( $settings['design_style'] === 'style_3' ): ?>
        <div class="about_content">
            <div class="row">
            <?php foreach ( $settings['slides'] as $slide ):
                  if ( !empty($slide['image_2']['id']) ) {
                      $image = wp_get_attachment_image_url( $slide['image_2']['id'], 'full' );
                      if ( ! $image ) {
                          $image = $slide['image_2']['url'];
                      }
                  }
              ?>
            <div class="col col-lg-6">
                <div class="policy_item_2">
                  <div class="item_icon">
                    <?php if( !empty($slide['selected_icon']) ): ?>
                      <?php bdevs_element_render_icon( $slide, 'icon', 'selected_icon', ['class' => 'bdevs-btn-icon'] ); ?>
                      <?php else: ?>
                          <img src="<?php echo esc_url($image); ?>" alt="icon" />
                   <?php endif; ?>
                  </div>
                  <div class="item_content">
                    <?php if( $slide['title'] ) : ?>
                        <h3 class="item_title"><?php echo bdevs_element_kses_basic( $slide['title'] ); ?></h3>
                    <?php endif; ?>
                    <?php if( $slide['description'] ) : ?>
                    <p class="mb-0" data-text-color="#828A9B">
                      <?php echo bdevs_element_kses_basic( $slide['description'] ); ?>
                    </p>
                    <?php endif; ?>
                  </div>
                </div>
            </div>
            <?php endforeach; ?>
            </div>
          </div>
        <?php elseif ( $settings['design_style'] === 'style_2' ): ?>
            <div class="service_tab_content pb-0">
                <?php if(!empty($settings['back_title'] && $settings['shape_switcher'])) : ?>
                <h5 class="outline_text"><?php echo bdevs_element_kses_basic($settings['back_title']); ?></h5>
                <?php endif; ?>
                <div class="row justify-content-center">
                 <?php foreach ( $settings['slides'] as $slide ):
                    if ( !empty($slide['image_2']['id']) ) {
                        $image = wp_get_attachment_image_url( $slide['image_2']['id'], 'full' );
                        if ( ! $image ) {
                            $image = $slide['image_2']['url'];
                        }
                    }
                ?>
                  <div class="col col-lg-3 col-md-4 col-sm-6">
                    <div class="work_process_item bdevs-el-content elementor-repeater-item-<?php echo esc_attr( $slide['_id'] ); ?>">
                      <div class="item_icon" style="background-image: url('<?php echo $image ? esc_url($image): ''; ?>');">
                        <?php if( !empty($slide['selected_icon']) ): ?>
                            <?php bdevs_element_render_icon( $slide, 'icon', 'selected_icon', ['class' => 'bdevs-btn-icon'] ); ?>
                            <?php else: ?>
                                <img src="<?php echo esc_url($image); ?>" alt="icon" />
                        <?php endif; ?>
                      </div>
                      <?php if( $slide['title'] ) : ?>
                      <h3 class="item_ttile text-white bdevs-el-title"><?php echo bdevs_element_kses_basic( $slide['title'] ); ?></h3>
                      <?php endif; ?>
                      <?php if( $slide['description'] ) : ?>
                        <p class="mb-0">
                          <?php echo bdevs_element_kses_basic( $slide['description'] ); ?>
                        </p>
                        <?php endif; ?>
                    </div>
                  </div>
                  <?php endforeach; ?>
                </div>
                <?php if(!empty($settings['video_link'])) : ?>
                <div class="play_btn_wrap text-center" style="background-image: url('http://localhost/wp/repairon/wp-content/themes/repairon/assets/img/shapes/shape_1.png');">
                  <a class="popup_video" href="<?php echo esc_url($settings['video_link']); ?>">
                    <i class="fas fa-play"></i>
                  </a>
                </div>
                <?php endif; ?>
              </div>
        <?php else: 

        $this->add_inline_editing_attributes( 'title', 'basic' );
        $this->add_render_attribute( 'title', 'class', 'heading_text mb-0 bdevs-el-title' );
        if ( !empty($settings['image']['id']) ) {
            $image = wp_get_attachment_image_url( $settings['image']['id'], $settings['thumbnail_size'] );
        }
        ?>
        <div class="service_tab_content">
            <?php if(!empty($settings['back_title'] && $settings['shape_switcher'])) : ?>
                <h5 class="outline_text"><?php echo bdevs_element_kses_basic($settings['back_title']); ?></h5>
            <?php endif; ?>
            <div class="row">
              <div class="col order-last col-lg-5">
                <?php if(!empty($image)) : ?>
                <div class="image_wrap image_2">
                  <img src="<?php echo esc_url($image); ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($image), '_wp_attachment_image_alt', true); ?>">
                </div>
                <?php endif; ?>
              </div>
              <div class="col col-lg-7">
               <?php if ( $settings['title' ] ) :
                    printf( '<%1$s %2$s>%3$s</%1$s>',
                        tag_escape( $settings['title_tag'] ),
                        $this->get_render_attribute_string( 'title' ),
                        bdevs_element_kses_basic( $settings['title' ] )
                        );
                endif; ?>
                <div class="row">
                <?php foreach ( $settings['slides'] as $slide ):
                    if ( !empty($slide['image']['id']) ) {
                        $image = wp_get_attachment_image_url( $slide['image']['id'], 'full' );
                        if ( ! $image ) {
                            $image = $slide['image']['url'];
                        }
                    }
                ?>
                  <div class="col col-lg-6">
                    <div class="policy_item_2 elementor-repeater-item-<?php echo esc_attr( $slide['_id'] ); ?>">
                      <div class="item_icon">
                        <?php if( !empty($slide['selected_icon']) ): ?>
                            <?php bdevs_element_render_icon( $slide, 'icon', 'selected_icon', ['class' => 'bdevs-btn-icon'] ); ?>
                            <?php else: ?>
                                <img src="<?php echo esc_url($image); ?>" alt="icon" />
                        <?php endif; ?>
                      </div>
                      <div class="item_content bdevs-el-content">
                        <?php if( $slide['title'] ) : ?>
                            <h3 class="item_title text-white bdevs-el-title"><?php echo bdevs_element_kses_basic( $slide['title'] ); ?></h3>
                        <?php endif; ?>
                        <?php if( $slide['description'] ) : ?>
                        <p class="mb-0">
                          <?php echo bdevs_element_kses_basic( $slide['description'] ); ?>
                        </p>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
          </div>
        <?php endif; ?>
        
        <?php
    }

}
