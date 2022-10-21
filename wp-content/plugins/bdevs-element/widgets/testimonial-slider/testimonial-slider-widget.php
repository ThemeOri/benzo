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

class Testimonial_Slider extends BDevs_El_Widget
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
        return 'testimonial_slider';
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
        return __('Testimonial Slider', 'bdevs-element');
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
        return 'eicon-blockquote';
    }

    public function get_keywords()
    {
        return ['slider', 'testimonial', 'gallery', 'carousel'];
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


        // section title
        $this->start_controls_section(
            '_section_title',
            [
                'label' => __('Title & Description', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_1','style_2','style_3']
                ]
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' => __('Sub Title', 'bdevs-element'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __('bdevs Info Box Sub Title', 'bdevs-element'),
                'placeholder' => __('Type Info Box Sub Title', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_1']
                ]
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'bdevs-element'),
                'label_block' => true,
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('bdevs Info Box Title', 'bdevs-element'),
                'placeholder' => __('Type Info Box Title', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __('Description', 'bdevs-element'),
                'description' => bdevs_element_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('bdevs info box description goes here', 'bdevs-element'),
                'placeholder' => __('Type info box description', 'bdevs-element'),
                'rows' => 5,
                'condition' => [
                    'design_style' => ['style_11']
                ],
                'dynamic' => [
                    'active' => true,
                ]
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


        // Testimonial Video Info
        $this->start_controls_section(
                '_section_title_video',
                [
                    'label' => __('Testimonial Video Info', 'bdevs-element'),
                    'tab' => Controls_Manager::TAB_CONTENT,
                    'condition' => [
                        'design_style' => ['style_20']
                    ]
                ]
            );
        
            $this->add_control(
                'video_title',
                [
                    'label' => __('Video Title', 'bdevs-element'),
                    'label_block' => true,
                    'type' => Controls_Manager::TEXTAREA,
                    'default' => __('bdevs video Title', 'bdevs-element'),
                    'placeholder' => __('Type video Title', 'bdevs-element'),
                    'dynamic' => [
                        'active' => true,
                    ]
                ]
            );
    
            $this->add_control(
                'video_description',
                [
                    'label' => __('Video Description', 'bdevs-element'),
                    'description' => bdevs_element_get_allowed_html_desc('intermediate'),
                    'type' => Controls_Manager::TEXTAREA,
                    'default' => __('bdevs video description goes here', 'bdevs-element'),
                    'placeholder' => __('Type video description', 'bdevs-element'),
                    'rows' => 5,
                    'dynamic' => [
                        'active' => true,
                    ]
                ]
            );
            $this->add_control(
                'video_url',
                [
                    'label' => __( 'Video URL', 'bdevs-element' ),
                    'description' => bdevs_element_get_allowed_html_desc( 'intermediate' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'https://www.youtube.com/embed/Rr0uFzAOQus', 'bdevs-element' ),
                    'placeholder' => __( 'Set Video URL', 'bdevs-element' ),
                    'label_block' => true,
                    'dynamic' => [
                        'active' => true,
                    ]
                ]
            );
        
        $this->end_controls_section();


        // Images

        $this->start_controls_section(
            '_section_image',
            [
                'label' => __('Image', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'type' => 'icon',
                    'field_condition' => ['style_10'],
                ]
            ]
        );

        $this->add_control(
            'image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __('Image', 'bdevs-element'),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->end_controls_section();

        // Slides
        $this->start_controls_section(
            '_section_slides',
            [
                'label' => __('Slides', 'bdevs-element'),
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
                    'style_2' => __('Style 2', 'bdevs-element')
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
                'label' => __('profile Image', 'bdevs-element'),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'field_condition' => ['style_1'],
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'message',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'show_label' => false,
                'placeholder' => __('Message', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'client_name',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => false,
                'placeholder' => __('Client Name', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'designation_name',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => false,
                'placeholder' => __('Designation Name', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'nav_bg_image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Nav BG Image', 'bdevs-element' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'field_condition' => ['style_2'],
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        ); 

        $this->add_control(
            'slides',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(client_name || "Carousel Item"); #>',
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


        // Settings
        $this->start_controls_section(
            '_section_settings',
            [
                'label' => __( 'Settings', 'bdevs-element' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

       $this->add_control(
            'ts_slider_autoplay',
            [
                'label' => esc_html__( 'Autoplay', 'bdevs-element' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'bdevs-element' ),
                'label_off' => esc_html__( 'No', 'bdevs-element' ),
                'return_value' => 'yes',
                'default' => 'no'
            ]
        );

        $this->add_control(
            'ts_slider_speed',
            [
               'label' => esc_html__( 'Slider Speed', 'bdevs-element' ),
               'type' => Controls_Manager::NUMBER,
               'placeholder' => esc_html__( 'Enter Slider Speed', 'bdevs-element' ),
               'default' => '5000',
               // 'default' => 5000,
               'condition' => ["ts_slider_autoplay" => ['yes']],
            ]
          );

        $this->add_control(
        'ts_slider_nav_show',
            [
            'label' => esc_html__( 'Nav show', 'bdevs-element' ),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Yes', 'bdevs-element' ),
            'label_off' => esc_html__( 'No', 'bdevs-element' ),
            'return_value' => 'yes',
            'default' => 'yes'
            ]
        );
        $this->add_control(
         'ts_slider_dot_nav_show',
             [
             'label' => esc_html__( 'Dot nav', 'bdevs-element' ),
             'type' => Controls_Manager::SWITCHER,
             'label_on' => esc_html__( 'Yes', 'bdevs-element' ),
             'label_off' => esc_html__( 'No', 'bdevs-element' ),
             'return_value' => 'yes',
             'default' => 'yes'
             ]
         );

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


    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        // ================
        $show_navigation   =   $settings["ts_slider_nav_show"]=="yes"?true:false;
        $auto_nav_slide    =   $settings['ts_slider_autoplay'];
        $dot_nav_show      =   $settings['ts_slider_dot_nav_show'];
        $ts_slider_speed   =   $settings['ts_slider_speed'] ? $settings['ts_slider_speed'] : '5000';

        $slide_controls    = [
            'show_nav'=>$show_navigation, 
            'dot_nav_show'=>$dot_nav_show, 
            'auto_nav_slide'=>$auto_nav_slide, 
            'ts_slider_speed'=>$ts_slider_speed, 
        ];
   
        $slide_controls = \json_encode($slide_controls); 
        // ================


        if (empty($settings['slides'])) {
            return;
        }

        $title = bdevs_element_kses_basic($settings['title']);
        ?>
        <?php if ($settings['design_style'] == 'style_4'): ?>
        <section class="testimonial_section sec_ptb_130 bg_gray clearfix">
            <div class="container">
                <?php if (!empty($settings['title'])): ?>
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-7 col-sm-9">
                            <div class="section_title text-center mb_30 wow fadeInUp22" data-wow-delay=".1s">
                                <?php if ($settings['sub_title']) : ?>
                                    <h4 class="small_title"><?php echo bdevs_element_kses_intermediate($settings['sub_title']); ?></h4>
                                <?php endif; ?>
                                <?php printf('<%1$s %2$s>%3$s<span>.</span></%1$s>',
                                    tag_escape($settings['title_tag']),
                                    $this->get_render_attribute_string('title'),
                                    $title
                                ); ?>
                                <?php if ($settings['big_title']) : ?>
                                    <span class="biggest_title"><?php echo bdevs_element_kses_intermediate($settings['big_title']); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="testimonial_carousel column_3_carousel owl-carousel owl-theme wow fadeInUp22"
                     data-wow-delay=".3s">
                    <?php foreach ($settings['slides'] as $slide) :
                        // image
                        $image = wp_get_attachment_image_url($slide['image']['id'], $settings['thumbnail_size']);
                        // bg_image
                        $bg_image = wp_get_attachment_image_url($slide['bg_image']['id'], 'full');
                        ?>
                        <div class="item">
                            <div class="testimonial_primary">
                                <div class="content_wrap">
                                    <?php if (!empty($slide['message'])): ?>
                                        <p><?php echo bdevs_element_kses_intermediate($slide['message']); ?></p>
                                    <?php endif; ?>
                                    <?php if (!empty($bg_image)): ?>
                                        <span class="quote_icon">
                                    <img src="<?php print esc_url($slide['bg_image']['url']); ?>" alt="icon_not_found">
                                </span>
                                    <?php endif; ?>
                                </div>
                                <div class="hero_info_wrap">
                                    <?php if (!empty($image)): ?>
                                        <div class="hero_thumbnail">
                                            <img src="<?php print esc_url($slide['image']['url']); ?>"
                                                 alt="icon_not_found">
                                        </div>
                                    <?php endif; ?>
                                    <div class="hero_info">
                                        <?php if ($slide['client_name']): ?>
                                            <h3 class="hero_name"><?php echo bdevs_element_kses_basic($slide['client_name']); ?></h3>
                                        <?php endif; ?>
                                        <?php if ($slide['designation_name']): ?>
                                            <span class="hero_title"><?php echo bdevs_element_kses_basic($slide['designation_name']); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php elseif ($settings['design_style'] == 'style_3'): 

        $this->add_inline_editing_attributes( 'title', 'basic' );
        $this->add_render_attribute( 'title', 'class', 'title_text mb-0 bdevs-el-title' );

        ?>

        <section class="testimonial_section">
            <div class="container">

              <div class="row justify-content-center">
                <div class="col col-lg-6">
                  <div class="section_title text-center">
                    <?php if ($settings['sub_title']) : ?>
                    <h2 class="sub_title bdevs-el-subtitle">
                      <?php echo bdevs_element_kses_intermediate($settings['sub_title']); ?>
                    </h2>
                    <?php endif; ?>
                    <?php
                        if ( $settings['title' ] ) :
                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['title_tag'] ),
                                $this->get_render_attribute_string( 'title' ),
                                 $settings['title' ]
                                );
                        endif;
                    ?>
                  </div>
                </div>
              </div>

              <div class="testimonial_carousel_3" data-slick='{"arrows": false}'>
                <div class="common_carousel_3col">
                 <?php foreach ($settings['slides'] as $slide) :
                        if (!empty($slide['image']['id'])) {
                            $image = wp_get_attachment_image_url($slide['image']['id'], $settings['thumbnail_size']);
                        }
                  ?>
                  <div class="carousel_item">
                    <div class="testimonial_item_3">
                      <i class="quote_icon flaticon-quotation-right-mark"></i>
                      <div class="hero_wrap">
                        <div class="hero_image">
                        <?php if (!empty($image)): ?>
                          <img src="<?php print esc_url($slide['image']['url']); ?>" alt="Model Image">
                          <?php endif; ?>

                        </div>
                        <div class="hero_content">
                          <?php if ($slide['client_name']): ?>
                          <h3 class="hero_name"><?php echo bdevs_element_kses_basic($slide['client_name']); ?></h3>
                          <?php endif; ?>
                          <?php if ($slide['designation_name']): ?>
                          <span class="hero_designation"><?php echo bdevs_element_kses_basic($slide['designation_name']); ?></span>
                          <?php endif; ?>
                          <ul class="reting_star ul_li">
                            <li class="active"><i class="flaticon-star"></i></li>
                            <li class="active"><i class="flaticon-star"></i></li>
                            <li class="active"><i class="flaticon-star"></i></li>
                            <li class="active"><i class="flaticon-star"></i></li>
                            <li class="active"><i class="flaticon-star"></i></li>
                          </ul>
                        </div>
                      </div>
                      <?php if ($slide['message']): ?>
                      <p>
                        <?php echo bdevs_element_kses_basic($slide['message']); ?>
                      </p>
                      <?php endif; ?>
                    </div>
                  </div>
                  <?php endforeach ?>
                </div>
              </div>

            </div>
        </section>

    <?php elseif ($settings['design_style'] == 'style_2'): 
        $this->add_inline_editing_attributes( 'title', 'basic' );
        $this->add_render_attribute( 'title', 'class', 'title_text bdevs-el-title' );
        
    ?>

        <section class="testimonial_section pt-135 pb-90 decoration_wrap">
            <div class="half_bg_top" data-bg-color="#F5F7F8"></div>
            <div class="container">

              <div class="row justify-content-center">
                <div class="col col-lg-6">
                  <div class="section_title text-center">
                    <?php if ($settings['sub_title']) : ?>
                    <h2 class="sub_title bdevs-el-subtitle" data-text-color="#74C138">
                      <?php echo bdevs_element_kses_intermediate($settings['sub_title']); ?>
                      <span class="icon">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo/favourite_icon_3.png" alt="Logo Icon">
                      </span>
                    </h2>
                    <?php endif; ?>
                    <?php
                        if ( $settings['title' ] ) :
                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['title_tag'] ),
                                $this->get_render_attribute_string( 'title' ),
                                 $settings['title' ]
                                );
                         endif;
                    ?>
                  </div>
                </div>
              </div>
              <div class="testimonial_carousel_2 carousel_style_2">
                <div class="row common_carousel_2col" data-slick='{"arrows": false}'>
                 <?php foreach ($settings['slides'] as $slide) :
                    if (!empty($slide['image']['id'])) {
                        $image = wp_get_attachment_image_url($slide['image']['id'], $settings['thumbnail_size']);
                    }
                  ?>
                  <div class="col carousel_item">
                    <div class="testimonial_item_2" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/shapes/shape_4.png');">
                      <div class="quote_icon text-end">
                        <span>
                          <i class="flaticon-quotation-right-mark"></i>
                        </span>
                      </div>
                      <div class="content_wrap">
                        <?php if ($slide['client_name']): ?>
                        <h3 class="hero_name"><?php echo bdevs_element_kses_basic($slide['client_name']); ?></h3>
                        <?php endif; ?>
                        <?php if ($slide['designation_name']): ?>
                        <span class="hero_designation"><?php echo bdevs_element_kses_basic($slide['designation_name']); ?></span>
                        <?php endif; ?>
                        <?php if ($slide['message']): ?>
                        <p>
                          <?php echo bdevs_element_kses_basic($slide['message']); ?>
                        </p>
                        <?php endif; ?>
                        <ul class="reting_star ul_li">
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                          <li class="active"><i class="flaticon-star"></i></li>
                        </ul>
                      </div>
                      <div class="thumbnail_wrap">
                        <?php if (!empty($image)): ?>
                        <img src="<?php print esc_url($slide['image']['url']); ?>" alt="Avatar Image">
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                  <?php endforeach; ?>
                </div>
              </div>

            </div>
        </section>

        <?php else:

        $this->add_inline_editing_attributes( 'title', 'basic' );
        $this->add_render_attribute( 'title', 'class', 'bdevs-el-title title_text mb-0 text-white' );  

        ?>

        <section class="testimonial_section pt-115 pb-115 decoration_wrap" data-bg-color="#000323"
            style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/backgrounds/pattern.png');">
            <div class="overlay" data-bg-color="#000323"></div>
            <div class="container">

              <div class="row justify-content-center">
                <div class="col col-lg-8">
                  <div class="section_title text-center">
                    <?php if ($settings['sub_title']) : ?>
                    <h2 class="sub_title bdevs-el-subtitle"><?php echo bdevs_element_kses_intermediate($settings['sub_title']); ?></h2>
                    <?php endif; ?>

                <?php
                    if ( $settings['title' ] ) :
                        printf( '<%1$s %2$s>%3$s</%1$s>',
                            tag_escape( $settings['title_tag'] ),
                            $this->get_render_attribute_string( 'title' ),
                             $settings['title' ]
                            );
                     endif;
                    ?>
                  </div>
                </div>
              </div>

              <div class="testimonial_carousel_1 arrow_right_left">
                <div class="row justify-content-center">
                  <div class="col col-lg-8">
                    <div class="testimonial_carousel row" data-slick='{"dots": false}'>
                        <?php foreach ($settings['slides'] as $slide) :
                                if (!empty($slide['image']['id'])) {
                                    $image = wp_get_attachment_image_url($slide['image']['id'], $settings['thumbnail_size']);
                                }
                        ?>
                        <div class="col carousel_item">
                        <div class="testimonial_item text-center">
                          <div class="testimonial_thumbnail">
                            <?php if (!empty($image)): ?>
                            <img src="<?php print esc_url($slide['image']['url']); ?>" alt="Person Image">
                            <?php endif; ?>
                             <div class="testimonial_quote_item">
                                 <span><i class="fas fa-quote-right"></i></span>
                             </div>
                          </div>
                          <?php if ($slide['message']): ?>
                          <p>
                            <?php echo bdevs_element_kses_basic($slide['message']); ?>
                          </p>
                          <?php endif; ?>
                          <?php if ($slide['client_name']): ?>
                          <h4 class="hero_name text-white"><?php echo bdevs_element_kses_basic($slide['client_name']); ?></h4>
                          <?php endif; ?>
                          <?php if ($slide['designation_name']): ?>
                          <h5 class="hero_title text-white"><?php echo bdevs_element_kses_basic($slide['designation_name']); ?></h5>
                          <?php endif; ?>
                          <ul class="reting_star ul_li_center">
                            <li class="active"><i class="flaticon-star"></i></li>
                            <li class="active"><i class="flaticon-star"></i></li>
                            <li class="active"><i class="flaticon-star"></i></li>
                            <li class="active"><i class="flaticon-star"></i></li>
                            <li class="active"><i class="flaticon-star"></i></li>
                          </ul>
                        </div>
                      </div>
                     <?php endforeach; ?>
                    </div>
                  </div>
                </div>
                <div class="carousel_arrow">
                  <button type="button" class="tc_left_arrow"><i class="fal fa-angle-left"></i></button>
                  <button type="button" class="tc_right_arrow"><i class="fal fa-angle-right"></i></button>
                </div>
              </div>

            </div>
        </section>

    <?php endif; ?>
        <?php
    }
}
