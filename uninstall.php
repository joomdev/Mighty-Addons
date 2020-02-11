<?php

if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

$option_name = 'mighty_addons_status';
delete_option($option_name);
?>