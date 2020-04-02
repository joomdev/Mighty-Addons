<?php
namespace MightyAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils as Utils;
use \Elementor\Repeater;
use \Elementor\Scheme_Color;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;
use \Elementor\Scheme_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor MT_Progressbar
 *
 * Elementor widget for MT_Progressbar.
 *
 * @since 1.0.0
 */
class MT_Progressbar extends Widget_Base {
	
	public function get_name() {
		return 'mt-progressbar';
	}
	
	public function get_title() {
		return __( 'Progress Bar', 'mighty' );
	}
	
	public function get_icon() {
		return 'mf mf-progressbar';
	}

	public function get_categories() {
		return [ 'mighty-addons' ];
	}

	public function get_keywords() {
		return [ 'mighty', 'progress', 'bars' ];
    }

	public function get_style_depends() {
		return [ 'mt-progressbar' ];
	}
	
	protected function _register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Progress Bar', 'mighty' ),
			]
		);

			$this->add_control(
				'mt_progressbar_list',
				[
					'label' => __( 'Progress Bar', 'mighty' ),
					'type' => Controls_Manager::REPEATER,
					'default' => [
						[
							'mt_progressbar_title'         => __('Graphic Design','mighty'),
							'mt_progressbar_value'         => '93',
						],
						[
							'mt_progressbar_title'         => __('Web Design','mighty'),
							'mt_progressbar_value'         => '84',
						],
						[
							'mt_progressbar_title'         => __('Photoshop','mighty'),
							'mt_progressbar_value'         => '89',

						],
					],

					'fields' => [
						[
							'name'        => 'mt_progressbar_title',
							'label'       => __( 'Title', 'mighty' ),
							'type'        => Controls_Manager::TEXT,
							'default'     => __( 'Item' , 'mighty' ),
						],

						[
							'name' => 'mt_progressbar_value',
							'label' => __( 'Progress Bar Value', 'mighty' ),
							'type' => Controls_Manager::SLIDER,
							'range' => [
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => '%',
								'size' => 50,
							],
							'selectors' => [
								'{{WRAPPER}} .mighty-progressbar {{CURRENT_ITEM}} > .progressbar' => 'width: {{SIZE}}{{UNIT}};',
							]
						],

						[
							'name' => 'mt_progressbar_color',
							'label' => __( 'Progress Bar Color', 'mighty' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .mighty-progressbar .progress-bar{{CURRENT_ITEM}} > .progressbar' => 'background: {{VALUE}};',
							],
						],
						
						[
							'name' => 'mt_progressbar_bgcolor',
							'label' => __( 'Background Color', 'mighty' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .mighty-progressbar .progress-bar{{CURRENT_ITEM}}' => 'background: {{VALUE}};',
							],
						],
					],
					'title_field' => '{{{ mt_progressbar_title }}}',
				]
			);

        $this->end_controls_section();
        
        // ProgressBar Styling
        $this->start_controls_section(
			'progressbar_style',
			[
				'label' => __( 'Progress Bar Styling', 'mighty' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'bar_type',
				[
					'label' => __( 'Bar Type', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'default',
					'options' => [
						'default'  => __( 'Default', 'mighty' ),
						'striped' => __( 'Striped', 'mighty' ),
						'animated' => __( 'Animated Striped', 'mighty' ),
					],
				]
			);

			$this->add_control(
				'mt_title_position',
				[
					'label' => __( 'Title Position', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'outside',
					'options' => [
						'inside'  => __( 'Inside', 'mighty' ),
						'outside' => __( 'Outside', 'mighty' ),
					],
				]
			);

			$this->add_control(
				'mt_show_percentage',
				[
					'label' => __( 'Show percentage', 'mighty' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => __( 'On', 'mighty' ),
					'label_off' => __( 'Off', 'mighty' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);
			
			$this->add_control(
				'mt_percentage_position',
				[
					'label' => __( 'Percentage Position', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'outside',
					'options' => [
						'inside'  => __( 'Inside', 'mighty' ),
						'outside' => __( 'Outside', 'mighty' ),
					],
					'condition' => [
						'mt_show_percentage' => 'yes',
					],
				]
			);

			$this->add_responsive_control(
				'mt_progressbar_size',
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
						'size' => 10,
					],
					'selectors' => [
						'{{WRAPPER}} .progress-bar' => 'height: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_responsive_control(
				'mt_progressbar_spacing',
				[
					'label' => __( 'Spacing', 'mighty' ),
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
						'size' => 5,
					],
					'selectors' => [
						'{{WRAPPER}} .mighty-progressbar .progress-bar:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_control(
                'mt_progressbar_global_color',
                [
                    'label' => __( 'Color', 'mighty' ),
						  'type' => Controls_Manager::COLOR,
						  'default' => '#4965fb',
					'selectors' => [
						'{{WRAPPER}} .mighty-progressbar .progress-bar .progressbar' => 'background: {{VALUE}};',
					],
                ]
			);
			
			$this->add_control(
                'mt_progressbar_bg_color',
                [
                    'label' => __( 'Background Color', 'mighty' ),
						  'type' => Controls_Manager::COLOR,
						  'default' => '#e8eaf0',
                    'selectors' => [
                        '{{WRAPPER}} .mighty-progressbar .progress-bar' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'border_type',
					'label' => __( 'Border', 'mighty' ),
					'selector' => '{{WRAPPER}} .mighty-progressbar .progress-bar',
				]
			);

			$this->add_control(
                'border_radius',
                [
                    'label' => __( 'Border Radius', 'mighty' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px' ],
                    'selectors' => [
                        '{{WRAPPER}} .mighty-progressbar .progress-bar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
			);
            
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'bar_shadow',
                    'label' => __( 'Bar Shadow', 'mighty' ),
                    'selector' => '{{WRAPPER}} .mighty-progressbar .progress-bar',
                ]
            );

		$this->end_controls_section();

		// Text Styling
        $this->start_controls_section(
			'progressbar_text_style',
			[
				'label' => __( 'Text Styling', 'mighty' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'text_color',
				[
					'label' => __( 'Text Color', 'mighty' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#333',
					'selectors' => [
						'{{WRAPPER}} .mighty-progressbar' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
                    'name' => 'mighty_title_typography',
                    'label' => __( 'Typography', 'mighty' ),
					'scheme' => Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .mighty-progressbar .progressbar-details *',
				]
            );

        $this->end_controls_section();
	}
	
	protected function render() {
        $settings = $this->get_settings_for_display();

        $animation = false;
        $striped = false;
        $percentage = false;

        if ( $settings['bar_type'] === 'animated' ) {
			$animation = true;
			$striped = true;
        }
        if ( $settings['bar_type'] === 'striped' ) {
            $striped = true;
        }
        if ( $settings['mt_show_percentage'] === 'yes' ) {
            $percentage = true;
        }

        echo '<div class="mighty-progressbar">';
        foreach ( $settings['mt_progressbar_list'] as $progressbar ) :

			if ( $settings['mt_title_position'] === 'outside' || $settings['mt_percentage_position'] === 'outside' ) {

				echo '<div class="progressbar-details">';

					if ( $settings['mt_title_position'] === 'outside' ) {
						echo '<div class="progressbar-title">'. $progressbar['mt_progressbar_title'] . '</div>';
					}

					if ( $settings['mt_percentage_position'] === 'outside' ) {
						echo '<div class="progressbar-percentage">' . ( ($percentage===true) ? $progressbar['mt_progressbar_value']['size'] . $progressbar['mt_progressbar_value']['unit'] .'' : '' ) .'</div>';
					}

				echo '</div>';

			}

            echo '<div class="progress-bar'. (($animation===true) ? ' animated' : '') .''. (($striped===true) ? ' striped' : '') .' elementor-repeater-item-'. $progressbar['_id'] . '">';

			echo '<div class="progressbar">';

				if ( $settings['mt_title_position'] === 'inside' || $settings['mt_percentage_position'] === 'inside' ) {
					
					echo '<div class="progressbar-details">';

					if ( $settings['mt_title_position'] === 'inside' ) {
						echo '<div class="progressbar-title">'. $progressbar['mt_progressbar_title'] . '</div>';
					}
	
					if ( $settings['mt_percentage_position'] === 'inside' ) {
						echo '<div class="progressbar-percentage">' . ( ($percentage===true) ? $progressbar['mt_progressbar_value']['size'] . $progressbar['mt_progressbar_value']['unit'] .'' : '' ) .'</div>';
					}

					echo '</div>';

				}
			
            echo '</div>';	# .progressbar
            echo '</div>';	# .progress-bar
        endforeach;
        echo '</div>'; # .mighty-progressbar
	}
	
	protected function _content_template() {
	}
}
