<?php
namespace BenzoToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Utils;

defined( 'ABSPATH' ) || exit;

class Benzo_Fanfact extends Widget_Base {

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
        return 'benzo-fanfact';
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
        return esc_html__( 'Benzo Fan Fact', 'benzo-toolkit' );
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
        return 'eicon-nerd';
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
        return ['Benzo', 'Toolkit', 'counter', 'fan','fanfact'];
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
            '_section_media',
            [
                'label' => esc_html__('Icon / Image', 'benzo-toolkit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'media_type',
            [
                'label'          => esc_html__('Media Type', 'benzo-toolkit'),
                'type'           => \Elementor\Controls_Manager::CHOOSE,
                'label_block'    => false,
                'options'        => [
                    'icon'  => [
                        'title' => esc_html__('Icon', 'benzo-toolkit'),
                        'icon'  => 'far fa-grin-wink',
                    ],
                    'image' => [
                        'title' => esc_html__('Image', 'benzo-toolkit'),
                        'icon'  => 'eicon-image',
                    ],
                ],
                'default'        => 'icon',
                'toggle'         => false,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'image',
            [
                'label'     => esc_html__('Image', 'benzo-toolkit'),
                'type'      => \Elementor\Controls_Manager::MEDIA,
                'default'   => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'media_type' => 'image'
                ],
                'dynamic'   => [
                    'active' => true,
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name'      => 'thumbnail',
                'default'   => 'medium_large',
                'separator' => 'none',
                'exclude'   => [
                    'full',
                    'custom',
                    'large',
                    'shop_catalog',
                    'shop_single',
                    'shop_thumbnail'
                ],
                'condition' => [
                    'media_type' => 'image'
                ]
            ]
        );

        $this->add_control(
            'icons',
            [
                'label'      => esc_html__('Icons', 'benzo-toolkit'),
                'type'       => \Elementor\Controls_Manager::ICONS,
                'show_label' => true,
                'default'    => [
                    'value'   => 'far fa-grin-wink',
                    'library' => 'solid',
                ],
                'condition'  => [
                    'media_type' => 'icon',
                ],

            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_fanfact',
            [
                'label' => esc_html__('Fan Fact Content', 'benzo-toolkit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Counter Number', 'benzo-toolkit'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 4,
                'default' => '366',
                'placeholder' => esc_html__('Counter Number', 'benzo-toolkit'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'symbols',
            [
                'label' => esc_html__('Symbols', 'benzo-toolkit'),
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
            'sub_title',
            [
                'label' => esc_html__('Sub Title', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'placeholder' => esc_html__('Type text here', 'benzo-toolkit'),
                'default' => esc_html__('Type text here', 'benzo-toolkit'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_content',
            [
                'label' => esc_html__('Style Heading Title & Content', 'benzo-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
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
        <div class="fanfact__area-wrapper">
          <div class="fanfact__area-item">
             <div class="fanfact-icon-one">
                <span> <?php \Elementor\Icons_Manager::render_icon($settings['icons'], ['aria-hidden' => 'true']); ?></span>
             </div>
             <div class="fanfact-content-one">
             <?php if ($settings['title']) : ?>
                <h2 class="webtend-el-title"><span class="counter webtend-el-title"><?php echo wp_kses_post($settings['title']); ?></span>
                <?php endif; ?>
                <?php if ($settings['symbols']) : ?>
                <?php echo wp_kses_post($settings['symbols']); ?>
                <?php endif; ?>
                </h2>
                <?php if ($settings['sub_title']) : ?>
                <span class="webtend-el-subtitle"><?php echo wp_kses_post($settings['sub_title']); ?></span>
                <?php endif; ?>
             </div>
          </div>
        </div>
        <?php endif; ?>

        <?php if ( 'design-2' === $settings['widget_design'] ) : ?>
            <div class="fanfact__area-two">
                <div class="container">
                    <div class="row fanfact-bg-two">
                        <div class="col-lg-3">
                            <div class="fanfact-item-two">
                                <div class="fanfact-icon-two">
                                    <i class="fanfact-icon-up fal fa-thumbs-up"></i>
                                </div>
                                <div class="fanfact-content-two">
                                    <h3><span>308</span>+</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="fanfact-item-two">
                                <div class="fanfact-icon-two">
                                   <i class="fanfact-icon-up fal fa-thumbs-up"></i>
                                </div>
                                <div class="fanfact-content-two">
                                    <h3><span>308</span>+</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="fanfact-item-two">
                                <div class="fanfact-icon-two">
                                   <i class="fanfact-icon-up fal fa-thumbs-up"></i>
                                </div>
                                <div class="fanfact-content-two">
                                    <h3><span>308</span>+</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="fanfact-item-two">
                                <div class="fanfact-icon-two">
                                   <i class="fanfact-icon-up fal fa-thumbs-up"></i>
                                </div>
                                <div class="fanfact-content-two">
                                    <h3><span>308</span>+</h3>
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