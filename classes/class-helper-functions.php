<?php

namespace MightyAddons\Classes;

if ( ! defined( 'ABSPATH' ) ) exit;

class HelperFunctions {

    public static function mighty_addons() {
        $widgets = [
            'testimonial' => [
                'title' => esc_html__( 'MT Testimonial', 'mighty-addons' ),
                'description' => '',
                'enable' => true,
                'class' => 'MT_Testimonial',
                'slug' => 'testimonial',
                'icon' => 'mf mf-testimonial'
            ],
            'team' => [
                'title' => esc_html__( 'MT Team', 'mighty-addons' ),
                'description' => '',
                'enable' => true,
                'class' => 'MT_Team',
                'slug' => 'team',
                'icon' => 'mf mf-team'
            ],
            'progressbar' => [
                'title' => esc_html__( 'MT Progressbar', 'mighty-addons' ),
                'description' => '',
                'enable' => true,
                'class' => 'MT_Progressbar',
                'slug' => 'progressbar',
                'icon' => 'mf mf-progressbar'
            ],
            'counter' => [
                'title' => esc_html__( 'MT Counter', 'mighty-addons' ),
                'description' => '',
                'enable' => true,
                'class' => 'MT_Counter',
                'slug' => 'counter',
                'icon' => 'mf mf-counter'
            ],
            'buttongroup' => [
                'title' => esc_html__( 'MT Button Group', 'mighty-addons' ),
                'description' => '',
                'enable' => true,
                'class' => 'MT_Buttongroup',
                'slug' => 'buttongroup',
                'icon' => 'mf mf-button'
            ],
            'accordion' => [
                'title' => esc_html__( 'MT Accordion', 'mighty-addons' ),
                'description' => '',
                'enable' => true,
                'class' => 'MT_Accordion',
                'slug' => 'accordion',
                'icon' => 'mf mf-accordion'
            ],
            'beforeafter' => [
                'title' => esc_html__( 'MT Before After', 'mighty-addons' ),
                'description' => '',
                'enable' => true,
                'class' => 'MT_Beforeafter',
                'slug' => 'beforeafter',
                'icon' => 'mf mf-beforeafter'
            ],
            'gradientheading' => [
                'title' => esc_html__( 'MT Gradient Heading', 'mighty-addons' ),
                'description' => '',
                'enable' => true,
                'class' => 'MT_Gradientheading',
                'slug' => 'gradientheading',
                'icon' => 'mf mf-heading'
            ],
            'flipbox' => [
                'title' => esc_html__( 'MT FlipBox', 'mighty-addons' ),
                'description' => '',
                'enable' => true,
                'class' => 'MT_Flipbox',
                'slug' => 'flipbox',
                'icon' => 'mf mf-flipbox'
            ],
            'openinghours' => [
                'title' => esc_html__( 'MT Opening Hours', 'mighty-addons' ),
                'description' => '',
                'enable' => true,
                'class' => 'MT_Openinghours',
                'slug' => 'openinghours',
                'icon' => 'mf mf-openinghours'
            ],
        ];

        return $widgets;
    }
    
}
