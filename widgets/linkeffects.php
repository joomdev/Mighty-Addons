<?php
namespace MightyAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor MT_LinkEffects
 *
 * Elementor widget for MT_LinkEffects.
 *
 * @since 1.4.5
 */
class MT_LinkEffects extends Widget_Base {
	
	public function get_name() {
		return 'mt-linkeffects';
	}
	
	public function get_title() {
		return __( 'Link Effects', 'mighty' );
	}
	
	public function get_icon() {
		return 'mf mf-linkeffects';
	}

	public function get_categories() {
		return [ 'mighty-addons' ];
    }    
    
    public function get_keywords() {
		return [ 'mighty', 'link', 'url', 'effect' ];
    }

	public function get_style_depends() {
		return [ 'mt-common', 'mt-linkeffects' ];
    }
	
	protected function _register_controls() {

        $this->start_controls_section(
			'section_linkeffects',
			[
				'label' => __( 'Link Effects', 'mighty' ),
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