<?php
namespace BenzoToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Utils;

defined( 'ABSPATH' ) || exit;

class Benzo_Project extends Widget_Base {

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
        return 'benzo-project';
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
        return esc_html__( 'Benzo Project', 'benzo-toolkit' );
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
        return 'eicon-slider-device';
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
        return ['Benzo', 'Toolkit', 'box', 'video','play'];
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
                    'design-2' => esc_html__( 'Design Two', 'benzo-toolkit' ),
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
                    'widget_design' => ['design-1'],
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
            'sub_title_up',
            [
                'label' => esc_html__('Sub Title Up', 'benzo-toolkit'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Heading Sub Title Up',
                'placeholder' => esc_html__('Heading Sub Text Up', 'benzo-toolkit'),
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
            '_section_slides',
            [
                'label' => esc_html__('Project Slider', 'benzo-toolkit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'image',
            [
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label' => esc_html__('Image', 'benzo-toolkit'),
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'subtitle',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => esc_html__('Sub Title', 'benzo-toolkit'),
                'placeholder' => esc_html__('Type sub title here', 'benzo-toolkit'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'slider_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__('Title', 'benzo-toolkit'),
                'placeholder' => esc_html__('Type title here', 'benzo-toolkit'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'slider_url',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__('#', 'benzo-toolkit'),
                'placeholder' => esc_html__('#', 'benzo-toolkit'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'slides',
            [
                'show_label' => false,
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(slider_title || "Carousel Item"); #>',
                'default' => [
                    [
                        'image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'medium_large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_content',
            [
                'label' => esc_html__('Style Heading Title & Content', 'benzo-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'widget_design' => ['design-1'],
                ],
            ]
        );

        // Title
        $this->add_control(
            '_heading_title',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Title', 'webtend-el-title'),
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

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Text Color', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title',
                'selector' => '{{WRAPPER}} .webtend-el-title',
            ]
        );

        // Sub Title Up  
        $this->add_control(
            '_content_subtitle_up',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Sub Title Up', 'benzo-toolkit'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'subtitle_up_spacing',
            [
                'label' => esc_html__('Bottom Spacing', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-subtitle-up' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'subtitle_up_color',
            [
                'label' => esc_html__('Text Color', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-subtitle-up' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_up',
                'selector' => '{{WRAPPER}} .webtend-el-subtitle-up',
            ]
        );

        // Subtitle
        $this->add_control(
            '_subtitle_subtitle',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Subtitle', 'benzo-toolkit'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'subtitle_spacing',
            [
                'label' => esc_html__('Bottom Spacing', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => esc_html__('Text Color', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-subtitle' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle',
                'selector' => '{{WRAPPER}} .webtend-el-subtitle',
            ]
        );


        $this->end_controls_section();

        // Style Slider Title & Content
        $this->start_controls_section(
            '_section_style_slider',
            [
                'label' => esc_html__('Style Slider Title & Content', 'benzo-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Title
        $this->add_control(
            '_heading_slider_title',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Title', 'webtend-el-title-s'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'title_slider_spacing',
            [
                'label' => esc_html__('Bottom Spacing', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-title-s' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_slider_color',
            [
                'label' => esc_html__('Text Color', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-title-s' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title-slider',
                'selector' => '{{WRAPPER}} .webtend-el-title-s',
            ]
        );

        // Subtitle
        $this->add_control(
            '_slider_subtitle',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Subtitle', 'benzo-toolkit'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'subtitle_slider_spacing',
            [
                'label' => esc_html__('Bottom Spacing', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-subtitle-s' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'subtitle_slider_color',
            [
                'label' => esc_html__('Text Color', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-subtitle-s' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle-slider',
                'selector' => '{{WRAPPER}} .webtend-el-subtitle-s',
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

        if (empty($settings['slides'])) {
            return;
        }

        $title = wp_kses_post($settings['title'] ?? '');
        $this->add_inline_editing_attributes('title', 'basic');
        $this->add_render_attribute('title', 'class', 'webtend-el-title');

        ?>

       <?php if ( 'design-1' === $settings['widget_design'] ) : ?>
            <div class="project__wrapper-bg">
                <div class="project-shape">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/project-pattern.png" alt="img">
                </div>
                <div class="container">
                <div class="row align-items-center">
                <div class="col-lg-10">
                    <div class="benzo-header-area-one two">
                    <div class="heading-subtitle-wrapper">
                        <div class="subtitle-one-icon">
                            <span><i class="fal fa-star"></i></span>
                        </div>
                        <div class="subtitle-content-wrapper">
                            <?php if ($settings['sub_title_up']) : ?>
                            <h6 class="webtend-el-subtitle-up"><?php echo wp_kses_post($settings['sub_title_up']); ?></h6>
                            <?php endif; ?>
                            <?php if ($settings['sub_title']) : ?>
                            <h5 class="webtend-el-subtitle"><?php echo wp_kses_post($settings['sub_title']); ?></h5>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="heading-title-one">
                        <?php printf(
                            '<%1$s %2$s>%3$s</%1$s>',
                            tag_escape($settings['title_tag']),
                            $this->get_render_attribute_string('title'),
                            $title
                        ); ?>
                    </div>
                </div>
                    </div>
                    <div class="col-lg-2">
                    <div class="services-two-nav">
                        <div class="services-button-prev"><i class="fal fa-long-arrow-left"></i></i></div>
                        <div class="services-button-next"><i class="fal fa-long-arrow-right"></i></div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="project__wrapper-slider">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="project-slider-one">
                            <div class="swiper-container services-two-active">
                                <div class="swiper-wrapper">
                                <?php foreach ($settings['slides'] as $slide) : 
                                    if (!empty($slide['image']['id'])) {
                                        $image = wp_get_attachment_image_url($slide['image']['id'], $settings['thumbnail_size']);
                                    }
                                ?>
                                    <div class="swiper-slide">
                                        <div class="project-slider-item">
                                            <div class="project-slider-thumb">
                                                <img src="<?php print esc_url($slide['image']['url']); ?>" alt="img">
                                                <div class="project-slider-content">
                                                <?php if ($slide['subtitle']) : ?>
                                                    <span class="webtend-el-subtitle-s"><?php echo wp_kses_post($slide['subtitle']); ?></span>
                                                <?php endif; ?>
                                                <?php if ($slide['slider_title']) : ?>
                                                    <h4><a class="webtend-el-title-s" href="<?php echo esc_url($slide['slider_url']); ?>"><?php echo wp_kses_post($slide['slider_title']); ?></a></h4>
                                                <?php endif; ?>
                                                <?php if ($slide['slider_url']) : ?>
                                                    <a class="project-slider-arrow" href="<?php echo esc_url($slide['slider_url']); ?>"><i class="fal fa-long-arrow-right"></i></a>
                                                <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        <?php endif; ?>    
        
        <?php if ( 'design-2' === $settings['widget_design'] ) : ?>
            <div class="project__wrapper-two">
                <div class="container-fluid project-side-p">
                <div class="swiper-container project-active">
                  <div class="swiper-wrapper">
                  <?php foreach ($settings['slides'] as $slide) : 
                        if (!empty($slide['image']['id'])) {
                            $image = wp_get_attachment_image_url($slide['image']['id'], $settings['thumbnail_size']);
                        }
                   ?>
                    <div class="swiper-slide">
                        <div class="project__wrapper-item-two">
                            <div class="project-item-thumb-two">
                                <img src="<?php print esc_url($slide['image']['url']); ?>" alt="img">
                            <div class="project__wrapper-content-two">
                                <?php if ($slide['slider_title']) : ?>
                                <div class="project-item-title-two">
                                    <h3><a class="webtend-el-title-s" href="<?php echo esc_url($slide['slider_url']); ?>"><?php echo wp_kses_post($slide['slider_title']); ?></a></h3>
                                </div>
                                <?php endif; ?>
                                <?php if ($slide['subtitle']) : ?>
                                <div class="project-item-subtitle-two">
                                    <span class="webtend-el-subtitle-s"><?php echo wp_kses_post($slide['subtitle']); ?></span>
                                </div>
                                <?php endif; ?>
                            </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                  </div>
                </div>
                </div>
            </div>
        <?php endif; ?> 

        <?php
}
}