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
		// wp_register_script( 'mightypro-chart', MIGHTY_ADDONS_PRO_PLG_URL . 'assets/js/chart.js', [ 'jquery' ], MIGHTY_ADDONS_PRO_VERSION, true );
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

    public function get_script_depends() {
        return [
            // 'mightypro-main',
            // 'mightypro-chart'
        ];
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
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'text_marquee_item',
                [
                    'label' => __( 'Items', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'title_field' => ' Items ',
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
                    ]
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
                    'default' => 'yes',
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
                        '{{WRAPPER}} .marquee' => 'padding-right: {{SIZE}}{{UNIT}};',
                    ]
                ]
            );

            $this->add_control(
                'text_stroke_width',
                [
                    'label' => __( 'Text Stroke Width', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'condition' => [
                        'text_stroke_effect' => 'yes',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .marquee' => 'padding-right: {{SIZE}}{{UNIT}};',
                    ]
                ]
            );

            $this->add_control(
                'space_between_items',
                [
                    'label' => __( 'Space Between Items', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'Px', '%' , 'EM' ],
                    'range' => [
                        '%' => [
                            'min' => 1,
                            'max' => 100,
                            'step' => 1,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 20,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .marquee' => 'padding-right: {{SIZE}}{{UNIT}};',
                    ]
                ]
            );

        $this->end_controls_section();

    }
    
	protected function render() {
        
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute( 'mighty-text-marquee', 'class', 'mighty-marquee' );
        $this->add_render_attribute( 'text-marquee', 'class', 'marquee__inner' );

        ?>

        <?php echo '<div '.$this->get_render_attribute_string('mighty-text-marquee').'  id="mighty-text-marquee-' . $this->get_id() . '" >' ?>

            <div class="marquee">
                <?php foreach ($settings['text_marquee_item'] as $key => $value) { ?>
                    
                        <span <?php echo $this->get_render_attribute_string('text-marquee');?> ><?php echo $value['text_marquee_text']; ?></span>

                <?php } ?>
            </div>

        <?php echo '</div>'; ?>

    <?php

	}
}