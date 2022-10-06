<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Benzo
 */

use BenzoTheme\Classes\Benzo_Helper as Helper;
use BenzoTheme\Classes\Benzo_Post_Helper;

$show_meta     = Helper::get_option( 'archive_post_meta', 'yes' );
$show_excerpt  = Helper::get_option( 'archive_post_excerpt', 'yes' );
$excerpt_count = Helper::get_option( 'post_excerpt_count', 35 );
$show_button   = Helper::get_option( 'archive_post_button', 'yes' );
$button_text   = Helper::get_option( 'post_button_text', __( 'Continue Reading', 'benzo' ) );

?>

<article id="post-<?php the_ID();?>" <?php post_class( 'entry-post clearfix' );?>>
    <?php Benzo_Post_Helper::render_media(); ?>
    <div class="entry-summary">
		<?php
            if( 'yes' === $show_meta ) {
                Benzo_Post_Helper::render_meta();
            }

            the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );

            if ( 'yes' === $show_excerpt ) {
                if ( has_excerpt() ) {
                    echo wpautop( wp_trim_words( get_the_excerpt(), $excerpt_count, '...' ) );
                } else {
                    echo wpautop( wp_trim_words( get_the_content(), $excerpt_count, '...' ) );
                }
            }

            if ( 'yes' === $show_button && ! empty( $button_text ) ) {
                echo '<a href="' . esc_url( get_permalink() ) . '" class="read-more">' . esc_html( $button_text ) . ' <i class="far fa-angle-double-right"></i></a>';
            }
        ?>
	</div>
</article>