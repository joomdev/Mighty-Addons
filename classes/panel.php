<?php
/**
 * Dashboard
 *
 * Package: mighty-addonsAddons
 * @since 1.1.0
 */
namespace MightyAddons\Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class DashboardPanel {

    const PLG_SLUG = 'mighty-addons';

    const PLG_NONCE = 'mighty_addons_panel';

    static $menu_slug = '';

    public static function init() {
        add_action( 'admin_menu', [ __CLASS__, 'add_menu' ] );

    }

    public static function add_menu() {
        self::$menu_slug = add_menu_page(
            __( 'MightyAddons Dashboard', 'mighty-addons' ),
            __( 'Mighty Addons', 'mighty-addons' ),
            'manage_options',
            self::PLG_SLUG,
            [ __CLASS__, 'generate_homepage' ],
            'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjwhRE9DVFlQRSBzdmcgIFBVQkxJQyAnLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4nICAnaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkJz48c3ZnIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDI0IDI0IiBoZWlnaHQ9IjI0cHgiIGlkPSJMYXllcl8xIiB2ZXJzaW9uPSIxLjEiIHZpZXdCb3g9IjAgMCAyNCAyNCIgd2lkdGg9IjI0cHgiIHhtbDpzcGFjZT0icHJlc2VydmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPjxwYXRoIGQ9Ik0yMywxOS45TDIzLDE5LjlsMC0yYzAtMC4zLTAuMi0wLjUtMC41LTAuNWgtMC44Yy0wLjEsMC0wLjMtMC4yLTAuMy0wLjJsMC0xMC40YzAtMC4xLDAuMi0wLjMsMC4zLTAuM2gwLjggIGMwLjMsMCwwLjUtMC4yLDAuNS0wLjVWMy42YzAtMC4zLTAuMi0wLjUtMC41LTAuNWgtNy45Yy0wLjIsMC0wLjQsMC4xLTAuNSwwLjRsLTIuMiw4LjFMOS44LDMuNUM5LjcsMy4zLDkuNSwzLjEsOS4zLDMuMUgxLjMgIGMtMC4zLDAtMC41LDAuMi0wLjUsMC41djIuNWMwLDAuMywwLjIsMC41LDAuNSwwLjVsMC44LDBjMC4xLDAsMC4zLDAuMiwwLjMsMC4zbDAsMTAuNGMwLDAuMS0wLjIsMC4yLTAuMywwLjJIMS4zICBjLTAuMywwLTAuNSwwLjItMC41LDAuNXYyYy0wLjIsMC4xLTAuNCwwLjItMC40LDAuNWMwLDAuMywwLjIsMC41LDAuNSwwLjVoMC40SDRoMy43YzAuMywwLDAuNS0wLjIsMC41LTAuNXYtMi41ICBjMC0wLjMtMC4yLTAuNS0wLjUtMC41SDYuNnYtNy4ybDIuOCwxMC4zYzAuMSwwLjIsMC4yLDAuNCwwLjUsMC40aDIuOWMwLjIsMCwwLjQtMC4xLDAuNS0wLjRMMTYsMTAuMnY3LjJoLTEuMSAgYy0wLjMsMC0wLjUsMC4yLTAuNSwwLjV2Mi41YzAsMC4zLDAuMiwwLjUsMC41LDAuNWg1aDIuNkgyM2MwLjMsMCwwLjUtMC4yLDAuNS0wLjVDMjMuNSwyMC4xLDIzLjMsMTkuOSwyMywxOS45eiIvPjwvc3ZnPg==',
            99
        );
    }

    private static function load_html( $page ) {
        $file = MIGHTY_ADDONS_PLG_URL . 'panel/' . $page . '.php';
        if ( is_readable( $file ) ) {
            include( $file );
        }
    }

    public static function generate_homepage() {
        self::load_html( 'widget-settings' );
    }
}

DashboardPanel::init();