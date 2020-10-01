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
    $mighty_addons_pro_list = [
        "addons" => [
            'openstreet' => [
                'title' => 'Open Street Map',
                'description' => '',
                'enable' => false,
                'class' => 'MT_Openstreet',
                'slug' => 'openstreet',
                'icon' => 'mf mf-openstreetmap',
                'stub' => 'true',
            ],
            'googlemaps' => [
                'title' => 'Google Maps',
                'description' => '',
                'enable' => false,
                'class' => 'MT_Googlemaps',
                'slug' => 'googlemaps',
                'icon' => 'mf mf-gmaps',
                'stub' => 'true',
            ],
            'twosteplogin' => [
                'title' => 'Two Step Login',
                'description' => '',
                'enable' => false,
                'class' => 'MT_TwoStepLogin',
                'slug' => 'twosteplogin',
                'icon' => 'mf mf-tsl',
                'stub' => 'true',
            ],
            'weather' => [
                'title' => 'Weather',
                'description' => '',
                'enable' => false,
                'class' => 'MT_Weather',
                'slug' => 'weather',
                'icon' => 'mf mf-weather',
                'stub' => 'true',
            ],
            'advanceheading' => [
                'title' => 'Advance Heading',
                'description' => '',
                'enable' => false,
                'class' => 'MT_AdvanceHeading',
                'slug' => 'advanceheading',
                'icon' => 'mf mf-advanceheading',
                'stub' => 'true',
            ],
            'paypalbutton' => [
                'title' => 'PayPal Button',
                'description' => '',
                'enable' => false,
                'class' => 'MT_PaypalButton',
                'slug' => 'paypalbutton',
                'icon' => 'mf mf-paypal',
                'stub' => 'true',
            ],
            'instagallery' => [
                'title' => 'Insta Gallery',
                'description' => '',
                'enable' => false,
                'class' => 'MT_InstaGallery',
                'slug' => 'instagallery',
                'icon' => 'mf mf-instagallery',
                'stub' => 'true',
            ],
            'pricelist' => [
                'title' => 'Price List',
                'description' => '',
                'enable' => false,
                'class' => 'MT_PriceList',
                'slug' => 'pricelist',
                'icon' => 'mf mf-pricelist',
                'stub' => 'true',
            ],
            'clicktocall' => [
                'title' => 'Click To Call',
                'description' => '',
                'enable' => false,
                'class' => 'MT_ClickToCall',
                'slug' => 'clicktocall',
                'icon' => 'mf mf-clicktocall',
                'stub' => 'true',
            ],
            'hotspot' => [
                'title' => 'Hotspot',
                'description' => '',
                'enable' => false,
                'class' => 'MT_Hotspot',
                'slug' => 'hotspot',
                'icon' => 'mf mf-hotspot',
                'stub' => 'true',
            ],
            'opentable' => [
                'title' => 'Open Table',
                'description' => '',
                'enable' => false,
                'class' => 'MT_Opentable',
                'slug' => 'opentable',
                'icon' => 'mf mf-opentable',
                'stub' => 'true',
            ],
            'contenttoggle' => [
                'title' => 'Content Toggle',
                'description' => '',
                'enable' => false,
                'class' => 'MT_Contenttoggle',
                'slug' => 'contenttoggle',
                'icon' => 'mf mf-contenttoggle',
                'stub' => 'true',
            ],
            'whatsappchat' => [
                'title' => 'WhatsApp Chat',
                'description' => '',
                'enable' => false,
                'class' => 'MT_WhatsappChat',
                'slug' => 'whatsappchat',
                'icon' => 'mf mf-whatsappchat',
                'stub' => 'true',
            ],
            'timeline' => [
                'title' => 'Timeline',
                'description' => '',
                'enable' => false,
                'class' => 'MT_Timeline',
                'slug' => 'timeline',
                'icon' => 'mf mf-timeline',
                'stub' => 'true',
            ],
        ],
        "extensions" => [
            'particles' => [
                'title' => 'Particles',
                'description' => 'Quick pictures insert, integrated with Pixabay.',
                'enable' => false,
                'class' => 'MT_Particles',
                'slug' => 'particles',
                'icon' => 'mf mf-particles',
                'stub' => 'true',
                'include' => true // File Include?
            ],
            'unsplash' => [
                'title' => 'Unsplash',
                'description' => 'Quick pictures insert, integrated with Unsplash.',
                'enable' => false,
                'class' => 'MT_Unsplash',
                'slug' => 'unsplash',
                'icon' => 'mf mf-unsplash',
                'stub' => 'true',
                'include' => false // File include?
            ],
            'xscps' => [
                'title' => 'Cross-Site Copy Paste Style',
                'description' => 'Quickly Copy/Paste Styles of Widgets/Sections/Page across multiple domains.',
                'enable' => false,
                'class' => 'MT_Copypastestyle',
                'slug' => 'xscps',
                'icon' => 'mf mf-xscps',
                'stub' => 'true',
                'include' => false // File include?
            ],
            
            'display-conditions' => [
                'title' => 'Display Conditions',
                'description' => 'Show elementor elements based on Conditional Rules.',
                'enable' => true,
                'class' => 'MT_DisplayConditions',
                'slug' => 'displayconditions',
                'icon' => 'mf mf-displayconditions',
                'stub' => 'true',
                'include' => true // File Include?
            ],
        ]
    ];
    $pro_widgets = $mighty_addons_pro_list['addons'];
    $pro_extensions = $mighty_addons_pro_list['extensions'];
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