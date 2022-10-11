<?php

namespace Generic\Elements;

defined('ABSPATH') || die();

class WooProduct extends GenericWidget
{

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
		return 'generic-wooproduct';
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
        return esc_html__('Generic WooProduct', 'generic-elements');
    }

    public function get_custom_help_url()
    {
        return 'http://elementor.bdevs.net/bdevselement/generic-wooproduct/';
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
        return 'eicon-products gen-icon';
    }

    public function get_keywords()
    {
        return ['Generic', 'woo', 'product', 'logo', 'header', 'navigation', 'nav'];
    }

    public function get_categories()
    {
        return ['generic-elements'];
    }


    // register_content_controls
    protected function register_content_controls()
    {
        $this->generic_woo_product_content_controls();
    }

    // generic_woo_product_content_controls
    protected function generic_woo_product_content_controls()
    {

        $this->start_controls_section(
            'section_product_query',
            [
                'label' => esc_html__('Product Query', 'generic-elements'),
            ]
        );

        $post_type = 'product';
        $taxonomy = 'product_cat';

        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Posts Per Page', 'generic-elements'),
                'description' => esc_html__('Leave blank or enter -1 for all.', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => '3',
            ]
        );

        $this->add_control(
            'category',
            [
                'label' => esc_html__('Include Categories', 'generic-elements'),
                'description' => esc_html__('Select a category to include or leave blank for all.', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => get_generic_el_categories($taxonomy),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'exclude_category',
            [
                'label' => esc_html__('Exclude Categories', 'generic-elements'),
                'description' => esc_html__('Select a category to exclude', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => get_generic_el_categories($taxonomy),
                'label_block' => true
            ]
        );

        $this->add_control(
            'post__not_in',
            [
                'label' => esc_html__('Exclude Item', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => get_generic_el_all_post_types($post_type),
                'multiple' => true,
                'label_block' => true
            ]
        );

        $this->add_control(
            'offset',
            [
                'label' => esc_html__('Offset', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => '0',
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label' => esc_html__('Order By', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => array(
			        'ID' => 'Post ID',
			        'author' => 'Post Author',
			        'title' => 'Title',
			        'date' => 'Date',
			        'modified' => 'Last Modified Date',
			        'parent' => 'Parent Id',
			        'rand' => 'Random',
			        'comment_count' => 'Comment Count',
			        'menu_order' => 'Menu Order',
			    ),
                'default' => 'date',
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => esc_html__('Order', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'asc' 	=> esc_html__( 'Ascending', 'generic-elements' ),
                    'desc' 	=> esc_html__( 'Descending', 'generic-elements' )
                ],
                'default' => 'desc',

            ]
        );
        $this->add_control(
            'ignore_sticky_posts',
            [
                'label' => esc_html__( 'Ignore Sticky Posts', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'generic-elements' ),
                'label_off' => esc_html__( 'No', 'generic-elements' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );


        $this->end_controls_section();


        // layout Panel
        $this->start_controls_section(
            'section_campaign',
            [
                'label' => esc_html__('Product - Layout', 'generic-elements'),
            ]
        );
        $this->add_control(
            'design_style',
            [
                'label' => esc_html__('Select Layout', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Grid Style 1', 'generic-elements'),
                ],
                'default' => 'layout-1',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
            ]
        );
        $this->add_control(
            'generic_el_product_pagination',
            [
                'label' => esc_html__( 'Pagination', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'generic-elements' ),
                'label_off' => esc_html__( 'Hide', 'generic-elements' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );


        $this->add_control(
            'generic_el_image_show',
            [
                'label' => esc_html__( 'Show Image', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'generic-elements' ),
                'label_off' => esc_html__( 'Hide', 'generic-elements' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'generic_el_prcie_show',
            [
                'label' => esc_html__( 'Show Price', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'generic-elements' ),
                'label_off' => esc_html__( 'Hide', 'generic-elements' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );


        $this->add_control(
            'generic_el_rating_show',
            [
                'label' => esc_html__( 'Show Rating', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'generic-elements' ),
                'label_off' => esc_html__( 'Hide', 'generic-elements' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'generic_el_button_show',
            [
                'label' => esc_html__( 'Show Button', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'generic-elements' ),
                'label_off' => esc_html__( 'Hide', 'generic-elements' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();


        // generic_el_product_columns_section
        $this->start_controls_section(
            'generic_el_product_columns_section',
            [
                'label' => esc_html__('Product - Columns', 'generic-elements'),
            ]
        );

        $this->add_control(
            'generic_el_col_for_desktop',
            [
                'label' => esc_html__( 'Columns for Desktop', 'generic-elements' ),
                'description' => esc_html__( 'Screen width equal to or greater than 1200px', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__( '1 Columns', 'generic-elements' ),
                    6 => esc_html__( '2 Columns', 'generic-elements' ),
                    4 => esc_html__( '3 Columns', 'generic-elements' ),
                    3 => esc_html__( '4 Columns', 'generic-elements' ),
                    2 => esc_html__( '6 Columns', 'generic-elements' ),
                    1 => esc_html__( '12 Columns', 'generic-elements' ),
                ],
                'separator' => 'before',
                'default' => '4',
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'generic_el_col_for_laptop',
            [
                'label' => esc_html__( 'Columns for Laptop', 'generic-elements' ),
                'description' => esc_html__( 'Screen width equal to or greater than 992px', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__( '1 Columns', 'generic-elements' ),
                    6 => esc_html__( '2 Columns', 'generic-elements' ),
                    4 => esc_html__( '3 Columns', 'generic-elements' ),
                    3 => esc_html__( '4 Columns', 'generic-elements' ),
                    2 => esc_html__( '6 Columns', 'generic-elements' ),
                    1 => esc_html__( '12 Columns', 'generic-elements' ),
                ],
                'separator' => 'before',
                'default' => '4',
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'generic_el_col_for_tablet',
            [
                'label' => esc_html__( 'Columns for Tablet', 'generic-elements' ),
                'description' => esc_html__( 'Screen width equal to or greater than 768px', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__( '1 Columns', 'generic-elements' ),
                    6 => esc_html__( '2 Columns', 'generic-elements' ),
                    4 => esc_html__( '3 Columns', 'generic-elements' ),
                    3 => esc_html__( '4 Columns', 'generic-elements' ),
                    2 => esc_html__( '6 Columns', 'generic-elements' ),
                    1 => esc_html__( '12 Columns', 'generic-elements' ),
                ],
                'separator' => 'before',
                'default' => '6',
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'generic_el_col_for_mobile',
            [
                'label' => esc_html__( 'Columns for Mobile', 'generic-elements' ),
                'description' => esc_html__( 'Screen width less than 768px', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__( '1 Columns', 'generic-elements' ),
                    6 => esc_html__( '2 Columns', 'generic-elements' ),
                    4 => esc_html__( '3 Columns', 'generic-elements' ),
                    3 => esc_html__( '4 Columns', 'generic-elements' ),
                    5 => esc_html__( '5 Columns (For Carousel Item)', 'generic-elements' ),
                    2 => esc_html__( '6 Columns', 'generic-elements' ),
                    1 => esc_html__( '12 Columns', 'generic-elements' ),
                ],
                'separator' => 'before',
                'default' => '12',
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();

    }



    // register_style_controls
    protected function register_style_controls()
    {
        $this->generic_woo_product_style_controls();
    }


    // generic_woo_product_style_controls
    protected function generic_woo_product_style_controls()
    {
        $this->start_controls_section(
            'section_generic_woo_product_style_controls',
            [
                'label' => esc_html__('Product Style', 'generic-elements'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'text_transform',
			[
				'label' => esc_html__( 'Text Transform', 'generic-elements' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'None', 'generic-elements' ),
					'uppercase' => esc_html__( 'UPPERCASE', 'generic-elements' ),
					'lowercase' => esc_html__( 'lowercase', 'generic-elements' ),
					'capitalize' => esc_html__( 'Capitalize', 'generic-elements' ),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
				],
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

		if (get_query_var('paged')) {
            $paged = get_query_var('paged');
        } else if (get_query_var('page')) {
            $paged = get_query_var('page');
        } else {
            $paged = 1;
        }

        // include_categories
        $category_list = '';
        if (!empty($settings['category'])) {
            $category_list = implode(", ", $settings['category']);
        }
        $category_list_value = explode(" ", $category_list);

        // exclude_categories
        $exclude_categories = '';
        if(!empty($settings['exclude_category'])){
            $exclude_categories = implode(", ", $settings['exclude_category']);
        }
        $exclude_category_list_value = explode(" ", $exclude_categories);

        $post__not_in = '';
        if (!empty($settings['post__not_in'])) {
            $post__not_in = $settings['post__not_in'];
            $args['post__not_in'] = $post__not_in;
        }
        $posts_per_page = (!empty($settings['posts_per_page'])) ? $settings['posts_per_page'] : '-1';
        $orderby = (!empty($settings['orderby'])) ? $settings['orderby'] : 'post_date';
        $order = (!empty($settings['order'])) ? $settings['order'] : 'desc';
        $offset_value = (!empty($settings['offset'])) ? $settings['offset'] : '0';
        $ignore_sticky_posts = (! empty( $settings['ignore_sticky_posts'] ) && 'yes' == $settings['ignore_sticky_posts']) ? true : false ;


        // number
        $off = (!empty($offset_value)) ? $offset_value : 0;
        $offset = $off + (($paged - 1) * $posts_per_page);
        $p_ids = array();

        // build up the array
        if (!empty($settings['post__not_in'])) {
            foreach ($settings['post__not_in'] as $p_idsn) {
                $p_ids[] = $p_idsn;
            }
        }

        $args = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => $posts_per_page,
            'orderby' => $orderby,
            'order' => $order,
            'offset' => $offset,
            'paged' => $paged,
            'post__not_in' => $p_ids,
            'ignore_sticky_posts' => $ignore_sticky_posts
        );

        // exclude_categories
        if ( !empty($settings['exclude_category'])) {

            // Exclude the correct cats from tax_query
            $args['tax_query'] = array(
                array(
                    'taxonomy'	=> 'product_cat',
                    'field'	 	=> 'slug',
                    'terms'		=> $exclude_category_list_value,
                    'operator'	=> 'NOT IN'
                )
            );

            // Include the correct cats in tax_query
            if ( !empty($settings['category'])) {
                $args['tax_query']['relation'] = 'AND';
                $args['tax_query'][] = array(
                    'taxonomy'	=> 'course-category',
                    'field'		=> 'slug',
                    'terms'		=> $category_list_value,
                    'operator'	=> 'IN'
                );
            }

        } else {
            // Include the cats from $cat_slugs in tax_query
            if (!empty($settings['category'])) {
                $args['tax_query'][] = [
                    'taxonomy' => 'product_cat',
                    'field' => 'slug',
                    'terms' => $category_list_value,
                ];
            }
        }

        $filter_list = $settings['category'];

        // The Query
        $query = new \WP_Query($args);

        // var_dump($query);


        ?>

        <?php if ( $settings['design_style']  == 'layout-2' ): ?>

        <?php else: ?>

        <!-- Product area start -->
        <section class="bd-product__area pt-120 pb-90">
            <div class="container">
                <div class="row">
                    <?php
                        // global $product;
                        while ($query->have_posts()) : $query->the_post();
                        global $product;
                        $terms = get_the_terms(get_the_ID(), 'product_cat');
                        $post_id = $product->get_id();
                    ?>
                    <div class="col-xl-<?php echo esc_attr($settings['generic_el_col_for_desktop']);?> col-lg-<?php echo esc_attr($settings['generic_el_col_for_laptop']);?> col-md-<?php echo esc_attr($settings['generic_el_col_for_tablet']);?> col-sm-<?php echo esc_attr($settings['generic_el_col_for_mobile']);?>">
                        <div class="bd-product__item text-center mb-30">
                            <?php if(!empty($settings['generic_el_image_show'])) : ?>
                            <div class="bd-product__img">
                                <?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?>
                            </div>
                            <?php endif; ?>

                            <div class="bd-product__content">
                                <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                                <?php if(!empty($settings['generic_el_prcie_show'])) : ?>
                                <span class="bd-product__new-price">
                                    <?php echo \Generic\Elements\Notices::product_price($post_id, true); ?>
                                </span>
                                <?php endif; ?>
                            </div>

                            <div class="bd-product__action">
                                <?php echo \Generic\Elements\Notices::add_to_cart_button($post_id);  ?>
                                <?php echo \Generic\Elements\Notices::quick_view_button($post_id);  ?>
                                <?php echo \Generic\Elements\Notices::wishlists_button($post_id);  ?>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; wp_reset_query(); ?>
                </div>
            </div>
        </section>
        <!-- Product area end -->


    	<?php endif; ?>

       <?php
	}

}
