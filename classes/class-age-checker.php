<?php

namespace MightyAddons\classes;

if ( ! defined( 'ABSPATH' ) ) exit;

// include 
class AgeChecker{

    public static function agecheckerhtml( $settings , $this )
    { ?>

    <?php 
        if ( $settings[ 'display_logo' ] == 'yes' ) {
            $logo = $settings[ 'logo' ]['id'] ? $settings[ 'logo' ]['url'] : '';
        }

        if ( $settings[ 'add_background_image' ] == 'yes' ) {
            $background_image = $settings[ 'background_image' ]['id'] ? $settings[ 'background_image' ]['url'] : '';
        }

        $title = ( $settings[ 'enable_title' ] == 'yes' ) ? $settings[ 'title' ] : '';

        if ( $settings[ 'enable_description' ] == 'yes' ) {

            if ( $settings[ 'method' ] == 'age_confirmation' ) {
                $description = $settings[ 'description' ];
            }
            if ( $settings[ 'method' ] == 'yes_no' ) {
                $description = $settings[ 'description_yes_no' ];
            }
            if ( $settings[ 'method' ] == 'date_birth' ) {
                $description = $settings[ 'description_date_birth' ];
            }

            if ( $settings['overlay_color'] ) {
                $this->add_render_attribute( 'background-overlay', 'class', 'has-overlay' );
            }

        }
    
    ?>
        <div class="ma-agech <?php echo Element_Base::get_render_attribute_string('background-overlay'); ?>"  style='background-image: url(<?php echo $background_image ;?> ); background-position : <?php echo $settings['background_image_position'];?>' >

            <div class="ma-agech__wrapper ma-right-side-image <?php echo $settings['display_position'];?> ">

                <div class="ma-agech__content">

                    <div class="ma-agech__content-inner ma-align-<?php echo $settings['content_alignment'];?>">

                        <?php if ( isset( $logo ) ) { ?>
                            <div class="ma-agech__logo-wrapper">
                                <img src="<?php echo $logo ;?>" alt="logo" class="ma-agech__logo">
                            </div>
                        <?php } ?>    

                        <?php if ( isset ( $title ) ) { ?>
                            <h3 class="ma-agech__title"><?php echo $title ?></h3>
                        <?php } ?>    

                        <?php if ( isset ( $description ) ) { ?>
                            <div class="ma-agech__description"><?php echo $description; ?></div>
                        <?php } ?>

                        <?php if ( $settings['method'] == 'age_confirmation' ) { ?>
                            <div class="ma-agech__checkbox-wrapper">
                                <input type="checkbox" id="age18plus" class="ma-agech__checkbox" name="age"value="age">
                                <label for="vehicle1" class="ma-agech__checkbox-label"><?php echo $settings['check_input_box'];?></label>
                            </div>
                        <?php } ?>

                        <div class="ma-agech__input-btn-wrapper">
                            <?php if ( $settings['method'] == 'date_birth' ) { ?>
                                <div class="ma-agech__input-wrapper">
                                    <input type="date" id="birthdate" class="ma-agech__input" name="birthdate">
                                </div>
                            <?php } ?>

                            <div class="ma-agech__btn-wrapper">

                                <a href="#" class="ma-agech__btn-primary ma-agech__icon-<?php echo $settings['icon_position'];?>"role="btn">
                                    <span class="ma-agech-btn__icon"><i class="<?php echo $settings['button_icon']['value']; ?>"></i></span>
                                    <input tye= class="ma-agech-btn__text"><?php echo $settings['button_text']; ?></input>
                                    
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

                    <div class="ma-agech__bottom-text ma-align-<?php echo $settings['bottom_line_alignment'];?>"><?php echo $settings['bottom_text']; ?></div>

                </div>
                
                <?php if ( $settings['add_right_side_image'] == 'yes' ) { ?>
                    <div class="ma-agech__side-image" ></div>
                <?php } ?>

            </div>

	    </div>

	<script type="text/javascript"  src="https://apiv2.popupsmart.com/api/Bundle/371727" async></script>
    <?php }
}

new AgeChecker();