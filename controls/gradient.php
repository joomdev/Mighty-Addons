<?php
/**
 * Class Gradient
 * 
 * @since 1.1.0
 */
namespace Mighty_Addons\Controls;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;

/**
 * Elementor Text Gradient Control.
 */
class Group_Control_Text_Gradient extends \Elementor\Group_Control_Base {

    /**
     * Fields.
     *
     * Holds all the Text Gradient control fields.
     *
     * @access protected
     * @static
     *
     * @var array Text Gradient control fields.
     */
    protected static $fields;

    /**
     * Get Text Gradient control type.
     *
     * Retrieve the control type, in this case `ha_text_color`.
     *
     * @access public
     * @static
     *
     * @return string Control type.
     */
    public static function get_type() {
        return 'text-gradient';
    }

    /**
     * Init fields.
     *
     * Initialize Text Gradient control fields.
     *
     * @access public
     *
     * @return array Control fields.
     */
    public function init_fields() {
        $fields = [];

        $fields['color_type'] = [
            'label' => _x( 'Text Color', 'Background Control', 'mighty' ),
            'type' => Controls_Manager::CHOOSE,
            'label_block' => false,
            'render_type' => 'ui',
            'options' => [
                'gradient' => [
                    'title' => _x( 'Gradient', 'Text Color Control', 'mighty' ),
                    'icon' => 'fa fa-barcode',
                ],
            ],
            'default' => 'gradient'
        ];

        $fields['color'] = [
            'label' => _x( 'Color', 'mighty' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#09009f',
            'title' => _x( 'Text Color', 'mighty' ),
            'selectors' => [
                '{{SELECTOR}}' => 'color: {{VALUE}};',
            ],
            'condition' => [
                'color_type' => [ 'gradient' ],
            ],
        ];

        $fields['color_stop'] = [
            'label' => _x( 'Location', 'Background Control', 'mighty' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => [ '%' ],
            'default' => [
                'unit' => '%',
                'size' => 30,
            ],
            'render_type' => 'ui',
            'condition' => [
                'color_type' => [ 'gradient' ],
            ],
            'of_type' => 'gradient',
        ];

        $fields['color_b'] = [
            'label' => _x( 'Second Color', 'Background Control', 'mighty' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#00c4ce',
            'render_type' => 'ui',
            'condition' => [
                'color_type' => [ 'gradient' ],
            ],
            'of_type' => 'gradient',
        ];

        $fields['color_b_stop'] = [
            'label' => _x( 'Location', 'Background Control', 'mighty' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => [ '%' ],
            'default' => [
                'unit' => '%',
                'size' => 72,
            ],
            'render_type' => 'ui',
            'condition' => [
                'color_type' => [ 'gradient' ],
            ],
            'of_type' => 'gradient',
        ];

        $fields['gradient_type'] = [
            'label' => _x( 'Type', 'Background Control', 'mighty' ),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'linear' => _x( 'Linear', 'Background Control', 'mighty' ),
                'radial' => _x( 'Radial', 'Background Control', 'mighty' ),
            ],
            'default' => 'linear',
            'render_type' => 'ui',
            'condition' => [
                'color_type' => [ 'gradient' ],
            ],
            'of_type' => 'gradient',
        ];

        $fields['gradient_angle'] = [
            'label' => _x( 'Angle', 'Background Control', 'mighty' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => [ 'deg' ],
            'default' => [
                'unit' => 'deg',
                'size' => 170,
            ],
            'range' => [
                'deg' => [
                    'step' => 10,
                ],
            ],
            'selectors' => [
                '{{SELECTOR}}' => '-webkit-background-clip: text; -webkit-text-fill-color: transparent; background-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{color.VALUE}} {{color_stop.SIZE}}{{color_stop.UNIT}}, {{color_b.VALUE}} {{color_b_stop.SIZE}}{{color_b_stop.UNIT}})',
            ],
            'condition' => [
                'color_type' => [ 'gradient' ],
                'gradient_type' => 'linear',
            ],
            'of_type' => 'gradient',
        ];

        $fields['gradient_position'] = [
            'label' => _x( 'Position', 'Background Control', 'mighty' ),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'center center' => _x( 'Center Center', 'Background Control', 'mighty' ),
                'center left' => _x( 'Center Left', 'Background Control', 'mighty' ),
                'center right' => _x( 'Center Right', 'Background Control', 'mighty' ),
                'top center' => _x( 'Top Center', 'Background Control', 'mighty' ),
                'top left' => _x( 'Top Left', 'Background Control', 'mighty' ),
                'top right' => _x( 'Top Right', 'Background Control', 'mighty' ),
                'bottom center' => _x( 'Bottom Center', 'Background Control', 'mighty' ),
                'bottom left' => _x( 'Bottom Left', 'Background Control', 'mighty' ),
                'bottom right' => _x( 'Bottom Right', 'Background Control', 'mighty' ),
            ],
            'default' => 'center center',
            'selectors' => [
                '{{SELECTOR}}' => '-webkit-background-clip: text; -webkit-text-fill-color: transparent; background-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{color.VALUE}} {{color_stop.SIZE}}{{color_stop.UNIT}}, {{color_b.VALUE}} {{color_b_stop.SIZE}}{{color_b_stop.UNIT}})',
            ],
            'condition' => [
                'color_type' => [ 'gradient' ],
                'gradient_type' => 'radial',
            ],
            'of_type' => 'gradient',
        ];
        return $fields;
    }

    /**
     * Get child default args.
     *
     * Retrieve the default arguments for all the child controls for a specific group
     * control.
     *
     * @access protected
     *
     * @return array Default arguments for all the child controls.
     */
    protected function get_child_default_args() {
        return [
            'types' => [ 'gradient' ],
        ];
    }

    /**
     * Filter fields.
     *
     * Filter which controls to display, using `include`, `exclude`, `condition`
     * and `of_type` arguments.
     *
     * @access protected
     *
     * @return array Control fields.
     */
    protected function filter_fields() {
        $fields = parent::filter_fields();

        $args = $this->get_args();

        foreach ( $fields as &$field ) {
            if ( isset( $field['of_type'] ) && ! in_array( $field['of_type'], $args['types'] ) ) {
                unset( $field );
            }
        }

        return $fields;
    }

    /**
     * Get default options.
     *
     * Retrieve the default options of the Text Gradient control. Used to return the
     * default options while initializing the Text Gradient control.
     *
     * @access protected
     *
     * @return array Default Text Gradient control options.
     */
    protected function get_default_options() {
        return [
            'popover' => false,
        ];
    }
}
