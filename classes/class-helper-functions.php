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
        $active_plugins                   = array_merge( $active_plugins, array_keys( $active_sitewide_plugins ) );
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