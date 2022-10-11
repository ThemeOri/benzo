<?php
namespace BenzoToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Benzo_Date extends Widget_Base {

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
        return 'benzo-date';
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
        return esc_html__( 'Benzo Current Date', 'benzo-toolkit' );
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
        return 'eicon-date';
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
        return ['Benzo', 'Toolkit', 'Date', 'Current'];
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
            'date_format_select',
            [
                'label'   => esc_html__( 'Date Format', 'benzo-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'default'          => esc_html__( 'Default', 'benzo-toolkit' ),
                    'wordpress_format' => esc_html__( 'Wordpress Format', 'benzo-toolkit' ),
                    'custom'           => esc_html__( 'Custom', 'benzo-toolkit' ),
                ],
                'default' => 'default',
            ]
        );

        $this->add_control(
            'date_format_custom',
            [
                'label'       => esc_html__( 'Custom Date Format', 'benzo-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'condition'   => ['date_format_select' => 'custom'],
                'description' => esc_html__( 'Set your date format, about this, please refer to the ', 'benzo-toolkit' )
                . sprintf(
                    ' <a href="%1$s" target="_blank">%2$s</a>',
                    'https://wordpress.org/support/article/formatting-date-and-time/',
                    esc_html__( 'Wordpress.org', 'benzo-toolkit' )
                ),
                'label_block' => true,
                'default'     => 'F j, Y',
            ]
        );

        $this->add_control(
            'time_zone',
            [
                'label'   => esc_html__( 'Time Zone', 'benzo-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'UTC'                  => esc_html__( 'Default', 'benzo-toolkit' ),
                    'Pacific/Midway'       => esc_html__( '(GMT-11:00) Midway Island', 'benzo-toolkit' ),
                    'US/Samoa'             => esc_html__( '(GMT-11:00) Samoa', 'benzo-toolkit' ),
                    'US/Hawaii'            => esc_html__( '(GMT-10:00) Hawaii', 'benzo-toolkit' ),
                    'US/Alaska'            => esc_html__( '(GMT-09:00) Alaska', 'benzo-toolkit' ),
                    'US/Pacific'           => esc_html__( '(GMT-08:00) Pacific Time (US &amp; Canada)', 'benzo-toolkit' ),
                    'America/Tijuana'      => esc_html__( '(GMT-08:00) Tijuana', 'benzo-toolkit' ),
                    'US/Arizona'           => esc_html__( '(GMT-07:00) Arizona', 'benzo-toolkit' ),
                    'US/Mountain'          => esc_html__( '(GMT-07:00) Mountain Time (US &amp; Canada)', 'benzo-toolkit' ),
                    'America/Chihuahua'    => esc_html__( '(GMT-07:00) Chihuahua', 'benzo-toolkit' ),
                    'America/Mazatlan'     => esc_html__( '(GMT-07:00) Mazatlan', 'benzo-toolkit' ),
                    'America/Mexico_City'  => esc_html__( '(GMT-06:00) Mexico City', 'benzo-toolkit' ),
                    'America/Monterrey'    => esc_html__( '(GMT-06:00) Monterrey', 'benzo-toolkit' ),
                    'Canada/Saskatchewan'  => esc_html__( '(GMT-06:00) Saskatchewan', 'benzo-toolkit' ),
                    'US/Central'           => esc_html__( '(GMT-06:00) Central Time (US &amp; Canada)', 'benzo-toolkit' ),
                    'US/Eastern'           => esc_html__( '(GMT-05:00) Eastern Time (US &amp; Canada)', 'benzo-toolkit' ),
                    'US/East-Indiana'      => esc_html__( '(GMT-05:00) Indiana (East)', 'benzo-toolkit' ),
                    'America/Bogota'       => esc_html__( '(GMT-05:00) Bogota', 'benzo-toolkit' ),
                    'America/Lima'         => esc_html__( '(GMT-05:00) Lima', 'benzo-toolkit' ),
                    'America/Caracas'      => esc_html__( '(GMT-04:30) Caracas', 'benzo-toolkit' ),
                    'Canada/Atlantic'      => esc_html__( '(GMT-04:00) Atlantic Time (Canada)', 'benzo-toolkit' ),
                    'America/La_Paz'       => esc_html__( '(GMT-04:00) La Paz', 'benzo-toolkit' ),
                    'America/Santiago'     => esc_html__( '(GMT-04:00) Santiago', 'benzo-toolkit' ),
                    'Canada/Newfoundland'  => esc_html__( '(GMT-03:30) Newfoundland', 'benzo-toolkit' ),
                    'America/Buenos_Aires' => esc_html__( '(GMT-03:00) Buenos Aires', 'benzo-toolkit' ),
                    'Greenland'            => esc_html__( '(GMT-03:00) Greenland', 'benzo-toolkit' ),
                    'Atlantic/Stanley'     => esc_html__( '(GMT-02:00) Stanley', 'benzo-toolkit' ),
                    'Atlantic/Azores'      => esc_html__( '(GMT-01:00) Azores', 'benzo-toolkit' ),
                    'Atlantic/Cape_Verde'  => esc_html__( '(GMT-01:00) Cape Verde Is.', 'benzo-toolkit' ),
                    'Africa/Casablanca'    => esc_html__( '(GMT) Casablanca', 'benzo-toolkit' ),
                    'Europe/Dublin'        => esc_html__( '(GMT) Dublin', 'benzo-toolkit' ),
                    'Europe/Lisbon'        => esc_html__( '(GMT) Lisbon', 'benzo-toolkit' ),
                    'Europe/London'        => esc_html__( '(GMT) London', 'benzo-toolkit' ),
                    'Africa/Monrovia'      => esc_html__( '(GMT) Monrovia', 'benzo-toolkit' ),
                    'Europe/Amsterdam'     => esc_html__( '(GMT+01:00) Amsterdam', 'benzo-toolkit' ),
                    'Europe/Belgrade'      => esc_html__( '(GMT+01:00) Belgrade', 'benzo-toolkit' ),
                    'Europe/Berlin'        => esc_html__( '(GMT+01:00) Berlin', 'benzo-toolkit' ),
                    'Europe/Bratislava'    => esc_html__( '(GMT+01:00) Bratislava', 'benzo-toolkit' ),
                    'Europe/Brussels'      => esc_html__( '(GMT+01:00) Brussels', 'benzo-toolkit' ),
                    'Europe/Budapest'      => esc_html__( '(GMT+01:00) Budapest', 'benzo-toolkit' ),
                    'Europe/Copenhagen'    => esc_html__( '(GMT+01:00) Copenhagen', 'benzo-toolkit' ),
                    'Europe/Ljubljana'     => esc_html__( '(GMT+01:00) Ljubljana', 'benzo-toolkit' ),
                    'Europe/Madrid'        => esc_html__( '(GMT+01:00) Madrid', 'benzo-toolkit' ),
                    'Europe/Paris'         => esc_html__( '(GMT+01:00) Paris', 'benzo-toolkit' ),
                    'Europe/Prague'        => esc_html__( '(GMT+01:00) Prague', 'benzo-toolkit' ),
                    'Europe/Rome'          => esc_html__( '(GMT+01:00) Rome', 'benzo-toolkit' ),
                    'Europe/Sarajevo'      => esc_html__( '(GMT+01:00) Sarajevo', 'benzo-toolkit' ),
                    'Europe/Skopje'        => esc_html__( '(GMT+01:00) Skopje', 'benzo-toolkit' ),
                    'Europe/Stockholm'     => esc_html__( '(GMT+01:00) Stockholm', 'benzo-toolkit' ),
                    'Europe/Vienna'        => esc_html__( '(GMT+01:00) Vienna', 'benzo-toolkit' ),
                    'Europe/Warsaw'        => esc_html__( '(GMT+01:00) Warsaw', 'benzo-toolkit' ),
                    'Europe/Zagreb'        => esc_html__( '(GMT+01:00) Zagreb', 'benzo-toolkit' ),
                    'Europe/Athens'        => esc_html__( '(GMT+02:00) Athens', 'benzo-toolkit' ),
                    'Europe/Bucharest'     => esc_html__( '(GMT+02:00) Bucharest', 'benzo-toolkit' ),
                    'Africa/Cairo'         => esc_html__( '(GMT+02:00) Cairo', 'benzo-toolkit' ),
                    'Africa/Harare'        => esc_html__( '(GMT+02:00) Harare', 'benzo-toolkit' ),
                    'Europe/Helsinki'      => esc_html__( '(GMT+02:00) Helsinki', 'benzo-toolkit' ),
                    'Europe/Istanbul'      => esc_html__( '(GMT+02:00) Istanbul', 'benzo-toolkit' ),
                    'Asia/Jerusalem'       => esc_html__( '(GMT+02:00) Jerusalem', 'benzo-toolkit' ),
                    'Europe/Kiev'          => esc_html__( '(GMT+02:00) Kyiv', 'benzo-toolkit' ),
                    'Europe/Minsk'         => esc_html__( '(GMT+02:00) Minsk', 'benzo-toolkit' ),
                    'Europe/Riga'          => esc_html__( '(GMT+02:00) Riga', 'benzo-toolkit' ),
                    'Europe/Sofia'         => esc_html__( '(GMT+02:00) Sofia', 'benzo-toolkit' ),
                    'Europe/Tallinn'       => esc_html__( '(GMT+02:00) Tallinn', 'benzo-toolkit' ),
                    'Europe/Vilnius'       => esc_html__( '(GMT+02:00) Vilnius', 'benzo-toolkit' ),
                    'Asia/Baghdad'         => esc_html__( '(GMT+03:00) Baghdad', 'benzo-toolkit' ),
                    'Asia/Kuwait'          => esc_html__( '(GMT+03:00) Kuwait', 'benzo-toolkit' ),
                    'Africa/Nairobi'       => esc_html__( '(GMT+03:00) Nairobi', 'benzo-toolkit' ),
                    'Asia/Riyadh'          => esc_html__( '(GMT+03:00) Riyadh', 'benzo-toolkit' ),
                    'Europe/Moscow'        => esc_html__( '(GMT+03:00) Moscow', 'benzo-toolkit' ),
                    'Asia/Tehran'          => esc_html__( '(GMT+03:30) Tehran', 'benzo-toolkit' ),
                    'Asia/Baku'            => esc_html__( '(GMT+04:00) Baku', 'benzo-toolkit' ),
                    'Europe/Volgograd'     => esc_html__( '(GMT+04:00) Volgograd', 'benzo-toolkit' ),
                    'Asia/Muscat'          => esc_html__( '(GMT+04:00) Muscat', 'benzo-toolkit' ),
                    'Asia/Tbilisi'         => esc_html__( '(GMT+04:00) Tbilisi', 'benzo-toolkit' ),
                    'Asia/Yerevan'         => esc_html__( '(GMT+04:00) Yerevan', 'benzo-toolkit' ),
                    'Asia/Kabul'           => esc_html__( '(GMT+04:30) Kabul', 'benzo-toolkit' ),
                    'Asia/Karachi'         => esc_html__( '(GMT+05:00) Karachi', 'benzo-toolkit' ),
                    'Asia/Tashkent'        => esc_html__( '(GMT+05:00) Tashkent', 'benzo-toolkit' ),
                    'Asia/Kolkata'         => esc_html__( '(GMT+05:30) Kolkata', 'benzo-toolkit' ),
                    'Asia/Kathmandu'       => esc_html__( '(GMT+05:45) Kathmandu', 'benzo-toolkit' ),
                    'Asia/Yekaterinburg'   => esc_html__( '(GMT+06:00) Ekaterinburg', 'benzo-toolkit' ),
                    'Asia/Almaty'          => esc_html__( '(GMT+06:00) Almaty', 'benzo-toolkit' ),
                    'Asia/Dhaka'           => esc_html__( '(GMT+06:00) Dhaka', 'benzo-toolkit' ),
                    'Asia/Novosibirsk'     => esc_html__( '(GMT+07:00) Novosibirsk', 'benzo-toolkit' ),
                    'Asia/Bangkok'         => esc_html__( '(GMT+07:00) Bangkok', 'benzo-toolkit' ),
                    'Asia/Jakarta'         => esc_html__( '(GMT+07:00) Jakarta', 'benzo-toolkit' ),
                    'Asia/Krasnoyarsk'     => esc_html__( '(GMT+08:00) Krasnoyarsk', 'benzo-toolkit' ),
                    'Asia/Chongqing'       => esc_html__( '(GMT+08:00) Chongqing', 'benzo-toolkit' ),
                    'Asia/Hong_Kong'       => esc_html__( '(GMT+08:00) Hong Kong', 'benzo-toolkit' ),
                    'Asia/Kuala_Lumpur'    => esc_html__( '(GMT+08:00) Kuala Lumpur', 'benzo-toolkit' ),
                    'Australia/Perth'      => esc_html__( '(GMT+08:00) Perth', 'benzo-toolkit' ),
                    'Asia/Singapore'       => esc_html__( '(GMT+08:00) Singapore', 'benzo-toolkit' ),
                    'Asia/Taipei'          => esc_html__( '(GMT+08:00) Taipei', 'benzo-toolkit' ),
                    'Asia/Ulaanbaatar'     => esc_html__( '(GMT+08:00) Ulaan Bataar', 'benzo-toolkit' ),
                    'Asia/Urumqi'          => esc_html__( '(GMT+08:00) Urumqi', 'benzo-toolkit' ),
                    'Asia/Irkutsk'         => esc_html__( '(GMT+09:00) Irkutsk', 'benzo-toolkit' ),
                    'Asia/Seoul'           => esc_html__( '(GMT+09:00) Seoul', 'benzo-toolkit' ),
                    'Asia/Tokyo'           => esc_html__( '(GMT+09:00) Tokyo', 'benzo-toolkit' ),
                    'Australia/Adelaide'   => esc_html__( '(GMT+09:30) Adelaide', 'benzo-toolkit' ),
                    'Australia/Darwin'     => esc_html__( '(GMT+09:30) Darwin', 'benzo-toolkit' ),
                    'Asia/Yakutsk'         => esc_html__( '(GMT+10:00) Yakutsk', 'benzo-toolkit' ),
                    'Australia/Brisbane'   => esc_html__( '(GMT+10:00) Brisbane', 'benzo-toolkit' ),
                    'Australia/Canberra'   => esc_html__( '(GMT+10:00) Canberra', 'benzo-toolkit' ),
                    'Pacific/Guam'         => esc_html__( '(GMT+10:00) Guam', 'benzo-toolkit' ),
                    'Australia/Hobart'     => esc_html__( '(GMT+10:00) Hobart', 'benzo-toolkit' ),
                    'Australia/Melbourne'  => esc_html__( '(GMT+10:00) Melbourne', 'benzo-toolkit' ),
                    'Pacific/Port_Moresby' => esc_html__( '(GMT+10:00) Port Moresby', 'benzo-toolkit' ),
                    'Australia/Sydney'     => esc_html__( '(GMT+10:00) Sydney', 'benzo-toolkit' ),
                    'Asia/Vladivostok'     => esc_html__( '(GMT+11:00) Vladivostok', 'benzo-toolkit' ),
                    'Asia/Magadan'         => esc_html__( '(GMT+12:00) Magadan', 'benzo-toolkit' ),
                    'Pacific/Auckland'     => esc_html__( '(GMT+12:00) Auckland', 'benzo-toolkit' ),
                    'Pacific/Fiji'         => esc_html__( '(GMT+12:00) Fiji', 'benzo-toolkit' ),
                ],
                'default' => 'UTC',
            ]
        );

        $this->add_control(
            'date_align',
            [
                'label'       => esc_html__( 'Alignment', 'benzo-toolkit' ),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'toggle'      => true,
                'options'     => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'benzo-toolkit' ),
                        'icon'  => 'eicon-order-start',
                    ],
                    'center'     => [
                        'title' => esc_html__( 'Center', 'benzo-toolkit' ),
                        'icon'  => ' eicon-shrink',
                    ],
                    'right'   => [
                        'title' => esc_html__( 'Right', 'benzo-toolkit' ),
                        'icon'  => 'eicon-order-end',
                    ],
                ],
                'default'     => 'flex-start',
                'selectors'   => [
                    '{{WRAPPER}} .benzo-date' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'date_title_style',
            [
                'label'   => esc_html__( 'Title Style', 'benzo-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'text' => esc_html__( 'Text', 'benzo-toolkit' ),
                    'icon' => esc_html__( 'Icon', 'benzo-toolkit' ),
                ],
                'default' => 'date',
            ]
        );

        $this->add_control(
            'title_text',
            [
                'label'     => esc_html__( 'Title Text', 'benzo-toolkit' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => esc_html__( 'Date', 'benzo-toolkit' ),
                'condition' => [
                    'date_title_style' => 'text',
                ],
            ],
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'widget_style',
            [
                'label' => esc_html__( 'Style', 'benzo-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'date_color',
            [
                'label'     => esc_html__( 'Color', 'benzo-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .benzo-date' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'date_typography',
                'selector' => '{{WRAPPER}} .benzo-date',
            ]
        );
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

        $UTC   = new \DateTimeZone( "UTC" );
        $newTZ = new \DateTimeZone( $settings['time_zone'] );

        $date = new \DateTime( 'NOW', $UTC );
        $date->setTimezone( $newTZ );

        switch ( $settings['date_format_select'] ) {
        case 'default':
            $date_html = date_i18n( 'F j, Y' );
            break;

        case 'wordpress_format':
            $date_html = date_i18n( get_option( 'date_format' ) );
            break;

        default:
            $date_html = date_i18n( $settings['date_format_custom'] );
            break;
        }

        ?>

        <div class="benzo-date">
            <?php
                if ( 'icon' === $settings['date_title_style'] ) {
                    echo '<i class="far fa-clock"></i>';
                } else {
                    echo '<span>' . esc_html( $settings['title_text'] ) . '</span>';

                }
                echo esc_html( $date_html );
            ?>
        </div>

        <?php
    }
}