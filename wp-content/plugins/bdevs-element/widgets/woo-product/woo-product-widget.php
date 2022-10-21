<?php
namespace BdevsElement\Widget;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Icons_Manager;
use \Elementor\Repeater;
use \Elementor\Core\Schemes;
use \Elementor\Group_Control_Background;
use \BdevsElement\BDevs_El_Select2;
use Elementor\Utils;

defined('ABSPATH') || die();

class Woo_Product extends BDevs_El_Widget
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
        return 'woo_product';
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
        return __('Woo Product', 'bdevs-element');
    }

    public function get_custom_help_url()
    {
        return 'http://elementor.bdevs.net//widgets/post-list/';
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
        return 'eicon-product-images';
    }

    public function get_keywords()
    {
        return ['posts', 'post', 'post-list', 'list', 'product'];
    }

    /**
     * Get a list of All Post Types
     *
     * @return array
     */
    public function get_post_types()
    {
        $post_types = bdevs_element_get_post_types([], ['elementor_library', 'attachment']);
        return $post_types;
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
                'label' => __( 'Design Style', 'bdevs-element' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __( 'Style 1', 'bdevs-element' ),
                    'style_2' => __( 'Style 2', 'bdevs-element' ),
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
                'label' => __('Title & Description', 'bdevselement'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_2']
                ]
            ]
        );

        $this->add_control(
            'bg_image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Image', 'bdevselement' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_3']
                ]
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'bdevselement'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Shop By Categories',
                'placeholder' => __('Heading Text', 'bdevselement'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' => __('Sub Title', 'bdevselement'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Sub Title',
                'placeholder' => __('Sub Title Text', 'bdevselement'),
                'condition' => [
                    'design_style' => ['style_2']
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

         $this->add_control(
            'back_title',
            [
                'label' => __('Back Title', 'bdevselement'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Back Title',
                'placeholder' => __('Back Title Text', 'bdevselement'),
                'condition' => [
                    'design_style' => ['style_2']
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

          $this->add_control(
            'extra_button_text',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __( 'Button', 'bdevselement' ),
                'label_block' => true,
                'default' => __('Browse More', 'bdevselement'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_2']
                ]
            ]
        );
        $this->add_control(
            'extra_button_link',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __( 'Button Link', 'bdevselement' ),
                'label_block' => true,
                'default' => __('#', 'bdevselement'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_2']
                ]
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => __('Title HTML Tag', 'elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p',
                ],
                'default' => 'h2',
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __('Alignment', 'bdevselement'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'bdevselement'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'bdevselement'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'bdevselement'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();
   


        $this->start_controls_section(
            '_section_post_list',
            [
                'label' => __('List', 'bdevs-element'),
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

        $this->add_control(
            'show_post_by',
            [
                'label' => __('Show post by:', 'bdevs-element'),
                'type' => Controls_Manager::SELECT,
                'default' => 'recent',
                'options' => [
                    'recent' => __('Recent Post', 'bdevs-element'),
                    'selected' => __('Selected Post', 'bdevs-element'),
                ],

            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => __('Item Limit', 'bdevs-element'),
                'type' => Controls_Manager::NUMBER,
                'default' => 3,
                'dynamic' => ['active' => true],
                'condition' => [
                    'show_post_by' => ['recent']
                ]
            ]
        );

        $repeater = [];

        foreach ($this->get_post_types() as $key => $value) {

            $repeater[$key] = new Repeater();

            $repeater[$key]->add_control(
                'title',
                [
                    'label' => __('Title', 'bdevs-element'),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'placeholder' => __('Customize Title', 'bdevs-element'),
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );


            $repeater[$key]->add_control(
                'post_id',
                [
                    'label' => __('Select ', 'bdevs-element') . $value,
                    'label_block' => true,
                    'type' => BDevs_El_Select2::TYPE,
                    'multiple' => false,
                    'placeholder' => 'Search ' . $value,
                    'data_options' => [
                        'post_type' => $key,
                        'action' => 'bdevs_element_post_list_query'
                    ],
                ]
            );


            $this->add_control(
                'selected_list_' . $key,
                [
                    'label' => '',
                    'type' => Controls_Manager::REPEATER,
                    'fields' => $repeater[$key]->get_controls(),
                    'title_field' => '{{ title }}',
                    'condition' => [
                        'show_post_by' => 'selected',
                        'post_type' => $key
                    ],
                ]
            );
        }

        $this->end_controls_section();

    }

    protected function register_style_controls(){
        $this->start_controls_section(
            '_section_style_content',
            [
                'label' => __( 'Title / Content', 'bdevs-element' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_responsive_control(
            'content_padding',
            [
                'label' => __( 'Content Padding', 'bdevs-element' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'content_background',
                'selector' => '{{WRAPPER}} .bdevs-el-content',
                'exclude' => [
                    'image'
                ]
            ]
        );
        
        // Title
        $this->add_control(
            '_heading_title',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Title', 'bdevs-element' ),
                'separator' => 'before'
            ]
        );
        
        $this->add_responsive_control(
            'title_spacing',
            [
                'label' => __( 'Bottom Spacing', 'bdevs-element' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'title_color',
            [
                'label' => __( 'Text Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title',
                'selector' => '{{WRAPPER}} .bdevs-el-title',
                'scheme' => Typography::TYPOGRAPHY_2,
            ]
        );
        
        // Subtitle    
        $this->add_control(
            '_heading_subtitle',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Subtitle', 'bdevs-element' ),
                'separator' => 'before'
            ]
        );
        
        $this->add_responsive_control(
            'subtitle_spacing',
            [
                'label' => __( 'Bottom Spacing', 'bdevs-element' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'subtitle_color',
            [
                'label' => __( 'Text Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-subtitle' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle',
                'selector' => '{{WRAPPER}} .bdevs-el-subtitle',
                'scheme' => Typography::TYPOGRAPHY_3,
            ]
        );
        
        // description
        $this->add_control(
            '_content_description',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Description', 'bdevs-element' ),
                'separator' => 'before'
            ]
        );
        
        $this->add_responsive_control(
            'description_spacing',
            [
                'label' => __( 'Bottom Spacing', 'bdevs-element' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-content p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'description_color',
            [
                'label' => __( 'Text Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-content p' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description',
                'selector' => '{{WRAPPER}} .bdevs-el-content p',
                'scheme' => Typography::TYPOGRAPHY_4,
            ]
        );
        
        
        $this->end_controls_section();

        // Button 1 style
        $this->start_controls_section(
            '_section_style_button',
            [
                'label' => __( 'Button', 'bdevs-element' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __( 'Padding', 'bdevs-element' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .bdevs-el-btn',
                'scheme' => Typography::TYPOGRAPHY_4,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .bdevs-el-btn',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => __( 'Border Radius', 'bdevs-element' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .bdevs-el-btn',
            ]
        );

        $this->add_control(
            'hr',
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->start_controls_tabs( '_tabs_button' );

        $this->start_controls_tab(
            '_tab_button_normal',
            [
                'label' => __( 'Normal', 'bdevs-element' ),
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => __( 'Text Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => __( 'Background Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_button_hover',
            [
                'label' => __( 'Hover', 'bdevs-element' ),
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label' => __( 'Text Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn:hover, {{WRAPPER}} .bdevs-el-btn:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color',
            [
                'label' => __( 'Background Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn:hover, {{WRAPPER}} .bdevs-el-btn:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => __( 'Border Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'button_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn:hover, {{WRAPPER}} .bdevs-el-btn:focus' => 'border-color: {{VALUE}};',
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
        if (!$settings['post_type']) return;
        $args = [
            'post_status' => 'publish',
            'post_type' => $settings['post_type'],
        ];
        if ('recent' === $settings['show_post_by']) {
            $args['posts_per_page'] = $settings['posts_per_page'];
        }

        $customize_title = [];
        $ids = [];
        if ('selected' === $settings['show_post_by']) {
            $args['posts_per_page'] = -1;
            $lists = $settings['selected_list_' . $settings['post_type']];
            if (!empty($lists)) {
                foreach ($lists as $index => $value) {
                    $ids[] = $value['post_id'];
                    if ($value['title']) $customize_title[$value['post_id']] = $value['title'];
                }
            }
            $args['post__in'] = (array)$ids;
            $args['orderby'] = 'post__in';
        }

        if ('selected' === $settings['show_post_by'] && empty($ids)) {
            $posts = [];
        } else {
            $posts = get_posts($args);
        }

        ?>

        <?php if (!empty($settings['design_style']) and $settings['design_style'] == 'style_5'):
        if (count($posts) !== 0) :
            ?>
            <section class="product-h-two">
                <div class="container">
                    <div class="row product-active common-arrows">
                        <?php foreach ($posts as $post): ?>
                            <div class="col-lg-3 col-sm-6 custom-width-20">
                                <div class="product-wrapper mb-40">
                                    <div class="pro-img mb-20">
                                        <a href="<?php echo esc_url(get_the_permalink($post->ID)); ?>">
                                            <?php echo get_the_post_thumbnail($post->ID, 'large', ['class' => 'img-fluid']); ?>
                                        </a>
                                        <div class="product-action text-center">
                                            <?php echo \BdevsElement\BDevs_El_Woocommerce::add_to_cart_button($post->ID); ?>

                                            <?php echo \BdevsElement\BDevs_El_Woocommerce::quick_view_button($post->ID); ?>

                                            <?php echo \BdevsElement\BDevs_El_Woocommerce::yith_wishlist($post->ID); ?>
                                        </div>
                                    </div>
                                    <div class="pro-text">
                                        <div class="pro-title">
                                            <h6>
                                                <?php
                                                $title = $post->post_title;
                                                if ('selected' === $settings['show_post_by'] && array_key_exists($post->ID, $customize_title)) {
                                                    $title = $customize_title[$post->ID];
                                                }

                                                printf('<a href="%2$s">%1$s</a>',
                                                    esc_html($title),
                                                    esc_url(get_the_permalink($post->ID))
                                                );
                                                ?>
                                            </h6>
                                            <h5 class="pro-price">
                                                <?php echo \BdevsElement\BDevs_El_Woocommerce::product_price($post->ID, true); ?>
                                            </h5>
                                        </div>
                                        <div class="cart-icon">
                                            <a href="<?php print esc_url(get_the_permalink($post->ID)); ?>">
                                                <i class="fal fa-heart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        <?php
        else:
            printf('%1$s %2$s %3$s',
                __('No ', 'bdevs-element'),
                esc_html($settings['post_type']),
                __('Found', 'bdevs-element')
            );
        endif;
        ?>

    <?php elseif (!empty($settings['design_style']) and $settings['design_style'] == 'style_4'):
        if (count($posts) !== 0) :
            ?>
            <section class="product-h-three">
                <div class="container">
                    <div class="row custom-row-10">
                        <?php foreach ($posts as $post): ?>
                            <div class="col-lg-3 col-sm-6 custom-col-10 custom-width-20">
                                <div class="product-wrapper mb-40">
                                    <div class="pro-img mb-10">
                                        <a href="<?php echo esc_url(get_the_permalink($post->ID)); ?>">
                                            <?php echo get_the_post_thumbnail($post->ID, 'large', ['class' => 'img-fluid']); ?>
                                        </a>
                                        <div class="product-action text-center">
                                            <?php echo \BdevsElement\BDevs_El_Woocommerce::add_to_cart_button($post->ID); ?>

                                            <?php echo \BdevsElement\BDevs_El_Woocommerce::quick_view_button($post->ID); ?>

                                            <?php echo \BdevsElement\BDevs_El_Woocommerce::yith_wishlist($post->ID); ?>
                                        </div>
                                    </div>
                                    <?php echo \BdevsElement\BDevs_El_Woocommerce::product_rating($post->ID); ?>
                                    <div class="pro-text">
                                        <div class="pro-title pro-title-three">
                                            <h6>
                                                <?php
                                                $title = $post->post_title;
                                                if ('selected' === $settings['show_post_by'] && array_key_exists($post->ID, $customize_title)) {
                                                    $title = $customize_title[$post->ID];
                                                }

                                                printf('<a href="%2$s">%1$s</a>',
                                                    esc_html($title),
                                                    esc_url(get_the_permalink($post->ID))
                                                );
                                                ?>
                                            </h6>
                                            <h5 class="pro-price">
                                                <?php echo \BdevsElement\BDevs_El_Woocommerce::product_price($post->ID, true); ?>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        <?php
        else:
            printf('%1$s %2$s %3$s',
                __('No ', 'bdevs-element'),
                esc_html($settings['post_type']),
                __('Found', 'bdevs-element')
            );
        endif;
        ?>
    <?php elseif (!empty($settings['design_style']) and $settings['design_style'] == 'style_3'):
        if (count($posts) !== 0) :
            ?>
            <section class="product-h-three">
                <div class="container">
                    <div class="row custom-row-10 product-active common-arrows">
                        <?php foreach ($posts as $post): ?>
                            <div class="col-lg-3 col-sm-6 custom-col-10">
                                <div class="product-wrapper mb-40">
                                    <div class="pro-img mb-10">
                                        <a href="<?php echo esc_url(get_the_permalink($post->ID)); ?>">
                                            <?php print get_the_post_thumbnail($post->ID, 'full', ['class' => 'img-fluid']); ?>
                                        </a>
                                        <div class="product-action text-center">
                                            <?php echo \BdevsElement\BDevs_El_Woocommerce::add_to_cart_button($post->ID); ?>

                                            
                                            <?php echo \BdevsElement\BDevs_El_Woocommerce::quick_view_button($post->ID); ?>

                                            <?php echo \BdevsElement\BDevs_El_Woocommerce::yith_wishlist($post->ID); ?>
                                        </div>
                                    </div>
                                    <?php echo \BdevsElement\BDevs_El_Woocommerce::product_rating($post->ID); ?>
                                    <div class="pro-text">
                                        <div class="pro-title pro-title-three">
                                            <h6>
                                                <?php
                                                $title = $post->post_title;
                                                if ('selected' === $settings['show_post_by'] && array_key_exists($post->ID, $customize_title)) {
                                                    $title = $customize_title[$post->ID];
                                                }

                                                printf('<a href="%2$s">%1$s</a>',
                                                    esc_html($title),
                                                    esc_url(get_the_permalink($post->ID))
                                                );
                                                ?>
                                            </h6>
                                            <h5 class="pro-price">
                                                <?php echo \BdevsElement\BDevs_El_Woocommerce::product_price($post->ID, true); ?>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        <?php
        else:
            printf('%1$s %2$s %3$s',
                __('No ', 'bdevs-element'),
                esc_html($settings['post_type']),
                __('Found', 'bdevs-element')
            );
        endif;
        ?>

    <?php elseif (!empty($settings['design_style']) and $settings['design_style'] == 'style_2'): ?>
        <?php if ( !empty($posts) ) : ?>

          <section class="product_section">
            <div class="container">

              <div class="row align-items-center">
                <div class="col col-lg-6">
                  <div class="section_title">
                    <?php if( !empty($settings['sub_title']) ) : ?>
                    <h2 class="sub_title">
                      <?php echo bdevs_element_kses_basic($settings['sub_title']); ?>
                      <?php if(!empty($settings['back_title'])) : ?>
                      <span class="under_text"><?php echo bdevs_element_kses_basic($settings['back_title']); ?></span>
                      <?php endif; ?>
                    </h2>
                    <?php endif; ?>

                    <?php if($settings['title']) : ?>
                    <h3 class="title_text bdevs-el-title mb-0"><?php echo bdevs_element_kses_basic($settings['title']); ?></h3>
                    <?php endif; ?>
                  </div>
                </div>

                <div class="col col-lg-6">
                    <?php if(!empty($settings['extra_button_text'])) : ?>
                  <div class="single_btn_wrap p-0 text-lg-end transoff">
                    <a class="btn btn_danger btn_rounded" href="<?php echo esc_url($settings['extra_button_link']); ?>"><?php echo bdevs_element_kses_basic($settings['extra_button_text']); ?></a>
                  </div>
                    <?php endif; ?>
                </div>
              </div>

              <div class="row">
                <?php foreach ($posts as $post): 

                $store_location = function_exists('get_field') && !empty(get_field( 'store_location', $post->ID )) ? get_field( 'store_location', $post->ID ) : NULL;
                $product_condition = function_exists('get_field') && !empty(get_field( 'product_condition', $post->ID )) ? get_field( 'product_condition', $post->ID ) : NULL;
                ?>
                <div class="col col-lg-6">
                  <div class="product_split">

                    <a class="item_image" href="<?php echo esc_url(get_the_permalink($post->ID)); ?>">
                        <?php echo get_the_post_thumbnail($post->ID, 'large', ['class' => 'img-fluid']); ?>
                    </a>
                    <div class="item_content">
                      <div class="post_date"><?php echo repairon_relative_time(); ?></div>
                      <h3 class="item_title">
                        <?php
                        $title = $post->post_title;
                        if ('selected' === $settings['show_post_by'] && array_key_exists($post->ID, $customize_title)) {
                            $title = $customize_title[$post->ID];
                        }

                        printf('<a href="%2$s">%1$s</a>',
                            esc_html($title),
                            esc_url(get_the_permalink($post->ID))
                        );
                        ?>
                      </h3>
                      <ul class="item_info_list ul_li">
                        <?php if(!empty($store_location)) : ?>
                        <li><?php echo esc_html__('Location :', 'bdevs-element'); ?> <span><?php echo esc_html($store_location); ?></span></li>
                        <?php endif; ?>
                        <?php if(!empty($product_condition)) : ?>
                        <li><?php echo esc_html__('Condition :', 'bdevs-element'); ?>  <span><?php echo esc_html($product_condition); ?></span></li>
                        <?php endif; ?>
                      </ul>
                      <div class="item_price">
                        <?php echo \BdevsElement\BDevs_El_Woocommerce::product_price($post->ID, true); ?>
                      </div>
                    </div>
                  </div>
                </div>
                <?php endforeach; ?>

              </div>

            </div>
          </section>


        <?php
        else:
            printf('%1$s %2$s %3$s',
                __('No ', 'bdevs-element'),
                esc_html($settings['post_type']),
                __('Found', 'bdevs-element')
            );
        endif;
        ?>
    <?php else: ?>
        <?php if ( !empty($posts) ) : ?>


        <div class="product_group_carousel arrow_top_right">
            <div class="common_carousel_4col" data-slick='{"dots": false}'>

            <?php  
            $news_array = array();               
            foreach($posts as $qKey => $news) {
                    $categories = get_the_category($news->ID);
                    array_push($news_array, $news);
                } 
                wp_reset_postdata();
                $news_count = count($news_array);
            ?>
            <?php 
                for ( $i=0; $i < $news_count; $i+=2 ):
                $news = $news_array[$i]; 
            ?>
              <div class="carousel_item">

                    <div class="product_grid_2">
                    <a class="item_image" href="<?php echo esc_url(get_the_permalink($news->ID)); ?>">
                        <?php print get_the_post_thumbnail($news->ID, 'full', ['class' => 'img-fluid']); ?>
                    </a>
                      <div class="item_content">
                        <h3 class="item_title">
                            <?php
                            $title = $news->post_title;
                            if ('selected' === $settings['show_post_by'] && array_key_exists($news->ID, $customize_title)) {
                                $title = $customize_title[$news->ID];
                            }

                            printf('<a href="%2$s">%1$s</a>',
                                esc_html($title),
                                esc_url(get_the_permalink($news->ID))
                            );
                            ?>
                        </h3>
                        <?php echo \BdevsElement\BDevs_El_Woocommerce::product_rating_grid2($news->ID, true); ?>
                        <div class="item_price">
                          <?php echo \BdevsElement\BDevs_El_Woocommerce::product_price($news->ID, true); ?>
                        </div>

                        <ul class="cart_btns_group ul_li">
                          <?php echo \BdevsElement\BDevs_El_Woocommerce::add_to_cart_button($news->ID, true); ?>
                          <?php echo \BdevsElement\BDevs_El_Woocommerce::yith_wishlist($news->ID, true); ?>
                        </ul>
                      </div>
                    </div>

                   <?php 
                   for ($j=$i+1; $j <= $i+1; $j++): 
                   $news = $news_array[$j]; ?>
                    <div class="product_grid_2">

                    <a class="item_image" href="<?php echo esc_url(get_the_permalink($news->ID)); ?>">
                        <?php print get_the_post_thumbnail($news->ID, 'full', ['class' => 'img-fluid']); ?>
                    </a>

                      <div class="item_content">
                        <h3 class="item_title">
                            <?php
                            $title = $news->post_title;
                            if ('selected' === $settings['show_post_by'] && array_key_exists($news->ID, $customize_title)) {
                                $title = $customize_title[$news->ID];
                            }

                            printf('<a href="%2$s">%1$s</a>',
                                esc_html($title),
                                esc_url(get_the_permalink($news->ID))
                            );
                            ?>
                        </h3>
                        <?php echo \BdevsElement\BDevs_El_Woocommerce::product_rating_grid2($news->ID, true); ?>
                        <div class="item_price">
                          <?php echo \BdevsElement\BDevs_El_Woocommerce::product_price($news->ID, true); ?>
                        </div>
                        <ul class="cart_btns_group ul_li">
                          <?php echo \BdevsElement\BDevs_El_Woocommerce::add_to_cart_button($news->ID, true); ?>
                          <?php echo \BdevsElement\BDevs_El_Woocommerce::yith_wishlist($news->ID, true); ?>
                        </ul>
                      </div>
                    </div>

                <?php endfor; ?>

              </div>
            <?php endfor; ?>

            </div>
                <div class="carousel_arrow">
                  <button type="button" class="cc4c_left_arrow"><i class="fal fa-angle-left"></i></button>
                  <button type="button" class="cc4c_right_arrow"><i class="fal fa-angle-right"></i></button>
                </div>
            </div>

        <?php
        else:
            printf('%1$s %2$s %3$s',
                __('No ', 'bdevs-element'),
                esc_html($settings['post_type']),
                __('Found', 'bdevs-element')
            );
        endif;
        ?>
    <?php endif;
    }
}
