<?php
namespace Generic\Elements;

class Notices {
    public function run() {
      	// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

        // Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, GENERIC_ELEMENTS_MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_generic_elements_minimum_elementor_version' ] );
			return;
		}

        // Check for required PHP version
		if ( version_compare( PHP_VERSION, GENERIC_ELEMENTS_MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_generic_elements_minimum_php_version' ] );
			return;
		}
    }

    /**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'generic-elements' ),
			'<strong>' . esc_html__( 'Generic Elements', 'generic-elements' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'generic-elements' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

    /**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_generic_elements_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'generic-elements' ),
			'<strong>' . esc_html__( 'Bdevs Element', 'generic-elements' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'generic-elements' ) . '</strong>',
			 GENERIC_ELEMENTS_MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

    /**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_generic_elements_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'generic-elements' ),
			'<strong>' . esc_html__( 'Bdevs Element', 'generic-elements' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'generic-elements' ) . '</strong>',
			 GENERIC_ELEMENTS_MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}



	// For Generic Elements Woocommerce specially WooProduct Widget

	/**
     * Instance
     *
     * @since 1.0.0
     *
     * @access private
     * @static
     *
     */
    private static $_instance = null;

    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @since 1.0.0
     *
     * @access public
     * @static
     *
     */

    public static function instance()
    {

        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;

    }


	// category_list
    public static function category_list()
    {
        $args = [
            'number' => 100,
        ];

        $list = array('Select Category' => '');

        if (BDEVSEL_WOOCOMMERCE_ACTIVED) {

            $product_categories = get_terms('product_cat', $args);
            if (!empty($product_categories)) {

                foreach ($product_categories as $product_categorie) {
                    $list[$product_categorie->name] = $product_categorie->slug;
                }
            }
        }

        return $list;
    }

	// add_to_cart_button
    public static function add_to_cart_button($product_id)
    {

        woocommerce_template_loop_add_to_cart();
    }


	// quick_view_button
    public static function quick_view_button($product_id) {
        if( class_exists( 'WPCleverWoosq' ) ){
            echo do_shortcode('[woosq]');
        }
    }

    // wishlist_button
    public static function wishlists_button($product_id) {

        if( class_exists( 'TInvWL_Admin_TInvWL' ) ){
            echo do_shortcode( '[ti_wishlists_addtowishlist]' );
        }
    }

    // product_price
    public static function product_price($product_id, $oldp = false)
    {

        $product = wc_get_product($product_id);

        return $product->get_price_html();

    }

    // product_price_sale
    public static function product_price_sale($product_id, $oldp = false)
    {

        $product = wc_get_product($product_id);
        $woo_sale_tag = get_theme_mod('woo_sale_tag', 'Sale');

        $price = $product->get_regular_price();
        $old = '';

        if ($product->get_sale_price() != '') {
            if ($oldp) {
                return '<span class="sale-text">' . $woo_sale_tag . '</span> ';
            }
            else{
                '';
            }
        }
        return false;
    }

	// product_rating
    public static function product_rating($product_id)
    {

        $product = wc_get_product($product_id);
        $rating = $product->get_average_rating();
        $review = 'Rating ' . $rating . ' out of 5';
        $html   = '';
        $html   .= '<div class="details-rating mb-10" title="' . $review . '">';
        for ( $i = 0; $i <= 4; $i ++ ) {
            if ( $i < floor( $rating ) ) {
                $html .= '<i class="fas fa-star"></i>';
            } else {
                $html .= '<i class="far fa-star"></i>';
            }
        }

        $html .= '</div>';

        return $html;
    }

    function generic_el_woo_rating() {
        global $product;
        $rating = $product->get_average_rating();
        $review = 'Rating ' . $rating . ' out of 5';
        $html   = '';
        $html   .= '<div class="details-rating mb-10" title="' . $review . '">';
        for ( $i = 0; $i <= 4; $i ++ ) {
            if ( $i < floor( $rating ) ) {
                $html .= '<i class="fas fa-star"></i>';
            } else {
                $html .= '<i class="far fa-star"></i>';
            }
        }
        $html .= '<span>( ' . $rating . ' out of 5 )</span>';
        $html .= '</div>';
        print generic_el_woo_rating_html( $html );
    }

    function generic_el_woo_rating_html( $html ) {
        return $html;
    }


    /**
     * taxonomy category
     */
    public static function product_get_terms($id, $tax)
    {

        $terms = get_the_terms(get_the_ID(), $tax);

        $list = '';
        if ($terms && !is_wp_error($terms)) :
            $i = 1;
            $cats_count = count($terms);

            foreach ($terms as $term) {
                $exatra = ($cats_count > $i) ? ', ' : '';
                $list .= $term->name . $exatra;
                $i++;
            }
        endif;

        return trim($list, ',');
    }


}