<?php

namespace MightyAddons\Classes;

if ( ! defined( 'ABSPATH' ) ) exit;

class HelperFunctions {

    public static function mighty_addons() {

        $widgets = get_option( 'mighty_addons_status' );
        
        if ( empty($widgets) ) {
            $widgets = [

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
            ];
        }
        
        return $widgets;
    }
    
}
