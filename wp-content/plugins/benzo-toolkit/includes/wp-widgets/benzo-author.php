<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit( 'No direct script access allowed' );
}

if ( class_exists( 'CSF' ) ) {
    CSF::createWidget( 'benzo_author_widget', [
        'title'       => esc_html__( '*Benzo Authors', 'benzo-toolkit' ),
        'classname'   => 'benzo-authors',
        'description' => esc_html__( 'Show Authors', 'benzo-toolkit' ),
        'fields'      => [
            [
                'id'      => 'title',
                'type'    => 'text',
                'title'   => esc_html( 'Title', 'benzo-toolkit' ),
                'default' => esc_html__( 'Best Author', 'benzo-toolkit' ),
            ],
            [
                'id'      => 'author_from',
                'label'   => esc_html__( 'User From', 'benzo-toolkit' ),
                'type'    => 'select',
                'options' => [
                    'all'           => esc_html__( 'All', 'benzo-toolkit' ),
                    'specific-rule' => esc_html__( 'Specific Rule', 'benzo-toolkit' ),
                ],
                'default' => 'all',
            ],
            [
                'id'         => 'role_in',
                'type'       => 'select',
                'title'      => esc_html__( 'Role in', 'benzo-toolkit' ),
                'chosen'     => true,
                'multiple'   => true,
                'options'    => [
                    'administrator' => esc_html__( 'Administrator', 'benzo-toolkit' ),
                    'editor'        => esc_html__( 'Editor', 'benzo-toolkit' ),
                    'author'        => esc_html__( 'Author', 'benzo-toolkit' ),
                    'contributor'   => esc_html__( 'Contributor', 'benzo-toolkit' ),
                    'subscriber'    => esc_html__( 'Subscriber', 'benzo-toolkit' ),
                ],
                'default'    => 'author',
                'dependency' => ['author_from', '==', 'specific-rule'],
            ],
            [
                'id'      => 'order',
                'type'    => 'select',
                'title'   => esc_html__( 'Order', 'benzo-toolkit' ),
                'options' => [
                    'ASC'  => esc_html__( 'ASC', 'benzo-toolkit' ),
                    'DESC' => esc_html__( 'DESC', 'benzo-toolkit' ),
                ],
                'default' => 'ASC',
            ],
        ],
    ] );

    function benzo_author_widget( $args, $instance ) {
        $user_args = [
            'order' => $instance['order'],
        ];

        if ( 'specific-rule' === $instance['author_from'] && $instance['role_in'] ) {
            $user_args['role__in'] = $instance['role_in'];
        }

        $authors = get_users( $user_args );

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

        ?>

        <div class="benzo-authors">
            <?php foreach ( $authors as $author ): ?>
                <div class="benzo-author">
                    <h6 class="name">
                        <a href="<?php echo get_author_posts_url( $author->ID ) ?>"><?php echo esc_html( $author->display_name ) ?></a>
                    </h6>
                    <?php
                        $author_meta = get_user_meta( $author->ID, 'benzo_user_meta', true );

                        if ( isset( $author_meta['user_profile_image'] ) ) {
                            $thumbnail_id = $author_meta['user_profile_image']['id'];
                        } else {
                            $thumbnail_id = '';
                        }
                        if( $thumbnail_id ) :
                    ?>
                        <div class="thumbnail">
                            <img src="<?php echo wp_get_attachment_image_url( $thumbnail_id, 'medium' ) ?>" alt="<?php echo esc_html( $author->display_name ) ?>">
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <?php echo wp_kses( $args['after_widget'], $allowed_html );
    }
}