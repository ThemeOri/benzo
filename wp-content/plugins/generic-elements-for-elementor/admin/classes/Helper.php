<?php

namespace Generic\Elements\Admin;

class Helper
{

    /**
     * Get the generic elements parameters of post_id
     * 
     * @parm $post_id
     * 
    */
    public static function get_generic_el_params($post_id)
    {

        $generic_el_params = get_post_meta($post_id, 'generic_el_params', TRUE);

        $generic_el_params = unserialize($generic_el_params);

        if (!empty($generic_el_params))
            return $generic_el_params;
        else
            return [];
    }



    /**
     * Save the generic elements parameters fo post_id and fields
     * 
     * @parm $post_id
     * @parm $fields
     * 
    */
    public  static function save_generic_el_params($post_id, $fields)
    {

        if (!empty($fields)) {
            update_post_meta($post_id, 'generic_el_params', serialize($fields));
        }
    }


    /**
     * This is data sanitizations function and it's responsible for sanitize the data.
     * 
     * @param array $field
     * @param string|array $value
     * @return string|array
     */
    public static function sanitize_field($field, $value)
    {
        if (isset($field['sanitize']) && !empty($field['sanitize'])) {
            if (function_exists($field['sanitize'])) {
                $value = call_user_func($field['sanitize'], $value);
            }
            return $value;
        }

        if (is_array($field) && isset($field['type'])) {
            switch ($field['type']) {
                case 'text':
                    $value = sanitize_text_field($value);
                    break;
                case 'textarea':
                    $value = sanitize_textarea_field($value);
                    break;
                case 'email':
                    $value = sanitize_email($value);
                    break;
                default:
                    return $value;
                    break;
            }
        } else {
            $value = sanitize_text_field($value);
        }

        return $value;
    }

    /**
     * This function is responsible for making an array sort by their key
     * @param array $data
     * @param string $using
     * @param string $way
     * @return array
     */
    public static function sorter($data, $using = 'time_date',  $way = 'DESC')
    {
        if (!is_array($data)) {
            return $data;
        }
        $new_array = [];
        if ($using === 'key') {
            if ($way !== 'ASC') {
                krsort($data);
            } else {
                ksort($data);
            }
        } else {
            foreach ($data as $key => $value) {
                if (!is_array($value)) continue;
                foreach ($value as $inner_key => $single) {
                    if ($inner_key == $using) {
                        $value['tempid'] = $key;
                        $single = self::numeric_key_gen($new_array, $single);
                        $new_array[$single] = $value;
                    }
                }
            }

            if ($way !== 'ASC') {
                krsort($new_array);
            } else {
                ksort($new_array);
            }

            if (!empty($new_array)) {
                foreach ($new_array as $array) {
                    $index = $array['tempid'];
                    unset($array['tempid']);
                    $new_data[$index] = $array;
                }
                $data = $new_data;
            }
        }

        return $data;
    }

    /**
     * 
     * The numeric key gen function is generate unique numeric key of a given array.
     *
     * @param array $data
     * @param integer $index
     * @return integer
     */

    private static function numeric_key_gen($data, $index = 0)
    {
        if (isset($data[$index])) {
            $index += 1;
            return self::numeric_key_gen($data, $index);
        }
        return $index;
    }


    /**
     * Get all post types
     *
     * @param array $exclude
     * @return void
     */
    public static function post_types($exclude = array())
    {
        $post_types = get_post_types(array(
            'public'    => true,
            'show_ui'   => true
        ), 'objects');

        unset($post_types['attachment']);

        if (count($exclude)) {
            foreach ($exclude as $type) {
                if (isset($post_types[$type])) {
                    unset($post_types[$type]);
                }
            }
        }

        return apply_filters('generic_el_post_types', $post_types);
    }

    /**
     * Get all taxonomies
     *
     * @param string $post_type
     * @param array $exclude
     * @return void
     */
    public static function taxonomies($post_type = '', $exclude = array())
    {
        if (empty($post_type)) {
            $taxonomies = get_taxonomies(
                array(
                    'public'       => true,
                    '_builtin'     => false
                ),
                'objects'
            );
        } else {
            $taxonomies = get_object_taxonomies($post_type, 'objects');
        }

        $data = array();
        if (is_array($taxonomies)) {
            foreach ($taxonomies as $tax_slug => $tax) {
                if (!$tax->public || !$tax->show_ui) {
                    continue;
                }
                if (in_array($tax_slug, $exclude)) {
                    continue;
                }
                $data[$tax_slug] = $tax;
            }
        }
        return apply_filters('generic_el_loop_taxonomies', $data, $taxonomies, $post_type);
    }
}
