<?php

namespace BdevsElement\Widget;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;
use \BdevsElementor\BDevs_El_Select2;
use \Elementor\Utils;

defined('ABSPATH') || die();


class Woo_Product_Tab extends BDevs_El_Widget
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
        return 'woo_product_tab';
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
        return __('Woo Product Tab', 'bdevselement');
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
        return 'eicon-product-tabs';
    }

    public function get_keywords()
    {
        return ['posts', 'post', 'post-tab', 'tab', 'news'];
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
            'page' => ''
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
            $tax = bdevs_element_get_taxonomies([
                'public' => true,
                "object_type" => [$post_type]
            ], 'object', true);
            $list[$post_type] = count($tax) !== 0 ? $tax : '';
        } else {
            $list = bdevs_element_get_taxonomies(['public' => true], 'object', true);
        }

        return $list;
    }

    protected function register_content_controls()
    {
        $this->start_controls_section(
            '_section_title',
            [
                'label' => __('Title & Description', 'bdevselement'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'bg_image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Image', 'bdevselement' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_3']
                ]
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'bdevselement'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Shop By Categories',
                'placeholder' => __('Heading Text', 'bdevselement'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' => __('Sub Title', 'bdevselement'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Sub Title',
                'placeholder' => __('Sub Title Text', 'bdevselement'),
                'condition' => [
                    'design_style' => ['style_2']
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

         $this->add_control(
            'back_title',
            [
                'label' => __('Back Title', 'bdevselement'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Back Title',
                'placeholder' => __('Back Title Text', 'bdevselement'),
                'condition' => [
                    'design_style' => ['style_2']
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __('Description', 'bdevselement'),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => __('Heading Description Text', 'bdevselement'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

          $this->add_control(
            'extra_button_text',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __( 'Button', 'bdevselement' ),
                'label_block' => true,
                'default' => __('Explore Now', 'bdevselement'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_1','style_2']
                ]
            ]
        );
        $this->add_control(
            'extra_button_link',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __( 'Button Link', 'bdevselement' ),
                'label_block' => true,
                'default' => __('#', 'bdevselement'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_1','style_2']
                ]
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => __('Title HTML Tag', 'elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p',
                ],
                'default' => 'h2',
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __('Alignment', 'bdevselement'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'bdevselement'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'bdevselement'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'bdevselement'),
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

        $this->start_controls_section(
            '_section_post_tab_query',
            [
                'label' => __('Query', 'bdevselement'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'post_type',
            [
                'label' => __('Source', 'bdevselement'),
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
                    'label' => __('Taxonomies', 'bdevselement'),
                    'type' => Controls_Manager::SELECT,
                    'options' => $taxonomy[$key],
                    'default' => key($taxonomy[$key]),
                    'condition' => [
                        'post_type' => $key
                    ],
                ]
            );

            foreach ($taxonomy[$key] as $tax_key => $tax_value) {

                $this->add_control(
                    'tax_ids_' . $tax_key,
                    [
                        'label' => __('Select ', 'bdevselement') . $tax_value,
                        'label_block' => true,
                        'type' => 'bdevselement-select2',
                        'multiple' => true,
                        'placeholder' => 'Search ' . $tax_value,
                        'data_options' => [
                            'tax_id' => $tax_key,
                            'action' => 'bdevs_element_post_tab_select_query'
                        ],
                        'condition' => [
                            'post_type' => $key,
                            'tax_type_' . $key => $tax_key
                        ],
                        'render_type' => 'template',
                    ]
                );
            }
        }

        $this->add_control(
            'item_limit',
            [
                'label' => __('Item Limit', 'bdevselement'),
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
                'label' => __('Settings', 'bdevselement'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'design_style',
            [
                'label' => __('Design Style', 'bdevselement'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __('Style 1', 'bdevselement'),
                    'style_2' => __('Style 2', 'bdevselement'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'excerpt',
            [
                'label' => __('Show Excerpt', 'bdevselement'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevselement'),
                'label_off' => __('Hide', 'bdevselement'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );


        $this->end_controls_section();

    }

    protected function register_style_controls()
    {


        $this->start_controls_section(
            '_section_style_content',
            [
                'label' => __( 'Title / Content', 'bdevselement' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_responsive_control(
            'content_padding',
            [
                'label' => __( 'Content Padding', 'bdevselement' ),
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

        //Section Title
        $this->add_control(
            '_heading_section_title',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Section Title', 'bdevselement' ),
                'separator' => 'before'
            ]
        );
        
        $this->add_responsive_control(
            '_section_title_spacing',
            [
                'label' => __( 'Bottom Spacing', 'bdevselement' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-title-section' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            '_section_title_color',
            [
                'label' => __( 'Text Color', 'bdevselement' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-title-section' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => '_section_title',
                'selector' => '{{WRAPPER}} .bdevs-el-title-section',
                'scheme' => Typography::TYPOGRAPHY_2,
            ]
        );

        //Section SubTitle
        $this->add_control(
            '_heading_section_subtitle',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'SubTitle', 'bdevselement' ),
                'separator' => 'before'
            ]
        );
        
        $this->add_responsive_control(
            '_section_subtitle_spacing',
            [
                'label' => __( 'Bottom Spacing', 'bdevselement' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-subtitle-section' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            '_section_subtitle_color',
            [
                'label' => __( 'Text Color', 'bdevselement' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-subtitle-section' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => '_section_subtitle',
                'selector' => '{{WRAPPER}} .bdevs-el-subtitle-section',
                'scheme' => Typography::TYPOGRAPHY_2,
            ]
        );

        // Description
        $this->add_control(
            '_content_description',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Description', 'bdevselement' ),
                'separator' => 'before'
            ]
        );
        
        $this->add_responsive_control(
            'description_spacing',
            [
                'label' => __( 'Bottom Spacing', 'bdevselement' ),
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
                'label' => __( 'Text Color', 'bdevselement' ),
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

         // Button 1 style
        $this->add_control(
            '_heading_section_button_',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Button', 'bdevselement' ),
                'separator' => 'before'
            ]
        );
        

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __( 'Padding', 'bdevselement' ),
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
                'label' => __( 'Border Radius', 'bdevselement' ),
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
                'label' => __( 'Normal', 'bdevselement' ),
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => __( 'Text Color', 'bdevselement' ),
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
                'label' => __( 'Background Color', 'bdevselement' ),
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
                'label' => __( 'Hover', 'bdevselement' ),
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label' => __( 'Text Color', 'bdevselement' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn:hover, {{WRAPPER}} .bdevs-el-btn:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color',
            [
                'label' => __( 'Background Color', 'bdevselement' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn:hover, {{WRAPPER}} .bdevs-el-btn:focus, {{WRAPPER}} .bdevs-el-btn:before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => __( 'Border Color', 'bdevselement' ),
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

        $this->start_controls_section(
            '_section_post_tab_filter',
            [
                'label' => __('Tab', 'bdevselement'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'tab_margin_btm',
            [
                'label' => __('Margin Bottom', 'bdevselement'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-filter' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'filter_pos' => 'top',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_padding',
            [
                'label' => __('Padding', 'bdevselement'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-filter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'tab_shadow',
                'label' => __('Box Shadow', 'bdevselement'),
                'selector' => '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-filter',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'tab_border',
                'label' => __('Border', 'bdevselement'),
                'selector' => '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-filter',
            ]
        );

        $this->add_responsive_control(
            'tab_item',
            [
                'label' => __('Tab Item', 'bdevselement'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'tab_item_margin',
            [
                'label' => __('Margin', 'bdevselement'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-filter button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_item_padding',
            [
                'label' => __('Padding', 'bdevselement'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-filter button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->start_controls_tabs('tab_item_tabs');
        $this->start_controls_tab(
            'tab_item_normal_tab',
            [
                'label' => __('Normal', 'bdevselement'),
            ]
        );

        $this->add_control(
            'tab_item_color',       
            [
                'label' => __('Color', 'bdevselement'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-filter button span,{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-filter button.active span, {{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-filter button' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'tab_item_background',
                'label' => __('Background', 'bdevselement'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-filter button',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'tab_item_background_active',
                'label' => __('Active Background', 'bdevselement'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-filter button.active, {{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-filter button.active:after',
            ] 
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_item_hover_tab',
            [
                'label' => __('Hover', 'bdevselement'),
            ]
        );

        $this->add_control(
            'tab_item_hvr_color',
            [
                'label' => __('Color', 'bdevselement'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-filter button.active span, {{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-filter button.active' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-filter button:hover span, {{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-filter button:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-filter button.active' => 'border-color: {{VALUE}}'
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'tab_item_hvr_background',
                'label' => __('Background', 'bdevselement'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-filter button.active,{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-filter button:hover',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tab_item_typography',
                'label' => __('Typography', 'bdevselement'),
                'scheme' => Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-filter button',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'tab_item_border',
                'label' => __('Border', 'bdevselement'),
                'selector' => '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-filter button',
            ]
        );

        $this->add_responsive_control(
            'tab_item_border_radius',
            [
                'label' => __('Border Radius', 'bdevselement'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-filter button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->end_controls_section();

        //Column
        $this->start_controls_section(
            '_section_post_tab_column',
            [
                'label' => __('Column', 'bdevselement'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'post_item_space',
            [
                'label' => __('Space Between', 'bdevselement'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item' => 'padding-left: {{SIZE}}{{UNIT}};padding-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_item_margin_btm',
            [
                'label' => __('Margin Bottom', 'bdevselement'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_item_padding',
            [
                'label' => __('Padding', 'bdevselement'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'post_item_background',
                'label' => __('Background', 'bdevselement'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item-inner',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'post_item_box_shadow',
                'label' => __('Box Shadow', 'bdevselement'),
                'selector' => '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item-inner',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'post_item_border',
                'label' => __('Border', 'bdevselement'),
                'selector' => '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item-inner',
            ]
        );

        $this->add_responsive_control(
            'post_item_border_radius',
            [
                'label' => __('Border Radius', 'bdevselement'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->end_controls_section();

        //Content Style
        $this->start_controls_section(
            '_section_post_tab_content',
            [
                'label' => __('Content', 'bdevselement'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'post_content_image',
            [
                'label' => __('Image', 'bdevselement'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_responsive_control(
            'post_item_content_img_margin_btm',
            [
                'label' => __('Margin Bottom', 'bdevselement'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
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
                'label' => __('Border', 'bdevselement'),
                'selector' => '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item-inner .bdevselement-post-tab-thumb img',
            ]
        );

        $this->add_responsive_control(
            'image_boder_radius',
            [
                'label' => __('Border Radius', 'bdevselement'),
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
                'label' => __('Title', 'bdevselement'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'post_content_margin_btm',
            [
                'label' => __('Margin Bottom', 'bdevselement'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
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
                'label' => __('Typography', 'bdevselement'),
                'scheme' => Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item-inner .bdevselement-post-tab-title',
            ]
        );

        $this->start_controls_tabs('title_tabs');
        $this->start_controls_tab(
            'title_normal_tab',
            [
                'label' => __('Normal', 'bdevselement'),
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __('Color', 'bdevselement'),
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
                'label' => __('Hover', 'bdevselement'),
            ]
        );

        $this->add_control(
            'title_hvr_color',
            [
                'label' => __('Color', 'bdevselement'),
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
                'label' => __('Meta', 'bdevselement'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'meta_typography',
                'label' => __('Typography', 'bdevselement'),
                'scheme' => Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-meta span',
            ]
        );

        $this->start_controls_tabs('meta_tabs');
        $this->start_controls_tab(
            'meta_normal_tab',
            [
                'label' => __('Normal', 'bdevselement'),
            ]
        );

        $this->add_control(
            'meta_color',
            [
                'label' => __('Color', 'bdevselement'),
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
                'label' => __('Hover', 'bdevselement'),
            ]
        );

        $this->add_control(
            'meta_hvr_color',
            [
                'label' => __('Color', 'bdevselement'),
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
                'label' => __('Margin', 'bdevselement'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-meta span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'post_content_excerpt',
            [
                'label' => __('Excerpt', 'bdevselement'),
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
                'label' => __('Typography', 'bdevselement'),
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
                'label' => __('Color', 'bdevselement'),
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
                'label' => __('Margin Top', 'bdevselement'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
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
        if ( empty($settings['post_type']) OR $settings['post_type'] != 'product') {
            return;
        }

        $taxonomy = $settings['tax_type_' . $settings['post_type']];
        $terms_ids = $settings['tax_ids_' . $taxonomy];
        $terms_args = [
            'taxonomy' => $taxonomy,
            'hide_empty' => true,
            'include' => $terms_ids,
            'orderby' => 'term_id',
        ];
        $filter_list = get_terms($terms_args);

        $post_args = [
            'post_status' => 'publish',
            'post_type' => $settings['post_type'],
            'posts_per_page' => $settings['item_limit'],
            'tax_query' => array(
                array(
                    'taxonomy' => $taxonomy,
                    'field' => 'term_id',
                    'terms' => $terms_ids ? $terms_ids : '',
                ),
            ),
        ];
        $posts = get_posts($post_args);
        ?>
        <?php if (!empty($settings['design_style']) and $settings['design_style'] == 'style_3'): 
            $_rand_class = rand(12121, 958415645);

            if( !empty($settings['bg_image']['id']) ) {
                $bg_image = wp_get_attachment_image_url($settings['bg_image']['id'], 'full');
            }

        ?>

        <div class="trending-product-area">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-3 col-lg-3 trending-col-1">
                        <div class="trending-banner">
                            <a href="<?php echo esc_url($settings['extra_button_link']); ?>"><img src="<?php echo esc_url($bg_image); ?>" class="img-fluid" alt="<?php echo esc_html__('banner-img', 'bdevselement'); ?>"></a>
                            <div class="t-banner-content">
                                <?php if( !empty($settings['extra_button_text']) ) : ?>
                                <a href="<?php echo esc_url($settings['extra_button_link']); ?>" class="epix-white-btn-2 bdevs-el-btn"><?php echo bdevs_element_kses_basic($settings['extra_button_text']); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-9 col-lg-9 trending-col-2 bdevselement-post-tab">
                        <div class="trending-right border-bottom-1 mb-25">
                            <div class="row align-items-end">
                                <div class="col-xxl-6 col-md-6">
                                    <?php if( !empty($settings['title']) ) : ?>
                                    <div class="epix-section-title-4 bdevs-el-content">
                                        <h3 class="s-title bdevs-el-title-section"><?php echo bdevs_element_kses_basic($settings['title']); ?></h3>
                                        <?php if(!empty($settings['description'])) : ?>
                                        <p><?php echo bdevs_element_kses_basic($settings['description']); ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div class="product-tabs-2">
                                        <ul class="nav bdevselement-post-tab-filter justify-content-md-end" role="tablist">
                                            <?php
                                            $i = 1;
                                            foreach ($filter_list as $key => $list):
                                                $cat_icon = get_term_meta( $list->term_id, 'product_icon', true );
                                                $active_class = $key == 0 ? 'active' : '';
                                            ?>
                                            <li class="nav-item" role="presentation">
                                                <button class=" <?php echo esc_attr($active_class); ?>" data-bs-toggle="tab" data-bs-target="#tab-1-<?php print $i; ?><?php echo esc_attr($_rand_class); ?>"
                                                    type="button"><?php echo esc_html($list->name); ?> </button>
                                            </li>
                                            <?php $i++; endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-content-2">
                            <div class="tab-content" id="myTabContent<?php echo esc_attr($_rand_class); ?>">

                                <?php
                                    $i = 1;
                                    foreach ($filter_list as $key => $list):
                                    $active_class = $key == 0 ? 'show active' : '';
                                ?> 
                                <div class="tab-pane fade bdevselement-post-tab-item <?php echo esc_attr($active_class); ?>" id="tab-1-<?php print $i; ?><?php echo esc_attr($_rand_class); ?>">
                                    <div class="trending-active swiper-container">
                                        <?php
                                        $post_args = [
                                            'post_status' => 'publish',
                                            'post_type' => $settings['post_type'],
                                            'posts_per_page' => $settings['item_limit'],
                                            'tax_query' => array(
                                                array(
                                                    'taxonomy' => $taxonomy,
                                                    'field' => 'term_id',
                                                    'terms' => !empty($list->term_id) ? $list->term_id : '',
                                                ),
                                            ),
                                        ];
                                        $posts = get_posts($post_args);
                                        ?>
                                        <div class="swiper-wrapper">
                                            <?php foreach ($posts as $post): ?>
                                            <div class="swiper-slide">
                                                <div class="single-product-4 single-trending-product bdevselement-post-tab-item-inner">
                                                    <div class="product-top">
                                                        <div class="wrap">
                                                            <div class="epix_cat_product_rating">
                                                                <?php echo \BdevsElement\BDevs_El_Woocommerce::product_rating($post->ID); ?>
                                                            </div>
                                                            <div class="actions">
                                                                <?php echo \BdevsElement\BDevs_El_Woocommerce::yith_wishlist2($post->ID); ?>
                                                            </div>
                                                        </div>
                                                        <div class="thumb bdevselement-post-tab-thumb">
                                                            <div class="epix-action">
                                                                <?php echo \BdevsElement\BDevs_El_Woocommerce::quick_view_button($post->ID); ?>
                                                                <?php echo \BdevsElement\BDevs_El_Woocommerce::add_to_cart_button($post->ID); ?>
                                                            </div>

                                                            <a href="<?php echo esc_url(get_the_permalink($post->ID)); ?>"><?php echo get_the_post_thumbnail($post->ID, 'full', ['class' => 'img-fluid']); ?></a>
                                                        </div>
                                                    </div>
                                                    <div class="content">
                                                        <h4 class="bdevselement-post-tab-title"><a href="<?php echo esc_url(get_the_permalink($post->ID)); ?>"><?php echo esc_html($post->post_title); ?></a></h4>

                                                        <div class="epix-price-box bdevselement-post-tab-meta">
                                                          <?php echo \BdevsElement\BDevs_El_Woocommerce::product_price($post->ID, true); ?>
                                                        </div>

                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <?php endforeach; ?>

                                        </div>
                                    </div>
                                </div>
                                <?php $i++; endforeach; ?>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <?php elseif (!empty($settings['design_style']) and $settings['design_style'] == 'style_2'): ?>

        <div class="product_section_3 pt-130 pb-120">
            <div class="container">
              <div class="row align-items-center">
                <div class="col col-lg-5">
                  <div class="section_title">
                    <?php if ($settings['sub_title']): ?>
                    <h2 class="sub_title">
                       <?php echo bdevs_element_kses_intermediate($settings['sub_title']); ?>
                      <span class="under_text"><?php echo bdevs_element_kses_intermediate($settings['back_title']); ?></span>
                    </h2>
                     <?php endif; ?>
                    <?php if ($settings['title']): ?>
                    <h3 class="title_text mb-0 bdevs-el-title-section">
                      <?php echo bdevs_element_kses_intermediate($settings['title']); ?>
                    </h3>
                    <?php endif; ?>
                  </div>
                </div>

                <div class="col col-lg-7">
                  <div class="product_tabnav_wrap">
                    <ul class="tabs_nav style_3 nav ul_li" role="tablist">
                        <?php
                            $i = 1;
                            foreach ($filter_list as $key => $list):
                                $cat_icon = get_term_meta( $list->term_id, 'product_icon', true );
                                $active_class = $key == 0 ? 'active' : '';
                        ?>
                      <li>
                        <button class="<?php echo esc_attr($active_class); ?>" data-bs-toggle="tab" data-bs-target="#teb_screen_protector_<?php print $i; ?>" type="button"
                          role="tab" aria-selected="true">
                          <?php echo esc_html($list->name); ?>
                        </button>
                      </li>
                     <?php $i++; endforeach; ?>
                    </ul>
                     <?php if( !empty($settings['extra_button_text']) ) : ?>
                    <a class="btn btn_danger btn_rounded" href="<?php echo esc_url($settings['extra_button_link']); ?>"><?php echo bdevs_element_kses_basic($settings['extra_button_text']); ?></a>
                    <?php endif; ?>
                  </div>
                </div>
              </div>

                <div class="tab-content">
                     <?php
                        $i = 1;
                        foreach ($filter_list as $key => $list):
                        $active_class = $key == 0 ? 'show active' : '';
                     ?>

                    <div class="tab-pane fade show <?php echo esc_attr($active_class); ?>" id="teb_screen_protector_<?php print $i; ?>" role="tabpanel">
                    <?php
                        $post_args = [
                            'post_status' => 'publish',
                            'post_type' => $settings['post_type'],
                            'posts_per_page' => $settings['item_limit'],
                            'tax_query' => array(
                                array(
                                    'taxonomy' => $taxonomy,
                                    'field' => 'term_id',
                                    'terms' => !empty($list->term_id) ? $list->term_id : '',
                                ),
                            ),
                        ];
                        $posts = get_posts($post_args);
                     ?>
                      <div class="product_5col_wrap">
                        <?php foreach ($posts as $post): ?>
                        <div class="col">
                          <div class="product_grid_2 red_effect">
                            <a class="item_image" href="<?php echo esc_url(get_the_permalink($post->ID)); ?>">
                              <?php echo get_the_post_thumbnail($post->ID, 'full', ['class' => 'img-fluid']); ?>
                            </a>
                            <div class="item_content">
                              <h3 class="item_title">
                                <a href="<?php echo esc_url(get_the_permalink($post->ID)); ?>"><?php echo esc_html($post->post_title); ?></a>
                              </h3>
                             <?php echo \BdevsElement\BDevs_El_Woocommerce::product_rating($post->ID); ?>
                              <div class="item_price">
                                <?php echo \BdevsElement\BDevs_El_Woocommerce::product_price($post->ID, true); ?>
                              </div>
                              <ul class="cart_btns_group ul_li">
                                <?php echo \BdevsElement\BDevs_El_Woocommerce::add_to_cart_button($post->ID); ?>
                                <?php echo \BdevsElement\BDevs_El_Woocommerce::yith_wishlist($post->ID); ?>
                              </ul>
                            </div>
                          </div>
                        </div>
                         <?php endforeach; ?>
                      </div>
                    </div>
                    <?php $i++; endforeach; ?>
               </div>

            </div>
        </div>

    <?php else: ?>

        <section class="product_section">
            <div class="product_section_titlee pb-0">
              <div class="container">
                <div class="section_title">
                  <div class="row align-items-center">
                    <div class="col col-lg-6">
                      <?php if ($settings['title']): ?>
                      <h2 class="title_text mb-0 bdevs-el-title-section"><?php echo bdevs_element_kses_intermediate($settings['title']); ?></h2>
                      <?php endif; ?>
                    </div>
                    <div class="col col-lg-6">
                        <?php if( !empty($settings['extra_button_text']) ) : ?>
                      <div class="single_btn_wrap p-0 text-lg-end">
                        <a class="btn btn_danger" href="<?php echo esc_url($settings['extra_button_link']); ?>"><?php echo bdevs_element_kses_basic($settings['extra_button_text']); ?></a>
                      </div>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>

                <ul class="tabs_nav nav" role="tablist">
                    <?php
                        $i = 1;
                        foreach ($filter_list as $key => $list):
                            $cat_icon = get_term_meta( $list->term_id, 'product_icon', true );
                            $active_class = $key == 0 ? 'active' : '';
                    ?>
                      <li>
                        <button class="<?php echo esc_attr($active_class); ?>" data-bs-toggle="tab" data-bs-target="#used_car_tab_<?php print $i; ?>" type="button" role="tab"
                          aria-selected="true"><?php echo esc_html($list->name); ?></button>
                      </li>
                    <?php $i++; endforeach; ?>

                </ul>
              </div>
            </div>
            <div class="container">
              <div class="tab-content">
                <?php
                    $i = 1;
                    foreach ($filter_list as $key => $list):
                    $active_class = $key == 0 ? 'show active' : '';
                ?> 
                <div class="tab-pane fade <?php echo esc_attr($active_class); ?>" id="used_car_tab_<?php print $i; ?>" role="tabpanel">
                    <?php
                        $post_args = [
                            'post_status' => 'publish',
                            'post_type' => $settings['post_type'],
                            'posts_per_page' => $settings['item_limit'],
                            'tax_query' => array(
                                array(
                                    'taxonomy' => $taxonomy,
                                    'field' => 'term_id',
                                    'terms' => !empty($list->term_id) ? $list->term_id : '',
                                ),
                            ),
                        ];
                        $posts = get_posts($post_args);
                    ?>
                  <div class="row">
                    <?php foreach ($posts as $post): ?>
                    <div class="col col-lg-3 col-md-4 col-sm-6">
                      <div class="product_grid_1">
                        <div class="item_image">
                          <?php echo get_the_post_thumbnail($post->ID, 'full', ['class' => 'img-fluid']); ?>
                        </div>
                        <div class="item_content">
                          <h3 class="item_title">
                             <a href="<?php echo esc_url(get_the_permalink($post->ID)); ?>"><?php echo esc_html($post->post_title); ?></a>
                          </h3>
                          <div class="item_price">
                            <span><?php echo \BdevsElement\BDevs_El_Woocommerce::product_price($post->ID, true); ?></span>
                          </div>
                          <?php echo \BdevsElement\BDevs_El_Woocommerce::product_rating($post->ID); ?>
                        </div>
                        <ul class="cart_btns_group ul_li_center">
                            <?php echo \BdevsElement\BDevs_El_Woocommerce::add_to_cart_button($post->ID); ?>
                            <?php echo \BdevsElement\BDevs_El_Woocommerce::yith_wishlist($post->ID); ?>
                        </ul>
                      </div>
                    </div>
                    <?php endforeach; ?>
                  </div>
                </div>
                <?php $i++; endforeach; ?>
              </div>
            </div>
        </section>
    
    <?php
    endif;
    }
}
