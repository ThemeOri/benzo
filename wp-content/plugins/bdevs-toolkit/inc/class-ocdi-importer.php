<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}

class OCDI_Demo_Importer {

    public function __construct() {
        add_filter( 'pt-ocdi/import_files', [$this, 'import_files_config'] );
        add_filter( 'pt-ocdi/after_import', [$this, 'ocdi_after_import_setup'] );
        add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );
        add_action( 'init', [$this, 'bdevs_toolkit_rewrite_flush'] );
    }

    public function import_files_config() {

        // Tutor demo
        $home_prevs = [
            'eduman_home_1' => [
                'title'        => __( 'Home Tutor 01', 'bdevs-toolkit' ),
                'page'         => __( 'home', 'bdevs-toolkit' ),
                'screenshot'   => plugins_url( 'assets/preview/home1.jpg', dirname( __FILE__ ) ),
                'preview_link' => 'https://bdevs.net/wp/eduman/',
            ],
            'eduman_home_2' => [
                'title'        => __( 'Home Tutor 02', 'bdevs-toolkit' ),
                'page'         => __( 'home-02', 'bdevs-toolkit' ),      
                'screenshot'   => plugins_url( 'assets/preview/home2.jpg', dirname( __FILE__ ) ),
                'preview_link' => 'https://bdevs.net/wp/eduman/home-02/',
            ],
            'eduman_home_3' => [
                'title'        => __( 'Home Tutor 03', 'bdevs-toolkit' ),
                'page'         => __( 'home-03', 'bdevs-toolkit' ),
                'screenshot'   => plugins_url( 'assets/preview/home3.jpg', dirname( __FILE__ ) ),
                'preview_link' => 'https://bdevs.net/wp/eduman/home-03/',
            ],
        ]; 


        // learnpress demo
        $home_lp_prevs = [
            'eduman_lp_home_1' => [
                'title'        => __( 'Home Learnpress 01', 'bdevs-toolkit' ),
                'page'         => __( 'home', 'bdevs-toolkit' ),
                'screenshot'   => plugins_url( 'assets/preview/home1.jpg', dirname( __FILE__ ) ),
                'preview_link' => 'https://bdevs.net/wp/eduman-lp/',
            ],
            'eduman_lp_home_2' => [
                'title'        => __( 'Home Learnpress 02', 'bdevs-toolkit' ),
                'page'         => __( 'home-02', 'bdevs-toolkit' ),      
                'screenshot'   => plugins_url( 'assets/preview/home2.jpg', dirname( __FILE__ ) ),
                'preview_link' => 'https://bdevs.net/wp/eduman-lp/home-02/',
            ],
            'eduman_lp_home_3' => [
                'title'        => __( 'Home Learnpress 03', 'bdevs-toolkit' ),
                'page'         => __( 'home-03', 'bdevs-toolkit' ),
                'screenshot'   => plugins_url( 'assets/preview/home3.jpg', dirname( __FILE__ ) ),
                'preview_link' => 'https://bdevs.net/wp/eduman-lp/home-03/',
            ],
        ];

        // learndash demo
        $home_ld_prevs = [
            'eduman_lp_home_1' => [
                'title'        => __( 'Home Learndash 01', 'bdevs-toolkit' ),
                'page'         => __( 'home', 'bdevs-toolkit' ),
                'screenshot'   => plugins_url( 'assets/preview/home1.jpg', dirname( __FILE__ ) ),
                'preview_link' => 'https://bdevs.net/wp/eduman-ld/',
            ],
            'eduman_ld_home_2' => [
                'title'        => __( 'Home Learndash 02', 'bdevs-toolkit' ),
                'page'         => __( 'home-02', 'bdevs-toolkit' ),      
                'screenshot'   => plugins_url( 'assets/preview/home2.jpg', dirname( __FILE__ ) ),
                'preview_link' => 'https://bdevs.net/wp/eduman-ld/home-02/',
            ],
            'eduman_ld_home_3' => [
                'title'        => __( 'Home Learndash 03', 'bdevs-toolkit' ),
                'page'         => __( 'home-03', 'bdevs-toolkit' ),
                'screenshot'   => plugins_url( 'assets/preview/home3.jpg', dirname( __FILE__ ) ),
                'preview_link' => 'https://bdevs.net/wp/eduman-ld/home-03/',
            ],
        ];


        $config = [];

        $import_path = trailingslashit( get_template_directory() ) . 'sample-data/';

        foreach ( $home_prevs as $key => $prev ) {

            $contents_demo = $import_path . '/tutor/contents-demo.xml';
            $widget_settings = $import_path . '/tutor/widget-settings.json';
            $customizer_data = $import_path . '/tutor/customizer-data.dat';

            $config[] = [
                'import_file_id'               => $key,
                'import_page_name'             => $prev['page'],
                'import_file_name'             => $prev['title'],
                'local_import_file'            => $contents_demo,
                'local_import_widget_file'     => $widget_settings,
                'local_import_customizer_file' => $customizer_data,
                'import_preview_image_url'     => $prev['screenshot'],
                'preview_url'                  => $prev['preview_link'],
                'import_notice'                => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'bdevs-element' ),
            ];
        }

        // learnpress demo
        foreach ( $home_lp_prevs as $key => $prev ) {

            $contents_demo = $import_path . '/learnpress/contents-demo.xml';
            $widget_settings = $import_path . '/learnpress/widget-settings.json';
            $customizer_data = $import_path . '/learnpress/customizer-data.dat';

            $config[] = [
                'import_file_id'               => $key,
                'import_page_name'             => $prev['page'],
                'import_file_name'             => $prev['title'],
                'local_import_file'            => $contents_demo,
                'local_import_widget_file'     => $widget_settings,
                'local_import_customizer_file' => $customizer_data,
                'import_preview_image_url'     => $prev['screenshot'],
                'preview_url'                  => $prev['preview_link'],
                'import_notice'                => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'bdevs-element' ),
            ];
        }

         // learndash demo
        foreach ( $home_ld_prevs as $key => $prev ) {

            $contents_demo = $import_path . '/learndash/contents-demo.xml';
            $widget_settings = $import_path . '/learndash/widget-settings.json';
            $customizer_data = $import_path . '/learndash/customizer-data.dat';

            $config[] = [
                'import_file_id'               => $key,
                'import_page_name'             => $prev['page'],
                'import_file_name'             => $prev['title'],
                'local_import_file'            => $contents_demo,
                'local_import_widget_file'     => $widget_settings,
                'local_import_customizer_file' => $customizer_data,
                'import_preview_image_url'     => $prev['screenshot'],
                'preview_url'                  => $prev['preview_link'],
                'import_notice'                => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'bdevs-element' ),
            ];
        }


        return $config;
    }

    public function ocdi_after_import_setup( $selected_file ) {

        $this->assign_menu_to_location();
        $this->assign_frontpage_id( $selected_file );
        $this->update_permalinks();
        update_option( 'basa_ocdi_importer_flash', true );
    }

    private function assign_menu_to_location() {

        $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

        set_theme_mod( 'nav_menu_locations', [
            'main-menu' => $main_menu->term_id,
        ] );
    }

    private function assign_frontpage_id( $selected_import ) {

        $front_page = get_page_by_title( $selected_import['import_page_name'] );
        $blog_page = get_page_by_title( 'Blog' );

        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $front_page->ID );
        update_option( 'page_for_posts', $blog_page->ID );
    }

    private function update_permalinks() {
        update_option( 'permalink_structure', '/%postname%/' );
    }

    public function bdevs_toolkit_rewrite_flush() {

        if ( get_option( 'basa_ocdi_importer_flash' ) == true ) {
            flush_rewrite_rules();
            delete_option( 'basa_ocdi_importer_flash' );
        }
    }
}

new OCDI_Demo_Importer;