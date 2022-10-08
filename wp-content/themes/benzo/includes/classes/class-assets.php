<?php
namespace BenzoTheme\Classes;

defined( 'ABSPATH' ) || exit;

/**
 * Load Theme Assets
 */
class Benzo_Assets {

    protected static $instance = null;

    public static function instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function initialize() {
        add_action( 'wp_enqueue_scripts', [$this, 'enqueue_styles'] );
        add_action( 'wp_enqueue_scripts', [$this, 'enqueue_scripts'] );
        add_action( 'wp_enqueue_scripts', [$this, 'inline_css'] );
        add_action( 'admin_enqueue_scripts', [$this, 'enqueue_admin_styles'] );

        add_action( 'wp_head', [$this, 'custom_header_scripts'] );
        add_action( 'wp_footer', [$this, 'custom_footer_scripts'] );
    }

    /**
     * Load Google Font
     *
     * @return string
     */
    public function google_font_url() {
        $fonts_url     = '';
        $font_families = [];
        $subsets       = 'latin';

        $primary_font   = Benzo_Helper::get_option( 'primary_font', ['font-family' => ''] );
        $secondary_font = Benzo_Helper::get_option( 'secondary_font', ['font-family' => ''] );

        if ( '' == $primary_font || is_array( $primary_font ) && ! $primary_font['font-family'] ) {
            if ( 'off' !== _x( 'on', 'Inter', 'benzo' ) ) {
                $font_families[] = 'Inter:100,300,400,500,600,700,800,900';
            }
        }

        if ( '' == $primary_font || is_array( $secondary_font ) && ! $secondary_font['font-family'] ) {
            if ( 'off' !== _x( 'on', 'Roboto', 'benzo' ) ) { 
                $font_families[] = 'Roboto:100,300,400,500,700,900';
            }
        }

        if ( $font_families ) {
            $fonts_url = add_query_arg( [
                'family' => urlencode( implode( '|', $font_families ) ),
                'subset' => urlencode( $subsets ),
            ], 'https://fonts.googleapis.com/css' );
        }

        return esc_url_raw( $fonts_url );
    }

    /**
     * Enqueue Theme Style
     *
     * @return void
     */
    public function enqueue_styles() {
        wp_enqueue_style( 'benzo-fonts', $this->google_font_url(), [], null );
        wp_enqueue_style( 'fontawesome', BENZO_ASSETS . '/css/font-awesome.min.css', [], '5.14' );
        wp_enqueue_style( 'slick', BENZO_ASSETS . '/css/slick.min.css', [], '1.8.1' );
        wp_enqueue_style( 'magnific-popup', BENZO_ASSETS . '/css/magnific-popup.min.css', [], '1.1.0' );
        wp_enqueue_style( 'benzo-theme', BENZO_ASSETS . '/css/theme.min.css', [], BENZO_VERSION );
        wp_enqueue_style( 'benzo-style', get_stylesheet_uri(), [], BENZO_VERSION );
    }

    public function inline_css() {
        $primary_font    = Benzo_Helper::get_option( 'primary_font', ['font-family' => ''] );
        $secondary_font  = Benzo_Helper::get_option( 'secondary_font', ['font-family' => ''] );
        $primary_color   = Benzo_Helper::get_option( 'primary_color', '' );
        $secondary_color = Benzo_Helper::get_option( 'secondary_color', '' );
        $body_color      = Benzo_Helper::get_option( 'body_color', '' );
        $border_color    = Benzo_Helper::get_option( 'border_color', '' );
        $border_color    = Benzo_Helper::get_option( 'border_color', '' );
        $light_color     = Benzo_Helper::get_option( 'light_color', '' );

        $inline_css = [];

        if ( is_array( $primary_font ) && $primary_font['font-family'] ) {
            $inline_css[] = '--font-primary: ' . $primary_font['font-family'];
        } else {
            $inline_css[] = '--font-primary: Inter';
        }

        if ( is_array( $primary_font ) && $secondary_font['font-family'] ) {
            $inline_css[] = '--font-secondary: ' . $secondary_font['font-family'];
        } else {
            $inline_css[] = '--font-secondary: Roboto';
        }

        if ( ! empty( $primary_color ) ) {
            $inline_css[] = '--color-primary: ' . $primary_color;
        } else {
            $inline_css[] = '--color-primary: #005DE0';
        }

        if ( ! empty( $secondary_color ) ) {
            $inline_css[] = '--color-secondary: ' . $secondary_color;
        } else {
            $inline_css[] = '--color-secondary: #0F0F11';
        }

        if ( ! empty( $body_color ) ) {
            $inline_css[] = '--color-body: ' . $body_color;
        } else {
            $inline_css[] = '--color-body: #535353';
        }

        $inline_css[] = '--color-white: #ffffff';

        if ( ! empty( $border_color ) ) {
            $inline_css[] = '--color-border: ' . $border_color;
        } else {
            $inline_css[] = '--color-border: #EEF0F1';
        }

        if ( ! empty( $light_color ) ) {
            $inline_css[] = '--color-light: ' . $light_color;
        } else {
            $inline_css[] = '--color-light: #f6f6f6';
        }

        $output = '
        :root {
            ' . esc_attr( implode( '; ', $inline_css ) ) . '
        }
        ';

        wp_add_inline_style( 'benzo-theme', $output );
    }

    /**
     * Enqueue Theme Scripts
     *
     * @return void
     */
    public function enqueue_scripts() {
        wp_enqueue_script( 'slick', BENZO_ASSETS . '/js/slick.min.js', ['jquery'], '1.8.1', true );
        wp_enqueue_script( 'magnific-popup', BENZO_ASSETS . '/js/magnific-popup.min.js', ['jquery'], '1.1.0', true );
        wp_enqueue_script( 'benzo-theme', BENZO_ASSETS . '/js/theme.min.js', ['jquery'], BENZO_VERSION, true );

        wp_localize_script(
            'benzo-theme',
            'benzoLocalize', [
                'ajax_url' => admin_url( 'admin-ajax.php' ),
            ]
        );

        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }
    }

    public function enqueue_admin_styles() {
        wp_enqueue_style( 'benzo-admin', BENZO_ASSETS . '/css/admin.min.css', [], BENZO_VERSION, 'all' );
    }

    /**
     * Custom Header Scripts
     */
    public function custom_header_scripts() {
        if ( '' !== Benzo_Helper::get_option( 'custom_header_scripts' ) ): ?>
            <script>
                <?php echo Benzo_Helper::get_option( 'custom_header_scripts' ); ?>
            </script>
        <?php endif;
    }

    /**
     * Custom Scripts
     */
    public function custom_footer_scripts() {
        if ( '' !== Benzo_Helper::get_option( 'custom_footer_scripts' ) ): ?>
            <script>
                <?php echo Benzo_Helper::get_option( 'custom_footer_scripts' ); ?>
            </script>
        <?php endif;
    }
}

Benzo_Assets::instance()->initialize();