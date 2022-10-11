<?php
namespace BenzoToolkit\ElementorAddon\Widgets;

use BenzoTheme\Classes\Benzo_Post_Helper;
use BenzoToolkit\ElementorAddon\Helper\Benzo_Post_Templates;
use BenzoToolkit\ElementorAddon\Helper\Benzo_Query_Builder;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Benzo_Highlight_Posts extends Widget_Base {

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
        return 'benzo-highlight-posts';
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
        return esc_html__( 'Benzo Highlight Posts', 'benzo-toolkit' );
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
        return 'eicon-kit-details';
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
        return ['Benzo', 'Highlight', 'trending', 'list', 'blog', 'post'];
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
            'widget_design',
            [
                'label'   => esc_html__( 'Design', 'benzo-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'design-one'   => esc_html__( 'Design One', 'benzo-toolkit' ),
                    'design-two'   => esc_html__( 'Design Two', 'benzo-toolkit' ),
                    'design-three' => esc_html__( 'Design Three', 'benzo-toolkit' ),
                ],
                'default' => 'design-one',
            ]
        );

        $this->add_control(
            'show_box_title',
            [
                'label'        => esc_html__( 'Show Title', 'benzo-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'benzo-toolkit' ),
                'label_off'    => esc_html__( 'Hide', 'benzo-toolkit' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        $this->add_control(
            'box_title',
            [
                'label'     => esc_html__( 'Box Title', 'benzo-toolkit' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => esc_html__( 'Highlights', 'benzo-toolkit' ),
                'condition' => [
                    'show_box_title' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_more_button',
            [
                'label'        => esc_html__( 'Show More Button', 'benzo-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'benzo-toolkit' ),
                'label_off'    => esc_html__( 'Hide', 'benzo-toolkit' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        $this->add_control(
            'box_btn_link',
            [
                'label'       => esc_html__( 'Button Link', 'benzo-toolkit' ),
                'type'        => Controls_Manager::URL,
                'label_block' => true,
                'condition'   => [
                    'show_more_button' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'box_btn_text',
            [
                'label'     => esc_html__( 'Button Text', 'benzo-toolkit' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => esc_html__( 'More Posts', 'benzo-toolkit' ),
                'condition' => [
                    'show_more_button' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'    => 'thumbnail',
                'default' => 'medium_large',
                'exclude' => [
                    'custom',
                ],
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

        $this->end_controls_section();

        Benzo_Query_Builder::render_loop_options( $this, ['post_type' => 'post'] );

        $this->start_controls_section(
            'wrapper_style',
            [
                'label' => esc_html__( 'Wrapper Style', 'benzo-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'wrapper_margin',
            [
                'label'      => esc_html__( 'Margin', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-highlight-posts' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wrapper_padding',
            [
                'label'      => esc_html__( 'Padding', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-highlight-posts' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'wrapper_border',
                'selector' => '{{WRAPPER}} .benzo-highlight-posts',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'wide_post_style',
            [
                'label' => esc_html__( 'Wide Post', 'benzo-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'wide_post_margin',
            [
                'label'      => esc_html__( 'Padding', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-highlight-posts .wide-post .benzo-post-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'widget_design' => 'design-one',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'wide_post_border',
                'selector'  => '{{WRAPPER}} .benzo-highlight-posts .wide-post .benzo-post-box',
                'condition' => [
                    'widget_design' => 'design-one',
                ],
            ]
        );

        $this->add_control(
            'hr_1',
            [
                'type'      => Controls_Manager::DIVIDER,
                'condition' => [
                    'widget_design' => 'design-one',
                ],
            ]
        );

        $this->add_control(
            'post_media_heading',
            [
                'label' => esc_html__( 'Post Media', 'benzo-toolkit' ),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->add_responsive_control(
            'post_media_width',
            [
                'label'      => esc_html__( 'Width', 'benzo-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .highlight-big-post .post-media' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .wide-post .post-media'          => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_media_height  ',
            [
                'label'      => esc_html__( 'Height', 'benzo-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .highlight-big-post .post-media' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .wide-post .post-media'          => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'post_media_overly',
            [
                'label'     => esc_html__( 'Overly Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .design-two .highlight-big-post .post-media::after' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'widget_design' => 'design-two',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'post_media_overly_opacity',
            [
                'label'      => esc_html__( 'opacity', 'benzo-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0.1,
                        'max'  => 1,
                        'step' => 0.1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .design-two .highlight-big-post .post-media::after' => 'opacity: {{SIZE}};',
                ],
                'condition'  => [
                    'widget_design' => 'design-two',
                ],
            ]
        );

        $this->add_control(
            'hr_2',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'wide_title_heading',
            [
                'label' => esc_html__( 'Title', 'benzo-toolkit' ),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'wide_title_color',
            [
                'label'     => esc_html__( 'Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .highlight-big-post .post-content .post-title a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .wide-post .post-content .post-title a'          => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'wide_title_hover_color',
            [
                'label'     => esc_html__( 'Color(Hover)', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .highlight-big-post .post-content .post-title:hover a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .wide-post .post-content .post-title:hover a'          => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'wide_title_typography',
                'selector' => '{{WRAPPER}} .highlight-big-post .post-content .post-title, {{WRAPPER}} .wide-post .post-content .post-title',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'small_post_style',
            [
                'label' => esc_html__( 'Small Style', 'benzo-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'small_media_heading',
            [
                'label' => esc_html__( 'Post Media', 'benzo-toolkit' ),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->add_responsive_control(
            'small_media_width',
            [
                'label'      => esc_html__( 'Width', 'benzo-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .small-post .post-media'          => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .highlight-list-post .post-media' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'small_post_media_height  ',
            [
                'label'      => esc_html__( 'Height', 'benzo-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .small-post .post-media'          => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .highlight-list-post .post-media' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'hr_3',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'small_title_heading',
            [
                'label' => esc_html__( 'Title', 'benzo-toolkit' ),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'small_title_color',
            [
                'label'     => esc_html__( 'Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .small-post .post-title a'          => 'color: {{VALUE}}',
                    '{{WRAPPER}} .highlight-list-post .post-title a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'small_title_hover_color',
            [
                'label'     => esc_html__( 'Color(Hover)', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .small-post .post-title:hover a'          => 'color: {{VALUE}}',
                    '{{WRAPPER}} .highlight-list-post .post-title:hover a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'small_title_typography',
                'selector' => '{{WRAPPER}} .small-post .post-title, {{WRAPPER}} .highlight-list-post .post-title',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'box_title_style',
            [
                'label'     => esc_html__( 'Title', 'benzo-toolkit' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_box_title' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'box_title_color',
            [
                'label'     => esc_html__( 'Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-highlight-posts .highlight-posts-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'box_title_typography',
                'selector' => '{{WRAPPER}} .benzo-highlight-posts .highlight-posts-title',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'box_button_style',
            [
                'label'     => esc_html__( 'Button', 'benzo-toolkit' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_more_button' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'box_button_color',
            [
                'label'     => esc_html__( 'Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-highlight-posts .highlight-posts-link a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'box_button_hover_color',
            [
                'label'     => esc_html__( 'Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-highlight-posts .highlight-posts-link a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'box_button_typography',
                'selector' => '{{WRAPPER}} .benzo-highlight-posts .highlight-posts-link a',
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
        $query    = Benzo_Query_Builder::build_query( $settings );
        $index    = 0;

        $options = [
            'post_layout'    => 'image-left',
            'meta_design'    => 'meta-design-two',
            'show_category'  => 'yes',
            'show_author'    => 'yes',
            'excerpt_word'   => 20,
            'title_word'     => $settings['title_word'],
            'show_read_more' => 'no',
            'read_more_text' => '',
        ];
        ?>
        <div class="benzo-highlight-posts <?php echo esc_attr( $settings['widget_design'] ) ?>">
            <?php if ( 'yes' == $settings['show_box_title'] && ! empty( $settings['box_title'] ) ): ?>
                <h4 class="highlight-posts-title"><?php echo esc_html( $settings['box_title'] ) ?></h4>
            <?php endif; ?>
            <div class="entry-highlight-posts">
                <?php if ( 'design-one' === $settings['widget_design'] ): ?>
                    <div class="row">
                        <?php
                            if ( $query->have_posts() ):
                                while ( $query->have_posts() ): $query->the_post();
                                    $index++;

                                    if ( 5 < $index ) {
                                        $index = 1;
                                    }

                                    if ( 1 == $index ) {
                                        $options['title_tag']      = 'h4';
                                        $options['show_excerpt']   = 'yes';
                                        $options['show_date']      = 'yes';
                                        $options['thumbnail_size'] = $settings['thumbnail_size'];
                                        echo '<div class="col-12 wide-post">';
                                    } else {
                                        $options['title_tag']      = 'h5';
                                        $options['show_excerpt']   = 'no';
                                        $options['show_date']      = 'no';
                                        $options['thumbnail_size'] = 'medium';
                                        echo '<div class="col-md-6 small-post">';
                                    }

                                    Benzo_Post_Templates::render_post_box( $options );

                                    echo '</div>';

                                endwhile;
                            endif;
                            wp_reset_query();
                        ?>
                    </div>
                <?php else :
                    if ( $query->have_posts() ):
                        while ( $query->have_posts() ): $query->the_post();
                            $index++;

                            if ( $settings['title_word'] ) {
                                $title = wp_trim_words( get_the_title(), $settings['title_word'], '..' );
                            } else {
                                $title = get_the_title();
                            }

                            if ( $index == 1 ) : ?>
                            <div class="highlight-big-post">
                                <?php Benzo_Post_Helper::render_media( get_the_ID(), $settings['thumbnail_size'] ); ?>
                                <div class="post-content">
                                    <div class="post-top-meta">
                                        <?php Benzo_Post_Templates::post_category( get_the_ID() ) ?>
                                        <?php if ( 'design-three' === $settings['widget_design'] ) : ?>
                                        <div class="date">
                                            <?php
                                                echo '<i class="far fa-calendar-alt"></i>';
                                                echo esc_html( get_the_time( get_option( 'date_format' ) ) );
                                            ?>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <h5 class="post-title">
                                        <a href="<?php echo esc_url( get_the_permalink() ) ?>">
                                            <?php echo wp_kses_post( $title ) ?>
                                        </a>
                                    </h5>
                                    <?php
                                        if ( 'design-two' === $settings['widget_design'] ) {
                                            $date_options = [
                                                'meta_design' => 'meta-design-one',
                                                'show_author' => 'yes',
                                                'show_date'   => 'yes',
                                            ];
                                            Benzo_Post_Templates::post_author_date( $date_options );
                                        }
                                    ?>
                                </div>
                            </div>
                            <?php else : ?>
                                <div class="highlight-list-post">
                                    <?php if ( 'design-three' === $settings['widget_design'] ) :
                                        Benzo_Post_Helper::render_media( get_the_ID(), 'medium' );
                                        ?>
                                        <div class="post-content">
                                            <div class="date">
                                                <?php
                                                    echo '<i class="far fa-calendar-alt"></i>';
                                                    echo esc_html( get_the_time( get_option( 'date_format' ) ) );
                                                ?>
                                            </div>
                                            <h6 class="post-title">
                                                <a href="<?php echo esc_url( get_the_permalink() ) ?>">
                                                    <?php echo wp_kses_post( $title ) ?>
                                                </a>
                                            </h6>
                                        </div>
                                    <?php else : ?>
                                        <h6 class="post-title">
                                            <a href="<?php echo esc_url( get_the_permalink() ) ?>">
                                                <?php echo wp_kses_post( $title ) ?>
                                            </a>
                                        </h6>
                                    <?php endif; ?>
                                </div>
                            <?php endif;
                        endwhile;
                    endif;
                    wp_reset_query();
                endif; ?>
            </div>
            <?php if ( 'yes' == $settings['show_more_button'] && ! empty( $settings['box_btn_text'] && ! empty( $settings['box_btn_link']['url'] ) ) ): ?>
                <div class="highlight-posts-link">
                    <a href="<?php echo esc_url( $settings['box_btn_link']['url'] ) ?>">
                        <span><?php echo esc_html( $settings['box_btn_text'] ) ?></span>
                        <i class="fas fa-angle-double-right"></i>
                    </a>
                </div>
            <?php endif; ?>
        </div>
        <?php
    }
}