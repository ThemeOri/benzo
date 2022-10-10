<?php
/**
 * Template part for displaying page Title
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Benzo
 */

use BenzoTheme\Classes\Benzo_Helper;

$active_title = Benzo_Helper::get_option( 'site_page_title', 'enabled' );
$breadcrumb   = Benzo_Helper::get_option( 'site_breadcrumb', 'enabled' );
$title        = '';
$custom_title = '';
$title_output = [];

if ( is_page() && ! is_home() ) {
    $page_title        = Benzo_Helper::get_meta( 'benzo_page_meta', 'page_title', 'default' );
    $page_breadcrumb   = Benzo_Helper::get_meta( 'benzo_page_meta', 'page_breadcrumb', 'default' );
    $page_title_type   = Benzo_Helper::get_meta( 'benzo_page_meta', 'page_title_type', 'default' );
    $page_custom_title = Benzo_Helper::get_meta( 'benzo_page_meta', 'page_custom_title', '' );

    if ( 'default' !== $page_title ) {
        $active_title = $page_title;
    }

    if ( 'custom' === $page_title_type && ! empty( $page_custom_title ) ) {
        $custom_title = $page_custom_title;
    }

    if ( 'default' !== $page_breadcrumb ) {
        $breadcrumb = $page_breadcrumb;
    }

} elseif ( is_single() && 'post' === get_post_type() ) {
    $post_page_title   = Benzo_Helper::get_meta( 'benzo_post_meta', 'post_page_title', 'default' );
    $post_breadcrumb   = Benzo_Helper::get_meta( 'benzo_post_meta', 'post_breadcrumb', 'default' );
    $post_title_type   = Benzo_Helper::get_meta( 'benzo_post_meta', 'post_title_type', 'custom' );
    $post_custom_title = Benzo_Helper::get_meta( 'benzo_post_meta', 'post_custom_title', __( 'News Details', 'benzo' ) );

    if ( 'default' !== $post_page_title ) {
        $active_title = $post_page_title;
    }

    if ( 'custom' === $post_title_type && ! empty( $post_custom_title ) ) {
        $custom_title = $post_custom_title;
    }

    if ( 'default' !== $post_breadcrumb ) {
        $breadcrumb = $post_breadcrumb;
    }
}

if ( is_home() ) {
    $title = Benzo_Helper::get_option( 'blog_archive_title', __( 'Latest News', 'benzo' ) );
} elseif ( is_search() ) {
    $title = esc_html__( 'Search Results for: ', 'benzo' ) . get_search_query();
} elseif ( is_404() ) {
    $title = esc_html__( 'Page Not Found', 'benzo' );
} elseif ( is_archive() ) {
    $title = wp_kses_post( get_the_archive_title() );
    if ( is_author() ) {
        $title = __( 'Author Details', 'benzo' );
    }
} elseif ( ! empty( $custom_title ) ) {
    $title = esc_html( $custom_title );
} else {
    $title = wp_kses_post( get_the_title() );
}

if ( $title ) {
    $title_output[] = sprintf( '%s', $title );
}

if ( 'enabled' !== $active_title ) {
    return;
}

?>

<div class="page-title-area">
    <div class="container">
        <div class="page-title-inner">
            <h2 class="page-title"><?php echo implode( '', $title_output ); ?></h2>
            <?php if ( 'disabled' !== $breadcrumb && function_exists( 'bcn_display' ) ): ?>
                <div class="breadcrumb">
                    <?php bcn_display()?>
                </div>
            <?php endif;?>
        </div>
    </div>
</div>