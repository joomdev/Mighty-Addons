<?php
/**
 * Mighty Addons
 * Widget Settings
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Widget Controls | What you allow is what will continue - Mighty Dashboard
?>
<div id="widgets" class="ma-tabs-content">
    <div class="ma-row">
        <div class="ma-col-full">

            <div class="ma-gl-cnt-right">
                <div class="ma-btn-group">
                    <button id="enable-all" type="button" class="ma-btn ma-btn-action ma-gl-cnt-enable">Enable All</button>
                    <button  id="disable-all" type="button" class="ma-btn ma-btn-action ma-gl-cnt-disable">Disable All</button>
                </div>
            </div>
            
            <form id="mighty-settings" action="" method="POST" name="mighty-settings">
                <div class="ma-element-container">
                    <?php foreach( $widgets as $widget => $props ) : ?>
                    <div class="ma-element">
                        <div class="ma-ele-info">
                            <i class="<?php echo $props['icon']; ?> widget-icon"></i>
                            <p class="ma-ele-title">
                                <?php echo ucfirst($props['title']); ?>
                            </p>
                            <!-- <a href="https://demo.mightythemes.com/mighty-addons/<?php echo strtolower(str_replace(' ', '-', $props['title'])); ?>" class="ma-ele-info-link" target="_blank">
                                <span class="ma-view-demo">
                                    <img src="<?php echo MIGHTY_ADDONS_PLG_URL . 'assets/admin/images/desktop-solid.svg' ?>" alt="">
                                </span>
                                <span class="ma-ele-info-tooltip">Demo</span>
                            </a> -->
                            <!-- <a href="https://mightythemes.com/products/mighty-addons/" target="_blank" class="ma-ele-info-link">
                                <span class="ma-get-help">
                                    <img src="<?php echo MIGHTY_ADDONS_PLG_URL . 'assets/admin/images/question-solid.svg' ?>" alt="">
                                </span>
                                <span class="ma-ele-info-tooltip">Documentation</span>
                            </a> -->
                        </div>
                        <div class="ma-ele-switch">
                            <label class="switch">
                                <input class="switch-input mighty-addons-free" type="checkbox" name="<?php echo $props['slug']; ?>" id="<?php echo $props['slug']; ?>" <?php checked( 1, $props['enable'], true ); ?> />
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                    </div>
                    <?php endforeach; ?>

                    <?php foreach( $pro_widgets as $widget => $props ) : ?>
                    <div class="ma-element">
                        <div class="ma-ele-info">
                            <i class="<?php echo $props['icon']; ?> widget-icon"></i>
                            <p class="ma-ele-title">
                                <?php echo ucfirst($props['title']); ?>
                                <sup class="mighty-pro-tag">PRO</sup>
                            </p>
                            <!-- <a href="https://demo.mightythemes.com/mighty-addons/<?php echo strtolower(str_replace(' ', '-', $props['title'])); ?>" class="ma-ele-info-link" target="_blank">
                                <span class="ma-view-demo">
                                    <img src="<?php echo MIGHTY_ADDONS_PLG_URL . 'assets/admin/images/desktop-solid.svg' ?>" alt="">
                                </span>
                                <span class="ma-ele-info-tooltip">Demo</span>
                            </a> -->
                            <!-- <a href="https://mightythemes.com/products/mighty-addons/" target="_blank" class="ma-ele-info-link">
                                <span class="ma-get-help">
                                    <img src="<?php echo MIGHTY_ADDONS_PLG_URL . 'assets/admin/images/question-solid.svg' ?>" alt="">
                                </span>
                                <span class="ma-ele-info-tooltip">Documentation</span> -
                            </a> -->
                        </div>
                        <div class="ma-ele-switch <?php echo isset( $props['stub'] ) ? 'stub-widget' : ''; ?>">
                            <label class="switch">
                                <input class="switch-input mighty-addons-pro" type="checkbox" name="<?php echo $props['slug']; ?>" id="<?php echo $props['slug']; ?>" <?php checked( 1, $props['enable'], true ); ?> <?php echo isset( $props['stub'] ) ? 'disabled' : ''; ?>/>
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="text-center ma-cta-save">
                    <button type="submit" class="button ma-btn ma-save-button" disabled="disabled"><?php _e('Save Settings', 'mighty-addons'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>