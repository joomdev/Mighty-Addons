<?php
namespace MightyAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils as Utils;
use \Elementor\Group_Control_Typography;
use \Elementor\Scheme_Typography;
use \Elementor\Scheme_Color;
use \Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor MT_Counter
 *
 * Elementor widget for MT_Counter.
 *
 * @since 1.0.0
 */
class MT_Counter extends Widget_Base {
	
	public function get_name() {
		return 'mt-counter';
	}
	
	public function get_title() {
		return __( 'Counter', 'mighty' );
	}
	
	public function get_icon() {
		return 'mf mf-counter';
	}

	public function get_categories() {
		return [ 'mighty-addons' ];
	}

	public function get_keywords() {
		return [ 'mighty', 'counter', 'icon' ];
    }

	public function get_style_depends() {
		return [ 'mt-counter' ];
    }
    
    public function get_script_depends() {
		return [ 'mt-counter' ];
	}
	
	protected function _register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Counter', 'mighty' ),
			]
		);

			$this->add_control(
				'counter_title',
				[
					'label' => __( 'Title', 'mighty' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __( 'Cups of Coffee', 'mighty' ),
					'placeholder' => __( 'Title', 'mighty' ),
				]
			);
			
			$this->add_control(
                'starting_number',
                [
                    'label' => __( 'Starting Number', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                    'default' => 1,
                ]
            );

            $this->add_control(
                'ending_number',
                [
                    'label' => __( 'Ending Number', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                    'default' => 1000,
                ]
            );

            $this->add_control(
                'number_prefix',
                [
                    'label' => __( 'Number Prefix', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'placeholder' => __( '₹', 'mighty' ),
                ]
			);
			
			$this->add_control(
				'number_suffix',
				[
					'label' => __( 'Number Suffix', 'mighty' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'placeholder' => __( '/-')
				]
			);

			$this->add_control(
				'show_counter_icon',
				[
					'label' => __( 'Show Icon', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => __( 'Show', 'mighty' ),
					'label_off' => __( 'Hide', 'mighty' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

            $this->add_control(
                'counter_icon',
                [
                    'label' => __( 'Icon', 'mighty' ),
					'type' => Controls_Manager::ICONS,
					'condition' => [
                        'show_counter_icon' => 'yes'
					],
					'default' => [
						'value' => 'fas fa-coffee',
						'library' => 'solid',
					],
                ]
			);

			$this->add_control(
				'number_separator',
				[
					'label' => __( 'Thousand Separator', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'none',
					'options' => [
						'none'  => __( 'None', 'mighty' ),
						'comma' => __( 'Comma', 'mighty' ),
						'dot' => __( 'Dot', 'mighty' ),
					],
				]
			);
			
			$this->add_control(
				'mtanimation_duration',
				[
					'label' => __( 'Animation Duration', 'mighty' ),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'default' => 2000,
				]
			);

        $this->end_controls_section();

        // Icon Styling
        $this->start_controls_section(
			'counter_icon_style',
			[
				'label' => __( 'Icon Styling', 'mighty' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_counter_icon' => 'yes'
				],
			]
		);

			$this->add_responsive_control(
				'icon_spacing',
				[
					'label' => __( 'Icon Spacing', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 200,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 0,
					],
					'selectors' => [
						'{{WRAPPER}} .mighty-counter .mt-counter-icon' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					],
					'condition' => [
						'show_counter_icon' => 'yes'
					],
				]
			);

			$this->add_responsive_control(
				'counter_icon_size',
				[
					'label' => __( 'Size', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 300,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 40,
					],
					'selectors' => [
						'{{WRAPPER}} .mighty-counter .mt-counter-icon i' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .mighty-counter .mt-counter-icon svg' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
            );

            $this->add_responsive_control(
				'counter_padding',
				[
					'label' => __( 'Padding', 'mighty' ),
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
						'size' => 0,
					],
					'selectors' => [
						'{{WRAPPER}} .mighty-counter .mt-counter-icon *' => 'padding: {{SIZE}}{{UNIT}};',
						// '{{WRAPPER}} .mighty-counter .mt-counter-icon svg' => 'padding: {{SIZE}}{{UNIT}};',
					],
				]
			);
			
			$this->add_control(
                'counter_icon_color',
                [
                    'label'     => __( 'Color', 'mighty' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .mighty-counter .mt-counter-icon *' => 'color: {{VALUE}};'
					]
                ]
			);
			
			$this->add_control(
                'counter_icon_bgcolor',
                [
                    'label'     => __( 'Background Color', 'mighty' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .mighty-counter .mt-counter-icon *' => 'background-color: {{VALUE}};'
					]
                ]
			);
			
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'icon_border_type',
					'label' => __( 'Icon Border Type', 'mighty' ),
					'selector' => '{{WRAPPER}} .mighty-counter .mt-counter-icon *',
				]
			);

			$this->add_control(
                'border_radius',
                [
                    'label' => __( 'Border Radius', 'mighty' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px' ],
                    'selectors' => [
                        '{{WRAPPER}} .mighty-counter .mt-counter-icon *' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
			);

        $this->end_controls_section();

        // Counter Styling
        $this->start_controls_section(
			'counter_style',
			[
				'label' => __( 'Counter Styling', 'mighty' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_responsive_control(
				'counter_spacing',
				[
					'label' => __( 'Counter Spacing', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 200,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 0,
					],
					'selectors' => [
						'{{WRAPPER}} .mighty-counter .mtcounter-content .counter' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					]
				]
			);

			$this->add_control(
				'counter_color',
				[
					'label' => __( 'Color', 'mighty' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#000',
					'selectors' => [
						'{{WRAPPER}} .mighty-counter .counter' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'counter_typography',
					'scheme' => Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .mighty-counter .counter *',
				]
			);

			$this->add_control(
				'counter_position',
				[
					'label' => __( 'Counter Position', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'above',
					'options' => [
						'above'  => __( 'Above Title', 'mighty' ),
						'below' => __( 'Below Title', 'mighty' ),
					],
				]
			);

        $this->end_controls_section();
        
        // Title Styling
        $this->start_controls_section(
			'counter_title_style',
			[
				'label' => __( 'Title Styling', 'mighty' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'title_color',
				[
					'label' => __( 'Color', 'mighty' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#000',
					'selectors' => [
						'{{WRAPPER}} .mighty-counter .counter-title' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'title_typography',
					'scheme' => Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .mighty-counter .counter-title',
				]
			);

		$this->end_controls_section();
	}
	
	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$counter =	'<div class="counter"> ' .
						( !empty($settings['number_prefix']) ? '<span class="count-prefix">'. $settings['number_prefix'] .'</span>' : '') .

						'<span class="count" data-num-separator="'. $settings['number_separator'] .'" data-start-number="'. $settings['starting_number'] .'" data-end-number="'. $settings['ending_number'] .'" data-animation="'. $settings['mtanimation_duration'] .'">'. $settings['ending_number'] .'</span>' .

						( !empty($settings['number_suffix']) ? '<span class="count-suffix">'. $settings['number_suffix'] .'</span>' : '') .
					'</div>';
		
		// Icon Rendering Starts
		echo '<div class="mighty-counter">';
		
		// if icon is set
		if ( 'yes' === $settings['show_counter_icon'] && ! empty($settings['counter_icon']['value']) ) {
			echo '<div class="mt-counter-icon">';
				\Elementor\Icons_Manager::render_icon( $settings['counter_icon'], [ 'aria-hidden' => 'true', 'class' => 'counter-icon' ] );
			echo '</div>';
		}
		
			echo '<div class="mtcounter-content">';
				// For counter position above title
				if ( 'above' === $settings['counter_position'] ) {
					echo $counter;
				}

				echo '<div class="counter-title">'. $settings['counter_title'] .'</div>';
				
				// For counter position below title
				if ( 'below' === $settings['counter_position'] ) {
					echo $counter;
				}
			echo '</div>';
        echo '</div>';
	}
	
	protected function _content_template() {
	}
}
