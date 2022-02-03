<?php
namespace MightyAddons;

use \MightyAddons\Classes\HelperFunctions;

/**
 * Class Mighty_Elementor
 * 
 * @since 1.0.0
 */
class Mighty_Elementor {

	private static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct() {

		// Register Widget Styles
		add_action( 'wp_enqueue_scripts', [ $this, 'mt_enqueue_styles' ] );

		add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'enqueue_editor_scripts' ] );

		// Register Custom Category
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_elementor_widget_categories' ] );

		// Register widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );

		add_filter( 'plugin_row_meta', array( $this, 'plugin_meta_links' ), 10, 2 );
		add_filter( 'plugin_action_links_' . MIGHTY_ADDONS_PLG_BASENAME, [ $this, 'plugin_action_links' ] );

		// Mailchimp
		add_action( 'wp_ajax_save_mailchimp_details', [ $this, 'mighty_mailchimp_details'] );
		add_action( 'wp_ajax_nopriv_save_mailchimp_details', [ $this, 'mighty_mailchimp_details'] );

		// Including Admin Widget and update options
		$this->update_mighty_options();

		// Including extensions
		$this->register_extension();
		
		// Copy/Paste
		if ( HelperFunctions::mighty_addons()['extensions']['xscp']['enable'] ) {
			add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'copy_paste_extension_scripts' ] );
		}

		// Registering stub widgets
		add_filter( 'elementor/editor/localize_settings', [ $this, 'get_stub_widgets' ] );

		add_action( 'wp_footer', [ $this, 'html_to_footer' ] );


	}

	public static function enqueue_editor_scripts() {

		wp_enqueue_style( 
			'font-awesome', 
			plugins_url( '/elementor/assets/lib/font-awesome/css/all.css' ), 
			false
		);

        wp_enqueue_style(
            'mighty-icons',
            MIGHTY_ADDONS_PLG_URL . 'assets/css/mighty-icons.min.css',
            null,
            MIGHTY_ADDONS_VERSION
		);

		wp_enqueue_style( 'mighty-icons' );

		$short_name = HelperFunctions::get_white_label('plugin_short_name');
		if ( '' !== $short_name ) {
			$custom_css = "
				.elementor-element [class*='mf-']:after {
					content: '{$short_name}';
				}";
			wp_add_inline_style( 'mighty-icons', $custom_css );
		}
	}

	public function mt_enqueue_styles() {		
		// Common Stylings
		wp_enqueue_style( 'mt-common', MIGHTY_ADDONS_PLG_URL . 'assets/css/common.css', false, MIGHTY_ADDONS_VERSION );

		// Reading-progress-bar
		wp_enqueue_script(
			'mt-rpbjs',
			MIGHTY_ADDONS_PLG_URL . 'assets/js/rpb.js',
			[ 'jquery' ],
			MIGHTY_ADDONS_VERSION,
			true
		);
	}

	/**
	 * Plugin Category
	 *
	 * Creating category for Mighty Addons
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function add_elementor_widget_categories( $elements_manager ) {

		$branding = HelperFunctions::get_white_label();

		$elements_manager->add_category(
			'mighty-addons',
			[
				'title' => $branding['plugin_name']
			]
		);
	}

	public function update_mighty_options() {
		
		require_once ( MIGHTY_ADDONS_DIR_PATH . 'classes/panel.php' );
		
		$dashboard = new \MightyAddons\Classes\DashboardPanel;
		$widgets = $dashboard->get_enabled_addons();
		
		if ( 
			get_option('mighty_addons_status') &&
			isset(get_option('mighty_addons_status')['version']) && 
			get_option('mighty_addons_status')['version'] === MIGHTY_ADDONS_VERSION
		) {
			// do nothing
		} else {
			update_option( 'mighty_addons_status', $widgets );
		}

	}
	
	public function register_widgets() {

		$widgets = HelperFunctions::mighty_addons()['addons'];
		
		foreach( $widgets as $widget => $props ) {
			if( $props['enable'] ) {
				
				// Including Plugin
				require_once( MIGHTY_ADDONS_DIR_PATH . 'widgets/' . $widget .'.php' );
				
				// Register Widgets
				$class = sprintf( 'MightyAddons\Widgets\%s', $props['class'] );
				\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $class );
			}
		}
		
	}

	public function register_extension() {

		// Registering stub extensions
		require_once( MIGHTY_ADDONS_DIR_PATH . 'extensions/stub-extensions.php' );

        if ( isset( HelperFunctions::mighty_addons()['extensions'] ) ) {
			$extensions = HelperFunctions::mighty_addons()['extensions'];
            if ( ! empty( $extensions ) ) {
                foreach ( $extensions as $extension => $props ) {

                    if ( $props['enable'] && $props['include'] ) {
						
                        // Magical Potion
                        require_once( MIGHTY_ADDONS_DIR_PATH . 'extensions/' . $extension . '.php' );
        
                    }
                }
            }
		}
		
    }

	public function get_stub_widgets( $settings ) {
		
		if ( function_exists('is_plugin_active') && HelperFunctions::mightyProAvailable() ) {
			return $settings;
		}

		$promotion_widgets = [];
		
		if ( isset( $settings['promotionWidgets'] ) ) {
			$promotion_widgets = $settings['promotionWidgets'];
		}

		$stub_widgets = HelperFunctions::$mighty_addons_pro_stub['addons'];

		$maWidgets = [];
		foreach( $stub_widgets as $stub ) {
			$maWidgets[] = [
				'name' => $stub['slug'],
				'title' => $stub['title'],
				'icon' => $stub['icon'],
				'categories' => '[ "mighty-addons" ]'
			];
		}

		$mergedArray = array_merge( $promotion_widgets, $maWidgets );

		$settings['promotionWidgets'] = $mergedArray;

		return $settings;
	}

	/**
	 * Send Mailchimp form data to API
	 */
	public function mighty_mailchimp_details() {
		if ( isset( $_POST['fields'] ) ) {
			parse_str( $_POST['fields'], $data );
		} else {
			return;
		}
		
		if ( empty( $data['email'] ) ) {
			return "Email is required!";
		}
		
		$mailchimpKey = HelperFunctions::get_integration_option('mailchimp-key');
		$region = substr( $mailchimpKey, strpos( $mailchimpKey, '-') + 1 );
		
		$email = $data['email'] ? $data['email'] : '';
		$fname = $data['fname'] ? $data['fname'] : '';
		$lname = $data['lname'] ? $data['lname'] : '';
		$list = $data['list'] ? $data['list'] : '';
		$memberId = md5(strtolower($email));
		$url = "https://$region.api.mailchimp.com/3.0/lists/$list/members/$memberId";

		$data = [
			"email_address" => $email,
			"status" => "subscribed",
			"merge_fields" => [
				"FNAME" => $fname,
				"LNAME" => $lname
			]
		];

		$response = wp_remote_post( $url, [
			'method' => 'PUT',
			'body'        => json_encode( $data ),
			'headers' => [
				'Authorization' => 'Basic ' . base64_encode( 'user:' . $mailchimpKey )
			],
		]);
		
		$response_body = json_decode( wp_remote_retrieve_body( $response ) );
		
		if ( $response_body->status == "subscribed" ) {
			return 1;
		} else {
			return 0;
		}
	}

	/**
	 * Enable Copy/Paste in Elementor's Editor View
	 */
	public function copy_paste_extension_scripts() {

		$branding = HelperFunctions::get_white_label();
		
		wp_enqueue_script(
			'mt-xs-localstorage',
			MIGHTY_ADDONS_PLG_URL . 'assets/js/xs-localstorage.js',
			null,
			MIGHTY_ADDONS_VERSION,
			true
		);

		// Cross-Site-Copy-Paste
		wp_enqueue_script(
			'mt-xs-cp',
			MIGHTY_ADDONS_PLG_URL . 'assets/js/xs-cp.js',
			[ 'jquery', 'elementor-editor' ],
			MIGHTY_ADDONS_VERSION,
			true
		);
		
		wp_localize_script( 'mt-xs-cp', 'xscp', array(
			'xdScript' => 'https://api.mightythemes.com/xscp',
			'copy' => sprintf( __( '%1s Copy', 'mighty' ), $branding['plugin_short_name'] ),
			'paste' => sprintf( __( '%1s Paste', 'mighty' ), $branding['plugin_short_name'] ),
			'copy_all' => sprintf( __( '%1s Copy All', 'mighty' ), $branding['plugin_short_name'] ),
			'paste_all' => sprintf( __( '%1s Paste All', 'mighty' ), $branding['plugin_short_name'] ),
			'elementorCompatible' => ELEMENTOR_OLD_COMPATIBLITY
		) );
	}

	/**
	 * Plugin action seconday links
	 * 
	 * Adds action links to the plugin secondary column
	 */
	public function plugin_meta_links( $links, $file ) {

		$currentScreen = get_current_screen();
		
		if( $currentScreen->id === "plugins" && MIGHTY_ADDONS_PLG_BASENAME == $file ) {

			$links[] = '<a target="_blank" href="https://mightythemes.com/docs/docs-category/mighty-addons/">' . esc_html__( 'Documentation', 'mighty' ) . '</a>';
			$links[] = '<a target="_blank" href="https://www.youtube.com/channel/UC6TOMaD5I2YTmf4mzHV5Yig">' . __( 'Video Tutorials', 'mighty' ) . '</a>';

		}

		return $links;
	}

	/**
	 * Plugin action links.
	 *
	 * Adds action links to the plugin primary column
	 */
	public function plugin_action_links( $links ) {
		$settings_link = sprintf( '<a href="%1$s">%2$s</a>', admin_url( 'admin.php?page=mighty-addons-home' ), __( 'Settings', 'mighty' ) );

		array_unshift( $links, $settings_link );

		if ( ! HelperFunctions::mightyProAvailable() ) {
			$links['go_pro'] = sprintf( '<a style="color: #5A00F0; font-weight: bold;" href="%1$s" target="_blank">%2$s</a>', 'https://mightythemes.com/mighty-addons', __( 'Go Pro', 'mighty' ) );
		}

		return $links;
	}

	/**
	 * Renders custom HTML to footer
	 */
	public function html_to_footer() {

		$postId = (string) get_the_ID();

		if( isset( get_option('mighty_addons_integration')['reading-progress-bar'] ) && array_key_exists( $postId, get_option('mighty_addons_integration')['reading-progress-bar'] )
		) {

			echo $this->getRpbHTML( get_option('mighty_addons_integration')['reading-progress-bar'][$postId] );

		} else if( isset( get_option('mighty_addons_integration')['reading-progress-bar-globally'] ) ) {

			$globalRpb = array_values( get_option('mighty_addons_integration')['reading-progress-bar-globally'] )[0];

			$showOn = $globalRpb['display_on'];

			if( ( get_post_type() == 'page' && $showOn == 'all-pages' ) || ( get_post_type() == 'post' && $showOn == 'all-posts' ) || ( ( get_post_type() == 'post' || get_post_type() == 'page' ) && $showOn == 'all-pages-posts' )) {
				
				echo $this->getRpbHTML( $globalRpb );

			}

		}
		
	}

	/**
	 * Refactors RPB HTML
	 */
	public function getRpbHTML( $options ) {

		$rpbHideOnDesktop = $options['hide_on_desktop'];
		$rpbHideOnTablet = $options['hide_on_tablet'];
		$rpbHideOnMobile = $options['hide_on_mobile'];

		if ( $options['select_view'] == 'view2' ) {

			$rpbIcon = $options['rpb_icon']['value'];
			$iconSize = $options['icon_size']['size'] . $options['icon_size']['unit'];
			$iconColor = $options['icon_color'];
			$iconBgColor = $options['icon_bg_color'];
			$iconHoverColor = $options['icon_hover_color'];
			$iconBgHoverColor = $options['icon_bg_hover_color'];
			$iconShape = $options['icon_shape'];
			$barSize = $options['bar_size']['size'];
			$barColor = $options['bar_color'];
			$barBgColor = $options['bar_bg_color'];
			$rpbAnimationSpeed = 'transition: stroke-dashoffset ' . ( $options['animation_speed'] ? $options['animation_speed']['size'] : '10') . 'ms ease; ';
			
			$rpbCss = 
			'<style>
				.ma-rpb-icon {
					font-size: ' . $iconSize . ';
					line-height: ' . $iconSize . ';
					color: ' . $iconColor . ';
				}

				#ma-btt-rpb.ma-progress-wrap {
					height: calc( 46px + (' . $iconSize . ' - 20px ) );
					width: calc( 46px + (' . $iconSize . ' - 20px ) );
				}

				.ma-rpb-icon:hover {
					color: ' . $iconHoverColor . ';
				}

				.ma-progress-wrap svg {
					background-color: ' . $iconBgColor . ';
				}

				.ma-progress-wrap:hover svg {
					background-color: ' . $iconBgHoverColor . ';
				}

				.ma-progress-wrap svg.progress-circle path.bar {
					' . $rpbAnimationSpeed . '
					stroke-width: '. $barSize .';
					stroke: '. $barColor .';
				}
				
				.ma-progress-wrap svg.progress-circle path.bar-bg {
					stroke: '. $barBgColor .';
					stroke-width: '. $barSize .';
				}
			</style>';

			$html = $rpbCss . '<div id="ma-btt-rpb" data-hide-on-desktop="' . $rpbHideOnDesktop . '" data-hide-on-tablet="' . $rpbHideOnTablet . '" data-hide-on-mobile="' . $rpbHideOnMobile . '" class="ma-rpb ma-progress-wrap"><svg class="progress-circle" width="100%" height="100%" viewBox="-1 -1 102 102"> <path class="bar-bg" d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" /> <path class="bar" d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" /> <div class="ma-rpb-icon"><i class="'. $rpbIcon .'"></i></div> </svg></div>';

		} else {
			$rpbAnimationSpeed = 'transition: width ' . ( $options['animation_speed'] ? $options['animation_speed']['size'] : '10') . 'ms ease; ';
			$rpbPosition = $options['position'];
			$rpbHeight = 'height: ' . $options['height']['size'] . $options['height']['unit'] . '; ';
			$rpbBgColor = 'background-color: ' . $options['background_color'] . '; ';
			$rpbFillColor = 'background-color: ' . $options['fill_color'] . '; ';
			
			$html = '<div id="ma-rpb" data-position="' . $rpbPosition . '" data-hide-on-desktop="' . $rpbHideOnDesktop . '" data-hide-on-tablet="' . $rpbHideOnTablet . '" data-hide-on-mobile="' . $rpbHideOnMobile . '" class="ma-rpb ma-rpb-header"><div class="ma-rpb-progress-container" style="' . $rpbBgColor . $rpbHeight . '"><div class="ma-rpb-progress-bar" style="' . $rpbHeight . $rpbFillColor . $rpbAnimationSpeed .'"></div></div></div>';
		}

		return $html;

	}
}

// Instantiate Mighty_Elementor Class
Mighty_Elementor::instance();
