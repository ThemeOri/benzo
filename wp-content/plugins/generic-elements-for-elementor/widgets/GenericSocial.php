<?php

namespace Generic\Elements;

defined('ABSPATH') || die();

class GenericSocial extends GenericWidget
{

    /**
     * Get widget name.
     *
     * Retrieve Generic Elements widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */

    public function get_name()
    {
        return 'generic-social';
    }

    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */

    public function get_title()
    {
        return esc_html__('Generic Social', 'generic-elements');
    }

    public function get_custom_help_url()
    {
        return 'http://elementor.bdevs.net/bdevselement/generic-social/';
    }


    public function get_style_depends()
    {
        return ['bootstrap', 'fontawesome', 'generic-element-css'];
    }

    public function get_script_depends()
    {
        return ['bootstrap', 'generic-element-js'];
    }

    /**
     * Get widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-social-icons gen-icon';
    }

    public function get_keywords()
    {
        return ['Generic', 'elements', 'social', 'icon', 'logo', 'header', 'navigation', 'nav', 'footer'];
    }

    public function get_categories()
    {
        return ['generic-elements'];
    }


    // get_profile_names
    protected static function get_profile_names()
    {
        return [
            'fal fa-comments' => esc_html__('Comments', 'generic-elements'),
            'apple' => esc_html__('Apple', 'generic-elements'),
            'behance' => esc_html__('Behance', 'generic-elements'),
            'bitbucket' => esc_html__('BitBucket', 'generic-elements'),
            'codepen' => esc_html__('CodePen', 'generic-elements'),
            'delicious' => esc_html__('Delicious', 'generic-elements'),
            'deviantart' => esc_html__('DeviantArt', 'generic-elements'),
            'digg' => esc_html__('Digg', 'generic-elements'),
            'dribbble' => esc_html__('Dribbble', 'generic-elements'),
            'email' => esc_html__('Email', 'generic-elements'),
            'facebook' => esc_html__('Facebook', 'generic-elements'),
            'flickr' => esc_html__('Flicker', 'generic-elements'),
            'foursquare' => esc_html__('FourSquare', 'generic-elements'),
            'github' => esc_html__('Github', 'generic-elements'),
            'houzz' => esc_html__('Houzz', 'generic-elements'),
            'instagram' => esc_html__('Instagram', 'generic-elements'),
            'jsfiddle' => esc_html__('JS Fiddle', 'generic-elements'),
            'linkedin' => esc_html__('LinkedIn', 'generic-elements'),
            'medium' => esc_html__('Medium', 'generic-elements'),
            'pinterest' => esc_html__('Pinterest', 'generic-elements'),
            'product-hunt' => esc_html__('Product Hunt', 'generic-elements'),
            'reddit' => esc_html__('Reddit', 'generic-elements'),
            'slideshare' => esc_html__('Slide Share', 'generic-elements'),
            'snapchat' => esc_html__('Snapchat', 'generic-elements'),
            'soundcloud' => esc_html__('SoundCloud', 'generic-elements'),
            'spotify' => esc_html__('Spotify', 'generic-elements'),
            'stack-overflow' => esc_html__('StackOverflow', 'generic-elements'),
            'tripadvisor' => esc_html__('TripAdvisor', 'generic-elements'),
            'tumblr' => esc_html__('Tumblr', 'generic-elements'),
            'twitch' => esc_html__('Twitch', 'generic-elements'),
            'twitter' => esc_html__('Twitter', 'generic-elements'),
            'vimeo' => esc_html__('Vimeo', 'generic-elements'),
            'vk' => esc_html__('VK', 'generic-elements'),
            'website' => esc_html__('Website', 'generic-elements'),
            'whatsapp' => esc_html__('WhatsApp', 'generic-elements'),
            'wordpress' => esc_html__('WordPress', 'generic-elements'),
            'xing' => esc_html__('Xing', 'generic-elements'),
            'yelp' => esc_html__('Yelp', 'generic-elements'),
            'youtube' => esc_html__('YouTube', 'generic-elements'),
        ];
    }


    // register_content_controls
    protected function register_content_controls()
    {
        $this->social_profile_content_controls();
        //$this->social_icon_setting_content_controls();
    }

    // social_profile_content_controls
    protected function social_profile_content_controls()
    {
        $this->start_controls_section(
            '_section_social',
            [
                'label' => esc_html__('Social Profiles', 'generic-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'name',
            [
                'label' => esc_html__('Profile Name', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'select2options' => [
                    'allowClear' => false,
                ],
                'options' => self::get_profile_names()
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__('Profile Link', 'generic-elements'),
                'placeholder' => esc_html__('Add your profile link', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::URL,
                'label_block' => true,
                'autocomplete' => false,
                'show_external' => false,
                'condition' => [
                    'name!' => 'email'
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'email',
            [
                'label' => esc_html__('Email Address', 'generic-elements'),
                'placeholder' => esc_html__('Add your email address', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'input_type' => 'email',
                'condition' => [
                    'name' => 'email'
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'customize',
            [
                'label' => esc_html__('Want To Customize?', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'generic-elements'),
                'label_off' => esc_html__('No', 'generic-elements'),
                'return_value' => 'yes',
                'style_transfer' => true,
            ]
        );

        $repeater->start_controls_tabs(
            '_tab_icon_colors',
            [
                'condition' => ['customize' => 'yes']
            ]
        );

        $repeater->start_controls_tab(
            '_tab_icon_normal',
            [
                'label' => esc_html__('Normal', 'generic-elements'),
            ]
        );

        $repeater->add_control(
            'color',
            [
                'label' => esc_html__('Text Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-social-icon > {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
                ],
                'condition' => ['customize' => 'yes'],
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'border_color',
            [
                'label' => esc_html__('Border Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-social-icon > {{CURRENT_ITEM}}' => 'border-color: {{VALUE}}',
                ],
                'condition' => ['customize' => 'yes'],
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'bg_color',
            [
                'label' => esc_html__('Background Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-social-icon > {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}',
                ],
                'condition' => ['customize' => 'yes'],
                'style_transfer' => true,
            ]
        );

        $repeater->end_controls_tab();
        $repeater->start_controls_tab(
            '_tab_icon_hover',
            [
                'label' => esc_html__('Hover', 'generic-elements'),
            ]
        );

        $repeater->add_control(
            'hover_color',
            [
                'label' => esc_html__('Text Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-social-icon > {{CURRENT_ITEM}}:hover, {{WRAPPER}} .generic-el-social-icon > {{CURRENT_ITEM}}:focus' => 'color: {{VALUE}}',
                ],
                'condition' => ['customize' => 'yes'],
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'hover_bg_color',
            [
                'label' => esc_html__('Background Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-social-icon > {{CURRENT_ITEM}}:hover, {{WRAPPER}} .generic-el-social-icon > {{CURRENT_ITEM}}:focus' => 'background-color: {{VALUE}}',
                ],
                'condition' => ['customize' => 'yes'],
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'hover_border_color',
            [
                'label' => esc_html__('Border Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-social-icon > {{CURRENT_ITEM}}:hover, {{WRAPPER}} .generic-el-social-icon > {{CURRENT_ITEM}}:focus' => 'border-color: {{VALUE}}',
                ],
                'condition' => ['customize' => 'yes'],
                'style_transfer' => true,
            ]
        );

        $repeater->end_controls_tab();
        $repeater->end_controls_tabs();

        $this->add_control(
            'profiles',
            [
                'show_label' => false,
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(name.slice(0,1).toUpperCase() + name.slice(1)) #>',
                'default' => [
                    [
                        'link' => ['url' => 'https://facebook.com/'],
                        'name' => 'facebook'
                    ],
                    [
                        'link' => ['url' => 'https://twitter.com/'],
                        'name' => 'twitter'
                    ],
                    [
                        'link' => ['url' => 'https://linkedin.com/'],
                        'name' => 'linkedin'
                    ]
                ],
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => esc_html__('Alignment', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'generic-elements'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'generic-elements'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'generic-elements'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors'          => [
                    '{{WRAPPER}} .generic-el-social-icon' => 'text-align: {{VALUE}};',
                ],
                'frontend_available' => true,
                'toggle' => true,
            ]
        );

        $this->end_controls_section();
    }


    // register_style_controls
    protected function register_style_controls()
    {
        $this->social_icon_style_controls();
    }

    // social_icon_style_controls
    protected function social_icon_style_controls()
    {
        $this->start_controls_section(
            '_section_style_content',
            [
                'label' => esc_html__('Social Icon', 'generic-elements'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'generic_social_icon_width',
            [
                'label' => esc_html__('Width', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 700,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-social-icon a' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'generic_social_icon_height',
            [
                'label' => esc_html__('Height', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 700,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-social-icon a' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'generic_social_icon_line_height',
            [
                'label' => esc_html__('Line Height', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 700,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-social-icon a' => 'line-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'normal_icon_margin',
            [
                'label' => esc_html__('Social Icon Margin', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-social-icon a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'normal-icon-border',
                'selector' => '{{WRAPPER}} .generic-el-social-icon a',
            ]
        );

        $this->add_control(
            'social_icon_border_radius',
            [
                'label' => esc_html__('Border Radius', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-social-icon a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'social-icon',
                'selector' => '{{WRAPPER}} .generic-el-social-icon a i',
            ]
        );



        $this->start_controls_tabs('_tabs_name_color');

        $this->start_controls_tab(
            '_tab_social_name_color',
            [
                'label' => esc_html__('Normal', 'generic-elements'),
            ]
        );

        $this->add_control(
            'social_icon_color',
            [
                'label' => esc_html__('Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-social-icon a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'social-icon-background',
                'label' => esc_html__('Background', 'generic-elements'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .generic-el-social-icon a',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_social_name_hover_color',
            [
                'label' => esc_html__('Hover', 'generic-elements'),
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label' => esc_html__('Text Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-social-icon a:hover i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'social-icon-hover-background',
                'label' => esc_html__('Background', 'generic-elements'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .generic-el-social-icon a:hover',
            ]
        );


        $this->end_controls_tab();
        $this->end_controls_tabs();





        $this->end_controls_section();
    }


    // Render Function
    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>
        <div class="generic-el-social-icon">
            <?php
            foreach ($settings['profiles'] as $profile) :
                $icon = !empty($profile['name']) ? $profile['name'] : '';
                $url = !empty($profile['link']['url']) ? $profile['link']['url'] : '';

                if ($profile['name'] === 'website') {
                    $icon = 'globe';
                } elseif ($profile['name'] === 'email') {
                    $icon = 'envelope';
                    $url = 'mailto:' . antispambot($profile['email']);
                }

                printf(
                    '<a target="_blank" rel="noopener" data-tooltip="hello" href="%s" class="elementor-repeater-item-%s comments-btn"><i class="fab fa-%s" aria-hidden="true"></i></a>',
                    $url,
                    esc_attr($profile['_id']),
                    esc_attr($icon),
                    esc_attr($icon)
                );
            endforeach; ?>
        </div>
<?php
    }
}
