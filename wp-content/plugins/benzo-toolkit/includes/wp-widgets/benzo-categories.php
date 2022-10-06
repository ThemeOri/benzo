<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit( 'No direct script access allowed' );
}

if ( class_exists( 'CSF' ) ) {
    CSF::createWidget( 'benzo_categories_widget', [
        'title'       => esc_html__( '*Benzo Categories', 'benzo-toolkit' ),
        'classname'   => 'benzo-categories-wrap',
        'description' => esc_html__( 'Show categories', 'benzo-toolkit' ),
        'fields'      => [
            [
                'id'      => 'title',
                'type'    => 'text',
                'title'   => esc_html( 'Title', 'benzo-toolkit' ),
                'default' => esc_html__( 'Category', 'benzo-toolkit' ),
            ],
            [
                'id'=> 'selected_categories',
                'type'    => 'select',
                'title'      => esc_html__( 'Select Categories', 'benzo-toolkit' ),
                'chosen'     => true,
                'multiple'   => true,
                'options'    => benzo_categories_list()
            ]
        ],
    ] );

    function benzo_categories_widget( $args, $instance ) {
        $allowed_html = [
            'div' => [
                'id'    => [],
                'class' => [],
            ],
            'h3'  => [
                'class' => [],
            ],
            'h4'  => [
                'class' => [],
            ],
            'h5'  => [
                'class' => [],
            ],
            'h6'  => [
                'class' => [],
            ],
        ];

        echo wp_kses( $args['before_widget'], $allowed_html );

        if ( ! empty( $instance['title'] ) ) {
            echo wp_kses( $args['before_title'], $allowed_html ) . apply_filters( 'widget_title', $instance['title'] ) . wp_kses( $args['after_title'], $allowed_html );
        }

        if ( $instance['selected_categories'] ) {
            $categories = $instance['selected_categories'];
        } else {
            $categories = get_terms( [
                'taxonomy' => 'category',
            ] );
        }

        ?>

        <div class="benzo-categories">
            <?php foreach ( $categories as $category ):
                if ( $instance['selected_categories'] ) {
                    $category = get_term_by( 'slug', $category, 'category' );
                }
                $category_meta = get_term_meta( $category->term_id, 'benzo_category_meta', true );

                if ( isset( $category_meta['category_icon'] ) ) {
                    $icon = $category_meta['category_icon'];
                } else {
                    $icon = '';
                }
                if ( isset( $category_meta['category_color'] ) ) {
                    $bg = $category_meta['category_color'];
                } else {
                    $bg = '';
                }
                ?>
                <div class="category-item">
                    <a href="<?php echo esc_url( get_term_link( $category ) ) ?>" <?php if( $bg ) : ?>style="background-color: <?php echo esc_attr( $bg ) ?>"<?php endif; ?>>
                        <?php
                            if ( $icon ) {
                                echo '<i class="' . esc_attr( $icon ) . '"></i>';
                            }

                            echo esc_html( $category->name )

                        ?>
                    </a>
                </div>
                <?php
            endforeach; ?>
        </div>

        <?php echo wp_kses( $args['after_widget'], $allowed_html );
    }
}

function benzo_categories_list() {
    $terms = get_terms( [
        'taxonomy'   => 'category',
        'hide_empty' => true,
    ] );

    $options = [];

    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
        foreach ( $terms as $term ) {
            $options[$term->slug] = $term->name;
        }
    }

    return $options;
}