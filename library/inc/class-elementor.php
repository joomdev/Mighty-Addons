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

use Elementor\Plugin;

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
		add_action( 'wp_ajax_elementor_fetch_tmpl_data', [ $this, 'fetch_tmpl_data'], 1);
	}

	/**
	 * Load styles and scripts for Elementor modal.
	 */
	public function enqueue_editor_scripts() {
		
		wp_enqueue_style( 'mightyaddons-elementor-modal', MIGHTY_ADDONS_PLG_URL . 'library/assets/css/elementor-modal.css', [], MIGHTY_ADDONS_VERSION );
		
		wp_enqueue_style( 'mighty-library-admin', MIGHTY_ADDONS_PLG_URL . 'library/assets/js/library/build/static/css/main.d1b05096.chunk.css', [], MIGHTY_ADDONS_VERSION );

		wp_enqueue_script( 'mightyaddons-elementor-modal', MIGHTY_ADDONS_PLG_URL . 'library/assets/js/elementor-modal.js', [ 'jquery' ], MIGHTY_ADDONS_VERSION );

		wp_enqueue_script(
			'mighty-library-react',
			MIGHTY_ADDONS_PLG_URL . 'library/assets/js/lib2/dist/public/bundle.js',
			['wp-element', 'wp-components'],
			MIGHTY_ADDONS_VERSION,
			true 
		);

		wp_localize_script( 'mighty-library-react', 'MightyLibrary', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' )
		) );
	}

	/**
	 * Fetches the selected tmpl by user.
	 */
	public function fetch_tmpl_data() 
	{
		$tmplUrl = !isset($_POST['tmpl']) ? '' : $_POST['tmpl'];
		
		$response = wp_remote_get($tmplUrl, array(
            'timeout' => 120,
            'httpversion' => '1.1'
		));
		
		$tmpl = json_decode($response['body'], true);
		
		$content = $this->process_import_ids($tmpl);
		
		$content = $this->process_import_content($tmpl, 'on_import');
		
		// return $content;

		if ( is_wp_error( $content ) ) {
			echo json_encode( $content->errors );
		} else {
			echo 'successful import';
		}

		die();
	}

	protected function process_import_ids($content)
    {
        return \Elementor\Plugin::$instance
            ->db->iterate_data($content, function ($element)
        {
            $element['id'] = \Elementor\Utils::generate_random_string();
            return $element;
        });
	}
	
	protected function process_import_content($content, $method)
    {
        return \Elementor\Plugin::$instance->db->iterate_data($content, function ($element_data) use ($method)
        {
            $element = \Elementor\Plugin::$instance->elements_manager->create_element_instance($element_data);

            if (!$element)
            {
                return null;
            }

            $r = $this->process_import_element($element, $method);
            
            return $r;
        });
	}
	
	protected function process_import_element($element, $method)
    {
        $element_data = $element->get_data();
        if (method_exists($element, $method))
        {
            $element_data = $element->{$method}($element_data);
        }
        foreach ($element->get_controls() as $control)
        {
            $control_class = \ELementor\Plugin::$instance
                ->controls_manager
                ->get_control($control['type']);
            if (!$control_class)
            {
                return $element_data;
            }
            if (method_exists($control_class, $method))
            {
                $element_data['settings'][$control['name']] = $control_class->{$method}($element->get_settings($control['name']) , $control);
            }
        }
        return $element_data;
    }
}

new Elementor();
