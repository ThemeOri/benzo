<?php

namespace Generic\Elements;

class Admin
{
    private $plugin_name;
    private $version;
    public $type = 'generic_el_template';
    public $metabox;
    public static $prefix = 'generic_el_meta_';
    public static $settings;
    public static $counts;
    public static $enabled_types = [];
    public static $active_items = [];


    /**
     *  Constructor
     */
    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }


    /**
    * Display the Generic Elements dashboard Menu list
    */
    public function generic_el_menu_page()
    {
        add_menu_page('Generic Elements', 'Generic Elements', 'administrator', 'generic-elements-admin', array($this, 'generic_el_page'), 'dashicons-tickets', 6);
        add_submenu_page('generic-elements-admin', 'All Generic Elements', 'Eeneric Elements', 'manage_options', 'generic-elements-admin');
        add_submenu_page('generic-elements-admin', __('Add New', 'generic-elements'), __('Add New', 'generic-elements'), 'manage_options', 'post-new.php?post_type=generic_el_template');
        add_submenu_page('generic-elements-admin', __('Add Generic Elements', 'generic-elements'), __('Add Generic Elements', 'generic-elements'), 'manage_options', 'post-new.php?post_type=generic_el_template'); 
    }


    /*
    *  Function for Generic Elements template post count 
    */
    public static function count_posts($type = 'generic_el_template', $perm = '')
    {
        global $wpdb;
        if (!post_type_exists($type)) {
            return;
        }

        $cache_key = 'generic_el_counts_cache';
        self::$counts = wp_cache_get($cache_key, 'counts');
        if (false !== self::$counts) {
            return self::$counts;
        }

        $query = "SELECT ID, post_status, meta_key, meta_value FROM {$wpdb->posts} INNER JOIN {$wpdb->postmeta} ON ID = post_id WHERE post_type = %s AND meta_key = '_generic_el_meta_active_check'";
        $results = (array) $wpdb->get_results($wpdb->prepare($query, $type), ARRAY_A);
        $counts  = array_fill_keys(array('enabled', 'disabled', 'trash', 'publish'), 0);
        $disable = 0;
        $enable = 0;
        foreach ($results as $row) {
            $counts['publish'] = $counts['publish'] + ($row['post_status'] === 'publish' ? 1 : 0);
            $counts['trash'] = $counts['trash'] + ($row['post_status'] === 'trash' ? 1 : 0);

            if ($row['meta_value'] == 0) {
                $disable = 1;
                $enable = 0;
            }
            if ($row['meta_value'] == 1) {
                $disable = 0;
                $enable = 1;
            }

            if ($disable == 1 && $row['post_status'] == 'trash') {
                $disable = 0;
            }

            if ($enable == 1 && $row['post_status'] == 'trash') {
                $enable = 0;
            }

            $counts['disabled'] = $counts['disabled'] + $disable;
            $counts['enabled'] = $counts['enabled'] + $enable;
        }

        self::$counts = (object) $counts;
        wp_cache_set($cache_key, self::$counts, 'counts');
        return self::$counts;
    }



    /*
    * Generic Elements page status
    */

    public function generic_el_page()
    {
        $all_active_class = '';
        $enabled_active_class = '';
        $disabled_active_class = '';
        $trash_active_class = '';
        $pagenow = '';
        $paged = 1;
        $count_posts = self::count_posts();
        $screen = get_current_screen();

        $user = get_current_user_id();
        $option = $screen->get_option('per_page', 'option');
        //$per_page = get_user_meta($user, $option, true);
        $per_page = empty($per_page) ? 10 : $per_page;
        $total_page = 1;
        $pagination_current_url = admin_url('admin.php?page=generic-elements-admin');

        $post_args = array(
            'post_type' => 'generic_el_template',
            'numberposts' => -1,
            'posts_per_page' => $per_page,
        );

        if (isset($_GET['page']) && $_GET['page'] == 'generic-elements-admin') {
            $all_active_class = 'class="active"';
            $pagenow = 'publish, draft';
            if (isset($_GET['status']) && $_GET['status'] == 'enabled') {
                $pagination_current_url = add_query_arg('status', 'enabled', $pagination_current_url);
                $enabled_active_class   = 'class="active"';
                $all_active_class       = '';
                $pagenow                = 'publish';
                $total_page  = ceil($count_posts->enabled / $per_page);
            }
            if (isset($_GET['status']) && $_GET['status'] == 'disabled') {
                $pagination_current_url = add_query_arg('status', 'disabled', $pagination_current_url);
                $disabled_active_class  = 'class="active"';
                $all_active_class       = '';
                $pagenow                = 'publish';
                $total_page  = ceil($count_posts->disabled / $per_page);
            }
            if (isset($_GET['status']) && $_GET['status'] == 'trash') {
                $pagination_current_url = add_query_arg('status', 'trash', $pagination_current_url);
                $trash_active_class     = 'class="active"';
                $all_active_class       = '';
                $pagenow                = 'trash';
                $total_page  = ceil($count_posts->trash / $per_page);
            }
            if (isset($_GET['paged'])) {
                if (intval($_GET['paged']) > 0) {
                    $paged = intval($_GET['paged']);
                }
            }
        }

        $generic_el_posts = get_posts($post_args);

        $table_header = apply_filters('generic_elements_admin_table_header', array(
            'Title',
            __('Preview', 'generic-elements'),
            __('Status', 'generic-elements'),
            __('Type', 'generic-elements'),
            __('Stats', 'generic-elements'),
            __('Date', 'generic-elements'),
        ));
        include_once GENERIC_ELEMENTS_TEMPLATES . '/admin.php';
    }



    /**
    * Get the post meta
    *
    * @parm $post_id
    * @parm $key
    * @parm $single
    * 
    */
    public static function get_post_meta($post_id, $key, $single = true)
    {
        return get_post_meta($post_id, '_generic_el_meta_' . $key, $single);
    }

    /*
    * Update the post meta
    * @parm $post_id
    * @parm $key
    * @parm $value
    */
    public static function update_post_meta($post_id, $key, $value)
    {
        update_post_meta($post_id, '_generic_el_meta_' . $key, $value);
    }

    /**
    * Admin initializations
    * @parm $hook
    */
    public function admin_init($hook)
    {
        /**
         * Get the current admin url
         */
        $current_url = admin_url('admin.php?page=generic-elements-admin');


        /**
         * For Empty Trash
         */
        $this->empty_trash($current_url);
        /**
         * For Enable And Disable
         */
        $this->enable_disable($current_url);
    }


    /*
    * Display the header content
    */
    public static function get_header_content()
    {
        echo self::$elementor_instance->frontend->get_builder_content_for_display(get_generic_el_header_id());
    }


    /*
    * Display the footer content
    */
    public static function get_footer_content()
    {
        echo self::$elementor_instance->frontend->get_builder_content_for_display(get_generic_el_footer_id());
    }




    /**
     *
     * The stylesheets enqueue for the admin area
     *
     * @since    1.0.3
     */
    public function enqueue_styles($hook)
    {
        global $post_type;
        $page_status = false;
        wp_enqueue_style(
            $this->plugin_name . '-admin-global',
            GENERIC_ELEMENTS_ADMIN_ASSETS . '/css/generic-admin-global.min.css',
            array(),
            $this->version,
            'all'
        );

        wp_enqueue_style('wp-color-picker');
        wp_enqueue_style(
            $this->plugin_name . '-select2',
            GENERIC_ELEMENTS_ADMIN_ASSETS . '/css/select2.min.css',
            array(),
            $this->version,
            'all'
        );
        wp_enqueue_style(
            $this->plugin_name . '-flatfickr',
            GENERIC_ELEMENTS_ADMIN_ASSETS . '/css/flatfickr.min.css',
            array(),
            $this->version,
            'all'
        );
        wp_enqueue_style(
            $this->plugin_name,
            GENERIC_ELEMENTS_ADMIN_ASSETS . '/css/generic-admin.min.css',
            array(),
            $this->version,
            'all'
        );
        wp_enqueue_style(
            $this->plugin_name . '-tab',
            GENERIC_ELEMENTS_ADMIN_ASSETS . '/css/tab.css',
            array(),
            $this->version,
            'all'
        );
        wp_enqueue_style(
            $this->plugin_name . '-grid',
            GENERIC_ELEMENTS_ADMIN_ASSETS . '/css/grid.min.css',
            array(),
            $this->version,
            'all'
        );
        wp_enqueue_style(
            $this->plugin_name . '-semantic',
            GENERIC_ELEMENTS_ADMIN_ASSETS . '/css/semantic.min.css',
            array(),
            $this->version,
            'all'
        );
    }
    /**
     * 
     * The javascript file enqueue for the admin area.
     *
     * @since    1.0.3
     */
    public function enqueue_scripts($hook)
    {
        global $post_type;
        $page_status = false;

        if ($hook == 'Generic Elementsx_page_generic-elements-builder' || $hook == 'Generic Elementsx_page_generic-elements-settings' || $hook === 'toplevel_page_generic-el-admin') {
            $page_status = true;
        }

        if ('generic-elements' == get_post_type()) {
            wp_dequeue_script('autosave');
        }

        wp_enqueue_script('wp-color-picker');
        wp_enqueue_script('jquery-ui-datepicker');
        wp_enqueue_media();
        wp_enqueue_script(
            $this->plugin_name . '-sweetalert',
            GENERIC_ELEMENTS_ADMIN_ASSETS . '/js/sweetalert.min.js',
            array('jquery'),
            $this->version,
            true
        );
        wp_enqueue_script(
            $this->plugin_name . '-select2',
            GENERIC_ELEMENTS_ADMIN_ASSETS . '/js/select2.min.js',
            array('jquery'),
            $this->version,
            true
        );
        wp_enqueue_script(
            $this->plugin_name . '-flatfickr',
            GENERIC_ELEMENTS_ADMIN_ASSETS . '/js/flatfickr.min.js',
            array('jquery'),
            $this->version,
            true
        );
        wp_enqueue_script(
            $this->plugin_name,
            GENERIC_ELEMENTS_ADMIN_ASSETS . '/js/generic-admin.js',
            array('jquery'),
            $this->version,
            true
        );
        wp_enqueue_script(
            $this->plugin_name . '-tabs',
            GENERIC_ELEMENTS_ADMIN_ASSETS . '/js/tab.js',
            array('jquery'),
            $this->version,
            true
        );
        wp_enqueue_script(
            $this->plugin_name . '-semantic-min',
            GENERIC_ELEMENTS_ADMIN_ASSETS . '/js/semantic.min.js',
            array('jquery'),
            $this->version,
            true
        );
    }
}
