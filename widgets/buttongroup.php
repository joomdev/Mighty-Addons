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

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor MT_ButtonGroup
 *
 * Elementor widget for MT_ButtonGroup.
 *
 * @since 1.0.0
 */
class MT_ButtonGroup extends Widget_Base {
	
	public function get_name() {
		return 'mt-buttongroup';
	}
	
	public function get_title() {
		return __( 'MT Button Group', 'mighty' );
	}
	
	public function get_icon() {
		return 'mf mf-button';
	}

	public function get_categories() {
		return [ 'mighty-addons' ];
	}

	public function get_style_depends() {
		return [ 'mt-common', 'mt-buttongroup' ];
    }
	
	protected function _register_controls() {

        $this->start_controls_section(
			'section_buttongroup',
			[
				'label' => __( 'MT Button Group', 'mighty' ),
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
                            'left' => [
                                'title' => __('Left', 'mighty'),
                                'icon' => 'fa fa-align-left',
                            ],
                            'right' => [
                                'title' => __('Right', 'mighty'),
                                'icon' => 'fa fa-align-right',
                            ],
                        ],
                        'default' => 'left',
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
                        'range' => [
                            '%' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'default' => [
                            'unit' => 'px',
                            'size' => 0,
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .mighty-buttongroup {{CURRENT_ITEM}} i' => 'margin: 0 {{SIZE}}{{UNIT}};',
                        ],
                        'condition' => [
                            'button_icon!' => '',
                        ],
                    ]
                );
                
                $repeater->add_control(
                    'button_icon_animation',
                    [
                        'label' => __('Icon Animation', 'mighty'),
                        'type' => \Elementor\Controls_Manager::ANIMATION,
                    ]
                );
                
                $repeater->add_control(
                    'button_size',
                    [
                        'label' => __('Button Size', 'mighty'),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'default' => 'ma-btn-md',
                        'options' => [
                            'ma-btn-sm' => __('Small', 'mighty'),
                            'ma-btn-md' => __('Medium', 'mighty'),
                            'ma-btn-lg' => __('Large', 'mighty'),
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
                            'top' =>  '5',
                            'right' => '30',
                            'bottom' => '5',
                            'left' => '30',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .mighty-buttongroup {{CURRENT_ITEM}} a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

                $repeater->add_group_control(
                    Group_Control_Typography::get_type(),
                    [
                        'name' => 'testimonial_typography',
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
                                'button_size' => 'ma-btn-md',
                                'buttongroup_bg_color' => '#f96b77',
                            ],
                            [
                                'button_text' => __('Click Here', 'mighty'),
                                'button_link' => '#',
                                'button_size' => 'ma-btn-md',
                                'buttongroup_bg_color' => '#a652de',
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
                            'max' => 50,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 10,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mighty-buttongroup .mt-button:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}}',
                    ],
                ]
            );

            $this->add_control(
				'buttongroup_stack_on',
				[
					'label' => __( 'Stack On', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'none',
					'options' => [
						'none' => __( 'None', 'mighty' ),
						'stack-on-desktop' => __( 'Desktop', 'mighty' ),
						'stack-on-tablet' => __( 'Tablet', 'mighty' ),
						'stack-on-mobile' => __( 'Mobile', 'mighty' ),
					],
				]
            );
            
            $this->add_control(
                'buttongroup_btns_align',
                [
                    'label' => __( 'Alignment', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'mighty' ),
                            'icon' => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'mighty' ),
                            'icon' => 'fa fa-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'mighty' ),
                            'icon' => 'fa fa-align-right',
                        ],
                        'justify' => [
                            'title' => __( 'Justify', 'mighty' ),
                            'icon' => 'fa fa-align-justify',
                        ]
                    ],
                    'default' => 'left',
                ]
            );
        
        $this->end_controls_section();
	}
	
	protected function render() {
        $settings = $this->get_settings_for_display();

        if ( empty( $settings['mt_buttongroup_btns'] ) ) {
            return;
		}
        $stackButtons = (($settings['buttongroup_stack_on'] == "none") ? '' : ' ' . $settings['buttongroup_stack_on'] . ' ');

        echo '<div class="mighty-buttongroup ' . $stackButtons . 'mt-btng-align-'. $settings['buttongroup_btns_align'] .'">';

        foreach (  $settings['mt_buttongroup_btns'] as $btngrp ) :
            $target = $btngrp['button_link']['is_external'] ? ' target="_blank"' : '';
            $nofollow = $btngrp['button_link']['nofollow'] ? ' rel="nofollow"' : '';
            $url = $btngrp['button_link']['url'];
            $iconAnimation = (($btngrp['button_icon_animation'] !== 'none') ? 'animated '.$btngrp['button_icon_animation'] . ' ' : '');
            $buttonIcon = '<i aria-hidden="true" class="'. $iconAnimation . $btngrp['button_icon']['value'].'"></i>';
            $buttonAnimation = (!empty($btngrp['hover_animation']) == true ? ' elementor-animation-'.$btngrp['hover_animation'] : '');
            echo '<div class="mt-button elementor-repeater-item-'. $btngrp['_id'] . '">';

                echo '<a ' . (($btngrp['button_css_id'] !== "") ? 'id="' . $btngrp['button_css_id'] . '" ' : '') . 'class="ma-btn mighty-btn '. (($btngrp['button_css_class'] !== "") ? $btngrp['button_css_class'] ." " : '') . $btngrp['button_size'] . $buttonAnimation . '" '. $target . $nofollow .' href="'. $url . '">' . ( ($btngrp['button_icon_align']==="left") ? $buttonIcon . ' ' : '' ) . $btngrp['button_text'] . ( ($btngrp['button_icon_align']==="right") ? ' ' . $buttonIcon : '' ) .'</a>';

            echo '</div>'; // .mt-button
        endforeach;
        
        echo '</div>'; // .mighty-buttongroup
        
        
	}
	
	protected function _content_template() {
	}
}
