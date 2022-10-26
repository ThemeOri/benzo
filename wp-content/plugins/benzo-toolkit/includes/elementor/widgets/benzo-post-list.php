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
            'widget_design',
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

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'benzo-toolkit'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'rows' => 4,
                'default' => 'Button Text',
                'placeholder' => esc_html__('Button Text', 'benzo-toolkit'),
                'condition' => [
                    'widget_design' => ['design-2'],
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->end_controls_section();

        Benzo_Query_Builder::render_loop_options( $this, ['post_type' => 'post'] );


        $this->start_controls_section(
            'post_content_style',
            [
                'label' => esc_html__( 'Post Content Style', 'benzo-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
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

        $this->add_responsive_control(
            'title_spacing',
            [
                'label' => esc_html__('Bottom Spacing', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .benzo-post-list' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-post-list' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label'     => esc_html__( 'Color(Hover)', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-post-list:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .benzo-post-list',
            ]
        );

        // description
        $this->add_control(
            '_content_description',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Description', 'benzo-toolkit'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'description_spacing',
            [
                'label' => esc_html__('Bottom Spacing', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-content p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('Text Color', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description',
                'selector' => '{{WRAPPER}} .webtend-el-content p',
            ]
        );

        $this->add_control(
            'meta_heading',
            [
                'label'     => esc_html__( 'Post Meta', 'benzo-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'widget_design' => ['design-1'],
                ],
            ]
        );

        $this->add_responsive_control(
            'meta_spacing',
            [
                'label' => esc_html__('Bottom Spacing', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .blog-meta-one ul li' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'widget_design' => ['design-1'],
                ],
            ]
        );

        $this->add_control(
            'meta_color',
            [
                'label'     => esc_html__( 'Meta Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-meta-one ul li'   => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'widget_design' => ['design-1'],
                ],
                
            ]
        );

        $this->add_control(
            'meta_icon_color',
            [
                'label'     => esc_html__( 'Meta Icon Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-meta-one ul li i'   => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'widget_design' => ['design-1'],
                ],
                
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'meta_typography',
                'selector'  => '{{WRAPPER}} .blog-meta-one ul li',
                'condition' => [
                    'widget_design' => ['design-1'],
                ],
            ]
        );

        $this->add_control(
            'author_heading',
            [
                'label'     => esc_html__( 'Post Tag', 'benzo-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'widget_design' => ['design-1'],
                ],
            ]
        );

        $this->add_control(
            'author_color',
            [
                'label'     => esc_html__( 'Author Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-meta-one ul li a'   => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'widget_design' => ['design-1'],
                ],
                
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'author_typography',
                'selector'  => '{{WRAPPER}} .blog-meta-one ul li a',
                'condition' => [
                    'widget_design' => ['design-1'],
                ],
            ]
        );


        // Blog Post Two Style
        $this->add_control(
            'meta_heading_two',
            [
                'label'     => esc_html__( 'Post Meta', 'benzo-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'widget_design' => ['design-2'],
                ],
            ]
        );

        $this->add_responsive_control(
            'meta_spacing_two',
            [
                'label' => esc_html__('Bottom Spacing', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .blog-post-meta-two ul li' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'widget_design' => ['design-2'],
                ],
            ]
        );

        $this->add_control(
            'meta_color_two',
            [
                'label'     => esc_html__( 'Meta Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-post-meta-two ul li'   => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'widget_design' => ['design-2'],
                ],
                
            ]
        );

        $this->add_control(
            'meta_icon_color_two',
            [
                'label'     => esc_html__( 'Meta Icon Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-post-meta-two ul li i'   => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'widget_design' => ['design-2'],
                ],
                
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'meta_typography_two',
                'selector'  => '{{WRAPPER}} .blog-post-meta-two ul li',
                'condition' => [
                    'widget_design' => ['design-2'],
                ],
            ]
        );

        $this->add_control(
            'author_heading_two',
            [
                'label'     => esc_html__( 'Post Tag', 'benzo-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'widget_design' => ['design-2'],
                ],
            ]
        );

        $this->add_control(
            'author_color_two',
            [
                'label'     => esc_html__( 'Author Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-post-meta-two ul li a'   => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'widget_design' => ['design-2'],
                ],
                
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'author_typography_two',
                'selector'  => '{{WRAPPER}} .blog-post-meta-two ul li a',
                'condition' => [
                    'widget_design' => ['design-2'],
                ],
            ]
        );

        $this->end_controls_section();

        // Button 
        $this->start_controls_section(
            'section_button_style',
            [
                'label' => esc_html__( 'Button', 'benzo-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label'      => esc_html__( 'Padding', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .webtend-el-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'button_border',
                'selector' => '{{WRAPPER}} .webtend-el-btn',
            ]
        );

        $this->add_responsive_control(
            'button_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .webtend-el-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'button_typography',
                'label'    => esc_html__( 'Typography', 'benzo-toolkit' ),
                'selector' => '{{WRAPPER}} .webtend-el-btn',
            ]
        );

        $this->start_controls_tabs( 'button_tabs' );

        $this->start_controls_tab(
            'field_button_normal',
            [
                'label' => esc_html__( 'Normal', 'benzo-toolkit' ),
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label'     => esc_html__( 'Text Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-btn' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-btn' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'field_button_hover',
            [
                'label' => esc_html__( 'Hover', 'benzo-toolkit' ),
            ]
        );

        $this->add_control(
            'button_text_focus',
            [
                'label'     => esc_html__( 'Text Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-btn:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color_focus',
            [
                'label'     => esc_html__( 'Background Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-btn:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_border_focus',
            [
                'label'     => esc_html__( 'Border Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-btn:hover' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

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

        <?php if ( 'design-1' === $settings['widget_design'] ) : ?>
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
                        <?php if( has_post_thumbnail( ) ) : ?>
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
                            <?php endif; ?>
                            <div class="blog-meta-one">
                                <ul>
                                    <?php if(has_tag()) : ?>
                                    <?php  if( 'yes' === $settings['show_tag'] ) : ?>
                                    <li><i class="fal fa-tags"></i> <?php the_tags('', '', ''); ?></li>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if( 'yes' == $settings['show_author'] ) : ?>
                                    <li><i class="far fa-user-circle"></i><span><?php the_author(); ?></span></li>
                                    <?php endif; ?>
                                    <?php if( 'yes' == $settings['show_comments'] ) : ?>
                                    <li><i class="far fa-comment"></i> <span><?php comments_number();?></span></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <div class="blog-content-one webtend-el-content">
                                <h3><a class="benzo-post-list" href="<?php echo esc_url( get_the_permalink() ) ?>"><?php echo wp_kses_post( $title ) ?></a></h3>
                                <p><?php echo wpautop( wp_trim_words( get_the_excerpt(), '20' ) ); ?></p>
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
        <?php endif; ?>

        <?php if ( 'design-2' === $settings['widget_design'] ) : ?>
        <div class="blog__post-wrapper-two">
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
                        <div class="blog-post-item-two">
                            <?php if( has_post_thumbnail( ) ) : ?>
                            <?php if( 'yes' == $settings['show_thumbnail'] ) : ?>
                            <div class="blog-post-thumb-two">
                                <img src="<?php print get_the_post_thumbnail_url($query->ID, 'full'); ?>" alt="img">
                                <?php  if( 'yes' === $settings['show_date'] ) : ?>
                                <div class="entry-posts-date-two">
                                    <div class="entry-posts-date-name-two">
                                        <h5><?php the_time( 'M' ); ?></h5>
                                    </div>
                                    <div class="entry-posts-date-number-two">
                                        <h5><?php the_time( 'j' ); ?></h5>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>
                            <?php endif; ?>
                            <div class="blog-post-meta-two">
                                <ul>
                                    <?php if(has_tag()) : ?>
                                    <?php  if( 'yes' === $settings['show_tag'] ) : ?>
                                    <li><i class="fal fa-tags"></i> <?php the_tags('', '', ''); ?></li>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if( 'yes' == $settings['show_author'] ) : ?>
                                    <li><i class="far fa-user-circle"></i><span><?php the_author(); ?></span></li>
                                    <?php endif; ?>
                                    <?php if( 'yes' == $settings['show_comments'] ) : ?>
                                    <li><i class="far fa-comment"></i> <span><?php comments_number();?></span></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <div class="blog-post-content-two webtend-el-content">
                                <h3><a class="benzo-post-list" href="<?php echo esc_url( get_the_permalink() ) ?>"><?php echo wp_kses_post( $title ) ?></a></h3>
                                <p><?php echo wpautop( wp_trim_words( get_the_excerpt(), '20' ) ); ?></p>
                            </div>
                            <?php if ($settings['button_text']) : ?>
                            <div class="blog-post-btn-two">
                                <a class="blog-btn-two btn-round webtend-el-btn" href="<?php echo esc_url( get_the_permalink() ) ?>"><?php echo wp_kses_post($settings['button_text']); ?></a>
                            </div>
                            <?php endif; ?>
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
       <?php endif; ?>     

        <?php
    }
}