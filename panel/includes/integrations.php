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
                <div class="ma-element">
                    <label for="gmaps" class="ma-ele-title"><?php _e('🌏 Google Maps Key', 'mighty-addons'); ?></label>
                    <div class="info-field">
                        <?php if ( Helper::mightyProAvailable() ) { ?>
                            <input class="regular-text" type="text" name="gmaps-api-key" placeholder="YOUR_API_KEY" id="gmaps" value="<?php echo Helper::get_integration_option('gmaps-api-key'); ?>" />
                            <a class="help-link" target="_blank" href="https://developers.google.com/maps/documentation/javascript/get-api-key"><?php _e('Get Google Maps API key 🔑', 'mighty-addons'); ?></a>
                        <?php } else { ?>
                            <input type="button" value="Mighty Addons Pro Required" class="button ma-btn white-label-settings" />
                        <?php } ?>
                        
                    </div>
                </div>

                <div class="ma-element">
                    <label for="mailchimp" class="ma-ele-title"><?php _e('🐵 Mailchimp Key', 'mighty-addons'); ?></label>
                    <div class="info-field">
                        <input class="regular-text" type="text" name="mailchimp-key" placeholder="YOUR_API_KEY" id="mailchimp" value="<?php echo Helper::get_integration_option('mailchimp-key'); ?>" />
                        <a class="help-link" target="_blank" href="https://mailchimp.com/help/about-api-keys/"><?php _e('Get Mailchimp API key 🔑', 'mighty-addons'); ?></a>
                    </div>
                </div>

                <?php if ( $branding['hide_option'] !== "on" ) : ?>

                    <div class="ma-element">
                        <label for="white-label" class="ma-ele-title"><?php _e('📃 White Label', 'mighty-addons'); ?></label>
                        <?php if ( Helper::mightyProAvailable() ) { ?>
                            <a href="#white-label" class="button ma-btn white-label-settings"><?php _e('Configure', 'mighty-addons'); ?></a>
                        <?php } else { ?>
                            <input type="button" value="Mighty Addons Pro Required" class="button ma-btn white-label-settings" />
                        <?php } ?>
                    </div>

                <?php endif; ?>

                <div class="text-center ma-cta-save">
                    <button type="submit" class="button ma-btn ma-save-button"><?php _e('Save Settings', 'mighty-addons'); ?></button>
                </div>
            </form>
            
        </div>
    </div>
</div>