<?php
namespace BenzoToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Benzo_Social_Followers extends Widget_Base {

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
        return 'benzo-social-followers';
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
        return esc_html__( 'Benzo Social Followers', 'benzo-toolkit' );
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
        return 'eicon-social-icons';
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
        return ['benzo', 'toolkit', 'social', 'count', 'followers'];
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

        $repeater = new Repeater();

        $repeater->add_control(
            'count',
            [
                'label' => esc_html__( 'Followers Count', 'benzo-toolkit' ),
                'type'  => Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__( 'Followers Title', 'benzo-toolkit' ),
                'type'  => Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'social_icon',
            [
                'label'            => esc_html__( 'Icon', 'benzo-toolkit' ),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'social',
            ]
        );

        $repeater->add_control(
            'url',
            [
                'label'   => esc_html__( 'Followers Title', 'benzo-toolkit' ),
                'type'    => Controls_Manager::URL,
                'default' => [
                    'url'         => '#',
                    'is_external' => true,
                ],
            ]
        );

        $repeater->add_control(
			'single_item_color',
			[
				'label' => esc_html__( 'Background', 'benzo-toolkit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .benzo-social-followers {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}'
				],
			]
		);

        $repeater->add_control(
			'single_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'benzo-toolkit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .benzo-social-followers {{CURRENT_ITEM}} .icon' => 'color: {{VALUE}}'
				],
			]
		);

        $repeater->add_control(
			'single_icon_bg',
			[
				'label' => esc_html__( 'Icon Background', 'benzo-toolkit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .benzo-social-followers {{CURRENT_ITEM}} .icon' => 'background-color: {{VALUE}}'
				],
			]
		);

        $this->add_control(
            'social_items',
            [
                'label'   => esc_html__( 'Social Items', 'benzo-toolkit' ),
                'type'    => Controls_Manager::REPEATER,
                'fields'  => $repeater->get_controls(),
                'default' => [
                    [
                        'count'       => esc_html__( '12M', 'benzo-toolkit' ),
                        'title'       => esc_html__( 'Followers', 'benzo-toolkit' ),
                        'social_icon' => [
                            'value'   => 'fab fa-facebook-f',
                            'library' => 'fa-brands',
                        ],
                    ],
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'widget_style',
            [
                'label' => esc_html__( 'Wrapper', 'benzo-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'wrapper_bg',
            [
                'label'     => esc_html__( 'Background', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-social-followers' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'wrapper_margin',
            [
                'label'      => esc_html__( 'Margin', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-social-followers' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wrapper_padding',
            [
                'label'      => esc_html__( 'Padding', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-social-followers' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'wrapper_border',
                'label'    => esc_html__( 'Border', 'benzo-toolkit' ),
                'selector' => '{{WRAPPER}} .benzo-social-followers',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'items_style',
            [
                'label' => esc_html__( 'Items', 'benzo-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'item_padding',
            [
                'label'      => esc_html__( 'Padding', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-social-followers .single-social-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'item_color',
            [
                'label'     => esc_html__( 'Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-social-followers .single-social-item' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'item_bg',
            [
                'label'     => esc_html__( 'Background', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-social-followers .single-social-item' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography',
                'selector' => '{{WRAPPER}} .benzo-social-followers .single-social-item',
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

        $this->add_control(
            'icon_color',
            [
                'label'     => esc_html__( 'Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-social-followers .single-social-item .icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'icon_bg',
            [
                'label'     => esc_html__( 'Background', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-social-followers .single-social-item .icon' => 'background-color: {{VALUE}}',
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

        if ( empty( $settings['social_items'] ) ) {
            return;
        }

        $migration_allowed = Icons_Manager::is_migration_allowed();
        ?>
        <div class="benzo-social-followers">
            <?php foreach ( $settings['social_items'] as $index => $item ):
                $migrated = isset( $item['__fa4_migrated']['social_icon'] );
                $is_new   = empty( $item['social'] ) && $migration_allowed;
                $url_key  = $this->get_repeater_setting_key( 'url', 'social_items', $index );
                $this->add_link_attributes( $url_key, $item['url'] );
                ?>
                <div class="single-social-item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ) ?>">
                    <div class="icon">
                        <?php
                            if ( $is_new || $migrated ) {
                                Icons_Manager::render_icon( $item['social_icon'], ['aria-hidden' => 'true'] );
                            } else {
                                printf( '<i class="%1$s" aria-hidden="true"></i><i class="%1$s" aria-hidden="true"></i>',
                                    esc_attr( $item['social'] )
                                );
                            }
                        ?>
                    </div>
                    <div class="content">
                        <span class="count"><?php echo esc_html( $item['count'] ) ?></span>
                        <span class="title"><?php echo esc_html( $item['title'] ) ?></span>
                    </div>
                    <a <?php echo $this->get_render_attribute_string( $url_key ); ?>></a>
                </div>
                <?php
            endforeach; ?>
        </div>
        <?php
    }
}