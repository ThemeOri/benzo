<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Benzo
 */

use BenzoTheme\Classes\Benzo_Helper as Helper;

$copyright = Helper::get_option( 'copyright_text', __( 'Copyright © 2022. All rights reserved.', 'benzo' ) );

?>

<footer class="site-footer default-footer">
    <div class="container">
        <?php if ( is_active_sidebar( 'footer_widgets' ) ): ?>
        <div class="footer-widgets">
            <div class="footer-row">
                <?php dynamic_sidebar( 'footer_widgets' );?>
            </div>
        </div>
        <?php endif;?>
    </div>
</footer>

<!-- Footer Copyright -->
<div class="footer-copyright-area">
    <div class="container">
        <div class="footer-row">
            <div class="footer-copyright">
               <?php echo esc_html( $copyright ) ?>
            </div>
        </div>
    </div>
</div>