<?php 
namespace BdevsElement;

class Helper {

    /** 
    * Get widgets list
    */
    public static function get_widgets() {

        return [
            'advanced-price' => [
                'title' => __( 'Advanced Price', 'bdevselement' ),
                'icon' => 'eicon-tabs',
                'ispro' =>true
            ],
            'hero' => [
                'title' => __( 'hero', 'bdevselement' ),
                'icon' => 'eicon-tabs',
                'ispro' =>true
            ],

            'cta' => [
                'title' => __( 'CTA', 'bdevselement' ),
                'icon' => 'fa fa-time',
                'ispro' =>true
            ], 
            
            'faq' => [
                'title' => __( 'FAQ', 'bdevselement' ),
                'icon' => 'fa fa-card',
                'ispro' =>true
            ],
            'service-carousel' => [
                'title' => __( 'Service Carousel', 'bdevselement' ),
                'icon' => 'fa fa-card',
                'ispro' =>true
            ],    
            'skill' => [
                'title' => __( 'Skill', 'bdevselement' ),
                'icon' => 'fa fa-card',
                'ispro' =>true
            ],                                                        

            'about' => [
                'title' => __( 'About', 'bdevselement' ),
                'icon' => 'fa fa-card',
                'ispro' =>true
            ],
            'about-tab' => [
                'title' => __( 'About Tab', 'bdevselement' ),
                'icon' => 'fa fa-card',
                'ispro' =>true
            ],

            'brand' => [
                'title' => __( 'Brand', 'bdevselement' ),
                'icon' => 'fa fa-card',
                'ispro' =>true
            ],
            'service' => [
                'title' => __( 'Service', 'bdevselement' ),
                'icon' => 'fa fa-card',
                'ispro' =>true
            ],          

            'cf7' => [
                'title' => __( 'Contact Form 7', 'bdevselement' ),
                'icon' => 'fa fa-form',
            ],

            'contact-info' => [
                'title' => __( 'Contact Info', 'bdevselement' ),
                'icon' => 'fa fa-form',
            ],

            'heading' => [
                'title' => __( 'Heading Title', 'bdevselement' ),
                'icon' => 'fa fa-icon-box',
            ],
            'icon_box' => [
                'title' => __( 'Icon Box', 'bdevselement' ),
                'icon' => 'fa fa-blog-content',
            ],

            'member-slider' => [
                'title' => __( 'Team Member Slider', 'bdevselement' ),
                'icon' => 'fa fa-team-member',
            ],             

            'list-item' => [
                'title' => __( 'List Item', 'bdevselement' ),
                'icon' => 'fa fa-team-member',
            ],

            'fact' => [
                'title' => __( 'Fact', 'bdevselement' ),
                'icon' => 'fa fa-team-member',
            ],

            'pricing-table' => [
                'title' => __( 'Pricing Table', 'bdevselement' ),
                'icon' => 'fa fa-file-cabinet',
            ],

            'slider' => [
                'title' => __( 'Slider', 'bdevselement' ),
                'icon' => 'fa fa-image-slider',
            ],

            'featured-list' => [
                'title' => __( 'Featured List', 'bdevselement' ),
                'icon' => 'fa fa-flip-card',
            ],            

            'post-list' => [
                'title' => __( 'Post List', 'bdevselement' ),
                'icon' => 'fa fa-post-list',
            ],            

            'project' => [
                'title' => __( 'Project', 'bdevselement' ),
                'icon' => 'fa fa-post-tab',
            ],  
            'testimonial-slider' => [
                'title' => __( 'Testimonial Slider', 'bdevselement' ),
                'icon' => 'fa fa-testimonial',
                'css' => ['testimonial'],
                'js' => [],
                'vendor' => [
                    'css' => [],
                    'js' => [],
                ],
            ],
            'video-info' => [
                'title' => __( 'Video Info', 'bdevselement' ),
                'icon' => 'eicon-posts-ticker',
                'ispro' =>true
            ],
    
            'woo-product' => [
                'title' => __( 'Woo Product', 'bdevselement' ),
                'icon' => 'fa fa-card'
            ],
            'woo-product-cat' => [
                'title' => __( 'Woo Product cat', 'bdevselement' ),
                'icon' => 'fa fa-card'
            ],
            'woo-catcarousel' => [
                'title' => __( 'Woo Catcarousel', 'bdevselement' ),
                'icon' => 'eicon-tabs',
                'ispro' =>true
            ],
            'woo-product-tab' => [
                'title' => __( 'Woo Product Tab', 'bdevselement' ),
                'icon' => 'fa fa-card'
            ],
            'subscribe' => [
                'title' => __( 'Subscribe', 'bdevselement' ),
                'icon' => 'fa fa-icon-box',
            ],
            'service-slider' => [
                'title' => __( 'Service Slider', 'bdevselement' ),
                'icon' => 'fa fa-card'
            ],
        ];
    }


    /**
    *  Get Tutor Course widgets list   
    **/

    public static function get_tutor_course_widgets() { 
        return [
            'course-list' => [
                'title' => __('Tutor Course List', 'bdevselement'),
                'icon' => 'fa fa-post-list',
            ],

            'course-tab' => [
                'title' => __('Tutor Course Tab', 'bdevselement'),
                'icon' => 'fa fa-post-tab',
            ]
        ];
    }


    /**
    *  Get Learpress Course widgets list   
    **/

    public static function get_learnpress_course_widgets() { 
        return [
            'learnpress-course-list' => [
                'title' => __( 'LearnPress Course List', 'bdevselement' ),
                'icon' => 'fa fa-post-list',
            ],
            'learnpress-course-tab' => [
                'title' => __( 'LearnPress Course Tab', 'bdevselement' ),
                'icon' => 'fa fa-post-tab',
            ]
        ];
    }


    /**
    *  Get Leardash Course widgets list   
    **/

    public static function get_learndash_course_widgets() { 
        return [
            'learndash-course-list' => [
                'title' => __( 'Learndash Course List', 'bdevselement' ),
                'icon' => 'fa fa-post-list',
            ],
            'learndash-course-tab' => [
                'title' => __( 'Learndash Course Tab', 'bdevselement' ),
                'icon' => 'fa fa-post-tab',
            ]
        ];
    }

    
    /**
    *  Get WooCommerce widgets list   
    **/
    public static function get_woo_widgets() { 

        return [
            'woo-product' => [
                'title' => __( 'Woo Product', 'bdevselement' ),
                'icon' => 'fa fa-card'
            ]

        ];
    }
}