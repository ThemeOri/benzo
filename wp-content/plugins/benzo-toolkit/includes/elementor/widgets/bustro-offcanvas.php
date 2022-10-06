<?php
namespace BenzoToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Plugin;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Benzo_Offcanvas extends Widget_Base {

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
        return 'benzo-offcanvas';
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
        return esc_html__( 'Benzo Offcanvas', 'benzo-toolkit' );
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
        return 'eicon-apps';
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
        return ['benzo-theme'];
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
        return ['benzo', 'toolkit', 'header', 'offcanvas', 'side', 'slide'];
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
            'template_id',
            [
                'label'   => esc_html__( 'Select Template', 'benzo-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => $this->select_saved_template(),
            ]
        );

        $this->add_control(
            'toggle_align',
            [
                'label'   => esc_html__( 'Toggle Alignment', 'benzo-toolkit' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
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
                'default' => 'right',
                'toggle'  => false,
            ]
        );

        $this->add_control(
            'canvas_position',
            [
                'label'   => esc_html__( 'Canvas Position', 'benzo-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'left'   => esc_html__( 'Left', 'benzo-toolkit' ),
                    'right'  => esc_html__( 'Right', 'benzo-toolkit' ),
                ],
                'default' => 'right',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'toggle_style',
            [
                'label' => esc_html__( 'Toggle', 'benzo-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'toggle_width',
            [
                'label'       => esc_html__( 'Width', 'benzo-toolkit' ),
                'type'        => Controls_Manager::NUMBER,
                'label_block' => false,
                'min'         => 30,
                'max'         => 200,
                'selectors'   => [
                    '{{WRAPPER}} .benzo-offcanvas .offcanvas-toggle' => 'width: {{VALUE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'toggle_height',
            [
                'label'       => esc_html__( 'Height', 'benzo-toolkit' ),
                'type'        => Controls_Manager::NUMBER,
                'label_block' => false,
                'min'         => 30,
                'max'         => 200,
                'selectors'   => [
                    '{{WRAPPER}} .benzo-offcanvas .offcanvas-toggle' => 'height: {{VALUE}}px;',
                ],
            ]
        );

        $this->add_control(
            'toggle_bg',
            [
                'label'     => esc_html__( 'Background', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-offcanvas .offcanvas-toggle' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'toggle_color',
            [
                'label'     => esc_html__( 'Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-offcanvas .offcanvas-toggle span' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'close_style',
            [
                'label' => esc_html__( 'Close', 'benzo-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'close_width_height',
            [
                'label'       => esc_html__( 'Size', 'benzo-toolkit' ),
                'type'        => Controls_Manager::NUMBER,
                'label_block' => false,
                'min'         => 1,
                'max'         => 100,
                'selectors'   => [
                    '{{WRAPPER}} .benzo-offcanvas .offcanvas-close' => 'width: {{VALUE}}px; height: {{VALUE}}px;',
                ],
            ]
        );

        $this->add_control(
            'close_bg',
            [
                'label'     => esc_html__( 'Background', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-offcanvas .offcanvas-close' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'close_color',
            [
                'label'     => esc_html__( 'Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-offcanvas .offcanvas-close' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'canvas_style',
            [
                'label' => esc_html__( 'Canvas', 'benzo-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'overly_color',
            [
                'label'     => esc_html__( 'Overly Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-offcanvas-wrapper .offcanvas-overly' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'canvas_width',
            [
                'label'       => esc_html__( 'Width', 'benzo-toolkit' ),
                'type'        => Controls_Manager::NUMBER,
                'label_block' => false,
                'min'         => 100,
                'max'         => 2000,
                'selectors'   => [
                    '{{WRAPPER}} .benzo-offcanvas-wrapper .offcanvas-container' => 'width: {{VALUE}}px;',
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
        if ( ! $settings['template_id'] ) {
            return;
        }

        ?>
        <div class="benzo-offcanvas">
            <div class="offcanvas-toggle toggle-<?php echo esc_attr( $settings['toggle_align'] ) ?>">
                <div class="toggle-inner">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <div class="benzo-offcanvas-wrapper offcanvas-<?php echo esc_attr( $settings['canvas_position'] ) ?>">
                <div class="offcanvas-overly"></div>
                <div class="offcanvas-container">
                    <div class="offcanvas-close"><i class="fal fa-times"></i></div>
                    <?php echo Plugin::$instance->frontend->get_builder_content( $settings['template_id'], true );?>
                </div>
            </div>

        </div>
        <?php
    }

    /**
     * Get ALl Elementor Saved Template
     *
     * @since 1.0.0
     * @access protected
     */
    protected function select_saved_template() {
        $args = [
            'post_type'   => 'benzo_template',
            'numberposts' => -1,
            'orderby'     => 'title',
            'order'       => 'ASC',
        ];

        $query_query = get_posts( $args );

        $posts = [];

        if ( $query_query ) {
            foreach ( $query_query as $query ) {
                if ( 'offcanvas' === $this->template_type( $query->ID ) ) {
                    $posts[$query->ID] = $query->post_title;
                }
            }
        }

        return $posts;
    }

    /**
     * Template Type
     */
    protected function template_type( $post_id ) {

        $meta = get_post_meta( $post_id, 'benzo_tb_settings', true );

        if ( isset( $meta['template_type'] ) ) {
            $template_type = $meta['template_type'];
        } else {
            $template_type = '';
        }

        return $template_type;
    }
}