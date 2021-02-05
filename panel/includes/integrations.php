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
        <div class="ma-integration">
            
            <form id="mighty-integration-settings" action="" method="POST" name="mighty-integration-settings">

                <div class="ma-element">
                    <label for="mailchimp" class="ma-ele-title"><?php _e('🐵 Mailchimp Key', 'mighty-addons'); ?></label>
                    <div class="info-field">
                        <input class="regular-text" type="text" name="mailchimp-key" placeholder="YOUR_API_KEY" id="mailchimp" value="<?php echo Helper::get_integration_option('mailchimp-key'); ?>" />
                        <a class="help-link" target="_blank" href="https://mailchimp.com/help/about-api-keys/"><?php _e('Get Mailchimp API key 🔑', 'mighty-addons'); ?></a>
                    </div>
                </div>

                <div class="ma-element">
                    <label for="gmaps" class="ma-ele-title"><?php _e('🌏 Google Maps Key', 'mighty-addons'); ?></label>
                    <div class="info-field">
                        <?php if ( Helper::mightyProAvailable() ) { ?>
                            <input class="regular-text" type="text" name="gmaps-api-key" placeholder="YOUR_API_KEY" id="gmaps" value="<?php echo Helper::get_integration_option('gmaps-api-key'); ?>" />
                            <a class="help-link" target="_blank" href="https://developers.google.com/maps/documentation/javascript/get-api-key"><?php _e('Get Google Maps API key 🔑', 'mighty-addons'); ?></a>
                        <?php } else { ?>
                            <a href="https://mightythemes.com/products/mighty-addons/" target="_BLANK" class="button ma-btn">Mighty Addons Pro Required</a>
                        <?php } ?>
                        
                    </div>
                </div>

                <?php if ( $branding['hide_option'] !== "on" ) : ?>

                    <div class="ma-element">
                        <label for="white-label" class="ma-ele-title"><?php _e('📃 White Label', 'mighty-addons'); ?></label>
                        <?php if ( Helper::mightyProAvailable() ) { ?>
                            <a href="#white-label" class="button ma-btn white-label-settings"><?php _e('Configure', 'mighty-addons'); ?></a>
                        <?php } else { ?>
                            <a href="https://mightythemes.com/products/mighty-addons/" target="_BLANK" class="button ma-btn">Mighty Addons Pro Required</a>
                        <?php } ?>
                    </div>

                <?php endif; ?>

                <div class="ma-element">
                    <label for="weather-api" class="ma-ele-title"><?php _e('⛅ Weather', 'mighty-addons'); ?></label>
                    <?php if ( Helper::mightyProAvailable() ) { ?>
                        <div class="info-field">

                            <?php $weatherAPI = Helper::get_integration_option('weather-api'); ?>
                            <select class="regular-text" name="weather-api" id="weather-api">
                                <option value="-1"<?php echo $weatherAPI == "-1" ? ' selected' : ''; ?>>Choose API</option>
                                <option value="openweather"<?php echo $weatherAPI == "openweather" ? ' selected' : ''; ?>>OpenWeather</option>
                                <option value="weatherbit"<?php echo $weatherAPI == "weatherbit" ? ' selected' : ''; ?>>Weatherbit</option>
                            </select>
                            
                            <a style="display:none;" class="help-link api-key-openweather" target="_blank" href="https://openweathermap.org/appid"><?php _e('Get OpenWeather API key 🔑', 'mighty-addons'); ?></a>
                            <a style="display:none;" class="help-link api-key-weatherbit" target="_blank" href="https://www.weatherbit.io/api"><?php _e('Get Weatherbit API key 🔑', 'mighty-addons'); ?></a>

                            <input style="<?php echo $weatherAPI == "weatherbit" || $weatherAPI == "openweather" ? 'display:block;' : 'display:none;'; ?> margin-top: 10px;" class="regular-text" type="text" name="weather-api-key" placeholder="YOUR_API_KEY" id="weather-api-key" value="<?php echo Helper::get_integration_option('weather-api-key'); ?>" />
                        </div>
                    <?php } else { ?>
                        <a href="https://mightythemes.com/products/mighty-addons/" target="_BLANK" class="button ma-btn">Mighty Addons Pro Required</a>
                    <?php } ?>
                </div>

                <div class="ma-element">
                    <label for="instagram" class="ma-ele-title"><?php _e('📷 Insta Gallery', 'mighty-addons'); ?></label>
                    <?php if ( Helper::mightyProAvailable() ) { ?>
                    <div class="info-field">
                        <input class="regular-text" type="text" name="ig-access-token" placeholder="ACCESS_TOKEN" id="instagram" value="<?php echo Helper::get_integration_option('ig-access-token'); ?>" />

                        <a class="help-link" target="_blank" href="https://mightythemes.com/insta-token-generator/"><?php _e('Generate Access Token 📃', 'mighty-addons'); ?></a>
                    </div>
                    <?php } else { ?>
                        <a href="https://mightythemes.com/products/mighty-addons/" target="_BLANK" class="button ma-btn">Mighty Addons Pro Required</a>
                    <?php } ?>
                </div>

                <div class="text-center ma-cta-save">
                    <button type="submit" class="button ma-btn ma-save-button"><?php _e('Save Settings', 'mighty-addons'); ?></button>
                </div>
            </form>
            
        </div>
    </div>
</div>