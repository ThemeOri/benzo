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

if ( isset( $user_meta['user_profile_image'] ) ) {
    $thumbnail_id = $user_meta['user_profile_image']['id'];
} else {
    $thumbnail_id = '';
}

if ( isset( $user_meta['user_title'] ) ) {
    $user_title = $user_meta['user_title'];
} else {
    $user_title = '';
}

if ( isset( $user_meta['user_address'] ) ) {
    $user_address = $user_meta['user_address'];
} else {
    $user_address = '';
}

if ( isset( $user_meta['user_social_links'] ) ) {
    $user_social_links = $user_meta['user_social_links'];
} else {
    $user_social_links = '';
}

$user_name = get_the_author_meta( 'display_name' );

if ( empty( $display_name ) ) {
    $display_name = get_the_author_meta( 'nickname', $user_id );
}

$user_description = get_the_author_meta( 'user_description', $user_id );

get_header();

?>

<div class="<?php Helper::container_class()?>">
    <div class="content-wrapper no-sidebar">
        <div class="content-area">
            <div class="entry-author-info">
                <div class="row">
                    <?php if( $thumbnail_id ) : ?>
                        <div class="col-lg-5 order-lg-2">
                            <div class="author-thumbnail">
                                <img src="<?php echo wp_get_attachment_image_url( $thumbnail_id, 'full' ) ?>" alt="<?php echo esc_html( get_the_author_meta( 'display_name' ) ) ?>">
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="col-lg-7">
                        <div class="author-content">
                            <h3 class="name">
                                <?php echo esc_html( get_the_author_meta( 'display_name' ) ); ?>
                            </h3>
                            <?php
                                if ( $user_title ) {
                                    echo '<span class="title">' . esc_html( $user_title ) . '</span>';
                                }
                            ?>
                            <?php if ( $user_description ) : ?>
                                <div class="description">
                                    <?php echo wp_kses_post( get_the_author_meta( 'user_description', $user_id ) ); ?>
                                </div>
                            <?php endif; ?>
                            <?php if ( ! empty( $user_address ) && is_array( $user_address ) ) : ?>
                                <div class="user-address">
                                    <h4 class="address-title"><?php echo wp_kses_post( $user_address['user_address_title'] ) ?></h4>
                                    <?php echo wpautop( wp_kses_post( $user_address['user_address_desc'] ) ) ?>
                                </div>
                            <?php endif; ?>

                            <?php if ( $user_social_links ) : ?>
                                <ul class="social-links">
                                    <?php foreach( $user_social_links as $item ) : ?>
                                        <li>
                                            <a href="<?php echo esc_url( $item['social_link'] ) ?>">
                                                <i class="<?php echo esc_attr( $item['social_icon'] ) ?>"></i>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
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
