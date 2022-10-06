<?php
namespace BenzoToolkit\TemplateBuilder;

use CSF;

defined( 'ABSPATH' ) || exit;

class Template_Metaboxes {

    protected static $instance = null;
    private $prefix            = 'benzo_template_meta';

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

        $this->init_metaboxes();
    }

    public function init_metaboxes() {
        CSF::createMetabox( $this->prefix, [
            'title'        => esc_html__( 'Template Settings', 'benzo-toolkit' ),
            'post_type'    => 'benzo_template',
            'show_restore' => true,
            'theme'        => 'dark',
            'data_type'    => 'unserialize',
        ] );

        CSF::createSection( $this->prefix, [
            'fields' => [
                [
                    'id'     => 'benzo_tb_settings',
                    'type'   => 'fieldset',
                    'title'  => esc_html__( 'Common Settings', 'benzo-toolkit' ),
                    'fields' => [
                        [
                            'id'          => 'template_type',
                            'type'        => 'select',
                            'title'       => esc_html__( 'Template Type', 'benzo-toolkit' ),
                            'placeholder' => esc_html__( 'Select Type', 'benzo-toolkit' ),
                            'options'     => [
                                'header'    => esc_html__( 'Header', 'benzo-toolkit' ),
                                'footer'    => esc_html__( 'Footer', 'benzo-toolkit' ),
                                'block'     => esc_html__( 'Block', 'benzo-toolkit' ),
                                'popup'     => esc_html__( 'Popup', 'benzo-toolkit' ),
                                'offcanvas' => esc_html__( 'OffCanvas', 'benzo-toolkit' ),
                            ],
                            'default'     => 'block',
                        ],
                        [
                            'id'         => 'popup_width',
                            'type'       => 'select',
                            'title'      => esc_html__( 'Popup Width', 'benzo-toolkit' ),
                            'subtitle'   => esc_html__( 'Select or type a value (PX)', 'benzo-toolkit' ),
                            'options'    => [
                                'full'   => esc_html__( 'Full', 'benzo-toolkit' ),
                                'custom' => esc_html__( 'Custom', 'benzo-toolkit' ),
                            ],
                            'default'    => 'custom',
                            'dependency' => ['template_type', '==', 'popup'],
                        ],
                        [
                            'id'         => 'set_popup_width',
                            'type'       => 'dimensions',
                            'title'      => esc_html__( 'Popup Width', 'benzo-toolkit' ),
                            'default'    => [
                                'width' => '820',
                            ],
                            'height'     => false,
                            'units'      => ['px'],
                            'show_units' => false,
                            'dependency' => ['template_type|popup_width', '==|==', 'popup|custom'],
                        ],
                        [
                            'id'         => 'popup_height',
                            'type'       => 'select',
                            'title'      => esc_html__( 'Popup Height', 'benzo-toolkit' ),
                            'subtitle'   => esc_html__( 'Set the popup max height.', 'benzo-toolkit' ),
                            'options'    => [
                                'fit_content' => esc_html__( 'Fit Content', 'benzo-toolkit' ),
                                'full'        => esc_html__( 'Full', 'benzo-toolkit' ),
                                'custom'      => esc_html__( 'Custom', 'benzo-toolkit' ),
                            ],
                            'default'    => 'fit_content',
                            'dependency' => ['template_type', '==', 'popup'],
                        ],
                        [
                            'id'         => 'set_popup_height',
                            'type'       => 'dimensions',
                            'title'      => esc_html__( 'Height', 'benzo-toolkit' ),
                            'default'    => [
                                'height' => '520',
                            ],
                            'width'      => false,
                            'units'      => ['px'],
                            'show_units' => false,
                            'dependency' => ['template_type|popup_height', '==|==', 'popup|custom'],
                        ],
                        [
                            'id'         => 'popup_position',
                            'type'       => 'select',
                            'title'      => esc_html__( 'Popup Position', 'benzo-toolkit' ),
                            'subtitle'   => esc_html__( 'Choose the popup position on page.', 'benzo-toolkit' ),
                            'options'    => [
                                'center-center' => esc_html__( 'Center Center', 'benzo-toolkit' ),
                                'center-left'   => esc_html__( 'Center Left', 'benzo-toolkit' ),
                                'center-right'  => esc_html__( 'Center Right', 'benzo-toolkit' ),
                                'bottom-center' => esc_html__( 'Bottom Center', 'benzo-toolkit' ),
                                'top-center'    => esc_html__( 'Top Center', 'benzo-toolkit' ),
                                'bottom-left'   => esc_html__( 'Bottom Left', 'benzo-toolkit' ),
                                'top-left'      => esc_html__( 'Top Left', 'benzo-toolkit' ),
                                'bottom-right'  => esc_html__( 'Bottom Right', 'benzo-toolkit' ),
                                'top-right'     => esc_html__( 'Top Right', 'benzo-toolkit' ),
                            ],
                            'default'    => 'center-center',
                            'dependency' => ['template_type', '==', 'popup'],
                        ],
                        [
                            'id'         => 'popup_overly_color',
                            'type'       => 'color',
                            'title'      => esc_html__( 'Popup Overly Color', 'benzo-toolkit' ),
                            'dependency' => ['template_type', '==', 'popup'],
                            'default'    => 'rgba(0, 0, 0, 0.5)',
                        ],
                        [
                            'id'         => 'popup_close_color',
                            'type'       => 'color',
                            'title'      => esc_html__( 'Popup Close Color', 'benzo-toolkit' ),
                            'dependency' => ['template_type', '==', 'popup'],
                            'default'    => '#fb2614',
                        ],
                        [
                            'id'         => 'popup_close_bg',
                            'type'       => 'color',
                            'title'      => esc_html__( 'Popup Close Color', 'benzo-toolkit' ),
                            'dependency' => ['template_type', '==', 'popup'],
                            'default'    => '#ffffff',
                        ],
                        [
                            'id'         => 'popup_close_size',
                            'type'       => 'dimensions',
                            'title'      => esc_html__( 'Popup Close Size', 'benzo-toolkit' ),
                            'dependency' => ['template_type', '==', 'popup'],
                            'units'      => ['px'],
                            'default'    => [
                                'width'  => '40',
                                'height' => '40',
                            ],
                            'show_units' => false,
                        ],
                        [
                            'id'         => 'popup_close_radius',
                            'type'       => 'number',
                            'title'      => esc_html__( 'Popup Close Radius', 'benzo-toolkit' ),
                            'dependency' => ['template_type', '==', 'popup'],
                        ],
                        [
                            'id'         => 'popup_delay',
                            'type'       => 'number',
                            'title'      => esc_html__( 'Popup Delay', 'benzo-toolkit' ),
                            'dependency' => ['template_type', '==', 'popup'],
                            'default'    => 3,
                            'subtitle'   => esc_html__( 'Show when page is loaded (Second).', 'benzo' ),
                        ],
                        [
                            'id'         => 'offcanvas_width',
                            'type'       => 'dimensions',
                            'title'      => esc_html__( 'Width', 'benzo-toolkit' ),
                            'height'     => false,
                            'units'      => ['px'],
                            'default'    => [
                                'width' => '420',
                            ],
                            'show_units' => false,
                            'dependency' => ['template_type', '==', 'offcanvas'],
                        ],
                    ],
                ],
                [
                    'id'           => 'benzo_tb_include',
                    'type'         => 'repeater',
                    'title'        => esc_html__( 'Display On', 'benzo-toolkit' ),
                    'subtitle'     => esc_html__( 'Select the locations where this item should be visible.', 'benzo-toolkit' ),
                    'button_title' => esc_html__( 'Add Display Rule', 'benzo-toolkit' ),
                    'dependency'   => ['template_type', 'any', 'header,footer,popup'],
                    'fields'       => [
                        [
                            'type'    => 'subheading',
                            'content' => esc_html__( 'Define Rule', 'benzo-toolkit' ),
                        ],
                        [
                            'id'      => 'rule',
                            'type'    => 'select',
                            'title'   => esc_html__( 'Display on', 'benzo-toolkit' ),
                            'options' => [
                                'entire_website'    => esc_html__( 'Entire Website', 'benzo-toolkit' ),
                                'all_pages'         => esc_html__( 'All Pages', 'benzo-toolkit' ),
                                'front_page'        => esc_html__( 'Front Page', 'benzo-toolkit' ),
                                'post_page'         => esc_html__( 'Post Page', 'benzo-toolkit' ),
                                'post_details'      => esc_html__( 'Post Details', 'benzo-toolkit' ),
                                'all_archive'       => esc_html__( 'All Archive', 'benzo-toolkit' ),
                                'date_archive'      => esc_html__( 'Date Archive', 'benzo-toolkit' ),
                                'author_archive'    => esc_html__( 'Author Archive', 'benzo-toolkit' ),
                                'search_page'       => esc_html__( 'Search Page', 'benzo-toolkit' ),
                                '404_page'          => esc_html__( '404 Page', 'benzo-toolkit' ),
                                'specific_pages'    => esc_html__( 'Specific Pages', 'benzo-toolkit' ),
                                'specific_posts'    => esc_html__( 'Specific Posts', 'benzo-toolkit' ),
                                'shop_page'         => esc_html__( 'Shop Page', 'benzo-toolkit' ),
                                'product_details'   => esc_html__( 'Product Details', 'benzo-toolkit' ),
                                'specific_products' => esc_html__( 'Specific Products', 'benzo-toolkit' ),
                            ],
                        ],
                        [
                            'id'          => 'page_ids',
                            'type'        => 'select',
                            'title'       => esc_html__( 'Select Pages', 'benzo-toolkit' ),
                            'placeholder' => esc_html__( 'Select Pages', 'benzo-toolkit' ),
                            'chosen'      => true,
                            'ajax'        => true,
                            'multiple'    => true,
                            'sortable'    => true,
                            'options'     => 'pages',
                            'dependency'  => ['rule', '==', 'specific_pages'],
                        ],
                        [
                            'id'          => 'posts_ids',
                            'type'        => 'select',
                            'title'       => esc_html__( 'Select Posts', 'benzo-toolkit' ),
                            'placeholder' => esc_html__( 'Select Posts', 'benzo-toolkit' ),
                            'chosen'      => true,
                            'ajax'        => true,
                            'multiple'    => true,
                            'sortable'    => true,
                            'options'     => 'posts',
                            'dependency'  => ['rule', '==', 'specific_posts'],
                        ],
                        [
                            'id'          => 'product_ids',
                            'type'        => 'select',
                            'title'       => esc_html__( 'Select Products', 'benzo-toolkit' ),
                            'placeholder' => esc_html__( 'Select Products', 'benzo-toolkit' ),
                            'chosen'      => true,
                            'ajax'        => true,
                            'multiple'    => true,
                            'sortable'    => true,
                            'options'     => 'post',
                            'query_args'  => [
                                'post_type' => 'product',
                            ],
                            'dependency'  => ['rule', '==', 'specific_products'],
                        ],
                    ],
                ],
                [
                    'id'           => 'benzo_tb_exclude',
                    'type'         => 'repeater',
                    'title'        => esc_html__( 'Hide On', 'benzo-toolkit' ),
                    'subtitle'     => esc_html__( 'Select the locations where this item should be visible.', 'benzo-toolkit' ),
                    'button_title' => esc_html__( 'Add Hide Rule', 'benzo-toolkit' ),
                    'dependency'   => ['template_type', 'any', 'header,footer,popup'],
                    'fields'       => [
                        [
                            'type'    => 'subheading',
                            'content' => esc_html__( 'Hide Rule', 'benzo-toolkit' ),
                        ],
                        [
                            'id'      => 'rule',
                            'type'    => 'select',
                            'title'   => esc_html__( 'Hide on', 'benzo-toolkit' ),
                            'options' => [
                                'entire_website'    => esc_html__( 'Entire Website', 'benzo-toolkit' ),
                                'all_pages'         => esc_html__( 'All Pages', 'benzo-toolkit' ),
                                'front_page'        => esc_html__( 'Front Page', 'benzo-toolkit' ),
                                'post_page'         => esc_html__( 'Post Page', 'benzo-toolkit' ),
                                'post_details'      => esc_html__( 'Post Details', 'benzo-toolkit' ),
                                'all_archive'       => esc_html__( 'All Archive', 'benzo-toolkit' ),
                                'date_archive'      => esc_html__( 'Date Archive', 'benzo-toolkit' ),
                                'author_archive'    => esc_html__( 'Author Archive', 'benzo-toolkit' ),
                                'search_page'       => esc_html__( 'Search Page', 'benzo-toolkit' ),
                                '404_page'          => esc_html__( '404 Page', 'benzo-toolkit' ),
                                'specific_pages'    => esc_html__( 'Specific Pages', 'benzo-toolkit' ),
                                'specific_posts'    => esc_html__( 'Specific Posts', 'benzo-toolkit' ),
                                'shop_page'         => esc_html__( 'Shop Page', 'benzo-toolkit' ),
                                'product_details'   => esc_html__( 'Product Details', 'benzo-toolkit' ),
                                'specific_products' => esc_html__( 'Specific Products', 'benzo-toolkit' ),
                            ],
                        ],
                        [
                            'id'          => 'page_ids',
                            'type'        => 'select',
                            'title'       => esc_html__( 'Select Pages', 'benzo-toolkit' ),
                            'placeholder' => esc_html__( 'Select Pages', 'benzo-toolkit' ),
                            'chosen'      => true,
                            'ajax'        => true,
                            'multiple'    => true,
                            'sortable'    => true,
                            'options'     => 'pages',
                            'dependency'  => ['rule', '==', 'specific_pages'],
                        ],
                        [
                            'id'          => 'posts_ids',
                            'type'        => 'select',
                            'title'       => esc_html__( 'Select Posts', 'benzo-toolkit' ),
                            'placeholder' => esc_html__( 'Select Posts', 'benzo-toolkit' ),
                            'chosen'      => true,
                            'ajax'        => true,
                            'multiple'    => true,
                            'sortable'    => true,
                            'options'     => 'posts',
                            'dependency'  => ['rule', '==', 'specific_posts'],
                        ],
                        [
                            'id'          => 'product_ids',
                            'type'        => 'select',
                            'title'       => esc_html__( 'Select Products', 'benzo-toolkit' ),
                            'placeholder' => esc_html__( 'Select Products', 'benzo-toolkit' ),
                            'chosen'      => true,
                            'ajax'        => true,
                            'multiple'    => true,
                            'sortable'    => true,
                            'options'     => 'post',
                            'query_args'  => [
                                'post_type' => 'product',
                            ],
                            'dependency'  => ['rule', '==', 'specific_products'],
                        ],
                    ],
                ],
            ],
        ] );
    }
}

Template_Metaboxes::instance()->initialize();