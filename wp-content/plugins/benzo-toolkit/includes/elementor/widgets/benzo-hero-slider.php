<?php
namespace BenzoToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Utils;

defined( 'ABSPATH' ) || exit;

class Benzo_Hero_slider extends Widget_Base {

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
        return 'benzo-hero-slider';
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
        return esc_html__( 'Benzo Hero Slider', 'benzo-toolkit' );
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
        return 'eicon-slider-album';
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
        return ['Benzo', 'Toolkit', 'slider', 'hero'];
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
            '_section_slides',
            [
                'label' => esc_html__('Hero Slider', 'benzo-toolkit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'slider_condition',
            [
                'label' => __('Slider condition', 'benzo-toolkit'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'design-1' => esc_html__('Style 1', 'benzo-toolkit'),
                    'design-2' => esc_html__('Style 2', 'benzo-toolkit')
                ],
                'default' => 'design-1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'image',
            [
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label' => esc_html__('Slider BG Image', 'benzo-toolkit'),
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'video_url',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'label' => esc_html__('Video URL', 'benzo-toolkit'),
                'default' => esc_html__('video url', 'benzo-toolkit'),
                'placeholder' => esc_html__('#', 'benzo-toolkit'),
                'condition' => [
                    'slider_condition' => ['design-1'],
                ],
                'dynamic' => [
                    'active' => true,
                ],

            ]
        );

        $repeater->add_control(
            'sub_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'label' => esc_html__('Sub Title', 'benzo-toolkit'),
                'default' => esc_html__('Subtitle', 'benzo-toolkit'),
                'placeholder' => esc_html__('Type subtitle here', 'benzo-toolkit'),
                'condition' => [
                    'slider_condition' => ['design-1'],
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater->add_control(
            'title',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true,
                'label' => esc_html__('Title', 'benzo-toolkit'),
                'default' => esc_html__('Title Here', 'benzo-toolkit'),
                'placeholder' => esc_html__('Type title here', 'benzo-toolkit'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'description',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'label' => esc_html__('Description', 'benzo-toolkit'),
                'default' => esc_html__('Description', 'benzo-toolkit'),
                'placeholder' => esc_html__('Type description here', 'benzo-toolkit'),
                'condition' => [
                    'slider_condition' => ['design-2'],
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        //button
        $repeater->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Button Text',
                'placeholder' => esc_html__('Type button text here', 'benzo-toolkit'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'button_link',
            [
                'label' => esc_html__('Button Link', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => 'http://elementor.webtend.net/',
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'button2_text_two',
            [
                'label' => esc_html__('Button Text Two', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Button Text',
                'placeholder' => esc_html__('Type button text here', 'benzo-toolkit'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'button2_link_two',
            [
                'label' => esc_html__('Button Link Two', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => 'http://elementor.webtend.net/',
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $repeater->end_controls_tab();

        $this->add_control(
            'slides',
            [
                'show_label' => false,
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(title || "Carousel Item"); #>',
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
                    [
                        'image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ]
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
            '_style_content',
            [
                'label' => esc_html__('Style Title & Content', 'benzo-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Subtitle
        $this->add_control(
            'hero_subtitle',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Subtitle', 'benzo-toolkit'),
                'separator' => 'before'
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

        $this->end_controls_section();


        // Button One Style
        $this->start_controls_section(
            'section_button_style',
            [
                'label' => esc_html__( 'Button One', 'benzo-toolkit' ),
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

        $this->add_control(
            'button_bg_after_color',
            [
                'label'     => esc_html__( 'Background After Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-el-btn::after' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_bg_before_color',
            [
                'label'     => esc_html__( 'Background Before Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-el-btn::before' => 'background-color: {{VALUE}}',
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


         // Button Two Style
        $this->start_controls_section(
            'section2_button_style',
            [
                'label' => esc_html__( 'Button Two', 'benzo-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'button2_padding',
            [
                'label'      => esc_html__( 'Padding', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .webtend-el-btn2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'button2_border',
                'selector' => '{{WRAPPER}} .webtend-el-btn2',
            ]
        );

        $this->add_responsive_control(
            'button2_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .webtend-el-btn2' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'button2_typography',
                'label'    => esc_html__( 'Typography', 'benzo-toolkit' ),
                'selector' => '{{WRAPPER}} .webtend-el-btn2',
            ]
        );

        $this->start_controls_tabs( 'button2_tabs' );

        $this->start_controls_tab(
            'field2_button_normal',
            [
                'label' => esc_html__( 'Normal', 'benzo-toolkit' ),
            ]
        );

        $this->add_control(
            'button2_text_color',
            [
                'label'     => esc_html__( 'Text Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-btn2' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button2_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-btn2' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button2_bg_after_color',
            [
                'label'     => esc_html__( 'Background After Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-el-btn::after' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button2_bg_before_color',
            [
                'label'     => esc_html__( 'Background Before Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-el-btn::before' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'field2_button_hover',
            [
                'label' => esc_html__( 'Hover', 'benzo-toolkit' ),
            ]
        );

        $this->add_control(
            'button2_text_focus',
            [
                'label'     => esc_html__( 'Text Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-btn2:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button2_bg_color_focus',
            [
                'label'     => esc_html__( 'Background Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-btn2:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button2_border_focus',
            [
                'label'     => esc_html__( 'Border Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-btn2:hover' => 'border-color: {{VALUE}}',
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
        extract($settings);

        if (empty($settings['slides'])) {
            return;
        }

        $title = wp_kses_post($settings['title'] ?? '');
        $this->add_inline_editing_attributes('title', 'basic');
        $this->add_render_attribute('title', 'class', 'webtend-el-title');

        ?>
        <?php if ( 'design-1' === $settings['widget_design'] ) : ?>
        <div class="slider-area-one">
          <div class="hero-slider-active swiper-container">
            <div class="swiper-wrapper">
               <?php foreach ($settings['slides'] as $slide) : 
                $image = wp_get_attachment_image_url($slide['image']['id'], $settings['thumbnail_size']);

                ?>
                <div class="slider-item-one swiper-slide">
                    <div class="slider-area-one-bg" data-background="<?php print esc_url($slide['image']['url']); ?>"></div>
                      <div class="container">
                          <div class="row">
                              <div class="col-lg-12">
                                  <div class="slider-one-content">
                                      <div class="slider-one-video-popup">
                                          <a class="popup-video slider-popup" href="<?php echo esc_url($slide['video_url']); ?>"><i class="fas fa-play"></i></a>
                                      </div>
                                      <?php if (!empty($slide['sub_title'])) : ?>
                                      <h5 class="webtend-el-subtitle"><?php echo wp_kses_post($slide['sub_title']); ?></h5>
                                      <?php endif; ?>
                                      <?php if (!empty($slide['title'])) : ?>
                                      <div class="slider-one-title">
                                          <h2 class="webtend-el-title"><?php echo wp_kses_post($slide['title']); ?></h2>
                                      </div>
                                      <?php endif; ?>
                                      <div class="slider-one-btn">
                                        <!-- Button Style one -->
                                          <a class="benzo-el-btn webtend-el-btn" href="<?php echo esc_url($slide['button_link']['url']); ?>"><?php echo wp_kses_post($slide['button_text']); ?></a>
                                        <!-- Button Style Two -->
                                         <a class="benzo-el-btn el-btn-white webtend-el-btn2" href="<?php echo esc_url($slide['button2_link_two']['url']); ?>"><?php echo wp_kses_post($slide['button2_text_two']); ?></a>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                    </div>
                   <?php endforeach; ?>
                 </div>
              </div>
              <div class="hero__slider-one">
                  <div class="hero__slider-one-next swiper-button-next"><i class="fal fa-chevron-right"></i></div>
                  <div class="hero__slider-one-prev swiper-button-prev"><i class="fal fa-chevron-left"></i></div>
               </div>
          </div>
        </div>
        <?php endif; ?>

        <?php if ( 'design-2' === $settings['widget_design'] ) : ?>
            <div class="slider-area-two">
                <div class=" swiper-container hero-slider-active2">
                <div class="swiper-wrapper">
                <?php foreach ($settings['slides'] as $slide) : 
                     if (!empty($slide['image']['id'])) {
                        $image = wp_get_attachment_image_url($slide['image']['id'], $settings['thumbnail_size']);
                    }
                ?>
                <div class="swiper-slide">
                <div class="slider-area-bg" data-background="<?php print esc_url($slide['image']['url']); ?>">
                <div class="slider-bg-shape-one"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/slider-shape-1.png" alt="img"></div>
                <div class="slider-bg-shape-two"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/slider-shape-2.png" alt="img"></div>
                <div class="slider-bg-shape"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="slider-content-two webtend-el-content">
                                   <?php if (!empty($slide['title'])) : ?>
                                    <h2 class="webtend-el-title"><?php echo wp_kses_post($slide['title']); ?></h2>
                                    <?php endif; ?>
                                    <?php if (!empty($slide['description'])) : ?>
                                    <p><?php echo wp_kses_post($slide['description']); ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="slider-two-btn">
                                    <!-- Button Style one -->
                                    <a class="benzo-el-btn webtend-el-btn" href="<?php echo esc_url($slide['button_link']['url']); ?>"><?php echo wp_kses_post($slide['button_text']); ?></a>
                                    <!-- Button Style Two -->
                                    <a class="benzo-el-btn el-btn-white webtend-el-btn2" href="<?php echo esc_url($slide['button2_link_two']['url']); ?>"><?php echo wp_kses_post($slide['button2_text_two']); ?></a>
                                </div>
                            </div>
                        </div>
                       </div>
                     </div>
                  </div>
                  <?php endforeach; ?>
                 </div>
               </div>
               <div class="hero__slider-two">
                  <div class="hero__slider-two-next swiper-button-next"><i class="fal fa-chevron-right"></i></div>
                  <div class="hero__slider-two-prev swiper-button-prev"><i class="fal fa-chevron-left"></i></div>
               </div>
            </div>
        <?php endif; ?>     

        <?php
}
}