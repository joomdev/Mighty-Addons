<?php
/**
 * Mighty Addons
 * Integrations
 */

use MightyAddons\Classes\HelperFunctions as Helper;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<!-- Extensions -->
<div id="integrations" class="ma-tabs-content">
    <div class="ma-row">
        <div class="ma-col-full">
            
            <form id="mighty-integration-settings" action="" method="POST" name="mighty-integration-settings">
                <div class="ma-element ">
                    <label for="gmaps" class="ma-ele-title"><?php _e('🌏 Google Maps Key', 'mighty-addons'); ?></label>
                    <div class="info-field">
                        <input type="text" name="gmaps-api-key" placeholder="YOUR_API_KEY" id="gmaps" value="<?php echo Helper::get_integration_option('gmaps-api-key'); ?>" />
                        <a class="help-link" target="_blank" href="https://developers.google.com/maps/documentation/javascript/get-api-key"><?php _e('Get Google Maps API key 🔑', 'mighty-addons'); ?></a>
                    </div>                    
                </div>

                <div class="ma-element ma-element-free">
                    <label for="white-label" class="ma-ele-title"><?php _e('📃 White Label', 'mighty-addons'); ?></label>
                    <a href="#white-label" class="button ma-btn"><?php _e('Configure', 'mighty-addons'); ?></a>
                </div>

                <div class="text-center ma-cta-save">
                    <button type="submit" class="button ma-btn js-ma-settings-save ma-btn ma-save-button"><?php _e('Save Settings', 'mighty-addons'); ?></button>
                </div>
            </form>
            
        </div>
    </div>
</div>