<?php

namespace Generic\Elements;

defined('ABSPATH') || die();

class GenericSidebarToggle extends GenericWidget
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
        return 'generic-sidebar-toggle';
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
        return esc_html__('Generic Sidebar Toggle', 'generic-elements');
    }

    public function get_custom_help_url()
    {
        return 'http://elementor.bdevs.net/bdevselement/generic-sidebar-toggle/';
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
        return 'eicon-site-logo gen-icon';
    }

    public function get_keywords()
    {
        return ['Generic', 'logo', 'sidebar', 'toggle', 'sidebar-toggle', 'logo', 'header', 'navigation', 'nav'];
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
        $this->side_info_content_controls();
        $this->social_profile_content_controls();
        $this->side_info_toggle_settings();
    }

    // side_info_content_controls
    protected function side_info_content_controls()
    {
        // Title & Description
        $this->start_controls_section(
            '_section_sideinfo_content',
            [
                'label' => esc_html__('Contact Info', 'generic-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_hide_contact_info',
            [
                'label' => esc_html__('Contact Info Show/Hide', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'generic-elements'),
                'label_off' => esc_html__('Hide', 'generic-elements'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'media_type',
            [
                'label'          => esc_html__('Media Type', 'generic-elements'),
                'type'           => \Elementor\Controls_Manager::CHOOSE,
                'label_block'    => false,
                'options'        => [
                    'icon'  => [
                        'title' => esc_html__('Icon', 'generic-elements'),
                        'icon'  => 'far fa-grin-wink',
                    ],
                    'image' => [
                        'title' => esc_html__('Image', 'generic-elements'),
                        'icon'  => 'eicon-image',
                    ],
                ],
                'default'        => 'icon',
                'toggle'         => false,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'image',
            [
                'label'     => esc_html__('Image', 'generic-elements'),
                'type'      => \Elementor\Controls_Manager::MEDIA,
                'default'   => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'media_type' => 'image'
                ],
                'dynamic'   => [
                    'active' => true,
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name'      => 'thumbnail',
                'default'   => 'medium_large',
                'separator' => 'none',
                'exclude'   => [
                    'full',
                    'custom',
                    'large',
                    'shop_catalog',
                    'shop_single',
                    'shop_thumbnail'
                ],
                'condition' => [
                    'media_type' => 'image'
                ]
            ]
        );

        $this->add_control(
            'icons',
            [
                'label'      => esc_html__('Icons', 'generic-elements'),
                'type'       => \Elementor\Controls_Manager::ICONS,
                'show_label' => true,
                'default'    => [
                    'value'   => 'far fa-grin-wink',
                    'library' => 'solid',
                ],
                'condition'  => [
                    'media_type' => 'icon',
                ],

            ]
        );

        $this->add_control(
            'contact_info_title',
            [
                'label' => esc_html__('Contact Info Title', 'generic-elements'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 4,
                'default' => 'Contact Info',
                'placeholder' => esc_html__('Type Contact Info title', 'generic-elements'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'instagram_shortcode',
            [
                'label'       => esc_html__('Instagram Shortcode', 'generic-elements'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => esc_html__('', 'generic-elements'),
                'placeholder' => esc_html__('Place here instagram shortcode', 'generic-elements'),
                'rows'        => 5,
                'dynamic'     => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'sidebar_map_url',
            [
                'label' => esc_html__('Map URL', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('#', 'generic-elements'),
                'placeholder' => esc_html__('Set Map URL', 'generic-elements'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-circle',
                    'library' => 'fa-solid',
                ],
                'recommended' => [
                    'fa-solid' => [
                        'circle',
                        'dot-circle',
                        'square-full',
                    ],
                    'fa-regular' => [
                        'circle',
                        'dot-circle',
                        'square-full',
                    ],
                ],
            ]
        );

        $repeater->add_control(
            'title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label' => esc_html__('Title', 'generic-elements'),
                'placeholder' => esc_html__('Type title here', 'generic-elements'),
                'default' => esc_html__('12/A, City Tower, NYC', 'generic-elements'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'slide_url',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => false,
                'placeholder' => esc_html__('Type link here', 'generic-elements'),
                'default' => esc_html__('#', 'generic-elements'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Image(not use)', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'type' => 'image'
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
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(title || "Carousel Item"); #>',
                'default' => [
                    [
                        'image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                ]
            ]
        );


        $this->end_controls_section();
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

        $this->add_control(
            'show_hide_sideinfo_social',
            [
                'label' => esc_html__('Social List Show/Hide', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'generic-elements'),
                'label_off' => esc_html__('Hide', 'generic-elements'),
                'return_value' => 'yes',
                'default' => 'yes',
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
            'social_icon_color',
            [
                'label' => esc_html__('Social Icon Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-contact-info-social > {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
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
                    '{{WRAPPER}} .generic-el-contact-info-social > {{CURRENT_ITEM}}' => 'border-color: {{VALUE}}',
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
                    '{{WRAPPER}} .generic-el-contact-info-social > {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}',
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
                    '{{WRAPPER}} .generic-el-contact-info-social > {{CURRENT_ITEM}}:hover, {{WRAPPER}} .generic-el-contact-info-social > {{CURRENT_ITEM}}:focus' => 'color: {{VALUE}}',
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
                    '{{WRAPPER}} .generic-el-contact-info-social > {{CURRENT_ITEM}}:hover, {{WRAPPER}} .generic-el-contact-info-social > {{CURRENT_ITEM}}:focus' => 'background-color: {{VALUE}}',
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
                    '{{WRAPPER}} .generic-el-contact-info-social > {{CURRENT_ITEM}}:hover, {{WRAPPER}} .generic-el-contact-info-social > {{CURRENT_ITEM}}:focus' => 'border-color: {{VALUE}}',
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
            'social-align',
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
                    '{{WRAPPER}} .generic-el-contact-info-social' => 'text-align: {{VALUE}};',
                ],
                'frontend_available' => true,
                'toggle' => true,
            ]
        );

        $this->end_controls_section();
    }


    // side_info_toggle_settings
    protected function side_info_toggle_settings()
    {
        $this->start_controls_section(
            '_section_side_info_settings',
            [
                'label' => esc_html__('Settings', 'generic-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'toggle-align',
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
                    '{{WRAPPER}} .generic-el-sidebar-toggle' => 'text-align: {{VALUE}};',
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
        $this->menu_side_toggle_style_control();
        $this->humburger_menu_style_controls();
        $this->sidebar_search_style_controls();
        $this->sidebar_instagram_style_controls();
        $this->sidebar_map_style_controls();
        $this->social_icon_style_controls();
    }

    // menu_side_toggle_style_control
    protected function menu_side_toggle_style_control()
    {
        $this->start_controls_section(
            'menu_side_toggle_style',
            [
                'label' => esc_html__('Side Toggle Style', 'generic-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'sidebar-toggle',
                'selector' => '{{WRAPPER}} div.generic-el-sidebar-toggle i',
            ]
        );


        $this->start_controls_tabs('_tabs_side_toggle_color');

        $this->start_controls_tab(
            '_tab_side_toggle_color',
            [
                'label' => esc_html__('Normal', 'generic-elements'),
            ]
        );

        $this->add_control(
            'side_toogle_color',
            [
                'label' => esc_html__('Side Toggle Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} div.generic-el-sidebar-toggle i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'side-toggle-icon-background',
                'label' => esc_html__('Background', 'generic-elements'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} div.generic-el-sidebar-toggle i, .generic-el-sidebar-icon .side-toggle img',
            ]
        );

        $this->add_responsive_control(
            'generic_el_side_toggle_padding',
            [
                'label' => esc_html__('Padding', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} div.generic-el-sidebar-toggle .side-toggle i, .generic-el-sidebar-icon .side-toggle img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'sideinfo-toggle-border',
                'label' => esc_html__('Border', 'generic-elements'),
                'selector' => '{{WRAPPER}} div.generic-el-sidebar-toggle i, .generic-el-sidebar-icon .side-toggle img',
            ]
        );

        $this->add_responsive_control(
            'sideinfo-toggle-border_radius',
            [
                'label' => esc_html__('Border Radius', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} div.generic-el-sidebar-toggle i, .generic-el-sidebar-icon .side-toggle img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_team_name_hover_color',
            [
                'label' => esc_html__('Hover', 'generic-elements'),
            ]
        );

        $this->add_control(
            'side_toogle_hover_color',
            [
                'label' => esc_html__('Side Toggle Hover Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} div.generic-el-sidebar-toggle button:hover i, {{WRAPPER}} div.generic-el-sidebar-toggle button:focus i, .generic-el-sidebar-icon .side-toggle img' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'side-toggle-icon-hover-background',
                'label' => esc_html__('Background', 'generic-elements'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} div.generic-el-sidebar-toggle i:hover, .generic-el-sidebar-icon .side-toggle img:hover',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    // humburger_menu_style_controls
    protected function humburger_menu_style_controls()
    {
        $this->start_controls_section(
            'humburger_menu_style_tab',
            [
                'label' => esc_html__('Humberger Menu Style', 'generic-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'humburger_content_padding',
            [
                'label' => esc_html__('Content Padding', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} div.side-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'generic_humburger_width',
            [
                'label' => esc_html__('Humburger width', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'selectors' => [
                    '{{WRAPPER}} div.side-info' => 'width: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'humburger-background',
                'label' => esc_html__('Background', 'generic-elements'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} div.side-info',
            ],
        );

        $this->add_control(
            'humburger_close_icon_color',
            [
                'label' => esc_html__('Close Icon Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} div.side-info .side-info-close' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'humburger_menu_color',
            [
                'label' => esc_html__('Menu Color Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mean-container .mean-nav ul li a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'humburger_border_color',
            [
                'label' => esc_html__('Border Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mean-container .mean-nav ul li a' => 'border-color: {{VALUE}};',
                ],
            ]
        );



        $this->start_controls_tabs('_tabs_menu_expand_color');

        $this->start_controls_tab(
            '_tab_menu_expand_color',
            [
                'label' => esc_html__('Normal', 'generic-elements'),
            ]
        );
        $this->add_control(
            'humburger_menu_expand_icon_color',
            [
                'label' => esc_html__('Menu Expand Icon Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mean-container .mean-nav ul li a.mean-expand' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'humburger_menu_expand_background_color',
            [
                'label' => esc_html__('Menu Expand Background Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mean-container .mean-nav ul li a.mean-expand' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_menu_expand_hover_color',
            [
                'label' => esc_html__('Hover', 'generic-elements'),
            ]
        );


        $this->add_control(
            'humburger_menu_expand_hover_icon_color',
            [
                'label' => esc_html__('Menu Expand Icon Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} div.mean-container .mean-nav ul li a.mean-expand:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'humburger_menu_expand_hover_background_color',
            [
                'label' => esc_html__('Menu Expand Background Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mean-container .mean-nav ul li a.mean-expand:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_tab();
        $this->end_controls_tabs();


        $this->end_controls_section();
    }

    // sidebar_search_style_controls
    protected function sidebar_search_style_controls()
    {
        $this->start_controls_section(
            '_section_sideinfo_search_style_section',
            [
                'label' => esc_html__('SideInfo Search', 'generic-elements'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'sideinfo_search_content_padding',
            [
                'label' => esc_html__('Content Padding', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-side-info-search' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'search_bottom_spacing',
            [
                'label' => esc_html__('Bottom Spacing', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-side-info-search' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }


    // sidebar_instagram_style_controls
    protected function sidebar_instagram_style_controls()
    {
        $this->start_controls_section(
            '_section_sideinfo_instagram_style_section',
            [
                'label' => esc_html__('SideInfo Instagram', 'generic-elements'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'sideinfo_instagram_content_padding',
            [
                'label' => esc_html__('Content Padding', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-sideinfo-instagram-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'instagram_bottom_spacing',
            [
                'label' => esc_html__('Bottom Spacing', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-sideinfo-instagram-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    // sidebar_map_style_controls
    protected function sidebar_map_style_controls()
    {
        $this->start_controls_section(
            '_section_sideinfo_map_style_section',
            [
                'label' => esc_html__('SideInfo Map', 'generic-elements'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'sideinfo_map_content_padding',
            [
                'label' => esc_html__('Content Padding', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-sideinfo-map-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'map_bottom_spacing',
            [
                'label' => esc_html__('Bottom Spacing', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-sideinfo-map-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'generic_el_sideinfo_map_width',
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
                    '{{WRAPPER}} .generic-el-sideinfo-map-wrapper' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'generic_el_sideinfo_map_height',
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
                    '{{WRAPPER}} .generic-el-sideinfo-map-wrapper' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
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
            'social_content_padding',
            [
                'label' => esc_html__('Content Padding', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-contact-info-social' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
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
                    '{{WRAPPER}} .generic-el-contact-info-social a' => 'width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .generic-el-contact-info-social a' => 'height: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .generic-el-contact-info-social a' => 'line-height: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .generic-el-contact-info-social a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'normal-icon-border',
                'selector' => '{{WRAPPER}} .generic-el-contact-info-social a',
            ]
        );

        $this->add_control(
            'social_icon_border_radius',
            [
                'label' => esc_html__('Border Radius', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-contact-info-social a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'social-icon',
                'selector' => '{{WRAPPER}} .generic-el-contact-info-social a i',
            ]
        );

        $this->end_controls_section();
    }



    // Render Function
    protected function render()
    {
        $settings = $this->get_settings_for_display();

?>
        <div class="generic-el-sidebar-toggle">
            <div class="generic-el-sidebar-icon">
                <button class="side-toggle">
                    <?php if (!empty($settings['icons']['value'])) : ?>
                        <?php \Elementor\Icons_Manager::render_icon($settings['icons'], ['aria-hidden' => 'true']); ?>
                    <?php elseif ($settings['image']['url'] || $settings['image']['id']) : ?>
                        <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'image'); ?>
                    <?php endif; ?>
                </button>
            </div>
        </div>

        <!-- mobile menu info -->
        <div class="fix">
            <div class="side-info">
                <button class="side-info-close"><i class="fal fa-times"></i></button>
                <!-- Mobile Menu Call  -->
                <div class="generic-mobile-menu fix"></div>

                <?php if (!empty($settings['show_hide_contact_info'])) : ?>
                    <div class="generic-el-side-info-content">
                        <!-- Sideinfo Search  -->
                        <div class="generic-el-side-info-search">
                            <form action="<?php print esc_url(home_url('/')); ?>" method="get">
                                <input type="text" name="s" value="<?php print esc_attr(get_search_query()) ?>" placeholder="<?php print esc_attr__('Search...', 'generic-elements'); ?>">
                                <button type="submit"><i class="far fa-search"></i></button>
                            </form>
                        </div>

                        <!-- sideinfo instagram  -->
                        <?php if (!empty($settings['instagram_shortcode'])) : ?>
                            <!-- sideinfo instagram  -->
                            <div class="generic-el-sideinfo-instagram-wrap">
                                <div class="generic-el-sideinfo-instagram">
                                    <h5><?php echo wp_kses_post($settings['instagram_shortcode']); ?></h5>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($settings['sidebar_map_url'])) : ?>
                            <!-- Sideinfo Map  -->
                            <div class="generic-el-sideinfo-map-wrapper">
                                <iframe src="<?php echo esc_url($settings['sidebar_map_url']); ?>" width="600" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        <?php endif; ?>

                        <!-- sideinfo contact List -->
                        <div class="generic-el-side-info-contact-wrapper">
                            <?php if (!empty($settings['contact_info_title'])) : ?>
                                <h4 class="side-info-contact-title"><?php echo wp_kses_post($settings['contact_info_title']); ?> </h4>
                            <?php endif; ?>
                            <ul>
                                <?php foreach ($settings['slides'] as $slide) : ?>
                                    <li class="d-flex align-items-center elementor-repeater-item-<?php echo esc_attr($slide['_id']); ?>">
                                        <div class="generic-el-side-info-contact-icon">
                                            <?php \Elementor\Icons_Manager::render_icon($slide['icon'], ['aria-hidden' => 'true']); ?>
                                        </div>
                                        <?php if (!empty($slide['title'])) : ?>
                                            <div class="generic-el-side-info-contact-text">
                                                <a href="<?php echo esc_url($slide['slide_url']); ?>"><?php echo wp_kses_post($slide['title']); ?></a>
                                            </div>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <?php if (!empty($settings['show_hide_sideinfo_social'])) : ?>
                            <!-- Sideinfo Social  -->
                            <div class="generic-el-contact-info-social">
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
                        <?php endif; ?>

                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- For Mobile offcanvas overlay  -->
        <div class="offcanvas-overlay"></div>
<?php
    }
}
