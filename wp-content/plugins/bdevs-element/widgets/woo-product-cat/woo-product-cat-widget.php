<?php

namespace BdevsElement\Widget;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;
use \BdevsElementor\BDevs_El_Select2;
use \Elementor\Group_Control_Text_Shadow;
use Elementor\Utils;

defined('ABSPATH') || die();


class Woo_Product_Cat extends BDevs_El_Widget
{

    /**
     * Get widget name.
     *
     * Retrieve Bdevs Element widget name.
     *
     * @return string Widget name.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_name()
    {
        return 'woo_product_cat'; 
    }


    /**
     * Get widget title.
     *
     * @return string Widget title.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_title()
    {
        return __('Woo Product Cat', 'bdevs-element');
    }

    public function get_custom_help_url()
    {
        return 'http://elementor.bdevs.net//widgets/post-tab/';
    }

    /**
     * Get widget icon.
     *
     * @return string Widget icon.
     * @since 1.0.0
     * @access public
     *
     */ 
    public function get_icon()
    {
        return 'eicon-product-tabs';
    }

    public function get_keywords()
    {
        return ['posts', 'post', 'post-tab', 'tab', 'news'];
    }

    /**
     * Get a list of All Post Types
     *
     * @return array
     */
    public static function get_post_types()
    {
        $diff_key = [
            'elementor_library' => '',
            'attachment' => '',
            'page' => ''
        ];
        $post_types = bdevs_element_get_post_types([], $diff_key);

        return $post_types;
    }

    /**
     * Get a list of Taxonomy
     *
     * @return array
     */
    public static function get_taxonomies($post_type = '')
    {
        $list = [];
        if ($post_type) {
            $tax = bdevs_element_get_taxonomies([
                'public' => true,
                "object_type" => [$post_type]
            ], 'object', true);
            $list[$post_type] = count($tax) !== 0 ? $tax : '';
        } else {
            $list = bdevs_element_get_taxonomies(['public' => true], 'object', true);
        }

        return $list;
    }

    protected function register_content_controls()
    {

        //Settings
        $this->start_controls_section(
            '_section_settings',
            [
                'label' => __('Settings', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'design_style',
            [
                'label' => __('Design Style', 'bdevs-element'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __('Style 1: Product Cats with button', 'bdevs-element'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            '_section_title',
            [
                'label' => __('Title & Description', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'bdevs-element'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Browse Category', 'bdevs-element'),
                'placeholder' => __('Type Title', 'bdevs-element'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );


        $this->add_control(
            'product_btn',
            [
                'label' => __('Button Text', 'bdevs-element'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Browse More', 'bdevs-element'),
                'placeholder' => __('Type Button text', 'bdevs-element'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_1']
                ]
            ]
        );
        $this->add_control(
            'product_url',
            [
                'label' => __('Button Url', 'bdevs-element'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __('Button Url', 'bdevs-element'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_1']
                ]
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            '_section_image',
            [
                'label' => __('Image', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_20']
                ],
            ]
        );

        $this->add_control(
            'bg_image',
            [
                'label' => __('BG', 'bdevs-element'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'product_image',
            [
                'label' => __('Product Image', 'bdevs-element'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_post_tab_query',
            [
                'label' => __('Query', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'post_type',
            [
                'label' => __('Source', 'bdevs-element'),
                'type' => Controls_Manager::SELECT,
                'options' => $this->get_post_types(),
                'default' => key($this->get_post_types()),
            ]
        );

        foreach (self::get_post_types() as $key => $value) {
            $taxonomy = self::get_taxonomies($key);
            if (!$taxonomy[$key]) {
                continue;
            }
            $this->add_control(
                'tax_type_' . $key,
                [
                    'label' => __('Taxonomies', 'bdevs-element'),
                    'type' => Controls_Manager::SELECT,
                    'options' => $taxonomy[$key],
                    'default' => key($taxonomy[$key]),
                    'condition' => [
                        'post_type' => $key
                    ],
                ]
            );

            foreach ($taxonomy[$key] as $tax_key => $tax_value) {

                $this->add_control(
                    'tax_ids_' . $tax_key,
                    [
                        'label' => __('Select ', 'bdevs-element') . $tax_value,
                        'label_block' => true,
                        'type' => 'bdevselement-select2',
                        'multiple' => true,
                        'placeholder' => 'Search ' . $tax_value,
                        'data_options' => [
                            'tax_id' => $tax_key,
                            'action' => 'bdevs_element_post_tab_select_query'
                        ],
                        'condition' => [
                            'post_type' => $key,
                            'tax_type_' . $key => $tax_key
                        ],
                        'render_type' => 'template',
                    ]
                );
            }
        }

        $this->add_control(
            'item_limit',
            [
                'label' => __('Item Limit', 'bdevs-element'),
                'type' => Controls_Manager::NUMBER,
                'default' => 10,
                'dynamic' => ['active' => true],
            ]
        );

        $this->end_controls_section();

    }

    protected function register_style_controls()
    {

        $this->start_controls_section(
            '_section_style_title',
            [
                'label' => __( 'Title', 'bdevs-element' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title',
                'selector' => '{{WRAPPER}} .bdevs-el-title-section',
                'scheme' => Typography::TYPOGRAPHY_2
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'title',
                'selector' => '{{WRAPPER}} .bdevs-el-title-section',
            ]
        );

        $this->start_controls_tabs( '_tabs_title' );

        $this->start_controls_tab(
            '_tab_title_normal',
            [
                'label' => __( 'Normal', 'bdevs-element' ),
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Text Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-title-section' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'title_before_color',
            [
                'label' => __( 'border Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-title-section:before' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_title_hover',
            [
                'label' => __( 'Hover', 'bdevs-element' ),
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label' => __( 'Text Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}:hover .bdevs-el-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'title_before_hover_color',
            [
                'label' => __( 'border Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-title:hover:before' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        //Content Style
        $this->start_controls_section(
            '_section_post_tab_content',
            [
                'label' => __('Content', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'post_content_image',
            [
                'label' => __('Image', 'bdevs-element'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_responsive_control(
            'post_item_content_img_margin_btm',
            [
                'label' => __('Margin Bottom', 'bdevs-element'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-thumb' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_boder',
                'label' => __('Border', 'bdevs-element'),
                'selector' => '{{WRAPPER}} .bdevs-el-thumb img',
            ]
        );

        $this->add_responsive_control(
            'image_boder_radius',
            [
                'label' => __('Border Radius', 'bdevs-element'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_content_title',
            [
                'label' => __('Title', 'bdevs-element'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'post_content_margin_btm',
            [
                'label' => __('Margin Bottom', 'bdevs-element'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Typography', 'bdevs-element'),
                'scheme' => Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .bdevs-el-title',
            ]
        );

        $this->start_controls_tabs('title_tabs');
        $this->start_controls_tab(
            'title_normal_tab',
            [
                'label' => __('Normal', 'bdevs-element'),
            ]
        );

        $this->add_control(
            'title_colour',
            [
                'label' => __('Color', 'bdevs-element'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'title_hover_tab',
            [
                'label' => __('Hover', 'bdevs-element'),
            ]
        );

        $this->add_control(
            'title_hvr_color',
            [
                'label' => __('Color', 'bdevs-element'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-title:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();


        $this->add_responsive_control(
            'post_content_desc',
            [
                'label' => __('Description', 'bdevs-element'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'desc_typography',
                'label' => __('Typography', 'bdevs-element'),
                'scheme' => Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .bdevs-el-desc',
            ]
        );
        $this->add_control(
            'desc_colour',
            [
                'label' => __('Color', 'bdevs-element'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-desc' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_content_list',
            [
                'label' => __('List item', 'bdevs-element'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'post_content_list_margin_btm',
            [
                'label' => __('Margin Bottom', 'bdevs-element'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-list' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'list_typography',
                'label' => __('Typography', 'bdevs-element'),
                'scheme' => Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .bdevs-el-list a',
            ]
        );

        $this->start_controls_tabs('list_tabs');
        $this->start_controls_tab(
            'title_list_tab',
            [
                'label' => __('Normal', 'bdevs-element'),
            ]
        );

        $this->add_control(
            'list_colour',
            [
                'label' => __('Color', 'bdevs-element'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-list a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'list_hover_tab',
            [
                'label' => __('Hover', 'bdevs-element'),
            ]
        );

        $this->add_control(
            'list_hvr_color',
            [
                'label' => __('Color', 'bdevs-element'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-list a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();


        $this->add_responsive_control(
            'post_content_list_icon',
            [
                'label' => __('List icon', 'bdevs-element'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->start_controls_tabs('list_icon_tabs');
        $this->start_controls_tab(
            'title_list_tab_icon',
            [
                'label' => __('Normal', 'bdevs-element'),
            ]
        );

        $this->add_control(
            'list_icon_colour',
            [
                'label' => __('Color', 'bdevs-element'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-list a i, {{WRAPPER}} .bdevs-el-list li:before' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'list_icon_hover_tab',
            [
                'label' => __('Hover', 'bdevs-element'),
            ]
        );

        $this->add_control(
            'list_icon_hvr_color',
            [
                'label' => __('Color', 'bdevs-element'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-list a i:hover, {{WRAPPER}} .bdevs-el-list li:after' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();


        $this->end_controls_section();
    }

    protected function render()
    {

        $settings = $this->get_settings_for_display();
        if (!$settings['post_type']) {
            return;
        }

        $taxonomy = $settings['tax_type_' . $settings['post_type']];
        $terms_ids = $settings['tax_ids_' . $taxonomy];
        $terms_args = [
            'taxonomy' => $taxonomy,
            'hide_empty' => true,
            'include' => $terms_ids,
            'orderby' => 'term_id',
        ];
        $filter_list = get_terms($terms_args);

        $post_args = [
            'post_status' => 'publish',
            'post_type' => $settings['post_type'],
            'posts_per_page' => $settings['item_limit'],
            'tax_query' => array(
                array(
                    'taxonomy' => $taxonomy,
                    'field' => 'term_id',
                    'terms' => $terms_ids ? $terms_ids : '',
                ),
            ),
        ];
        $posts = get_posts($post_args);
        ?>
        <?php if (!empty($settings['design_style']) and $settings['design_style'] == 'style_2') : ?>


        <?php else: ?>

            <div class="category_filter_sidebar">
                <div class="fs_widget category_list">
                  <?php if( !empty($settings['title']) ) : ?>
                    <h3 class="fs_widget_title"><?php echo bdevs_element_kses_basic($settings['title']); ?></h3>
                  <?php endif; ?>
                  <ul class="ul_li_block">
                    <li><a href="#"><?php echo esc_html__('All Categories', 'bdevs-element'); ?> <span></span></a></li>
                    <?php
                    foreach ($filter_list as $key => $list):
                        $thumbnail_id = get_term_meta( $list->term_id, 'thumbnail_id', true );
                        $image = wp_get_attachment_url( $thumbnail_id );
                    ?>
                    <li><a href="<?php echo get_term_link( $list ); ?>"><?php echo esc_html($list->name); ?> <span>(<?php echo esc_html($list->count); ?>)</span></a></li>
                    <?php endforeach; ?>

                  </ul>

                  
                </div>
                <?php if( !empty($settings['product_btn']) ) : ?>
                <div class="fs_widget">
                  <a href="<?php echo esc_url($settings['product_url']); ?>" class="btn btn_success btn_rounded"><?php echo esc_html($settings['product_btn']); ?></a>
                </div>
                <?php endif; ?>
            </div>

        <?php
        endif;
    }
}
