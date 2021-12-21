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
	
		wp_register_style( 'mighty-howtocss', MIGHTY_ADDONS_PLG_URL . 'assets/css/howto.min.css', false, MIGHTY_ADDONS_VERSION );
		
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
                    'default' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque eum nisi et quo doloremque laborum autem alias mollitia nobis delectus nemo hic, earum, voluptatem provident! Quo blanditiis laboriosam aliquam quibusdam!',
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
                    'label' => __( 'Link', 'mighty' ),
                    'type' => Controls_Manager::URL,
                    'placeholder' => __( 'https://your-link.com', 'mighty' ),
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
                    'type' => Controls_Manager::REPEATER,
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
                    'type' => Controls_Manager::REPEATER,
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
                'steps_title', [
                    'label' => esc_html__( 'Title', 'mighty' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => 'Necessary Steps',
                    'dynamic' => [ 'active' => true ],
                ]
            );

            $this->add_control(
                'steps_description',
                [
                    'label' => __('Description', 'mighty'),
                    'type' => Controls_Manager::TEXTAREA,
                    'dynamic' => [ 'active' => true ],
                ]
            );

            $repeater = new \Elementor\Repeater();

            $repeater->add_control(
                'step_title', [
                    'label' => esc_html__( 'Tool', 'mighty' ),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'dynamic' => [ 'active' => true ],
                ]
            );

            $repeater->add_control(
                'step_description',
                [
                    'label' => __('Description', 'mighty'),
                    'type' => Controls_Manager::TEXTAREA,
                    'dynamic' => [ 'active' => true ],
                    'default' => 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
                ]
            );
            
            $repeater->add_control(
                'step_image',
                [
                    'label' => __( 'Image', 'mighty' ),
                    'type' => Controls_Manager::MEDIA,
                    'dynamic' => [ 'active' => true ],
                ]
            );

            $repeater->add_control(
                'image_position',
                [
                    'label' => __('Image Positon', 'mighty'),
                    'type' => Controls_Manager::SELECT,
                    'default' => __('default'),
                    'options' => [
                        'default' => __('Default', 'mighty'),
                        'custom' => __('Custom', 'mighty'),
                    ],
                    // 'selectors' => [
                    //     '{{WRAPPER}} .ma-agech' => 'background-position: {{VALUE}}',
                    // ],
                ]
            );

            $repeater->add_control(
                'image_alignment',
                [
                    'label' => __( 'Alignment', 'mighty' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'top' => [
                            'title' => __( 'Top', 'mighty' ),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'bottom' => [
                            'title' => __( 'Bottom', 'mighty' ),
                            'icon' => 'eicon-v-align-bottom',
                        ],
                        'left' => [
                            'title' => __( 'Left', 'mighty' ),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'mighty' ),
                            'icon' => 'eicon-h-align-right',
                        ],
                    ],
                    'condition' => [
                        'image_position' => 'custom'
                    ],
                    'default' => 'right',
                    'toggle' => true,
                ]
            );

            $repeater->add_control(
                'horizontal_alignment',
                [
                    'label' => __( 'Horizontal Alignment', 'mighty' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'mighty' ),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'mighty' ),
                            'icon' => 'eicon-h-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'mighty' ),
                            'icon' => 'eicon-h-align-right',
                        ],
                    ],
                    'condition' => [
                        'image_alignment' => [ 'top', 'bottom' ]
                    ],
                    'default' => 'center',
                    'toggle' => true,
                ]
            );

            $repeater->add_control(
                'vertical_alignment',
                [
                    'label' => __( 'Vertical Alignment', 'mighty' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'top' => [
                            'title' => __( 'Top', 'mighty' ),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'middle' => [
                            'title' => __( 'Middle', 'mighty' ),
                            'icon' => ' eicon-v-align-middle',
                        ],
                        'bottom' => [
                            'title' => __( 'Bottom', 'mighty' ),
                            'icon' => 'eicon-v-align-bottom',
                        ],
                    ],
                    'condition' => [
                        'image_alignment' => [ 'left', 'right' ]
                    ],
                    'default' => 'middle',
                    'toggle' => true,
                ]
            );

            $repeater->add_control(
                'step_image_link',
                [
                    'label' => __( 'Link', 'mighty' ),
                    'type' => Controls_Manager::URL,
                    'placeholder' => __( 'https://your-link.com', 'mighty' ),
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
                'step_list',
                [
                    'label' => esc_html__( 'Steps', 'mighty' ),
                    'type' => Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [
                            'step_title' => esc_html__( 'Step 1', 'mighty' ),
                        ],
                        [
                            'step_title' => esc_html__( 'Step 2', 'mighty' ),
                        ],
                        [
                            'step_title' => esc_html__( 'Step 3', 'mighty' ),
                        ],
                    ],
                    'title_field' => '{{{ step_title }}}',
                ]
            );

            $this->add_control(
                'step_enable_lightbox',
                [
                    'label' => __('Enable Lightbox', 'mighty'),
                    'type' => Controls_Manager::SELECT,
                    'default' => __('yes'),
                    'options' => [
                        'yes' => __('Yes', 'mighty'),
                        'no' => __('No', 'mighty'),
                    ],
                    // 'selectors' => [
                    //     '{{WRAPPER}} .ma-agech' => 'background-position: {{VALUE}}',
                    // ],
                ]
            );
            
        $this->end_controls_section();

        $this->start_controls_section(
			'section_box_style',
			[
				'label' => __( 'Box', 'mighty' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
        );

            $this->add_control(
                'box_alignment',
                [
                    'label' => __( 'Box Alignment', 'mighty' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'mighty' ),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'mighty' ),
                            'icon' => 'eicon-h-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'mighty' ),
                            'icon' => 'eicon-h-align-right',
                        ],
                    ],
                    'default' => 'left',
                    'toggle' => true,
                ]
            );

            $this->add_control(
                'box_background_color',
                [
                    'label'     => __( 'Background Color', 'mighty' ),
                    'type'      => Controls_Manager::COLOR,
                    // 'selectors' => [
                    //     '{{WRAPPER}} .ma-agech__title' => 'color: {{VALUES}}'
                    // ]
                ]
            );

            $this->add_responsive_control(
				'box_padding',
				[
					'label' => __( 'Padding', 'mighty' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' ],
					// 'selectors' => [
					// 	'{{WRAPPER}} .ma-agech__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					// ],
				]
			);

            $this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'box_border',
					'label' => __( 'Border Type', 'mighty' ),
					// 'selector' => '{{WRAPPER}} .ma-agech__input',
				]
			);

            $this->add_responsive_control(
				'box_border_radius',
				[
					'label' => __( 'Box Border Radius', 'mighty' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' , '%' ],
					// 'selectors' => [
					// 	'{{WRAPPER}} .ma-agech__input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					// ],
				]
			);

            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'box_box_shadow',
                    'label' => __( 'Box Shadow', 'mighty' ),
                    // 'selector' => '{{WRAPPER}} .ma-agech__input',
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
			'section_title_style',
			[
				'label' => __( 'Title', 'mighty' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
        );

            $this->add_control(
                'title_color',
                [
                    'label'     => __( 'Title Color', 'mighty' ),
                    'type'      => Controls_Manager::COLOR,
                    // 'selectors' => [
                    //     '{{WRAPPER}} .ma-agech__title' => 'color: {{VALUES}}'
                    // ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    // 'selector' => '{{WRAPPER}} .ma-agech__btn-primary',
                ]
            );

            $this->add_control(
                'title_html_tag',
                [
                    'label' => __( 'Title HTML Tag', 'mighty' ),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'h1' => 'H1',
                        'h2' => 'H2',
                        'h3' => 'H3',
                        'h4' => 'H4',
                        'h5' => 'H5',
                        'h6' => 'H6',
                    ],
                    'default' => 'h2',
                ]
            );

            $this->add_control(
                'title_alignment',
                [
                    'label' => __( 'Title Alignment', 'mighty' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'mighty' ),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'mighty' ),
                            'icon' => 'eicon-h-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'mighty' ),
                            'icon' => 'eicon-h-align-right',
                        ],
                    ],
                    'default' => 'left',
                    'toggle' => true,
                ]
            );

            $this->add_responsive_control(
                'space_below_title',
                [
                    'label' => __('Space Below Title', 'mighty'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ '%', 'px' , 'em' ],
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
                    //     '{{WRAPPER}} .ma-agech__input-btn-wrapper' => 'max-width: {{SIZE}}{{UNIT}}',
                    // ],
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
			'section_description_style',
			[
				'label' => __( 'Description', 'mighty' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
        );

            $this->add_control(
                'description_color',
                [
                    'label'     => __( 'Description Color', 'mighty' ),
                    'type'      => Controls_Manager::COLOR,
                    // 'selectors' => [
                    //     '{{WRAPPER}} .ma-agech__title' => 'color: {{VALUES}}'
                    // ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'description_typography',
                    // 'selector' => '{{WRAPPER}} .ma-agech__btn-primary',
                ]
            );

            $this->add_control(
                'description_alignment',
                [
                    'label' => __( 'Description Alignment', 'mighty' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'mighty' ),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'mighty' ),
                            'icon' => 'eicon-h-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'mighty' ),
                            'icon' => 'eicon-h-align-right',
                        ],
                    ],
                    'default' => 'left',
                    'toggle' => true,
                ]
            );

            $this->add_responsive_control(
                'space_below_description',
                [
                    'label' => __('Space Below Description', 'mighty'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ '%', 'px' , 'em' ],
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
                    //     '{{WRAPPER}} .ma-agech__input-btn-wrapper' => 'max-width: {{SIZE}}{{UNIT}}',
                    // ],
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
			'section_image_style',
			[
				'label' => __( 'Image', 'mighty' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
        );

            $this->add_control(
                'image_alignment',
                [
                    'label' => __( 'Image Alignment', 'mighty' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'mighty' ),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'mighty' ),
                            'icon' => 'eicon-h-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'mighty' ),
                            'icon' => 'eicon-h-align-right',
                        ],
                    ],
                    'default' => 'left',
                    'toggle' => true,
                ]
            );

            $this->add_responsive_control(
				'image_padding',
				[
					'label' => __( 'Padding', 'mighty' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' ],
					// 'selectors' => [
					// 	'{{WRAPPER}} .ma-agech__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					// ],
				]
			);

            $this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'image_border',
					'label' => __( 'Border Type', 'mighty' ),
					// 'selector' => '{{WRAPPER}} .ma-agech__input',
				]
			);

            $this->add_responsive_control(
				'image_border_radius',
				[
					'label' => __( 'Image Border Radius', 'mighty' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' , '%' ],
					// 'selectors' => [
					// 	'{{WRAPPER}} .ma-agech__input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					// ],
				]
			);

            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'image_box_shadow',
                    'label' => __( 'Box Shadow', 'mighty' ),
                    // 'selector' => '{{WRAPPER}} .ma-agech__input',
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
			'section_advance_options_style',
			[
				'label' => __( 'Advance Options', 'mighty' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
        );

            $this->add_control(
                'total_time_options',
                [
                    'label' => esc_html__( 'Total Time', 'mighty' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'how_to_total_time' => 'yes'
                    ],
                ]
            );

            $this->add_control(
                'total_time_color',
                [
                    'label'     => __( 'Total Time Color', 'mighty' ),
                    'type'      => Controls_Manager::COLOR,
                    'condition' => [
                        'how_to_total_time' => 'yes'
                    ],
                    // 'selectors' => [
                    //     '{{WRAPPER}} .ma-agech__title' => 'color: {{VALUES}}'
                    // ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'total_time_typography',
                    'condition' => [
                        'how_to_total_time' => 'yes'
                    ],
                    // 'selector' => '{{WRAPPER}} .ma-agech__btn-primary',
                ]
            );

            $this->add_control(
                'total_time_alignment',
                [
                    'label' => __( 'Total Time Alignment', 'mighty' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'mighty' ),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'mighty' ),
                            'icon' => 'eicon-h-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'mighty' ),
                            'icon' => 'eicon-h-align-right',
                        ],
                    ],
                    'condition' => [
                        'how_to_total_time' => 'yes'
                    ],
                    'default' => 'left',
                    'toggle' => true,
                ]
            );

            $this->add_responsive_control(
                'space_below_total_time',
                [
                    'label' => __('Space Below Total Time', 'mighty'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ '%', 'px' , 'em' ],
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
                    'condition' => [
                        'how_to_total_time' => 'yes'
                    ],
                    // 'selectors' => [
                    //     '{{WRAPPER}} .ma-agech__input-btn-wrapper' => 'max-width: {{SIZE}}{{UNIT}}',
                    // ],
                ]
            );

            $this->add_control(
                'estimate_cost_options',
                [
                    'label' => esc_html__( 'Estimate Cost', 'mighty' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'how_to_estimated_time' => 'yes'
                    ],
                ]
            );

            $this->add_control(
                'estimate_cost_color',
                [
                    'label'     => __( 'Estimate Cost Color', 'mighty' ),
                    'type'      => Controls_Manager::COLOR,
                    'condition' => [
                        'how_to_estimated_time' => 'yes'
                    ],
                    // 'selectors' => [
                    //     '{{WRAPPER}} .ma-agech__title' => 'color: {{VALUES}}'
                    // ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'estimate_cost_typography',
                    'condition' => [
                        'how_to_estimated_time' => 'yes'
                    ],
                    // 'selector' => '{{WRAPPER}} .ma-agech__btn-primary',
                ]
            );

            $this->add_control(
                'estimate_cost_alignment',
                [
                    'label' => __( 'Estimate Cost Alignment', 'mighty' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'mighty' ),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'mighty' ),
                            'icon' => 'eicon-h-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'mighty' ),
                            'icon' => 'eicon-h-align-right',
                        ],
                    ],
                    'condition' => [
                        'how_to_estimated_time' => 'yes'
                    ],
                    'default' => 'left',
                    'toggle' => true,
                ]
            );

            $this->add_responsive_control(
                'space_below_estimate_cost',
                [
                    'label' => __('Space Below Estimate Cost', 'mighty'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ '%', 'px' , 'em' ],
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
                    'condition' => [
                        'how_to_estimated_time' => 'yes'
                    ],
                    // 'selectors' => [
                    //     '{{WRAPPER}} .ma-agech__input-btn-wrapper' => 'max-width: {{SIZE}}{{UNIT}}',
                    // ],
                ]
            );

            $this->add_control(
                'supply_options',
                [
                    'label' => esc_html__( 'Supply', 'mighty' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'how_to_supply' => 'yes'
                    ],
                ]
            );

            $this->add_control(
                'supply_title_color',
                [
                    'label'     => __( 'Supply Title Color', 'mighty' ),
                    'type'      => Controls_Manager::COLOR,
                    'condition' => [
                        'how_to_supply' => 'yes'
                    ],
                    // 'selectors' => [
                    //     '{{WRAPPER}} .ma-agech__title' => 'color: {{VALUES}}'
                    // ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'supply_title_typography',
                    'condition' => [
                        'how_to_supply' => 'yes'
                    ],
                    // 'selector' => '{{WRAPPER}} .ma-agech__btn-primary',
                ]
            );

            $this->add_control(
                'supply_title_alignment',
                [
                    'label' => __( 'Supply Title Alignment', 'mighty' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'mighty' ),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'mighty' ),
                            'icon' => 'eicon-h-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'mighty' ),
                            'icon' => 'eicon-h-align-right',
                        ],
                    ],
                    'condition' => [
                        'how_to_supply' => 'yes'
                    ],
                    'default' => 'left',
                    'toggle' => true,
                ]
            );

            $this->add_responsive_control(
                'space_below_supply_title',
                [
                    'label' => __('Space Below Supply Title', 'mighty'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ '%', 'px' , 'em' ],
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
                    'condition' => [
                        'how_to_supply' => 'yes'
                    ],
                    // 'selectors' => [
                    //     '{{WRAPPER}} .ma-agech__input-btn-wrapper' => 'max-width: {{SIZE}}{{UNIT}}',
                    // ],
                ]
            );

            $this->add_control(
                'supply_html_tag',
                [
                    'label' => __( 'Supply Title HTML Tag', 'mighty' ),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'h1' => 'H1',
                        'h2' => 'H2',
                        'h3' => 'H3',
                        'h4' => 'H4',
                        'h5' => 'H5',
                        'h6' => 'H6',
                    ],
                    'default' => 'h2',
                    'condition' => [
                        'how_to_supply' => 'yes'
                    ],
                ]
            );

            $this->add_control(
                'supply_color',
                [
                    'label'     => __( 'Supply Color', 'mighty' ),
                    'type'      => Controls_Manager::COLOR,
                    'condition' => [
                        'how_to_supply' => 'yes'
                    ],
                    // 'selectors' => [
                    //     '{{WRAPPER}} .ma-agech__title' => 'color: {{VALUES}}'
                    // ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'supply_typography',
                    'condition' => [
                        'how_to_supply' => 'yes'
                    ],
                    // 'selector' => '{{WRAPPER}} .ma-agech__btn-primary',
                ]
            );

            $this->add_control(
                'supply_alignment',
                [
                    'label' => __( 'Supply Alignment', 'mighty' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'mighty' ),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'mighty' ),
                            'icon' => 'eicon-h-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'mighty' ),
                            'icon' => 'eicon-h-align-right',
                        ],
                    ],
                    'condition' => [
                        'how_to_supply' => 'yes'
                    ],
                    'default' => 'left',
                    'toggle' => true,
                ]
            );

            $this->add_responsive_control(
                'space_below_supply',
                [
                    'label' => __('Space Between Supplies', 'mighty'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ '%', 'px' , 'em' ],
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
                    'condition' => [
                        'how_to_supply' => 'yes'
                    ],
                    // 'selectors' => [
                    //     '{{WRAPPER}} .ma-agech__input-btn-wrapper' => 'max-width: {{SIZE}}{{UNIT}}',
                    // ],
                ]
            );

            $this->add_responsive_control(
                'space_below_supply_section',
                [
                    'label' => __('Space Below Supply Section', 'mighty'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ '%', 'px' , 'em' ],
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
                    'condition' => [
                        'how_to_supply' => 'yes'
                    ],
                    // 'selectors' => [
                    //     '{{WRAPPER}} .ma-agech__input-btn-wrapper' => 'max-width: {{SIZE}}{{UNIT}}',
                    // ],
                ]
            );

            $this->add_control(
                'tool_options',
                [
                    'label' => esc_html__( 'Tools', 'mighty' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'how_to_tool' => 'yes'
                    ],
                ]
            );

            $this->add_control(
                'tool_title_color',
                [
                    'label'     => __( 'Tool Title Color', 'mighty' ),
                    'type'      => Controls_Manager::COLOR,
                    'condition' => [
                        'how_to_tool' => 'yes'
                    ],
                    // 'selectors' => [
                    //     '{{WRAPPER}} .ma-agech__title' => 'color: {{VALUES}}'
                    // ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'tool_title_typography',
                    'condition' => [
                        'how_to_tool' => 'yes'
                    ],
                    // 'selector' => '{{WRAPPER}} .ma-agech__btn-primary',
                ]
            );

            $this->add_control(
                'tool_title_alignment',
                [
                    'label' => __( 'Tool Title Alignment', 'mighty' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'mighty' ),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'mighty' ),
                            'icon' => 'eicon-h-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'mighty' ),
                            'icon' => 'eicon-h-align-right',
                        ],
                    ],
                    'condition' => [
                        'how_to_tool' => 'yes'
                    ],
                    'default' => 'left',
                    'toggle' => true,
                ]
            );

            $this->add_responsive_control(
                'space_below_tool_title',
                [
                    'label' => __('Space Below Tool Title', 'mighty'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ '%', 'px' , 'em' ],
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
                    'condition' => [
                        'how_to_tool' => 'yes'
                    ],
                    // 'selectors' => [
                    //     '{{WRAPPER}} .ma-agech__input-btn-wrapper' => 'max-width: {{SIZE}}{{UNIT}}',
                    // ],
                ]
            );

            $this->add_control(
                'tool_html_tag',
                [
                    'label' => __( 'Tool Title HTML Tag', 'mighty' ),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'h1' => 'H1',
                        'h2' => 'H2',
                        'h3' => 'H3',
                        'h4' => 'H4',
                        'h5' => 'H5',
                        'h6' => 'H6',
                    ],
                    'default' => 'h2',
                    'condition' => [
                        'how_to_tool' => 'yes'
                    ],
                ]
            );

            $this->add_control(
                'tool_color',
                [
                    'label'     => __( 'Tool Color', 'mighty' ),
                    'type'      => Controls_Manager::COLOR,
                    'condition' => [
                        'how_to_tool' => 'yes'
                    ],
                    // 'selectors' => [
                    //     '{{WRAPPER}} .ma-agech__title' => 'color: {{VALUES}}'
                    // ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'tool_typography',
                    'condition' => [
                        'how_to_tool' => 'yes'
                    ],
                    // 'selector' => '{{WRAPPER}} .ma-agech__btn-primary',
                ]
            );

            $this->add_control(
                'tool_alignment',
                [
                    'label' => __( 'Tools Alignment', 'mighty' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'mighty' ),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'mighty' ),
                            'icon' => 'eicon-h-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'mighty' ),
                            'icon' => 'eicon-h-align-right',
                        ],
                    ],
                    'condition' => [
                        'how_to_tool' => 'yes'
                    ],
                    'default' => 'left',
                    'toggle' => true,
                ]
            );

            $this->add_responsive_control(
                'space_below_tools',
                [
                    'label' => __('Space Between Tools', 'mighty'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ '%', 'px' , 'em' ],
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
                    'condition' => [
                        'how_to_tool' => 'yes'
                    ],
                    // 'selectors' => [
                    //     '{{WRAPPER}} .ma-agech__input-btn-wrapper' => 'max-width: {{SIZE}}{{UNIT}}',
                    // ],
                ]
            );

            $this->add_responsive_control(
                'space_below_tools_section',
                [
                    'label' => __('Space Below Tools Section', 'mighty'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ '%', 'px' , 'em' ],
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
                    'condition' => [
                        'how_to_tool' => 'yes'
                    ],
                    // 'selectors' => [
                    //     '{{WRAPPER}} .ma-agech__input-btn-wrapper' => 'max-width: {{SIZE}}{{UNIT}}',
                    // ],
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
			'section_steps_style',
			[
				'label' => __( 'Steps', 'mighty' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
        );

            $this->add_responsive_control(
                'space_between_steps',
                [
                    'label' => __('Spacing Between Steps', 'mighty'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ '%', 'px' , 'em' ],
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
                    //     '{{WRAPPER}} .ma-agech__input-btn-wrapper' => 'max-width: {{SIZE}}{{UNIT}}',
                    // ],
                ]
            );

            $this->add_control(
                'step_section_title',
                [
                    'label' => esc_html__( 'Section Title', 'mighty' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'step_section_title_color',
                [
                    'label'     => __( 'Color', 'mighty' ),
                    'type'      => Controls_Manager::COLOR,
                    // 'selectors' => [
                    //     '{{WRAPPER}} .ma-agech__title' => 'color: {{VALUES}}'
                    // ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'step_section_title_typography',
                    // 'selector' => '{{WRAPPER}} .ma-agech__btn-primary',
                ]
            );

            $this->add_control(
                'step_section_html_tag',
                [
                    'label' => __( 'HTML Tag', 'mighty' ),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'h1' => 'H1',
                        'h2' => 'H2',
                        'h3' => 'H3',
                        'h4' => 'H4',
                        'h5' => 'H5',
                        'h6' => 'H6',
                    ],
                    'default' => 'h2',
                ]
            );

            $this->add_control(
                'step_section_title_alignment',
                [
                    'label' => __( 'Alignment', 'mighty' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'mighty' ),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'mighty' ),
                            'icon' => 'eicon-h-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'mighty' ),
                            'icon' => 'eicon-h-align-right',
                        ],
                    ],
                    'default' => 'left',
                    'toggle' => true,
                ]
            );

            $this->add_responsive_control(
                'space_below_section_title',
                [
                    'label' => __('Space Below Title', 'mighty'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ '%', 'px' , 'em' ],
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
                    //     '{{WRAPPER}} .ma-agech__input-btn-wrapper' => 'max-width: {{SIZE}}{{UNIT}}',
                    // ],
                ]
            );

            $this->add_control(
                'step_section_description',
                [
                    'label' => esc_html__( 'Section Description', 'mighty' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'step_section_description_color',
                [
                    'label'     => __( 'Color', 'mighty' ),
                    'type'      => Controls_Manager::COLOR,
                    // 'selectors' => [
                    //     '{{WRAPPER}} .ma-agech__title' => 'color: {{VALUES}}'
                    // ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'step_section_description_typography',
                    // 'selector' => '{{WRAPPER}} .ma-agech__btn-primary',
                ]
            );

            $this->add_control(
                'step_section_description_alignment',
                [
                    'label' => __( 'Alignment', 'mighty' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'mighty' ),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'mighty' ),
                            'icon' => 'eicon-h-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'mighty' ),
                            'icon' => 'eicon-h-align-right',
                        ],
                    ],
                    'default' => 'left',
                    'toggle' => true,
                ]
            );

            $this->add_responsive_control(
                'space_below_section_description',
                [
                    'label' => __('Space Below Description', 'mighty'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ '%', 'px' , 'em' ],
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
                    //     '{{WRAPPER}} .ma-agech__input-btn-wrapper' => 'max-width: {{SIZE}}{{UNIT}}',
                    // ],
                ]
            );

            $this->add_control(
                'step_style_title',
                [
                    'label' => esc_html__( 'Step Title', 'mighty' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'step_title_color',
                [
                    'label'     => __( 'Color', 'mighty' ),
                    'type'      => Controls_Manager::COLOR,
                    // 'selectors' => [
                    //     '{{WRAPPER}} .ma-agech__title' => 'color: {{VALUES}}'
                    // ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'step_title_typography',
                    // 'selector' => '{{WRAPPER}} .ma-agech__btn-primary',
                ]
            );

            $this->add_control(
                'step_html_tag',
                [
                    'label' => __( 'HTML Tag', 'mighty' ),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'h1' => 'H1',
                        'h2' => 'H2',
                        'h3' => 'H3',
                        'h4' => 'H4',
                        'h5' => 'H5',
                        'h6' => 'H6',
                    ],
                    'default' => 'h2',
                ]
            );

            $this->add_control(
                'step_title_alignment',
                [
                    'label' => __( 'Alignment', 'mighty' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'mighty' ),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'mighty' ),
                            'icon' => 'eicon-h-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'mighty' ),
                            'icon' => 'eicon-h-align-right',
                        ],
                    ],
                    'default' => 'left',
                    'toggle' => true,
                ]
            );

            $this->add_responsive_control(
                'space_below_section_title',
                [
                    'label' => __('Space Below Title', 'mighty'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ '%', 'px' , 'em' ],
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
                    //     '{{WRAPPER}} .ma-agech__input-btn-wrapper' => 'max-width: {{SIZE}}{{UNIT}}',
                    // ],
                ]
            );

            $this->add_control(
                'step_style_description',
                [
                    'label' => esc_html__( 'Step Description', 'mighty' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'step_description_color',
                [
                    'label'     => __( 'Color', 'mighty' ),
                    'type'      => Controls_Manager::COLOR,
                    // 'selectors' => [
                    //     '{{WRAPPER}} .ma-agech__title' => 'color: {{VALUES}}'
                    // ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'step_description_typography',
                    // 'selector' => '{{WRAPPER}} .ma-agech__btn-primary',
                ]
            );

            $this->add_control(
                'step_description_alignment',
                [
                    'label' => __( 'Alignment', 'mighty' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'mighty' ),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'mighty' ),
                            'icon' => 'eicon-h-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'mighty' ),
                            'icon' => 'eicon-h-align-right',
                        ],
                    ],
                    'default' => 'left',
                    'toggle' => true,
                ]
            );

            $this->add_control(
                'step_style_image',
                [
                    'label' => esc_html__( 'Step Image', 'mighty' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'step_image_alignment',
                [
                    'label' => __( 'Alignment', 'mighty' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'top' => [
                            'title' => __( 'Top', 'mighty' ),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'bottom' => [
                            'title' => __( 'Bottom', 'mighty' ),
                            'icon' => 'eicon-v-align-bottom',
                        ],
                        'left' => [
                            'title' => __( 'Left', 'mighty' ),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'mighty' ),
                            'icon' => 'eicon-h-align-right',
                        ],
                    ],
                    'default' => 'right',
                    'toggle' => true,
                ]
            );

            $this->add_control(
                'step_horizontal_alignment',
                [
                    'label' => __( 'Horizontal Alignment', 'mighty' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'mighty' ),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'mighty' ),
                            'icon' => 'eicon-h-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'mighty' ),
                            'icon' => 'eicon-h-align-right',
                        ],
                    ],
                    'condition' => [
                        'step_image_alignment' => [ 'top', 'bottom' ]
                    ],
                    'default' => 'center',
                    'toggle' => true,
                ]
            );

            $this->add_control(
                'step_vertical_alignment',
                [
                    'label' => __( 'Vertical Alignment', 'mighty' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'top' => [
                            'title' => __( 'Top', 'mighty' ),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'middle' => [
                            'title' => __( 'Middle', 'mighty' ),
                            'icon' => ' eicon-v-align-middle',
                        ],
                        'bottom' => [
                            'title' => __( 'Bottom', 'mighty' ),
                            'icon' => 'eicon-v-align-bottom',
                        ],
                    ],
                    'condition' => [
                        'step_image_alignment' => [ 'left', 'right' ]
                    ],
                    'default' => 'middle',
                    'toggle' => true,
                ]
            );

            $this->add_responsive_control(
                'step_image_width',
                [
                    'label' => __('Image Width', 'mighty'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ '%', 'px' , 'em' ],
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
                    //     '{{WRAPPER}} .ma-agech__input-btn-wrapper' => 'max-width: {{SIZE}}{{UNIT}}',
                    // ],
                ]
            );

            $this->add_responsive_control(
                'step_image_spacing',
                [
                    'label' => __('Image Spacing', 'mighty'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ '%', 'px' , 'em' ],
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
                    //     '{{WRAPPER}} .ma-agech__input-btn-wrapper' => 'max-width: {{SIZE}}{{UNIT}}',
                    // ],
                ]
            );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if ( !empty($settings['how_to_image_link']['url'] ) ) {
            $how_to_image_link = $settings['how_to_image_link']['url'];
        } else {
            $how_to_image_link = "javascript:void(0)";
        }

        if ( $settings['how_to_total_time'] == 'yes' ) {
            $total_time = $settings['how_to_total_time_text'];

            if ( !empty ( $settings['duration_year'] ) ) {
                $total_time = $total_time . ' '. $settings['duration_year'] . ' years,';
            }
            if ( !empty ( $settings['duration_month'] ) ) {
                $total_time = $total_time . ' '. $settings['duration_month'] . ' months,';
            }
            if ( !empty ( $settings['duration_days'] ) ) {
                $total_time = $total_time . ' ' . $settings['duration_days'] . ' days,';
            }
            if ( !empty ( $settings['duration_hours'] ) ) {
                $total_time = $total_time . ' ' . $settings['duration_hours'] . ' hours,';
            }
            if ( !empty ( $settings['duration_minutes'] ) ) {
                $total_time = $total_time . ' ' . $settings['duration_minutes'] . ' minutes';
            }
        }
        
        if ( $settings['how_to_estimated_time'] == 'yes' ) {
            $estimate_time = $settings['how_to_estimated_time_text'];
            
            if ( !empty ( $settings['estimated_currency'] ) ) {
                $estimate_time = $estimate_time . ' <span>' . $settings['estimated_currency'];
            }
            if ( !empty ( $settings['estimate_cost'] ) ) {
                $estimate_time = $estimate_time . $settings['estimate_cost'] . '</span>';
            }
        }

    ?>
             
    <div class="mt-how-to mt-how-to-'<?php echo $this->get_id();?>' " id ="mt-how-to-'<?php echo $this->get_id();?>' ">
        
        <?php if ( !empty( $settings['how_to_title'] ) ) { ?>
            <h2 class="mt-how-to-title"><?php echo $settings['how_to_title']; ?></h2>
        <?php } ?>

        <?php if ( !empty( $settings['how_to_subtitle'] ) ) { ?>
            <h4 class="mt-how-to-subtitle"><?php echo $settings['how_to_subtitle']; ?></h4>
        <?php } ?>

        <?php if ( !empty( $settings['how_to_description'] ) ) { ?>
            <div class="mt-how-to-description"><?php echo $settings['how_to_description'];?></div>
        <?php } ?>

        <?php if ( !empty( $settings['how_to_image']['url'] ) ) { ?>
            <a href="<?php echo $how_to_image_link;?>">
                <div class="mt-how-to-image">
                    <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'how_to_image_size', 'how_to_image' ); ?>
                </div>
            </a>
        <?php } ?>

        <!-- Advanced Options -->
        <?php if ( $settings['how_to_total_time'] == 'yes' ||  $settings['how_to_estimated_time'] == 'yes'  ) { ?>

            <div class="mt-how-to-slug">

                <?php if ( $settings['how_to_total_time'] == 'yes' ) { ?>
                    <p class="mt-how-to-total-time"><?php echo  $total_time; ?></p>
                <?php } ?>

                <?php if ( $settings['how_to_estimated_time'] == 'yes' ) { ?>
                    <p class="mt-how-to-estimated-cost"><?php echo $estimate_time;?></p>
                <?php } ?>

            </div>

        <?php } ?>

        <div class="mt-how-to-supply">
            <h3 class="mt-how-to-supply-title">Necessary Supply Items</h3>
            <div class="mt-supply mt-supply-1">
                <i class="mt-supply-icon fas fa-check"></i>
                <span>Supply 1</span>
            </div>
            <div class="mt-supply mt-supply-2">
                <i class="mt-supply-icon fas fa-check"></i>
                <span>Supply 2</span>
            </div>
            <div class="mt-supply mt-supply-3">
                <i class="mt-supply-icon fas fa-check"></i>
                <span>Supply 3</span>
            </div>
        </div>

        <div class="mt-how-to-tools">
            <h3 class="mt-how-to-tools-title">Necessary Tool Items</h3>
            <div class="mt-tool mt-tool-1">
                <i class="mt-tool-icon fas fa-check"></i>
                <span>Tool 1</span>
            </div>
            <div class="mt-tool mt-tool-2">
                <i class="mt-tool-icon fas fa-check"></i>
                <span>Tool 2</span>
            </div>
            <div class="mt-tool mt-tool-3">
                <i class="mt-tool-icon fas fa-check"></i>
                <span>Tool 3</span>
            </div>
        </div>
        <!-- Advanced Options -->

        <div class="mt-how-to-steps">
            <h3 class="mt-how-to-step-section-title">Necessary Steps</h3>

            <div class="mt-how-to-step mt-has-img mt-step-img-right">
                <div class="mt-how-to-step-content">
                    <h3 class="mt-how-to-step-title">Step 1</h3>
                    <div class="mt-how-to-step-description">Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</div>
                </div>
                <div class="mt-how-to-step-image">
                    <a href="https://images.unsplash.com/photo-1633114128174-2f8aa49759b0" class="elementor-clickable">
                    <img src="https://images.unsplash.com/photo-1633114128174-2f8aa49759b0" alt="Place Step Title Here" title="Place Step Title Here">
                    </a>
                </div>
            </div>
            
            <div class="mt-how-to-step mt-has-img mt-step-img-right">
                <div class="mt-how-to-step-content">
                    <h3 class="mt-how-to-step-title">Step 2</h3>
                    <div class="mt-how-to-step-description">Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</div>
                </div>
                <div class="mt-how-to-step-image">
                    <a href="https://images.unsplash.com/photo-1633114128174-2f8aa49759b0" class="elementor-clickable">
                    <img src="https://images.unsplash.com/photo-1633114128174-2f8aa49759b0" alt="Place Step Title Here" title="Place Step Title Here">
                    </a>
                </div>
            </div>

            <div class="mt-how-to-step mt-has-img mt-step-img-right">
                <div class="mt-how-to-step-content">
                    <h3 class="mt-how-to-step-title">Step 3</h3>
                    <div class="mt-how-to-step-description">Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</div>
                </div>
                <div class="mt-how-to-step-image">
                    <a href="https://images.unsplash.com/photo-1633114128174-2f8aa49759b0" class="elementor-clickable">
                    <img src="https://images.unsplash.com/photo-1633114128174-2f8aa49759b0" alt="Place Step Title Here" title="Place Step Title Here">
                    </a>
                </div>
            </div>

        </div>

    </div>

    <?php }

}
	