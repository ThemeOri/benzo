<?php
namespace BenzoToolkit\ElementorAddon\Helper;

use Elementor\Controls_Manager;
use WP_Query;

/**
 * Benzo Query Builder
 */
if ( ! class_exists( 'Benzo_Query_Builder' ) ) {
    class Benzo_Query_Builder {
        /**
         * Render Loop OPtions
         */
        public static function render_loop_options( $self, $array = [] ) {

            if ( ! $self ) {
                return;
            }

            $self->start_controls_section(
                'query_section',
                [
                    'label' => esc_html__( 'Query', 'benzo-toolkit' ),
                ]
            );

            $self->add_control(
                'number_of_posts',
                [
                    'label'   => esc_html__( 'Post count', 'benzo-toolkit' ),
                    'type'    => Controls_Manager::NUMBER,
                    'default' => 5,
                    'min'     => 1,
                    'step'    => 1,
                ]
            );

            $self->add_control(
                'order_by',
                [
                    'label'   => esc_html__( 'Order by', 'benzo-toolkit' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'date',
                    'options' => [
                        'date'          => esc_html__( 'Date', 'benzo-toolkit' ),
                        'title'         => esc_html__( 'Title', 'benzo-toolkit' ),
                        'author'        => esc_html__( 'Author', 'benzo-toolkit' ),
                        'modified'      => esc_html__( 'Modified', 'benzo-toolkit' ),
                        'rand'          => esc_html__( 'Random', 'benzo-toolkit' ),
                        'comment_count' => esc_html__( 'Comments', 'benzo-toolkit' ),
                        'menu_order'    => esc_html__( 'Menu Order', 'benzo-toolkit' ),
                    ],
                ]
            );

            $self->add_control(
                'order',
                [
                    'label'   => esc_html__( 'Order', 'benzo-toolkit' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'DESC',
                    'options' => [
                        'DESC' => esc_html__( 'Descending', 'benzo-toolkit' ),
                        'ASC'  => esc_html__( 'Ascending', 'benzo-toolkit' ),
                    ],
                ]
            );

            if ( ! isset( $array['hide_cats'] ) ) {
                $self->add_control(
                    'hr_cats',
                    [
                        'type' => Controls_Manager::DIVIDER,
                    ]
                );
                $self->add_control(
                    'categories',
                    [
                        'label'       => esc_html__( 'Filter By Category', 'benzo-toolkit' ),
                        'type'        => Controls_Manager::SELECT2,
                        'multiple'    => true,
                        'label_block' => true,
                        'options'     => self::categories_suggester(),
                    ]
                );
                $self->add_control(
                    'exclude_categories',
                    [
                        'label'        => esc_html__( 'Exclude These Categories', 'benzo-toolkit' ),
                        'type'         => Controls_Manager::SWITCHER,
                        'label_on'     => esc_html__( 'On', 'benzo-toolkit' ),
                        'label_off'    => esc_html__( 'Off', 'benzo-toolkit' ),
                        'return_value' => 'yes',
                        'description'  => esc_html__( 'Leave empty for all', 'benzo-toolkit' ),
                    ]
                );
            }

            if ( ! isset( $array['hide_tags'] ) ) {
                $self->add_control(
                    'hr_tags',
                    [
                        'type' => Controls_Manager::DIVIDER,
                    ]
                );

                $self->add_control( 'tags',
                    [
                        'label'       => esc_html__( 'Filter By Tags Slug', 'benzo-toolkit' ),
                        'type'        => Controls_Manager::SELECT2,
                        'multiple'    => true,
                        'label_block' => true,
                        'options'     => self::tags_suggester(),
                    ]
                );

            }

            if ( ! isset( $array['hide_individual_posts'] ) ) {
                $self->add_control(
                    'hr_posts',
                    ['type' => Controls_Manager::DIVIDER]
                );

                $self->add_control(
                    'by_posts',
                    [
                        'label'       => esc_html__( 'Individual Posts', 'benzo-toolkit' ),
                        'type'        => Controls_Manager::SELECT2,
                        'multiple'    => true,
                        'label_block' => true,
                        'options'     => self::by_posts_suggester( ['post_type' => 'post'] ),
                    ]
                );

            }

            $self->add_control(
                'hr_author',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $self->add_control( 'author',
                [
                    'label'       => esc_html__( 'Author', 'benzo-toolkit' ),
                    'type'        => Controls_Manager::SELECT2,
                    'multiple'    => true,
                    'label_block' => true,
                    'options'     => self::by_author_suggester(),
                ]
            );

            $self->end_controls_section();
        }

        /**
         * Get Term Parents
         */
        public static function get_term_parents_list( $term_id, $taxonomy, $args = [] ) {
            $list = '';
            $term = get_term( $term_id, $taxonomy );

            if ( is_wp_error( $term ) ) {
                return $term;
            }

            if ( ! $term ) {
                return $list;
            }

            $term_id = $term->term_id;

            $defaults = [
                'format'    => 'name',
                'separator' => '/',
                'inclusive' => true,
            ];

            $args = wp_parse_args( $args, $defaults );

            foreach ( ['inclusive'] as $bool ) {
                $args[$bool] = wp_validate_boolean( $args[$bool] );
            }

            $parents = get_ancestors( $term_id, $taxonomy, 'taxonomy' );

            if ( $args['inclusive'] ) {
                array_unshift( $parents, $term_id );
            }

            $a = count( $parents ) - 1;
            foreach ( array_reverse( $parents ) as $index => $term_id ) {
                $parent      = get_term( $term_id, $taxonomy );
                $temp_sep    = $args['separator'];
                $lastElement = reset( $parents );
                $first       = end( $parents );

                if ( $index == $a - 1 ) {
                    $temp_sep = '';
                }
                if ( $term_id != $lastElement ) {
                    $name = $parent->name;
                    $list .= $name . $temp_sep;
                }
            }

            return $list;
        }

        /**
         * Get All Categories
         */
        public static function categories_suggester() {
            $content = [];

            $categories = get_categories();
            foreach ( $categories as $cat ) {
                $args = [
                    'separator' => ' > ',
                    'format'    => 'name',
                ];
                $parent = self::get_term_parents_list( $cat->cat_ID, 'category', [] );

                $content[(string) $cat->slug] = $cat->cat_name . ( ! empty( $parent ) ? esc_html__( ' (Parent categories: (', 'benzo-toolkit' ) . $parent . '))' : "" );
            }
            return $content;
        }

        /**
         * Get All Tags
         */
        public static function tags_suggester() {

            $content = [];
            $tags    = get_tags();
            foreach ( $tags as $tag ) {
                $content[(string) $tag->slug] = $tag->name;
            }

            return $content;
        }

        /**
         * Get List Of All Post
         */
        public static function by_posts_suggester( $array ) {
            $content = [];
            $args    = [];

            if ( ! isset( $array['post_type'] ) ) {
                $args['post_type'] = 'any';
            } else {
                $args['post_type'] = $array['post_type'];
            }

            $args['numberposts'] = -1;
            $posts               = get_posts( $args );
            foreach ( $posts as $post ) {
                $content[$post->post_name] = $post->post_title;
            }
            return $content;
        }

        /**
         * Get List of Author
         */
        public static function by_author_suggester() {
            $content = [];
            $users   = get_users();
            foreach ( $users as $user ) {
                $content[(string) $user->ID] = (string) $user->data->user_nicename;
            }
            return $content;
        }

        /**
         * Build The Query
         */
        public static function build_query( $options ) {
            global $paged;

            $args = [
                'post_type'   => 'post',
                'post_status' => 'publish',
            ];

            $args['posts_per_page'] = 'All' === $options['number_of_posts'] ? -1 : (int) $options['number_of_posts'];
            $args['orderby']        = $options['order_by'];
            $args['order']          = $options['order'];

            if ( 'yes' === $options['hide_sticky_post'] ) {
                $args['ignore_sticky_posts'] = 1;
            }

            if ( ! empty( $options['categories'] ) ) {
                if ( 'yes' === $options['exclude_categories'] ) {
                    $id_list = [];
                    foreach ( (array) $options['categories'] as $key => $value ) {
                        $idObj     = get_term_by( 'slug', $value, 'category' );
                        $id_list[] = (int) $idObj->term_id;
                    }
                    $args['category__not_in'] = $id_list;
                } else {
                    $args['category_name'] = implode( ", ", (array) $options['categories'] );
                }
            }

            if ( ! empty( $options['tags'] ) ) {
                if ( 'yes' === $options['exclude_tags'] ) {
                    $id_list = [];

                    foreach ( (array) $options['tags'] as $key => $value ) {
                        $idObj     = get_term_by( 'slug', $value, 'post_tag' );
                        $id_list[] = (int) $idObj->term_id;
                    }

                    $args['tag__not_in'] = $id_list;
                } else {
                    $args['tag_slug__in'] = (array) $options['tags'];
                }
            }

            if ( ! empty( $options['by_posts'] ) ) {
                if ( 'yes' === $options['exclude_any'] ) {
                    $id_list = [];

                    $list = new WP_Query( [
                        'post_type'     => 'post',
                        'post_name__in' => $options['by_posts'],
                    ] );

                    foreach ( $list->posts as $obj ) {
                        $id_list[] = $obj->ID;
                    }

                    $args['post__not_in'] = $id_list;
                } else {
                    $args['post_name__in'] = (array) $options['by_posts'];
                }
            }

            if ( ! empty( $options['author'] ) ) {
                if ( 'yes' === $options['exclude_author'] ) {
                    $args['author__not_in'] = (array) $options['author'];
                } else {
                    $args['author'] = implode( ", ", (array) $options['author'] );
                }
            }

            if ( empty( $paged ) ) {
                $paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
            }

            $args['paged'] = $paged;

            $output = new WP_Query( $args );

            return $output;
        }
    }
}