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

		add_action( 'elementor/editor/after_save', [ $this, 'save_global_values' ], 10, 2 );

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
                    'return_value' => 'yes',
                ]
            );

			$rpbOptions = get_option( 'mighty_addons_integration' );
			$currentPostId = (string) get_the_ID();

			if ( !isset( $rpbOptions['reading-progress-bar-globally'] ) || ( isset( $rpbOptions['reading-progress-bar-globally'][$currentPostId] ) && $rpbOptions['reading-progress-bar-globally'][$currentPostId]['post_id'] == $currentPostId ) ) {
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
						]
					]
				);
			} else {
				$element->add_control(
                    'ma_rpb_global_notice',
                    [
                        'type' => Controls_Manager::RAW_HTML,
                        'raw' => __( '<p>This is enabled globally. Go <a target="_blank" href="' . get_bloginfo('url') . '/wp-admin/post.php?post=' . array_values( $rpbOptions['reading-progress-bar-globally'] )[0]['post_id'] . '&action=elementor">here</a> to edit globally.</p>', 'mighty' ),
                        'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
						'condition' => [
							'ma_enable_rpb' => 'yes'
						]
                    ]
                );
			}

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
					],
					'selectors' => [
						'.ma-rpb-progress-container' => 'height: {{SIZE}}{{UNIT}} !important',
						'.ma-rpb-progress-container .ma-rpb-progress-bar' => 'height: {{SIZE}}{{UNIT}} !important',
					],
				]
			);

            $element->add_control(
				'ma_background_color',
				[
					'label' => __( 'Background Color', 'mighty' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#C5C5C6',
					'condition' => [
						'ma_enable_rpb' => 'yes',
                        'ma_select_view' => 'view1'
					],
					'selectors' => [
						'.ma-rpb-progress-container' => 'background-color: {{VALUE}};'
					]
				]
			);

            $element->add_control(
				'ma_fill_color',
				[
					'label' => __( 'Fill Color', 'mighty' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#6A63DA',
					'condition' => [
						'ma_enable_rpb' => 'yes',
                        'ma_select_view' => 'view1'
					],
					'selectors' => [
						'.ma-rpb-progress-container .ma-rpb-progress-bar' => 'background-color: {{VALUE}};'
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
                        'value' => 'fas fa-arrow-up',
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
						'size' => 30,
					],
					'condition' => [
						'ma_enable_rpb' => 'yes',
                        'ma_select_view' => 'view2'
					],
					'selectors' => [
						'#ma-btt-rpb .ma-rpb-icon' => 'font-size: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
						'#ma-btt-rpb.ma-progress-wrap' => 'height: calc(46px + ({{SIZE}}{{UNIT}} - 20px)) !important; width: calc(46px + ({{SIZE}}{{UNIT}} - 20px)) !important;',
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
							],
							'selectors' => [
								'.ma-progress-wrap .ma-rpb-icon' => 'color: {{VALUE}};'
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
							],
							'selectors' => [
								'#ma-btt-rpb svg' => 'background-color: {{VALUE}} !important;'
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
							],
							'selectors' => [
								'#ma-btt-rpb .ma-rpb-icon:hover' => 'color: {{VALUE}} !important;'
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
							],
							'selectors' => [
								'#ma-btt-rpb:hover svg' => 'background-color: {{VALUE}} !important;'
							]
                        ]
                    );

                $element->end_controls_tab();
            
			$element->end_controls_tabs( 'view2_styling' );

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
					],
					'selectors' => [
						'#ma-btt-rpb svg.progress-circle path.bar' => 'stroke-width: {{SIZE}} !important;',
						'#ma-btt-rpb svg.progress-circle path.bar-bg' => 'stroke-width: {{SIZE}} !important;'
					]
				]
			);

			$element->add_control(
				'ma_bar_color',
				[
					'label' => __( 'Bar Color', 'mighty' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'condition' => [
						'ma_enable_rpb' => 'yes',
                        'ma_select_view' => 'view2'
					],
					'selectors' => [
						'#ma-btt-rpb svg.progress-circle path.bar' => 'stroke: {{VALUE}} !important;'
					]
				]
			);

			$element->add_control(
				'ma_bar_bg_color',
				[
					'label' => __( 'Bar Background Color', 'mighty' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#B3A9A97A',
					'condition' => [
						'ma_enable_rpb' => 'yes',
                        'ma_select_view' => 'view2'
					],
					'selectors' => [
						'#ma-btt-rpb svg.progress-circle path.bar-bg' => 'stroke: {{VALUE}} !important;'
					]
				]
			);

            $element->add_control(
				'ma_animation_speed',
				[
					'label' => __( 'Animation Speed (Milliseconds)', 'mighty' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min'  => 1,
							'max'  => 2000,
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
					],
					'selectors' => [
						'.ma-rpb-progress-container .ma-rpb-progress-bar' => 'transition: width {{SIZE}}ms ease;',
						'.ma-progress-wrap svg.progress-circle path.bar' => 'transition: stroke-dashoffset {{SIZE}}ms ease !important;'
					],
				]
			);

			$element->add_control(
				'ma_hide_on_desktop',
				[
					'label' => __( 'Hide On Desktop', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => __( 'Show', 'mighty' ),
					'label_off' => __( 'Hide', 'mighty' ),
					'return_value' => 'yes',
					'condition' => [
						'ma_enable_rpb' => 'yes',
					],
				]
			);

			$element->add_control(
				'ma_hide_on_tablet',
				[
					'label' => __( 'Hide On Tablet', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => __( 'Show', 'mighty' ),
					'label_off' => __( 'Hide', 'mighty' ),
					'return_value' => 'yes',
					'condition' => [
						'ma_enable_rpb' => 'yes',
					],
				]
			);

			$element->add_control(
				'ma_hide_on_mobile',
				[
					'label' => __( 'Hide On Mobile', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => __( 'Show', 'mighty' ),
					'label_off' => __( 'Hide', 'mighty' ),
					'return_value' => 'yes',
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

			// Global Settings	
			if ( $settings['ma_enable_rpb_globally'] == 'yes' ) {
				$oldSettings['reading-progress-bar-globally'][$post_id] = self::createOption( $settings );
				$oldSettings['reading-progress-bar-globally'][$post_id]['post_id'] = get_the_ID();
				$oldSettings['reading-progress-bar-globally'][$post_id]['display_on'] = $settings['ma_display_on'];

				// Updating old settings if present
				if ( $oldSettings['reading-progress-bar'][$post_id] ) {
					$oldSettings['reading-progress-bar'][$post_id] = self::createOption( $settings );
				}
			} else {
				$oldSettings['reading-progress-bar'][$post_id] = self::createOption( $settings );

				// Removing global values if disabled
				if( array_key_exists( $post_id, get_option('mighty_addons_integration')['reading-progress-bar-globally'] ) ) {
					unset( $oldSettings['reading-progress-bar-globally'] );
				}
			}

		} else {

			if( array_key_exists( $post_id, get_option('mighty_addons_integration')['reading-progress-bar'] ) ) {
				// removing the disabled RPB
				unset( $oldSettings['reading-progress-bar'][$post_id] );
			}

		}
		
		update_option( 'mighty_addons_integration', $oldSettings );

	}

	public static function createOption( $settings ) {

		$rpbSetting = [];

		$rpbSetting['select_view'] = $settings['ma_select_view'];
		$rpbSetting['animation_speed'] = $settings['ma_animation_speed'];
		$rpbSetting['hide_on_desktop'] = $settings['ma_hide_on_desktop'];
		$rpbSetting['hide_on_tablet'] = $settings['ma_hide_on_tablet'];
		$rpbSetting['hide_on_mobile'] = $settings['ma_hide_on_mobile'];

		if( $settings['ma_select_view'] == 'view1' ) {
			// view 1
			$rpbSetting['position'] = $settings['ma_position'];
			$rpbSetting['height'] = $settings['ma_height'];
			$rpbSetting['background_color'] = $settings['ma_background_color'];
			$rpbSetting['fill_color'] = $settings['ma_fill_color'];
		} else {
			// view 2
			$rpbSetting['rpb_icon'] = $settings['ma_rpb_icon'];
			$rpbSetting['icon_size'] = $settings['ma_icon_size'];
			$rpbSetting['icon_color'] = $settings['ma_icon_color'];
			$rpbSetting['icon_bg_color'] = $settings['ma_icon_bg_color'];
			$rpbSetting['icon_hover_color'] = $settings['ma_icon_hover_color'];
			$rpbSetting['icon_bg_hover_color'] = $settings['ma_icon_bg_hover_color'];
			$rpbSetting['icon_shape'] = $settings['ma_icon_shape'];
			$rpbSetting['bar_size'] = $settings['ma_bar_size'];
			$rpbSetting['bar_color'] = $settings['ma_bar_color'];
			$rpbSetting['bar_bg_color'] = $settings['ma_bar_bg_color'];
		}

		return $rpbSetting;
	}
    
    public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
}

MT_ReadingProgressBar::instance();