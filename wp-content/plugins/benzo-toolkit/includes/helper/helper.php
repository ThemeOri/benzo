<?php
namespace BenzoToolkit\Helper;

defined( 'ABSPATH' ) || exit;

use BenzoTheme\Classes\Benzo_Helper as Helper;

/**
 * Benzo Toolkit Helper
 */

if ( ! class_exists( 'Benzo_Toolkit_Helper' ) ) {

    class Benzo_Toolkit_Helper {

        /**
         * Retrieve the name of the highest priority template file that exists.
         *
         * @param string|array $template_names Template file(s) to search for, in order.
         * @param string       $origin_path    Template file(s) origin path. (../benzo-toolkit/elementor/widgets/)
         * @param string       $override_path  New template file(s) override path. (../benzo)
         *
         * @return string The template filename if one is located.
         */
        public static function get_locate_template( $template_names, $origin_path, $override_path ) {
            $files = [];
            $file  = '';

            foreach ( (array) $template_names as $template_name ) {
                if ( file_exists( get_stylesheet_directory() . $override_path . $template_name ) ) {
                    $file = get_stylesheet_directory() . $override_path . $template_name;
                } elseif ( file_exists( get_template_directory() . $override_path . $template_name ) ) {
                    $file = get_template_directory() . $override_path . $template_name;
                } elseif ( file_exists( realpath( __DIR__ . '/..' ) . $origin_path . $template_name ) ) {
                    $file = realpath( __DIR__ . '/..' ) . $origin_path . $template_name;
                }
                array_push( $files, $file );
            }

            return $files;
        }

        /**
         * Get a list of all Contact Form 7
         *
         * @since 1.0.0
         * @return array
         */
        public static function get_all_cf7() {
            $forms_list = [];

            if ( function_exists( 'wpcf7' ) ) {
                $forms = get_posts( [
                    'post_type'      => 'wpcf7_contact_form',
                    'post_status'    => 'publish',
                    'posts_per_page' => -1,
                    'orderby'        => 'title',
                    'order'          => 'ASC',
                ] );

                if ( ! empty( $forms ) ) {
                    $forms_list = wp_list_pluck( $forms, 'post_title', 'ID' );
                } else {
                    $forms_list[0] = esc_html__( 'No Contact From found', 'benzo-toolkit' );
                }
            } else {
                $forms_list[0] = esc_html__( 'Please Install & Active Contact Contact Form 7', 'benzo-toolkit' );
            }

            return $forms_list;
        }

        /**
         * Social Share links
         */
        public static function post_share_links() {
            global $post;
            if ( ! isset( $post->ID ) ) {
                return;
            }

            $share_items = Helper::get_option( 'social_share_item', [] );

            if ( array_key_exists( 'enabled', $share_items ) ) {
                $share = $share_items['enabled'];
            } else {
                $share = [];
            }

            $html = '';

            if ( array_key_exists( 'twitter', $share ) ) {
                $html .= '<li>
                    <a target="_blank" href="' . esc_url( 'https://twitter.com/intent/tweet?text=' . get_the_title() . '&amp;url=' . get_permalink() ) . '">
                        <i class="fab fa-twitter"></i>
                    </a>
                </li>';
            }

            if ( array_key_exists( 'facebook', $share ) ) {
                $html .= '<li>
                    <a target="_blank" href="' . esc_url( 'https://www.facebook.com/share.php?u=' . get_permalink() ) . '">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                </li>';
            }

            if ( array_key_exists( 'pinterest', $share ) ) {
                $img_url = wp_get_attachment_image_url( get_post_thumbnail_id( $post->ID ), 'full' );

                $html .= '<li>
                    <a target="_blank" href="' . esc_url( 'https://pinterest.com/pin/create/button/?url=' . get_permalink() . '&media=' . $img_url ) . '">
                        <i class="fab fa-pinterest-p"></i>
                    </a>
                </li>';
            }

            if ( array_key_exists( 'linkedin', $share ) ) {
                $html .= '<li>
                    <a target="_blank" href="' . esc_url( 'http://www.linkedin.com/shareArticle?mini=true&url=' . substr( urlencode( get_permalink() ), 0, 1024 ) ) . '&title=' . esc_attr( substr( urlencode( html_entity_decode( get_the_title() ) ), 0, 200 ) ) . '">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </li>';
            }

            if ( array_key_exists( 'reddit', $share ) ) {
                $html .= '<li>
                    <a target="_blank" href="' . esc_url( 'https://reddit.com/submit?url=<URL>&amp;title=' . get_the_title() . '&amp;url=' . get_permalink() ) . '">
                        <i class="fab fa-reddit-alien" aria-hidden="true"></i>
                    </a>
                </li>';
            }

            if ( array_key_exists( 'whatsapp', $share ) ) {
                $html .= '<li>
                    <a target="_blank" href="' . esc_url( 'https://wa.me/?text=' . get_the_title() ) . '">
                        <i class="fab fa-whatsapp" aria-hidden="true"></i>
                    </a>
                </li>';
            }

            if ( array_key_exists( 'telegram', $share ) ) {
                $html .= '<li>
                        <a target="_blank" href="' . esc_url( 'https://telegram.me/share/url?url=<URL>&amp;text=' . get_the_title() . '&amp;url=' . get_permalink() ) . '">
                            <i class="fab fa-telegram-plane" aria-hidden="true"></i>
                        </a>
                </li>';
            }

            echo '<ul class="post-share">' . $html . '</ul>';
        }
    }
}