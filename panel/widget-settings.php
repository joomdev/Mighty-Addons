<?php
/**
 * Mighty Addons Command Template
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// What you allow is what will continue - Mighty Dashboard
$widgets = self::$ma_get_settings;
$page = 'widgets';
?>

<?php include_once('includes/header.php'); ?>

<div id="widgets" class="ma-tabs-content">
    <div class="ma-row">
        <div class="ma-col-full">
            <div class="ma-gl-cnt-wrap">
                <div class="ma-gl-cnt-left">
                    <h4 class="title">Content Elements</h4>
                    <div class="ma-btn-group">
                        <button type="button" class="ma-btn ma-btn-action active" data-filter="*">All</button>
                        <button type="button" class="ma-btn ma-btn-action" data-filter="free">Free</button>
                        <button type="button" class="ma-btn ma-btn-action" data-filter="pro">Pro</button>
                    </div>
                </div>
                <div class="ma-gl-cnt-right">
                    <h4 class="title">Global Control</h4>
                    <div class="ma-btn-group">
                        <button id="enable-all" type="button" class="ma-btn ma-btn-action ma-gl-cnt-enable">Enable All</button>
                        <button  id="disable-all" type="button" class="ma-btn ma-btn-action ma-gl-cnt-disable">Disable All</button>
                    </div>
                </div>
            </div>
            <form id="mighty-settings" action="" method="POST" name="mighty-settings">
                <div class="ma-element-container">
                    <?php foreach( $widgets as $widget => $props ) : ?>
                    <div class="ma-element ma-element-free">
                        <div class="ma-ele-info">
                            <i class="<?php echo $props['icon']; ?> widget-icon"></i>
                            <p class="ma-ele-title"><?php echo ucfirst($props['title']); ?></p>
                            <a href="#" class="ma-ele-info-link">
                                <span class="ma-view-demo">
                                    <img src="<?php echo MIGHTY_ADDONS_PLG_URL . 'assets/admin/images/desktop-solid.svg' ?>" alt="">
                                </span>
                                <span class="ma-ele-info-tooltip">Demo</span>
                            </a>
                            <a href="#" class="ma-ele-info-link">
                                <span class="ma-get-help">
                                    <img src="<?php echo MIGHTY_ADDONS_PLG_URL . 'assets/admin/images/question-solid.svg' ?>" alt="">
                                </span>
                                <span class="ma-ele-info-tooltip">Documentation</span>
                            </a>
                        </div>
                        <div class="ma-ele-switch">
                            <label class="switch">
                                <input class="switch-input" type="checkbox" name="<?php echo $props['slug']; ?>" id="<?php echo $props['slug']; ?>" <?php checked( 1, $props['enable'], true ); ?> />
                                <span class="switch-label" data-on="On" data-off="Off"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="text-center">
                    <button type="submit" class="button ma-btn js-ma-settings-save ma-btn ma-save-button"><?php echo __('Save Settings', 'mighty-addons'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include_once('includes/footer.php'); ?>