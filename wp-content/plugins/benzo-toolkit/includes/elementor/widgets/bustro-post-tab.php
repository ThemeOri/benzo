<?php
namespace BenzoToolkit\ElementorAddon\Widgets;

use BenzoToolkit\ElementorAddon\Helper\Benzo_Post_Templates;
use BenzoToolkit\ElementorAddon\Helper\Benzo_Query_Builder;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Benzo_Post_Tab extends Widget_Base {

    /**
     * Retrieve the widget name.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'benzo-post-tab';
    }

    /**
     * Retrieve the widget title.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Benzo Post Tab', 'benzo-toolkit' );
    }

    /**
     * Retrieve the widget icon.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-tabs';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return ['benzo_elements'];
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the widget belongs to.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return ['Benzo', 'toolkit'];
    }

    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function register_controls() {

        $this->start_controls_section(
            'widget_content',
            [
                'label' => esc_html__( 'General', 'benzo-toolkit' ),
            ]
        );

        $this->add_control(
            'tab_layout',
            [
                'label'   => esc_html__( 'Layout', 'benzo-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'grid-layout'    => esc_html__( 'Grid Layout', 'benzo-toolkit' ),
                    'masonry-layout' => esc_html__( 'Masonry Layout', 'benzo-toolkit' ),
                ],
                'default' => 'grid-layout',
            ]
        );

        $this->add_control(
            'masonry_layout',
            [
                'label'     => esc_html__( 'Masonry Layout', 'benzo-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'layout-one'   => esc_html__( 'Layout One', 'benzo-toolkit' ),
                    'layout-two'   => esc_html__( 'Layout Two', 'benzo-toolkit' ),
                    'layout-three' => esc_html__( 'Layout Three', 'benzo-toolkit' ),
                    'layout-four'  => esc_html__( 'Layout Four', 'benzo-toolkit' ),
                    'layout-five'  => esc_html__( 'Layout Five', 'benzo-toolkit' ),
                    'layout-six'   => esc_html__( 'Layout Six', 'benzo-toolkit' ),
                    'layout-seven' => esc_html__( 'Layout Seven', 'benzo-toolkit' ),
                ],
                'default'   => 'layout-one',
                'condition' => [
                    'tab_layout' => 'masonry-layout',
                ],
            ]
        );

        $this->add_control(
            'additional_heading',
            [
                'label'     => esc_html__( 'Additional Options', 'benzo-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'masonry_post_layout',
            [
                'label'      => esc_html__( 'Layout', 'benzo-toolkit' ),
                'type'       => Controls_Manager::SELECT,
                'options'    => [
                    'normal-layout'    => esc_html__( 'Normal Layout', 'benzo-toolkit' ),
                    'image-background' => esc_html__( 'Image Background', 'benzo-toolkit' ),
                    'image-hover-bg'   => esc_html__( 'Image Hover Background', 'benzo-toolkit' ),
                ],
                'default'    => 'normal-layout',
                'conditions' => [
                    'relation' => 'and',
                    'terms'    => [
                        [
                            'name'     => 'tab_layout',
                            'operator' => '==',
                            'value'    => 'masonry-layout',
                        ],
                        [
                            'name'     => 'masonry_layout',
                            'operator' => '!=',
                            'value'    => 'layout-three',
                        ],
                        [
                            'name'     => 'masonry_layout',
                            'operator' => '!=',
                            'value'    => 'layout-four',
                        ],
                        [
                            'name'     => 'masonry_layout',
                            'operator' => '!=',
                            'value'    => 'layout-five',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'grid_post_layout',
            [
                'label'     => esc_html__( 'Layout', 'benzo-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'normal-layout'     => esc_html__( 'Normal Layout', 'benzo-toolkit' ),
                    'image-background'  => esc_html__( 'Image Background', 'benzo-toolkit' ),
                    'image-hover-bg'    => esc_html__( 'Image Hover Background', 'benzo-toolkit' ),
                    'image-left'        => esc_html__( 'Image left', 'benzo-toolkit' ),
                    'image-right'       => esc_html__( 'Image Right', 'benzo-toolkit' ),
                    'image-left-boxed'  => esc_html__( 'Image Left Boxed', 'benzo-toolkit' ),
                    'image-right-boxed' => esc_html__( 'Image Right Boxed', 'benzo-toolkit' ),
                ],
                'default'   => 'normal-layout',
                'condition' => [
                    'tab_layout' => 'grid-layout',
                ],
            ]
        );

        $this->add_control(
            'meta_design',
            [
                'label'   => esc_html__( 'Meta Design', 'benzo-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'meta-design-one'   => esc_html__( 'Design One', 'benzo-toolkit' ),
                    'meta-design-two'   => esc_html__( 'Design Two', 'benzo-toolkit' ),
                    'meta-design-three' => esc_html__( 'Design Three', 'benzo-toolkit' ),
                ],
                'default' => 'meta-design-one',
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label'       => esc_html__( 'Title HTML Tag', 'benzo-toolkit' ),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'h3' => [
                        'title' => esc_html__( 'H3', 'benzo-toolkit' ),
                        'icon'  => 'eicon-editor-h3',
                    ],
                    'h4' => [
                        'title' => esc_html__( 'H4', 'benzo-toolkit' ),
                        'icon'  => 'eicon-editor-h4',
                    ],
                    'h5' => [
                        'title' => esc_html__( 'H5', 'benzo-toolkit' ),
                        'icon'  => 'eicon-editor-h5',
                    ],
                    'h6' => [
                        'title' => esc_html__( 'H6', 'benzo-toolkit' ),
                        'icon'  => 'eicon-editor-h6',
                    ],
                ],
                'default'     => 'h4',
                'toggle'      => false,
            ]
        );

        $this->add_control(
            'title_word',
            [
                'label'   => esc_html__( 'Title Word', 'benzo-toolkit' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 10,
            ]
        );

        $this->add_control(
            'show_excerpt',
            [
                'label'        => esc_html__( 'Show Excerpt', 'benzo-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'benzo-toolkit' ),
                'label_off'    => esc_html__( 'Hide', 'benzo-toolkit' ),
                'return_value' => 'yes',
                'default'      => 'no',
                'separator'    => 'before',
            ]
        );

        $this->add_control(
            'excerpt_word',
            [
                'label'     => esc_html__( 'Excerpt Word', 'benzo-toolkit' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 25,
                'condition' => [
                    'show_excerpt' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_category',
            [
                'label'        => esc_html__( 'Show Category', 'benzo-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'benzo-toolkit' ),
                'label_off'    => esc_html__( 'Hide', 'benzo-toolkit' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'show_author',
            [
                'label'        => esc_html__( 'Show Author', 'benzo-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'benzo-toolkit' ),
                'label_off'    => esc_html__( 'Hide', 'benzo-toolkit' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'show_date',
            [
                'label'        => esc_html__( 'Show Date', 'benzo-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'benzo-toolkit' ),
                'label_off'    => esc_html__( 'Hide', 'benzo-toolkit' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'show_read_more',
            [
                'label'        => esc_html__( 'Show Read More', 'benzo-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'benzo-toolkit' ),
                'label_off'    => esc_html__( 'Hide', 'benzo-toolkit' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        $this->add_control(
            'read_more_text',
            [
                'label'     => esc_html__( 'Button Text', 'benzo-toolkit' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => esc_html__( 'Read More', 'benzo-toolkit' ),
                'condition' => [
                    'show_read_more' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'    => 'thumbnail',
                'default' => 'medium_large',
                'exclude' => [
                    'custom',
                ],
            ]
        );

        $this->add_control(
            'column_heading',
            [
                'label'     => esc_html__( 'Column', 'benzo-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'tab_layout' => 'grid-layout',
                ],
            ]
        );

        $this->add_control(
            'desktop_column',
            [
                'label'     => esc_html__( 'Desktop', 'benzo-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'col-lg-12' => esc_html__( 'One', 'benzo-toolkit' ),
                    'col-lg-6'  => esc_html__( 'Two', 'benzo-toolkit' ),
                    'col-lg-4'  => esc_html__( 'Three', 'benzo-toolkit' ),
                    'col-lg-3'  => esc_html__( 'Four', 'benzo-toolkit' ),
                ],
                'default'   => 'col-lg-4',
                'condition' => [
                    'tab_layout' => 'grid-layout',
                ],
            ]
        );

        $this->add_control(
            'tab_column',
            [
                'label'     => esc_html__( 'Tab', 'benzo-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'col-md-12' => esc_html__( 'One', 'benzo-toolkit' ),
                    'col-md-6'  => esc_html__( 'Two', 'benzo-toolkit' ),
                    'col-md-4'  => esc_html__( 'Three', 'benzo-toolkit' ),
                    'col-md-3'  => esc_html__( 'Four', 'benzo-toolkit' ),
                ],
                'default'   => 'col-md-6',
                'condition' => [
                    'tab_layout' => 'grid-layout',
                ],
            ]
        );

        $this->add_control(
            'mobile_column',
            [
                'label'     => esc_html__( 'Mobile', 'benzo-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'col-12' => esc_html__( 'One', 'benzo-toolkit' ),
                    'col-6'  => esc_html__( 'Two', 'benzo-toolkit' ),
                    'col-4'  => esc_html__( 'Three', 'benzo-toolkit' ),
                    'col-3'  => esc_html__( 'Four', 'benzo-toolkit' ),
                ],
                'default'   => 'col-12',
                'condition' => [
                    'tab_layout' => 'grid-layout',
                ],
            ]
        );

        $this->end_controls_section();

        Benzo_Query_Builder::render_loop_options( $this, ['hide_tags' => true] );

        $this->start_controls_section(
            'filter_nav_style',
            [
                'label' => esc_html__( 'Filter Navigation', 'benzo-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'filter_nav',
            [
                'label'      => esc_html__( 'Margin', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-post-tab .post-filter-nav' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'nav_alignment',
            [
                'label'       => esc_html__( 'Alignment', 'benzo-toolkit' ),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'toggle'      => true,
                'options'     => [
                    'flex-start' => [
                        'title' => esc_html__( 'Left', 'benzo-toolkit' ),
                        'icon'  => 'eicon-order-start',
                    ],
                    'center'     => [
                        'title' => esc_html__( 'Center', 'benzo-toolkit' ),
                        'icon'  => ' eicon-shrink',
                    ],
                    'flex-end'   => [
                        'title' => esc_html__( 'Right', 'benzo-toolkit' ),
                        'icon'  => 'eicon-order-end',
                    ],
                ],
                'default'     => 'center',
                'selectors'   => [
                    '{{WRAPPER}} .benzo-post-tab .post-filter-nav ul' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'filter_nav_typo',
                'selector' => '{{WRAPPER}} .benzo-post-tab .post-filter-nav a',
            ]
        );

        $this->start_controls_tabs( 'filter_nav_tab' );

        $this->start_controls_tab(
            'filter_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'benzo-toolkit' ),
            ]
        );

        $this->add_control(
            'nav_normal_color',
            [
                'label'     => esc_html__( 'Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-post-tab .post-filter-nav a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'filter_active_tab',
            [
                'label' => esc_html__( 'Active/hover', 'benzo-toolkit' ),
            ]
        );

        $this->add_control(
            'nav_active_color',
            [
                'label'     => esc_html__( 'Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-post-tab .post-filter-nav a:hover'  => 'color: {{VALUE}}',
                    '{{WRAPPER}} .benzo-post-tab .post-filter-nav a.active' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'wrapper_style',
            [
                'label' => esc_html__( 'Post Wrapper', 'benzo-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'wrapper_margin',
            [
                'label'      => esc_html__( 'Margin', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .post-tab-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'wrapper_padding',
            [
                'label'      => esc_html__( 'Padding', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .post-tab-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'wrapper_border',
                'selector' => '{{WRAPPER}} .post-tab-item',
            ]
        );

        $this->add_responsive_control(
            'wrapper_grid',
            [
                'label'      => esc_html__( 'Items Gap', 'benzo-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-post-boxes'    => '--grid-gap: {{SIZE}}px;',
                    '{{WRAPPER}} .benzo-masonry-posts' => '--grid-gap: {{SIZE}}px;',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'post_item_style',
            [
                'label' => esc_html__( 'Post Item', 'benzo-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'post_item_padding',
            [
                'label'      => esc_html__( 'Margin', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .post-tab-item .benzo-post-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_item_margin',
            [
                'label'      => esc_html__( 'Padding', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .post-tab-item .benzo-post-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'post_item_bg',
            [
                'label'     => esc_html__( 'Background Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-tab-item .benzo-post-box' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'post_item_border',
                'selector' => '{{WRAPPER}} .post-tab-item .benzo-post-box',
            ]
        );

        $this->add_control(
            'masonry_post_media_overly',
            [
                'label'     => esc_html__( 'Overly Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-masonry-posts .benzo-post-box .post-media::before' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'tab_layout' => 'masonry-layout',
                ],
            ]
        );

        $this->add_responsive_control(
            'masonry_post_media_overly_opacity',
            [
                'label'      => esc_html__( 'opacity', 'benzo-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0.1,
                        'max'  => 1,
                        'step' => 0.1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-masonry-posts .benzo-post-box.image-background .post-media::before'     => 'opacity: {{SIZE}};',
                    '{{WRAPPER}} .benzo-masonry-posts .benzo-post-box.image-hover-bg:hover .post-media::before' => 'opacity: {{SIZE}};',
                ],
                'condition'  => [
                    'tab_layout' => 'masonry-layout',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'post_media_style',
            [
                'label'     => esc_html__( 'Post Media', 'benzo-toolkit' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'tab_layout' => 'grid-layout',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_media_margin',
            [
                'label'      => esc_html__( 'Margin', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-post-box .post-media' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_media_width',
            [
                'label'      => esc_html__( 'Width', 'benzo-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-post-box .post-media' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'grid_post_layout!' => 'image-hover-bg',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_media_height',
            [
                'label'      => esc_html__( 'Height', 'benzo-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-post-box .post-media' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'grid_post_layout!' => 'image-hover-bg',
                ],
                'separator'  => 'after',
            ]
        );

        $this->add_control(
            'post_media_overly',
            [
                'label'      => esc_html__( 'Overly Color', 'benzo-toolkit' ),
                'type'       => Controls_Manager::COLOR,
                'selectors'  => [
                    '{{WRAPPER}} .benzo-post-boxes .benzo-post-box .post-media::before' => 'background: {{VALUE}}',
                ],
                'conditions' => [
                    'relation' => 'or',
                    'terms'    => [
                        [
                            'name'     => 'grid_post_layout',
                            'operator' => '==',
                            'value'    => 'image-background',
                        ],
                        [
                            'name'     => 'grid_post_layout',
                            'operator' => '==',
                            'value'    => 'image-hover-bg',
                        ],
                    ],
                ],
            ]
        );

        $this->add_responsive_control(
            'post_media_overly_opacity',
            [
                'label'      => esc_html__( 'opacity', 'benzo-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0.1,
                        'max'  => 1,
                        'step' => 0.1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-post-boxes .benzo-post-box.image-background .post-media::before'     => 'opacity: {{SIZE}};',
                    '{{WRAPPER}} .benzo-post-boxes .benzo-post-box.image-hover-bg:hover .post-media::before' => 'opacity: {{SIZE}};',
                ],
                'conditions' => [
                    'relation' => 'or',
                    'terms'    => [
                        [
                            'name'     => 'grid_post_layout',
                            'operator' => '==',
                            'value'    => 'image-background',
                        ],
                        [
                            'name'     => 'grid_post_layout',
                            'operator' => '==',
                            'value'    => 'image-hover-bg',
                        ],
                    ],
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'post_content_style',
            [
                'label' => esc_html__( 'Post Content', 'benzo-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'post_content_bg',
            [
                'label'     => esc_html__( 'Background Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-post-box .post-content' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'post_content_border',
                'selector' => '{{WRAPPER}} .benzo-post-box .post-content',
            ]
        );

        $this->add_responsive_control(
            'post_content_padding',
            [
                'label'      => esc_html__( 'Margin', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-post-box .post-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_content_margin',
            [
                'label'      => esc_html__( 'Padding', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-post-box .post-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_heading',
            [
                'label'     => esc_html__( 'Title', 'benzo-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-post-box .post-content .post-title a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label'     => esc_html__( 'Color(Hover)', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-post-box .post-content .post-title:hover a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .benzo-post-box .post-content .post-title',
            ]
        );

        $this->add_control(
            'excerpt_heading',
            [
                'label'     => esc_html__( 'Excerpt', 'benzo-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'show_excerpt' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'excerpt_color',
            [
                'label'     => esc_html__( 'Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-post-box .post-content p' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'show_excerpt' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'excerpt_typography',
                'selector'  => '{{WRAPPER}} .benzo-post-box .post-content p',
                'condition' => [
                    'show_excerpt' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'meta_heading',
            [
                'label'     => esc_html__( 'Post Meta', 'benzo-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'meta_3_color',
            [
                'label'     => esc_html__( 'Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-post-box .post-content .post-meta'   => 'color: {{VALUE}}',
                    '{{WRAPPER}} .benzo-post-box .post-content .post-meta a' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'meta_design' => 'meta-design-three',
                ],
            ]
        );

        $this->add_control(
            'meta_3_cat_color',
            [
                'label'     => esc_html__( 'Categories Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-post-box .post-content .post-meta .post-categories a' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'meta_design' => 'meta-design-three',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'meta_3_typography',
                'selector'  => '{{WRAPPER}} .benzo-post-box .post-content .post-meta',
                'condition' => [
                    'meta_design' => 'meta-design-three',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'     => esc_html__( 'Categories Typography', 'benzo-toolkit' ),
                'name'      => 'category_typography',
                'selector'  => '{{WRAPPER}} .benzo-post-box.meta-design-one .post-categories a, {{WRAPPER}} .benzo-post-box.meta-design-two .post-categories a',
                'condition' => [
                    'meta_design!' => 'meta-design-three',
                ],
            ]
        );

        $this->add_control(
            'category_color',
            [
                'label'     => esc_html__( 'Categories Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-post-box.meta-design-one .post-categories a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .benzo-post-box.meta-design-two .post-categories a' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'meta_design!' => 'meta-design-three',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'     => esc_html__( 'Author Typography', 'benzo-toolkit' ),
                'name'      => 'author_typography',
                'selector'  => '{{WRAPPER}} .benzo-post-box .post-content .post-author-date .author-name',
                'condition' => [
                    'meta_design!' => 'meta-design-three',
                ],
            ]
        );

        $this->add_control(
            'author_color',
            [
                'label'     => esc_html__( 'Author Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-post-box .post-content .post-author-date .author-name' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'meta_design!' => 'meta-design-three',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'     => esc_html__( 'Date Typography', 'benzo-toolkit' ),
                'name'      => 'date_typography',
                'selector'  => '{{WRAPPER}} .benzo-post-box .post-content .post-author-date .post-date',
                'condition' => [
                    'meta_design!' => 'meta-design-three',
                ],
            ]
        );

        $this->add_control(
            'date_color',
            [
                'label'     => esc_html__( 'Date Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-post-box .post-content .post-author-date .post-date' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'meta_design!' => 'meta-design-three',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        $query = Benzo_Query_Builder::build_query( $settings );

        if ( 'masonry-layout' === $settings['tab_layout'] ) {
            $post_layout = $settings['masonry_post_layout'];
            $column      = '';
        } else {
            $column      = [$settings['desktop_column'], $settings['tab_column'], $settings['mobile_column']];
            $post_layout = $settings['grid_post_layout'];
        }

        $options = [
            'tab_layout'     => $settings['tab_layout'],
            'masonry_layout' => $settings['masonry_layout'],
            'post_layout'    => $post_layout,
            'meta_design'    => $settings['meta_design'],
            'show_category'  => $settings['show_category'],
            'show_date'      => $settings['show_date'],
            'show_author'    => $settings['show_author'],
            'show_category'  => $settings['show_category'],
            'show_excerpt'   => $settings['show_excerpt'],
            'excerpt_word'   => $settings['excerpt_word'],
            'title_word'     => $settings['title_word'],
            'title_tag'      => $settings['title_tag'],
            'show_read_more' => $settings['show_read_more'],
            'read_more_text' => $settings['read_more_text'],
            'thumbnail_size' => $settings['thumbnail_size'],
            'column'         => $column,
        ];

        $data = [
            'options' => $options,
            'query'   => $query->query,
        ];

        $data  = htmlspecialchars( json_encode( $data ), ENT_QUOTES, 'UTF-8' );
        $nonce = wp_create_nonce( 'benzo-post-tab' );
        ?>
        <div class="benzo-post-tab">
            <?php $this->filter_nav( $query->query )?>
            <div class="post-tab-item">
                <?php Benzo_Post_Templates::render_post_tab( $query, $options );?>
            </div>
            <span class="ajax-load-data" data-ajax_data="<?php echo $data ?>" data-nonce="<?php echo $nonce ?>"></span>
        </div>
        <?php
}

    public function filter_nav( $param ) {
        $include_category = isset( $param['category_name'] ) ? $param['category_name'] : [];
        $exclude          = isset( $param['category__not_in'] ) ? $param['category__not_in'] : [];
        $include          = [];

        if ( ! empty( $include_category ) && isset( $include_category ) ) {
            $include_category = explode( ", ", $include_category );
            foreach ( $include_category as $key => $value ) {
                $idObj = get_category_by_slug( $value );
                if ( $idObj ) {
                    $id_list[] = $idObj->term_id;
                }
            }
            $include = implode( ',', $id_list );
        }

        $args = [
            'taxonomy'   => 'category',
            'hide_empty' => true,
        ];

        if ( $exclude ) {
            $args['exclude'] = $exclude;
        } else {
            $args['include'] = $include;
        }

        $cats = get_terms( $args );
        if ( empty( $cats ) ) {
            return;
        }
        ?>
        <div class="post-filter-nav">
            <ul>
                <li><a href="#" data-id="all" class="active"><?php echo esc_html( 'All' ) ?></a></li>
                <?php foreach ( $cats as $cat ): ?>
                <li>
                    <a href="<?php echo esc_url( get_term_link( $cat->term_id, 'category' ) ) ?>" data-id="<?php echo esc_attr( $cat->term_id ) ?>">
                        <?php echo esc_html( $cat->name ) ?>
                    </a>
                </li>
                <?php endforeach;?>
            </ul>
        </div>
        <?php
}
}