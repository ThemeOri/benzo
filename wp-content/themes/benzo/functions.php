<?php
/**
 * Benzo functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Benzo
 */

/**
 * Define constant
 */
$theme = wp_get_theme();

if ( ! empty( $theme['Template'] ) ) {
    $theme = wp_get_theme( $theme['Template'] );
}

define( 'BENZO_NAME', $theme['Name'] );
define( 'BENZO_VERSION', $theme['Version'] );
define( 'BENZO_PATH', untrailingslashit( get_template_directory() ) );
define( 'BENZO_URI', untrailingslashit( get_template_directory_uri() ) );
define( 'BENZO_ASSETS', untrailingslashit( get_template_directory_uri() ) . '/assets' );
define( 'BENZO_INCLUDES', BENZO_PATH . '/includes' );
define( 'BENZO_CLASSES', BENZO_PATH . '/includes/classes' );
define( 'BENZO_ADMIN', BENZO_PATH . '/includes/admin' );
define( 'BENZO_IS_RTL', is_rtl() ? true : false );

/**
 * Load theme files
 */
require_once BENZO_CLASSES . '/class-setup.php';
require_once BENZO_CLASSES . '/class-helper.php';
require_once BENZO_CLASSES . '/class-assets.php';
require_once BENZO_CLASSES . '/class-post-helper.php';
require_once BENZO_CLASSES . '/class-comment-walker.php';
require_once BENZO_ADMIN . '/class-admin-panel.php';
require_once BENZO_INCLUDES . '/library/class-tgm-plugin-activation.php';
require_once BENZO_INCLUDES . '/library/required-plugin.php';