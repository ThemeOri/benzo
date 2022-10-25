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
                    'design-3' => esc_html__( 'Design Three', 'benzo-toolkit' ),
                ],
                'default' => 'design-1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_media',
            [
                'label' => esc_html__('Icon', 'benzo-toolkit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'widget_design' => ['design-1'],
                ],
            ]
        );

        $this->add_control(
			'icon',
			[
				'type' => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'label_block' => true,
				'default' => [
					'value' => 'fas fa-smile-wink',
					'library' => 'fa-solid',
				],
			]
		);


        $this->end_controls_section();

        $this->start_controls_section(
            '_section_fanfact',
            [
                'label' => esc_html__('Fan Fact Content', 'benzo-toolkit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'widget_design' => ['design-1','design-3'],
                ],
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
            '_section_fanfact_list',
            [
                'label' => esc_html__('Fan Fact List', 'benzo-toolkit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'selected_icon',
			[
				'type' => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'label_block' => true,
				'default' => [
					'value' => 'fas fa-smile-wink',
					'library' => 'fa-solid',
				],
			]
		);

        $repeater->add_control(
            'fanfact_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__('300', 'benzo-toolkit'),
                'placeholder' => esc_html__('300', 'benzo-toolkit'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'fanfact_symbols',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__('+', 'benzo-toolkit'),
                'placeholder' => esc_html__('+', 'benzo-toolkit'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'fanfact_subtitle',
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

        $this->add_control(
            'slides',
            [
                'show_label' => false,
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(fanfact_title || "Carousel Item"); #>',
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

        if (empty($settings['slides'])) {
            return;
        }

        $title = wp_kses_post($settings['title'] ?? '');

        ?>

       <?php if ( 'design-1' === $settings['widget_design'] ) : ?>
        <div class="fanfact__area-wrapper">
          <div class="fanfact__area-item">
             <div class="fanfact-icon-one">
                <span>  <i class="fanfact-icon-up <?php echo $settings['icon']['value'];?>"></i></span>
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
                    <?php foreach ($settings['slides'] as $slide) : ?>
                        <div class="col-lg-3">
                            <div class="fanfact-item-two">
                                <div class="fanfact-icon-two">
                                    <i class="fanfact-icon-up <?php echo $slide['selected_icon']['value'];?>"></i>
                                </div>
                                <div class="fanfact-content-two">
                                <?php if (!empty($slide['fanfact_title'])) : ?>
                                <h3 class="webtend-el-title"><span class="counter webtend-el-title"><?php echo wp_kses_post($slide['fanfact_title']); ?></span><?php echo wp_kses_post($slide['fanfact_symbols']); ?></h3>
                                <?php endif; ?>
                                <?php if (!empty($slide['fanfact_subtitle'])) : ?>
                                    <h5 class="webtend-el-subtitle"> <?php echo wp_kses_post($slide['fanfact_subtitle']); ?> </h5>
                                <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if ( 'design-3' === $settings['widget_design'] ) : ?>
            <div class="fanfact-percent-area">
                <div class="fanfact-percent-content">
                <?php if ($settings['title']) : ?>
                    <h5 class="webtend-el-title"><span class="counter webtend-el-title"><?php echo wp_kses_post($settings['title']); ?></span><?php echo wp_kses_post($settings['symbols']); ?></h5>
                <?php endif; ?>
                <?php if ($settings['sub_title']) : ?>
                    <p class="webtend-el-subtitle"><?php echo wp_kses_post($settings['sub_title']); ?></p>
                <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>    

        <?php
}
}