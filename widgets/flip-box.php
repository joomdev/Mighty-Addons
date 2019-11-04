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
		return 'flip-box';
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
                    'name' => 'front_choose_image_size', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
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
                ]
            );

            $this->add_control(
                'front_description',
                [
                    'label' => __( 'Description', 'mighty' ),
                    'type' => Controls_Manager::WYSIWYG,
                    'placeholder' => __( 'Type your description here', 'mighty' ),
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
                ]
            );

            $this->add_control(
                'front_vertical_alignment',
                [
                    'label' => __( 'Vertical Alignment', 'mighty' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Top', 'mighty' ),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'middle' => [
                            'title' => __( 'Middle', 'mighty' ),
                            'icon' => 'eicon-v-align-middle',
                        ],
                        'right' => [
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
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .mt-flipbox-wrapper',
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
                    'placeholder' => __( 'Front Title', 'mighty' ),
                ]
            );

            $this->add_control(
                'back_description',
                [
                    'label' => __( 'Description', 'mighty' ),
                    'type' => Controls_Manager::WYSIWYG,
                    'placeholder' => __( 'Type your description here', 'mighty' ),
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
                ]
            );

            $this->add_control(
                'back_vertical_alignment',
                [
                    'label' => __( 'Vertical Alignment', 'mighty' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Top', 'mighty' ),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'middle' => [
                            'title' => __( 'Middle', 'mighty' ),
                            'icon' => 'eicon-v-align-middle',
                        ],
                        'right' => [
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
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .mt-flipbox-wrapper',
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
                        'size' => 50,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mt-flipbox-wrapper' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'flipbox_radius',
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
        
        $this->start_controls_section(
            'section_gh_style',
            [
                'label' => __( 'Gradient Heading', 'mighty' ),
                'tab' => Controls_Manager::TAB_STYLE,
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
