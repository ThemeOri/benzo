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
                'dynamic' => [
                    'active' => true,
                ]
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
                'dynamic' => [
                    'active' => true,
                ]
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
                'placeholder' => 'http://elementor.bdevs.net/',
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'button_text_two',
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
            'button_link_two',
            [
                'label' => esc_html__('Button Link Two', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => 'http://elementor.bdevs.net/',
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
                    '{{WRAPPER}} .benzo-mailchimp-wrapper input[type=submit], {{WRAPPER}} .benzo-mailchimp-wrapper button[type=submit]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'button_border',
                'selector' => '{{WRAPPER}} .benzo-mailchimp-wrapper input[type=submit], {{WRAPPER}} .benzo-mailchimp-wrapper button[type=submit]',
            ]
        );

        $this->add_responsive_control(
            'button_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-mailchimp-wrapper input[type=submit], {{WRAPPER}} .benzo-mailchimp-wrapper button[type=submit]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'button_typography',
                'label'    => esc_html__( 'Typography', 'benzo-toolkit' ),
                'selector' => '{{WRAPPER}} .benzo-mailchimp-wrapper input[type=submit], {{WRAPPER}} .benzo-mailchimp-wrapper button[type=submit]',
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
                    '{{WRAPPER}} .benzo-mailchimp-wrapper input[type=submit], {{WRAPPER}} .benzo-mailchimp-wrapper button[type=submit]' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-mailchimp-wrapper input[type=submit], {{WRAPPER}} .benzo-mailchimp-wrapper button[type=submit]' => 'background-color: {{VALUE}}',
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
                    '{{WRAPPER}} .benzo-mailchimp-wrapper input[type=submit]:hover, {{WRAPPER}} .benzo-mailchimp-wrapper button[type=submit]:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color_focus',
            [
                'label'     => esc_html__( 'Background Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-mailchimp-wrapper input[type=submit]:hover, {{WRAPPER}} .benzo-mailchimp-wrapper button[type=submit]:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_border_focus',
            [
                'label'     => esc_html__( 'Border Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-mailchimp-wrapper input[type=submit]:hover, {{WRAPPER}} .benzo-mailchimp-wrapper button[type=submit]:hover' => 'border-color: {{VALUE}}',
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

        if (empty($settings['slides'])) {
            return;
        }

        $title = wp_kses_post($settings['title'] ?? '');

        ?>

        <div class="slider-area-one">
          <div class="hero-slider-active swiper-container">
            <div class="swiper-wrapper">
               <?php foreach ($settings['slides'] as $key => $slide) : 
                $image = wp_get_attachment_image_url($slide['image']['id'], $settings['thumbnail_size']);
                $this->add_render_attribute('button_' . $key, 'class', 'benzo-el-btn');
                $this->add_render_attribute('button_' . $key, 'href', $slide['button_link']['url']);
                ?>
                <div class="slider-item-one swiper-slide">
                    <div class="slider-area-one-bg" data-background="<?php print esc_url($image); ?>"></div>
                      <div class="container">
                          <div class="row">
                              <div class="col-lg-12">
                                  <div class="slider-one-content">
                                      <div class="slider-one-video-popup">
                                          <a class="popup-video slider-popup" href="<?php echo esc_url($slide['video_url']); ?>"><i class="fas fa-play"></i></a>
                                      </div>
                                      <?php if (!empty($slide['sub_title'])) : ?>
                                      <h5><?php echo wp_kses_post($slide['sub_title']); ?></h5>
                                      <?php endif; ?>
                                      <?php if (!empty($slide['title'])) : ?>
                                      <div class="slider-one-title">
                                          <h2><?php echo wp_kses_post($slide['title']); ?></h2>
                                      </div>
                                      <?php endif; ?>
                                      <div class="slider-one-btn">
                                          <?php if ($slide['button_text'] && ((empty($slide['button_selected_icon']) || empty($slide['button_selected_icon']['value'])) && empty($slide['button_icon']))) :
                                                printf(
                                                    '<a %1$s>%2$s</a>',
                                                    $this->get_render_attribute_string('button_' . $key),
                                                    esc_html($slide['button_text'])
                                                );
                                            elseif (empty($slide['button_text']) && ((!empty($slide['button_selected_icon']) || empty($slide['button_selected_icon']['value'])) || !empty($slide['button_icon']))) : ?>
                                                <a <?php $this->print_render_attribute_string('button_' . $key); ?>><?php bdevs_element_render_icon($slide, 'button_icon', 'button_selected_icon'); ?></a>
                                                <?php elseif ($slide['button_text'] && ((!empty($slide['button_selected_icon']) || empty($slide['button_selected_icon']['value'])) || !empty($slide['button_icon']))) :
                                                if ($slide['button_icon_position'] === 'before') : ?>
                                                    <a <?php $this->print_render_attribute_string('button_' . $key); ?>><span><?php bdevs_element_render_icon($slide, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon']); ?></span> <?php echo esc_html($slide['button_text']); ?></a>
                                                <?php
                                                else : ?>
                                                    <a <?php $this->print_render_attribute_string('button_' . $key); ?>><?php echo esc_html($slide['button_text']); ?> <span><?php bdevs_element_render_icon($slide, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon']); ?></span></a>
                                            <?php
                                                endif;
                                            endif; ?>
                                        <a class="benzo-el-btn el-btn-white" href="#">Contact Us_</a>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                    </div>
                   <?php endforeach; ?>
                 </div>
              </div>
          </div>
        </div>

        <?php
}
}