<?php
namespace MightyAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use \Elementor\Utils as Utils;
use Elementor\Repeater as Repeater;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Scheme_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class MT_Accordion extends Widget_Base {

	public function get_name() {
		return 'mt-accordion';
	}

	public function get_title() {
		return __( 'Accordion', 'mighty' );
    }
    
	public function get_icon() {
		return 'mf mf-accordion';
    }

    public function get_categories() {
        return [ 'mighty-addons' ];
    }
    
	public function get_keywords() {
		return [ 'mighty', 'accordion', 'tabs' ];
    }

    public function get_style_depends() {
		return [ 'mt-accordion' ];
    }
    
    public function get_script_depends() {
		return [ 'mt-accordion' ];
	}
    
	protected function _register_controls() {
		$this->start_controls_section(
			'section_accordion',
			[
				'label' => __( 'Accordion', 'mighty' ),
			]
		);

            $repeater = new Repeater();

                $repeater->add_control(
                    'accordion_title',
                    [
                        'label' => __( 'Title & Description', 'mighty' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Accordion Title', 'mighty' ),
                        'dynamic' => [
                            'active' => true,
                        ],
                        'label_block' => true,
                    ]
                );

                $repeater->add_control(
                    'accordion_content',
                    [
                        'label' => __( 'Content', 'mighty' ),
                        'type' => Controls_Manager::WYSIWYG,
                        'default' => __( 'Accordion Content', 'mighty' ),
                        'show_label' => false,
                    ]
                );

                $repeater->add_control(
                    'accordion_main_icon',
                    [
                        'label' => __( 'Icon', 'mighty' ),
                        'type' => Controls_Manager::ICONS,
                    ]
                );

                $this->add_control(
                    'tabs',
                    [
                        'label' => __( 'Accordion Items', 'mighty' ),
                        'type' => Controls_Manager::REPEATER,
                        'fields' => $repeater->get_controls(),
                        'default' => [
                            [
                                'accordion_title' => __( 'Accordion 1', 'mighty' ),
                                'accordion_main_icon' => __( 'fas fa-plus', 'mighty' ),
                                'accordion_content' => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'mighty' ),
                            ],
                            [
                                'accordion_title' => __( 'Accordion 2', 'mighty' ),
                                'accordion_main_icon' => __( 'fas fa-plus', 'mighty' ),
                                'accordion_content' => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'mighty' ),
                            ],
                            [
                                'accordion_title' => __( 'Accordion 3', 'mighty' ),
                                'accordion_main_icon' => __( 'fas fa-plus', 'mighty' ),
                                'accordion_content' => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'mighty' ),
                            ],
                        ],
                        'title_field' => '{{{ accordion_title }}}',
                    ]
                );
            
            $repeater->end_controls_tabs();

            $this->add_control(
                'first_active',
                [
                    'label' => __( 'First Active', 'mighty' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'On', 'mighty' ),
                    'label_off' => __( 'Off', 'mighty' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
            
            $this->add_control(
                'multiple_accordion',
                [
                    'label' => __( 'Open Multiple', 'mighty' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'On', 'mighty' ),
                    'label_off' => __( 'Off', 'mighty' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
            
            $this->add_control(
                'open_all',
                [
                    'label' => __( 'Open All', 'mighty' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'On', 'mighty' ),
                    'label_off' => __( 'Off', 'mighty' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
            
            $this->add_control(
                'enable_faq',
                [
                    'label' => __( 'Enable FAQ Schema', 'mighty' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'On', 'mighty' ),
                    'label_off' => __( 'Off', 'mighty' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                    'description' => 'FAQPage Schema is allowed once on a page. If you will enable it on multiple sections of a page, you will get Duplicate Field "FAQPage" error at the time of Structure data validation.',
                ]
            );
        
        $this->end_controls_section();
        
        $this->start_controls_section(
			'section_title_style',
			[
				'label' => __( 'Title', 'mighty' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
        );

            $this->add_control(
                'title_html_tag',
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
                        'div' => 'div',
                    ],
                    'default' => 'div',
                    'separator' => 'before',
                ]
            );
        
            $this->add_control(
                'title_color',
                [
                    'label' => __( 'Color', 'mighty' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .mighty-accordion .mt-panel .accordion .mt-accordion-title' => 'color: {{VALUE}};',
                    ],
                    'default' => '#000',
                ]
            );

            $this->add_control(
                'title_background',
                [
                    'label' => __( 'Background', 'mighty' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#F6FAFB',
                    'selectors' => [
                        '{{WRAPPER}} .mighty-accordion .mt-panel .accordion' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'active_color',
                [
                    'label' => __( 'Active Color', 'mighty' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .mighty-accordion .mt-panel .active .mt-accordion-title' => 'color: {{VALUE}};',
                    ],
                    'default' => '#000',
                ]
            );
            
            $this->add_control(
                'active_background_color',
                [
                    'label' => __( 'Active Background Color', 'mighty' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#F6FAFB',
                    'selectors' => [
                        '{{WRAPPER}} .mighty-accordion .mt-panel .active' => 'background-color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .mighty-accordion .mt-panel .accordion .mt-accordion-title',
                ]
            );

            $this->add_responsive_control(
                'title_padding',
                [
                    'label' => __( 'Padding', 'mighty' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'default' => [
                        'top' =>  '2',
                        'right' => '2',
                        'bottom' => '2',
                        'left' => '2',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mighty-accordion .mt-panel .accordion .mt-accordion-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'title_border',
                    'label' => __( 'Border Type', 'mighty' ),
                    'selector' => '{{WRAPPER}} .mighty-accordion .accordion',
                ]
            );

            $this->add_control(
                'title_border_radius',
                [
                    'label' => __( 'Border Radius', 'mighty' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px' ],
                    'default' => [
                        'top' =>  '5',
                        'right' => '5',
                        'bottom' => '0',
                        'left' => '0',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mighty-accordion .accordion' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();
        
        $this->start_controls_section(
			'section_icon_style',
			[
				'label' => __( 'Icon', 'mighty' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
        );
        
            $this->add_control(
                'open_close_icon',
                [
                    'label' => __( 'Select Icon', 'mighty' ),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'options' => [
                        'fa-angle-down' => [
                            'title' => __( 'Angle', 'mighty' ),
                            'icon' => 'fas fa-angle-down',
                        ],
                        'fa-plus' => [
                            'title' => __( 'Plus', 'mighty' ),
                            'icon' => 'fas fa-plus',
                        ],
                        'fa-arrow-down' => [
                            'title' => __( 'Arrow', 'mighty' ),
                            'icon' => 'fas fa-arrow-down',
                        ],
                        'fa-sort-down' => [
                            'title' => __( 'Sort', 'mighty' ),
                            'icon' => 'fas fa-sort-down',
                        ],
                    ],
                    'default' => 'fa-angle-down',
                    'toggle' => true,
                ]
            );

            $this->add_responsive_control(
                'primary_icon_size',
                [
                    'label' => __( 'Primary Icon Size', 'mighty' ),
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
                        '{{WRAPPER}} .mighty-accordion .mt-panel .accordion .mt-accordion-title svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .mighty-accordion .mt-panel .accordion .mt-accordion-title i' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'secondary_icon_size',
                [
                    'label' => __( 'Secondary Icon Size', 'mighty' ),
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
                        '{{WRAPPER}} .mighty-accordion .mt-panel .accordion .accordion-icons i' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'icon_align',
                [
                    'label' => __( 'Alignment', 'mighty' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Start', 'mighty' ),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'right' => [
                            'title' => __( 'End', 'mighty' ),
                            'icon' => 'eicon-h-align-right',
                        ],
                    ],
                    'default' => is_rtl() ? 'left' : 'right',
                    'toggle' => false,
                    'label_block' => false,
                ]
            );

            $this->add_responsive_control(
                'primary_icon_spacing',
                [
                    'label' => __( 'Primary Icon Spacing', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
						'unit' => 'px',
						'size' => 5,
					],
                    'selectors' => [
                        '{{WRAPPER}} .mighty-accordion .mt-panel .accordion .mt-accordion-title svg' => 'margin-right: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .mighty-accordion .mt-panel .accordion .mt-accordion-title i' => 'margin-right: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'secondary_icon_spacing',
                [
                    'label' => __( 'Secondary Icon Spacing', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
						'unit' => 'px',
						'size' => 5,
					],
                    'selectors' => [
                        '{{WRAPPER}} .mighty-accordion .mt-panel .accordion .accordion-icons i' => 'margin: 0 {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            
            $this->start_controls_tabs(
                'style_tabs'
            );

                $this->start_controls_tab(
                    'style_normal_tab',
                    [
                        'label' => __( 'Normal', 'mighty' ),
                    ]
                );

                    $this->add_control(
                        'icon_color',
                        [
                            'label' => __( 'Color', 'mighty' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .mighty-accordion .mt-panel .accordion .accordion-icons i' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'icon_bg_color',
                        [
                            'label' => __( 'Background Color', 'mighty' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .mighty-accordion .mt-panel .accordion .accordion-icons i' => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'style_active_tab',
                    [
                        'label' => __( 'Active', 'mighty' ),
                    ]
                );

                    $this->add_control(
                        'icon_active_color',
                        [
                            'label' => __( 'Color', 'mighty' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .mighty-accordion .mt-panel .active .accordion-icons i' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'icon_active_bg_color',
                        [
                            'label' => __( 'Background Color', 'mighty' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .mighty-accordion .mt-panel .active .accordion-icons i' => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();
            $this->end_controls_tabs();

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'icon_border',
                    'label' => __( 'Border Type', 'mighty' ),
                    'selector' => '{{WRAPPER}} .mighty-accordion .mt-panel .accordion-icons i',
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'icon_border_radius',
                [
                    'label' => __( 'Border Radius', 'mighty' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px' ],
                    'selectors' => [
                        '{{WRAPPER}} .mighty-accordion .mt-panel .accordion-icons i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'icon_padding',
                [
                    'label' => __( 'Padding', 'mighty' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'default' => [
                        'top' =>  '5',
                        'right' => '5',
                        'bottom' => '5',
                        'left' => '5',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mighty-accordion .mt-panel .accordion-icons i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_accordion_style',
			[
				'label' => __( 'Accordion', 'mighty' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
        );

            $this->add_control(
                'accordion_gap',
                [
                    'label' => __( 'Gap', 'mighty' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 5,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mighty-accordion .mt-panel:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                    ],
                ]
            );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			[
				'label' => __( 'Content', 'mighty' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

            $this->add_control(
                'content_background_color',
                [
                    'label' => __( 'Background', 'mighty' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .mighty-accordion .mt-panel .panel' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'content_color',
                [
                    'label' => __( 'Color', 'mighty' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .mighty-accordion .mt-panel .panel .accordion-content' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'content_typography',
                    'selector' => '{{WRAPPER}} .mighty-accordion .mt-panel .panel',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_3,
                ]
            );

            $this->add_responsive_control(
                'content_padding',
                [
                    'label' => __( 'Padding', 'mighty' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'default' => [
                        'top' =>  '10',
                        'right' => '10',
                        'bottom' => '10',
                        'left' => '10',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .mighty-accordion .mt-panel .panel .accordion-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'content_border',
                    'label' => __( 'Border Type', 'mighty' ),
                    'selector' => '{{WRAPPER}} .mighty-accordion .mt-panel .panel .accordion-content',
                ]
            );

            $this->add_control(
                'content_border_radius',
                [
                    'label' => __( 'Border Radius', 'mighty' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px' ],
                    'selectors' => [
                        '{{WRAPPER}} .mighty-accordion .panel' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

		$this->end_controls_section();
    }
    
	protected function render() {
        $settings = $this->get_settings_for_display();

        if ( empty( $settings['tabs'] ) ) {
            return;
        }

        $openMultiple = $settings['multiple_accordion'] == "yes" ? 'enable' : 'disable';
        $firstActive = $settings['first_active'] == "yes" ? 'active' : '';
        $openAll = $settings['open_all'] == "yes" ? 'active' : '';
        $faqSchema = $settings['enable_faq'] == "yes" ? true : false;
        $titleTag = $settings['title_html_tag'];
        $openAccordionIcon = $settings['open_close_icon'];
        $closeAccordionIcon = "";
            if( $openAccordionIcon ) {
                switch( $openAccordionIcon ) {
                    case 'fa-angle-down': $closeAccordionIcon = 'fa-angle-up';
                    break;
                    case 'fa-plus': $closeAccordionIcon = 'fa-minus';
                    break;
                    case 'fa-arrow-down': $closeAccordionIcon = 'fa-arrow-up';
                    break;
                    case 'fa-sort-down': $closeAccordionIcon = 'fa-sort-up';
                    break;
                }
            }
        ?>

        <div <?php echo $faqSchema ? 'itemscope itemtype="https://schema.org/FAQPage" ' : ''; ?> class="mighty-accordion" data-enable-multiple="<?php echo $openMultiple; ?>" data-first-active="<?php echo $firstActive; ?>" data-open-all="<?php echo $openAll; ?>">
            <?php
            foreach (  $settings['tabs'] as $index => $tab ) :
                $tabId = substr( $this->get_id_int(), 0, 3 ) . ( $index + 1 );

                $accordionIcon = '<i aria-hidden="true" class="accordion-icon fas ' . $openAccordionIcon .'"></i>';
                $accordionActiveIcon = '<i aria-hidden="true" class="accordion-active-icon fas ' . $closeAccordionIcon .'"></i>';
            ?>
                <div <?php echo $faqSchema ? 'itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" ' : ''; ?> class="mt-panel elementor-repeater-item-<?php echo $tab['_id']; ?>">
                    <div class="accordion accordion-<?php echo $tabId; ?><?php echo $firstActive; ?> <?php echo $settings['icon_align'] == "left" ? 'icons-left' : 'icons-right'; ?>">

                        <?php if ( $settings['icon_align'] == "left" ) { ?>
                        <div class="accordion-icons">
                            <?php echo $accordionIcon; ?>
                            <?php echo $accordionActiveIcon; ?>
                        </div>
                        <?php } ?>

                        <<?php echo $titleTag; ?><?php echo $faqSchema ? ' itemprop="name"' : ''; ?> class="mt-accordion-title">
                            <?php
                            if ( isset( $tab['accordion_main_icon'] ) ) {
                                if ( $tab['accordion_main_icon']['library'] == "svg" ) {
                                    Icons_Manager::render_icon( $tab['accordion_main_icon'], [ 'aria-hidden' => 'true' ] );
                                } elseif ( substr_count($tab['accordion_main_icon']['library'], "fa-") ) {
                                    echo '<i aria-hidden="true" class="accordion-icon-main ' . $tab['accordion_main_icon']['value'].'"></i>';
                                }
                            }
                            ?>
                            <?php echo $tab['accordion_title']; ?>
                        </<?php echo $titleTag; ?>>
                        
                        <?php if ( $settings['icon_align'] == "right" ) { ?>
                        <div class="accordion-icons">
                            <?php echo $accordionIcon; ?>
                            <?php echo $accordionActiveIcon; ?>
                        </div>
                        <?php } ?>
                        
                    </div>
                    <div <?php echo $faqSchema ? 'itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" ' : ''; ?> class="panel">
                        <div itemprop="text" class="accordion-content">
                            <?php echo $tab['accordion_content']; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
		<?php
	}
}
