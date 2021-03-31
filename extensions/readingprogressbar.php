<?php

namespace MightyAddons\Extensions\MT_ReadingProgressBar;

// Elementor classes
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class MT_ReadingProgressBar {

    private static $_instance = null;

    public final function __construct() {
		
		// Register controls on Post/Page Settings
		add_action( 'elementor/documents/register_controls', [ $this, 'register_controls' ], 10, 3 );

        // Enqueue scripts.
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );

		add_action( 'elementor/editor/after_save', [ $this, 'save_global_values' ], 10, 2 );
		add_action( 'elementor/preview/enqueue_styles', [ $this, 'enqueue_styles' ] );

	}

    public function enqueue_scripts() {
		
		wp_enqueue_script( 'mt-rpbjs', MIGHTY_ADDONS_PLG_URL . 'assets/js/rpb.js', [ 'jquery' ], MIGHTY_ADDONS_VERSION, true );
        
	}

	public function enqueue_styles() {

		wp_enqueue_style( 'mt-reading-bar', MIGHTY_ADDONS_PLG_URL . 'assets/css/rpb.css', [], MIGHTY_ADDONS_PRO_VERSION );

	}
    
    public function register_controls( $element ) {
        
		$element->start_controls_section(
			'ma_reading_progress_bar',
			[
                'tab' => Controls_Manager::TAB_SETTINGS,
				'label' => __( 'MA Reading Progress Bar', 'mighty' ),
			]
        );

            $element->add_control(
                'ma_enable_rpb',
                [
                    'label' => __( 'Enable Progress Bar', 'mighty' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'On', 'mighty' ),
                    'label_off' => __( 'Off', 'mighty' ),
                    'return_value' => 'yes'
                ]
            );

            $element->add_control(
                'ma_enable_rpb_globally',
                [
                    'label' => __( 'Enable Progress Bar Globally', 'mighty' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'On', 'mighty' ),
                    'label_off' => __( 'Off', 'mighty' ),
                    'return_value' => 'yes',
                    'condition' => [
                        'ma_enable_rpb' => 'yes'
                    ]
                ]
            );

            $element->add_control(
				'ma_display_on',
				[
					'label' => __( 'Display On', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'all-pages',
					'options' => [
						'all-pages' => __( 'All Pages', 'mighty' ),
						'all-posts' => __( 'All Posts', 'mighty' ),
						'all-pages-posts' => __( 'All Pages & Posts', 'mighty' ),
					],
					'condition' => [
						'ma_enable_rpb' => 'yes',
						'ma_enable_rpb_globally' => 'yes'
					],
				]
			);

            $element->add_control(
				'ma_select_view',
				[
					'label' => __( 'Select View', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'view1',
					'options' => [
						'view1' => __( 'View 1', 'mighty' ),
						'view2' => __( 'View 2', 'mighty' ),
					],
                    'separator' => 'after',
					'condition' => [
						'ma_enable_rpb' => 'yes',
					],
				]
			);

            // View 1 controls
            $element->add_control(
				'ma_position',
				[
					'label' => __( 'Position', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'top',
					'options' => [
						'top' => __( 'Top', 'mighty' ),
						'bottom' => __( 'Bottom', 'mighty' ),
					],
					'condition' => [
						'ma_enable_rpb' => 'yes',
                        'ma_select_view' => 'view1'
					],
				]
			);

            $element->add_control(
				'ma_height',
				[
					'label' => __( 'Height', 'mighty' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min'  => 1,
							'max'  => 100,
							'step' => 1,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 10,
					],
					'condition' => [
						'ma_enable_rpb' => 'yes',
                        'ma_select_view' => 'view1'
					]
				]
			);

            $element->add_control(
				'ma_background_color',
				[
					'label' => __( 'Background Color', 'mighty' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'condition' => [
						'ma_enable_rpb' => 'yes',
                        'ma_select_view' => 'view1'
					]
				]
			);

            $element->add_control(
				'ma_fill_color',
				[
					'label' => __( 'Fill Color', 'mighty' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'condition' => [
						'ma_enable_rpb' => 'yes',
                        'ma_select_view' => 'view1'
					]
				]
			);

            // View 2 controls
            $element->add_control(
                'ma_rpb_icon',
                [
                    'label' => __( 'Select Icon', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-star',
                        'library' => 'solid',
                    ],
					'condition' => [
						'ma_enable_rpb' => 'yes',
                        'ma_select_view' => 'view2'
					]
                ]
            );

            $element->add_control(
				'ma_icon_size',
				[
					'label' => __( 'Icon Size', 'mighty' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min'  => 1,
							'max'  => 100,
							'step' => 1,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 10,
					],
					'condition' => [
						'ma_enable_rpb' => 'yes',
                        'ma_select_view' => 'view2'
					]
				]
			);

            $element->start_controls_tabs( 'view2_styling' );

                $element->start_controls_tab( 'normal',
                    [
                        'label' => __( 'Normal', 'mighty' ),
                        'condition' => [
                            'ma_enable_rpb' => 'yes',
                            'ma_select_view' => 'view2'
                        ]
                    ]
				);

                    $element->add_control(
                        'ma_icon_color',
                        [
                            'label' => __( 'Icon Color', 'mighty' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'condition' => [
                                'ma_enable_rpb' => 'yes',
                                'ma_select_view' => 'view2'
                            ]
                        ]
                    );

                    $element->add_control(
                        'ma_icon_bg_color',
                        [
                            'label' => __( 'Icon Background Color', 'mighty' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'condition' => [
                                'ma_enable_rpb' => 'yes',
                                'ma_select_view' => 'view2'
                            ]
                        ]
                    );

                $element->end_controls_tab();

                $element->start_controls_tab( 'hover',
                    [
                        'label' => __( 'Hover', 'mighty' ),
                        'condition' => [
                            'ma_enable_rpb' => 'yes',
                            'ma_select_view' => 'view2'
                        ]
                    ]
				);
				
                    $element->add_control(
                        'ma_icon_hover_color',
                        [
                            'label' => __( 'Icon Color', 'mighty' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'condition' => [
                                'ma_enable_rpb' => 'yes',
                                'ma_select_view' => 'view2'
                            ]
                        ]
                    );

                    $element->add_control(
                        'ma_icon_bg_hover_color',
                        [
                            'label' => __( 'Icon Background Color', 'mighty' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'condition' => [
                                'ma_enable_rpb' => 'yes',
                                'ma_select_view' => 'view2'
                            ]
                        ]
                    );

                $element->end_controls_tab();
            
			$element->end_controls_tabs( 'view2_styling' );

            $element->add_control(
				'ma_icon_shape',
				[
					'label' => __( 'Icon Shape', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'circle',
					'options' => [
						'circle' => __( 'Circle', 'mighty' ),
						'square' => __( 'Square', 'mighty' ),
						'rounded' => __( 'Rounded', 'mighty' ),
					],
                    'condition' => [
						'ma_enable_rpb' => 'yes',
                        'ma_select_view' => 'view2'
					]
				]
			);

            $element->add_control(
				'ma_bar_size',
				[
					'label' => __( 'Bar Size', 'mighty' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min'  => 1,
							'max'  => 100,
							'step' => 1,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 10,
					],
					'condition' => [
						'ma_enable_rpb' => 'yes',
                        'ma_select_view' => 'view2'
					]
				]
			);

            $element->add_control(
				'ma_bar_background_color',
				[
					'label' => __( 'Bar Background Color', 'mighty' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'condition' => [
						'ma_enable_rpb' => 'yes',
                        'ma_select_view' => 'view2'
					]
				]
			);

            $element->add_control(
				'ma_animation_speed',
				[
					'label' => __( 'Animation Speed', 'mighty' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min'  => 1,
							'max'  => 100,
							'step' => 1,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 10,
					],
                    'separator' => 'before',
					'condition' => [
						'ma_enable_rpb' => 'yes'
					]
				]
			);

            $element->add_control(
				'ma_hide_on',
				[
					'label' => __( 'Hide On', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'nothing',
					'options' => [
                        'nothing' => __( 'Nothing', 'mighty' ),
						'desktop' => __( 'Desktop', 'mighty' ),
						'tablet' => __( 'Tablet', 'mighty' ),
						'mobile' => __( 'Mobile', 'mighty' ),
					],
					'condition' => [
						'ma_enable_rpb' => 'yes',
					],
				]
			);

        $element->end_controls_section();
        
	}

	public function save_global_values( $post_id, $editor_data ) {

		$document = \Elementor\Plugin::$instance->documents->get($post_id, false);
		$settings = $document->get_settings();
		$oldSettings = get_option( 'mighty_addons_integration' );

		if ( $settings['ma_enable_rpb'] == 'yes' ) {
			$oldSettings['reading-progress-bar'][$post_id]['select_view'] = $settings['ma_select_view'];
			$oldSettings['reading-progress-bar'][$post_id]['animation_speed'] = $settings['ma _animation_speed'];
			$oldSettings['reading-progress-bar'][$post_id]['hide_on'] = $settings['ma_hide_on'];

			if( $settings['ma_select_view'] == 'view1' ) {
				// view 1
				$oldSettings['reading-progress-bar'][$post_id]['position'] = $settings['ma_position'];
				$oldSettings['reading-progress-bar'][$post_id]['height'] = $settings['ma_height'];
				$oldSettings['reading-progress-bar'][$post_id]['background_color'] = $settings['ma_background_color'];
				$oldSettings['reading-progress-bar'][$post_id]['fill_color'] = $settings['ma_fill_color'];
			} else {
				// view 2
				$oldSettings['reading-progress-bar'][$post_id]['rpb_icon'] = $settings['ma_rpb_icon'];
				$oldSettings['reading-progress-bar'][$post_id]['icon_size'] = $settings['ma_icon_size'];
				$oldSettings['reading-progress-bar'][$post_id]['icon_color'] = $settings['ma_icon_color'];
				$oldSettings['reading-progress-bar'][$post_id]['icon_bg_color'] = $settings['ma_icon_bg_color'];
				$oldSettings['reading-progress-bar'][$post_id]['icon_hover_color'] = $settings['ma_icon_hover_color'];
				$oldSettings['reading-progress-bar'][$post_id]['icon_bg_hover_color'] = $settings['ma_icon_bg_hover_color'];
				$oldSettings['reading-progress-bar'][$post_id]['icon_shape'] = $settings['ma_icon_shape'];
				$oldSettings['reading-progress-bar'][$post_id]['bar_size'] = $settings['ma_bar_size'];
				$oldSettings['reading-progress-bar'][$post_id]['bar_background_color'] = $settings['ma_bar_background_color'];	
			}
		} else {
			if( array_key_exists( $post_id, get_option('mighty_addons_integration')['reading-progress-bar'] ) ) {
				// removing the disabled RPB
				unset( $oldSettings['reading-progress-bar'][$post_id] );
			}
		}
		
		update_option( 'mighty_addons_integration', $oldSettings );

	}
    
    public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
}

MT_ReadingProgressBar::instance();