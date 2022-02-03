<?php
namespace MightyAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils as Utils;
use Elementor\Repeater as Repeater;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor MT_Team
 *
 * Elementor widget for MT_Team.
 *
 * @since 1.0.0
 */
class MT_Team extends Widget_Base {

	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );

		wp_register_style( 'mt-team', MIGHTY_ADDONS_PLG_URL . 'assets/css/team.min.css', false, MIGHTY_ADDONS_VERSION );
	}
	
	public function get_name() {
		return 'mt-team';
	}
	
	public function get_title() {
		return __( 'Team', 'mighty' );
	}
	
	public function get_icon() {
		return 'mf mf-team';
	}

	public function get_categories() {
		return [ 'mighty-addons' ];
	}

	public function get_keywords() {
		return [ 'mighty', 'team', 'contact', 'people' ];
    }

	public function get_style_depends() {
		return [ 'mt-team' ];
	}
	
	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Team', 'mighty' ),
			]
		);

			$this->add_control(
				'name',
				[
					'label' => __( 'Name', 'mighty' ),
					'type' => Controls_Manager::TEXT,
					'default' => 'Darth Vader',
				]
			);

			$this->add_control(
				'avatar_image',
				['label' => __( 'Team Avatar', 'mighty' ),
					'type' => Controls_Manager::MEDIA,
					'default' => [
						'url' => Utils::get_placeholder_image_src(),
					],
				]
			);

			$this->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name' => 'avatar_image_size',
					'default' => 'full',
				]
			);

			$this->add_control(
				'designation',
				[
					'label' => __( 'Designation', 'mighty' ),
					'type' => Controls_Manager::TEXT,
					'default' => 'Digital Overlord',
				]
			);

			$this->add_control(
				'about',
				[
					'label' => __( 'About', 'mighty' ),
					'type' => Controls_Manager::TEXTAREA,
					'dynamic' => [
						'active' => true,
					],
					'rows' => '10',
					'default' => 'I\'m cool and I know it.',
				]
			);

		$this->end_controls_section();

		// Social Media Icons
        $this->start_controls_section(
            'mt_team_social_link',
            [
                'label' => __( 'Social Profiles', 'mighty' ),
            ]
		);

			$this->add_control(
				'show_social_icons',
				[
					'label' => __( 'Show Social Icons', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => __( 'Show', 'mighty' ),
					'label_off' => __( 'Hide', 'mighty' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

            $repeater = new Repeater();

				$repeater->add_control(
					'mt_social_title',
					[
						'label'   => __( 'Title', 'mighty' ),
						'type'    => Controls_Manager::TEXT,
						'default' => 'Facebook',
					]
				);

				$repeater->add_control(
					'mt_social_link',
					[
						'label'   => __( 'Link', 'mighty' ),
						'type'    => Controls_Manager::TEXT,
						'default' => __( '#', 'mighty' ),
					]
				);
				
				$repeater->add_control(
					'mt_social_icon',
					[
						'label' => __( 'Icon', 'elementor' ),
						'type' => Controls_Manager::ICONS,
						'recommended' => [
							'fa-brands' => [
								'android',
								'apple',
								'behance',
								'bitbucket',
								'codepen',
								'delicious',
								'deviantart',
								'digg',
								'dribbble',
								'elementor',
								'facebook',
								'flickr',
								'foursquare',
								'free-code-camp',
								'github',
								'gitlab',
								'globe',
								'google-plus',
								'houzz',
								'instagram',
								'jsfiddle',
								'linkedin',
								'medium',
								'meetup',
								'mixcloud',
								'odnoklassniki',
								'pinterest',
								'product-hunt',
								'reddit',
								'shopping-cart',
								'skype',
								'slideshare',
								'snapchat',
								'soundcloud',
								'spotify',
								'stack-overflow',
								'steam',
								'stumbleupon',
								'telegram',
								'thumb-tack',
								'tripadvisor',
								'tumblr',
								'twitch',
								'twitter',
								'viber',
								'vimeo',
								'vk',
								'weibo',
								'weixin',
								'whatsapp',
								'wordpress',
								'xing',
								'yelp',
								'youtube',
								'500px',
							],
							'fa-solid' => [
								'envelope',
								'link',
								'rss',
							],
						],
					]
				);

				$repeater->add_control(
					'mt_icon_color',
					[
						'label'     => __( 'Icon Color', 'mighty' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} {{CURRENT_ITEM}} i' => 'color: {{VALUES}}',
							'{{WRAPPER}} {{CURRENT_ITEM}} svg' => 'fill: {{VALUES}}',
						]
					]
				);

				$repeater->add_control(
					'mt_icon_background',
					[
						'label'     => __( 'Icon Background', 'mighty' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} {{CURRENT_ITEM}} i' => 'background-color: {{VALUES}}'
						]
					]
				);

				$repeater->add_control(
					'mt_icon_hover_color',
					[
						'label'     => __( 'Icon Hover Color', 'mighty' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} {{CURRENT_ITEM}} i:hover' => 'color: {{VALUES}}'
						]
					]
				);

				$repeater->add_control(
					'mt_icon_hover_background',
					[
						'label'     => __( 'Icon Hover Background', 'mighty' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} {{CURRENT_ITEM}} i:hover' => 'background-color: {{VALUES}}'
						]
					]
				);

				$repeater->add_control(
					'mt_icon_hover_border_color',
					[
						'label'     => __( 'Icon Hover border color', 'mighty' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} {{CURRENT_ITEM}} i:hover' => 'border-color: {{VALUES}}'
						]
					]
				);

				$this->add_control(
					'mt_team_social_link_list',
					[
						'type'    => Controls_Manager::REPEATER,
						'fields'  => $repeater->get_controls(),
						'default' => [
							[
								'mt_social_title'      => __( 'Facebook', 'mighty' ),
								'mt_social_icon'       => [
									'value' => 'fab fa-facebook',
									'library' => 'fa-brands',
								],
								'mt_social_link'       => __( '#', 'mighty' ),
							],
							[
								'mt_social_title' => __( 'Twitter', 'mighty' ),
								'mt_social_icon' => [
									'value' => 'fab fa-twitter',
									'library' => 'fa-brands',
								],
								'mt_social_link' => __( '#', 'mighty' ),
							],
							[
								'mt_social_title' => __( 'LinkedIn', 'mighty' ),
								'mt_social_icon' => [
									'value' => 'fab fa-linkedin-in',
									'library' => 'fa-brands',
								],
								'mt_social_link' => __( '#', 'mighty' ),
							],
						],
						'title_field' => '{{{ mt_social_title }}}',
						'condition' => [
							'show_social_icons' => 'yes',
						]
					]
				);
				
			$repeater->end_controls_tabs();

        $this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'mighty' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_responsive_control(
				'team_align',
				[
					'label' => __( 'Alignment', 'mighty' ),
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
						'justify' => [
							'title' => __( 'Justified', 'mighty' ),
							'icon' => 'fa fa-align-justify',
						],
					],
					'selectors' => [
						'{{WRAPPER}} .mighty-team' => 'text-align: {{VALUE}};',
					],
					'default' => 'center',
				]
			);

		$this->end_controls_section();

		// Image Styling
		$this->start_controls_section(
			'mtteam_image_style',
			[
				'label' => __( 'Image', 'mighty' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_responsive_control(
				'mt_image_spacing',
				[
					'label' => __( 'Image Spacing', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 200,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 15,
					],
					'selectors' => [
						'{{WRAPPER}} .mighty-team .avatar-wrapper img' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					]
				]
			);

			$this->add_responsive_control(
				'image_border_radius',
				[
					'label' => __( 'Border Radius', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'rem' ],
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 400,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 15,
					],
					'selectors' => [
						'{{WRAPPER}} .mighty-team .avatar-wrapper img' => 'border-radius: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_responsive_control(
				'image_width',
				[
					'label' => __( 'Image Width', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 1000,
						],
						'%' => [
							'min' => 1,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 300,
					],
					'selectors' => [
						'{{WRAPPER}} .mighty-team .avatar-wrapper img' => 'width: {{SIZE}}{{UNIT}}',
					],
				]
			);

		$this->end_controls_section();
		
		// Name Styling
		$this->start_controls_section(
			'mt_team_name_style',
			[
				'label' => __( 'Name', 'mighty' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'name!' => '',
				],
			]
		);

			$this->add_responsive_control(
				'team_name_margin',
				[
					'label' => __( 'Spacing', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px', 'em', 'rem' ],
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 200,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 0,
					],
					'selectors' => [
						'{{WRAPPER}} .mighty-team .person-name' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_control(
				'mt_name_htmltag',
				[
					'label' => __( 'HTML Tag', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'h3',
					'options' => [
						'h1'  => __( 'H1', 'mighty' ),
						'h2' => __( 'H2', 'mighty' ),
						'h3' => __( 'H3', 'mighty' ),
						'h4' => __( 'H4', 'mighty' ),
						'h5' => __( 'H5', 'mighty' ),
						'h6' => __( 'H6', 'mighty' ),
						'p' => __( 'P', 'mighty' ),
						'div' => __( 'DIV', 'mighty' ),
					],
				]
			);

			$this->add_control(
				'team_name_color',
				[
					'label' => __( 'Color', 'mighty' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#343434',
					'selectors' => [
						'{{WRAPPER}} .mighty-team .person-name' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'team_name_typography',
					'selector' => '{{WRAPPER}} .mighty-team .person-name',
				]
			);

		$this->end_controls_section();

		// Designation Styling
		$this->start_controls_section(
			'mt_team_designation_style',
			[
				'label' => __( 'Designation', 'mighty' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'designation!' => '',
				],
			]
		);

			$this->add_responsive_control(
				'team_designation_margin',
				[
					'label' => __( 'Spacing', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px', 'em', 'rem' ],
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 200,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 0,
					],
					'selectors' => [
						'{{WRAPPER}} .mighty-team .person-designation' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_control(
				'team_designation_color',
				[
					'label' => __( 'Color', 'mighty' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#999A9C',
					'selectors' => [
						'{{WRAPPER}} .mighty-team .person-designation' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'team_designation_typography',
					'selector' => '{{WRAPPER}} .mighty-team .person-designation',
				]
			);

		$this->end_controls_section();

		// About Styling
		$this->start_controls_section(
			'mt_team_about_style',
			[
				'label' => __( 'About', 'mighty' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'about!' => '',
				],
			]
		);

			$this->add_responsive_control(
				'team_about_margin',
				[
					'label' => __( 'Spacing', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px', 'em', 'rem' ],
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 200,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 25,
					],
					'selectors' => [
						'{{WRAPPER}} .mighty-team .person-about' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					],
					'condition' => [
						'mt_icon_position' => 'after-bio'
					]
				]
			);

			$this->add_control(
				'team_about_color',
				[
					'label' => __( 'Color', 'mighty' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#343434',
					'selectors' => [
						'{{WRAPPER}} .mighty-team .person-about' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'team_about_typography',
					'selector' => '{{WRAPPER}} .mighty-team .person-about',
				]
			);

		$this->end_controls_section();

		// Social Icons Styling
		$this->start_controls_section(
			'mt_team_socialicons_style',
			[
				'label' => __( 'Social Icons', 'mighty' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_social_icons' => 'yes',
				]
			]
		);

			$this->add_responsive_control(
				'team_socialicons_fontsize',
				[
					'label' => __( 'Font Size', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px', 'em', 'rem' ],
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 200,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 18,
					],
					'selectors' => [
						'{{WRAPPER}} .mighty-team .social-icons-wrapper a i' => 'font-size: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_responsive_control(
				'team_socialicons_margin',
				[
					'label' => __( 'Spacing Between Icons', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px', 'em', 'rem' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 200,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 10,
					],
					'selectors' => [
						'{{WRAPPER}} .mighty-team .social-icons-wrapper a i' => 'margin: 0 {{SIZE}}{{UNIT}}',
					],
				]
			);
			
			$this->add_control(
				'mt_icon_position',
				[
					'label' => __( 'Icons Position', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'after-bio',
					'options' => [
						'before-bio'  => __( 'Before Bio', 'mighty' ),
						'after-bio' => __( 'After Bio', 'mighty' ),
					],
					'condition' => [
						'show_social_icons' => 'yes',
					]
				]
			);

			$this->add_responsive_control(
				'team_icons_spacing',
				[
					'label' => __( 'Spacing', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px', 'em', 'rem' ],
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 200,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 0,
					],
					'selectors' => [
						'{{WRAPPER}} .mighty-team .social-icons-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					],
					'condition' => [
						'mt_icon_position' => 'before-bio'
					]
				]
			);

			$this->add_control(
				'icon_color_type',
				[
					'label' => __( 'Icon Color Type', 'mighty' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'default',
					'options' => [
						'default'  => __( 'Brand Colors', 'mighty' ),
						'custom' => __( 'Custom', 'mighty' ),
					],
				]
			);

			$this->add_control(
                'icon_color',
                [
                    'label' => __( 'Icon Color', 'mighty' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
						'{{WRAPPER}} .mighty-team .social-icons-wrapper a i' => 'color: {{VALUES}}',
						'{{WRAPPER}} .mighty-team .social-icons-wrapper a svg' => 'fill: {{VALUES}}'
					],
					'condition' => [
						'icon_color_type' => 'custom',
					],
                ]
			);
			
			$this->add_control(
                'icon_background',
                [
                    'label'     => __( 'Icon Background', 'mighty' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .mighty-team .social-icons-wrapper a i' => 'background-color: {{VALUES}}'
					],
					'condition' => [
						'icon_color_type' => 'custom',
					],
                ]
            );

            $this->add_control(
                'icon_hover_color',
                [
                    'label'     => __( 'Icon Hover Color', 'mighty' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .mighty-team .social-icons-wrapper a i:hover' => 'color: {{VALUES}}'
					],
					'condition' => [
						'icon_color_type' => 'custom',
					],
                ]
            );

            $this->add_control(
                'icon_hover_background',
                [
                    'label'     => __( 'Icon Hover Background', 'mighty' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .mighty-team .social-icons-wrapper a i:hover' => 'background-color: {{VALUES}}'
					],
					'condition' => [
						'icon_color_type' => 'custom',
					],
                ]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'avatar_border',
					'label' => __( 'Border Type', 'mighty' ),
					'selector' => '{{WRAPPER}} .mighty-team .social-icons-wrapper a i',
				]
			);

			$this->add_control(
				'mt_border_radius',
				[
					'label' => __( 'Border Radius', 'mighty' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' ],
					'selectors' => [
						'{{WRAPPER}} .mighty-team .social-icons-wrapper a i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					]
				]
			);

			$this->add_control(
                'mt_border_hovercolor',
                [
                    'label'     => __( 'Border Hover Color', 'mighty' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .mighty-team .social-icons-wrapper a i:hover' => 'border-color: {{VALUES}}'
					],
					'condition' => [
						'mt_border_style!' => 'none'
					],
                ]
			);

			$this->add_control(
				'icons_padding',
				[
					'label' => __( 'Padding', 'mighty' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' ],
					'selectors' => [
						'{{WRAPPER}} .mighty-team .social-icons-wrapper a i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();
	}
	
	protected function render() {
		$settings = $this->get_settings_for_display();
		$img_url = Group_Control_Image_Size::get_attachment_image_src( strval($settings['avatar_image']['id']), 'avatar_image_size', $settings );

		echo '<div class="mighty-team">';

			echo '<div class="avatar-wrapper">';
				echo '<img src='.$img_url.' >';
			echo '</div>';

			if ( $settings['name'] !== "" ) {
				echo '<' . $settings['mt_name_htmltag'] .' class="person-name">' . $settings['name'] . '</'. $settings['mt_name_htmltag'] .'>';
			}

			if ( $settings['designation'] !== "" ) {
				echo '<div class="person-designation">' . $settings['designation'] . '</div>';
			}
			
			if ( $settings['mt_icon_position'] == "after-bio" || $settings['show_social_icons'] !== "yes" ) {
				if ( $settings['about'] !== "" ) {
					echo '<div class="person-about">' . $settings['about'] . '</div>';
				}
			}

			if ( $settings['show_social_icons'] == "yes" ) {
				echo '<ul class="social-icons-wrapper">';
					foreach ( $settings['mt_team_social_link_list'] as $socialprofile ) :
						echo '<li class="elementor-repeater-item-'. $socialprofile['_id'] .'" >
						<a href="'. esc_url( $socialprofile['mt_social_link'] ) .'">';
						\Elementor\Icons_Manager::render_icon( $socialprofile['mt_social_icon'], [ 'aria-hidden' => 'true' ] );
						echo '</a></li>';
					endforeach;
				echo '</ul>';
			}
			
			if ( $settings['mt_icon_position'] == "before-bio") {
				if ( $settings['about'] !== "" ) {
					echo '<div class="person-about">' . $settings['about'] . '</div>';
				}
			}
		echo '</div>';
	}
	
}
