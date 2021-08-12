<?php

namespace MightyAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class MT_textmarquee extends Widget_Base {

    public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
        
        wp_register_style( 'mt-text-marquee', MIGHTY_ADDONS_PLG_URL . 'assets/css/text-marquee.css', false, MIGHTY_ADDONS_VERSION );
	}

	public function get_name() {
		return 'mt-textmarquee';
	}

	public function get_title() {
		return __( 'Text Marquee', 'mighty' );
    }
    
	public function get_icon() {
		return 'mf mf-textmarquee';
    }

    public function get_categories() {
        return [ 'mighty-addons' ];
    }

    public function get_style_depends() {
		return [ 'mt-text-marquee' ];
    }
    
	public function get_keywords() {
		return [ 'mighty', 'mt', 'text', 'marquee' ];
    }
    
	protected function _register_controls() {
        // basic section
		$this->start_controls_section(
			'section_wcg_basic',
			[
				'label' => __( 'Basic', 'mighty' ),
			]
		);

            $repeater = new \Elementor\Repeater();

            $repeater->add_control(
                'text_marquee_text', [
                    'label' => __( 'Text', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'text_marquee_item',
                [
                    'label' => __( 'Items', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'default' => [
                        [
                            'text_marquee_text' => __( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'mighty' ),
                        ],
                    ],                    
                    'fields' => $repeater->get_controls(),
                    'title_field' => ' Item ',
                ]
            );

        $this->end_controls_section();
        // style 
        $this->start_controls_section(
			'section_tm_style',
			[
				'label' => __( 'Basic', 'mighty' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
        );

            $this->add_control(
                'text_marquee_color',
                [
                    'label' => __( 'Color', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'default' => 'grey',
                    'selectors' => [
                        '{{WRAPPER}} .marquee' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'text_marquee_typography',
					'label' => __( 'Typography', 'mighty' ),
					'selector' => '{{WRAPPER}} .marquee',
				]
            );
            
            $this->add_control(
                'text_stroke_effect', [
                    'label' => __( 'Enable Text Stroke Effect', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'text_stroke_color',
                [
                    'label' => __( 'Text Stroke Color', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'default' => 'grey',
                    'condition' => [
                        'text_stroke_effect' => 'yes'
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .marquee' => '-webkit-text-stroke-color: {{VALUE}}; color: transparent;',
                    ]
                ]
            );

            $this->add_control(
                'text_stroke_width',
                [
                    'label' => __( 'Text Stroke Width', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                    'condition' => [
                        'text_stroke_effect' => 'yes',
                    ],
                    'default' => 1,
                    'selectors' => [
                        '{{WRAPPER}} .marquee' => '-webkit-text-stroke-width: {{VALUE}}px;',
                    ]
                ]
            );

            $this->add_responsive_control(
                'space_between_items',
                [
                    'label' => __( 'Space Between Items', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 1,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 40,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mighty-marquee .marquee .marquee_inner' => 'padding-right: {{SIZE}}{{UNIT}};',
                    ]
                ]
            );
            
            $this->add_responsive_control(
                'animation_speed',
                [
                    'label' => __( 'Speed', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 20,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mighty-marquee .marquee .marquee-items' => 'animation-duration: {{SIZE}}s;',
                    ]
                ]
            );

        $this->end_controls_section();

    }
    
	protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <?php echo '<div class="mighty-marquee"  id="mighty-text-marquee-' . $this->get_id() . '" >' ?>

            <div class="marquee">
                <div class="marquee-items">
                    <?php  foreach ( $settings['text_marquee_item'] as $key => $value ) { ?>
                        <p class="marquee_inner" ><?php echo $value['text_marquee_text']; ?></p>
                    <?php } ?>
                </div>
                <div class="marquee-items">
                    <?php  foreach ( $settings['text_marquee_item'] as $key => $value ) { ?>
                        <p class="marquee_inner" ><?php echo $value['text_marquee_text']; ?></p>
                    <?php } ?>
                </div>
            </div>
        <?php echo '</div>'; ?>
    <?php
	}
}