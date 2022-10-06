<?php
namespace BenzoToolkit\ElementorAddon\Helper;

if ( ! defined( 'ABSPATH' ) ) {
    exit( 'No direct script access allowed' );
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;

class Benzo_Section_Settings {
    protected static $instance = null;

    public static function instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function initialize() {
        add_action( 'elementor/element/section/section_layout/after_section_end', [$this, 'register_controls_column'], 10, 1 );
        add_action( 'elementor/element/section/section_advanced/after_section_end', [$this, 'register_controls_sticky'], 10, 1 );
        add_action( 'elementor/frontend/section/before_render', [$this, 'sticky_before_render'], 10, 1 );
    }

    /**
     * Column Alignment
     *
     * @return void
     */
    public function register_controls_column( $section, $args = [] ) {
        $section->start_controls_section(
            'benzo_column_option',
            [
                'label' => esc_html__( 'Benzo Extra Options', 'benzo-toolkit' ),
                'tab'   => Controls_Manager::TAB_LAYOUT,
            ]
        );

        $section->add_responsive_control(
            'column_align', [
                'label'     => esc_html__( 'Horizontal Column Alignment', 'benzo-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'flex-start' => esc_html__( 'Left', 'benzo-toolkit' ),
                    'center'     => esc_html__( 'Center', 'benzo-toolkit' ),
                    'flex-end'   => esc_html__( 'End', 'benzo-toolkit' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-container' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $section->end_controls_section();
    }

    /**
     * Sticky Section
     *
     * @return void
     */
    public function register_controls_sticky( $section, $args = [] ) {

        $section->start_controls_section(
            'section_sticky_controls',
            [
                'label' => esc_html__( 'Section Sticky', 'benzo-toolkit' ),
                'tab'   => Controls_Manager::TAB_ADVANCED,
            ]
        );

        $section->add_control(
            'section_sticky_on',
            [
                'label'        => esc_html__( 'Enable Sticky', 'benzo-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'description'  => esc_html__( 'Set sticky options by enable this option.', 'benzo-toolkit' ),
            ]
        );

        $section->add_responsive_control(
            'section_sticky_offset',
            [
                'label'     => esc_html__( 'Offset', 'benzo-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'condition' => [
                    'section_sticky_on' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}}.benzo-sticky.benzo-sticky-active' => 'top: {{SIZE}}px;',
                ],
            ]
        );

        $section->add_control(
            'section_sticky_active_bg',
            [
                'label'     => esc_html__( 'Active Background Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}.benzo-sticky.benzo-sticky-active' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'section_sticky_on' => 'yes',
                ],
            ]
        );

        $section->add_responsive_control(
            'section_sticky_active_padding',
            [
                'label'      => esc_html__( 'Active Padding', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}}.benzo-sticky.benzo-sticky-active' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'section_sticky_on' => 'yes',
                ],
            ]
        );

        $section->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'label'     => esc_html__( 'Active Box Shadow', 'benzo-toolkit' ),
                'name'      => 'section_sticky_active_shadow',
                'selector'  => '{{WRAPPER}}.benzo-sticky.benzo-sticky-active',
                'condition' => [
                    'section_sticky_on' => 'yes',
                ],
            ]
        );

        $section->end_controls_section();
    }

    /**
     * Sticky Before Render
     *
     * @param $section
     * @return void
     */
    public function sticky_before_render( $section ) {
        $settings = $section->get_settings_for_display();

        if ( ! empty( $settings['section_sticky_on'] ) == 'yes' ) {
            $section->add_render_attribute( '_wrapper', 'class', 'benzo-sticky' );
        }
    }
}

Benzo_Section_Settings::instance()->initialize();
