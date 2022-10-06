<?php

namespace BenzoTheme\Classes;

defined( 'ABSPATH' ) || exit;

/**
 * Initial Helper functions for this theme.
 */
class Benzo_Helper {
    /**
     * Get Theme Options
     *
     * @param $option Required Option id
     * @param $default Optional set default value
     *
     * @return mixed
     */
    public static function get_option( $option, $default = null ) {
        $options = get_option( 'benzo_options' );
        return ( isset( $options[$option] ) ) ? $options[$option] : $default;
    }

    /**
     * Get a metaboxes
     *
     * @param $prefix_key Required Meta unique slug
     * @param $meta_key Required Meta slug
     * @param $default Optional Set default value
     * @param $id Optional Set post id
     *
     * @return mixed
     */
    public static function get_meta( $prefix_key, $meta_key, $default = null, $id = '' ) {
        if ( ! $id ) {
            $id = get_the_ID();
        }

        $meta_boxes = get_post_meta( $id, $prefix_key, true );
        return ( isset( $meta_boxes[$meta_key] ) ) ? $meta_boxes[$meta_key] : $default;
    }

    /**
     * Get content layout
     *
     * @return string
     */
    public static function content_layout() {
        $layout = 'boxed-layout';

        if ( is_page() ) {
            $page_layout = self::get_meta( 'benzo_page_meta', 'content_layout', 'boxed-layout' );
            $layout      = $page_layout;
        } elseif ( is_single() && 'post' === get_post_type() ) {
            $layout      = self::get_option( 'blog_details_layout', 'boxed-layout' );
            $post_layout = self::get_meta( 'benzo_post_meta', 'post_details_layout', 'default' );

            if ( 'default' !== $post_layout ) {
                $layout = $post_layout;
            }
        } elseif ( ! is_page() ) {
            $layout = self::get_option( 'blog_archive_layout', 'boxed-layout' );
        }

        return $layout;
    }

    /**
     * Get Content Sidebar
     *
     * @return string
     */
    public static function content_sidebar() {
        $sidebar = 'right-sidebar';

        if ( is_page() ) {
            $page_sidebar = self::get_meta( 'benzo_page_meta', 'content_sidebar', 'no-sidebar' );
            $sidebar      = $page_sidebar;
        } elseif ( is_single() && 'post' === get_post_type() ) {
            $sidebar      = self::get_option( 'blog_details_sidebar', 'right-sidebar' );
            $post_sidebar = self::get_meta( 'benzo_post_meta', 'post_details_sidebar', 'default' );

            if ( 'default' !== $post_sidebar ) {
                $sidebar = $post_sidebar;
            }
        } elseif ( ! is_page() ) {
            $sidebar = self::get_option( 'blog_archive_sidebar', 'right-sidebar' );
        }

        if ( ! is_active_sidebar( 'primary_sidebar' ) ) {
            $sidebar = 'no-sidebar';
        }

        return $sidebar;
    }

    /**
     * Set Container Class
     *
     * @return string|string[] $classes Space-separated string or array of class.
     */
    public static function container_class() {
        $classes = ['content-container'];

        if ( 'full-width-layout' === self::content_layout() ) {
            $classes[] = 'full-width';
        }

        echo esc_attr( implode( ' ', $classes ) );
    }

    /**
     * Set Container Inner classes
     *
     * @return string|string[] $classes Space-separated string or array of class.
     */
    public static function content_wrap_class() {
        $classes = ['content-wrapper'];

        if ( 'left-sidebar' === self::content_sidebar() ) {
            $classes[] = 'left-sidebar';
        } elseif ( 'right-sidebar' === self::content_sidebar() ) {
            $classes[] = 'right-sidebar';
        } elseif ( 'no-sidebar' === self::content_sidebar() ) {
            $classes[] = 'no-sidebar';
        }

        // return the $classes array
        echo esc_attr( implode( ' ', $classes ) );
    }

    /**
     * Check Theme Default Header
     */
    public static function check_default_header() {
        $default_header = self::get_option( 'default_header', 'enabled' );

        if ( is_page() ) {
            $page_default_header = self::get_meta( 'benzo_page_meta', 'page_default_header', 'default' );

            if ( 'default' !== $page_default_header ) {
                $default_header = $page_default_header;
            }
        } elseif ( is_single() && 'post' === get_post_type() ) {
            $post_default_header = self::get_meta( 'benzo_post_meta', 'post_default_header', 'default' );

            if ( 'default' !== $post_default_header ) {
                $default_header = $post_default_header;
            }
        }

        return $default_header;
    }

    /**
     * Check Default Footer
     *
     * @return void
     */
    public static function check_default_footer() {
        $default_footer = self::get_option( 'default_footer', 'enabled' );

        if ( is_page() ) {
            $page_default_footer = self::get_meta( 'benzo_page_meta', 'page_default_footer', 'default' );

            if ( 'default' !== $page_default_footer ) {
                $default_footer = $page_default_footer;
            }
        } elseif ( is_single() && 'post' === get_post_type() ) {
            $post_default_footer = self::get_meta( 'benzo_post_meta', 'post_default_footer', 'default' );

            if ( 'default' !== $post_default_footer ) {
                $default_footer = $post_default_footer;
            }
        }

        return $default_footer;
    }

    /**
     * Check Sticky Header
     *
     * @return string
     */
    public static function sticky_header() {
        $site_sticky_header = self::get_option( 'site_sticky_header', 'enabled' );

        if ( is_page() ) {
            $page_sticky_header = self::get_meta( 'benzo_page_meta', 'page_sticky_header', 'default' );

            if ( 'default' !== $page_sticky_header ) {
                $site_sticky_header = $page_sticky_header;
            }
        } elseif ( is_single() && 'post' === get_post_type() ) {
            $post_sticky_header = self::get_meta( 'benzo_post_meta', 'post_sticky_header', 'default' );

            if ( 'default' !== $post_sticky_header ) {
                $site_sticky_header = $post_sticky_header;
            }
        }

        return $site_sticky_header;
    }

    /**
     * Get Elementor content for display
     *
     * @param int $content_id
     */
    public static function get_elementor_content( $content_id ) {
        $content = '';
        if ( \class_exists( '\Elementor\Plugin' ) ) {
            $elementor_instance = \Elementor\Plugin::instance();
            $content            = $elementor_instance->frontend->get_builder_content_for_display( $content_id );
        }
        return $content;
    }

    /**
     * Render Column
     *
     * @param string $lg_column
     * @param string $md_column
     * @param string $sm_column
     *
     * @return string
     */
    public static function render_column( $lg_column = '3', $md_column = '2', $sm_column = '1' ) {
        $classes = [];

        if ( '1' === $lg_column ) {
            $classes[] = 'col-lg-12';
        } elseif ( '2' === $lg_column ) {
            $classes[] = 'col-lg-6';
        } elseif ( '3' === $lg_column ) {
            $classes[] = 'col-lg-4';
        } elseif ( '4' === $lg_column ) {
            $classes[] = 'col-lg-3';
        } elseif ( '6' === $lg_column ) {
            $classes[] = 'col-lg-2';
        } else {
            $classes[] = 'col-lg-4';
        }

        if ( '1' === $md_column ) {
            $classes[] = 'col-md-12';
        } elseif ( '2' === $md_column ) {
            $classes[] = 'col-md-6';
        } elseif ( '3' === $md_column ) {
            $classes[] = 'col-md-4';
        } elseif ( '4' === $md_column ) {
            $classes[] = 'col-md-3';
        } elseif ( '6' === $md_column ) {
            $classes[] = 'col-md-2';
        } else {
            $classes[] = 'col-md-4';
        }

        if ( '1' === $sm_column ) {
            $classes[] = 'col-12';
        } elseif ( '2' === $sm_column ) {
            $classes[] = 'col-6';
        } elseif ( '3' === $sm_column ) {
            $classes[] = 'col-4';
        } elseif ( '4' === $sm_column ) {
            $classes[] = 'col-3';
        } elseif ( '6' === $sm_column ) {
            $classes[] = 'col-2';
        } else {
            $classes[] = 'col-4';
        }

        return implode( ' ', $classes );
    }
}
