<?php
/**
 * Mighty Addons
 * Integrations
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<!-- Extensions -->
<div id="integrations" class="ma-tabs-content">
    <div class="ma-row">
        <div class="ma-col-full">
            
            <form id="mighty-integration-settings" action="" method="POST" name="mighty-integration-settings">
                <div class="ma-element-container">
                    <label for="gmaps" class="ma-ele-title">Google Maps Key</label>
                    <input type="text" name="gmaps-api-key" id="gmaps">
                </div>

                <div class="text-center ma-cta-save">
                    <button type="submit" class="button ma-btn js-ma-settings-save ma-btn ma-save-button"><?php echo __('Save Settings', 'mighty-addons'); ?></button>
                </div>
            </form>
            
        </div>
    </div>
</div>