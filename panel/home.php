<?php
/**
 * Mighty Addons
 */
use \MightyAddons\Classes\HelperFunctions as Helper;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// All the Awesomeness
$widgets = self::$ma_get_settings['addons'];
$extensions = self::$ma_get_settings['extensions'];

$allPlugins = Helper::get_all_plugins();

if ( in_array( 'Mighty-Addons-Pro/mighty-addons-pro.php', $allPlugins['active'], true ) || in_array( 'mighty-addons-pro/mighty-addons-pro.php', $allPlugins['active'], true )) {
    $pro_widgets = self::get_enabled_pro_addons()['addons'];
    $pro_extensions = self::get_enabled_pro_addons()['extensions'];
    $mighty_addons_pro_active = true;
} else {
    $pro_widgets = Helper::$mighty_addons_pro_stub['addons'];
    $pro_extensions = Helper::$mighty_addons_pro_stub['extensions'];
    $mighty_addons_pro_active = false;
}

$branding = Helper::get_white_label();

include_once('includes/header.php');

if ( $branding['hide_logo'] !== "on" ) :
    include_once('includes/boring-stuff.php');
endif;

include_once('includes/widget-settings.php');

include_once('includes/extension-settings.php');

if( Helper::mightyProAvailable() ) {
    if ( $branding['hide_licencepage'] !== "on" ) :
        include_once(MIGHTY_ADDONS_PRO_DIR_PATH . 'pages/go-pro.php');
    endif;
    include_once(MIGHTY_ADDONS_PRO_DIR_PATH . 'pages/white-label.php');
} else {
    if ( $branding['hide_licencepage'] !== "on" ) :
        include_once('includes/go-pro.php');
    endif;
}

include_once('includes/integrations.php');

include_once('includes/footer.php');
?>