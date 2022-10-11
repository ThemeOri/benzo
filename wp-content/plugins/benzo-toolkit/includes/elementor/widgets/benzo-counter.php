<?php
namespace BenzoToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Benzo_Counter extends Widget_Base {

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
        return 'benzo-counter';
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
        return esc_html__( 'Benzo Counter', 'benzo-toolkit' );
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
        return 'eicon-counter';
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
     * Retrieve the list of Scripts the widget depended on.
     *
     * Used to set Scripts dependencies required to run the widget.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget Scripts dependencies.
     */
    public function get_script_depends() {
        return ['jquery-numerator', 'benzo-toolkit'];
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
        return ['benzo', 'counter', 'up'];
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
                'label' => esc_html__( 'Counter', 'benzo-toolkit' ),
            ]
        );

        $this->add_control(
            'starting_number',
            [
                'label'   => esc_html__( 'Starting Number', 'benzo-toolkit' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 1,
                'min'     => 1,
            ]
        );

        $this->add_control(
            'ending_number',
            [
                'label'   => esc_html__( 'Ending Number', 'benzo-toolkit' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 100,
            ]
        );

        $this->add_control(
            'prefix',
            [
                'label'       => esc_html__( 'Number Prefix', 'benzo-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => '',
                'placeholder' => 1,
            ]
        );

        $this->add_control(
            'suffix',
            [
                'label'       => esc_html__( 'Number Suffix', 'benzo-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => '',
                'placeholder' => esc_html__( 'Plus', 'benzo-toolkit' ),
            ]
        );

        $this->add_control(
            'duration',
            [
                'label'   => esc_html__( 'Animation Duration', 'benzo-toolkit' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 2000,
                'min'     => 100,
                'step'    => 100,
            ]
        );

        $this->add_control(
            'thousand_separator',
            [
                'label'     => esc_html__( 'Thousand Separator', 'benzo-toolkit' ),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'label_on'  => esc_html__( 'Show', 'benzo-toolkit' ),
                'label_off' => esc_html__( 'Hide', 'benzo-toolkit' ),
            ]
        );

        $this->add_control(
            'thousand_separator_char',
            [
                'label'     => esc_html__( 'Separator', 'benzo-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'condition' => [
                    'thousand_separator' => 'yes',
                ],
                'options'   => [
                    ''  => 'Default',
                    '.' => 'Dot',
                    ' ' => 'Space',
                ],
            ]
        );

        $this->add_control(
            'title', [
                'label'       => esc_html__( 'Title', 'benzo-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( 'Raised Funds', 'benzo-toolkit' ),
            ]
        );

        $this->add_control(
            'show_icon',
            [
                'label'     => esc_html__( 'Show Icon?', 'benzo-toolkit' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => esc_html__( 'Show', 'benzo-toolkit' ),
                'label_off' => esc_html__( 'Hide', 'benzo-toolkit' ),
                'default'   => 'no',
            ]
        );

        $this->add_control(
            'icon_type', [
                'label'     => esc_html__( 'Icon Type', 'benzo-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'image'   => esc_html__( 'Icon Image', 'benzo-toolkit' ),
                    'library' => esc_html__( 'Icon Library', 'benzo-toolkit' ),
                ],
                'default'   => 'library',
                'condition' => [
                    'show_icon' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'selected_icon', [
                'label'            => esc_html__( 'Icon', 'benzo-toolkit' ),
                'type'             => Controls_Manager::ICONS,
                'label_block'      => true,
                'fa4compatibility' => 'icon',
                'default'          => [
                    'value'   => 'fas fa-smile-wink',
                    'library' => 'fa-solid',
                ],
                'conditions'       => [
                    'relation' => 'and',
                    'terms'    => [
                        [
                            'name'     => 'show_icon',
                            'operator' => '==',
                            'value'    => 'yes',
                        ],
                        [
                            'name'     => 'icon_type',
                            'operator' => '==',
                            'value'    => 'library',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'selected_image', [
                'label'      => esc_html__( 'Image', 'benzo-toolkit' ),
                'type'       => Controls_Manager::MEDIA,
                'default'    => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'conditions' => [
                    'relation' => 'and',
                    'terms'    => [
                        [
                            'name'     => 'show_icon',
                            'operator' => '==',
                            'value'    => 'yes',
                        ],
                        [
                            'name'     => 'icon_type',
                            'operator' => '==',
                            'value'    => 'image',
                        ],
                    ],
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'widget_style',
            [
                'label' => esc_html__( 'Style', 'benzo-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'margin',
            [
                'label'      => esc_html__( 'Margin', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-counter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'padding',
            [
                'label'      => esc_html__( 'Padding', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-counter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'text_align',
            [
                'label'     => esc_html__( 'Text Align', 'benzo-toolkit' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => esc_html__( 'Left', 'benzo-toolkit' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'benzo-toolkit' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__( 'Right', 'benzo-toolkit' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .benzo-counter' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'box_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-counter' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'content_style',
            [
                'label' => esc_html__( 'Content', 'benzo-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'counter_heading',
            [
                'label' => esc_html__( 'Counter', 'benzo-toolkit' ),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'counter_color',
            [
                'label'     => esc_html__( 'Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-counter .counter-wrap' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'counter_typography',
                'selector' => '{{WRAPPER}} .benzo-counter .counter-wrap',
            ]
        );

        $this->add_responsive_control(
            'counter_bottom_gap',
            [
                'label'      => esc_html__( 'Bottom Gap', 'benzo-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 200,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-counter .counter-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_heading',
            [
                'label'     => esc_html__( 'Title', 'benzo-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-counter .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .benzo-counter .title',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'icon_style',
            [
                'label' => esc_html__( 'Icon', 'benzo-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => esc_html__( 'Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-counter .icon i'   => 'color: {{VALUE}};',
                    '{{WRAPPER}} .benzo-counter .icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label'      => esc_html__( 'Icon Size', 'benzo-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 200,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-counter .icon img, {{WRAPPER}} .benzo-counter .icon svg' => 'max-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .benzo-counter .icon i'                                          => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_bottom_gap',
            [
                'label'      => esc_html__( 'Bottom Gap', 'benzo-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 200,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-counter .icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
        $settings = $this->get_settings();

        $migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
		$is_new = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

        $this->add_render_attribute( 'title', 'class', 'title' );
        $this->add_inline_editing_attributes( 'title', 'none' );

        $this->add_render_attribute( 'counter', [
			'class' => 'elementor-counter-number',
			'data-duration' => $settings['duration'],
			'data-to-value' => $settings['ending_number'],
			'data-from-value' => $settings['starting_number'],
		] );

        if ( ! empty( $settings['thousand_separator'] ) ) {
			$delimiter = empty( $settings['thousand_separator_char'] ) ? ',' : $settings['thousand_separator_char'];
			$this->add_render_attribute( 'counter', 'data-delimiter', $delimiter );
		}

        ?>

        <div class="benzo-counter">
            <?php if( 'yes' == $settings['show_icon'] ) : ?>
                <div class="icon">
                    <?php
                        if ( 'library' == $settings['icon_type'] ) {
                            if ( $is_new || $migrated ) {
                                Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
                            } else {
                                printf( '<i class="%1$s" aria-hidden="true"></i>',
                                    esc_attr( $settings['icon'] )
                                );
                            }
                        } else {
                            printf( '<img src="%1$s">',
                                esc_attr( $settings['selected_image']['url'] )
                            );
                        }
                    ?>
                </div>
            <?php endif; ?>
            <div class="counter-wrap">
                <?php
                    if( $settings['prefix'] ) {
                        printf( '<span class="counter-prefix">%1$s</span>',
                            esc_html($settings['prefix'])
                        );
                    }

                    if( $settings['ending_number'] && $settings['starting_number'] ) {
                        printf( '<span %1$s>%2$s</span>',
                            $this->get_render_attribute_string( 'counter' ),
                            esc_html($settings['starting_number'])
                        );
                    }

                    if( $settings['suffix'] ) {
                        printf( '<span class="counter-suffix">%1$s</span>',
                            esc_html($settings['suffix'])
                        );
                    }
                ?>
            </div>
            <?php
                if( $settings['title'] ) {
                    printf( '<h6 %1$s>%2$s</h6>',
                        $this->get_render_attribute_string( 'title' ),
                        esc_html($settings['title'])
                    );
                }
            ?>
        </div>

        <?php
    }

    /**
     * Render heading widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function content_template() {
        ?>

        <#
            var iconHTML = elementor.helpers.renderIcon( view, settings.selected_icon, { 'aria-hidden': true }, 'i' , 'object' ),
            migrated = elementor.helpers.isIconMigrated( settings, 'selected_icon' );

            view.addRenderAttribute( 'title', {
                'class': 'title'
            } );
            view.addInlineEditingAttributes( 'title', 'none' );
        #>

        <div class="benzo-counter">
            <# if( 'yes' == settings.show_icon ) { #>
                <div class="icon">
                    <# if ( 'library' == settings.icon_type ) { #>
                        <# if ( iconHTML && iconHTML.rendered && ( ! settings.icon || migrated ) ) { #>
                            {{{ iconHTML.value }}}
                        <# } else { #>
                            <i class="{{ settings.icon }}" aria-hidden="true"></i>
                        <# } #>
                    <# } else { #>
                        <img src="{{ settings.selected_image.url }}">
                    <# } #>
                </div>
            <# } #>
            <div class="counter-wrap">
                <# if( settings.prefix ) { #>
                    <span class="counter-prefix">{{{ settings.prefix }}}</span>
                <# } #>

                <span class="elementor-counter-number" data-duration="{{ settings.duration }}" data-to-value="{{ settings.ending_number }}" data-delimiter="{{ settings.thousand_separator ? settings.thousand_separator_char || ',' : '' }}">{{{ settings.starting_number }}}</span>

                <# if( settings.suffix ) { #>
                    <span class="counter-suffix">{{{ settings.suffix }}}</span>
                <# } #>

            </div>
            <# if( settings.title ) { #>
                <h6 {{{ view.getRenderAttributeString( 'title' ) }}}>{{{ settings.title }}}</h6>
            <# } #>
        </div>
        <?php
    }
}