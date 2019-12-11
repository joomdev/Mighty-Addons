<?php
/**
 * Mighty Extensions
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$page = 'go-pro';
?>

<?php include_once('includes/header.php'); ?>

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