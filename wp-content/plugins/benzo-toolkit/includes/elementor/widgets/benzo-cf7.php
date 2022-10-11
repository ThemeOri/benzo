<?php
namespace BenzoToolkit\ElementorAddon\Widgets;

use BenzoToolkit\Helper\Benzo_Toolkit_Helper;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Benzo_CF7 extends Widget_Base {

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
        return 'benzo-cf7';
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
        return esc_html__( 'Benzo Contact Form 7', 'benzo-toolkit' );
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
        return 'eicon-mail';
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
        return ['benzo', 'toolkit', 'form', 'contact', 'cf7', 'form'];
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
                'label' => esc_html__( 'Form', 'benzo-toolkit' ),
            ]
        );

        $this->add_control(
            'form_id',
            [
                'label'       => esc_html__( 'Select Your Form', 'benzo-toolkit' ),
                'type'        => Controls_Manager::SELECT,
                'label_block' => true,
                'options'     => Benzo_Toolkit_Helper::get_all_cf7(),
                'default'     => '0',
                'description' => esc_html__( "Contact Form 7 - plugin must be installed and there must be some contact forms made with the Contact Form 7 . For More information visit Theme Documentation", 'benzo-toolkit' ),
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'section_fields_style',
            [
                'label' => esc_html__( 'Form Fields', 'benzo-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'field_width',
            [
                'label'          => esc_html__( 'Width', 'benzo-toolkit' ),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units'     => ['%', 'px'],
                'range'          => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .benzo-cf7 .wpcf7-form-control:not(.wpcf7-submit)' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'field_height',
            [
                'label'      => esc_html__( 'Height', 'benzo-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-cf7 .wpcf7-form-control:not(.wpcf7-submit)' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'field_textarea_height',
            [
                'label'      => esc_html__( 'Textarea Height', 'benzo-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 800,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-cf7 .wpcf7-form-control.wpcf7-textarea' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'field_margin',
            [
                'label'      => esc_html__( 'Field Spacing Bottom', 'benzo-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-cf7 .wpcf7-form-control:not(.wpcf7-submit)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'field_padding',
            [
                'label'      => esc_html__( 'Padding', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-cf7 .wpcf7-form-control:not(.wpcf7-submit)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'hr',
            [
                'type'  => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'field_border',
                'selector' => '{{WRAPPER}} .benzo-cf7 .wpcf7-form-control:not(.wpcf7-submit)',
            ]
        );

        $this->add_responsive_control(
            'field_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-cf7 .wpcf7-form-control:not(.wpcf7-submit)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'hr2',
            [
                'type'  => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'field_typography',
                'label'    => esc_html__( 'Typography', 'benzo-toolkit' ),
                'selector' => '{{WRAPPER}} .benzo-cf7 .wpcf7-form-control:not(.wpcf7-submit)',
            ]
        );

        $this->add_control(
            'field_placeholder_color',
            [
                'label'     => esc_html__( 'Field Placeholder Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-cf7 ::-webkit-input-placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .benzo-cf7 ::-moz-placeholder'          => 'color: {{VALUE}};',
                    '{{WRAPPER}} .benzo-cf7 ::-ms-input-placeholder'     => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_field_state' );

        $this->start_controls_tab(
            'tab_field_normal',
            [
                'label' => esc_html__( 'Normal State', 'benzo-toolkit' ),
            ]
        );

        $this->add_control(
            'field_text_color',
            [
                'label'     => esc_html__( 'Field Text Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-cf7 .wpcf7-form-control:not(.wpcf7-submit)' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'field_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-cf7 .wpcf7-form-control:not(.wpcf7-submit)' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_field_focus',
            [
                'label' => esc_html__( 'Focus', 'benzo-toolkit' ),
            ]
        );

        $this->add_control(
            'field_focus_text_color',
            [
                'label'     => esc_html__( 'Field Text Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-cf7 .wpcf7-form-control:not(.wpcf7-submit):focus' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'field_focus_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-cf7 .wpcf7-form-control:not(.wpcf7-submit):focus' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'field_focus_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-cf7 .wpcf7-form-control:not(.wpcf7-submit):focus' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'wpf-form-label',
            [
                'label' => esc_html__( 'Form Fields Label', 'benzo-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'label_margin',
            [
                'label'      => esc_html__( 'Margin', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-cf7 label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'label_padding',
            [
                'label'      => esc_html__( 'Padding', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-cf7 label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'hr3',
            [
                'type'  => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->add_control(
            'label_color',
            [
                'label'     => esc_html__( 'Label Text Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-cf7 label' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'label_typography',
                'label'    => esc_html__( 'Label Typography', 'benzo-toolkit' ),
                'selector' => '{{WRAPPER}} .benzo-cf7 label',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'submit',
            [
                'label' => esc_html__( 'Submit Button', 'benzo-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'button_width',
            [
                'label'      => esc_html__( 'Button Width', 'benzo-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'default'    => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'range'      => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 800,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-cf7 .wpcf7-submit, {{WRAPPER}} .benzo-cf7 button[type=submit]' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'submit_btn_position',
            [
                'label'     => esc_html__( 'Button Position', 'benzo-toolkit' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => esc_html__( 'Left', 'benzo-toolkit' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'benzo-toolkit' ),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__( 'Right', 'benzo-toolkit' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'toggle'    => false,
                'selectors' => [
                    '{{WRAPPER}} .benzo-cf7 .input-submit' => 'text-align: {{Value}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'submit_margin',
            [
                'label'      => esc_html__( 'Margin', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-cf7 .wpcf7-submit, {{WRAPPER}} .benzo-cf7 button[type=submit]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'submit_padding',
            [
                'label'      => esc_html__( 'Padding', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-cf7 .wpcf7-submit, {{WRAPPER}} .benzo-cf7 button[type=submit]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'hr4',
            [
                'type'  => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'submit_typography',
                'selector' => '{{WRAPPER}} .benzo-cf7 .wpcf7-submit, {{WRAPPER}} .benzo-cf7 button[type=submit]',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'submit_border',
                'selector' => '{{WRAPPER}} .benzo-cf7 .wpcf7-submit, {{WRAPPER}} .benzo-cf7 button[type=submit]',
            ]
        );

        $this->add_responsive_control(
            'submit_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-cf7 .wpcf7-submit, {{WRAPPER}} .benzo-cf7 button[type=submit]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'hr5',
            [
                'type'  => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->start_controls_tabs( 'tabs_button_style' );

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => esc_html__( 'Normal', 'benzo-toolkit' ),
            ]
        );

        $this->add_control(
            'submit_color',
            [
                'label'     => esc_html__( 'Text Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .benzo-cf7 .wpcf7-submit, {{WRAPPER}} .benzo-cf7 button[type=submit]' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'submit_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-cf7 .wpcf7-submit, {{WRAPPER}} .benzo-cf7 button[type=submit]' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => esc_html__( 'Hover', 'benzo-toolkit' ),
            ]
        );

        $this->add_control(
            'submit_hover_color',
            [
                'label'     => esc_html__( 'Text Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-cf7 .wpcf7-submit:hover, {{WRAPPER}} .benzo-cf7 button[type=submit]:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'submit_hover_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-cf7 .wpcf7-submit:hover, {{WRAPPER}} .benzo-cf7 button[type=submit]:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'submit_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-cf7 .wpcf7-submit:hover, {{WRAPPER}} .benzo-cf7 button[type=submit]:hover' => 'border-color: {{VALUE}};',
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
        $settings = $this->get_settings();

        if ( function_exists( 'wpcf7' ) && ! empty( $settings['form_id'] ) ): ?>
            <div class="benzo-cf7">
                <?php echo do_shortcode( '[contact-form-7 id="' . $settings['form_id'] . '"]' ); ?>
            </div>
        <?php endif;
    }
}