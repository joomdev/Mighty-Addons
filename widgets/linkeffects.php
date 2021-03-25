<?php
namespace MightyAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor MT_LinkEffects
 *
 * Elementor widget for MT_LinkEffects.
 *
 * @since 1.4.5
 */
class MT_LinkEffects extends Widget_Base {

    public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
	
		wp_register_style( 'mt-linkeffects', MIGHTY_ADDONS_PLG_URL . 'assets/css/linkeffects.min.css', false, MIGHTY_ADDONS_VERSION );
	}
	
	public function get_name() {
		return 'mt-linkeffects';
	}
	
	public function get_title() {
		return __( 'Link Effects', 'mighty' );
	}
	
	public function get_icon() {
		return 'mf mf-linkeffects';
	}

	public function get_categories() {
		return [ 'mighty-addons' ];
    }    
    
    public function get_keywords() {
		return [ 'mighty', 'link', 'url', 'effect' ];
    }

	public function get_style_depends() {
		return [ 'mt-common', 'mt-linkeffects' ];
    }
	
	protected function _register_controls() {

        $this->start_controls_section(
			'section_linkeffects',
			[
				'label' => __( 'Link Effects', 'mighty' ),
			]
        );
        
            $this->add_control(
                'pre_text',
                [
                    'label' => __( 'Pre Text', 'mighty' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'Pre text', 'mighty' ),
                    'placeholder' => __( 'Pre Text', 'mighty' ),
                ]
            );

            $this->add_control(
                'post_text',
                [
                    'label' => __( 'Post Text', 'mighty' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'Post text', 'mighty' ),
                    'placeholder' => __( 'Post Text', 'mighty' ),
                ]
            );

            $this->add_control(
                'link_text',
                [
                    'label' => __( 'Link Text', 'mighty' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'Link text', 'mighty' ),
                    'placeholder' => __( 'Link Text', 'mighty' ),
                ]
            );

            $this->add_control(
				'text_link',
				[
					'label' => __( 'Link', 'mighty' ),
					'type' => Controls_Manager::URL,
					'placeholder' => __( 'https://example.com', 'mighty' ),
					'show_external' => true,
					'description' => __( 'Accepts both normal URL and hashed (#) URLs', 'mighty' ),
					'default' => [
						'url' => '',
						'is_external' => false,
						'nofollow' => false,
					]
				]
            );

            $this->add_control(
                'link_effect',
                [
                    'label' => __( 'Link Effects', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 's1',
                    'options' => [
                        's1' => __( 'Style 1', 'mighty' ),
                        's2' => __( 'Style 2', 'mighty' ),
                        's3' => __( 'Style 3', 'mighty' ),
                        's4' => __( 'Style 4', 'mighty' ),
                        's5' => __( 'Style 5', 'mighty' ),
                        's6' => __( 'Style 6', 'mighty' ),
                        's7' => __( 'Style 7', 'mighty' ),
                        's8' => __( 'Style 8', 'mighty' ),
                        's9' => __( 'Style 9', 'mighty' ),
                        's10' => __( 'Style 10', 'mighty' ),
                        's11' => __( 'Style 11', 'mighty' ),
                        's12' => __( 'Style 12', 'mighty' ),
                        's13' => __( 'Style 13', 'mighty' ),
                        's14' => __( 'Style 14', 'mighty' ),
                        's15' => __( 'Style 15', 'mighty' ),
                        's16' => __( 'Style 16', 'mighty' ),
                        's17' => __( 'Style 17', 'mighty' ),
                        's18' => __( 'Style 18', 'mighty' ),
                        // 's19' => __( 'Style 19', 'mighty' ), // todo: styling fix
                        's20' => __( 'Style 19', 'mighty' ),
                    ]
                ]
            );
            
            $this->add_control(
                'link_align',
                [
                    'label' => __( 'Alignment', 'mighty' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'flex-start' => [
                            'title' => __( 'Left', 'mighty' ),
                            'icon' => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'mighty' ),
                            'icon' => 'fa fa-align-center',
                        ],
                        'flex-end' => [
                            'title' => __( 'Right', 'mighty' ),
                            'icon' => 'fa fa-align-right',
                        ]
                    ],
                    'default' => 'left',
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .mt-link-effects' => "justify-content: {{VALUE}};",
                    ]
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_linkeffects_style',
            [
                'label' => __( 'Style', 'mighty' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'linkeffects_link_heading',
                [
                    'label' => __( 'Link', 'mighty' ),
                    'type' => Controls_Manager::HEADING,
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'link_typography',
                    'label' => __( 'Link Typography', 'mighty' ),
                    'selector' => '{{WRAPPER}} .mt-link-effects .mt-link-effect',
                ]
            );

            $this->start_controls_tabs( 'link_styling_tabs' );

                $this->start_controls_tab(
                    'style_normal_tab',
                    [
                        'label' => __( 'Normal', 'mighty' ),
                    ]
                );

                    $this->add_control(
                        'link_color',
                        [
                            'label' => __( 'Color', 'mighty' ),
                            'type' => Controls_Manager::COLOR,
                            // 'default' => '#fff',
                            'selectors' => [
                                '{{WRAPPER}} .mt-link-effect-s1' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s2' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s3' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s4' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s5' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s6' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s7' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s8' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s9' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s10' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s11' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s12' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s13' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s14' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s15' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s16' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s17' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s18' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s19' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s20' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'link_bg_color',
                        [
                            'label' => __( 'Background Color', 'mighty' ),
                            'type' => Controls_Manager::COLOR,
                            // 'default' => '#000',
                            'selectors' => [
                                '{{WRAPPER}} .mt-link-effect-s1' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s2 span' => 'background-color: {{VALUE}}',
                                '{{WRAPPER}} .mt-link-effect-s3' => 'background-color: {{VALUE}}',
                                '{{WRAPPER}} .mt-link-effect-s4' => 'background-color: {{VALUE}}',
                                '{{WRAPPER}} .mt-link-effect-s5' => 'background-color: {{VALUE}}',
                                '{{WRAPPER}} .mt-link-effect-s6' => 'background-color: {{VALUE}}',
                                '{{WRAPPER}} .mt-link-effect-s7' => 'background-color: {{VALUE}}',
                                '{{WRAPPER}} .mt-link-effect-s8' => 'background-color: {{VALUE}}',
                                '{{WRAPPER}} .mt-link-effect-s9' => 'background-color: {{VALUE}}',
                                '{{WRAPPER}} .mt-link-effect-s10 span' => 'background-color: {{VALUE}}',
                                '{{WRAPPER}} .mt-link-effect-s10::before' => 'background-color: {{VALUE}}',
                                '{{WRAPPER}} .mt-link-effect-s11' => 'background-color: {{VALUE}}',
                                '{{WRAPPER}} .mt-link-effect-s12' => 'background-color: {{VALUE}}',
                                '{{WRAPPER}} .mt-link-effect-s13' => 'background-color: {{VALUE}}',
                                '{{WRAPPER}} .mt-link-effect-s14' => 'background-color: {{VALUE}}',
                                '{{WRAPPER}} .mt-link-effect-s15' => 'background-color: {{VALUE}}',
                                '{{WRAPPER}} .mt-link-effect-s16' => 'background-color: {{VALUE}}',
                                '{{WRAPPER}} .mt-link-effect-s17' => 'background-color: {{VALUE}}',
                                '{{WRAPPER}} .mt-link-effect-s18' => 'background-color: {{VALUE}}',
                                '{{WRAPPER}} .mt-link-effect-s19 span' => 'background-color: {{VALUE}}',
                                '{{WRAPPER}} .mt-link-effect-s19 span::before' => 'background-color: {{VALUE}}',
                                '{{WRAPPER}} .mt-link-effect-s20 span' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_control(
                        'link_border_color',
                        [
                            'label' => __( 'Border Color', 'mighty' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .mt-link-effect-s6::before' => 'background: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s6::after' => 'background: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s7::before' => 'background: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s8::before' => 'border-color: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s11' => 'border-top-color: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s14 span::before' => 'background: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s14 span::after' => 'background: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s18::before' => 'background: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s18::after' => 'background: {{VALUE}};'
                            ],
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'style_hover_tab',
                    [
                        'label' => __( 'Hover', 'mighty' ),
                    ]
                );

                    $this->add_control(
                        'link_hover_color',
                        [
                            'label' => __( 'Color', 'mighty' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .mt-link-effect-s1:hover' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s2:hover span::before' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s3:hover' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s4:hover' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s5:hover span::before' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s6:hover' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s7:hover' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s8:hover' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s9:hover' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s10:hover::before' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s11:hover span::before' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s12:hover' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s13:hover' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s14:hover' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s15:hover' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s16:hover span::before' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s17:hover' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s18:hover' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s19:hover span::before' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s20:hover span::before' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'link_hover_bg_color',
                        [
                            'label' => __( 'Background Color', 'mighty' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .mt-link-effect-s1:hover' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .mt-link-effect-s2:hover span::before' => 'background-color: {{VALUE}}',
                                '{{WRAPPER}} .mt-link-effect-s3:hover' => 'background-color: {{VALUE}}',
                                '{{WRAPPER}} .mt-link-effect-s4:hover' => 'background-color: {{VALUE}}',
                                '{{WRAPPER}} .mt-link-effect-s5:hover' => 'background-color: {{VALUE}}',
                                '{{WRAPPER}} .mt-link-effect-s6:hover' => 'background-color: {{VALUE}}',
                                '{{WRAPPER}} .mt-link-effect-s7:hover' => 'background-color: {{VALUE}}',
                                '{{WRAPPER}} .mt-link-effect-s8:hover' => 'background-color: {{VALUE}}',
                                '{{WRAPPER}} .mt-link-effect-s9:hover' => 'background-color: {{VALUE}}',
                                '{{WRAPPER}} .mt-link-effect-s10:hover::before' => 'background-color: {{VALUE}}',
                                '{{WRAPPER}} .mt-link-effect-s11:hover' => 'background-color: {{VALUE}}',
                                '{{WRAPPER}} .mt-link-effect-s12:hover' => 'background-color: {{VALUE}}',
                                '{{WRAPPER}} .mt-link-effect-s13:hover' => 'background-color: {{VALUE}}',
                                '{{WRAPPER}} .mt-link-effect-s14:hover' => 'background-color: {{VALUE}}',
                                '{{WRAPPER}} .mt-link-effect-s15:hover' => 'background-color: {{VALUE}}',
                                '{{WRAPPER}} .mt-link-effect-s16:hover' => 'background-color: {{VALUE}}',
                                '{{WRAPPER}} .mt-link-effect-s17:hover' => 'background-color: {{VALUE}}',
                                '{{WRAPPER}} .mt-link-effect-s18:hover' => 'background-color: {{VALUE}}',
                                '{{WRAPPER}} .mt-link-effect-s19:hover span::before' => 'background-color: {{VALUE}}',
                                '{{WRAPPER}} .mt-link-effect-s20:hover span::before' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_control(
                        'link_hover_border_color',
                        [
                            'label' => __( 'Border Color', 'mighty' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#000000',
                            'selectors' => [
                                '.mt-link-effect-s1:hover::before, .mt-link-effect-s1:hover::after' => 'color: {{VALUE}};',

                                '.mt-link-effect-s3:hover::after' => 'background: {{VALUE}};',

                                '.mt-link-effect-s4:hover::after' => 'background: {{VALUE}};',

                                '.mt-link-effect-s6:hover::after, .mt-link-effect-s6:hover::before' => 'background: {{VALUE}} !important;',

                                '.mt-link-effect-s7:hover::before, .mt-link-effect-s7:hover::after' => 'background: {{VALUE}} !important;',

                                '.mt-link-effect-s8:hover::after' => 'border-color: {{VALUE}};',

                                '.mt-link-effect-s9:hover::before, .mt-link-effect-s9:hover::after' => 'background: {{VALUE}};',

                                '.mt-link-effect-s11:hover' => 'border-top-color: {{VALUE}} !important;',
                                '.mt-link-effect-s11 span:hover::before' => 'border-bottom-color: {{VALUE}};',

                                '.mt-link-effect-s12:hover::after, .mt-link-effect-s12:hover::before' => 'border-color: {{VALUE}};',

                                '.mt-link-effect-s13:hover:before' => 'color: {{VALUE}} !important; text-shadow: 10px 0 {{VALUE}}, -10px 0 {{VALUE}} !important;',

                                '.mt-link-effect-s14:hover span::before, .mt-link-effect-s14:hover span::after' => 'background: {{VALUE}} !important;',

                                '.mt-link-effect-s17:hover span::after' => 'background: {{VALUE}};',

                                '.mt-link-effect-s18:hover::before, .mt-link-effect-s18:hover::after' => 'background: {{VALUE}} !important;',
                            ],
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

            $this->add_control(
                'linkeffects_text_heading',
                [
                    'label' => __( 'Text', 'mighty' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before'
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'text_typography',
                    'label' => __( 'Text Typography', 'mighty' ),
                    'selector' => '{{WRAPPER}} .mt-link-effects .text',
                ]
            );

            $this->add_control(
                'text_color',
                [
                    'label' => __( 'Color', 'mighty' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .mt-link-effects .text' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'link_text_spacing',
                [
                    'label' => __( 'Spacing', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 15,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mt-link-effects .mt-link-effect' => 'margin: 0 {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();
        
	}
	
	protected function render() {

        $settings = $this->get_settings_for_display();
        ?>

        <div class="mt-link-effects">

            <?php if ( $settings['pre_text'] ) : ?>
            <span class="pre-text text"><?php echo $settings['pre_text']; ?></span>
            <?php endif; ?>

            <?php if ( $settings['link_text'] ) :

            $this->add_render_attribute( 'mighty-linkeffects', 'class', 'mt-link-effect' );
            $this->add_render_attribute( 'mighty-linkeffects', 'class', 'mt-link-effect-' . $settings['link_effect'] );
            $this->add_render_attribute( 'mighty-linkeffects', 'href', $settings['text_link']['url'] ? $settings['text_link']['url'] : '#' );
            if ( $settings['text_link']['is_external'] ) {
                $this->add_render_attribute( 'mighty-linkeffects', 'target', $settings['text_link']['is_external'] );
            }
            if ( $settings['text_link']['nofollow'] ) {
                $this->add_render_attribute( 'mighty-linkeffects', 'rel', $settings['text_link']['nofollow'] );
            }
            ?>

            <a data-hover="<?php echo $settings['link_text']; ?>" <?php echo $this->get_render_attribute_string('mighty-linkeffects'); ?> >
                <span data-hover="<?php echo $settings['link_text']; ?>" class="link-text"><?php echo $settings['link_text']; ?></span>
            </a>
            <?php endif; ?>

            <?php if ( $settings['pre_text'] ) : ?>
            <span class="post-text text"><?php echo $settings['post_text']; ?></span>
            <?php endif; ?>

        </div>

        <?php
	}
	
	protected function _content_template() {
	}
}