<?php
namespace BdevsElement\Widget;


use \Elementor\Group_Control_Text_Shadow;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Utils;
use \Elementor\Control_Media;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;

defined( 'ABSPATH' ) || die();

class Icon_Box extends BDevs_El_Widget {

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
        return 'icon_box';
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
        return __( 'Icon Box', 'bdevs-element' );
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
        return 'eicon-icon-box';
    }

    public function get_keywords() {
        return [ 'info', 'box', 'icon' ];
    }

    protected function register_content_controls() {

        $this->start_controls_section(
            '_section_settings',
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
                    'style_4' => __( 'Style 4', 'bdevs-element' )
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_media',
            [
                'label' => __( 'Icon / Image', 'bdevs-element' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
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

        $this->add_control(
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
                ],
                'condition' => [
                    'type' => 'image'
                ]
            ]
        );

        if ( bdevs_element_is_elementor_version( '<', '2.6.0' ) ) {
            $this->add_control(
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
            $this->add_control(
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

        $this->add_control(
            '_icon_color',
            [
                'label' => __( 'Icon Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item_icon i' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'design_style' => ['style_1']
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_icon',
            [
                'label' => __( 'Content', 'bdevs-element' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'bdevs-element' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __( 'Icon Box', 'bdevs-element' ),
                'placeholder' => __( 'Type Icon Box Title', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );


        $this->add_control(
            'description',
            [
                'label' => __( 'Description', 'bdevs-element' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => __( 'Icon Description', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_3']
                ]
            ]
        );

        $this->add_control(
            'icon_link',
            [
                'label' => __( 'Icon Link', 'bdevs-element' ),
                'type' => Controls_Manager::URL,
                'placeholder' => 'http://elementor.bdevs.net/',
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_333']
                ]
            ]
        );

        $this->add_control(
            'step_number',
            [
                'label' => __( 'Step Number', 'bdevs-element' ),
                'type' => Controls_Manager::TEXT,
                'default' => 01,
                'description' => __( 'Type step number', 'bdevs-element' ),
                'condition' => [
                    'design_style' => ['style_223']
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'slide_url',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => false,
                'placeholder' => __( 'Type link here', 'bdevs-element' ),
                'default' => __( '#', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_333']
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
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();


    }

    protected function register_style_controls() {
        $this->start_controls_section(
            '_section_style_icon',
            [
                'label' => __( 'Icon', 'bdevs-element' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'icon_padding',
            [
                'label' => __( 'Padding', 'bdevs-element' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .icon' => 'padding: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_spacing',
            [
                'label' => __( 'Bottom Spacing', 'bdevs-element' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'max' => 150,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .thumb' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'icon_border',
                'selector' => '{{WRAPPER}} .icon'
            ]
        );

        $this->add_responsive_control(
            'icon_border_radius',
            [
                'label' => __( 'Border Radius', 'bdevs-element' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'icon_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .icon'
            ]
        );

        $this->start_controls_tabs( '_tabs_icon' );

        $this->start_controls_tab(
            '_tab_icon_normal',
            [
                'label' => __( 'Normal', 'bdevs-element' ),
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => __( 'Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .icon i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_bg_color',
            [
                'label' => __( 'Background Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .services__item' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_bg_rotate',
            [
                'label' => __( 'Rotate Icon Box', 'bdevs-element' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'deg' ],
                'default' => [
                    'unit' => 'deg',
                ],
                'range' => [
                    'deg' => [
                        'min' => 0,
                        'max' => 360,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .icon' => '-webkit-transform: rotate({{SIZE}}{{UNIT}}); transform: rotate({{SIZE}}{{UNIT}});',
                    '{{WRAPPER}} .icon > i' => '-webkit-transform: rotate(-{{SIZE}}{{UNIT}}); transform: rotate(-{{SIZE}}{{UNIT}});',
                ],
                'condition' => [
                    'icon_bg_color!' => '',
                ]
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
            'icon_hover_color',
            [
                'label' => __( 'Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}:hover .icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_hover_bg_color',
            [
                'label' => __( 'Background Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}:hover .icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_hover_border_color',
            [
                'label' => __( 'Border Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}:hover .icon' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'icon_border_border!' => '',
                ]
            ]
        );

        $this->add_control(
            'icon_hover_bg_rotate',
            [
                'label' => __( 'Rotate Icon Box', 'bdevs-element' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'deg' ],
                'default' => [
                    'unit' => 'deg',
                ],
                'range' => [
                    'deg' => [
                        'min' => 0,
                        'max' => 360,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}:hover .icon' => '-webkit-transform: rotate({{SIZE}}{{UNIT}}); transform: rotate({{SIZE}}{{UNIT}});',
                    '{{WRAPPER}}:hover .icon > i' => '-webkit-transform: rotate(-{{SIZE}}{{UNIT}}); transform: rotate(-{{SIZE}}{{UNIT}});',
                ],
                'condition' => [
                    'icon_bg_color!' => '',
                ]
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_title',
            [
                'label' => __( 'Title', 'bdevs-element' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title',
                'selector' => '{{WRAPPER}} .title',
                'scheme' => Typography::TYPOGRAPHY_2
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'title',
                'selector' => '{{WRAPPER}} .title',
            ]
        );

        $this->start_controls_tabs( '_tabs_title' );

        $this->start_controls_tab(
            '_tab_title_normal',
            [
                'label' => __( 'Normal', 'bdevs-element' ),
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Text Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_title_hover',
            [
                'label' => __( 'Hover', 'bdevs-element' ),
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label' => __( 'Text Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}:hover .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_desc',
            [
                'label' => __( 'Description', 'bdevs-element' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'desc_font_size',
            [
                'label' => __( 'Font Size', 'bdevs-element' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-description' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'desc_spacing',
            [
                'label' => __( 'Bottom Spacing', 'bdevs-element' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'max' => 150,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'desc_padding',
            [
                'label' => __( 'Padding', 'bdevs-element' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->add_control(
            'desc_color',
            [
                'label' => __( 'Text Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'desc_box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .bdevs-el-description',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'desc_typography',
                'label' => __( 'Typography', 'bdevs-element' ),
                'exclude' => [
                    'font_family',
                    'line_height'
                ],
                'default' => [
                    'font_size' => ['']
                ],
                'selector' => '{{WRAPPER}} .bdevs-el-description',
                'scheme' => Typography::TYPOGRAPHY_3,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_badge',
            [
                'label' => __( 'Badge', 'bdevs-element' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'badge_offset_toggle',
            [
                'label' => __( 'Offset', 'bdevs-element' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __( 'None', 'bdevs-element' ),
                'label_on' => __( 'Custom', 'bdevs-element' ),
                'return_value' => 'yes',
            ]
        );

        $this->start_popover();

        $this->add_responsive_control(
            'badge_offset_x',
            [
                'label' => __( 'Offset Left', 'bdevs-element' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => [
                    'badge_offset_toggle' => 'yes'
                ],
                'default' => [
                    'size' => 1
                ],
                'range' => [
                    'px' => [
                        'min' => -250,
                        'max' => 250,
                    ],
                ],
                'render_type' => 'ui'
            ]
        );

        $this->add_responsive_control(
            'badge_offset_y',
            [
                'label' => __( 'Offset Top', 'bdevs-element' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => [
                    'badge_offset_toggle' => 'yes'
                ],
                'default' => [
                    'size' => 1
                ],
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '(desktop){{WRAPPER}} .bdevselement-badge' =>
                        '-webkit-transform: translate({{badge_offset_x.SIZE || 0}}{{UNIT}}, {{badge_offset_y.SIZE || 0}}{{UNIT}});
                        transform: translate({{badge_offset_x.SIZE || 0}}{{UNIT}}, {{badge_offset_y.SIZE || 0}}{{UNIT}});',
                    '(tablet){{WRAPPER}} .bdevselement-badge' =>
                        '-webkit-transform: translate({{badge_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{badge_offset_y_tablet.SIZE || 0}}{{UNIT}});
                        transform: translate({{badge_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{badge_offset_y_tablet.SIZE || 0}}{{UNIT}});',
                    '(mobile){{WRAPPER}} .bdevselement-badge' =>
                        '-webkit-transform: translate({{badge_offset_x_mobile.SIZE}}{{UNIT}}, {{badge_offset_y_mobile.SIZE || 0}}{{UNIT}});
                        transform: translate({{badge_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{badge_offset_y_mobile.SIZE || 0}}{{UNIT}});',
                ],
            ]
        );
        $this->end_popover();

        $this->add_responsive_control(
            'badge_padding',
            [
                'label' => __( 'Padding', 'bdevs-element' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'badge_color',
            [
                'label' => __( 'Text Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-badge' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'badge_bg_color',
            [
                'label' => __( 'Background Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-badge' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'badge_border',
                'selector' => '{{WRAPPER}} .bdevselement-badge',
            ]
        );

        $this->add_responsive_control(
            'badge_border_radius',
            [
                'label' => __( 'Border Radius', 'bdevs-element' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'badge_box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .bdevselement-badge',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'badge_typography',
                'label' => __( 'Typography', 'bdevs-element' ),
                'exclude' => [
                    'font_family',
                    'line_height'
                ],
                'default' => [
                    'font_size' => ['']
                ],
                'selector' => '{{WRAPPER}} .bdevselement-badge',
                'scheme' => Typography::TYPOGRAPHY_3,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_shape',
            [
                'label' => __( 'Shape', 'bdevs-element' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'shape_offset_toggle',
            [
                'label' => __( 'Offset', 'bdevs-element' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __( 'None', 'bdevs-element' ),
                'label_on' => __( 'Custom', 'bdevs-element' ),
                'return_value' => 'yes',
            ]
        );

        $this->start_popover();

        $this->add_responsive_control(
            'shape_offset_x',
            [
                'label' => __( 'Offset Left', 'bdevs-element' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => [
                    'shape_offset_toggle' => 'yes'
                ],
                'default' => [
                    'size' => 1
                ],
                'range' => [
                    'px' => [
                        'min' => -250,
                        'max' => 250,
                    ],
                ],
                'render_type' => 'ui'
            ]
        );

        $this->add_responsive_control(
            'shape_offset_y',
            [
                'label' => __( 'Offset Top', 'bdevs-element' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => [
                    'shape_offset_toggle' => 'yes'
                ],
                'default' => [
                    'size' => 1
                ],
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '(desktop){{WRAPPER}} .shape img' =>
                        '-webkit-transform: translate({{shape_offset_x.SIZE || 0}}{{UNIT}}, {{shape_offset_y.SIZE || 0}}{{UNIT}});
                        transform: translate({{shape_offset_x.SIZE || 0}}{{UNIT}}, {{shape_offset_y.SIZE || 0}}{{UNIT}});',
                    '(tablet){{WRAPPER}} .shape img' =>
                        '-webkit-transform: translate({{shape_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{shape_offset_y_tablet.SIZE || 0}}{{UNIT}});
                        transform: translate({{shape_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{shape_offset_y_tablet.SIZE || 0}}{{UNIT}});',
                    '(mobile){{WRAPPER}} .shape img' =>
                        '-webkit-transform: translate({{shape_offset_x_mobile.SIZE}}{{UNIT}}, {{shape_offset_y_mobile.SIZE || 0}}{{UNIT}});
                        transform: translate({{shape_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{shape_offset_y_mobile.SIZE || 0}}{{UNIT}});',
                ],
            ]
        );
        $this->end_popover();

        $this->add_responsive_control(
            'shape_padding',
            [
                'label' => __( 'Padding', 'bdevs-element' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .shape img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'shape_box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .shape img',
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
        $this->add_render_attribute( 'title', 'class', 'title' );

        $this->add_inline_editing_attributes( 'description', 'none' );
        $this->add_render_attribute( 'description', 'class', 'content-desc' );

        if (!empty($settings['image']['url'])) {
            $this->add_render_attribute( 'image', 'src', $settings['image']['url'] );
            $this->add_render_attribute( 'image', 'alt', Control_Media::get_image_alt( $settings['image'] ) );
            $this->add_render_attribute( 'image', 'title', Control_Media::get_image_title( $settings['image'] ) );
        }

        if (!empty($settings['shape_image']['url'])) {
            $this->add_render_attribute( 'shape_image', 'src', $settings['shape_image']['url'] );
            $this->add_render_attribute( 'shape_image', 'alt', Control_Media::get_image_alt( $settings['shape_image'] ) );
            $this->add_render_attribute( 'shape_image', 'title', Control_Media::get_image_title( $settings['shape_image'] ) );
        }


        ?>

        <?php if ( $settings['design_style'] === 'style_5' ): 
        $shape_image = wp_get_attachment_image_url( !empty($settings['shape_image']['id']), 'small' );
        if ( ! $shape_image ) {
            $shape_image = $settings['shape_image']['url'];
        }
        $thumb_small = !empty($settings['sm_lg']) ? 'small-box' : ''; 
        ?>
            <div class="single-department single-department-2 <?php print esc_attr( $thumb_small ); ?>">
                <div class="thumb-wrap">
                    <div class="shape"><img src="<?php echo esc_url( $shape_image ); ?>" alt=""></div>
                    <div class="thumb">
                        <?php if ( $settings['type'] === 'image' && ( $settings['image']['url'] || $settings['image']['id'] ) ) :
                        $this->get_render_attribute_string( 'image' );
                        $settings['hover_animation'] = 'disable-animation'; // hack to prevent image hover animation
                        ?>
                        <figure>
                            <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ); ?>
                        </figure>
                        <?php elseif ( ! empty( $settings['icon'] ) || ! empty( $settings['selected_icon']['value'] ) ) : ?>
                        <figure>
                            <?php bdevs_element_render_icon( $settings, 'icon', 'selected_icon' ); ?>
                        </figure>
                        <?php endif; ?>
                        <?php if ( $settings['step_number'] ) : ?>
                        <span class="count bdevselement-badge"><?php echo esc_html( $settings['step_number'] ); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="content">
                    <?php if ( $settings['title' ] ) :
                        printf( '<%1$s %2$s>%3$s</%1$s>',
                            tag_escape( $settings['title_tag'] ),
                            $this->get_render_attribute_string( 'title' ),
                            bdevs_element_kses_basic( $settings['title' ] )
                            );
                    endif; ?>
                    <?php if ( $settings['description'] ) : ?>
                    <p <?php $this->print_render_attribute_string( 'description' ); ?>><?php echo esc_html( $settings['description'] ); ?></p>
                    <?php endif; ?>
                </div>
            </div>

        <?php elseif ( $settings['design_style'] === 'style_4' ):
            $this->add_inline_editing_attributes( 'title', 'basic' );
            $this->add_render_attribute( 'title', 'class', 'mb-0 bdevs-el-title' );
        ?>
            <div class="personal_skill_item">
              <span class="item_icon">
                <?php if ( $settings['type'] === 'image' && ( $settings['image']['url'] || $settings['image']['id'] ) ) :
                    $this->get_render_attribute_string( 'image' );
                    $settings['hover_animation'] = 'disable-animation'; // hack to prevent image hover animation
                    ?>
                        <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ); ?>
                        <?php elseif ( ! empty( $settings['icon'] ) || ! empty( $settings['selected_icon']['value'] ) ) : ?>
                        <?php bdevs_element_render_icon( $settings, 'icon', 'selected_icon' ); ?>
                <?php endif; ?>
              </span>
              <?php if ( $settings['title' ] ) :
                printf( '<%1$s %2$s>%3$s</%1$s>',
                    tag_escape( $settings['title_tag'] ),
                    $this->get_render_attribute_string( 'title' ),
                    bdevs_element_kses_basic( $settings['title' ] )
                    );
            endif; ?>
            </div>
        <?php elseif ( $settings['design_style'] === 'style_3' ):
            $this->add_inline_editing_attributes( 'title', 'basic' );
            $this->add_render_attribute( 'title', 'class', 'item_title bdevs-el-title' );
        ?>
            <div class="policy_item_3 style_2">
                <div class="item_icon">
                  <?php if ( $settings['type'] === 'image' && ( $settings['image']['url'] || $settings['image']['id'] ) ) :
                        $this->get_render_attribute_string( 'image' );
                        $settings['hover_animation'] = 'disable-animation'; // hack to prevent image hover animation
                        ?>
                            <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ); ?>
                            <?php elseif ( ! empty( $settings['icon'] ) || ! empty( $settings['selected_icon']['value'] ) ) : ?>
                            <?php bdevs_element_render_icon( $settings, 'icon', 'selected_icon' ); ?>
                    <?php endif; ?>
                </div>
                <?php if ( $settings['title' ] ) :
                    printf( '<%1$s %2$s>%3$s</%1$s>',
                        tag_escape( $settings['title_tag'] ),
                        $this->get_render_attribute_string( 'title' ),
                        bdevs_element_kses_basic( $settings['title' ] )
                        );
                endif; ?>
                <?php if(!empty($settings['description'])) : ?>
                <p class="bdevs-el-description">
                    <?php echo bdevs_element_kses_intermediate($settings['description']); ?>
                </p>
                <?php endif; ?>
              </div>
        <?php elseif ( $settings['design_style'] === 'style_2' ):
            $this->add_inline_editing_attributes( 'title', 'basic' );
            $this->add_render_attribute( 'title', 'class', 'item_title bdevs-el-title' );
        ?>

            <div class="policy_item_4">
                <div class="item_icon">
                  <?php if ( $settings['type'] === 'image' && ( $settings['image']['url'] || $settings['image']['id'] ) ) :
                        $this->get_render_attribute_string( 'image' );
                        $settings['hover_animation'] = 'disable-animation'; // hack to prevent image hover animation
                        ?>
                            <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ); ?>
                            <?php elseif ( ! empty( $settings['icon'] ) || ! empty( $settings['selected_icon']['value'] ) ) : ?>
                            <?php bdevs_element_render_icon( $settings, 'icon', 'selected_icon' ); ?>
                    <?php endif; ?>
                </div>
                <?php if ( $settings['title' ] ) :
                    printf( '<%1$s %2$s>%3$s</%1$s>',
                        tag_escape( $settings['title_tag'] ),
                        $this->get_render_attribute_string( 'title' ),
                        bdevs_element_kses_basic( $settings['title' ] )
                        );
                endif; ?>
          </div>
        

        <?php else: 
            $this->add_inline_editing_attributes( 'title', 'basic' );
            $this->add_render_attribute( 'title', 'class', 'item_title bdevs-el-title' );
        ?>
            <div class="policy_item">
              <div class="item_icon">
                <?php if ( $settings['type'] === 'image' && ( $settings['image']['url'] || $settings['image']['id'] ) ) :
                    $this->get_render_attribute_string( 'image' );
                    $settings['hover_animation'] = 'disable-animation'; // hack to prevent image hover animation
                    ?>
                        <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ); ?>
                        <?php elseif ( ! empty( $settings['icon'] ) || ! empty( $settings['selected_icon']['value'] ) ) : ?>
                        <?php bdevs_element_render_icon( $settings, 'icon', 'selected_icon' ); ?>
                <?php endif; ?>
              </div>
              <?php if ( $settings['title' ] ) :
                    printf( '<%1$s %2$s>%3$s</%1$s>',
                        tag_escape( $settings['title_tag'] ),
                        $this->get_render_attribute_string( 'title' ),
                        bdevs_element_kses_basic( $settings['title' ] )
                        );
                endif; ?>
            </div>
        <?php endif; ?>
        
        <?php
    }

}