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

$error_note  = Helper::get_option( 'error_note', __( 'The page which you are looking for does not exist galley of type and scrambled it to make a type specimen book. Please return to the homepage.', 'benzo' ) );
$button_text = Helper::get_option( 'error_button_text', __( 'Return To Home_', 'benzo' ) );

?>

<div class="error-content-area content-container">
    <div class="row">
        <div class="col-lg-7">
            <div class="error-content">
                <h2 class="error-title"><?php esc_html_e( '404', 'benzo' )?></h2>
                <?php if ( $error_note ): ?>
                    <p class="error-note"><?php echo esc_html( $error_note ) ?></p>
                <?php endif;?>
                <a class="theme-btn" href="<?php echo esc_url( home_url( '/' ) ) ?>">
                    <?php echo esc_html( $button_text ) ?>
                    </a>
                </a>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();