<?php
/**
 * Required Plugin for Benzo theme
 *
 * @package Benzo
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit( 'No direct script access allowed' );
}

add_action( 'tgmpa_register', 'benzo_register_required_plugins' );
function benzo_register_required_plugins() {
    $plugins = [
        [
            'name'     => esc_html__( 'Elementor Website Builder', 'benzo' ),
            'slug'     => 'elementor',
            'required' => true,
            'version'  => '3.0',
        ],
        [
            'name'     => esc_html__( 'Benzo Toolkit', 'benzo' ),
            'slug'     => 'benzo-toolkit',
            'source'   => BENZO_INCLUDES . '/library/plugins/benzo-toolkit.zip',
            'required' => true,
            'version'  => '1.0',
        ],
        [
            'name'     => esc_html__( 'Contact Form 7', 'benzo' ),
            'slug'     => 'contact-form-7',
            'required' => false,
        ],
        [
            'name'     => esc_html__( 'Breadcrumb NavXT', 'benzo' ),
            'slug'     => 'breadcrumb-navxt',
            'required' => false,
        ],
        [
            'name'     => esc_html__( 'MC4WP: Mailchimp for WordPress', 'benzo' ),
            'slug'     => 'mailchimp-for-wp',
            'required' => false,
        ],
        [
            'name'     => esc_html__( 'One Click Demo Import', 'benzo' ),
            'slug'     => 'one-click-demo-import',
            'required' => false,
        ],
    ];

    $config = [
        'default_path' => '',
        'menu'         => 'benzo_install_plugins',
        'has_notices'  => true,
        'dismissable'  => false,
        'dismiss_msg'  => '',
        'is_automatic' => false,
        'message'      => '',
    ];

    tgmpa( $plugins, $config );
}
