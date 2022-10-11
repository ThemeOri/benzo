<?php

namespace Generic\Elements;

defined('ABSPATH') || die();

class Breadcrumb extends GenericWidget
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
        return 'generic-breadcrumb';
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
        return esc_html__('Generic Breadcrumb', 'generic-elements');
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
        return 'eicon-product-breadcrumbs gen-icon';
    }

    public function get_keywords()
    {
        return ['generic', 'elements', 'breadcrumbs', 'site', 'header', 'navigation', 'nav'];
    }

    public function get_categories()
    {
        return ['generic-elements'];
    }


    // register_content_controls
    protected function register_content_controls()
    {
        $this->breadcrumb_settings_content_controls();
    }

    // breadcrumb_settings_content_controls
    protected function breadcrumb_settings_content_controls()
    {
        $this->start_controls_section(
            'section_breadcrumb_settings',
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
                    '{{WRAPPER}} .generic-page-title-wrapper' => 'text-align: {{VALUE}};',
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
        $this->breadcrumb_style_control();
    }


    // breadcrumb_style_control
    protected function breadcrumb_style_control()
    {
        $this->start_controls_section(
            '_section_style_content',
            [
                'label' => esc_html__('Breadcrumb', 'generic-elements'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Title
        $this->add_control(
            '_breadcrumb_title',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Title', 'generic-elements'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'breadcrumb_title_spacing',
            [
                'label' => esc_html__('Bottom Spacing', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-breadcrumb-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Text Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-breadcrumb-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'breadcrumb-title',
                'selector' => '{{WRAPPER}} .generic-el-breadcrumb-title',
            ]
        );

        // Breacrumb Nav
        $this->add_control(
            '_heading_subtitle',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Breadcrumb Nav', 'generic-elements'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'breadcrumb_nav_color',
            [
                'label' => esc_html__('Nav Text Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} nav.generic-el-breadcrumb-trail.breadcrumbs' => 'color: {{VALUE}}',
                ],
            ]
        );


        $this->add_responsive_control(
            'divider_padding',
            [
                'label' => esc_html__('Divider Spacing', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-breadcrumb-trail span.dvdr ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'breadcrumb-nav',
                'selector' => '{{WRAPPER}} nav.generic-el-breadcrumb-trail.breadcrumbs',
            ]
        );

        $this->end_controls_section();
    }



    // Render Function
    protected function render()
    {
        $settings = $this->get_settings_for_display();

        global $post;
        $breadcrumb_class = '';
        $breadcrumb_show = 1;

        $hide_bg_img = function_exists('get_field') ? get_field('hide_breadcrumb_background_image') : '';

        if (is_front_page() && is_home()) {
            $title = get_theme_mod('breadcrumb_blog_title', esc_html__('Blog', 'generic-elements'));
            $breadcrumb_class = 'home_front_page';
        } elseif (is_front_page()) {
            $title = get_theme_mod('breadcrumb_blog_title', esc_html__('Blog', 'generic-elements'));
            $breadcrumb_show = 0;
        } elseif (is_home()) {
            if (get_option('page_for_posts')) {
                $title = get_the_title(get_option('page_for_posts'));
            }
        } elseif (is_single() && 'post' == get_post_type()) {
            $title = get_the_title();
        } elseif (is_single() && 'product' == get_post_type()) {
            $title = get_theme_mod('breadcrumb_product_details', esc_html__('Shop', 'generic-elements'));
        } elseif (is_single() && 'bdevs-services' == get_post_type()) {
            $title = get_the_title();
        } elseif (is_single() && 'courses' == get_post_type()) {
            $title = esc_html__('Course Details', 'generic-elements');
        } elseif (is_single() && 'bdevs-event' == get_post_type()) {
            $title = esc_html__('Event Details', 'generic-elements');
        } elseif (is_single() && 'bdevs-cases' == get_post_type()) {
            $title = get_the_title();
        } elseif (is_search()) {

            $title = esc_html__('Search Results for : ', 'generic-elements') . get_search_query();
        } elseif (is_404()) {
            $title = esc_html__('Page not Found', 'generic-elements');
        } elseif (is_archive()) {

            $title = get_the_archive_title();
        } else {
            $title = get_the_title();
        }

        $_id = get_the_ID();

        if (is_single() && 'product' == get_post_type()) {
            $_id = $post->ID;
        } elseif (function_exists("is_shop") and is_shop()) {
            $_id = wc_get_page_id('shop');
        } elseif (is_home() && get_option('page_for_posts')) {
            $_id = get_option('page_for_posts');
        }

        $is_breadcrumb = function_exists('get_field') ? get_field('is_it_invisible_breadcrumb', $_id) : '';
        if (!empty($_GET['s'])) {
            $is_breadcrumb = null;
        }

        if (empty($is_breadcrumb) && $breadcrumb_show == 1) {

            $bg_img_from_page = function_exists('get_field') ? get_field('breadcrumb_background_image', $_id) : '';
            $hide_bg_img = function_exists('get_field') ? get_field('hide_breadcrumb_background_image', $_id) : '';

            // get_theme_mod
            $bg_img_url = get_template_directory_uri() . '/assets/img/page-title/page-title.jpg';
            $bg_img = get_theme_mod('breadcrumb_bg_img');
            $generic_el_breadcrumb_shape_switch = get_theme_mod('generic_el_breadcrumb_shape_switch', true);
            $breadcrumb_info_switch = get_theme_mod('breadcrumb_info_switch', true);

            if ($hide_bg_img && empty($_GET['s'])) {
                $bg_img = '';
            } else {
                $bg_img = !empty($bg_img_from_page) ? $bg_img_from_page['url'] : $bg_img;
            }
?>

            <!-- breadcrumb area start -->
            <div class="generic-page-title-wrapper">
                <div class="generic-page-titel-inner">
                    <h2 class="generic-el-breadcrumb-title"><?php echo wp_kses_post($title); ?></h2>
                    <div class="breadcrumb-menu">
                        <nav class="generic-el-breadcrumb-trail breadcrumbs">
                            <?php
                            if (function_exists('bcn_display')) {
                                bcn_display();
                            } ?>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- breadcrumb area end -->

<?php
        }
    }
}
