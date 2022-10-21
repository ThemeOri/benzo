<?php

namespace BdevsElement\Widget;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Icons_Manager;
use \Elementor\Repeater;
use \Elementor\Core\Schemes;
use \Elementor\Group_Control_Background;
use \BdevsElement\BDevs_El_Select2;
use Elementor\Utils;

defined('ABSPATH') || die();


class Learnpress_Course_List extends BDevs_El_Widget
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
        return 'learnpress_course_list';
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
        return __('Learnpress Course List', 'bdevs-element');
    }

    public function get_custom_help_url()
    {
        return 'http://elementor.bdevs.net/widgets/event-list/';
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
        return 'eicon-parallax';
    }

    public function get_keywords()
    {
        return ['press', 'course-list', 'list', 'event'];
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
            'bdevs-services' => '',
            'bdevs-portfolio' => '',
            'post' => '',
            'e-landing-page' => '',
            'product' => '',
            'bdevs-gallery' => '',
            'product' => '',
            'tutor_assignments' => '',
            'tribe_events' => '',
            'lesson' => ''
        ];

        $post_types = bdevs_element_get_post_types([], $diff_key);

        return $post_types;
    }

    protected function register_content_controls()
    {
        $this->start_controls_section(
            '_section_design',
            [
                'label' => __('Design Template', 'bdevs-element'),
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
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_post_list',
            [
                'label' => __('Course List', 'bdevs-element'),
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

        $this->add_control(
            'show_post_by',
            [
                'label' => __('Show post by:', 'bdevs-element'),
                'type' => Controls_Manager::SELECT,
                'default' => 'recent',
                'options' => [
                    'recent' => __('Recent Post', 'bdevs-element'),
                    'selected' => __('Selected Post', 'bdevs-element'),
                ],

            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => __('Item Limit', 'bdevs-element'),
                'type' => Controls_Manager::NUMBER,
                'default' => 3,
                'dynamic' => ['active' => true],
                'condition' => [
                    'show_post_by' => ['recent']
                ]
            ]
        );

        $repeater = [];

        foreach ($this->get_post_types() as $key => $value) {

            $repeater[$key] = new Repeater();

            $repeater[$key]->add_control(
                'title',
                [
                    'label' => __('Title', 'bdevs-element'),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'placeholder' => __('Customize Title', 'bdevs-element'),
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );

            $repeater[$key]->add_control(
                'post_short_text',
                [
                    'label' => __('Short Content', 'bdevs-element'),
                    'type' => Controls_Manager::TEXTAREA,
                    'label_block' => true,
                    'placeholder' => __('Short Content', 'bdevs-element'),
                    'rows' => 3,
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );

            $repeater[$key]->add_control(
                'post_id',
                [
                    'label' => __('Select ', 'bdevs-element') . $value,
                    'label_block' => true,
                    'type' => BDevs_El_Select2::TYPE,
                    'multiple' => false,
                    'placeholder' => 'Search ' . $value,
                    'data_options' => [
                        'post_type' => $key,
                        'action' => 'bdevs_element_post_list_query'
                    ],
                ]
            );

            $this->add_control(
                'selected_list_' . $key,
                [
                    'label' => '',
                    'type' => Controls_Manager::REPEATER,
                    'fields' => $repeater[$key]->get_controls(),
                    'title_field' => '{{ title }}',
                    'condition' => [
                        'show_post_by' => 'selected',
                        'post_type' => $key
                    ],
                ]
            );
        }

        $this->end_controls_section();

        //Settings
        $this->start_controls_section(
            '_section_settings',
            [
                'label' => __('Settings', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'read_more',
            [
                'label' => __('Read More', 'bdevs-element'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevs-element'),
                'label_off' => __('Hide', 'bdevs-element'),
                'return_value' => 'yes',
                'condition' => [
                    'design_style' => ['style_1']
                ], 
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
                    'read_more' => 'yes',
                    'design_style' => ['style_1']
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
                    'read_more' => 'yes',
                    'design_style' => ['style_1']
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
                'default' => 'thumbnail',
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
                'condition' => [
                    'design_style' => ['style_1']
                ],
                'default' => '',
            ]
        );

        $this->end_controls_section();

    }

    protected function register_style_controls()
    {

        $this->start_controls_section(
            '_section_post_list_style',
            [
                'label' => __('List', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'list_item_common',
            [
                'label' => __('Common', 'bdevs-element'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_responsive_control(
            'list_item_margin',
            [
                'label' => __('Margin', 'bdevs-element'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-list .bdevselement-post-list-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'list_item_padding',
            [
                'label' => __('Padding', 'bdevs-element'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-list .bdevselement-post-list-item a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'list_item_background',
                'label' => __('Background', 'bdevs-element'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .bdevselement-post-list .bdevselement-post-list-item',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'list_item_box_shadow',
                'label' => __('Box Shadow', 'bdevs-element'),
                'selector' => '{{WRAPPER}} .bdevselement-post-list .bdevselement-post-list-item',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'list_item_border',
                'label' => __('Border', 'bdevs-element'),
                'selector' => '{{WRAPPER}} .bdevselement-post-list .bdevselement-post-list-item',
            ]
        );

        $this->add_responsive_control(
            'list_item_border_radius',
            [
                'label' => __('Border Radius', 'bdevs-element'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-list .bdevselement-post-list-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'advance_style',
            [
                'label' => __('Advance Style', 'bdevs-element'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('On', 'bdevs-element'),
                'label_off' => __('Off', 'bdevs-element'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_responsive_control(
            'list_item_first',
            [
                'label' => __('First Item', 'bdevs-element'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'advance_style' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'list_item_first_child_margin',
            [
                'label' => __('Margin', 'bdevs-element'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-list .bdevselement-post-list-item:first-child' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'advance_style' => 'yes',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'list_item_first_child_border',
                'label' => __('Border', 'bdevs-element'),
                'selector' => '{{WRAPPER}} .bdevselement-post-list .bdevselement-post-list-item:first-child',
                'condition' => [
                    'advance_style' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'list_item_last',
            [
                'label' => __('Last Item', 'bdevs-element'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'advance_style' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'list_item_last_child_margin',
            [
                'label' => __('Margin', 'bdevs-element'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-list .bdevselement-post-list-item:last-child' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'advance_style' => 'yes',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'list_item_last_child_border',
                'label' => __('Border', 'bdevs-element'),
                'selector' => '{{WRAPPER}} .bdevselement-post-list .bdevselement-post-list-item:last-child',
                'condition' => [
                    'advance_style' => 'yes',
                ]
            ]
        );

        $this->end_controls_section();
        //Title Style
        $this->start_controls_section(
            '_section_post_list_title_style',
            [
                'label' => __('Title', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Typography', 'bdevs-element'),
                'scheme' => Schemes\Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .bdevselement-post-list-title',
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
                    '{{WRAPPER}} .bdevselement-post-list-title' => 'color: {{VALUE}}',
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
                    '{{WRAPPER}} .bdevselement-post-list .bdevselement-post-list-item a:hover .bdevselement-post-list-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
        //List Icon Style
        $this->start_controls_section(
            '_section_list_icon_feature_iamge_style',
            [
                'label' => __('Icon & Feature Image', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_STYLE,
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'feature_image',
                            'operator' => '==',
                            'value' => 'yes',
                        ],
                        [
                            'name' => 'list_icon',
                            'operator' => '==',
                            'value' => 'yes',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => __('Color', 'bdevs-element'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} span.bdevselement-post-list-icon' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'feature_image!' => 'yes',
                    'list_icon' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => __('Font Size', 'bdevs-element'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} span.bdevselement-post-list-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'feature_image!' => 'yes',
                    'list_icon' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_line_height',
            [
                'label' => __('Line Height', 'bdevs-element'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} span.bdevselement-post-list-icon' => 'line-height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'feature_image!' => 'yes',
                    'list_icon' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'image_width',
            [
                'label' => __('Image Width', 'bdevs-element'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-list-item a img' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'feature_image' => 'yes',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_boder',
                'label' => __('Border', 'bdevs-element'),
                'selector' => '{{WRAPPER}} .bdevselement-post-list-item a img',
                'condition' => [
                    'feature_image' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'image_boder_radius',
            [
                'label' => __('Border Radius', 'bdevs-element'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-list-item a img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'feature_image' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_margin_right',
            [
                'label' => __('Margin Right', 'bdevs-element'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} span.bdevselement-post-list-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .bdevselement-post-list-item a img' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        //List Meta Style
        $this->start_controls_section(
            '_section_list_meta_style',
            [
                'label' => __('Meta', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'meta' => 'yes',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'meta_typography',
                'label' => __('Typography', 'bdevs-element'),
                'scheme' => Schemes\Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} .bdevselement-post-list-meta-wrap span',
            ]
        );

        $this->add_control(
            'meta_color',
            [
                'label' => __('Color', 'bdevs-element'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-list-meta-wrap span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'meta_space',
            [
                'label' => __('Space Between', 'bdevs-element'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-list-meta-wrap span' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .bdevselement-post-list-meta-wrap span:last-child' => 'margin-right: 0;',
                ],
            ]
        );

        $this->add_responsive_control(
            'meta_box_margin',
            [
                'label' => __('Margin', 'bdevs-element'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-list-meta-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'meta_icon_heading',
            [
                'label' => __('Meta Icon', 'bdevs-element'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'meta_icon_color',
            [
                'label' => __('Color', 'bdevs-element'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-list-meta-wrap span i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'meta_icon_space',
            [
                'label' => __('Space Between', 'bdevs-element'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-list-meta-wrap span i' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {

        $settings = $this->get_settings_for_display();

        if (!$settings['post_type']) return;

        $args = [
            'post_status' => 'publish',
            'post_type' => $settings['post_type'],
        ];

        if ('recent' === $settings['show_post_by']) {
            $args['posts_per_page'] = $settings['posts_per_page'];
        }

        $selected_post_type = 'selected_list_' . $settings['post_type'];

        $customize_title = [];

        $ids = [];
        if ('selected' === $settings['show_post_by']) {
            $args['posts_per_page'] = -1;
            $lists = $settings['selected_list_' . $settings['post_type']];

            if (!empty($lists)) {

                foreach ($lists as $index => $value) {
                    $post_id = !empty($value['post_id']) ? $value['post_id'] : 0;
                    $ids[] = $post_id;
                    if ($value['title']) $customize_title[$post_id] = $value['title'];
                }
            }

            $args['post__in'] = (array)$ids;
            $args['orderby'] = 'post__in';
        }

        if ('selected' === $settings['show_post_by'] && empty($ids)) {
            $posts = [];
        } else {
            $posts = new \WP_Query($args);
        }

        if (!empty($settings['design_style']) and $settings['design_style'] == 'style_2'): ?>
            <?php if ( !empty($posts) ):
                $this->add_render_attribute('title', 'class', 'mb-15'); ?>
                <div class="course-area">
                    <div class="container">
                        <div class="row">
                            <?php
                            global $authordata;
                            if ($posts->have_posts()):
                                while ($posts->have_posts()) : $posts->the_post();
                                    $terms = get_the_terms(get_the_ID(), 'course_category');
                                    $course    = LP()->global['course'];
                                    $lessons = $course->get_curriculum_items( 'lp_lesson' )? count( $course->get_curriculum_items( 'lp_lesson' ) ) : 0;
                                    $instructor = $course->get_instructor();
                                    $user_designation = get_the_author_meta( 'user_designation',$instructor->get_id());
                                    $instructor_link = $course->get_instructor_html();
                                    $instructor_id = $course->get_id(); 
                                  ?>
                                  <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                     <div class="course__item course__item-2 white-bg mb-30 transition-3">
                                        <?php if ('yes' === $settings['feature_image']): ?>
                                        <div class="course__thumb fix w-img">
                                            <a href="<?php print get_the_permalink() ?>">
                                                <?php echo get_the_post_thumbnail(get_the_ID(), $settings['post_image_size']); ?>
                                            </a>
                                        </div>
                                        <?php endif; ?>
                                        <div class="course__content-2">
                                           <h3 class="course__title-2"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                           <?php if (!empty($settings['content'])):
                                                $content_limit = (!empty($settings['content_limit'])) ? $settings['content_limit'] : '';
                                                ?>
                                                <p><?php print wp_trim_words(get_the_excerpt(get_the_ID()), $content_limit, ''); ?></p>
                                            <?php endif; ?>

                                           <div class="course__bottom d-sm-flex justify-content-between align-items-center">
                                            <?php if ( !empty($settings['author_switch']) ) : ?>

                                                <?php 
                                                    $dir = learn_press_user_profile_picture_upload_dir();
                                                    $user = get_user_by( 'id', $instructor->get_id());
                                                    $pro_link = get_user_meta($user->ID,'_lp_profile_picture',true); 
                                                    $base_url = isset($dir['baseurl'])?$dir['baseurl']:'';
                                                    $profile_link =  $base_url.'/'.$pro_link;
                                                ?> 

                                                <?php if($pro_link !='') : ?>                 
                                              <div class="course__teacher-2 d-flex align-items-center">
                                                 <div class="course__teacher-thumb-2 mr-20">
                                                    <img src="<?php echo esc_url($profile_link); ?>" alt="<?php  echo  esc_attr($user->display_name); ?>">
                                                    <div class="course__teacher-rating">
                                                       <i class="icon_star"></i>
                                                    </div>
                                                 </div>
                                                 <div class="course__teacher-info">
                                                    <h6>
                                                        <?php  echo wp_kses_post($instructor_link); ?>
                                                    </h6>
                                                    
                                                    <?php if ( !empty($user_designation) ) : ?>
                                                     <span><?php echo esc_html($user_designation); ?></span>
                                                    <?php endif; ?>                                                                                                                                                                                                                                                                                         
                                                    
                                                 </div>
                                              </div>
                                              <?php else: ?>
                                              <div class="course__teacher-2 d-flex align-items-center">
                                                 <div class="course__teacher-thumb-2 mr-20">
                                                    <img src="<?php echo esc_url( get_avatar_url( $instructor->get_id() ) ); ?>" alt="<?php  echo  esc_attr($user->display_name); ?>">
                                                    <div class="course__teacher-rating">
                                                       <i class="icon_star"></i>
                                                    </div>
                                                 </div>
                                                 <div class="course__teacher-info">
                                                    <h6>
                                                        <?php  echo wp_kses_post($instructor_link); ?>
                                                    </h6>
                                                    
                                                    <?php if ( !empty($user_designation) ) : ?>
                                                     <span><?php echo esc_html($user_designation); ?></span>
                                                    <?php endif; ?>
                                                    
                                                 </div>
                                              </div>
                                              <?php endif; ?>
                                              <?php endif; ?>

                                              <?php if ( !empty($settings['lession_switch']) ) : ?>
                                              <div class="course__meta">
                                                 <div class="course__lesson">
                                                    <span><i class="far fa-book-alt"></i>
                                                        <?php echo esc_html($lessons); ?>
                                                        <?php echo esc_html__(' Lessons', 'bdevs-element'); ?>
                                                    </span>
                                                 </div>
                                              </div>
                                              <?php endif; ?>
                                           </div>
                                        </div>

                                     </div>
                                  </div>
                                <?php
                                endwhile;
                                wp_reset_query();
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
            <?php
            else:
                printf('%1$s %2$s %3$s',
                    __('No ', 'bdevs-element'),
                    esc_html($settings['post_type']),
                    __('Found', 'bdevs-element')
                );
            endif;
            ?>
        <?php
        else:
            if ( !empty($posts) ):
                $this->add_render_attribute('title', 'class', 'mb-15'); ?>
                <div class="course-area">
                    <div class="container">
                           <div class="row">
                            <?php
                            global $authordata;
                            if ($posts->have_posts()):
                                while ($posts->have_posts()) : $posts->the_post();

                                    $terms = get_the_terms(get_the_ID(), 'course_category');
                                    $course    = LP()->global['course'];
                                    $lessons = $course->get_curriculum_items( 'lp_lesson' )? count( $course->get_curriculum_items( 'lp_lesson' ) ) : 0;
                                    $instructor = $course->get_instructor();
                                    $instructor_link = $course->get_instructor_html();
                                    $instructor_id = $course->get_id(); 
                                    ?>
                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 grid-item <?php echo $item_classes; ?>">
                                        <div class="course__item white-bg mb-30 fix">
                                            <?php if ('yes' === $settings['feature_image']): ?>
                                            <div class="course__thumb w-img p-relative fix">
                                               <a href="<?php print get_the_permalink() ?>">
                                                  <?php echo get_the_post_thumbnail(get_the_ID(), $settings['post_image_size']); ?>
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
                                               <h3 class="course__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                               
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
                                                     <img src="<?php echo esc_url( get_avatar_url( $instructor->get_id() ) ); ?>" alt="<?php  echo  esc_attr($user->display_name); ?>">
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
                                               <?php if ( $settings['read_more'] ) : ?>
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
                                <?php
                                endwhile;
                                wp_reset_query();
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
            <?php
            else:
                printf('%1$s %2$s %3$s',
                    __('No ', 'bdevs-element'),
                    esc_html($settings['post_type']),
                    __('Found', 'bdevs-element')
                );
            endif;
            ?>
        <?php
        endif;
    }
}