<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Benzo
 */

use BenzoTheme\Classes\Benzo_Helper as Helper;
?>
    </main>
    <?php
        if (  class_exists( 'Benzo_Toolkit' ) ) {
            do_action( "benzo_builder_after_main" );
        }

        if( 'enabled' === Helper::check_default_footer() ) {
            get_template_part( 'template-parts/footer/footer', 'default' );
        }
    ?>
</div>

<?php wp_footer();?>

</body>
</html>
