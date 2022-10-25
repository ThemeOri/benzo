<?php
namespace BenzoToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Utils;

defined( 'ABSPATH' ) || exit;

class Benzo_Testimonial extends Widget_Base {

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
        return 'benzo-testimonial';
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
        return esc_html__( 'Benzo Testimonial', 'benzo-toolkit' );
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
        return 'eicon-testimonial';
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
        return ['Benzo', 'Toolkit', 'Testimonial', 'slider'];
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
                'label' => esc_html__('Testimoniyal Slider', 'benzo-toolkit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'image',
            [
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label' => esc_html__('Profile Image', 'benzo-toolkit'),
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'client_name',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => esc_html__('Client Name', 'benzo-toolkit'),
                'placeholder' => esc_html__('Type client name here', 'benzo-toolkit'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'designation',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__('Designation', 'benzo-toolkit'),
                'placeholder' => esc_html__('Type designation here', 'benzo-toolkit'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'messages',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => esc_html__('Messages', 'benzo-toolkit'),
                'placeholder' => esc_html__('Type messages here', 'benzo-toolkit'),
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
                'title_field' => '<# print(client_name || "Carousel Item"); #>',
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
                'label' => esc_html__('Title', 'webtend-el-title'),
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
                    '{{WRAPPER}} .webtend-el-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_slider_color',
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
                'name' => 'title-slider',
                'selector' => '{{WRAPPER}} .webtend-el-title',
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
                    '{{WRAPPER}} .webtend-el-subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'subtitle_slider_color',
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
                'name' => 'subtitle-slider',
                'selector' => '{{WRAPPER}} .webtend-el-subtitle',
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
        <div class="testimonial__wrapper-one">
            <div class="swiper-container testimonial-active">
                <div class="swiper-wrapper">
                <?php foreach ($settings['slides'] as $slide) : 
                     if (!empty($slide['image']['id'])) {
                        $image = wp_get_attachment_image_url($slide['image']['id'], $settings['thumbnail_size']);
                    }
                ?>
                    <div class="swiper-slide">
                        <div class="testimoniyal-item">
                            <div class="testimoniyal-thumb">
                                <img src="<?php print esc_url($slide['image']['url']); ?>" alt="img">
                                <div class="testimoniyal-quote">
                                    <span><i class="fal fa-quote-right"></i></span>
                                </div>
                            </div>
                            <div class="testimoniyal-content webtend-el-content">
                            <?php if (!empty($slide['client_name'])) : ?>
                                <h4 class="webtend-el-title"><?php echo wp_kses_post($slide['client_name']); ?></h4>
                                <?php endif; ?>
                                <?php if (!empty($slide['designation'])) : ?>
                                <span class="webtend-el-subtitle"><?php echo wp_kses_post($slide['designation']); ?></span>
                                <?php endif; ?>
                                <ul>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                </ul>
                                <?php if (!empty($slide['messages'])) : ?>
                                <p><?php echo wp_kses_post($slide['messages']); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="testimoniyal-pagination">
                 <div class="pagination"></div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if ( 'design-2' === $settings['widget_design'] ) : ?>
            
            <div class="testimonial__wrapper-two myslider">
            <?php foreach ($settings['slides'] as $slide) : 
                     if (!empty($slide['image']['id'])) {
                        $image = wp_get_attachment_image_url($slide['image']['id'], $settings['thumbnail_size']);
                    }
            ?>
                <div class="testimonial-item-two">
                    <div class="testimonial-thumb-two">
                        <img src="<?php print esc_url($slide['image']['url']); ?>" alt="img">
                        <div class="testimonial-quote-two">
                            <i class="fal fa-quote-right"></i>
                        </div>
                    </div>
                    <div class="testimonial-content-two webtend-el-content">
                        <?php if (!empty($slide['messages'])) : ?>
                            <p><?php echo wp_kses_post($slide['messages']); ?></p>
                        <?php endif; ?>
                        <?php if (!empty($slide['client_name'])) : ?>
                        <h4 class="webtend-el-title"><?php echo wp_kses_post($slide['client_name']); ?> <span class="webtend-el-subtitle"> <?php echo wp_kses_post($slide['designation']); ?> </span></h4> 
                        <?php endif; ?>   
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
    <?php endif; ?>  

        <?php
}
}