<?php
/**
 * Mighty Addons
 * Extension Settings
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<!-- Extensions -->
<div id="extensions" class="ma-tabs-content">
    <div class="ma-row">
        <div class="ma-col-full">

            <form id="mighty-settings" action="" method="POST" name="mighty-settings">
                <div class="ma-element-container">
                    <?php foreach( $extensions as $extension => $props ) : ?>
                    <div class="ma-element">
                        <div class="ma-ele-info">
                            <i class="<?php echo $props['icon']; ?> widget-icon"></i>
                            <p class="ma-ele-title"><?php echo ucfirst($props['title']); ?></p>
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

                    <?php foreach( $pro_extensions as $extension => $props ) : ?>
                    <div class="ma-element">
                        <div class="ma-ele-info">
                            <i class="<?php echo $props['icon']; ?> widget-icon"></i>
                            <p class="ma-ele-title">
                                <?php echo ucfirst($props['title']); ?>
                                <sup class="mighty-pro-tag">PRO</sup>
                            </p>
                            <!-- <a href="https://mightythemes.com/products/mighty-addons/" target="_blank" class="ma-ele-info-link">
                                <span class="ma-get-help">
                                    <img src="<?php echo MIGHTY_ADDONS_PLG_URL . 'assets/admin/images/question-solid.svg' ?>" alt="">
                                </span>
                                <span class="ma-ele-info-tooltip">Documentation</span>
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
                    <button type="submit" class="button ma-btn ma-save-button" disabled="disabled"><?php _e( 'Save Settings', 'mighty-addons' ); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>