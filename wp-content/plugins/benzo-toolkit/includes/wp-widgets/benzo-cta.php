<?php



if ( ! defined( 'ABSPATH' ) ) {
    exit( 'No direct script access allowed' );
}

if ( class_exists( 'CSF' ) ) {
    CSF::createWidget( 'benzo_cta_widget', [
        'title'       => esc_html__( '*Benzo CTA', 'benzo-toolkit' ),
        'classname'   => 'benzo-cta',
        'description' => esc_html__( 'Show CTA', 'benzo-toolkit' ),
        'fields'      => [
            [
                'id'      => 'title',
                'type'    => 'text',
                'title'   => esc_html( 'CTA Title', 'benzo-toolkit' ),
                'default' => esc_html__( 'CTA Title', 'benzo-toolkit' ),
            ],
            [
                'id'      => 'widget_cta_thumb',
                'type'    => 'media',
                'title'   => esc_html__( 'CTA Image', 'benzo-toolkit' ),
                'library' => 'image',
                'url'     => false,
            ],
            [
                'id'      => 'cta_button_text',
                'type'    => 'text',
                'title'   => esc_html( 'CTA Button Title', 'benzo-toolkit' ),
                'default' => esc_html__( 'CTA Button Title', 'benzo-toolkit' ),
            ],
            [
                'id'      => 'cta_button_url',
                'type'    => 'text',
                'title'   => esc_html( 'CTA Button URL', 'benzo-toolkit' ),
                'default' => esc_html__( '#', 'benzo-toolkit' ),
            ],

        ],
    ] );

    function benzo_cta_widget( $args, $instance ) {

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
            'a'  => [
                'class' => [],
            ],
            'href'  => [

            ],
            'target'  => [

            ],
        ];

        echo wp_kses( $args['before_widget'], $allowed_html );

        $cta_thumb = ($instance['widget_cta_thumb']);

        ?>

        <div class="benzo-widget-cta">
            <div class="widget-cta-thumb">
                <img src="<?php echo esc_attr($cta_thumb['url']); ?>" alt="<?php echo esc_html( get_bloginfo() ) ?>">
                <div class="widget-cta-content">
                <?php if (!empty($instance['title'])) : ?>
                <div class="widget-cta-title">
                    <h2><?php echo esc_html($instance['title']); ?></h2>
                </div>
                <?php endif; ?>
                <div class="widget-cta-btn">
                  <a class="cta-btn" href="<?php echo esc_url($instance['cta_button_url']); ?>">
                      <?php echo wp_kses($instance['cta_button_text'],$allowed_html); ?>
                  </a>
                </div>
                </div>
            </div>
        </div>

        <?php echo wp_kses( $args['after_widget'], $allowed_html );
    }
}