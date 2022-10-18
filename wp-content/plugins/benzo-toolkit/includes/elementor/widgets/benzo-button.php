<?php
namespace BenzoToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Utils;

defined( 'ABSPATH' ) || exit;

class Benzo_button extends Widget_Base {

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
        return 'benzo-button';
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
        return esc_html__( 'Benzo Button', 'benzo-toolkit' );
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
        return ' eicon-button';
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
        return ['Benzo', 'Toolkit', 'button', 'cta'];
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
            'section_media',
            [
                'label' => esc_html__('Author Image', 'benzo-toolkit'),
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
            'section_author',
            [
                'label' => esc_html__('Author Info', 'benzo-toolkit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'author_title',
            [
                'label' => esc_html__('Title', 'benzo-toolkit'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'rows' => 4,
                'default' => 'Title',
                'placeholder' => esc_html__('Title', 'benzo-toolkit'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'author_designation',
            [
                'label' => esc_html__('Designation', 'benzo-toolkit'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 4,
                'default' => 'designation',
                'placeholder' => esc_html__('designation', 'benzo-toolkit'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->end_controls_section();


        // Button
        $this->start_controls_section(
            '_section_button',
            [
                'label' => esc_html__('Button', 'benzo-toolkit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'benzo-toolkit'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Button Text',
                'placeholder' => esc_html__('button text', 'benzo-toolkit'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => esc_html__('Link', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => 'https://example.com',
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
            '_section_style_content',
            [
                'label' => esc_html__('Style Author Title & Content', 'benzo-toolkit'),
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
            'designation_style',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Designation', 'benzo-toolkit'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'designation_spacing',
            [
                'label' => esc_html__('Designation Spacing', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'designation_color',
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
                'name' => 'designation',
                'selector' => '{{WRAPPER}} .webtend-el-subtitle',
            ]
        );


        $this->end_controls_section();


        // Button 
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

       <div class="about__author-info">
          <div class="about__author">
          <?php if ( $settings['image']['url'] ): ?>
             <div class="about__author-thumb">
                <img src="<?php echo esc_attr( $settings['image']['url'] ) ?>" alt="img">
             </div>
             <?php endif;?>
             <?php if ($settings['author_title']) : ?>
             <div class="about__author-content">
               <h5 class="webtend-el-title"><?php echo wp_kses_post($settings['author_title']); ?></h5>
               <span class="webtend-el-subtitle"><?php echo wp_kses_post($settings['author_designation']); ?></span>
             </div>
             <?php endif;?>
          </div>
          <div class="common-btn">
           <a class="benzo-el-btn webtend-el-btn common-el-btn" href="<?php echo esc_url($settings['button_link']['url']); ?>">
             <?php echo wp_kses_post($settings['button_text']); ?>
           </a>
        </div>
       </div>

        <?php
}
}