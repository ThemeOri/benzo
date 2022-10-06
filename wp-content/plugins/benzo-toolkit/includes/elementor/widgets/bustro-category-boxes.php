<?php
namespace BenzoToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Benzo_Category_Boxes extends Widget_Base {

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
        return 'benzo-category-boxes';
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
        return esc_html__( 'Benzo Category Boxes', 'benzo-toolkit' );
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
        return ['Benzo', 'post', 'category', 'boxes'];
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
                'label'   => esc_html__( 'Design', 'benzo-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'design-1' => esc_html__( 'Design One', 'benzo-toolkit' ),
                    'design-2' => esc_html__( 'Design Two', 'benzo-toolkit' ),
                    'design-3' => esc_html__( 'Design Three', 'benzo-toolkit' ),
                ],
                'default' => 'design-1',
            ]
        );

        $this->add_control(
            'selected_categories',
            [
                'label'       => esc_html__( 'Select Categories', 'benzo-toolkit' ),
                'type'        => Controls_Manager::SELECT2,
                'multiple'    => true,
                'label_block' => true,
                'options'     => $this->select_category(),
            ]
        );

        $this->add_control(
            'show_post_count',
            [
                'label'        => esc_html__( 'Show Post Count', 'benzo-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'benzo-toolkit' ),
                'label_off'    => esc_html__( 'Hide', 'benzo-toolkit' ),
                'return_value' => 'yes',
                'default'      => 'yes',
                'conditions'   => [
                    'terms' => [
                        [
                            'name'     => 'widget_design',
                            'operator' => '!=',
                            'value'    => 'design-3',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'post_count_text',
            [
                'label'      => esc_html__( 'Post Count Text', 'benzo-toolkit' ),
                'type'       => Controls_Manager::TEXT,
                'default'    => esc_html__( 'Posts Publish', 'benzo-toolkit' ),
                'conditions' => [
                    'relation' => 'and',
                    'terms'    => [
                        [
                            'name'     => 'show_post_count',
                            'operator' => '==',
                            'value'    => 'yes',
                        ],
                        [
                            'name'     => 'widget_design',
                            'operator' => '==',
                            'value'    => 'design-1',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'show_button',
            [
                'label'        => esc_html__( 'Show Button', 'benzo-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'benzo-toolkit' ),
                'label_off'    => esc_html__( 'Hide', 'benzo-toolkit' ),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'    => [
                    'widget_design' => 'design-1',
                ],
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label'      => esc_html__( 'Button Text', 'benzo-toolkit' ),
                'type'       => Controls_Manager::TEXT,
                'default'    => esc_html__( 'View Posts', 'benzo-toolkit' ),
                'conditions' => [
                    'relation' => 'and',
                    'terms'    => [
                        [
                            'name'     => 'show_button',
                            'operator' => '==',
                            'value'    => 'yes',
                        ],
                        [
                            'name'     => 'widget_design',
                            'operator' => '==',
                            'value'    => 'design-1',
                        ],
                    ],
                ],
            ]
        );

        $this->add_responsive_control(
            'column',
            [
                'label'     => esc_html__( 'Column', 'benzo-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    '1' => esc_html__( 'One', 'benzo-toolkit' ),
                    '2' => esc_html__( 'Two', 'benzo-toolkit' ),
                    '3' => esc_html__( 'Three', 'benzo-toolkit' ),
                    '4' => esc_html__( 'Four', 'benzo-toolkit' ),
                    '5' => esc_html__( 'Five', 'benzo-toolkit' ),
                    '6' => esc_html__( 'Six', 'benzo-toolkit' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .benzo-category-boxes ' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'widget_style',
            [
                'label' => esc_html__( 'Item', 'benzo-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'wrapper_grid',
            [
                'label'      => esc_html__( 'Items Gap', 'benzo-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-category-boxes' => 'grid-gap: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label'      => esc_html__( 'Padding', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-category-boxes .category-box .category-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .benzo-category-boxes.design-3 .category-box'          => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name'     => 'widget_design',
                            'operator' => '!=',
                            'value'    => 'design-2',
                        ],
                    ],
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
            'content_color',
            [
                'label'     => esc_html__( 'Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-category-boxes .category-box'                   => 'color: {{VALUE}}',
                    '{{WRAPPER}} .benzo-category-boxes .category-box .category-title a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .benzo-category-boxes .category-box .category-title, {{WRAPPER}} .benzo-category-boxes .category-box',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'count_style',
            [
                'label'     => esc_html__( 'Count', 'benzo-toolkit' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'widget_design' => 'design-2',
                ],
            ]
        );

        $this->add_control(
            'count_color',
            [
                'label'     => esc_html__( 'Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-category-boxes .category-box .category-count' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .benzo-category-boxes .category-box .category-count' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'count_bg',
            [
                'label'     => esc_html__( 'Background', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-category-boxes .category-box .category-count' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'count_typography',
                'selector' => '{{WRAPPER}} .benzo-category-boxes .category-box .category-count',
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

        if ( $settings['selected_categories'] ) {
            $categories = $settings['selected_categories'];
        } else {
            $categories = get_terms( [
                'taxonomy' => 'category',
            ] );
        }

        ?>
        <div class="benzo-category-boxes <?php echo esc_attr( $settings['widget_design'] ) ?>">
            <?php foreach ( $categories as $category ):
                if ( $settings['selected_categories'] ) {
                    $category = get_term_by( 'slug', $category, 'category' );
                }
                $category_meta = get_term_meta( $category->term_id, 'benzo_category_meta', true );

                if ( isset( $category_meta['category_thumbnail'] ) ) {
                    $thumbnail = $category_meta['category_thumbnail']['url'];
                } else {
                    $thumbnail = '';
                }
                if ( isset( $category_meta['category_icon'] ) ) {
                    $icon = $category_meta['category_icon'];
                } else {
                    $icon = '';
                }
                if ( isset( $category_meta['category_color'] ) && 'design-3' === $settings['widget_design'] ) {
                    $bg = $category_meta['category_color'];
                } else {
                    $bg = '';
                }
                ?>
                <div class="category-box" <?php if( $bg ) : ?>style="background-color: <?php echo esc_attr( $bg ) ?>"<?php endif; ?>>
                    <?php if ( 'design-3' !== $settings['widget_design'] ) : ?>
                        <?php if ( $thumbnail ) : ?>
                        <div class="category-thumb">
                            <div class="thumb-inner" style="background-image: url(<?php echo esc_url( $thumbnail ) ?>)">
                            </div>
                            <?php
                                if ( 'yes' === $settings['show_post_count'] && 'design-2' === $settings['widget_design'] ) {
                                    echo '<p class="category-count">' . esc_html( $category->count ) . '</p>';
                                }
                            ?>
                        </div>
                        <?php endif; ?>
                        <div class="category-content">
                            <h4 class="category-title">
                                <a href="<?php echo esc_url( get_term_link( $category ) ) ?>"><?php echo esc_html( $category->name ) ?></a>
                            </h4>
                            <?php if ( 'yes' === $settings['show_post_count'] && 'design-1' === $settings['widget_design'] ): ?>
                            <p class="category-count">
                                <?php
                                    echo esc_html( $category->count );
                                    if ( 'design-1' === $settings['widget_design'] ) {
                                        echo ' ' . esc_html( $settings['post_count_text'] );
                                    }
                                ?>
                            </p>
                            <?php endif;
                            if ( 'yes' === $settings['show_button'] ) {
                                printf( '<a href="%1$s" class="category-button">%2$s<i class="fas fa-angle-double-right"></i></a>',
                                    esc_url( get_term_link( $category ) ),
                                    esc_html( $settings['button_text'] )
                                );
                            } ?>
                        </div>
                    <?php elseif ( 'design-3' === $settings['widget_design'] ) : ?>
                        <?php if ( $icon ) : ?>
                        <i class="<?php echo esc_attr( $icon ) ?>"></i>
                        <?php endif; ?>
                        <?php echo esc_html( $category->name ) ?>
                        <a href="<?php echo esc_url( get_term_link( $category ) ) ?>"></a>
                    <?php endif; ?>
                </div>
            <?php endforeach;?>
        </div>
        <?php
    }

    /**
     * List of Categories
     *
     * @param string $category
     * @return void
     */
    protected function select_category() {
        $terms = get_terms( [
            'taxonomy'   => 'category',
            'hide_empty' => true,
        ] );

        $options = [];

        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
            foreach ( $terms as $term ) {
                $options[$term->slug] = $term->name;
            }
        }

        return $options;
    }
}