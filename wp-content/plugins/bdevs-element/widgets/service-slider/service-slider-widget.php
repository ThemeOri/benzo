<?php

namespace BdevsElement\Widget;

use \Elementor\Group_Control_Background;
use \Elementor\Repeater;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Utils;

defined('ABSPATH') || die();

class  Service_Slider extends BDevs_El_Widget
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
        return 'service-slider';
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
        return __('Service Slider', 'bdevs-element');
    }

    public function get_custom_help_url()
    {
        return 'http://elementor.bdevs.net//widgets/slider/';
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
        return 'eicon-gallery-grid';
    }

    public function get_keywords()
    {
        return ['slider', 'image', 'gallery', 'project'];
    }

    protected function register_content_controls()
    {

        $this->start_controls_section(
            '_section_design_title',
            [
                'label' => __('Design Style', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'design_style',
            [
                'label' => __('Design Style', 'bdevs-element'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __('Style 1', 'bdevs-element'),
                    'style_2' => __('Style 2', 'bdevs-element'),
                    'style_3' => __('Style 3', 'bdevs-element'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();

        // Title & Description
        $this->start_controls_section(
            '_section_title',
            [
                'label' => __('Title & Description', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_1'],
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'bdevs-element'),
                'label_block' => true,
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 4,
                'default' => 'Heading Title',
                'placeholder' => __('Heading Text', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' => __('Sub Title', 'bdevs-element'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => 'Heading Sub Title',
                'placeholder' => __('Heading Sub Text', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_1'],
                ],
            ]
        );
        $this->add_control(
            'description',
            [
                'label' => __('Description', 'bdevs-element'),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => __('Heading Description Text', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_2'],
                ],
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => __('Title HTML Tag', 'bdevs-element'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => __('H1', 'bdevs-element'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => __('H2', 'bdevs-element'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => __('H3', 'bdevs-element'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => __('H4', 'bdevs-element'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => __('H5', 'bdevs-element'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => __('H6', 'bdevs-element'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h3',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __('Alignment', 'bdevs-element'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'bdevs-element'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'bdevs-element'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'bdevs-element'),
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
            '_section_slides',
            [
                'label' => __('Service List', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'field_condition',
            [
                'label' => __('Field condition', 'bdevs-element'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __('Style 1', 'bdevs-element'),
                    'style_2' => __('Style 2', 'bdevs-element'),
                    'style_3' => __('Style 3', 'bdevs-element'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Image', 'bdevs-element' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );  

        $repeater->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __('Title', 'bdevs-element'),
                'default' => __('Item List', 'bdevs-element'),
                'placeholder' => __('Type title here', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

         $repeater->add_control(
            'price_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __('Price Title', 'bdevs-element'),
                'default' => __('price title', 'bdevs-element'),
                'placeholder' => __('Type price title here', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater->add_control(
            'price_title_value',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __('Price Title Value', 'bdevs-element'),
                'default' => __('price title value', 'bdevs-element'),
                'placeholder' => __('Type price title value here', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );


        $repeater->add_control(
            'slide_url',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __('URL', 'bdevs-element'),
                'default' => __('#', 'bdevs-element'),
                'placeholder' => __('Type url here', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => __( 'Description', 'bdevs-element' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => __( 'bdevs description', 'bdevs-element' ),
                'placeholder' => __( 'Description here', 'bdevs-element' ),
                'condition' => [
                    'field_condition' => ['style_1','style_2']
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater->add_control(
            'button_text',
            [
                'label' => __( 'Text', 'bdevs-element' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Button Text',
                'placeholder' => __( 'Type button text here', 'bdevs-element' ),
                'condition' => [
                    'field_condition' => ['style_1','style_2']
                ],
                'label_block' => true, 
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'button_link',
            [
                'label' => __( 'Link', 'bdevs-element' ),
                'type' => Controls_Manager::URL,
                'placeholder' => 'http://elementor.bdevs.net/', 
                'condition' => [
                    'field_condition' => ['style_1','style_2']
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        if ( bdevs_element_is_elementor_version( '<', '2.6.0' ) ) {
            $repeater->add_control(
                'button_icon',
                [
                    'label' => __( 'Icon', 'bdevs-element' ),
                    'label_block' => true,
                    'type' => Controls_Manager::ICON,
                    'options' => bdevs_element_get_bdevs_element_icons(),
                    'condition' => [
                    'field_condition' => ['style_1','style_2']
                ],
                    'default' => 'fa fa-angle-right',
                ]
            );

            $condition = ['button_icon!' => ''];
        } else {
            $repeater->add_control(
                'button_selected_icon',
                [
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'button_icon',
                    'condition' => [
                    'field_condition' => ['style_1','style_2']
                ],
                    'label_block' => true,
                ]
            );
            $condition = ['button_selected_icon[value]!' => ''];
        }

        $repeater->add_control(
            'button_icon_position',
            [
                'label' => __( 'Icon Position', 'bdevs-element' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'condition' => [
                    'field_condition' => ['style_1','style_2']
                ],
                'options' => [
                    'before' => [
                        'title' => __( 'Before', 'bdevs-element' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'after' => [
                        'title' => __( 'After', 'bdevs-element' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'before',
                'toggle' => false,
                'condition' => $condition,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'button_icon_spacing',
            [
                'label' => __( 'Icon Spacing', 'bdevs-element' ),
                'type' => Controls_Manager::SLIDER,
                'condition' => $condition,
                'condition' => [
                    'field_condition' => ['style_1','style_2']
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn--icon-before .bdevs-el-btn-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .bdevs-el-btn--icon-after .bdevs-el-btn-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'slides',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(title || "Carousel Item"); #>',
                'default' => [
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ]
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'medium_large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_settings',
            [
                'label' => __('Settings', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_1'],
                ],
            ]
        );

        $this->add_control(
            'animation_speed',
            [
                'label' => __('Animation Speed', 'bdevs-element'),
                'type' => Controls_Manager::NUMBER,
                'min' => 100,
                'step' => 10,
                'max' => 10000,
                'default' => 300,
                'description' => __('Slide speed in milliseconds', 'bdevs-element'),
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => __('Autoplay?', 'bdevs-element'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'bdevs-element'),
                'label_off' => __('No', 'bdevs-element'),
                'return_value' => 'yes',
                'default' => 'yes',
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label' => __('Autoplay Speed', 'bdevs-element'),
                'type' => Controls_Manager::NUMBER,
                'min' => 100,
                'step' => 100,
                'max' => 10000,
                'default' => 3000,
                'description' => __('Autoplay speed in milliseconds', 'bdevs-element'),
                'condition' => [
                    'autoplay' => 'yes'
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'loop',
            [
                'label' => __('Infinite Loop?', 'bdevs-element'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'bdevs-element'),
                'label_off' => __('No', 'bdevs-element'),
                'return_value' => 'yes',
                'default' => 'yes',
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'vertical',
            [
                'label' => __('Vertical Mode?', 'bdevs-element'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'bdevs-element'),
                'label_off' => __('No', 'bdevs-element'),
                'return_value' => 'yes',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'navigation',
            [
                'label' => __('Navigation', 'bdevs-element'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => __('None', 'bdevs-element'),
                    'arrow' => __('Arrow', 'bdevs-element'),
                    'dots' => __('Dots', 'bdevs-element'),
                    'both' => __('Arrow & Dots', 'bdevs-element'),
                ],
                'default' => 'arrow',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();
    }

    protected function register_style_controls()
    {
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

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        if (empty($settings['slides'])) {
            return;
        }
        ?>

        <?php if ($settings['design_style'] === 'style_3'): 

        ?>

        <div class="service_details">
        <div class="related_service_wrap ">
        <div class="container">
            <div class="row">
                <?php foreach ($settings['slides'] as $key => $slide) :
                    if (!empty($slide['image']['id'])) {
                        $image = wp_get_attachment_image_url($slide['image']['id'], $settings['thumbnail_size']);
                    }

                ?>
             <div class="col col-lg-4 col-md-6 col-sm-6">
                <div class="service_card_layout style_2 p-0">
                  <div class="item_image">
                    <?php if( $slide['image'] ) : ?>
                    <a class="image_wrap" href="<?php echo esc_url( $slide['slide_url'] ); ?>">
                      <img src="<?php print esc_url($image); ?>" alt="Service Image">
                    </a>
                    <?php endif; ?>

                    <div class="price_wrap">
                      <?php if( $slide['price_title'] ) : ?>
                      <span><?php echo bdevs_element_kses_basic( $slide['price_title'] ); ?></span>
                      <?php endif; ?>
                      <?php if( $slide['price_title_value'] ) : ?>
                      <strong data-text-color="#D42222" style="color: rgb(212, 34, 34);"><?php echo bdevs_element_kses_basic( $slide['price_title_value'] ); ?></strong>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="item_content">
                    <?php if( $slide['title'] ) : ?>
                    <a href="<?php echo esc_url( $slide['slide_url'] ); ?>">
                      <h4 class="item_title bdevs-el-title mb-0"><?php echo bdevs_element_kses_basic( $slide['title'] ); ?></h4>
                    </a>
                    <?php endif; ?>
                  </div>
                </div>
                </div>
              <?php endforeach; ?>
            </div>
           </div>
           </div>
        </div>

        <?php elseif ($settings['design_style'] === 'style_2'): ?>


        <div class="service_section_in">
            <div class="container">
              <div class="service_items_wrap">
                <div class="row">
                <?php foreach ($settings['slides'] as $key => $slide) :
                    if (!empty($slide['image']['id'])) {
                        $image = wp_get_attachment_image_url($slide['image']['id'], $settings['thumbnail_size']);
                    }

                    $this->add_render_attribute( 'button_'. $key, 'class', 'btn danger_border btn_rounded bdevs-el-btn' );
                    $this->add_render_attribute( 'button_'. $key, 'href', $slide['button_link']['url'] );
                ?>
                <div class="col col-lg-4 col-md-6">
                    <div class="service_card_layout style_2 bordered">
                      <div class="item_image">
                        <?php if( $slide['image'] ) : ?>
                        <a class="image_wrap" href="<?php echo esc_url( $slide['slide_url'] ); ?>">
                          <img src="<?php print esc_url($image); ?>" alt="Service Image">
                        </a>
                        <?php endif; ?>
                        <div class="price_wrap">
                          <?php if( $slide['price_title'] ) : ?>
                          <span><?php echo bdevs_element_kses_basic( $slide['price_title'] ); ?></span>
                          <?php endif; ?>
                          <?php if( $slide['price_title_value'] ) : ?>
                          <strong data-text-color="#D42222"><?php echo bdevs_element_kses_basic( $slide['price_title_value'] ); ?></strong>
                          <?php endif; ?>
                        </div>
                      </div>
                      <div class="item_content">
                        <?php if( $slide['title'] ) : ?>
                        <a href="<?php echo esc_url( $slide['slide_url'] ); ?>">
                          <h4 class="item_title"><?php echo bdevs_element_kses_basic( $slide['title'] ); ?></h4>
                        </a>
                        <?php endif; ?>
                        <?php if( $slide['description'] ) : ?>
                        <p>
                          <?php echo bdevs_element_kses_basic( $slide['description'] ); ?>
                        </p>
                        <?php endif; ?>
                       <?php if ( $slide['button_text'] && ( ( empty( $slide['button_selected_icon'] ) || empty( $slide['button_selected_icon']['value'] ) ) && empty( $slide['button_icon'] ) ) ) :
                                printf( '<a %1$s>%2$s</a>',
                                    $this->get_render_attribute_string( 'button_'. $key ),
                                    esc_html( $slide['button_text'] )
                                    );
                            elseif ( empty( $slide['button_text'] ) && ( ( !empty( $slide['button_selected_icon'] ) || empty( $slide['button_selected_icon']['value'] ) ) || !empty( $slide['button_icon'] ) ) ) : ?>
                                <a <?php $this->print_render_attribute_string( 'button_'. $key ); ?>><?php bdevs_element_render_icon( $slide, 'button_icon', 'button_selected_icon' ); ?></a>
                            <?php elseif ( $slide['button_text'] && ( ( !empty( $slide['button_selected_icon'] ) || empty( $slide['button_selected_icon']['value'] ) ) || !empty($slide['button_icon']) ) ) :
                                if ( $slide['button_icon_position'] === 'before' ): ?>
                                    <a <?php $this->print_render_attribute_string( 'button_'. $key ); ?>><span><?php bdevs_element_render_icon( $slide, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon'] ); ?></span> <?php echo esc_html($slide['button_text']); ?></a>
                                    <?php
                                else: ?>
                                    <a <?php $this->print_render_attribute_string( 'button_'. $key ); ?>><?php echo esc_html($slide['button_text']); ?> <span><?php bdevs_element_render_icon( $slide, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon'] ); ?></span></a>
                                <?php
                                endif;
                        endif; ?>
                      </div>
                    </div>
                  </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
        </div>


        <?php else: 
        $title = bdevs_element_kses_basic($settings['title']);

       $this->add_inline_editing_attributes('title', 'basic');
        $this->add_render_attribute('title', 'class', 'title_text mb-0 bdevs-el-title');

        ?>

        <div class="service_section">
            <div class="container">

              <div class="row justify-content-center">
                <div class="col col-lg-5">
                  <div class="section_title text-center">
                    <?php if ($settings['sub_title']) : ?>
                    <h2 class="sub_title bdevs-el-subtitle">
                       <?php echo bdevs_element_kses_intermediate($settings['sub_title']); ?>
                      <span class="icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo/favourite_icon_3.png" alt="Logo Icon">
                      </span>
                      <?php endif;?>
                    </h2>
                    <?php printf('<%1$s %2$s>%3$s</%1$s>',
                        tag_escape($settings['title_tag']),
                        $this->get_render_attribute_string('title'),
                        $title
                    ); ?>
                  </div>
                </div>
              </div>

              <div class="featured_services_carousel carousel_style_2">
                <div class="row common_carousel_3col" data-slick='{"arrows": false}'>
                <?php foreach ($settings['slides'] as $key => $slide) :
                    if (!empty($slide['image']['id'])) {
                        $image = wp_get_attachment_image_url($slide['image']['id'], $settings['thumbnail_size']);
                    }

                    $this->add_render_attribute( 'button_'. $key, 'class', 'btn success_border btn_rounded bdevs-el-btn' );
                    $this->add_render_attribute( 'button_'. $key, 'href', $slide['button_link']['url'] );
                 ?>
                  <div class="col carousel_item">
                    <div class="service_card_layout style_2">
                      <div class="item_image">
                        <?php if( $slide['image'] ) : ?>
                        <a class="image_wrap" href="<?php echo esc_url( $slide['slide_url'] ); ?>">
                          <img src="<?php print esc_url($image); ?>" alt="Service Image">
                        </a>
                        <?php endif; ?>
                        <div class="price_wrap">
                        <?php if( $slide['price_title'] ) : ?>
                          <span><?php echo bdevs_element_kses_basic( $slide['price_title'] ); ?></span>
                          <?php endif; ?>
                          <?php if( $slide['price_title_value'] ) : ?>
                          <strong><?php echo bdevs_element_kses_basic( $slide['price_title_value'] ); ?></strong>
                          <?php endif; ?>
                        </div>
                      </div>
                      <div class="item_content">

                        <?php if( $slide['title'] ) : ?>
                        <a href="<?php echo esc_url( $slide['slide_url'] ); ?>">
                          <h4 class="item_title bdevs-el-title"><?php echo bdevs_element_kses_basic( $slide['title'] ); ?></h4>
                        </a>
                        <?php endif; ?>

                        <?php if( $slide['description'] ) : ?>
                        <p>
                          <?php echo bdevs_element_kses_basic( $slide['description'] ); ?>
                        </p>
                        <?php endif; ?>

                        <?php if ( $slide['button_text'] && ( ( empty( $slide['button_selected_icon'] ) || empty( $slide['button_selected_icon']['value'] ) ) && empty( $slide['button_icon'] ) ) ) :
                                printf( '<a %1$s>%2$s</a>',
                                    $this->get_render_attribute_string( 'button_'. $key ),
                                    esc_html( $slide['button_text'] )
                                    );
                            elseif ( empty( $slide['button_text'] ) && ( ( !empty( $slide['button_selected_icon'] ) || empty( $slide['button_selected_icon']['value'] ) ) || !empty( $slide['button_icon'] ) ) ) : ?>
                                <a <?php $this->print_render_attribute_string( 'button_'. $key ); ?>><?php bdevs_element_render_icon( $slide, 'button_icon', 'button_selected_icon' ); ?></a>
                            <?php elseif ( $slide['button_text'] && ( ( !empty( $slide['button_selected_icon'] ) || empty( $slide['button_selected_icon']['value'] ) ) || !empty($slide['button_icon']) ) ) :
                                if ( $slide['button_icon_position'] === 'before' ): ?>
                                    <a <?php $this->print_render_attribute_string( 'button_'. $key ); ?>><span><?php bdevs_element_render_icon( $slide, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon'] ); ?></span> <?php echo esc_html($slide['button_text']); ?></a>
                                    <?php
                                else: ?>
                                    <a <?php $this->print_render_attribute_string( 'button_'. $key ); ?>><?php echo esc_html($slide['button_text']); ?> <span><?php bdevs_element_render_icon( $slide, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon'] ); ?></span></a>
                                <?php
                                endif;
                             endif; ?>
                      </div>
                    </div>
                  </div>
                  <?php endforeach; ?>
                </div>
              </div>

            </div>
        </div>

    <?php endif; ?>

        <?php
    }
}
