<?php
/**
 * Mighty Addons Command Template
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use \MightyAddons\Classes\DashboardPanel;
$widgets = DashboardPanel::mighty_addons();


?>

<div class="mighty-addons-panel">
    <div class="container m-5">
        <div class="row text-center">
            <?php foreach( $widgets as $widget => $props ) : ?>
                <div class="col-4 m-4">
                    <div class="mighty-widget">
                        <label for="<?php echo $props['slug']; ?>" class="btn btn-default d-flex justify-content-around">
                            <input type="checkbox" id="<?php echo $props['slug']; ?>" class="badgebox" <?php echo $props['enable'] ? 'checked' : ''; ?>>
                            <i class="<?php echo $props['icon']; ?>"></i> <?php echo $props['title']; ?>
                        </label>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>