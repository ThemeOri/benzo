<?php
namespace BdevsElement\Widget;

use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Css_Filter;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Utils;
use \Elementor\Control_Media;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;

defined( 'ABSPATH' ) || die();

class Hero extends BDevs_El_Widget {

    
    /**
     * Get widget name.
     *
     * Retrieve Bdevs Element widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'hero';
    }

    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Hero', 'bdevs-element' );
    }

    public function get_custom_help_url() {
        return 'http://elementor.bdevs.net/bdevselement/hero/';
    }

    /**
     * Get widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-inner-section';
    }

    public function get_keywords() {
        return [ 'hero', 'blurb', 'infobox', 'content', 'block', 'box' ];
    }

    protected function register_content_controls() {
        $this->start_controls_section(
            '_section_design_title',
            [
                'label' => __( 'Design Style', 'bdevs-element' ),
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
                    'style_3' => __( 'Style 3', 'bdevs-element' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'shape_switch',
            [
                'label' => __('Shape Show/Hide', 'bdevs-element'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevs-element'),
                'label_off' => __('Hide', 'bdevs-element'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'design_style' => ['style_10'],
                ],
                'style_transfer' => true,
            ]
        );
        $this->end_controls_section();

        // Title & Description
        $this->start_controls_section (
            '_section_title',
            [
                'label' => __( 'Title & Description', 'bdevs-element' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => __( 'Sub Title', 'bdevs-element' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Sub Title', 'bdevs-element' ),
                'placeholder' => __( 'Sub Title Here', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_1','style_3'],
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __( 'Hero Title', 'bdevs-element' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Hero Title', 'bdevs-element' ),
                'placeholder' => __( 'Type Hero Title Here', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $this->add_control(
            'sm_title',
            [
                'label' => __( 'Hero SM Title', 'bdevs-element' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Hero SM Title', 'bdevs-element' ),
                'placeholder' => __( 'Type Hero SM Title Here', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => 'style_10',
                ],
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __( 'Description', 'bdevs-element' ),
                'description' => bdevs_element_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Hero description goes here', 'bdevs-element' ),
                'placeholder' => __( 'Enter Hero description', 'bdevs-element' ),
                'rows' => 5,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'placeholder_text',
            [
                'label' => __( 'Placeholder Text', 'bdevs-element' ),
                'description' => bdevs_element_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Placeholder text goes here', 'bdevs-element' ),
                'placeholder' => __( 'Enter placeholder text here', 'bdevs-element' ),
                'rows' => 5,
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => 'style_20',
                ],
            ]
        );

        $this->add_control(
            'form_description',
            [
                'label' => __( 'Form Description', 'bdevs-element' ),
                'description' => bdevs_element_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Hero form description goes here', 'bdevs-element' ),
                'placeholder' => __( 'Enter Hero Form Description', 'bdevs-element' ),
                'rows' => 5,
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => 'style_20',
                ],
            ]
        );

        $this->add_control(
            'quote_title',
            [
                'label' => __( 'Quote Title', 'bdevs-element' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Quote Title', 'bdevs-element' ),
                'placeholder' => __( 'Type Quote Title Here', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => 'style_1',
                ],
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => __( 'Title HTML Tag', 'bdevs-element' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1'  => [
                        'title' => __( 'H1', 'bdevs-element' ),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2'  => [
                        'title' => __( 'H2', 'bdevs-element' ),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3'  => [
                        'title' => __( 'H3', 'bdevs-element' ),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4'  => [
                        'title' => __( 'H4', 'bdevs-element' ),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5'  => [
                        'title' => __( 'H5', 'bdevs-element' ),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6'  => [
                        'title' => __( 'H6', 'bdevs-element' ),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h1',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __( 'Alignment', 'bdevs-element' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'bdevs-element' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'bdevs-element' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'bdevs-element' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

        // Hero Author
        $this->start_controls_section (
            '_author_section_title',
            [
                'label' => __( 'Hero Author', 'bdevs-element' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => 'style_20',
                ],
            ]
        );

        $this->add_control(
            'author_title',
            [
                'label' => __( 'Hero Author Title', 'bdevs-element' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Hero Author Title', 'bdevs-element' ),
                'placeholder' => __( 'Type Hero Author Title Here', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'author_description',
            [
                'label' => __( 'Author Description', 'bdevs-element' ),
                'description' => bdevs_element_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Author description goes here', 'bdevs-element' ),
                'placeholder' => __( 'Enter author description', 'bdevs-element' ),
                'rows' => 5,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'hero_author_image',
            [
                'label' => __( 'Hero Author Image', 'bdevs-element' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->end_controls_section();


        // Hero Congratulations
        $this->start_controls_section (
            '_congratulations_section_title',
            [
                'label' => __( 'Hero Congratulations', 'bdevs-element' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => 'style_20',
                ],
            ]
        );

        $this->add_control(
            'congratulations_title',
            [
                'label' => __( 'Hero Congratulation Title', 'bdevs-element' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Hero Author Title', 'bdevs-element' ),
                'placeholder' => __( 'Type Hero Author Title Here', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'congratulation_description',
            [
                'label' => __( 'Congratulation Description', 'bdevs-element' ),
                'description' => bdevs_element_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Congratulation description goes here', 'bdevs-element' ),
                'placeholder' => __( 'Enter Congratulation Description', 'bdevs-element' ),
                'rows' => 5,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->end_controls_section();


        // Hero Counter
        $this->start_controls_section (
            '_counter_section_title',
            [
                'label' => __( 'Hero Counter', 'bdevs-element' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => 'style_20',
                ],
            ]
        );

        $this->add_control(
            'counter_title',
            [
                'label' => __( 'Hero Counter Title', 'bdevs-element' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Hero Counter Title', 'bdevs-element' ),
                'placeholder' => __( 'Type Hero Counter Title Here', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'counter_description',
            [
                'label' => __( 'Counter Description', 'bdevs-element' ),
                'description' => bdevs_element_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Counter description goes here', 'bdevs-element' ),
                'placeholder' => __( 'Enter Counter Description', 'bdevs-element' ),
                'rows' => 5,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_banner_social',
            [
                'label' => __( 'Hero Social Icon', 'bdevs-element' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_3'],    
                ],
            ]
        );

        $this->add_control(
            'show_social',
            [
                'label' => __( 'Show Options?', 'bdevselement' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'bdevselement' ),
                'label_off' => __( 'No', 'bdevselement' ),
                'condition' => [
                    'design_style' => ['style_3'],    
                ],
                'return_value' => 'yes',
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'web_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Website Address', 'bdevselement' ),
                'placeholder' => __( 'Add your profile link', 'bdevselement' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $this->add_control(
            'email_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Email', 'bdevselement' ),
                'placeholder' => __( 'Add your email link', 'bdevselement' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );           

        $this->add_control(
            'phone_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Phone', 'bdevselement' ),
                'placeholder' => __( 'Add your phone link', 'bdevselement' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $this->add_control(
            'facebook_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Facebook', 'bdevselement' ),
                'default' => __( '#', 'bdevselement' ),
                'placeholder' => __( 'Add your facebook link', 'bdevselement' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );                

        $this->add_control(
            'twitter_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Twitter', 'bdevselement' ),
                'default' => __( '#', 'bdevselement' ),
                'placeholder' => __( 'Add your twitter link', 'bdevselement' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'instagram_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Instagram', 'bdevselement' ),
                'default' => __( '#', 'bdevselement' ),
                'placeholder' => __( 'Add your instagram link', 'bdevselement' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );       

        $this->add_control(
            'linkedin_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'LinkedIn', 'bdevselement' ),
                'placeholder' => __( 'Add your linkedin link', 'bdevselement' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $this->add_control(
            'youtube_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Youtube', 'bdevselement' ),
                'placeholder' => __( 'Add your youtube link', 'bdevselement' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $this->add_control(
            'googleplus_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Google Plus', 'bdevselement' ),
                'placeholder' => __( 'Add your Google Plus link', 'bdevselement' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $this->add_control(
            'flickr_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Flickr', 'bdevselement' ),
                'placeholder' => __( 'Add your flickr link', 'bdevselement' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $this->add_control(
            'vimeo_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Vimeo', 'bdevselement' ),
                'placeholder' => __( 'Add your vimeo link', 'bdevselement' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'behance_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Behance', 'bdevselement' ),
                'placeholder' => __( 'Add your hehance link', 'bdevselement' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $this->add_control(
            'dribble_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Dribbble', 'bdevselement' ),
                'placeholder' => __( 'Add your dribbble link', 'bdevselement' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $this->add_control(
            'pinterest_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Pinterest', 'bdevselement' ),
                'placeholder' => __( 'Add your pinterest link', 'bdevselement' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'gitub_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Github', 'bdevselement' ),
                'placeholder' => __( 'Add your github link', 'bdevselement' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        ); 


        $this->end_controls_section();


        // Image
        $this->start_controls_section(
            '_section_image',
            [
                'label' => __( 'Image', 'bdevs-element' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_3'],    
                ],
            ]
        );


        $this->add_control(
            'image',
            [
                'label' => __( 'Image', 'bdevs-element' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );


        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'bg_thumbnail',
                'default' => 'large',
                'separator' => 'none',
            ]
        );

        $this->end_controls_section();

        // Button
        $this->start_controls_section(
            '_section_button',
            [
                'label' => __( 'Button', 'bdevs-element' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __( 'Text', 'bdevs-element' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Button Text',
                'placeholder' => __( 'Type button text here', 'bdevs-element' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => __( 'Link', 'bdevs-element' ),
                'type' => Controls_Manager::URL,
                'placeholder' => 'http://elementor.bdevs.net/',
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        if ( bdevs_element_is_elementor_version( '<', '2.6.0' ) ) {
            $this->add_control(
                'button_icon',
                [
                    'label' => __( 'Icon', 'bdevs-element' ),
                    'label_block' => true,
                    'type' => Controls_Manager::ICON,
                    'options' => bdevs_element_get_bdevs_element_icons(),
                    'default' => 'fa fa-angle-right',
                ]
            );

            $condition = ['button_icon!' => ''];
        } else {
            $this->add_control(
                'button_selected_icon',
                [
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'button_icon',
                    'label_block' => true,
                ]
            );
            $condition = ['button_selected_icon[value]!' => ''];
        }

        $this->add_control(
            'button_icon_position',
            [
                'label' => __( 'Icon Position', 'bdevs-element' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
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

        $this->add_control(
            'button_icon_spacing',
            [
                'label' => __( 'Icon Spacing', 'bdevs-element' ),
                'type' => Controls_Manager::SLIDER,
                'condition' => $condition,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-btn--icon-before .bdevs-btn-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .bdevs-btn--icon-after .bdevs-btn-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        
    }

    protected function register_style_controls() {
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

    protected function render() {
        $settings = $this->get_settings_for_display();

        ?>

        <?php if ( $settings['design_style'] === 'style_3' ):
        $this->add_inline_editing_attributes( 'title', 'basic' );
        $this->add_render_attribute( 'title', 'class', 'bdevs-el-title' );

        if (!empty($settings['image']['id'])) {
            $image = wp_get_attachment_image_url($settings['image']['id'], 'full');
        }

        ?>    

        <section class="banner_section banner_3">
            <div class="container">
              <div class="row align-items-center justify-content-lg-between">
                <div class="col order-last col-lg-6">
                <?php if ( $settings['image'] ) : ?>
                  <div class="banner_image">
                    <img src="<?php echo esc_attr($image); ?>" alt="creative Solutions Image">
                  </div>
                </div>
                <?php endif; ?>
                <div class="col col-lg-6">
                  <div class="banner_content">
                   <?php if ( $settings['subtitle'] ) : ?>
                   <small class="banner_content_3_subtitle bdevs-el-subtitle"><?php echo bdevs_element_kses_intermediate( $settings['subtitle'] ); ?></small>
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
                    <?php if ( $settings['description'] ) : ?>
                       <p>
                          <?php echo bdevs_element_kses_intermediate( $settings['description'] ); ?>
                       </p>
                    <?php endif; ?>

                    <form method="get" action="<?php print esc_url(home_url('/')); ?>">
                      <div class="form_item form_rounded">
                        <input type="search" name="s" value="<?php print esc_attr( get_search_query() ) ?>" placeholder="<?php print esc_attr__('Search here...', 'repairon'); ?>">
                        <button type="submit" class="btn btn_danger btn_rounded"><?php print esc_html('Search Now','repairon'); ?></button>
                      </div>
                    </form>
                    <?php if( !empty($settings['show_social'] ) ) : ?>
                    <ul class="social_icon social_round ul_li">
                       <?php if( !empty($settings['web_title'] ) ) : ?>
                            <li><a href="<?php echo esc_url( $settings['web_title'] ); ?>"><i class="far fa-globe"></i></a></li>
                            <?php endif; ?>  

                            <?php if( !empty($settings['email_title'] ) ) : ?>
                              <li> <a href="mailto:<?php echo esc_url( $settings['email_title'] ); ?>"><i class="fal fa-envelope"></i></a></li>
                            <?php endif; ?>  

                            <?php if( !empty($settings['phone_title'] ) ) : ?>
                              <li><a href="tell:<?php echo esc_url( $settings['phone_title'] ); ?>"><i class="fas fa-phone"></i></a></li>
                            <?php endif; ?>  

                            <?php if( !empty($settings['facebook_title'] ) ) : ?>
                             <li><a href="<?php echo esc_url( $settings['facebook_title'] ); ?>"><i class="fab fa-facebook-f"></i></a></li>
                            <?php endif; ?>

                            <?php if( !empty($settings['twitter_title'] ) ) : ?>
                             <li><a href="<?php echo esc_url( $settings['twitter_title'] ); ?>"><i class="fab fa-twitter"></i></a></li>
                            <?php endif; ?>

                            <?php if( !empty($settings['instagram_title'] ) ) : ?>
                             <li><a href="<?php echo esc_url( $settings['instagram_title'] ); ?>"><i class="fab fa-instagram"></i></a></li>
                            <?php endif; ?>

                            <?php if( !empty($settings['linkedin_title'] ) ) : ?>
                             <li> <a href="<?php echo esc_url( $settings['linkedin_title'] ); ?>"><i class="fab fa-linkedin-in"></i></a></li>
                            <?php endif; ?>

                            <?php if( !empty($settings['youtube_title'] ) ) : ?>
                             <li><a href="<?php echo esc_url( $settings['youtube_title'] ); ?>"><i class="fab fa-youtube"></i></a></li>
                            <?php endif; ?>

                            <?php if( !empty($settings['googleplus_title'] ) ) : ?>
                              <li> <a href="<?php echo esc_url( $settings['googleplus_title'] ); ?>"><i class="fab fa-google-plus-g"></i></a></li>
                            <?php endif; ?>

                            <?php if( !empty($settings['flickr_title'] ) ) : ?>
                             <li><a href="<?php echo esc_url( $settings['flickr_title'] ); ?>"><i class="fab fa-flickr"></i></a></li>
                            <?php endif; ?>

                            <?php if( !empty($settings['vimeo_title'] ) ) : ?>
                             <li><a href="<?php echo esc_url( $settings['vimeo_title'] ); ?>"><i class="fab fa-vimeo-v"></i></a></li>
                            <?php endif; ?>

                            <?php if( !empty($settings['behance_title'] ) ) : ?>
                             <li><a href="<?php echo esc_url( $settings['behance_title'] ); ?>"><i class="fab fa-behance"></i></a></li>
                            <?php endif; ?>

                            <?php if( !empty($settings['dribble_title'] ) ) : ?>
                             <li><a href="<?php echo esc_url( $settings['dribble_title'] ); ?>"><i class="fab fa-dribbble"></i></a></li>
                            <?php endif; ?>

                            <?php if( !empty($settings['pinterest_title'] ) ) : ?>
                            <li><a href="<?php echo esc_url( $settings['pinterest_title'] ); ?>"><i class="fab fa-pinterest-p"></i></a></li>
                            <?php endif; ?>

                            <?php if( !empty($settings['gitub_title'] ) ) : ?>
                            <li><a href="<?php echo esc_url( $settings['gitub_title'] ); ?>"><i class="fab fa-github"></i></a></li>
                            <?php endif; ?>
                    </ul>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
        </section>

        <?php elseif ( $settings['design_style'] === 'style_2' ):

        $this->add_inline_editing_attributes( 'title', 'basic' );
        $this->add_render_attribute( 'title', 'class', 'bdevs-el-title' );

        $this->add_inline_editing_attributes( 'description', 'intermediate' );
        $this->add_render_attribute( 'description', 'class', 'bdevs-card-text' );

        $this->add_inline_editing_attributes( 'button_text', 'none' );
        $this->add_render_attribute( 'button', 'class', 'btn btn_success btn_rounded bdevs-el-btn' );
        $this->add_link_attributes( 'button', $settings['button_link'] );

        if ( !empty($settings['image']['id']) ){
            $image = wp_get_attachment_image_url( $settings['image']['id'], $settings['bg_thumbnail_size'] );
        }
        if ( !empty($settings['hero_sm_image']['id']) ){
            $hero_sm_image = wp_get_attachment_image_url( $settings['hero_sm_image']['id'], $settings['bg_thumbnail_size'] );
        }
        if ( !empty($settings['hero_author_image']['id']) ){
            $hero_author_image = wp_get_attachment_image_url( $settings['hero_author_image']['id'], $settings['bg_thumbnail_size'] );
        }

        ?>

        <section class="banner_section banner_2 parallaxie">
            <div class="container">
              <div class="row">
                <div class="col col-lg-8 col-md-8">
                  <div class="banner_content bdevs-el-content">
                    <?php
                    if ( $settings['title' ] ) :
                        printf( '<%1$s %2$s>%3$s</%1$s>',
                            tag_escape( $settings['title_tag'] ),
                            $this->get_render_attribute_string( 'title' ),
                             $settings['title' ]
                        );
                     endif;
                    ?>
                    <?php if ( $settings['description'] ) : ?>
                    <p>
                     <?php echo bdevs_element_kses_intermediate( $settings['description'] ); ?>
                    </p>
                    <?php endif; ?>
                    
                    <?php if ( $settings['button_text'] && ( ( empty( $settings['button_selected_icon'] ) || empty( $settings['button_selected_icon']['value'] ) ) && empty( $settings['button_icon'] ) ) ) :
                        $this->add_render_attribute( 'button', 'class', 'site-btn' );
                        printf( '<a %1$s>%2$s</a>',
                            $this->get_render_attribute_string( 'button' ),
                            esc_html( $settings['button_text'] )
                            );
                    elseif ( empty( $settings['button_text'] ) && ( ! ( empty( $settings['button_selected_icon'] ) || empty( $settings['button_selected_icon']['value'] ) ) || ! empty( $settings['button_icon'] ) ) ) : ?>
                        <a <?php $this->print_render_attribute_string( 'button' ); ?>><?php bdevs_element_render_icon( $settings, 'button_icon', 'button_selected_icon' ); ?></a>
                    <?php elseif ( $settings['button_text'] && ( ! ( empty( $settings['button_selected_icon'] ) || empty( $settings['button_selected_icon']['value'] ) ) || ! empty( $settings['button_icon'] ) ) ) :
                        if ( $settings['button_icon_position'] === 'before' ) :
                            $this->add_render_attribute( 'button', 'class', 'site-btn bdevs-btn--icon-before' );
                            $button_text = sprintf( '<span %1$s>%2$s</span>', $this->get_render_attribute_string( 'button_text' ), esc_html( $settings['button_text'] ) );
                            ?>
                            <a <?php $this->print_render_attribute_string( 'button' ); ?>><?php bdevs_element_render_icon( $settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon'] ); ?> <?php echo $button_text; ?></a>
                            <?php
                        else :
                            $this->add_render_attribute( 'button', 'class', 'bdevs-btn--icon-after' );
                            $button_text = sprintf( '<span %1$s>%2$s</span>', $this->get_render_attribute_string( 'button_text' ), esc_html( $settings['button_text'] ) );
                            ?>
                            <a <?php $this->print_render_attribute_string( 'button' ); ?>><?php echo $button_text; ?> <?php bdevs_element_render_icon( $settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon'] ); ?></a>
                        <?php
                        endif;
                        endif; ?>
                  </div>
                </div>
              </div>
            </div>
        </section>

        <?php else:
        $this->add_inline_editing_attributes( 'title', 'basic' );
        $this->add_render_attribute( 'title', 'class', 'bdevs-el-title' );

        $this->add_inline_editing_attributes( 'description', 'intermediate' );
        $this->add_render_attribute( 'description', 'class', 'bdevs-card-text' );

        if ( !empty($settings['button_link']) ) {
            $this->add_render_attribute( 'button', 'class', 'btn btn_danger bdevs-el-btn' );
            $this->add_link_attributes( 'button', $settings['button_link'] );
        }    

        if ( !empty($settings['image']['id']) ){
            $image = wp_get_attachment_image_url( $settings['image']['id'], $settings['bg_thumbnail_size'] );
        }
        if ( !empty($settings['hero_sm_image']['id']) ){
            $hero_sm_image = wp_get_attachment_image_url( $settings['hero_sm_image']['id'], $settings['bg_thumbnail_size'] );
        }

        ?>

        <section class="banner_section banner_1 parallaxie">
            <div class="container">
              <div class="row justify-content-center">
                <div class="col col-lg-8 col-md-8 col-sm-10">
                  <div class="banner_content text-center">
                    <?php
                        if ( $settings['title' ] ) :
                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['title_tag'] ),
                                $this->get_render_attribute_string( 'title' ),
                                 $settings['title' ]
                                );
                        endif;
                    ?>
                    <!-- button one  -->
                    <?php if ( $settings['button_text'] && ( ( empty( $settings['button_selected_icon'] ) || empty( $settings['button_selected_icon']['value'] ) ) && empty( $settings['button_icon'] ) ) ) :
                        $this->add_render_attribute( 'button', 'class', 'site-btn' );
                        printf( '<a %1$s>%2$s</a>',
                            $this->get_render_attribute_string( 'button' ),
                            esc_html( $settings['button_text'] )
                            );
                    elseif ( empty( $settings['button_text'] ) && ( ! ( empty( $settings['button_selected_icon'] ) || empty( $settings['button_selected_icon']['value'] ) ) || ! empty( $settings['button_icon'] ) ) ) : ?>
                        <a <?php $this->print_render_attribute_string( 'button' ); ?>><?php bdevs_element_render_icon( $settings, 'button_icon', 'button_selected_icon' ); ?></a>
                    <?php elseif ( $settings['button_text'] && ( ! ( empty( $settings['button_selected_icon'] ) || empty( $settings['button_selected_icon']['value'] ) ) || ! empty( $settings['button_icon'] ) ) ) :
                        if ( $settings['button_icon_position'] === 'before' ) :
                            $this->add_render_attribute( 'button', 'class', 'site-btn bdevs-btn--icon-before' );
                            $button_text = sprintf( '<span %1$s>%2$s</span>', $this->get_render_attribute_string( 'button_text' ), esc_html( $settings['button_text'] ) );
                            ?>
                            <a <?php $this->print_render_attribute_string( 'button' ); ?>><?php bdevs_element_render_icon( $settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon'] ); ?> <?php echo $button_text; ?></a>
                            <?php
                        else :
                            $this->add_render_attribute( 'button', 'class', 'bdevs-btn--icon-after' );
                            $button_text = sprintf( '<span %1$s>%2$s</span>', $this->get_render_attribute_string( 'button_text' ), esc_html( $settings['button_text'] ) );
                            ?>
                            <a <?php $this->print_render_attribute_string( 'button' ); ?>><?php echo $button_text; ?> <?php bdevs_element_render_icon( $settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon'] ); ?></a>
                        <?php
                        endif;
                        endif; ?>
                  </div>
                </div>
              </div>
            </div>
        </section>

        <?php endif; ?>    
        <?php
    }

}