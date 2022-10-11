<?php

namespace Generic\Elements;

defined('ABSPATH') || die();

class FooterMenuList extends GenericWidget
{
    /**
     * Get widget name.
     *
     * Retrieve Generic Elements widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */

    public function get_name()
    {
        return 'generic-footer-menu-list';
    }

    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */

    public function get_title()
    {
        return esc_html__('Footer Menu List', 'generic-elements');
    }

    public function get_custom_help_url()
    {
        return 'http://elementor.bdevs.net//widgets/generic-footer-menu-list/';
    }

    public function get_style_depends()
    {
        return ['bootstrap', 'magnific-popup', 'fontawesome', 'generic-element-css', 'generic-elements-pro-css', 'generic-editor-pro'];
    }

    public function get_script_depends()
    {
        return ['bootstrap', 'magnific-popup', 'generic-elements-pro-js'];
    }


    /**
     * Get widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */

    public function get_icon()
    {
        return 'eicon-bullet-list gen-icon';
    }

    public function get_keywords()
    {
        return ['footer', 'menu', 'menulist', 'list', 'icon', 'cat', 'lists'];
    }
    public function get_categories()
    {
        return ['generic-elements'];
    }


    // register_content_controls
    protected function register_content_controls()
    {
        $this->categories_list_content_controls();
    }

    // categories_list_content_controls
    protected function categories_list_content_controls()
    {
        $this->start_controls_section(
            '_section_categories_list',
            [
                'label' => esc_html__('List', 'generic-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'eicon-check',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $repeater->add_control(
            'categories_list_icon_color',
            [
                'label' => esc_html__('Icon Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#592DEE',
                'frontend_available' => true,
                'selectors' => [
                    '{{WRAPPER}}  {{CURRENT_ITEM}} i' => 'color: {{VALUE}};',
                ],
                'style_transfer' => true,
                'frontend_available' => true,
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__('List Title', 'generic-elements'),
                'placeholder' => esc_html__('Type Icon Box Title', 'generic-elements'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'slide_url',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => false,
                'placeholder' => esc_html__('Type link here', 'generic-elements'),
                'default' => esc_html__('#', 'generic-elements'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'slides',
            [
                'show_label' => false,
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(title || "Carousel Item"); #>',
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label'     => esc_html__('Alignment', 'generic-elements'),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => esc_html__('Left', 'generic-elements'),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'generic-elements'),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__('Right', 'generic-elements'),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .categories-list-inner' => 'text-align: {{VALUE}};', '{{VALUE}}',
                ],
                'selectors_dictionary' => [
                    'left' => '-webkit-box-pack: start; -ms-flex-pack: start; justify-content: flex-start; text-align: left',
                    'center' => '-webkit-box-pack: center; -ms-flex-pack: center; justify-content: center; text-align: center',
                    'right' => '-webkit-box-pack: end; -ms-flex-pack: end; justify-content: flex-end; text-align: right',
                ],
            ]
        );

        $this->end_controls_section();

        $this->end_controls_section();
    }


    // register_style_controls
    protected function register_style_controls()
    {
        $this->categories_icon_style_controls();
        $this->categories_ist_item_style_controls();
    }

    // categories_icon_style_controls
    protected function categories_icon_style_controls()
    {
        $this->start_controls_section(
            '_section_style_content',
            [
                'label' => esc_html__('Icon', 'generic-elements'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'icon_font_size',
            [
                'label' => esc_html__('Font Size', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'max' => 150,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .categories-list-inner ul li i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_padding',
            [
                'label' => esc_html__('Padding', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .categories-list-inner ul li i' => 'padding: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_spacing',
            [
                'label' => esc_html__('Right Spacing', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'max' => 150,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .categories-list-inner ul li i' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__('Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .categories-list-inner ul li i' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'icon_bg_color',
            [
                'label' => esc_html__('Background Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .categories-list-inner ul li i' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'icon_border',
                'selector' => '{{WRAPPER}} .categories-list-inner ul li i'
            ]
        );

        $this->add_responsive_control(
            'icon_border_radius',
            [
                'label' => esc_html__('Border Radius', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .categories-list-inner ul li i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'icon_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .categories-list-inner ul li i'
            ]
        );

        $this->end_controls_section();
    }

    // categories_ist_item_style_controls
    protected function categories_ist_item_style_controls()
    {
        $this->start_controls_section(
            '_section_list_item_style_content',
            [
                'label' => esc_html__('List Item', 'generic-elements'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title',
                'selector' => '{{WRAPPER}} .categories-list-inner ul li a',
            ]
        );

        $this->add_responsive_control(
            'categories_list_bottom_spacing',
            [
                'label' => esc_html__('Bottom Spacing', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .categories-list-inner ul li' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Title
        $this->add_control(
            '_heading_title',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Title', 'generic-elements'),
                'separator' => 'before'
            ]
        );

        $this->start_controls_tabs('_categoris_list_color');

        $this->start_controls_tab(
            '_cat_list_color_normal',
            [
                'label' => esc_html__('Normal', 'generic-elements'),
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Text Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .categories-list-inner ul li a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'cat_list_icon_color',
            [
                'label' => esc_html__('Categories Icon Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .categories-list-inner ul li a i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_cat_list_hover_color_normal',
            [
                'label' => esc_html__('Hover', 'generic-elements'),
            ]
        );
        $this->add_control(
            'title_hover_color',
            [
                'label' => esc_html__('Text Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .categories-list-inner ul li a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'cat_list_icon_hover_color',
            [
                'label' => esc_html__('Categories Icon Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .categories-list-inner ul li:hover a i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }


    /**
     * Render widget output on the frontend.
     *
     * Used to generate the final HTML displayed on the frontend.
     *
     * @since 1.0.0
     * @access public
     */

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $this->add_inline_editing_attributes('title', 'basic');
        $this->add_render_attribute('title', 'class', '.generic-el-title');
?>

        <div class="generic-el-categories-list-wrapper">
            <div class="categories-list-inner">
                <ul>
                    <?php foreach ($settings['slides'] as $slide) : ?>
                        <li class="elementor-repeater-item-<?php echo esc_attr($slide['_id']); ?>">
                            <a href="<?php echo esc_url($slide['slide_url']); ?>">
                                <?php \Elementor\Icons_Manager::render_icon($slide['icon'], ['aria-hidden' => 'true']); ?>
                                <?php echo wp_kses_post($slide['title']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
<?php
    }
}
