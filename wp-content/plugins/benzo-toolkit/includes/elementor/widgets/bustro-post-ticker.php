<?php
namespace BenzoToolkit\ElementorAddon\Widgets;

use BenzoToolkit\ElementorAddon\Helper\Benzo_Query_Builder;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Benzo_Post_Ticker extends Widget_Base {

    /**
     * Retrieve the widget name.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'benzo-post-ticker';
    }

    /**
     * Retrieve the widget title.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Benzo Post Ticker', 'benzo-toolkit' );
    }

    /**
     * Retrieve the widget icon.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-posts-ticker';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return ['benzo_elements'];
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the widget belongs to.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return ['Benzo', 'post', 'ticker', 'trending'];
    }

    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function register_controls() {
        $this->start_controls_section(
            'widget_content',
            [
                'label' => esc_html__( 'General', 'benzo-toolkit' ),
            ]
        );

        $this->add_control(
            'title_word',
            [
                'label'   => esc_html__( 'Title Word', 'benzo-toolkit' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 10,
            ]
        );

        $this->add_control(
            'additional_heading',
            [
                'label'     => esc_html__( 'Additional Options', 'benzo-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label'   => esc_html__( 'Autoplay?', 'benzo-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'true',
                'options' => [
                    'true'  => esc_html__( 'Yes', 'benzo-toolkit' ),
                    'false' => esc_html__( 'No', 'benzo-toolkit' ),
                ],
            ]

        );

        $this->add_control(
            'autoplay_time',
            [
                'label'     => esc_html__( 'Autoplay Time', 'benzo-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => '5000',
                'condition' => [
                    'autoplay' => 'true',
                ],
                'options'   => [
                    '1000'  => esc_html__( '1s', 'benzo-toolkit' ),
                    '2000'  => esc_html__( '2s', 'benzo-toolkit' ),
                    '3000'  => esc_html__( '3s', 'benzo-toolkit' ),
                    '4000'  => esc_html__( '4s', 'benzo-toolkit' ),
                    '5000'  => esc_html__( '5s', 'benzo-toolkit' ),
                    '6000'  => esc_html__( '6s', 'benzo-toolkit' ),
                    '7000'  => esc_html__( '7s', 'benzo-toolkit' ),
                    '8000'  => esc_html__( '8s', 'benzo-toolkit' ),
                    '9000'  => esc_html__( '9s', 'benzo-toolkit' ),
                    '10000' => esc_html__( '10s', 'benzo-toolkit' ),
                    '11000' => esc_html__( '11s', 'benzo-toolkit' ),
                    '12000' => esc_html__( '12s', 'benzo-toolkit' ),
                    '13000' => esc_html__( '13s', 'benzo-toolkit' ),
                    '14000' => esc_html__( '14s', 'benzo-toolkit' ),
                    '15000' => esc_html__( '15s', 'benzo-toolkit' ),
                ],
            ]
        );

        $this->end_controls_section();

        Benzo_Query_Builder::render_loop_options( $this, ['post_type' => 'post'] );

        $this->start_controls_section(
            'single_item_style',
            [
                'label' => esc_html__( 'Post Item', 'benzo-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'item_padding',
            [
                'label'      => esc_html__( 'Padding', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-post-ticker .single-post-ticker' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-post-ticker .single-post-ticker a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label'     => esc_html__( 'Color(Hover)', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-post-ticker .single-post-ticker a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .benzo-post-ticker .single-post-ticker a',
            ]
        );

        $this->add_responsive_control(
            'dots_size',
            [
                'label'      => esc_html__( 'Dots Size', 'benzo-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-post-ticker .single-post-ticker .dots' => 'width: {{SIZE}}px; height: {{SIZE}}px;',
                ],
                'separator'  => 'before',
            ]
        );

        $this->add_responsive_control(
            'dots_gap',
            [
                'label'      => esc_html__( 'Dots Gap', 'benzo-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-post-ticker .single-post-ticker .dots' => 'margin-right: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_control(
            'dots_color',
            [
                'label'     => esc_html__( 'Dots Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-post-ticker .single-post-ticker .dots' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'arrows_style',
            [
                'label' => esc_html__( 'Arrows', 'benzo-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'arrows_width',
            [
                'label'      => esc_html__( 'Width', 'benzo-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-post-ticker .slick-arrow'        => 'width: {{SIZE}}px;',
                    '{{WRAPPER}} .benzo-post-ticker .post-ticker-slider' => 'max-width: calc(100% - (({{SIZE}}px * 2) + 20px));',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrows_height',
            [
                'label'      => esc_html__( 'Height', 'benzo-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-post-ticker .slick-arrow' => 'height: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrows_size',
            [
                'label'      => esc_html__( 'Icon Size', 'benzo-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-post-ticker .slick-arrow' => 'font-size: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_control(
            'arrows_color',
            [
                'label'     => esc_html__( 'Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-post-ticker .slick-arrow' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'arrows_border',
                'selector' => '{{WRAPPER}} .benzo-post-ticker .slick-arrow',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        $data_array = [];
        $data_array[] = 'data-autoplay = ' . $settings['autoplay'];
        $data_array[] = 'data-autoplay-time = ' . $settings['autoplay_time'];

        ?>
        <div class="benzo-post-ticker" <?php echo esc_attr( implode( ' ', $data_array ) ) ?>>
            <div class="post-ticker-slider">
                <?php
                    $query = Benzo_Query_Builder::build_query( $settings );
                    while ( $query->have_posts() ): $query->the_post(); ?>
                    <div class="single-post-ticker">
                        <div class="post-ticker-inner">
                            <span class="dots"></span>
                            <a href="<?php echo esc_url( get_the_permalink() )  ?>">
                                <?php
                                    if ( $settings['title_word'] ) {
                                        $title = wp_trim_words( get_the_title(), $settings['title_word'], '..' );
                                    } else {
                                        $title = get_the_title();
                                    }
                                    echo wp_kses_post( $title )
                                ?>
                            </a>
                        </div>
                    </div>
                    <?php endwhile;
                    wp_reset_query();
                ?>
            </div>
            <div class="post-ticker-arrows">
            </div>
        </div>
        <?php
    }
}