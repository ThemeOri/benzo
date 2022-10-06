<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Benzo
 */

use BenzoTheme\Classes\Benzo_Helper as Helper;
use BenzoTheme\Classes\Benzo_Post_Helper;

get_header();

$show_form  = Helper::get_option( 'show_search_form', true );
$form_title = Helper::get_option( 'search_form_title', __( 'Search Here:', 'benzo' ) );
$form_note  = Helper::get_option( 'search_form_note', __( 'If you are not happy with the results below please do another search', 'benzo' ) );

?>

<div class="<?php Helper::container_class()?>">
    <div class="content-wrapper no-sidebar">
        <div class="content-area">
            <?php if ( $show_form ) : ?>
                <div class="search-form-wrap">
                    <h3 class="search-form-title"><?php echo esc_html( $form_title ) ?></h3>
                    <?php get_search_form(); ?>
                    <?php
                        if ( $form_note ) {
                            echo wpautop( esc_html( $form_note ) );
                        }
                    ?>
                </div>
            <?php endif; ?>
            <div class="entry-grid-posts row">
				<?php
                    if ( have_posts() ):
                        /* Start the Loop */
                        while ( have_posts() ): the_post();

                            /*
                            * Include the Post-Type-specific template for the content.
                            * If you want to override this in a child theme, then include a file
                            * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                            */
                            get_template_part( 'template-parts/contents/content', 'post-grid' );

                        endwhile;
                        ?>
                        <div class="col-12">
                            <?php
                                Benzo_Post_Helper::pagination();
                            ?>
                        </div>
                        <?php
                    else:
                        ?>
                        <div class="col-12">
                            <?php get_template_part( 'template-parts/contents/content', 'none' ); ?>
                        </div>
                        <?php
                    endif;
                ?>
			</div>
        </div>
    </div>
</div>

<?php
get_footer();