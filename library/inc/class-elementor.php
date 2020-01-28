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

	/**
	 * All Activated Plugins
	 *
	 * @since 1.2.0
	 */
	private $activated_plugins = [];
    
	public function __construct() {
		add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'enqueue_editor_scripts' ] );
		add_action( 'elementor/preview/enqueue_styles', [ $this, 'enqueue_editor_scripts' ] );
		add_action( 'wp_ajax_elementor_fetch_tmpl_data', [ $this, 'fetch_tmpl_data'], 1);
		add_action( 'wp_ajax_save_mighty_extension_media', [ $this, 'mighty_extension_media'] );
		add_action( 'admin_enqueue_scripts', [ $this, 'load_custom_wp_admin_scripts' ], 100 );
	}

	/**
	 * Load styles and scripts for Elementor modal.
	 */
	public function enqueue_editor_scripts() {

		if ( ! $this->activated_plugins ) {
			$active_plugins          = apply_filters( 'active_plugins', get_option( 'active_plugins' ) );
			$active_sitewide_plugins = get_site_option( 'active_sitewide_plugins' );
			if ( ! is_array( $active_plugins ) ) {
				$active_plugins = [];
			}
			if ( ! is_array( $active_sitewide_plugins ) ) {
				$active_sitewide_plugins = [];
			}
			if ( ! function_exists( 'get_plugins' ) ) {
				require_once ABSPATH . 'wp-admin/includes/plugin.php';
			}
			$active_plugins                   = array_merge( $active_plugins, array_keys( $active_sitewide_plugins ) );
			$this->activated_plugins['active'] = $active_plugins;
			$this->activated_plugins['all']    = get_plugins();
		}
		
		if ( in_array( 'elementor-pro/elementor-pro.php', $this->activated_plugins['active'], true ) ) {
			$elementorPro = true;
		} else {
			$elementorPro = false;
		}
		
		wp_enqueue_style( 'mightyaddons-elementor-modal', MIGHTY_ADDONS_PLG_URL . 'library/assets/css/elementor-modal.css', [], MIGHTY_ADDONS_VERSION );

		wp_enqueue_script( 'mightyaddons-elementor-modal', MIGHTY_ADDONS_PLG_URL . 'library/assets/js/elementor-modal.js', [ 'jquery' ], MIGHTY_ADDONS_VERSION );

		wp_enqueue_script( 'mightyaddons-elementor-gallery', MIGHTY_ADDONS_PLG_URL . 'library/assets/js/elementor-gallery.js', [ 'jquery' ], MIGHTY_ADDONS_VERSION, true );

		wp_enqueue_script(
			'mighty-library-react',
			MIGHTY_ADDONS_PLG_URL . 'library/assets/js/lib/build/main.js',
			['wp-element', 'wp-components'],
			MIGHTY_ADDONS_VERSION,
			true
		);

		wp_localize_script( 'mighty-library-react', 'MightyLibrary', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'baseUrl' => MIGHTY_ADDONS_PLG_URL,
			'apiUrl' => "http://api.mightythemes.local/api/",
			'elementorPro' => $elementorPro,
			'key' => "",
			'host' => $_SERVER['HTTP_HOST'],
			'nonce' => "MightyLibrary"
		) );
	}

	public function load_custom_wp_admin_scripts() {

		wp_enqueue_script( 'mightyaddons-elementor-gallery', MIGHTY_ADDONS_PLG_URL . 'library/assets/js/elementor-gallery.js', [ 'jquery' ], MIGHTY_ADDONS_VERSION, true );

	}

	/**
	 * Fetches the selected tmpl by user.
	 */
	public function fetch_tmpl_data() 
	{
		$tmplUrl = !isset($_POST['tmpl']) ? '' : $_POST['tmpl'];

		$response = wp_remote_post($tmplUrl, [
			'key' => '',
			'host' => $_SERVER['HTTP_HOST']
		]);
		
		$tmpl = json_decode($response['body'], true);

		$content = $this->process_import_ids($tmpl);
		
		$content = $this->process_import_content($tmpl, 'on_import');
		
		print_r(\json_encode($content));

		die();
	}

	/**
	 * Fetches the selected image by user.
	 */
	public function mighty_extension_media()
	{
		$image = $_POST['image'];

		if ( $image ) {
			$imageurl = stripslashes($image);
			$uploads = wp_upload_dir();
			// $post_id = isset($_POST['postid']) ? (int) $_POST['postid'] : 0;
			$ext = pathinfo(basename($imageurl), PATHINFO_EXTENSION);
			$newfilename = basename($imageurl);
			$filename = wp_unique_filename($uploads['path'], $newfilename, $unique_filename_callback = null); // Get a filename that is sanitized and unique for the given directory.
			$wp_filetype = wp_check_filetype($filename, null);
			$fullpathfilename = $uploads['path'] . "/" . $filename;
			
            try {
                if (!substr_count($wp_filetype['type'], "image")) {
                    throw new Exception(basename($imageurl) . ' is not a valid image. ' . $wp_filetype['type'] . '');
				}
				
				$image_string = wp_remote_get($image);
				
				$fileSaved = file_put_contents($uploads['path'] . "/" . $filename, $image_string['body']);
				
                if (!$fileSaved) {
                    throw new Exception("The file cannot be saved.");
				}

				// Local URL
				$localUrl = $uploads['url'] . "/" . basename($fullpathfilename);
				
				print_r(\json_encode($localUrl));

				wp_die();

            } catch (Exception $e) {
				echo $e->getMessage();
            }
		}
	}

	protected function process_import_ids($content)
    {
        return \Elementor\Plugin::$instance->db->iterate_data($content, function ($element)
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
