<?php
/**
 * Template part for displaying Main Header
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Benzo
 */
use BenzoTheme\Classes\Benzo_Helper as Helper;

$site_logo        = Helper::get_option( 'site_main_logo', ['url' => BENZO_ASSETS . '/img/logo.png'] );
$slide_panel_logo = Helper::get_option( 'slide_panel_logo', ['url' => BENZO_ASSETS . '/img/logo.png'] );
?>

<header class="site-header default-header">
    <div class="container">
        <div class="header-navigation">
            <div class="benzo-site-logo">
                <?php if ( ! empty( $site_logo['url'] ) ): ?>
                    <a href="<?php echo esc_url( home_url() ) ?>">
                        <img src="<?php echo esc_url( $site_logo['url'] ) ?>" alt="<?php echo esc_html( get_bloginfo() ) ?>">
                    </a>
                <?php else: ?>
                    <h2>
                        <a href="<?php echo esc_url( home_url() ) ?>">
                            <?php echo esc_html( get_bloginfo() ) ?>
                        </a>
                    </h2>
                <?php endif;?>
            </div>
            <nav class="benzo-nav-menu default-theme-header" data-breakpoint="<?php echo helper::get_option( 'header_breakpoint', '1200' ) ?>">
                <?php
                    if( has_nav_menu( 'primary_menu' ) ) {
                        wp_nav_menu( [
                            'theme_location'  => 'primary_menu',
                            'container'       => 'div',
                            'container_class' => 'nav-menu-wrapper nav-flex-end',
                            'menu_class'      => 'primary-menu',
                            'after'           => '',
                            'link_before'     => '<span class="link-text">',
                            'link_after'      => '</span>',
                        ] );
                    }
                ?>
                <div class="navbar-toggler">
                    <span>
                        <span class="line"></span>
                        <span class="line"></span>
                        <span class="line"></span>
                    </span>
                </div>
                <div class="slide-panel-wrapper">
                    <div class="slide-panel-overly"></div>
                    <div class="slide-panel-content">
                        <div class="slide-panel-close">
                            <i class="fal fa-times"></i>
                        </div>
                        <?php if ( $slide_panel_logo['url'] ): ?>
                            <div class="slide-panel-logo">
                                <img src="<?php echo esc_url( $slide_panel_logo['url'] ) ?>" alt="<?php echo get_bloginfo() ?>">
                            </div>
                        <?php endif;?>
                        <?php
                            wp_nav_menu( [
                                'theme_location'  => 'primary_menu',
                                'container'       => 'div',
                                'container_class' => 'slide-panel-menu',
                                'menu_class'      => 'primary-menu',
                                'after'           => '',
                                'link_before'     => '<span class="link-text">',
                                'link_after'      => '</span>',
                            ] );
                        ?>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</header>