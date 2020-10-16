<?php

namespace MightyAddons\Extensions\MT_Customcss;

use \MightyAddons\Classes\HelperFunctions;

// Elementor classes
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Core\DynamicTags\Dynamic_CSS;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class MT_Customcss {

    private static $_instance = null;

    public final function __construct() {
		
		// Register controls
		add_action( 'elementor/element/after_section_end', [ $this, 'register_controls' ], 10, 3 );

	}
    
    public function register_controls( $element, $section_id ) {

		if ( '_section_responsive' !== $section_id ) {
			return;
        }
        
		$element->start_controls_section(
			'mighty_custom_css',
			[
                'tab'   => 'map',
				'label' => __( 'MA Custom CSS', 'mighty' ),
			]
        );
        
			$element->add_control(
				'custom_css',
				[
					'label' => __( 'Custom CSS', 'mighty' ),
					'type' => \Elementor\Controls_Manager::CODE,
					'language' => 'css',
					'rows' => 20,
					'render_type' => 'ui',
				]
			);

        $element->end_controls_section();
        
	}
    
    public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
}

MT_Customcss::instance();