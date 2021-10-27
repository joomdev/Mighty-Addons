<?php

namespace MightyAddons\classes;

if ( ! defined( 'ABSPATH' ) ) exit;

class AgeChecker{

    public static function agecheckerhtml( $settings )
    { ?>

    <?php 
        if ( $settings[ 'display_logo' ] == 'yes' ) {
            $logo = $settings[ 'logo' ]['id'] ? $settings[ 'logo' ]['url'] : '';
        }

        $title = ( $settings[ 'enable_title' ] == 'yes' ) ? $settings[ 'title' ] : '';

        $description = ( $settings[ 'enable_description' ] == 'yes' ) ? $settings[ 'description' ] : '';
    
    ?>
        <div class="ma-agech">

            <div class="ma-agech__wrapper ma-right-side-image <?php echo $settings['display_position'];?> ">

                <div class="ma-agech__content">

                    <div class="ma-agech__content-inner ma-align-<?php echo $settings['content_alignment'];?>">

                        <?php if ( $logo ) { ?>
                            <div class="ma-agech__logo-wrapper">
                                <img src="<?php echo $logo ;?>" alt="logo" class="ma-agech__logo">
                            </div>
                        <?php } ?>    

                        <?php if ( $title ) { ?>
                            <h3 class="ma-agech__title"><?php echo $title ?></h3>
                        <?php } ?>    

                        <?php if ( $description ) { ?>
                            <p class="ma-agech__description"><?php echo $description; ?></p>
                        <?php } ?>

                        <?php if ( $settings['method'] == 'age_confirmation' ) { ?>
                            <div class="ma-agech__checkbox-wrapper">
                                <input type="checkbox" id="age18plus" class="ma-agech__checkbox" name="age"value="age">
                                <label for="vehicle1" class="ma-agech__checkbox-label"><?php echo $settings['check_input_box'];?></label>
                            </div>
                        <?php } ?>

                        <div class="ma-agech__input-btn-wrapper">

                            <div class="ma-agech__input-wrapper">
                                <input type="date" id="birthdate" class="ma-agech__input" name="birthdate">
                            </div>

                            <div class="ma-agech__btn-wrapper">

                                <a href="#" class="ma-agech__btn-primary ma-agech__icon-<?php echo $settings['icon_position'];?>"role="btn">
                                    <span class="ma-agech-btn__icon"><i class="<?php echo $settings['button_icon']['value']; ?>"></i></span>
                                    <span class="ma-agech-btn__text"><?php echo $settings['button_text']; ?></span>
                                    
                                </a>

                                <?php if( $settings['method'] == 'yes_no' ) { ?>
                                    <a href="#" class="ma-agech__btn-secondary ma-agech__icon-after"role="btn">
                                        <span class="ma-agech-btn__icon"><i class="fas fa-times"></i></span>
                                        <span class="ma-agech-btn__text">No</span>
                                    </a>
                                <?php } ?>

                            </div>

                        </div>

                    </div>

                    <p class="ma-agech__bottom-text ma-align-<?php echo $settings['bottom_line_alignment'];?>"><?php echo $settings['bottom_text']; ?></p>

                </div>

                <div class="ma-agech__side-image"></div>

            </div>

	    </div>

	<script type="text/javascript"  src="https://apiv2.popupsmart.com/api/Bundle/371727" async></script>
    <?php }
}

new AgeChecker();