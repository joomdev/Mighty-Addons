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
			'section_mc_styling',
			[
				'label' => __( 'General', 'mighty' ),
				'tab' => Controls_Manager::TAB_STYLE,
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
