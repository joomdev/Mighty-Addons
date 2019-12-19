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
class Elementor {
    
	public function __construct() {
		add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'enqueue_editor_scripts' ] );
		add_action( 'elementor/preview/enqueue_styles', [ $this, 'enqueue_editor_scripts' ] );

	}

	/**
	 * Load styles and scripts for Elementor modal.
	 *
	 * @return void
	 */
	public function enqueue_editor_scripts() {

        wp_enqueue_script( 'mightyaddons-elementor-modal', MIGHTY_ADDONS_PLG_URL . 'assets/js/elementor-modal.js', [ 'jquery' ], MIGHTY_ADDONS_VERSION, false );
        
		wp_enqueue_style( 'mightyaddons-elementor-modal', MIGHTY_ADDONS_PLG_URL . 'assets/css/elementor-modal.css', [ 'dashicons' ], MIGHTY_ADDONS_VERSION );

		wp_enqueue_script(
			'mightylibrary-modal',
			MIGHTY_ADDONS_PLG_URL . 'assets/js/app-modal.js',
			[
				'react',
				'react-dom',
				'jquery',
				'wp-components',
				'wp-hooks',
				'wp-i18n',
				'wp-api-fetch',
				'wp-html-entities',
			],
			MIGHTY_ADDONS_VERSION,
			true
		);
		wp_set_script_translations( 'mightylibrary-modal', 'ang' );

		wp_enqueue_style( 'wp-components' );

		$i10n = apply_filters( // phpcs:ignore
			'analog/app/strings',
			[
				'is_settings_page' => false,
				'syncColors'       => ( '' !== Options::get_instance()->get( 'ang_sync_colors' ) ? Options::get_instance()->get( 'ang_sync_colors' ) : true ),
				'stylekit_queue'   => Utils::get_stylekit_queue() ? array_values( Utils::get_stylekit_queue() ) : [],
			]
		);

		wp_localize_script( 'mightylibrary-modal', 'AGWP', $i10n );
	}
}

new Elementor();
