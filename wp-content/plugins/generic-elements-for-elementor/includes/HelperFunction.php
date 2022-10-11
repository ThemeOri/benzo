<?php

function generic_element_is_elementor_version($operator = '<', $version = '2.6.0')
{
	return defined('ELEMENTOR_VERSION') && version_compare(ELEMENTOR_VERSION, $version, $operator);
}

function get_generic_elements_icons()
{
	return [
		'fa-solid' => [
			'chevron-up',
			'angle-up',
			'angle-double-up',
			'caret-up',
			'caret-square-up',
		],
		'fa-regular' => [
			'caret-square-up',
		],
	];
}

function get_generic_el_templates()
{
	$args = [
		'post_status' => 'publish',
		'post_type' => 'generic_el_template',
		'orderby'   => 'ID',
		'order' => 'ASC',
		'posts_per_page' => -1
	];

	return new \WP_Query($args);
}


function is_show_breadcumb()
{
	$breadcrumb_show = 1;
	$_id = get_the_ID();
	$is_breadcrumb = function_exists('get_field') ? get_field('is_it_invisible_breadcrumb', $_id) : '';

	if (empty($is_breadcrumb) && $breadcrumb_show == 1) {
		return true;
	}
	return false;
}


/**
 * Get Post Categories
 */
function get_generic_el_categories($taxonomy)
{
    $terms = get_terms(array(
        'taxonomy' => $taxonomy,
        'hide_empty' => true,
    ));
    $options = array();
    if (!empty($terms) && !is_wp_error($terms)) {
        foreach ($terms as $term) {
            $options[$term->slug] = $term->name;
        }
    }
    return $options;
}

/**
 * Get all types of post.
 */
function get_generic_el_all_post_types($post_type)
{

    $posts_args = get_posts(array(
        'post_type' => $post_type,
        'orderby' => 'date',
        'order' => 'DESC',
        'post_status' => 'publish',
        'posts_per_page' => 20,
    ));

    $posts = array();

    if (!empty($posts_args) && !is_wp_error($posts_args)) {
        foreach ($posts_args as $post) {
            $posts[$post->ID] = $post->post_title;
        }
    }

    return $posts;
}
