<?php
namespace MightyAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils as Utils;
use Elementor\Repeater as Repeater;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;
use \Elementor\Scheme_Typography;
use \Elementor\Scheme_Color;
use Elementor\Icons_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor MT_ButtonGroup
 *
 * Elementor widget for MT_ButtonGroup.
 *
 * @since 1.0.0
 */
class MT_Buttongroup extends Widget_Base {
	
	public function get_name() {
		return 'mt-buttongroup';
	}
	
	public function get_title() {
		return __( 'Button Group', 'mighty' );
	}
	
	public function get_icon() {
		return 'mf mf-button';
	}

	public function get_categories() {
		return [ 'mighty-addons' ];
    }    
    
    public function get_keywords() {
		return [ 'mighty', 'button', 'group', 'action' ];
    }

	public function get_style_depends() {
		return [ 'mt-common', 'mt-buttongroup' ];
    }
	
	protected function _register_controls() {

        $this->start_controls_section(
			'section_buttongroup',
			[
				'label' => __( 'Button Group', 'mighty' ),
			]
		);

			$repeater = new Repeater();

			$repeater->start_controls_tabs( 'buttons' );

                $repeater->add_control(
                    'button_text',
                    [
                        'label' => __('Title', 'mighty'),
                        'type' => Controls_Manager::TEXT,
                        'default' => 'Click Here',
                    ]
                );
                
                $repeater->add_control(
                    'button_link',
                    [
                        'label' => __('Link', 'mighty'),
                        'type' => Controls_Manager::URL,
                        'dynamic' => [
                            'active' => true,
                        ],
                        'placeholder' => __('https://example.com', 'mighty'),
                        'show_external' => true,
                        'default' => [
                            'url' => '#',
                            'is_external' => true,
                            'nofollow' => true,
                        ],
                    ]
                );

                $repeater->add_control(
                    'button_icon',
                    [
                        'name' => 'button_icon',
                        'label' => __('Icon', 'mighty'),
                        'type' => \Elementor\Controls_Manager::ICONS,
                    ]
                );

                $repeater->add_control(
                    'button_icon_align',
                    [
                        'label' => __('Icon Alignment', 'mighty'),
                        'type' => \Elementor\Controls_Manager::CHOOSE,
                        'options' => [
                            'mighty-button-icon-left' => [
                                'title' => __('Left', 'mighty'),
                                'icon' => 'fa fa-align-left',
                            ],
                            'mighty-button-icon-right' => [
                                'title' => __('Right', 'mighty'),
                                'icon' => 'fa fa-align-right',
                            ],
                        ],
                        'default' => 'mighty-button-icon-left',
                        'toggle' => true,
                        'condition' => [
                            'button_icon!' => '',
                        ],
                    ]
                );
                
                $repeater->add_control(
                    'button_icon_spacing',
                    [
                        'label' => __('Icon Spacing', 'mighty'),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%' ],
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 200,
                            ],
                            '%' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'default' => [
                            'unit' => 'px',
                            'size' => 10,
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .mighty-buttongroup {{CURRENT_ITEM}} .mighty-button-icon-left .mighty-button-text' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: 0;',
                            '{{WRAPPER}} .mighty-buttongroup {{CURRENT_ITEM}} .mighty-button-text' => 'margin-right: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' => [
                            'button_icon!' => ''
                        ],
                    ]
                );
                
                $repeater->add_control(
                    'button_icon_animation',
                    [
                        'label' => __('Icon Animation', 'mighty'),
                        'type' => \Elementor\Controls_Manager::ANIMATION
                    ]
                );
                
                $repeater->add_control(
                    'button_size',
                    [
                        'label' => __('Button Size', 'mighty'),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'default' => 'ma-btn-md',
                        'options' => [
                            'mighty-button-sm' => __('Small', 'mighty'),
                            '' => __('Medium', 'mighty'),
                            'mighty-button-lg' => __('Large', 'mighty'),
                        ],
                    ]
                );

                $repeater->end_controls_tabs();

                // Two Tabs for styling
                $repeater->start_controls_tabs(
                    'style_tabs'
                );
                
                // Normal Styling
                $repeater->start_controls_tab(
                    'style_normal_tab',
                    [
                        'label' => __( 'Normal', 'mighty' ),
                    ]
                );
                
                    $repeater->add_control(
                        'buttongroup_text_color',
                        [
                            'label'     => __( 'Color', 'mighty' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .mighty-buttongroup {{CURRENT_ITEM}} a' => 'color: {{VALUES}}'
                            ]
                        ]
                    );

                    $repeater->add_control(
                        'buttongroup_bg_color',
                        [
                            'label'     => __( 'Background Color', 'mighty' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .mighty-buttongroup {{CURRENT_ITEM}} a' => 'background-color: {{VALUES}}'
                            ]
                        ]
                    );

                $repeater->end_controls_tab();
                
                // Hover styling
                $repeater->start_controls_tab(
                    'style_hover_tab',
                    [
                        'label' => __( 'Hover', 'mighty' ),
                    ]
                );

                    $repeater->add_control(
                        'buttongroup_hover_text_color',
                        [
                            'label'     => __( 'Color', 'mighty' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .mighty-buttongroup {{CURRENT_ITEM}} a:hover' => 'color: {{VALUES}}'
                            ]
                        ]
                    );

                    $repeater->add_control(
                        'buttongroup_hover_bg_color',
                        [
                            'label'     => __( 'Background Color', 'mighty' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .mighty-buttongroup {{CURRENT_ITEM}} a:hover' => 'background-color: {{VALUES}}'
                            ]
                        ]
                    );

                    $repeater->add_control(
                        'buttongroup_hover_border_color',
                        [
                            'label'     => __( 'Border Color', 'mighty' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .mighty-buttongroup {{CURRENT_ITEM}} a:hover' => 'border-color: {{VALUES}}'
                            ]
                        ]
                    );
                
                    $repeater->add_control(
                        'hover_animation',
                        [
                            'label' => __('Hover Animation', 'mighty'),
                            'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
                        ]
                    );

                $repeater->end_controls_tab();
                
                $repeater->end_controls_tabs();

                $repeater->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'border',
                        'label' => __( 'Border', 'mighty' ),
                        'selector' => '{{WRAPPER}} .mighty-buttongroup {{CURRENT_ITEM}} a',
                        'separator' => 'before',
                    ]
                );

                $repeater->add_control(
                    'buttongroup_border_radius',
                    [
                        'label' => __( 'Border Radius', 'mighty' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px' ],
                        'selectors' => [
                            '{{WRAPPER}} .mighty-buttongroup {{CURRENT_ITEM}} a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

                $repeater->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'buttongroup_btn_shadow',
                        'label' => __( 'Box Shadow', 'mighty' ),
                        'selector' => '{{WRAPPER}} .mighty-buttongroup {{CURRENT_ITEM}} a',
                    ]
                );

                $repeater->add_control(
                    'buttongroup_button_padding',
                    [
                        'label' => __( 'Button Padding', 'mighty' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px' ],
                        'default' => [
                            'top' =>  '',
                            'right' => '',
                            'bottom' => '',
                            'left' => '',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .mighty-buttongroup {{CURRENT_ITEM}} a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

                $repeater->add_group_control(
                    Group_Control_Typography::get_type(),
                    [
                        'name' => 'buttongroup_typography',
                        'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                        'selector' => '{{WRAPPER}} .mighty-buttongroup {{CURRENT_ITEM}} a',
                    ]
                );

                $repeater->add_control(
                    'button_css_id',
                    [
                        'label' => __('HTML ID', 'mighty'),
                        'type' => Controls_Manager::TEXT,
                        'default' => __('', 'mighty'),
                    ]
                );
                
                $repeater->add_control(
                    'button_css_class',
                    [
                        'label' => __('CSS Class', 'mighty'),
                        'type' => Controls_Manager::TEXT,
                    ]
                );
                
                $this->add_control(
                    'mt_buttongroup_btns',
                    [
                        'label' => __('Buttons', 'mighty'),
                        'type' => Controls_Manager::REPEATER,
                        'fields' => $repeater->get_controls(),
                        'default' => [
                            [
                                'button_text' => __('Click Here', 'mighty'),
                                'button_link' => '#',
                                'button_size' => '',
                                'buttongroup_bg_color' => '#5F6AE6',
                            ],
                            [
                                'button_text' => __('No, click here', 'mighty'),
                                'button_link' => '#',
                                'button_size' => '',
                                'buttongroup_bg_color' => '#2FCC71',
                            ],
                        ],
                        'title_field' => '{{{ button_text }}}',
                    ]
                );
			
            $repeater->end_controls_tabs();

        $this->end_controls_section();
        
        // Spacing
        $this->start_controls_section(
			'section_spacing',
			[
				'label' => __( 'Spacing', 'mighty' ),
			]
        );

            $this->add_responsive_control(
                'space_between_buttons',
                [
                    'label' => __( 'Spacing Between Buttons', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'size' => 20,
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mighty-buttongroup>*+*' => 'margin-left: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .mighty-buttongroup.mighty-buttongroup-stack-desktop>*+*' => 'margin-top: {{SIZE}}{{UNIT}}; margin-left:0;',
                        '(tablet) {{WRAPPER}} .mighty-buttongroup.mighty-buttongroup-stack-tablet>*+*' => 'margin-top: {{SIZE}}{{UNIT}}; margin-left:0;',
                        '(mobile) {{WRAPPER}} .mighty-buttongroup.mighty-buttongroup-stack-mobile>*+*' => 'margin-top: {{SIZE}}{{UNIT}}; margin-left:0;',
                    ],
                ]
            );

            $this->add_control(
				'buttongroup_stack_on',
				[
					'label' => __( 'Stack On', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'mighty-buttongroup-stack-none',
					'options' => [
						'mighty-buttongroup-stack-none' => __( 'None', 'mighty' ),
						'mighty-buttongroup-stack-desktop' => __( 'Desktop', 'mighty' ),
						'mighty-buttongroup-stack-tablet' => __( 'Tablet', 'mighty' ),
						'mighty-buttongroup-stack-mobile' => __( 'Mobile', 'mighty' ),
                    ],
				]
            );
            
            $this->add_control(
                'buttongroup_btns_align',
                [
                    'label' => __( 'Alignment', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'options' => [
                        'mighty-buttongroup-align-left' => [
                            'title' => __( 'Left', 'mighty' ),
                            'icon' => 'fa fa-align-left',
                        ],
                        'mighty-buttongroup-align-center' => [
                            'title' => __( 'Center', 'mighty' ),
                            'icon' => 'fa fa-align-center',
                        ],
                        'mighty-buttongroup-align-right' => [
                            'title' => __( 'Right', 'mighty' ),
                            'icon' => 'fa fa-align-right',
                        ],
                        'mighty-buttongroup-align-justify' => [
                            'title' => __( 'Justify', 'mighty' ),
                            'icon' => 'fa fa-align-justify',
                        ]
                    ],
                    'default' => 'mighty-buttongroup-align-left',
                ]
            );
        
        $this->end_controls_section();
	}
	
	protected function render() {
        $settings = $this->get_settings_for_display();

        if ( empty( $settings['mt_buttongroup_btns'] ) ) {
            return;
		}
        $stackButtons = (($settings['buttongroup_stack_on'] == "mighty-buttongroup-stack-none") ? '' : ' ' . $settings['buttongroup_stack_on'] . ' ');

        echo '<div class="mighty-buttongroup ' . $settings['buttongroup_stack_on'] . ' ' . $settings['buttongroup_btns_align'] . '">';
        foreach (  $settings['mt_buttongroup_btns'] as $btngrp ) :

            $target = $btngrp['button_link']['is_external'] ? ' target="_blank"' : '';
            $nofollow = $btngrp['button_link']['nofollow'] ? ' rel="nofollow"' : '';
            $url = $btngrp['button_link']['url'];
            $iconAnimation = (($btngrp['button_icon_animation'] !== 'none') ? 'animated '.$btngrp['button_icon_animation'] . ' ' : '');
            $buttonAnimation = (!empty($btngrp['hover_animation']) == true ? ' elementor-animation-'.$btngrp['hover_animation'] : '');
            $buttonSize = ' ' . $btngrp['button_size'];
            
            echo '<div ' . (($btngrp['button_css_id'] !== "") ? 'id="' . $btngrp['button_css_id'] . '" ' : '') . ' class="mighty-button ' . $settings['buttongroup_btns_align'] . ' elementor-repeater-item-'. $btngrp['_id'] . '">';
                echo '<a class="mighty-button-link ' . $btngrp['button_icon_align'] . $buttonAnimation . (($btngrp['button_css_class'] !== "") ? " " . $btngrp['button_css_class'] : '') . $buttonSize .'" href="' . $url . '" '. $target . $nofollow .'>';
                    echo '<span class="mighty-button-text">' . $btngrp['button_text'] . '</span>';
                    if ( ! empty( $btngrp['button_icon']['value'] ) || ! empty( $btngrp['button_icon']['url']) ) :
                        echo "<span class='mighty-button-icon " . $iconAnimation . "'>";
                        \Elementor\Icons_Manager::render_icon( $btngrp['button_icon'], [ 'aria-hidden' => 'true' ] );
                        echo "</span>";
                    endif;
                echo '</a>';
            echo '</div>';
        endforeach;
        echo '</div>';
	}
	
	protected function _content_template() {
	}
}