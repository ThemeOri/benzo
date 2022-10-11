<?php

namespace Generic\Elements;

class PostType
{

    protected static $instance = null;
    private $post_types = array();
    private $slug;

    /**
     *  Constructor
     */
    private function __construct()
    {
        $this->slug = 'generic-el-template';
        add_action('init', array($this, 'register_custom_post_types'));

        add_filter('single_template', [$this, 'get_custom_pt_single_template']);
    }


    /**
     *  Instance
     */
    public static function instance()
    {
        if (null == self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     *
     * This function is responsibel for Add post types
     * @pram $post_types
     *
     */
    public function add_post_types($post_types)
    {

        foreach ($post_types as $post_type => $args) {

            $title = $args['title'];
            $plural_title = empty($args['plural_title']) ? $title : $args['plural_title'];

            if (!empty($args['rewrite'])) {
                $args['rewrite'] = array('slug' => $args['rewrite']);
            }

            $labels      = array(
                'name'                     => $plural_title,
                'singular_name'            => $title,
                'add_new'                  => esc_html__('Add New', 'generic-elements'),
                'add_new_item'             => sprintf(esc_html__('Add New %s', 'generic-elements'), $title),
                'edit_item'                => sprintf(esc_html__('Edit %s', 'generic-elements'), $title),
                'new_item'                 => sprintf(esc_html__('New %s', 'generic-elements'), $title),
                'view_item'                => sprintf(esc_html__('View %s', 'generic-elements'), $title),
                'view_items'               => sprintf(esc_html__('View %s', 'generic-elements'), $plural_title),
                'search_items'             => sprintf(esc_html__('Search %s', 'generic-elements'), $plural_title),
                'not_found'                => sprintf(esc_html__('%s not found', 'generic-elements'), $plural_title),
                'not_found_in_trash'       => sprintf(esc_html__('%s found in Trash', 'generic-elements'), $plural_title),
                'menu_name'                => $plural_title
            );

            if (!empty($args['labels_override'])) {
                $labels = wp_parse_args($args['labels_override'], $labels);
            }

            $defaults = array(
                'labels'              => $labels,
                'public'              => true,
                'taxonomies'          => array(''),
                'public'              => true,
                'publicly_queryable'  => true,
                'show_ui'             => true,
                'show_in_menu'        => true,
                'show_in_nav_menus'   => false,
                'show_in_admin_bar'   => true,
                'query_var'           => true,
                'has_archive'         => true,
                'hierarchical'        => true,
                'menu_position'       => 10,
                'menu_icon'           => 'dashicons-admin-page',
                'exclude_from_search' => true,
                'can_export'          => true,
                'rewrite' => ['slug' => $this->slug],
                'capability_type'     => 'post',
                'supports'            => array('title', 'editor', 'thumbnail', 'page-attributes')
            );


            $args = wp_parse_args($args, $defaults);
            $this->post_types[$post_type] = $args;
            register_post_type($post_type, $args);
        }
    }


    /**
     * This is function is responsible for the register custom post types
     * @pram $post_types
     */
    public function register_custom_post_types()
    {
        $post_types = apply_filters('generec_el_custom_post_types', $this->post_types);
        $this->add_post_types($post_types);
    }


    /**
     * This is the function for open header wrapper
     */
    public function wrapper_header_open()
    {
        global $post;

        if ($post->post_type == 'generic_el_template') {
            echo "<header class='generic-elements-header-wrap'>";
            echo "<div class='generic-el-site-header'>";
            echo "<div class='container-wrapper'>";
        }
    }


    /**
     * This is the function for close the header wrapper
     */
    public function wrapper_header_close()
    {
        global $post;

        if ($post->post_type == 'generic_el_template') {
            echo '</div>';
            echo '</div>';
            echo '</header>';
        }
    }


    /**
     * This function is responsible for open the footer wrapper
     */
    public function wrapper_footer_open()
    {
        global $post;

        if ($post->post_type == 'generic_el_template') {
            echo "<footer class='generic-elements-footer-wrap'>";
            echo "<div class='generic-el-site-footer'>";
            echo "<div class='container-wrapper'>";
        }
    }

    /**
     * This function if responsible for close the footer wrapper
     */
    public function wrapper_footer_close()
    {
        global $post;

        if ($post->post_type == 'generic_el_template') {
            echo '</div>';
            echo '</div>';
            echo '</footer>';
        }
    }


    /**
     *
     * Get the custom post type single template
     * @pram $single_template
     *
     */

    function get_custom_pt_single_template($single_template)
    {
        global $post;
        $generic_el_params = \Generic\Elements\Admin\Helper::get_generic_el_params(get_the_ID());

        if ($post->post_type == 'generic_el_template' && $generic_el_params['_template_type'] == 'header') {

            if (defined('ELEMENTOR_PATH')) {
                $elementor_template = ELEMENTOR_PATH . '/modules/page-templates/templates/canvas.php';

                if (file_exists($elementor_template)) {
                    add_action('elementor/page_templates/canvas/before_content', [$this, 'wrapper_header_open']);
                    add_action('elementor/page_templates/canvas/after_content', [$this, 'wrapper_header_close']);
                    return $elementor_template;
                }
            }

            if (file_exists(get_template_directory() . '/single-generic_el_template.php')) return $single_template;

            $single_template = GENERIC_ELEMENTS_TEMPLATES . '/single-generic_el_template.php';
        }


        if ($post->post_type == 'generic_el_template' && $generic_el_params['_template_type'] == 'footer') {

            if (defined('ELEMENTOR_PATH')) {
                $elementor_template = ELEMENTOR_PATH . '/modules/page-templates/templates/canvas.php';

                if (file_exists($elementor_template)) {
                    add_action('elementor/page_templates/canvas/before_content', [$this, 'wrapper_footer_open']);
                    add_action('elementor/page_templates/canvas/after_content', [$this, 'wrapper_footer_close']);
                    return $elementor_template;
                }
            }

            if (file_exists(get_template_directory() . '/single-generic_el_template.php')) return $single_template;

            $single_template = GENERIC_ELEMENTS_TEMPLATES . '/single-generic_el_template.php';
        }




        return $single_template;
    }
}
