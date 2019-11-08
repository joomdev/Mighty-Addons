<?php
namespace MightyAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils as Utils;
use \Elementor\Group_Control_Typography;
use \Elementor\Scheme_Typography;
use \Elementor\Scheme_Color;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor MT_FlipBox
 *
 * Elementor widget for MT_FlipBox.
 *
 * @since 1.0.0
 */
class MT_FlipBox extends Widget_Base {
	
	public function get_name() {
		return 'mt-flip-box';
	}
	
	public function get_title() {
		return __( 'MT Flip Box', 'mighty' );
	}
	
	public function get_icon() {
		return 'fas fa-square';
	}

	public function get_categories() {
		return [ 'mighty-addons' ];
	}

	public function get_style_depends() {
		return [ 'mt-flipbox' ];
    }
	
	protected function _register_controls() {

        // Front
		$this->start_controls_section(
			'section_front',
			[
				'label' => __( 'Front', 'mighty' ),
			]
		);

            $this->add_control(
                'front_graphic_element',
                [
                    'label' => __( 'Graphic Element', 'mighty' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'icon',
                    'options' => [
                        'none'  => __( 'None', 'mighty' ),
                        'image' => __( 'Image', 'mighty' ),
                        'icon' => __( 'Icon', 'mighty' ),
                    ],
                ]
            );

            $this->add_control(
                'front_choose_image',
                [
                    'label' => __( 'Choose Image', 'mighty' ),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                    'condition' => [
                        'front_graphic_element' => 'image',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'front_image_dimension', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                    'default' => 'large',
                    'condition' => [
                        'front_graphic_element' => 'image',
                    ],
                ]
            );

            $this->add_control(
                'front_choose_icon',
                [
                    'label' => __( 'Icon', 'mighty' ),
                    'type' => Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-star',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'front_graphic_element' => 'icon',
                    ],
                ]
            );

            $this->add_control(
                'front_title',
                [
                    'label' => __( 'Title', 'mighty' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => __( 'Front Title', 'mighty' ),
                    'default' => __( 'Front Title', 'mighty'),
                ]
            );

            $this->add_control(
                'front_description',
                [
                    'label' => __( 'Description', 'mighty' ),
                    'type' => Controls_Manager::WYSIWYG,
                    'placeholder' => __( 'Type your description here', 'mighty' ),
                    'default' => __( 'Front box description', 'mighty'),
                ]
            );

            $this->add_control(
                'front_horizontal_alignment',
                [
                    'label' => __( 'Horizontal Alignment', 'mighty' ),
                    'type' => Controls_Manager::CHOOSE,
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
                        '{{WRAPPER}} .mt-flipbox-wrapper .front' => "text-align: {{VALUE}}",
                    ]
                ]
            );

            $this->add_control(
                'front_vertical_alignment',
                [
                    'label' => __( 'Vertical Alignment', 'mighty' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'mt-justify-content-start' => [
                            'title' => __( 'Top', 'mighty' ),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'mt-justify-content-center' => [
                            'title' => __( 'Middle', 'mighty' ),
                            'icon' => 'eicon-v-align-middle',
                        ],
                        'mt-justify-content-end' => [
                            'title' => __( 'Bottom', 'mighty' ),
                            'icon' => 'eicon-v-align-bottom',
                        ],
                    ],
                    'default' => 'middle',
                    'toggle' => true,
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'front_background',
                    'label' => __( 'Background', 'mighty' ),
                    'selector' => '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .front',
                ]
            );

        $this->end_controls_section();

        // Back
        $this->start_controls_section(
			'section_back',
			[
				'label' => __( 'Back', 'mighty' ),
			]
		);

            $this->add_control(
                'back_graphic_element',
                [
                    'label' => __( 'Graphic Element', 'mighty' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'icon',
                    'options' => [
                        'none'  => __( 'None', 'mighty' ),
                        'image' => __( 'Image', 'mighty' ),
                        'icon' => __( 'Icon', 'mighty' ),
                    ],
                ]
            );

            $this->add_control(
                'back_choose_image',
                [
                    'label' => __( 'Choose Image', 'mighty' ),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                    'condition' => [
                        'back_graphic_element' => 'image',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'back_choose_image_size',
                    'default' => 'large',
                    'condition' => [
                        'back_graphic_element' => 'image',
                    ],
                ]
            );

            $this->add_control(
                'back_choose_icon',
                [
                    'label' => __( 'Icon', 'mighty' ),
                    'type' => Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-star',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'back_graphic_element' => 'icon',
                    ],
                ]
            );

            $this->add_control(
                'back_title',
                [
                    'label' => __( 'Title', 'mighty' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => __( 'Back Title', 'mighty' ),
                    'default' => __( 'Back Title', 'mighty'),
                ]
            );

            $this->add_control(
                'back_description',
                [
                    'label' => __( 'Description', 'mighty' ),
                    'type' => Controls_Manager::WYSIWYG,
                    'placeholder' => __( 'Type your description here', 'mighty' ),
                    'default' => __( 'Back box description', 'mighty'),
                ]
            );

            $this->add_control(
                'back_button_text',
                [
                    'label' => __( 'Button Text', 'mighty' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'Click Here', 'mighty' ),
                    'placeholder' => __( 'Enter Button Text', 'mighty' ),
                ]
            );

            $this->add_control(
                'back_button_link',
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
                'back_horizontal_alignment',
                [
                    'label' => __( 'Horizontal Alignment', 'mighty' ),
                    'type' => Controls_Manager::CHOOSE,
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
                        '{{WRAPPER}} .mt-flipbox-wrapper .back' => "text-align: {{VALUE}}",
                    ]
                ]
            );

            $this->add_control(
                'back_vertical_alignment',
                [
                    'label' => __( 'Vertical Alignment', 'mighty' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'mt-justify-content-start' => [
                            'title' => __( 'Top', 'mighty' ),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'mt-justify-content-center' => [
                            'title' => __( 'Middle', 'mighty' ),
                            'icon' => 'eicon-v-align-middle',
                        ],
                        'mt-justify-content-end' => [
                            'title' => __( 'Bottom', 'mighty' ),
                            'icon' => 'eicon-v-align-bottom',
                        ],
                    ],
                    'default' => 'middle',
                    'toggle' => true,
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'back_background',
                    'label' => __( 'Background', 'mighty' ),
                    'selector' => '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .back',
                ]
            );

        $this->end_controls_section();

        // Common Settings
        $this->start_controls_section(
			'section_common_settings',
			[
				'label' => __( 'Common Settings', 'mighty' ),
			]
        );

            $this->add_control(
                'flip_effect',
                [
                    'label' => __( 'Flip Effect', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'flip',
                    'options' => [
                        'flip'  => __( 'Flip', 'mighty' ),
                        'slide' => __( 'Slide', 'mighty' ),
                        'push' => __( 'Push', 'mighty' ),
                        'zoom-in' => __( 'Zoom In', 'mighty' ),
                        'zoom-out' => __( 'Zoom Out', 'mighty' ),
                        'fade' => __( 'Fade', 'mighty' ),
                    ],
                ]
            );

            $this->add_control(
                'flip_direction',
                [
                    'label' => __( 'Flip Direction', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'left',
                    'options' => [
                        'up'  => __( 'Up', 'mighty' ),
                        'down' => __( 'Down', 'mighty' ),
                        'left' => __( 'Left', 'mighty' ),
                        'right' => __( 'Right', 'mighty' ),
                    ],
                ]
            );

            $this->add_responsive_control(
                'flipbox_height',
                [
                    'label' => __( 'Height', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', 'vh' ],
                    'range' => [
                        'px' => [
                            'min' => 100,
                            'max' => 1000,
                            'step' => 5,
                        ],
                        'vh' => [
                            'min' => 10,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 200,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mt-flipbox-wrapper .mt-card' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'flipbox_border_radius',
                [
                    'label' => __( 'Border Radius', 'mighty' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px' ],
                    'selectors' => [
                        '{{WRAPPER}} .mt-flipbox-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        
        $this->end_controls_section();
        
        // Front Styling
        $this->start_controls_section(
            'section_flipbox_front_style',
            [
                'label' => __( 'Front', 'mighty' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_responsive_control(
                'front_padding',
                [
                    'label' => __( 'Padding', 'mighty' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px' ],
                    'selectors' => [
                        '{{WRAPPER}} .mt-flipbox-wrapper .mt-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'front_card',
                    'label' => __( 'Border', 'mighty' ),
                    'selector' => '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .front',
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'front_box_shadow',
                    'label' => __( 'Box Shadow', 'mighty' ),
                    'selector' => '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .front',
                ]
            );

            // Icon Styling for Front
            $this->add_control(
                'heading_front_icon_style',
                [
                    'type' => Controls_Manager::HEADING,
                    'label' => __( 'Icon', 'mighty' ),
                    'condition' => [
                        'front_graphic_element' => 'icon',
                    ],
                    'separator' => 'before',
                ]
            );
            
            $this->add_control(
                'front_icon_spacing',
                [
                    'label' => __( 'Icon Spacing', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ]
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 20,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .front .mt-flipbox-icon i' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .front .mt-flipbox-icon svg' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'front_graphic_element' => 'icon',
                    ],
                ]
            );

            $this->add_control(
                'front_icon_color',
                [
                    'label' => __( 'Icon Color', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Scheme_Color::get_type(),
                        'value' => \Elementor\Scheme_Color::COLOR_1,
                    ],
                    'default' => '#562dd4',
                    'selectors' => [
                        '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .front .mt-flipbox-icon i' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .front .mt-flipbox-icon svg' => 'color: {{VALUE}}',
                    ],
                    'condition' => [
                        'front_graphic_element' => 'icon',
                    ],
                ]
            );

            $this->add_control(
                'front_icon_size',
                [
                    'label' => __( 'Icon Size', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 5,
                            'max' => 600,
                            'step' => 1,
                        ]
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 50,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .front .mt-flipbox-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .front .mt-flipbox-icon svg' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'front_graphic_element' => 'icon',
                    ],
                ]
            );

            $this->add_control(
                'front_icon_bgcolor',
                [
                    'label' => __( 'Background Color', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Scheme_Color::get_type(),
                        'value' => \Elementor\Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .front .mt-flipbox-icon i' => 'background-color: {{VALUE}}',
                        '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .front .mt-flipbox-icon svg' => 'background-color: {{VALUE}}',
                    ],
                    'condition' => [
                        'front_graphic_element' => 'icon',
                    ],
                ]
            );

            $this->add_responsive_control(
                'front_icon_padding',
                [
                    'label' => __( 'Padding', 'mighty' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px' ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 10,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .front .mt-flipbox-icon i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .front .mt-flipbox-icon svg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'front_graphic_element' => 'icon',
                    ],
                ]
            );

            $this->add_control(
                'front_icon_rotate',
                [
                    'label' => __( 'Icon Rotate', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 360,
                            'step' => 1,
                        ]
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .front .mt-flipbox-icon i' => 'transform: rotate({{SIZE}}deg);',
					    '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .front .mt-flipbox-icon svg' => 'transform: rotate({{SIZE}}deg);',
                    ],
                    'condition' => [
                        'front_graphic_element' => 'icon',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'front_icon_border',
                    'label' => __( 'Border', 'mighty' ),
                    'selector' => '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .front .mt-flipbox-icon i',
                    'condition' => [
                        'front_graphic_element' => 'icon',
                    ],
                ]
            );

            $this->add_control(
                'front_icon_border_radius',
                [
                    'label' => __( 'Border Radius', 'mighty' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px' ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 50,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .front .mt-flipbox-icon i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            // Image Styling for Front
            $this->add_control(
                'heading_front_image_style',
                [
                    'type' => Controls_Manager::HEADING,
                    'label' => __( 'Image', 'mighty' ),
                    'condition' => [
                        'front_graphic_element' => 'image',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'front_image_spacing',
                [
                    'label' => __( 'Image Spacing', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ]
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 10,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .front .mt-flipbox-image img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'front_graphic_element' => 'image',
                    ],
                ]
            );
            
            $this->add_control(
                'front_image_size',
                [
                    'label' => __( 'Image Size', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 10,
                            'max' => 500,
                            'step' => 1,
                        ]
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 70,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .front .mt-flipbox-image img' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'front_graphic_element' => 'image',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'front_image_padding',
                [
                    'label' => __( 'Padding', 'mighty' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px' ],
                    'selectors' => [
                        '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .front .mt-flipbox-image img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'front_graphic_element' => 'image',
                    ],
                ]
            );
            
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'front_image_border',
                    'label' => __( 'Border', 'mighty' ),
                    'selector' => '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .front .mt-flipbox-image img',
                    'condition' => [
                        'front_graphic_element' => 'image',
                    ],
                ]
            );

            $this->add_responsive_control(
                'front_border_radius',
                [
                    'label' => __( 'Border Radius', 'mighty' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px' ],
                    'selectors' => [
                        '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .front .mt-flipbox-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'front_graphic_element' => 'image',
                    ],
                ]
            );

            // Title Styling for Front
            $this->add_control(
                'heading_front_title_style',
                [
                    'type' => Controls_Manager::HEADING,
                    'label' => __( 'Title', 'mighty' ),
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'front_title_spacing',
                [
                    'label' => __( 'Spacing', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ]
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 10,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .front .mt-front-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ]
                ]
            );

            $this->add_control(
                'front_title_color',
                [
                    'label' => __( 'Title Color', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Scheme_Color::get_type(),
                        'value' => \Elementor\Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .front .mt-front-title' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'front_title_typography',
                    'label' => __( 'Typography', 'mighty' ),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .front .mt-front-title',
                ]
            );

            // Description Styling for Front
            $this->add_control(
                'heading_front_description_style',
                [
                    'type' => Controls_Manager::HEADING,
                    'label' => __( 'Description', 'mighty' ),
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'front_description_color',
                [
                    'label' => __( 'Description Color', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Scheme_Color::get_type(),
                        'value' => \Elementor\Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .front .card-description' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'front_description_typography',
                    'label' => __( 'Typography', 'mighty' ),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .front .card-description',
                ]
            );

        $this->end_controls_section();

        // Back Styling
        $this->start_controls_section(
            'section_flipbox_back_style',
            [
                'label' => __( 'Back', 'mighty' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_responsive_control(
                'back_padding',
                [
                    'label' => __( 'Padding', 'mighty' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px' ],
                    'selectors' => [
                        '{{WRAPPER}} .mt-flipbox-wrapper .mt-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'back_card',
                    'label' => __( 'Border', 'mighty' ),
                    'selector' => '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .back',
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'back_box_shadow',
                    'label' => __( 'Box Shadow', 'mighty' ),
                    'selector' => '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .back',
                ]
            );

            // Icon Styling for Back
            $this->add_control(
                'heading_back_icon_style',
                [
                    'type' => Controls_Manager::HEADING,
                    'label' => __( 'Icon', 'mighty' ),
                    'condition' => [
                        'back_graphic_element' => 'icon',
                    ],
                    'separator' => 'before',
                ]
            );
            
            $this->add_control(
                'back_icon_spacing',
                [
                    'label' => __( 'Icon Spacing', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ]
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 10,
                    ],                    
                    'selectors' => [
                        '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .back .mt-flipbox-icon i' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .back .mt-flipbox-icon svg' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'back_graphic_element' => 'icon',
                    ],
                ]
            );

            $this->add_control(
                'back_icon_color',
                [
                    'label' => __( 'Icon Color', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Scheme_Color::get_type(),
                        'value' => \Elementor\Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .back .mt-flipbox-icon i' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .back .mt-flipbox-icon svg' => 'color: {{VALUE}}',
                    ],
                    'condition' => [
                        'back_graphic_element' => 'icon',
                    ],
                ]
            );

            $this->add_control(
                'back_icon_size',
                [
                    'label' => __( 'Icon Size', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 5,
                            'max' => 600,
                            'step' => 1,
                        ]
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 50,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .back .mt-flipbox-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .back .mt-flipbox-icon svg' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'back_graphic_element' => 'icon',
                    ],
                ]
            );

            $this->add_control(
                'back_icon_bgcolor',
                [
                    'label' => __( 'Background Color', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Scheme_Color::get_type(),
                        'value' => \Elementor\Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .back .mt-flipbox-icon i' => 'background-color: {{VALUE}}',
                        '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .back .mt-flipbox-icon svg' => 'background-color: {{VALUE}}',
                    ],
                    'condition' => [
                        'back_graphic_element' => 'icon',
                    ],
                ]
            );

            $this->add_responsive_control(
                'back_icon_padding',
                [
                    'label' => __( 'Padding', 'mighty' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px' ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 10,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .back .mt-flipbox-icon i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .back .mt-flipbox-icon svg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'back_graphic_element' => 'icon',
                    ],
                ]
            );

            $this->add_control(
                'back_icon_rotate',
                [
                    'label' => __( 'Icon Rotate', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 360,
                            'step' => 1,
                        ]
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .back .mt-flipbox-icon i' => 'transform: rotate({{SIZE}}deg);',
					    '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .back .mt-flipbox-icon svg' => 'transform: rotate({{SIZE}}deg);',
                    ],
                    'condition' => [
                        'back_graphic_element' => 'icon',
                    ],
                ]
            );
            
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'back_icon_border',
                    'label' => __( 'Border', 'mighty' ),
                    'selector' => '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .back .mt-flipbox-icon i',
                    'condition' => [
                        'back_graphic_element' => 'icon',
                    ],
                ]
            );

            $this->add_control(
                'back_icon_border_radius',
                [
                    'label' => __( 'Border Radius', 'mighty' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px' ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 50,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .back .mt-flipbox-icon i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            // Image Styling for Back
            $this->add_control(
                'heading_back_image_style',
                [
                    'type' => Controls_Manager::HEADING,
                    'label' => __( 'Image', 'mighty' ),
                    'condition' => [
                        'back_graphic_element' => 'image',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'back_image_spacing',
                [
                    'label' => __( 'Image Spacing', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ]
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 10,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .back .mt-flipbox-image img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'back_graphic_element' => 'image',
                    ],
                ]
            );
            
            $this->add_control(
                'back_image_size',
                [
                    'label' => __( 'Image Size', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 10,
                            'max' => 500,
                            'step' => 1,
                        ]
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 50,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .back .mt-flipbox-image img' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'back_graphic_element' => 'image',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'back_image_padding',
                [
                    'label' => __( 'Padding', 'mighty' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px' ],
                    'selectors' => [
                        '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .back .mt-flipbox-image img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'back_graphic_element' => 'image',
                    ],
                ]
            );
            
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'back_image_border',
                    'label' => __( 'Border', 'mighty' ),
                    'selector' => '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .back .mt-flipbox-image img',
                    'condition' => [
                        'back_graphic_element' => 'image',
                    ],
                ]
            );

            $this->add_responsive_control(
                'back_border_radius',
                [
                    'label' => __( 'Border Radius', 'mighty' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px' ],
                    'selectors' => [
                        '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .back .mt-flipbox-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'back_graphic_element' => 'image',
                    ],
                ]
            );

            // Title Styling for Back
            $this->add_control(
                'heading_back_title_style',
                [
                    'type' => Controls_Manager::HEADING,
                    'label' => __( 'Title', 'mighty' ),
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'back_title_spacing',
                [
                    'label' => __( 'Spacing', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ]
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 10,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .back .mt-back-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ]
                ]
            );

            $this->add_control(
                'back_title_color',
                [
                    'label' => __( 'Title Color', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Scheme_Color::get_type(),
                        'value' => \Elementor\Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .back .mt-back-title' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'back_title_typography',
                    'label' => __( 'Typography', 'mighty' ),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .back .mt-back-title',
                ]
            );

            // Description Styling for Back
            $this->add_control(
                'heading_back_description_style',
                [
                    'type' => Controls_Manager::HEADING,
                    'label' => __( 'Description', 'mighty' ),
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'back_description_color',
                [
                    'label' => __( 'Description Color', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Scheme_Color::get_type(),
                        'value' => \Elementor\Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .back .card-description' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'back_description_typography',
                    'label' => __( 'Typography', 'mighty' ),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .back .card-description',
                ]
            );

            // Button Styling for Back
            $this->add_control(
                'heading_back_button_style',
                [
                    'type' => Controls_Manager::HEADING,
                    'label' => __( 'Button', 'mighty' ),
                    'separator' => 'before',
                    'condition' => [
                        'back_button_text!' => '',
                    ]
                ]
            );

            $this->add_control(
                'button_size',
                [
                    'label' => __('Button Size', 'mighty'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'btn-md',
                    'options' => [
                        'btn-sm' => __('Small', 'mighty'),
                        'btn-md' => __('Medium', 'mighty'),
                        'btn-lg' => __('Large', 'mighty'),
                    ],
                ]
            );
            
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'button_typogrpahy',
                    'label' => __( 'Typography', 'mighty' ),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .back .card-button a',
                ]
            );

            $this->add_control(
                'button_text_color',
                [
                    'label' => __( 'Text Color', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Scheme_Color::get_type(),
                        'value' => \Elementor\Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .back .card-button a' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'button_bg_color',
                [
                    'label' => __( 'Background Color', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Scheme_Color::get_type(),
                        'value' => \Elementor\Scheme_Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .back .card-button a' => 'background-color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'border',
                    'label' => __( 'Border', 'mighty' ),
                    'selector' => '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .back .card-button a',
                ]
            );

            $this->add_responsive_control(
                'button_border-radius',
                [
                    'label' => __( 'Border Radius', 'mighty' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px' ],
                    'selectors' => [
                        '{{WRAPPER}} .mt-flipbox-wrapper .mt-card .back .card-button a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();
	}
	
	protected function render() {
        $settings = $this->get_settings_for_display();

        // Effects
        $effect = "";
        $flipEffect = $settings['flip_effect'];
        if ( $flipEffect == "flip" || $flipEffect == "slide" || $flipEffect == "push" ) {
            $effect = $flipEffect . "-" . $settings['flip_direction'];
        } else {
            $effect = $flipEffect;
        }
    ?>
        <div class="mt-flipbox-wrapper <?php echo $effect; ?>">
            <div class="mt-card">

                <div class="front">
                    <?php if( $settings['front_graphic_element'] == 'image' ) : ?>
                    <div class="mt-flipbox-image">
                        <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'front_image_dimension', 'front_choose_image' ); ?>
                    </div>
                    <?php endif; ?>

                    <?php if( $settings['front_graphic_element'] == 'icon' ) : ?>
                    <div class="mt-flipbox-icon">
                        <?php \Elementor\Icons_Manager::render_icon( $settings['front_choose_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    </div>
                    <?php endif; ?>
                    
                    <h3 class="mt-front-title"><?php echo $settings['front_title']; ?></h3>
                    <div class="card-description">
                        <?php echo $settings['front_description']; ?>
                    </div>
                </div>

                <div class="back">
                    <?php if( $settings['back_graphic_element'] == 'image' ) : ?>
                    <div class="mt-flipbox-image">
                        <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'back_image_dimension', 'back_choose_image' ); ?>
                    </div>
                    <?php endif; ?>

                    <?php if( $settings['back_graphic_element'] == 'icon' ) : ?>
                    <div class="mt-flipbox-icon">
                        <?php \Elementor\Icons_Manager::render_icon( $settings['back_choose_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    </div>
                    <?php endif; ?>
                    
                    <h3 class="mt-back-title"><?php echo $settings['back_title']; ?></h3>
                    <div class="card-description">
                        <?php echo $settings['back_description']; ?>
                    </div>

                    <div class="card-button">
                    <?php
                        $target = $settings['back_button_link']['is_external'] ? ' target="_blank"' : '';
		                $nofollow = $settings['back_button_link']['nofollow'] ? ' rel="nofollow"' : '';
                        echo '<a class="btn ' . $settings['button_size'] . '" href="' . $settings['back_button_link']['url'] . '"' . $target . $nofollow . '>' . $settings['back_button_text'] .'</a>';
                    ?>
                    </div>
                </div>
            </div>
        </div>
    <?php
	}
	
	protected function _content_template() {
	}
}
