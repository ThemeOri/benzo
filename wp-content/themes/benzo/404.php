<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Benzo
 */

use BenzoTheme\Classes\Benzo_Helper as Helper;

get_header();

$error_note  = Helper::get_option( 'error_note', __( 'The page you are looking for doesn&rsquo;t exist. It may have been moved or removed altogether. Please try searching for some other page, or return to the website&rsquo;s homepage to find what you&rsquo;re looking for.', 'benzo' ) );
$button_text = Helper::get_option( 'error_button_text', __( 'Return To Home', 'benzo' ) );

?>

<div class="error-content-area content-container">
    <div class="row">
        <div class="col-lg-7">
            <div class="error-content">
                <h2 class="error-title"><?php esc_html_e( '404', 'benzo' )?></h2>
                <?php if ( $error_note ): ?>
                    <p class="error-note"><?php echo esc_html( $error_note ) ?></p>
                <?php endif;?>
                <a class="error-btn" href="<?php echo esc_url( home_url( '/' ) ) ?>">
                    <?php echo esc_html( $button_text ) ?>
                    <i class="fas fa-angle-double-right"></i></a>
                </a>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();