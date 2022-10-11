<?php

/**
 * Plugin Name:                 Generic Elements For Elementor
 * Plugin URI:                  https://generic-elements.bdevs.net/
 * Description:                 The ultimate Elementor Addons
 * Version:                     1.0.3
 * Author:                      bdevs
 * Requires at least:           5.8
 * Elementor tested up to:      3.7.0
 * Elementor Pro tested up to:  3.7.3
 * Author URI:                  https://bdevs.net/
 * License:                     GPL v2 or later
 * License URI:                 https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:                 generic-elements
 * Domain Path:                 /languages
 */

if (!defined('ABSPATH')) {
    exit;
}

//Require autoload files
require_once __DIR__ . '/vendor/autoload.php';


function generic_elements_render_icon($settings = [], $old_icon_id = 'icon', $new_icon_id = 'selected_icon', $attributes = [])
{
    // Check if its already migrated
    $migrated = isset($settings['__fa4_migrated'][$new_icon_id]);
    // Check if its a new widget without previously selected icon using the old Icon control
    $is_new = empty($settings[$old_icon_id]);

    $attributes['aria-hidden'] = 'true';

    \Elementor\Icons_Manager::render_icon($settings[$new_icon_id], $attributes);
}

/**
 * Base_Plugin class
 *
 * The class that holds the entire Generic_Elements plugin
 */
final class Generic_Elements
{

    /**
     * Plugin version
     *
     * @var string
     */
    public $version = '1.0.0';

    /**
     * Plugin name
     *
     * @var string
     */
    public $plugin_name = 'Generic Elements For Elementor';

    private $_page_id = null;

    /**
     * Constructor for the Base_Plugin class
     *
     * Sets up all the appropriate hooks and actions
     * within our plugin.
     */
    public function __construct()
    {
        $this->define_constants();
        add_action('plugins_loaded', [$this, 'init_classes']);
        add_action('init', [$this, 'i18n']);
    }

    /**
     * Define the constants
     *
     * @return void
     */
    public function define_constants()
    {
        define('GENERIC_ELEMENTS_VERSION', $this->version);
        define('GENERIC_ELEMENTS_FILE', __FILE__);
        define('GENERIC_ELEMENTS_PATH', __DIR__);
        define('GENERIC_ELEMENTS_INCLUDES', GENERIC_ELEMENTS_PATH . '/includes');
        define('GENERIC_ELEMENTS_TEMPLATES', GENERIC_ELEMENTS_PATH . '/admin/templates');
        define('GENERIC_ELEMENTS_URL', plugins_url('', GENERIC_ELEMENTS_FILE));
        define('GENERIC_ELEMENTS_ASSETS', GENERIC_ELEMENTS_URL . '/assets');
        define('GENERIC_ELEMENTS_ADMIN_ASSETS', GENERIC_ELEMENTS_URL . '/admin/assets');
        define('GENERIC_ELEMENTS_MINIMUM_ELEMENTOR_VERSION', '2.0.0');
        define('GENERIC_ELEMENTS_MINIMUM_PHP_VERSION', '5.5');
    }

    /**
     * Instantiate the required classes
     *
     * @return void
     */
    public function init_classes()
    {
        require_once GENERIC_ELEMENTS_PATH . '/includes/HelperFunction.php';

        require_once GENERIC_ELEMENTS_PATH . '/admin/classes/Admin.php';
        require_once GENERIC_ELEMENTS_PATH . '/admin/classes/AdminMetabox.php';
        require_once GENERIC_ELEMENTS_PATH . '/admin/classes/Helper.php';
        require_once GENERIC_ELEMENTS_PATH . '/admin/classes/PostType.php';
        require_once GENERIC_ELEMENTS_PATH . '/admin/classes/MetaFields.php';

        require_once GENERIC_ELEMENTS_PATH . '/admin/classes/TemplateGenerator.php';

        require_once GENERIC_ELEMENTS_PATH . '/themes/templates/generic-el-template.php';


        $plugin_admin = new Generic\Elements\Admin($this->get_plugin_name(), $this->get_version());
        $plugin_admin->meta = new Generic\Elements\AdminMetabox();

        Generic\Elements\PostType::instance();

        $notice = new Generic\Elements\Notices();
        $notice->run();

        $reg_cat = new Generic\Elements\RegisterCategory();
        $reg_cat->run();

        $assets = new Generic\Elements\Assets;
        $assets->run();

        new Generic\Elements\TemplateGenerator();

        add_action('admin_menu', array($plugin_admin, 'generic_el_menu_page'));

        add_action('save_post_generic_el_template', array($plugin_admin->meta, 'save_metabox'));

        add_filter('generec_el_custom_post_types', array($this, 'generic_el_post_types'));

        add_action('add_meta_boxes', array($plugin_admin->meta, 'add_meta_boxes'), 10, 2);

        add_action('admin_enqueue_scripts', array($plugin_admin, 'enqueue_styles'));
        add_action('admin_enqueue_scripts', array($plugin_admin, 'enqueue_scripts'));
    }

    /**
     * Load The Textdomain
     *
     * Load plugin localization files.
     *
     * Fired by `init` action hook.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function i18n()
    {
        // Load textdomain
        load_plugin_textdomain('generic-elements', false, basename(dirname(__FILE__)) . '/languages/');
    }

    public function generic_el_post_types()
    {
        return array(
            'generic_el_template' => array('title' => 'Elementor Template', 'plural_title' => 'Elementor Templates', 'rewrite' => 'elementor-template', 'menu_icon' => 'dashicons-awards')
        );
    }

    public function get_version()
    {
        return $this->version;
    }

    public function get_plugin_name()
    {
        return $this->plugin_name;
    }

    public function get_generic_element_page_id2()
    {
        return get_the_ID();
    }

    /**
     * Initializes the Generic_Elements class
     *
     * Checks for an existing Generic_Elements() instance
     * and if it doesn't find one, creates it.
     */

    public static function init()
    {
        static $instance = false;

        if (!$instance) {
            $instance = new Generic_Elements();
        }

        return $instance;
    }
}

$generic = Generic_Elements::init();
