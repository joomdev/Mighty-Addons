<?php

namespace MightyAddons\Extensions\MT_ReadingProgressBar;

// Elementor classes
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class MT_ReadingProgressBar {

    private static $_instance = null;

    public final function __construct() {
		
		// Register controls on Post/Page Settings
		add_action( 'elementor/documents/register_controls', [ $this, 'register_controls' ], 10, 3 );

	}
    
    public function register_controls( $element ) {
        
		$element->start_controls_section(
			'ma_reading_progress_bar',
			[
                'tab' => Controls_Manager::TAB_SETTINGS,
				'label' => __( 'MA Reading Progress Bar', 'mighty' ),
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

MT_ReadingProgressBar::instance();