<?php
/**
 * Dashboard
 *
 * Package: MightyAddons
 * @since 1.1.0
 */
namespace MightyAddons\Classes;

use \MightyAddons\Classes\HelperFunctions;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'DashboardPanel' ) ) {
    class DashboardPanel {

        const PLG_SLUG = 'mighty-addons';

        const PLG_NONCE = 'mighty_addons_panel';

        public static $mighty_addons;

        private static $ma_default_settings;

        private static $ma_settings;

        private static $ma_get_settings;

        public function __construct() {
            self::$mighty_addons = HelperFunctions::$mighty_addons;
        }
        
        public static function init() {
            
            add_action( 'admin_menu', [ __CLASS__, 'add_menu' ], 22 );

            add_action( 'admin_enqueue_scripts', [ __CLASS__, 'enqueue_scripts' ] );

            add_action( 'wp_ajax_save_mighty_addons_settings', [ __CLASS__, 'mighty_addons_status' ] );

            add_action( 'wp_ajax_save_mighty_addons_integration', [ __CLASS__, 'mighty_addons_integration' ] );

            add_filter( 'all_plugins', [ __CLASS__, 'plugin_settings' ] );

        }

        public static function add_menu() {

            $branding = HelperFunctions::get_white_label();

            add_menu_page(
                __( $branding['plugin_name'] . ' Panel', 'mighty-addons' ),
                __( $branding['plugin_name'], 'mighty-addons' ),
                'manage_options',
                'mighty-addons-home',
                [ __CLASS__, 'generate_homepage' ],
                $branding['hide_logo'] == "on" ? 'dashicons-admin-generic' : MIGHTY_ADDONS_PLG_URL.'assets/admin/images/mighty-logo.svg',
                99
            );

            add_submenu_page(
                'mighty-addons-home',
                __( 'Mighty Widgets', 'mighty-addons' ),
                __( 'Widgets', 'mighty-addons' ),
                'manage_options',
                'admin.php?page=mighty-addons-home#widgets'
            );

            add_submenu_page(
                'mighty-addons-home',
                __( 'Mighty Extension', 'mighty-addons' ),
                __( 'Extensions', 'mighty-addons' ),
                'manage_options',
                'admin.php?page=mighty-addons-home#extensions'
            );

            if ( $branding['hide_licencepage'] !== "on" ) :
                add_submenu_page(
                    'mighty-addons-home',
                    __( 'Mighty Pro', 'mighty-addons' ),
                    __( 'Go Pro 🔥', 'mighty-addons' ),
                    'manage_options',
                    'admin.php?page=mighty-addons-home#go-pro'
                );
            endif;

            add_submenu_page(
                'mighty-addons-home',
                __( 'Mighty Pro', 'mighty-addons' ),
                __( 'Integrations 🔨', 'mighty-addons' ),
                'manage_options',
                'admin.php?page=mighty-addons-home#integrations'
            );
        }

        public static function enqueue_scripts( $hook ) {
            
            if( strpos($hook, self::PLG_SLUG) !== false ) {
                // ⚠ Proceed with caution
            } else {
                return;
            }

            wp_enqueue_style(
                'mighty-icons',
                MIGHTY_ADDONS_PLG_URL . 'assets/css/mighty-icons.css',
                null,
                MIGHTY_ADDONS_VERSION
            );

            wp_enqueue_style(
                'mighty-styles',
                MIGHTY_ADDONS_PLG_URL . 'assets/admin/css/admin-styles.css',
                null,
                MIGHTY_ADDONS_VERSION
            );
            
            wp_enqueue_style(
                'mighty-font-roboto',
                'https://fonts.googleapis.com/css?family=Roboto:400,500,700,900&display=swap',
                null,
                MIGHTY_ADDONS_VERSION
            );
            

            wp_enqueue_script(
                'mighty-panel-js',
                MIGHTY_ADDONS_PLG_URL . 'assets/admin/js/admin-script.js',
                array('jquery'),
                MIGHTY_ADDONS_VERSION,
                true // in footer?
            );

            wp_localize_script(
                'mighty-panel-js',
                'MightyAddonsDashboard',
                [
                    'nonce' => wp_create_nonce( self::PLG_NONCE ),
                    'ajaxUrl' => admin_url( 'admin-ajax.php' ),
                ]
            );
        }

        private static function load_html( $page ) {
            $file = MIGHTY_ADDONS_DIR_PATH . 'panel/' . $page . '.php';
            if ( is_readable( $file ) ) {
                include( $file );
            }
        }

        public static function generate_homepage() {
            
            self::$ma_get_settings = self::get_enabled_addons();
            
            self::load_html( 'home' );

        }

        public static function get_enabled_addons() {

            self::$ma_default_settings = self::$mighty_addons; // Default values

            self::$ma_get_settings = get_option( 'mighty_addons_status', self::$mighty_addons );

            if
            (
                isset( self::$ma_get_settings['version'] ) &&
                self::$ma_get_settings['version'] == self::$ma_default_settings['version']
            ) {
                // do nothing
            } else {
                $ma_new_addons = self::$ma_default_settings;
            }

            if( ! empty ( $ma_new_addons ) ) {
                update_option( 'mighty_addons_status', $ma_new_addons );
            }

            return get_option( 'mighty_addons_status', self::$ma_default_settings );

        }

        public static function get_enabled_pro_addons() {

            return get_option( 'mighty_addons_pro_status' );

        }

        public static function mighty_addons_status() {
            
            check_ajax_referer( 'mighty_addons_panel', 'security' );
            
            if( isset( $_POST['fields'] ) ) {
                parse_str( $_POST['fields'], $settings );
            } else {
                return;
            }
            
            if( isset( $_POST['proFields'] ) ) {
                parse_str( $_POST['proFields'], $proSettings );
            } else {
                return;
            }

            $proAddons = self::get_enabled_pro_addons();
            $freeAddons = self::get_enabled_addons();

            // Free Addons
            foreach( $freeAddons['addons'] as $addon ) {
                $freeAddons['addons'][$addon['slug']]['enable'] = intval( $settings[ $addon['slug'] ] ? 1 : 0 );
            }
            
            // Free Extensions
            foreach( $freeAddons['extensions'] as $extension ) {
                $freeAddons['extensions'][$extension['slug']]['enable'] = intval( $settings[ $extension['slug'] ] ? 1 : 0 );
            }

            // Pro Addons
            foreach( $proAddons['addons'] as $addon ) {
                $proAddons['addons'][$addon['slug']]['enable'] = intval( $proSettings[ $addon['slug'] ] ? 1 : 0 );
            }

            // Pro Extensions
            foreach( $proAddons['extensions'] as $extension ) {
                $proAddons['extensions'][$extension['slug']]['enable'] = intval( $proSettings[ $extension['slug'] ] ? 1 : 0 );
            }
            
            update_option( 'mighty_addons_status', $freeAddons );
            
            update_option( 'mighty_addons_pro_status', $proAddons );
            
            return true;
        }

        public static function mighty_addons_integration() {

            check_ajax_referer( 'mighty_addons_panel', 'security' );

            if( isset( $_POST['fields'] ) ) {
                parse_str( $_POST['fields'], $settings );
            } else {
                return;
            }

            update_option( 'mighty_addons_integration', $settings );

            return true;
        }

        public static function plugin_settings( $plugins ) {
            
            $settings = HelperFunctions::get_white_label();
            $plugin = plugin_basename( MIGHTY_ADDONS_DIR_PATH . 'mighty-addons.php');

            if ( $plugins[ $plugin ] ) {

                $plugins[ $plugin ]['Name'] = $settings['plugin_name'];
                $plugins[ $plugin ]['Title'] = $settings['plugin_name'];
                $plugins[ $plugin ]['PluginURI'] = $settings['author_url'];
                $plugins[ $plugin ]['Description'] = $settings['plugin_description'];
                $plugins[ $plugin ]['Author'] = $settings['author'];
                $plugins[ $plugin ]['AuthorName'] = $settings['author'];
                $plugins[ $plugin ]['AuthorURI'] = $settings['author_url'];

            }

            return $plugins;
        }

    }
}

DashboardPanel::init();