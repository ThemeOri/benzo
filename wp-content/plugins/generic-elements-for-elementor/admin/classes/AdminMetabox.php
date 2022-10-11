<?php

namespace Generic\Elements;

use stdClass;

class AdminMetabox
{

    public static $type = 'generic_el_template';
    public static $_meta_info;
    public static $_meta_fields;
    public static $prefix = 'generic_el_params';
    public static $post_id;
    public static $params;

    /**
     * User Selection Option
     *
     * @since  1.0.3
     *
     * @var $user_selection
     */
    private static $user_selection;

    /**
     * Location Selection Option
     *
     * @since  1.0.3
     *
     * @var $location_selection
     */
    private static $location_selection;

    public function __construct()
    {
        add_action('admin_init', array($this, 'initialize_options'));
    }

    public static function init_metabox()
    {
        return array(
            'id' => 'generic_el_metabox_wrap',
            'title' => __('Elementor Theme Builder Settings', 'generic-elements'),
            'screen' => array('generic_el_template'),
            'context' => 'normal',
            'priority' => 'high'
        );
    }

    /**
     * The initialize of member variables.
     *
     * @return void
     */
    public function initialize_options()
    {
        self::$location_selection = self::get_posts_types();


        self::$_meta_info = self::init_metabox();
        self::$_meta_fields = self::generic_el_metabox_fields();
    }


    /**
     * 
     * Display Generic Elements metabox fields in a array
     * 
    */
    public static function generic_el_metabox_fields()
    {

        return  array(
            'template' => array(
                'title' => __('Template', 'generic-elements'),
                'icon' => 'magic-wand.svg',
                'fields' => array(
                    'generic_el_type_header' => array(
                        'type' => 'radio',
                        'id' => 'template_type',
                        'title' => __('Header', 'generic-elements'),
                        'image' => GENERIC_ELEMENTS_ASSETS . '/admin/img/themes/generic-el-subs-theme-1.jpg',
                        'description'    => __('Set your location here.'),
                        'value' => 'header',
                        'priority' => 0
                    ),
                    'generic_el_type_before_header' => array(
                        'type' => 'radio',
                        'id' => 'template_type',
                        'title' => __('Before Header', 'generic-elements'),
                        'image' => GENERIC_ELEMENTS_ASSETS . '/admin/img/themes/generic-el-subs-theme-1.jpg',
                        'description'    => __('Set your location here.'),
                        'value' => 'before_header',
                        'priority' => 0
                    ),
                    'generic_el_type_after_header' => array(
                        'type' => 'radio',
                        'id' => 'template_type',
                        'title' => __('After Header', 'generic-elements'),
                        'image' => GENERIC_ELEMENTS_ASSETS . '/admin/img/themes/generic-el-subs-theme-1.jpg',
                        'description'    => __('Set your location here.'),
                        'value' => 'after_header',
                        'priority' => 0
                    ),
                    'generic_el_type_breadcrumb' => array(
                        'type' => 'radio',
                        'id' => 'template_type',
                        'title' => __('Breadcrumb', 'generic-elements'),
                        'image' => GENERIC_ELEMENTS_ASSETS . '/admin/img/themes/generic-el-subs-theme-1.jpg',
                        'description'    => __('Set your location here.'),
                        'value' => 'breadcrumb',
                        'priority' => 0
                    ),
                    'generic_el_type_footer' => array(
                        'type' => 'radio',
                        'id' => 'template_type',
                        'title' => __('Footer', 'generic-elements'),
                        'image' => GENERIC_ELEMENTS_ASSETS . '/admin/img/themes/generic-el-subs-theme-1.jpg',
                        'description'    => __('Set your location here.'),
                        'value' => 'footer',
                        'priority' => 0
                    ),                    
                    'generic_el_type_custom_block' => array(
                        'type' => 'radio',
                        'id' => 'template_type',
                        'title' => __('Custom Block', 'generic-elements'),
                        'image' => GENERIC_ELEMENTS_ASSETS . '/admin/img/themes/generic-el-subs-theme-1.jpg',
                        'description'    => __('Set your location here.'),
                        'value' => 'custom_block',
                        'priority' => 0
                    )

                )
            ),
            'canvas_template' => array(
                'title' => __('Canvas Template', 'generic-elements'),
                'icon' => 'magic-wand.svg',
                'fields' => array(
                    'enable_generic_el_canvas' => array(
                        'type' => 'radio',
                        'id' => 'canvas_template_enable',
                        'title' => __('Enable Canvas Template', 'generic-elements'),
                        'image' => GENERIC_ELEMENTS_ASSETS . '/admin/img/themes/generic-el-subs-theme-1.jpg',
                        'description'    => __('Set your location here.'),
                        'value' => 'enable_canvas_template',
                        'priority' => 0
                    )
                )
            ),

            'visibility' => array(
                'title' => __('Visibility', 'generic-elements'),
                'icon' => 'database.svg',
                'fields' => self::get_visibility_fields(),
                'value' => 'visibility'
            ),

            'live_support' => array(
                'title' => __('Live Support', 'generic-elements'),
                'icon' => 'database.svg',
                'fields' => array(
                    'message' => array(
                        'type'     => 'message',
                        'title' => 'Sub Title',
                        'description'    => __('Set your location here.'),
                        'priority' => 0,
                    )
                )
            )
        );
    }


    /**
     * 
     * Function for add the meta boxes
     * 
    */
    public function add_meta_boxes()
    {
        add_meta_box(self::$_meta_info['id'], self::$_meta_info['title'], __CLASS__ . '::render_metabox', self::$_meta_info['screen'], self::$_meta_info['context'], self::$_meta_info['priority']);
    }

    /**
     * Function for the renders the meta box.
     * @pram $post
     */
    public static function render_metabox($post = null)
    {
        self::$post_id = $post->ID;
        $prefix     = self::$prefix;
        $metabox_id = self::$_meta_info['id'];

        wp_nonce_field($metabox_id, $metabox_id . '_nonce');
        include_once GENERIC_ELEMENTS_TEMPLATES . '/render-metabox.php';
    }


    /**
     * 
     * This function is responsible for Save Metabox data
     * @pram $post_id
     * 
    */
    public static function save_metabox($post_id)
    {

        $metabox_id     = self::$_meta_info['id'];
        $object_types   = self::$_meta_info['screen'];

        // Verify the nonce.
        if (!isset($_POST[$metabox_id . '_nonce']) || !wp_verify_nonce($_POST[$metabox_id . '_nonce'], $metabox_id)) {
            return $post_id;
        }

        // Verify if this is an auto save routine.
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }

        // Check permissions to edit pages and/or posts
        if (in_array($_POST['post_type'], $object_types)) {
            if (!current_user_can('edit_page', $post_id) || !current_user_can('edit_post', $post_id)) {
                return $post_id;
            }
        }
        /**
         * Save all meta!
         */

        self::save_data($_POST, $post_id);
        do_action('generic_el_save_post');
        if (isset($_POST['_generic_el_elementor_auto_redirect']) && $_POST['_generic_el_elementor_auto_redirect'] == 'on') {
            $post_meta = get_post_meta($post_id, '_generic_el_bar_elementor_type_id', true);
            if (is_numeric($post_meta) && class_exists('\Elementor\Plugin')) {
                $documents = \Elementor\Plugin::$instance->documents->get($post_meta);
                if ($documents) {
                    $edit_with_elementor = $documents->get_edit_url();
                    $redirected = wp_safe_redirect($edit_with_elementor);
                    if ($redirected) {
                        exit;
                    }
                }
            }
        }
    }


    /**
     * 
     * Save the post data
     * @pram $posts
     * @pram $post_id
     * 
    */
    public static function save_data($posts, $post_id)
    {
        $prefix       = self::$prefix;
        $meta_fields  = self::generic_el_metabox_fields();
        $old_settings = self::get_metabox_settings($post_id);
        $fields      = [];

        foreach ($meta_fields as $name => $m_fields) {

            foreach ($m_fields['fields'] as $field) {

                $field_id = !empty($field['id']) ? $field['id'] : '';
                $value = '0';

                if (isset($posts[$prefix][$field_id])) {
                    $value = \Generic\Elements\Admin\Helper::sanitize_field($field, $posts[$prefix][$field_id]);
                }

                $fields["_{$field_id}"] = $value;
            }
        }

        \Generic\Elements\Admin\Helper::save_generic_el_params($post_id, $fields);
    }



    /**
     * Display all the meta settings
     *
     * @param int $id
     * @return stdClass object
     */
    public static function get_metabox_settings($id)
    {
        $fields     = self::generic_el_metabox_fields();
        $field_id     = self::$prefix;
        $settings   = new stdClass();

        if (empty($id)) {
            return;
        }

        foreach ($fields as $name => $field) {

            $default    = isset($field['default']) ? $field['default'] : '';

            if (isset($field['type']) && $field['type'] == 'template') {
                $default    = isset($field['defaults']) ? $field['defaults'] : [];
                if (strrpos($name, 'template_new') >= 0 && metadata_exists('post', $id, "_{$field_id}_string")) {
                    $value  = get_post_meta($id, "_{$field_id}_string", true);
                    $settings->{"{$name}_string"} = $value;
                } else {
                    $value  = get_post_meta($id, "_{$field_id}", true);
                    $settings->{"{$name}"} = $value;
                }
            } else {
                if (metadata_exists('post', $id, "_{$field_id}")) {
                    $value  = get_post_meta($id, "_{$field_id}", true);
                } else {
                    $value  = $default;
                }
            }

            $settings->{$name} = $value;
        }

        $settings->active_check = boolval(get_post_meta($id, "_generic_el_meta_active_check", true));


        $settings->id = $id;

        return $settings;
    }


    /**
     * Get the visibility fields
     */

    public static function get_visibility_fields()
    {
        $fields = array(
            'visibility_pages_on' => array(
                'type' => 'radio',
                'id' => 'is_entire_website',
                'title' => __('Entire Website', 'generic-elements'),
                'image' => GENERIC_ELEMENTS_ASSETS . '/img/themes/generic-el-subs-theme-1.jpg',
                'description'    => __('Set your location here.'),
                'value' => 'entire_site',
                'priority' => 0
            ),
            'visibility_pages_2_on' => array(
                'type' => 'radio',
                'id' => 'is_entire_website',
                'title' => __('Specific pages', 'generic-elements'),
                'image' => GENERIC_ELEMENTS_ASSETS . '/img/themes/generic-el-subs-theme-1.jpg',
                'description'    => __('Set your location here.'),
                'value' => 'specific_page',
                'priority' => 0
            )
        );

        foreach (self::$location_selection as $type) {

            $fields['on_' . $type->name] = array(
                'type' => 'select',
                'id' => 'visibility_' . $type->name,
                'title' => __('Select ' . ucwords($type->name), 'generic-elements'),
                'description'    => __('Set '. ucwords($type->name)),
                'name' => $type->label,
                'options' => self::get_all_posts($type->name),
                'priority' => 0
            );
        }

        return $fields;
    }


    /**
     * Get the posts types
     */

    public static function get_posts_types()
    {
        $custom_post_types = [
            'product' => (object)[
                'name' => 'product',
                'label' => 'Products'
            ]
        ];

        $args = array(
            'public'   => true,
            '_builtin' => true
        );

        $post_types = get_post_types($args, 'objects');
        unset($post_types['attachment']);


        return apply_filters('generic_el_modifying_post_types', array_merge($post_types, $custom_post_types));
    }

    /**
     * Get all the posts
     */
    public static function get_all_posts($type = 'post')
    {

        $args = array(
            'numberposts'   => -1,
            'post_type' => $type
        );

        $posts = get_posts($args);


        return apply_filters('generic_el_modifying_posts', $posts);
    }
}
