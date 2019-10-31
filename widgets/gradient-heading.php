<?php
namespace MightyAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils as Utils;
use \Elementor\Group_Control_Typography;
use \Elementor\Scheme_Typography;
use \Elementor\Scheme_Color;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Text_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor MT_GradientHeading
 *
 * Elementor widget for MT_GradientHeading.
 *
 * @since 1.0.0
 */
class MT_GradientHeading extends Widget_Base {
	
	public function get_name() {
		return 'gradient-heading';
	}
	
	public function get_title() {
		return __( 'MT Gradient Heading', 'mighty' );
	}
	
	public function get_icon() {
		return 'fas fa-heading';
	}

	public function get_categories() {
		return [ 'mighty-addons' ];
	}

	public function get_style_depends() {
		return [ 'mt-gradientheading' ];
    }
	
	protected function _register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'MT Gradient Heading', 'mighty' ),
			]
		);

            $this->add_control(
                'gh_heading',
                [
                    'label' => __( 'Title', 'mighty' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => 'Mighty Gradient Heading..',
                ]
            );

            $this->add_control(
                'gh_link',
                [
                    'label' => __( 'Link', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::URL,
                    'placeholder' => __( 'https://your-link.com', 'mighty' ),
                    'show_external' => true,
                    'default' => [
                        'url' => '',
                        'is_external' => true,
                        'nofollow' => true,
                    ],
                ]
            );

            $this->add_control(
                'gh_title_tag',
                [
                    'label' => __( 'Title HTML Tag', 'mighty' ),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'h1' => 'H1',
                        'h2' => 'H2',
                        'h3' => 'H3',
                        'h4' => 'H4',
                        'h5' => 'H5',
                        'h6' => 'H6',
                    ],
                    'default' => 'h3',
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'gh_heading_align',
                [
                    'label' => __( 'Heading Alignment', 'mighty' ),
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
                    ],
                    'default' => 'center',
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .mighty-gradient-heading' => 'text-align: {{VALUE}}',
                    ],
                ]
            );

        $this->end_controls_section();
        
        $this->start_controls_section(
            'section_gh_style',
            [
                'label' => __( 'Gradient Heading', 'mighty' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'gh_heading_color',
                    'selector' => '{{WRAPPER}} .mighty-gradient-heading',
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'gh_heading_typography',
                    'label' => __( 'Typography', 'mighty' ),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .mighty-gradient-heading',
                ]
            );
            
            $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),
                [
                    'name' => 'gh_heading_shadow',
                    'label' => __( 'Text Shadow', 'mighty' ),
                    'selector' => '{{WRAPPER}} .mighty-gradient-heading',
                ]
            );

            
            $this->add_control(
                'gh_blend_mode',
                [
                    'label' => __( 'Blend Mode', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'solid',
                    'options' => [
                        'normal'  => __( 'Normal', 'mighty' ),
                        'screen' => __( 'Screen', 'mighty' ),
                        'overlay' => __( 'Overlay', 'mighty' ),
                        'darken' => __( 'Darken', 'mighty' ),
                        'color-dodge' => __( 'Color Dodge', 'mighty' ),
                        'color-burn' => __( 'Color Burn', 'mighty' ),
                        'hard-light' => __( 'Hard Light', 'mighty' ),
                        'soft-light' => __( 'Soft Light', 'mighty' ),
                        'difference' => __( 'Difference', 'mighty' ),
                        'exclusion' => __( 'Exlusion', 'mighty' ),
                        'hue' => __( 'Hue', 'mighty' ),
                        'saturation' => __( 'Saturation', 'mighty' ),
                        'color' => __( 'Color', 'mighty' ),
                        'luminosity' => __( 'Luminosity', 'mighty' ),
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mighty-gradient-heading' => 'mix-blend-mode: {{VALUE}}'
                    ],
                ]
            );
        
        $this->end_controls_section();
	}
	
	protected function render() {
        $settings = $this->get_settings_for_display();
        
            
	}
	
	protected function _content_template() {
	}
}
