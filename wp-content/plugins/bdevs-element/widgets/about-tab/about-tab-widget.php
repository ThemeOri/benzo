<?php

namespace BdevsElement\Widget;

use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use BdevsElementor\Controls\Select2;

defined('ABSPATH') || die();

class About_Tab extends BDevs_El_Widget
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
        return 'about-tab';
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
        return __('About Tab', 'bdevs-element');
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
        return 'eicon-tabs';
    }

    public function get_keywords()
    {
        return ['tabs', 'section', 'advanced', 'toggle', 'price'];
    }

    protected function register_content_controls()
    {
       $this->start_controls_section(
            '_section_title_desc',
            [
                'label' => __('Title & Description', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_3']
                ]
            ]
        );
       $this->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Title', 'bdevs-element'),
                'default' => __('Tab Title', 'bdevs-element'),
                'placeholder' => __('Type Tab Title', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
       $this->add_control(
            'subtitle',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Subtitle', 'bdevs-element'),
                'default' => __('Tab Subtitle', 'bdevs-element'),
                'placeholder' => __('Type Tab Subtitle', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
       $this->end_controls_section();
        $this->start_controls_section(
            '_section_price_tabs',
            [
                'label' => __('Price Tabs', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Title', 'bdevs-element'),
                'default' => __('Tab Title', 'bdevs-element'),
                'placeholder' => __('Type Tab Title', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $repeater->add_control(
            'type',
            [
                'label' => __( 'Media Type', 'bdevs-element' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'icon' => [
                        'title' => __( 'Icon', 'bdevs-element' ),
                        'icon' => 'fa fa-smile-o',
                    ],
                    'image' => [
                        'title' => __( 'Image', 'bdevs-element' ),
                        'icon' => 'fa fa-image',
                    ],
                ],
                'default' => 'icon',
                'toggle' => false,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => __( 'Image', 'bdevs-element' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'type' => 'image'
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'medium_large',
                'separator' => 'none',
                'exclude' => [
                    'full',
                    'custom',
                    'large',
                    'shop_catalog',
                    'shop_single',
                    'shop_thumbnail'
                ],
                'condition' => [
                    'type' => 'image'
                ]
            ]
        );

        if ( bdevs_element_is_elementor_version( '<', '2.6.0' ) ) {
            $repeater->add_control(
                'icon',
                [
                    'label' => __( 'Icon', 'bdevs-element' ),
                    'label_block' => true,
                    'type' => Controls_Manager::ICON,
                    'options' => bdevs_element_get_bdevs_element_icons(),
                    'default' => 'fa fa-smile-o',
                    'condition' => [
                        'type' => 'icon'
                    ]
                ]
            );
        } 
        else {
            $repeater->add_control(
                'selected_icon',
                [
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fas fa-smile-wink',
                        'library' => 'fa-solid',
                    ],
                    'condition' => [
                        'type' => 'icon'
                    ]
                ]
            );
        }
        $repeater->add_control(
            'template',
            [
                'label' => __('Section Template', 'bdevs-element'),
                'placeholder' => __('Select a section template for as tab content', 'bdevs-element'),
                'description' => sprintf(__('Wondering what is section template or need to create one? Please click %1$shere%2$s ', 'bdevs-element'),
                    '<a target="_blank" href="' . esc_url(admin_url('/edit.php?post_type=elementor_library&tabs_group=library&elementor_library_type=section')) . '">',
                    '</a>'
                ),
                'type' => Controls_Manager::SELECT2,
                'options' => get_elementor_templates()
            ]
        );

        $this->add_control(
            'tabs',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{title}}',
                'default' => [
                    [
                        'title' => 'Tab 1',
                    ],
                    [
                        'title' => 'Tab 2',
                    ]
                ]
            ]
        );

        $this->end_controls_section();


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
                    'style_1' => __('Style 1', 'bdevs-element'),
                    'style_2' => __('Style 2', 'bdevs-element'),
                    'style_3' => __('Style 3', 'bdevs-element'),
                    'style_4' => __('Style 4', 'bdevs-element'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'filter_pos',
            [
                'label' => __('Filter Position', 'bdevs-element'),
                'label_block' => false,
                'type' => Controls_Manager::CHOOSE,
                'default' => 'top',
                'options' => [
                    'left' => [
                        'title' => __('Left', 'bdevs-element'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'top' => [
                        'title' => __('Top', 'bdevs-element'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'right' => [
                        'title' => __('Right', 'bdevs-element'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'filter_align',
            [
                'label' => __('Filter Align', 'bdevs-element'),
                'label_block' => false,
                'type' => Controls_Manager::CHOOSE,
                'default' => 'left',
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
                'condition' => [
                    'filter_pos' => 'top',
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-filter' => 'text-align: {{VALUE}};',
                ],
                'style_transfer' => true,
            ]
        );


        $this->add_responsive_control(
            'event',
            [
                'label' => __('Tab action', 'bdevs-element'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'click' => __('On Click', 'bdevs-element'),
                    'hover' => __('On Hover', 'bdevs-element'),
                ],
                'default' => 'click',
                'render_type' => 'template',
                'style_transfer' => true,
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
        if (!$settings['tabs'])
            return;


        $event = 'click';
        if ('hover' === $settings['event']) {
            $event = 'hover touchstart';
        }

        $wrapper_class = [
            'price__area pricing-' . $settings['filter_pos'],
        ];
        $this->add_render_attribute('wrapper', 'class', $wrapper_class);
        $this->add_render_attribute('wrapper', 'data-event', $event);
        $this->add_render_attribute('project-filter', 'class', ['nav nav-tabs justify-content-center']);
        $this->add_render_attribute('project-body', 'class', ['tab-content']);
        if($settings['design_style'] === 'style_1') :
            $i = 1;
            if (!empty($settings['tabs'])) :?>
             <!-- Service Tab Section - Start
            ================================================== -->
              <section class="service_tab_section">
                <div class="service_tab_nav">
                  <div class="container">
                    <ul class="ul_li_center nav" role="tablist">
                    <?php foreach ($settings['tabs'] as $key => $tab):
                        if ($key == 0) {
                            $tab['active_tab'] = 'yes';
                        } else {
                            $tab['active_tab'] = 'no';
                        }
                        if (!empty($tab['template'])):
                            $tab_title = str_replace(' ', '_', $tab['title']);
                    ?>
                      <li>
                        <button class="<?php echo ($tab['active_tab'] == 'yes') ? 'active' : ''; ?>" data-bs-toggle="tab" data-bs-target="#advance_<?php echo $tab_title; ?>_tab" type="button"
                          role="tab" aria-selected="true">
                          <?php if( !empty($tab['selected_icon']) ): ?>
                                <?php bdevs_element_render_icon( $tab, 'icon', 'selected_icon', ['class' => 'bdevs-btn-icon'] ); ?>
                                <?php else: ?>
                                    <img src="<?php echo esc_url($image); ?>" alt="icon" />
                            <?php endif; ?>
                          <span><?php echo bdevs_element_kses_basic($tab['title']); ?></span>
                        </button>
                      </li>
                      <?php endif; endforeach; ?>
                    </ul>
                  </div>
                </div>
                <div class="container">
                  <div class="tab-content">
                    <?php foreach ($settings['tabs'] as $key => $tab):
                        if ($key == 0) {
                            $tab['active_tab'] = 'yes';
                        } else {
                            $tab['active_tab'] = 'no';
                        }
                        if (!empty($tab['template'])):
                            $tab_title = str_replace(' ', '_', $tab['title']);
                    ?>
                    <div class="tab-pane fade <?php echo ($tab['active_tab'] == 'yes') ? 'show active' : ''; ?>" id="advance_<?php echo $tab_title; ?>_tab" role="tabpanel">
                      <?php echo \BdevsElement::$elementor_instance->frontend->get_builder_content($tab['template'], true); ?>
                    </div>
                    <?php endif; endforeach; ?>
                  </div>
                </div>
              </section>
              <!-- Service Tab Section - End
                ================================================== -->

            <?php else:
                printf('%1$s',
                    __('No  List  Found', 'bdevs-element')
                );
            endif;
            elseif($settings['design_style'] === 'style_3') :
            $i = 1;
            if (!empty($settings['tabs'])) :
        ?>
        <!-- Service Section - Start
        ================================================== -->
        <div class="service_tab_section_2 pt-115 pb-0 decoration_wrap">
            <div class="half_bg_top" data-bg-color="#000323"></div>
            <div class="container">
              <div class="row justify-content-center">
                <div class="col col-lg-6">
                  <div class="section_title text-center">
                    <?php if(!empty($settings['subtitle'])) : ?>
                    <h2 class="sub_title bdevs-el-subtitle">
                        <?php echo bdevs_element_kses_intermediate($settings['subtitle']); ?>
                    </h3>
                    <?php endif; ?>
                     <?php if(!empty($settings['title'])) : ?>
                    <h3 class="title_text mb-0 text-white bdevs-el-title">
                        <?php echo bdevs_element_kses_intermediate($settings['title']); ?>
                    </h3>
                    <?php endif; ?>
                  </div>
                </div>
              </div>

              <ul class="tabs_nav style_4 nav ul_li_center" role="tablist">
                <?php foreach ($settings['tabs'] as $key => $tab):
                    if ($key == 0) {
                        $tab['active_tab'] = 'yes';
                    } else {
                        $tab['active_tab'] = 'no';
                    }
                    if (!empty($tab['template'])):
                        $tab_title = str_replace(' ', '_', $tab['title']);
                ?>
                <li>
                  <button class="<?php echo ($tab['active_tab'] == 'yes') ? 'active' : ''; ?>" data-bs-toggle="tab" data-bs-target="#tab_<?php echo $tab_title; ?>" type="button" role="tab"
                    aria-selected="false"><?php echo bdevs_element_kses_basic($tab['title']); ?></button>
                </li>
                <?php endif; endforeach; ?>
              </ul>

              <div class="tab-content">
                <?php foreach ($settings['tabs'] as $key => $tab):
                    if ($key == 0) {
                        $tab['active_tab'] = 'yes';
                    } else {
                        $tab['active_tab'] = 'no';
                    }
                    if (!empty($tab['template'])):
                        $tab_title = str_replace(' ', '_', $tab['title']);
                ?>
                <div class="tab-pane fade <?php echo ($tab['active_tab'] == 'yes') ? 'show active' : ''; ?>" id="tab_<?php echo $tab_title; ?>" role="tabpanel">
                  <?php echo \BdevsElement::$elementor_instance->frontend->get_builder_content($tab['template'], true); ?>
                </div>
                <?php endif; endforeach; ?>
              </div>
            </div>
        </div>
        <!-- Service Section - End
        ================================================== -->
        <?php else:
                printf('%1$s',
                    __('No  List  Found', 'bdevs-element')
                );
            endif; 
        elseif($settings['design_style'] === 'style_4') :
            $i = 1;
            if (!empty($settings['tabs'])) :
        ?>
        <div class="details_info_tab">
          <ul class="nav" role="tablist">
            <?php foreach ($settings['tabs'] as $key => $tab):
                if ($key == 0) {
                    $tab['active_tab'] = 'yes';
                } else {
                    $tab['active_tab'] = 'no';
                }
                if (!empty($tab['template'])):
                    $tab_title = str_replace(' ', '_', $tab['title']);
            ?>
            <li>
              <button class="border-bottom-0 <?php echo ($tab['active_tab'] == 'yes') ? 'active' : ''; ?>" data-bs-toggle="tab" data-bs-target="#tab_<?php echo $tab_title; ?>"
                type="button" role="tab" aria-selected="true">
                <?php echo bdevs_element_kses_basic($tab['title']); ?>
              </button>
            </li>
            <?php endif; endforeach; ?>
          </ul>
          <div class="tab-content">
            <?php foreach ($settings['tabs'] as $key => $tab):
                if ($key == 0) {
                    $tab['active_tab'] = 'yes';
                } else {
                    $tab['active_tab'] = 'no';
                }
                if (!empty($tab['template'])):
                    $tab_title = str_replace(' ', '_', $tab['title']);
            ?>
            <div class="tab-pane fade <?php echo ($tab['active_tab'] == 'yes') ? 'show active' : ''; ?>" id="tab_<?php echo $tab_title; ?>" role="tabpanel">
              <?php echo \BdevsElement::$elementor_instance->frontend->get_builder_content($tab['template'], true); ?>
            </div>
            <?php endif; endforeach; ?>
          </div>
        </div>
        <?php else:
                printf('%1$s',
                    __('No  List  Found', 'bdevs-element')
                );
            endif; 
        elseif($settings['design_style'] === 'style_2') :
            $i = 1;
            if (!empty($settings['tabs'])) :
        ?>

        <!-- Service Tab Section 2 - Start
        ================================================== -->
          <div class="service_tab_section_2 bg_gray">
            <div class="container">
              <ul class="tabs_nav style_2 nav" role="tablist">
                <?php foreach ($settings['tabs'] as $key => $tab):
                    if ($key == 0) {
                        $tab['active_tab'] = 'yes';
                    } else {
                        $tab['active_tab'] = 'no';
                    }
                    if (!empty($tab['template'])):
                        $tab_title = str_replace(' ', '_', $tab['title']);
                ?>
                <li>
                  <button class="<?php echo ($tab['active_tab'] == 'yes') ? 'active' : ''; ?>" data-bs-toggle="tab" data-bs-target="#tab_<?php echo $tab_title; ?>_flash" type="button" role="tab"
                    aria-selected="true"><?php echo bdevs_element_kses_basic($tab['title']); ?></button>
                </li>
                <?php endif; endforeach; ?>
              </ul>
              <div class="tab-content">
                <?php foreach ($settings['tabs'] as $key => $tab):
                    if ($key == 0) {
                        $tab['active_tab'] = 'yes';
                    } else {
                        $tab['active_tab'] = 'no';
                    }
                    if (!empty($tab['template'])):
                        $tab_title = str_replace(' ', '_', $tab['title']);
                ?>
                <div class="tab-pane fade <?php echo ($tab['active_tab'] == 'yes') ? 'show active' : ''; ?>" id="tab_<?php echo $tab_title; ?>_flash" role="tabpanel">
                  <?php echo \BdevsElement::$elementor_instance->frontend->get_builder_content($tab['template'], true); ?>
                </div>
                <?php endif; endforeach; ?>
              </div>
            </div>
          </div>
        <!-- Service Tab Section 2 - End
        ================================================== -->
        <?php else:
                printf('%1$s',
                    __('No  List  Found', 'bdevs-element')
                );
            endif; 
        endif;

    }
}