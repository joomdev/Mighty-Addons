<?php
namespace MightyAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils as Utils;
use Elementor\Repeater as Repeater;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;
use \Elementor\Scheme_Typography;
use \Elementor\Scheme_Color;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor MT_OpeningHours
 *
 * Elementor widget for MT_OpeningHours.
 *
 * @since 1.0.0
 */
class MT_OpeningHours extends Widget_Base {
	
	public function get_name() {
		return 'mt-openinghours';
	}
	
	public function get_title() {
		return __( 'MT Opening Hours', 'mighty' );
	}
	
	public function get_icon() {
		return 'fas fa-clock';
	}

	public function get_categories() {
		return [ 'mighty-addons' ];
	}

	public function get_style_depends() {
		return [ 'mt-common', 'mt-openinghours' ];
    }
	
	protected function _register_controls() {

        $this->start_controls_section(
			'section_openinghours',
			[
				'label' => __( 'MT Opening Hours', 'mighty' ),
			]
        );
        
            $repeater = new Repeater();

            $repeater->start_controls_tabs( 'business_days_timings' );

                $repeater->add_control(
                    'business_day',
                    [
                        'label' => __('Enter Day', 'mighty'),
                        'type' => Controls_Manager::TEXT,
                        'default' => 'Monday',
                    ]
                );

                $repeater->add_control(
                    'business_time',
                    [
                        'label' => __('Enter Time', 'mighty'),
                        'type' => Controls_Manager::TEXT,
                        'default' => 'Always Open',
                    ]
                );

                $repeater->add_control(
                    'enable_styling',
                    [
                        'label' => __( 'Enable Styling', 'mighty' ),
                        'type' => Controls_Manager::SWITCHER,
                        'label_on' => __( 'On', 'mighty' ),
                        'label_off' => __( 'Off', 'mighty' ),
                        'return_value' => 'true',
                        'default' => 'true',
                    ]
                );

                $repeater->add_control(
                    'day_color',
                    [
                        'label' => __( 'Day Color', 'mighty' ),
                        'type' => Controls_Manager::COLOR,
                        'scheme' => [
                            'type' => Scheme_Color::get_type(),
                            'value' => Scheme_Color::COLOR_1,
                        ],
                        'selectors' => [
                            '{{WRAPPER}}' => 'color: {{VALUE}}',
                        ],
                        'condition' => [
                            'enable_styling' => 'true',
                        ],
                    ]
                );

                $repeater->add_control(
                    'time_color',
                    [
                        'label' => __( 'Time Color', 'mighty' ),
                        'type' => Controls_Manager::COLOR,
                        'scheme' => [
                            'type' => Scheme_Color::get_type(),
                            'value' => Scheme_Color::COLOR_1,
                        ],
                        'selectors' => [
                            '{{WRAPPER}}' => 'color: {{VALUE}}',
                        ],
                        'condition' => [
                            'enable_styling' => 'true',
                        ],
                    ]
                );

                $repeater->add_control(
                    'oh_bg_color',
                    [
                        'label' => __( 'Background Color', 'mighty' ),
                        'type' => Controls_Manager::COLOR,
                        'scheme' => [
                            'type' => Scheme_Color::get_type(),
                            'value' => Scheme_Color::COLOR_1,
                        ],
                        'selectors' => [
                            '{{WRAPPER}}' => 'color: {{VALUE}}',
                        ],
                        'condition' => [
                            'enable_styling' => 'true',
                        ],
                    ]
                );

                $this->add_control(
                    'mt_openinghours_data',
                    [
                        'label' => __('Business Days & Timings', 'mighty'),
                        'type' => Controls_Manager::REPEATER,
                        'fields' => $repeater->get_controls(),
                        'default' => [
                            [
                                'business_day' => __('Monday', 'mighty'),
                                'business_time' => __('10 AM - 5 PM', 'mighty'),
                                'enable_styling' => 'false',
                                'day_color' => '#000',
                                'time_color' => '#000',
                                'oh_bg_color' => '#fff',
                            ],
                            [
                                'business_day' => __('Tuesday', 'mighty'),
                                'business_time' => __('10 AM - 5 PM', 'mighty'),
                                'enable_styling' => 'false',
                                'day_color' => '#000',
                                'time_color' => '#000',
                                'oh_bg_color' => '#fff',
                            ],
                            [
                                'business_day' => __('Wednesday', 'mighty'),
                                'business_time' => __('10 AM - 5 PM', 'mighty'),
                                'enable_styling' => 'false',
                                'day_color' => '#000',
                                'time_color' => '#000',
                                'oh_bg_color' => '#fff',
                            ],
                            [
                                'business_day' => __('Thursday', 'mighty'),
                                'business_time' => __('10 AM - 5 PM', 'mighty'),
                                'enable_styling' => 'false',
                                'day_color' => '#000',
                                'time_color' => '#000',
                                'oh_bg_color' => '#fff',
                            ],
                            [
                                'business_day' => __('Friday', 'mighty'),
                                'business_time' => __('10 AM - 5 PM', 'mighty'),
                                'enable_styling' => 'false',
                                'day_color' => '#000',
                                'time_color' => '#000',
                                'oh_bg_color' => '#fff',
                            ],
                            [
                                'business_day' => __('Saturday', 'mighty'),
                                'business_time' => __('Closed', 'mighty'),
                                'enable_styling' => 'false',
                                'day_color' => '#bb0f0f',
                                'time_color' => '#bb0f0f',
                                'oh_bg_color' => '#fff',
                            ],
                            [
                                'business_day' => __('Sunday', 'mighty'),
                                'business_time' => __('Closed', 'mighty'),
                                'enable_styling' => 'false',
                                'day_color' => '#bb0f0f',
                                'time_color' => '#bb0f0f',
                                'oh_bg_color' => '#fff',
                            ],
                        ],
                        'title_field' => '{{{ business_day }}}',
                    ]
                );
			
            $repeater->end_controls_tabs();

            $this->add_control(
                'footer_text',
                [
                    'label' => __('Footer Text', 'mighty'),
                    'type' => Controls_Manager::TEXT,
                    'default' => 'Come in we\'re open!',
                ]
            );

        $this->end_controls_section();
        
	}
	
	protected function render() {
        $settings = $this->get_settings_for_display();

        if ( empty( $settings[ 'MT_OpeningHours'] ) ) {
            return;
		}
        ?>

        <div class="mt-openinghours-wrapper">

        </div>
        <?php
	}
	
	protected function _content_template() {
	}
}
