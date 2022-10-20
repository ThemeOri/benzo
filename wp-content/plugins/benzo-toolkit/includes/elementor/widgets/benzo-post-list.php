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

class Benzo_Post_List extends Widget_Base {

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
        return 'benzo-post-list';
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
        return esc_html__( 'Benzo Post List', 'benzo-toolkit' );
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
        return 'eicon-post-list';
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
        return ['Benzo', 'post', 'list', 'blog'];
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
            'meta_design',
            [
                'label'   => esc_html__( 'Meta Design', 'benzo-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'design-1' => esc_html__( 'Design One', 'benzo-toolkit' ),
                    'design-2' => esc_html__( 'Design Two', 'benzo-toolkit' ),
                ],
                'default' => 'design-2',
            ]
        );

        
        $this->add_control(
            'show_date',
            [
                'label'        => esc_html__( 'Show Date', 'benzo-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'benzo-toolkit' ),
                'label_off'    => esc_html__( 'Hide', 'benzo-toolkit' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'show_tag',
            [
                'label'        => esc_html__( 'Show Tags', 'benzo-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'benzo-toolkit' ),
                'label_off'    => esc_html__( 'Hide', 'benzo-toolkit' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );


        $this->add_control(
            'show_author',
            [
                'label'        => esc_html__( 'Show Author', 'benzo-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'benzo-toolkit' ),
                'label_off'    => esc_html__( 'Hide', 'benzo-toolkit' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'show_thumbnail',
            [
                'label'        => esc_html__( 'Show Thumbnail', 'benzo-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'benzo-toolkit' ),
                'label_off'    => esc_html__( 'Hide', 'benzo-toolkit' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'show_comments',
            [
                'label'        => esc_html__( 'Show Comments', 'benzo-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'benzo-toolkit' ),
                'label_off'    => esc_html__( 'Hide', 'benzo-toolkit' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

       

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'thumbnail',
                'default'   => 'medium',
                'exclude'   => [
                    'custom',
                ],
                'condition' => [
                    'show_thumbnail' => 'yes',
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
            'wrapper_padding',
            [
                'label'      => esc_html__( 'Margin', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-post-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wrapper_margin',
            [
                'label'      => esc_html__( 'Padding', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-post-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'wrapper_bg',
            [
                'label'     => esc_html__( 'Background Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-post-list' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'wrapper_border',
                'selector' => '{{WRAPPER}} .benzo-post-list',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'post_item_style',
            [
                'label' => esc_html__( 'Post Item', 'benzo-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'post_item_padding',
            [
                'label'      => esc_html__( 'Margin', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-post-list li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_item_margin',
            [
                'label'      => esc_html__( 'Padding', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-post-list li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'post_item_bg',
            [
                'label'     => esc_html__( 'Background Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-post-list li' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'divider',
            [
                'label'     => esc_html__( 'Divider Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-post-list li:not(:last-child)' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'post_content_style',
            [
                'label' => esc_html__( 'Post Content', 'benzo-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'post_media_style',
            [
                'label' => esc_html__( 'Post Media', 'benzo-toolkit' ),
                'type'   => Controls_Manager::HEADING,
            ]
        );

        $this->add_responsive_control(
            'post_media_margin',
            [
                'label'      => esc_html__( 'Margin', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-post-list li .post-media' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
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
                    '{{WRAPPER}} .benzo-post-list li .post-media' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_media_height',
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
                    '{{WRAPPER}} .benzo-post-list li .post-media' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_heading',
            [
                'label'     => esc_html__( 'Title', 'benzo-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-post-list .post-title a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label'     => esc_html__( 'Color(Hover)', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-post-list .post-title:hover a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .benzo-post-list .post-title',
            ]
        );

        $this->add_control(
            'meta_heading',
            [
                'label'     => esc_html__( 'Post Meta', 'benzo-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'meta_3_color',
            [
                'label'     => esc_html__( 'Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-post-list .post-meta'   => 'color: {{VALUE}}',
                    '{{WRAPPER}} .benzo-post-list .post-meta a' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'meta_design' => 'design-2',
                ],
            ]
        );

        $this->add_control(
            'meta_3_cat_color',
            [
                'label'     => esc_html__( 'Categories Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-post-list .post-meta .post-categories a' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'meta_design' => 'design-2',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'meta_3_typography',
                'selector'  => '{{WRAPPER}} .benzo-post-list .post-meta',
                'condition' => [
                    'meta_design' => 'design-2',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'     => esc_html__( 'Categories Typography', 'benzo-toolkit' ),
                'name'      => 'category_typography',
                'selector'  => '{{WRAPPER}} .benzo-post-list.meta-design-1 .post-categories a',
                'condition' => [
                    'meta_design!' => 'design-2',
                ],
            ]
        );

        $this->add_control(
            'category_color',
            [
                'label'     => esc_html__( 'Categories Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-post-list.meta-design-1 .post-categories a' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'meta_design!' => 'design-2',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'     => esc_html__( 'Author/Date Typography', 'benzo-toolkit' ),
                'name'      => 'author_typography',
                'selector'  => '{{WRAPPER}} .benzo-post-list .author-date',
                'condition' => [
                    'meta_design!' => 'design-2',
                ],
            ]
        );

        $this->add_control(
            'author_color',
            [
                'label'     => esc_html__( 'Author/Date Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-post-list .author-date' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .benzo-post-list .author-date a' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'meta_design!' => 'design-2',
                ],
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
        $wrapper_class = ['benzo-post-list', $settings['thumbnail_position'], 'meta-' . $settings['meta_design']];
        ?>
        <div class="d-none">
            <ul class="<?php echo esc_attr( implode( ' ', $wrapper_class ) ) ?>">
                <?php
                    $query = Benzo_Query_Builder::build_query( $settings );
                    if( $query->have_posts() ) :
                        while ( $query->have_posts() ): $query->the_post();
                        if ( $settings['title_word'] ) {
                            $title = wp_trim_words( get_the_title(), $settings['title_word'], '..' );
                        } else {
                            $title = get_the_title();
                        }
                        ?>
                        <li>
                            <?php
                                if( 'yes' == $settings['show_thumbnail'] ) {
                                    Benzo_Post_Helper::render_media( get_the_ID(), $settings['thumbnail_size'] );
                                }
                            ?>
                            <div class="post-content">
                                <?php
                                    if ( 'design-1' === $settings['meta_design'] && 'yes' == $settings['show_categories'] ) {
                                        Benzo_Post_Templates::post_category( get_the_ID() );
                                    }

                                    if ( 'design-2' === $settings['meta_design'] ) : ?>
                                        <div class="post-meta">
                                            <?php  if( 'yes' === $settings['show_date'] ) : ?>
                                            <span class="post-date">
                                                <?php echo esc_html( get_the_time( get_option( 'date_format' ) ) ); ?>
                                            </span>
                                            <?php endif; ?>
                                            <?php  if( 'yes' === $settings['show_author'] ) : ?>
                                            <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="author-name">
                                                <?php
                                                    esc_html_e( 'By ', 'benzo-toolkit' );
                                                    echo esc_html( get_the_author_meta( 'display_name' ) );
                                                ?>
                                            </a>
                                            <?php endif; ?>
                                            <?php
                                                if ( 'yes' === $settings['show_categories'] ) {
                                                    Benzo_Post_Templates::post_category( get_the_ID() );
                                                }
                                            ?>
                                        </div>
                                    <?php endif;
                                ?>
                                <h5 class="post-title">
                                    <a href="<?php echo esc_url( get_the_permalink() ) ?>">
                                        <?php echo wp_kses_post( $title ) ?>
                                    </a>
                                </h5>
                                <?php if ( 'design-1' == $settings['meta_design'] ) : ?>
                                    <?php if ( 'yes' == $settings['show_date'] || 'yes' == $settings['show_author'] ) : ?>
                                    <div class="author-date">
                                        <?php if( 'yes' == $settings['show_author'] ) : ?>
                                        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="author-name">
                                            <?php echo esc_html__( 'By', 'benzo-toolkit' ) . ' ' . esc_html( get_the_author_meta( 'display_name' ) ); ?>
                                        </a>
                                        <?php endif; ?>
                                        <?php if( 'yes' == $settings['show_date'] ) : ?>
                                        <span class="post-date">
                                            <i class="far fa-calendar-alt"></i>
                                            <?php echo esc_html( get_the_time( get_option( 'date_format' ) ) ); ?>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </li>
                        <?php
                        endwhile;
                    endif;
                    wp_reset_query();
                ?>
            </ul>
        </div>

        
        <div class="blog__wrapper-one">
            <div class="container">
                <div class="row">
                <?php
                    $query = Benzo_Query_Builder::build_query( $settings );
                    if( $query->have_posts() ) :
                        while ( $query->have_posts() ): $query->the_post();
                        if ( $settings['title_word'] ) {
                            $title = wp_trim_words( get_the_title(), $settings['title_word'], '..' );
                        } else {
                            $title = get_the_title();
                        }
                        ?>
                    <div class="col-lg-4">
                        <div class="blog-item-one">
                        <?php  if( 'yes' === $settings['show_date'] ) : ?>
                            <div class="entry-posts-date">
                                <div class="entry-posts-date-name">
                                    <h5><?php the_time( 'M' ); ?></h5>
                                </div>
                                <div class="entry-posts-date-number">
                                    <h5><?php the_time( 'j' ); ?></h5>
                                </div>
                           </div>
                           <?php endif; ?>
                            <div class="blog-thumb-one">
                            <?php
                                if( 'yes' == $settings['show_thumbnail'] ) {
                                    Benzo_Post_Helper::render_media( get_the_ID(), $settings['thumbnail_size'] );
                                }
                            ?>
                            </div>
                            <div class="blog-meta-one">
                                <ul>
                                <?php  if( 'yes' === $settings['show_tag'] ) : ?>
                                    <li><i class="fal fa-tags"></i> <?php the_tags('', '', ''); ?></li>
                                    <?php endif; ?>
                                    <?php if( 'yes' == $settings['show_author'] ) : ?>
                                    <li><i class="far fa-user-circle"></i><span><?php the_author(); ?></span></li>
                                    <?php endif; ?>
                                    <?php if( 'yes' == $settings['show_comments'] ) : ?>
                                    <li><i class="far fa-comment"></i> <span><?php comments_number();?></span></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <div class="blog-content-one">
                                <h3><a href="<?php echo esc_url( get_the_permalink() ) ?>"><?php echo wp_kses_post( $title ) ?></a></h3>
                                <p>Felistan commodo into libero pedels sapien same <br> quam sodale lobor eude duise</p>
                                <a class="features-sp-btn" href="<?php echo esc_url( get_the_permalink() ) ?>">
                                    <i class="fal fa-long-arrow-right"></i>
                                    <i class="fal fa-long-arrow-right"></i>
                               </a>
                            </div>
                        </div>
                    </div>
                     <?php
                        endwhile;
                    endif;
                    wp_reset_query();
                ?>
                </div>
            </div>
        </div>


        <?php
    }
}