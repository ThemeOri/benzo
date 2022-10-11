<?php

namespace Generic\Elements;

class MetaFields
{
    protected $field;

    public function __construct($field)
    {
        $this->field = $field;
    }

    /**
     * Set field in meta box
     *
     * @param      $field
     * @param bool $multi
     *
     * @return string
     */
    protected static function set_field($field, $multi = false)
    {
        if ($field) {
            if ($multi) {
                return 'generic_el_params[' . $field . '][]';
            } else {
                return 'generic_el_params[' . $field . ']';
            }
        } else {
            return '';
        }
    }

    /**
     * Get Post Meta
     *
     * @param $field
     *
     * @return bool
     */
    public static function get_field($field, $default = '')
    {
        $params = get_option('generic_el_params', array());
        if (isset($params[$field]) && $field) {
            return $params[$field];
        } else {
            return $default;
        }
    }


    /**
     * This function is responsible for set checkbox meta field
     * @pram $name
     * @pram $field
     */
    public static function set_checkbox_meta_field($name, $field)
    {
        ob_start(); ?>
        <tr valign="top">
            <th scope="row">
                <label for="<?php echo self::set_field($field['id']) ?>"><?php esc_html_e($field['title'], 'generic-elements') ?></label>
            </th>
            <td>
                <div class="ui toggle checkbox">
                    <input id="<?php echo self::set_field($field['id']) ?>
        type=" checkbox" <?php checked(self::get_field($field['id']), 1) ?> tabindex="0" class="hidden" value="1" name="<?php echo self::set_field($field['id']) ?>" />
                    <label></label>
                </div>
                <p class="description"><?php esc_html_e($field['description'], 'generic-elements') ?></p>
            </td>
        </tr>
    <?php
        return ob_get_clean();
    }

    /**
     * This function is responsible for set radio meta field
     * @pram $name
     * @pram $field
     */
    public static function set_radio_meta_field($name, $field)
    {
        ob_start();

        $generic_el_params = \Generic\Elements\Admin\Helper::get_generic_el_params(get_the_ID());

        $field_val = !empty($generic_el_params) ? $generic_el_params["_{$field['id']}"] : 0;

        $f_val = !empty($field['value']) ? $field['value'] : 1;

    ?>

        <tr valign="top">
            <th scope="row">
                <label for="<?php echo self::set_field($field['id']) ?>"><?php esc_html_e($field['title'], 'generic-elements') ?></label>
            </th>
            <td>
                <div class="ui toggle checkbox">
                    <input id="<?php echo self::set_field($field['id']) ?>" type="radio" <?php echo ($field_val == $f_val) ? 'checked="checked"' : ''; ?> tabindex="0" class="hidden" value="<?php echo esc_attr($f_val); ?>" name="<?php echo self::set_field($field['id']) ?>" />
                    <label></label>
                </div>
                <p class="description"><?php esc_html_e($field['description'], 'generic-elements') ?></p>
            </td>
        </tr>
    <?php
        return ob_get_clean();
    }


    /**
     * 
     * This is the funcitn to set select meta field
     * @pram $name
     * @pram $field
     * 
     */
    public static function set_select_meta_field($name, $field)
    { 
     
        $generic_el_params = \Generic\Elements\Admin\Helper::get_generic_el_params(get_the_ID());
        $field_val = !empty($generic_el_params["_{$field['id']}"]) ? $generic_el_params["_{$field['id']}"] : 0;

    ?>
        <tr valign="top">
            <th scope="row">
                <label for="<?php echo self::set_field($field['id']) ?>"><?php esc_html_e($field['title'], 'generic-elements') ?></label>
            </th>
            <td>
                <select id="<?php echo self::set_field($field['id']) ?>" name="<?php echo self::set_field($field['id']) ?>" class="ui fluid dropdown">
                    <option value=""><?php printf(esc_html__('Select %s', 'generic-elements'), $field['name']); ?></option>
                    <?php
                    if (!empty($field['options'])) :
                        foreach ($field['options'] as $post_key => $post_val) : ?>
                            <option <?php echo ($field_val == $post_val->ID) ? 'selected="selected"' : ''; ?> value="<?php echo esc_attr($post_val->ID); ?>"><?php echo esc_html($post_val->post_title); ?></option>
                    <?php
                        endforeach;
                    endif;
                    ?>
                    <!--  -->
                </select>

                <p class="description"><?php esc_html_e('desc here.', 'generic-elements') ?></p>
            </td>
        </tr>
    <?php
        
    }

    /**
     * Set text meta field
     * @pram $name
     * @pram $field
     */
    public static function set_text_meta_field($name, $field)
    { ?>
        <tr valign="top" class="select_product">
            <th scope="row">
                <label><?php esc_html_e($field['title'], 'generic-elements') ?></label>
            </th>
            <td>
                <div class="ui form">
                    <div class="inline fields">
                        <input type="text" name="<?php echo self::set_field($field['id']) ?>" value="<?php echo self::get_field($field['title'], '') ?>" />
                        <label><?php esc_html_e($field['title'], 'generic-elements') ?></label>
                    </div>
                </div>
                <p class="description"><?php esc_html_e($field['description'], 'generic-elements') ?></p>
            </td>
        </tr>
    <?php
    }

    /**
     * 
     * Set textarea meta field
     * @pram $name
     * @pram $field
     * 
     */
    public static function set_textarea_meta_field($name, $field)
    {
        ob_start(); ?>
        <tr valign="top" class="virtual_address">
            <th scope="row">
                <label><?php esc_html_e($field['title'], 'generic-elements') ?></label>
            </th>
            <td>
                <textarea name="<?php echo self::set_field($field['id']) ?>"><?php echo esc_attr($field['title']) ?></textarea>
                <p class="description"><?php esc_html_e($field['description'], 'generic-elements') ?></p>
            </td>
        </tr>
    <?php return ob_get_clean();
    }


    /**
     * Set message meta field
     * @pram $name
     * @pram $field
     */
    public static function set_message_meta_field($name, $field)
    {
        ob_start(); ?>
        <tr valign="top">
            <th scope="row">
                <label for="<?php echo self::set_field('Generic Elements_product_show_type') ?>"><?php esc_html_e($field['title'], 'generic-elements') ?></label>
            </th>
            <td>
                <p class="description"><?php esc_html_e($field['description'], 'generic-elements') ?></p>
            </td>
        </tr>
    <?php return ob_get_clean();
    }


    /**
     * 
     * Set the file meta fields
     * @pram $name
     * @pram $field
     * 
    */
    public static function set_file_meta_field($name, $field)
    { ?>
        <tr valign="top">
            <th scope="row">
                <label for="<?php echo self::set_field('Generic Elements_product_show_type') ?>"><?php esc_html_e('Show Generic Elements', 'generic-elements') ?></label>
            </th>
            <td>

                <select name="<?php echo self::set_field('Generic Elements_product_show_type') ?>" class="ui fluid dropdown">
                    <option <?php selected(self::get_field('Generic Elements_product_show_type', 0), '0') ?> value="0"><?php echo esc_html__('Default', 'generic-elements') ?></option>
                    <option <?php selected(self::get_field('Generic Elements_product_show_type', 0), '0') ?> value="0"><?php echo esc_html__('Pages', 'generic-elements') ?></option>
                    <option <?php selected(self::get_field('Generic Elements_product_show_type')) ?> value="1"><?php echo esc_html__('Posts', 'generic-elements') ?></option>
                    <option <?php selected(self::get_field('Generic Elements_product_show_type')) ?> value="1"><?php echo esc_html__('Categories', 'generic-elements') ?></option>
                    <option <?php selected(self::get_field('Generic Elements_product_show_type')) ?> value="1"><?php echo esc_html__('WooCommerce Products', 'generic-elements') ?></option>
                    <option <?php selected(self::get_field('Generic Elements_product_show_type')) ?> value="1"><?php echo esc_html__('Recently Purchased Product', 'generic-elements') ?></option>
                    <option <?php selected(self::get_field('Generic Elements_product_show_type')) ?> value="1"><?php echo esc_html__('WooCommerce Categories', 'generic-elements') ?></option>
                    <option <?php selected(self::get_field('Generic Elements_product_show_type')) ?> value="1"><?php echo esc_html__('Out of Stock Products', 'generic-elements') ?></option>
                </select>

                <p class="description"><?php esc_html_e('In product single page, Generic Elements can only display current product or other products in the same category.', 'generic-elements') ?></p>
            </td>
        </tr>
    <?php
    }

}
