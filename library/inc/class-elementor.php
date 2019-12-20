<?php
/**
 * Mighty Library
 * 
 * Integrating Elementor core.
 *
 * @package MightyAddons
 * @since 1.2.1
 */

namespace Mighty_Addons;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


/**
 * Elementor registration for MightyAddons popup.
 *
 * @since 1.2.1
 */
class Elementor extends base {
    
	public function __construct() {
		
		add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'enqueue_editor_scripts' ] );
		add_action( 'elementor/preview/enqueue_styles', [ $this, 'enqueue_editor_scripts' ] );

	}

	/**
	 * Load styles and scripts for Elementor modal.
	 */
	public function enqueue_editor_scripts() {

		wp_enqueue_script( 'mightyaddons-elementor-modal', MIGHTY_ADDONS_PLG_URL . 'library/assets/js/elementor-modal.js', [ 'jquery' ], MIGHTY_ADDONS_VERSION );
		
		wp_enqueue_style( 'mightyaddons-elementor-modal', MIGHTY_ADDONS_PLG_URL . 'library/assets/css/elementor-modal.css', [], MIGHTY_ADDONS_VERSION );

	}
}

new Elementor();
