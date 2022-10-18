<?php
namespace BenzoToolkit\DemoConfig;

if ( ! defined( 'ABSPATH' ) ) {
    exit( 'No direct script access allowed' );
}

class Benzo_Demo_Config {
    protected static $instance = null;

    public static function instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

     public function initialize() {
        add_filter( 'ocdi/import_files', [$this, 'import_files_config'] );
        add_filter( 'ocdi/after_import', [$this, 'ocdi_after_import_setup'] );
        add_filter( 'ocdi/disable_pt_branding', '__return_true' );
        add_filter( 'ocdi/after_import', [$this, 'after_import_demo'] );
        add_action( 'ocdi', [$this, 'webtend_toolkit_rewrite_flush'] );
        add_filter( 'ocdi/register_plugins', [$this, 'register_plugins'] );
    }

    /**
     * Import Files
     */
   public function import_files_config() {

        // Demo 01
        $home_prevs1 = [
            'benzo_home_1' => [
                'title'        => __( 'Digital Home 01', 'benzo-toolkit' ),
                'page'         => __( 'home', 'benzo-toolkit' ),
                'screenshot'   => plugins_url( 'assets/img/preview/home1.png', dirname( __FILE__ ) ),
                'preview_link' => 'https://demo.webtend.net/wp/benzo',
            ],
            'benzo_home_2' => [
                'title'        => __( 'Digital Home 02', 'benzo-toolkit' ),
                'page'         => __( 'home-02', 'benzo-toolkit' ),      
                'screenshot'   => plugins_url( 'assets/img/preview/home2.png', dirname( __FILE__ ) ),
                'preview_link' => 'https://demo.webtend.net/wp/benzo',
            ],
            'benzo_home_3' => [
                'title'        => __( 'Digital Home 03', 'benzo-toolkit' ),
                'page'         => __( 'home-03', 'benzo-toolkit' ),      
                'screenshot'   => plugins_url( 'assets/img/preview/home2.png', dirname( __FILE__ ) ),
                'preview_link' => 'https://demo.webtend.net/wp/benzo',
            ],
        ]; 


        $home_prevs2 = [
            'benzo_home_11' => [
                'title'        => __( 'IT Solution Home 01', 'benzo-toolkit' ),
                'page'         => __( 'home', 'benzo-toolkit' ),
                'screenshot'   => plugins_url( 'assets/img/preview/home1.png', dirname( __FILE__ ) ),
                'preview_link' => 'https://demo.webtend.net/wp/benzo',
            ],
            'benzo_home_22' => [
                'title'        => __( 'IT Solution Home 02', 'benzo-toolkit' ),
                'page'         => __( 'home-02', 'benzo-toolkit' ),      
                'screenshot'   => plugins_url( 'assets/img/preview/home2.png', dirname( __FILE__ ) ),
                'preview_link' => 'https://demo.webtend.net/wp/benzo',
            ],
             'benzo_home_33' => [
                'title'        => __( 'IT Solution Home 03', 'benzo-toolkit' ),
                'page'         => __( 'home-03', 'benzo-toolkit' ),      
                'screenshot'   => plugins_url( 'assets/img/preview/home2.png', dirname( __FILE__ ) ),
                'preview_link' => 'https://demo.webtend.net/wp/benzo',
            ],
        ];


        $config = [];

        $import_path = trailingslashit( get_template_directory() ) . 'demo/';

        foreach ( $home_prevs1 as $key => $prev ) {

            $contents_demo = $import_path . '/demo/contents-demo.xml';
            $widget_settings = $import_path . '/demo/widget-settings.json';
            $customizer_data = $import_path . '/demo/customizer-data.dat';

            $config[] = [
                'import_file_id'               => $key,
                'import_page_name'             => $prev['page'],
                'import_file_name'             => $prev['title'],
                'local_import_file'            => $contents_demo,
                'local_import_widget_file'     => $widget_settings,
                'local_import_customizer_file' => $customizer_data,
                'import_preview_image_url'     => $prev['screenshot'],
                'preview_url'                  => $prev['preview_link'],
                'import_notice'                => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'benzo-toolkit' ),
            ];
        }

        foreach ( $home_prevs2 as $key => $prev ) {

            $contents_demo = $import_path . '/demo/contents-demo.xml';
            $widget_settings = $import_path . '/demo/widget-settings.json';
            $customizer_data = $import_path . '/demo/customizer-data.dat';

            $config[] = [
                'import_file_id'               => $key,
                'import_page_name'             => $prev['page'],
                'import_file_name'             => $prev['title'],
                'local_import_file'            => $contents_demo,
                'local_import_widget_file'     => $widget_settings,
                'local_import_customizer_file' => $customizer_data,
                'import_preview_image_url'     => $prev['screenshot'],
                'preview_url'                  => $prev['preview_link'],
                'import_notice'                => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'benzo-toolkit' ),
            ];
        }


        return $config;
    }

    /**
     * After Import Demo
     *
     * Do Stuff After Demo Import
     */

    public function webtend_toolkit_rewrite_flush() {

        if ( get_option( 'basa_ocdi_importer_flash' ) == true ) {
            flush_rewrite_rules();
            delete_option( 'basa_ocdi_importer_flash' );
        }
    }

    public function after_import_demo() {
        $main_menu = get_term_by( 'name', 'Primary Menu', 'nav_menu' );

        set_theme_mod( 'nav_menu_locations',
            [
                'primary_menu' => $main_menu->term_id,
            ]
        );

        $front_page_id = get_page_by_title( 'Home' );
        $blog_page_id  = get_page_by_title( 'News Classic' );

        update_option( 'elementor_disable_color_schemes', 'yes' );
        update_option( 'elementor_disable_typography_schemes', 'yes' );
        update_option( 'elementor_global_image_lightbox', 'no' );

        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $front_page_id->ID );
        update_option( 'page_for_posts', $blog_page_id->ID );
    }

    /**
     * Register Plugins
     */
    public function register_plugins( $plugins ) {
        $theme_plugins = [
            [
                'name'        => esc_html__( 'Elementor Website Builder', 'benzo-toolkit' ),
                'slug'        => 'elementor',
                'required'    => true,
                'preselected' => true,
            ],
            [
                'name'        => esc_html__( 'Benzo Toolkit', 'benzo' ),
                'slug'        => 'benzo-toolkit',
                'source'      => get_template_directory() . '/inc/plugins/benzo-toolkit.zip',
                'required'    => true,
                'version'     => '1.0.0',
                'preselected' => true,
            ],
            [
                'name'     => esc_html__( 'Contact Form 7', 'benzo-toolkit' ),
                'slug'     => 'contact-form-7',
                'required' => false,
            ],
            [
                'name'     => esc_html__( 'Breadcrumb NavXT', 'benzo-toolkit' ),
                'slug'     => 'breadcrumb-navxt',
                'required' => false,
            ],
            [
                'name'     => esc_html__( 'MC4WP: Mailchimp for WordPress', 'benzo-toolkit' ),
                'slug'     => 'mailchimp-for-wp',
                'required' => false,
            ],
        ];

        return array_merge( $plugins, $theme_plugins );
    }
}

Benzo_Demo_Config::instance()->initialize();