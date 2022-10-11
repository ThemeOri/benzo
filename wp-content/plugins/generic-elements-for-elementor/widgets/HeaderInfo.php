<?php

namespace Generic\Elements;

defined('ABSPATH') || die();

class HeaderInfo extends GenericWidget
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
        return 'generic-header-info';
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
        return esc_html__('Header Info', 'generic-elements');
    }

    public function get_custom_help_url()
    {
        return 'http://elementor.bdevs.net/bdevselement/generic-header-info/';
    }

    public function get_style_depends()
    {
        return ['bootstrap', 'fontawesome', 'gen-editor', 'generic-element-css'];
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
        return 'eicon-info-circle-o gen-icon';
    }

    public function get_keywords()
    {
        return ['Generic', 'header', 'info', 'logo', 'header', 'navigation', 'nav', 'header list', 'list'];
    }

    public function get_categories()
    {
        return ['generic-elements'];
    }

    // register_content_controls
    protected function register_content_controls()
    {
        $this->header_info_content_controls();
        $this->header_info_settings();
    }


    // header_info_content_controls
    protected function header_info_content_controls()
    {
        $this->start_controls_section(
            'section_generic_header_info',
            [
                'label' => esc_html__('Header Info', 'generic-elements'),
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'generic_header_info_icons',
            [
                'label'         => esc_html__('Icon', 'generic-elements'),
                'label_block'   => true,
                'type'          => \Elementor\Controls_Manager::ICONS,
                'default'       => [
                    'value'         => 'eicon-mail',
                    'library' => 'solid',
                ],

            ]
        );

        $repeater->add_control(
            'generic_header_info_text',
            [
                'label' => esc_html__('List Item Text', 'generic-elements'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'example@gmail.com',
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater->add_control(
            'generic_header_info_link',
            [
                'label' => esc_html__('Link', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://example.com', 'generic-elements'),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'generic_header_info_group',
            [
                'label' => esc_html__('Header Info', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'generic_header_info_text' => esc_html__('info@example.com', 'generic-elements'),
                    ],

                ],
                'title_field' => '{{{ generic_header_info_text }}}',
            ]
        );
        $this->end_controls_section();
    }

    // header_info_settings
    protected function header_info_settings()
    {
        $this->start_controls_section(
            'section_generic_header_info_settings',
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
                    '{{WRAPPER}} .generic-el-header-info' => 'text-align: {{VALUE}};',
                ],
                'frontend_available' => true,
                'toggle' => true,
            ]
        );

        $this->add_control(
            'generic_header_info_translatex',
            [
                'label' => esc_html__('Header Info Translate X', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-header-info' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_control(
            'generic_header_info_translatey',
            [
                'label' => esc_html__('Header Info Translate Y', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-header-info' => '-webkit-transform: translateY({{SIZE}}{{UNIT}}); transform: translateY({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->end_controls_section();
    }

    // register_style_controls
    protected function register_style_controls()
    {
        $this->header_info_content_style_controls();
    }


    // header_info_content_style_controls
    protected function header_info_content_style_controls()
    {
        $this->start_controls_section(
            'generic_header_info_icon_style_controls',
            [
                'label' => esc_html__('Header Info', 'generic-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'generic_header_info_list_margin',
            [
                'label' => esc_html__('Margin', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-header-info > li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'generic_header_info_list_padding',
            [
                'label' => esc_html__('Padding', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-header-info > li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'generic_header_info_list_text_color',
            [
                'label' => esc_html__('Text Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .generic-el-header-info > li > a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'generic_header_info_list_bg_color',
            [
                'label'     => esc_html__('Background Color', 'generic-elements'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-header-info > li' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'header_info_list_typography',
                'label' => esc_html__('Typography', 'generic-elements'),
                'selector' => '{{WRAPPER}} .generic-el-header-info > li > a',
            ]
        );

        $this->add_control(
            'header_info_icon_label',
            [
                'label'     => esc_html__('Icon', 'generic-elements'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'generic_info_icon_color',
            [
                'label' => esc_html__('Icon Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .generic-el-header-info > li > a i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .generic-el-header-info > li > a svg path'   => 'stroke: {{VALUE}}; fill: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'generic_info_list_icon_size',
            [
                'label' => esc_html__('Icon Size', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                        'step' => 5,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-header-info > li > a i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .generic-el-header-info > li > a svg' => 'max-width: {{SIZE}}{{UNIT}}; height: auto',
                ],
            ]
        );
        $this->add_responsive_control(
            'generic_info_list_icon_spacing',
            [
                'label' => esc_html__('Icon Spacing', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'size' => 10,
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-header-info > li > a i, {{WRAPPER}} .generic-el-header-info > li > a svg' => 'margin-right: {{SIZE}}{{UNIT}};',
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
        <ul class="generic-el-header-info">
            <?php
            if ($settings['generic_header_info_group']) {
                foreach ($settings['generic_header_info_group'] as $key => $item) {
                    if (!empty($item['generic_header_info_link']['url'])) {
                        $this->add_link_attributes('link-' . $key, $item['generic_header_info_link']);
                    }
            ?>
                    <li>
                        <a <?php echo $this->get_render_attribute_string('link-' . $key); ?>>
                            <?php \Elementor\Icons_Manager::render_icon($item['generic_header_info_icons'], ['aria-hidden' => 'true']); ?>
                            <?php echo esc_html($item['generic_header_info_text']); ?>
                        </a>
                    </li>
            <?php
                }
            }
            ?>
        </ul>

<?php
    }
}
