<?php
namespace BenzoToolkit\ElementorAddon\Widgets;

use BenzoTheme\Classes\Benzo_Helper;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Benzo_Site_Logo extends Widget_Base {

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
        return 'benzo-site-logo';
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
        return esc_html__( 'Benzo Site Logo', 'benzo-toolkit' );
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
        return 'eicon-site-logo';
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
        return ['benzo', 'toolkit', 'header', 'footer', 'logo', 'site'];
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
            'logo_type',
            [
                'label'   => esc_html__( 'Panel Logo', 'benzo-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'default' => esc_html__( 'Default', 'benzo-toolkit' ),
                    'custom'  => esc_html__( 'Custom', 'benzo-toolkit' ),
                ],
                'default' => 'default',
            ]
        );

        $this->add_control(
            'custom_logo',
            [
                'label'     => esc_html__( 'Custom Logo', 'benzo-toolkit' ),
                'type'      => Controls_Manager::MEDIA,
                'default'   => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'logo_type' => 'custom',
                ],
            ]
        );

        $this->add_responsive_control(
            'logo_alignment',
            [
                'label'       => esc_html__( 'Logo Alignment', 'benzo-toolkit' ),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'benzo-toolkit' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center'     => [
                        'title' => esc_html__( 'Center', 'benzo-toolkit' ),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'right'   => [
                        'title' => esc_html__( 'Right', 'benzo-toolkit' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'default'     => 'left',
                'toggle'      => false,
                'selectors'   => [
                    '{{WRAPPER}} .benzo-nav-menu' => 'text-align: {{VALUE}};',
                ],
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'url_type',
            [
                'label'   => esc_html__( 'URL Type', 'benzo-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'default' => esc_html__( 'Default', 'benzo-toolkit' ),
                    'custom'  => esc_html__( 'Custom', 'benzo-toolkit' ),
                ],
                'default' => 'default',
            ]
        );

        $this->add_control(
            'custom_url',
            [
                'label'       => esc_html__( 'Custom URL', 'benzo-toolkit' ),
                'type'        => Controls_Manager::URL,
                'placeholder' => home_url(),
                'condition'   => [
                    'url_type' => 'custom',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
			'section_style_image',
			[
				'label' => esc_html__( 'Image', 'benzo-toolkit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_responsive_control(
			'width',
			[
				'label' => esc_html__( 'Width', 'benzo-toolkit' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%', 'px', 'vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .benzo-nav-menu img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'space',
			[
				'label' => esc_html__( 'Max Width', 'benzo-toolkit' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%', 'px', 'vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .benzo-nav-menu img' => 'max-width: {{SIZE}}{{UNIT}};',
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
        $settings  = $this->get_settings();
        $site_logo = Benzo_Helper::get_option( 'site_main_logo', ['url' => get_template_directory_uri() . '/assets/img/logo.png'] );
        ?>
        <div class="benzo-nav-menu">
            <a href="<?php echo esc_url( home_url() ) ?>">
                <?php if ( 'custom' === $settings['logo_type'] ): ?>
                    <?php if ( $settings['custom_logo']['url'] ): ?>
                        <img src="<?php echo esc_url( $settings['custom_logo']['url'] ) ?>" alt="<?php echo get_bloginfo() ?>">
                    <?php endif;?>
                <?php else: ?>
                    <?php if ( $site_logo['url'] ): ?>
                        <img src="<?php echo esc_url( $site_logo['url'] ) ?>" alt="<?php echo get_bloginfo() ?>">
                    <?php endif;?>
                <?php endif;?>
            </a>
        </div>
        <?php
    }
}