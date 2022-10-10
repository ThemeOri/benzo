<?php
namespace BenzoToolkit\Helper;

use CSF;

defined( 'ABSPATH' ) || exit;

/**
 * Benzo Toolkit Helper
 */

class Benzo_Theme_Options {
    protected static $instance = null;

    private $options_prefix = 'benzo_options';
    private $menu_slug      = 'benzo_options';
    private $template_builder_url;

    public static function instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function initialize() {
        if ( ! class_exists( 'CSF' ) ) {
            return;
        }

        $this->template_builder_url = admin_url( 'edit.php?post_type=benzo_template' );

        $this->theme_options();
        $this->preloader_section();
        $this->header_section();
        $this->page_title_section();
        $this->footer_section();
        $this->blog_section();
        $this->shop_section();
        $this->error_section();
        $this->search_section();
        $this->color_scheme_section();
        $this->typography_section();
        $this->custom_scrips_section();
        $this->backup_section();
    }

    /**
     * Create Theme Option
     */
    public function theme_options() {
        CSF::createOptions( $this->options_prefix, [
            'menu_title'         => esc_html__( 'Theme Options', 'benzo-toolkit' ),
            'menu_slug'          => $this->menu_slug,
            'framework_title'    => esc_html__( 'Benzo Options', 'benzo-toolkit' ),
            'show_in_customizer' => true,
            'menu_type'          => 'submenu',
            'menu_parent'        => 'benzo_dashboard',
        ] );
    }

    /**
     * Preloader option
     */
    public function preloader_section() {
        CSF::createSection( $this->options_prefix, [
            'title'  => esc_html__( 'Preloader', 'benzo-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Preloader', 'benzo-toolkit' ),
                ],
                [
                    'id'      => 'site_preloader',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Preloader?', 'benzo-toolkit' ),
                    'options' => [
                        'enabled'  => esc_html__( 'Enable', 'benzo-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'benzo-toolkit' ),
                    ],
                    'default' => 'enabled',
                ],
                [
                    'id'          => 'preloader_background',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Preloader background', 'benzo-toolkit' ),
                    'output'      => '#preloader',
                    'output_mode' => 'background-color',
                    'dependency'  => [
                        'site_preloader', '==', 'enabled',
                    ],
                ],
                [
                    'id'         => 'preloader_image',
                    'type'       => 'media',
                    'title'      => esc_html__( 'Preloader Image', 'benzo-toolkit' ),
                    'library'    => 'image',
                    'default'    => [
                        'url'       => BT_ASSETS . '/img/options/preloader.gif',
                        'thumbnail' => BT_ASSETS . '/img/options/preloader.gif',
                    ],
                    'dependency' => [
                        'site_preloader', '==', 'enabled',
                    ],
                ],
            ],
        ] );
    }

    /**
     * Header Options
     */
    public function header_section() {
        CSF::createSection( $this->options_prefix, [
            'id'    => 'header_options',
            'title' => esc_html__( 'Header', 'benzo-toolkit' ),
        ] );

        CSF::createSection( $this->options_prefix, [
            'parent' => 'header_options',
            'title'  => esc_html__( 'General', 'benzo-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'General', 'benzo-toolkit' ),
                ],
                [
                    'type'    => 'notice',
                    'style'   => 'info',
                    'content' => esc_html__( 'If you used theme builder for site header then disable default theme header', 'benzo-toolkit' ),
                ],
                [
                    'id'       => 'default_header',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Default Header', 'benzo-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable Theme default header', 'benzo-toolkit' ),
                    'options'  => [
                        'enabled'  => esc_html__( 'Enable', 'benzo-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'benzo-toolkit' ),
                    ],
                    'default'  => 'enabled',
                ],
                [
                    'type'       => 'notice',
                    'style'      => 'warning',
                    'content'    => esc_html__( 'You disabled default theme header. Set your site header form ', 'benzo-toolkit' ) . '<a href="' . esc_url( $this->template_builder_url ) . '">' . esc_html__( 'here', 'benzo-toolkit' ) . '</a>',
                    'dependency' => [
                        'default_header', '==', 'disabled',
                    ],
                ],
                [
                    'id'         => 'sticky_header',
                    'type'       => 'button_set',
                    'title'      => esc_html__( 'Sticky Header', 'benzo-toolkit' ),
                    'subtitle'   => esc_html__( 'It will stick header at the top when page scrolling', 'benzo-toolkit' ),
                    'options'    => [
                        'enabled'  => esc_html__( 'Enable', 'benzo-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'benzo-toolkit' ),
                    ],
                    'default'    => 'enabled',
                    'dependency' => [
                        'default_header', '==', 'enabled',
                    ],
                ],
                [
                    'id'         => 'header_breakpoint',
                    'type'       => 'number',
                    'title'      => esc_html__( 'Header Breakpoint', 'benzo-toolkit' ),
                    'default'    => 1200,
                    'desc'       => esc_html__( 'Enter when the slide menu will appear', 'benzo-toolkit' ),
                    'dependency' => [
                        'default_header', '==', 'enabled',
                    ],
                ],
            ],
        ] );

        CSF::createSection( $this->options_prefix, [
            'parent' => 'header_options',
            'title'  => esc_html__( 'Logo', 'benzo-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Logo', 'benzo-toolkit' ),
                ],
                [
                    'id'      => 'site_main_logo',
                    'type'    => 'media',
                    'title'   => esc_html__( 'Main logo', 'benzo-toolkit' ),
                    'library' => 'image',
                    'url'     => false,
                    'default' => [
                        'url'       => BT_ASSETS . '/img/options/logo.png',
                        'thumbnail' => BT_ASSETS . '/img/options/logo.png',
                    ],
                ],
                [
                    'id'     => 'logo_dimension',
                    'type'   => 'dimensions',
                    'title'  => esc_html__( 'Logo Dimensions', 'benzo-toolkit' ),
                    'output' => '.default-header .benzo-site-logo img',
                ],
                [
                    'id'      => 'slide_panel_logo',
                    'type'    => 'media',
                    'title'   => esc_html__( 'Slide Panel Logo', 'benzo-toolkit' ),
                    'library' => 'image',
                    'url'     => false,
                    'default' => [
                        'url'       => BT_ASSETS . '/img/options/logo.png',
                        'thumbnail' => BT_ASSETS . '/img/options/logo.png',
                    ],
                ],
                [
                    'id'     => 'slide_panel_dimension',
                    'type'   => 'dimensions',
                    'title'  => esc_html__( 'Logo Dimensions', 'benzo-toolkit' ),
                    'output' => '.default-header .slide-panel-logo img',
                ],
            ],
        ] );

        CSF::createSection( $this->options_prefix, [
            'parent' => 'header_options',
            'title'  => esc_html__( 'Styling', 'benzo-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Header Styling', 'benzo-toolkit' ),
                ],
                [
                    'id'          => 'header_bg',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Header Background', 'benzo-toolkit' ),
                    'output'      => ['.default-header'],
                    'output_mode' => 'background-color',
                ],
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Menu Items', 'benzo-toolkit' ),
                ],
                [
                    'id'          => 'menu_item_color',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Menu Item Color', 'benzo-toolkit' ),
                    'desc'        => esc_html__( 'This is the menu item font color.', 'benzo-toolkit' ),
                    'output'      => ['.default-header .benzo-nav-menu .nav-menu-wrapper a'],
                    'output_mode' => 'color',
                ],
                [
                    'id'          => 'menu_item_hover_color',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Active/Current Color', 'benzo-toolkit' ),
                    'desc'        => esc_html__( 'This is the menu item font color.', 'benzo-toolkit' ),
                    'output'      => ['.default-header .benzo-nav-menu .nav-menu-wrapper a:hover, .default-header .benzo-nav-menu .nav-menu-wrapper li.current_page_item > a'],
                    'output_mode' => 'color',
                ],
                [
                    'id'     => 'menu_typography',
                    'type'   => 'typography',
                    'title'  => esc_html__( 'Menu Typography', 'benzo-toolkit' ),
                    'color'  => false,
                    'output' => '.default-header .benzo-nav-menu .nav-menu-wrapper a',
                ],
                [
                    'type'    => 'subheading',
                    'content' => esc_html__( 'Submenu', 'benzo-toolkit' ),
                ],
                [
                    'id'          => 'submenu_bg',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Submenu Background', 'benzo-toolkit' ),
                    'output'      => '.default-header .benzo-nav-menu .nav-menu-wrapper .sub-menu',
                    'output_mode' => 'background-color',
                ],
                [
                    'id'          => 'submenu_item_divider',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Item Divider', 'benzo-toolkit' ),
                    'output'      => '.default-header .benzo-nav-menu .nav-menu-wrapper .sub-menu li:not(:last-child)',
                    'output_mode' => 'border-color',
                ],
                [
                    'id'          => 'submenu_item_color',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Item Color', 'benzo-toolkit' ),
                    'output'      => '.default-header .benzo-nav-menu .nav-menu-wrapper .sub-menu a',
                    'output_mode' => 'color',
                ],
                [
                    'id'          => 'submenu_item_hover_color',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Item Hover Color', 'benzo-toolkit' ),
                    'output'      => '.default-header .benzo-nav-menu .nav-menu-wrapper .sub-menu a:hover',
                    'output_mode' => 'color',
                ],
                [
                    'id'     => 'submenu_typography',
                    'type'   => 'typography',
                    'title'  => esc_html__( 'Item Typography', 'benzo-toolkit' ),
                    'color'  => false,
                    'output' => '.default-header .benzo-nav-menu .nav-menu-wrapper .sub-menu a',
                ],
                [
                    'type'    => 'subheading',
                    'content' => esc_html__( 'Slide Panel', 'benzo-toolkit' ),
                ],
                [
                    'id'     => 'toggler_color',
                    'type'   => 'color',
                    'title'  => esc_html__( 'Toggler Color', 'benzo-toolkit' ),
                    'output' => [
                        'border-color'     => '.default-header .benzo-nav-menu .navbar-toggler',
                        'background-color' => '.default-header .benzo-nav-menu .navbar-toggler .line',
                    ],
                ],
                [
                    'id'          => 'slide_panel_bg',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Background', 'benzo-toolkit' ),
                    'output'      => '.default-header .benzo-nav-menu .slide-panel-wrapper.show-panel .slide-panel-content',
                    'output_mode' => 'background-color',
                ],
                [
                    'id'          => 'panel_item_divider',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Item Divider', 'benzo-toolkit' ),
                    'output'      => ['.default-header .benzo-nav-menu .slide-panel-wrapper .slide-panel-menu a', '.default-header .benzo-nav-menu .slide-panel-wrapper ul.primary-menu'],
                    'output_mode' => 'border-color',
                ],
                [
                    'id'          => 'panel_item_color',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Item Color', 'benzo-toolkit' ),
                    'output'      => ['.default-header .benzo-nav-menu .slide-panel-wrapper .slide-panel-menu a', '.default-header .benzo-nav-menu .slide-panel-wrapper .slide-panel-close'],
                    'output_mode' => 'color',
                ],
                [
                    'id'          => 'panel_item_hover_color',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Item Hover Color', 'benzo-toolkit' ),
                    'output'      => '.default-header .benzo-nav-menu .slide-panel-wrapper .slide-panel-menu li.current_page_item > a',
                    'output_mode' => 'color',
                ],
                [
                    'id'     => 'panel_typography',
                    'type'   => 'typography',
                    'title'  => esc_html__( 'Item Typography', 'benzo-toolkit' ),
                    'color'  => false,
                    'output' => '.default-header .benzo-nav-menu .slide-panel-wrapper .slide-panel-menu a',
                ],
            ],
        ] );
    }

    /**
     * Page Title
     */
    public function page_title_section() {
        CSF::createSection( $this->options_prefix, [
            'title'  => esc_html__( 'Page Title', 'benzo-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Page Title', 'benzo-toolkit' ),
                ],
                [
                    'id'      => 'site_page_title',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Site Page Title', 'benzo-toolkit' ),
                    'options' => [
                        'enabled'  => esc_html__( 'Enable', 'benzo-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'benzo-toolkit' ),
                    ],
                    'default' => 'enabled',
                ],
                [
                    'id'         => 'site_breadcrumb',
                    'type'       => 'button_set',
                    'title'      => esc_html__( 'Site Breadcrumb', 'benzo-toolkit' ),
                    'options'    => [
                        'enabled'  => esc_html__( 'Enable', 'benzo-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'benzo-toolkit' ),
                    ],
                    'default'    => 'enabled',
                    'dependency' => ['site_page_title', '==', 'enabled'],
                ],
                [
                    'type'       => 'subheading',
                    'content'    => esc_html__( 'Page Title Styling', 'benzo-toolkit' ),
                    'dependency' => ['site_page_title', '==', 'enabled'],
                ],
                [
                    'id'          => 'page_title_padding',
                    'type'        => 'spacing',
                    'title'       => esc_html__( 'Padding', 'benzo-toolkit' ),
                    'output'      => '.page-title-area',
                    'output_mode' => 'padding',
                ],
                [
                    'id'          => 'page_title_bg',
                    'type'        => 'background',
                    'title'       => esc_html__( 'Background', 'benzo-toolkit' ),
                    'output'      => '.page-title-area',
                    'background_gradient'   => false,
                    'background_origin'     => false,
                    'background_clip'       => false,
                    'background_blend_mode' => false,
                    'background-color'      => false,
                ],
                [
                    'id'          => 'page_title_nav_bg',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Breadcrumb Nav Background', 'benzo-toolkit' ),
                    'output'      => ['.page-title-area .breadcrumb'],
                    'output_mode' => 'background-color',
                ], 
                [
                    'id'     => 'page_title_typo',
                    'type'   => 'typography',
                    'title'  => esc_html( 'Typography', 'benzo-toolkit' ),
                    'output' => '.page-title-area .page-title',
                ],
                [
                    'id'     => 'page_breadcrumb_typo',
                    'type'   => 'typography',
                    'title'  => esc_html( 'Breadcrumb Typography', 'benzo-toolkit' ),
                    'output' => '.page-title-area .breadcrumb, .page-title-area .breadcrumb a',
                ], 
            ],
        ] );
    }

    /**
     * Footer Options
     */
    public function footer_section() {
        CSF::createSection( $this->options_prefix, [
            'id'    => 'footer_options',
            'title' => esc_html__( 'Footer', 'benzo-toolkit' ),
        ] );

        CSF::createSection( $this->options_prefix, [
            'parent' => 'footer_options',
            'title'  => esc_html__( 'General', 'benzo-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'General', 'benzo-toolkit' ),
                ],
                [
                    'type'    => 'notice',
                    'style'   => 'info',
                    'content' => esc_html__( 'If you used theme builder for site footer then disable default theme header', 'benzo-toolkit' ),
                ],
                [
                    'id'       => 'default_footer',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Default Footer', 'benzo-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable Theme default footer', 'benzo-toolkit' ),
                    'options'  => [
                        'enabled'  => esc_html__( 'Enable', 'benzo-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'benzo-toolkit' ),
                    ],
                    'default'  => 'enabled',
                ],
                [
                    'type'       => 'notice',
                    'style'      => 'warning',
                    'content'    => esc_html__( 'You disabled default theme footer. Set your site footer form ', 'benzo-toolkit' ) . '<a href="' . esc_url( $this->template_builder_url ) . '">' . esc_html__( 'here', 'benzo-toolkit' ) . '</a>',
                    'dependency' => [
                        'default_footer', '==', 'disabled',
                    ],
                ],
            ],
        ] );

        CSF::createSection( $this->options_prefix, [
            'parent' => 'footer_options',
            'title'  => esc_html__( 'Footer Widgets', 'benzo-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Footer Widgets', 'benzo-toolkit' ),
                ],
                [
                    'id'     => 'footer_background',
                    'type'   => 'background',
                    'title'  => esc_html__( 'Footer background', 'benzo-toolkit' ),
                    'output' => '.site-default-footer',
                ],
                [
                    'id'     => 'footer_text_color',
                    'type'   => 'color',
                    'title'  => esc_html__( 'Text Color', 'benzo-toolkit' ),
                    'output' => [
                        'color' => '.footer-widgets .widget, .footer-widgets .widget a, .footer-widgets .widget.widget_pages a::before, .footer-widgets .widget.widget_pages a, .footer-widgets .widget.widget_meta a::before, .footer-widgets .widget.widget_meta a, .footer-widgets .widget.widget_nav_menu a::before, .footer-widgets .widget.widget_nav_menu a, .footer-widgets .widget.widget_recent_entries a::before, .footer-widgets .widget.widget_recent_entries a, .footer-widgets .widget.widget_block .wp-block-categories a, .footer-widgets .widget.widget_block .wp-block-archives a, .footer-widgets .widget.widget_categories a, .footer-widgets .widget.widget_archive a, .footer-widgets .widget.widget_tag_cloud .wp-block-tag-cloud a, .footer-widgets .widget.widget_tag_cloud .tagcloud a, .footer-widgets .widget.widget_block .wp-block-latest-comments a, .footer-widgets .widget.widget_recent_comments a',
                    ],
                ],
                [
                    'id'     => 'footer_text_hover_color',
                    'type'   => 'color',
                    'title'  => esc_html__( 'Hover Color', 'benzo-toolkit' ),
                    'output' => [
                        'color'            => '.footer-widgets .widget.widget_pages a:hover, .footer-widgets .widget.widget_meta a:hover, .footer-widgets .widget.widget_nav_menu a:hover, .footer-widgets .widget.widget_recent_entries a:hover, .footer-widgets .widget.widget_block .wp-block-categories a:hover, .footer-widgets .widget.widget_block .wp-block-archives a:hover, .footer-widgets .widget.widget_categories a:hover, .footer-widgets .widget.widget_archive a:hover, .footer-widgets .widget.widget_rss a.rsswidget:hover, .footer-widgets .widget.widget_block .wp-block-latest-comments a:hover, .footer-widgets .widget.widget_recent_comments a:hover',
                        'border-color'     => '.footer-widgets .widget.widget_tag_cloud .wp-block-tag-cloud a:hover, .footer-widgets .widget.widget_tag_cloud .tagcloud a:hover',
                        'background-color' => '.footer-widgets .widget.widget_tag_cloud .wp-block-tag-cloud a:hover, .footer-widgets .widget.widget_tag_cloud .tagcloud a:hover, .footer-widgets .widget.widget_search button, .footer-widgets .widget.widget_search button:hover',
                    ],
                ],
                [
                    'id'               => 'footer_content_typography',
                    'type'             => 'typography',
                    'title'            => esc_html__( 'Content Typography', 'benzo-toolkit' ),
                    'color'            => false,
                    'line_height_unit' => 'em',
                    'preview'          => false,
                    'output'           => ['.site-footer .footer-widgets .widget'],
                ],
                [
                    'type'    => 'subheading',
                    'content' => esc_html__( 'Widget Title', 'benzo-toolkit' ),
                ],
                [
                    'id'               => 'footer_title_typography',
                    'type'             => 'typography',
                    'title'            => esc_html__( 'Title', 'benzo-toolkit' ),
                    'output'           => '.footer-widgets .widget .widget-title',
                    'color'            => false,
                    'line_height_unit' => 'em',
                    'preview'          => false,
                ],
                [
                    'id'     => 'footer_title_color',
                    'type'   => 'color',
                    'title'  => esc_html__( 'Color', 'benzo-toolkit' ),
                    'output' => '.footer-widgets .widget .widget-title, .footer-widgets .widget.widget_rss a.rsswidget',
                ],
            ],
        ] );

        CSF::createSection( $this->options_prefix, [
            'parent' => 'footer_options',
            'title'  => esc_html__( 'Footer Copyright', 'benzo-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Footer', 'benzo-toolkit' ),
                ],
                [
                    'id'      => 'copyright_text',
                    'type'    => 'textarea',
                    'title'   => esc_html__( 'Copyright Text', 'benzo-toolkit' ),
                    'default' => esc_html__( 'Copyright © 2022. All rights reserved.', 'benzo-toolkit' ),
                ],
                [
                    'type'    => 'subheading',
                    'content' => esc_html__( 'Style', 'benzo-toolkit' ),
                ],
                [
                    'id'          => 'copyright_color_bg',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Copyright Background', 'benzo-toolkit' ),
                    'output'      => ['.default-footer'],
                    'output_mode' => 'background-color',
                ],
                [
                    'id'     => 'copyright_color',
                    'type'   => 'color',
                    'title'  => esc_html__( 'Copyright text color', 'benzo-toolkit' ),
                    'output' => '.default-footer .footer-copyright',
                ],
            ],
        ] );
    }

    /**
     * Blog Options
     */
    public function blog_section() {
        CSF::createSection( $this->options_prefix, [
            'id'    => 'blog_options',
            'title' => esc_html__( 'Blog', 'benzo-toolkit' ),
        ] );

        CSF::createSection( $this->options_prefix, [
            'parent' => 'blog_options',
            'title'  => esc_html__( 'Blog Archive', 'benzo-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Blog Archive', 'benzo-toolkit' ),
                ],
                [
                    'id'          => 'blog_archive_title',
                    'type'        => 'text',
                    'title'       => esc_html__( 'Blog Archive Title', 'benzo-toolkit' ),
                    'placeholder' => esc_html__( 'Type title', 'benzo-toolkit' ),
                    'default'     => esc_html__( 'Latest News', 'benzo-toolkit' ),
                ],
                [
                    'id'      => 'blog_archive_layout',
                    'type'    => 'image_select',
                    'title'   => esc_html__( 'Archive Layout', 'benzo-toolkit' ),
                    'options' => [
                        'boxed-layout'      => BT_ASSETS . '/img/options/boxed-layout.jpg',
                        'full-width-layout' => BT_ASSETS . '/img/options/full-width-layout.jpg',
                    ],
                    'default' => 'boxed-layout',
                    'desc'    => esc_html__( 'Select Archive layout. Full width or In container.  Settings will also apply on the blog category and tag archive pages', 'benzo-toolkit' ),
                ],
                [
                    'id'      => 'blog_archive_sidebar',
                    'type'    => 'image_select',
                    'title'   => esc_html__( 'Sidebar', 'benzo-toolkit' ),
                    'options' => [
                        'left-sidebar'  => BT_ASSETS . '/img/options/left-sidebar.jpg',
                        'right-sidebar' => BT_ASSETS . '/img/options/right-sidebar.jpg',
                        'no-sidebar'    => BT_ASSETS . '/img/options/no-sidebar.jpg',
                    ],
                    'default' => 'right-sidebar',
                    'desc'    => esc_html__( 'Select Page Sidebar. Left sidebar or right sidebar or No sidebar', 'benzo-toolkit' ),
                ],
                [
                    'id'       => 'archive_post_thumb',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Show Post Thumbnail', 'benzo-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable Post thumbnail on Blog Archive page', 'benzo-toolkit' ),
                    'options'  => [
                        'yes' => esc_html__( 'Yes', 'benzo-toolkit' ),
                        'no'  => esc_html__( 'No', 'benzo-toolkit' ),
                    ],
                    'default'  => 'yes',
                ],
                [
                    'id'       => 'archive_post_meta',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Show Post Meta', 'benzo-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable Post meta on Blog Archive page', 'benzo-toolkit' ),
                    'options'  => [
                        'yes' => esc_html__( 'Yes', 'benzo-toolkit' ),
                        'no'  => esc_html__( 'No', 'benzo-toolkit' ),
                    ],
                    'default'  => 'yes',
                ],
                [
                    'id'       => 'archive_post_excerpt',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Show Post Excerpt', 'benzo-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable Post Excerpt on Blog Archive page', 'benzo-toolkit' ),
                    'options'  => [
                        'yes' => esc_html__( 'Yes', 'benzo-toolkit' ),
                        'no'  => esc_html__( 'No', 'benzo-toolkit' ),
                    ],
                    'default'  => 'yes',
                ],
                [
                    'id'         => 'post_excerpt_count',
                    'type'       => 'number',
                    'title'      => esc_html__( 'Excerpt Word Count', 'benzo-toolkit' ),
                    'subtitle'   => esc_html__( 'Set how many words you want to show in the post Excerpt', 'benzo-toolkit' ),
                    'default'    => 35,
                    'dependency' => [
                        'archive_post_excerpt', '==', 'yes',
                    ],
                ],
                [
                    'id'       => 'archive_post_button',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Show Read More Button', 'benzo-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable Post Read More Button on Blog Archive page', 'benzo-toolkit' ),
                    'options'  => [
                        'yes' => esc_html__( 'Yes', 'benzo-toolkit' ),
                        'no'  => esc_html__( 'No', 'benzo-toolkit' ),
                    ],
                    'default'  => 'yes',
                ],
                [
                    'id'         => 'post_button_text',
                    'type'       => 'text',
                    'title'      => esc_html__( 'Button Text', 'benzo-toolkit' ),
                    'default'    => esc_html__( 'Read More_', 'benzo-toolkit' ),
                    'dependency' => [
                        'archive_post_button', '==', 'yes',
                    ],
                ],
            ],
        ] );

        CSF::createSection( $this->options_prefix, [
            'parent' => 'blog_options',
            'title'  => esc_html__( 'Blog Single', 'benzo-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Blog single', 'benzo-toolkit' ),
                ],
                [
                    'id'      => 'blog_details_layout',
                    'type'    => 'image_select',
                    'title'   => esc_html__( 'Details Layout', 'benzo-toolkit' ),
                    'options' => [
                        'boxed-layout'      => BT_ASSETS . '/img/options/boxed-layout.jpg',
                        'full-width-layout' => BT_ASSETS . '/img/options/full-width-layout.jpg',
                    ],
                    'default' => 'boxed-layout',
                    'desc'    => esc_html__( 'Select Blog details layout. Full width or In container', 'benzo-toolkit' ),
                ],
                [
                    'id'      => 'blog_details_sidebar',
                    'type'    => 'image_select',
                    'title'   => esc_html__( 'Sidebar', 'benzo-toolkit' ),
                    'options' => [
                        'left-sidebar'  => BT_ASSETS . '/img/options/left-sidebar.jpg',
                        'right-sidebar' => BT_ASSETS . '/img/options/right-sidebar.jpg',
                        'no-sidebar'    => BT_ASSETS . '/img/options/no-sidebar.jpg',
                    ],
                    'default' => 'right-sidebar',
                    'desc'    => esc_html__( 'Select Blog Details Sidebar. Left sidebar or right sidebar or No sidebar', 'benzo-toolkit' ),
                ],
                [
                    'id'       => 'blog_details_meta',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Show Post Meta', 'benzo-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable Post meta on Blog Details page', 'benzo-toolkit' ),
                    'options'  => [
                        'yes' => esc_html__( 'Yes', 'benzo-toolkit' ),
                        'no'  => esc_html__( 'No', 'benzo-toolkit' ),
                    ],
                    'default'  => 'yes',
                ],
                [
                    'id'       => 'blog_details_share',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Show Post Share Links', 'benzo-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable Post social share links.', 'benzo-toolkit' ),
                    'options'  => [
                        'yes' => esc_html__( 'Yes', 'benzo-toolkit' ),
                        'no'  => esc_html__( 'No', 'benzo-toolkit' ),
                    ],
                    'default'  => 'no',
                ],
                [
                    'id'         => 'social_share_item',
                    'type'       => 'sorter',
                    'title'      => esc_html__( 'Social Share Links', 'benzo-toolkit' ),
                    'default'    => [
                        'enabled'  => [
                            'facebook'  => esc_html__( 'Facebook', 'benzo-toolkit' ),
                            'twitter'   => esc_html__( 'Twitter', 'benzo-toolkit' ),
                            'pinterest' => esc_html__( 'Pinterest', 'benzo-toolkit' ),
                            'linkedin'  => esc_html__( 'Linkedin', 'benzo-toolkit' ),
                        ],
                        'disabled' => [
                            'reddit'   => esc_html__( 'Reddit', 'benzo-toolkit' ),
                            'whatsapp' => esc_html__( 'Whatsapp', 'benzo-toolkit' ),
                            'telegram' => esc_html__( 'Telegram', 'benzo-toolkit' ),
                        ],
                    ],
                    'dependency' => [
                        'blog_details_share', '==', 'yes',
                    ],
                ],
                [
                    'id'       => 'blog_details_tag',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Show Related Tags', 'benzo-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable related tag on Blog Details page', 'benzo-toolkit' ),
                    'options'  => [
                        'yes' => esc_html__( 'Yes', 'benzo-toolkit' ),
                        'no'  => esc_html__( 'No', 'benzo-toolkit' ),
                    ],
                    'default'  => 'yes',
                ],
            ],
        ] );
    }

    /**
     * Shop Options
     */
    public function shop_section() {
        CSF::createSection( $this->options_prefix, [
            'title'  => esc_html__( 'Shop', 'benzo-toolkit' ),
            'fields' => [

            ],
        ] );
    }

    /**
     * Error Options
     */
    public function error_section() {
        CSF::createSection( $this->options_prefix, [
            'title'  => esc_html__( 'Error 404', 'benzo-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Error Page', 'benzo-toolkit' ),
                ],
                [
                    'id'      => 'error_note',
                    'type'    => 'textarea',
                    'title'   => esc_html__( 'Error Page Note', 'benzo-toolkit' ),
                    'default' => esc_html__( 'The page which you are looking for does not exist galley of type and scrambled it to make a type specimen book. Please return to the homepage.', 'benzo-toolkit' ),
                ],
                [
                    'id'      => 'error_button_text',
                    'type'    => 'text',
                    'title'   => esc_html__( 'Error Button Text', 'benzo-toolkit' ),
                    'default' => esc_html__( 'Return To Home_', 'benzo-toolkit' ),
                ],
            ],
        ] );
    }

    /**
     * Search Options
     */
    public function search_section() {
        CSF::createSection( $this->options_prefix, [
            'title'  => esc_html__( 'Search Result', 'benzo-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Search Page', 'benzo-toolkit' ),
                ],
                [
                    'id'       => 'show_search_form',
                    'type'     => 'switcher',
                    'title'    => esc_html__( 'Show Search Form', 'benzo-toolkit' ),
                    'text_on'  => esc_html__( 'Yes', 'benzo-toolkit' ),
                    'text_off' => esc_html__( 'No', 'benzo-toolkit' ),
                    'default'  => true,
                ],
                [
                    'id'         => 'search_form_title',
                    'type'       => 'text',
                    'title'      => esc_html__( 'Form Title', 'benzo-toolkit' ),
                    'default'    => esc_html__( 'Search Here:', 'benzo-toolkit' ),
                    'dependency' => [
                        'show_search_form', '==', 'true',
                    ],
                ],
                [
                    'id'         => 'search_form_note',
                    'type'       => 'textarea',
                    'title'      => esc_html__( 'Form Note', 'benzo-toolkit' ),
                    'default'    => esc_html__( 'If you are not happy with the results below please do another search', 'benzo-toolkit' ),
                    'dependency' => [
                        'show_search_form', '==', 'true',
                    ],
                ],
            ],
        ] );
    }

    /**
     * Color Options
     */
    public function color_scheme_section() {
        CSF::createSection( $this->options_prefix, [
            'title'  => esc_html__( 'Color Scheme', 'benzo-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Color Scheme', 'benzo-toolkit' ),
                ],
                [
                    'id'       => 'primary_color',
                    'type'     => 'color',
                    'title'    => esc_html__( 'Primary Color', 'benzo-toolkit' ),
                    'default'  => '#005DE0',
                    'subtitle' => esc_html__( 'Default: #005DE0', 'benzo-toolkit' ),
                ],
                [
                    'id'       => 'secondary_color',
                    'type'     => 'color',
                    'title'    => esc_html__( 'Secondary Color', 'benzo-toolkit' ),
                    'default'  => '#0F0F11',
                    'subtitle' => esc_html__( 'Default: #0F0F11', 'benzo-toolkit' ),
                ],
                [
                    'id'       => 'body_color',
                    'type'     => 'color',
                    'title'    => esc_html__( 'Body Color', 'benzo-toolkit' ),
                    'default'  => '#535353',
                    'subtitle' => esc_html__( 'Default: #535353', 'benzo-toolkit' ),
                ],
                [
                    'id'       => 'border_color',
                    'type'     => 'color',
                    'title'    => esc_html__( 'Common Border Color', 'benzo-toolkit' ),
                    'default'  => '#EEF0F1',
                    'subtitle' => esc_html__( 'Default: #EEF0F1', 'benzo-toolkit' ),
                ],
                [
                    'id'       => 'light_color',
                    'type'     => 'color',
                    'title'    => esc_html__( 'Common Light Color', 'benzo-toolkit' ),
                    'default'  => '#F5F5F5',
                    'subtitle' => esc_html__( 'Default: #F5F5F5', 'benzo-toolkit' ),
                ],
            ],
        ] );
    }

    /**
     * Typography Options
     */
    public function typography_section() {
        CSF::createSection( $this->options_prefix, [
            'title'  => esc_html__( 'Typography', 'benzo-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Typography', 'benzo-toolkit' ),
                ],
                [
                    'id'                 => 'primary_font',
                    'type'               => 'typography',
                    'title'              => esc_html__( 'Primary Font', 'benzo-toolkit' ),
                    'font_weight'        => true,
                    'font_style'         => true,
                    'extra_styles'       => true,
                    'font_size'          => false,
                    'line_height'        => false,
                    'letter_spacing'     => false,
                    'text_align'         => false,
                    'text_transform'     => false,
                    'color'              => false,
                    'backup_font_family' => false,
                    'subset'             => true,
                    'preview'            => false,
                ],
                [
                    'id'                 => 'secondary_font',
                    'type'               => 'typography',
                    'title'              => esc_html__( 'Secondary Font', 'benzo-toolkit' ),
                    'font_weight'        => true,
                    'font_style'         => true,
                    'extra_styles'       => true,
                    'font_size'          => false,
                    'line_height'        => false,
                    'letter_spacing'     => false,
                    'text_align'         => false,
                    'text_transform'     => false,
                    'color'              => false,
                    'backup_font_family' => false,
                    'subset'             => true,
                    'preview'            => false,
                ],
                [
                    'id'      => 'body_typo_types',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Body Typography', 'benzo-toolkit' ),
                    'options' => [
                        'default-font' => esc_html__( 'Default', 'benzo-toolkit' ),
                        'custom-font'  => esc_html__( 'Custom', 'benzo-toolkit' ),
                    ],
                    'default' => 'default-font',
                ],
                [
                    'id'               => 'body_typo',
                    'type'             => 'typography',
                    'title'            => esc_html__( 'Body', 'benzo-toolkit' ),
                    'output'           => 'body',
                    'line_height_unit' => 'em',
                    'dependency'       => [
                        'body_typo_types', '==', 'custom-font',
                    ],
                ],
                [
                    'id'      => 'heading_typo_type',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Heading Typography', 'benzo-toolkit' ),
                    'options' => [
                        'default-font' => esc_html__( 'Default', 'benzo-toolkit' ),
                        'custom-font'  => esc_html__( 'Custom', 'benzo-toolkit' ),
                    ],
                    'default' => 'default-font',
                ],
                [
                    'id'               => 'heading1_typo',
                    'type'             => 'typography',
                    'title'            => esc_html__( 'Heading 1', 'benzo-toolkit' ),
                    'output'           => 'h1',
                    'line_height_unit' => 'em',
                    'dependency'       => [
                        'heading_typo_type', '==', 'custom-font',
                    ],
                ],
                [
                    'id'               => 'heading2_typo',
                    'type'             => 'typography',
                    'title'            => esc_html__( 'Heading 2', 'benzo-toolkit' ),
                    'output'           => 'h2',
                    'line_height_unit' => 'em',
                    'dependency'       => [
                        'heading_typo_type', '==', 'custom-font',
                    ],
                ],
                [
                    'id'               => 'heading3_typo',
                    'type'             => 'typography',
                    'title'            => esc_html__( 'Heading 3', 'benzo-toolkit' ),
                    'output'           => 'h3',
                    'line_height_unit' => 'em',
                    'dependency'       => [
                        'heading_typo_type', '==', 'custom-font',
                    ],
                ],
                [
                    'id'               => 'heading4_typo',
                    'type'             => 'typography',
                    'title'            => esc_html__( 'Heading 4', 'benzo-toolkit' ),
                    'output'           => 'h4',
                    'line_height_unit' => 'em',
                    'dependency'       => [
                        'heading_typo_type', '==', 'custom-font',
                    ],
                ],
                [
                    'id'               => 'heading5_typo',
                    'type'             => 'typography',
                    'title'            => esc_html__( 'Heading 5', 'benzo-toolkit' ),
                    'output'           => 'h5',
                    'line_height_unit' => 'em',
                    'dependency'       => [
                        'heading_typo_type', '==', 'custom-font',
                    ],
                ],
                [
                    'id'               => 'heading6_typo',
                    'type'             => 'typography',
                    'title'            => esc_html__( 'Heading 6', 'benzo-toolkit' ),
                    'output'           => 'h6',
                    'line_height_unit' => 'em',
                    'dependency'       => [
                        'heading_typo_type', '==', 'custom-font',
                    ],
                ],
            ],
        ] );
    }

    /**
     * Custom Script Options
     */
    public function custom_scrips_section() {
        CSF::createSection( $this->options_prefix, [
            'title'  => esc_html__( 'Custom Scripts', 'benzo-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Custom Scripts', 'benzo-toolkit' ),
                ],
                [
                    'id'       => 'custom_header_scripts',
                    'type'     => 'code_editor',
                    'title'    => esc_html__( 'Js Code(Head)', 'benzo-toolkit' ),
                    'settings' => [
                        'theme' => 'mbo',
                        'mode'  => 'javascript',
                    ],
                    'subtitle' => esc_html__( 'Add your custom js code here. Must Be type without script tag and valid code, It will insert the code to wp_head hook.
                    ', 'benzo-toolkit' ),
                ],
                [
                    'id'       => 'custom_footer_scripts',
                    'type'     => 'code_editor',
                    'title'    => esc_html__( 'Js Code(Footer)', 'benzo-toolkit' ),
                    'settings' => [
                        'theme' => 'mbo',
                        'mode'  => 'javascript',
                    ],
                    'subtitle' => esc_html__( 'Add your custom js code here. Must Be type without script tag and valid code, It will insert the code to wp_footer hook.
                    ', 'benzo-toolkit' ),
                ],
                [
                    'type'    => 'submessage',
                    'style'   => 'info',
                    'content' => esc_html__( 'You Can add also custom css in Appearance>Customize>Additional CSS', 'benzo-toolkit' ),
                ],
            ],
        ] );
    }

    /**
     * Backup Options
     */
    public function backup_section() {
        CSF::createSection( $this->options_prefix, [
            'title'  => esc_html__( 'Backup', 'benzo-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Backup', 'benzo-toolkit' ),
                ],
                [
                    'type' => 'backup',
                ],
            ],
        ] );
    }
}

Benzo_Theme_Options::instance()->initialize();