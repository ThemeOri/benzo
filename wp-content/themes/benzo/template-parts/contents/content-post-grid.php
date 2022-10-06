<?php
/**
 * Template part for displaying posts for search
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Benzo
 */

use BenzoTheme\Classes\Benzo_Helper as Helper;
use BenzoTheme\Classes\Benzo_Post_Helper;

?>

<div class="col-lg-3 col-md-6">
    <article id="post-<?php the_ID();?>" <?php post_class( 'entry-grid-post clearfix' );?>>
        <?php Benzo_Post_Helper::render_media( get_the_ID(), 'medium_large' ); ?>
        <div class="entry-summary">
            <div class="entry-meta">
                <span class="date">
                    <a href="#">
                        <?php echo esc_html( get_the_date( 'M d, Y' ) ) ?>
                    </a>
                </span>
                <span class="category">
                    <?php echo get_the_category_list( ', ' ) ?>
                </span>
            </div>
            <?php
                the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );

                echo '<a href="' . esc_url( get_permalink() ) . '" class="read-more">' . esc_html__( 'Read More', 'benzo' ) . ' <i class="far fa-angle-double-right"></i></a>';
            ?>
        </div>
    </article>
</div>