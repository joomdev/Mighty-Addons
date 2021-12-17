<?php

namespace MightyAddons\Classes;

if ( ! defined( 'ABSPATH' ) ) exit;

class HelperFunctions {

    public static $mighty_addons = [
        "version" => MIGHTY_ADDONS_VERSION,
        "addons" => [
            'testimonial' => [
                'title' => 'Testimonial',
                'description' => '',
                'enable' => true,
                'class' => 'MT_Testimonial',
                'slug' => 'testimonial',
                'icon' => 'mf mf-testimonial'
            ],
            'team' => [
                'title' => 'Team',
                'description' => '',
                'enable' => true,
                'class' => 'MT_Team',
                'slug' => 'team',
                'icon' => 'mf mf-team'
            ],
            'progressbar' => [
                'title' => 'Progress Bar',
                'description' => '',
                'enable' => true,
                'class' => 'MT_Progressbar',
                'slug' => 'progressbar',
                'icon' => 'mf mf-progressbar'
            ],
            'counter' => [
                'title' => 'Counter',
                'description' => '',
                'enable' => true,
                'class' => 'MT_Counter',
                'slug' => 'counter',
                'icon' => 'mf mf-counter'
            ],
            'buttongroup' => [
                'title' => 'Button Group',
                'description' => '',
                'enable' => true,
                'class' => 'MT_Buttongroup',
                'slug' => 'buttongroup',
                'icon' => 'mf mf-button'
            ],
            'accordion' => [
                'title' => 'Accordion',
                'description' => '',
                'enable' => true,
                'class' => 'MT_Accordion',
                'slug' => 'accordion',
                'icon' => 'mf mf-accordion'
            ],
            'beforeafter' => [
                'title' => 'Before After',
                'description' => '',
                'enable' => true,
                'class' => 'MT_Beforeafter',
                'slug' => 'beforeafter',
                'icon' => 'mf mf-beforeafter'
            ],
            'gradientheading' => [
                'title' => 'Gradient Heading',
                'description' => '',
                'enable' => true,
                'class' => 'MT_Gradientheading',
                'slug' => 'gradientheading',
                'icon' => 'mf mf-heading'
            ],
            'flipbox' => [
                'title' => 'Flip Box',
                'description' => '',
                'enable' => true,
                'class' => 'MT_Flipbox',
                'slug' => 'flipbox',
                'icon' => 'mf mf-flipbox'
            ],
            'openinghours' => [
                'title' => 'Opening Hours',
                'description' => '',
                'enable' => true,
                'class' => 'MT_Openinghours',
                'slug' => 'openinghours',
                'icon' => 'mf mf-openinghours'
            ],
            'contactform7' => [
                'title' => 'Contact Form 7',
                'description' => '',
                'enable' => true,
                'class' => 'MT_ContactForm7',
                'slug' => 'contactform7',
                'icon' => 'mf mf-contactform7'
            ],
            'mailchimp' => [
                'title' => 'Mailchimp',
                'description' => '',
                'enable' => true,
                'class' => 'MT_Mailchimp',
                'slug' => 'mailchimp',
                'icon' => 'mf mf-mailchimp'
            ],
            'linkeffects' => [
                'title' => 'Link Effects',
                'description' => '',
                'enable' => true,
                'class' => 'MT_LinkEffects',
                'slug' => 'linkeffects',
                'icon' => 'mf mf-linkeffects'
            ],
            'textmarquee' => [
                'title' => 'Text Marquee',
                'description' => '',
                'enable' => false,
                'class' => 'MT_textmarquee',
                'slug' => 'textmarquee',
                'icon' => 'mf mf-textmarquee'
            ],
            'piedonutchart' => [
                'title' => 'Donut and Pie Chart ',
                'description' => '',
                'enable' => false,
                'class' => 'MT_piedonutchart',
                'slug' => 'piedonutchart',
                'icon' => 'mf mf-piedonutchart'
            ],
            'agechecker' => [
                'title' => 'Age Checker',
                'description' => '',
                'enable' => false,
                'class' => 'MT_agechecker',
                'slug' => 'agechecker',
                'icon' => 'mf mf-agechecker'
            ],
            'howto' => [
                'title' => 'How To',
                'description' => '',
                'enable' => false,
                'class' => 'MT_howto',
                'slug' => 'howto',
                'icon' => 'mf mf-howto',
                // 'group' => 'howto',
            ]
        ],
        "extensions" => [
            'pixabay' => [
                'title' => 'Pixabay',
                'description' => 'Quick pictures insert, integrated with Pixabay.',
                'enable' => true,
                'class' => 'MT_Photos',
                'slug' => 'pixabay',
                'icon' => 'mf mf-pixabay',
                'include' => false // File include?
            ],
            'xscp' => [
                'title' => 'Cross-Site Copy Paste',
                'description' => 'Quickly Copy/Paste Widgets/Sections/Page across multiple domains.',
                'enable' => true,
                'class' => 'MT_Copypaste',
                'slug' => 'xscp',
                'icon' => 'mf mf-copypaste',
                'include' => false // File include?
            ],
            'customcss' => [
                'title' => 'Custom CSS',
                'description' => '',
                'enable' => true,
                'class' => 'MT_Customcss',
                'slug' => 'customcss',
                'icon' => 'mf mf-customcss',
                'include' => true // File include?
            ],
            'wrapperlink' => [
                'title' => 'Wrapper Link',
                'description' => 'Wrap any section, column or widget in a link.',
                'enable' => true,
                'class' => 'MT_WrapperLink',
                'slug' => 'wrapperlink',
                'icon' => 'mf mf-wrapperlink',
                'include' => true // File Include?
            ],
            'readingprogressbar' => [
                'title' => 'Reading Progress Bar',
                'description' => '',
                'enable' => true,
                'class' => 'MT_ReadingProgressBar',
                'slug' => 'readingprogressbar',
                'icon' => 'mf mf-readingprogressbar',
                'include' => true // File Include?
            ],
        ]
    ];

    public static $mighty_addons_pro_stub = [
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
            'wooslider' => [
                'title' => 'Woo Slider',
                'description' => '',
                'enable' => false,
                'class' => 'MT_WooSlider',
                'slug' => 'wooslider',
                'icon' => 'mf mf-wooslider',
                'dependency' => 'WooCommerce',
                'stub' => 'true',
            ],
            'wooaddtocart' => [
                'title' => 'Woo Add to Cart',
                'description' => '',
                'enable' => false,
                'class' => 'MT_AddToCart',
                'slug' => 'wooaddtocart',
                'icon' => 'mf mf-wooaddtocart',
                'dependency' => 'WooCommerce',
                'stub' => 'true',
            ],
            'wooproductsgrid' => [
                'title' => 'Woo Products Grid',
                'description' => '',
                'enable' => false,
                'class' => 'MT_ProductsGrid',
                'slug' => 'wooproductsgrid',
                'icon' => 'mf mf-wooproductsgrid',
                'dependency' => 'WooCommerce',
                'stub' => 'true',
            ],
            'chart' => [
                'title' => 'Chart',
                'description' => '',
                'enable' => false,
                'class' => 'MT_Chart',
                'slug' => 'chart',
                'icon' => 'mf mf-chart',
                'stub' => 'true',
            ],
            'modal' => [
                'title' => 'Modal',
                'description' => '',
                'enable' => false,
                'class' => 'MT_Modal',
                'slug' => 'modal',
                'icon' => 'mf mf-modal',
                'stub' => 'true',
            ]
        ],
        "extensions" => [
            'particles' => [
                'title' => 'MA Particles',
                'description' => 'Add Animated Particles Moving Around Using the Particles Background feature.',
                'enable' => false,
                'class' => 'MT_Particles',
                'slug' => 'particles',
                'icon' => 'mf mf-particles',
                'stub' => 'true',
                'sidebar' => 'true',
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
            'displayconditions' => [
                'title' => 'Display Conditions',
                'description' => 'Restrict any section or element to any specific type of audience that meets the specified rules.',
                'enable' => false,
                'class' => 'MT_DisplayConditions',
                'slug' => 'displayconditions',
                'icon' => 'mf mf-displayconditions',
                'stub' => 'true',
                'sidebar' => 'true',
                'include' => true // File Include?
            ],
            'advanceshadow' => [
                'title' => 'Advance Shadow',
                'description' => 'Advance Shadow helps to you add multiple-layered shadow to any element or section.',
                'enable' => false,
                'class' => 'MT_AdvanceShadow',
                'slug' => 'advanceshadow',
                'icon' => 'mf mf-advanceshadow',
                'stub' => 'true',
                'sidebar' => 'true',
                'include' => true // File Include?
            ],
            'advancegradients' => [
                'title' => 'Advance Gradients',
                'description' => 'Apply Advance Gradients to Elements.',
                'enable' => false,
                'class' => 'MT_AdvanceGradients',
                'slug' => 'advancegradients',
                'icon' => 'mf mf-advancegradients',
                'stub' => 'true',
                'sidebar' => 'true',
                'include' => true // File Include?
            ],
            'spacer' => [
                'title' => 'Spacers',
                'description' => 'Apply quick padding & margin to the elements.',
                'enable' => false,
                'class' => 'MT_Spacer',
                'slug' => 'spacer',
                'icon' => 'mf mf-spacer',
                'stub' => 'true',
                'include' => true // File Include?
            ],
            'sectionslider' => [
                'title' => 'Section Slider',
                'description' => '',
                'enable' => false,
                'class' => 'MT_SectionSlider',
                'slug' => 'sectionslider',
                'icon' => 'mf mf-sectionslider',
                'stub' => 'true',
                'include' => true // File Include?
            ],
            'backdropfilter' => [
                'title' => 'Backdrop Filters',
                'description' => 'Apply Backdrop Filter to Elements.',
                'enable' => false,
                'class' => 'MT_BackdropFilter',
                'slug' => 'backdropfilter',
                'icon' => 'mf mf-backdropfilter',
                'stub' => 'true',
                'include' => true // File Include?
            ],
            'filtereffects' => [
                'title' => 'CSS Filters',
                'description' => 'Apply Filter Effects to Elements.',
                'enable' => false,
                'class' => 'MT_FilterEffects',
                'slug' => 'filtereffects',
                'icon' => 'mf mf-filtereffects',
                'stub' => 'true',
                'include' => true // File Include?
            ]
        ]
    ];

    public static function mighty_addons() {
        $widgets = get_option( 'mighty_addons_status', self::$mighty_addons );
        
        return $widgets;
    }

    public static function mighty_addons_pro() {

        return get_option( 'mighty_addons_pro_status' );

    }

    public static function cf7FormsList() {
        $cf7forms = get_posts( [
            'post_type'      => 'wpcf7_contact_form',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'orderby'        => 'title',
            'order'          => 'ASC',
        ] );

        if ( ! empty( $cf7forms ) ) {
            return wp_list_pluck( $cf7forms, 'post_title', 'ID' );
        }
        return [ esc_html__( 'No contact form found!', 'mighty' ) ];
    }

    public static function get_all_plugins() {
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
        $active_plugins = array_merge( $active_plugins, array_keys( $active_sitewide_plugins ) );
        $activated_plugins['active'] = $active_plugins;
        $activated_plugins['all']    = get_plugins();

        return $activated_plugins;
    }
    
    public static function getProKey() {

        $key = get_option('mighty_addons_pro_key', '');
        
        if ( $key ) {
            return $key;
        } else {
            return null;
        }
        
    }

    public static function get_integration_option( $option ) {
        return get_option('mighty_addons_integration')[$option] ?? '';
    }

    public static function mightyProAvailable() {
        if( is_plugin_active( 'Mighty-Addons-Pro/mighty-addons-pro.php' ) || is_plugin_active( 'mighty-addons-pro/mighty-addons-pro.php' )) {
            return true;
        } else {
            return false;
        }
    }

    public static function get_white_label( $option = "all" ) {

        $settings = get_option( 'mighty_addons_white_label' );

        $defaults = [
            'author'                    => 'MightyThemes',
            'author_url'                => 'https://mightythemes.com',
            'plugin_name'               => 'Mighty Addons',
            'plugin_short_name'         => 'MA',
            'plugin_description'        => 'Mighty Addons is a Powerful Elementor Widget Plugin that comes with advanced & flexible features powering up your Elementor website and increasing your designing experience.',
            'pro_plugin_name'           => 'Mighty Addons Pro',
            'pro_plugin_short_name'     => 'MAP',
            'pro_plugin_description'    => 'Mighty Addons Pro is a Powerful Elementor Widget Pro Plugin that gives you power to do more.',
            'hide_option'               => 'off',
            'hide_logo'                 => 'off',
            'hide_templatelibrary'      => 'off',
            'hide_licencepage'          => 'off',
        ];

        $ma_settings = [
            'author'                    => ( isset ( $settings['author'] ) ) && "" !== $settings['author'] ? $settings['author'] : $defaults['author'],
            'author_url'                => ( isset ( $settings['author_url'] ) ) && "" !== $settings['author_url'] ? $settings['author_url'] :  $defaults['author_url'],
            'plugin_name'               => ( isset ( $settings['plugin_name'] ) ) && "" !== $settings['plugin_name'] ? $settings['plugin_name'] : $defaults['plugin_name'],
            'plugin_short_name'         => ( isset ( $settings['plugin_short_name'] ) ) && "" !== $settings['plugin_short_name'] ? $settings['plugin_short_name'] : $defaults['plugin_short_name'],
            'plugin_description'        => ( isset ( $settings['plugin_description'] ) ) && "" !== $settings['plugin_description'] ? $settings['plugin_description'] :  $defaults['plugin_description'],
            'pro_plugin_name'           => ( isset ( $settings['pro_plugin_name'] ) ) && "" !== $settings['pro_plugin_name'] ? $settings['pro_plugin_name'] : $defaults['pro_plugin_name'],
            'pro_plugin_short_name'     => ( isset ( $settings['pro_plugin_short_name'] ) ) && "" !== $settings['pro_plugin_short_name'] ? $settings['pro_plugin_short_name'] : $defaults['pro_plugin_short_name'],
            'pro_plugin_description'    => ( isset ( $settings['pro_plugin_description'] ) ) && "" !== $settings['pro_plugin_description'] ? $settings['pro_plugin_description'] : $defaults['pro_plugin_description'],
            'hide_option'               => ( isset ( $settings['hide_option'] ) ) && "on" == $settings['hide_option'] ? $settings['hide_option'] : $defaults['hide_option'],
            'hide_logo'                 => ( isset ( $settings['hide_logo'] ) ) && "on" == $settings['hide_logo'] ? $settings['hide_logo'] : $defaults['hide_logo'],
            'hide_templatelibrary'      => ( isset ( $settings['hide_templatelibrary'] ) ) && "on" == $settings['hide_templatelibrary'] ? $settings['hide_templatelibrary'] : $defaults['hide_templatelibrary'],
            'hide_licencepage'          => ( isset ( $settings['hide_licencepage'] ) ) && "on" == $settings['hide_licencepage'] ? $settings['hide_licencepage'] : $defaults['hide_licencepage'],
        ];

        if ( "defaults" == $option ) {
            return $defaults;
        }

        if ( "all" == $option ) {
            return $ma_settings;
        }
        
        return $ma_settings[$option];

    }

    public static function mailchimpLists() {

        $mailchimpKey = self::get_integration_option('mailchimp-key');
        $region = substr( $mailchimpKey, strpos( $mailchimpKey, '-') + 1 );

        if ( $mailchimpKey ) {
            $lists = wp_remote_get("https://$region.api.mailchimp.com/3.0/lists?apikey=$mailchimpKey");

            if( is_wp_error( $lists ) ) {
                return false; // Bail out
            }
            
            $lists = json_decode( wp_remote_retrieve_body( $lists ), true )[ 'lists' ];
            
            if ( ! empty( $lists ) ) {
                return wp_list_pluck( $lists, 'name', 'id' );
            }
            return [ esc_html__( 'No List Found!', 'mighty' ) ];
        }

        return [ esc_html__( 'No Mailchimp Key Found!', 'mighty' ) ];

    }
}