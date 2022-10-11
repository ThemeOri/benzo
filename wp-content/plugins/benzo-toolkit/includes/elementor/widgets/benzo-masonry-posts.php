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

class Benzo_Masonry_Posts extends Widget_Base {

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
        return 'benzo-masonry-posts';
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
        return esc_html__( 'Benzo Masonry Posts', 'benzo-toolkit' );
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
        return 'eicon-posts-masonry';
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
        return ['Benzo', 'post', 'overly', 'masonry', 'blog'];
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
            'masonry_layout',
            [
                'label'   => esc_html__( 'Masonry Layout', 'benzo-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'layout-one'   => esc_html__( 'Layout One', 'benzo-toolkit' ),
                    'layout-two'   => esc_html__( 'Layout Two', 'benzo-toolkit' ),
                    'layout-three' => esc_html__( 'Layout Three', 'benzo-toolkit' ),
                    'layout-four'  => esc_html__( 'Layout Four', 'benzo-toolkit' ),
                    'layout-five'  => esc_html__( 'Layout Five', 'benzo-toolkit' ),
                    'layout-six'   => esc_html__( 'Layout Six', 'benzo-toolkit' ),
                    'layout-seven' => esc_html__( 'Layout Seven', 'benzo-toolkit' ),
                ],
                'default' => 'layout-one',
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
            'post_layout',
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
            'navigation_type',
            [
                'label'     => esc_html__( 'Navigation Type', 'benzo-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'none'       => esc_html__( 'None', 'benzo-toolkit' ),
                    'pagination' => esc_html__( 'Pagination', 'benzo-toolkit' ),
                    'load-more'  => esc_html__( 'Load More', 'benzo-toolkit' ),
                ],
                'default'   => 'none',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label'     => esc_html__( 'Button Text', 'benzo-toolkit' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => esc_html__( 'Load More', 'benzo-toolkit' ),
                'condition' => [
                    'navigation_type' => 'load-more',
                ],
            ]
        );

        $this->add_control(
            'button_ajax',
            [
                'label'        => esc_html__( 'Enable Ajax?', 'benzo-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes',
                'condition'    => [
                    'navigation_type' => 'load-more',
                ],
            ]
        );

        $this->add_control(
            'button_url',
            [
                'label'      => esc_html__( 'Button URL', 'benzo-toolkit' ),
                'type'       => Controls_Manager::URL,
                'default'    => [
                    'url' => '#',
                ],
                'conditions' => [
                    'relation' => 'and',
                    'terms'    => [
                        [
                            'name'     => 'navigation_type',
                            'operator' => '==',
                            'value'    => 'load-more',
                        ],
                        [
                            'name'     => 'button_ajax',
                            'operator' => '!=',
                            'value'    => 'yes',
                        ],
                    ],
                ],
            ]
        );

        $this->end_controls_section();

        Benzo_Query_Builder::render_loop_options( $this, ['post_type' => 'post'] );

        $this->start_controls_section(
            'wrapper_style',
            [
                'label' => esc_html__( 'Wrapper Style', 'benzo-toolkit' ),
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
                    '{{WRAPPER}} .benzo-masonry-posts' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wrapper_padding',
            [
                'label'      => esc_html__( 'Padding', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-masonry-posts' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'wrapper_border',
                'selector' => '{{WRAPPER}} .benzo-masonry-posts',
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
                    '{{WRAPPER}} .benzo-masonry-posts .benzo-post-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .benzo-masonry-posts .benzo-post-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'post_item_bg',
            [
                'label'     => esc_html__( 'Background Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-masonry-posts .benzo-post-box' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'post_item_border',
                'selector' => '{{WRAPPER}} .benzo-masonry-posts .benzo-post-box',
            ]
        );

        $this->add_control(
            'post_media_overly',
            [
                'label'     => esc_html__( 'Overly Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-masonry-posts .benzo-post-box .post-media::before' => 'background: {{VALUE}}',
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
                    '{{WRAPPER}} .benzo-masonry-posts .benzo-post-box.image-background .post-media::before'     => 'opacity: {{SIZE}};',
                    '{{WRAPPER}} .benzo-masonry-posts .benzo-post-box.image-hover-bg:hover .post-media::before' => 'opacity: {{SIZE}};',
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
                    '{{WRAPPER}} .benzo-post-boxes .benzo-post-box .post-content' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'post_content_border',
                'selector' => '{{WRAPPER}} .benzo-post-boxes .benzo-post-box .post-content',
            ]
        );

        $this->add_responsive_control(
            'post_content_padding',
            [
                'label'      => esc_html__( 'Margin', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-post-boxes .benzo-post-box .post-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .benzo-post-boxes .benzo-post-box .post-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

        $this->start_controls_section(
            'navigation_style',
            [
                'label'     => esc_html__( 'Navigation Style', 'benzo-toolkit' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'navigation_type!' => 'none',
                ],
            ]
        );

        $this->add_responsive_control(
            'navigation_margin',
            [
                'label'      => esc_html__( 'Margin', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .load-more-btn-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'navigation_alignment',
            [
                'label'       => esc_html__( 'Alignment', 'benzo-toolkit' ),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'toggle'      => false,
                'options'     => [
                    'start'  => [
                        'title' => esc_html__( 'Left', 'benzo-toolkit' ),
                        'icon'  => 'eicon-order-start',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'benzo-toolkit' ),
                        'icon'  => ' eicon-shrink',
                    ],
                    'end'    => [
                        'title' => esc_html__( 'Right', 'benzo-toolkit' ),
                        'icon'  => 'eicon-order-end',
                    ],
                ],
                'default'     => 'center',
                'selectors'   => [
                    '{{WRAPPER}} .load-more-btn-wrap'                    => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .load-more-btn-wrap .benzo-pagination' => 'justify-content: flex-{{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label'      => esc_html__( 'Padding', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .load-more-btn-wrap .load-more-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'navigation_type' => 'load-more',
                ],
            ]
        );

        $this->add_control(
            'button_width',
            [
                'label'        => esc_html__( 'Full Width', 'benzo-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => '100%',
                'selectors'    => [
                    '{{WRAPPER}} .load-more-btn-wrap .load-more-btn' => 'width: {{VALUE}};',
                ],
                'condition'    => [
                    'navigation_type' => 'load-more',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'button_typography',
                'selector' => '{{WRAPPER}} .load-more-btn-wrap .load-more-btn, {{WRAPPER}} .benzo-pagination .page-numbers',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'button_border',
                'selector' => '{{WRAPPER}} .load-more-btn-wrap .load-more-btn, {{WRAPPER}} .benzo-pagination .page-numbers',
            ]
        );

        $this->start_controls_tabs( 'button_tab' );

        $this->start_controls_tab(
            'button_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'benzo-toolkit' ),
            ]
        );

        $this->add_control(
            'btn_normal_color',
            [
                'label'     => esc_html__( 'Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .load-more-btn-wrap .load-more-btn' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .benzo-pagination .page-numbers'   => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'btn_normal_bg',
            [
                'label'     => esc_html__( 'Background Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .load-more-btn-wrap .load-more-btn' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .benzo-pagination .page-numbers'   => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'button_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'benzo-toolkit' ),
            ]
        );

        $this->add_control(
            'btn_hover_color',
            [
                'label'     => esc_html__( 'Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .load-more-btn-wrap .load-more-btn:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .benzo-pagination .page-numbers:hover'   => 'color: {{VALUE}}',
                    '{{WRAPPER}} .benzo-pagination .page-numbers.current' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'btn_hover_bg',
            [
                'label'     => esc_html__( 'Background Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .load-more-btn-wrap .load-more-btn:hover' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .benzo-pagination .page-numbers:hover'   => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .benzo-pagination .page-numbers.current' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'btn_hover_border',
            [
                'label'     => esc_html__( 'Border Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .load-more-btn-wrap .load-more-btn:hover' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .benzo-pagination .page-numbers:hover'   => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .benzo-pagination .page-numbers.current' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

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
        Benzo_Post_Templates::render_masonry_post( $settings );
    }
}