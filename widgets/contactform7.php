<?php
namespace MightyAddons\Widgets;

use \MightyAddons\Classes\HelperFunctions as Helper;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils as Utils;
use Elementor\Repeater as Repeater;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor MT_ContactForm7
 *
 * Elementor widget for MT_ContactForm7.
 *
 * @since 1.3.1
 */
class MT_ContactForm7 extends Widget_Base {
	
	public function get_name() {
		return 'mt-contactform7';
	}
	
	public function get_title() {
		return __( 'MT Contact Form 7', 'mighty' );
	}
	
	public function get_icon() {
		return 'mf mf-contactform7';
	}

	public function get_categories() {
		return [ 'mighty-addons' ];
	}

	public function get_style_depends() {
		return [ 'mt-common', 'mt-contactform7' ];
    }
	
	protected function _register_controls() {

        $this->start_controls_section(
			'section_contactform7',
			[
				'label' => __( 'MT Contact Form 7', 'mighty' ),
			]
        );

            if ( ! Helper::isCf7Active() ) {
                
                $this->add_control(
                    'cf7_inactive_notice',
                    [
                        'type' => Controls_Manager::RAW_HTML,
                        'raw' => __( '<p>You need to install and activate <b>Contact Form 7</b> to use the element.</p><br><p>1. Get <a target="_blank" rel="noopener" href="https://wordpress.org/plugins/contact-form-7/">Contact Form 7</a>.</p><br><p>2. Install and Activate the plugin.</b>.</p><br><p>3. Voila! Start styling your forms.</p>', 'mighty' ),
                        'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
                    ]
                );
                $this->end_controls_section();
                return;
            }
        
            $this->add_control(
                'cf7_form_id',
                [
                    'label' => __( 'Select Form', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'options' => Helper::cf7FormsList(),
                ]
            );

            $this->add_control(
                'show_title',
                [
                    'label' => __( 'Show Title', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'mighty' ),
                    'label_off' => __( 'Hide', 'mighty' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'cf7_title',
                [
                    'label' => __( 'Title', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'placeholder' => __( 'Type your title here', 'mighty' ),
                    'condition' => [
                        'show_title' => 'yes'
                    ]
                ]
            );

            $this->add_control(
                'show_description',
                [
                    'label' => __( 'Show Description', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'mighty' ),
                    'label_off' => __( 'Hide', 'mighty' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'cf7_description',
                [
                    'label' => __( 'Description', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'rows' => 5,
                    'placeholder' => __( 'Type your description here', 'mighty' ),
                    'condition' => [
                        'show_description' => 'yes'
                    ]
                ]
            );

            $this->add_control(
                'show_labels',
                [
                    'label' => __( 'Show Labels', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'mighty' ),
                    'label_off' => __( 'Hide', 'mighty' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'show_placeholders',
                [
                    'label' => __( 'Show Placeholders', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'mighty' ),
                    'label_off' => __( 'Hide', 'mighty' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
			'section_contactform7_messages',
			[
				'label' => __( 'Messages', 'mighty' ),
			]
        );

            $this->add_control(
                'show_success_msg',
                [
                    'label' => __( 'Show Success Message', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'mighty' ),
                    'label_off' => __( 'Hide', 'mighty' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'show_error_msg',
                [
                    'label' => __( 'Show Error Message', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'mighty' ),
                    'label_off' => __( 'Hide', 'mighty' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'show_validation_msg',
                [
                    'label' => __( 'Show Validation Message', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'mighty' ),
                    'label_off' => __( 'Hide', 'mighty' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'custom_class',
                [
                    'label' => __( 'Custom Classes', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'placeholder' => __( 'Type CSS Classes here', 'mighty' )
                ]
            );

            $this->add_control(
                'custom_id',
                [
                    'label' => __( 'Custom ID', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'placeholder' => __( 'Type CSS ID here', 'mighty' )
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_cf7_form_style',
            [
                'label' => __( 'Form', 'mighty' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'background',
                    'label' => __( 'Background', 'mighty' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .wrapper',
                ]
            );

            $this->add_responsive_control(
                'form_alignment',
                [
                    'label' => __( 'Form Alignment', 'mighty' ),
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
                    'default' => is_rtl() ? 'left' : 'right',
                    'toggle' => false,
                    'label_block' => false,
                ]
            );

            $this->add_responsive_control(
                'form_max_width',
                [
                    'label' => __( 'Width', 'mighty' ),
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
                        '{{WRAPPER}} .box' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'form_margin',
                [
                    'label' => __( 'Margin', 'mighty' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .your-class' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'form_padding',
                [
                    'label' => __( 'Padding', 'mighty' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .your-class' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'form_border',
                    'label' => __( 'Border', 'mighty' ),
                    'selector' => '{{WRAPPER}} .wrapper',
                ]
            );

            $this->add_responsive_control(
                'form_border_radius',
                [
                    'label' => __( 'Border Radius', 'mighty' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .your-class' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'form_box_shadow',
                    'label' => __( 'Box Shadow', 'mighty' ),
                    'selector' => '{{WRAPPER}} .wrapper',
                ]
            );

        $this->end_controls_section();
	}
	
	protected function render() {

        if ( ! Helper::isCf7Active() ) {
            return;
        }

        $settings = $this->get_settings_for_display();
        $cf7forms = Helper::cf7FormsList();

        if ( ! empty( $settings['cf7_form_id'] ) ) {
            echo "<div class='mighty-cf7-wrapper'>";
            echo "<div class='mighty-cf7-title'>";
            echo "<h1>Title</h1>";
            echo "</div>";
            echo do_shortcode( '[contact-form-7 id="' . $settings['cf7_form_id'] . ' title="' . $cf7forms[$settings['cf7_form_id']] .'"]' );
            echo "</div>";
        }
	}
	
	protected function _content_template() {
	}
}