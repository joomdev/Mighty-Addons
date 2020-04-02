<?php
namespace MightyAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils as Utils;
use \Elementor\Group_Control_Typography;
use \Elementor\Scheme_Typography;
use \Elementor\Scheme_Color;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Control_Media;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor MT_Counter
 *
 * Elementor widget for MT_Counter.
 *
 * @since 1.0.0
 */
class MT_Beforeafter extends Widget_Base {
	
	public function get_name() {
		return 'mt-before-after';
	}
	
	public function get_title() {
		return __( 'Before After', 'mighty' );
	}
	
	public function get_icon() {
		return 'mf mf-beforeafter';
	}

	public function get_categories() {
		return [ 'mighty-addons' ];
    }
    
    public function get_keywords() {
		return [ 'mighty', 'beforeafter', 'compare', 'slider' ];
    }

	public function get_style_depends() {
		return [ 'mt-beforeafter' ];
    }
    
    public function get_script_depends() {
		return [ 'mt-eventmove', 'mt-twentytwenty', 'mt-beforeafter' ];
	}
	
	protected function _register_controls() {
        // Before Image ops
		$this->start_controls_section(
			'section_content_before',
			[
				'label' => __( 'Before', 'mighty' ),
			]
        );

            $this->add_control(
                'before_image',
                [
                    'label' => __( 'Choose Before Image', 'mighty' ),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'before_image_size', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                    'default' => 'full',
                    'separator' => 'none',
                ]
            );

            $this->add_control(
                'before_label',
                [
                    'label' => __( 'Label', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => __( 'Before', 'mighty' ),
                    'placeholder' => __( 'Type your title here', 'mighty' ),
                ]
            );

        $this->end_controls_section();
        
        // After image ops
        $this->start_controls_section(
			'section_content_after',
			[
				'label' => __( 'After', 'mighty' ),
			]
        );

            $this->add_control(
                'after_image',
                [
                    'label' => __( 'Choose After Image', 'mighty' ),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'after_image_size', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                    'default' => 'full',
                    'separator' => 'none',
                ]
            );

            $this->add_control(
                'after_label',
                [
                    'label' => __( 'Label', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => __( 'After', 'mighty' ),
                    'placeholder' => __( 'Type your title here', 'mighty' ),
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
			'section_orientation_style',
			[
				'label' => __( 'Orientation', 'mighty' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
        );

            $this->add_control(
                'beforeafter_orientation',
                [
                    'label' => __( 'Slider Orientation', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'horizontal',
                    'options' => [
                        'horizontal'  => __( 'Horizontal', 'mighty' ),
                        'vertical' => __( 'Vertical', 'mighty' ),
                    ],
                ]
            );

            $this->add_control(
                'move_on_hover',
                [
                    'label' => __( 'Move On Hover', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => __( 'On', 'mighty' ),
                    'label_off' => __( 'Off', 'mighty' ),
                    'return_value' => 'true',
                    'default' => 'false',
                ]
            );

            $this->add_control(
                'enable_overlay',
                [
                    'label' => __( 'Enable Overlay', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => __( 'On', 'mighty' ),
                    'label_off' => __( 'Off', 'mighty' ),
                    'return_value' => 'true',
                    'default' => 'true',
                ]
            );

            $this->add_control(
                'beforeafter_overlay',
                [
                    'label' => __( 'Overlay Color', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .mighty-before-after .twentytwenty-overlay:hover' => 'background: {{VALUE}}',
                        '{{WRAPPER}} .mighty-before-after .inverted-overlay:hover' => 'background: {{VALUE}}',
                    ],
                    'default' => 'rgba(98,55,206,0.44)',
                    'condition' => [
                        'enable_overlay' => 'true',
                    ],
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
			'section_comparison_style',
			[
				'label' => __( 'Comparison Handle', 'mighty' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
        );

            $this->add_control(
                'handle_initial_offset',
                [
                    'label' => __( 'Handle Initial Offset', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ '%' ],
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 50,
                    ]
                ]
            );

            $this->add_control(
                'handle_color',
                [
                    'label' => __( 'Handle Color', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'default' => '#fff',
                    'selectors' => [
                        '{{WRAPPER}} .mighty-before-after .twentytwenty-handle' => 'border-color: {{VALUE}}',
                        '{{WRAPPER}} .mighty-before-after .twentytwenty-handle:before' => 'background: {{VALUE}}; box-shadow: 0 3px 0 {{VALUE}}, 0px 0px 12px rgba(51, 51, 51, 0.5);',
                        '{{WRAPPER}} .mighty-before-after .twentytwenty-handle:after' => 'background: {{VALUE}}; box-shadow: 0 3px 0 {{VALUE}}, 0px 0px 12px rgba(51, 51, 51, 0.5);',
                        '{{WRAPPER}} .mighty-before-after .twentytwenty-handle i' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'handle_thickness',
                [
                    'label' => __( 'Handle Thickness', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 10,
                            'step' => 1,
                        ]
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 4,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mighty-before-after .twentytwenty-handle' => 'border-width: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .twentytwenty-horizontal .mighty-before-after .twentytwenty-handle:before' => 'width: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .twentytwenty-horizontal .mighty-before-after .twentytwenty-handle:after' => 'width: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .twentytwenty-vertical .mighty-before-after .twentytwenty-handle:before' => 'height: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .twentytwenty-vertical .mighty-before-after .twentytwenty-handle:after' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'circle_width',
                [
                    'label' => __( 'Circle Width', 'mighty' ),
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
                        'size' => 40,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mighty-before-after .twentytwenty-handle' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'arrows_size',
                [
                    'label' => __( 'Arrows Size', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ]
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 10,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mighty-before-after .twentytwenty-handle i' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
			'section_ba_label_style',
			[
				'label' => __( 'Before/After Label', 'mighty' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
        );

            $this->add_control(
                'show_label_on',
                [
                    'label' => __( 'Show Label On', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'always',
                    'options' => [
                        'normal'  => __( 'Normal', 'mighty' ),
                        'hover' => __( 'Hover', 'mighty' ),
                        'always' => __( 'Always', 'mighty' ),
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'ba_label_typography',
                    'label' => __( 'Typography', 'mighty' ),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selectors' => [
                        '{{WRAPPER}} .twentytwenty-wrapper .mighty-before-after .twentytwenty-overlay div:before',
                        '{{WRAPPER}} .twentytwenty-wrapper .mighty-before-after .inverted-overlay div:before'
                    ]
                ]
            );

            $this->add_control(
                'label_color',
                [
                    'label' => __( 'Label Color', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'default' => '#ffffff',
                    'selectors' => [
                        '{{WRAPPER}} .twentytwenty-wrapper .mighty-before-after .twentytwenty-overlay div:before' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .twentytwenty-wrapper .mighty-before-after .inverted-overlay div:before' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'label_bg_color',
                [
                    'label' => __( 'Label Background Color', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'default' => '#000000',
                    'selectors' => [
                        '{{WRAPPER}} .twentytwenty-wrapper .mighty-before-after .twentytwenty-overlay div:before' => 'background-color: {{VALUE}}',
                        '{{WRAPPER}} .twentytwenty-wrapper .mighty-before-after .inverted-overlay div:before' => 'background-color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'label_padding',
                [
                    'label' => __( 'Padding', 'mighty' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .twentytwenty-wrapper .mighty-before-after .twentytwenty-overlay div:before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .twentytwenty-wrapper .mighty-before-after .inverted-overlay div:before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'label_horizontal_alignment',
                [
                    'label' => __( 'Alignment', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'middle',
                    'options' => [
                        'top'  => __( 'Top', 'mighty' ),
                        'middle' => __( 'Middle', 'mighty' ),
                        'bottom' => __( 'Bottom', 'mighty' ),
                    ],
                    'condition' => [
                        'beforeafter_orientation' => 'horizontal',
                    ],
                ]
            );

            $this->add_control(
                'label_vertical_alignment',
                [
                    'label' => __( 'Alignment', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'center',
                    'options' => [
                        'left'  => __( 'Left', 'mighty' ),
                        'center' => __( 'Center', 'mighty' ),
                        'right' => __( 'Right', 'mighty' ),
                    ],
                    'condition' => [
                        'beforeafter_orientation' => 'vertical',
                    ],
                ]
            );

        $this->end_controls_section();

	}
	
	protected function render() {
        $settings = $this->get_settings_for_display();
        $horizontalLabelAlign = $settings['beforeafter_orientation'] == "horizontal" ? ' label-h-'.$settings['label_horizontal_alignment'] : '';
        $verticalLabelAlign = $settings['beforeafter_orientation'] == "vertical" ? ' label-v-'.$settings['label_vertical_alignment'] : '';
    ?>
    
        <div id="mighty-before-after-<?php echo $this->get_id(); ?>" class="mighty-before-after twentytwenty-container<?php echo $horizontalLabelAlign; ?> <?php echo $verticalLabelAlign; ?> show-label-<?php echo $settings['show_label_on']; ?>" data-slider-orientation="<?php echo $settings['beforeafter_orientation']; ?>" data-enable-hover="<?php echo $settings['move_on_hover']; ?>" data-enable-overlay="<?php echo $settings['enable_overlay']; ?>" data-handle-offset="<?php echo $settings['handle_initial_offset']['size'] ?>" data-before-label="<?php echo $settings['before_label']; ?>" data-after-label="<?php echo $settings['after_label']; ?>">
        
            <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'before_image_size', 'before_image' ); ?>
            <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'after_image_size', 'after_image' ); ?>

            <?php if ( $settings['enable_overlay'] == false ) { ?>
                <div class="inverted-overlay">
                    <div class="twentytwenty-before-label" data-content="Before"></div>
                    <div class="twentytwenty-after-label" data-content="After"></div>
                </div>
            <?php } ?>

        </div>

        <?php if ( $settings['enable_overlay'] == false ) { ?>
            <style>
            .elementor-widget-mt-before-after .mighty-before-after .twentytwenty-overlay:hover {
                background: transparent !important;
            }
            
            .elementor-widget-mt-before-after .mighty-before-after .inverted-overlay:hover {
                background: transparent !important;
            }
            </style>
        <?php }
	}
	
	protected function _content_template() {
	}
}
