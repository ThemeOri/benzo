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

class Benzo_Post_Slider extends Widget_Base {

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
        return 'benzo-post-slider';
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
        return esc_html__( 'Benzo Post Slider', 'benzo-toolkit' );
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
        return 'eicon-post-slider';
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
        return ['Benzo', 'post', 'news', 'slider', 'blog'];
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
            'post_layout',
            [
                'label'   => esc_html__( 'Layout', 'benzo-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'normal-layout'     => esc_html__( 'Normal Layout', 'benzo-toolkit' ),
                    'image-background'  => esc_html__( 'Image Background', 'benzo-toolkit' ),
                    'image-hover-bg'    => esc_html__( 'Image Hover Background', 'benzo-toolkit' ),
                    'image-left'        => esc_html__( 'Image left', 'benzo-toolkit' ),
                    'image-right'       => esc_html__( 'Image Right', 'benzo-toolkit' ),
                    'image-left-boxed'  => esc_html__( 'Image Left Boxed', 'benzo-toolkit' ),
                    'image-right-boxed' => esc_html__( 'Image Right Boxed', 'benzo-toolkit' ),
                ],
                'default' => 'normal-layout',
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

        $this->end_controls_section();

        $this->start_controls_section(
            'slider_content',
            [
                'label' => esc_html__( 'Additional Options', 'benzo-toolkit' ),
            ]
        );

        $this->add_control(
            'column_heading',
            [
                'label'     => esc_html__( 'Items', 'benzo-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'desktop_column',
            [
                'label'   => esc_html__( 'Desktop', 'benzo-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    '1' => esc_html__( 'One', 'benzo-toolkit' ),
                    '2' => esc_html__( 'Two', 'benzo-toolkit' ),
                    '3' => esc_html__( 'Three', 'benzo-toolkit' ),
                    '4' => esc_html__( 'Four', 'benzo-toolkit' ),
                ],
                'default' => '3',
            ]
        );

        $this->add_control(
            'tab_column',
            [
                'label'   => esc_html__( 'Tab', 'benzo-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    '1' => esc_html__( 'One', 'benzo-toolkit' ),
                    '2' => esc_html__( 'Two', 'benzo-toolkit' ),
                    '3' => esc_html__( 'Three', 'benzo-toolkit' ),
                    '4' => esc_html__( 'Four', 'benzo-toolkit' ),
                ],
                'default' => '2',
            ]
        );

        $this->add_control(
            'mobile_column',
            [
                'label'   => esc_html__( 'Mobile', 'benzo-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    '1' => esc_html__( 'One', 'benzo-toolkit' ),
                    '2' => esc_html__( 'Two', 'benzo-toolkit' ),
                    '3' => esc_html__( 'Three', 'benzo-toolkit' ),
                    '4' => esc_html__( 'Four', 'benzo-toolkit' ),
                ],
                'default' => '1',
            ]
        );

        $this->add_control(
            'hr_arrow', [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'arrow',
            [
                'label'   => esc_html__( 'Arrow?', 'benzo-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true'  => esc_html__( 'Yes', 'benzo-toolkit' ),
                    'false' => esc_html__( 'No', 'benzo-toolkit' ),
                ],
            ]
        );

        $this->add_control(
            'dots',
            [
                'label'   => esc_html__( 'Dots?', 'benzo-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true'  => esc_html__( 'Yes', 'benzo-toolkit' ),
                    'false' => esc_html__( 'No', 'benzo-toolkit' ),
                ],
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label'   => esc_html__( 'Autoplay?', 'benzo-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'true',
                'options' => [
                    'true'  => esc_html__( 'Yes', 'benzo-toolkit' ),
                    'false' => esc_html__( 'No', 'benzo-toolkit' ),
                ],
            ]

        );

        $this->add_control(
            'autoplay_time',
            [
                'label'     => esc_html__( 'Autoplay Time', 'benzo-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => '5000',
                'condition' => [
                    'autoplay' => 'true',
                ],
                'options'   => [
                    '1000'  => esc_html__( '1s', 'benzo-toolkit' ),
                    '2000'  => esc_html__( '2s', 'benzo-toolkit' ),
                    '3000'  => esc_html__( '3s', 'benzo-toolkit' ),
                    '4000'  => esc_html__( '4s', 'benzo-toolkit' ),
                    '5000'  => esc_html__( '5s', 'benzo-toolkit' ),
                    '6000'  => esc_html__( '6s', 'benzo-toolkit' ),
                    '7000'  => esc_html__( '7s', 'benzo-toolkit' ),
                    '8000'  => esc_html__( '8s', 'benzo-toolkit' ),
                    '9000'  => esc_html__( '9s', 'benzo-toolkit' ),
                    '10000' => esc_html__( '10s', 'benzo-toolkit' ),
                    '11000' => esc_html__( '11s', 'benzo-toolkit' ),
                    '12000' => esc_html__( '12s', 'benzo-toolkit' ),
                    '13000' => esc_html__( '13s', 'benzo-toolkit' ),
                    '14000' => esc_html__( '14s', 'benzo-toolkit' ),
                    '15000' => esc_html__( '15s', 'benzo-toolkit' ),
                ],
            ]
        );

        $this->end_controls_section();

        Benzo_Query_Builder::render_loop_options( $this, ['post_type' => 'post'] );

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
                    '{{WRAPPER}} .benzo-post-boxes .benzo-post-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .benzo-post-boxes .benzo-post-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'post_item_bg',
            [
                'label'     => esc_html__( 'Background Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-post-boxes .benzo-post-box' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'post_item_border',
                'selector' => '{{WRAPPER}} .benzo-post-boxes .benzo-post-box',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'post_media_style',
            [
                'label' => esc_html__( 'Post Media', 'benzo-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
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
                    'post_layout!' => 'image-hover-bg',
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
                    'post_layout!' => 'image-hover-bg',
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
                            'name'     => 'post_layout',
                            'operator' => '==',
                            'value'    => 'image-background',
                        ],
                        [
                            'name'     => 'post_layout',
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
                            'name'     => 'post_layout',
                            'operator' => '==',
                            'value'    => 'image-background',
                        ],
                        [
                            'name'     => 'post_layout',
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
            'slider_arrow_style',
            [
                'label'     => esc_html__( 'Arrows', 'benzo-toolkit' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'arrow' => 'true',
                ],
            ]
        );

        $this->add_control(
            'arrow_position',
            [
                'label'   => esc_html__( 'Position', 'benzo-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'arrows-left-top'     => esc_html__( 'Left Top', 'benzo-toolkit' ),
                    'arrows-right-top'    => esc_html__( 'Right Top', 'benzo-toolkit' ),
                    'arrows-left-bottom'  => esc_html__( 'Left Bottom', 'benzo-toolkit' ),
                    'arrows-right-bottom' => esc_html__( 'Right Bottom', 'benzo-toolkit' ),
                ],
                'default' => 'arrows-left-top',
            ]
        );

        $this->add_control(
            'arrow_color',
            [
                'label'     => esc_html__( 'Arrow color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-slider-arrows .slick-arrow' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'arrow_bg',
            [
                'label'     => esc_html__( 'Arrow Background', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-slider-arrows .slick-arrow' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'arrow_divider',
            [
                'label'     => esc_html__( 'Arrow Divider', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-slider-arrows::before' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'slider_dots_style',
            [
                'label'     => esc_html__( 'Dots', 'benzo-toolkit' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'dots' => 'true',
                ],
            ]
        );

        $this->add_control(
            'dots_position',
            [
                'label'   => esc_html__( 'Position', 'benzo-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'dots-left-top'      => esc_html__( 'Left Top', 'benzo-toolkit' ),
                    'dots-right-top'    => esc_html__( 'Right Top', 'benzo-toolkit' ),
                    'dots-center-top'    => esc_html__( 'Center Top', 'benzo-toolkit' ),
                    'dots-left-bottom'   => esc_html__( 'Left Bottom', 'benzo-toolkit' ),
                    'dots-right-bottom'  => esc_html__( 'Right Bottom', 'benzo-toolkit' ),
                    'dots-center-bottom' => esc_html__( 'Center Bottom', 'benzo-toolkit' ),
                ],
                'default' => 'dots-right-top',
            ]
        );

        $this->add_control(
            'dots_color',
            [
                'label'     => esc_html__( 'Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-slider-dots .slick-dots li' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'dots_active_color',
            [
                'label'     => esc_html__( 'Color(Active)', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-slider-dots .slick-dots li.slick-active' => 'background-color: {{VALUE}}',
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
        $settings                    = $this->get_settings_for_display();
        $settings['navigation_type'] = 'none';
        Benzo_Post_Templates::render_post_boxes( $settings, true );
    }
}