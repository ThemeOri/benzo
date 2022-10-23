<?php
namespace BenzoToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Utils;

defined( 'ABSPATH' ) || exit;

class Benzo_About extends Widget_Base {

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
        return 'benzo-about';
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
        return esc_html__( 'Benzo About', 'benzo-toolkit' );
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
        return 'eicon-import-kit';
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
        return ['Benzo', 'Toolkit', 'image', 'about'];
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
                'label'   => esc_html__( 'Select Style', 'benzo-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'design-1' => esc_html__( 'Design One', 'benzo-toolkit' ),
                    'design-2' => esc_html__( 'Design Three', 'benzo-toolkit' ),
                ],
                'default' => 'design-1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_fields_heading',
            [
                'label' => esc_html__( 'Title & Description', 'benzo-toolkit' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'widget_design' => ['design-2'],
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'benzo-toolkit'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 4,
                'default' => 'Heading Title',
                'placeholder' => esc_html__('Heading Text', 'benzo-toolkit'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' => esc_html__('Sub Title', 'benzo-toolkit'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Heading Sub Title',
                'placeholder' => esc_html__('Heading Sub Text', 'benzo-toolkit'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'benzo-toolkit'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'benzo-toolkit'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'benzo-toolkit'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'benzo-toolkit'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'benzo-toolkit'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'benzo-toolkit'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
            ]
        );

            $this->add_responsive_control(
            'align',
            [
                'label' => esc_html__('Alignment', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'benzo-toolkit'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'benzo-toolkit'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'benzo-toolkit'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_media',
            [
                'label' => esc_html__('Image', 'benzo-toolkit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

         $this->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnails',
                'default' => 'large',
                'separator' => 'none',
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_experience',
            [
                'label' => esc_html__('Experience', 'benzo-toolkit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'experience_title',
            [
                'label' => esc_html__('Experience Title', 'benzo-toolkit'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 4,
                'default' => 'Experience Title',
                'placeholder' => esc_html__('Experience Title', 'benzo-toolkit'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'experience_symbols',
            [
                'label' => esc_html__('Experience Symbols', 'benzo-toolkit'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'rows' => 4,
                'default' => '+',
                'placeholder' => esc_html__('+', 'benzo-toolkit'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'description_experience',
            [
                'label' => esc_html__('Description Experience', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__('Description Experience Text', 'benzo-toolkit'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'benzo-toolkit'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'benzo-toolkit'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'benzo-toolkit'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'benzo-toolkit'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'benzo-toolkit'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'benzo-toolkit'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h3',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => esc_html__('Alignment', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'benzo-toolkit'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'benzo-toolkit'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'benzo-toolkit'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_button',
            [
                'label' => esc_html__('Style Title & Content', 'benzo-toolkit'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

         // Title
        $this->add_control(
            '_heading_title',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Title', 'benzo-toolkit'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'title_spacing',
            [
                'label' => esc_html__('Bottom Spacing', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

       $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Typography', 'benzo-toolkit'),
                'selector' => '{{WRAPPER}} .webtend-el-title',
            ]
        );

        $this->start_controls_tabs('title_tabs');
        $this->start_controls_tab(
            'title_normal_tab',
            [
                'label' => esc_html__('Normal', 'benzo-toolkit'),
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'title_hover_tab',
            [
                'label' => esc_html__('Hover', 'benzo-toolkit'),
            ]
        );

        $this->add_control(
            'title_hvr_color',
            [
                'label' => esc_html__('Color', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-title:hover > a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

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
                    '{{WRAPPER}} .webtend-el-des p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('Text Color', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-des p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description',
                'selector' => '{{WRAPPER}} .webtend-el-des p',
            ]
        );

         $this->add_responsive_control(
            'description_spacing',
            [
                'label' => esc_html__('Bottom Spacing', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-des p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
        extract($settings);

        $title = wp_kses_post($settings['title'] ?? '');
        $this->add_inline_editing_attributes('title', 'basic');
        $this->add_render_attribute('title', 'class', 'webtend-el-title');
        $title = wp_kses_post($settings['title']);

        ?>
        <?php if ( 'design-1' === $settings['widget_design'] ) : ?>
        <div class="about__one-wrapper">
            <div class="about__one-thumb">
            <?php if ( $settings['image']['url'] ): ?>
                <img src="<?php echo esc_attr( $settings['image']['url'] ) ?>" alt="img">
                <?php endif;?>
                <div class="about__one-experience">
                   <?php if ($settings['experience_title']) : ?>
                    <h5><span class="counter"><?php echo wp_kses_post($settings['experience_title']); ?></span>
                    <?php echo wp_kses_post($settings['experience_symbols']); ?>
                   </h5>
                    <?php endif;?>
                    <?php if ($settings['description_experience']) : ?>
                    <p><?php echo wp_kses_post($settings['description_experience']); ?></p>
                    <?php endif;?>
                </div>
            </div>
        </div>
        <?php endif; ?>
        
        <?php if ( 'design-2' === $settings['widget_design'] ) : ?>

        <div class="about__wrapper-two">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7 col-md-6">
                        <div class="about-left-gallery">
                        <div class="about-left-thumb">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/about/about-3.jpg" alt="img">
                        </div>
                        <div class="about-middle-thumb">
                            <div class="about-middle-one">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/about/about-2.jpg" alt="img">
                            </div>
                            <div class="about-middle-two">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/about/about-4.jpg" alt="img">
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6">
                        <div class="about-right-content">
                            <div class="about-two-heading-style">
                                <div class="heading__style-three">
                                <?php if ($settings['sub_title']) : ?>
                                <span class="webtend-el-subtitle"><?php echo wp_kses_post($settings['sub_title']); ?></span>
                                <?php endif; ?>
                                <?php printf(
                                        '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape($settings['title_tag']),
                                        $this->get_render_attribute_string('title'),
                                        $title
                                    ); 
                                ?>
                                </div>
                                <p>Belis commodo libero velos pedels be sapien same quam integer sodale lobortis eude duise natoque Iaculis 
                            adipiscing duilarty iaculis varius laorey nostra duis purus lobortis curabitur donec</p>
                            </div>
                            <div class="about-author-two">
                                <div class="about-author-two-thumb">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/author/about-two.png" alt="img">
                                </div>
                                <div class="about-author-content">
                                    <h5>Robert Climate, <span> Founder & CEO </span></h5>
                                    <p>Belis commodo liberod velos pedels better sapiens same quam integer sodale lobosie</p>
                                    <div class="about-author-quote-two">
                                     <i class="fal fa-quote-right"></i>
                                    </div>
                                </div>
                            </div>
                                <div class="about-two-list">
                                    <ul>
                                        <li><h5><i class="fal fa-check-circle"></i> Excellence Engineering</h5></li>
                                        <li><h5><i class="fal fa-check-circle"></i>Bring your ideas to life</h5></li>
                                    </ul>
                                </div>
                                <div class="about-video-two">
                                    <div class="about-video-thumb-two">
                                       <img src="<?php echo get_template_directory_uri(); ?>/assets/img/about/about-video.png" alt="img">
                                       <a class="popup-video about-popup-two" href="https://www.youtube.com/watch?v=P_Q4gn16yDA"><i class="fas fa-play"></i></a>
                                    </div>
                                    <div class="about-video-content-two">
                                        <p>Conubia elementum metus pulvinar turps aliquam senectus luctus bed curabitur rutrum suspendise 
                                            convallis torquent  a hymenaeos adipiscing sitting eleifend pulvinar and ridiculus. Venenatis 
                                            natoque suspense mattis turpis orci cursus </p>
                                    </div>
                                </div>
                                <div class="about-button-support">
                                    <a class="about-support-btn benzo-el-btn webtend-el-btn" href="#">Learn More_</a>
                                    <div class="about-support-two">
                                        <span>Free Support:</span>
                                        <h5><a href="tel:08 (520) 526-2250">08 (520) 526-2250</a></h5>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php endif; ?>

        <?php
}
}