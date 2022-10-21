<?php

namespace BdevsElement\Widget;

Use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Control_Media;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;

defined('ABSPATH') || die();

class About extends BDevs_El_Widget
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
        return 'about';
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
        return __('About', 'bdevs-element');
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
        return 'eicon-single-post';
    }

    public function get_keywords()
    {
        return ['info', 'blurb', 'box', 'about', 'content'];
    }

    /**
     * Register content related controls
     */
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
                    'style_1' => __('Style 1', 'bdevs-element'),
                    'style_2' => __('Style 2', 'bdevs-element'),
                    'style_3' => __('Style 3', 'bdevs-element'),
                    'style_4' => __('Style 4', 'bdevs-element'),
                    'style_5' => __('Style 5', 'bdevs-element'),
                    'style_6' => __('Style 6', 'bdevs-element'),
                    'style_7' => __('Style 7', 'bdevs-element'),
                    'style_8' => __('Style 8', 'bdevs-element'),
                    'style_9' => __('Style 9', 'bdevs-element'),
                    'style_10' => __('Style 10', 'bdevs-element'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_title',
            [
                'label' => __('Title & Description', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'shape_switch',
            [
                'label' => __('Shape Show/Hide', 'bdevselement'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevselement'),
                'label_off' => __('Hide', 'bdevselement'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'design_style' => ['style_3', 'style_7'],
                ],
                'style_transfer' => true,
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
                    'design_style' => ['style_1', 'style_2', 'style_3', 'style_4', 'style_5', 'style_6'],
                ],
            ]
        );

        $this->add_control(
            'back_title',
            [
                'label' => __('Back Title', 'bdevs-element'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __('About', 'bdevs-element'),
                'placeholder' => __('Type Info Box Back Title', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_4', 'style_7'],
                ],
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
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_1', 'style_3', 'style_4', 'style_5', 'style_7', 'style_8', 'style_9', 'style_10'],
                ]
            ]
        );
        $this->add_control(
            'price_start_label',
            [
                'label' => __('Price Start Label', 'bdevs-element'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __('Start From', 'bdevs-element'),
                'placeholder' => __('Price Start Label', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_8']
                ]
            ]
        );
        $this->add_control(
            'price_start_value',
            [
                'label' => __('Price Start Value', 'bdevs-element'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __('$20.00', 'bdevs-element'),
                'placeholder' => __('Price Start Value', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_8']
                ]
            ]
        );
        $this->add_control(
            'quote_text',
            [
                'label' => __('Quote Text', 'bdevs-element'),
                'label_block' => true,
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('bdevs quote Text', 'bdevs-element'),
                'placeholder' => __('Type quote Text', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_1'],
                ],
            ]
        );

        $this->add_control(
            'number',
            [
                'label' => __('Number', 'bdevs-element'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __('10', 'bdevs-element'),
                'placeholder' => __('Type number', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_1', 'style_3', 'style_4'],
                ],
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
                'default' => 'h2',
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
        // img
        $this->start_controls_section(
            '_section_certified_box',
            [
                'label' => __('Certified Box', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_7']
                ]
            ]
        );
        $this->add_control(
            'certified_title',
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
            'certified_subtitle',
            [
                'label' => __('Sub Title', 'bdevs-element'),
                'label_block' => true,
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('bdevs Info Box Sub Title', 'bdevs-element'),
                'placeholder' => __('Type Info Box Sub Title', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail_2',
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

        if (bdevs_element_is_elementor_version('<', '2.6.0')) {
            $this->add_control(
                'icon_2',
                [
                    'label' => __('Icon_2', 'bdevs-element'),
                    'label_block' => true,
                    'type' => Controls_Manager::ICON,
                    'options' => bdevs_element_get_bdevs_element_icons(),
                    'default' => 'fa fa-smile-o',
                ]
            );
        } else {
            $this->add_control(
                'selected_icon_2',
                [
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon_2',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fas fa-smile-wink',
                        'library' => 'fa-solid',
                    ],
                ]
            );
        }
        $this->end_controls_section();
        // img
        $this->start_controls_section(
            '_section_about_image',
            [
                'label' => __('Image', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'bg_image',
            [
                'label' => __('Big Image', 'bdevs-element'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'image2',
            [
                'label' => __('Image 02', 'bdevs-element'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_3', 'style_5'],
                ],
            ]
        );

        $this->add_control(
            'image3',
            [
                'label' => __('Image 03', 'bdevs-element'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_5'],
                ],
            ]
        );

        $this->add_control(
            'image4',
            [
                'label' => __('Image 04', 'bdevs-element'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_5'],
                ],
            ]
        );

        $this->add_control(
            'author_image',
            [
                'label' => __('Athor Image', 'bdevs-element'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_101'],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'large',
                'separator' => 'none',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_features_list',
            [
                'label' => __('Features List', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_2', 'style_3', 'style_5', 'style_6', 'style_9', 'style_10'],
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'field_condition',
            [
                'label' => __('Field condition', 'bdevs-element'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_2' => __('Style 2', 'bdevs-element'),
                    'style_3' => __('Style 3', 'bdevs-element'),
                    'style_5' => __('Style 5', 'bdevs-element'),
                    'style_6' => __('Style 6', 'bdevs-element'),
                    'style_9' => __('Style 9', 'bdevs-element'),
                    'style_10' => __('Style 10', 'bdevs-element'),
                ],
                'default' => 'style_2',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'type',
            [
                'label' => __('Media Type', 'bdevs-element'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'icon' => [
                        'title' => __('Icon', 'bdevs-element'),
                        'icon' => 'fa fa-smile-o',
                    ],
                    'image' => [
                        'title' => __('Image', 'bdevs-element'),
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
                'label' => __('Image', 'bdevs-element'),
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

        if (bdevs_element_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'icon',
                [
                    'label' => __('Icon', 'bdevs-element'),
                    'label_block' => true,
                    'type' => Controls_Manager::ICON,
                    'options' => bdevs_element_get_bdevs_element_icons(),
                    'default' => 'fa fa-smile-o',
                    'condition' => [
                        'type' => 'icon'
                    ]
                ]
            );
        } else {
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
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __('Title', 'bdevs-element'),
                'placeholder' => __('Type title here', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'description',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __('Description', 'bdevs-element'),
                'placeholder' => __('Type description here', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'field_condition' => ['style_2', 'style_5', 'style_6'],
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
                ]
            ]
        );

        $this->end_controls_section();

        // Button 
        $this->start_controls_section(
            '_section_button',
            [
                'label' => __('Button', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_1', 'style_3', 'style_4', 'style_7', 'style_8', 'style_9'],
                ],
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __('Text', 'bdevs-element'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Button Text', 'bdevs-element'),
                'placeholder' => __('Type button text here', 'bdevs-element'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => __('Link', 'bdevs-element'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('http://elementor.bdevs.net/', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        if (bdevs_element_is_elementor_version('<', '2.6.0')) {
            $this->add_control(
                'button_icon',
                [
                    'label' => __('Icon', 'bdevs-element'),
                    'label_block' => true,
                    'type' => Controls_Manager::ICON,
                    'options' => bdevs_element_get_bdevs_element_icons(),
                    'default' => 'fa fa-angle-right',
                ]
            );

            $condition = ['button_icon!' => ''];
        } else {
            $this->add_control(
                'button_selected_icon',
                [
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'button_icon',
                    'label_block' => true,
                ]
            );
            $condition = ['button_selected_icon[value]!' => ''];
        }

        $this->add_control(
            'button_icon_position',
            [
                'label' => __('Icon Position', 'bdevs-element'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'before' => [
                        'title' => __('Before', 'bdevs-element'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'after' => [
                        'title' => __('After', 'bdevs-element'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'after',
                'toggle' => false,
                'condition' => $condition,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'button_icon_spacing',
            [
                'label' => __('Icon Spacing', 'bdevs-element'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 10
                ],
                'condition' => $condition,
                'selectors' => [
                    '{{WRAPPER}} .btn--icon-before .btn-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .btn--icon-after .btn-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        //button 2
        $this->start_controls_section(
            '_section_button2',
            [
                'label' => __( 'Button 2', 'bdevs-element' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_101'],
                ],
            ]
        );
        // 2nd btn
        $this->add_control(
            'button_text2',
            [
                'label' => __( 'Button Text 2', 'bdevs-element' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Button Text 2',
                'placeholder' => __( 'Type button text here', 'bdevs-element' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'button_link2',
            [
                'label' => __( 'Link', 'bdevs-element' ),
                'type' => Controls_Manager::URL,
                'placeholder' => 'http://elementor.bdevs.net/',
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        if ( bdevs_element_is_elementor_version( '<', '2.6.0' ) ) {
            $this->add_control(
                'button_icon2',
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
            $this->add_control(
                'button_selected_icon2',
                [
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'button_icon',
                    'label_block' => true,
                ]
            );
            $condition = ['button_selected_icon[value]!' => ''];
        }

        $this->add_control(
            'button_icon_position2',
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

        $this->add_control(
            'button_icon_spacing2',
            [
                'label' => __( 'Icon Spacing', 'bdevs-element' ),
                'type' => Controls_Manager::SLIDER,
                'condition' => $condition,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-btn--icon-before .bdevs-btn-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .bdevs-btn--icon-after .bdevs-btn-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Register styles related controls
     */
    protected function register_style_controls()
    {

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


        // list style content
        $this->start_controls_section(
            '_section_style_item',
            [
                'label' => __('List Item', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'item_icon_size',
            [
                'label' => __('Size', 'bdevs-element'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-list ul li span i,{{WRAPPER}} .bdevs-el-list ol li::marker,{{WRAPPER}} .bdevs-el-list i' => 'font-size: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'item_typography',
                'selector' => '{{WRAPPER}} .bdevs-el-list ul li span, {{WRAPPER}} .bdevs-el-list ol li, {{WRAPPER}} .bdevs-el-list h3',
                'scheme' => Typography::TYPOGRAPHY_4,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'item_border',
                'selector' => '{{WRAPPER}} .bdevs-el-list ul li span,{{WRAPPER}} .bdevs-el-list ol li, {{WRAPPER}} .bdevs-el-list i',
            ]
        );

        $this->add_control(
            'item_border_radius',
            [
                'label' => __('Border Radius', 'bdevs-element'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-list ul li span i,{{WRAPPER}} .bdevs-el-list ol li::marker, {{WRAPPER}} .bdevs-el-list i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'item_box_shadow',
                'selector' => '{{WRAPPER}} .bdevs-el-list ul li span i,{{WRAPPER}} .bdevs-el-list ol li::marker, {{WRAPPER}} .bdevs-el-list i',
            ]
        );

        $this->add_control(
            'hr_2',
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->start_controls_tabs('_lits_tabs_button');

        $this->start_controls_tab(
            '_list_tab_button_normal',
            [
                'label' => __('Normal', 'bdevs-element'),
            ]
        );

        $this->add_control(
            'list_item_link_color_2',
            [
                'label' => __('Text Color', 'bdevs-element'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-list ul li span i,{{WRAPPER}} .bdevs-el-list ol li::marker,{{WRAPPER}} .bdevs-el-list ol li, {{WRAPPER}} .bdevs-el-list h3, {{WRAPPER}} .bdevs-el-list i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'list_item_border_color_2',
            [
                'label' => __('Border Color', 'bdevs-element'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-list ul li span i,{{WRAPPER}} .bdevs-el-list ol li::marker,{{WRAPPER}} .bdevs-el-list ol li, {{WRAPPER}} .bdevs-el-list h3, {{WRAPPER}} .bdevs-el-list i' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'list_item_bg_color_2',
            [
                'label' => __('Background Color', 'bdevs-element'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-list ul li span i,{{WRAPPER}} .bdevs-el-list ol li::marker,{{WRAPPER}} .bdevs-el-list ol li, {{WRAPPER}} .bdevs-el-list h3, {{WRAPPER}} .bdevs-el-list i' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'list_icon_translate_2',
            [
                'label' => __('Icon Translate X', 'bdevs-element'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-list ul li span i,{{WRAPPER}} .bdevs-el-list ol li::marker,{{WRAPPER}} .bdevs-el-list ol li, {{WRAPPER}} .bdevs-el-list h3, {{WRAPPER}} .bdevs-el-list i' => '-webkit-transform: translateX(calc(-1 * {{SIZE}}{{UNIT}})); transform: translateX(calc(-1 * {{SIZE}}{{UNIT}}));',
                    '{{WRAPPER}} .bdevs-el-list ul li span i,{{WRAPPER}} .bdevs-el-list ol li::marker,{{WRAPPER}} .bdevs-el-list ol li, {{WRAPPER}} .bdevs-el-list h3, {{WRAPPER}} .bdevs-el-list i' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_list_tab_button_hover',
            [
                'label' => __('Hover', 'bdevs-element'),
            ]
        );

        $this->add_control(
            'list_link_hover_color',
            [
                'label' => __('Text Color', 'bdevs-element'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-list ul li:hover span i,{{WRAPPER}} .capabilities__list ol li::marker,,{{WRAPPER}} .capabilities__list ol li, {{WRAPPER}} .achievement__item h3:hover, {{WRAPPER}} .achievement__item i:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'list_border_hover_color',
            [
                'label' => __('Border Color', 'bdevs-element'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-list ul li:hover span i,{{WRAPPER}} .bdevs-el-list ol li::marker,,{{WRAPPER}} .bdevs-el-list ol li, {{WRAPPER}} .bdevs-el-list h3:hover, {{WRAPPER}} .bdevs-el-list i:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'list_hover_bg_color',
            [
                'label' => __('Background Color', 'bdevs-element'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-list ul li:hover span i, {{WRAPPER}} .bdevs-el-list ul li:hover span i,{{WRAPPER}} .capabilities__list ol li::marker,,{{WRAPPER}} .capabilities__list ol li, {{WRAPPER}} .bdevs-el-list h3:hover, {{WRAPPER}} .bdevs-el-list i:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'list_hover_icon_translate',
            [
                'label' => __('Icon Translate X', 'bdevs-element'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0
                ],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-list ul li:hover span i,{{WRAPPER}} .bdevs-el-list ol li::marker,,{{WRAPPER}} .bdevs-el-list ol li, {{WRAPPER}} .bdevs-el-list h3:hover, {{WRAPPER}} .bdevs-el-list i:hover' => '-webkit-transform: translateX(calc(-1 * {{SIZE}}{{UNIT}})); transform: translateX(calc(-1 * {{SIZE}}{{UNIT}}));',
                    '{{WRAPPER}} .bdevs-el-list ul li:hover span i,{{WRAPPER}} .bdevs-el-list ol li::marker,,{{WRAPPER}} .bdevs-el-list ol li, {{WRAPPER}} .bdevs-el-list h3:hover, {{WRAPPER}} .bdevs-el-list i:hover' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
        
        // Button 1 style
        $this->start_controls_section(
            '_section_style_button',
            [
                'label' => __( 'Button', 'bdevs-element' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __( 'Padding', 'bdevs-element' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .bdevs-el-btn',
                'scheme' => Typography::TYPOGRAPHY_4,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .bdevs-el-btn',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => __( 'Border Radius', 'bdevs-element' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .bdevs-el-btn',
            ]
        );

        $this->add_control(
            'hr',
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->start_controls_tabs( '_tabs_button' );

        $this->start_controls_tab(
            '_tab_button_normal',
            [
                'label' => __( 'Normal', 'bdevs-element' ),
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => __( 'Text Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => __( 'Background Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_button_hover',
            [
                'label' => __( 'Hover', 'bdevs-element' ),
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label' => __( 'Text Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn:hover, {{WRAPPER}} .bdevs-el-btn:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color',
            [
                'label' => __( 'Background Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn:hover, {{WRAPPER}} .bdevs-el-btn:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => __( 'Border Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'button_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn:hover, {{WRAPPER}} .bdevs-el-btn:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();


    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $title = bdevs_element_kses_basic($settings['title']);
        ?>
        <?php if ($settings['design_style'] === 'style_4'):

        if (!empty($settings['bg_image']['id'])) {
            $bg_image = wp_get_attachment_image_url($settings['bg_image']['id'], $settings['thumbnail_size']);
        }


        $this->add_render_attribute('button', 'class', 'btn btn_danger btn_rounded bdevs-el-btn');
        $this->add_render_attribute('button', 'data-wow-delay', '');
        $this->add_link_attributes('button', $settings['button_link']);
        ?>

        <section class="about_section section_space bg_black">
            <?php if (!empty($bg_image)): ?>
            <div class="about_image_3">
              <img src="<?php echo esc_url($bg_image); ?>" alt="Person Image">
            </div>
            <?php endif; ?>

            <div class="container">
              <div class="row justify-content-lg-end">
                <div class="col col-lg-7">
                  <div class="about_content_2">
                    <?php if ($settings['number']): ?>
                    <div class="year_text">
                      <strong><?php echo bdevs_element_kses_intermediate($settings['number']); ?><sup>+</sup></strong>
                      <span><?php echo esc_html('Years Experiences','repairon') ?></span>
                    </div>
                    <?php endif; ?>

                    <div class="section_title mb-0 bdevs-el-content">
                      <?php if ($settings['sub_title']): ?>
                      <h2 class="sub_title bdevs-el-subtitle">
                        <?php echo bdevs_element_kses_intermediate($settings['sub_title']); ?>
                        <span class="under_text"><?php echo bdevs_element_kses_intermediate($settings['back_title']); ?></span>
                      </h2>
                      <?php endif; ?>


                      <?php if ($settings['title']): ?>
                      <h3 class="title_text bdevs-el-title">
                        <?php echo bdevs_element_kses_intermediate($settings['title']); ?>
                      </h3>
                      <?php endif; ?>

                      <?php if ($settings['description']): ?>
                      <p><?php echo bdevs_element_kses_intermediate($settings['description']); ?></p>
                      <?php endif; ?>

                        <?php if ($settings['button_text'] && ((empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) && empty($settings['button_icon']))) :
                            printf('<a %1$s>%2$s</a>',
                                $this->get_render_attribute_string('button'),
                                esc_html($settings['button_text'])
                            );
                        elseif (empty($settings['button_text']) && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) : ?>
                            <a <?php $this->print_render_attribute_string('button'); ?>><?php bdevs_element_render_icon($settings, 'button_icon', 'button_selected_icon'); ?></a>
                        <?php elseif ($settings['button_text'] && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) :
                            if ($settings['button_icon_position'] === 'before'): ?>
                                <a <?php $this->print_render_attribute_string('button'); ?>><?php bdevs_element_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon']); ?>
                                    <span><?php echo esc_html($settings['button_text']); ?></span></a>
                            <?php
                            else: ?>
                                <a <?php $this->print_render_attribute_string('button'); ?>>
                                    <span><?php echo esc_html($settings['button_text']); ?></span>
                                    <?php bdevs_element_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon']); ?>
                                </a>
                            <?php
                            endif;
                        endif; ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </section>

    <?php elseif ($settings['design_style'] === 'style_5'):

        if (!empty($settings['bg_image']['id'])) {
            $bg_image = wp_get_attachment_image_url($settings['bg_image']['id'], $settings['thumbnail_size']);
        }

        if (!empty($settings['image2']['id'])) {
            $image2 = wp_get_attachment_image_url($settings['image2']['id'], $settings['thumbnail_size']);
        }

        if (!empty($settings['image3']['id'])) {
            $image3 = wp_get_attachment_image_url($settings['image3']['id'], $settings['thumbnail_size']);
        }

        if (!empty($settings['image4']['id'])) {
            $image4 = wp_get_attachment_image_url($settings['image4']['id'], $settings['thumbnail_size']);
        }

        ?>

        <section class="about_section_in">
            <div class="container">
              <div class="row">
                <div class="col col-lg-6">
                    <?php if (!empty($bg_image)): ?>
                    <div class="about_image_4">
                        <img src="<?php echo esc_url($bg_image); ?>" alt="About Company">
                    </div>
                    <?php endif; ?>
                </div>
                <div class="col col-lg-6">
                  <div class="about_content">
                    <div class="section_title bdevs-el-content">
                      <?php if ($settings['sub_title']): ?>
                      <h2 class="sub_title bdevs-el-subtitle"><?php echo bdevs_element_kses_intermediate($settings['sub_title']); ?></h2>
                      <?php endif; ?>

                      <?php if ($settings['title']): ?>
                      <h3 class="title_text bdevs-el-title">
                        <?php echo bdevs_element_kses_intermediate($settings['title']); ?>
                      </h3>
                      <?php endif; ?>

                      <?php if ($settings['description']): ?>
                      <p class="mb-0"><?php echo bdevs_element_kses_intermediate($settings['description']); ?></p>
                      <?php endif; ?>

                    </div>
                    <div class="row">
                        <?php foreach ($settings['slides'] as $slide): ?>
                        <div class="col col-lg-6">
                            <div class="policy_item_2">
                              <div class="item_icon">
                                <?php if ($slide['type'] === 'image' && ($slide['image']['url'] || $slide['image']['id'])) :
                                    $this->get_render_attribute_string('image');
                                    $slide['hover_animation'] = 'disable-animation'; ?>
                                    <?php echo Group_Control_Image_Size::get_attachment_image_html($slide, 'thumbnail', 'image'); ?>
                                <?php elseif (!empty($slide['icon']) || !empty($slide['selected_icon']['value'])) : ?>
                                    <?php bdevs_element_render_icon($slide, 'icon', 'selected_icon'); ?>
                                <?php endif; ?>
                              </div>
                              <div class="item_content">
                                <?php if (!empty($slide['title'])) : ?>
                                <h3 class="item_title"><?php echo bdevs_element_kses_basic($slide['title']); ?></h3>
                                <?php endif; ?>

                                <?php if (!empty($slide['description'])) : ?>
                                <p class="mb-0">
                                  <?php echo bdevs_element_kses_basic($slide['description']); ?>
                                </p>
                                <?php endif; ?>
                              </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <ul class="about_images_group ul_li">  
                        <?php if (!empty($image2)): ?>
                        <li>
                            <img src="<?php echo esc_url($image2); ?>" alt="Working Image">
                        </li>
                        <?php endif; ?>

                        <?php if (!empty($image3)): ?>
                        <li>
                            <img src="<?php echo esc_url($image3); ?>" alt="Working Image">
                        </li>
                        <?php endif; ?>

                        <?php if (!empty($image4)): ?>
                        <li>
                            <img src="<?php echo esc_url($image4); ?>" alt="Working Image">
                        </li>
                        <?php endif; ?>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
        </section>


    <?php elseif ($settings['design_style'] === 'style_6'):

        if (!empty($settings['bg_image']['id'])) {
            $bg_image = wp_get_attachment_image_url($settings['bg_image']['id'], $settings['thumbnail_size']);
        }

        ?>

      <div class="about_section section_space">
        <div class="container">
          <div class="row align-items-center">
            <div class="col col-lg-6 col-md-5">
                <?php if (!empty($bg_image)): ?>
                <div class="about_image mb-0">
                    <img src="<?php echo esc_url($bg_image); ?>" alt="Car Repair Images">
                </div>
                <?php endif; ?>
            </div>

            <div class="col col-lg-6 col-md-7">
              <div class="about_content">
                <div class="section_title mb-2">
                  <?php if ($settings['sub_title']): ?>
                  <h2 class="sub_title bdevs-el-subtitle"><?php echo bdevs_element_kses_intermediate($settings['sub_title']); ?></h2>
                  <?php endif; ?>

                  <?php if ($settings['title']): ?>
                  <h3 class="title_text bdevs-el-title">
                    <?php echo bdevs_element_kses_intermediate($settings['title']); ?>
                  </h3>
                  <?php endif; ?>
                </div>
                <div class="row">
                    <?php foreach ($settings['slides'] as $slide): ?>
                    <div class="col col-lg-6">
                        <div class="policy_item_2">
                          <div class="item_icon">
                            <?php if ($slide['type'] === 'image' && ($slide['image']['url'] || $slide['image']['id'])) :
                                $this->get_render_attribute_string('image');
                                $slide['hover_animation'] = 'disable-animation'; ?>
                                <?php echo Group_Control_Image_Size::get_attachment_image_html($slide, 'thumbnail', 'image'); ?>
                            <?php elseif (!empty($slide['icon']) || !empty($slide['selected_icon']['value'])) : ?>
                                <?php bdevs_element_render_icon($slide, 'icon', 'selected_icon'); ?>
                            <?php endif; ?>
                          </div>
                          <div class="item_content">
                            <?php if (!empty($slide['title'])) : ?>
                            <h3 class="item_title"><?php echo bdevs_element_kses_basic($slide['title']); ?></h3>
                            <?php endif; ?>

                            <?php if (!empty($slide['description'])) : ?>
                            <p class="mb-0">
                              <?php echo bdevs_element_kses_basic($slide['description']); ?>
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
        </div>
      </div>

    <?php elseif($settings['design_style'] === 'style_7') : 
         if (!empty($settings['bg_image']['id'])) {
            $bg_image = wp_get_attachment_image_url($settings['bg_image']['id'], $settings['thumbnail_size']);
        }
        $this->add_inline_editing_attributes('title', 'basic');
        $this->add_render_attribute('title', 'class', 'heading_text bdevs-el-title');
        $this->add_render_attribute('button', 'class', 'btn btn_danger bdevs-el-btn');
        $this->add_link_attributes('button', $settings['button_link']);
    ?>
    <div class="service_tab_content">
        <?php if(!empty($settings['back_title']) && $settings['shape_switch']) : ?>
            <h5 class="outline_text text-start"><?php echo bdevs_element_kses_intermediate($settings['back_title']); ?></h5>
        <?php endif; ?>
        <div class="row">
          <div class="col order-last col-lg-6">
            <?php if(!empty($bg_image)) : ?>
            <div class="image_wrap">
              <img src="<?php echo esc_url($bg_image); ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($bg_image), '_wp_attachment_image_alt', true); ?>">
            </div>
            <?php endif; ?>
          </div>
          <div class="col col-lg-6">
            <?php if ( $settings['title' ] ) :
                printf( '<%1$s %2$s>%3$s</%1$s>',
                    tag_escape( $settings['title_tag'] ),
                    $this->get_render_attribute_string( 'title' ),
                    bdevs_element_kses_basic( $settings['title' ] )
                    );
            endif; ?>
            <?php if(!empty($settings['description'])) : ?>
            <p class="bdevs-el-content">
                <?php echo bdevs_element_kses_intermediate($settings['description']); ?>
            </p>
            <?php endif; ?>
            <div class="info_list">
              <div class="row">
                <div class="col col-lg-6">
                  <div class="certified_badge">
                    <div class="item_icon">
                      <?php bdevs_element_render_icon($settings, 'icon_2', 'selected_icon_2'); ?>
                    </div>
                    <div class="item_content">
                        <?php if(!empty($settings['certified_title'])) : ?>
                            <h4 class="item_title text-white bdevs-el-title"><?php echo bdevs_element_kses_intermediate($settings['certified_title']); ?></h4>
                        <?php endif; ?>
                        <?php if(!empty($settings['certified_subtitle'])) : ?>
                            <p class="mb-0"><?php echo bdevs_element_kses_intermediate($settings['certified_subtitle']); ?></p>
                        <?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php if(!empty($settings['button_text'])) : ?>
                <div class="single_btn_wrap">
                    <?php if ($settings['button_text'] && ((empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) && empty($settings['button_icon']))) :
                        printf('<a %1$s>%2$s</a>',
                            $this->get_render_attribute_string('button'),
                            esc_html($settings['button_text'])
                        );
                    elseif (empty($settings['button_text']) && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) : ?>
                        <a <?php $this->print_render_attribute_string('button'); ?>><?php bdevs_element_render_icon($settings, 'button_icon', 'button_selected_icon'); ?></a>
                    <?php elseif ($settings['button_text'] && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) :
                        if ($settings['button_icon_position'] === 'before'): ?>
                            <a <?php $this->print_render_attribute_string('button'); ?>><?php bdevs_element_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon']); ?>
                                <span><?php echo esc_html($settings['button_text']); ?></span></a>
                        <?php
                        else: ?>
                            <a <?php $this->print_render_attribute_string('button'); ?>>
                                <span><?php echo esc_html($settings['button_text']); ?></span>
                                <?php bdevs_element_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon']); ?>
                            </a>
                        <?php
                        endif;
                    endif; ?>
                </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
       <?php elseif($settings['design_style'] === 'style_10') :
            $this->add_render_attribute('button', 'class', 'btn btn_danger bdevs-el-btn');
             if (!empty($settings['bg_image']['id'])) {
                $bg_image = wp_get_attachment_image_url($settings['bg_image']['id'], $settings['thumbnail_size']);
            }
        ?>
        <div class="row">
            <div class="col order-last col-lg-6 col-md-6">
            <?php if(!empty($bg_image)) : ?>
              <div class="image_wrap">
                <img src="<?php echo esc_url($bg_image); ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($bg_image), '_wp_attachment_image_alt', true); ?>">
              </div>
            <?php endif; ?>
            </div>
            <div class="col col-lg-6 col-md-6">
              <div class="content_wrap bdevs-el-content">
                <?php if ($settings['description']): ?>
                <p><?php echo bdevs_element_kses_intermediate($settings['description']); ?></p>
                <?php endif; ?>
                <?php if (!empty($settings['slides'])): ?>
                <div class="service_package_item">
                  <ul class="info_list ul_li_block">
                    <?php foreach($settings['slides'] as $slide): ?>
                        <?php if (!empty($slide['title'])): ?>
                            <li><i class="fas fa-check-square"></i> <?php echo bdevs_element_kses_basic($slide['title']); ?></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                  </ul>
                </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
      <?php elseif($settings['design_style'] === 'style_9') :
        $this->add_render_attribute('button', 'class', 'btn btn_danger bdevs-el-btn');
        $this->add_link_attributes('button', $settings['button_link']);
        if (!empty($settings['bg_image']['id'])) {
            $bg_image = wp_get_attachment_image_url($settings['bg_image']['id'], $settings['thumbnail_size']);
        }
    ?>
    <div class="row align-items-center justify-content-lg-between">
        <div class="col order-last col-lg-5">
        <?php if(!empty($bg_image)) : ?>
            <div class="item_image">
                <img src="<?php echo esc_url($bg_image); ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($bg_image), '_wp_attachment_image_alt', true); ?>">
            </div>
        <?php endif; ?>
        </div>
        <div class="col col-lg-6">
          <div class="item_content">
            <?php if ($settings['title']): ?>
                <h3 class="item_title bdevs-el-title">
                  <?php echo bdevs_element_kses_intermediate($settings['title']); ?>
                </h3>
                <?php endif; ?>
            <?php if ($settings['description']): ?>
            <p><?php echo bdevs_element_kses_intermediate($settings['description']); ?></p>
            <?php endif; ?>
            <div class="service_package_item bg-transparent">
              <?php if(!empty($settings['slides'])) : ?>
              <ul class="info_list ul_li_block">
                <?php foreach ($settings['slides'] as $slide): ?>
                    <?php if(!empty($slide['title'])) : ?>
                        <li><i class="fas fa-check-square"></i> <?php echo bdevs_element_kses_basic($slide['title']); ?></li>
                    <?php endif; ?>
                <?php endforeach; ?>
              </ul>
              <?php endif; ?>
            </div>
            <?php if(!empty($settings['button_text'])) : ?>
             <?php if ($settings['button_text'] && ((empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) && empty($settings['button_icon']))) :
                    printf('<a %1$s>%2$s</a>',
                        $this->get_render_attribute_string('button'),
                        esc_html($settings['button_text'])
                    );
                elseif (empty($settings['button_text']) && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) : ?>
                    <a <?php $this->print_render_attribute_string('button'); ?>><?php bdevs_element_render_icon($settings, 'button_icon', 'button_selected_icon'); ?></a>
                <?php elseif ($settings['button_text'] && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) :
                    if ($settings['button_icon_position'] === 'before'): ?>
                        <a <?php $this->print_render_attribute_string('button'); ?>><?php bdevs_element_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon']); ?>
                            <span><?php echo esc_html($settings['button_text']); ?></span></a>
                    <?php
                    else: ?>
                        <a <?php $this->print_render_attribute_string('button'); ?>>
                            <span><?php echo esc_html($settings['button_text']); ?></span>
                            <?php bdevs_element_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon']); ?>
                        </a>
                    <?php
                    endif;
                endif; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php elseif($settings['design_style'] === 'style_8') :
        $this->add_render_attribute('button', 'class', 'btn danger_border btn_rounded bdevs-el-btn');
        $this->add_link_attributes('button', $settings['button_link']);
        if (!empty($settings['bg_image']['id'])) {
            $bg_image = wp_get_attachment_image_url($settings['bg_image']['id'], $settings['thumbnail_size']);
        }
    ?>
        <div class="row align-items-center justify-content-lg-between">
            <div class="col order-last col-lg-5">
              <div class="item_image">
                <?php if(!empty($bg_image)) : ?>
                <img src="<?php echo esc_url($bg_image); ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($bg_image), '_wp_attachment_image_alt', true); ?>">
                <?php endif; ?>
              </div>
            </div>
            <div class="col col-lg-6">
              <div class="item_content bdevs-el-content">
                <?php if ($settings['title']): ?>
                <h3 class="item_title bdevs-el-title">
                  <?php echo bdevs_element_kses_intermediate($settings['title']); ?>
                </h3>
                <?php endif; ?>
                <div class="price_wrap">
                    <?php if ($settings['price_start_label']): ?>
                        <span><?php echo bdevs_element_kses_intermediate($settings['price_start_label']); ?></span>
                    <?php endif; ?>
                    <?php if ($settings['price_start_value']): ?>
                        <strong><?php echo bdevs_element_kses_intermediate($settings['price_start_value']); ?></strong>
                    <?php endif; ?>
                </div>
               <?php if ($settings['description']): ?>
                <p><?php echo bdevs_element_kses_intermediate($settings['description']); ?></p>
                <?php endif; ?>
                <?php if ($settings['button_text'] && ((empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) && empty($settings['button_icon']))) :
                    printf('<a %1$s>%2$s</a>',
                        $this->get_render_attribute_string('button'),
                        esc_html($settings['button_text'])
                    );
                elseif (empty($settings['button_text']) && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) : ?>
                    <a <?php $this->print_render_attribute_string('button'); ?>><?php bdevs_element_render_icon($settings, 'button_icon', 'button_selected_icon'); ?></a>
                <?php elseif ($settings['button_text'] && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) :
                    if ($settings['button_icon_position'] === 'before'): ?>
                        <a <?php $this->print_render_attribute_string('button'); ?>><?php bdevs_element_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon']); ?>
                            <span><?php echo esc_html($settings['button_text']); ?></span></a>
                    <?php
                    else: ?>
                        <a <?php $this->print_render_attribute_string('button'); ?>>
                            <span><?php echo esc_html($settings['button_text']); ?></span>
                            <?php bdevs_element_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon']); ?>
                        </a>
                    <?php
                    endif;
                endif; ?>
              </div>
            </div>
          </div>
    <?php elseif ($settings['design_style'] === 'style_3'):

        if (!empty($settings['bg_image']['id'])) {
            $bg_image = wp_get_attachment_image_url($settings['bg_image']['id'], $settings['thumbnail_size']);
        }

        if (!empty($settings['image2']['id'])) {
            $image2 = wp_get_attachment_image_url($settings['image2']['id'], $settings['thumbnail_size']);
        }

        $this->add_render_attribute('button', 'class', 'btn btn_success btn_rounded bdevs-el-btn');
        $this->add_render_attribute('button', 'data-wow-delay', '');
        $this->add_link_attributes('button', $settings['button_link']);

        ?>

        <div class="about_section">
            <div class="container">
              <div class="row align-items-center">
                <div class="col col-lg-6 order-last col-md-8">
                  <div class="about_image_2 decoration_wrap">
                    <?php if (!empty($bg_image)): ?>
                    <div class="big_image">
                      <img src="<?php echo esc_url($bg_image); ?>" alt="Worker Image">
                    </div>
                    <?php endif; ?>

                    <?php if (!empty($image2)): ?>
                    <div class="small_image">
                      <img src="<?php echo esc_url($image2); ?>" alt="Worker Image">
                    </div>
                    <?php endif; ?>

                    <?php if (!empty($settings['shape_switch'])): ?>
                    <div class="deco_item shape_1">
                      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shapes/shape_2.png" alt="Dots Shape Image">
                    </div>
                    <div class="deco_item shape_2">
                      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shapes/shape_3.png" alt="Border Circle Image">
                    </div>
                    <?php endif; ?>

                    <?php if ($settings['number']): ?>
                    <div class="year_text">
                      <strong><?php echo bdevs_element_kses_intermediate($settings['number']); ?></strong>
                      <span>
                        <span class="d-block"><?php echo esc_html('Years','repairon') ?></span>
                        <?php echo esc_html('Experiences','repairon') ?>
                      </span>
                    </div>
                    <?php endif; ?>
                  </div>
                </div>

                <div class="col col-lg-6">
                  <div class="about_content">
                    <div class="section_title bdevs-el-content">
                        <?php if ($settings['sub_title']): ?>
                        <h2 class="sub_title bdevs-el-subtitle" data-text-color="#74C138">
                        <?php echo bdevs_element_kses_intermediate($settings['sub_title']); ?>
                            <span class="icon">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo/favourite_icon_3.png" alt="Logo Icon">
                            </span>
                        </h2>
                        <?php endif; ?>

                        <?php if ($settings['title']): ?>
                        <h3 class="title_text bdevs-el-title">
                            <?php echo bdevs_element_kses_intermediate($settings['title']); ?>
                        </h3>
                        <?php endif; ?>

                        <?php if ($settings['description']): ?>
                        <p class="mb-0"><?php echo bdevs_element_kses_intermediate($settings['description']); ?></p>
                        <?php endif; ?>
                    </div>

                    <ul class="info_list ul_li_block">
                        <?php foreach ($settings['slides'] as $slide): ?>
                        <li><i class="fas fa-check-square"></i> <?php echo bdevs_element_kses_basic($slide['title']); ?></li>
                        <?php endforeach; ?>
                    </ul>

                    <?php if ($settings['button_text'] && ((empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) && empty($settings['button_icon']))) :
                        printf('<a %1$s>%2$s</a>',
                            $this->get_render_attribute_string('button'),
                            esc_html($settings['button_text'])
                        );
                    elseif (empty($settings['button_text']) && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) : ?>
                        <a <?php $this->print_render_attribute_string('button'); ?>><?php bdevs_element_render_icon($settings, 'button_icon', 'button_selected_icon'); ?></a>
                    <?php elseif ($settings['button_text'] && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) :
                        if ($settings['button_icon_position'] === 'before'): ?>
                            <a <?php $this->print_render_attribute_string('button'); ?>><?php bdevs_element_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon']); ?>
                                <span><?php echo esc_html($settings['button_text']); ?></span></a>
                        <?php
                        else: ?>
                            <a <?php $this->print_render_attribute_string('button'); ?>>
                                <span><?php echo esc_html($settings['button_text']); ?></span>
                                <?php bdevs_element_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon']); ?>
                            </a>
                        <?php
                        endif;
                    endif; ?>
                  </div>
                </div>
              </div>
            </div>
        </div>

    <?php elseif ($settings['design_style'] === 'style_2'):
        if (!empty($settings['bg_image']['id'])) {
            $bg_image = wp_get_attachment_image_url($settings['bg_image']['id'], $settings['thumbnail_size']);
        }

        $this->add_render_attribute('title', 'class', 'section__title bdevs-el-title');

        ?>

        <div class="about_section">
            <div class="container">
              <div class="row align-items-center">
                <div class="col col-lg-6 col-md-8">
                  <?php if (!empty($bg_image)): ?>
                  <div class="about_image">
                    <img src="<?php echo esc_url($bg_image); ?>" alt="Laptop Repair Images">
                  </div>
                  <?php endif; ?>
                </div>

                <div class="col col-lg-6">
                  <div class="about_content">
                    <div class="section_title mb-2">
                      <?php if ($settings['sub_title']): ?>
                      <h2 class="sub_title bdevs-el-subtitle" data-text-color="#74C138">
                        <?php echo bdevs_element_kses_intermediate($settings['sub_title']); ?>
                        <span class="icon">
                          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo/favourite_icon_3.png" alt="Logo Icon">
                        </span>
                      </h2>
                      <?php endif; ?>

                      <?php if ($settings['title']): ?>
                      <h3 class="title_text bdevs-el-title">
                        <?php echo bdevs_element_kses_intermediate($settings['title']); ?>
                      </h3>
                      <?php endif; ?>
                    </div>
                    <div class="row">

                        <?php foreach ($settings['slides'] as $slide): ?>
                        <div class="col col-lg-6">
                            <div class="policy_item_2">
                              <div class="item_icon" data-text-color="#74C138">
                                <?php if ($slide['type'] === 'image' && ($slide['image']['url'] || $slide['image']['id'])) :
                                    $this->get_render_attribute_string('image');
                                    $slide['hover_animation'] = 'disable-animation'; ?>
                                    <?php echo Group_Control_Image_Size::get_attachment_image_html($slide, 'thumbnail', 'image'); ?>
                                <?php elseif (!empty($slide['icon']) || !empty($slide['selected_icon']['value'])) : ?>
                                    <?php bdevs_element_render_icon($slide, 'icon', 'selected_icon'); ?>
                                <?php endif; ?>
                              </div>
                              <div class="item_content">
                                <?php if (!empty($slide['title'])) : ?>
                                <h3 class="item_title"><?php echo bdevs_element_kses_basic($slide['title']); ?></h3>
                                <?php endif; ?>

                                <?php if (!empty($slide['description'])) : ?>
                                <p class="mb-0" data-text-color="#828A9B">
                                  <?php echo bdevs_element_kses_basic($slide['description']); ?>
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
            </div>
        </div>
         
    <?php else:
        if (!empty($settings['bg_image']['id'])) {
            $bg_image = wp_get_attachment_image_url($settings['bg_image']['id'], $settings['thumbnail_size']);
        }


        $this->add_render_attribute('button', 'class', 'btn btn_danger bdevs-el-btn');

        if ( !empty( $settings['button_link'] ) ) {
            $this->add_link_attributes( 'button', $settings['button_link'] );
        }

        ?>

      <section class="washing_section section_space pb-0">
        <div class="container">
          <div class="row align-items-center">
            <div class="col order-last col-lg-6">
              <?php if (!empty($bg_image)): ?>
              <div class="washing_image">
                <img src="<?php echo esc_url($bg_image); ?>" alt="Car Washing Image">
              </div>
              <?php endif; ?>
            </div>

            <div class="col col-lg-6">
              <div class="washing_content">
                <div class="section_title bdevs-el-content">
                  <?php if ($settings['sub_title']): ?>
                  <h2 class="sub_title bdevs-el-subtitle"><?php echo bdevs_element_kses_intermediate($settings['sub_title']); ?></h2>
                  <?php endif; ?>

                  <?php if ($settings['title']): ?>
                  <h3 class="title_text bdevs-el-title">
                    <?php echo bdevs_element_kses_intermediate($settings['title']); ?>
                  </h3>
                  <?php endif; ?>

                   <?php if ($settings['description']): ?>
                    <p><?php echo bdevs_element_kses_intermediate($settings['description']); ?></p>
                    <?php endif; ?>
                </div>

                <?php if ($settings['quote_text']): ?>
                <blockquote>
                  <?php echo bdevs_element_kses_intermediate($settings['quote_text']); ?>
                </blockquote>
                <?php endif; ?>
                <div class="row align-items-center">
                  <?php if (!empty($settings['button_text'])): ?>
                  <div class="col col-lg-5 col-md-3">
                        <?php if ($settings['button_text'] && ((empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) && empty($settings['button_icon']))) :
                            printf('<a %1$s>%2$s</a>',
                                $this->get_render_attribute_string('button'),
                                esc_html($settings['button_text'])
                            );
                        elseif (empty($settings['button_text']) && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) : ?>
                            <a <?php $this->print_render_attribute_string('button'); ?>><?php bdevs_element_render_icon($settings, 'button_icon', 'button_selected_icon'); ?></a>
                        <?php elseif ($settings['button_text'] && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) :
                            if ($settings['button_icon_position'] === 'before'): ?>
                                <a <?php $this->print_render_attribute_string('button'); ?>><?php bdevs_element_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon']); ?>
                                    <span><?php echo esc_html($settings['button_text']); ?></span></a>
                            <?php
                            else: ?>
                                <a <?php $this->print_render_attribute_string('button'); ?>>
                                    <span><?php echo esc_html($settings['button_text']); ?></span>
                                    <?php bdevs_element_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon']); ?>
                                </a>
                            <?php
                            endif;
                        endif; ?>
                  </div>
                  <?php endif; ?>
                  <div class="col col-lg-7 col-md-4">
                    <div class="hotline_default">
                      <div class="icon_wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" width="70.353" height="53.474"
                          viewBox="0 0 70.353 53.474">
                          <path
                            d="M55.6,90.7v-24.4A6.816,6.816,0,0,0,48.793,59.5H6.808A6.816,6.816,0,0,0,0,66.307V90.7a6.816,6.816,0,0,0,6.808,6.808H12.92l.13,6.147a2.271,2.271,0,0,0,3.635,1.764l10.494-7.911H48.793A6.816,6.816,0,0,0,55.6,90.7ZM26.419,92.974a2.27,2.27,0,0,0-1.366.457l-7.559,5.7L17.41,95.2a2.27,2.27,0,0,0-2.269-2.221H6.808A2.272,2.272,0,0,1,4.539,90.7v-24.4a2.272,2.272,0,0,1,2.269-2.269H48.793a2.272,2.272,0,0,1,2.269,2.269V90.7a2.272,2.272,0,0,1-2.269,2.269H26.419ZM70.353,80.491V99.215a6.816,6.816,0,0,1-6.808,6.808H57.424l-.121,4.739a2.27,2.27,0,0,1-2.269,2.212c-.906,0-.4.157-11.752-6.95H32.907a2.269,2.269,0,0,1,0-4.539c12.037,0,11.475-.127,12.231.346l7.729,4.839.076-2.974a2.269,2.269,0,0,1,2.269-2.212h8.333a2.272,2.272,0,0,0,2.269-2.269V80.491a2.272,2.272,0,0,0-2.269-2.269,2.269,2.269,0,0,1,0-4.539A6.816,6.816,0,0,1,70.353,80.491Zm-28.368-6.1a2.269,2.269,0,0,1-2.269,2.269H15.886a2.269,2.269,0,1,1,0-4.539H39.716A2.269,2.269,0,0,1,41.985,74.392Zm-4.113,9.929A2.269,2.269,0,0,1,35.6,86.591H20a2.269,2.269,0,1,1,0-4.539H35.6A2.269,2.269,0,0,1,37.872,84.321Z"
                            transform="translate(0 -59.499)" fill="#d42222" />
                        </svg>
                      </div>

                      <?php if ($settings['quote_text']): ?>
                      <div class="content_wrap">
                        <h4 class="item_title"><?php echo esc_html('Send Request','repairon') ?></h4>
                        <span class="hotline_number"><a href="tel:<?php echo esc_url($settings['number']); ?>"><?php echo bdevs_element_kses_intermediate($settings['number']); ?></a></span>
                      </div>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

    <?php endif; ?>
        <?php
    }
}
