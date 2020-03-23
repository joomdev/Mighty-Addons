<?php

namespace MightyAddons\Classes;

if ( ! defined( 'ABSPATH' ) ) exit;

class HelperFunctions {

    public static $mighty_addons = [
        "version" => MIGHTY_ADDONS_VERSION,
        "addons" => [
            'testimonial' => [
                'title' => 'MT Testimonial',
                'description' => '',
                'enable' => true,
                'class' => 'MT_Testimonial',
                'slug' => 'testimonial',
                'icon' => 'mf mf-testimonial'
            ],
            'team' => [
                'title' => 'MT Team',
                'description' => '',
                'enable' => true,
                'class' => 'MT_Team',
                'slug' => 'team',
                'icon' => 'mf mf-team'
            ],
            'progressbar' => [
                'title' => 'MT Progress Bar',
                'description' => '',
                'enable' => true,
                'class' => 'MT_Progressbar',
                'slug' => 'progressbar',
                'icon' => 'mf mf-progressbar'
            ],
            'counter' => [
                'title' => 'MT Counter',
                'description' => '',
                'enable' => true,
                'class' => 'MT_Counter',
                'slug' => 'counter',
                'icon' => 'mf mf-counter'
            ],
            'buttongroup' => [
                'title' => 'MT Button Group',
                'description' => '',
                'enable' => true,
                'class' => 'MT_Buttongroup',
                'slug' => 'buttongroup',
                'icon' => 'mf mf-button'
            ],
            'accordion' => [
                'title' => 'MT Accordion',
                'description' => '',
                'enable' => true,
                'class' => 'MT_Accordion',
                'slug' => 'accordion',
                'icon' => 'mf mf-accordion'
            ],
            'beforeafter' => [
                'title' => 'MT Before After',
                'description' => '',
                'enable' => true,
                'class' => 'MT_Beforeafter',
                'slug' => 'beforeafter',
                'icon' => 'mf mf-beforeafter'
            ],
            'gradientheading' => [
                'title' => 'MT Gradient Heading',
                'description' => '',
                'enable' => true,
                'class' => 'MT_Gradientheading',
                'slug' => 'gradientheading',
                'icon' => 'mf mf-heading'
            ],
            'flipbox' => [
                'title' => 'MT Flip Box',
                'description' => '',
                'enable' => true,
                'class' => 'MT_Flipbox',
                'slug' => 'flipbox',
                'icon' => 'mf mf-flipbox'
            ],
            'openinghours' => [
                'title' => 'MT Opening Hours',
                'description' => '',
                'enable' => true,
                'class' => 'MT_Openinghours',
                'slug' => 'openinghours',
                'icon' => 'mf mf-openinghours'
            ],
            'contactform7' => [
                'title' => 'MT Contact Form 7',
                'description' => '',
                'enable' => true,
                'class' => 'MT_ContactForm7',
                'slug' => 'contactform7',
                'icon' => 'mf mf-contactform7'
            ],
        ],

        "extensions" => [
            'pixabay' => [
                'title' => 'Pixabay',
                'description' => 'Quick pictures insert, integrated with Pixabay.',
                'enable' => true,
                'class' => 'MT_Photos',
                'slug' => 'pixabay',
                'icon' => 'mf mf-pixabay-icon'
            ]
        ]
    ];

    public static function mighty_addons() {
        $widgets = get_option( 'mighty_addons_status', self::$mighty_addons );
        
        return $widgets;
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

        return $key;
    }
}