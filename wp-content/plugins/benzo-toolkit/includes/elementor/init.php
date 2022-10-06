<?php
namespace BenzoToolkit\ElementorAddon;

defined( 'ABSPATH' ) || exit;

use BenzoToolkit\Helper\Benzo_Toolkit_Helper;
use Elementor\Plugin;

/**
 * Benzo Elementor Addon
 */
if ( ! class_exists( 'Benzo_Elementor_Addon' ) ) {
    class Benzo_Elementor_Addon {

        /**
         * The default path to elementor dir on this plugin.
         *
         * @var string
         */
        private $dir_path;

        /**
         * Instance
         *
         * @since 1.0.0
         *
         * @access private
         * @static
         */
        protected static $instance = null;

        /**
         * Instance
         *
         * Ensures only one instance of the class is loaded or can be loaded.
         *
         * @since 1.0.0
         *
         * @access public
         * @static
         */
        public static function instance() {
            if ( null === self::$instance ) {
                self::$instance = new self();
            }

            return self::$instance;
        }

        /**
         * Initialize Addons
         *
         * @since 1.0.0
         *
         * @access public
         */
        public function initialize() {
            $this->dir_path = plugin_dir_path( __FILE__ );

            add_action( 'elementor/init', [$this, 'elementor_init'] );
        }

        /**
         * Initialize Elementor Action
         *
         * Load the plugin only after Elementor are loaded.
         *
         * Fired by `plugins_loaded` action hook.
         *
         * @since 1.0.0
         *
         * @access public
         */
        public function elementor_init() {

            // Add New Elementor Categories
            add_action( 'elementor/elements/categories_registered', [$this, 'init_categories'] );

            // Register Frontend Widget Scripts
            add_action( 'elementor/frontend/after_register_scripts', [$this, 'register_widget_scripts'] );

            // Register New Widgets
            add_action( 'elementor/widgets/widgets_registered', [$this, 'init_widgets'] );

            // Include Helper
            $this->include_files();
        }

        /**
         * Widgets Category
         *
         * @since 1.0.0
         * @access public
         */
        public function init_categories( $elements_manager ) {
            $elements_manager->add_category(
                'benzo_elements',
                [
                    'title' => esc_html__( 'Benzo Elements', 'benzo-toolkit' ),
                    'icon'  => 'fa fa-smile-o',
                ]
            );
        }

        /**
         * Widgets Scripts
         *
         * @since 1.0.0
         * @access public
         */
        public function register_widget_scripts() {
            wp_enqueue_script(
                'benzo-toolkit',
                BT_ASSETS . '/js/benzo-toolkit.min.js',
                ['jquery'],
                BT_VERSION,
                true
            );
        }

        /**
         * Init Widgets
         *
         * Include widgets files and register them
         *
         * @since 1.0.0
         * @access public
         */
        public function init_widgets() {
            $template_names       = [];
            $template_path        = '/benzo-toolkit/elementor/widgets/';
            $plugin_template_path = $this->dir_path . 'widgets/';
            $widgets_manager      = Plugin::instance()->widgets_manager;

            foreach ( glob( $plugin_template_path . '*.php' ) as $file ) {
                $template_name = basename( $file );
                array_push( $template_names, $template_name );
            }

            $files = Benzo_Toolkit_Helper::get_locate_template( $template_names, '/elementor/widgets/', $template_path );

            foreach ( (array) $files as $file ) {
                $filename = basename( str_replace( '.php', '', $file ) );
                $class    = ucwords( str_replace( '-', ' ', $filename ) );
                $class    = str_replace( ' ', '_', $class );
                $class    = sprintf( 'BenzoToolkit\ElementorAddon\Widgets\%s', $class );

                // Require Files
                require_once $file;

                // Class File
                if ( class_exists( $class ) ) {
                    $widgets_manager->register_widget_type( new $class );
                }
            }
        }

        /**
         * Include required addon files
         *
         * @return void
         */
        public function include_files() {
            include_once BT_INCLUDES . '/elementor/helper/query-builder.php';
            include_once BT_INCLUDES . '/elementor/helper/render-templates.php';
            include_once BT_INCLUDES . '/elementor/helper/section-settings.php';
        }
    }

    Benzo_Elementor_Addon::instance()->initialize();
}