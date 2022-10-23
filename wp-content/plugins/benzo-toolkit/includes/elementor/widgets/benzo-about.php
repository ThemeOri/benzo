<?php
namespace BenzoToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Utils;

defined( 'ABSPATH' ) || exit;

class Benzo_About extends Widget_Base {

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
        return 'benzo-about';
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
        return esc_html__( 'Benzo About', 'benzo-toolkit' );
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
        return 'eicon-import-kit';
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
        return ['Benzo', 'Toolkit', 'image', 'about'];
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
                'label'   => esc_html__( 'Select Style', 'benzo-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'design-1' => esc_html__( 'Design One', 'benzo-toolkit' ),
                    'design-2' => esc_html__( 'Design Tow', 'benzo-toolkit' ),
                ],
                'default' => 'design-1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_fields_heading',
            [
                'label' => esc_html__( 'Title & Description', 'benzo-toolkit' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'widget_design' => ['design-2'],
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'benzo-toolkit'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 4,
                'default' => 'Heading Title',
                'placeholder' => esc_html__('Heading Text', 'benzo-toolkit'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' => esc_html__('Sub Title', 'benzo-toolkit'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Heading Sub Title',
                'placeholder' => esc_html__('Heading Sub Text', 'benzo-toolkit'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'benzo-toolkit'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'description',
                'placeholder' => esc_html__('description text', 'benzo-toolkit'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'benzo-toolkit'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'benzo-toolkit'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'benzo-toolkit'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'benzo-toolkit'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'benzo-toolkit'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'benzo-toolkit'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
            ]
        );

            $this->add_responsive_control(
            'align',
            [
                'label' => esc_html__('Alignment', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'benzo-toolkit'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'benzo-toolkit'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'benzo-toolkit'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_media',
            [
                'label' => esc_html__('Image', 'benzo-toolkit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'widget_design' => ['design-1'],
                ],
            ]
        );

         $this->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnails',
                'default' => 'large',
                'separator' => 'none',
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_media_two',
            [
                'label' => esc_html__('About Image', 'benzo-toolkit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'widget_design' => ['design-2'],
                ],
            ]
        );

        $this->add_control(
            'about_image_left',
            [
                'label' => esc_html__('Image Left', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'image_middle_one',
            [
                'label' => esc_html__('Image One', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'image_middle_three',
            [
                'label' => esc_html__('Image Three', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnails',
                'default' => 'large',
                'separator' => 'none',
            ]
        );


        $this->end_controls_section();

        // About Experience
        $this->start_controls_section(
            'section_experience',
            [
                'label' => esc_html__('Experience', 'benzo-toolkit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'widget_design' => ['design-1'],
                ],
            ]
        );

        $this->add_control(
            'experience_title',
            [
                'label' => esc_html__('Experience Title', 'benzo-toolkit'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 4,
                'default' => 'Experience Title',
                'placeholder' => esc_html__('Experience Title', 'benzo-toolkit'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'experience_symbols',
            [
                'label' => esc_html__('Experience Symbols', 'benzo-toolkit'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'rows' => 4,
                'default' => '+',
                'placeholder' => esc_html__('+', 'benzo-toolkit'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'description_experience',
            [
                'label' => esc_html__('Description Experience', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__('Description Experience Text', 'benzo-toolkit'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'benzo-toolkit'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'benzo-toolkit'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'benzo-toolkit'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'benzo-toolkit'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'benzo-toolkit'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'benzo-toolkit'),
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
                'label' => esc_html__('Alignment', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'benzo-toolkit'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'benzo-toolkit'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'benzo-toolkit'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

        // About Author
        $this->start_controls_section(
            'section_author',
            [
                'label' => esc_html__('About Author', 'benzo-toolkit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'widget_design' => ['design-2'],
                ],
            ]
        );

        $this->add_control(
            'about_author_img',
            [
                'label' => esc_html__('Author Profile', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'author_title',
            [
                'label' => esc_html__('Author Title', 'benzo-toolkit'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'rows' => 4,
                'default' => 'Author Title',
                'placeholder' => esc_html__('Author Title', 'benzo-toolkit'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'author_subtitle',
            [
                'label' => esc_html__('Author Sub Title', 'benzo-toolkit'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'rows' => 4,
                'default' => 'author subtitle',
                'placeholder' => esc_html__('author subtitle', 'benzo-toolkit'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'author_description',
            [
                'label' => esc_html__('Description', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__('Description Text', 'benzo-toolkit'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->end_controls_section();

        // About Icon List
        $this->start_controls_section(
            '_section_icon_list',
            [
                'label' => esc_html__('About Icon List', 'benzo-toolkit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'widget_design' => ['design-2'],
                ],
            ]
        );

        $repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'selected_icon',
			[
				'type' => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'label_block' => true,
				'default' => [
					'value' => 'fas fa-smile-wink',
					'library' => 'fa-solid',
				],
			]
		);

        $repeater->add_control(
            'about_icon_list',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__('Icon Title', 'benzo-toolkit'),
                'placeholder' => esc_html__('Type title here', 'benzo-toolkit'),
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
                'title_field' => '<# print(about_icon_list || "Carousel Item"); #>',
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
                    [
                        'image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                ]
            ]
        );

        $this->end_controls_section();

        // About Video
        $this->start_controls_section(
            'section_video',
            [
                'label' => esc_html__('About Video', 'benzo-toolkit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'widget_design' => ['design-2'],
                ],
            ]
        );

        $this->add_control(
            'about_video_image',
            [
                'label' => esc_html__('Video Image', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'about_video_url',
            [
                'label' => esc_html__('Video URL', 'benzo-toolkit'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'rows' => 4,
                'default' => '#',
                'placeholder' => esc_html__('#', 'benzo-toolkit'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'video_description',
            [
                'label' => esc_html__('Description', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__('Description Text', 'benzo-toolkit'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->end_controls_section();

        // Button
        $this->start_controls_section(
            '_section_button',
            [
                'label' => esc_html__('Button', 'benzo-toolkit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'widget_design' => ['design-2'],
                ],
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'benzo-toolkit'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Button Text',
                'placeholder' => esc_html__('button text', 'benzo-toolkit'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => esc_html__('Link', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => 'https://example.com',
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => '#'
                ],
            ]
        );

        $this->end_controls_section();

        // About Support
        $this->start_controls_section(
            'section_support',
            [
                'label' => esc_html__('About Support', 'benzo-toolkit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'widget_design' => ['design-2'],
                ],
            ]
        );

        $this->add_control(
            'about_support_title',
            [
                'label' => esc_html__('About Support Title', 'benzo-toolkit'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'rows' => 4,
                'default' => 'About Support Title',
                'placeholder' => esc_html__('About Support Title', 'benzo-toolkit'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'about_support_number',
            [
                'label' => esc_html__('Support Number', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__('08 (520) 526-2250', 'benzo-toolkit'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'about_support_url',
            [
                'label' => esc_html__('Support URL', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__('Tell', 'benzo-toolkit'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_content',
            [
                'label' => esc_html__('Style Title & Content', 'benzo-toolkit'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

         // Title
        $this->add_control(
            '_heading_title',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Title', 'benzo-toolkit'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'title_spacing',
            [
                'label' => esc_html__('Bottom Spacing', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

       $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Typography', 'benzo-toolkit'),
                'selector' => '{{WRAPPER}} .webtend-el-title',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        // Subtitle
        $this->add_control(
            '_subtitle_subtitle',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Subtitle', 'benzo-toolkit'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'subtitle_spacing',
            [
                'label' => esc_html__('Bottom Spacing', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => esc_html__('Text Color', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-subtitle' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle',
                'selector' => '{{WRAPPER}} .webtend-el-subtitle',
            ]
        );

        // description
        $this->add_control(
            '_content_description',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Description', 'benzo-toolkit'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'description_spacing',
            [
                'label' => esc_html__('Bottom Spacing', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-des p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('Text Color', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-des p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description',
                'selector' => '{{WRAPPER}} .webtend-el-des p',
            ]
        );

         $this->add_responsive_control(
            'description_spacing',
            [
                'label' => esc_html__('Bottom Spacing', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-des p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            '_section_style_author',
            [
                'label' => esc_html__('Style About Author', 'benzo-toolkit'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

         // Title
        $this->add_control(
            '_about_author_style_title',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Title', 'benzo-toolkit'),
                'separator' => 'before'
            ]
        );

       $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_about_author_title_typography',
                'label' => esc_html__('Typography', 'benzo-toolkit'),
                'selector' => '{{WRAPPER}} .webtend-el-about-title',
            ]
        );

        $this->add_control(
            'about_author_title_color',
            [
                'label' => esc_html__('Color', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-about-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        // Subtitle
        $this->add_control(
            '_author_subtitle',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Subtitle', 'benzo-toolkit'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            '_author_subtitle_color',
            [
                'label' => esc_html__('Text Color', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-subtitle-author' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_author_subtitle',
                'selector' => '{{WRAPPER}} .webtend-el-subtitle-author',
            ]
        );

        // description
        $this->add_control(
            '__author_content_description',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Description', 'benzo-toolkit'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'description_author_color',
            [
                'label' => esc_html__('Text Color', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-author-des p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'author_description',
                'selector' => '{{WRAPPER}} .webtend-el-author-des p',
            ]
        );

        $this->end_controls_section();

        // Button 
        $this->start_controls_section(
            'section_button_style',
            [
                'label' => esc_html__( 'Button', 'benzo-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label'      => esc_html__( 'Padding', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .webtend-el-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'button_border',
                'selector' => '{{WRAPPER}} .webtend-el-btn',
            ]
        );

        $this->add_responsive_control(
            'button_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .webtend-el-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'button_typography',
                'label'    => esc_html__( 'Typography', 'benzo-toolkit' ),
                'selector' => '{{WRAPPER}} .webtend-el-btn',
            ]
        );

        $this->start_controls_tabs( 'button_tabs' );

        $this->start_controls_tab(
            'field_button_normal',
            [
                'label' => esc_html__( 'Normal', 'benzo-toolkit' ),
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label'     => esc_html__( 'Text Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-btn' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-btn' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_bg_after_color',
            [
                'label'     => esc_html__( 'Background After Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-el-btn::after' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_bg_before_color',
            [
                'label'     => esc_html__( 'Background Before Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-el-btn::before' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'field_button_hover',
            [
                'label' => esc_html__( 'Hover', 'benzo-toolkit' ),
            ]
        );

        $this->add_control(
            'button_text_focus',
            [
                'label'     => esc_html__( 'Text Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-btn:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color_focus',
            [
                'label'     => esc_html__( 'Background Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-btn:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_border_focus',
            [
                'label'     => esc_html__( 'Border Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-btn:hover' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        // Support Style
        $this->start_controls_section(
            '_section_style_support',
            [
                'label' => esc_html__('Style About Support', 'benzo-toolkit'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

         // Title
        $this->add_control(
            '_about_support_style_title',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Title', 'benzo-toolkit'),
                'separator' => 'before'
            ]
        );

       $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_about_support_title_typography',
                'label' => esc_html__('Typography', 'benzo-toolkit'),
                'selector' => '{{WRAPPER}} .webtend-el-sp-title',
            ]
        );

        $this->add_control(
            'about_support_title_color',
            [
                'label' => esc_html__('Color', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-sp-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        // Subtitle
        $this->add_control(
            '_support_number',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Number', 'benzo-toolkit'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            '_support_number_color',
            [
                'label' => esc_html__('Number Color', 'benzo-toolkit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .webtend-el-subtitle-sp' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_number_subtitle',
                'selector' => '{{WRAPPER}} .webtend-el-subtitle-sp',
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
        extract($settings);

        $title = wp_kses_post($settings['title'] ?? '');
        $this->add_inline_editing_attributes('title', 'basic');
        $this->add_render_attribute('title', 'class', 'webtend-el-title');
        $title = wp_kses_post($settings['title']);

        ?>
        <?php if ( 'design-1' === $settings['widget_design'] ) : ?>
        <div class="about__one-wrapper">
            <div class="about__one-thumb">
            <?php if ( $settings['image']['url'] ): ?>
                <img src="<?php echo esc_attr( $settings['image']['url'] ) ?>" alt="img">
                <?php endif;?>
                <div class="about__one-experience">
                   <?php if ($settings['experience_title']) : ?>
                    <h5><span class="counter"><?php echo wp_kses_post($settings['experience_title']); ?></span>
                    <?php echo wp_kses_post($settings['experience_symbols']); ?>
                   </h5>
                    <?php endif;?>
                    <?php if ($settings['description_experience']) : ?>
                    <p><?php echo wp_kses_post($settings['description_experience']); ?></p>
                    <?php endif;?>
                </div>
            </div>
        </div>
        <?php endif; ?>
        
        <?php if ( 'design-2' === $settings['widget_design'] ) : ?>

        <div class="about__wrapper-two">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7 col-md-6">
                        <div class="about-left-gallery">
                        <?php if ( $settings['about_image_left']['url'] ): ?>
                        <div class="about-left-thumb">
                            <img src="<?php echo esc_attr( $settings['about_image_left']['url'] ) ?>" alt="img">
                        </div>
                        <?php endif;?>
                        <div class="about-middle-thumb">
                        <?php if ( $settings['image_middle_one']['url'] ): ?>
                            <div class="about-middle-one">
                            <img src="<?php echo esc_attr( $settings['image_middle_one']['url'] ) ?>" alt="img">
                            </div>
                        <?php endif;?>
                        <?php if ( $settings['image_middle_three']['url'] ): ?>
                            <div class="about-middle-two">
                            <img src="<?php echo esc_attr( $settings['image_middle_three']['url'] ) ?>" alt="img">
                            </div>
                        <?php endif;?>
                        </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6">
                        <div class="about-right-content">
                            <div class="about-two-heading-style webtend-el-des">
                                <div class="heading__style-three">
                                <?php if ($settings['sub_title']) : ?>
                                <span class="webtend-el-subtitle"><?php echo wp_kses_post($settings['sub_title']); ?></span>
                                <?php endif; ?>
                                <?php printf(
                                        '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape($settings['title_tag']),
                                        $this->get_render_attribute_string('title'),
                                        $title
                                    ); 
                                ?>
                                </div>
                                <?php if ($settings['description']) : ?>
                                <p><?php echo wp_kses_post($settings['description']); ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="about-author-two">
                            <?php if ( $settings['about_author_img']['url'] ): ?>
                                <div class="about-author-two-thumb">
                                    <img src="<?php echo esc_attr( $settings['about_author_img']['url'] ) ?>" alt="img">
                                </div>
                            <?php endif; ?>
                                <div class="about-author-content webtend-el-author-des">
                                <?php if ($settings['author_subtitle']) : ?>
                                    <h5 class="webtend-el-about-title"><?php echo wp_kses_post($settings['author_title']); ?> <span class="webtend-el-subtitle-author"> <?php echo wp_kses_post($settings['author_subtitle']); ?> </span></h5>
                                    <?php endif; ?>
                                    <?php if ($settings['author_description']) : ?>
                                    <p><?php echo wp_kses_post($settings['author_description']); ?></p>
                                    <?php endif; ?>
                                    <div class="about-author-quote-two">
                                     <i class="fal fa-quote-right"></i>
                                    </div>
                                </div>
                            </div>
                                <div class="about-two-list">
                                    <ul>
                                    <?php foreach ($settings['slides'] as $slide) : ?>
                                        <li><h5><i class="<?php echo $slide['selected_icon']['value'];?>"></i> <?php echo wp_kses_post($slide['about_icon_list']); ?></h5></li>
                                    <?php endforeach; ?>
                                    </ul>
                                </div>
                                <div class="about-video-two">
                                <?php if ( $settings['about_video_image']['url'] ): ?>
                                    <div class="about-video-thumb-two">
                                       <img src="<?php echo esc_attr( $settings['about_video_image']['url'] ) ?>" alt="img">
                                       <a class="popup-video about-popup-two" href="<?php echo esc_url($settings['about_video_url']); ?>"><i class="fas fa-play"></i></a>
                                    </div>
                                <?php endif; ?>
                                <?php if ($settings['video_description']) : ?>
                                    <div class="about-video-content-two webtend-el-des">
                                        <p><?php echo wp_kses_post($settings['video_description']); ?></p>
                                    </div>
                                <?php endif; ?>
                                </div>
                                <div class="about-button-support">
                                <?php if ($settings['button_text']) : ?>
                                    <a class="about-support-btn benzo-el-btn webtend-el-btn" href="<?php echo esc_url( $settings['button_link']['url'] ) ?>"><?php echo wp_kses_post($settings['button_text']); ?></a>
                                    <?php endif; ?>
                                    <?php if ($settings['about_support_title']) : ?>
                                    <div class="about-support-two">
                                        <span class="webtend-el-sp-title"><?php echo wp_kses_post($settings['about_support_title']); ?></span>
                                        <h5><a class="webtend-el-subtitle-sp" href="<?php echo esc_url($settings['about_support_url']); ?>"><?php echo wp_kses_post($settings['about_support_number']); ?></a></h5>
                                    </div>
                                    <?php endif; ?>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php endif; ?>

        <?php
}
}