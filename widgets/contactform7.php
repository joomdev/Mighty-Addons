<?php
namespace MightyAddons\Widgets;

use \MightyAddons\Classes\HelperFunctions as Helper;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils as Utils;
use Elementor\Repeater as Repeater;

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

        $this->end_controls_section();
	}
	
	protected function render() {

        if ( ! Helper::isCf7Active() ) {
            return;
        }

        $settings = $this->get_settings_for_display();

        if ( ! empty( $settings['cf7_form_id'] ) ) {
            echo "<div class='mighty-cf7-wrapper'>";
            echo do_shortcode( '[contact-form-7 id="' . $settings['cf7_form_id'] . '"]' );
            echo "</div>";
        }
	}
	
	protected function _content_template() {
	}
}