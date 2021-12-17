<?php
namespace MightyAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils as Utils;
use Elementor\Repeater as Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor MT_howto
 *
 * Elementor widget for MT_howto.
 *
 * @since 1.0.0
 */
class MT_howto extends Widget_Base {

	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
	
		// wp_register_style( 'mighty-agecheckercss', MIGHTY_ADDONS_PLG_URL . 'assets/css/age-checker.css', false, MIGHTY_ADDONS_VERSION );
		
		// wp_register_script( 'mighty-age-checkerjs', MIGHTY_ADDONS_PLG_URL . 'assets/js/age-checker.js', [ 'jquery' ], MIGHTY_ADDONS_VERSION );
	}
	
	public function get_name() {
		return 'mt-howto';
	}
	
	public function get_title() {
		return __( 'How To', 'mighty' );
	}
	
	public function get_icon() {
		return 'mf mf-howto';
	}

	public function get_categories() {
		return [ 'mighty-addons' ];
	}

	public function get_keywords() {
		return [ 'mighty', 'howto' ];
    }
	
	public function get_script_depends() {
		// return [ 'mighty-age-checkerjs' ];
	}

	public function get_style_depends() {
		// return [ 'mighty-agecheckercss' ];
	}

    protected function register_controls() {

        $this->start_controls_section(
			'section_agechecker_basic',
			[
				'label' => __( 'Basic', 'mighty' ),
			]
		);

            $this->add_control(
                'enable_schema', [
                    'label' => __( 'Enable How To Schema', 'mighty' ),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                    'description' => 'Enble it if you want to add How to page schema on your page. To use schema markup, your page must have only single instance of HowTo widget.	Use JSON method',
                ]
            );

        $this->end_controls_section();

        // start How To
        $this->start_controls_section(
			'section_Howto',
			[
				'label' => __( 'How To', 'mighty' ),
			]
		);

            $this->add_control(
                'how_to_title',
                [
                    'label' => __('Title', 'mighty'),
                    'type' => Controls_Manager::TEXT,
                    'default' => 'How To',
                    'dynamic' => [ 'active' => true ],
                ]
            );

            $this->add_control(
                'how_to_subtitle',
                [
                    'label' => __('Subtitle', 'mighty'),
                    'type' => Controls_Manager::TEXT,
                    'dynamic' => [ 'active' => true ],
                ]
            );

            $this->add_control(
                'how_to_description',
                [
                    'label' => __('Description', 'mighty'),
                    'type' => Controls_Manager::TEXTAREA,
                    'dynamic' => [ 'active' => true ],
                ]
            );

            $this->add_control(
                'how_to_image',
                [
                    'label' => __( 'Image', 'mighty' ),
                    'type' => Controls_Manager::MEDIA,
                    'dynamic' => [ 'active' => true ],
                ]
            );

            $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'how_to_image_size', 
                    'exclude' => [ 'custom' ],
                    'include' => [],
                    'default' => 'large',
                ]
            );

            $this->add_control(
                'how_to_image_link',
                [
                    'label' => __( 'Link', 'plugin-domain' ),
                    'type' => Controls_Manager::URL,
                    'placeholder' => __( 'https://your-link.com', 'plugin-domain' ),
                    'show_external' => true,
                    'default' => [
                        'url' => '',
                        'is_external' => true,
                        'nofollow' => true,
                    ],
                    'dynamic' => [ 'active' => true ],
                ]
            );

            $this->add_control(
                'how_to_advance_option', [
                    'label' => __( 'Advance Options', 'mighty' ),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'no',
                ]
            );

        $this->end_controls_section();

        // Extra
        $this->start_controls_section(
			'section_advance_option',
			[
				'label' => __( 'Advance Options', 'mighty' ),
                'condition' => [
                    'how_to_advance_option' => 'yes'
                ],
			]
		);

            $this->add_control(
                'how_to_total_time', [
                    'label' => __( 'Add Total Time', 'mighty' ),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'no'
                ]
            );

            $this->add_control(
                'how_to_duration',
                [
                    'type' =>Controls_Manager::DIVIDER,
                ]
            );

            $this->add_control(
                'how_to_total_time_text',
                [
                    'label' => __('Total Time Text', 'mighty'),
                    'type' => Controls_Manager::TEXT,
                    'default' => 'Time Needed:',
                    'dynamic' => [ 'active' => true ],
                    'condition' => [
                        'how_to_total_time' => 'yes'
                    ],
                ]
            );

            $this->add_control(
                'duration_options',
                [
                    'label' => esc_html__( 'Duration', 'mighty' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'how_to_total_time' => 'yes'
                    ],
                ]
            );

            $this->add_control(
                'duration_year',
                [
                    'label' => __('Years', 'mighty'),
                    'type' => Controls_Manager::NUMBER,
                    'dynamic' => [ 'active' => true ],
                    'condition' => [
                        'how_to_total_time' => 'yes'
                    ],
                ]
            );

            $this->add_control(
                'duration_month',
                [
                    'label' => __('Months', 'mighty'),
                    'type' => Controls_Manager::NUMBER,
                    'dynamic' => [ 'active' => true ],
                    'condition' => [
                        'how_to_total_time' => 'yes'
                    ],
                ]
            );

            $this->add_control(
                'duration_days',
                [
                    'label' => __('Days', 'mighty'),
                    'type' => Controls_Manager::NUMBER,
                    'dynamic' => [ 'active' => true ],
                    'condition' => [
                        'how_to_total_time' => 'yes'
                    ],
                ]
            );

            $this->add_control(
                'duration_hours',
                [
                    'label' => __('Hours', 'mighty'),
                    'type' => Controls_Manager::NUMBER,
                    'dynamic' => [ 'active' => true ],
                    'condition' => [
                        'how_to_total_time' => 'yes'
                    ],
                ]
            );

            $this->add_control(
                'duration_minutes',
                [
                    'label' => __('Minutes', 'mighty'),
                    'type' => Controls_Manager::NUMBER,
                    'dynamic' => [ 'active' => true ],
                    'condition' => [
                        'how_to_total_time' => 'yes'
                    ],
                ]
            );

            $this->add_control(
                'how_to_estimated_time', [
                    'label' => __( 'Add Estimated Cost', 'mighty' ),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'no'
                ]
            );

            $this->add_control(
                'how_to_estimated_time_text',
                [
                    'label' => __('Estimated Cost Text', 'mighty'),
                    'type' => Controls_Manager::TEXT,
                    'default' => 'Total Cost:',
                    'dynamic' => [ 'active' => true ],
                    'condition' => [
                        'how_to_estimated_time' => 'yes'
                    ],
                ]
            );

            $this->add_control(
                'estimate_cost',
                [
                    'label' => __('Estimated Cost', 'mighty'),
                    'type' => Controls_Manager::NUMBER,
                    'dynamic' => [ 'active' => true ],
                    'condition' => [
                        'how_to_estimated_time' => 'yes'
                    ],
                ]
            );

            $this->add_control(
                'estimated_currency',
                [
                    'label' => __('Currency', 'mighty'),
                    'type' => Controls_Manager::TEXT,
                    'default' => '$',
                    'dynamic' => [ 'active' => true ],
                    'condition' => [
                        'how_to_estimated_time' => 'yes'
                    ],
                ]
            );

            $this->add_control(
                'how_to_supply', [
                    'label' => __( 'Add Supply', 'mighty' ),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'no'
                ]
            );

            $this->add_control(
                'supply_title',
                [
                    'label' => __('Supply Title', 'mighty'),
                    'type' => Controls_Manager::TEXT,
                    'default' => 'Necessary Supply Items',
                    'dynamic' => [ 'active' => true ],
                    'condition' => [
                        'how_to_supply' => 'yes'
                    ],
                ]
            );

            $this->add_control(
                'supply_icon',
                [
                    'label' => __('Supply Icon', 'mighty'),
                    'type' => Controls_Manager::ICONS,
                    'condition' => [
                        'how_to_supply' => 'yes'
                    ],
                ]
            );

            $this->add_responsive_control(
                'supply_icon_size',
                [
                    'label' => __('Icon Size', 'mighty'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ '%', 'px' , 'em' ],
                    'condition' => [
                        'how_to_supply' => 'yes'
                    ],
                    'range' => [
                        '%' => [
                            'min' => 1,
                            'max' => 100
                        ],
                        'px' => [
                            'min' => 1,
                            'max' => 1000
                        ],
                        'em' => [
                            'min' => 1,
                            'max' => 100
                        ]
                    ],
                    // 'selectors' => [
                    //     '{{WRAPPER}} .ma-agech .ma-agech__btn-primary.ma-agech__icon-before .ma-agech-btn__icon' => 'margin-right: {{SIZE}}{{UNIT}}',
                    // ],
                    
                ]
            );

            $this->add_responsive_control(
                'supply_icon_spacing',
                [
                    'label' => __('Icon Spacing', 'mighty'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ '%', 'px' , 'em' ],
                    'condition' => [
                        'how_to_supply' => 'yes'
                    ],
                    'range' => [
                        '%' => [
                            'min' => 1,
                            'max' => 100
                        ],
                        'px' => [
                            'min' => 1,
                            'max' => 1000
                        ],
                        'em' => [
                            'min' => 1,
                            'max' => 1000
                        ]
                    ],
                    // 'selectors' => [
                    //     '{{WRAPPER}} .ma-agech .ma-agech__btn-primary.ma-agech__icon-before .ma-agech-btn__icon' => 'margin-right: {{SIZE}}{{UNIT}}',
                    // ],
                    
                ]
            );

            $repeater = new \Elementor\Repeater();

            $repeater->add_control(
                'supply_name', [
                    'label' => esc_html__( 'Supply', 'mighty' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Supply' , 'mighty' ),
                    'label_block' => true,
                    'dynamic' => [ 'active' => true ],
                ]
            );
    
            $this->add_control(
                'supply_list',
                [
                    'label' => esc_html__( 'Add Supply', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'condition' => [
                        'how_to_supply' => 'yes'
                    ],
                    'default' => [
                        [
                            'supply_name' => esc_html__( 'Supply 1', 'mighty' ),
                        ],
                        [
                            'supply_name' => esc_html__( 'Supply 2', 'mighty' ),
                        ],
                        [
                            'supply_name' => esc_html__( 'Supply 3', 'mighty' ),
                        ],
                    ],
                    'title_field' => '{{{ supply_name }}}',
                ]
            );

            $this->add_control(
                'how_to_tool', [
                    'label' => __( 'Add Tools', 'mighty' ),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'no'
                ]
            );

            $this->add_control(
                'tool_title',
                [
                    'label' => __('Tool Title', 'mighty'),
                    'type' => Controls_Manager::TEXT,
                    'default' => 'Necessary Tool Items',
                    'dynamic' => [ 'active' => true ],
                    'condition' => [
                        'how_to_tool' => 'yes'
                    ],
                ]
            );

            $this->add_control(
                'tool_icon',
                [
                    'label' => __('Tool Icon', 'mighty'),
                    'type' => Controls_Manager::ICONS,
                    'condition' => [
                        'how_to_tool' => 'yes'
                    ],
                ]
            );

            $this->add_responsive_control(
                'tool_icon_size',
                [
                    'label' => __('Icon Size', 'mighty'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ '%', 'px' , 'em' ],
                    'condition' => [
                        'how_to_tool' => 'yes'
                    ],
                    'range' => [
                        '%' => [
                            'min' => 1,
                            'max' => 100
                        ],
                        'px' => [
                            'min' => 1,
                            'max' => 1000
                        ],
                        'em' => [
                            'min' => 1,
                            'max' => 100
                        ]
                    ],
                    // 'selectors' => [
                    //     '{{WRAPPER}} .ma-agech .ma-agech__btn-primary.ma-agech__icon-before .ma-agech-btn__icon' => 'margin-right: {{SIZE}}{{UNIT}}',
                    // ],
                    
                ]
            );

            $this->add_responsive_control(
                'tool_icon_spacing',
                [
                    'label' => __('Icon Spacing', 'mighty'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ '%', 'px' , 'em' ],
                    'condition' => [
                        'how_to_tool' => 'yes'
                    ],
                    'range' => [
                        '%' => [
                            'min' => 1,
                            'max' => 100
                        ],
                        'px' => [
                            'min' => 1,
                            'max' => 1000
                        ],
                        'em' => [
                            'min' => 1,
                            'max' => 1000
                        ]
                    ],
                    // 'selectors' => [
                    //     '{{WRAPPER}} .ma-agech .ma-agech__btn-primary.ma-agech__icon-before .ma-agech-btn__icon' => 'margin-right: {{SIZE}}{{UNIT}}',
                    // ],
                    
                ]
            );

            $repeater = new \Elementor\Repeater();

            $repeater->add_control(
                'tool_name', [
                    'label' => esc_html__( 'Tool', 'mighty' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Tool' , 'mighty' ),
                    'label_block' => true,
                    'dynamic' => [ 'active' => true ],
                ]
            );
    
            $this->add_control(
                'tool_list',
                [
                    'label' => esc_html__( 'Add Tool', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'condition' => [
                        'how_to_tool' => 'yes'
                    ],
                    'default' => [
                        [
                            'tool_name' => esc_html__( 'Tool 1', 'mighty' ),
                        ],
                        [
                            'tool_name' => esc_html__( 'Tool 2', 'mighty' ),
                        ],
                        [
                            'tool_name' => esc_html__( 'Tool 3', 'mighty' ),
                        ],
                    ],
                    'title_field' => '{{{ tool_name }}}',
                ]
            );
        
    
        $this->end_controls_section();

        // style
        $this->start_controls_section(
			'section_how_to_steps',
			[
				'label' => __( 'Steps', 'mighty' ),
			]
        );

            $this->add_control(
                'step_title', [
                    'label' => esc_html__( 'Title', 'mighty' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => 'Necessary Steps',
                    'dynamic' => [ 'active' => true ],
                ]
            );
            
        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        
       

    }

}
	