<?php

namespace BdevsElement\Widget;

use Elementor\Core\Schemes\Typography;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;

defined('ABSPATH') || die();

class LearnPress_Course_Tab extends BDevs_El_Widget
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
        return 'learnpress_course_tab';
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
        return __('LearnPress Course Tab', 'bdevs-element');
    }

    public function get_custom_help_url()
    {
        return 'http://elementor.bdevs.net//widgets/post-tab/';
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
        return ['posts', 'post', 'post-tab', 'tab', 'Learnpress'];
    }

    /**
     * Get a list of All Post Types
     *
     * @return array
     */
    public static function get_post_types()
    {
        $diff_key = [
            'elementor_library' => '',
            'attachment' => '',
            'page' => '',
        ];
        $post_types = bdevs_element_get_post_types([], $diff_key);
        return $post_types;
    }

    /**
     * Get a list of Taxonomy
     *
     * @return array
     */
    public static function get_taxonomies($post_type = '')
    {
        $list = [];
        if ($post_type) {
            $tax = bdevs_element_get_taxonomies(['public' => true, "object_type" => [$post_type]], 'object', true);
            $list[$post_type] = count($tax) !== 0 ? $tax : '';
        } else {
            $list = bdevs_element_get_taxonomies(['public' => true], 'object', true);
        }
        return $list;
    }

    protected function register_content_controls()
    {
        // Title & Description
        $this->start_controls_section(
            '_section_title',
            [
                'label' => __('Title & Description', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'bdevs-element'),
                'label_block' => true,
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 4,
                'default' => 'Heading Title',
                'placeholder' => __('Heading Text', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' => __('Sub Title', 'bdevs-element'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => 'Heading Sub Title',
                'placeholder' => __('Heading Sub Text', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __('Description', 'bdevs-element'),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => __('Heading Description Text', 'bdevs-element'),
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


        // Query

        $this->start_controls_section(
            '_section_post_tab_query',
            [
                'label' => __('Query', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'post_type',
            [
                'label' => __('Source', 'bdevs-element'),
                'type' => Controls_Manager::SELECT,
                'options' => $this->get_post_types(),
                'default' => key($this->get_post_types()),
            ]
        );

        foreach (self::get_post_types() as $key => $value) {
            $taxonomy = self::get_taxonomies($key);
            if (!$taxonomy[$key]) {
                continue;
            }

            $this->add_control(
                'tax_type_' . $key,
                [
                    'label' => __('Taxonomies', 'bdevs-element'),
                    'type' => Controls_Manager::SELECT,
                    'options' => $taxonomy[$key],
                    'default' => key($taxonomy[$key]),
                    'condition' => [
                        'post_type' => $key,
                    ],
                ]
            );

            foreach ($taxonomy[$key] as $tax_key => $tax_value) {

                $this->add_control(
                    'tax_ids_' . $tax_key,
                    [
                        'label' => __('Select ', 'bdevs-element') . $tax_value,
                        'label_block' => true,
                        'type' => 'bdevselement-select2',
                        'multiple' => true,
                        'placeholder' => 'Search ' . $tax_value,
                        'data_options' => [
                            'tax_id' => $tax_key,
                            'action' => 'bdevs_element_post_tab_select_query',
                        ],
                        'condition' => [
                            'post_type' => $key,
                            'tax_type_' . $key => $tax_key,
                        ],
                        'render_type' => 'template',
                    ]
                );
            }
        }

        $this->add_control(
            'item_limit',
            [
                'label' => __('Item Limit', 'bdevs-element'),
                'type' => Controls_Manager::NUMBER,
                'default' => 3,
                'dynamic' => ['active' => true],
            ]
        );

        $this->end_controls_section();

        //Settings
        $this->start_controls_section(
            '_section_settings',
            [
                'label' => __('Settings', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'column',
            [
                'label' => __('Column', 'bdevs-element'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => __('1 Column', 'bdevs-element'),
                    '2' => __('2 Column', 'bdevs-element'),
                    '3' => __('3 Column', 'bdevs-element'),
                    '4' => __('4 Column', 'bdevs-element'),
                    '5' => __('5 Column', 'bdevs-element'),
                    '6' => __('6 Column', 'bdevs-element'),
                ],
                'render_type' => 'template',
                'default' => '3',
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'excerpt',
            [
                'label' => __('Show Excerpt', 'bdevs-element'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevs-element'),
                'label_off' => __('Hide', 'bdevs-element'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_control(
            'read_more',
            [
                'label' => __('Button Switch', 'bdevs-element'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevs-element'),
                'label_off' => __('Hide', 'bdevs-element'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_control(
            'read_more_text',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __('Button Text', 'bdevs-element'),
                'default' => __('Know Details', 'bdevs-element'),
                'placeholder' => __('Type text here', 'bdevs-element'),
                'condition' => [
                    'read_more' => 'yes'
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'read_more_icon',
            [
                'label' => __('Read More Icon', 'bdevs-element'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'far fa-arrow-right',
                    'library' => 'reguler',
                ],
                'condition' => [
                    'read_more' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'feature_image',
            [
                'label' => __('Featured Image', 'bdevs-element'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevs-element'),
                'label_off' => __('Hide', 'bdevs-element'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'post_image',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ],
                'condition' => [
                    'feature_image' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'content',
            [
                'label' => __('Content', 'bdevs-element'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevs-element'),
                'label_off' => __('Hide', 'bdevs-element'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_control(
            'content_limit',
            [
                'label' => __('Content Limit', 'bdevs-element'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '14',
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'content' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'author_switch',
            [
                'label' => __('Author Switch', 'bdevs-element'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevs-element'),
                'label_off' => __('Hide', 'bdevs-element'),
                'return_value' => 'yes',
                'default' => '',
            ]
        ); 

        $this->add_control(
            'lession_switch',
            [
                'label' => __('Lession Switch', 'bdevs-element'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevs-element'),
                'label_off' => __('Hide', 'bdevs-element'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );        

        $this->add_control(
            'rating_switch',
            [
                'label' => __('Rating Switch', 'bdevs-element'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevs-element'),
                'label_off' => __('Hide', 'bdevs-element'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->end_controls_section();
    }

    protected function register_style_controls()
    {

        $this->start_controls_section(
            '_section_style_title',
            [
                'label' => __('Title & Desccription', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            '_heading_title',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __('Title', 'bdevs-element'),
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'heading_margin',
            [
                'label' => __('Margin', 'bdevs-element'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .section-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_padding',
            [
                'label' => __('Padding', 'bdevs-element'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .section-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title',
                'selector' => '{{WRAPPER}} .section-title',
                'scheme' => Typography::TYPOGRAPHY_1,
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'title',
                'label' => __('Text Shadow', 'bdevs-element'),
                'selector' => '{{WRAPPER}} .section-title',
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label' => __('Text Color', 'bdevs-element'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .section-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'back_heading_color',
            [
                'label' => __('Back Text Color', 'bdevs-element'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .text-border-title1' => '-webkit-text-stroke-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'blend_mode',
            [
                'label' => __('Blend Mode', 'bdevs-element'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => __('Normal', 'bdevs-element'),
                    'multiply' => 'Multiply',
                    'screen' => 'Screen',
                    'overlay' => 'Overlay',
                    'darken' => 'Darken',
                    'lighten' => 'Lighten',
                    'color-dodge' => 'Color Dodge',
                    'saturation' => 'Saturation',
                    'color' => 'Color',
                    'difference' => 'Difference',
                    'exclusion' => 'Exclusion',
                    'hue' => 'Hue',
                    'luminosity' => 'Luminosity',
                ],
                'selectors' => [
                    '{{WRAPPER}} .section-title' => 'mix-blend-mode: {{VALUE}};',
                ],
                'separator' => 'none',
            ]
        );

        // subtitle
        $this->add_control(
            '_heading_subtitle',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __('Sub Title', 'bdevs-element'),
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'heading_subtitle_margin',
            [
                'label' => __('Margin', 'bdevs-element'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_subtitle_padding',
            [
                'label' => __('Padding', 'bdevs-element'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .sub-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle',
                'selector' => '{{WRAPPER}} .sub-title',
                'scheme' => Typography::TYPOGRAPHY_2,
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'subtitle',
                'label' => __('Text Shadow', 'bdevs-element'),
                'selector' => '{{WRAPPER}} .sub-title',
            ]
        );

        $this->add_control(
            'heading_subtitle_color',
            [
                'label' => __('Text Color', 'bdevs-element'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .sub-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        // content

        $this->add_control(
            '_heading_description',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __('Content', 'bdevs-element'),
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'heading_desc_margin',
            [
                'label' => __('Margin', 'bdevs-element'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .section-heading p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_desc_padding',
            [
                'label' => __('Padding', 'bdevs-element'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .section-heading p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'desccription',
                'selector' => '{{WRAPPER}} .section-heading p',
                'scheme' => Typography::TYPOGRAPHY_3,
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'desccription',
                'label' => __('Text Shadow', 'bdevs-element'),
                'selector' => '{{WRAPPER}} .section-heading p',
            ]
        );

        $this->add_control(
            'heading_desc_color',
            [
                'label' => __('Text Color', 'bdevs-element'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .section-heading p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_post_tab_filter',
            [
                'label' => __('Tab', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'tab_line_color',
            [
                'label' => __('Tab Line BG', 'bdevs-element'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .project-filter-box::before' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'tab_box_color',
            [
                'label' => __('Tab Box BG', 'bdevs-element'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .project-filter-box' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_margin_btm',
            [
                'label' => __('Margin Bottom', 'bdevs-element'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .project-filter-box' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'filter_pos' => 'top',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_padding',
            [
                'label' => __('Padding', 'bdevs-element'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .project-filter-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'tab_shadow',
                'label' => __('Box Shadow', 'bdevs-element'),
                'selector' => '{{WRAPPER}} .project-filter-box',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'tab_border',
                'label' => __('Border', 'bdevs-element'),
                'selector' => '{{WRAPPER}} .project-filter-box',
            ]
        );

        $this->add_responsive_control(
            'tab_item',
            [
                'label' => __('Tab Item', 'bdevs-element'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'tab_item_margin',
            [
                'label' => __('Margin', 'bdevs-element'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .project-filter-box button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_item_padding',
            [
                'label' => __('Padding', 'bdevs-element'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .project-filter-box button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('tab_item_tabs');
        $this->start_controls_tab(
            'tab_item_normal_tab',
            [
                'label' => __('Normal', 'bdevs-element'),
            ]
        );

        $this->add_control(
            'tab_item_color',
            [
                'label' => __('Color', 'bdevs-element'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .project-filter-box button' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'tab_item_background',
                'label' => __('Background', 'bdevs-element'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .project-filter-box button',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_item_hover_tab',
            [
                'label' => __('Hover', 'bdevs-element'),
            ]
        );

        $this->add_control(
            'tab_item_hvr_color',
            [
                'label' => __('Color', 'bdevs-element'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .project-filter-box button.active' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .project-filter-box button:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'tab_item_hvr_background',
                'label' => __('Background', 'bdevs-element'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .project-filter-box button.active,{{WRAPPER}} .project-filter-box button:hover',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tab_item_typography',
                'label' => __('Typography', 'bdevs-element'),
                'scheme' => Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .project-filter-box button',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'tab_item_border',
                'label' => __('Border', 'bdevs-element'),
                'selector' => '{{WRAPPER}} .project-filter-box button',
            ]
        );

        $this->add_responsive_control(
            'tab_item_border_radius',
            [
                'label' => __('Border Radius', 'bdevs-element'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .project-filter-box button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        //Column
        $this->start_controls_section(
            '_section_post_tab_column',
            [
                'label' => __('Column', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'post_item_space',
            [
                'label' => __('Space Between', 'bdevs-element'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item' => 'padding-left: {{SIZE}}{{UNIT}};padding-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_item_margin_btm',
            [
                'label' => __('Margin Bottom', 'bdevs-element'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_item_padding',
            [
                'label' => __('Padding', 'bdevs-element'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'post_item_background',
                'label' => __('Background', 'bdevs-element'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item-inner',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'post_item_box_shadow',
                'label' => __('Box Shadow', 'bdevs-element'),
                'selector' => '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item-inner',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'post_item_border',
                'label' => __('Border', 'bdevs-element'),
                'selector' => '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item-inner',
            ]
        );

        $this->add_responsive_control(
            'post_item_border_radius',
            [
                'label' => __('Border Radius', 'bdevs-element'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        //Content Style
        $this->start_controls_section(
            '_section_post_tab_content',
            [
                'label' => __('Content', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'post_content_image',
            [
                'label' => __('Image', 'bdevs-element'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_responsive_control(
            'post_item_content_img_margin_btm',
            [
                'label' => __('Margin Bottom', 'bdevs-element'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item-inner .bdevselement-post-tab-thumb' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_boder',
                'label' => __('Border', 'bdevs-element'),
                'selector' => '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item-inner .bdevselement-post-tab-thumb img',
            ]
        );

        $this->add_responsive_control(
            'image_boder_radius',
            [
                'label' => __('Border Radius', 'bdevs-element'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item-inner .bdevselement-post-tab-thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_content_title',
            [
                'label' => __('Title', 'bdevs-element'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'post_content_margin_btm',
            [
                'label' => __('Margin Bottom', 'bdevs-element'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item-inner .bdevselement-post-tab-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Typography', 'bdevs-element'),
                'scheme' => Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item-inner .bdevselement-post-tab-title',
            ]
        );

        $this->start_controls_tabs('title_tabs');
        $this->start_controls_tab(
            'title_normal_tab',
            [
                'label' => __('Normal', 'bdevs-element'),
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __('Color', 'bdevs-element'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item-inner .bdevselement-post-tab-title a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'title_hover_tab',
            [
                'label' => __('Hover', 'bdevs-element'),
            ]
        );

        $this->add_control(
            'title_hvr_color',
            [
                'label' => __('Color', 'bdevs-element'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item-inner .bdevselement-post-tab-title a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'post_content_meta',
            [
                'label' => __('Meta', 'bdevs-element'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'meta_typography',
                'label' => __('Typography', 'bdevs-element'),
                'scheme' => Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-meta span',
            ]
        );

        $this->start_controls_tabs('meta_tabs');
        $this->start_controls_tab(
            'meta_normal_tab',
            [
                'label' => __('Normal', 'bdevs-element'),
            ]
        );

        $this->add_control(
            'meta_color',
            [
                'label' => __('Color', 'bdevs-element'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-meta span' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-meta span a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'meta_hover_tab',
            [
                'label' => __('Hover', 'bdevs-element'),
            ]
        );

        $this->add_control(
            'meta_hvr_color',
            [
                'label' => __('Color', 'bdevs-element'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-meta span:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-meta span:hover a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'meta__margin',
            [
                'label' => __('Margin', 'bdevs-element'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-meta span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_content_excerpt',
            [
                'label' => __('Excerpt', 'bdevs-element'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'excerpt' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'excerpt_typography',
                'label' => __('Typography', 'bdevs-element'),
                'scheme' => Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-excerpt p',
                'condition' => [
                    'excerpt' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'excerpt_color',
            [
                'label' => __('Color', 'bdevs-element'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-excerpt p' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'excerpt' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'excerpt_margin_top',
            [
                'label' => __('Margin Top', 'bdevs-element'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-excerpt' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'excerpt' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {

        $settings = $this->get_settings_for_display();

        if (!$settings['post_type']) {
            return;
        }

        $taxonomy = $settings['tax_type_' . $settings['post_type']];
        $terms_ids = $settings['tax_ids_' . $taxonomy];
        if ( !empty($terms_ids) ) {
            $terms_args = [
                'taxonomy' => $taxonomy,
                'hide_empty' => true,
                'include' => $terms_ids,
                'orderby' => 'term_id',
            ];
            $post_args = [
                'post_status' => 'publish',
                'post_type' => $settings['post_type'],
                'posts_per_page' => $settings['item_limit'],
                'tax_query' => [
                    [
                        'taxonomy' => $taxonomy,
                        'field' => 'term_id',
                        'terms' => $terms_ids ? $terms_ids : '',
                    ],
                ],
            ];
        }
        else {
            $terms_args = [
                'taxonomy' => $taxonomy,
                'hide_empty' => true,
                'orderby' => 'term_id',
            ];
            $post_args = [
                'post_status' => 'publish',
                'post_type' => $settings['post_type'],
                'posts_per_page' => $settings['item_limit'],
            ];
        }

        $posts = query_posts($post_args);
        $filter_list = get_terms($terms_args);
        

        $query_settings = [
            'post_type' => $settings['post_type'],
            'taxonomy' => $taxonomy,
            'item_limit' => $settings['item_limit'],
            'excerpt' => $settings['excerpt'] ? $settings['excerpt'] : 'no',
        ];
        $query_settings = json_encode($query_settings, true);
        
        $this->add_render_attribute('project-filter', 'class', ['portfolio-menu text-center mb-50']);
        $this->add_render_attribute('project-body', 'class', ['row filter-grid']);
        $this->add_render_attribute( 'title', 'class', 'section__title' );
        $title = bdevs_element_kses_basic($settings['title']);
        $i = 1;

        if (count($posts) !== 0): ?>
         <section class="course__area">
            <div class="container">
               <div class="row align-items-end">
                  <div class="col-xxl-5 col-xl-6 col-lg-6">
                    <?php if ($settings['title']) : ?>
                        <div class="section__title-wrapper mb-60">
                            <?php if ($settings['sub_title']) : ?>
                                <span class="sub-title bdevs-el-subtitle"><?php echo bdevs_element_kses_intermediate($settings['sub_title']); ?></span>
                            <?php endif; ?>
                            <?php printf('<%1$s %2$s>%3$s</%1$s>',
                                tag_escape($settings['title_tag']),
                                $this->get_render_attribute_string('title'),
                                $title
                            ); ?>
                            <?php if ($settings['description']) : ?>
                                <p><?php echo bdevs_element_kses_intermediate($settings['description']); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                  </div>
                  <div class="col-xxl-7 col-xl-6 col-lg-6">
                     <div class="course__menu d-flex justify-content-lg-end mb-60">
                        <div class="masonary-menu filter-button-group">
                            <?php foreach ($filter_list as $list): ?>
                                <?php if ($i === 1): $i++; ?>
                                    <button class="active" data-filter="*"><?php echo esc_html('See All'); ?>
                                        <span class="tag">new</span>
                                    </button>
                                    <button data-filter=".<?php echo esc_attr($list->slug); ?>"><?php echo esc_html($list->name); ?></button>
                                <?php else: ?>
                                    <button data-filter=".<?php echo esc_attr($list->slug); ?>"><?php echo esc_html($list->name); ?></button>
                                <?php endif; ?>
                            <?php endforeach; ?>
                       </div>
                     </div>
                  </div>
               </div>
               <div class="row grid">
                    <?php

                    if (have_posts()): while (have_posts()): the_post();
                    $item_classes = '';
                    $item_cat_names = '';
                    $item_cats = get_the_terms(get_the_id(), $taxonomy);
                    if (!empty($item_cats)):
                        $count = count($item_cats) - 1;
                        foreach ($item_cats as $key => $item_cat) {
                            $item_classes .= $item_cat->slug . ' ';
                            $item_cat_names .= ($count > $key) ? $item_cat->name . ', ' : $item_cat->name;
                        }
                    endif;

                    $terms = get_the_terms(get_the_ID(), 'course_category');
                    $course    = LP()->global['course'];
                    $lessons = $course->get_curriculum_items( 'lp_lesson' )? count( $course->get_curriculum_items( 'lp_lesson' ) ) : 0;
                    $instructor = $course->get_instructor();
                    $instructor_link = $course->get_instructor_html();
                    $instructor_id = $course->get_id();

                    $feature_img = '';
                    if ('yes' === $settings['feature_image']) {
                        $feature_img = get_the_post_thumbnail_url(get_the_ID(), $settings['post_image_size']);
                    }
                    ?>
                  <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 grid-item <?php echo $item_classes; ?>">
                     <div class="course__item white-bg mb-30 fix">
                        <?php if ('yes' === $settings['feature_image']): ?>
                        <div class="course__thumb w-img p-relative fix">
                           <a href="<?php the_permalink(); ?>">
                              <img src="<?php print esc_url($feature_img); ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($feature_img), '_wp_attachment_image_alt', true); ?>">
                           </a>

                           <?php if(!empty($terms)) : ?>
                           <div class="course__tag">
                                <?php foreach ($terms as $term) : ?>
                                    <a href="<?php echo get_term_link($term->slug, 'course_category'); ?>"><?php echo $term->name; ?></a>
                                <?php endforeach; ?>
                           </div>
                           <?php endif; ?>
                        </div>
                        <?php endif; ?>

                        <div class="course__content">
                           <div class="course__meta d-flex align-items-center justify-content-between">
                             <?php if ( !empty($settings['lession_switch']) ) : ?>
                              <div class="course__lesson">
                                 <span>
                                    <i class="far fa-book-alt"></i>
                                    <?php echo esc_html($lessons); ?>
                                    <?php echo esc_html__(' Lessons', 'turitor'); ?>
                                </span>
                              </div>
                              <?php endif; ?>

                              <?php 
                              if ( class_exists( 'LP_Addon_Course_Review_Preload' ) ) :
                              $total_rating = 5;
                              $reviews = leanr_press_get_ratings_result( get_the_ID() ); 
                              $taken_rating = !empty($reviews['rated']) ? $reviews['rated'] : 0;
                              $blank_rating = $total_rating - $taken_rating;
                              
                              ?>
                             
                              <div class="course__rating">
                                 <span>
                                    <i class="icon_star"></i><?php echo $taken_rating; ?> (<?php echo !empty($reviews['total']) ? $reviews['total'] : 0; ?>)</span>
                              </div>
                              <?php endif; ?>
                              
                           </div>
                           <h3 class="course__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></h3>

                            <?php if (!empty($settings['content'])):
                                $content_limit = (!empty($settings['content_limit'])) ? $settings['content_limit'] : '';
                                ?>
                                <p><?php print wp_trim_words(get_the_excerpt(get_the_ID()), $content_limit, ''); ?></p>
                            <?php endif; ?>

                            <?php if ( !empty($settings['author_switch']) ) : ?>
                           <div class="course__teacher d-flex align-items-center">
                                <?php 
                                    $dir = learn_press_user_profile_picture_upload_dir();
                                    $user = get_user_by( 'id', $instructor->get_id());
                                    $pro_link = get_user_meta($user->ID,'_lp_profile_picture',true); 
                                    $base_url = isset($dir['baseurl'])?$dir['baseurl']:'';
                                    $profile_link =  $base_url.'/'.$pro_link;
                                ?>
                               <?php if($pro_link !='') : ?> 
                                  <div class="course__teacher-thumb mr-15">
                                     <img src="<?php echo esc_url($profile_link); ?>" alt="<?php  echo  esc_attr($user->display_name); ?>">
                                  </div>
                                  <h6><?php  echo wp_kses_post($instructor_link); ?></h6>
                                <?php else: ?>
                                <div class="course__teacher-thumb mr-15">
                                    <img src="<?php echo esc_url( get_avatar_url( $instructor->get_id() ) ); ?>" alt="<?php  echo  esc_attr($user->display_name); ?>">
                                </div>
                                <h6><?php  echo wp_kses_post($instructor_link); ?></h6>
                                <?php endif; ?>
                           </div>
                           <?php endif; ?>
                        </div>
                        <div class="course__more d-flex justify-content-between align-items-center">
                           <div class="course__status">
                              <?php if($course->is_free()): ?>
                              <span> <?php echo esc_html__('Free','bdevs-element'); ?> </span>
                              <?php else: ?>

                                <span class="blue"><?php echo $course->get_price_html(); ?> </span>
                                <?php if ( $course->get_origin_price() != $course->get_price() ) : ?>
                                <span class="old-price"><?php echo $course->get_origin_price_html(); ?></span>
                                <?php endif; ?>
                              <?php endif; ?>
                           </div>
                           <?php if ( !empty($settings['read_more']) ) : ?>
                           <div class="course__btn">
                              <a href="<?php the_permalink(); ?>" class="link-btn">
                                 <?php echo bdevs_element_kses_basic( $settings['read_more_text'] ); ?>
                                 <?php \Elementor\Icons_Manager::render_icon( $settings['read_more_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                 <?php \Elementor\Icons_Manager::render_icon( $settings['read_more_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                              </a>
                           </div>
                           <?php endif; ?>
                        </div>
                     </div>
                  </div>
                    <?php endwhile;
                        wp_reset_query();
                    endif;
                    ?>
               </div>
            </div>
         </section>

        <?php else:
            printf('%1$s',
                __('No  Posts  Found', 'bdevs-element')
            );
        endif;
    }
}
