<?php

namespace Generic\Elements;

defined('ABSPATH') || die();

class GenericLogo extends GenericWidget
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
        return 'generic-logo';
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
        return esc_html__('Generic Logo', 'generic-elements');
    }

    public function get_custom_help_url()
    {
        return 'http://elementor.bdevs.net/bdevselement/generic-logo/';
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
        return 'eicon-site-logo gen-icon';
    }

    public function get_keywords()
    {
        return ['Generic', 'logo', 'site', 'logo', 'header', 'navigation', 'nav'];
    }

    public function get_categories()
    {
        return ['generic-elements'];
    }


    // register_content_controls
    protected function register_content_controls()
    {
        $this->generic_logo_content_controls();
    }

    protected function generic_logo_content_controls()
    {
        $this->start_controls_section(
            'section_generic_header_logo',
            [
                'label' => esc_html__('Generic Header Logo', 'generic-elements'),
            ]
        );

        $this->add_control(
            'generic_header_logo',
            [
                'label'     => esc_html__('Add Header Logo', 'generic-elements'),
                'type'      => \Elementor\Controls_Manager::MEDIA,
                'dynamic'   => [
                    'active' => true,
                ],
                'default'   => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'exclude' => ['custom'],
                'include' => [],
                'default' => 'large',
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
                'default' => 'center',
                'selectors'          => [
                    '{{WRAPPER}} .generic-el-logo-wrapper' => 'text-align: {{VALUE}};',
                ],
                'frontend_available' => true,
                'toggle' => true,
            ]
        );

        $this->add_control(
            'generic_logo_url',
            [
                'label' => esc_html__('Generic Logo URL', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('https://your-link.com', 'generic-elements'),
                'placeholder' => esc_html__('#', 'generic-elements'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->end_controls_section();
    }



    // register_style_controls
    protected function register_style_controls()
    {
        $this->generic_logo_content_styles_controls();
    }


    protected function generic_logo_content_styles_controls()
    {
        $this->start_controls_section(
            'section_generic_header_logo_style_controls',
            [
                'label' => esc_html__('Generic Header Logo', 'generic-elements'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'generic_logo_width',
            [
                'label' => esc_html__('Logo Width', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 700,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-logo-wrapper img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'generic_logo_height',
            [
                'label' => esc_html__('Logo Height', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 700,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-logo-wrapper img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'generic_logo_padding',
            [
                'label' => esc_html__('Padding', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-logo-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'generic_logo_border',
                'selector' => '{{WRAPPER}} .generic-el-logo-wrapper',
            ]
        );

        $this->add_control(
            'generic_logo_border_radius',
            [
                'label' => esc_html__('Border Radius', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-logo-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'generic_logo_box_shadow',
                'selector' => '{{WRAPPER}} .generic-el-logo-wrapper',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'logo-background',
                'label' => esc_html__('Background', 'generic-elements'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .generic-el-logo-wrapper',
            ],
        );

        $this->add_control(
            'generic_logo_translatex',
            [
                'label' => esc_html__('Generic Logo Translate X', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-logo-wrapper img' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_control(
            'generic_logo_translatey',
            [
                'label' => esc_html__('Generic Logo Translate Y', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-logo-wrapper img' => '-webkit-transform: translateY({{SIZE}}{{UNIT}}); transform: translateY({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->end_controls_section();
    }


    // Render Function
    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if (!empty($settings['generic_header_logo']['url'])) {
            $generic_header_logo = !empty($settings['generic_header_logo']['id']) ? wp_get_attachment_image_url($settings['generic_header_logo']['id'], $settings['thumbnail_size']) : $settings['generic_header_logo']['url'];
            $generic_header_logo_alt = get_post_meta($settings["generic_header_logo"]["id"], "_wp_attachment_image_alt", true);
        }
?>

        <div class="generic-el-logo-wrapper">
            <a href="<?php echo esc_url($settings['generic_logo_url']); ?>">
                <img src="<?php echo esc_url($generic_header_logo); ?>" alt="<?php echo esc_attr($generic_header_logo_alt); ?>" />
            </a>
        </div>

<?php
    }
}
