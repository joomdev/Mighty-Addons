<?php
namespace MightyAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Scheme_Typography;
use \Elementor\Scheme_Color;
use \Elementor\Group_Control_Text_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor MT_FlipBox
 *
 * Elementor widget for MT_FlipBox.
 *
 * @since 1.0.0
 */
class MT_FlipBox extends Widget_Base {
	
	public function get_name() {
		return 'flip-box';
	}
	
	public function get_title() {
		return __( 'MT Flip Box', 'mighty' );
	}
	
	public function get_icon() {
		return 'fas fa-square';
	}

	public function get_categories() {
		return [ 'mighty-addons' ];
	}

	public function get_style_depends() {
		return [ 'mt-flipbox' ];
    }
	
	protected function _register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'MT Flip Box', 'mighty' ),
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
