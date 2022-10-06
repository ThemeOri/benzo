<?php
namespace BenzoToolkit\ElementorAddon\Helper;

use BenzoTheme\Classes\Benzo_Helper;
use BenzoTheme\Classes\Benzo_Post_Helper;

/**
 * Benzo Query Builder
 */
if ( ! class_exists( 'Benzo_Post_Templates' ) ) {
    class Benzo_Post_Templates {

        /**
         * Render Common Category Markup
         */
        public static function post_category( $idd ) {
            if ( ! $idd ) {
                $idd = get_the_ID();
            }

            $categories = get_the_category( $idd );

            if ( $categories ): ?>
            <div class="post-categories">
                <?php
                    foreach ( $categories as $category ) {
                        $category_meta = get_term_meta( $category->term_id, 'benzo_category_meta', true );

                        if( isset($category_meta['category_color']) ){
                            $color = $category_meta['category_color'];
                        } else {
                            $color = '';
                        }

                        if ( $color ) {
                            printf( '<a href="%1$s" style="background-color: %2$s">%3$s</a>',
                                esc_url( get_category_link( $category->term_id ) ),
                                esc_attr( $color ),
                                esc_html( $category->cat_name )
                            );
                        } else {
                            printf( '<a href="%1$s">%2$s</a>',
                                esc_url( get_category_link( $category->term_id ) ),
                                esc_html( $category->cat_name )
                            );
                        }
                    }
                ?>
            </div>
            <?php endif;
        }

        /**
         * Post Author Date
         */
        public static function post_author_date( $date_options ) {
            $author_meta = get_user_meta( get_the_author_meta( 'ID' ), 'benzo_user_meta', true );

            if ( isset( $author_meta['user_profile_image'] ) ) {
                $thumbnail_id = $author_meta['user_profile_image']['id'];
            } else {
                $thumbnail_id = '';
            }

            ?>
            <div class="post-author-date">
                <?php if( 'yes' == $date_options['show_author']  ) : ?>
                    <?php if( 'meta-design-one' == $date_options['meta_design'] ) : ?>
                    <div class="author-photo">
                        <?php echo wp_get_attachment_image( $thumbnail_id, 'thumbnail' ) ?>
                    </div>
                    <?php endif; ?>
                <div class="author-info">
                    <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="author-name">
                        <?php
                            if( 'meta-design-two' == $date_options['meta_design'] ) {
                                esc_html_e( 'By ', 'benzo-toolkit' );
                            }
                            echo esc_html( get_the_author_meta( 'display_name' ) );
                        ?>
                    </a>
                    <?php if( 'yes' == $date_options['show_date']  ) : ?>
                    <span class="post-date">
                        <?php
                            if( 'meta-design-two' == $date_options['meta_design'] ) {
                                echo '<i class="far fa-calendar-alt"></i>';
                            }
                        ?>
                        <?php echo esc_html( get_the_time( get_option( 'date_format' ) ) ); ?>
                    </span>
                    <?php endif; ?>
                </div>
                <?php elseif(  'yes' != $date_options['show_author'] && 'yes' == $date_options['show_date']  ) : ?>
                    <span class="post-date"><?php echo esc_html( get_the_time( get_option( 'date_format' ) ) ); ?></span>
                <?php endif; ?>
            </div>
            <?php
        }

        /**
         * Render Post Box
         */
        public static function render_post_box( $options ) {
            $post_id     = get_the_ID();
            $box_class = ['benzo-post-box', $options['post_layout'], $options['meta_design']];
            $post_format = Benzo_Helper::get_meta( 'benzo_post_meta', 'post_format', 'standard', $post_id );
            $box_class[] = 'post-format-' . $post_format;
            $excerpt_word = $options['excerpt_word'] ? $options['excerpt_word'] : 25;
            ?>
            <div class="<?php echo esc_attr( implode( ' ', $box_class ) ) ?>">
                <?php Benzo_Post_Helper::render_media( $post_id, $options['thumbnail_size'] ); ?>
                <div class="post-content">
                    <?php
                        if ( 'meta-design-three' !== $options['meta_design'] && 'yes' === $options['show_category'] ) {
                            self::post_category( $post_id );
                        }

                        if ( 'meta-design-three' === $options['meta_design'] ) : ?>
                            <div class="post-meta">
                                <?php  if( 'yes' === $options['show_date'] ) : ?>
                                <span class="post-date">
                                    <?php echo esc_html( get_the_time( get_option( 'date_format' ) ) ); ?>
                                </span>
                                <?php endif; ?>
                                <?php if( 'yes' === $options['show_author'] ) : ?>
                                <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="author-name">
                                    <?php
                                        esc_html_e( 'By ', 'benzo-toolkit' );
                                        echo esc_html( get_the_author_meta( 'display_name' ) );
                                    ?>
                                </a>
                                <?php endif; ?>
                                <?php
                                    if ( 'yes' === $options['show_category'] ) {
                                        self::post_category( $post_id );
                                    }
                                ?>
                            </div>
                        <?php endif;

                        if ( $options['title_word'] ) {
                            $title = wp_trim_words( get_the_title(), $options['title_word'], '..' );
                        } else {
                            $title = get_the_title();
                        }

                        printf( '<%1$s class="post-title"><a href="%2$s">%3$s</a></%1$s>',
                            tag_escape( $options['title_tag'] ),
                            esc_url( get_the_permalink() ),
                            wp_kses_post( $title )
                        );

                        if( 'yes' === $options['show_excerpt'] ) {
                            if( has_excerpt() ) {
                                $content = get_the_excerpt();
                            } else {
                                $content = get_the_content();
                            }

                            if ( $excerpt_word ) {
                                echo wpautop( esc_html( wp_trim_words( $content, $options['excerpt_word'] ) ) );
                            } else {
                                echo wpautop( esc_html( $content ) );
                            }
                        }

                        if( 'meta-design-three' !== $options['meta_design'] ) {
                            if( 'yes' === $options['show_author'] || 'yes' === $options['show_date'] ) {
                                $date_options = [
                                    'meta_design' => $options['meta_design'],
                                    'show_author' => $options['show_author'],
                                    'show_date' => $options['show_date'],
                                ];
                                self::post_author_date( $date_options );
                            }
                        }

                        if ( 'yes' === $options['show_read_more'] && !empty( $options['read_more_text'] ) ) {
                            printf( '<a href="%1$s" class="read-more">%2$s <i class="fas fa-angle-double-right"></i></a>',
                                esc_url( get_the_permalink() ),
                                esc_html( $options['read_more_text'] )
                            );
                        }
                    ?>
                </div>
            </div>
            <?php
        }

        /**
         * Masonry Layout One
         */
        public static function masonry_layout_one( $query, $options ) {
            $index = 0;
            $last  = count( $query->posts );
            $item  = 0;
            if( $query->have_posts() ) :
                while ( $query->have_posts() ): $query->the_post();
                    $index ++;
                    $item ++;

                    if ( 4 < $item ) {
                        $item = 1;
                    }

                    if ( 1 == $item ) {
                        echo '<div class="col-lg-4 long-post">';
                    } elseif ( 2 == $item ) {
                        echo '<div class="col-lg-8">';
                    }

                    if ( 2 == $item ) {
                        echo '<div class="row">';
                        if ( 'layout-six' === $options['masonry_layout'] ) {
                            echo '<div class="col-12 wide-post order-last">';
                        } else {
                            echo '<div class="col-12 wide-post order-last order-lg-first">';
                        }
                    }

                    if ( 3 == $item || 4 == $item ) {
                        echo '<div class="col-md-6 small-post">';
                    }

                    self::render_post_box( $options );

                    if ( 2 == $item || 3 == $item || 4 == $item ) {
                        echo '</div>';
                    }

                    if ( 4 == $item || $index == $last ) {
                        echo '</div>';
                    }

                    if ( 1 == $item ) {
                        echo '</div>';
                    } elseif( 4 == $item || $index == $last) {
                        echo '</div>';
                    }
                endwhile;
                wp_reset_query();
            endif;
        }

        /**
         * Masonry Layout Two
         */
        public static function masonry_layout_two( $query, $options ) {
            $index = 0;
            $item  = 0;
            if( $query->have_posts() ) :
                while ( $query->have_posts() ): $query->the_post();
                    $index ++;
                    $item ++;

                    if ( 6 < $item ) {
                        $item = 1;
                    }

                    if ( 5 != $item && 6 != $item ) {
                        echo '<div class="col-lg-3 col-md-6 small-post">';
                    } else {
                        echo '<div class="col-lg-6 col-md-6 wide-post">';
                    }

                    self::render_post_box( $options );

                    echo '</div>';

                endwhile;
                wp_reset_query();
            endif;
        }

        /**
         * Masonry Layout Three
         */
        public static function masonry_layout_three( $query, $options ) {
            $index = 0;
            $last  = count( $query->posts );
            $item  = 0;
            if( $query->have_posts() ) :
                while ( $query->have_posts() ): $query->the_post();
                    $index ++;
                    $item ++;

                    if ( 5 < $item ) {
                        $item = 1;
                    }

                    if ( 1 == $item ) {
                        $options['post_layout'] = 'image-background';
                    } else {
                        $options['post_layout'] = 'normal-layout';
                    }

                    if ( 1 == $item ) {
                        echo '<div class="col-lg-6 long-post">';
                    } elseif ( 2 == $item ) {
                        echo '<div class="col-lg-6 small-post">';
                    }

                    if ( 2 == $item ) {
                        echo '<div class="row">';
                        echo '<div class="col-md-6">';
                    }

                    if ( 3 == $item || 4 == $item || 5 == $item ) {
                        echo '<div class="col-md-6">';
                    }

                    self::render_post_box( $options );

                    if ( 2 == $item || 3 == $item || 4 == $item || 5 == $item ) {
                        echo '</div>';
                    }

                    if ( 5 == $item || $index == $last ) {
                        echo '</div>';
                    }

                    if ( 1 == $item || 5 == $item || $index == $last ) {
                        echo '</div>';
                    }
                endwhile;
                wp_reset_query();
            endif;
        }

        /**
         * Masonry Layout Four
         */
        public static function masonry_layout_four( $query, $options ) {
            $index = 0;
            $last  = count( $query->posts );
            $item  = 0;
            if( $query->have_posts() ) :
                while ( $query->have_posts() ): $query->the_post();
                    $index ++;
                    $item ++;

                    if ( 6 < $item ) {
                        $item = 1;
                    }

                    if ( 1 == $item ) {
                        $options['post_layout'] = 'normal-layout';
                    } else {
                        $options['post_layout'] = 'image-left';
                        $options['show_excerpt'] = 'no';
                        $options['thumbnail_size'] = 'thumbnail';
                    }

                    if ( 1 == $item ) {
                        echo '<div class="col-lg-6 long-post">';
                    } elseif ( 2 == $item ) {
                        echo '<div class="col-lg-6 small-post">';
                    }

                    self::render_post_box( $options );

                    if ( 1 == $item || 6 == $item || $index == $last ) {
                        echo '</div>';
                    }
                endwhile;
                wp_reset_query();
            endif;
        }

        /**
         * Masonry Layout Five
         */
        public static function masonry_layout_five( $query, $options ) {
            $index = 0;
            $last  = count( $query->posts );
            $item  = 0;
            $options['post_layout'] = 'normal-layout';
            $original_size  = $options['thumbnail_size'];

            if( $query->have_posts() ) :
                while ( $query->have_posts() ): $query->the_post();
                    $index ++;
                    $item ++;

                    if ( 9 < $item ) {
                        $item = 1;
                    }

                    if ( 1 == $item || 6 == $item  ) {
                        echo '<div class="col-lg-3 col-md-6 small-post">';
                    } elseif( 5 == $item ) {
                        echo '<div class="col-lg-6 wide-post">';
                    }

                    if ( 5 == $item ) {
                        $options['show_excerpt'] = 'yes';
                    } else {
                        $options['show_excerpt'] = 'no';
                    }

                    if( 1 == $item || 5 == $index || 6 == $item ) {
                        $options['thumbnail_size'] =  $original_size;
                    } else {
                        $options['thumbnail_size'] =  'thumbnail';
                    }

                    self::render_post_box( $options );

                    if ( 4 == $item || 5 == $item || 9 == $item || $index == $last ) {
                        echo '</div>';
                    }

                endwhile;
                wp_reset_query();
            endif;
        }

        /**
         * Masonry Layout Seven
         */
        public static function masonry_layout_seven( $query, $options ) {
            $index           = 0;
            $last            = count( $query->posts );
            $item            = 0;
            $original_layout = $options['post_layout'];

            if( $query->have_posts() ) :
                while ( $query->have_posts() ): $query->the_post();
                    $index ++;
                    $item ++;

                    if ( 5 < $item ) {
                        $item = 1;
                    }

                    if ( 3 == $item ) {
                        $options['post_layout'] = 'normal';
                    } else {
                        $options['post_layout'] = $original_layout;
                    }

                    if ( 1 == $item || 4 == $item  ) {
                        echo '<div class="col-lg-3 col-md-6 small-post">';
                    } elseif( 3 == $item ) {
                        echo '<div class="col-lg-6 wide-post">';
                    }

                    self::render_post_box( $options );

                    if ( 2 == $item || 3 == $item || 5 == $item || $index == $last ) {
                        echo '</div>';
                    }

                endwhile;
                wp_reset_query();
            endif;
        }

        /**
         * Render Pagination
         */
        public static function render_pagination( $query, $options, $pagination_opt ) {
            ?>
            <div class="load-more-btn-wrap">
                <?php
                    if ( 'pagination' === $pagination_opt['type'] ) {
                        Benzo_Post_Helper::pagination( $query );
                    } elseif ( 'load-more' === $pagination_opt['type'] ) {
                        $data = [
                            'options' => $options,
                            'query'   => $query->query,
                        ];
                        Benzo_Post_Helper::load_more( $data, $pagination_opt );
                    }
                ?>
            </div>
            <?php
        }

        /**
         * Render Post Boxes
         */
        public static function render_post_boxes( $settings, $slider = false ) {
            $query = Benzo_Query_Builder::build_query( $settings );

            $options = [
                'post_layout'    => $settings['post_layout'],
                'meta_design'    => $settings['meta_design'],
                'show_category'  => $settings['show_category'],
                'show_date'      => $settings['show_date'],
                'show_author'    => $settings['show_author'],
                'show_excerpt'   => $settings['show_excerpt'],
                'excerpt_word'   => $settings['excerpt_word'],
                'title_word'     => $settings['title_word'],
                'title_tag'      => $settings['title_tag'],
                'show_read_more' => $settings['show_read_more'],
                'read_more_text' => $settings['read_more_text'],
                'thumbnail_size' => $settings['thumbnail_size'],
            ];

            $wrapper_class = ['benzo-post-boxes'];
            $row_class     = [];
            $column        = '';
            $data_array    = [];

            if ( $slider ) {
                $row_class[]  = 'benzo-post-slider';
                $column       = ['post-slider-item'];
                $data_array[] = 'data-desktop-column = ' . $settings['desktop_column'];
                $data_array[] = 'data-tab-column = ' . $settings['tab_column'];
                $data_array[] = 'data-mobile-column = ' . $settings['mobile_column'];
                $data_array[] = 'data-arrow = ' . $settings['arrow'];
                $data_array[] = 'data-dots = ' . $settings['dots'];
                $data_array[] = 'data-autoplay = ' . $settings['autoplay'];
                $data_array[] = 'data-autoplay-time = ' . $settings['autoplay_time'];
            } else {
                $row_class[] = 'row';
                $column    = [$settings['desktop_column'], $settings['tab_column'], $settings['mobile_column']];
            }

            if ( 'load-more' === $settings['navigation_type'] && 'yes' === $settings['button_ajax'] ) {
                $wrapper_class[]   = 'has-ajax-load-more';
                $row_class[] = 'append-ajax-posts';

                $options['column'] = $column;
            }

            ?>
            <div class="<?php echo esc_attr( implode( ' ', $wrapper_class ) ) ?>">
                <div class="<?php echo esc_attr( implode( ' ', $row_class ) ) ?>" <?php echo esc_attr( implode( ' ', $data_array ) ) ?>>
                    <?php
                        if( $query->have_posts() ) :
                            while ( $query->have_posts() ): $query->the_post(); ?>
                                <div class="<?php echo esc_attr( implode( ' ', $column ) ) ?>">
                                    <?php self::render_post_box( $options ); ?>
                                </div>
                            <?php endwhile;
                            wp_reset_query();
                        endif;
                    ?>
                </div>
                <?php
                    if( 'none' !== $settings['navigation_type'] ) {
                        $pagination_opt = [
                            'type' => $settings['navigation_type'],
                            'ajax' => $settings['button_ajax'],
                            'text' => $settings['button_text'],
                            'url'  => '',
                        ];
                        if ( 'yes' !== $settings['button_ajax'] ) {
                            $pagination_opt['url'] = $settings['button_url']['url'];
                        }
                        self::render_pagination( $query, $options, $pagination_opt);
                    }

                    if ( $slider ) {
                        echo '<div class="post-slider-arrows '. $settings['arrow_position'] .'"></div>';
                        echo '<div class="post-slider-dots '. $settings['dots_position'] .'"></div>';
                    }
                ?>
            </div>
            <?php
        }

        /**
         * Render Masonry Post
         */
        public static function render_masonry_post( $settings ) {
            $query = Benzo_Query_Builder::build_query( $settings );

            $options = [
                'masonry_layout' => $settings['masonry_layout'],
                'post_layout'    => $settings['post_layout'],
                'meta_design'    => $settings['meta_design'],
                'show_category'  => $settings['show_category'],
                'show_date'      => $settings['show_date'],
                'show_author'    => $settings['show_author'],
                'show_category'  => $settings['show_category'],
                'show_excerpt'   => $settings['show_excerpt'],
                'excerpt_word'   => $settings['excerpt_word'],
                'title_word'     => $settings['title_word'],
                'title_tag'      => $settings['title_tag'],
                'show_read_more' => $settings['show_read_more'],
                'read_more_text' => $settings['read_more_text'],
                'thumbnail_size' => $settings['thumbnail_size'],
            ];

            $wrapper_class = ['benzo-masonry-posts', $settings['masonry_layout']];
            $row_class     = ['row'];

            if ( 'load-more' === $settings['navigation_type'] && 'yes' === $settings['button_ajax'] ) {
                $wrapper_class[] = 'has-ajax-load-more';
                $row_class[]     = 'append-ajax-posts';
            }

            ?>
            <div class="<?php echo esc_attr( implode( ' ', $wrapper_class ) ) ?>">
                <div class="<?php echo esc_attr( implode( ' ', $row_class ) ) ?>">
                    <?php
                        switch ( $settings['masonry_layout'] ) {
                            case 'layout-one':
                            case 'layout-six':
                                self::masonry_layout_one( $query, $options );
                                break;
                            case 'layout-two':
                                self::masonry_layout_two( $query, $options );
                                break;
                            case 'layout-three':
                                self::masonry_layout_three( $query, $options );
                                break;
                            case 'layout-four':
                                self::masonry_layout_four( $query, $options );
                                break;
                            case 'layout-five':
                                self::masonry_layout_five( $query, $options );
                                break;
                            case 'layout-seven':
                                self::masonry_layout_seven( $query, $options );
                                break;
                        }
                    ?>
                </div>
                <?php
                    if( 'none' !== $settings['navigation_type'] ) {
                        $pagination_opt = [
                            'type' => $settings['navigation_type'],
                            'ajax' => $settings['button_ajax'],
                            'text' => $settings['button_text'],
                            'url'  => '',
                        ];
                        if ( 'yes' !== $settings['button_ajax'] ) {
                            $pagination_opt['url'] = $settings['button_url']['url'];
                        }
                        self::render_pagination( $query, $options, $pagination_opt );
                    }
                ?>
            </div>
            <?php
        }

        /**
         * Render Post Tab
         */
        public static function render_post_tab( $query, $options ) {
            if ( 'masonry-layout' === $options['tab_layout'] ) {
                $wrapper_class = 'benzo-masonry-posts' . ' ' . $options['masonry_layout'];
            } else {
                $wrapper_class = 'benzo-post-boxes';
            }
            ?>
            <div class="<?php echo esc_attr( $wrapper_class ) ?>">
                <div class="row">
                    <?php
                        if ( 'masonry-layout' === $options['tab_layout'] ) {
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
                        } elseif( 'grid-layout' === $options['tab_layout'] ) {
                            if( $query->have_posts() ) :
                                while ( $query->have_posts() ): $query->the_post(); ?>
                                    <div class="<?php echo esc_attr( implode( ' ', $options['column'] ) ) ?>">
                                        <?php Benzo_Post_Templates::render_post_box( $options ) ?>
                                    </div>
                                <?php endwhile;
                                wp_reset_query();
                            endif;
                        }
                    ?>
                </div>
            </div>
            <?php
        }
    }
}