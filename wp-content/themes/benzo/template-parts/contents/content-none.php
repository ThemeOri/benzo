<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package benzo
 */
?>

<div class="not-found-wrapper">
    <h3 class="not-found-title"><?php esc_html_e( 'Nothing Found', 'benzo' );?></h3>

	<div class="not-found-content">
        <?php if( is_home() && current_user_can( 'publish_posts' ) ) : ?>
            <p>
                <?php esc_html_e( 'Ready to publish your first post?.', 'benzo' ); ?>
                <a href="<?php echo esc_url( admin_url( 'post-new.php' ) ) ?>">
                    <?php esc_html_e( 'Get started here', 'benzo' ); ?>
                </a>
            </p>
        <?php elseif( is_search() ) : ?>
            <p>
                <?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'benzo' ); ?>
            </p>
        <?php else : ?>
            <p>
                <?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'benzo' ); ?>
            </p>
            <?php get_search_form(); ?>
        <?php endif; ?>
	</div>
</div>
