<?php
namespace BenzoToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Benzo_Author_Boxes extends Widget_Base {

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
        return 'benzo-author-boxes';
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
        return esc_html__( 'Benzo Author Boxes', 'benzo-toolkit' );
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
        return ['Benzo', 'author', 'user', 'boxes'];
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
            'user_from',
            [
                'label'   => esc_html__( 'User From', 'benzo-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'all'           => esc_html__( 'All', 'benzo-toolkit' ),
                    'specific-user' => esc_html__( 'Specific User', 'benzo-toolkit' ),
                ],
                'default' => 'all',
            ]
        );

        $this->add_control(
            'include_ids',
            [
                'label'       => esc_html__( 'Select User', 'benzo-toolkit' ),
                'type'        => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple'    => true,
                'options'     => $this->list_of_user(),
                'condition'   => [
                    'user_from' => 'specific-user',
                ],
            ]
        );

        $this->add_control(
            'role_in',
            [
                'label'       => esc_html__( 'Role in', 'benzo-toolkit' ),
                'type'        => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple'    => true,
                'options'     => [
                    'administrator' => esc_html__( 'Administrator', 'benzo-toolkit' ),
                    'editor'        => esc_html__( 'Editor', 'benzo-toolkit' ),
                    'author'        => esc_html__( 'Author', 'benzo-toolkit' ),
                    'contributor'   => esc_html__( 'Contributor', 'benzo-toolkit' ),
                    'subscriber'    => esc_html__( 'Subscriber', 'benzo-toolkit' ),
                ],
                'default'     => 'author',
                'condition'   => [
                    'user_from' => 'specific-user',
                ],
            ]
        );

        $this->add_control(
            'order',
            [
                'label'   => esc_html__( 'Order', 'benzo-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'ASC'  => esc_html__( 'ASC', 'benzo-toolkit' ),
                    'DESC' => esc_html__( 'DESC', 'benzo-toolkit' ),
                ],
                'default' => 'ASC',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'    => 'thumbnail',
                'default' => 'medium',
                'exclude' => [
                    'custom',
                ],
            ]
        );

        $this->add_control(
            'column_heading',
            [
                'label'     => esc_html__( 'Column', 'benzo-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'desktop_column',
            [
                'label'   => esc_html__( 'Desktop', 'benzo-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'col-lg-12' => esc_html__( 'One', 'benzo-toolkit' ),
                    'col-lg-6'  => esc_html__( 'Two', 'benzo-toolkit' ),
                    'col-lg-4'  => esc_html__( 'Three', 'benzo-toolkit' ),
                    'col-lg-3'  => esc_html__( 'Four', 'benzo-toolkit' ),
                ],
                'default' => 'col-lg-3',
            ]
        );

        $this->add_control(
            'tab_column',
            [
                'label'   => esc_html__( 'Tab', 'benzo-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'col-md-12' => esc_html__( 'One', 'benzo-toolkit' ),
                    'col-md-6'  => esc_html__( 'Two', 'benzo-toolkit' ),
                    'col-md-4'  => esc_html__( 'Three', 'benzo-toolkit' ),
                    'col-md-3'  => esc_html__( 'Four', 'benzo-toolkit' ),
                ],
                'default' => 'col-md-6',
            ]
        );

        $this->add_control(
            'mobile_column',
            [
                'label'   => esc_html__( 'Mobile', 'benzo-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'col-12' => esc_html__( 'One', 'benzo-toolkit' ),
                    'col-6'  => esc_html__( 'Two', 'benzo-toolkit' ),
                    'col-4'  => esc_html__( 'Three', 'benzo-toolkit' ),
                    'col-3'  => esc_html__( 'Four', 'benzo-toolkit' ),
                ],
                'default' => 'col-12',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'author_box_style',
            [
                'label' => esc_html__( 'Author Box', 'benzo-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'author_box_margin',
            [
                'label'      => esc_html__( 'Margin', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-author-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'author_box_padding',
            [
                'label'      => esc_html__( 'Padding', 'benzo-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .benzo-author-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'author_box_bg',
            [
                'label'     => esc_html__( 'Background Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-author-box' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'author_box_line',
            [
                'label'     => esc_html__( 'Line Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-author-box::after' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'content_style',
            [
                'label' => esc_html__( 'Color & Typography', 'benzo-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'name_heading',
            [
                'label'     => esc_html__( 'Name', 'benzo-toolkit' ),
                'type'      => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'name_color',
            [
                'label'     => esc_html__( 'Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-author-box .author-content .name a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'name_hover_color',
            [
                'label'     => esc_html__( 'Color(Hover)', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-author-box .author-content .name:hover a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'name_typography',
                'selector' => '{{WRAPPER}} .benzo-author-box .author-content .name',
            ]
        );

        $this->add_control(
            'title_heading',
            [
                'label'     => esc_html__( 'Title', 'benzo-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-author-box .author-content .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .benzo-author-box .author-content .title',
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

        $args = [
            'order' => $settings['order'],
        ];

        if ( 'specific-user' === $settings['user_from'] && $settings['include_ids'] ) {
            $args['include'] = $settings['include_ids'];
        }

        if ( 'specific-user' === $settings['user_from'] && $settings['role_in'] ) {
            $args['role__in'] = $settings['role_in'];
        }

        $users = get_users( $args );

        if ( $users ): ?>
        <div class="benzo-author-boxes">
            <div class="row">
                <?php foreach ( $users as $user ):
                    $column    = [$settings['desktop_column'], $settings['tab_column'], $settings['mobile_column']];
                    $user_meta = get_user_meta( $user->ID, 'benzo_user_meta', true );

                    if ( isset( $user_meta['user_profile_image'] ) ) {
                        $thumbnail_id = $user_meta['user_profile_image']['id'];
                    } else {
                        $thumbnail_id = '';
                    }

                    if ( isset( $user_meta['user_title'] ) ) {
                        $user_title = $user_meta['user_title'];
                    } else {
                        $user_title = '';
                    }

                    ?>
                    <div class="<?php echo esc_attr( implode( ' ', $column ) ) ?>">
                        <div class="benzo-author-box">
                            <div class="author-content">
                                <h4 class="name">
                                    <a href="<?php echo esc_url( get_author_posts_url( $user->ID ) ) ?>"><?php echo esc_html( $user->display_name ) ?></a>
                                </h4>
                                <?php
                                    if ( $user_title ) {
                                        echo '<span class="title">' . esc_html( $user_title ) . '</span>';
                                    }
                                ?>
                            </div>
                            <?php if( $thumbnail_id ) : ?>
                                <div class="author-thumbnail">
                                    <img src="<?php echo wp_get_attachment_image_url( $thumbnail_id, $settings['thumbnail_size'] ) ?>" alt="<?php echo esc_html( $user->display_name ) ?>">
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php
                endforeach;?>
            </div>
        </div>
        <?php endif;
    }

    protected function list_of_user() {
        $users      = get_users();
        $users_list = [];

        if ( $users ) {
            foreach ( $users as $user ) {
                $users_list[$user->ID] = $user->display_name;
            }
        }

        return $users_list;
    }
}