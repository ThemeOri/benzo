<?php

namespace Generic\Elements;

defined('ABSPATH') || die();

class GenericShoppingCart extends GenericWidget
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
        return 'generic-shopping-cart';
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
        return esc_html__('Generic Shopping Cart', 'generic-elements');
    }

    public function get_custom_help_url()
    {
        return 'http://elementor.bdevs.net/generic-elements/generic-shopping-cart/';
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
        return 'eicon-cart-light gen-icon';
    }

    public function get_keywords()
    {
        return ['Generic', 'shopping cart', 'shopping', 'cart', 'logo', 'header', 'navigation', 'nav'];
    }

    public function get_categories()
    {
        return ['generic-elements'];
    }


    // register_content_controls
    protected function register_content_controls()
    {
        $this->generic_shopping_cart_content_controls();
    }

    protected function generic_shopping_cart_content_controls()
    {
        $this->start_controls_section(
            'section_generic_mini_cart',
            [
                'label' => esc_html__('Generic Mini Cart', 'generic-elements'),
            ]
        );

        $this->add_control(
            'media_type',
            [
                'label'          => esc_html__('Media Type', 'generic-elements'),
                'type'           => \Elementor\Controls_Manager::CHOOSE,
                'label_block'    => false,
                'options'        => [
                    'icon'  => [
                        'title' => esc_html__('Icon', 'generic-elements'),
                        'icon'  => 'far fa-grin-wink',
                    ],
                    'image' => [
                        'title' => esc_html__('Image', 'generic-elements'),
                        'icon'  => 'eicon-image',
                    ],
                ],
                'default'        => 'icon',
                'toggle'         => false,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'image',
            [
                'label'     => esc_html__('Image', 'generic-elements'),
                'type'      => \Elementor\Controls_Manager::MEDIA,
                'default'   => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'media_type' => 'image'
                ],
                'dynamic'   => [
                    'active' => true,
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name'      => 'thumbnail',
                'default'   => 'medium_large',
                'separator' => 'none',
                'exclude'   => [
                    'full',
                    'custom',
                    'large',
                    'shop_catalog',
                    'shop_single',
                    'shop_thumbnail'
                ],
                'condition' => [
                    'media_type' => 'image'
                ]
            ]
        );

        $this->add_control(
            'icons',
            [
                'label'      => esc_html__('Icons', 'generic-elements'),
                'type'       => \Elementor\Controls_Manager::ICONS,
                'show_label' => true,
                'default'    => [
                    'value'   => 'fal fa-shopping-cart',
                    'library' => 'solid',
                ],
                'condition'  => [
                    'media_type' => 'icon',
                ],

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
                    '{{WRAPPER}} .generic-el-mini-card' => 'text-align: {{VALUE}};',
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
        $this->generic_shopping_cart_style_controls();
    }


    protected function generic_shopping_cart_style_controls()
    {
        $this->start_controls_section(
            'section_generic_el_shopping_cart_style',
            [
                'label' => esc_html__('Shopping Cart', 'generic-elements'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'generic_el_cart_padding',
            [
                'label' => esc_html__('Padding', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-mini-card a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'generic_el_cart_margin',
            [
                'label' => esc_html__('Margin', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-mini-card a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'generic_el_cart_border',
                'selector' => '{{WRAPPER}} .generic-el-mini-card a',
            ]
        );

        $this->add_control(
            'generic_el_cart_border_radius',
            [
                'label' => esc_html__('Border Radius', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-mini-card a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'generic_el_cart_box_shadow',
                'selector' => '{{WRAPPER}} .generic-el-mini-card a',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'cart_icon_typography',
                'selector' => '{{WRAPPER}} .generic-el-mini-card a',
            ]
        );


        // color tab
        $this->start_controls_tabs('_tabs_cart_color');

        $this->start_controls_tab(
            '_tab_cart_icon_color',
            [
                'label' => esc_html__('Normal', 'generic-elements'),
            ]
        );


        $this->add_control(
            'cart_icon_color',
            [
                'label' => esc_html__('color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-mini-card a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'cart-background',
                'label' => esc_html__('Background', 'generic-elements'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .generic-el-mini-card a',
            ],
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_cart_icon_hover_color',
            [
                'label' => esc_html__('Hover', 'generic-elements'),
            ]
        );

        $this->add_control(
            'cart_icon_hover_color',
            [
                'label' => esc_html__('Text Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-mini-card a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'cart-hover-background',
                'label' => esc_html__('Background', 'generic-elements'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .generic-el-mini-card a:hover',
            ],
        );

        $this->add_control(
            'cart_icon_hover_border_color',
            [
                'label' => esc_html__('Border', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-mini-card a:hover' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }


    // Render Function
    protected function render()
    {

        $settings = $this->get_settings_for_display();
?>

        <?php if (class_exists('WooCommerce')) : ?>
            <div class="generic-el-mini-card">
                <a class="generic-el-mini-card-icon" href="<?php echo wc_get_cart_url(); ?>">
                    <?php if (!empty($settings['icons']['value'])) : ?>
                        <?php \Elementor\Icons_Manager::render_icon($settings['icons'], ['aria-hidden' => 'true']); ?>
                    <?php elseif ($settings['image']['url'] || $settings['image']['id']) : ?>
                        <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'image'); ?>
                    <?php endif; ?>
                    <span id="generic-el-cart-item" class="cart-count">
                        <?php echo esc_html(WC()->cart->cart_contents_count); ?>
                    </span>
                </a>
                <div class="mini-shopping-cart-box">
                    <?php woocommerce_mini_cart();
                    ?>
                </div>
            </div>
        <?php endif; ?>
<?php
    }
}
