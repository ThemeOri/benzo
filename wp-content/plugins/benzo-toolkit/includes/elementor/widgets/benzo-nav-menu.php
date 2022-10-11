<?php
namespace BenzoToolkit\ElementorAddon\Widgets;

use BenzoTheme\Classes\Benzo_Helper;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Benzo_Nav_Menu extends Widget_Base {

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
        return 'benzo-nav-menu';
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
        return esc_html__( 'Benzo Nav Menu', 'benzo-toolkit' );
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
        return 'eicon-nav-menu';
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
     * Retrieve the list of Scripts the widget depended on.
     *
     * Used to set Scripts dependencies required to run the widget.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget Scripts dependencies.
     */
    public function get_script_depends() {
        return ['benzo-theme'];
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
        return ['benzo', 'toolkit', 'header', 'footer', 'nav', 'menu'];
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
            'menu_type',
            [
                'label'   => esc_html__( 'Menu', 'benzo-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'theme-default' => esc_html__( 'Theme Default', 'benzo-toolkit' ),
                    'custom'        => esc_html__( 'Custom Menu', 'benzo-toolkit' ),
                ],
                'default' => 'theme-default',
            ]
        );

        $this->add_control(
            'selected_menu',
            [
                'label'     => esc_html__( 'Select Menu', 'benzo-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => $this->get_menus_list(),
                'condition' => [
                    'menu_type' => 'custom',
                ],
            ]
        );

        $this->add_control(
            'menu_alignment',
            [
                'label'       => esc_html__( 'Menu Alignment', 'benzo-toolkit' ),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'flex-start' => [
                        'title' => esc_html__( 'Left', 'benzo-toolkit' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center'     => [
                        'title' => esc_html__( 'Center', 'benzo-toolkit' ),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'flex-end'   => [
                        'title' => esc_html__( 'Right', 'benzo-toolkit' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'default'     => 'flex-end',
                'toggle'      => false,
                'selectors'   => [
                    '{{WRAPPER}} .benzo-nav-menu .nav-menu-wrapper ul' => 'justify-content: {{VALUE}};',
                ],
                'separator'   => 'before',
            ]
        );

        $this->add_responsive_control(
            'menu_height',
            [
                'label'       => esc_html__( 'Menu Height', 'benzo-toolkit' ),
                'type'        => Controls_Manager::NUMBER,
                'min'         => 0,
                'label_block' => false,
                'selectors'   => [
                    '{{WRAPPER}} .benzo-nav-menu .nav-menu-wrapper ul.primary-menu' => 'height: {{VALUE}}px;',
                    '{{WRAPPER}} .benzo-nav-menu.breakpoint-on'                     => 'height: {{VALUE}}px;',
                ],
            ]
        );

        $this->add_control(
            'slide_panel_heading',
            [
                'label'     => esc_html__( 'Slide Panel', 'benzo-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'breakpoint',
            [
                'label'       => esc_html__( 'Breakpoint', 'benzo-toolkit' ),
                'type'        => Controls_Manager::NUMBER,
                'min'         => 0,
                'default'     => 1024,
                'label_block' => false,
                'description' => esc_html__( 'Define when the toggle will appear?', 'benzo-toolkit' ),
            ]
        );

        $this->add_control(
            'toggle_alignment',
            [
                'label'       => esc_html__( 'Toggle Alignment', 'benzo-toolkit' ),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'flex-start' => [
                        'title' => esc_html__( 'Left', 'benzo-toolkit' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center'     => [
                        'title' => esc_html__( 'Center', 'benzo-toolkit' ),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'flex-end'   => [
                        'title' => esc_html__( 'Right', 'benzo-toolkit' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'default'     => 'flex-end',
                'toggle'      => false,
                'selectors'   => [
                    '{{WRAPPER}} .benzo-nav-menu.breakpoint-on' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'panel_logo_type',
            [
                'label'   => esc_html__( 'Panel Logo', 'benzo-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'default' => esc_html__( 'Default', 'benzo-toolkit' ),
                    'custom'        => esc_html__( 'Custom', 'benzo-toolkit' ),
                ],
                'default' => 'default',
            ]
        );

        $this->add_control(
            'slide_panel_logo',
            [
                'label'   => esc_html__( 'Panel Logo', 'benzo-toolkit' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'panel_logo_type' => 'custom',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'widget_style',
            [
                'label' => esc_html__( 'Menu Items', 'benzo-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'nav_item_spacing',
            [
                'label'       => esc_html__( 'Item Spacing', 'benzo-toolkit' ),
                'type'        => Controls_Manager::NUMBER,
                'label_block' => false,
                'min'         => 0,
                'max'         => 100,
                'selectors'   => [
                    '{{WRAPPER}} .benzo-nav-menu .nav-menu-wrapper li' => 'margin: 0 {{VALUE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'nav_item_padding',
            [
                'label'      => esc_html__( 'Item Padding', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-nav-menu .nav-menu-wrapper li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'menu_item_typography',
                'selector' => '{{WRAPPER}} .benzo-nav-menu .nav-menu-wrapper li a',
            ]
        );

        $this->add_control(
            'submenu_heading',
            [
                'label'     => esc_html__( 'Submenu', 'benzo-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'submenu_bg',
            [
                'label'     => esc_html__( 'Submenu Background', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-nav-menu .nav-menu-wrapper .sub-menu' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'submenu_shadow',
                'selector' => '{{WRAPPER}} .benzo-nav-menu .nav-menu-wrapper .sub-menu',
            ]
        );

        $this->add_control(
            'submenu_item_divider',
            [
                'label'     => esc_html__( 'Item Divider', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-nav-menu .nav-menu-wrapper .sub-menu li:not(:last-child)' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'submenu_item_padding',
            [
                'label'      => esc_html__( 'Item Padding', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-nav-menu .nav-menu-wrapper .sub-menu a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'submenu_item_typography',
                'selector' => '{{WRAPPER}} .benzo-nav-menu .nav-menu-wrapper .sub-menu a',
            ]
        );

        $this->start_controls_tabs( 'nav-menu-tab' );

        $this->start_controls_tab(
            'menu_item_normal',
            [
                'label' => esc_html__( 'Normal', 'benzo-toolkit' ),
            ]
        );

        $this->add_control(
            'menu_item_color',
            [
                'label'     => esc_html__( 'Item Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-nav-menu .nav-menu-wrapper li a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'submenu_item_color',
            [
                'label'     => esc_html__( 'Submenu Item Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-nav-menu .nav-menu-wrapper .sub-menu a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'menu_item_hover',
            [
                'label' => esc_html__( 'Hover/Current', 'benzo-toolkit' ),
            ]
        );

        $this->add_control(
            'menu_item_hover_color',
            [
                'label'     => esc_html__( 'Item Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-nav-menu .nav-menu-wrapper li a:hover'               => 'color: {{VALUE}};',
                    '{{WRAPPER}} .benzo-nav-menu .nav-menu-wrapper li.current_page_item > a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'submenu_item_hover_color',
            [
                'label'     => esc_html__( 'Submenu Item Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-nav-menu .nav-menu-wrapper .sub-menu a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'panel_style',
            [
                'label' => esc_html__( 'Slide Panel', 'benzo-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'toggler_color',
            [
                'label'     => esc_html__( 'Toggler Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-nav-menu .navbar-toggler'       => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .benzo-nav-menu .navbar-toggler .line' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'panel_bg',
            [
                'label'     => esc_html__( 'Background', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-nav-menu .slide-panel-wrapper .slide-panel-content' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'panel_typography',
                'selector' => '{{WRAPPER}} .benzo-nav-menu .slide-panel-wrapper .slide-panel-menu a',
            ]
        );

        $this->add_control(
            'panel_item_divider',
            [
                'label'     => esc_html__( 'Item Divider', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-nav-menu .slide-panel-wrapper ul.primary-menu' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .benzo-nav-menu .slide-panel-wrapper .slide-panel-menu a' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'panel-menu-tab' );

        $this->start_controls_tab(
            'panel_item_normal',
            [
                'label' => esc_html__( 'Normal', 'benzo-toolkit' ),
            ]
        );

        $this->add_control(
            'panel_item_color',
            [
                'label'     => esc_html__( 'Item Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-nav-menu .slide-panel-wrapper .slide-panel-menu a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .benzo-nav-menu .slide-panel-wrapper .slide-panel-close'  => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'panel_item_hover',
            [
                'label' => esc_html__( 'Current', 'benzo-toolkit' ),
            ]
        );

        $this->add_control(
            'panel_item_hover_color',
            [
                'label'     => esc_html__( 'Item Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-nav-menu .slide-panel-wrapper .slide-panel-menu li.current_page_item > a' => 'color: {{VALUE}};',
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
        $settings = $this->get_settings();

        if ( $settings['breakpoint'] ) {
            $breakpoint = $settings['breakpoint'];
        } else {
            $breakpoint = 1024;
        }

        $args = [
            'container'       => 'div',
            'container_class' => 'nav-menu-wrapper nav-' . $settings['menu_alignment'],
            'menu_class'      => 'primary-menu',
            'after'           => '',
            'link_before'     => '<span class="link-text">',
            'link_after'      => '</span>'
        ];

        if ( 'custom' == $settings['menu_type'] && ! empty( $settings['selected_menu'] ) ) {
            $args['menu'] = $settings['selected_menu'];
        } elseif ( has_nav_menu( 'primary_menu' ) ) {
            $args['theme_location'] = 'primary_menu';
        }

        $slide_panel_logo = Benzo_Helper::get_option( 'slide_panel_logo', ['url' => get_template_directory_uri() . '/assets/img/logo.png'] );
        ?>
        <nav class="benzo-nav-menu" data-breakpoint="<?php echo esc_attr( $breakpoint ) ?>">
            <?php wp_nav_menu( $args ); ?>
            <div class="navbar-toggler">
                <span>
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                </span>
            </div>
            <div class="slide-panel-wrapper">
                <div class="slide-panel-overly"></div>
                <div class="slide-panel-content">
                    <div class="slide-panel-close">
                        <i class="fal fa-times"></i>
                    </div>
                    <div class="slide-panel-logo">
                        <?php if ( 'custom' === $settings['panel_logo_type'] ) : ?>
                            <?php if ( $settings['slide_panel_logo']['url'] ): ?>
                                <img src="<?php echo esc_url( $settings['slide_panel_logo']['url'] ) ?>" alt="<?php echo get_bloginfo() ?>">
                            <?php endif;?>
                        <?php else: ?>
                            <?php if ( $slide_panel_logo['url'] ): ?>
                                <img src="<?php echo esc_url( $slide_panel_logo['url'] ) ?>" alt="<?php echo get_bloginfo() ?>">
                            <?php endif;?>
                        <?php endif; ?>
                    </div>
                    <?php
                        $args['container_class'] = 'slide-panel-menu';
                        wp_nav_menu( $args );
                    ?>
                </div>
            </div>
        </nav>
        <?php
    }

    /**
     * Get Menus List
     *
     * @since 1.0.0
     * @access protected
     */
    protected function get_menus_list() {
        $nav_menus = [];
        $terms     = get_terms( 'nav_menu' );
        foreach ( $terms as $term ) {
            $nav_menus[$term->name] = $term->name;
        }

        return $nav_menus;
    }
}