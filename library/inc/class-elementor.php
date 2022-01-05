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
use \MightyAddons\Classes\HelperFunctions;

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
		add_action( 'wp_ajax_elementor_fetch_copy_paste_data', [ $this, 'fetch_copy_paste_data'], 1);
		add_action( 'wp_ajax_save_mighty_extension_media', [ $this, 'mighty_extension_media'] );
	}

	/**
	 * Load styles and scripts for Elementor modal.
	 */
	public function enqueue_editor_scripts() {

		$this->activated_plugins = HelperFunctions::get_all_plugins();
		
		if ( in_array( 'elementor-pro/elementor-pro.php', $this->activated_plugins['active'], true ) ) {
			$elementorPro = true;
		} else {
			$elementorPro = false;
		}

		if( is_plugin_active( 'Mighty-Addons-Pro/mighty-addons-pro.php' ) || is_plugin_active( 'mighty-addons-pro/mighty-addons-pro.php' )) {
			$mightyAddonsProActive = true;
		} else {
			$mightyAddonsProActive = false;
		}

		if ( isset( get_option('mighty_addons_pro_key')['map-user-key'] ) ) {
			$mapKeyActive = true;
		} else {
			$mapKeyActive = false;
		}
		
		wp_enqueue_style( 'mightyaddons-elementor-modal', MIGHTY_ADDONS_PLG_URL . 'library/assets/css/elementor-modal.css', [], MIGHTY_ADDONS_VERSION );

		wp_enqueue_script( 'mightyaddons-elementor-modal', MIGHTY_ADDONS_PLG_URL . 'library/assets/js/elementor-modal.js', [ 'jquery' ], MIGHTY_ADDONS_VERSION );

		wp_localize_script( 'mightyaddons-elementor-modal', 'MightyAddonsModal', array(
			'enableLibrary' => HelperFunctions::get_white_label( 'hide_templatelibrary' ),
		) );

		wp_enqueue_script(
			'mighty-library-react',
			MIGHTY_ADDONS_PLG_URL . 'library/assets/js/lib/build/main.js',
			['wp-element', 'wp-components'],
			MIGHTY_ADDONS_VERSION,
			true
		);
		
		// Image Sizes for Gallery
		$imageSizes = [];
		foreach( get_intermediate_image_sizes() as $size ) {
			if ( get_option( $size . "_size_w" ) || get_option( $size . "_size_h" ) ) {
				$imageSizes[] = [
					'name' => ucwords( implode( ' ', explode( '_', $size ) ) ) . ' - ' . get_option( $size . "_size_w" ) . ' x ' . get_option( $size . "_size_h" ),
					'size' => $size
				];
			} else {
				$imageSizes[] = [ 'name' => $size, 'size' => $size ];
			}
		}
		$imageSizes[] = [ 'name' => 'Full', 'size' => 'full' ];

		wp_localize_script( 'mighty-library-react', 'MightyLibrary', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'baseUrl' => MIGHTY_ADDONS_PLG_URL,
			'apiUrl' => "https://api.mightythemes.com/api/",
			'elementorPro' => $elementorPro,
			'maProStatus' => $mightyAddonsProActive,
			'key' => isset(HelperFunctions::getProKey()['map-user-key']) ? HelperFunctions::getProKey()['map-user-key'] : '',
			'host' => $_SERVER['HTTP_HOST'],
			'nonce' => "MightyLibrary",
			'pxStatus' => HelperFunctions::mighty_addons()['extensions']['pixabay']['enable'],
			'unsplashStatus' => isset( HelperFunctions::mighty_addons_pro()['extensions']['unsplash']['enable'] ) ? HelperFunctions::mighty_addons_pro()['extensions']['unsplash']['enable'] : false,
			'pxUrl' => "pixabay/image/",
			'usUrl' => "unsplash/image/",
			'plgShortName' => HelperFunctions::get_white_label('plugin_short_name'),
			'elementorCompatible' => ELEMENTOR_OLD_COMPATIBLITY,
			'keyActive' => $mapKeyActive,
			'imageSizes' => $imageSizes
		) );
	}

	/**
	 * Fetches the selected tmpl by user.
	 */
	public function fetch_tmpl_data() 
	{
		$tmplUrl = !isset($_POST['tmpl']) ? '' : $_POST['tmpl'];
		$key = get_option('mighty_addons_pro_key') ? get_option('mighty_addons_pro_key')['map-user-key'] : "";
		
		$response = wp_remote_post($tmplUrl, [
			'method' => 'POST',
			'headers' => [
				'Content-Type' => 'application/json; charset=utf-8',
			],
			'body' => json_encode([
				'key' => $key,
				'host' => $_SERVER['HTTP_HOST']
			])
		]);
		
		$tmpl = json_decode($response['body'], true);

		$content = $this->process_import_ids($tmpl);
		
		$content = $this->process_import_content($tmpl, 'on_import');
		
		print_r(\json_encode($content));

		wp_die();
	}

	public function fetch_copy_paste_data() 
	{
		$data = !isset( $_POST['data'] ) ? '' : wp_unslash( $_POST['data'] );
		$type = !isset( $_POST['type'] ) ? '' : wp_unslash( $_POST['type'] );

		if ( $type == "multiple" ) {
			$json = json_decode( $data, true );

			$tmpl = [
				"status" => 'success',
				"code" => 200,
				"data" => [
					"template" => [
						"content" => $json
					]
				]
			];
		} else if ( $type == "single" ) {
			$tmpl = array( json_decode( $data, true ) );
		}

		$content = $this->process_import_ids($tmpl);
		
		$content = $this->process_import_content($tmpl, 'on_import');

		wp_send_json_success( $content );
	}

	/**
	 * Fetches the selected image by user.
	 */
	public function mighty_extension_media()
	{
		$image = $_POST['image'];
		$src = $_POST['src'];
		$size = $_POST['size'];
		
		if ( $image ) {

			if ( $src == "unsplash" ) {

				$request  = wp_remote_get( $image );
				$response = wp_remote_retrieve_body( $request );
				
				$image = json_decode($response, true)['data']['url'];
				
				// Format
				parse_str(parse_url($image)['query'], $params);
				$imgFormat = ".".$params['fm'];
				
				$newfilename = md5(time()) . $imgFormat;
			}
			elseif ( $src == "pixabay" ) {
				$imageurl = stripslashes($image);
				
				$newfilename = basename($imageurl);
			}

			$uploads = wp_upload_dir();

			$filename = wp_unique_filename( $uploads['path'], $newfilename, $unique_filename_callback = null );
				
			$fullpathfilename = $uploads['path'] . "/" . $filename;

			$wp_filetype = wp_check_filetype($filename, null);

			try {
				if (!substr_count($wp_filetype['type'], "image")) {
					throw new Exception(basename($imageurl) . ' is not a valid image. ' . $wp_filetype['type'] . '');
				}
				
				$image_string = wp_remote_get( $image,
					array(
						'timeout'     => 120,
					)
				);
				
				$fileSaved = file_put_contents($uploads['path'] . "/" . $filename, $image_string['body']);
				
				if (!$fileSaved) {
					throw new Exception("The file cannot be saved.");
				}

				$attachment = array(
					'post_mime_type' => $wp_filetype['type'],
					'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
					'post_content' => '',
					'post_status' => 'inherit',
					'guid' => $uploads['url'] . "/" . $filename,
				);

				if ( $size !== 'full' ) {
					$resized = image_make_intermediate_size( $fullpathfilename, get_option( $size . "_size_w" ), get_option( $size . "_size_h" ), get_option( $size . "_crop" ) );

					if ( $resized ) {
						$fullpathfilename = $uploads['path'] . "/" . $resized['file'];
					}
				}
				
				$attach_id = wp_insert_attachment($attachment, $fullpathfilename);
				
				if (!$attach_id) {
					throw new Exception("Failed to save record into database.");
				}
				
				$attach_data = wp_generate_attachment_metadata($attach_id, $fullpathfilename);
				wp_update_attachment_metadata($attach_id, $attach_data);

				// Local URL
				$localUrl = $uploads['baseurl'] . '/' . $attach_data['file'];

				$data = array(
					"status" => true,
					"category" => "photos",
					"photoId" => "2QSPL8V",
					"attachmentData" => [
					  "id" => $attach_id,
					  "title" => "Lorem ipsum dolor sit amet",
					  "filename" => "lorem-ipsum-dolor-sit-amet.jpg",
					  "url" => $localUrl,
					  "link" => "#",
					  "alt" => "Lorem ipsum dolor sit amet",
					  "author" => "1",
					  "description" => "Lorem ipsum dolor sit amet, ipsum dolor",
					  "caption" => "Lorem ipsum dolor sit amet, ipsum dolor",
					  "name" => "lorem-ipsum-dolor-sit-amet",
					  "mime" => "image/jpeg",
					  "type" => "image",
					  "subtype" => "jpeg",
					  "dateFormatted" => "January 24, 2020",
					]
				);
				
				print_r(\json_encode($data));

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
