<?php
namespace MightyAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils as Utils;
use Elementor\Repeater as Repeater;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;
use \Elementor\Scheme_Typography;
use \Elementor\Scheme_Color;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor MT_OpeningHours
 *
 * Elementor widget for MT_OpeningHours.
 *
 * @since 1.0.0
 */
class MT_OpeningHours extends Widget_Base {
	
	public function get_name() {
		return 'mt-openinghours';
	}
	
	public function get_title() {
		return __( 'MT Opening Hours', 'mighty' );
	}
	
	public function get_icon() {
		return 'fas fa-clock';
	}

	public function get_categories() {
		return [ 'mighty-addons' ];
	}

	public function get_style_depends() {
		return [ 'mt-common', 'mt-openinghours' ];
    }
	
	protected function _register_controls() {

        $this->start_controls_section(
			'section_openinghours',
			[
				'label' => __( 'MT Opening Hours', 'mighty' ),
			]
        );

        $this->end_controls_section();
        
	}
	
	protected function render() {
        $settings = $this->get_settings_for_display();

        if ( empty( $settings[ 'MT_OpeningHours'] ) ) {
            return;
		}
        
        ?>

        <div class="mt-openinghours-wrapper">

        </div>

        <?php
        
	}
	
	protected function _content_template() {
	}
}
