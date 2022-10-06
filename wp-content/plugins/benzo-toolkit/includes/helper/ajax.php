<?php
namespace BenzoToolkit\Helper;

use BenzoToolkit\ElementorAddon\Helper\Benzo_Post_Templates;
use WP_Query;

defined( 'ABSPATH' ) || exit;

/**
 * Benzo Toolkit Helper
 */

if ( ! class_exists( 'Benzo_Ajax' ) ) {

    class Benzo_Ajax {

        /**
         * Class Constructor
         */
        public function __construct() {
            add_action( 'wp_ajax_benzo_load_more_ajax', [$this, 'benzo_load_more_ajax'] );
            add_action( 'wp_ajax_nopriv_benzo_load_more_ajax', [$this, 'benzo_load_more_ajax'] );
            add_action( 'wp_ajax_benzo_ajax_post_tab', [$this, 'benzo_ajax_post_tab'] );
            add_action( 'wp_ajax_nopriv_benzo_ajax_post_tab', [$this, 'benzo_ajax_post_tab'] );
        }

        /**
         * Load More Button AJAX Init
         */
        public function benzo_load_more_ajax() {
            $nonce = isset( $_REQUEST['nonce'] ) ? sanitize_text_field( $_REQUEST['nonce'] ) : 0;

            if ( ! wp_verify_nonce( $nonce, 'benzo-load-more' ) ): ?>
                <div class="ajax-error-msg col-12">
                    <p><?php esc_html_e( 'Something went wrong...', 'benzo-toolkit' )?></p>
                </div>
            <?php else:
                $args    = $_POST['data']['query'];
                $options = $_POST['data']['options'];
                $query   = new WP_Query( $args );

                if ( array_key_exists( 'column', $options ) ):
                    if ( $query->have_posts() ):
                        while ( $query->have_posts() ): $query->the_post();?>
                            <div class="<?php echo esc_attr( implode( ' ', $options['column'] ) ) ?>">
                                <?php Benzo_Post_Templates::render_post_box( $options );?>
                            </div>
                        <?php endwhile;
                    endif;
                    wp_reset_query();
                else:
                    switch ( $options['masonry_layout'] ) {
                        case 'layout-one':
                        case 'layout-six':
                            Benzo_Post_Templates::masonry_layout_one( $query, $options );
                            break;
                        case 'layout-two':
                            Benzo_Post_Templates::masonry_layout_two( $query, $options );
                            break;
                        case 'layout-three':
                            Benzo_Post_Templates::masonry_layout_three( $query, $options );
                            break;
                        case 'layout-four':
                            Benzo_Post_Templates::masonry_layout_four( $query, $options );
                            break;
                        case 'layout-five':
                            Benzo_Post_Templates::masonry_layout_five( $query, $options );
                            break;
                        case 'layout-seven':
                            Benzo_Post_Templates::masonry_layout_seven( $query, $options );
                            break;
                    }
                endif;
            endif;

            wp_die();
        }

        /**
         * AJAX Post Tab
         */
        public function benzo_ajax_post_tab() {
            $nonce = isset( $_REQUEST['nonce'] ) ? sanitize_text_field( $_REQUEST['nonce'] ) : 0;

            if ( ! wp_verify_nonce( $nonce, 'benzo-post-tab' ) ): ?>
                <div class="ajax-error-msg col-12">
                    <p><?php esc_html_e( 'Something went wrong...', 'benzo-toolkit' )?></p>
                </div>
            <?php else:
                $args   = $_POST['data']['query'];
                $cat_id = $_POST['cat_id'];
                $options = $_POST['data']['options'];

                if ( 'all' !== $cat_id ) {
                    unset( $args['category_name'] );
                    $args['category__in'] = $cat_id;
                }

                $query   = new WP_Query( $args );
                Benzo_Post_Templates::render_post_tab( $query, $options );
            endif;

            wp_die();
        }
    }

    new Benzo_Ajax();
}