<?php
/**
 * Plugin Name: Benzo Toolkit
 * Description: A Helper plugin for all benzo Wordpress Themes
 * Plugin URI: #
 * Author: Webtend
 * AUthor URI: http://webtend.net/
 * Version: 1.0
 * Text Domain: benzo-toolkit
 * License: GPL2 or later
 * License URI: http://www.gnu.org/licences/gpl-2.0.html
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * The Main Plugin class
 */
final class Benzo_Toolkit {

    /**
     * Addon Version
     *
     * @since 1.0.0
     * @var string The Plugin version.
     */
    const version = '1.0';

    /**
     * Minimum PHP Version
     *
     * @since 1.0.0
     * @var string Minimum PHP version required to run the Plugin.
     */
    const MINIMUM_PHP_VERSION = '5.6';

    /**
     * Class Constructor
     */
    private function __construct() {
        $this->define_constants();

        add_action( 'plugin_loaded', [$this, 'init_plugin'] );
    }

    /**
     * Initializes a singleton instance
     *
     * @return \Benzo_Toolkit
     */
    public static function init() {
        static $instance = false;

        if ( ! $instance ) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * Define the required plugin constants
     *
     * @return void
     */
    public function define_constants() {
        define( 'BT_VERSION', self::version );
        define( 'BT_FILE', __FILE__ );
        define( 'BT_PATH', plugin_dir_path( BT_FILE ) );
        define( 'BT_URL', plugin_dir_url( BT_FILE ) );
        define( 'BT_ASSETS', untrailingslashit( BT_URL . 'assets' ) );
        define( 'BT_INCLUDES', untrailingslashit( BT_PATH . 'includes' ) );
        define( 'BT_WP_WIDGETS', untrailingslashit( BT_PATH . 'includes/wp-widgets' ) );
    }

    /**
     * Load Textdomain
     *
     * Load plugin localization files.
     *
     * Fired by `init` action hook.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function i18n() {
        load_plugin_textdomain( 'benzo-toolkit', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
    }

    /**
     * Initialize the plugin
     *
     * @return void
     */
    public function init_plugin() {
        if ( $this->is_compatible() ) {
            $this->include_files();
        }
    }

    /**
     * Get current theme slug
     *
     * @access public
     * @static
     */
    public static function get_theme_slug() {
        return str_replace( '-child', '', wp_get_theme()->get( 'TextDomain' ) );
    }

    /**
     * Check Compatible
     *
     * @access public
     * @static
     *
     * @return boolean
     */
    public static function theme_is_compatible() {
        $plugin_name = trim( dirname( plugin_basename( __FILE__ ) ) );
        $theme_name  = self::get_theme_slug();

        return false !== stripos( $plugin_name, $theme_name );
    }

    /**
     * Compatibility Checks
     *
     * Checks whether the site meets the addon requirement.
     *
     * @since 1.0.0
     * @access public
     */
    public function is_compatible() {
        // Check for required PHP version
        if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
            add_action( 'admin_notices', [$this, 'admin_notice_minimum_php_version'] );
            return false;
        }

        // Check For 'benzo-toolkit' Theme install or active
        if ( ! self::theme_is_compatible() ) {
            add_action( 'admin_notices', [$this, 'admin_notice_missing_main_theme'] );
            return false;
        }

        return true;
    }

    public function is_active_elementor() {
        if ( ! did_action( 'elementor/loaded' ) ) {
            return false;
        }

        return true;
    }

    /**
     * Include required plugin files
     *
     * @return void
     */
    public function include_files() {
        include_once BT_INCLUDES . '/library/codestar-framework/codestar-framework.php';
        include_once BT_INCLUDES . '/helper/helper.php';
        include_once BT_INCLUDES . '/helper/theme-options.php';
        include_once BT_INCLUDES . '/helper/metaboxes.php';
        include_once BT_INCLUDES . '/helper/ajax.php';

        if ( $this->is_active_elementor() ) {
            include_once BT_INCLUDES . '/elementor/init.php';
            include_once BT_INCLUDES . '/template-builder/template-builder.php';
        }

        require_once BT_WP_WIDGETS . '/benzo-recent-post.php';
        require_once BT_WP_WIDGETS . '/benzo-author.php';
        require_once BT_WP_WIDGETS . '/benzo-categories.php';
        require_once BT_WP_WIDGETS . '/benzo-cta.php';

        require_once BT_INCLUDES . '/demo-config/demo-config.php';
    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have a minimum required PHP version.
     *
     * @since 1.0.0
     * @access public
     */
    public function admin_notice_minimum_php_version() {

        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }

        $message = sprintf(
            /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
            esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'benzo-toolkit' ),
            '<strong>' . esc_html__( 'Benzo Toolkit', 'benzo-toolkit' ) . '</strong>',
            '<strong>' . esc_html__( 'PHP', 'benzo-toolkit' ) . '</strong>',
            self::MINIMUM_PHP_VERSION
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have Benzo theme installed or activated.
     *
     * @since 1.0.0
     * @access public
     */
    public function admin_notice_missing_main_theme() {

        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }

        $message = sprintf(
            esc_html__( '"%1$s" plugin requires Benzo theme to be installed and activated', 'benzo-toolkit' ),
            '<strong>' . esc_html__( 'Benzo Toolkit', 'benzo-toolkit' ) . '</strong>',
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }

}

/**
 * Initializes the main plugin
 *
 * @return void
 */
function benzo_toolkit() {
    return Benzo_Toolkit::init();
}

// kick-off the plugin
benzo_toolkit();