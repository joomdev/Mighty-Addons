<?php
/**
 * Mighty Addons
 * General
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// All the Awesomeness
$widgets = self::$ma_get_settings;
?>

<?php include_once('includes/header.php'); ?>

<!-- Home Sweet Home -->
<div id="general" class="ma-tabs-content">
    <div class="mt-banner">
        <img class="banner" src="<?php echo MIGHTY_ADDONS_PLG_URL . 'assets/admin/images/banner.jpg'; ?>" alt="">
    </div>
    <div class="ma-row ma-tabs-content-wrap container">
        <div class="ma-tabs-content-inner">
            <div class="ma-tabs-content-block-wrap">
                <div class="ma-tabs-block ma-tabs-block-docs">
                    <header class="ma-tabs-block-header">
                        <h4 class="ma-tabs-block-title">Need Help?</h4>
                    </header>
                    <div class="ma-tabs-block-content">
                        <p>Facing issues while using addons? Get help from our dedicated WordPress Developers on <a class="mighty-underline" href="https://mightythemes.com/support/c/mighty-addons/" target="_blank">Mighty Addons Official Forum</a>. Or join our <a class="mighty-underline" target="_blank" href="https://www.facebook.com/groups/mightythemes/">Facebook Community</a> and post your questions there as well.</p>
                        <a href="https://mightythemes.com/support/c/mighty-addons/" class="ma-btn" target="_blank">Reach out on Forum</a>
                    </div>
                </div>

                <div class="ma-tabs-block ma-tabs-block-docs">
                    <header class="ma-tabs-block-header">
                        <h4 class="ma-tabs-block-title">Missing Any Feature?</h4>
                    </header>
                    <div class="ma-tabs-block-content">
                        <p>Are we missing any features that you need for your project? Submit feature requests on GitHub and help us improve Mighty Addons.</p>
                        <br>
                        <a href="https://github.com/mightythemes/Mighty-Addons/issues/new?template=issue_template.md&title=Feature%20Request:&labels=Feature%20Request" class="ma-btn" target="_blank">Request a Feature</a>
                    </div>
                </div>

                <div class="ma-tabs-block ma-tabs-block-docs">
                    <header class="ma-tabs-block-header">
                        <h4 class="ma-tabs-block-title">Developer? Want to Contribute?</h4>
                    </header>
                    <div class="ma-tabs-block-content">
                        <p>We 💗 Open Source. You can contribute to MightyAddons by reporting bugs, creating issues and pull requests on GitHub.</p>
                        <a href="https://github.com/mightythemes/Mighty-Addons/issues/new?template=issue_template.md&title=&labels=bug" class="ma-btn" target="_blank">Report a Bug</a>
                    </div>
                </div>

                <div class="ma-tabs-block ma-tabs-block-docs">
                    <header class="ma-tabs-block-header">
                        <h4 class="ma-tabs-block-title">Loved it? Show Your Love.</h4>
                    </header>
                    <div class="ma-tabs-block-content">
                        <p>Thanks for choosing Mighty Addons plugin. We are making it awesome day by day. That being said, if you could take a minute to post a review, we would so appreciate it.</p>
                        <a href="https://wordpress.org/support/plugin/mighty-addons/reviews/#new-post" class="ma-btn" target="_blank">Yeah, you deserve 5 Stars</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Widget Controls | What you allow is what will continue - Mighty Dashboard -->
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
                    <div class="ma-element ma-element-free">
                        <div class="ma-ele-info">
                            <i class="<?php echo $props['icon']; ?> widget-icon"></i>
                            <p class="ma-ele-title"><?php echo ucfirst($props['title']); ?></p>
                            <a href="https://demo.mightythemes.com/mighty-addons/<?php echo strtolower(str_replace(' ', '-', $props['title'])); ?>" class="ma-ele-info-link" target="_blank">
                                <span class="ma-view-demo">
                                    <img src="<?php echo MIGHTY_ADDONS_PLG_URL . 'assets/admin/images/desktop-solid.svg' ?>" alt="">
                                </span>
                                <span class="ma-ele-info-tooltip">Demo</span>
                            </a>
                            <a href="https://mightythemes.com/products/mighty-addons/" target="_blank" class="ma-ele-info-link">
                                <span class="ma-get-help">
                                    <img src="<?php echo MIGHTY_ADDONS_PLG_URL . 'assets/admin/images/question-solid.svg' ?>" alt="">
                                </span>
                                <span class="ma-ele-info-tooltip">Documentation</span>
                            </a>
                        </div>
                        <div class="ma-ele-switch">
                            <label class="switch">
                                <input class="switch-input" type="checkbox" name="<?php echo $props['slug']; ?>" id="<?php echo $props['slug']; ?>" <?php checked( 1, $props['enable'], true ); ?> />
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="text-center ma-cta-save">
                    <button type="submit" class="button ma-btn js-ma-settings-save ma-btn ma-save-button" disabled="disabled"><?php echo __('Save Settings', 'mighty-addons'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Extensions -->
<div id="extensions" class="ma-tabs-content coming-soon">
    <div class="ma-row">
        <div class="ma-col-full">
            <div class="text-center">
                <h1 class="cs-title">Coming Soon_</h1>
                <p>: :&nbsp;&nbsp;&nbsp;&nbsp;: :&nbsp;&nbsp;&nbsp;&nbsp;: :</p>
                <div class="text-muted cs-description">Something cool is coming.<br>Stay tuned.</div>
            </div>
            <div class="mt-illustration">
                <img class="under-construction" src="<?php echo MIGHTY_ADDONS_PLG_URL . 'assets/admin/images/undraw_under_construction.svg' ?>" alt="">
            </div>
        </div>
    </div>
</div>

<!-- "Be a HERO" - Go Pro  -->
<div id="go-pro" class="ma-tabs-content coming-soon">
    <div class="ma-row">
        <div class="ma-col-full">
            <div class="mt-illustration">
                <img class="under-construction" src="<?php echo MIGHTY_ADDONS_PLG_URL . 'assets/admin/images/undraw_on_the_way.svg' ?>" alt="">
            </div>
            <div class="text-center">
                <h1 class="cs-title">On the way ..</h1>
                <p>: :&nbsp;&nbsp;&nbsp;&nbsp;: :&nbsp;&nbsp;&nbsp;&nbsp;: :</p>
                <div class="text-muted cs-description">Mighty Addons is coming up with a pro version very soon.<br> Sign Up for an exclusive launch offer. </div>
                <a href="https://mailchi.mp/58871d7350d3/mightyaddonspro" target="_BLANK" class="button ma-btn cs-cta"><?php echo __('Get Aboard', 'mighty-addons'); ?></a>
            </div>
        </div>
    </div>
</div>

<?php include_once('includes/footer.php'); ?>