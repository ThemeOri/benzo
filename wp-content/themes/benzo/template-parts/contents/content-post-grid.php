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

<div class="col-lg-4 col-md-6">
    <article id="post-<?php the_ID();?>" <?php post_class( 'entry-grid-post clearfix' );?>>
        <?php Benzo_Post_Helper::render_media( get_the_ID(), 'medium_large' ); ?>
        <div class="entry-summary  blog-content-wrapper search">
            <div class="entry-meta">
                <span class="category">
                 <i class="far fa-tags"></i>
                 <?php echo get_the_category_list( ', ' ) ?>
                </span>
                <span class="admin">
                    <i class="fal fa-user-circle"></i>
                    <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>">
                        <?php echo esc_html( get_the_author() ) ?>
                    </a>
                </span>
                <span>
                  <i class="far fa-comment"></i>
                  <a href="<?php comments_link();?>"><?php comments_number();?></a>
               </span>
            </div>
            <?php
                the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );

                echo '<a href="' . esc_url( get_permalink() ) . '" class="theme-btn entry-grid-btn">' . esc_html__( 'Read More_', 'benzo' ) . '</a>';
            ?>
        </div>
    </article>
</div>