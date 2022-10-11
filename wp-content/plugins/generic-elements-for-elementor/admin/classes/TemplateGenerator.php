<?php

namespace Generic\Elements;

class TemplateGenerator
{

    /**
     * Location Selection Option
     *
     * @since  1.0.3
     *
     * @var $location_selection
     */
 
    /**
     * Location Selection Option
     *
     * @since  1.0.3
     *
     * @var $location_selection
     */
    private static $footer_id;

    /**
     *  Constructor
     */
    public function __construct()
    {
        self::$footer_id = self::get_footer_id();
    }


    /**
     * This function is responsible to get header templates
     * @pram $header_id
     * 
     */
    public static function get_header_template()
    {
        if (did_action('elementor/loaded')) {
            echo \Elementor\Plugin::$instance->frontend->get_builder_content(self::get_header_id());
        }
    }


    /**
     *  This Function is responsible for set the header template into the page
     *  @pram $get_header_id
     */
    public static function get_header_id()
    {
        $header_templates = array();
        $header_before_templates = array();
        $header_after_templates = array();
     
        $args = [
            'post_status' => 'publish',
            'post_type' => 'generic_el_template',
            'orderby'   => 'ID',
            'order' => 'ASC',
            'posts_per_page' => -1
        ];
        $templates = new \WP_Query($args);

        foreach ($templates->posts as $key => $template) {
            $generic_el_params = \Generic\Elements\Admin\Helper::get_generic_el_params($template->ID);

            if ($generic_el_params['_template_type'] == 'header') {
                array_push($header_templates, $template->ID);
            }

            if ($generic_el_params['_template_type'] == 'before_header') {
                array_push($header_before_templates, $template->ID);
            }

            if ($generic_el_params['_template_type'] == 'after_header') {
                array_push($header_after_templates, $template->ID);
            }
        }

        $header_id = null;

        if( !empty($header_templates) ) {
            foreach ( $header_templates as $template_id ) {

                $generic_el_params = \Generic\Elements\Admin\Helper::get_generic_el_params($template_id);
      
                if ( $generic_el_params['_is_entire_website'] == 'specific_page' && get_the_ID() == $generic_el_params['_visibility_page'] ) {
                    $header_id = $template_id;
                    break;
                }
                else if ( $generic_el_params['_is_entire_website'] == 'entire_site' ) {
                    
                    $header_id = $template_id; 
                } 
            } 

        }

        if($header_id)
            return apply_filters ( 'generic_el_header_id', $header_id );
        else
            return null;
    }



    /**
     * This function is responsible to get breadcrumb templates
     * @pram $breadcrumb_id
     * 
     */
    public static function get_breadcrumb_template()
    {
        if (did_action('elementor/loaded')) {
            echo \Elementor\Plugin::$instance->frontend->get_builder_content(self::get_breadcrumb_id());
        }
    }


    /**
     *  This Function is responsible for set the breadcrumb template into the page
     *  @pram $get_breadcrumb_id
     */
    public static function get_breadcrumb_id()
    {
        $breadcrumb_templates = array();

        $args = [
            'post_status' => 'publish',
            'post_type' => 'generic_el_template',
            'orderby'   => 'ID',
            'order' => 'ASC',
            'posts_per_page' => -1
        ];
        $templates = new \WP_Query($args);

        foreach ($templates->posts as $key => $template) {
            $generic_el_params = \Generic\Elements\Admin\Helper::get_generic_el_params($template->ID);

            if ($generic_el_params['_template_type'] == 'breadcrumb') {
                array_push($breadcrumb_templates, $template->ID);
            }
        }

        $breadcrumb_id = null;

        if( !empty($breadcrumb_templates) ) {
            foreach ( $breadcrumb_templates as $template_id ) {

                $generic_el_params = \Generic\Elements\Admin\Helper::get_generic_el_params($template_id);
      
                if ( $generic_el_params['_is_entire_website'] == 'specific_page' && get_the_ID() == $generic_el_params['_visibility_page'] ) {
                    $breadcrumb_id = $template_id;
                    break;
                }
                else if ( $generic_el_params['_is_entire_website'] == 'entire_site' ) {
                    $breadcrumb_id = $template_id; 
                } 
            } 
        }

        if($breadcrumb_id)
            return apply_filters ( 'generic_el_breadcrumb_id', $breadcrumb_id );
        else
            return null;
    }





    /**
     * 
     * This function is responsible to get the footer templates
     * @pram $footer_id
     * 
     */

    public static function get_footer_template()
    {
        if (did_action('elementor/loaded')) {
            echo \Elementor\Plugin::$instance->frontend->get_builder_content(self::get_footer_id());
        }
    }


    /**
     *  This Function is responsible for set the footer template into the page
     *  @pram $get_footer_id
     */
    public static function get_footer_id()
    {
        $footer_templates = array();
        $footer_before_templates = array();

        $args = [
            'post_status' => 'publish',
            'post_type' => 'generic_el_template',
            'orderby'   => 'ID',
            'order' => 'ASC',
            'posts_per_page' => -1
        ];
        $templates = new \WP_Query($args);

        foreach ($templates->posts as $key => $template) {
            $generic_el_params = \Generic\Elements\Admin\Helper::get_generic_el_params($template->ID);

            if ($generic_el_params['_template_type'] == 'footer') {
                array_push($footer_templates, $template->ID);
            }

            if ($generic_el_params['_template_type'] == 'footer_header') {
                array_push($header_before_templates, $template->ID);
            }

            if ($generic_el_params['_template_type'] == 'after_footer') {
                array_push($header_after_templates, $template->ID);
            }
        }

        $footer_id = null;

        if( !empty($footer_templates) ) {
            foreach ( $footer_templates as $template_id ) {

                $generic_el_params = \Generic\Elements\Admin\Helper::get_generic_el_params($template_id);
      
                if ( $generic_el_params['_is_entire_website'] == 'specific_page' && get_the_ID() == $generic_el_params['_visibility_page'] ) {
                    $footer_id = $template_id;
                    break;
                }
                else if ( $generic_el_params['_is_entire_website'] == 'entire_site' ) {
                    $footer_id = $template_id; 
                } 
            } 
        }

        if($footer_id)
            return apply_filters ( 'generic_el_footer_id', $footer_id );
        else
            return null;
    }



}
