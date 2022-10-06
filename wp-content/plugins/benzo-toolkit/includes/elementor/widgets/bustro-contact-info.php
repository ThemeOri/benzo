<?php
namespace BenzoToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Benzo_Contact_Info extends Widget_Base {

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
        return 'benzo-contact-info';
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
        return esc_html__( 'Benzo Contact Info', 'benzo-toolkit' );
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
        return 'eicon-post-list';
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
        return ['benzo', 'toolkit', 'contact', 'information'];
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
                'label' => esc_html__( 'Contact Information', 'benzo-toolkit' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'title',
            [
                'label'       => esc_html__( 'Title', 'benzo-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Phone', 'benzo-toolkit' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'title_tag',
            [
                'label'       => esc_html__( 'Title HTML Tag', 'benzo-toolkit' ),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'h3' => [
                        'title' => esc_html__( 'H3', 'benzo-toolkit' ),
                        'icon'  => 'eicon-editor-h3',
                    ],
                    'h4' => [
                        'title' => esc_html__( 'H4', 'benzo-toolkit' ),
                        'icon'  => 'eicon-editor-h4',
                    ],
                    'h5' => [
                        'title' => esc_html__( 'H5', 'benzo-toolkit' ),
                        'icon'  => 'eicon-editor-h5',
                    ],
                    'h6' => [
                        'title' => esc_html__( 'H6', 'benzo-toolkit' ),
                        'icon'  => 'eicon-editor-h6',
                    ],
                ],
                'default'     => 'h4',
                'toggle'      => false,
            ]
        );

        $repeater->add_control(
            'content',
            [
                'label' => esc_html__( 'Content', 'benzo-toolkit' ),
                'type'  => Controls_Manager::TEXTAREA,
                'rows'  => 10,
            ]
        );

        $repeater->add_control(
            'show_icon',
            [
                'label'     => esc_html__( 'Show Icon?', 'benzo-toolkit' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => esc_html__( 'Show', 'benzo-toolkit' ),
                'label_off' => esc_html__( 'Hide', 'benzo-toolkit' ),
                'default'   => 'yes',
            ]
        );

        $repeater->add_control(
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

        $repeater->add_control(
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

        $repeater->add_control(
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

        $this->add_control(
            'informations',
            [
                'label'       => esc_html__( 'Information\'s', 'benzo-toolkit' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'widget_style',
            [
                'label' => esc_html( 'List', 'benzo-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'box_padding',
            [
                'label'      => esc_html__( 'Padding', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .single-contact-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'box_gap',
            [
                'label'      => esc_html__( 'Bottom Gap', 'benzo-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .single-contact-info:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'box_border',
                'label'    => esc_html__( 'Border', 'benzo-toolkit' ),
                'selector' => '{{WRAPPER}} .single-contact-info',
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
                    '{{WRAPPER}} .single-contact-info .info-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .single-contact-info .info-title',
            ]
        );

        $this->add_control(
            'content_heading',
            [
                'label'     => esc_html__( 'Content', 'benzo-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label'     => esc_html__( 'Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-contact-info .info-content'   => 'color: {{VALUE}};',
                    '{{WRAPPER}} .single-contact-info .info-content a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography',
                'selector' => '{{WRAPPER}} .single-contact-info .info-content',
            ]
        );

        $this->add_control(
            'icon_heading',
            [
                'label'     => esc_html__( 'Icon', 'benzo-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
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
                    '{{WRAPPER}} .benzo-contact-info .single-contact-info .icon' => 'max-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .benzo-contact-info .single-contact-info .icon' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => esc_html__( 'Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-contact-info .icon'     => 'color: {{VALUE}};',
                    '{{WRAPPER}} .single-contact-info .icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_bg',
            [
                'label'     => esc_html__( 'Background', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-contact-info .icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'box_tabs' );

        $this->start_controls_tab(
            'box_normal',
            [
                'label' => esc_html__( 'Normal State', 'benzo-toolkit' ),
            ]
        );

        $this->add_control(
            'box_bg_color',
            [
                'label'     => esc_html__( 'Background', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-contact-info' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_shadow',
                'selector' => '{{WRAPPER}} .single-contact-info',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'box_hover',
            [
                'label' => esc_html__( 'Hover State', 'benzo-toolkit' ),
            ]
        );

        $this->add_control(
            'box_hover_bg_color',
            [
                'label'     => esc_html__( 'Background', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-contact-info:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label'     => esc_html__( 'Title Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-contact-info:hover .info-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_hover_color',
            [
                'label'     => esc_html__( 'Content Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-contact-info:hover .info-content'   => 'color: {{VALUE}};',
                    '{{WRAPPER}} .single-contact-info:hover .info-content a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_hover_color',
            [
                'label'     => esc_html__( 'Icon Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-contact-info:hover .icon'     => 'color: {{VALUE}};',
                    '{{WRAPPER}} .single-contact-info:hover .icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_hover_bg',
            [
                'label'     => esc_html__( 'Icon Background', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-contact-info:hover .icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'box_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-contact-info:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_shadow_hover',
                'selector' => '{{WRAPPER}} .single-contact-info:hover',
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

        $allowed_html = [
            'i'  => [
                'class' => [],
            ],
            'u'  => [
                'class' => [],
            ],
            'b'  => [
                'class' => [],
            ],
            'a'  => [
                'class' => [],
                'href'  => [],
            ],
            'br' => [],
        ];

        ?>
        <div class="benzo-contact-info">
			<?php
            foreach ( $settings['informations'] as $index => $item ) :
                $title_setting_key = $this->get_repeater_setting_key( 'title', 'informations', $index );
                $content_setting_key = $this->get_repeater_setting_key( 'content', 'informations', $index );

                $this->add_render_attribute( $title_setting_key, 'class', 'info-title' );
                $this->add_inline_editing_attributes( $title_setting_key, 'none' );

                $this->add_render_attribute( $content_setting_key, 'class', 'info-content' );
                $this->add_inline_editing_attributes( $content_setting_key, 'basic' );

                $migrated = isset( $item['__fa4_migrated']['selected_icon'] );
                $is_new = empty( $item['icon'] ) && Icons_Manager::is_migration_allowed();

                ?>
                <div class="single-contact-info">
                    <?php if( 'yes' == $item['show_icon'] ) : ?>
                    <div class="icon">
                        <?php
                            if ( 'library' == $item['icon_type'] ) {
                                if ( $is_new || $migrated ) {
                                    Icons_Manager::render_icon( $item['selected_icon'], [ 'aria-hidden' => 'true' ] );
                                } else {
                                    printf( '<i class="%1$s" aria-hidden="true"></i>',
                                        esc_attr( $item['icon'] )
                                    );
                                }
                            } else {
                                printf( '<img src="%1$s">',
                                    esc_attr( $item['selected_image']['url'] )
                                );
                            }
                        ?>
                    </div>
                    <?php endif; ?>
                    <div class="content">
                        <?php
                            if ( $item['title'] ) {
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $item['title_tag'] ),
                                    $this->get_render_attribute_string( $title_setting_key ),
                                    esc_html( $item['title'] )
                                );
                            }

                            if ( $item['content'] ) {
                                printf( '<p %1$s>%2$s</p>',
                                    $this->get_render_attribute_string( $content_setting_key ),
                                    wp_kses( $item['content'], $allowed_html )
                                );
                            }
                        ?>
                    </div>
                </div>
                <?php
            endforeach;
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
        <div class="benzo-contact-info">
            <# if ( settings.informations ) {
                _.each( settings.informations, function( item, index ) {
                    var titleSettingKey = view.getRepeaterSettingKey( 'title', 'informations', index );
                    var contentSettingKey = view.getRepeaterSettingKey( 'content', 'informations', index );

					view.addRenderAttribute( titleSettingKey, 'class', 'info-title' );
					view.addInlineEditingAttributes( titleSettingKey, 'none' );

                    view.addRenderAttribute( contentSettingKey, 'class', 'info-content' );
					view.addInlineEditingAttributes( contentSettingKey, 'basic' );

                    var iconHTML = elementor.helpers.renderIcon( view, item.selected_icon, { 'aria-hidden': true }, 'i' , 'object' ),
                    migrated = elementor.helpers.isIconMigrated( item, 'selected_icon' );

                    #>
                    <div class="single-contact-info">
                        <# if( 'yes' == item.show_icon ) { #>
                        <div class="icon">
                            <# if ( 'library' == item.icon_type ) { #>
                                <# if ( iconHTML && iconHTML.rendered && ( ! item.icon || migrated ) ) { #>
                                    {{{ iconHTML.value }}}
                                <# } else { #>
                                    <i class="{{ item.icon }}" aria-hidden="true"></i>
                                <# } #>
                            <# } else { #>
                                <img src="{{ item.selected_image.url }}">
                            <# } #>
                        </div>
                        <# } #>
                        <div class="content">
                            <#
                                var title_html = '<' + item.title_tag  + ' ' + view.getRenderAttributeString( titleSettingKey ) + '>' + item.title + '</' + item.title_tag + '>';
                                print( title_html );
                            #>
                            <p {{{ view.getRenderAttributeString( contentSettingKey ) }}}>{{{ item.content }}}</p>
                        </div>
                    </div>
                <# } );
            } #>
        </div>
        <?php
    }
}