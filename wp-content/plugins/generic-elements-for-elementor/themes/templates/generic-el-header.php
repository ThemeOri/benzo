<?php

/**
 * The elementor way of footer file
 *
 * @package generic-elements
 * @since 1.0.3
 */

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php do_action('wp_body_open'); ?>
	<div id="page" class="generic-el site">

		<?php do_action('generic_el_header'); ?>
		<?php do_action('generic_el_breadcrumb'); ?>
