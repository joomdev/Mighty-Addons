<?php
namespace MightyAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils as Utils;
use Elementor\Repeater as Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Border;

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
		return __( 'MT Testimonial', 'mighty' );
	}
	
	public function get_icon() {
		return 'fas fa-id-card';
	}

	public function get_categories() {
		return [ 'mighty-addons' ];
	}
	
	public function get_script_depends() {
		return [ 'mt-testimonial', 'mighty-slick' ];
	}

	public function get_style_depends() {
		return [ 'mighty-slick', 'mt-testimonial' ];
	}
	
	protected function _register_controls() {
		$this->start_controls_section(
			'section_testimonials',
			[
				'label' => __( 'MT Testimonial', 'mighty' ),
			]
		);

			$repeater = new Repeater();

			$repeater->start_controls_tabs( 'testimonials' );

				$repeater->add_control(
					'image',
					[
						'label' => __( 'Testimonial Avatar', 'mighty' ),
						'type' => Controls_Manager::MEDIA,
						'default' => [
							'url' => Utils::get_placeholder_image_src(),
						],
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
							'testimonial' => 'Lorem Ipsum dolor sit amet..',
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
					'default' => '1',
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
					'default' => '1',
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
					'default' => 'yes',
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
						'size' => 10,
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
			
			$this->add_control(
				'border_size',
				[
					'label' => __( 'Border Width', 'mighty' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' ],
					'selectors' => [
						'{{WRAPPER}} .mighty-testimonial-wrapper .mt-testimonial-slide' => 'border-style: solid',
						'{{WRAPPER}} .mighty-testimonial .mt-testimonial-slide' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
                'testimonial_border_color',
                [
                    'label'     => __( 'Border Color', 'mighty' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .mighty-testimonial .mt-testimonial-slide' => 'border-color: {{VALUES}}'
					]
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
						'size' => 100,
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
						'size' => 1,
					],
					'selectors' => [
						'{{WRAPPER}} .mighty-testimonial-wrapper .mt-testimonial-slide .mt-testimonial-avatar img' => 'margin: {{SIZE}}{{UNIT}} auto',
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
						'size' => 1,
					],
					'selectors' => [
						'{{WRAPPER}} .mighty-testimonial-wrapper .mt-testimonial-slide .mt-person-testimonial' => 'margin: {{SIZE}}{{UNIT}} 0{{UNIT}}',
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
					'selectors' => [
						'{{WRAPPER}} .mighty-testimonial .mt-person-title' => 'color: {{VALUES}}'
					]
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

			$this->add_responsive_control(
				'arrows_fontsize',
				[
					'label' => __( 'Font Size', 'mighty' ),
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
				]
			);

			$this->add_responsive_control(
				'arrows_spacing',
				[
					'label' => __( 'Spacing', 'mighty' ),
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
						'size' => 5,
					],
					'selectors' => [
						'{{WRAPPER}} .mighty-testimonial-wrapper .prev-next .prev i' => 'margin-right: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} .mighty-testimonial-wrapper .prev-next .next i' => 'margin-left: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_control(
                'arrows_color',
                [
                    'label'     => __( 'Color', 'mighty' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .mighty-testimonial-wrapper .prev-next a i' => 'color: {{VALUES}}'
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
                ]
            );

		$this->end_controls_section();
	}
	
	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['testimonials'] ) ) {
			return;
		}

		$autoplaySlides = ($settings['enable_autoplay'] == "true" ? 'true' : 'false');
		$pauseOnHover = ($settings['pause_on_hover'] == "true" ? 'true' : 'false');
		$infiniteLoop = ($settings['infinite_loop'] == "true" ? 'true' : 'false');
		
		
		
		echo '<div class="mighty-testimonial-wrapper" id="mighty-testimonial-'. $this->get_id() .'">';

			if ( $settings['show_arrows'] === 'yes' ) {
				echo '<div class="prev-next">';
					echo '<a class="prev" role="button">';
						\Elementor\Icons_Manager::render_icon( $settings['prev_icon'], [ 'aria-hidden' => 'true' ] );
					echo '</a>';
				echo '</div>';
			}

			echo '<div class="mighty-testimonial" data-show-slides="' . $settings['slides_to_show'] . '" data-scroll-slides="' . $settings['slides_to_scroll'] . '" data-autoplay-status="' . $autoplaySlides . '" data-autoplay-speed="' . $settings['autoplay_speed'] . '" data-hover-pause="' . $pauseOnHover . '" data-infinite-looping="' . $infiniteLoop . '" data-transition-speed="' . $settings['transition_speed'] . '">';
			foreach (  $settings['testimonials'] as $index => $item ) {

				$slideId = substr( $this->get_id_int(), 0, 3 ) . $index+1;

				echo '<div class="mt-testimonial-slide testimonial-slide-'. $slideId .'">';

				echo '<div class="mt-person-testimonial">';
				echo '<blockquote>'. $item['testimonial_content'] .'</blockquote>';
				echo '</div>';

				echo '<div class="mt-testimonial-avatar">';
					echo '<img src="' . $item['image']['url'] .'" alt="' .$item['name'] . '">';
					echo '<div class="mt-person-name"><strong>' . $item['name'] . '</strong></div>';
				echo '</div>';
				
				if ( !empty($item['company_url']['url']) ) {
					$target = $item['company_url']['is_external'] ? ' target="_blank"' : '';
					$nofollow = $item['company_url']['nofollow'] ? ' rel="nofollow"' : '';

					echo '<div class="mt-person-title"><a href="' . $item['company_url']['url'] . '"' . $target . $nofollow . '>' . $item['title'] . '</a></div>';
				} else {
					echo '<div class="mt-person-title">' . $item['title'] . '</div>';
				}

				echo '</div>';
			}
			echo '</div>';

			if ( $settings['show_arrows'] === 'yes' ) {
				echo '<div class="prev-next">';
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
