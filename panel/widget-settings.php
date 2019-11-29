<?php
/**
 * Mighty Addons Command Template
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// What you allow is what will continue - Mighty Dashboard
$widgets = self::$ma_get_settings;

?>

<div class="mighty-addons-panel">
    <div class="container m-5">
        <form id="mighty-settings" action="" method="POST" name="mighty-settings">
            <div class="row text-center">
            <?php foreach( $widgets as $widget => $props ) : ?>
                <div class="col-3 m-3">
                    <div class="mighty-widget">
                        <label for="<?php echo $props['slug']; ?>" class="btn btn-default d-flex justify-content-around">
                            <input type="checkbox" name="<?php echo $props['slug']; ?>" id="<?php echo $props['slug']; ?>" class="badgebox" <?php checked( 1, $props['enable'], true ); ?>>
                            <i class="<?php echo $props['icon']; ?>"></i> <?php echo $props['title']; ?>
                        </label>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <div class="text-center">
                <input type="submit" value="<?php echo __('Save Settings', 'premium-addons-for-elementor'); ?>" class="btn btn-primary ma-btn ma-save-button">
            </div>
        </form>
    </div>
</div>