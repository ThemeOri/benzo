<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Benzo
 */

use BenzoTheme\Classes\Benzo_Helper as Helper;
use BenzoTheme\Classes\Benzo_Post_Helper;

$user_id   = get_the_author_meta( 'ID' );
$user_meta = get_user_meta( $user_id, 'benzo_user_meta', true );

$user_name = get_the_author_meta( 'display_name' );

if ( empty( $display_name ) ) {
    $display_name = get_the_author_meta( 'nickname', $user_id );
}

$user_description = get_the_author_meta( 'user_description', $user_id, get_query_var( 'author' ) );
$author_benzo_avatar_size = 110;
if ( $user_description != '' ):

get_header();

?>
    <div class="author_area-wrapper">
        <div class="author_area-thumb">
            <?php print get_avatar( get_the_author_meta( 'user_email' ), $author_benzo_avatar_size, '', '', [ 'class' => 'media-object img-circle' ] );?>
        </div>
        <div class="author_area-content">
            <div class="author_area-title">
                <h4><?php echo esc_html( get_the_author_meta( 'display_name' ) ); ?></h4>
            </div>
            <div class="author_area-date">
                <span><?php the_time( 'l, F jS, Y' ); ?></span>
            </div>
            <?php if ( $user_description ) : ?>
            <div class="author_area-des">
                <p><?php echo wp_kses_post( get_the_author_meta( 'user_description', $user_id ) ); ?></p>
            </div>
            <?php endif; ?> 
        </div>
    </div>

<?php endif;?>
