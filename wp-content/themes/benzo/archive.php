<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Benzo
 */

use BenzoTheme\Classes\Benzo_Helper as Helper;
use BenzoTheme\Classes\Benzo_Post_Helper;

get_header();
?>

<div class="<?php Helper::container_class()?>">
    <div class="<?php Helper::content_wrap_class()?>">
        <div class="content-area">
            <div class="entry-posts">
				<?php
                    if ( have_posts() ):
                        /* Start the Loop */
                        while ( have_posts() ): the_post();

                            /*
                            * Include the Post-Type-specific template for the content.
                            * If you want to override this in a child theme, then include a file
                            * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                            */
                            get_template_part( 'template-parts/contents/content');

                        endwhile;

                        Benzo_Post_Helper::pagination();

                    else:

                        get_template_part( 'template-parts/contents/content', 'none' );

                    endif;
                ?>
			</div>
        </div>
        <?php get_sidebar()?>
    </div>
</div>

<?php
get_footer();
