<?php

namespace MightyAddons\Classes;

if ( ! defined( 'ABSPATH' ) ) exit;

class HelperFunctions {

    public static function mighty_addons() {

        $widgets = get_option( 'mighty_addons_status' );

        return $widgets;
    }
    
}
