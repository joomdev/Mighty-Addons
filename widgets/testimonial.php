<?php
namespace MightyAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils as Utils;
use Elementor\Repeater as Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor MT_Testimonial
 *
 * Elementor widget for MT_Testimonial.
 *
 * @since 1.0.0
 */
class MT_Testimonial extends Widget_Base {
	
	public function get_name() {
		return 'mt-testimonial';
	}
	
	public function get_title() {
		return __( 'Testimonial', 'mighty' );
	}
	
	public function get_icon() {
		return 'mf mf-testimonial';
	}

	public function get_categories() {
		return [ 'mighty-addons' ];
	}

	public function get_keywords() {
		return [ 'mighty', 'testimonial', 'recommendation' ];
    }
	
	public function get_script_depends() {
		return [ 'mt-testimonial', 'mighty-slickjs' ];
	}

	public function get_style_depends() {
		return [ 'mighty-slickcss', 'mt-testimonial' ];
	}
	
	protected function _register_controls() {
		$this->start_controls_section(
			'section_testimonials',
			[
				'label' => __( 'Testimonial', 'mighty' ),
			]
		);

			$repeater = new Repeater();

			$repeater->start_controls_tabs( 'testimonials' );

				$repeater->add_control(
					'avatar_image',
					[
						'label' => __( 'Testimonial Avatar', 'mighty' ),
						'type' => Controls_Manager::MEDIA,
						'default' => [
							'url' => Utils::get_placeholder_image_src(),
						],
					]
				);

				$repeater->add_group_control(
					Group_Control_Image_Size::get_type(),
					[
						'name' => 'avatar_image_size',
						'default' => 'full',
					]
				);

				$repeater->add_control(
					'name',
					[
						'label' => __( 'Name', 'mighty' ),
						'type' => Controls_Manager::TEXT,
						'default' => 'Darth Vader',
					]
				);

				$repeater->add_control(
					'title',
					[
						'label' => __( 'Title', 'mighty' ),
						'type' => Controls_Manager::TEXT,
						'default' => 'Digital Overlord',
					]
				);

				$repeater->add_control(
					'company_url',
					[
						'label' => __( 'Company URL', 'mighty' ),
						'type' => \Elementor\Controls_Manager::URL,
						'placeholder' => __( 'https://your-company-link.com', 'mighty' ),
						'show_external' => true,
						'default' => [
							'url' => '',
							'is_external' => true,
							'nofollow' => true,
						],
					]
				);

				$repeater->add_control(
					'testimonial_content',
					[
						'label' => __( 'Content', 'mighty' ),
						'type' => \Elementor\Controls_Manager::WYSIWYG,
						'placeholder' => __( 'Type your description here', 'mighty' ),
						'default' => 'Testimonial goes here..'
					]
				);
			
			$repeater->end_controls_tabs();

			$this->add_control(
				'testimonials',
				[
					'label' => __( 'Testimonials', 'mighty' ),
					'type' => Controls_Manager::REPEATER,
					'show_label' => true,
					'fields' => $repeater->get_controls(),
					'default' => [
						[
							'image' => Utils::get_placeholder_image_src(),
							'name' => __( 'Darth Vader', 'mighty' ),
							'title' => __( 'Digital Overlord', 'mighty' ),
							'testimonial_content' => 'The circle is now complete. When I left you, I was but the learner. Now I am the master.',
						],
						[
							'image' => Utils::get_placeholder_image_src(),
							'name' => __( 'Yoda', 'mighty' ),
							'title' => __( 'Digital Master', 'mighty' ),
							'testimonial_content' => 'If you end your training now — if you choose the quick and easy path as Vader did — you will become an agent of evil.',
						],
					]
				]
			);

			// $this->add_control(
			// 	'testimonial_skin',
			// 	[
			// 		'label' => __( 'Skin', 'mighty' ),
			// 		'type' => \Elementor\Controls_Manager::SELECT,
			// 		'default' => 'skin-default',
			// 		'options' => [
			// 			'skin-default'  => __( 'Default', 'mighty' ),
			// 			'skin-bubble' => __( 'Bubble', 'mighty' ),
			// 		],
			// 	]
			// );

			$this->add_responsive_control(
				'slides_to_show',
				[
					'label' => __( 'Slides To Show', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default'        => '1',
					'tablet_default' => '1',
					'mobile_default' => '1',
					'options' => [
						'1' => __( '1', 'mighty' ),
						'2' => __( '2', 'mighty' ),
						'3' => __( '3', 'mighty' ),
						'4' => __( '4', 'mighty' ),
						'5' => __( '5', 'mighty' ),
						'6' => __( '6', 'mighty' ),
						'7' => __( '7', 'mighty' ),
						'8' => __( '8', 'mighty' ),
						'9' => __( '9', 'mighty' ),
						'10' => __( '10', 'mighty' ),
					],
				]
			);

			$this->add_responsive_control(
				'slides_to_scroll',
				[
					'label' => __( 'Slides To Scroll', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default'        => '1',
					'tablet_default' => '1',
					'mobile_default' => '1',
					'options' => [
						'1' => __( '1', 'mighty' ),
						'2' => __( '2', 'mighty' ),
						'3' => __( '3', 'mighty' ),
						'4' => __( '4', 'mighty' ),
						'5' => __( '5', 'mighty' ),
						'6' => __( '6', 'mighty' ),
						'7' => __( '7', 'mighty' ),
						'8' => __( '8', 'mighty' ),
						'9' => __( '9', 'mighty' ),
						'10' => __( '10', 'mighty' ),
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_navigation',
			[
				'label' => __( 'Navigation', 'mighty' ),
			]
		);

			$this->add_control(
				'show_arrows',
				[
					'label' => __( 'Show Arrows', 'mighty' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => __( 'On', 'mighty' ),
					'label_off' => __( 'Off', 'mighty' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

			$this->add_control(
				'show_bullets',
				[
					'label' => __( 'Show Bullets', 'mighty' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => __( 'On', 'mighty' ),
					'label_off' => __( 'Off', 'mighty' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

			$this->add_control(
				'transition_speed',
				[
					'label' => __( 'Transition Speed', 'mighty' ),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'min' => 100,
					'step' => 10,
					'default' => 300,
				]
			);



			$this->add_control(
				'enable_autoplay',
				[
					'label' => __( 'Enable Autoplay', 'mighty' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => __( 'On', 'mighty' ),
					'label_off' => __( 'Off', 'mighty' ),
					'return_value' => 'true',
					'default' => 'yes',
				]
			);

			$this->add_control(
				'autoplay_speed',
				[
					'label' => __( 'Autoplay Speed', 'mighty' ),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'min' => 100,
					'step' => 10,
					'default' => 2000,
					'condition' => [
						'enable_autoplay' => 'true'
					]
				]
			);

			$this->add_control(
				'pause_on_hover',
				[
					'label' => __( 'Pause on Hover', 'mighty' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => __( 'On', 'mighty' ),
					'label_off' => __( 'Off', 'mighty' ),
					'return_value' => 'true',
					'default' => 'yes',
					'condition' => [
						'enable_autoplay' => 'true'
					]
				]
			);

			$this->add_control(
				'infinite_loop',
				[
					'label' => __( 'Infinite Loop', 'mighty' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => __( 'On', 'mighty' ),
					'label_off' => __( 'Off', 'mighty' ),
					'return_value' => 'true',
					'default' => 'true',
				]
			);

		$this->end_controls_section();

		// Testimonial Styling
		$this->start_controls_section(
			'testimonial_style',
			[
				'label' => __( 'Testimonial', 'mighty' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_responsive_control(
				'space_between_slides',
				[
					'label' => __( 'Space Between Slides', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 50,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 0,
					],
					'selectors' => [
						'{{WRAPPER}} .mighty-testimonial-wrapper .mt-testimonial-slide' => 'margin: 0 {{SIZE}}{{UNIT}}',
					],
				]
			);
			
			$this->add_control(
                'testimonial_bg_color',
                [
                    'label'     => __( 'Background Color', 'mighty' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .mighty-testimonial .mt-testimonial-slide' => 'background-color: {{VALUES}}'
					]
                ]
			);
			
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'mt_testimonial_border',
					'label' => __( 'Border', 'plugin-domain' ),
					'selector' => '{{WRAPPER}} .mighty-testimonial .mt-testimonial-slide',
				]
			);

			$this->add_responsive_control(
				'border_radius',
				[
					'label' => __( 'Border Radius', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 100,
						],
						'%' => [
							'min' => 0,
							'max' => 50,
						]
					],
					'default' => [
						'unit' => 'px',
						'size' => 1,
					],
					'selectors' => [
						'{{WRAPPER}} .mighty-testimonial-wrapper .mt-testimonial-slide' => 'border-radius: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_control(
				'testimonial_padding',
				[
					'label' => __( 'Padding', 'mighty' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' ],
					'selectors' => [
						'{{WRAPPER}} .mighty-testimonial .mt-testimonial-slide' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'testimonial_boxshadow',
					'label' => __( 'Box Shadow', 'mighty' ),
					'selector' => '{{WRAPPER}} .mighty-testimonial .mt-testimonial-slide',
				]
			);

		$this->end_controls_section();

		// Avatar Styling
		$this->start_controls_section(
			'avatar_styling',
			[
				'label' => __( 'Avatar', 'mighty' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_responsive_control(
				'avatar_size',
				[
					'label' => __( 'Size', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 200,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 70,
					],
					'selectors' => [
						'{{WRAPPER}} .mighty-testimonial-wrapper .mt-testimonial-slide .mt-testimonial-avatar img' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_responsive_control(
				'avatar_gap',
				[
					'label' => __( 'Gap', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 20,
					],
					'selectors' => [
						'{{WRAPPER}} .mighty-testimonial-wrapper .mt-testimonial-slide .mt-testimonial-avatar' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'avatar_border',
					'label' => __( 'Border Type', 'mighty' ),
					'selector' => '{{WRAPPER}} .mighty-testimonial-wrapper .mt-testimonial-slide .mt-testimonial-avatar img',
				]
			);

			$this->add_responsive_control(
				'avatar_border_radius',
				[
					'label' => __( 'Border Radius', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 100,
					],
					'selectors' => [
						'{{WRAPPER}} .mighty-testimonial-wrapper .mt-testimonial-slide .mt-testimonial-avatar img' => 'border-radius: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_responsive_control(
				'avatar_alignment',
				[
					'label' => __( 'Alignment', 'mighty' ),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'options' => [
						'0 auto 0 0' => [
							'title' => __( 'Left', 'mighty' ),
							'icon' => 'fa fa-align-left',
						],
						'0 auto' => [
							'title' => __( 'Center', 'mighty' ),
							'icon' => 'fa fa-align-center',
						],
						'0 0 0 auto' => [
							'title' => __( 'Right', 'mighty' ),
							'icon' => 'fa fa-align-right',
						],
                    ],
                    'default' => '0 auto',
                    'selectors' => [
                        '{{WRAPPER}} .mighty-testimonial-wrapper .mt-testimonial-slide .mt-testimonial-avatar img' => 'margin: {{VALUE}};'
                    ],
					'toggle' => true,
				]
            );

		$this->end_controls_section();

		// Content Styling
		$this->start_controls_section(
			'content_styling',
			[
				'label' => __( 'Content', 'mighty' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_responsive_control(
				'content_gap',
				[
					'label' => __( 'Gap', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 20,
					],
					'selectors' => [
						'{{WRAPPER}} .mighty-testimonial-wrapper .mt-testimonial-slide .mt-person-testimonial' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'testimonial_content_color',
                [
                    'label'     => __( 'Color', 'mighty' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .mighty-testimonial .mt-testimonial-slide .mt-person-testimonial blockquote' => 'color: {{VALUES}}'
					]
                ]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'testimonial_typography',
					'scheme' => Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .mighty-testimonial .mt-testimonial-slide .mt-person-testimonial blockquote',
				]
			);

			$this->add_responsive_control(
				'content_alignment',
				[
					'label' => __( 'Alignment', 'mighty' ),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => __( 'Left', 'mighty' ),
							'icon' => 'fa fa-align-left',
						],
						'center' => [
							'title' => __( 'Center', 'mighty' ),
							'icon' => 'fa fa-align-center',
						],
						'right' => [
							'title' => __( 'Right', 'mighty' ),
							'icon' => 'fa fa-align-right',
						],
					],
					'default' => 'center',
					'toggle' => true,
					'selectors' => [
						'{{WRAPPER}} .mighty-testimonial-wrapper .mt-person-testimonial blockquote' => 'text-align: {{VALUE}};',
					],
				]
			);

		$this->end_controls_section();

		// Author Styling
		$this->start_controls_section(
			'author_style',
			[
				'label' => __( 'Author', 'mighty' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'author_typography',
					'scheme' => Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .mighty-testimonial .mt-person-name',
				]
			);

			$this->add_control(
                'author_color',
                [
                    'label'     => __( 'Color', 'mighty' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .mighty-testimonial .mt-person-name' => 'color: {{VALUES}}'
					]
                ]
			);
			
			$this->add_responsive_control(
				'author_alignment',
				[
					'label' => __( 'Alignment', 'mighty' ),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => __( 'Left', 'mighty' ),
							'icon' => 'fa fa-align-left',
						],
						'center' => [
							'title' => __( 'Center', 'mighty' ),
							'icon' => 'fa fa-align-center',
						],
						'right' => [
							'title' => __( 'Right', 'mighty' ),
							'icon' => 'fa fa-align-right',
						],
					],
					'default' => 'center',
					'toggle' => true,
					'selectors' => [
						'{{WRAPPER}} .mighty-testimonial-wrapper  .mighty-testimonial .mt-person-name' => 'text-align: {{VALUE}};',
					],
				]
			);

		$this->end_controls_section();

		// Author title Styling
		$this->start_controls_section(
			'author_title_style',
			[
				'label' => __( 'Author Title', 'mighty' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'author_title_typography',
					'scheme' => Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .mighty-testimonial .mt-person-title',
				]
			);

			$this->add_control(
                'author_title_color',
                [
                    'label'     => __( 'Color', 'mighty' ),
					'type'      => Controls_Manager::COLOR,
					'default'	=> '#6A5E5E',
					'selectors' => [
						'{{WRAPPER}} .mighty-testimonial .mt-person-title' => 'color: {{VALUES}}'
					]
                ]
			);
			
			$this->add_responsive_control(
				'author_title_alignment',
				[
					'label' => __( 'Alignment', 'mighty' ),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => __( 'Left', 'mighty' ),
							'icon' => 'fa fa-align-left',
						],
						'center' => [
							'title' => __( 'Center', 'mighty' ),
							'icon' => 'fa fa-align-center',
						],
						'right' => [
							'title' => __( 'Right', 'mighty' ),
							'icon' => 'fa fa-align-right',
						],
					],
					'default' => 'center',
					'toggle' => true,
					'selectors' => [
						'{{WRAPPER}} .mighty-testimonial-wrapper  .mighty-testimonial .mt-person-title' => 'text-align: {{VALUE}};',
					],
				]
			);

		$this->end_controls_section();

		// Pagination Styling
		$this->start_controls_section(
			'arrows_style',
			[
				'label' => __( 'Pagination', 'mighty' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'arrows_heading',
				[
					'label' => __( 'Arrows', 'mighty' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'show_arrows' => 'yes'
					]
				]
			);

			$this->add_responsive_control(
				'arrows_fontsize',
				[
					'label' => __( 'Arrows - Font Size', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px', 'em', 'rem' ],
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 200,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 20,
					],
					'selectors' => [
						'{{WRAPPER}} .mighty-testimonial-wrapper .prev-next a i' => 'font-size: {{SIZE}}{{UNIT}}',
					],
					'condition' => [
						'show_arrows' => 'yes'
					]
				]
			);

			$this->add_control(
                'arrows_color',
                [
                    'label'     => __( 'Color', 'mighty' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .mighty-testimonial-wrapper .prev-next a i' => 'color: {{VALUES}};'
					],
					'condition' => [
						'show_arrows' => 'yes'
					]
                ]
			);
			
			$this->add_control(
                'prev_icon',
                [
                    'label' => __( 'Previous Icon', 'mighty' ),
                    'type' => Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-chevron-left',
                        'library' => 'solid',
                    ],
					'condition' => [
						'show_arrows' => 'yes'
					]
                ]
			);
			
			$this->add_control(
                'next_icon',
                [
                    'label' => __( 'Next Icon', 'mighty' ),
                    'type' => Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-chevron-right',
                        'library' => 'solid',
                    ],
					'condition' => [
						'show_arrows' => 'yes'
					]
                ]
			);

			$this->add_control(
				'dots_heading',
				[
					'label' => __( 'Dots', 'mighty' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'show_bullets' => 'yes'
					]
				]
			);

			$this->add_responsive_control(
				'dots_fontsize',
				[
					'label' => __( 'Dots - Font Size', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px', 'em', 'rem' ],
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 50,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 10,
					],
					'selectors' => [
						'{{WRAPPER}} .mighty-testimonial .slick-dots li button::before' => 'font-size: {{SIZE}}{{UNIT}}',
					],
					'condition' => [
						'show_bullets' => 'yes'
					]
				]
			);
			
			$this->add_control(
                'dots_color',
                [
                    'label'     => __( 'Color', 'mighty' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .mighty-testimonial .slick-dots li button::before' => 'color: {{VALUES}}'
					],
					'condition' => [
						'show_bullets' => 'yes'
					]
                ]
			);

			$this->add_control(
                'dots_bgcolor',
                [
                    'label'     => __( 'Background Color', 'mighty' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .mighty-testimonial .slick-dots li button' => 'background-color: {{VALUES}}'
					],
					'condition' => [
						'show_bullets' => 'yes'
					]
                ]
			);

			$this->add_control(
                'dots_hover_bgcolor',
                [
                    'label'     => __( 'Hover Background Color', 'mighty' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .mighty-testimonial .slick-dots li button:hover' => 'background-color: {{VALUES}}'
					],
					'condition' => [
						'show_bullets' => 'yes'
					]
                ]
			);

		$this->end_controls_section();
	}
	
	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['testimonials'] ) ) {
			return;
		}
		
		echo '<div class="mighty-testimonial-wrapper" id="mighty-testimonial-'. $this->get_id() .'">';

			if ( $settings['show_arrows'] === 'yes' ) {
				echo '<div class="prev-next prev-icon">';
					echo '<a class="prev" role="button">';
						\Elementor\Icons_Manager::render_icon( $settings['prev_icon'], [ 'aria-hidden' => 'true' ] );
					echo '</a>';
				echo '</div>';
			}

			$this->add_render_attribute( 'mighty-testimonial', 'class', 'mighty-testimonial' );
			$this->add_render_attribute( 'mighty-testimonial', 'data-show-slides-desktop', $settings['slides_to_show'] );
			$this->add_render_attribute( 'mighty-testimonial', 'data-show-slides-tablet', $settings['slides_to_show_tablet'] );
			$this->add_render_attribute( 'mighty-testimonial', 'data-show-slides-mobile', $settings['slides_to_show_mobile'] );

			$this->add_render_attribute( 'mighty-testimonial', 'data-scroll-slides-desktop', $settings['slides_to_scroll'] );
			$this->add_render_attribute( 'mighty-testimonial', 'data-scroll-slides-tablet', $settings['slides_to_scroll_tablet'] );
			$this->add_render_attribute( 'mighty-testimonial', 'data-scroll-slides-mobile', $settings['slides_to_scroll_mobile'] );

			$this->add_render_attribute( 'mighty-testimonial', 'data-autoplay-status', ($settings['enable_autoplay'] == "true" ? 'true' : 'false') );
			$this->add_render_attribute( 'mighty-testimonial', 'data-autoplay-speed', $settings['autoplay_speed'] );
			$this->add_render_attribute( 'mighty-testimonial', 'data-hover-pause', ($settings['pause_on_hover'] == "true" ? 'true' : 'false') );
			$this->add_render_attribute( 'mighty-testimonial', 'data-infinite-looping', ($settings['infinite_loop'] == "true" ? 'true' : 'false') );
			$this->add_render_attribute( 'mighty-testimonial', 'data-transition-speed', $settings['transition_speed'] );
			$this->add_render_attribute( 'mighty-testimonial', 'data-enable-dots', ($settings['show_bullets'] == "yes" ? 'true' : 'false') );

			echo '<div ' . $this->get_render_attribute_string( 'mighty-testimonial' ) . '>';
			foreach (  $settings['testimonials'] as $index => $item ) {

				$slideId = substr( $this->get_id_int(), 0, 3 ) . ( $index + 1 );

				echo '<div class="mt-slick-slide">';
				echo '<div class="mt-testimonial-slide testimonial-slide-'. $slideId .'">';

				echo '<div class="mt-person-testimonial">';
				echo '<blockquote>'. $item['testimonial_content'] .'</blockquote>';
				echo '</div>';

				echo '<div class="mt-testimonial-avatar">';
					echo Group_Control_Image_Size::get_attachment_image_html( $item, 'avatar_image_size', 'avatar_image' );
				echo '</div>';

				echo '<div class="mt-person-name"><strong>' . $item['name'] . '</strong></div>';
				
				if ( !empty($item['company_url']['url']) ) {
					$target = $item['company_url']['is_external'] ? ' target="_blank"' : '';
					$nofollow = $item['company_url']['nofollow'] ? ' rel="nofollow"' : '';

					echo '<div class="mt-person-title"><a href="' . $item['company_url']['url'] . '"' . $target . $nofollow . '>' . $item['title'] . '</a></div>';
				} else {
					echo '<div class="mt-person-title">' . $item['title'] . '</div>';
				}

				echo '</div>';
				echo '</div>';
			}
			echo '</div>';

			if ( $settings['show_arrows'] === 'yes' ) {
				echo '<div class="prev-next next-icon">';
					echo '<a class="next" role="button">';
						\Elementor\Icons_Manager::render_icon( $settings['next_icon'], [ 'aria-hidden' => 'true' ] );
					echo '</a>';
				echo '</div>';
			}
			
		echo '</div>';
	}
	
	protected function _content_template() {
	}
}
