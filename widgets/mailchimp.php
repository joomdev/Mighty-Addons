<?php
namespace MightyAddons\Widgets;

use \MightyAddons\Classes\HelperFunctions as Helper;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor MT_Mailchimp
 *
 * Elementor widget for MT_Mailchimp.
 *
 * @since 1.3.4
 */
class MT_Mailchimp extends Widget_Base {
	
	public function get_name() {
		return 'mt-mailchimp';
	}
	
	public function get_title() {
		return __( 'Mailchimp', 'mighty' );
	}
	
	public function get_icon() {
		return 'mf mf-mailchimp';
	}

	public function get_categories() {
		return [ 'mighty-addons' ];
	}

	public function get_keywords() {
		return [ 'mighty', 'mail', 'chimp', 'form' ];
    }

	public function get_script_depends() {
		return [ 'mt-mailchimp' ];
	}

	public function get_style_depends() {
		return [ 'mt-common', 'mt-mailchimp' ];
	}
	
	protected function _register_controls() {
		
		$this->start_controls_section(
			'section_mailchimp',
			[
				'label' => __( 'Mailchimp', 'mighty' ),
			]
		);

			if ( ! Helper::get_integration_option('mailchimp-key') ) {
					
				$this->add_control(
					'mailchimp_notice',
					[
						'type' => Controls_Manager::RAW_HTML,
						'raw' => __( '<p>You need to insert <b>Mailchimp Key</b> to make the element work.</p><br><p>1. Get a <a target="_blank" rel="noopener" href="https://mailchimp.com/help/about-api-keys/">Key</a>.</p><br><p>2. Insert the key in the dashboard in <b>Integration</b> Settings.</b></p><br><p>3. Voila! Start collecting your subscribers.</p>', 'mighty' ),
						'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
					]
				);
			} else {
				$this->add_control(
					'mailchimp_list',
					[
						'label' => __( 'Choose List', 'mighty' ),
						'type' => Controls_Manager::SELECT,
						'options' => array_merge( array( 0 => 'Select a List'), Helper::mailchimpLists() ),
						'default' => '0'
					]
				);
			}

		$this->end_controls_section();

		$this->start_controls_section(
			'section_mc_fields',
			[
				'label' => __( 'Fields', 'mighty' ),
			]
		);

			$this->add_control(
				'email_ordering',
				[
					'label' => __( 'Email Ordering', 'mighty' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'1'  => __( '1', 'mighty' ),
						'2'  => __( '2', 'mighty' ),
						'3'  => __( '3', 'mighty' ),
					],
					'default' => __( '1', 'mighty' )
				]
			);

			$this->add_control(
				'email_label',
				[
					'label' => __( 'Email Label', 'mighty' ),
					'type' => Controls_Manager::TEXT,
					'default' => __( 'Your Email', 'mighty' ),
					'placeholder' => __( 'Type your title here', 'mighty' ),
				]
			);

			$this->add_control(
				'email_placeholder',
				[
					'label' => __( 'Email Placeholder', 'mighty' ),
					'type' => Controls_Manager::TEXT,
					'default' => __( 'Your Email', 'mighty' ),
				]
			);

			$this->add_responsive_control(
				'email_column_width',
				[
					'label' => __( 'Column Width', 'mighty' ),
					'type' => Controls_Manager::SELECT,
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
					'default' => __( '100', 'mighty' )
				]
			);

			// First Name
			$this->add_control(
				'enable_first_name',
				[
					'label' => __( 'First Name', 'mighty' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => __( 'Enable', 'mighty' ),
					'label_off' => __( 'Disable', 'mighty' ),
					'return_value' => 'yes',
					'separator' => 'before',
				]
			);

			$this->add_control(
				'fname_ordering',
				[
					'label' => __( 'First Name Ordering', 'mighty' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'1'  => __( '1', 'mighty' ),
						'2'  => __( '2', 'mighty' ),
						'3'  => __( '3', 'mighty' ),
					],
					'default' => __( '2', 'mighty' ),
					'condition' => [
						'enable_first_name' => 'yes'
					]
				]
			);

			$this->add_control(
				'fname_label',
				[
					'label' => __( 'First Name	Label', 'mighty' ),
					'type' => Controls_Manager::TEXT,
					'placeholder' => __( 'Type your First Name', 'mighty' ),
					'default' => __( 'First Name', 'mighty' ),
					'condition' => [
						'enable_first_name' => 'yes'
					]
				]
			);

			$this->add_control(
				'fname_placeholder',
				[
					'label' => __( 'First Name Placeholder', 'mighty' ),
					'type' => Controls_Manager::TEXT,
					'default' => __( 'Your First Name', 'mighty' ),
					'condition' => [
						'enable_first_name' => 'yes'
					]
				]
			);

			$this->add_responsive_control(
				'fname_column_width',
				[
					'label' => __( 'First Name Column Width', 'mighty' ),
					'type' => Controls_Manager::SELECT,
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
					'default' => __( '100', 'mighty' ),
					'condition' => [
						'enable_first_name' => 'yes'
					]
				]
			);

			$this->add_control(
				'fname_required',
				[
					'label' => __( 'First Name Required', 'mighty' ),
					'type' => Controls_Manager::SWITCHER,
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
					'label' => __( 'Last Name', 'mighty' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => __( 'Enable', 'mighty' ),
					'label_off' => __( 'Disable', 'mighty' ),
					'return_value' => 'yes',
					'separator' => 'before',
				]
			);

			$this->add_control(
				'lname_ordering',
				[
					'label' => __( 'Last Name Ordering', 'mighty' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'1'  => __( '1', 'mighty' ),
						'2'  => __( '2', 'mighty' ),
						'3'  => __( '3', 'mighty' ),
					],
					'default' => __( '3', 'mighty' ),
					'condition' => [
						'enable_last_name' => 'yes'
					]
				]
			);

			$this->add_control(
				'lname_label',
				[
					'label' => __( 'Last Name Label', 'mighty' ),
					'type' => Controls_Manager::TEXT,
					'placeholder' => __( 'Type your Last Name', 'mighty' ),
					'default' => __( 'Last Name', 'mighty' ),
					'condition' => [
						'enable_last_name' => 'yes'
					]
				]
			);

			$this->add_control(
				'lname_placeholder',
				[
					'label' => __( 'Last Name Placeholder', 'mighty' ),
					'type' => Controls_Manager::TEXT,
					'default' => __( 'Your First Name', 'mighty' ),
					'condition' => [
						'enable_last_name' => 'yes'
					]
				]
			);

			$this->add_responsive_control(
				'lname_column_width',
				[
					'label' => __( 'Last Name Column Width', 'mighty' ),
					'type' => Controls_Manager::SELECT,
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
					'default' => __( '100', 'mighty' ),
					'condition' => [
						'enable_last_name' => 'yes'
					]
				]
			);

			$this->add_control(
				'lname_required',
				[
					'label' => __( 'Required', 'mighty' ),
					'type' => Controls_Manager::SWITCHER,
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
				'enable_terms',
				[
					'label' => __( 'Agree To Terms', 'mighty' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => __( 'Enable', 'mighty' ),
					'label_off' => __( 'Disable', 'mighty' ),
					'return_value' => 'yes',
					'separator' => 'before'
				]
			);

			$this->add_control(
				'terms_label',
				[
					'label' => __( 'Acceptance Text', 'mighty' ),
					'type' => Controls_Manager::WYSIWYG,
					'default' => __( 'I have read and agree to the terms & conditions.', 'mighty' ),
					'condition' => [
						'enable_terms' => 'yes'
					]
				]
			);

			$this->add_control(
				'checked_by_default',
				[
					'label' => __( 'Checked By Default', 'mighty' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => __( 'Yes', 'mighty' ),
					'label_off' => __( 'No', 'mighty' ),
					'return_value' => 'yes',
					'condition' => [
						'enable_terms' => 'yes'
					]
				]
			);

			$this->add_control(
				'terms_required',
				[
					'label' => __( 'Required', 'mighty' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => __( 'Enable', 'mighty' ),
					'label_off' => __( 'Disable', 'mighty' ),
					'return_value' => 'yes',
					'condition' => [
						'enable_terms' => 'yes'
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
					'type' => Controls_Manager::TEXT,
					'placeholder' => __( 'Button Text', 'mighty' ),
					'default' => __( 'Subscribe Now', 'mighty' ),
				]
			);

			$this->add_control(
				'loading_text',
				[
					'label' => __( 'Loading Text', 'mighty' ),
					'type' => Controls_Manager::TEXT,
					'placeholder' => __( 'Loading Text', 'mighty' ),
					'default' => __( 'Subscribing...', 'mighty' ),
				]
			);

			$this->add_responsive_control(
				'submit_column_width',
				[
					'label' => __( 'Submit Column Width', 'mighty' ),
					'type' => Controls_Manager::SELECT,
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
					],
					'default' => __( '100', 'mighty' )
				]
			);

			$this->add_control(
				'button_size',
				[
					'label' => __( 'Size', 'mighty' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'ma-btn-sm'  => __( 'Small', 'mighty' ),
						'ma-btn-md'  => __( 'Medium', 'mighty' ),
						'ma-btn-lg'  => __( 'Large', 'mighty' )
					],
					'default' => 'ma-btn-lg'
				]
			);

			$this->add_control(
				'enable_icon',
				[
					'label' => __( 'Enable Icon', 'mighty' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => __( 'Yes', 'mighty' ),
					'label_off' => __( 'No', 'mighty' ),
					'return_value' => 'yes',
				]
			);

			$this->add_control(
				'button_icon',
				[
					'label' => __( 'Icon', 'mighty' ),
					'type' => Controls_Manager::ICONS,
					'condition' => [
						'enable_icon' => 'yes'
					]
				]
			);

			$this->add_control(
				'icon_position',
				[
					'label' => __( 'Icon Position', 'mighty' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'icon-before'  => __( 'Before', 'mighty' ),
						'icon-after'  => __( 'After', 'mighty' ),
					],
					'default' => 'icon-before',
					'condition' => [
						'enable_icon' => 'yes'
					]
				]
			);

			$this->add_responsive_control(
				'icon_spacing',
				[
					'label' => __( 'Icon Spacing', 'mighty' ),
					'type' =>  Controls_Manager::SLIDER,
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
						'size' => 10,
					],
					'selectors' => [
						'{{WRAPPER}} .mighty-mailchimp-wrapper .mailchimp-submit .icon-before .submit-icon' => 'margin-right: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} .mighty-mailchimp-wrapper .mailchimp-submit .icon-after .submit-icon' => 'margin-left: {{SIZE}}{{UNIT}}'
					],
					'condition' => [
						'enable_icon' => 'yes'
					]
				]
			);

			$this->add_control(
				'after_submission',
				[
					'label' => __( 'After submission', 'mighty' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'same' => __( 'AJAX Load', 'mighty' ),
						'different' => __( 'Redirect', 'mighty' ),
					],
					'default' => 'same',
					'description' => __( 'Keep user on the same page and show notification or redirect to different page after submission.')
				]
			);

			$this->add_control(
				'page_link',
				[
					'label' => __( 'Page Link', 'mighty' ),
					'type' => \Elementor\Controls_Manager::URL,
					'placeholder' => __( 'https://example.com', 'mighty' ),
					'show_external' => false,
					'default' => [
						'url' => '',
						'is_external' => false,
						'nofollow' => false,
					],
					'condition' => [
						'after_submission' => 'different'
					]
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
					'type' => Controls_Manager::TEXT,
					'placeholder' => __( 'Error Message', 'mighty' ),
					'default' => __( 'Something went wrong!', 'mighty' )
				]
			);

			$this->add_control(
				'success_message',
				[
					'label' => __( 'Successful Message', 'mighty' ),
					'type' => Controls_Manager::TEXT,
					'placeholder' => __( 'Success Message', 'mighty' ),
					'default' => __( 'You are subscribed!', 'mighty' )
				]
			);

		$this->end_controls_section();

		// Styling
		$this->start_controls_section(
			'section_general_styling',
			[
				'label' => __( 'General', 'mighty' ),
				'tab' =>  Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'mc_background',
					'label' => __( 'Background', 'mighty' ),
					'types' => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .mighty-mailchimp-wrapper',
				]
			);

			$this->add_responsive_control(
				'mc_margin',
				[
					'label' => __( 'Margin', 'mighty' ),
					'type' =>  Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .mighty-mailchimp-wrapper .mighty-maichimp-form' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'mc_padding',
				[
					'label' => __( 'Padding', 'mighty' ),
					'type' =>  Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .mighty-mailchimp-wrapper .mighty-maichimp-form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'mc_border',
					'label' => __( 'Border', 'mighty' ),
					'selector' => '{{WRAPPER}} .mighty-mailchimp-wrapper',
				]
			);

			$this->add_responsive_control(
				'mc_border_radius',
				[
					'label' => __( 'Border Radius', 'mighty' ),
					'type' =>  Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .mighty-mailchimp-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'mc_box_shadow',
					'label' => __( 'Box Shadow', 'mighty' ),
					'selector' => '{{WRAPPER}} .mighty-mailchimp-wrapper',
				]
			);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_fields_styling',
			[
				'label' => __( 'Form Fields', 'mighty' ),
				'tab' =>  Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_responsive_control(
				'fields_columns_gap',
				[
					'label' => __( 'Columns Gap', 'mighty' ),
					'type' =>  Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
							'step' => 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .mighty-mailchimp-wrapper .mighty-maichimp-form .mt-form-group' => 'padding-right: calc( {{SIZE}}{{UNIT}}/2 ); padding-left: calc( {{SIZE}}{{UNIT}}/2 );',
						'{{WRAPPER}} .mighty-mailchimp-wrapper .mighty-maichimp-form' => 'margin-left: calc( -{{SIZE}}{{UNIT}}/2 ); margin-right: calc( -{{SIZE}}{{UNIT}}/2 );',
					],
				]
			);

			$this->add_responsive_control(
				'fields_rows_gap',
				[
					'label' => __( 'Rows Gap', 'mighty' ),
					'type' =>  Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
							'step' => 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .mighty-mailchimp-wrapper .mighty-maichimp-form .mt-form-group' => 'margin-bottom: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .mighty-mailchimp-wrapper .mighty-maichimp-form' => 'margin-bottom: -{{SIZE}}{{UNIT}};',
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
							'type' =>  Controls_Manager::SLIDER,
							'size_units' => [ 'px' ],
							'range' => [
								'px' => [
									'min' => 0,
									'max' => 100,
									'step' => 1,
								]
							],
							'default' => [
								'unit' => 'px',
								'size' => 10,
							],
							'selectors' => [
								'{{WRAPPER}} .mighty-mailchimp-wrapper .mighty-maichimp-form label' => 'margin-bottom: {{SIZE}}{{UNIT}};',
							],
						]
					);

					$this->add_control(
						'label_color',
						[
							'label' => __( 'Label Color', 'mighty' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .mighty-mailchimp-wrapper .mighty-maichimp-form' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_group_control(
						\Elementor\Group_Control_Typography::get_type(),
						[
							'name' => 'label_typography',
							'label' => __( 'Typography', 'mighty' ),
							'selector' => '{{WRAPPER}} .mighty-mailchimp-wrapper .mighty-maichimp-form label',
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
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .mighty-mailchimp-wrapper .mighty-maichimp-form input' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'field_placeholder_color',
						[
							'label' => __( 'Placeholder Color', 'mighty' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .mighty-mailchimp-wrapper .mighty-maichimp-form input::placeholder' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_group_control(
						\Elementor\Group_Control_Typography::get_type(),
						[
							'name' => 'field_typography',
							'label' => __( 'Typography', 'mighty' ),
							'selector' => '{{WRAPPER}} .mighty-mailchimp-wrapper .mighty-maichimp-form input',
						]
					);

					$this->add_responsive_control(
						'field_padding',
						[
							'label' => __( 'Padding', 'mighty' ),
							'type' =>  Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors' => [
								'{{WRAPPER}} .mighty-mailchimp-wrapper .mighty-maichimp-form input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);

					$this->add_control(
						'field_background',
						[
							'label' => __( 'Background Color', 'mighty' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .mighty-mailchimp-wrapper .mighty-maichimp-form input' => 'background-color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'field_border_color',
						[
							'label' => __( 'Border Color', 'mighty' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .mighty-mailchimp-wrapper .mighty-maichimp-form input' => 'border-color: {{VALUE}}',
							],
						]
					);

					$this->add_responsive_control(
						'field_border_width',
						[
							'label' => __( 'Border Width', 'mighty' ),
							'type' =>  Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors' => [
								'{{WRAPPER}} .mighty-mailchimp-wrapper .mighty-maichimp-form input' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);

					$this->add_responsive_control(
						'field_border_radius',
						[
							'label' => __( 'Border Radius', 'mighty' ),
							'type' =>  Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors' => [
								'{{WRAPPER}} .mighty-mailchimp-wrapper .mighty-maichimp-form input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'tab' =>  Controls_Manager::TAB_STYLE,
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
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .mighty-mailchimp-wrapper .mighty-maichimp-form button' => 'background-color: {{VALUE}}',
							],
							'default' => '#61CE70'
						]
					);

					$this->add_control(
						'button_text_color',
						[
							'label' => __( 'Text Color', 'mighty' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .mighty-mailchimp-wrapper .mighty-maichimp-form button' => 'color: {{VALUE}}',
							],
							'default' => '#FFFFFF'
						]
					);

					$this->add_group_control(
						Group_Control_Typography::get_type(),
						[
							'name' => 'button_typography',
							'selector' => '{{WRAPPER}} .mighty-mailchimp-wrapper .mighty-maichimp-form button',
						]
					);
					
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name' => 'button_border',
							'label' => __( 'Border', 'mighty' ),
							'selector' => '{{WRAPPER}} .mighty-mailchimp-wrapper .mighty-maichimp-form .mailchimp-submit button',
						]
					);

					$this->add_responsive_control(
						'button_border_radius',
						[
							'label' => __( 'Border Radius', 'mighty' ),
							'type' =>  Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors' => [
								'{{WRAPPER}} .mighty-mailchimp-wrapper .mighty-maichimp-form button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
		
					$this->add_group_control(
						\Elementor\Group_Control_Box_Shadow::get_type(),
						[
							'name' => 'button_box_shadow',
							'label' => __( 'Box Shadow', 'mighty' ),
							'selector' => '{{WRAPPER}} .mighty-mailchimp-wrapper .mighty-maichimp-form button',
						]
					);
					
					$this->add_responsive_control(
						'button_padding',
						[
							'label' => __( 'Padding', 'mighty' ),
							'type' =>  Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors' => [
								'{{WRAPPER}} .mighty-mailchimp-wrapper .mighty-maichimp-form button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

					$this->add_control(
						'button_hover_background',
						[
							'label' => __( 'Background Color', 'mighty' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .mighty-mailchimp-wrapper .mighty-maichimp-form button:hover' => 'background-color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'button_text_hover_color',
						[
							'label' => __( 'Text Color', 'mighty' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .mighty-mailchimp-wrapper .mighty-maichimp-form button:hover' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'button_hover_animation',
						[
							'label' => __( 'Hover Animation', 'mighty' ),
							'type' => Controls_Manager::HOVER_ANIMATION,
							// 'prefix_class' => 'mighty-animation-',
						]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_message_styling',
			[
				'label' => __( 'Message', 'mighty' ),
				'tab' =>  Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'message_typography',
					'label' => __( 'Typography', 'mighty' ),
					'selector' => '{{WRAPPER}} .mighty-mailchimp-wrapper .mighty-maichimp-form .mailchimp-message',
				]
			);

			$this->add_control(
				'success_message_color',
				[
					'label' => __( 'Success Message Color', 'mighty' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .mighty-mailchimp-wrapper .mighty-maichimp-form .mailchimp-success' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'error_message_color',
				[
					'label' => __( 'Error Message Color', 'mighty' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .mighty-mailchimp-wrapper .mighty-maichimp-form .mailchimp-error' => 'color: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();

	}
	
	protected function render() {
		$settings = $this->get_settings_for_display();

		if( ! Helper::get_integration_option('mailchimp-key') || empty( $settings['mailchimp_list'] ) ) {
			$mcKey = "false";
		} else {
			$mcKey = "true";
		}

		// Fields ordering
		$ordering =  [ 'email' => $settings['email_ordering'], 'fname' => $settings['fname_ordering'], 'lname' => $settings['lname_ordering'] ];
		asort($ordering);
		
		$this->add_render_attribute( 'mt-mailchimp', 'class', 'mighty-maichimp-form' );
		$this->add_render_attribute( 'mt-mailchimp', 'id', 'mighty-mailchimp-form-' . esc_attr( $this->get_id() ) );
		$this->add_render_attribute( 'mt-mailchimp', 'method', 'POST' );
		$this->add_render_attribute( 'mt-mailchimp', 'data-mclist', empty( $settings['mailchimp_list'] ) ? null : $settings['mailchimp_list'] );
		$this->add_render_attribute( 'mt-mailchimp', 'data-mckey', $mcKey );
		$this->add_render_attribute( 'mt-mailchimp', 'data-error-msg', $settings['error_message'] );
		$this->add_render_attribute( 'mt-mailchimp', 'data-success-msg', $settings['success_message'] );
		$this->add_render_attribute( 'mt-mailchimp', 'data-after-submission', $settings['after_submission'] );
		$this->add_render_attribute( 'mt-mailchimp', 'data-enable-icon', $settings['enable_icon'] );
		if ( $settings['enable_icon'] == "yes" ) {
			$this->add_render_attribute( 'mt-mailchimp', 'data-button-icon', $settings['button_icon']['value'] );
		}
		$this->add_render_attribute( 'mt-mailchimp', 'data-button-text', $settings['button_text'] );
		$this->add_render_attribute( 'mt-mailchimp', 'data-loading-text', $settings['loading_text'] );
		if ( $settings['after_submission'] == "different" ) {
			$this->add_render_attribute( 'mt-mailchimp', 'data-link', $settings['page_link']['url'] );
			$this->add_render_attribute( 'mt-mailchimp', 'data-external', $settings['page_link']['is_external'] );
			$this->add_render_attribute( 'mt-mailchimp', 'data-nofollow', $settings['page_link']['nofollow'] );
		}

		// Email Column Width
		$this->add_render_attribute( 'email-width', 'class', 'mt-form-group mailchimp-email mt-col-' . $settings['email_column_width'] );
		( ! empty( $settings['email_column_width_tablet'] ) ? $this->add_render_attribute( 'email-width', 'class', 'mt-col-md-' . $settings['email_column_width_tablet'] ) : '' );
		( ! empty( $settings['email_column_width_mobile'] ) ? $this->add_render_attribute( 'email-width', 'class', 'mt-col-sm-' . $settings['email_column_width_mobile'] ) : '' );

		// Fname Column Width
		$this->add_render_attribute( 'fname-width', 'class', 'mt-form-group mailchimp-fname mt-col-' . $settings['fname_column_width'] );
		( ! empty( $settings['fname_column_width_tablet'] ) ? $this->add_render_attribute( 'fname-width', 'class', 'mt-col-md-' . $settings['fname_column_width_tablet'] ) : '' );
		( ! empty( $settings['fname_column_width_mobile'] ) ? $this->add_render_attribute( 'fname-width', 'class', 'mt-col-sm-' . $settings['fname_column_width_mobile'] ) : '' );

		// Lname Column Width
		$this->add_render_attribute( 'lname-width', 'class', 'mt-form-group mailchimp-lname mt-col-' . $settings['lname_column_width'] );
		( ! empty( $settings['lname_column_width_tablet'] ) ? $this->add_render_attribute( 'lname-width', 'class', 'mt-col-md-' . $settings['lname_column_width_tablet'] ) : '' );
		( ! empty( $settings['lname_column_width_mobile'] ) ? $this->add_render_attribute( 'lname-width', 'class', 'mt-col-sm-' . $settings['lname_column_width_mobile'] ) : '' );

		// Submit Column Width
		$this->add_render_attribute( 'submit-width', 'class', 'mt-form-group mailchimp-submit mt-col-' . $settings['submit_column_width'] );
		( ! empty( $settings['submit_column_width_tablet'] ) ? $this->add_render_attribute( 'submit-width', 'class', 'mt-col-md-' . $settings['submit_column_width_tablet'] ) : '' );
		( ! empty( $settings['submit_column_width_mobile'] ) ? $this->add_render_attribute( 'submit-width', 'class', 'mt-col-sm-' . $settings['submit_column_width_mobile'] ) : '' );
		
		echo "<div class='mighty-mailchimp-wrapper'>";
		echo "<form method='post' " . $this->get_render_attribute_string('mt-mailchimp') . ">";

		?>

		<?php 
		foreach ( $ordering as $field => $order ) :
			if ( $field == "email" ) { ?>
				<div <?php echo $this->get_render_attribute_string('email-width') ?>>
					<label class="mt-label-control" for="email-<?php echo $this->get_id(); ?>"><?php echo $settings['email_label']; ?></label>
					
					<input id="email-<?php echo $this->get_id(); ?>" type="email" name="email" class="mt-form-control" placeholder="<?php echo $settings['email_placeholder']; ?>" required />
					
				</div>
			<?php
			}
			elseif ( $field == "fname" ) { ?>
				<?php if ( $settings['enable_first_name'] == "yes" ) : ?>
				<div <?php echo $this->get_render_attribute_string('fname-width') ?>>
					<label class="mt-label-control" for="fname-<?php echo $this->get_id(); ?>"><?php echo $settings['fname_label']; ?></label>
					<input id="fname-<?php echo $this->get_id(); ?>" type="text" name="fname" class="mt-form-control" placeholder="<?php echo $settings['fname_placeholder']; ?>" <?php echo $settings['fname_required'] == "yes" ? 'required' : ''; ?> />
				</div>
				<?php endif; ?>
			<?php
			}
			elseif ( $field == "lname" ) { ?>
				<?php if ( $settings['enable_last_name'] == "yes" ) : ?>
				<div <?php echo $this->get_render_attribute_string('lname-width') ?>>
					<label class="mt-label-control" for="lname-<?php echo $this->get_id(); ?>"><?php echo $settings['lname_label']; ?></label>
					
					<input id="lname-<?php echo $this->get_id(); ?>" type="text" name="lname" class="mt-form-control" placeholder="<?php echo $settings['lname_placeholder']; ?>" <?php echo $settings['lname_required'] == "yes" ? 'required' : ''; ?> />
				</div>
				<?php endif; ?>
			<?php
			}
		endforeach;
		?>

		<?php if ( $settings['enable_terms'] == "yes" ) : ?>
		<div class="mt-form-group mailchimp-terms">
			<label class="" for="terms-<?php echo $this->get_id(); ?>">
				<input id="terms-<?php echo $this->get_id(); ?>" type="checkbox" name="terms" class="" <?php echo $settings['checked_by_default'] == "yes" ? ' checked' : ''; ?><?php echo $settings['terms_required'] == "yes" ? ' required' : ''; ?> />
				<?php echo $settings['terms_label']; ?>
			</label>
		</div>
		<?php endif; ?>

		<div <?php echo $this->get_render_attribute_string('submit-width') ?>>				
			<button class="mt-form-submit<?php echo " elementor-animation-".$settings['button_hover_animation']; ?> <?php echo $settings['enable_icon'] == "yes" ? $settings['icon_position'] : ''; ?> <?php echo $settings['button_size']; ?>" type="submit">
				<?php if ( $settings['enable_icon'] == "yes" ) : ?>
				<span class="submit-icon">
					<?php \Elementor\Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
				</span>
				<?php endif; ?>
				<?php echo $settings['button_text']; ?>
			</button>
		</div>

		<?php
		echo "</form>";
		echo "</div>";
	}
	
	protected function _content_template() {
	}
}
