<?php
namespace BenzoToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Utils;

defined( 'ABSPATH' ) || exit;

class Benzo_CTA extends Widget_Base {

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
        return 'benzo-cta';
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
        return esc_html__( 'Benzo CTA', 'benzo-toolkit' );
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
        return 'eicon-section';
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
        return ['Benzo', 'Toolkit', 'box', 'service','cta'];
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
                ],
                'default' => 'design-1',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            '_section_title_left',
            [
                'label' => esc_html__('CTA Left Content', 'benzo-toolkit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title_left',
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
            'description_left',
            [
                'label' => esc_html__('Description', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__('Heading Description Text', 'benzo-toolkit'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'button_link_left',
            [
                'label' => esc_html__('Button URL', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => 'URL',
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => '#'
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_title_right',
            [
                'label' => esc_html__('CTA Right Content', 'benzo-toolkit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title_right',
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
            'description_right',
            [
                'label' => esc_html__('Description', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__('Heading Description Text', 'benzo-toolkit'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'button_link_right',
            [
                'label' => esc_html__('Button URL', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => 'URL',
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => '#'
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_button',
            [
                'label' => esc_html__('Style CTA Left', 'benzo-toolkit'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

         // Title
        $this->add_control(
            '_heading_title_left',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Title', 'benzo-toolkit'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'title_spacing_left',
            [
                'label' => esc_html__('Bottom Spacing', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-title-left' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

       $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography_left',
                'label' => esc_html__('Typography', 'benzo-toolkit'),
                'selector' => '{{WRAPPER}} .webtend-el-title-left',
            ]
        );

        $this->add_control(
            'title_color_left',
            [
                'label' => esc_html__('Color', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-title-left' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'cta_bg_color_left',
            [
                'label'     => esc_html__( 'Background Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cta-left-item' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        // description
        $this->add_control(
            '_content_description_left',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Description', 'benzo-toolkit'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'description_spacing_left',
            [
                'label' => esc_html__('Bottom Spacing', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-des-left p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'description_color_left',
            [
                'label' => esc_html__('Text Color', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-des-left p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_left',
                'selector' => '{{WRAPPER}} .webtend-el-des-left p',
            ]
        );

         $this->add_responsive_control(
            'description_spacing_left',
            [
                'label' => esc_html__('Bottom Spacing', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-des-left p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_right',
            [
                'label' => esc_html__('Style CTA Right', 'benzo-toolkit'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

         // Title
        $this->add_control(
            '_heading_title_right',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Title', 'benzo-toolkit'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'title_spacing_right',
            [
                'label' => esc_html__('Bottom Spacing', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-title-right' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

       $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography_right',
                'label' => esc_html__('Typography', 'benzo-toolkit'),
                'selector' => '{{WRAPPER}} .webtend-el-title-right',
            ]
        );

        $this->add_control(
            'title_color_right',
            [
                'label' => esc_html__('Color', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-title-right' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'cta_bg_color_right',
            [
                'label'     => esc_html__( 'Background Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cta-right-item' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        // description
        $this->add_control(
            '_content_description_right',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Description', 'benzo-toolkit'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'description_spacing_right',
            [
                'label' => esc_html__('Bottom Spacing', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-des-right p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'description_color_right',
            [
                'label' => esc_html__('Text Color', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-des-right p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_right',
                'selector' => '{{WRAPPER}} .webtend-el-des-right p',
            ]
        );

         $this->add_responsive_control(
            'description_spacing_right',
            [
                'label' => esc_html__('Bottom Spacing', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-des-right p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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

        ?>

       <?php if ( 'design-1' === $settings['widget_design'] ) : ?>

        <div class="cta__area-wrapper">
            <div class="container">
                 <div class="row">
                    <div class="col-lg-6 pl-0">
                        <div class="cta-left-item">
                            <div class="cta-left-content webtend-el-des-left">
                                <?php if ($settings['title_left']) : ?>
                                <h3 class="webtend-el-title-left"><?php echo wp_kses_post($settings['title_left']); ?></h3>
                                <?php endif; ?>
                                <?php if ($settings['description_left']) : ?>
                                <p><?php echo wp_kses_post($settings['description_left']); ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="cta-left-btn">
                                <a class="features-sp-btn" href="<?php echo esc_url($settings['button_link_left']['url']); ?>">
                                 <i class="fal fa-long-arrow-right"></i>
                                 <i class="fal fa-long-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 pr-0">
                      <div class="cta-right-item">
                        <div class="cta-right-content webtend-el-des-right">
                            <?php if ($settings['title_right']) : ?>
                                <h3 class="webtend-el-title-right"><?php echo wp_kses_post($settings['title_right']); ?></h3>
                            <?php endif; ?>
                            <?php if ($settings['description_right']) : ?>
                                <p><?php echo wp_kses_post($settings['description_right']); ?></p>
                            <?php endif; ?>
                            </div>
                            <div class="cta-left-btn">
                                <a class="features-sp-btn" href="<?php echo esc_url($settings['button_link_right']['url']); ?>">
                                 <i class="fal fa-long-arrow-right"></i>
                                 <i class="fal fa-long-arrow-right"></i>
                                </a>
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