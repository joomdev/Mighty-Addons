<?php
namespace MightyAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils as Utils;
use \Elementor\Group_Control_Typography;
use \Elementor\Scheme_Typography;
use \Elementor\Scheme_Color;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor MT_GradientHeading
 *
 * Elementor widget for MT_GradientHeading.
 *
 * @since 1.0.0
 */
class MT_GradientHeading extends Widget_Base {
	
	public function get_name() {
		return 'gradient-heading';
	}
	
	public function get_title() {
		return __( 'MT Gradient Heading', 'mighty' );
	}
	
	public function get_icon() {
		return 'fas fa-heading';
	}

	public function get_categories() {
		return [ 'mighty-addons' ];
	}

	public function get_style_depends() {
		return [ 'mt-gradientheading' ];
    }
	
	protected function _register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'MT Gradient Heading', 'mighty' ),
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
