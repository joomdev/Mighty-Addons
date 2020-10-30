<?php

namespace MightyAddons\Extensions\MT_StubExtensions;

use \MightyAddons\Classes\HelperFunctions;

// Elementor classes
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class MT_StubExtensions {

    private static $_instance = null;

    public final function __construct() {

		// Register controls
		add_action( 'elementor/element/after_section_end', [ $this, 'register_controls' ], 10, 3 );

	}
    
    public function register_controls( $element, $section_id ) {

		if ( '_section_responsive' !== $section_id ) {
			return;
		}

		if ( function_exists('is_plugin_active') && HelperFunctions::mightyProAvailable() ) {
			return;
		}

		$pro_extensions = HelperFunctions::$mighty_addons_pro_stub['extensions'];
		if ( ! empty( $pro_extensions ) ) {
			foreach ( $pro_extensions as $extension => $props ) {
				if ( isset( $props['sidebar'] ) ) {

					$element->start_controls_section(
						$props['slug'],
						[
							'tab'   => 'map',
							'label' => __( $props['title'], 'mighty' ),
						]
					);

						$element->add_control(
							'pro_notice_' . $props['slug'],
							[
								// 'label' => __( 'Important Note', 'mighty' ),
								'type' => \Elementor\Controls_Manager::RAW_HTML,
								'raw' => __( '
									<div style="text-align:center; margin: 20px 0;">
										<img src="' . MIGHTY_ADDONS_PLG_URL . 'assets/admin/images/go-pro-editor.svg' .'">
										<div class="elementor-nerd-box-title">' . $props['title'] . '</div>
										<p class="elementor-nerd-box-message">' . $props['description'] . '</p>
										<a target="_blank" href="https://mightythemes.com/mighty-addons" style="background-color: #7327F2; margin-top: 10px;" class="elementor-button elementor-button-default elementor-button-go-pro">Go Pro</a>
									</div>
								', 'mighty' ),
							]
						);

					$element->end_controls_section();

				}
			}
		}
        
	}
    
    public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
}

MT_StubExtensions::instance();