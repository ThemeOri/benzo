<?php

namespace Generic\Elements;

defined('ABSPATH') || die();

class Language extends GenericWidget
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
        return 'generic-language';
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
        return esc_html__('Generic Language', 'generic-elements');
    }

    public function get_custom_help_url()
    {
        return 'http://elementor.bdevs.net/bdevselement/generic-language/';
    }

    public function get_style_depends()
    {
        return ['bootstrap', 'fontawesome', 'generic-element-css'];
    }

    public function get_script_depends()
    {
        return ['bootstrap', 'generic-element-js'];
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
        return 'eicon-page-transition gen-icon';
    }

    public function get_keywords()
    {
        return ['Generic', 'language', 'site', 'logo', 'header', 'navigation', 'nav'];
    }

    public function get_categories()
    {
        return ['generic-elements'];
    }

    // register_content_controls
    protected function register_content_controls()
    {
        $this->language_settings_content_controls();
    }


    // language_settings_controls
    protected function language_settings_content_controls()
    {
        $this->start_controls_section(
            'section_language_settings',
            [
                'label' => esc_html__('Settings', 'generic-elements'),
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => esc_html__('Alignment', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'generic-elements'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'generic-elements'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'generic-elements'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors'          => [
                    '{{WRAPPER}} .header-right .lang-icon' => 'text-align: {{VALUE}};',
                ],
                'frontend_available' => true,
                'toggle' => true,
            ]
        );

        $this->end_controls_section();
    }



    // register_style_controls
    protected function register_style_controls()
    {
        $this->language_style_controls();
        $this->language_list_style_controls();
        $this->language_list_panel_style_controls();
    }

    // language_style_controls
    protected function language_style_controls()
    {
        $this->start_controls_section(
            'generic_language_item_style_tab',
            [
                'label' => esc_html__('Language', 'generic-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'language_content_padding',
            [
                'label' => esc_html__('Language Padding', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .header-lang span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'language-border',
                'label' => esc_html__('Border', 'generic-elements'),
                'selector' => '{{WRAPPER}} .header-lang span',
            ]
        );

        $this->add_control(
            'language_border_radius',
            [
                'label' => esc_html__('Border Radius', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .header-lang span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'generic_language_typography',
                'label' => esc_html__('Typography', 'generic-elements'),
                'selector' => '{{WRAPPER}} .header-lang span',
            ]
        );

        // Language color Tab Start
        $this->start_controls_tabs('_tabs_language_color');

        $this->start_controls_tab(
            '_tab_language_color',
            [
                'label' => esc_html__('Normal', 'generic-elements'),
            ]
        );

        $this->add_control(
            'language_text_color',
            [
                'label' => esc_html__('Text Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header-lang span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'generic_language_background',
                'label' => esc_html__('Language Background', 'generic-elements'),
                'types' => ['classic', 'gradient'],
                'devices' => ['desktop'],
                'selector' => '{{WRAPPER}} .header-lang span',
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_language_hover_color',
            [
                'label' => esc_html__('Hover', 'generic-elements'),
            ]
        );

        $this->add_control(
            'language_hover_color',
            [
                'label' => esc_html__('Text Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header-lang span:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'generic_language_hover_background',
                'label' => esc_html__('Language Hover Background', 'generic-elements'),
                'types' => ['classic', 'gradient'],
                'devices' => ['desktop'],
                'selector' => '{{WRAPPER}} .header-lang span:hover',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        // Language color Tab End

        $this->end_controls_section();
    }

    // language_list_style_controls
    protected function language_list_style_controls()
    {
        $this->start_controls_section(
            'generic_language_list_style_tab',
            [
                'label' => esc_html__('Language List', 'generic-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'generic_language_list_items_typography',
                'selector' => '{{WRAPPER}} .header-lang-list li a',
            ]
        );

        $this->add_responsive_control(
            'language_list_vertical_padding',
            [
                'label'              => esc_html__('Language List Vertical Padding', 'generic-elements'),
                'type'               => \Elementor\Controls_Manager::SLIDER,
                'size_units'         => ['px'],
                'range'              => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default'            => [
                    'size' => 8,
                    'unit' => 'px',
                ],
                'selectors'          => [
                    '{{WRAPPER}} .header-lang-list li' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}}',
                ],
                'frontend_available' => true,
            ]
        );

        // Language List Items color Tab Start
        $this->start_controls_tabs(
            'generic_language_list_hover_tabs'
        );
        $this->start_controls_tab(
            'generic_language_list_item_tab',
            [
                'label'    => esc_html__('Normal', 'generic-elements')
            ]
        );

        $this->add_responsive_control(
            'generic_language_list_item_color',
            [
                'label' => esc_html__('Language List item text color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#647589',
                'selectors' => [
                    '{{WRAPPER}} .header-lang-list li a' => 'color: {{VALUE}}',
                ],

            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'generic_language_list_item_hover_tab',
            [
                'label'    => esc_html__('Hover', 'generic-elements')
            ]
        );

        $this->add_responsive_control(
            'generic_ilanguage_list_item_text_color_hover',
            [
                'label' => esc_html__('Language text color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .header-lang-list li a:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .header-lang-list li a:focus' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    // language_list_panel_style_controls
    protected function language_list_panel_style_controls()
    {
        $this->start_controls_section(
            'generic_language_item_panel_style_tab',
            [
                'label' => esc_html__('Language Panel', 'generic-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'generic_language_list_spacing',
            [
                'label' => esc_html__('Spacing', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'devices' => ['desktop', 'tablet'],
                'desktop_default' => [
                    'top' => 15,
                    'right' => 15,
                    'bottom' => 15,
                    'left' => 15,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'top' => 15,
                    'right' => 15,
                    'bottom' => 15,
                    'left' => 15,
                    'unit' => 'px',
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .header-lang-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'generic_language_list_panel_width',
            [
                'label' => esc_html__('Submenu Panel width', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'devices' => ['desktop'],
                'desktop_default' => '130px',
                'tablet_default' => '100px',
                'selectors' => [
                    '{{WRAPPER}} .header-lang-list' => 'min-width: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'generic_language_list_panel_background',
                'label' => esc_html__('Submenu Panel background', 'generic-elements'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .header-lang-list',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'generic_language_list_panel_background_border',
                'label' => esc_html__('Border', 'generic-elements'),
                'selector' => '{{WRAPPER}} .header-lang-list',
            ]
        );

        $this->add_control(
            'generic_language_list_panel_border_radius',
            [
                'label' => esc_html__('Border Radius', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .header-lang-list' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'generic_language_list_panel_box_shadow',
                'selector' => '{{WRAPPER}} .header-lang-list',
            ]
        );


        $this->add_control(
            'generic_language_list_panel_translatex',
            [
                'label' => esc_html__('Generic Submenu Panel Translate X', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -150,
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .header-lang-list' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_control(
            'generic_language_list_panel_translatey',
            [
                'label' => esc_html__('Generic Submenu Panel Translate Y', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -150,
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .header-lang-list' => '-webkit-transform: translateY({{SIZE}}{{UNIT}}); transform: translateY({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->end_controls_section();
    }

    // Render Function
    protected function render()
    {
        $settings = $this->get_settings_for_display();

?>

        <div class="header-right">
            <div class="header-lang">
                <div class="lang-icon">
                    <span>ENG<i class="fas fa-angle-down"></i></span>
                </div>
                <ul class="header-lang-list">
                    <li><a href="#">USA</a></li>
                    <li><a href="#">UK</a></li>
                    <li><a href="#">CA</a></li>
                    <li><a href="#">AU</a></li>
                </ul>
            </div>
        </div>

<?php
    }
}
