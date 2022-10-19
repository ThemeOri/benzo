<?php
namespace BenzoToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Utils;

defined( 'ABSPATH' ) || exit;

class Benzo_Icon_List extends Widget_Base {

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
        return 'benzo-icon-list';
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
        return esc_html__( 'Benzo Icon List', 'benzo-toolkit' );
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
        return 'eicon-bullet-list';
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
        return ['Benzo', 'Toolkit', 'Process', 'List','Features','Icon'];
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
            '_section_icon_list',
            [
                'label' => esc_html__('Icon List', 'benzo-toolkit'),
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
            'bg_image',
            [
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label' => esc_html__('Icon BG Image', 'benzo-toolkit'),
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'shape_image',
            [
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label' => esc_html__('Shape Image', 'benzo-toolkit'),
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
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
                'default' => esc_html__('URL', 'benzo-toolkit'),
                'placeholder' => esc_html__('#', 'benzo-toolkit'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'slider_description',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => esc_html__('Description', 'benzo-toolkit'),
                'placeholder' => esc_html__('Type description here', 'benzo-toolkit'),
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
                'label' => esc_html__('Style Icon Title & Content', 'benzo-toolkit'),
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

       <div class="process__list-wrapper-one">
        <?php foreach ($settings['slides'] as $slide) : 
                if (!empty($slide['bg_image']['id'])) {
                    $bg_image = wp_get_attachment_image_url($slide['bg_image']['id'], $settings['thumbnail_size']);
                }
                if (!empty($slide['shape_image']['id'])) {
                    $shape_image = wp_get_attachment_image_url($slide['shape_image']['id'], $settings['thumbnail_size']);
                }
        ?>
            <div class="process__list-item">
                <div class="process-icon-list">
                    <div class="process-icon-bg-thumb">
                        <img src="<?php print esc_url($slide['bg_image']['url']); ?>" alt="img">
                        <div class="process-icon-one">
                        <span><i class="<?php echo $slide['selected_icon']['value'];?>"></i></span>
                        </div>
                    </div>
                    <div class="process-icon-shape">
                       <img src="<?php print esc_url($slide['shape_image']['url']); ?>" alt="img">
                    </div>
                </div>
                <div class="process__list-content webtend-el-content">
                    <?php if (!empty($slide['slider_title'])) : ?>
                    <h4 class="webtend-el-title"><a class="webtend-el-title" href="<?php echo esc_url($slide['slider_url']); ?>"><?php echo wp_kses_post($slide['slider_title']); ?></a></h4>
                    <?php endif; ?>
                    <?php if (!empty($slide['slider_description'])) : ?>
                    <p><?php echo wp_kses_post($slide['slider_description']); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
       </div>

        <?php
}
}