<?php
namespace BenzoToolkit\Helper;

use CSF;

defined( 'ABSPATH' ) || exit;

/**
 * Benzo Toolkit Helper
 */

class Benzo_Metaboxes {
    protected static $instance = null;

    private $post_prefix     = 'benzo_post_meta';
    private $page_prefix     = 'benzo_page_meta';
    private $user_prefix     = 'benzo_user_meta';
    private $category_prefix = 'benzo_category_meta';
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

        $this->post_metaboxes();
        $this->page_metaboxes();
        $this->category_metaboxes();
    }

    public function post_metaboxes() {
        CSF::createMetabox( $this->post_prefix, [
            'title'        => esc_html__( 'Benzo Post Options', 'benzo-toolkit' ),
            'post_type'    => 'post',
            'show_restore' => true,
        ] );

        // General
        CSF::createSection( $this->post_prefix, [
            'title'  => esc_html__( 'General', 'benzo-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'General', 'benzo-toolkit' ),
                ],
                [
                    'id'      => 'post_format',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Post Format', 'benzo-toolkit' ),
                    'options' => [
                        'standard' => esc_html__( 'Standard', 'benzo-toolkit' ),
                        'gallery'  => esc_html__( 'Gallery', 'benzo-toolkit' ),
                        'video'    => esc_html__( 'Video', 'benzo-toolkit' ),
                        'audio'    => esc_html__( 'Audio', 'benzo-toolkit' ),
                        'quote'    => esc_html__( 'Quote', 'benzo-toolkit' ),
                        'link'     => esc_html__( 'Link', 'benzo-toolkit' ),
                    ],
                    'default' => 'standard',
                ],
                [
                    'id'         => 'post_gallery',
                    'type'       => 'gallery',
                    'title'      => esc_html__( 'Gallery Images', 'benzo-toolkit' ),
                    'desc'       => esc_html__( 'Choose your Gallery Images', 'benzo-toolkit' ),
                    'dependency' => ['post_format', '==', 'gallery'],
                ],
                [
                    'id'         => 'post_video_link',
                    'type'       => 'text',
                    'title'      => esc_html__( 'oEmbed URL', 'benzo-toolkit' ),
                    'dependency' => ['post_format', '==', 'video'],
                ],
                [
                    'id'         => 'post_video_thumb',
                    'type'       => 'media',
                    'library'    => 'image',
                    'title'      => esc_html__( 'Thumbnail', 'benzo-toolkit' ),
                    'desc'       => esc_html__( 'Add video Thumbnail', 'benzo-toolkit' ),
                    'dependency' => ['post_format', '==', 'video'],
                ],
                [
                    'id'         => 'post_audio_link',
                    'type'       => 'text',
                    'title'      => esc_html__( 'oEmbed URL', 'benzo-toolkit' ),
                    'dependency' => ['post_format', '==', 'audio'],
                ],
                [
                    'id'         => 'post_quote_text',
                    'type'       => 'textarea',
                    'title'      => esc_html__( 'Quote', 'benzo-toolkit' ),
                    'dependency' => ['post_format', '==', 'quote'],
                ],
                [
                    'id'         => 'post_quote_author',
                    'type'       => 'text',
                    'title'      => esc_html__( 'Quote Author Name', 'benzo-toolkit' ),
                    'dependency' => ['post_format', '==', 'quote'],
                ],
                [
                    'id'         => 'post_link_url',
                    'type'       => 'text',
                    'title'      => esc_html__( 'Link', 'benzo-toolkit' ),
                    'desc'       => esc_html__( 'Type your link. Example: https://webtend.net', 'benzo-toolkit' ),
                    'dependency' => ['post_format', '==', 'link'],
                ],
                [
                    'id'         => 'post_link_text',
                    'type'       => 'text',
                    'title'      => esc_html__( 'Link Text', 'benzo-toolkit' ),
                    'dependency' => ['post_format', '==', 'link'],
                ],
            ],
        ] );

        // Page Layout
        CSF::createSection( $this->post_prefix, [
            'title'  => esc_html__( 'Layout', 'benzo-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Post Layout', 'benzo-toolkit' ),
                ],
                [
                    'id'       => 'post_details_layout',
                    'type'     => 'image_select',
                    'title'    => esc_html__( 'Content Layout', 'benzo-toolkit' ),
                    'options'  => [
                        'default'           => BT_ASSETS . '/img/options/default.jpg',
                        'boxed-layout'      => BT_ASSETS . '/img/options/boxed-layout.jpg',
                        'full-width-layout' => BT_ASSETS . '/img/options/full-width-layout.jpg',
                    ],
                    'default'  => 'default',
                    'desc'     => esc_html__( 'Select Post layout. Full width or In container', 'benzo-toolkit' ),
                    'subtitle' => esc_html__( 'Default Comes From Theme Option', 'benzo-toolkit' ),
                ],
                [
                    'id'       => 'post_details_sidebar',
                    'type'     => 'image_select',
                    'title'    => esc_html__( 'Sidebar', 'benzo-toolkit' ),
                    'options'  => [
                        'default'       => BT_ASSETS . '/img/options/default.jpg',
                        'left-sidebar'  => BT_ASSETS . '/img/options/left-sidebar.jpg',
                        'right-sidebar' => BT_ASSETS . '/img/options/right-sidebar.jpg',
                        'no-sidebar'    => BT_ASSETS . '/img/options/no-sidebar.jpg',
                    ],
                    'default'  => 'default',
                    'desc'     => esc_html__( 'Select Page Sidebar. Left sidebar or right sidebar or No sidebar', 'benzo-toolkit' ),
                    'subtitle' => esc_html__( 'Default Comes From Theme Option', 'benzo-toolkit' ),

                ],
                [
                    'id'         => 'content_spacing',
                    'type'       => 'spacing',
                    'title'      => esc_html__( 'Content Spacing', 'benzo-toolkit' ),
                    'show_units' => false,
                    'desc'       => esc_html__( 'Default top: 40px, right: 20px, bottom: 100px, left: 20px', 'benzo-toolkit' ),
                    'output'     => '.content-container',
                ],
            ],
        ] );

        // Header
        CSF::createSection( $this->post_prefix, [
            'title'  => esc_html__( 'Header', 'benzo-toolkit' ),
            'fields' => [
                [
                    'type'    => 'notice',
                    'style'   => 'info',
                    'content' => esc_html__( 'If you used theme builder for post header then disable default header', 'benzo-toolkit' ),
                ],
                [
                    'id'       => 'post_default_header',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Default Header', 'benzo-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable post default header. Default comes form theme option', 'benzo-toolkit' ),
                    'options'  => [
                        'default'  => esc_html__( 'Default', 'benzo-toolkit' ),
                        'enabled'  => esc_html__( 'Enable', 'benzo-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'benzo-toolkit' ),
                    ],
                    'default'  => 'default',

                ],
                [
                    'type'       => 'notice',
                    'style'      => 'warning',
                    'content'    => esc_html__( 'You disabled default header. Set your post header form ', 'benzo-toolkit' ) . '<a href="' . esc_url( $this->template_builder_url ) . '">' . esc_html__( 'here', 'benzo-toolkit' ) . '</a>',
                    'dependency' => [
                        'post_default_header', '==', 'disabled',
                    ],
                ],
                [
                    'id'         => 'post_sticky_header',
                    'type'       => 'button_set',
                    'title'      => esc_html__( 'Sticky Header', 'benzo-toolkit' ),
                    'subtitle'   => esc_html__( 'It will stick header at the top when page scrolling. Default comes form theme option', 'benzo-toolkit' ),
                    'options'    => [
                        'default'  => esc_html__( 'Default', 'benzo-toolkit' ),
                        'enabled'  => esc_html__( 'Enable', 'benzo-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'benzo-toolkit' ),
                    ],
                    'default'    => 'default',
                    'dependency' => [
                        'post_default_header', '!=', 'disabled',
                    ],
                ],
            ],
        ] );

        // Page Title
        CSF::createSection( $this->post_prefix, [
            'title'  => esc_html__( 'Page Title', 'benzo-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Page Title', 'benzo-toolkit' ),
                ],
                [
                    'id'      => 'post_page_title',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Page Title', 'benzo-toolkit' ),
                    'options' => [
                        'default'  => esc_html__( 'Default', 'benzo-toolkit' ),
                        'enabled'  => esc_html__( 'Enable', 'benzo-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'benzo-toolkit' ),
                    ],
                    'default' => 'default',
                ],
                [
                    'id'         => 'post_title_type',
                    'type'       => 'button_set',
                    'title'      => esc_html__( 'Page Title Type', 'benzo-toolkit' ),
                    'options'    => [
                        'default' => esc_html__( 'Default', 'benzo-toolkit' ),
                        'custom'  => esc_html__( 'Custom', 'benzo-toolkit' ),
                    ],
                    'default'    => 'custom',
                    'dependency' => ['post_page_title', '!=', 'disabled'],
                ],
                [
                    'id'         => 'post_custom_title',
                    'type'       => 'text',
                    'title'      => esc_html__( 'Custom Title', 'benzo-toolkit' ),
                    'dependency' => [
                        ['post_page_title', '!=', 'disabled'],
                        ['post_title_type', '==', 'custom'],
                    ],
                    'default'    => esc_html__( 'News Details', 'benzo-toolkit' ),
                ],
                [
                    'id'         => 'post_breadcrumb',
                    'type'       => 'button_set',
                    'title'      => esc_html__( 'Page Breadcrumb', 'benzo-toolkit' ),
                    'options'    => [
                        'default'  => esc_html__( 'Default', 'benzo-toolkit' ),
                        'enabled'  => esc_html__( 'Enable', 'benzo-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'benzo-toolkit' ),
                    ],
                    'default'    => 'default',
                    'dependency' => ['post_page_title', '!=', 'disabled'],
                ],
                [
                    'id'         => 'customize_page_title_style',
                    'type'       => 'button_set',
                    'title'      => esc_html__( 'Customize Style', 'benzo-toolkit' ),
                    'options'    => [
                        'yes' => esc_html__( 'Yes', 'benzo-toolkit' ),
                        'no'  => esc_html__( 'No', 'benzo-toolkit' ),
                    ],
                    'default'    => 'no',
                    'dependency' => ['post_page_title', '!=', 'disabled'],
                ],
                [
                    'type'       => 'subheading',
                    'content'    => esc_html__( 'Page Title Styling', 'benzo-toolkit' ),
                    'dependency' => [
                        ['post_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'          => 'page_title_padding',
                    'type'        => 'spacing',
                    'title'       => esc_html__( 'Padding', 'benzo-toolkit' ),
                    'output'      => '.page-title-area',
                    'output_mode' => 'padding',
                    'dependency'  => [
                        ['post_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'         => 'page_title_border',
                    'type'       => 'border',
                    'title'      => esc_html__( 'Border', 'benzo-toolkit' ),
                    'output'     => '.page-title-area',
                    'dependency' => [
                        ['post_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'          => 'page_title_bg',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Background Color', 'benzo-toolkit' ),
                    'output'      => '.page-title-area',
                    'output_mode' => 'background-color',
                    'dependency'  => [
                        ['post_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'         => 'page_title_typo',
                    'type'       => 'typography',
                    'title'      => esc_html( 'Typography', 'benzo-toolkit' ),
                    'output'     => '.page-title-area .page-title',
                    'dependency' => [
                        ['post_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'         => 'page_breadcrumb_typo',
                    'type'       => 'typography',
                    'title'      => esc_html( 'Breadcrumb Typography', 'benzo-toolkit' ),
                    'output'     => '.page-title-area .breadcrumb, .page-title-area .breadcrumb a',
                    'dependency' => [
                        ['post_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'          => 'page_title_dot',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Dots Color', 'benzo-toolkit' ),
                    'output'      => '.page-title-area .breadcrumb::before',
                    'output_mode' => 'background-color',
                    'dependency'  => [
                        ['post_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
            ],
        ] );

        // Footer
        CSF::createSection( $this->post_prefix, [
            'title'  => esc_html__( 'Footer', 'benzo-toolkit' ),
            'fields' => [
                [
                    'type'    => 'notice',
                    'style'   => 'info',
                    'content' => esc_html__( 'If you used theme builder for post footer then disable default footer', 'benzo-toolkit' ),
                ],
                [
                    'id'       => 'post_default_footer',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Default Footer', 'benzo-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable post default footer. Default comes form theme option', 'benzo-toolkit' ),
                    'options'  => [
                        'default'  => esc_html__( 'Default', 'benzo-toolkit' ),
                        'enabled'  => esc_html__( 'Enable', 'benzo-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'benzo-toolkit' ),
                    ],
                    'default'  => 'default',

                ],
                [
                    'type'       => 'notice',
                    'style'      => 'warning',
                    'content'    => esc_html__( 'You disabled default footer. Set your post footer form ', 'benzo-toolkit' ) . '<a href="' . esc_url( $this->template_builder_url ) . '">' . esc_html__( 'here', 'benzo-toolkit' ) . '</a>',
                    'dependency' => [
                        'post_default_footer', '==', 'disabled',
                    ],
                ],
            ],
        ] );
    }

    public function page_metaboxes() {
        CSF::createMetabox( $this->page_prefix, [
            'title'        => esc_html__( 'Benzo Page Options', 'benzo-toolkit' ),
            'post_type'    => 'page',
            'show_restore' => true,
        ] );

        // Page Layout
        CSF::createSection( $this->page_prefix, [
            'title'  => esc_html__( 'Layout', 'benzo-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Page Layout', 'benzo-toolkit' ),
                ],
                [
                    'id'      => 'content_layout',
                    'type'    => 'image_select',
                    'title'   => esc_html__( 'Content Layout', 'benzo-toolkit' ),
                    'options' => [
                        'boxed-layout'      => BT_ASSETS . '/img/options/boxed-layout.jpg',
                        'full-width-layout' => BT_ASSETS . '/img/options/full-width-layout.jpg',
                    ],
                    'default' => 'boxed-layout',
                    'desc'    => esc_html__( 'Select Page layout. Full width or In container', 'benzo-toolkit' ),
                ],
                [
                    'id'      => 'content_sidebar',
                    'type'    => 'image_select',
                    'title'   => esc_html__( 'Sidebar', 'benzo-toolkit' ),
                    'options' => [
                        'left-sidebar'  => BT_ASSETS . '/img/options/left-sidebar.jpg',
                        'right-sidebar' => BT_ASSETS . '/img/options/right-sidebar.jpg',
                        'no-sidebar'    => BT_ASSETS . '/img/options/no-sidebar.jpg',
                    ],
                    'default' => 'no-sidebar',
                    'desc'    => esc_html__( 'Select Page Sidebar. Left sidebar or right sidebar or No sidebar', 'benzo-toolkit' ),
                ],
                [
                    'id'         => 'content_spacing',
                    'type'       => 'spacing',
                    'title'      => esc_html__( 'Content Spacing', 'benzo-toolkit' ),
                    'show_units' => false,
                    'desc'       => esc_html__( 'Default top: 40px, right: 20px, bottom: 100px, left: 20px', 'benzo-toolkit' ),
                    'output'     => '.content-container',
                ],
            ],
        ] );

        // Header
        CSF::createSection( $this->page_prefix, [
            'title'  => esc_html__( 'Header', 'benzo-toolkit' ),
            'fields' => [
                [
                    'type'    => 'notice',
                    'style'   => 'info',
                    'content' => esc_html__( 'If you used theme builder for page header then disable default header', 'benzo-toolkit' ),
                ],
                [
                    'id'       => 'page_default_header',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Default Header', 'benzo-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable page default header. Default comes form theme option', 'benzo-toolkit' ),
                    'options'  => [
                        'default'  => esc_html__( 'Default', 'benzo-toolkit' ),
                        'enabled'  => esc_html__( 'Enable', 'benzo-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'benzo-toolkit' ),
                    ],
                    'default'  => 'default',
                ],
                [
                    'type'       => 'notice',
                    'style'      => 'warning',
                    'content'    => esc_html__( 'You disabled default header. Set your page header form ', 'benzo-toolkit' ) . '<a href="' . esc_url( $this->template_builder_url ) . '">' . esc_html__( 'here', 'benzo-toolkit' ) . '</a>',
                    'dependency' => [
                        'page_default_header', '==', 'disabled',
                    ],
                ],
                [
                    'id'         => 'page_sticky_header',
                    'type'       => 'button_set',
                    'title'      => esc_html__( 'Sticky Header', 'benzo-toolkit' ),
                    'subtitle'   => esc_html__( 'It will stick header at the top when page scrolling. Default comes form theme option', 'benzo-toolkit' ),
                    'options'    => [
                        'default'  => esc_html__( 'Default', 'benzo-toolkit' ),
                        'enabled'  => esc_html__( 'Enable', 'benzo-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'benzo-toolkit' ),
                    ],
                    'default'    => 'default',
                    'dependency' => [
                        'page_default_header', '!=', 'disabled',
                    ],
                ],
            ],
        ] );

        // Page Title
        CSF::createSection( $this->page_prefix, [
            'title'  => esc_html__( 'Page Title', 'benzo-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Page Title', 'benzo-toolkit' ),
                ],
                [
                    'id'      => 'page_title',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Page Title', 'benzo-toolkit' ),
                    'options' => [
                        'default'  => esc_html__( 'Default', 'benzo-toolkit' ),
                        'enabled'  => esc_html__( 'Enable', 'benzo-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'benzo-toolkit' ),
                    ],
                    'default' => 'default',
                ],
                [
                    'id'         => 'page_title_type',
                    'type'       => 'button_set',
                    'title'      => esc_html__( 'Page Title Type', 'benzo-toolkit' ),
                    'options'    => [
                        'default' => esc_html__( 'Default', 'benzo-toolkit' ),
                        'custom'  => esc_html__( 'Custom', 'benzo-toolkit' ),
                    ],
                    'default'    => 'default',
                    'dependency' => ['page_title', '!=', 'disabled'],
                ],
                [
                    'id'         => 'page_custom_title',
                    'type'       => 'text',
                    'title'      => esc_html__( 'Custom Title', 'benzo-toolkit' ),
                    'dependency' => [
                        ['page_title', '!=', 'disabled'],
                        ['page_title_type', '==', 'custom'],
                    ],
                ],
                [
                    'id'         => 'page_breadcrumb',
                    'type'       => 'button_set',
                    'title'      => esc_html__( 'Page Breadcrumb', 'benzo-toolkit' ),
                    'options'    => [
                        'default'  => esc_html__( 'Default', 'benzo-toolkit' ),
                        'enabled'  => esc_html__( 'Enable', 'benzo-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'benzo-toolkit' ),
                    ],
                    'default'    => 'default',
                    'dependency' => ['page_title', '!=', 'disabled'],
                ],
                [
                    'id'         => 'customize_page_title_style',
                    'type'       => 'button_set',
                    'title'      => esc_html__( 'Customize Style', 'benzo-toolkit' ),
                    'options'    => [
                        'yes' => esc_html__( 'Yes', 'benzo-toolkit' ),
                        'no'  => esc_html__( 'No', 'benzo-toolkit' ),
                    ],
                    'default'    => 'no',
                    'dependency' => ['page_title', '!=', 'disabled'],
                ],
                [
                    'type'       => 'subheading',
                    'content'    => esc_html__( 'Page Title Styling', 'benzo-toolkit' ),
                    'dependency' => [
                        ['page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'          => 'page_title_padding',
                    'type'        => 'spacing',
                    'title'       => esc_html__( 'Padding', 'benzo-toolkit' ),
                    'output'      => '.page-title-area',
                    'output_mode' => 'padding',
                    'dependency'  => [
                        ['page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'         => 'page_title_border',
                    'type'       => 'border',
                    'title'      => esc_html__( 'Border', 'benzo-toolkit' ),
                    'output'     => '.page-title-area',
                    'dependency' => [
                        ['page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'          => 'page_title_bg',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Background Color', 'benzo-toolkit' ),
                    'output'      => '.page-title-area',
                    'output_mode' => 'background-color',
                    'dependency'  => [
                        ['page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'         => 'page_title_typo',
                    'type'       => 'typography',
                    'title'      => esc_html( 'Typography', 'benzo-toolkit' ),
                    'output'     => '.page-title-area .page-title',
                    'dependency' => [
                        ['page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'         => 'page_breadcrumb_typo',
                    'type'       => 'typography',
                    'title'      => esc_html( 'Breadcrumb Typography', 'benzo-toolkit' ),
                    'output'     => '.page-title-area .breadcrumb, .page-title-area .breadcrumb a',
                    'dependency' => [
                        ['page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'          => 'page_title_dot',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Dots Color', 'benzo-toolkit' ),
                    'output'      => '.page-title-area .breadcrumb::before',
                    'output_mode' => 'background-color',
                    'dependency'  => [
                        ['page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
            ],
        ] );

        // Footer
        CSF::createSection( $this->page_prefix, [
            'title'  => esc_html__( 'Footer', 'benzo-toolkit' ),
            'fields' => [
                [
                    'type'    => 'notice',
                    'style'   => 'info',
                    'content' => esc_html__( 'If you used theme builder for page footer then disable default footer', 'benzo-toolkit' ),
                ],
                [
                    'id'       => 'page_default_footer',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Default Footer', 'benzo-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable page default footer. Default comes form theme option', 'benzo-toolkit' ),
                    'options'  => [
                        'default'  => esc_html__( 'Default', 'benzo-toolkit' ),
                        'enabled'  => esc_html__( 'Enable', 'benzo-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'benzo-toolkit' ),
                    ],
                    'default'  => 'default',
                ],
                [
                    'type'       => 'notice',
                    'style'      => 'warning',
                    'content'    => esc_html__( 'You disabled default footer. Set your page footer form ', 'benzo-toolkit' ) . '<a href="' . esc_url( $this->template_builder_url ) . '">' . esc_html__( 'here', 'benzo-toolkit' ) . '</a>',
                    'dependency' => [
                        'page_default_footer', '==', 'disabled',
                    ],
                ],
            ],
        ] );
    }

    public function category_metaboxes() {
        CSF::createTaxonomyOptions( $this->category_prefix, [
            'title'        => esc_html__( 'Benzo Category Options', 'benzo-toolkit' ),
            'taxonomy'     => 'category',
            'show_restore' => true,
        ] );

        CSF::createSection( $this->category_prefix, [
            'fields' => [
                [
                    'id'      => 'category_thumbnail',
                    'type'    => 'media',
                    'title'   => esc_html__( 'Category Thumbnail', 'benzo-toolkit' ),
                    'library' => 'image',
                ],
                [
                    'id'    => 'category_icon',
                    'type'  => 'icon',
                    'title' => esc_html__( 'Category Icon', 'benzo-toolkit' ),
                ],
                [
                    'id'       => 'category_color',
                    'type'     => 'color',
                    'default'  => '#fb2614',
                    'title'    => esc_html__( 'Category Color', 'benzo-toolkit' ),
                    'subtitle' => esc_html__( 'For design purpose', 'benzo-toolkit' ),
                ],
            ],
        ] );
    }
}

Benzo_Metaboxes::instance()->initialize();