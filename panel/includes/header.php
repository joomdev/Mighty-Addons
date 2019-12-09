<?php
/**
 * Mighty Addons
 * Home Sweet Home
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<div id="mtbody-content">
    <!-- MT Settings Wrap -->
    <div class="ma-settings-wrap">
        <!-- MT Settings Header -->
        <div class="ma-settings-header-bar">
            <!-- MT Settings Header Left -->
            <div class="ma-settings-header-left">
                <div class="ma-logo">
                    <img src="https://mightythemes.com/wp-content/uploads/2019/05/logo-Blue-Sticky-1.png" alt="MightyThemes-addons">
                </div>
                <h2 class="title">Mighty Addons Settings</h2>
            </div>
            <?php if ( $page == "widgets") : ?>
            <div class="ma-settings-header-right">
                <button type="submit" class="button ma-btn js-ma-settings-save">Save settings</button>
            </div>
            <?php endif; ?>
        </div>


        <div class="ma-settings-tabs">
        
            <?php include_once('tabs.php'); ?>