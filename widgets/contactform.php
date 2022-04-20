<?php
namespace MightyAddons\Widgets;

use \MightyAddons\Classes\HelperFunctions as Helper;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils as Utils;
use Elementor\Repeater as Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor MT_contactform
 *
 * Elementor widget for MT_contactform.
 *
 * @since 1.0.0
 */
class MT_contactform extends Widget_Base {

	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
	
		wp_register_style( 'mt-contactform', MIGHTY_ADDONS_PLG_URL . 'assets/css/contactform.min.css', false, MIGHTY_ADDONS_VERSION );

		wp_register_script( 'mt-contactform', MIGHTY_ADDONS_PLG_URL . 'assets/js/contactform.js', [ 'jquery' ], MIGHTY_ADDONS_VERSION, true );

		wp_localize_script( 'mt-contactform', 'MightyContactForm', array(
			'ajaxUrl' => admin_url( 'admin-ajax.php' ),
			'contactformAction' => 'save_contact_form_details'
		) );
		
	}
	
	public function get_name() {
		return 'mt-contactform';
	}
	
	public function get_title() {
		return __( 'Contact Form', 'mighty' );
	}
	
	public function get_icon() {
		return 'mf mf-contactform';
	}

	public function get_categories() {
		return [ 'mighty-addons' ];
	}

	public function get_keywords() {
		return [ 'mighty', 'contactform' ];
    }
	
	public function get_style_depends() {
		return [ 'mt-contactform' ];
	}

	public function get_script_depends() {
		return [ 'mt-contactform' ];
	}

    protected function register_controls() {

        $this->start_controls_section(
			'section_contactform_basic',
			[
				'label' => __( 'Basic', 'mighty' ),
			]
		);

			$this->add_control(
				'contact_form_name',
				[
					'label' => __( 'Form Name', 'mighty' ),
					'type' => Controls_Manager::TEXT,
					'default' => 'New Form'
				]
			);

			$repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'form_field_type', [
					'label' => esc_html__( 'Type', 'mighty' ),
					'type' => Controls_Manager::SELECT,
                    'default' => __('name'),
                    'options' => [
                        'name' => __('Name', 'mighty'),
                        'email' => __('Email', 'mighty'),
                        'number' => __('Phone Number', 'mighty'),
                        'subject' => __('Subject', 'mighty'),
                        'message' => __('Message', 'mighty'),
                    ],
					'label_block' => true,
				]
			);

			$repeater->add_control(
				'form_field_label', [
					'label' => esc_html__( 'Label', 'mighty' ),
					'type' => Controls_Manager::TEXT,
				]
			);

			$repeater->add_control(
				'form_field_placeholder', [
					'label' => esc_html__( 'Placeholder', 'mighty' ),
					'type' => Controls_Manager::TEXT,
				]
			);

			$repeater->add_control(
				'form_field_column_width', [
					'label' => esc_html__( 'Column Width', 'mighty' ),
					'type' => Controls_Manager::SELECT,
                    'default' => __('100'),
                    'options' => [
                        '20' => __('20%', 'mighty'),
                        '25' => __('25%', 'mighty'),
                        '33' => __('33%', 'mighty'),
                        '40' => __('40%', 'mighty'),
                        '50' => __('50%', 'mighty'),
                        '60' => __('60%', 'mighty'),
                        '66' => __('66%', 'mighty'),
                        '75' => __('75%', 'mighty'),
                        '80' => __('80%', 'mighty'),
                        '100' => __('100%', 'mighty'),
                    ],
					'label_block' => true,
				]
			);

			$repeater->add_control(
                'form_field_required', [
                    'label' => __( 'Required?', 'mighty' ),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'no',
                ]
            );


			$repeater->add_control(
				'form_field_min_length',
				[
					'label' => esc_html__( 'Minimum Length', 'mighty' ),
					'type' => Controls_Manager::NUMBER,
					'condition' => [
						'form_field_type' => 'number',
					],
					'description' => 'Enter a number if you did like to limit the field input to a minimum number of characters.'
				]
			);

			$repeater->add_control(
				'form_field_max_length',
				[
					'label' => esc_html__( 'Maximum Length', 'mighty' ),
					'type' => Controls_Manager::NUMBER,
					'condition' => [
						'form_field_type' => 'number',
					],
					'description' => 'Enter a number if you did like to limit the field input to a maximum number of characters.'
				]
			);

			$repeater->add_control(
				'form_field_message_rows',
				[
					'label' => esc_html__( 'Rows', 'mighty' ),
					'type' => Controls_Manager::NUMBER,
					'condition' => [
						'form_field_type' => 'message'
					],
				]
			);

			$repeater->add_control(
				'form_field_id',
				[
					'label' => esc_html__( 'Field ID', 'mighty' ),
					'type' => Controls_Manager::TEXT,
					'description' => 'Please make sure the ID is unique and not used elsewhere in this form. This field allows <b> A-z 0-9 </b> & underscore chars without spaces.'	
				]
			);

			$this->add_control(
				'form_list',
				[
					'label' => esc_html__( 'Form Field', 'mighty' ),
					'type' => Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[
							'form_field_label' => esc_html__( 'Name', 'mighty' ),
						],
						[
							'form_field_label' => esc_html__( 'Email', 'mighty' ),
							'form_field_required' => esc_html__( 'yes', 'mighty' ),
						],
						[
							'form_field_label' => esc_html__( 'Subject', 'mighty' ),
						],
					],
					'title_field' => '{{{ form_field_label }}}',
				]
			);

			$this->add_control(
				'form_field_input_size', [
					'label' => esc_html__( 'Input Size', 'mighty' ),
					'type' => Controls_Manager::SELECT,
                    'default' => __('xs'),
                    'options' => [
                        'xs' => __('Extra Small', 'mighty'),
                        'sm' => __('Small', 'mighty'),
                        'md' => __('Medium', 'mighty'),
                        'lg' => __('Large', 'mighty'),
                        'xl' => __('Extra Large', 'mighty'),
                    ],
					'label_block' => true,
				]
			);

			$this->add_control(
                'form_field_show_label', [
                    'label' => __( 'Show Label', 'mighty' ),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                ]
            );

			$this->add_control(
                'form_field_show_required_mark', [
                    'label' => __( 'Show Required Mark', 'mighty' ),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                ]
            );

        $this->end_controls_section();

		$this->start_controls_section(
			'form_captcha',
			[
				'label' => __( 'Captcha', 'mighty' ),
			]
		);

			$this->add_control(
				'form_enable_captcha', [
					'label' => __( 'Enable Captcha', 'mighty' ),
					'type' => Controls_Manager::SWITCHER,
					'default' => 'no',
				]
			);

			$this->add_control(
				'form_captcha_type', [
					'label' => esc_html__( 'Captcha Type', 'mighty' ),
					'type' => Controls_Manager::SELECT,
                    'default' => __('default'),
                    'options' => [
                        'default' => __('Default', 'mighty'),
                        'gr' => __('Google ReCaptcha', 'mighty'),
                        'gir' => __('Google invisible ReCaptcha ', 'mighty'),
                    ],
					'condition' => [
						'form_enable_captcha' => 'yes',
					],
					'label_block' => true,
				]
			);

			if ( ! Helper::get_integration_option('captcha-key') ) {

				$this->add_control(
					'captcha_notice',
					[
						'type' => \ELEMENTOR\Controls_Manager::RAW_HTML,
						'raw' => __( '<p>You need to insert <b>Cpatcha Key</b> to make the element work.</p><br><p>1. Get a <a target="_blank" rel="noopener" href="https://mailchimp.com/help/about-api-keys/">Key</a>.</p><br><p>2. Insert the key in the dashboard in <b>Integration</b> Settings.</b></p>', 'mighty' ),
						'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
					]
				);
			}
			

		$this->end_controls_section();

		$this->start_controls_section(
			'form_consent',
			[
				'label' => __( 'Consent', 'mighty' ),
			]
		);

			$this->add_control(
				'form_show_consent', [
					'label' => __( 'Show Consent Acceptance', 'mighty' ),
					'type' => Controls_Manager::SWITCHER,
					'default' => 'no'
				]
			);

			$this->add_control(
				'consent_text', [
					'label' => __( 'Consent Text', 'mighty' ),
					'type' => Controls_Manager::TEXTAREA,
					'condition' => [
						'form_show_consent' => 'yes',
					],
					'description' => 'I agree with the <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a> and I declare that I have read the information that is required in accordance with <a href="http://eur-lex.europa.eu/legal-content/EN/TXT/?uri=uriserv:OJ.L_.2016.119.01.0001.01.ENG&amp;toc=OJ:L:2016:119:TOC" target="_blank">Article 13 of GDPR.</a>													'
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'form_button',
			[
				'label' => __( 'Button', 'mighty' ),
			]
		);

			$this->add_control(
				'form_button_text', [
					'label' => __( 'Button Text', 'mighty' ),
					'type' => Controls_Manager::TEXT,
					'default' => 'Submit',
				]
			);

			$this->add_control(
                'form_button_icon',
                [
                    'label' => __( 'Icon', 'mighty' ),
                    'type' => Controls_Manager::ICONS,
					'default' => [
						'value' => 'far fa-arrow-alt-circle-right',
					]
                ]
            );

			$this->add_control(
				'button_icon_position', [
					'label' => esc_html__( 'Icon Position', 'mighty' ),
					'type' => Controls_Manager::SELECT,
                    'default' => __('before'),
                    'options' => [
                        'before' => __('Before', 'mighty'),
                        'after' => __('After', 'mighty'),
                    ],
				]
			);

			$this->add_responsive_control(
                'button_icon_spacing',
                [
                    'label' => __( 'Icon Spacing', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ '%', 'px' , 'em' ],
                    'range' => [
                        '%' => [
                            'min' => 1,
                            'max' => 50
                        ],
                        'px' => [
                            'min' => 1,
                            'max' => 50
                        ],
                        'em' => [
                            'min' => 1,
                            'max' => 50
                        ]
                    ],
					'default' => [
                        'unit' => 'px',
                        'size' => 20,
                    ],                    
					'selectors' => [
						'{{WRAPPER}} .mt-c-form-fields-wrapper .type-submit .button.icon-before .button-icon' => 'margin-right: {{SIZE}}{{UNIT}}',
                        '{{WRAPPER}} .mt-c-form-fields-wrapper .type-submit .button.icon-after .button-icon' => 'margin-left: {{SIZE}}{{UNIT}}',
                    ],
                    
                ]
            );

			$this->add_control(
				'form_button_size', [
					'label' => esc_html__( 'Size', 'mighty' ),
					'type' => Controls_Manager::SELECT,
                    'default' => __('sm'),
                    'options' => [
                        'sm' => __('Small', 'mighty'),
                        'md' => __('Medium', 'mighty'),
                        'lg' => __('Large', 'mighty'),
                        'xl' => __('Extra Large', 'mighty'),
                    ],
					'label_block' => true,
				]
			);

			$this->add_control(
				'form_button_width', [
					'label' => esc_html__( 'Button Width', 'mighty' ),
					'type' => Controls_Manager::SELECT,
                    'default' => __('100'),
                    'options' => [
                        '20' => __('20%', 'mighty'),
                        '25' => __('25%', 'mighty'),
                        '33' => __('33%', 'mighty'),
                        '40' => __('40%', 'mighty'),
                        '50' => __('50%', 'mighty'),
                        '60' => __('60%', 'mighty'),
                        '66' => __('66%', 'mighty'),
                        '75' => __('75%', 'mighty'),
                        '80' => __('80%', 'mighty'),
                        '100' => __('100%', 'mighty'),
                    ],
					'label_block' => true,
				]
			);

			$this->add_control(
                'button_alignment',
                [
                    'label' => __( 'Alignment', 'mighty' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'mighty' ),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'mighty' ),
                            'icon' => 'eicon-v-align-bottom',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'mighty' ),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'block' => [
                            'title' => __( 'Block', 'mighty' ),
                            'icon' => 'eicon-h-align-right',
                        ],
                    ],
                    'default' => 'block',
                ]
            );

		$this->end_controls_section();

		$this->start_controls_section(
			'form_email_option',
			[
				'label' => __( 'Email Options', 'mighty' ),
			]
		);

			$this->add_control(
				'form_send_to', [
					'label' => __( 'To', 'mighty' ),
					'type' => Controls_Manager::TEXT,
				]
			);

			$this->add_control(
				'form_from_email', [
					'label' => __( 'From Email', 'mighty' ),
					'type' => Controls_Manager::TEXT,
				]
			);

			$this->add_control(
				'form_from_name', [
					'label' => __( 'From Name', 'mighty' ),
					'type' => Controls_Manager::TEXT,
				]
			);

			$this->add_control(
				'form_email_subject', [
					'label' => __( 'Email Subject', 'mighty' ),
					'type' => Controls_Manager::TEXT,
				]
			);

			$this->add_control(
				'form_reply_email', [
					'label' => __( 'Reply-To-Email', 'mighty' ),
					'type' => Controls_Manager::TEXT,
				]
			);

			$this->add_control(
				'form_reply_name', [
					'label' => __( 'Reply-To-Name', 'mighty' ),
					'type' => Controls_Manager::TEXT,
				]
			);

			$this->add_control(
				'form_cc_emails', [
					'label' => __( 'CC Emails', 'mighty' ),
					'type' => Controls_Manager::TEXT,
				]
			);

			$this->add_control(
				'form_bcc_emails', [
					'label' => __( 'BCC Emails', 'mighty' ),
					'type' => Controls_Manager::TEXT,
				]
			);

			$this->add_control(
                'email_copy_sender', [
                    'label' => __( 'Send Copy to Sender', 'mighty' ),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'no',
                ]
            );

		$this->end_controls_section();

		$this->start_controls_section(
			'form_email_options',
			[
				'label' => __( 'Email Template', 'mighty' ),
			]
		);

			$this->add_control(
				'form_email_template', [
					'label' => esc_html__( 'Email Template', 'mighty' ),
					'type' => Controls_Manager::SELECT,
					'default' => __('default'),
					'options' => [
						'default' => __('Default', 'mighty'),
						'custom' => __('Custom', 'mighty'),
					],
					'label_block' => true,
					
				]
			);

			$this->add_control(
				'form_email_custom_template',
				[
					'label' => esc_html__( 'Custom Email Template', 'mighty' ),
					'type' => Controls_Manager::WYSIWYG,
					'default' => '[all-fields]',
					'condition' => [
						'form_email_template' => 'custom',
					],
					'description' => 'By default, all form fields are sent via <b> [all-fields] </b>  shortcode. To customize sent fields, copy the field id that you enter inside each field and paste it above.'
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'form_advance_option',
			[
				'label' => __( 'Advanced Options', 'mighty' ),
			]
		);

			$this->add_control(
				'submission_type', [
					'label' => esc_html__( 'Action After Submissions', 'mighty' ),
					'type' => Controls_Manager::SELECT,
					'default' => __('ajax_submission'),
					'options' => [
						'ajax_submission' => __('Ajax Submission', 'mighty'),
						'redirect' => __('Redirect', 'mighty'),
					],
					'label_block' => true,
				]
			);

			$this->add_control(
				'thank_you_msg', [
					'label' => __( 'Thank you Message', 'mighty' ),
					'type' => Controls_Manager::TEXTAREA,
					'condition' => [
						'submission_type' => 'ajax_submission',
					],
					'default' => '<i class="fas fa-check-circle" aria-hidden="true"></i>Thank you! the form is sent successfully'
				]
			);

			$this->add_control(
				'redirect_url', [
					'label' => __( 'Redirect To', 'mighty' ),
					'type' => Controls_Manager::TEXT,
					'condition' => [
						'submission_type' => 'redirect',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'form_style',
			[
				'label' => __( 'Form', 'mighty' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
        );

			$this->add_responsive_control(
				'column_gap',
				[
					'label' => __( 'Columns Gap', 'mighty' ),
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
						'{{WRAPPER}} .mt-c-form-fields-wrapper .field-group' => 'padding-left: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} .mt-c-form-fields-wrapper .field-group' => 'padding-right: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_responsive_control(
                'row_gap',
                [
                    'label' => __( 'Rows Gap', 'mighty' ),
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
                        '{{WRAPPER}} .mt-c-form-fields-wrapper .field-group' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                    ],
                ]
            );

			$this->add_control(
                'text_color',
                [
                    'label'     => __( 'Text Color', 'mighty' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .mt-c-form' => 'color: {{VALUES}}'
                    ]
                ]
            );

			$this->add_control(
                'link_color',
                [
                    'label'     => __( 'Link Color', 'mighty' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .mt-c-form a' => 'color: {{VALUES}}'
                    ]
                ]
            );

			$this->add_control(
                'link_hover_color',
                [
                    'label'     => __( 'Link Hover Color', 'mighty' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .mt-c-form a:hover' => 'color: {{VALUES}}'
                    ]
                ]
            );

			$this->add_control(
				'form_label',
				[
					'label' => esc_html__( 'Label', 'mighty' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_responsive_control(
                'form_label_spacing',
                [
                    'label' => __( 'Spacing', 'mighty' ),
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
                        '{{WRAPPER}} .mt-c-form-fields-wrapper .field-group .field-label' => 'margin-bottom: {{SIZE}}{{UNIT}}'
                    ]
                ]
            );

			$this->add_control(
                'label_text_color',
                [
                    'label'     => __( 'Text Color', 'mighty' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .mt-c-form-fields-wrapper .field-group .field-label' => 'color: {{VALUES}}'
                    ]
                ]
            );

			$this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'label_typography',
                    'selector' => '{{WRAPPER}} .mt-c-form-fields-wrapper .field-group .field-label',
                ]
            );

			$this->add_control(
				'form_placeholder',
				[
					'label' => esc_html__( 'Placeholder', 'mighty' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_control(
                'placeholder_text_color',
                [
                    'label'     => __( 'Text Color', 'mighty' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .mt-c-form-fields-wrapper .field-group .field::placeholder' => 'color: {{VALUES}}'
                    ]
                ]
            );

			$this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'placeholder_typography',
                    'selector' => '{{WRAPPER}} .mt-c-form-fields-wrapper .field-group .field::placeholder',
                ]
            );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			[
				'label' => __( 'Field', 'mighty' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
        );

			$this->add_control(
				'field_text_color',
				[
					'label'     => __( 'Text Color', 'mighty' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .mt-c-form-fields-wrapper .field-group .field' => 'color: {{VALUES}}'
					]
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'field_typography',
					'selector' => '{{WRAPPER}} .mt-c-form-fields-wrapper .field-group .field',
				]
			);

			$this->add_control(
				'field_bg_color',
				[
					'label'     => __( 'Background Color', 'mighty' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .mt-c-form-fields-wrapper .field-group .field' => 'background-color: {{VALUES}}'
					]
				]
			);

			$this->add_control(
				'field_border_color',
				[
					'label'     => __( 'Border Color', 'mighty' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .mt-c-form-fields-wrapper .field-group .field' => 'border-color: {{VALUES}}'
					]
				]
			);

			$this->add_responsive_control(
				'field_border_width',
				[
					'label' => __( 'Border Width', 'mighty' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' , '%' ],
					'selectors' => [
						'{{WRAPPER}} .mt-c-form-fields-wrapper .field-group .field' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

            $this->add_responsive_control(
				'image_border_radius',
				[
					'label' => __( 'Border Radius', 'mighty' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' , '%' ],
					'selectors' => [
						'{{WRAPPER}} .mt-c-form-fields-wrapper .field-group .field' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'form_button_style',
			[
				'label' => __( 'Button', 'mighty' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
        );

			$this->start_controls_tabs(
				'button_tabs'
			);
			// start normal tab
				$this->start_controls_tab(
					'button_normal',
					[
						'label' => __('Normal', 'mighty'),
					]
				);

					$this->add_control(
						'button_text_color',
						[
							'label'     => __( 'Text Color', 'mighty' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .mt-c-form-fields-wrapper .type-submit .button' => 'color: {{VALUES}}'
							]
						]
					);

					$this->add_control(
						'button_background_color',
						[
							'label'     => __( 'Background Color', 'mighty' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .mt-c-form-fields-wrapper .type-submit .button' => 'background-color: {{VALUES}}'
							]
						]
					);

					$this->add_group_control(
						Group_Control_Typography::get_type(),
						[
							'name' => 'button_typography',
							'selector' => '{{WRAPPER}} .mt-c-form-fields-wrapper .type-submit .button',
						]
					);

				$this->end_controls_tab();
				// end normal tab
				// start hover tab
				$this->start_controls_tab(
					'button_hover',
					[
						'label' => __('Hover', 'mighty'),
					]
				);

					$this->add_control(
						'button_text_hover_color',
						[
							'label'     => __( 'Text Color', 'mighty' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .mt-c-form-fields-wrapper .type-submit .button:hover' => 'color: {{VALUES}}'
							]
						]
					);

					$this->add_control(
						'button_background_hover_color',
						[
							'label'     => __( 'Background Color', 'mighty' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .mt-c-form-fields-wrapper .type-submit .button:hover' => 'background-color: {{VALUES}}'
							]
						]
					);

					$this->add_group_control(
						Group_Control_Typography::get_type(),
						[
							'name' => 'button_hover_typography',
							'selector' => '{{WRAPPER}} .mt-c-form-fields-wrapper .type-submit .button:hover',
						]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'button_border_type',
					'label' => __( 'Border Type', 'mighty' ),
					'selector' => '{{WRAPPER}} .mt-c-form-fields-wrapper .type-submit .button',
				]
			);

			$this->add_responsive_control(
				'button_border_radius',
				[
					'label' => __( 'Border Radius', 'mighty' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' , '%' ],
					'selectors' => [
						'{{WRAPPER}} .mt-c-form-fields-wrapper .type-submit .button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'button_box_shadow',
                    'label' => __( 'Button Shadow', 'mighty' ),
                    'selector' => '{{WRAPPER}} .mt-c-form-fields-wrapper .type-submit .button',
                ]
            );

			$this->add_responsive_control(
				'button_padding',
				[
					'label' => __( 'Padding', 'mighty' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' , '%' ],
					'selectors' => [
						'{{WRAPPER}} .mt-c-form-fields-wrapper .type-submit .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'form_message',
			[
				'label' => __( 'Message', 'mighty' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
        );

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'message_typography',
					'selector' => '{{WRAPPER}} .mt-c-form-fields-wrapper .submit-message',
				]
			);

			$this->add_control(
				'success_msg_color',
				[
					'label'     => __( 'Success Message Color', 'mighty' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .mt-c-form-fields-wrapper .submit-message.thankyou' => 'color: {{VALUES}}'
					]
				]
			);

			$this->add_control(
				'error_msg_color',
				[
					'label'     => __( 'Error Message Color', 'mighty' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .mt-c-form-fields-wrapper .submit-message.error' => 'color: {{VALUES}}'
					]
				]
			);

		$this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
		$form_fields = $settings['form_list'];
		$email_value = [];

		( !empty( $settings['form_send_to'] ) ) ? $email_value['form_send_to'] = $settings['form_send_to'] : '';
		( !empty( $settings['form_from_email'] ) ) ? $email_value['form_from_email'] = $settings['form_from_email'] : '';
		( !empty( $settings['form_from_name'] ) ) ? $email_value['form_from_name'] = $settings['form_from_name'] : '';
		( !empty( $settings['form_email_subject'] ) ) ? $email_value['form_email_subject'] = $settings['form_email_subject'] : '';
		( !empty( $settings['form_reply_email'] ) ) ? $email_value['form_reply_email'] = $settings['form_reply_email'] : '';
		( !empty( $settings['form_reply_name'] ) ) ? $email_value['form_reply_name'] = $settings['form_reply_name'] : '';
		( !empty( $settings['form_cc_emails'] ) ) ? $email_value['form_cc_emails'] = $settings['form_cc_emails'] : '';
		( !empty( $settings['form_bcc_emails'] ) ) ? $email_value['form_bcc_emails'] = $settings['form_bcc_emails'] : '';

		$a = rand(1,9);
		$b = rand(1,9);
		$c = $a * $b;

		if( $settings['form_captcha_type'] == 'default' && $settings['form_enable_captcha'] == 'yes' ) {
			$this->add_render_attribute( 'mt-contact', 'data-dc_value', $c );
		}
		if( $settings['form_enable_captcha'] == 'yes' ) {
			$this->add_render_attribute( 'mt-contact', 'data-captcha_type', $settings['form_captcha_type'] );
		}
		
		if ( !empty($email_value) ) {
			$this->add_render_attribute( 'mt-contact', 'data-email_value', json_encode( $email_value ) );
		}

		$this->add_render_attribute( 'mt-contact', 'data-enable_captcha', $settings['form_enable_captcha'] );

		if ( $settings['email_copy_sender'] == 'yes' ) {

			$this->add_render_attribute( 'mt-contact', 'data-sender_email', wp_get_current_user()->user_email );
		}
		if ( $settings['submission_type'] == 'ajax_submission' ) {

			$this->add_render_attribute( 'mt-contact', 'data-thankyoumsg', $settings['thank_you_msg'] );
		}
		if ( $settings['submission_type'] == 'redirect' ) {

			$this->add_render_attribute( 'mt-contact', 'data-redirect_url', $settings['redirect_url'] );
		}

		$form_fields_data = []; 

		foreach( $form_fields as $field_id => $field_values ) {
			$form_fields_data[$field_values['form_field_id']] = 'form-'.$field_values['form_field_label'].$field_id;
		}
		if( $settings['form_email_template'] == 'custom' ) {

			$this->add_render_attribute( 'mt-contact', 'data-template_data', $settings['form_email_custom_template'] );
			$this->add_render_attribute( 'mt-contact', 'data-form_data', json_encode( $form_fields_data ) );

		}

	?>
	<script src='https://www.google.com/recaptcha/api.js' async defer ></script>

	<div class="container mt-form">
		<form class="mt-c-form mt-c-form-<?php echo $this->get_id(); ?>" action="javascript:void(0)" id="mt-c-form" method="post" name="<?php echo $settings['contact_form_name'];?>" <?php echo $this->get_render_attribute_string('mt-contact');?> >
			<div class="mt-c-form-fields-wrapper">
				<div class="mt-c-form-fields-wrapper-inner">

					<?php foreach( $form_fields as $key => $field_type ) { ?> 

						<div class="type-text field-group <?php echo ( $field_type['form_field_required'] == 'yes' && $settings['form_field_show_required_mark'] == 'yes' ) ? 'mark-required' : ''; ?> mt-form-col-<?php echo $field_type['form_field_column_width']; ?>">
							<?php if ( $settings['form_field_show_label'] == 'yes' ) { ?>
								<label class="field-label"><?php echo $field_type['form_field_label']; ?></label>
							<?php } ?>
							<?php if ( $field_type['form_field_type'] == 'name' || $field_type['form_field_type'] == 'subject' ) { ?>

								<input type="text" name="form-<?php echo $field_type['form_field_label'].$key; ?>" class="field field-size-<?php echo $settings['form_field_input_size'];?>" placeholder="<?php echo $field_type['form_field_placeholder']; ?>" <?php echo ( $field_type['form_field_required'] == 'yes' ) ? 'required' : ''; ?> >

							<?php } ?>	
							<?php if ( $field_type['form_field_type'] == 'number' ) { ?>

								<input type="number" name="form-<?php echo $field_type['form_field_label'] . $key; ?>" class="field field-size-<?php echo $settings['form_field_input_size'];?>" placeholder="<?php echo $field_type['form_field_placeholder']; ?>" <?php echo ( $field_type['form_field_required'] == 'yes' ) ? 'required' : ''; ?> min=<?php echo $field_type['form_field_min_length']; ?> max=<?php echo $field_type['form_field_max_length']; ?> >

							<?php } ?>	
							<?php if ( $field_type['form_field_type'] == 'email' ) { ?>

								<input type="email" name="form-<?php echo $field_type['form_field_label'] . $key; ?>" class="field field-size-<?php echo $settings['form_field_input_size'];?>" placeholder="<?php echo $field_type['form_field_placeholder']; ?>" <?php echo ( $field_type['form_field_required'] == 'yes' ) ? 'required' : ''; ?> >

							<?php } ?>	
							<?php if ( $field_type['form_field_type'] == 'message' ) { ?>

								<textarea name="form-<?php echo $field_type['form_field_label'] . $key; ?>" class="field field-size-<?php echo $settings['form_field_input_size'];?>" placeholder="<?php echo $field_type['form_field_placeholder']; ?>" <?php echo ( $field_type['form_field_required'] == 'yes' ) ? 'required' : ''; ?> rows="<?php echo $field_type['form_field_message_rows'];?>" ></textarea>

							<?php } ?>	

						</div>

					<?php } ?>

					<?php if( $settings['form_show_consent'] == 'yes' ) { ?>
						<div class="type-acceptance field-group mt-form-col-100">
							<div class="field-subgroup">
								<span class="field-option">
									<input type="checkbox" name="consent_agree" required >
									<label><?php echo $settings['consent_text']; ?></label>
								</span>
							</div>
						</div>
					<?php } ?>	

					<?php if ( $settings['form_enable_captcha'] == 'yes' ) { ?>
						<div class="type-recaptcha field-group mt-form-col-100">
							<?php if ( $settings['form_captcha_type'] == 'default' ) { ?>
								<div class="captcha-wrapper">
									<!-- <div class="captcha-output"></div> -->
									<input type="text" class="field field-size-md captcha-input" name="default_captcha_ans" placeholder="<?php echo $a . '*' . $b; ?>" required>
								</div>
								<?php } else { ?>
									<?php if ( !empty( Helper::get_integration_option('captcha-key') ) ) { ?>
										<div class="g-recaptcha" data-sitekey="<?php echo Helper::get_integration_option('captcha-key'); ?>" <?php echo ( $settings['form_captcha_type'] == 'gir' ) ? 'data-size="invisible"' : ''; ?>></div>
									<?php } ?>	
							<?php } ?>
						</div>
					<?php } ?>
				
					<div class="type-submit field-group mt-form-col-<?php echo $settings['form_button_width'];?>  button-<?php echo $settings['button_alignment']; ?>">
						<button type="submit" class="button button-<?php echo $settings['form_button_size']; ?> icon-<?php echo $settings['button_icon_position']; ?>" <?php echo ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) ? 'disabled="disabled"' : ''; ?> >
							<span>
								<?php if( !empty( $settings['form_button_icon']['value'] ) ) { ?>
									<span class="button-icon">
										<i aria-hidden="true" class="<?php echo $settings['form_button_icon']['value']; ?>"></i>
									</span>
								<?php } ?>	
								<span class="button-text"><?php echo $settings['form_button_text']; ?></span>
							</span>
						</button>
					</div>
				</div>
			</div>
		</form>
   </div>

    <?php }

}
	