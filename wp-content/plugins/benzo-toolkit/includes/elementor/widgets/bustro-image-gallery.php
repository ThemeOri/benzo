<?php
namespace BenzoToolkit\ElementorAddon\Widgets;

use BenzoTheme\Classes\Benzo_Helper;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Benzo_Image_Gallery extends Widget_Base {

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
        return 'benzo-image-gallery';
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
        return esc_html__( 'Benzo Image Gallery', 'benzo-toolkit' );
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
        return 'eicon-gallery-grid';
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
        return ['magnific-popup', 'benzo-toolkit'];
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
        return ['Benzo', 'Toolkit', 'image', 'gallery'];
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
            'images',
            [
                'label' => esc_html__( 'Select Galley Images', 'benzo-toolkit' ),
                'type'  => Controls_Manager::GALLERY,
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'thumbnail',
                'default'   => 'full',
                'separator' => 'none',
                'exclude'   => ['custom'],
            ]
        );

        $this->add_control(
            'open_lightbox',
            [
                'label'   => esc_html__( 'Lightbox', 'benzo-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'benzo-toolkit' ),
                    'no'  => esc_html__( 'No', 'benzo-toolkit' ),
                ],
            ]
        );

        $this->add_control(
            'grid_heading',
            [
                'label'     => esc_html__( 'Grid Column', 'benzo-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'desktop_column',
            [
                'label'   => esc_html__( 'Desktop', 'benzo-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    '1' => esc_html__( '1 column', 'benzo-toolkit' ),
                    '2' => esc_html__( '2 column', 'benzo-toolkit' ),
                    '3' => esc_html__( '3 column', 'benzo-toolkit' ),
                    '4' => esc_html__( '4 column', 'benzo-toolkit' ),
                    '6' => esc_html__( '6 column', 'benzo-toolkit' ),
                ],
                'default' => '3',
            ]
        );

        $this->add_control(
            'tab_column',
            [
                'label'   => esc_html__( 'Tablet', 'benzo-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    '1' => esc_html__( '1 column', 'benzo-toolkit' ),
                    '2' => esc_html__( '2 column', 'benzo-toolkit' ),
                    '3' => esc_html__( '3 column', 'benzo-toolkit' ),
                    '4' => esc_html__( '4 column', 'benzo-toolkit' ),
                    '6' => esc_html__( '6 column', 'benzo-toolkit' ),
                ],
                'default' => '2',
            ]
        );

        $this->add_control(
            'mobile_column',
            [
                'label'   => esc_html__( 'Mobile', 'benzo-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    '1' => esc_html__( '1 column', 'benzo-toolkit' ),
                    '2' => esc_html__( '2 column', 'benzo-toolkit' ),
                    '3' => esc_html__( '3 column', 'benzo-toolkit' ),
                    '4' => esc_html__( '4 column', 'benzo-toolkit' ),
                    '6' => esc_html__( '6 column', 'benzo-toolkit' ),
                ],
                'default' => '1',
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
            'grid_gap',
            [
                'label'      => esc_html__( 'Grid Gap', 'benzo-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-image-gallery .row'                 => 'margin: -{{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .benzo-image-gallery .row > [class*=col-]' => 'padding: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'image_border',
                'selector'  => '{{WRAPPER}} .benzo-image-gallery .single-image img',
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'image_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-image-gallery .single-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'overly_color',
            [
                'label'     => esc_html__( 'Overly Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .benzo-image-gallery .single-image::before' => 'background-color: {{VALUE}}',
                ],
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
                'label'      => esc_html__( 'Size', 'benzo-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-image-gallery .single-image .image-popup' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => esc_html__( 'Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-image-gallery .single-image .image-popup' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'icon_background',
            [
                'label'     => esc_html__( 'Background', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-image-gallery .single-image .image-popup' => 'background-color: {{VALUE}}',
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
        $settings = $this->get_settings_for_display();

        if ( empty( $settings['images'] ) ) {
            return;
        }

        $column = Benzo_Helper::render_column( $settings['desktop_column'], $settings['tab_column'], $settings['mobile_column'] );

        ?>
        <div class="benzo-image-gallery">
            <div class="row">
            <?php
            foreach ( $settings['images'] as $image ):
                $image_src       = wp_get_attachment_image_url( $image['id'], $settings['thumbnail_size'] );
                $image_popup_src = wp_get_attachment_image_url( $image['id'], 'full' );
                ?>
                <div class="<?php echo esc_attr( $column ) ?>">
                    <div class="single-image">
                        <img src="<?php echo esc_url( $image_src ) ?>" alt="">
                        <?php if ( 'yes' == $settings['open_lightbox'] ) : ?>
                        <span data-mfp-src="<?php echo esc_url( $image_popup_src ) ?>" class="image-popup">
                            <i class="far fa-eye"></i>
                        </span>
                        <?php endif; ?>
                    </div>
                </div>
                <?php
                endforeach;
                ?>
            </div>
        </div>
        <?php
    }
}