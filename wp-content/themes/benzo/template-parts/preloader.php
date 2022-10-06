<?php
/**
 * Template part for site preloader
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Benzo
 */

use BenzoTheme\Classes\Benzo_Helper as Helper;

$preloader_img = Helper::get_option( 'preloader_image', ['url' => BENZO_ASSETS . '/img/preloader.gif'] );

if ( defined( 'ELEMENTOR_VERSION' ) && \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
    echo '';
} else {
    ?>
    <div class="site-preloader">
        <?php if ( is_array( $preloader_img ) && $preloader_img['url'] ): ?>
            <img src="<?php echo esc_url( $preloader_img['url'] ) ?>" alt="<?php echo esc_attr__( 'Preloader', 'benzo' ) ?>">
        <?php endif;?>
    </div>
    <?php
}
?>