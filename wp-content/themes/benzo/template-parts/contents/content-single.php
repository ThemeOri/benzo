<?php
/**
 * Template part for displaying single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Benzo
 */

use BenzoTheme\Classes\Benzo_Helper as Helper;
use BenzoTheme\Classes\Benzo_Post_Helper;
use BenzoToolkit\Helper\Benzo_Toolkit_Helper;

$show_details_meta = Helper::get_option( 'blog_details_meta', 'yes' );
$show_post_share   = Helper::get_option( 'blog_details_share', 'no' );
$show_tag          = Helper::get_option( 'blog_details_tag', 'yes' );
$show_nav          = Helper::get_option( 'blog_details_nav', 'yes' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('entry-post-details clearfix'); ?>>
    <div class="<?php Helper::content_wrap_class()?>">
        <div class="content-area">
            <?php
                Benzo_Post_Helper::render_media();

                if( 'yes' === $show_details_meta ) {
                    Benzo_Post_Helper::render_meta();
                }

                the_title( '<h3 class="entry-title">', '</h3>' );
            ?>
            <div class="entry-content clearfix">
                <?php
                    the_content();

                    wp_link_pages(array(
                        'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__('Pages:', 'benzo') . '</span>',
                        'after' => '</div>',
                    ));
                ?>
            </div>
            <?php if ( 'yes' === $show_tag || 'yes' === $show_post_share ) : ?>
            <div class="entry-tags-share">
                <?php if ( 'yes' === $show_tag ) : ?>
                <div class="related-tags">
                    <div class="tags-title">
                        <span><?php esc_html_e('Tags:','benzo'); ?></span>
                    </div>
                    <?php the_tags('', '', ''); ?>
                </div>
                <?php endif; ?>
                <?php
                    if ( class_exists( 'Benzo_Toolkit' ) && 'yes' === $show_post_share ) {
                        Benzo_Toolkit_Helper::post_share_links();
                    }
                ?>
            </div>
            <?php endif; ?>

            <div class="author_area-wrapper">
                <div class="author_area-thumb">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/author/author.png" alt="img">
                </div>
                <div class="author_area-content">
                    <div class="author_area-title">
                        <h4><a href="#">Lethioum hazard</a></h4>
                    </div>
                    <div class="author_area-date">
                        <span>20 August, 2022 AT 10:30 AM</span>
                    </div>
                    <div class="author_area-des">
                        <p>Fermentum aliquet cras cras mattis antec donec vestibulum tristique sollicitudin uterin adipisc cras montes. Viverra placerat vulputate antes suscipit augue dictum consectetuer luctus litora ligula inceptos ligula cubilia dictum.</p>
                    </div>
                </div>
            </div>

            <?php
                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
            ?>
        </div>
        <?php get_sidebar()?>
    </div>
</article>