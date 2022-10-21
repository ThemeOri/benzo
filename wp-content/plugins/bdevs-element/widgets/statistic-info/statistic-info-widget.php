<?php
namespace BdevsElement\Widget;

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

class Statistic_Info extends BDevs_El_Widget {

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
        return 'statistic_info';
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
        return __( 'Statistic Info', 'bdevs-element' );
    }

	public function get_custom_help_url() {
		return 'http://elementor.bdevs.net//widgets/info-box/';
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
        return 'eicon-info-box';
    }

    public function get_keywords() {
        return [ 'info', 'blurb', 'box', 'text', 'content' ];
    }

    /**
     * Register content related controls
     */
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
                    'style_5' => __( 'Style 5', 'bdevs-element' ),
                    'style_6' => __( 'Style 6', 'bdevs-element' ),
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
                'condition' => [
                    'design_style' => 'style_10',
                ],
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

        $this->end_controls_section();



        $this->start_controls_section(
            '_section_title',
            [
                'label' => __( 'Title & Description', 'bdevs-element' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'bdevs-element' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Statistic Info', 'bdevs-element' ),
                'placeholder' => __( 'Type Info Box Title', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __( 'Description', 'bdevs-element' ),
                'description' => bdevs_element_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'bdevs info box description goes here', 'bdevs-element' ),
                'placeholder' => __( 'Type info box description', 'bdevs-element' ),
                'rows' => 5,
                'dynamic' => [
                    'active' => true,
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
                'default' => 'h2',
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
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'content_off',
            [
                'label' => __( 'Content on/off', 'bdevs-element' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'On', 'bdevs-element' ),
                'label_off' => __( 'Off', 'bdevs-element' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_statictic_list',
            [
                'label' => __( 'Statictic Info', 'bdevs-element' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'stat_image',
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
            'stat_number',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Number', 'bdevs-element' ),
                'placeholder' => __( 'Countr Number here', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'stat_content',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'show_label' => false,
                'placeholder' => __( 'Content here', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'statistic_items',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(stat_number || "Statictic Item"); #>',
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
                    ]
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'statictic_thumbnail',
                'default' => 'medium_large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_button',
            [
                'label' => __( 'Button', 'bdevs-element' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __( 'Text', 'bdevs-element' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Button Text', 'bdevs-element' ),
                'placeholder' => __( 'Type button text here', 'bdevs-element' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => __( 'Link', 'bdevs-element' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'http://elementor.bdevs.net/', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        if ( bdevs_element_is_elementor_version( '<', '2.6.0' ) ) {
            $this->add_control(
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
                'default' => 'after',
                'toggle' => false,
                'condition' => $condition,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'button_icon_spacing',
            [
                'label' => __( 'Icon Spacing', 'bdevs-element' ),
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
    }

    /**
     * Register styles related controls
     */
    protected function register_style_controls() {
        $this->start_controls_section(
            '_section_media_style',
            [
                'label' => __( 'Icon / Image', 'bdevs-element' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => __( 'Size', 'bdevs-element' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-infobox-figure--icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                     'type' => 'icon'
                ]
            ]
        );

        $this->add_responsive_control(
            'image_width',
            [
                'label' => __( 'Width', 'bdevs-element' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-infobox-figure--image' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'type' => 'image'
                ]
            ]
        );

        $this->add_responsive_control(
            'image_height',
            [
                'label' => __( 'Height', 'bdevs-element' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-infobox-figure--image' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'type' => 'image'
                ]
            ]
        );

        $this->add_control(
            'offset_toggle',
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
            'media_offset_x',
            [
                'label' => __( 'Offset Left', 'bdevs-element' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => [
                    'offset_toggle' => 'yes'
                ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'render_type' => 'ui',
            ]
        );

        $this->add_responsive_control(
            'media_offset_y',
            [
                'label' => __( 'Offset Top', 'bdevs-element' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => [
                    'offset_toggle' => 'yes'
                ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    // Media translate styles
                    '(desktop){{WRAPPER}} .bdevs-infobox-figure' => '-ms-transform: translate({{media_offset_x.SIZE || 0}}{{UNIT}}, {{media_offset_y.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{media_offset_x.SIZE || 0}}{{UNIT}}, {{media_offset_y.SIZE || 0}}{{UNIT}}); transform: translate({{media_offset_x.SIZE || 0}}{{UNIT}}, {{media_offset_y.SIZE || 0}}{{UNIT}});',
                    '(tablet){{WRAPPER}} .bdevs-infobox-figure' => '-ms-transform: translate({{media_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{media_offset_y_tablet.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{media_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{media_offset_y_tablet.SIZE || 0}}{{UNIT}}); transform: translate({{media_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{media_offset_y_tablet.SIZE || 0}}{{UNIT}});',
                    '(mobile){{WRAPPER}} .bdevs-infobox-figure' => '-ms-transform: translate({{media_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{media_offset_y_mobile.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{media_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{media_offset_y_mobile.SIZE || 0}}{{UNIT}}); transform: translate({{media_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{media_offset_y_mobile.SIZE || 0}}{{UNIT}});',
                    // Body text styles
                    '{{WRAPPER}} .bdevs-infobox-body' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_popover();

        $this->add_responsive_control(
            'media_spacing',
            [
                'label' => __( 'Bottom Spacing', 'bdevs-element' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-infobox-figure' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'media_padding',
            [
                'label' => __( 'Padding', 'bdevs-element' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-infobox-figure--image img, {{WRAPPER}} .bdevs-infobox-figure--icon' => 'padding: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'media_border',
                'selector' => '{{WRAPPER}} .bdevs-infobox-figure--image img, {{WRAPPER}} .bdevs-infobox-figure--icon',
            ]
        );

        $this->add_responsive_control(
            'media_border_radius',
            [
                'label' => __( 'Border Radius', 'bdevs-element' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-infobox-figure--image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .bdevs-infobox-figure--icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'media_box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .bdevs-infobox-figure--image img, {{WRAPPER}} .bdevs-infobox-figure--icon'
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => __( 'Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-infobox-figure--icon' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'type' => 'icon'
                ]
            ]
        );

        $this->add_control(
            'icon_bg_color',
            [
                'label' => __( 'Background Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-infobox-figure--icon' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'type' => 'icon'
                ]
            ]
        );

        $this->add_control(
            'icon_bg_rotate',
            [
                'label' => __( 'Background Rotate', 'bdevs-element' ),
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
                    // Icon rotate styles
                    '{{WRAPPER}} .bdevs-infobox-figure--icon > i' => '-ms-transform: rotate(-{{SIZE}}{{UNIT}}); -webkit-transform: rotate(-{{SIZE}}{{UNIT}}); transform: rotate(-{{SIZE}}{{UNIT}});',
                    // Icon box transform styles
                    '(desktop){{WRAPPER}} .bdevs-infobox-figure--icon' => '-ms-transform: translate({{media_offset_x.SIZE || 0}}px, {{media_offset_y.SIZE || 0}}px) rotate({{SIZE}}deg); -webkit-transform: translate({{media_offset_x.SIZE || 0}}px, {{media_offset_y.SIZE || 0}}px) rotate({{SIZE}}deg); transform: translate({{media_offset_x.SIZE || 0}}px, {{media_offset_y.SIZE || 0}}px) rotate({{SIZE}}deg);',
                    '(tablet){{WRAPPER}} .bdevs-infobox-figure--icon' => '-ms-transform: translate({{media_offset_x_tablet.SIZE || 0}}px, {{media_offset_y_tablet.SIZE || 0}}px) rotate({{SIZE}}deg); -webkit-transform: translate({{media_offset_x_tablet.SIZE || 0}}px, {{media_offset_y_tablet.SIZE || 0}}px) rotate({{SIZE}}deg); transform: translate({{media_offset_x_tablet.SIZE || 0}}px, {{media_offset_y_tablet.SIZE || 0}}px) rotate({{SIZE}}deg);',
                    '(mobile){{WRAPPER}} .bdevs-infobox-figure--icon' => '-ms-transform: translate({{media_offset_x_mobile.SIZE || 0}}px, {{media_offset_y_mobile.SIZE || 0}}px) rotate({{SIZE}}deg); -webkit-transform: translate({{media_offset_x_mobile.SIZE || 0}}px, {{media_offset_y_mobile.SIZE || 0}}px) rotate({{SIZE}}deg); transform: translate({{media_offset_x_mobile.SIZE || 0}}px, {{media_offset_y_mobile.SIZE || 0}}px) rotate({{SIZE}}deg);',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_title_style',
            [
                'label' => __( 'Title & Description', 'bdevs-element' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => __( 'Content Box Padding', 'bdevs-element' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-infobox-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_heading',
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
                    '{{WRAPPER}} .bdevs-infobox-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Text Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-infobox-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __( 'Typography', 'bdevs-element' ),
                'selector' => '{{WRAPPER}} .bdevs-infobox-title',
                'scheme' => Typography::TYPOGRAPHY_2
            ]
        );

        $this->add_control(
            'description_heading',
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
                    '{{WRAPPER}} .bdevs-infobox-text' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __( 'Text Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-infobox-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'label' => __( 'Typography', 'bdevs-element' ),
                'selector' => '{{WRAPPER}} .bdevs-infobox-text',
                'scheme' => Typography::TYPOGRAPHY_3,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_button',
            [
                'label' => __( 'Button', 'bdevs-element' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'link_padding',
            [
                'label' => __( 'Padding', 'bdevs-element' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typography',
                'selector' => '{{WRAPPER}} .btn',
                'scheme' => Typography::TYPOGRAPHY_4,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .btn',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => __( 'Border Radius', 'bdevs-element' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .btn',
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
            'link_color',
            [
                'label' => __( 'Text Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => __( 'Background Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_icon_translate',
            [
                'label' => __( 'Icon Translate X', 'bdevs-element' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .btn--icon-before .btn-icon' => '-webkit-transform: translateX(calc(-1 * {{SIZE}}{{UNIT}})); transform: translateX(calc(-1 * {{SIZE}}{{UNIT}}));',
                    '{{WRAPPER}} .btn--icon-after .btn-icon' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
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
            'link_hover_color',
            [
                'label' => __( 'Text Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn:hover, {{WRAPPER}} .btn:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color',
            [
                'label' => __( 'Background Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn:hover, {{WRAPPER}} .btn:focus' => 'background-color: {{VALUE}};',
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
                    '{{WRAPPER}} .btn:hover, {{WRAPPER}} .btn:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_icon_translate',
            [
                'label' => __( 'Icon Translate X', 'bdevs-element' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 10
                ],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .btn.btn--icon-before:hover .btn-icon' => '-webkit-transform: translateX(calc(-1 * {{SIZE}}{{UNIT}})); transform: translateX(calc(-1 * {{SIZE}}{{UNIT}}));',
                    '{{WRAPPER}} .btn.btn--icon-after:hover .btn-icon' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }

	protected function render() {


     $settings = $this->get_settings_for_display();

        $this->add_inline_editing_attributes('title', 'basic');
        $this->add_render_attribute('title', 'class', 'section-title bdevs-el-title  bdevs-el-btn');

        $this->add_inline_editing_attributes('button_text', 'none');
        $this->add_render_attribute('button_text', 'class', '');
        $this->add_render_attribute('button', 'class', 'z-btn z-btn-border ');

        if (!empty($settings['button_link'])) {
            $this->add_link_attributes('button', $settings['button_link']);
        }

        $title = bdevs_element_kses_basic($settings['title']);

        ?>


        <?php if ($settings['design_style'] === 'style_6'):
        $this->add_render_attribute('title', 'class', 'wow fadeInUp2 bdevs-el-title');
        $this->add_render_attribute('title', 'data-wow-delay', '.2s');
        ?>

    <!-- About Section - Start
        ================================================== -->
      <section class="about_section section_space bg_black fix">
        <div class="about_image_3">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/about/about_img_4.jpg" alt="Person Image">
        </div>
        <div class="container">
          <div class="row justify-content-lg-end">
            <div class="col col-lg-7">
              <div class="about_content_2">
                <div class="year_text">
                  <strong>10<sup>+</sup></strong>
                  <span>Years Experiences</span>
                </div>
                <div class="section_title mb-0">
                  <h2 class="sub_title">
                    About Company
                    <span class="under_text">About</span>
                  </h2>
                  <h3 class="title_text">
                    Trusted Repairing Shop Of Complex Solutions.
                  </h3>
                  <p>
                    All kinds of laptop, desktop computer servicing center forIt is a long established fact that a
                    reader will be distracted by the readable computer disk. Lorem ipsum dolor sit amet, consectetur
                    adipiscing elit. Ut elit tellus, luctus nec
                  </p>
                  <a class="btn btn_danger btn_rounded" href="https://themepure.net/wp/repairon/about/">Read More</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- About Section - End
        ================================================== -->

      <!-- Testimonial Section - Start
        ================================================== -->
      <section class="testimonial_section pt-115 pb-90">
        <div class="container">

          <div class="row justify-content-center">
            <div class="col col-lg-6">
              <div class="section_title text-center">
                <h2 class="sub_title">
                  Testimonials
                  <span class="under_text">Testimonial</span>
                </h2>
                <h3 class="title_text mb-0">
                  Some Feedback From Our Happy Clients.
                </h3>
              </div>
            </div>
          </div>

          <div class="testimonial_carousel_3" data-slick='{"arrows": false}'>
            <div class="common_carousel_3col">
              <div class="carousel_item">
                <div class="testimonial_item_3">
                  <i class="quote_icon flaticon-quotation-right-mark"></i>
                  <div class="hero_wrap">
                    <div class="hero_image">
                      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/meta/thumbnail_4.png" alt="Model Image">
                    </div>
                    <div class="hero_content">
                      <h3 class="hero_name">Nirob Shen Aronno</h3>
                      <span class="hero_designation">CEO, Codexpand</span>
                      <ul class="reting_star ul_li">
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                      </ul>
                    </div>
                  </div>
                  <p>
                    There are many variations of passages of Lorem Ipsum available, but the majority have suffered
                    alteration in some form injected humour, or randomised words which don't look even slightly.
                  </p>
                </div>
              </div>

              <div class="carousel_item">
                <div class="testimonial_item_3">
                  <i class="quote_icon flaticon-quotation-right-mark"></i>
                  <div class="hero_wrap">
                    <div class="hero_image">
                      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/meta/thumbnail_5.png" alt="Model Image">
                    </div>
                    <div class="hero_content">
                      <h3 class="hero_name">Daniel Jovan Cruse</h3>
                      <span class="hero_designation">Manager</span>
                      <ul class="reting_star ul_li">
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                      </ul>
                    </div>
                  </div>
                  <p>
                    There are many variations of passages of Lorem Ipsum available, but the majority have suffered
                    alteration in some form injected humour, or randomised words which don't look even slightly.
                  </p>
                </div>
              </div>

              <div class="carousel_item">
                <div class="testimonial_item_3">
                  <i class="quote_icon flaticon-quotation-right-mark"></i>
                  <div class="hero_wrap">
                    <div class="hero_image">
                      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/meta/thumbnail_6.png" alt="Model Image">
                    </div>
                    <div class="hero_content">
                      <h3 class="hero_name">Tanzin Reova</h3>
                      <span class="hero_designation">Journalist</span>
                      <ul class="reting_star ul_li">
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                      </ul>
                    </div>
                  </div>
                  <p>
                    There are many variations of passages of Lorem Ipsum available, but the majority have suffered
                    alteration in some form injected humour, or randomised words which don't look even slightly.
                  </p>
                </div>
              </div>

              <div class="carousel_item">
                <div class="testimonial_item_3">
                  <i class="quote_icon flaticon-quotation-right-mark"></i>
                  <div class="hero_wrap">
                    <div class="hero_image">
                      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/meta/thumbnail_4.png" alt="Model Image">
                    </div>
                    <div class="hero_content">
                      <h3 class="hero_name">Nirob Shen Aronno</h3>
                      <span class="hero_designation">CEO, Codexpand</span>
                      <ul class="reting_star ul_li">
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                      </ul>
                    </div>
                  </div>
                  <p>
                    There are many variations of passages of Lorem Ipsum available, but the majority have suffered
                    alteration in some form injected humour, or randomised words which don't look even slightly.
                  </p>
                </div>
              </div>

              <div class="carousel_item">
                <div class="testimonial_item_3">
                  <i class="quote_icon flaticon-quotation-right-mark"></i>
                  <div class="hero_wrap">
                    <div class="hero_image">
                      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/meta/thumbnail_5.png" alt="Model Image">
                    </div>
                    <div class="hero_content">
                      <h3 class="hero_name">Daniel Jovan Cruse</h3>
                      <span class="hero_designation">Manager</span>
                      <ul class="reting_star ul_li">
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                      </ul>
                    </div>
                  </div>
                  <p>
                    There are many variations of passages of Lorem Ipsum available, but the majority have suffered
                    alteration in some form injected humour, or randomised words which don't look even slightly.
                  </p>
                </div>
              </div>

              <div class="carousel_item">
                <div class="testimonial_item_3">
                  <i class="quote_icon flaticon-quotation-right-mark"></i>
                  <div class="hero_wrap">
                    <div class="hero_image">
                      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/meta/thumbnail_6.png" alt="Model Image">
                    </div>
                    <div class="hero_content">
                      <h3 class="hero_name">Tanzin Reova</h3>
                      <span class="hero_designation">Journalist</span>
                      <ul class="reting_star ul_li">
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                      </ul>
                    </div>
                  </div>
                  <p>
                    There are many variations of passages of Lorem Ipsum available, but the majority have suffered
                    alteration in some form injected humour, or randomised words which don't look even slightly.
                  </p>
                </div>
              </div>

              <div class="carousel_item">
                <div class="testimonial_item_3">
                  <i class="quote_icon flaticon-quotation-right-mark"></i>
                  <div class="hero_wrap">
                    <div class="hero_image">
                      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/meta/thumbnail_4.png" alt="Model Image">
                    </div>
                    <div class="hero_content">
                      <h3 class="hero_name">Nirob Shen Aronno</h3>
                      <span class="hero_designation">CEO, Codexpand</span>
                      <ul class="reting_star ul_li">
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                      </ul>
                    </div>
                  </div>
                  <p>
                    There are many variations of passages of Lorem Ipsum available, but the majority have suffered
                    alteration in some form injected humour, or randomised words which don't look even slightly.
                  </p>
                </div>
              </div>

              <div class="carousel_item">
                <div class="testimonial_item_3">
                  <i class="quote_icon flaticon-quotation-right-mark"></i>
                  <div class="hero_wrap">
                    <div class="hero_image">
                      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/meta/thumbnail_5.png" alt="Model Image">
                    </div>
                    <div class="hero_content">
                      <h3 class="hero_name">Daniel Jovan Cruse</h3>
                      <span class="hero_designation">Manager</span>
                      <ul class="reting_star ul_li">
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                      </ul>
                    </div>
                  </div>
                  <p>
                    There are many variations of passages of Lorem Ipsum available, but the majority have suffered
                    alteration in some form injected humour, or randomised words which don't look even slightly.
                  </p>
                </div>
              </div>

              <div class="carousel_item">
                <div class="testimonial_item_3">
                  <i class="quote_icon flaticon-quotation-right-mark"></i>
                  <div class="hero_wrap">
                    <div class="hero_image">
                      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/meta/thumbnail_6.png" alt="Model Image">
                    </div>
                    <div class="hero_content">
                      <h3 class="hero_name">Tanzin Reova</h3>
                      <span class="hero_designation">Journalist</span>
                      <ul class="reting_star ul_li">
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                      </ul>
                    </div>
                  </div>
                  <p>
                    There are many variations of passages of Lorem Ipsum available, but the majority have suffered
                    alteration in some form injected humour, or randomised words which don't look even slightly.
                  </p>
                </div>
              </div>
            </div>
          </div>

        </div>
      </section>
      <!-- Testimonial Section - End
        ================================================== -->


       <!-- Product Section - Start
        ================================================== -->
      <section class="product_section pt-130 pb-120">
        <div class="container">

          <div class="row align-items-center">
            <div class="col col-lg-6">
              <div class="section_title">
                <h2 class="sub_title">
                  Second Hand Mobile
                  <span class="under_text">Mobile</span>
                </h2>
                <h3 class="title_text mb-0">
                  Purchase Second Hand Used Headsets
                </h3>
              </div>
            </div>

            <div class="col col-lg-6">
              <div class="single_btn_wrap p-0 text-lg-end">
                <a class="btn btn_danger btn_rounded" href="https://themepure.net/wp/repairon/shop/">Browse More</a>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col col-lg-6">
              <div class="product_split">
                <a class="item_image" href="https://themepure.net/wp/repairon/product/apple-iphone-8-plus-64-gb-water-proof-used/">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shop/product_img_27.jpg" alt="Mobile Image">
                </a>
                <div class="item_content">
                  <div class="post_date">1 Days ago</div>
                  <h3 class="item_title">
                    <a href="https://themepure.net/wp/repairon/product/apple-iphone-8-plus-64-gb-water-proof-used/">
                      Apple iPhone 8 Plus 64 GB Water proof (Used)
                    </a>
                  </h3>
                  <ul class="item_info_list ul_li">
                    <li>Location : <span>New York</span></li>
                    <li>Condition : <span>Used</span></li>
                  </ul>
                  <div class="item_price">
                    <span>$55.00</span>
                    <del>$60.00</del>
                  </div>
                </div>
              </div>
            </div>

            <div class="col col-lg-6">
              <div class="product_split">
                <a class="item_image" href="https://themepure.net/wp/repairon/product/apple-iphone-8-plus-64-gb-water-proof-used/">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shop/product_img_28.jpg" alt="Mobile Image">
                </a>
                <div class="item_content">
                  <div class="post_date">1 Days ago</div>
                  <h3 class="item_title">
                    <a href="https://themepure.net/wp/repairon/product/apple-iphone-8-plus-64-gb-water-proof-used/">
                      Apple iPhone 8 Plus 64 GB Water proof (Used)
                    </a>
                  </h3>
                  <ul class="item_info_list ul_li">
                    <li>Location : <span>New York</span></li>
                    <li>Condition : <span>Used</span></li>
                  </ul>
                  <div class="item_price">
                    <span>$90.00</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="col col-lg-6">
              <div class="product_split">
                <a class="item_image" href="https://themepure.net/wp/repairon/product/apple-iphone-8-plus-64-gb-water-proof-used/">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shop/product_img_29.jpg" alt="Mobile Image">
                </a>
                <div class="item_content">
                  <div class="post_date">1 Days ago</div>
                  <h3 class="item_title">
                    <a href="https://themepure.net/wp/repairon/product/apple-iphone-8-plus-64-gb-water-proof-used/">
                      Samsung Galaxy A50 4/64GB 100% Original (Used)
                    </a>
                  </h3>
                  <ul class="item_info_list ul_li">
                    <li>Location : <span>New York</span></li>
                    <li>Condition : <span>Used</span></li>
                  </ul>
                  <div class="item_price">
                    <span>$68.00</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="col col-lg-6">
              <div class="product_split">
                <a class="item_image" href="https://themepure.net/wp/repairon/product/apple-iphone-8-plus-64-gb-water-proof-used/">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shop/product_img_30.jpg" alt="Mobile Image">
                </a>
                <div class="item_content">
                  <div class="post_date">1 Days ago</div>
                  <h3 class="item_title">
                    <a href="https://themepure.net/wp/repairon/product/apple-iphone-8-plus-64-gb-water-proof-used/">
                      Vivo Y50 November'20 (Used) With Selfie Stick
                    </a>
                  </h3>
                  <ul class="item_info_list ul_li">
                    <li>Location : <span>New York</span></li>
                    <li>Condition : <span>Used</span></li>
                  </ul>
                  <div class="item_price">
                    <span>$75.00</span>
                    <del>$85.00</del>
                  </div>
                </div>
              </div>
            </div>

            <div class="col col-lg-6">
              <div class="product_split">
                <a class="item_image" href="https://themepure.net/wp/repairon/product/apple-iphone-8-plus-64-gb-water-proof-used/">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shop/product_img_31.jpg" alt="Mobile Image">
                </a>
                <div class="item_content">
                  <div class="post_date">1 Days ago</div>
                  <h3 class="item_title">
                    <a href="https://themepure.net/wp/repairon/product/apple-iphone-8-plus-64-gb-water-proof-used/">
                      Samsung Galaxy A50 4GB Ram/64GB Rom (Used)
                    </a>
                  </h3>
                  <ul class="item_info_list ul_li">
                    <li>Location : <span>New York</span></li>
                    <li>Condition : <span>Used</span></li>
                  </ul>
                  <div class="item_price">
                    <span>$98.00</span>
                    <del>$110.00</del>
                  </div>
                </div>
              </div>
            </div>

            <div class="col col-lg-6">
              <div class="product_split">
                <a class="item_image" href="https://themepure.net/wp/repairon/product/apple-iphone-8-plus-64-gb-water-proof-used/">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shop/product_img_32.jpg" alt="Mobile Image">
                </a>
                <div class="item_content">
                  <div class="post_date">1 Days ago</div>
                  <h3 class="item_title">
                    <a href="https://themepure.net/wp/repairon/product/apple-iphone-8-plus-64-gb-water-proof-used/">
                      Nokia OnePlus 6 6Gb Ram+64Gb Rom (5 Months Used)
                    </a>
                  </h3>
                  <ul class="item_info_list ul_li">
                    <li>Location : <span>New York</span></li>
                    <li>Condition : <span>Used</span></li>
                  </ul>
                  <div class="item_price">
                    <span>$120.00</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </section>
      <!-- Product Section - End
        ================================================== -->



      <!-- FAQ Section - Start
        ================================================== -->
      <section class="faq_section section_space bg_gray">
        <div class="container">
          <div class="row align-items-center">

            <div class="col col-lg-7">
              <div class="faq_accordion_wrap" id="faq_accordion">
                <div class="accordion_item">
                  <div class="accordion_header" id="heading_one">
                    <h3 class="accordion_button" data-bs-toggle="collapse" data-bs-target="#collapse_one"
                      aria-expanded="true" aria-controls="collapse_one">
                      How I can Flash Handset?
                    </h3>
                  </div>
                  <div id="collapse_one" class="accordion_collapse collapse show" aria-labelledby="heading_one"
                    data-bs-parent="#faq_accordion">
                    <div class="accordion_body">
                      <p>
                        There might be repetitions due to the joining of all the thematic collections together, but
                        mainly the system retrieves as many occurrences of the term as are present in the database
                      </p>
                    </div>
                  </div>
                </div>

                <div class="accordion_item">
                  <div class="accordion_header" id="heading_two">
                    <h3 class="accordion_button collapsed" data-bs-toggle="collapse" data-bs-target="#collapse_two"
                      aria-expanded="false" aria-controls="collapse_two">
                      I do not find abbreviations of two letters such as those?
                    </h3>
                  </div>
                  <div id="collapse_two" class="accordion_collapse collapse" aria-labelledby="heading_two"
                    data-bs-parent="#faq_accordion">
                    <div class="accordion_body">
                      <p>
                        There might be repetitions due to the joining of all the thematic collections together, but
                        mainly the system retrieves as many occurrences of the term as are present in the database
                      </p>
                    </div>
                  </div>
                </div>

                <div class="accordion_item">
                  <div class="accordion_header" id="heading_three">
                    <h3 class="accordion_button collapsed" data-bs-toggle="collapse" data-bs-target="#collapse_three"
                      aria-expanded="false" aria-controls="collapse_three">
                      I see many repeated records. Why?
                    </h3>
                  </div>
                  <div id="collapse_three" class="accordion_collapse collapse" aria-labelledby="heading_three"
                    data-bs-parent="#faq_accordion">
                    <div class="accordion_body">
                      <p>
                        There might be repetitions due to the joining of all the thematic collections together, but
                        mainly the system retrieves as many occurrences of the term as are present in the database
                      </p>
                    </div>
                  </div>
                </div>

                <div class="accordion_item">
                  <div class="accordion_header" id="heading_four">
                    <h3 class="accordion_button collapsed" data-bs-toggle="collapse" data-bs-target="#collapse_four"
                      aria-expanded="false" aria-controls="collapse_four">
                      I see many repeated records. Why?
                    </h3>
                  </div>
                  <div id="collapse_four" class="accordion_collapse collapse" aria-labelledby="heading_four"
                    data-bs-parent="#faq_accordion">
                    <div class="accordion_body">
                      <p>
                        There might be repetitions due to the joining of all the thematic collections together, but
                        mainly the system retrieves as many occurrences of the term as are present in the database
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col col-lg-5">
              <div class="counter_items_group">
                <div class="counter_item">
                  <div class="item_icon" data-text-color="#000323">
                    <i class="flaticon-support"></i>
                  </div>
                  <div class="counter_text"><span class="counter">1200</span>+</div>
                  <h3 class="item_title">Repairing Cases Solved</h3>
                </div>

                <div class="counter_item">
                  <div class="item_icon" data-text-color="#000323">
                    <i class="flaticon-customer-satisfaction"></i>
                  </div>
                  <div class="counter_text"><span class="counter">500</span>+</div>
                  <h3 class="item_title">Happy Customers</h3>
                </div>

                <div class="counter_item">
                  <div class="item_icon" data-text-color="#000323">
                    <i class="flaticon-businessman"></i>
                  </div>
                  <div class="counter_text"><span class="counter">25</span></div>
                  <h3 class="item_title">Experienced Engineers</h3>
                </div>

                <div class="counter_item">
                  <div class="item_icon" data-text-color="#000323">
                    <i class="flaticon-star-1"></i>
                  </div>
                  <div class="counter_text"><span class="counter">99</span>%</div>
                  <h3 class="item_title">Successful Ratings</h3>
                </div>
              </div>
            </div>

          </div>
        </div>
      </section>
      <!-- FAQ Section - End
        ================================================== -->

      <!-- Blog Section - Start
        ================================================== -->
      <section class="blog_section home-inner pt-115 pb-90">
        <div class="container">

          <div class="section_title text-center">
            <div class="row justify-content-center">
              <div class="col col-lg-6">
                <h2 class="sub_title">Our Latest Blog</h2>
                <h3 class="title_text mb-0">
                  Read Latest Technology Blog Post
                </h3>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col col-lg-4 col-md-6 mb-30">
              <div class="blog_standard">
                <a class="item_image" href="https://themepure.net/wp/repairon/everything-you-want-to-know-about-creating-voice-user-interfaces-2/">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/blog/blog_img_1.jpg" alt="Blog Image">
                </a>
                <div class="item_content">
                  <ul class="post_meta ul_li">
                    <li><a href="#!"><i class="flaticon-user"></i> Repairon</a></li>
                    <li><a href="#!"><i class="far fa-comments"></i>04 Comments</a></li>
                    <li><i class="flaticon-calendar"></i> 18 Jan 2022</li>
                  </ul>
                  <h3 class="item_title">
                    <a href="https://themepure.net/wp/repairon/everything-you-want-to-know-about-creating-voice-user-interfaces-2/">
                      Web Design Done Well: The Ordinary
                    </a>
                  </h3>
                  <a class="btn_unfill" href="https://themepure.net/wp/repairon/everything-you-want-to-know-about-creating-voice-user-interfaces-2/">READ MORE <i class="far fa-plus"></i></a>
                </div>
              </div>
            </div>
            <div class="col col-lg-4 col-md-6 mb-30">
              <div class="blog_standard">
                <a class="item_image" href="https://themepure.net/wp/repairon/everything-you-want-to-know-about-creating-voice-user-interfaces-2/">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/blog/blog_img_2.jpg" alt="Blog Image">
                </a>
                <div class="item_content">
                  <ul class="post_meta ul_li">
                    <li><a href="#!"><i class="flaticon-user"></i> Repairon</a></li>
                    <li><a href="#!"><i class="far fa-comments"></i>05 Comments</a></li>
                    <li><i class="flaticon-calendar"></i> 15 Jan 2022</li>
                  </ul>
                  <h3 class="item_title">
                    <a href="https://themepure.net/wp/repairon/everything-you-want-to-know-about-creating-voice-user-interfaces-2/">
                      How to Change the Vehicle Tire Smoothly
                    </a>
                  </h3>
                  <a class="btn_unfill" href="https://themepure.net/wp/repairon/everything-you-want-to-know-about-creating-voice-user-interfaces-2/">READ MORE <i class="far fa-plus"></i></a>
                </div>
              </div>
            </div>
            <div class="col col-lg-4 col-md-6">
              <div class="blog_standard">
                <a class="item_image" href="https://themepure.net/wp/repairon/everything-you-want-to-know-about-creating-voice-user-interfaces-2/">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/blog/blog_img_7.jpg" alt="Blog Image">
                </a>
                <div class="item_content">
                  <ul class="post_meta ul_li">
                    <li><a href="#!"><i class="flaticon-user"></i> Repairon</a></li>
                    <li><a href="#!"><i class="far fa-comments"></i>07 Comments</a></li>
                    <li><i class="flaticon-calendar"></i> 22 Jan 2022</li>
                  </ul>
                  <h3 class="item_title">
                    <a href="https://themepure.net/wp/repairon/everything-you-want-to-know-about-creating-voice-user-interfaces-2/">
                     Frustrating Design Patterns Mega Menus  
                    </a>
                  </h3>
                  <a class="btn_unfill" href="https://themepure.net/wp/repairon/everything-you-want-to-know-about-creating-voice-user-interfaces-2/">READ MORE <i class="far fa-plus"></i></a>
                </div>
              </div>
            </div>
          </div>

        </div>
      </section>
      <!-- Blog Section - End
        ================================================== -->


        <?php elseif ($settings['design_style'] === 'style_5'):
        $this->add_render_attribute('title', 'class', 'wow fadeInUp2 bdevs-el-title');
        $this->add_render_attribute('title', 'data-wow-delay', '.2s');
        ?>

         <!-- Banner Section - Start
            ================================================== -->
        <section class="banner_section banner_3" style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/img/shapes/shape_5.png);">
            <div class="container">
              <div class="row align-items-center justify-content-lg-between">
                <div class="col order-last col-lg-6">
                  <div class="banner_image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/banner/banner_img_1.png" alt="creative Solutions Image">
                  </div>
                </div>

                <div class="col col-lg-6">
                  <div class="banner_content">
                    <h1>
                      <small>One Stop Repair House</small>
                      Repair Your Phone At <span data-text-color="#d42222">Doorstep</span>.
                    </h1>
                    <p>
                      Reapiron is a revolutionary service designed to simplify mobile repairs without making them too hard
                      on your wallet. Find the mobile.
                    </p>
                    <form action="#">
                      <div class="form_item form_rounded">
                        <input type="search" name="search" placeholder="Search Nearest Shop">
                        <button type="submit" class="btn btn_danger btn_rounded">Search Now</button>
                      </div>
                    </form>
                    <ul class="social_icon social_round ul_li">
                      <li><a href="#!"><i class="fab fa-facebook-f"></i></a></li>
                      <li><a href="#!"><i class="fab fa-twitter"></i></a></li>
                      <li><a href="#!"><i class="fab fa-instagram"></i></a></li>
                      <li><a href="#!"><i class="fab fa-linkedin-in"></i></a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
        </section>
        <!-- Banner Section - End
            ================================================== -->

      <!-- Brond Section - Start
        ================================================== -->
      <section class="brand_section pt-70 pb-65">
        <div class="container">
        <div class="brand_wrapper">
              <ul class="brand_carousel product_brands_list ul_li_center">
            <li>
              <a href="https://themepure.net/wp/repairon/shop/">
                <span>
                  <small class="item_image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/brands/envato-Logo.png" alt="img">
                  </small>
                </span>
              </a>
            </li>
            <li>
              <a href="https://themepure.net/wp/repairon/shop/">
                <span>
                  <small class="item_image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/brands/envato-Logo.png" alt="img">
                  </small>
                </span>
              </a>
            </li>
            <li>
              <a href="https://themepure.net/wp/repairon/shop/">
                <span>
                  <small class="item_image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/brands/envato-Logo.png" alt="img">
                  </small>
                </span>
              </a>
            </li>
            <li>
              <a href="https://themepure.net/wp/repairon/shop/">
                <span>
                  <small class="item_image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/brands/envato-Logo.png" alt="img">
                  </small>
    
                </span>
              </a>
            </li>
            <li>
              <a href="https://themepure.net/wp/repairon/shop/">
                <span>
                  <small class="item_image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/brands/envato-Logo.png" alt="img">
                  </small>
                </span>
              </a>
            </li>
            <li>
              <a href="https://themepure.net/wp/repairon/shop/">
                <span>
                  <small class="item_image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/brands/envato-Logo.png" alt="img">
                  </small>
                </span>
              </a>
            </li>
            <li>
              <a href="https://themepure.net/wp/repairon/shop/">
                <span>
                  <small class="item_image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/brands/envato-Logo.png" alt="img">
                  </small>
                </span>
              </a>
            </li>
            <li>
              <a href="https://themepure.net/wp/repairon/shop/">
                <span>
                  <small class="item_image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/brands/envato-Logo.png" alt="img">
                  </small>
                </span>
              </a>
            </li>
          </ul>
        </div>

        </div>
      </section>
      <!-- Brond Section - End
        ================================================== -->

      <!-- Advance Section - Start
        ================================================== -->
    <div class="advance_search_section advance_search_2 pt-105 pb-120 decoration_wrap parallaxie"
        style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/img/backgrounds/bg_4.jpg);">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col col-lg-8">
              <div class="section_title text-center">
                <h3 class="title_text text-white">
                  Facing Computer Problem? Please Send a Solution Request
                </h3>
              </div>
            </div>
          </div>

          <form action="#">
            <div class="row">
              <div class="col col-lg-3 col-md-4 col-sm-6">
                <div class="form_item">
                  <input type="text" name="name" placeholder="Your Name">
                </div>
              </div>
              <div class="col col-lg-3 col-md-4 col-sm-6">
                <div class="form_item">
                  <input type="email" name="email" placeholder="Email">
                </div>
              </div>
              <div class="col col-lg-3 col-md-4 col-sm-6">
                <div class="form_item">
                  <input type="tel" name="phone" placeholder="Phone">
                </div>
              </div>
              <div class="col col-lg-3 col-md-4 col-sm-6">
                <div class="form_item">
                  <input type="text" name="location" placeholder="Location">
                </div>
              </div>

              <div class="col col-lg-3 col-md-4 col-sm-6">
                <div class="select_option clearfix">
                  <select>
                    <option data-display="Select Brand">Select Your Option</option>
                    <option value="1">BMW</option>
                    <option value="2">Toyota</option>
                    <option value="3" disabled>Mitsubishi</option>
                    <option value="4">Honda</option>
                  </select>
                </div>
              </div>
              <div class="col col-lg-3 col-md-4 col-sm-6">
                <div class="select_option clearfix">
                  <select>
                    <option data-display="Select Problem">Select Your Option</option>
                    <option value="1">BMW 228i 4-Door Coupe</option>
                    <option value="2">Toyota C-HR Consumer</option>
                    <option value="3" disabled>Mitsubishi Triton / L200</option>
                    <option value="4">Honda Accord</option>
                  </select>
                </div>
              </div>
              <div class="col col-lg-6">
                <div class="form_item">
                  <input type="text" name="comment" placeholder="Write Note (Optional)">
                </div>
              </div>
            </div>

            <div class="single_btn_wrap text-center p-0">
              <button type="submit" class="btn btn_danger btn_rounded">Send a Request</button>
            </div>
          </form>
        </div>

        <div class="overlay" data-bg-color="#000323"></div>

        <div class="deco_item circle_1"></div>
        <div class="deco_item circle_2"></div>
      </div>
      <!-- Advance Section - End
        ================================================== -->

      <!-- About Section - Start
        ================================================== -->
      <div class="about_section pt-130 pb-0">
        <div class="container">
          <div class="row">
            <div class="col col-lg-6">
              <div class="section_title mb-2">
                <h2 class="sub_title">
                  Why Choose Us
                  <span class="under_text">Choose Us</span>
                </h2>
                <h3 class="title_text mb-0">
                  20K+ Mobile Repairing Problems Solved.
                </h3>
              </div>
            </div>
          </div>

          <div class="row justify-content-lg-between">
            <div class="col col-lg-6">
              <div class="about_content">
                <div class="row">
                  <div class="col col-lg-6">
                    <div class="policy_item_2">
                      <div class="item_icon">
                        <i class="flaticon-skills"></i>
                      </div>
                      <div class="item_content">
                        <h3 class="item_title">Skilled Technicians</h3>
                        <p class="mb-0" data-text-color="#828A9B">
                          Vehicle Repair on the Spot in the Store or at Home/Office
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="col col-lg-6">
                    <div class="policy_item_2">
                      <div class="item_icon">
                        <i class="flaticon-chemical-reaction"></i>
                      </div>
                      <div class="item_content">
                        <h3 class="item_title">10+ Years Experiences</h3>
                        <p class="mb-0" data-text-color="#828A9B">
                          Vehicle Repair on the Spot in the Store or at Home/Office
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="col col-lg-6">
                    <div class="policy_item_2">
                      <div class="item_icon">
                        <i class="flaticon-padlock"></i>
                      </div>
                      <div class="item_content">
                        <h3 class="item_title">Quality Guarantee</h3>
                        <p class="mb-0" data-text-color="#828A9B">
                          Vehicle Repair on the Spot in the Store or at Home/Office
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="col col-lg-6">
                    <div class="policy_item_2">
                      <div class="item_icon">
                        <i class="flaticon-holding-hands"></i>
                      </div>
                      <div class="item_content">
                        <h3 class="item_title">Trusted &amp; Recommended</h3>
                        <p class="mb-0" data-text-color="#828A9B">
                          Vehicle Repair on the Spot in the Store or at Home/Office
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col col-lg-5">
              <div class="progress_bar_area">
                <div class="progress_item">
                  <h4 class="item_title mb-0">Mobile Flash</h4>
                  <div class="progress">
                    <div class="progress_bar wow Rx_width_80" role="progressbar" data-wow-duration="1s"
                      data-wow-delay=".4s" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                      <span class="value_text">80%</span>
                    </div>
                  </div>
                </div>

                <div class="progress_item">
                  <h4 class="item_title mb-0">Country Lock</h4>
                  <div class="progress">
                    <div class="progress_bar wow Rx_width_70" role="progressbar" data-wow-duration="1s"
                      data-wow-delay=".4s" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                      <span class="value_text">70%</span>
                    </div>
                  </div>
                </div>

                <div class="progress_item">
                  <h4 class="item_title mb-0">Screen & Touch</h4>
                  <div class="progress">
                    <div class="progress_bar wow Rx_width_90" role="progressbar" data-wow-duration="1s"
                      data-wow-delay=".4s" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                      <span class="value_text">90%</span>
                    </div>
                  </div>
                </div>

                <div class="progress_item">
                  <h4 class="item_title mb-0">Whole Body Repair</h4>
                  <div class="progress">
                    <div class="progress_bar wow Rx_width_95" role="progressbar" data-wow-duration="1s"
                      data-wow-delay=".4s" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                      <span class="value_text">95%</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- About Section - End
        ================================================== -->

      <!-- Policy Section - Start
        ================================================== -->
      <div class="policy_section pt-110 pb-120">
        <div class="container">
          <div class="policy_wrap">
            <div class="col">
              <div class="policy_item_4">
                <div class="item_icon">
                  <i class="flaticon-support"></i>
                </div>
                <h3 class="item_title">Repairing Service</h3>
              </div>
            </div>

            <div class="col">
              <div class="policy_item_4">
                <div class="item_icon">
                  <i class="flaticon-sales"></i>
                </div>
                <h3 class="item_title">Accessories Sales</h3>
              </div>
            </div>

            <div class="col">
              <div class="policy_item_4">
                <div class="item_icon">
                  <i class="flaticon-customer-support"></i>
                </div>
                <h3 class="item_title">Customer Support</h3>
              </div>
            </div>

            <div class="col">
              <div class="policy_item_4">
                <div class="item_icon">
                  <i class="flaticon-protection-shield-with-a-check-mark"></i>
                </div>
                <h3 class="item_title">Save and trust</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Policy Section - End
        ================================================== -->

      <!-- Service Tab Section 2 - Start
        ================================================== -->
      <div class="service_tab_section_2 pt-115 pb-120 bg_gray">
        <div class="container">

          <div class="row justify-content-center">
            <div class="col col-lg-6">
              <div class="section_title text-center">
                <h2 class="sub_title">
                  Featured Service
                  <span class="under_text">Services</span>
                </h2>
                <h3 class="title_text mb-0">
                  What Powerful Services We Offer You.
                </h3>
              </div>
            </div>
          </div>

          <ul class="tabs_nav style_2 nav" role="tablist">
            <li>
              <button class="active" data-bs-toggle="tab" data-bs-target="#tab_mobile_flash" type="button" role="tab"
                aria-selected="true">Mobile Flash</button>
            </li>
            <li>
              <button data-bs-toggle="tab" data-bs-target="#tab_screen_repair" type="button" role="tab"
                aria-selected="false">Screen Repair</button>
            </li>
            <li>
              <button data-bs-toggle="tab" data-bs-target="#tab_software_installation" type="button" role="tab"
                aria-selected="false">Software Installation</button>
            </li>
            <li>
              <button data-bs-toggle="tab" data-bs-target="#tab_country_lock" type="button" role="tab"
                aria-selected="false">Country Lock</button>
            </li>
            <li>
              <button data-bs-toggle="tab" data-bs-target="#tab_data_recovery" type="button" role="tab"
                aria-selected="false">Data Recovery</button>
            </li>
            <li>
              <button data-bs-toggle="tab" data-bs-target="#tab_hardware_repair" type="button" role="tab"
                aria-selected="false">Hardware Repair</button>
            </li>
          </ul>

          <div class="tab-content">
            <div class="tab-pane fade show active" id="tab_mobile_flash" role="tabpanel">
              <div class="row align-items-center justify-content-lg-between">
                <div class="col order-last col-lg-5">
                  <div class="item_image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/service/service_img_10.jpg" alt="Service Image">
                    <div class="rating_wrap">
                      <ul class="reting_star ul_li_center">
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                      </ul>
                      <span class="review_counter">(125)</span>
                    </div>
                  </div>
                </div>
                <div class="col col-lg-6">
                  <div class="item_content">
                    <h3 class="item_title">
                      Any Kinds of Mobile Hard Flash With FlashPro Software
                    </h3>
                    <div class="price_wrap">
                      <span>Start From</span>
                      <strong>$20.00</strong>
                    </div>
                    <p>
                      Computer hardware when an unknown printer took a galley of type and scrambled computer of the last
                      expert engineers.
                    </p>
                    <a class="btn danger_border btn_rounded" href="https://themepure.net/wp/repairon/service-details/">Read More</a>
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane fade" id="tab_screen_repair" role="tabpanel">
              <div class="row align-items-center justify-content-lg-between">
                <div class="col order-last col-lg-5">
                  <div class="item_image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/service/service_img_7.jpg" alt="Service Image">
                    <div class="rating_wrap">
                      <ul class="reting_star ul_li_center">
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                      </ul>
                      <span class="review_counter">(125)</span>
                    </div>
                  </div>
                </div>
                <div class="col col-lg-6">
                  <div class="item_content">
                    <h3 class="item_title">
                      Screen repair of Mobile With the best Professional
                    </h3>
                    <div class="price_wrap">
                      <span>Start From</span>
                      <strong>$20.00</strong>
                    </div>
                    <p>
                      Computer hardware when an unknown printer took a galley of type and scrambled computer of the last
                      expert engineers.
                    </p>
                    <a class="btn danger_border btn_rounded" href="https://themepure.net/wp/repairon/service-details/">Read More</a>
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane fade" id="tab_software_installation" role="tabpanel">
              <div class="row align-items-center justify-content-lg-between">
                <div class="col order-last col-lg-5">
                  <div class="item_image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/service/service_img_8.jpg" alt="Service Image">
                    <div class="rating_wrap">
                      <ul class="reting_star ul_li_center">
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                      </ul>
                      <span class="review_counter">(125)</span>
                    </div>
                  </div>
                </div>
                <div class="col col-lg-6">
                  <div class="item_content">
                    <h3 class="item_title">
                      Software Installation with expert IT Engineers
                    </h3>
                    <div class="price_wrap">
                      <span>Start From</span>
                      <strong>$20.00</strong>
                    </div>
                    <p>
                      Computer hardware when an unknown printer took a galley of type and scrambled computer of the last
                      expert engineers.
                    </p>
                    <a class="btn danger_border btn_rounded" href="https://themepure.net/wp/repairon/service-details/">Read More</a>
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane fade" id="tab_country_lock" role="tabpanel">
              <div class="row align-items-center justify-content-lg-between">
                <div class="col order-last col-lg-5">
                  <div class="item_image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/service/service_img_9.jpg" alt="Service Image">
                    <div class="rating_wrap">
                      <ul class="reting_star ul_li_center">
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                      </ul>
                      <span class="review_counter">(125)</span>
                    </div>
                  </div>
                </div>
                <div class="col col-lg-6">
                  <div class="item_content">
                    <h3 class="item_title">
                      Country Lock service provided by expert IT Engineers
                    </h3>
                    <div class="price_wrap">
                      <span>Start From</span>
                      <strong>$20.00</strong>
                    </div>
                    <p>
                      Computer hardware when an unknown printer took a galley of type and scrambled computer of the last
                      expert engineers.
                    </p>
                    <a class="btn danger_border btn_rounded" href="https://themepure.net/wp/repairon/service-details/">Read More</a>
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane fade" id="tab_data_recovery" role="tabpanel">
              <div class="row align-items-center justify-content-lg-between">
                <div class="col order-last col-lg-5">
                  <div class="item_image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/service/service_img_10.jpg" alt="Service Image">
                    <div class="rating_wrap">
                      <ul class="reting_star ul_li_center">
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                      </ul>
                      <span class="review_counter">(125)</span>
                    </div>
                  </div>
                </div>
                <div class="col col-lg-6">
                  <div class="item_content">
                    <h3 class="item_title">
                      Data Recovery of service With the best Professional
                    </h3>
                    <div class="price_wrap">
                      <span>Start From</span>
                      <strong>$20.00</strong>
                    </div>
                    <p>
                      Computer hardware when an unknown printer took a galley of type and scrambled computer of the last
                      expert engineers.
                    </p>
                    <a class="btn danger_border btn_rounded" href="https://themepure.net/wp/repairon/service-details/">Read More</a>
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane fade" id="tab_hardware_repair" role="tabpanel">
              <div class="row align-items-center justify-content-lg-between">
                <div class="col order-last col-lg-5">
                  <div class="item_image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/service/service_img_7.jpg" alt="Service Image">
                    <div class="rating_wrap">
                      <ul class="reting_star ul_li_center">
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                      </ul>
                      <span class="review_counter">(125)</span>
                    </div>
                  </div>
                </div>
                <div class="col col-lg-6">
                  <div class="item_content">
                    <h3 class="item_title">
                      Hardware Repair services With the best Professional
                    </h3>
                    <div class="price_wrap">
                      <span>Start From</span>
                      <strong>$20.00</strong>
                    </div>
                    <p>
                      Computer hardware when an unknown printer took a galley of type and scrambled computer of the last
                      expert engineers.
                    </p>
                    <a class="btn danger_border btn_rounded" href="https://themepure.net/wp/repairon/service-details/">Read More</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
      <!-- Service Tab Section 2 - End
        ================================================== -->


        <?php elseif ($settings['design_style'] === 'style_4'):
        $this->add_render_attribute('title', 'class', 'wow fadeInUp2 bdevs-el-title');
        $this->add_render_attribute('title', 'data-wow-delay', '.2s');
        ?>


        <!-- Testimonial Section - Start
        ================================================== -->
      <section class="testimonial_section pt-135 pb-90 decoration_wrap">
        <div class="half_bg_top" data-bg-color="#F5F7F8"></div>
        <div class="container">

          <div class="row justify-content-center">
            <div class="col col-lg-6">
              <div class="section_title text-center">
                <h2 class="sub_title" data-text-color="#74C138">
                  Testimonials
                  <span class="icon">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo/favourite_icon_3.png" alt="Logo Icon">
                  </span>
                </h2>
                <h3 class="title_text">
                  Some Positive Feedback From Our Clients
                </h3>
              </div>
            </div>
          </div>

          <div class="testimonial_carousel_2 carousel_style_2">
            <div class="row common_carousel_2col" data-slick='{"arrows": false}'>
              <div class="col carousel_item">
                <div class="testimonial_item_2" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/shapes/shape_4.png');">
                  <div class="quote_icon text-end">
                    <span>
                      <i class="flaticon-quotation-right-mark"></i>
                    </span>
                  </div>
                  <div class="content_wrap">
                    <h3 class="hero_name">Nirob Shen Aronno</h3>
                    <span class="hero_designation">CEO, Codexpand</span>
                    <p>
                      Reviews, testimonials and word of mouth are winning the war in branding. A sea of research is out there about social proof and what to do and what not to do about soliciting.
                    </p>
                    <ul class="reting_star ul_li">
                      <li class="active"><i class="flaticon-star"></i></li>
                      <li class="active"><i class="flaticon-star"></i></li>
                      <li class="active"><i class="flaticon-star"></i></li>
                      <li class="active"><i class="flaticon-star"></i></li>
                      <li class="active"><i class="flaticon-star"></i></li>
                    </ul>
                  </div>
                  <div class="thumbnail_wrap">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/meta/thumbnail_2.png" alt="Avatar Image">
                  </div>
                </div>
              </div>

              <div class="col carousel_item">
                <div class="testimonial_item_2" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/shapes/shape_4.png');">
                  <div class="quote_icon text-end">
                    <span>
                      <i class="flaticon-quotation-right-mark"></i>
                    </span>
                  </div>
                  <div class="content_wrap">
                    <h3 class="hero_name">Daniel Brown Costa</h3>
                    <span class="hero_designation">Manager, Probidya</span>
                    <p>
                      Reviews, testimonials and word of mouth are winning the war in branding. A sea of research is out there about social proof and what to do and what not to do about soliciting.
                    </p>
                    <ul class="reting_star ul_li">
                      <li class="active"><i class="flaticon-star"></i></li>
                      <li class="active"><i class="flaticon-star"></i></li>
                      <li class="active"><i class="flaticon-star"></i></li>
                      <li class="active"><i class="flaticon-star"></i></li>
                      <li class="active"><i class="flaticon-star"></i></li>
                    </ul>
                  </div>
                  <div class="thumbnail_wrap">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/meta/thumbnail_3.png" alt="Avatar Image">
                  </div>
                </div>
              </div>

              <div class="col carousel_item">
                <div class="testimonial_item_2" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/shapes/shape_4.png');">
                  <div class="quote_icon text-end">
                    <span>
                      <i class="flaticon-quotation-right-mark"></i>
                    </span>
                  </div>
                  <div class="content_wrap">
                    <h3 class="hero_name">Nirob Shen Aronno</h3>
                    <span class="hero_designation">CEO, Codexpand</span>
                    <p>
                      Reviews, testimonials and word of mouth are winning the war in branding. A sea of research is out there about social proof and what to do and what not to do about soliciting.
                    </p>
                    <ul class="reting_star ul_li">
                      <li class="active"><i class="flaticon-star"></i></li>
                      <li class="active"><i class="flaticon-star"></i></li>
                      <li class="active"><i class="flaticon-star"></i></li>
                      <li class="active"><i class="flaticon-star"></i></li>
                      <li class="active"><i class="flaticon-star"></i></li>
                    </ul>
                  </div>
                  <div class="thumbnail_wrap">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/meta/thumbnail_2.png" alt="Avatar Image">
                  </div>
                </div>
              </div>

              <div class="col carousel_item">
                <div class="testimonial_item_2" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/shapes/shape_4.png');">
                  <div class="quote_icon text-end">
                    <span>
                      <i class="flaticon-quotation-right-mark"></i>
                    </span>
                  </div>
                  <div class="content_wrap">
                    <h3 class="hero_name">Daniel Brown Costa</h3>
                    <span class="hero_designation">Manager, Probidya</span>
                    <p>
                      Reviews, testimonials and word of mouth are winning the war in branding. A sea of research is out there about social proof and what to do and what not to do about soliciting.
                    </p>
                    <ul class="reting_star ul_li">
                      <li class="active"><i class="flaticon-star"></i></li>
                      <li class="active"><i class="flaticon-star"></i></li>
                      <li class="active"><i class="flaticon-star"></i></li>
                      <li class="active"><i class="flaticon-star"></i></li>
                      <li class="active"><i class="flaticon-star"></i></li>
                    </ul>
                  </div>
                  <div class="thumbnail_wrap">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/meta/thumbnail_3.png" alt="Avatar Image">
                  </div>
                </div>
              </div>

              <div class="col carousel_item">
                <div class="testimonial_item_2" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/shapes/shape_4.png');">
                  <div class="quote_icon text-end">
                    <span>
                      <i class="flaticon-quotation-right-mark"></i>
                    </span>
                  </div>
                  <div class="content_wrap">
                    <h3 class="hero_name">Nirob Shen Aronno</h3>
                    <span class="hero_designation">CEO, Codexpand</span>
                    <p>
                      Reviews, testimonials and word of mouth are winning the war in branding. A sea of research is out there about social proof and what to do and what not to do about soliciting.
                    </p>
                    <ul class="reting_star ul_li">
                      <li class="active"><i class="flaticon-star"></i></li>
                      <li class="active"><i class="flaticon-star"></i></li>
                      <li class="active"><i class="flaticon-star"></i></li>
                      <li class="active"><i class="flaticon-star"></i></li>
                      <li class="active"><i class="flaticon-star"></i></li>
                    </ul>
                  </div>
                  <div class="thumbnail_wrap">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/meta/thumbnail_2.png" alt="Avatar Image">
                  </div>
                </div>
              </div>

              <div class="col carousel_item">
                <div class="testimonial_item_2" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/shapes/shape_4.png');">
                  <div class="quote_icon text-end">
                    <span>
                      <i class="flaticon-quotation-right-mark"></i>
                    </span>
                  </div>
                  <div class="content_wrap">
                    <h3 class="hero_name">Daniel Brown Costa</h3>
                    <span class="hero_designation">Manager, Probidya</span>
                    <p>
                      Reviews, testimonials and word of mouth are winning the war in branding. A sea of research is out there about social proof and what to do and what not to do about soliciting.
                    </p>
                    <ul class="reting_star ul_li">
                      <li class="active"><i class="flaticon-star"></i></li>
                      <li class="active"><i class="flaticon-star"></i></li>
                      <li class="active"><i class="flaticon-star"></i></li>
                      <li class="active"><i class="flaticon-star"></i></li>
                      <li class="active"><i class="flaticon-star"></i></li>
                    </ul>
                  </div>
                  <div class="thumbnail_wrap">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/meta/thumbnail_3.png" alt="Avatar Image">
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </section>
      <!-- Testimonial Section - End
        ================================================== -->

      <!-- Counter Section - Start
        ================================================== -->
      <section class="counter_section_2 section_space decoration_wrap pt-130 pb-120" data-bg-color="#000323"
        style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/backgrounds/pattern_2.png');">
        <div class="overlay" data-bg-color="#000323"></div>
        <div class="container">
          <div class="counter_items_wrap">
            <div class="counter_item">
              <div class="item_icon text-white">
                <i class="flaticon-support"></i>
              </div>
              <div class="counter_text text-white"><span class="counter">1200</span>+</div>
              <h3 class="item_title text-white">Repairing Cases Solved</h3>
            </div>

            <div class="counter_item">
              <div class="item_icon text-white">
                <i class="flaticon-customer-satisfaction"></i>
              </div>
              <div class="counter_text text-white"><span class="counter">500</span>+</div>
              <h3 class="item_title text-white">Happy Customers</h3>
            </div>

            <div class="counter_item">
              <div class="item_icon text-white">
                <i class="flaticon-businessman"></i>
              </div>
              <div class="counter_text text-white"><span class="counter">25</span></div>
              <h3 class="item_title text-white">Experienced Engineers</h3>
            </div>

            <div class="counter_item">
              <div class="item_icon text-white">
                <i class="flaticon-star-1"></i>
              </div>
              <div class="counter_text text-white"><span class="counter">99</span>%</div>
              <h3 class="item_title text-white">Successful Ratings</h3>
            </div>
          </div>
        </div>
      </section>
      <!-- Counter Section - End
        ================================================== -->

      <!-- Blog Section - Start
        ================================================== -->
        <section class="blog_section_2 home-inner section_space pt-115 pb-100">
         <div class="container">
          <div class="section_title text-center">
            <div class="row justify-content-center">
              <div class="col col-lg-6">
                <h2 class="sub_title" data-text-color="#74C138">Our Latest Blog</h2>
                <h3 class="title_text mb-0">
                  Read Latest Technology Blog Post
                </h3>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col col-lg-4 col-md-6 mb-30">
              <div class="blog_standard">
                <a class="item_image" href="https://themepure.net/wp/repairon/everything-you-want-to-know-about-creating-voice-user-interfaces-2/">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/blog/blog_img_1.jpg" alt="Blog Image">
                </a>
                <div class="item_content">
                  <ul class="post_meta ul_li">
                    <li><a href="#!"><i class="flaticon-user"></i> Repairon</a></li>
                    <li><a href="#!"><i class="far fa-comments"></i>02 Comments</a></li>
                    <li><i class="flaticon-calendar"></i> 25 Jan 2022</li>
                  </ul>
                  <h3 class="item_title">
                    <a href="https://themepure.net/wp/repairon/everything-you-want-to-know-about-creating-voice-user-interfaces-2/">
                      Don’t Underestimate The Software Administration UX
                    </a>
                  </h3>
                  <a class="btn_unfill" href="https://themepure.net/wp/repairon/everything-you-want-to-know-about-creating-voice-user-interfaces-2/">READ MORE <i class="far fa-plus"></i></a>
                </div>
              </div>
            </div>
            <div class="col col-lg-4 col-md-6 mb-30">
              <div class="blog_standard">
                <a class="item_image" href="https://themepure.net/wp/repairon/everything-you-want-to-know-about-creating-voice-user-interfaces-2/">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/blog/blog_img_2.jpg" alt="Blog Image">
                </a>
                <div class="item_content">
                  <ul class="post_meta ul_li">
                    <li><a href="#!"><i class="flaticon-user"></i> Repairon</a></li>
                    <li><a href="#!"><i class="far fa-comments"></i>03 Comments</a></li>
                    <li><i class="flaticon-calendar"></i> 26 Jan 2022</li>
                  </ul>
                  <h3 class="item_title">
                    <a href="https://themepure.net/wp/repairon/everything-you-want-to-know-about-creating-voice-user-interfaces-2/">  
                      Designing With Reduced Motion For Sensitivities 
                    </a>
                  </h3>
                  <a class="btn_unfill" href="https://themepure.net/wp/repairon/everything-you-want-to-know-about-creating-voice-user-interfaces-2/">READ MORE <i class="far fa-plus"></i></a>
                </div>
              </div>
            </div>
            <div class="col col-lg-4 col-md-6">
              <div class="blog_standard">
                <a class="item_image" href="https://themepure.net/wp/repairon/everything-you-want-to-know-about-creating-voice-user-interfaces-2/">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/blog/blog_img_7.jpg" alt="Blog Image">
                </a>
                <div class="item_content">
                  <ul class="post_meta ul_li">
                    <li><a href="#!"><i class="flaticon-user"></i> Repairon</a></li>
                    <li><a href="#!"><i class="far fa-comments"></i>05 Comments</a></li>
                    <li><i class="flaticon-calendar"></i> 27 Jan 2022</li>
                  </ul>
                  <h3 class="item_title">
                    <a href="https://themepure.net/wp/repairon/everything-you-want-to-know-about-creating-voice-user-interfaces-2/">
                      Frustrating Design Patterns: Mega-Dropdown Menus 
                    </a>
                  </h3>
                  <a class="btn_unfill" href="https://themepure.net/wp/repairon/everything-you-want-to-know-about-creating-voice-user-interfaces-2/">READ MORE <i class="far fa-plus"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Blog Section - End
        ================================================== -->

      <!-- Advertisement Section - Start
        ================================================== -->
      <section class="advertisement_section section_space pb-0">
        <div class="container">
          <div class="advertisement_layout_1 decoration_wrap" data-bg-color="#74C138"
            style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/backgrounds/pattern_3.png');">
            <div class="overlay" data-bg-color="#74C138"></div>
            <h2 class="text-white">Sale Second Hand Computer Through Repairon</h2>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/advertisement/advertisement_img_1.png" alt="Computer Image">
            <a class="btn btn_white btn_rounded" href="https://themepure.net/wp/repairon/product-upload/">Sale Computer</a>
          </div>
        </div>
      </section>
      <!-- Advertisement Section - End
        ================================================== -->



        <?php elseif ($settings['design_style'] === 'style_3'):
        $this->add_render_attribute('title', 'class', 'wow fadeInUp2 bdevs-el-title');
        $this->add_render_attribute('title', 'data-wow-delay', '.2s');
        ?>

           
    <!-- Banner Section - Start
        ================================================== -->
      <section class="banner_section banner_2 parallaxie"
            style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/img/backgrounds/bg_3.jpg);">
            <div class="container">
              <div class="row">
                <div class="col col-lg-8 col-md-8">
                  <div class="banner_content">
                    <h1>
                      Computer Repairing Center Near You
                    </h1>
                    <p>
                      All kinds of laptop, desktop computer servicing center forIt is a long established fact that a reader
                      will be distracted by the readable computer disk.
                    </p>
                    <a class="btn btn_success btn_rounded" href="https://themepure.net/wp/repairon/service/">Repair Computer</a>
                  </div>
                </div>
              </div>
            </div>
        </section>
          <!-- Banner Section - End
            ================================================== -->

      <!-- Policy Section - Start
        ================================================== -->
      <div class="policy_section r_top_space_2">
        <div class="container">
          <div class="policy_wrap m-0">
            <div class="policy_item_3">
              <div class="item_icon">
                <i class="flaticon-support"></i>
              </div>
              <h3 class="item_title">Repairing Service</h3>
              <p>
                Every now and then we look around, select fresh free high-quality fonts and present them
              </p>
            </div>

            <div class="policy_item_3">
              <div class="item_icon">
                <i class="flaticon-sales"></i>
              </div>
              <h3 class="item_title">Accessories Sales</h3>
              <p>
                It is arguable that there is no goal in web design more satisfying than getting a beautiful
              </p>
            </div>

            <div class="policy_item_3">
              <div class="item_icon">
                <i class="flaticon-customer-support"></i>
              </div>
              <h3 class="item_title">Customer Support</h3>
              <p>
                But regardless of how much has changed in the production process, a website’s success
              </p>
            </div>

            <div class="policy_item_3">
              <div class="item_icon">
                <i class="flaticon-protection-shield-with-a-check-mark"></i>
              </div>
              <h3 class="item_title">Save and trust</h3>
              <p>
                Websites and Web applications have become progressively more complex as our technologies
              </p>
            </div>
          </div>
        </div>
      </div>
      <!-- Policy Section - End
        ================================================== -->

      <!-- About Section - Start
        ================================================== -->
      <div class="about_section pt-105 pb-120">
        <div class="container">
          <div class="row align-items-center">
            <div class="col col-lg-6 col-md-8">
              <div class="about_image">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/about/about_img_1.png" alt="Laptop Repair Images">
              </div>
            </div>

            <div class="col col-lg-6">
              <div class="about_content">
                <div class="section_title mb-2">
                  <h2 class="sub_title" data-text-color="#74C138">
                    Why Choose Us
                    <span class="icon">
                      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo/favourite_icon_3.png" alt="Logo Icon">
                    </span>
                  </h2>
                  <h3 class="title_text mb-0">
                    Bring More Happiness in Computer Using
                  </h3>
                </div>
                <div class="row">
                  <div class="col col-lg-6">
                    <div class="policy_item_2">
                      <div class="item_icon" data-text-color="#74C138">
                        <i class="flaticon-skills"></i>
                      </div>
                      <div class="item_content">
                        <h3 class="item_title">Skilled Technicians</h3>
                        <p class="mb-0" data-text-color="#828A9B">
                          Vehicle Repair on the Spot in the Store or at Home/Office
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="col col-lg-6">
                    <div class="policy_item_2">
                      <div class="item_icon" data-text-color="#74C138">
                        <i class="flaticon-chemical-reaction"></i>
                      </div>
                      <div class="item_content">
                        <h3 class="item_title">10+ Years Experiences</h3>
                        <p class="mb-0" data-text-color="#828A9B">
                          Vehicle Repair on the Spot in the Store or at Home/Office
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="col col-lg-6">
                    <div class="policy_item_2">
                      <div class="item_icon" data-text-color="#74C138">
                        <i class="flaticon-padlock"></i>
                      </div>
                      <div class="item_content">
                        <h3 class="item_title">Quality Guarantee</h3>
                        <p class="mb-0" data-text-color="#828A9B">
                          Vehicle Repair on the Spot in the Store or at Home/Office
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="col col-lg-6">
                    <div class="policy_item_2">
                      <div class="item_icon" data-text-color="#74C138">
                        <i class="flaticon-holding-hands"></i>
                      </div>
                      <div class="item_content">
                        <h3 class="item_title">Trusted &amp; Recommended</h3>
                        <p class="mb-0" data-text-color="#828A9B">
                          Vehicle Repair on the Spot in the Store or at Home/Office
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- About Section - End
        ================================================== -->

      <!-- Service Section - Start
        ================================================== -->
      <div class="service_section pt-115 pb-90 bg_gray">
        <div class="container">

          <div class="row justify-content-center">
            <div class="col col-lg-5">
              <div class="section_title text-center">
                <h2 class="sub_title" data-text-color="#74C138">
                  Featured Services
                  <span class="icon">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo/favourite_icon_3.png" alt="Logo Icon">
                  </span>
                </h2>
                <h3 class="title_text mb-0">
                  All in One Repairing Service For You
                </h3>
              </div>
            </div>
          </div>

          <div class="featured_services_carousel carousel_style_2">
            <div class="row common_carousel_3col" data-slick='{"arrows": false}'>
              <div class="col carousel_item">
                <div class="service_card_layout style_2">
                  <div class="item_image">
                    <a class="image_wrap" href="https://themepure.net/wp/repairon/service-details/">
                      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/service/service_img_7.jpg" alt="Service Image">
                    </a>
                    <div class="price_wrap">
                      <span>Start From</span>
                      <strong>$55.00</strong>
                    </div>
                  </div>
                  <div class="item_content">
                    <a href="https://themepure.net/wp/repairon/service-details/">
                      <h4 class="item_title">Hardware Maintenance</h4>
                    </a>
                    <p>
                      Computer hardware when an unknown printer took a galley of type and scrambled.
                    </p>
                    <a class="btn success_border btn_rounded" href="https://themepure.net/wp/repairon/service-details/">Read More</a>
                  </div>
                </div>
              </div>

              <div class="col carousel_item">
                <div class="service_card_layout style_2">
                  <div class="item_image">
                    <a class="image_wrap" href="https://themepure.net/wp/repairon/service-details/">
                      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/service/service_img_8.jpg" alt="Service Image">
                    </a>
                    <div class="price_wrap">
                      <span>Start From</span>
                      <strong>$23.00</strong>
                    </div>
                  </div>
                  <div class="item_content">
                    <a href="https://themepure.net/wp/repairon/service-details/">
                      <h4 class="item_title">Software Installation</h4>
                    </a>
                    <p>
                      Software installation when an unknown printer took a galley of type and scrambled.
                    </p>
                    <a class="btn success_border btn_rounded" href="https://themepure.net/wp/repairon/service-details/">Read More</a>
                  </div>
                </div>
              </div>

              <div class="col carousel_item">
                <div class="service_card_layout style_2">
                  <div class="item_image">
                    <a class="image_wrap" href="https://themepure.net/wp/repairon/service-details/">
                      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/service/service_img_9.jpg" alt="Service Image">
                    </a>
                    <div class="price_wrap">
                      <span>Start From</span>
                      <strong>$36.00</strong>
                    </div>
                  </div>
                  <div class="item_content">
                    <a href="https://themepure.net/wp/repairon/service-details/">
                      <h4 class="item_title">Networking Solution</h4>
                    </a>
                    <p>
                      Computer networking when an unknown printer took a galley of type and scrambled.
                    </p>
                    <a class="btn success_border btn_rounded" href="https://themepure.net/wp/repairon/service-details/">Read More</a>
                  </div>
                </div>
              </div>

              <div class="col carousel_item">
                <div class="service_card_layout style_2">
                  <div class="item_image">
                    <a class="image_wrap" href="https://themepure.net/wp/repairon/service-details/">
                      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/service/service_img_7.jpg" alt="Service Image">
                    </a>
                    <div class="price_wrap">
                      <span>Start From</span>
                      <strong>$55.00</strong>
                    </div>
                  </div>
                  <div class="item_content">
                    <a href="https://themepure.net/wp/repairon/service-details/">
                      <h4 class="item_title">Hardware Maintenance</h4>
                    </a>
                    <p>
                      Computer hardware when an unknown printer took a galley of type and scrambled.
                    </p>
                    <a class="btn success_border btn_rounded" href="https://themepure.net/wp/repairon/service-details/">Read More</a>
                  </div>
                </div>
              </div>

              <div class="col carousel_item">
                <div class="service_card_layout style_2">
                  <div class="item_image">
                    <a class="image_wrap" href="https://themepure.net/wp/repairon/service-details/">
                      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/service/service_img_8.jpg" alt="Service Image">
                    </a>
                    <div class="price_wrap">
                      <span>Start From</span>
                      <strong>$23.00</strong>
                    </div>
                  </div>
                  <div class="item_content">
                    <a href="https://themepure.net/wp/repairon/service-details/">
                      <h4 class="item_title">Software Installation</h4>
                    </a>
                    <p>
                      Software installation when an unknown printer took a galley of type and scrambled.
                    </p>
                    <a class="btn success_border btn_rounded" href="https://themepure.net/wp/repairon/service-details/">Read More</a>
                  </div>
                </div>
              </div>

              <div class="col carousel_item">
                <div class="service_card_layout style_2">
                  <div class="item_image">
                    <a class="image_wrap" href="https://themepure.net/wp/repairon/service-details/">
                      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/service/service_img_9.jpg" alt="Service Image">
                    </a>
                    <div class="price_wrap">
                      <span>Start From</span>
                      <strong>$36.00</strong>
                    </div>
                  </div>
                  <div class="item_content">
                    <a href="https://themepure.net/wp/repairon/service-details/">
                      <h4 class="item_title">Networking Solution</h4>
                    </a>
                    <p>
                      Computer networking when an unknown printer took a galley of type and scrambled.
                    </p>
                    <a class="btn success_border btn_rounded" href="https://themepure.net/wp/repairon/service-details/">Read More</a>
                  </div>
                </div>
              </div>

              <div class="col carousel_item">
                <div class="service_card_layout style_2">
                  <div class="item_image">
                    <a class="image_wrap" href="https://themepure.net/wp/repairon/service-details/">
                      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/service/service_img_8.jpg" alt="Service Image">
                    </a>
                    <div class="price_wrap">
                      <span>Start From</span>
                      <strong>$23.00</strong>
                    </div>
                  </div>
                  <div class="item_content">
                    <a href="https://themepure.net/wp/repairon/service-details/">
                      <h4 class="item_title">Software Installation</h4>
                    </a>
                    <p>
                      Software installation when an unknown printer took a galley of type and scrambled.
                    </p>
                    <a class="btn success_border btn_rounded" href="https://themepure.net/wp/repairon/service-details/">Read More</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
      <!-- Service Section - End
        ================================================== -->

      <!-- About Section - Start
        ================================================== -->
      <div class="about_section pt-125 pb-160">
        <div class="container">
          <div class="row align-items-center">
            <div class="col col-lg-6 order-last col-md-8">
              <div class="about_image_2 decoration_wrap">
                <div class="big_image">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/about/about_img_2.jpg" alt="Worker Image">
                </div>
                <div class="small_image">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/about/about_img_3.jpg" alt="Worker Image">
                </div>
                <div class="deco_item shape_1">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shapes/shape_2.png" alt="Dots Shape Image">
                </div>
                <div class="deco_item shape_2">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shapes/shape_3.png" alt="Border Circle Image">
                </div>
                <div class="year_text">
                  <strong>10+</strong>
                  <span>
                    <span class="d-block">Years</span>
                    Experiences
                  </span>
                </div>
              </div>
            </div>

            <div class="col col-lg-6">
              <div class="about_content">
                <div class="section_title">
                  <h2 class="sub_title" data-text-color="#74C138">
                    About Company
                    <span class="icon">
                      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo/favourite_icon_3.png" alt="Logo Icon">
                    </span>
                  </h2>
                  <h3 class="title_text">
                    Achieved a Milestone In Repairing Services
                  </h3>
                  <p class="mb-0">
                    All kinds of laptop, desktop computer servicing center forIt is a long established fact that a
                    reader will be distracted by the readable computer disk. Lorem ipsum dolor sit amet, consectetur
                    adipiscing elit. Ut elit tellus, luctus nec
                  </p>
                </div>
                  <ul class="info_list ul_li_block">
                      <li><i class="fas fa-check-square"></i> Easy to Edit & Repair</li>
                      <li><i class="fas fa-check-square"></i> Auto mobile Workshop For Garaz</li>
                      <li><i class="fas fa-check-square"></i> Maintenance & Repair Guide</li>
                      <li><i class="fas fa-check-square"></i> Estimated Repair Costs</li>
                  </ul>
                <a class="btn btn_success btn_rounded" href="https://themepure.net/wp/repairon/service/">Repair Computer</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- About Section - End
        ================================================== -->

      <!-- Advance Section - Start
        ================================================== -->
      <div class="advance_search_section advance_search_2 pt-105 pb-120  decoration_wrap parallaxie"
        style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/img/backgrounds/bg_4.jpg);">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col col-lg-8">
              <div class="section_title text-center">
                <h3 class="title_text text-white">
                  Facing Computer Problem? Please Send a Solution Request
                </h3>
              </div>
            </div>
          </div>

          <form action="#">
            <div class="row">
              <div class="col col-lg-3 col-md-4 col-sm-6">
                <div class="form_item">
                  <input type="text" name="name" placeholder="Your Name">
                </div>
              </div>
              <div class="col col-lg-3 col-md-4 col-sm-6">
                <div class="form_item">
                  <input type="email" name="email" placeholder="Email">
                </div>
              </div>
              <div class="col col-lg-3 col-md-4 col-sm-6">
                <div class="form_item">
                  <input type="tel" name="phone" placeholder="Phone">
                </div>
              </div>
              <div class="col col-lg-3 col-md-4 col-sm-6">
                <div class="form_item">
                  <input type="text" name="location" placeholder="Location">
                </div>
              </div>

              <div class="col col-lg-3 col-md-4 col-sm-6">
                <div class="select_option clearfix">
                  <select>
                    <option data-display="Select Brand">Select Your Option</option>
                    <option value="1">BMW</option>
                    <option value="2">Toyota</option>
                    <option value="3" disabled>Mitsubishi</option>
                    <option value="4">Honda</option>
                  </select>
                </div>
              </div>
              <div class="col col-lg-3 col-md-4 col-sm-6">
                <div class="select_option clearfix">
                  <select>
                    <option data-display="Select Problem">Select Your Option</option>
                    <option value="1">BMW 228i 4-Door Coupe</option>
                    <option value="2">Toyota C-HR Consumer</option>
                    <option value="3" disabled>Mitsubishi Triton / L200</option>
                    <option value="4">Honda Accord</option>
                  </select>
                </div>
              </div>
              <div class="col col-lg-6">
                <div class="form_item">
                  <input type="text" name="comment" placeholder="Write Note (Optional)">
                </div>
              </div>
            </div>

            <div class="single_btn_wrap text-center p-0">
              <button type="submit" class="btn btn_success btn_rounded">Send a Request</button>
            </div>
          </form>
        </div>

        <div class="overlay" data-bg-color="#000323"></div>

        <div class="deco_item circle_1"></div>
        <div class="deco_item circle_2"></div>
      </div>
      <!-- Advance Section - End
        ================================================== -->

           <!-- Product Section - Start
        ================================================== -->
      <section class="product_section pt-135 pb-115">
        <div class="container">
          <div class="row">
            <div class="col col-lg-5">
              <div class="section_title">
                <h2 class="sub_title" data-text-color="#74C138">
                  Our Products
                  <span class="icon">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo/favourite_icon_3.png" alt="Logo Icon">
                  </span>
                </h2>
                <h3 class="title_text">
                  Browse Computer Accessories
                </h3>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col col-lg-3 col-md-6">
              <div class="category_filter_sidebar">
                <div class="fs_widget category_list">
                  <h3 class="fs_widget_title">Browse Category</h3>
                  <ul class="ul_li_block">
                    <li><a href="#!">All Categories <span>(252)</span></a></li>
                    <li><a href="#!">Mouse <span>(58)</span></a></li>
                    <li><a href="#!">Keyboard <span>(10)</span></a></li>
                    <li><a href="#!">Hard Disk <span>(96)</span></a></li>
                    <li><a href="#!">Pendrive <span>(82)</span></a></li>
                    <li><a href="#!">Monitor <span>(30)</span></a></li>
                    <li><a href="#!">SSD <span>(10)</span></a></li>
                    <li><a href="#!">Processor <span>(42)</span></a></li>
                    <li><a href="#!">UPS & IPS <span>(32)</span></a></li>
                    <li><a href="#!">RAM <span>(63)</span></a></li>
                    <li><a href="#!">Motherboard <span>(64)</span></a></li>
                    <li><a href="#!">CPU Cooler <span>(36)</span></a></li>
                    <li><a href="#!">Graphics Card <span>(22)</span></a></li>
                    <li><a href="#!">DVD Writer <span>(44)</span></a></li>
                    <li><a href="#!">Webcam <span>(69)</span></a></li>
                    <li><a href="#!">Internet Modem <span>(25)</span></a></li>
                    <li><a href="#!">Computer Casing <span>(20)</span></a></li>
                  </ul>
                </div>
                <div class="fs_widget">
                  <button type="button" class="btn btn_success btn_rounded">Browse More</button>
                </div>
              </div>
            </div>

            <div class="col col-lg-9">
              <div class="product_group_carousel arrow_top_right">
                <div class="common_carousel_4col" data-slick='{"dots": false}'>
                  <div class="carousel_item">
                    <div class="product_grid_2">
                      <a class="item_image" href="https://themepure.net/wp/repairon/product/apple-iphone-8-plus-64-gb-water-proof-used/">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shop/product_img_9.png" alt="Shop Image">
                      </a>
                      <div class="item_content">
                        <h3 class="item_title">
                          <a href="https://themepure.net/wp/repairon/product/apple-iphone-8-plus-64-gb-water-proof-used/">
                            Sandisk AH353 Aluminum Alloy Pendrive
                          </a>
                        </h3>
                        <ul class="reting_star ul_li">
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                        </ul>
                        <div class="item_price">
                          <span>$25.00</span>
                          <del>$35.00</del>
                        </div>
                        <ul class="cart_btns_group ul_li">
                          <li><a class="action_cart_btn" href="#!">Add to Cart</a></li>
                          <li><a href="#!"><i class="flaticon-heart"></i></a></li>
                        </ul>
                      </div>
                    </div>

                    <div class="product_grid_2">
                      <a class="item_image" href="https://themepure.net/wp/repairon/product/apple-iphone-8-plus-64-gb-water-proof-used/">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shop/product_img_13.png" alt="Shop Image">
                      </a>
                      <div class="item_content">
                        <h3 class="item_title">
                          <a href="https://themepure.net/wp/repairon/product/apple-iphone-8-plus-64-gb-water-proof-used/">
                            Intel core-i5 10th gen processor
                          </a>
                        </h3>
                        <ul class="reting_star ul_li">
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                        </ul>
                        <div class="item_price">
                          <span>$25.00</span>
                        </div>
                        <ul class="cart_btns_group ul_li">
                          <li><a class="action_cart_btn" href="#!">Add to Cart</a></li>
                          <li><a href="#!"><i class="flaticon-heart"></i></a></li>
                        </ul>
                      </div>
                    </div>
                  </div>

                  <div class="carousel_item">
                    <div class="product_grid_2">
                      <a class="item_image" href="https://themepure.net/wp/repairon/product/apple-iphone-8-plus-64-gb-water-proof-used/">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shop/product_img_10.png" alt="Shop Image">
                      </a>
                      <div class="item_content">
                        <h3 class="item_title">
                          <a href="https://themepure.net/wp/repairon/product/apple-iphone-8-plus-64-gb-water-proof-used/">
                            Remax RP-W10 Infinite fast speed charger
                          </a>
                        </h3>
                        <ul class="reting_star ul_li">
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                        </ul>
                        <div class="item_price">
                          <span>$25.00</span>
                        </div>
                        <ul class="cart_btns_group ul_li">
                          <li><a class="action_cart_btn" href="#!">Add to Cart</a></li>
                          <li><a href="#!"><i class="flaticon-heart"></i></a></li>
                        </ul>
                      </div>
                    </div>

                    <div class="product_grid_2">
                      <a class="item_image" href="https://themepure.net/wp/repairon/product/apple-iphone-8-plus-64-gb-water-proof-used/">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shop/product_img_14.png" alt="Shop Image">
                      </a>
                      <div class="item_content">
                        <h3 class="item_title">
                          <a href="https://themepure.net/wp/repairon/product/apple-iphone-8-plus-64-gb-water-proof-used/">
                            Apacer AH353 standard multimedia keyboard
                          </a>
                        </h3>
                        <ul class="reting_star ul_li">
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                        </ul>
                        <div class="item_price">
                          <span>$25.00</span>
                          <del>$35.00</del>
                        </div>
                        <ul class="cart_btns_group ul_li">
                          <li><a class="action_cart_btn" href="#!">Add to Cart</a></li>
                          <li><a href="#!"><i class="flaticon-heart"></i></a></li>
                        </ul>
                      </div>
                    </div>
                  </div>

                  <div class="carousel_item">
                    <div class="product_grid_2">
                      <a class="item_image" href="https://themepure.net/wp/repairon/product/apple-iphone-8-plus-64-gb-water-proof-used/">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shop/product_img_11.png" alt="Shop Image">
                      </a>
                      <div class="item_content">
                        <h3 class="item_title">
                          <a href="https://themepure.net/wp/repairon/product/apple-iphone-8-plus-64-gb-water-proof-used/">
                            Benq GR876 standard multifunction mouse
                          </a>
                        </h3>
                        <ul class="reting_star ul_li">
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                        </ul>
                        <div class="item_price">
                          <span>$25.00</span>
                          <del>$35.00</del>
                        </div>
                        <ul class="cart_btns_group ul_li">
                          <li><a class="action_cart_btn" href="#!">Add to Cart</a></li>
                          <li><a href="#!"><i class="flaticon-heart"></i></a></li>
                        </ul>
                      </div>
                    </div>

                    <div class="product_grid_2">
                      <a class="item_image" href="https://themepure.net/wp/repairon/product/apple-iphone-8-plus-64-gb-water-proof-used/">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shop/product_img_15.png" alt="Shop Image">
                      </a>
                      <div class="item_content">
                        <h3 class="item_title">
                          <a href="https://themepure.net/wp/repairon/product/apple-iphone-8-plus-64-gb-water-proof-used/">
                            Tp-link double antena best for home router
                          </a>
                        </h3>
                        <ul class="reting_star ul_li">
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                        </ul>
                        <div class="item_price">
                          <span>$25.00</span>
                        </div>
                        <ul class="cart_btns_group ul_li">
                          <li><a class="action_cart_btn" href="#!">Add to Cart</a></li>
                          <li><a href="#!"><i class="flaticon-heart"></i></a></li>
                        </ul>
                      </div>
                    </div>
                  </div>

                  <div class="carousel_item">
                    <div class="product_grid_2">
                      <a class="item_image" href="https://themepure.net/wp/repairon/product/apple-iphone-8-plus-64-gb-water-proof-used/">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shop/product_img_12.png" alt="Shop Image">
                      </a>
                      <div class="item_content">
                        <h3 class="item_title">
                          <a href="https://themepure.net/wp/repairon/product/apple-iphone-8-plus-64-gb-water-proof-used/">
                            Apacer AH353 Aluminum Alloy hard-drive
                          </a>
                        </h3>
                        <ul class="reting_star ul_li">
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                        </ul>
                        <div class="item_price">
                          <span>$25.00</span>
                        </div>
                        <ul class="cart_btns_group ul_li">
                          <li><a class="action_cart_btn" href="#!">Add to Cart</a></li>
                          <li><a href="#!"><i class="flaticon-heart"></i></a></li>
                        </ul>
                      </div>
                    </div>

                    <div class="product_grid_2">
                      <a class="item_image" href="https://themepure.net/wp/repairon/product/apple-iphone-8-plus-64-gb-water-proof-used/">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shop/product_img_16.png" alt="Shop Image">
                      </a>
                      <div class="item_content">
                        <h3 class="item_title">
                          <a href="https://themepure.net/wp/repairon/product/apple-iphone-8-plus-64-gb-water-proof-used/">
                            Benq gx750M Aluminum Alloy power supply
                          </a>
                        </h3>
                        <ul class="reting_star ul_li">
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                        </ul>
                        <div class="item_price">
                          <span>$25.00</span>
                          <del>$35.00</del>
                        </div>
                        <ul class="cart_btns_group ul_li">
                          <li><a class="action_cart_btn" href="#!">Add to Cart</a></li>
                          <li><a href="#!"><i class="flaticon-heart"></i></a></li>
                        </ul>
                      </div>
                    </div>
                  </div>

                  <div class="carousel_item">
                    <div class="product_grid_2">
                      <a class="item_image" href="https://themepure.net/wp/repairon/product/apple-iphone-8-plus-64-gb-water-proof-used/">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shop/product_img_9.png" alt="Shop Image">
                      </a>
                      <div class="item_content">
                        <h3 class="item_title">
                          <a href="https://themepure.net/wp/repairon/product/apple-iphone-8-plus-64-gb-water-proof-used/">
                            Sandisk AH353 Aluminum Alloy Pendrive
                          </a>
                        </h3>
                        <ul class="reting_star ul_li">
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                        </ul>
                        <div class="item_price">
                          <span>$25.00</span>
                          <del>$35.00</del>
                        </div>
                        <ul class="cart_btns_group ul_li">
                          <li><a class="action_cart_btn" href="#!">Add to Cart</a></li>
                          <li><a href="#!"><i class="flaticon-heart"></i></a></li>
                        </ul>
                      </div>
                    </div>

                    <div class="product_grid_2">
                      <a class="item_image" href="https://themepure.net/wp/repairon/product/apple-iphone-8-plus-64-gb-water-proof-used/">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shop/product_img_13.png" alt="Shop Image">
                      </a>
                      <div class="item_content">
                        <h3 class="item_title">
                          <a href="https://themepure.net/wp/repairon/product/apple-iphone-8-plus-64-gb-water-proof-used/">
                            Intel core-i5 10th gen processor
                          </a>
                        </h3>
                        <ul class="reting_star ul_li">
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                        </ul>
                        <div class="item_price">
                          <span>$25.00</span>
                        </div>
                        <ul class="cart_btns_group ul_li">
                          <li><a class="action_cart_btn" href="#!">Add to Cart</a></li>
                          <li><a href="#!"><i class="flaticon-heart"></i></a></li>
                        </ul>
                      </div>
                    </div>
                  </div>

                  <div class="carousel_item">
                    <div class="product_grid_2">
                      <a class="item_image" href="https://themepure.net/wp/repairon/product/apple-iphone-8-plus-64-gb-water-proof-used/">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shop/product_img_10.png" alt="Shop Image">
                      </a>
                      <div class="item_content">
                        <h3 class="item_title">
                          <a href="https://themepure.net/wp/repairon/product/apple-iphone-8-plus-64-gb-water-proof-used/">
                            Remax RP-W10 Infinite fast speed charger
                          </a>
                        </h3>
                        <ul class="reting_star ul_li">
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                        </ul>
                        <div class="item_price">
                          <span>$25.00</span>
                        </div>
                        <ul class="cart_btns_group ul_li">
                          <li><a class="action_cart_btn" href="#!">Add to Cart</a></li>
                          <li><a href="#!"><i class="flaticon-heart"></i></a></li>
                        </ul>
                      </div>
                    </div>

                    <div class="product_grid_2">
                      <a class="item_image" href="https://themepure.net/wp/repairon/product/apple-iphone-8-plus-64-gb-water-proof-used/">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shop/product_img_14.png" alt="Shop Image">
                      </a>
                      <div class="item_content">
                        <h3 class="item_title">
                          <a href="https://themepure.net/wp/repairon/product/apple-iphone-8-plus-64-gb-water-proof-used/">
                            Apacer AH353 standard multimedia keyboard
                          </a>
                        </h3>
                        <ul class="reting_star ul_li">
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                        </ul>
                        <div class="item_price">
                          <span>$25.00</span>
                          <del>$35.00</del>
                        </div>
                        <ul class="cart_btns_group ul_li">
                          <li><a class="action_cart_btn" href="#!">Add to Cart</a></li>
                          <li><a href="#!"><i class="flaticon-heart"></i></a></li>
                        </ul>
                      </div>
                    </div>
                  </div>

                  <div class="carousel_item">
                    <div class="product_grid_2">
                      <a class="item_image" href="https://themepure.net/wp/repairon/product/apple-iphone-8-plus-64-gb-water-proof-used/">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shop/product_img_11.png" alt="Shop Image">
                      </a>
                      <div class="item_content">
                        <h3 class="item_title">
                          <a href="https://themepure.net/wp/repairon/product/apple-iphone-8-plus-64-gb-water-proof-used/">
                            Benq GR876 standard multifunction mouse
                          </a>
                        </h3>
                        <ul class="reting_star ul_li">
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                        </ul>
                        <div class="item_price">
                          <span>$25.00</span>
                          <del>$35.00</del>
                        </div>
                        <ul class="cart_btns_group ul_li">
                          <li><a class="action_cart_btn" href="#!">Add to Cart</a></li>
                          <li><a href="#!"><i class="flaticon-heart"></i></a></li>
                        </ul>
                      </div>
                    </div>

                    <div class="product_grid_2">
                      <a class="item_image" href="https://themepure.net/wp/repairon/product/apple-iphone-8-plus-64-gb-water-proof-used/">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shop/product_img_15.png" alt="Shop Image">
                      </a>
                      <div class="item_content">
                        <h3 class="item_title">
                          <a href="https://themepure.net/wp/repairon/product/apple-iphone-8-plus-64-gb-water-proof-used/">
                            Tp-link double antena best for home router
                          </a>
                        </h3>
                        <ul class="reting_star ul_li">
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                        </ul>
                        <div class="item_price">
                          <span>$25.00</span>
                        </div>
                        <ul class="cart_btns_group ul_li">
                          <li><a class="action_cart_btn" href="#!">Add to Cart</a></li>
                          <li><a href="#!"><i class="flaticon-heart"></i></a></li>
                        </ul>
                      </div>
                    </div>
                  </div>

                  <div class="carousel_item">
                    <div class="product_grid_2">
                      <a class="item_image" href="https://themepure.net/wp/repairon/product/apple-iphone-8-plus-64-gb-water-proof-used/">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shop/product_img_12.png" alt="Shop Image">
                      </a>
                      <div class="item_content">
                        <h3 class="item_title">
                          <a href="https://themepure.net/wp/repairon/product/apple-iphone-8-plus-64-gb-water-proof-used/">
                            Apacer AH353 Aluminum Alloy hard-drive
                          </a>
                        </h3>
                        <ul class="reting_star ul_li">
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                        </ul>
                        <div class="item_price">
                          <span>$25.00</span>
                        </div>
                        <ul class="cart_btns_group ul_li">
                          <li><a class="action_cart_btn" href="#!">Add to Cart</a></li>
                          <li><a href="#!"><i class="flaticon-heart"></i></a></li>
                        </ul>
                      </div>
                    </div>

                    <div class="product_grid_2">
                      <a class="item_image" href="https://themepure.net/wp/repairon/product/apple-iphone-8-plus-64-gb-water-proof-used/">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shop/product_img_16.png" alt="Shop Image">
                      </a>
                      <div class="item_content">
                        <h3 class="item_title">
                          <a href="https://themepure.net/wp/repairon/product/apple-iphone-8-plus-64-gb-water-proof-used/">
                            Benq gx750M Aluminum Alloy power supply
                          </a>
                        </h3>
                        <ul class="reting_star ul_li">
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                        </ul>
                        <div class="item_price">
                          <span>$25.00</span>
                          <del>$35.00</del>
                        </div>
                        <ul class="cart_btns_group ul_li">
                          <li><a class="action_cart_btn" href="#!">Add to Cart</a></li>
                          <li><a href="#!"><i class="flaticon-heart"></i></a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="carousel_arrow">
                  <button type="button" class="cc4c_left_arrow"><i class="fal fa-angle-left"></i></button>
                  <button type="button" class="cc4c_right_arrow"><i class="fal fa-angle-right"></i></button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Product Section - End
        ================================================== -->
      


    <?php elseif ($settings['design_style'] === 'style_2'): 
        $this->add_inline_editing_attributes( 'title', 'basic' );
        $this->add_render_attribute( 'title', 'class', 'brand__title' );    
    ?>
      

    <!-- Blog Section - Start
        ================================================== -->
      <section class="blog_section home-inner pt-115 pb-90">
        <div class="container">

          <div class="section_title text-center">
            <div class="row justify-content-center">
              <div class="col col-lg-6">
                <h2 class="sub_title">Our Latest Blog</h2>
                <h3 class="title_text mb-0">
                  Read Latest Technology Blog Post
                </h3>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col col-lg-4 col-md-6 mb-30">
              <div class="blog_standard">
                <a class="item_image" href="https://themepure.net/wp/repairon/everything-you-want-to-know-about-creating-voice-user-interfaces-2/">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/blog/blog_img_1.jpg" alt="Blog Image">
                </a>
                <div class="item_content">
                  <ul class="post_meta ul_li">
                    <li><a href="#!"><i class="flaticon-user"></i> Repairon</a></li>
                    <li><a href="#!"><i class="far fa-comments"></i>02 Comments</a></li>
                    <li><i class="flaticon-calendar"></i> 25 Jan 2022</li>
                  </ul>
                  <h3 class="item_title">
                    <a href="https://themepure.net/wp/repairon/everything-you-want-to-know-about-creating-voice-user-interfaces-2/">
                      Don’t Underestimate The Software Administration UX
                    </a>
                  </h3>
                  <a class="btn_unfill" href="https://themepure.net/wp/repairon/everything-you-want-to-know-about-creating-voice-user-interfaces-2/">READ MORE <i class="far fa-plus"></i></a>
                </div>
              </div>
            </div>
            <div class="col col-lg-4 col-md-6 mb-30">
              <div class="blog_standard">
                <a class="item_image" href="https://themepure.net/wp/repairon/everything-you-want-to-know-about-creating-voice-user-interfaces-2/">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/blog/blog_img_2.jpg" alt="Blog Image">
                </a>
                <div class="item_content">
                  <ul class="post_meta ul_li">
                    <li><a href="#!"><i class="flaticon-user"></i> Repairon</a></li>
                    <li><a href="#!"><i class="far fa-comments"></i>03 Comments</a></li>
                    <li><i class="flaticon-calendar"></i> 26 Jan 2022</li>
                  </ul>
                  <h3 class="item_title">
                    <a href="https://themepure.net/wp/repairon/everything-you-want-to-know-about-creating-voice-user-interfaces-2/">             
                      Designing Better Tooltips For Mobile User Interfaces 
                    </a>
                  </h3>
                  <a class="btn_unfill" href="https://themepure.net/wp/repairon/everything-you-want-to-know-about-creating-voice-user-interfaces-2/">READ MORE <i class="far fa-plus"></i></a>
                </div>
              </div>
            </div>
            <div class="col col-lg-4 col-md-6">
              <div class="blog_standard">
                <a class="item_image" href="https://themepure.net/wp/repairon/everything-you-want-to-know-about-creating-voice-user-interfaces-2/">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/blog/blog_img_7.jpg" alt="Blog Image">
                </a>
                <div class="item_content">
                  <ul class="post_meta ul_li">
                    <li><a href="#!"><i class="flaticon-user"></i> Repairon</a></li>
                    <li><a href="#!"><i class="far fa-comments"></i>05 Comments</a></li>
                    <li><i class="flaticon-calendar"></i> 27 Jan 2022</li>
                  </ul>
                  <h3 class="item_title">
                    <a href="https://themepure.net/wp/repairon/everything-you-want-to-know-about-creating-voice-user-interfaces-2/">
                      Frustrating Design Patterns: Mega-Dropdown Menus 
                    </a>
                  </h3>
                  <a class="btn_unfill" href="https://themepure.net/wp/repairon/everything-you-want-to-know-about-creating-voice-user-interfaces-2/">READ MORE <i class="far fa-plus"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Blog Section - End
        ================================================== -->

     <div class="newsletter_area_1">
        <div class="container">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col col-lg-4">
              <div class="title_wrap">
                <h2 class="title_text text-white">Subscribe Us For Newsletter</h2>
                <p>
                  All the Lorem Ipsum generators on the Internet tend to repeat predefined the Newsletter
                </p>
              </div>
            </div>
            <div class="col col-lg-6">
              <form action="#">
                <div class="form_item mb-0">
                  <label for="newsletter_email"><i class="flaticon-email"></i></label>
                  <input id="newsletter_email" type="email" name="email" placeholder="Your email">
                  <button type="submit" class="btn btn_danger">Subscribe <i class="flaticon-paper-plane"></i></button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    <?php else:
        $this->add_inline_editing_attributes( 'title', 'basic' );
        $this->add_render_attribute( 'title', 'class', 'section__title' );
    ?>
  

    <!-- Banner Section - Start
        ================================================== -->
      <section class="banner_section banner_1 parallaxie"
        style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/img/backgrounds/bg_1.jpg);">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col col-lg-8 col-md-8 col-sm-10">
              <div class="banner_content text-center">
                <h1 class="text-white">
                  Best Car Repairing Service Center
                </h1>
                <a class="btn btn_danger" href="https://themepure.net/wp/repairon/about/">Read More Us</a>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Banner Section - End
        ================================================== -->

      <!-- Advance Section - Start
        ================================================== -->
      <div class="advance_search_section advance_search_1">
        <div class="container">
          <form action="#">
            <div class="search_form">
              <div class="row">
                <div class="col col-lg-3 col-md-4 col-sm-6">
                  <div class="form_item">
                    <input type="text" name="name" placeholder="Your Name">
                  </div>
                </div>
                <div class="col col-lg-3 col-md-4 col-sm-6">
                  <div class="form_item">
                    <input type="tel" name="phone" placeholder="Phone">
                  </div>
                </div>
                <div class="col col-lg-3 col-md-4 col-sm-6">
                  <div class="form_item">
                    <input type="email" name="email" placeholder="Email">
                  </div>
                </div>
                <div class="col col-lg-3 col-md-4 col-sm-6">
                  <div class="form_item">
                    <input type="text" name="location" placeholder="Location">
                  </div>
                </div>

                <div class="col col-lg-3 col-md-4 col-sm-6">
                  <div class="select_option clearfix">
                    <select>
                      <option data-display="Select Brand">Select Your Option</option>
                      <option value="1">BMW</option>
                      <option value="2">Toyota</option>
                      <option value="3" disabled>Mitsubishi</option>
                      <option value="4">Honda</option>
                    </select>
                  </div>
                </div>
                <div class="col col-lg-3 col-md-4 col-sm-6">
                  <div class="select_option clearfix">
                    <select>
                      <option data-display="Select Model">Select Your Option</option>
                      <option value="1">BMW 228i 4-Door Coupe</option>
                      <option value="2">Toyota C-HR Consumer</option>
                      <option value="3" disabled>Mitsubishi Triton / L200</option>
                      <option value="4">Honda Accord</option>
                    </select>
                  </div>
                </div>
                <div class="col col-lg-3 col-md-4 col-sm-6">
                  <div class="form_item">
                    <input type="text" name="comment" placeholder="Problem">
                  </div>
                </div>
                <div class="col col-lg-3 col-md-4 col-sm-6">
                  <button type="submit" class="btn btn_secondary">Send Messages</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <!-- Advance Section - End
        ================================================== -->

      <!-- Washing Section - Start
        ================================================== -->
      <section class="washing_section pt-120 pb-0 fix">
        <div class="container">
          <div class="row align-items-center">
            <div class="col order-last col-lg-6">
              <div class="washing_image">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/washing/washing_img_1.png" alt="Car Washing Image">
              </div>
            </div>

            <div class="col col-lg-6">
              <div class="washing_content">
                <div class="section_title">
                  <h2 class="sub_title">Washing And Clinging</h2>
                  <h3 class="title_text">
                    Neat & Cleaning Any Dirt Inside The Vehicles
                  </h3>
                  <p>
                    All kinds of laptop, desktop computer servicing center forIt is a long established fact that a
                    reader will be distracted by the readable computer disk. Lorem ipsum dolor sit amet, consectetur
                    adipiscing elit. Ut elit tellus, luctus nec
                  </p>
                </div>
                <blockquote>
                  Professional Car Dashing & Detailing: Serving Car Care and Some Steps of Detailing, For Beginners
                  Guide.
                </blockquote>
                <div class="row align-items-center">
                  <div class="col col-lg-5 col-md-3">
                    <a class="btn btn_danger" href="https://themepure.net/wp/repairon/contact/">Get Estimated</a>
                  </div>
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
                      <div class="content_wrap">
                        <h4 class="item_title">Send Request</h4>
                        <span class="hotline_number"><a href="tel:+31054848846">+31 054 848 846</a></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Washing Section - End
        ================================================== -->

      <!-- Policy Section - Start
        ================================================== -->
      <section class="policy_section pt-125 pb-135">
        <div class="container">
          <div class="policy_wrap">
            <div class="policy_item">
              <div class="item_icon">
                <i class="flaticon-support"></i>
              </div>
              <h3 class="item_title">Repairing Service</h3>
            </div>

            <div class="policy_item">
              <div class="item_icon">
                <i class="flaticon-sales"></i>
              </div>
              <h3 class="item_title">Accessories Sales</h3>
            </div>

            <div class="policy_item">
              <div class="item_icon">
                <i class="flaticon-customer-support"></i>
              </div>
              <h3 class="item_title">Customer Support</h3>
            </div>

            <div class="policy_item">
              <div class="item_icon">
                <i class="flaticon-protection-shield-with-a-check-mark"></i>
              </div>
              <h3 class="item_title">Save and trust</h3>
            </div>
          </div>
        </div>
      </section>
      <!-- Policy Section - End
        ================================================== -->

      <!-- Service Section - Start
        ================================================== -->
      <section class="service_section_1 pt-115 pb-120 decoration_wrap parallaxie"
        style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/img/backgrounds/bg_2.jpg);">
        <div class="overlay" data-bg-color="#000323"></div>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col col-lg-5">
              <div class="section_title text-center">
                <h2 class="sub_title">Main Services</h2>
                <h3 class="title_text mb-0 text-white">
                  Our Featured Services For You
                </h3>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col col-lg-4 col-md-6 col-sm-6">
              <div class="service_card_layout">
                <div class="item_image">
                  <a class="image_wrap" href="https://themepure.net/wp/repairon/service-details/">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/service/service_img_1.jpg" alt="Service Image">
                  </a>
                  <div class="price_wrap">
                    <span>STRAT FROM</span>
                    <strong>$55.00</strong>
                  </div>
                </div>
                <div class="item_content">
                  <a href="https://themepure.net/wp/repairon/service-details/">
                    <h4 class="item_title">Tire Changing</h4>
                  </a>
                  <ul class="item_info ul_li">
                    <li>Super Gear</li>
                    <li>Gear Box</li>
                    <li>Engine Repair</li>
                    <li>Trunk Repair</li>
                    <li>Oil Control</li>
                    <li>Diagnosis</li>
                  </ul>
                </div>
              </div>
            </div>

            <div class="col col-lg-4 col-md-6 col-sm-6">
              <div class="service_card_layout">
                <div class="item_image">
                  <a class="image_wrap" href="https://themepure.net/wp/repairon/service-details/">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/service/service_img_2.jpg" alt="Service Image">
                  </a>
                  <div class="price_wrap">
                    <span>STRAT FROM</span>
                    <strong>$85.00</strong>
                  </div>
                </div>
                <div class="item_content">
                  <a href="https://themepure.net/wp/repairon/service-details/">
                  <h4 class="item_title">Oil Changing</h4>
                  </a>
                  <ul class="item_info ul_li">
                    <li>Super Gear</li>
                    <li>Gear Box</li>
                    <li>Engine Repair</li>
                    <li>Trunk Repair</li>
                    <li>Oil Control</li>
                    <li>Diagnosis</li>
                  </ul>
                </div>
              </div>
            </div>

            <div class="col col-lg-4 col-md-6 col-sm-6">
              <div class="service_card_layout">
                <div class="item_image">
                  <a class="image_wrap" href="https://themepure.net/wp/repairon/service-details/">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/service/service_img_3.jpg" alt="Service Image">
                  </a>
                  <div class="price_wrap">
                    <span>STRAT FROM</span>
                    <strong>$65.00</strong>
                  </div>
                </div>
                <div class="item_content">
                  <a href="https://themepure.net/wp/repairon/service-details/">
                  <h4 class="item_title">Car Diagnosis</h4>
                  </a>
                  <ul class="item_info ul_li">
                    <li>Super Gear</li>
                    <li>Gear Box</li>
                    <li>Engine Repair</li>
                    <li>Trunk Repair</li>
                    <li>Oil Control</li>
                    <li>Diagnosis</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Service Section - End
        ================================================== -->

      <!-- Package Section - Start
        ================================================== -->
      <section class="package_section pt-115 pb-120 bg_gray">
        <div class="container">
          <div class="row">
            <div class="col col-lg-6">
              <div class="section_title">
                <h2 class="sub_title">Package Comparison</h2>
                <h3 class="title_text mb-0">
                  Our Packaging Services For Repair
                </h3>
              </div>
            </div>
          </div>
          <div class="service_package_carousel arrow_top_right">
            <div class="row common_carousel_1col" data-slick='{"dots": false}'>
              <div class="col carousel_item">
                <div class="service_package_item">
                  <div class="image_wrap">
                    <div class="beforeAfter">
                      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/before.jpg" alt="example-img" />
                      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/after.jpg" alt="example-img" />
                    </div>
                  </div>
                  <div class="content_wrap">
                    <div class="item_price"><span>$85.00</span> <del>$100.00</del></div>
                    <h3 class="item_title">
                      Neat & Cleaning Any Dirt Inside The Vehicles
                    </h3>
                    <span class="post_date"><i class="far fa-clock"></i> 01: 25 Min</span>
                    <ul class="info_list ul_li_block">
                      <li><i class="fas fa-check-square"></i> Easy to Edit & Repair</li>
                      <li><i class="fas fa-check-square"></i> Auto mobile Workshop For Garaz</li>
                      <li><i class="fas fa-check-square"></i> Maintenance & Repair Guide</li>
                      <li><i class="fas fa-check-square"></i> Estimated Repair Costs</li>
                    </ul>
                    <a class="btn btn_danger" href="https://themepure.net/wp/repairon/contact/">Repair Now</a>
                  </div>
                </div>
              </div>
              <div class="col carousel_item">
                <div class="service_package_item">
                  <div class="image_wrap">
                    <div class="beforeAfter">
                      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/before.jpg" alt="example-img" />
                      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/after.jpg" alt="example-img" />
                    </div>
                  </div>
                  <div class="content_wrap">
                    <div class="item_price"><span>$85.00</span> <del>$100.00</del></div>
                    <h3 class="item_title">
                      Neat & Cleaning Any Dirt Inside The Vehicles
                    </h3>
                    <span class="post_date"><i class="far fa-clock"></i> 01: 25 Min</span>
                    <ul class="info_list ul_li_block">
                      <li><i class="fas fa-check-square"></i> Easy to Edit & Repair</li>
                      <li><i class="fas fa-check-square"></i> Auto mobile Workshop For Garaz</li>
                      <li><i class="fas fa-check-square"></i> Maintenance & Repair Guide</li>
                      <li><i class="fas fa-check-square"></i> Estimated Repair Costs</li>
                    </ul>
                    <a class="btn btn_danger" href="https://themepure.net/wp/repairon/contact/">Repair Now</a>
                  </div>
                </div>
              </div>
              <div class="col carousel_item">
                <div class="service_package_item">
                  <div class="image_wrap">
                    <div class="beforeAfter">
                      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/before.jpg" alt="example-img" />
                      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/after.jpg" alt="example-img" />
                    </div>
                  </div>
                  <div class="content_wrap">
                    <div class="item_price"><span>$85.00</span> <del>$100.00</del></div>
                    <h3 class="item_title">
                      Neat & Cleaning Any Dirt Inside The Vehicles
                    </h3>
                    <span class="post_date"><i class="far fa-clock"></i> 01: 25 Min</span>
                    <ul class="info_list ul_li_block">
                      <li><i class="fas fa-check-square"></i> Easy to Edit & Repair</li>
                      <li><i class="fas fa-check-square"></i> Auto mobile Workshop For Garaz</li>
                      <li><i class="fas fa-check-square"></i> Maintenance & Repair Guide</li>
                      <li><i class="fas fa-check-square"></i> Estimated Repair Costs</li>
                    </ul>
                    <a class="btn btn_danger" href="https://themepure.net/wp/repairon/contact/">Repair Now</a>
                  </div>
                </div>
              </div>
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

      <!-- Service Tab Section - Start
        ================================================== -->
      <section class="service_tab_section">
        <div class="service_tab_nav">
          <div class="container">
            <ul class="ul_li_center nav" role="tablist">
              <li>
                <button class="active" data-bs-toggle="tab" data-bs-target="#advance_service_tab" type="button"
                  role="tab" aria-selected="true">
                  <i class="flaticon-support"></i>
                  <span>Advance Service</span>
                </button>
              </li>
              <li>
                <button data-bs-toggle="tab" data-bs-target="#about_company_tab" type="button" role="tab"
                  aria-selected="false">
                  <i class="flaticon-building"></i>
                  <span>About Company</span>
                </button>
              </li>
              <li>
                <button data-bs-toggle="tab" data-bs-target="#chooseus_tab" type="button" role="tab"
                  aria-selected="false">
                  <i class="flaticon-fair-trade"></i>
                  <span>Why Choose Us</span>
                </button>
              </li>
              <li>
                <button data-bs-toggle="tab" data-bs-target="#howwework_tab" type="button" role="tab"
                  aria-selected="false">
                  <i class="flaticon-car-repair"></i>
                  <span>How We Work</span>
                </button>
              </li>
            </ul>
          </div>
        </div>
        <div class="container">
          <div class="tab-content">
            <div class="tab-pane fade show active" id="advance_service_tab" role="tabpanel">
              <div class="service_tab_content">
                <h5 class="outline_text">Advance Service</h5>
                <div class="row">
                  <div class="col order-last col-lg-5">
                    <div class="image_wrap">
                      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/service/service_img_4.jpg" alt="Car Reparing Image">
                    </div>
                  </div>
                  <div class="col col-lg-7">
                    <h3 class="heading_text">
                      We Brought Easy Advance Services For You
                    </h3>
                    <div class="info_list">
                      <div class="row">
                        <div class="col col-lg-6">
                          <ul class="ul_li_block">
                            <li><i class="fal fa-check-square"></i> FREE Loaner Cars</li>
                            <li><i class="fal fa-check-square"></i> General Auto Repair & Maintenance</li>
                            <li><i class="fal fa-check-square"></i> Transmission Repair & Replacement</li>
                            <li><i class="fal fa-check-square"></i> Fuel System Repair</li>
                            <li><i class="fal fa-check-square"></i> Exhaust System Repair</li>
                            <li><i class="fal fa-check-square"></i> FREE Shuttle Service</li>
                            <li><i class="fal fa-check-square"></i> Engine Cooling System Maintenance</li>
                          </ul>
                        </div>
                        <div class="col col-lg-6">
                          <ul class="ul_li_block">
                            <li><i class="fal fa-check-square"></i> Manufacturer Recommended Service</li>
                            <li><i class="fal fa-check-square"></i> Brake Repair and Replacement</li>
                            <li><i class="fal fa-check-square"></i> Air Conditioning A/C Repair</li>
                            <li><i class="fal fa-check-square"></i> Tire Repair and Replacement</li>
                            <li><i class="fal fa-check-square"></i> Vehicle Preventative Maintenance</li>
                            <li><i class="fal fa-check-square"></i> State Emissions Inspection</li>
                            <li><i class="fal fa-check-square"></i> Emission Repair Facility</li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane fade" id="about_company_tab" role="tabpanel">
              <div class="service_tab_content">
                <h5 class="outline_text text-start">About US</h5>
                <div class="row">
                  <div class="col order-last col-lg-6">
                    <div class="image_wrap">
                      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/service/service_img_6.png" alt="Car Image">
                    </div>
                  </div>
                  <div class="col col-lg-6">
                    <h3 class="heading_text">
                      About Repairon
                    </h3>
                    <p>
                      There are many variations of passages of Lorem Ipsum available, but the majority have suffered
                      alteration in some form, by injected humour, All the Lorem Ipsum generators on the Internet tend
                      to repeat predefined.
                    </p>
                    <div class="info_list">
                      <div class="row">
                        <div class="col col-lg-6">
                          <div class="certified_badge">
                            <div class="item_icon">
                              <i class="flaticon-star-1"></i>
                            </div>
                            <div class="item_content">
                              <h4 class="item_title text-white">Certified</h4>
                              <p class="mb-0">Vehicles Repair Center</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="single_btn_wrap">
                      <a class="btn btn_danger" href="https://themepure.net/wp/repairon/contact/">Send a Request</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane fade" id="chooseus_tab" role="tabpanel">
              <div class="service_tab_content">
                <h5 class="outline_text">WHY CHOOSE US</h5>
                <div class="row">
                  <div class="col order-last col-lg-5">
                    <div class="image_wrap image_2">
                      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/service/service_img_5.png" alt="Car Reparing Image">
                    </div>
                  </div>
                  <div class="col col-lg-7">
                    <h3 class="heading_text mb-0">
                      We Give You the Quality Guarantee
                    </h3>
                    <div class="row">
                      <div class="col col-lg-6">
                        <div class="policy_item_2">
                          <div class="item_icon">
                            <i class="flaticon-skills"></i>
                          </div>
                          <div class="item_content">
                            <h3 class="item_title text-white">Skilled Technicians</h3>
                            <p class="mb-0">
                              Vehicle Repair on the Spot in the Store or at Home/Office
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col col-lg-6">
                        <div class="policy_item_2">
                          <div class="item_icon">
                            <i class="flaticon-chemical-reaction"></i>
                          </div>
                          <div class="item_content">
                            <h3 class="item_title text-white">10+ Years Experiences</h3>
                            <p class="mb-0">
                              Vehicle Repair on the Spot in the Store or at Home/Office
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col col-lg-6">
                        <div class="policy_item_2">
                          <div class="item_icon">
                            <i class="flaticon-padlock"></i>
                          </div>
                          <div class="item_content">
                            <h3 class="item_title text-white">Quality Guarantee</h3>
                            <p class="mb-0">
                              Vehicle Repair on the Spot in the Store or at Home/Office
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col col-lg-6">
                        <div class="policy_item_2">
                          <div class="item_icon">
                            <i class="flaticon-holding-hands"></i>
                          </div>
                          <div class="item_content">
                            <h3 class="item_title text-white">Trusted & Recommended</h3>
                            <p class="mb-0">
                              Vehicle Repair on the Spot in the Store or at Home/Office
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane fade" id="howwework_tab" role="tabpanel">
              <div class="service_tab_content pb-0">
                <h5 class="outline_text">How We Work</h5>
                <div class="row justify-content-center">
                  <div class="col col-lg-3 col-md-4 col-sm-6">
                    <div class="work_process_item">
                      <div class="item_icon" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/icons/serial_no_1.png');">
                        <i class="flaticon-appointment"></i>
                      </div>
                      <h3 class="item_ttile text-white">Appointment</h3>
                      <p class="mb-0">
                        Vehicle Repair on the Spot in the Store or at Home/Office
                      </p>
                    </div>
                  </div>
                  <div class="col col-lg-3 col-md-4 col-sm-6">
                    <div class="work_process_item">
                      <div class="item_icon" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/icons/serial_no_2.png');">
                        <i class="flaticon-eye-scan"></i>
                      </div>
                      <h3 class="item_ttile text-white">Problem Identify</h3>
                      <p class="mb-0">
                        Vehicle Repair on the Spot in the Store or at Home/Office
                      </p>
                    </div>
                  </div>
                  <div class="col col-lg-3 col-md-4 col-sm-6">
                    <div class="work_process_item">
                      <div class="item_icon" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/icons/serial_no_3.png');">
                        <i class="flaticon-project-management"></i>
                      </div>
                      <h3 class="item_ttile text-white">Clear Conception</h3>
                      <p class="mb-0">
                        Vehicle Repair on the Spot in the Store or at Home/Office
                      </p>
                    </div>
                  </div>
                  <div class="col col-lg-3 col-md-4 col-sm-6">
                    <div class="work_process_item">
                      <div class="item_icon" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/icons/serial_no_4.png');">
                        <i class="flaticon-problem-solving"></i>
                      </div>
                      <h3 class="item_ttile text-white">Solving Problem</h3>
                      <p class="mb-0">
                        Vehicle Repair on the Spot in the Store or at Home/Office
                      </p>
                    </div>
                  </div>
                </div>
                <div class="play_btn_wrap text-center"
                  style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/shapes/shape_1.png');">
                  <a class="popup_video" href="http://www.youtube.com/watch?v=0O2aH4XLbto">
                    <i class="fas fa-play"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Service Tab Section - End
        ================================================== -->

      <!-- Counter Section - Start
        ================================================== -->
      <section class="counter_section_1 pt-125 pb-120">
        <div class="container">
          <div class="counter_items_wrap">
            <div class="counter_item">
              <div class="item_icon">
                <i class="flaticon-support"></i>
              </div>
              <div class="counter_text"><span class="counter">1200</span>+</div>
              <h3 class="item_title">Repairing Cases Solved</h3>
            </div>

            <div class="counter_item">
              <div class="item_icon">
                <i class="flaticon-customer-satisfaction"></i>
              </div>
              <div class="counter_text"><span class="counter">500</span>+</div>
              <h3 class="item_title">Happy Customers</h3>
            </div>

            <div class="counter_item">
              <div class="item_icon">
                <i class="flaticon-businessman"></i>
              </div>
              <div class="counter_text"><span class="counter">25</span></div>
              <h3 class="item_title">Experienced Engineers</h3>
            </div>

            <div class="counter_item">
              <div class="item_icon">
                <i class="flaticon-star-1"></i>
              </div>
              <div class="counter_text"><span class="counter">99</span>%</div>
              <h3 class="item_title">Successful Ratings</h3>
            </div>
          </div>
        </div>
      </section>
      <!-- Counter Section - End
        ================================================== -->

      <!-- Testimonial Section - Start
        ================================================== -->
      <section class="testimonial_section pt-115 pb-115 decoration_wrap" data-bg-color="#000323"
        style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/backgrounds/pattern.png');">
        <div class="overlay" data-bg-color="#000323"></div>
        <div class="container">

          <div class="row justify-content-center">
            <div class="col col-lg-8">
              <div class="section_title text-center">
                <h2 class="sub_title">Testimonials</h2>
                <h3 class="title_text mb-0 text-white d-lg-flex">
                  <span>Some Feedback From Our Happy Clients.</span>
                </h3>
              </div>
            </div>
          </div>

          <div class="testimonial_carousel_1 arrow_right_left">
            <div class="row justify-content-center">
              <div class="col col-lg-8">
                <div class="testimonial_carousel row" data-slick='{"dots": false}'>
                  <div class="col carousel_item">
                    <div class="testimonial_item text-center">
                      <div class="testimonial_thumbnail">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/meta/thumbnail_1.png" alt="Person Image">
                         <div class="testimonial_quote_item">
                             <span><i class="fas fa-quote-right"></i></span>
                         </div>
                      </div>
                      <p>
                        Nullam lectus neque, blandit quis, mattis quis, varius eudvs. Proin leo quisque est quam iacus
                        sed pretium ac fringilla ultricies nibh. Cumdsun socidis natoque penatibus et magnis lefdis
                        parturent montes nascetursed ipsum ridiculus. Consectetur adipisicing elit sed quisque est quam
                        eiusmod.
                      </p>
                      <h4 class="hero_name text-white">Nirob Shen Aronno</h4>
                      <h5 class="hero_title text-white">CEO, Codexpand</h5>
                      <ul class="reting_star ul_li_center">
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                      </ul>
                    </div>
                  </div>

                  <div class="col carousel_item">
                    <div class="testimonial_item text-center">
                      <div class="testimonial_thumbnail">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/meta/thumbnail_4.png" alt="Person Image">
                        <div class="testimonial_quote_item">
                             <span><i class="fas fa-quote-right"></i></span>
                         </div>
                      </div>
                      <p>
                        Nullam lectus neque, blandit quis, mattis quis, varius eudvs. Proin leo quisque est quam iacus
                        sed pretium ac fringilla ultricies nibh. Cumdsun socidis natoque penatibus et magnis lefdis
                        parturent montes nascetursed ipsum ridiculus. Consectetur adipisicing elit sed quisque est quam
                        eiusmod.
                      </p>
                      <h4 class="hero_name text-white">Daniel Brown Costa</h4>
                      <h5 class="hero_title text-white">Manager, Probidya</h5>
                      <ul class="reting_star ul_li_center">
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                      </ul>
                    </div>
                  </div>

                  <div class="col carousel_item">
                    <div class="testimonial_item text-center">
                      <div class="testimonial_thumbnail">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/meta/thumbnail_1.png" alt="Person Image">
                        <div class="testimonial_quote_item">
                             <span><i class="fas fa-quote-right"></i></span>
                         </div>
                      </div>
                      <p>
                        Nullam lectus neque, blandit quis, mattis quis, varius eudvs. Proin leo quisque est quam iacus
                        sed pretium ac fringilla ultricies nibh. Cumdsun socidis natoque penatibus et magnis lefdis
                        parturent montes nascetursed ipsum ridiculus. Consectetur adipisicing elit sed quisque est quam
                        eiusmod.
                      </p>
                      <h4 class="hero_name text-white">Nirob Shen Aronno</h4>
                      <h5 class="hero_title text-white">CEO, Codexpand</h5>
                      <ul class="reting_star ul_li_center">
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                      </ul>
                    </div>
                  </div>

                  <div class="col carousel_item">
                    <div class="testimonial_item text-center">
                      <div class="testimonial_thumbnail">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/meta/thumbnail_4.png" alt="Person Image">
                        <div class="testimonial_quote_item">
                             <span><i class="fas fa-quote-right"></i></span>
                         </div>
                      </div>
                      <p>
                        Nullam lectus neque, blandit quis, mattis quis, varius eudvs. Proin leo quisque est quam iacus
                        sed pretium ac fringilla ultricies nibh. Cumdsun socidis natoque penatibus et magnis lefdis
                        parturent montes nascetursed ipsum ridiculus. Consectetur adipisicing elit sed quisque est quam
                        eiusmod.
                      </p>
                      <h4 class="hero_name text-white">Daniel Brown Costa</h4>
                      <h5 class="hero_title text-white">Manager, Probidya</h5>
                      <ul class="reting_star ul_li_center">
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                        <li class="active"><i class="flaticon-star"></i></li>
                      </ul>
                    </div>
                  </div>

                </div>
              </div>
            </div>
            <div class="carousel_arrow">
              <button type="button" class="tc_left_arrow"><i class="fal fa-angle-left"></i></button>
              <button type="button" class="tc_right_arrow"><i class="fal fa-angle-right"></i></button>
            </div>
          </div>

        </div>
      </section>
      <!-- Testimonial Section - End
        ================================================== -->
    <?php endif; ?>

        <?php
    }
}   