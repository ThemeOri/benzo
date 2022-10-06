<?php
namespace BenzoTheme\Classes;

defined( 'ABSPATH' ) || exit;

/**
 * Post Helper Function
 */
class Benzo_Post_Helper {
    /**
     * Get Post Media
     *
     * @param int $idd
     * @return void
     */
    public static function render_media( $idd = '', $image_size = '', $class = '' ) {
        $layout  = Benzo_Helper::content_layout();
        $sidebar = Benzo_Helper::content_sidebar();

        if ( empty( $idd ) ) {
            $idd = get_the_ID();
        }

        $post_format       = Benzo_Helper::get_meta( 'benzo_post_meta', 'post_format', 'standard', $idd );
        $post_gallery      = Benzo_Helper::get_meta( 'benzo_post_meta', 'post_gallery', [], $idd );
        $post_video_link   = Benzo_Helper::get_meta( 'benzo_post_meta', 'post_video_link', '', $idd );
        $post_video_img    = Benzo_Helper::get_meta( 'benzo_post_meta', 'post_video_thumb', [], $idd );
        $post_audio_link   = Benzo_Helper::get_meta( 'benzo_post_meta', 'post_audio_link', '', $idd );
        $post_quote_text   = Benzo_Helper::get_meta( 'benzo_post_meta', 'post_quote_text', '', $idd );
        $post_quote_author = Benzo_Helper::get_meta( 'benzo_post_meta', 'post_quote_author', '', $idd );
        $post_audio_link   = Benzo_Helper::get_meta( 'benzo_post_meta', 'post_audio_link', '', $idd );
        $post_link_url     = Benzo_Helper::get_meta( 'benzo_post_meta', 'post_link_url', '', $idd );
        $post_link_text    = Benzo_Helper::get_meta( 'benzo_post_meta', 'post_link_text', '', $idd );

        $wrapper_class = ['post-media'];

        if ( 'gallery' == $post_format ) {
            $wrapper_class[] = 'post-media-gallery';
        } elseif ( 'video' == $post_format ) {
            $wrapper_class[] = 'post-media-video';
        } elseif ( 'audio' == $post_format ) {
            $wrapper_class[] = 'post-media-audio';
        } elseif ( 'quote' == $post_format ) {
            $wrapper_class[] = 'post-media-quote';
        } elseif ( 'link' == $post_format ) {
            $wrapper_class[] = 'post-media-link';
        } elseif( 'standard' == $post_format ) {
            $wrapper_class[] = 'post-media-standard';
        }

        if ( ! empty( $class ) ) {
            $wrapper_class[] = $class;
        };

        if( ! empty( $image_size )  ){
            $size = $image_size;
        } else {
            if( 'full-width-layout' === $layout ) {
                if( 'no-sidebar' == $sidebar ) {
                    $size = 'benzo_1920x850';
                } else {
                    $size = 'benzo_1230x600';

                }
            } else {
                if( 'no-sidebar' == $sidebar ) {
                    $size = 'benzo_1320x650';
                } else {
                    $size = 'benzo_870x500';
                }
            }
        }
        ?>
        <div class="<?php echo esc_attr( implode( ' ', $wrapper_class ) ) ?>">
            <?php if ( 'gallery' == $post_format && $post_gallery ): ?>
            <div class="gallery-slider-active">
                <?php
                $gallery_ids = explode( ',', $post_gallery );
                foreach ( $gallery_ids as $gallery_id ): ?>
                <div class="single-gallery">
                    <?php echo wp_get_attachment_image( $gallery_id, $size, false, ['alt' => wp_kses_post( get_the_title() )] ); ?>
                </div>
                <?php endforeach; ?>
            </div>
            <?php elseif ( 'video' == $post_format && $post_video_img ):
                echo wp_get_attachment_image( $post_video_img['id'], $size, false, ['alt' => wp_kses_post( get_the_title() )] );
                if ( $post_video_link ) {
                    echo '<a href="' . esc_url( $post_video_link ) . '" class="popup-video"><i class="fas fa-play"></i></a>';
                }
            ?>
            <?php elseif ( 'audio' == $post_format && $post_audio_link ):
                echo wp_oembed_get( $post_audio_link );
            elseif ( 'quote' == $post_format && $post_quote_text ): ?>
            <div class="quote-wrapper">
                <?php
                    echo wpautop( esc_html( $post_quote_text ) );
                    if ( $post_quote_author ) {
                        echo '<span>' . esc_html( $post_quote_author ) . '</span>';
                    }
                ?>
            </div>
            <?php elseif ( 'link' == $post_format && $post_link_url && $post_link_text ): ?>
            <div class="link-wrapper">
                <a href="<?php echo esc_url( $post_link_url ) ?>"><?php echo esc_html( $post_link_text ) ?></a>
            </div>
            <?php elseif ( has_post_thumbnail() ):
                the_post_thumbnail( $size, ['alt' => wp_kses_post( get_the_title() )] );
            endif; ?>
        </div>
        <?php
    }

    /**
     * Get Post Meta
     *
     * @param int $idd
     * @return void
     */
    public static function render_meta( $idd = '' ) {
        if ( empty( $idd ) ) {
            $idd = get_the_ID();
        }
        ?>
        <div class="entry-meta">
            <span class="date">
                <a href="#">
                    <?php echo esc_html( get_the_date( 'M d, Y' ) ) ?>
                </a>
            </span>
            <span class="admin">
                <?php esc_html_e( 'by', 'benzo' )?>
                <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>">
                    <?php echo esc_html( get_the_author() ) ?>
                </a>
            </span>
            <span class="category">
                <?php echo get_the_category_list( ', ' ) ?>
            </span>
        </div>
        <?php
    }

    /**
     * Post Navigation
     *
     * @return void
     */
    public static function post_navigation() {
        global $post;
        if ( 'post' === get_post_type() ) {
            $prev = get_previous_post();
            $next = get_next_post();
            ?>
            <div class="entry-post-navigation">
                <?php if ( ! empty( $prev ) ) :
                    $prev_id = $prev->ID; ?>
                    <div class="prev-post">
                    <?php if( has_post_thumbnail( $prev_id ) ) : ?>
                        <div class="thumb">
                            <?php echo get_the_post_thumbnail( $prev_id, 'thumbnail' ) ?>
                        </div>
                        <?php endif; ?>
                        <div class="content">
                            <a href="<?php echo esc_url( get_permalink( $prev_id ) ) ?>">
                                <span><?php echo esc_html__( 'Previous Post', 'benzo' ) ?></span>
                                <?php
                                    $title = wp_trim_words( get_the_title( $prev_id ), 4 );
                                    echo wp_kses_post( $title );
                                ?>
                            </a>
                        </div>
                    </div>
                <?php endif; if ( ! empty( $next ) ) :
                    $next_id = $next->ID; ?>
                    <div class="next-post">
                        <?php if( has_post_thumbnail( $next_id ) ) : ?>
                        <div class="thumb">
                            <?php echo get_the_post_thumbnail( $next_id, 'thumbnail' ) ?>
                        </div>
                        <?php endif; ?>
                        <div class="content">
                            <a href="<?php echo esc_url( get_permalink( $next_id ) ) ?>">
                                <span><?php echo esc_html__( 'Next Post', 'benzo' ) ?></span>
                                <?php
                                    $title = wp_trim_words( get_the_title( $next_id ), 4 );
                                    echo wp_kses_post( $title );
                                ?>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <?php
        }
    }

    /**
     * Pagination
     *
     * @param $query
     * @return void
     */
    public static function pagination( $query = false ) {
        if ( $query != false ) {
            $wp_query = $query;
        } else {
            global $paged, $wp_query;
        }

        if ( empty( $paged ) ) {
            $query_vars = $wp_query->query_vars;
            $paged      = isset( $query_vars['paged'] ) ? $query_vars['paged'] : 1;
        }

        $max_page = $wp_query->max_num_pages;

        // Exit if pagination not need
        if ( ! ( $max_page > 1 ) ) {
            return;
        }

        //return $output;
        $big = 999999999;

        $page_items = paginate_links( [
            'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'type'      => 'array',
            'current'   => max( 1, $paged ),
            'end_size'  => 1,
            'mid_size'  => 1,
            'total'     => $max_page,
            'prev_text' => '<i class="fas fa-angle-double-left"></i>',
            'next_text' => '<i class="fas fa-angle-double-right"></i>',
        ] );
        ?>
        <ul class="benzo-pagination">
            <?php foreach ( $page_items as $key => $value ) : ?>
                <li class="page"><?php echo wp_kses_post( $value ) ?></li>
            <?php endforeach; ?>
        </ul>
        <?php
    }

    /**
     * Load More Button
     *
     * @param boolean $data
     * @param string $button_text
     * @param boolean $icon
     * @return void
     */
    public static function load_more( $data = false, $button_opt = [] ) {
        $button_text = ! empty( $button_opt['text'] ) ? $button_opt['text'] : __( "Load More", 'benzo' );
        $button_url  = ! empty( $button_opt['url'] ) ? $button_opt['url'] : '';

        $data  = htmlspecialchars( json_encode( $data ), ENT_QUOTES, 'UTF-8' );
        $nonce = wp_create_nonce( 'benzo-load-more' );

        if( 'yes' === $button_opt['ajax'] ) {
            $button_url = '#';
        }
        ?>
        <a href="<?php echo esc_url( $button_url ) ?>" class="load-more-btn">
            <span><?php echo esc_html( $button_text ) ?></span>
            <i class="far fa-angle-double-right"></i>
        </a>
        <?php if( 'yes' === $button_opt['ajax'] ) : ?>
            <span class="ajax-load-data" data-ajax_data="<?php echo esc_attr( $data ) ?>" data-nonce="<?php echo esc_attr( $nonce ) ?>"></span>
        <?php endif; ?>
        <?php
    }
}