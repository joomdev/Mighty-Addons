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
                'slug' => 'testimonial'
            ],
            'team' => [
                'title' => esc_html__( 'MT Team', 'mighty-addons' ),
                'description' => '',
                'enable' => true,
                'class' => 'MT_Team',
                'slug' => 'team'
            ],
            'progressbar' => [
                'title' => esc_html__( 'MT Progressbar', 'mighty-addons' ),
                'description' => '',
                'enable' => true,
                'class' => 'MT_Progressbar',
                'slug' => 'progressbar'
            ],
            'counter' => [
                'title' => esc_html__( 'MT Counter', 'mighty-addons' ),
                'description' => '',
                'enable' => true,
                'class' => 'MT_Counter',
                'slug' => 'counter'
            ],
            'buttongroup' => [
                'title' => esc_html__( 'MT Button Group', 'mighty-addons' ),
                'description' => '',
                'enable' => true,
                'class' => 'MT_Buttongroup',
                'slug' => 'buttongroup'
            ],
            'accordion' => [
                'title' => esc_html__( 'MT Accordion', 'mighty-addons' ),
                'description' => '',
                'enable' => true,
                'class' => 'MT_Accordion',
                'slug' => 'accordion'
            ],
            'beforeafter' => [
                'title' => esc_html__( 'MT Before After', 'mighty-addons' ),
                'description' => '',
                'enable' => true,
                'class' => 'MT_Beforeafter',
                'slug' => 'beforeafter'
            ],
            'gradientheading' => [
                'title' => esc_html__( 'MT Gradient Heading', 'mighty-addons' ),
                'description' => '',
                'enable' => true,
                'class' => 'MT_Gradientheading',
                'slug' => 'gradientheading'
            ],
            'flipbox' => [
                'title' => esc_html__( 'MT FlipBox', 'mighty-addons' ),
                'description' => '',
                'enable' => true,
                'class' => 'MT_Flipbox',
                'slug' => 'flipbox'
            ],
            'openinghours' => [
                'title' => esc_html__( 'MT Opening Hours', 'mighty-addons' ),
                'description' => '',
                'enable' => true,
                'class' => 'MT_Openinghours',
                'slug' => 'openinghours'
            ],
        ];

        return $widgets;
    }
    
}
