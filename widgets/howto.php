<?php
namespace MightyAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils as Utils;
use Elementor\Repeater as Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

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
	
	public function get_style_depends() {
		return [ 'mighty-howtocss' ];
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
                    'label' => __( 'Title', 'mighty' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => 'How To',
                    'dynamic' => [ 'active' => true ],
                ]
            );

            $this->add_control(
                'how_to_subtitle',
                [
                    'label' => __( 'Subtitle', 'mighty' ),
                    'type' => Controls_Manager::TEXT,
                    'dynamic' => [ 'active' => true ],
                ]
            );

            $this->add_control(
                'how_to_description',
                [
                    'label' => __( 'Description', 'mighty' ),
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
                    'name' => 'image_size', 
                    'label'   => __( 'Image Size', 'mighty' ),
                    'default' => 'full',
                ]
            );

            $this->add_control(
                'how_to_image_link',
                [
                    'label' => __( 'Link', 'mighty' ),
                    'type' => Controls_Manager::URL,
                    'placeholder' => __( 'https://your-link.com', 'mighty' ),
                    'show_external' => true,
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
                    'label' => __( 'Total Time Text', 'mighty' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => 'Total Time Required:',
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
                    'label' => __( 'Years', 'mighty' ),
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
                    'label' => __( 'Months', 'mighty' ),
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
                    'label' => __( 'Days', 'mighty' ),
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
                    'label' => __( 'Hours', 'mighty' ),
                    'type' => Controls_Manager::NUMBER,
                    'default' => '2',
                    'dynamic' => [ 'active' => true ],
                    'condition' => [
                        'how_to_total_time' => 'yes'
                    ],
                ]
            );

            $this->add_control(
                'duration_minutes',
                [
                    'label' => __( 'Minutes', 'mighty' ),
                    'type' => Controls_Manager::NUMBER,
                    'dynamic' => [ 'active' => true ],
                    'default' => '30',
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
                    'label' => __( 'Estimated Cost Text', 'mighty' ),
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
                    'label' => __( 'Estimated Cost', 'mighty' ),
                    'type' => Controls_Manager::NUMBER,
                    'dynamic' => [ 'active' => true ],
                    'default' => '200',
                    'condition' => [
                        'how_to_estimated_time' => 'yes'
                    ],
                ]
            );

            $this->add_control(
                'estimated_currency',
                [
                    'label' => __( 'Currency', 'mighty' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => '$',
                    'dynamic' => [ 'active' => true ],
                    'condition' => [
                        'how_to_estimated_time' => 'yes'
                    ],
                    'description' => 'For your country ISO code <a href="https://en.wikipedia.org/wiki/List_of_circulating_currencies" target="_blank">click here</a>'
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
                    'label' => __( 'Supply Title', 'mighty' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => 'Required Supply/Material',
                    'dynamic' => [ 'active' => true ],
                    'condition' => [
                        'how_to_supply' => 'yes'
                    ],
                ]
            );

            $this->add_control(
                'supply_icon',
                [
                    'label' => __( 'Supply Icon', 'mighty' ),
                    'type' => Controls_Manager::ICONS,
                    'condition' => [
                        'how_to_supply' => 'yes'
                    ],
                    'default' => [
                        'value' => 'fas fa-check',
                        'library' => 'solid',
                    ],
                ]
            );

            $this->add_responsive_control(
                'supply_icon_size',
                [
                    'label' => __( 'Icon Size', 'mighty' ),
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
                    'selectors' => [
                        '{{WRAPPER}} .mt-supply i' => 'font-size: {{SIZE}}{{UNIT}}',
                    ],
                    
                ]
            );

            $this->add_responsive_control(
                'supply_icon_spacing',
                [
                    'label' => __( 'Icon Spacing', 'mighty' ),
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
                    'selectors' => [
                        '{{WRAPPER}} .mt-supply i' => 'margin-right: {{SIZE}}{{UNIT}}',
                    ],
                    
                ]
            );

            $repeater = new \Elementor\Repeater();

            $repeater->add_control(
                'supply_name', [
                    'label' => esc_html__( 'Supply', 'mighty' ),
                    'type' => Controls_Manager::TEXT,
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
                    'label' => __( 'Tool Title', 'mighty' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => 'Required Tools',
                    'dynamic' => [ 'active' => true ],
                    'condition' => [
                        'how_to_tool' => 'yes'
                    ],
                ]
            );

            $this->add_control(
                'tool_icon',
                [
                    'label' => __( 'Tool Icon', 'mighty' ),
                    'type' => Controls_Manager::ICONS,
                    'condition' => [
                        'how_to_tool' => 'yes'
                    ],
                    'default' => [
                        'value' => 'fas fa-check',
                        'library' => 'solid',
                    ],
                ]
            );

            $this->add_responsive_control(
                'tool_icon_size',
                [
                    'label' => __( 'Icon Size', 'mighty' ),
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
                    'selectors' => [
                        '{{WRAPPER}} .mt-tool i' => 'font-size: {{SIZE}}{{UNIT}}',
                    ],
                    
                ]
            );

            $this->add_responsive_control(
                'tool_icon_spacing',
                [
                    'label' => __( 'Icon Spacing', 'mighty' ),
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
                    'selectors' => [
                        '{{WRAPPER}} .mt-tool i' => 'margin-right: {{SIZE}}{{UNIT}}',
                    ],
                ]
            );

            $repeater = new \Elementor\Repeater();

            $repeater->add_control(
                'tool_name', [
                    'label' => esc_html__( 'Tool', 'mighty' ),
                    'type' => Controls_Manager::TEXT,
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
                    'label' => __( 'Description', 'mighty' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'dynamic' => [ 'active' => true ],
                    'default' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque eum nisi et quo doloremque laborum autem alias mollitia nobis delectus nemo hic, earum, voluptatem provident! Quo blanditiis laboriosam aliquam quibusdam!',
                ]
            );

            $repeater = new \Elementor\Repeater();

            $repeater->add_control(
                'step_title', [
                    'label' => esc_html__( 'Step', 'mighty' ),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'dynamic' => [ 'active' => true ],
                ]
            );

            $repeater->add_control(
                'step_description',
                [
                    'label' => __( 'Description', 'mighty' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'dynamic' => [ 'active' => true ],
                ]
            );
            
            $repeater->add_control(
                'step_image',
                [
                    'label' => __( 'Image', 'mighty' ),
                    'type' => Controls_Manager::MEDIA,
                    'dynamic' => [ 'active' => true ],
                    'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                ]
            );

            $repeater->add_control(
                'image_position',
                [
                    'label' => __( 'Image Positon', 'mighty' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => __('default'),
                    'options' => [
                        'default' => __('Default', 'mighty'),
                        'custom' => __('Custom', 'mighty'),
                    ],
                ]);
                
                $repeater->add_control(
                    'image_alignment',
                    [
                    'label' => __( 'Position', 'mighty' ),
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
                            'flex-start' => [
                                'title' => __( 'Left', 'mighty' ),
                                'icon' => 'eicon-h-align-left',
                            ],
                            'center' => [
                                'title' => __( 'Center', 'mighty' ),
                                'icon' => 'eicon-h-align-center',
                            ],
                            'flex-end' => [
                                'title' => __( 'Right', 'mighty' ),
                                'icon' => 'eicon-h-align-right',
                            ],
                        ],
                        'condition' => [
                            'image_position' => 'custom',
                            'image_alignment' => [ 'top', 'bottom' ],
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
                        'flex-start' => [
                            'title' => __( 'Top', 'mighty' ),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'center' => [
                            'title' => __( 'Middle', 'mighty' ),
                            'icon' => ' eicon-v-align-middle',
                        ],
                        'flex-end' => [
                            'title' => __( 'Bottom', 'mighty' ),
                            'icon' => 'eicon-v-align-bottom',
                        ],
                    ],
                    'condition' => [
                        'image_position' => 'custom',
                        'image_alignment' => [ 'left', 'right' ],
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
                            'step_description' => esc_html__( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'mighty' ),

                        ],
                        [
                            'step_title' => esc_html__( 'Step 2', 'mighty' ),
                            'step_description' => esc_html__( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'mighty' ),
                        ],
                        [
                            'step_title' => esc_html__( 'Step 3', 'mighty' ),
                            'step_description' => esc_html__( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'mighty' ),
                        ],
                    ],
                    'title_field' => '{{{ step_title }}}',
                ]
            );

            $this->add_control(
                'step_enable_lightbox',
                [
                    'label' => __( 'Enable Lightbox', 'mighty' ),
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

            $this->add_responsive_control(
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
                    'selectors' => [
                        '{{WRAPPER}} .mt-how-to' => 'text-align: {{VALUES}}'
                    ]
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'box_background_color',
                    'label' => __( 'Background Color', 'mighty' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .mt-how-to',
                ]
            );

            $this->add_responsive_control(
				'box_padding',
				[
					'label' => __( 'Padding', 'mighty' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' , '%' ],
					'selectors' => [
						'{{WRAPPER}} .mt-how-to' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

            $this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'box_border',
					'label' => __( 'Border Type', 'mighty' ),
					'selector' => '{{WRAPPER}} .mt-how-to',
				]
			);

            $this->add_responsive_control(
				'box_border_radius',
				[
					'label' => __( 'Box Border Radius', 'mighty' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' , '%' ],
					'selectors' => [
						'{{WRAPPER}} .mt-how-to' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'box_box_shadow',
                    'label' => __( 'Box Shadow', 'mighty' ),
                    'selector' => '{{WRAPPER}} .mt-how-to',
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
                    'selectors' => [
                        '{{WRAPPER}} .mt-how-to-title' => 'color: {{VALUES}}'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'selector' => '{{WRAPPER}} .mt-how-to-title',
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

            $this->add_responsive_control(
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
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .mt-how-to-title' => 'text-align: {{VALUES}}'
                    ]
                ]
            );

            $this->add_responsive_control(
                'space_below_title',
                [
                    'label' => __( 'Space Below Title', 'mighty' ),
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
                    'selectors' => [
                        '{{WRAPPER}} .mt-how-to-title' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                    ],
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
                    'selectors' => [
                        '{{WRAPPER}} .mt-how-to-description' => 'color: {{VALUES}}'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'description_typography',
                    'selector' => '{{WRAPPER}} .mt-how-to-description',
                ]
            );

            $this->add_responsive_control(
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
                    'selectors' => [
                        '{{WRAPPER}} .mt-how-to-description' => 'text-align: {{VALUES}}'
                    ]
                ]
            );

            $this->add_responsive_control(
                'space_below_description',
                [
                    'label' => __( 'Space Below Description', 'mighty' ),
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
                    'selectors' => [
                        '{{WRAPPER}} .mt-how-to-description' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                    ],
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

            $this->add_responsive_control(
                'style_image_alignment',
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
                    'selectors' => [
                        '{{WRAPPER}} .mt-how-to-image' => 'text-align: {{VALUE}}',
                    ],
                ]
            );

            $this->add_responsive_control(
				'image_padding',
				[
					'label' => __( 'Padding', 'mighty' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' ],
					'selectors' => [
						'{{WRAPPER}} .mt-how-to-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

            $this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'image_border',
					'label' => __( 'Border Type', 'mighty' ),
					'selector' => '{{WRAPPER}} .mt-how-to-image img',
				]
			);

            $this->add_responsive_control(
				'image_border_radius',
				[
					'label' => __( 'Image Border Radius', 'mighty' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' , '%' ],
					'selectors' => [
						'{{WRAPPER}} .mt-how-to-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'image_box_shadow',
                    'label' => __( 'Box Shadow', 'mighty' ),
                    'selector' => '{{WRAPPER}} .mt-how-to-image',
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
			'section_advance_options_style',
			[
				'label' => __( 'Advance Options', 'mighty' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'how_to_total_time',
                            'operator' => '==',
                            'value' => 'yes'
                        ],
                        [
                            'name' => 'how_to_estimated_time',
                            'operator' => '==',
                            'value' => 'yes'
                        ],
                        [
                            'name' => 'how_to_supply',
                            'operator' => '==',
                            'value' => 'yes'
                        ],
                        [
                            'name' => 'how_to_tool',
                            'operator' => '==',
                            'value' => 'yes'
                        ],
                    ]
                ]
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
                    'selectors' => [
                        '{{WRAPPER}} .mt-how-to-total-time' => 'color: {{VALUES}}'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'total_time_typography',
                    'condition' => [
                        'how_to_total_time' => 'yes'
                    ],
                    'selector' => '{{WRAPPER}} .mt-how-to-total-time',
                ]
            );

            $this->add_responsive_control(
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
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .mt-how-to-total-time' => 'text-align: {{VALUES}}'
                    ]
                ]
            );

            $this->add_responsive_control(
                'space_below_total_time',
                [
                    'label' => __( 'Space Below Total Time', 'mighty' ),
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
                    'selectors' => [
                        '{{WRAPPER}} .mt-how-to-total-time' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                    ],
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
                    'selectors' => [
                        '{{WRAPPER}} .mt-how-to-estimated-cost' => 'color: {{VALUES}}'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'estimate_cost_typography',
                    'condition' => [
                        'how_to_estimated_time' => 'yes'
                    ],
                    'selector' => '{{WRAPPER}} .mt-how-to-estimated-cost',
                ]
            );

            $this->add_responsive_control(
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
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .mt-how-to-estimated-cost' => 'text-align: {{VALUES}}'
                    ]
                ]
            );

            $this->add_responsive_control(
                'space_below_estimate_cost',
                [
                    'label' => __( 'Space Below Estimate Cost', 'mighty' ),
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
                    'selectors' => [
                        '{{WRAPPER}} .mt-how-to-estimated-cost' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                    ],
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
                    'selectors' => [
                        '{{WRAPPER}} .mt-how-to-supply-title' => 'color: {{VALUES}}'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'supply_title_typography',
                    'condition' => [
                        'how_to_supply' => 'yes'
                    ],
                    'selector' => '{{WRAPPER}} .mt-how-to-supply-title',
                ]
            );

            $this->add_responsive_control(
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
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .mt-how-to-supply-title' => 'text-align: {{VALUES}}'
                    ]
                ]
            );

            $this->add_responsive_control(
                'space_below_supply_title',
                [
                    'label' => __( 'Space Below Supply Title', 'mighty' ),
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
                    'selectors' => [
                        '{{WRAPPER}} .mt-how-to-supply-title' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                    ],
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
                    'selectors' => [
                        '{{WRAPPER}} .mt-supply' => 'color: {{VALUES}}'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'supply_typography',
                    'condition' => [
                        'how_to_supply' => 'yes'
                    ],
                    'selector' => '{{WRAPPER}} .mt-supply',
                ]
            );

            $this->add_responsive_control(
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
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .mt-supply' => 'text-align: {{VALUES}}'
                    ]
                ]
            );

            $this->add_responsive_control(
                'space_below_supply',
                [
                    'label' => __( 'Space Between Items', 'mighty' ),
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
                    'selectors' => [
                        '{{WRAPPER}} .mt-supply + .mt-supply' => 'margin-top: {{SIZE}}{{UNIT}}',
                    ],
                ]
            );

            $this->add_responsive_control(
                'space_below_supply_section',
                [
                    'label' => __( 'Space Below Supply Section', 'mighty' ),
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
                    'selectors' => [
                        '{{WRAPPER}} .mt-how-to-supply' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                    ],
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
                    'selectors' => [
                        '{{WRAPPER}} .mt-how-to-tools-title' => 'color: {{VALUES}}'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'tool_title_typography',
                    'condition' => [
                        'how_to_tool' => 'yes'
                    ],
                    'selector' => '{{WRAPPER}} .mt-how-to-tools-title',
                ]
            );

            $this->add_responsive_control(
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
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .mt-how-to-tools-title' => 'text-align: {{VALUES}}'
                    ]
                ]
            );

            $this->add_responsive_control(
                'space_below_tool_title',
                [
                    'label' => __( 'Space Below Tool Title', 'mighty' ),
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
                    'selectors' => [
                        '{{WRAPPER}} .mt-how-to-tools-title' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                    ],
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
                    'selectors' => [
                        '{{WRAPPER}} .mt-tool' => 'color: {{VALUES}}'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'tool_typography',
                    'condition' => [
                        'how_to_tool' => 'yes'
                    ],
                    'selector' => '{{WRAPPER}} .mt-tool',
                ]
            );

            $this->add_responsive_control(
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
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .mt-tool' => 'text-align: {{VALUES}}'
                    ]
                ]
            );

            $this->add_responsive_control(
                'space_below_tools',
                [
                    'label' => __( 'Space Between Tools', 'mighty' ),
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
                    'selectors' => [
                        '{{WRAPPER}} .mt-tool + .mt-tool' => 'margin-top: {{SIZE}}{{UNIT}}',
                    ],
                ]
            );

            $this->add_responsive_control(
                'space_below_tools_section',
                [
                    'label' => __( 'Space Below Tools Section', 'mighty' ),
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
                    'selectors' => [
                        '{{WRAPPER}} .mt-how-to-tools' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                    ],
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
                    'label' => __( 'Spacing Between Steps', 'mighty' ),
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
                    'selectors' => [
                        '{{WRAPPER}} .mt-how-to-step-section-title' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                    ],
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
                    'selectors' => [
                        '{{WRAPPER}} .mt-how-to-step-section-title' => 'color: {{VALUES}}'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'step_section_title_typography',
                    'selector' => '{{WRAPPER}} .mt-how-to-step-section-title',
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
                    'default' => 'h3',
                ]
            );

            $this->add_responsive_control(
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
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .mt-how-to-step-section-title' => 'text-align: {{VALUES}}'
                    ]
                ]
            );

            $this->add_responsive_control(
                'space_below_section_title',
                [
                    'label' => __( 'Space Below Title', 'mighty' ),
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
                    'selectors' => [
                        '{{WRAPPER}} .mt-how-to-step-section-title' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                    ],
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
                    'selectors' => [
                        '{{WRAPPER}} .mt-how-to-step-section-sub-title' => 'color: {{VALUES}}'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'step_section_description_typography',
                    'selector' => '{{WRAPPER}} .mt-how-to-step-section-sub-title',
                ]
            );

            $this->add_responsive_control(
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
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .mt-how-to-step-section-sub-title' => 'text-align: {{VALUES}}'
                    ]
                ]
            );

            $this->add_responsive_control(
                'space_below_section_description',
                [
                    'label' => __( 'Space Below Description', 'mighty' ),
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
                    'selectors' => [
                        '{{WRAPPER}} .mt-how-to-step-section-sub-title' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                    ],
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
                    'selectors' => [
                        '{{WRAPPER}} .mt-how-to-step-title' => 'color: {{VALUES}}'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'step_title_typography',
                    'selector' => '{{WRAPPER}} .mt-how-to-step-title',
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
                    'default' => 'h4',
                ]
            );

            $this->add_responsive_control(
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
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .mt-how-to-step-title' => 'text-align: {{VALUES}}'
                    ]
                ]
            );

            $this->add_responsive_control(
                'space_below_section_step_title',
                [
                    'label' => __( 'Space Below Title', 'mighty' ),
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
                    'selectors' => [
                        '{{WRAPPER}} .mt-how-to-step-title' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                    ],
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
                    'selectors' => [
                        '{{WRAPPER}} .mt-how-to-step-description' => 'color: {{VALUES}}'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'step_description_typography',
                    'selector' => '{{WRAPPER}} .mt-how-to-step-description',
                ]
            );

            $this->add_responsive_control(
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
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .mt-how-to-step-description' => 'text-align: {{VALUES}}'
                    ]
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

            $this->add_responsive_control(
                'step_image_alignment',
                [
                    'label' => __( 'Position', 'mighty' ),
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

            $this->add_responsive_control(
                'step_horizontal_alignment',
                [
                    'label' => __( 'Horizontal Alignment', 'mighty' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'flex-start' => [
                            'title' => __( 'Left', 'mighty' ),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'mighty' ),
                            'icon' => 'eicon-h-align-center',
                        ],
                        'flex-end' => [
                            'title' => __( 'Right', 'mighty' ),
                            'icon' => 'eicon-h-align-right',
                        ],
                    ],
                    'condition' => [
                        'step_image_alignment' => [ 'top', 'bottom' ]
                    ],
                    'default' => 'center',
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .mt-how-to-step-image' => 'align-items: {{VALUES}}'
                    ]
                ]
            );

            $this->add_responsive_control(
                'step_vertical_alignment',
                [
                    'label' => __( 'Vertical Alignment', 'mighty' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'flex-start' => [
                            'title' => __( 'Top', 'mighty' ),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'center' => [
                            'title' => __( 'Middle', 'mighty' ),
                            'icon' => ' eicon-v-align-middle',
                        ],
                        'flex-end' => [
                            'title' => __( 'Bottom', 'mighty' ),
                            'icon' => 'eicon-v-align-bottom',
                        ],
                    ],
                    'condition' => [
                        'step_image_alignment' => [ 'left', 'right' ]
                    ],
                    'default' => 'center',
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .mt-how-to-step-image' => 'align-items: {{VALUES}}'
                    ]
                ]
            );

            $this->add_responsive_control(
                'step_image_width',
                [
                    'label' => __( 'Image Width', 'mighty' ),
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
                    'default' => [
                        'unit' => '%',
                        'size' => 30,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mt-how-to-step-image' => 'width: {{SIZE}}{{UNIT}}',
                    ],
                ]
            );

            $this->add_responsive_control(
                'step_image_spacing',
                [
                    'label' => __( 'Image Spacing', 'mighty' ),
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
                    'selectors' => [
                        '{{WRAPPER}} .mt-step-img-top .mt-how-to-step-image' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                        '{{WRAPPER}} .mt-step-img-right .mt-how-to-step-image' => 'margin-left: {{SIZE}}{{UNIT}}',
                        '{{WRAPPER}} .mt-step-img-bottom .mt-how-to-step-image' => 'margin-top: {{SIZE}}{{UNIT}}',
                        '{{WRAPPER}} .mt-step-img-left .mt-how-to-step-image' => 'margin-right: {{SIZE}}{{UNIT}}',
                    ],
                ]
            );

        $this->end_controls_section();

    }

    protected function get_how_to_json_ld() {
		$settings           = $this->get_settings_for_display();
		$id                 = $this->get_id();
		$how_to_title       = $settings['how_to_title'];
		$how_to_description = wp_json_encode( $settings['how_to_description'] );
		$how_to_image       = $settings['how_to_image'];
		$show_advanced      = $settings['show_advanced'];
		$years              = ( '' !== $settings['duration_year'] ) ? $settings['duration_year'] : '0';
		$months             = ( '' !== $settings['duration_month'] ) ? $settings['total_time_months'] : '0';
		$days               = ( '' !== $settings['duration_days'] ) ? $settings['duration_days'] : '0';
		$hours              = ( '' !== $settings['duration_hours'] ) ? $settings['duration_hours'] : '0';
		$minutes            = ( '' !== $settings['duration_minutes'] ) ? $settings['duration_minutes'] : '0';

		$total_time         = $settings['duration_minutes'];
		$estimated_cost     = $settings['estimate_cost'];
		$currency_iso_code  = $settings['estimated_currency'];
		$add_supply         = $settings['how_to_supply'];
		$supplies           = $settings['supply_list'];
		$add_tools          = $settings['how_to_tool'];
		$tools              = $settings['tool_list'];
		$step_section_title = $settings['mt-how-to-step-section-title'];
		$steps_form         = $settings['step_list'];
		$enable_schema      = true;

		$y          = ( 525600 * $years );
		$m          = ( 43200 * $months );
		$d          = ( 1440 * $days );
		$h          = ( 60 * $hours );
		$total_time = $y + $m + $d + $h + $minutes;

		if ( isset( $settings['enable_schema'] ) && 'no' === $settings['enable_schema'] ) {
			$enable_schema = false;
		}

		if ( ! $enable_schema ) {
			return;
		}

		if ( $this->_schema_rendered ) {
			return;
		}

		if ( ! empty( $how_to_image['url'] ) ) {
			$image_url = Group_Control_Image_Size::get_attachment_image_src( strval($how_to_image['id']), 'image_size', $settings );
		};
		?>
		<script type="application/ld+json">
			{
				"@context":    "http://schema.org",
				"@type":       "HowTo",
				"name":        "<?php echo $how_to_title; ?>",
				"description": <?php echo $how_to_description; ?>,
				"image":       "<?php echo $image_url; ?>",

				<?php if ( 'yes' === $show_advanced ) { ?>
					<?php if ( '' !== $estimated_cost ) { ?>
					"estimatedCost": {
						"@type": "MonetaryAmount",
						"currency": "<?php echo wp_kses_post( $currency_iso_code ); ?>",
						"value": "<?php echo wp_kses_post( $estimated_cost ); ?>"
					},
					<?php } ?>
					<?php if ( '' !== $total_time ) { ?>
					"totalTime": "PT<?php echo wp_kses_post( $total_time ); ?>M",
					<?php } ?>

					<?php
					if ( 'yes' === $add_supply && isset( $supplies ) ) {
						?>
						"supply": [
							<?php foreach ( $supplies as $key => $supply ) { ?>
								{
									"@type": "HowToSupply",
									"name": "<?php echo wp_kses_post( $supply['supply_name'] ); ?>"
								}<?php echo ( ( $key + 1 ) !== sizeof( $supplies ) ) ? ',' : ''; ?>
							<?php } ?>
						],
						<?php
					}
					if ( 'yes' === $add_tools && isset( $tools ) ) {
						?>
						"tool": [
							<?php foreach ( $tools as $key => $tool ) { ?>
								{
									"@type": "HowToTool",
									"name": "<?php echo wp_kses_post( $tool['tool_name'] ); ?>"
								}<?php echo ( ( $key + 1 ) !== sizeof( $tools ) ) ? ',' : ''; ?>
							<?php } ?>
						],
						<?php
					}
				}
				if ( isset( $steps_form ) ) {
					?>
				"step": [
					<?php
					foreach ( $steps_form as $key => $step ) {
						$step_id      = 'step-' . $id . '-' . ( $key + 1 );
						$step_image   = $step['step_image_link'];
						$step_img_url = '';

						if ( ! empty( $step_image['url'] ) ) {
							$step_img_url = $step_image['url'];
						}
						if ( isset( $step['step_link']['url'] ) && ! empty( $step['step_link']['url'] ) ) {
							$meta_link = $step['step_link']['url'];
						} else {
							$meta_link = get_permalink() . '#' . $step_id;
						}
						?>
						{
							"@type": "HowToStep",
							"name": "<?php echo wp_kses_post( $step['step_title'] ); ?>",
							"text": <?php echo wp_json_encode( $step['step_description'] ); ?>,
							"image": "<?php echo esc_url( $step_img_url ); ?>",
							"url": "<?php echo esc_url( $meta_link ); ?>"
						}<?php echo ( ( $key + 1 ) !== sizeof( $steps_form ) ) ? ',' : ''; ?>
					<?php } ?>
				] 
				<?php } ?>
			}
		</script>
		<?php

		$this->_schema_rendered = true;
	}

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if ( !empty($settings['how_to_image_link']['url'] ) ) {
            $how_to_image_link = $settings['how_to_image_link']['url'];
        }

        $image_url = Group_Control_Image_Size::get_attachment_image_src( strval($settings['how_to_image']['id']), 'image_size', $settings );

        if ( $settings['how_to_total_time'] == 'yes' ) {
            $total_time = $settings['how_to_total_time_text'];

            if ( !empty ( $settings['duration_year'] ) ) {
                $year = ( $settings['duration_year'] > 1 ) ? ' years,' : ' year,';
                $total_time = $total_time . ' '. $settings['duration_year'] . $year;
            }
            if ( !empty ( $settings['duration_month'] ) ) {
                $month = ( $settings['duration_month'] > 1 ) ? ' months,' : ' month,';
                $total_time = $total_time . ' '. $settings['duration_month'] . $month;
            }
            if ( !empty ( $settings['duration_days'] ) ) {
                $days = ( $settings['duration_days'] > 1 ) ? ' days,' : ' day,';
                $total_time = $total_time . ' ' . $settings['duration_days'] . $days;
            }
            if ( !empty ( $settings['duration_hours'] ) ) {
                $hours = ( $settings['duration_hours'] > 1 ) ? ' hours,' : ' hour,';
                $total_time = $total_time . ' ' . $settings['duration_hours'] . $hours;
            }
            if ( !empty ( $settings['duration_minutes'] ) ) {
                $minutes = ( $settings['duration_minutes'] > 1 ) ? ' minutes,' : ' minute,';
                $total_time = $total_time . ' ' . $settings['duration_minutes'] . $minutes;
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

        $this->add_render_attribute( 'mt-how-to-title', 'class',  'mt-how-to-title' );
        $this->add_render_attribute( 'mt-how-to-supply-title', 'class',  'mt-how-to-supply-title' );
        $this->add_render_attribute( 'mt-how-to-tools-title', 'class',  'mt-how-to-tools-title' );
        $this->add_render_attribute( 'mt-how-to-step-title', 'class',  'mt-how-to-step-title' );
        $this->add_render_attribute( 'mt-how-to-step-section-title', 'class',  'mt-how-to-step-section-title' );
        $this->add_render_attribute( 'mt-how-to-step-image', 'class',  'mt-how-to-step-image' );
        $this->add_render_attribute( 'mt-how-to-step-content', 'class',  'mt-how-to-step-content' );

    ?>
             
    <div class="mt-how-to mt-how-to-<?php echo $this->get_id();?>" id ="mt-how-to-<?php echo $this->get_id();?>">
        <?php
			if ( 'yes' == $settings['enable_schema'] ) { ?>
				<?php $this->get_how_to_json_ld(); ?>
		<?php } ?>
        <?php if ( !empty( $settings['how_to_title'] ) ) { ?>
            <?php if ( !empty($how_to_image_link) ) { ?>
                <a href="<?php echo $how_to_image_link;?>">
            <?php } ?>
                <<?php echo $settings['title_html_tag']?> <?php echo $this->get_render_attribute_string('mt-how-to-title'); ?> ><?php echo $settings['how_to_title']; ?></<?php echo $settings['title_html_tag']?>>
            <?php if ( !empty($how_to_image_link) ) { ?>
                </a>
            <?php } ?>
        <?php } ?>

        <?php if ( !empty( $settings['how_to_subtitle'] ) ) { ?>
            <h4 class="mt-how-to-subtitle"><?php echo $settings['how_to_subtitle']; ?></h4>
        <?php } ?>

        <?php if ( !empty( $settings['how_to_description'] ) ) { ?>
            <div class="mt-how-to-description"><?php echo $settings['how_to_description'];?></div>
        <?php } ?>

        <?php if ( !empty( $settings['how_to_image']['url'] ) ) { ?>
                <div class="mt-how-to-image">
                    <img src=<?php echo $image_url; ?> >
                </div>
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

        <?php if ( $settings['how_to_supply'] == 'yes' ) { ?>
            <div class="mt-how-to-supply">
                <<?php echo $settings['supply_html_tag'];?> <?php echo $this->get_render_attribute_string('mt-how-to-supply-title'); ?> ><?php echo $settings['supply_title'];?></<?php echo $settings['supply_html_tag'];?> >
                <?php foreach ($settings['supply_list'] as $key => $value) { ?>
                    <div class="mt-supply mt-supply-<?php echo $key + 1; ?>">
                        <i class="<?php echo $settings['supply_icon']['value'];?>" ></i>
                        <span><?php echo $value['supply_name'];?></span>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
                
        <?php if ( $settings['how_to_tool'] == 'yes' ) { ?>
            <div class="mt-how-to-tools">
            <<?php echo $settings['tool_html_tag'];?> <?php echo $this->get_render_attribute_string('mt-how-to-tools-title'); ?> ><?php echo $settings['tool_title'];?></<?php echo $settings['tool_html_tag'];?> >
            <?php foreach ($settings['tool_list'] as $key => $value) { ?>
                <div class="mt-tool mt-tool-<?php echo $key + 1; ?>">
                    <i class="<?php echo $settings['tool_icon']['value'];?>"></i>
                    <span><?php echo $value['tool_name'];?></span>
                </div>
                <?php } ?>
            </div>
            <?php } ?>
            <!-- Advanced Options -->
            
            <div class="mt-how-to-steps">

                <<?php echo $settings['step_section_html_tag'];?> <?php echo $this->get_render_attribute_string('mt-how-to-step-section-title'); ?> ><?php echo $settings['steps_title'];?></<?php echo $settings['step_section_html_tag'];?> >
                
                <p class="mt-how-to-step-section-sub-title"><?php echo $settings['steps_description'];?></p>
                
                <?php foreach ( $settings['step_list'] as $key => $value ) { ?>

                    <php print_r($value); ?>
                    
                <?php if ( $value['image_position'] == 'custom' ) { ?>

                   <?php if ( $value['image_alignment'] == 'left' || $value['image_alignment'] == 'right' ) {

                    $this->add_render_attribute( 'mt-how-to-step-image', 'style',  'align-self:'.$value['vertical_alignment'].';' );
                    }

                    if ( $value['image_alignment'] == 'top' || $value['image_alignment'] == 'bottom' ) {

                    $this->add_render_attribute( 'mt-how-to-step-image', 'style',  'align-self:'.$value['horizontal_alignment'].';' );

                    } ?>

                <div class="mt-how-to-step mt-has-img mt-step-img-<?php echo $value['image_alignment'];?>" >
                <?php } else { ?>
                <div class="mt-how-to-step mt-has-img mt-step-img-<?php echo $settings['step_image_alignment'];?>" >
                <?php } ?>

                    <?php if ( !empty( $value['step_title'] ) || !empty( $value['step_description'] ) ) { ?>
                        
                        <div <?php echo $this->get_render_attribute_string('mt-how-to-step-content'); ?>>
                            
                            <?php if ( !empty( $value['step_title'] ) ) { ?>
                                <?php if ( !empty($value['step_image_link']['url'] ) ) { ?>
                                    <a target="_blank" href="<?php echo $value['step_image_link']['url'];?>" >
                                <?php } ?>
                                    <<?php echo $settings['step_html_tag'];?> <?php echo $this->get_render_attribute_string('mt-how-to-step-title'); ?> ><?php echo $value['step_title'];?></<?php echo $settings['step_html_tag'];?> >
                                <?php if ( !empty($value['step_image_link']['url'] ) ) { ?>
                                    </a>
                                <?php } ?>

                            <?php } ?>

                            <?php if ( !empty( $value['step_description'] ) ) { ?>
                                <div class="mt-how-to-step-description"><?php echo $value['step_description'];?></div>
                            <?php } ?>

                        </div>

                    <?php } ?>

                    <?php if ( !empty( $value['step_image']['url'] ) ) { ?>

                        <?php
							$link_key = 'mt-lightbox-' . ( $key + 1 );

							if ( 'no' !== $settings['step_enable_lightbox'] ) {
								$this->add_render_attribute(
									$link_key,
									[
										'href'  => $value['step_image']['url'],
										'class' => 'elementor-clickable',
										'data-elementor-open-lightbox' => $settings['step_enable_lightbox'],
										'data-elementor-lightbox-slideshow' => $this->get_id(),
									]
								);
							}
							?>
                        
                        <div <?php echo $this->get_render_attribute_string('mt-how-to-step-image'); ?> >
                            <?php if ( 'no' !== $settings['step_enable_lightbox'] ) {
								echo '<a ' . wp_kses_post( $this->get_render_attribute_string( $link_key ) ) . '>';
							} ?>
                                <img src="<?php echo $value['step_image']['url'];?>" alt="Place Step Title Here" title="<?php echo $settings['steps_title'];?>" >
                            <?php if ( 'no' !== $settings['step_enable_lightbox'] ) {
                                echo '</a>';
                            } ?>
                        </div>

                    <?php } ?>

                </div>

            <?php } ?>
            
        </div>

    </div>

    <?php }

}
	