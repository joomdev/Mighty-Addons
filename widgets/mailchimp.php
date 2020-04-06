<?php
namespace MightyAddons\Widgets;


use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor MT_Mailchimp
 *
 * Elementor widget for MT_Mailchimp.
 *
 * @since 1.3.3
 */
class MT_Mailchimp extends Widget_Base {
	
	public function get_name() {
		return 'mt-mailchimp';
	}
	
	public function get_title() {
		return __( 'Mailchimp', 'mighty' );
	}
	
	public function get_icon() {
		return 'mf mf-testimonial';
	}

	public function get_categories() {
		return [ 'mighty-addons' ];
	}

	public function get_keywords() {
		return [ 'mighty', 'mail', 'chimp', 'form' ];
    }
	
	public function get_script_depends() {
		return [  ];
	}

	public function get_style_depends() {
		return [  ];
	}
	
	protected function _register_controls() {
		
		$this->start_controls_section(
			'section_mailchimp',
			[
				'label' => __( 'Mailchimp', 'mighty' ),
			]
		);

			$this->add_control(
				'mailchimp_list',
				[
					'label' => __( 'Choose List', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'list'  => __( 'list', 'mighty' ),
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_mc_fields',
			[
				'label' => __( 'Fields', 'mighty' ),
			]
		);

			$this->add_control(
				'email_label',
				[
					'label' => __( 'Email Label', 'mighty' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'placeholder' => __( 'Type your title here', 'mighty' ),
				]
			);

			$this->add_responsive_control(
				'email_column_width',
				[
					'label' => __( 'Column Width', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'20'  => __( '20%', 'mighty' ),
						'25'  => __( '25%', 'mighty' ),
						'33'  => __( '33%', 'mighty' ),
						'40'  => __( '40%', 'mighty' ),
						'50'  => __( '50%', 'mighty' ),
						'60'  => __( '60%', 'mighty' ),
						'66'  => __( '66%', 'mighty' ),
						'75'  => __( '75%', 'mighty' ),
						'80'  => __( '80%', 'mighty' ),
						'100'  => __( '100%', 'mighty' ),
					],
				]
			);

			// First Name
			$this->add_control(
				'enable_first_name',
				[
					'label' => __( 'Enable First Name', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => __( 'Enable', 'mighty' ),
					'label_off' => __( 'Disable', 'mighty' ),
					'return_value' => 'yes',
				]
			);

			$this->add_control(
				'first_name',
				[
					'label' => __( 'First Name', 'mighty' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'placeholder' => __( 'Type your First Name', 'mighty' ),
					'condition' => [
						'enable_first_name' => 'yes'
					]
				]
			);

			$this->add_responsive_control(
				'fname_column_width',
				[
					'label' => __( 'First Name Column Width', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'20'  => __( '20%', 'mighty' ),
						'25'  => __( '25%', 'mighty' ),
						'33'  => __( '33%', 'mighty' ),
						'40'  => __( '40%', 'mighty' ),
						'50'  => __( '50%', 'mighty' ),
						'60'  => __( '60%', 'mighty' ),
						'66'  => __( '66%', 'mighty' ),
						'75'  => __( '75%', 'mighty' ),
						'80'  => __( '80%', 'mighty' ),
						'100'  => __( '100%', 'mighty' ),
					],
					'condition' => [
						'enable_first_name' => 'yes'
					]
				]
			);

			$this->add_control(
				'required_first_name',
				[
					'label' => __( 'Required', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => __( 'Enable', 'mighty' ),
					'label_off' => __( 'Disable', 'mighty' ),
					'return_value' => 'yes',
					'condition' => [
						'enable_first_name' => 'yes'
					]
				]
			);

			// Last Name
			$this->add_control(
				'enable_last_name',
				[
					'label' => __( 'Enable Last Name', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => __( 'Enable', 'mighty' ),
					'label_off' => __( 'Disable', 'mighty' ),
					'return_value' => 'yes',
				]
			);

			$this->add_control(
				'last_name',
				[
					'label' => __( 'Last Name', 'mighty' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'placeholder' => __( 'Type your Last Name', 'mighty' ),
					'condition' => [
						'enable_last_name' => 'yes'
					]
				]
			);

			$this->add_responsive_control(
				'lname_column_width',
				[
					'label' => __( 'Last Name Column Width', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'20'  => __( '20%', 'mighty' ),
						'25'  => __( '25%', 'mighty' ),
						'33'  => __( '33%', 'mighty' ),
						'40'  => __( '40%', 'mighty' ),
						'50'  => __( '50%', 'mighty' ),
						'60'  => __( '60%', 'mighty' ),
						'66'  => __( '66%', 'mighty' ),
						'75'  => __( '75%', 'mighty' ),
						'80'  => __( '80%', 'mighty' ),
						'100'  => __( '100%', 'mighty' ),
					],
					'condition' => [
						'enable_last_name' => 'yes'
					]
				]
			);

			$this->add_control(
				'required_last_name',
				[
					'label' => __( 'Required', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => __( 'Enable', 'mighty' ),
					'label_off' => __( 'Disable', 'mighty' ),
					'return_value' => 'yes',
					'condition' => [
						'enable_last_name' => 'yes'
					]
				]
			);

			// Terms
			$this->add_control(
				'agree_to_terms',
				[
					'label' => __( 'Agree To Terms', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => __( 'Enable', 'mighty' ),
					'label_off' => __( 'Disable', 'mighty' ),
					'return_value' => 'yes',
				]
			);

			$this->add_control(
				'acceptance_text',
				[
					'label' => __( 'Acceptance Text', 'mighty' ),
					'type' => \Elementor\Controls_Manager::WYSIWYG,
					'default' => __( 'I have read and agree to the terms & conditions.', 'mighty' ),
					'condition' => [
						'agree_to_terms' => 'yes'
					]
				]
			);

			$this->add_control(
				'checked_by_default',
				[
					'label' => __( 'Checked By Default', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => __( 'Yes', 'mighty' ),
					'label_off' => __( 'No', 'mighty' ),
					'return_value' => 'yes',
					'condition' => [
						'agree_to_terms' => 'yes'
					]
				]
			);

			$this->add_responsive_control(
				'terms_column_width',
				[
					'label' => __( 'Terms Column Width', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'20'  => __( '20%', 'mighty' ),
						'25'  => __( '25%', 'mighty' ),
						'33'  => __( '33%', 'mighty' ),
						'40'  => __( '40%', 'mighty' ),
						'50'  => __( '50%', 'mighty' ),
						'60'  => __( '60%', 'mighty' ),
						'66'  => __( '66%', 'mighty' ),
						'75'  => __( '75%', 'mighty' ),
						'80'  => __( '80%', 'mighty' ),
						'100'  => __( '100%', 'mighty' ),
					],
					'condition' => [
						'agree_to_terms' => 'yes'
					]
				]
			);

			$this->add_control(
				'required_terms',
				[
					'label' => __( 'Required', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => __( 'Enable', 'mighty' ),
					'label_off' => __( 'Disable', 'mighty' ),
					'return_value' => 'yes',
					'condition' => [
						'agree_to_terms' => 'yes'
					]
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_mc_submit',
			[
				'label' => __( 'Submit', 'mighty' ),
			]
		);

			$this->add_control(
				'button_text',
				[
					'label' => __( 'Button Text', 'mighty' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'placeholder' => __( 'Button Text', 'mighty' ),
					'default' => __( 'Subscribe Now', 'mighty' ),
				]
			);

			$this->add_control(
				'loading_text',
				[
					'label' => __( 'Loading Text', 'mighty' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'placeholder' => __( 'Loading Text', 'mighty' ),
					'default' => __( 'Subscribing...', 'mighty' ),
				]
			);

			$this->add_responsive_control(
				'submit_column_width',
				[
					'label' => __( 'Submit Column Width', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'20'  => __( '20%', 'mighty' ),
						'25'  => __( '25%', 'mighty' ),
						'33'  => __( '33%', 'mighty' ),
						'40'  => __( '40%', 'mighty' ),
						'50'  => __( '50%', 'mighty' ),
						'60'  => __( '60%', 'mighty' ),
						'66'  => __( '66%', 'mighty' ),
						'75'  => __( '75%', 'mighty' ),
						'80'  => __( '80%', 'mighty' ),
						'100' => __( '100%', 'mighty' ),
					]
				]
			);

			$this->add_control(
				'submit_size',
				[
					'label' => __( 'Size', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'small'  => __( 'Small', 'mighty' ),
						'medium'  => __( 'medium', 'mighty' ),
						'large'  => __( 'large', 'mighty' ),
						'extra-large'  => __( 'extra-large', 'mighty' ),
					],
				]
			);

			$this->add_control(
				'enable_icon',
				[
					'label' => __( 'Enable Icon', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => __( 'Yes', 'mighty' ),
					'label_off' => __( 'No', 'mighty' ),
					'return_value' => 'yes',
				]
			);

			$this->add_control(
				'submit_icon',
				[
					'label' => __( 'Icon', 'mighty' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'fas fa-star',
						'library' => 'solid',
					],
					'condition' => [
						'enable_icon' => 'yes'
					]
				]
			);

			$this->add_responsive_control(
				'icon_position',
				[
					'label' => __( 'Icon Position', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'before'  => __( 'Before', 'mighty' ),
						'after'  => __( 'After', 'mighty' ),
					]
				]
			);

			$this->add_control(
				'icon_spacing',
				[
					'label' => __( 'Icon Spacing', 'mighty' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 50,
							'step' => 1,
						]
					],
					'default' => [
						'unit' => 'px',
						'size' => 50,
					],
					'selectors' => [
						'{{WRAPPER}} ' => 'margin-top: {{SIZE}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_mc_message',
			[
				'label' => __( 'Message', 'mighty' ),
			]
		);

			$this->add_control(
				'error_message',
				[
					'label' => __( 'Error Message', 'mighty' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'placeholder' => __( 'Error Message', 'mighty' ),
				]
			);

			$this->add_control(
				'successful_message',
				[
					'label' => __( 'Successful Message', 'mighty' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'placeholder' => __( 'Success Message', 'mighty' ),
				]
			);

		$this->end_controls_section();

		// Styling
		$this->start_controls_section(
			'section_general_styling',
			[
				'label' => __( 'General', 'mighty' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'mc_background',
					'label' => __( 'Background', 'mighty' ),
					'types' => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .wrapper',
				]
			);

			$this->add_responsive_control(
				'mc_margin',
				[
					'label' => __( 'Margin', 'mighty' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'mc_padding',
				[
					'label' => __( 'Padding', 'mighty' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'mc_border',
					'label' => __( 'Border', 'mighty' ),
					'selector' => '{{WRAPPER}} ',
				]
			);

			$this->add_responsive_control(
				'mc_border_radius',
				[
					'label' => __( 'Border Radius', 'mighty' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'mc_box_shadow',
					'label' => __( 'Box Shadow', 'mighty' ),
					'selector' => '{{WRAPPER}} ',
				]
			);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_fields_styling',
			[
				'label' => __( 'Form Fields', 'mighty' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'fields_columns_gap',
				[
					'label' => __( 'Columns Gap', 'mighty' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
							'step' => 5,
						],
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
						'{{WRAPPER}} ' => 'margin-top: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'fields_rows_gap',
				[
					'label' => __( 'Rows Gap', 'mighty' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
							'step' => 5,
						],
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
						'{{WRAPPER}} ' => 'margin: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->start_controls_tabs(
				'form_styling'
			);

				$this->start_controls_tab(
					'form_label',
					[
						'label' => __( 'Label', 'mighty' ),
					]
				);

					$this->add_control(
						'label_spacing',
						[
							'label' => __( 'Spacing', 'mighty' ),
							'type' => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range' => [
								'px' => [
									'min' => 0,
									'max' => 1000,
									'step' => 5,
								],
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
								'{{WRAPPER}} ' => 'margin: {{SIZE}}{{UNIT}};',
							],
						]
					);

					$this->add_control(
						'label_color',
						[
							'label' => __( 'Label Color', 'mighty' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} ' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_group_control(
						\Elementor\Group_Control_Typography::get_type(),
						[
							'name' => 'label_typography',
							'label' => __( 'Typography', 'mighty' ),
							'scheme' => Scheme_Typography::TYPOGRAPHY_1,
							'selector' => '{{WRAPPER}} ',
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'form_fields',
					[
						'label' => __( 'Fields', 'mighty' ),
					]
				);

					$this->add_control(
						'field_text_color',
						[
							'label' => __( 'Text Color', 'mighty' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} ' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'field_placeholder_color',
						[
							'label' => __( 'Placeholder Color', 'mighty' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} ' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_group_control(
						\Elementor\Group_Control_Typography::get_type(),
						[
							'name' => 'field_typography',
							'label' => __( 'Typography', 'mighty' ),
							'scheme' => Scheme_Typography::TYPOGRAPHY_1,
							'selector' => '{{WRAPPER}} ',
						]
					);

					$this->add_control(
						'field_padding',
						[
							'label' => __( 'Padding', 'mighty' ),
							'type' => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors' => [
								'{{WRAPPER}} ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' => 'field_background',
							'label' => __( 'Background', 'mighty' ),
							'types' => [ 'classic' ],
							'selector' => '{{WRAPPER}} ',
						]
					);

					$this->add_control(
						'field_border_color',
						[
							'label' => __( 'Border Color', 'mighty' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} ' => 'border-color: {{VALUE}}',
							],
						]
					);

					$this->add_responsive_control(
						'field_border_width',
						[
							'label' => __( 'Border Width', 'mighty' ),
							'type' => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors' => [
								'{{WRAPPER}} ' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);

					$this->add_responsive_control(
						'field_border_radius',
						[
							'label' => __( 'Border Radius', 'mighty' ),
							'type' => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors' => [
								'{{WRAPPER}} ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

		$this->end_controls_section();


		$this->start_controls_section(
			'section_button_styling',
			[
				'label' => __( 'Button', 'mighty' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->start_controls_tabs(
				'button_styling'
			);

				$this->start_controls_tab(
					'button_normal',
					[
						'label' => __( 'Normal', 'mighty' ),
					]
				);

					$this->add_control(
						'button_bg_color',
						[
							'label' => __( 'Background Color', 'mighty' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} ' => 'background-color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'button_text_color',
						[
							'label' => __( 'Text Color', 'mighty' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} ' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Typography::get_type(),
						[
							'name' => 'button_typography',
							'selector' => '{{WRAPPER}} ',
						]
					);
					
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name' => 'button_border',
							'label' => __( 'Border', 'mighty' ),
							'selector' => '{{WRAPPER}} ',
						]
					);

					$this->add_responsive_control(
						'button_border_radius',
						[
							'label' => __( 'Border Radius', 'mighty' ),
							'type' => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors' => [
								'{{WRAPPER}} ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
		
					$this->add_group_control(
						\Elementor\Group_Control_Box_Shadow::get_type(),
						[
							'name' => 'button_box_shadow',
							'label' => __( 'Box Shadow', 'mighty' ),
							'selector' => '{{WRAPPER}} ',
						]
					);
					
					$this->add_control(
						'button_padding',
						[
							'label' => __( 'Padding', 'mighty' ),
							'type' => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors' => [
								'{{WRAPPER}} ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);

				$this->end_controls_tab();


				$this->start_controls_tab(
					'button_hover',
					[
						'label' => __( 'Hover', 'mighty' ),
					]
				);

					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' => 'button_hover_background',
							'label' => __( 'Background Color', 'mighty' ),
							'types' => [ 'classic' ],
							'selector' => '{{WRAPPER}} ',
						]
					);

					$this->add_control(
						'button_text_hover_color',
						[
							'label' => __( 'Text Color', 'mighty' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .title' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'button_hover_animation',
						[
							'label' => __( 'Hover Animation', 'mighty' ),
							'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
							'prefix_class' => 'elementor-animation-',
						]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_message_styling',
			[
				'label' => __( 'Message', 'mighty' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'message_typography',
					'label' => __( 'Typography', 'mighty' ),
					'scheme' => Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} ',
				]
			);

			$this->add_control(
				'success_message_color',
				[
					'label' => __( 'Success Message Color', 'mighty' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} ' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'error_message_color',
				[
					'label' => __( 'Error Message Color', 'mighty' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} ' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'inline_message_color',
				[
					'label' => __( 'Inline Message Color', 'mighty' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} ' => 'color: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();

	}
	
	protected function render() {
		$settings = $this->get_settings_for_display();
		
	}
	
	protected function _content_template() {
	}
}
