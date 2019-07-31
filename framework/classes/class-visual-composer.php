<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

class Lapa_Visual_Composer{

    protected $category;

    public function __construct(){
        if(!class_exists('Vc_Manager')) return false;
        $this->load_hooks();
    }

    private function load_hooks(){
        $this->category = esc_html_x( 'La Studio', 'admin-view', 'torresdigital');
        add_action( 'vc_before_init', array( $this, 'vc_before_init') );
        add_action( 'vc_after_init', array( $this, 'vc_after_init') );
        add_filter( 'vc_tta_container_classes', array( $this, 'vc_tta_container_classes'), 12, 2 );
        add_filter( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG , array( $this, 'modify_shortcode_css_class_output' ), 12, 3 );
    }

    public function vc_before_init(){
        vc_automapper()->setDisabled( true );
        vc_manager()->disableUpdater( true );
        vc_manager()->setIsAsTheme( true );
        if(class_exists( 'WooCommerce' )){
            remove_action( 'wp_enqueue_scripts', 'vc_woocommerce_add_to_cart_script' );
        }
        add_filter('vc_map_get_param_defaults', array( $this, 'change_css_animation_value' ), 10, 2);
    }

    public function vc_after_init(){
        $this->overrideVcSection();
        $this->overrideProgressBar();
        $this->overridePieChart();
        $this->overrideTtaAccordion();
        $this->overrideTtaTabs();
        $this->overrideTtaTour();
        $this->overrideTtaSection();

        if( function_exists('vc_set_default_editor_post_types') ){
            $list = array(
                'page',
                'post',
                'la_block',
                'la_portfolio'
            );
            vc_set_default_editor_post_types( $list );
        }
    }

    public function change_css_animation_value($value, $param){
        if( 'css_animation' ==  $param['param_name'] && 'none' == $value){
            $value = '';
        }
        return $value;
    }

    public function modify_shortcode_css_class_output($css_classes, $shortcode_name, $atts){
        if ( $shortcode_name == 'vc_progress_bar' ){
            if( isset($atts['display_type']) ){
                $css_classes .= ' vc_progress_bar_' . esc_attr($atts['display_type']);
            }
        }
        if ( $shortcode_name == 'vc_tta_tabs' || $shortcode_name == 'vc_tta_accordion' || $shortcode_name == 'vc_tta_tour' ){
            if( isset($atts['style']) && strpos($atts['style'], 'la-') !== false ){
                $css_classes = preg_replace('/ vc_tta-(o|shape|spacing|gap|color)[0-9a-zA-Z\_\-]+/','',$css_classes);
                if($shortcode_name == 'vc_tta_tabs'){
                    $css_classes .= ' vc_tta-o-no-fill';
                    $css_classes = str_replace('vc_tta-style-','tabs-',$css_classes);
                    $css_classes = str_replace('vc_general ','',$css_classes);
                }
                if($shortcode_name == 'vc_tta_tour'){
                    $css_classes = str_replace('vc_tta-style-','tour-',$css_classes);
                    $css_classes = str_replace('vc_general ','',$css_classes);
                }
            }
        }
        if($shortcode_name == 'vc_btn'){
            if(!empty($atts['style']) && in_array($atts['style'], array('modern', 'outline', 'custom', 'outline-custom'))){
                if( false !== strpos( $css_classes, 'vc_btn3-container')){
                    $css_classes .= ' la-vc-btn';
                }
            }
        }

        if ( $shortcode_name == 'vc_row' ) {
            $css_classes .= ' la_fp_slide la_fp_child_section';
        }

        return $css_classes;
    }

    public function vc_tta_container_classes($classes, $atts){
        if(isset($atts['style']) && strpos($atts['style'],'la-') !== false && isset($atts['alignment'])){
            $classes[] = 'vc_tta-' . $atts['style'];
            $classes[] = 'vc_tta-alignment-' . $atts['alignment'];
        }
        return $classes;
    }

    private function overrideProgressBar(){
        vc_map_update( 'vc_progress_bar', array(
            'category' => $this->category,
            'params' => array(
                array(
                    'type' => 'param_group',
                    'heading' => __( 'Values', 'torresdigital' ),
                    'param_name' => 'values',
                    'description' => __( 'Enter values for graph - value, title and color.', 'torresdigital' ),
                    'value' => urlencode( json_encode( array(
                        array(
                            'label' => __( 'Development', 'torresdigital' ),
                            'value' => '90',
                        ),
                        array(
                            'label' => __( 'Design', 'torresdigital' ),
                            'value' => '80',
                        ),
                        array(
                            'label' => __( 'Marketing', 'torresdigital' ),
                            'value' => '70',
                        ),
                    ) ) ),
                    'params' => array(
                        array(
                            'type' => 'textfield',
                            'heading' => __( 'Label', 'torresdigital' ),
                            'param_name' => 'label',
                            'description' => __( 'Enter text used as title of bar.', 'torresdigital' ),
                            'admin_label' => true,
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => __( 'Value', 'torresdigital' ),
                            'param_name' => 'value',
                            'description' => __( 'Enter value of bar.', 'torresdigital' ),
                            'admin_label' => true,
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => __( 'Color', 'torresdigital' ),
                            'param_name' => 'color',
                            'value' => array(
                                    __( 'Default', 'torresdigital' ) => '',
                                ) + array(
                                    __( 'Classic Grey', 'torresdigital' ) => 'bar_grey',
                                    __( 'Classic Blue', 'torresdigital' ) => 'bar_blue',
                                    __( 'Classic Turquoise', 'torresdigital' ) => 'bar_turquoise',
                                    __( 'Classic Green', 'torresdigital' ) => 'bar_green',
                                    __( 'Classic Orange', 'torresdigital' ) => 'bar_orange',
                                    __( 'Classic Red', 'torresdigital' ) => 'bar_red',
                                    __( 'Classic Black', 'torresdigital' ) => 'bar_black',
                                ) + getVcShared( 'colors-dashed' ) + array(
                                    __( 'Gradient', 'torresdigital' ) => 'gradient',
                                    __( 'Custom Color', 'torresdigital' ) => 'custom'
                                ),
                            'description' => __( 'Select single bar background color.', 'torresdigital' ),
                            'admin_label' => true,
                            'param_holder_class' => 'vc_colored-dropdown',
                        ),
                        array(
                            'type' => 'colorpicker',
                            'heading' => __( 'Custom color', 'torresdigital' ),
                            'param_name' => 'customcolor',
                            'description' => __( 'Select custom single bar background color.', 'torresdigital' ),
                            'dependency' => array(
                                'element' => 'color',
                                'value' => array( 'custom' ),
                            ),
                        ),
                        array(
                            'type' => 'colorpicker',
                            'heading' => __( 'Custom text color', 'torresdigital' ),
                            'param_name' => 'customtxtcolor',
                            'description' => __( 'Select custom single bar text color.', 'torresdigital' ),
                            'dependency' => array(
                                'element' => 'color',
                                'value' => array( 'custom' ),
                            )
                        ),
                    ),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __( 'Units', 'torresdigital' ),
                    'param_name' => 'units',
                    'description' => __( 'Enter measurement units (Example: %, px, points, etc. Note: graph value and units will be appended to graph title).', 'torresdigital' ),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Color', 'torresdigital' ),
                    'param_name' => 'bgcolor',
                    'value' => array(
                            __( 'Classic Grey', 'torresdigital' ) => 'bar_grey',
                            __( 'Classic Blue', 'torresdigital' ) => 'bar_blue',
                            __( 'Classic Turquoise', 'torresdigital' ) => 'bar_turquoise',
                            __( 'Classic Green', 'torresdigital' ) => 'bar_green',
                            __( 'Classic Orange', 'torresdigital' ) => 'bar_orange',
                            __( 'Classic Red', 'torresdigital' ) => 'bar_red',
                            __( 'Classic Black', 'torresdigital' ) => 'bar_black',
                        ) + getVcShared( 'colors-dashed' ) + array(
                            __( 'Gradient', 'torresdigital' ) => 'gradient',
                            __( 'Custom Color', 'torresdigital' ) => 'custom'
                        ),
                    'description' => __( 'Select bar background color.', 'torresdigital' ),
                    'admin_label' => true,
                    'param_holder_class' => 'vc_colored-dropdown',
                ),
                array(
                    'type' => 'colorpicker',
                    'heading' => __( 'Bar custom background color', 'torresdigital' ),
                    'param_name' => 'custombgcolor',
                    'description' => __( 'Select custom background color for bars.', 'torresdigital' ),
                    'dependency' => array(
                        'element' => 'bgcolor',
                        'value' => array( 'custom' ),
                    ),
                ),
                array(
                    'type' => 'colorpicker',
                    'heading' => __( 'Bar custom text color', 'torresdigital' ),
                    'param_name' => 'customtxtcolor',
                    'description' => __( 'Select custom text color for bars.', 'torresdigital' ),
                    'dependency' => array(
                        'element' => 'bgcolor',
                        'value' => array( 'custom' ),
                    ),
                ),
                array(
                    'type' => 'checkbox',
                    'heading' => __( 'Options', 'torresdigital' ),
                    'param_name' => 'options',
                    'value' => array(
                        __( 'Add stripes', 'torresdigital' ) => 'striped',
                        __( 'Add animation (Note: visible only with striped bar).', 'torresdigital' ) => 'animated',
                    ),
                ),
                vc_map_add_css_animation(),
                array(
                    'type' => 'el_id',
                    'heading' => __( 'Element ID', 'torresdigital' ),
                    'param_name' => 'el_id'
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __( 'Extra class name', 'torresdigital' ),
                    'param_name' => 'el_class',
                    'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'torresdigital' ),
                ),
                array(
                    'type' => 'css_editor',
                    'heading' => __( 'CSS box', 'torresdigital' ),
                    'param_name' => 'css',
                    'group' => __( 'Design Options', 'torresdigital' ),
                ),
            )
        ));
    }

    private function overridePieChart(){
        $shortcode_tag = 'vc_pie';
        $shortcode_object = vc_get_shortcode($shortcode_tag);
        $shortcode_params = $shortcode_object['params'];

        $shortcode_params = array(
            array(
                'type' => 'dropdown',
                'param_name' => 'style',
                'value' => array(
                    esc_html_x( 'Style 01', 'admin-view', 'torresdigital' ) => '1',
                    esc_html_x( 'Style 02', 'admin-view', 'torresdigital' ) => '2',
                ),
                'default'   => '1',
                'heading' => esc_html_x( 'Style', 'admin-view', 'torresdigital' ),
                'description' => esc_html_x( 'Select display style.', 'admin-view', 'torresdigital' )
            )
        ) + $shortcode_params ;

        vc_map_update( $shortcode_tag , array(
            'category' => $this->category,
            'params'   => $shortcode_params
        ));
    }

    private function overrideTtaAccordion(){
        vc_map_update('vc_tta_accordion' , array(
            'category' => $this->category,
            'params' => array(
                array(
                    'type' => 'dropdown',
                    'param_name' => 'style',
                    'value' => array(
                        esc_html_x( 'Lapa 01', 'admin-view', 'torresdigital' ) => 'la-1',
                        esc_html_x( 'Lapa 02', 'admin-view', 'torresdigital' ) => 'la-2',
                        esc_html_x( 'Lapa 03', 'admin-view', 'torresdigital' ) => 'la-3',
                        esc_html_x( 'Classic', 'admin-view', 'torresdigital' ) => 'classic',
                        esc_html_x( 'Modern', 'admin-view', 'torresdigital' ) => 'modern',
                        esc_html_x( 'Flat', 'admin-view', 'torresdigital' ) => 'flat',
                        esc_html_x( 'Outline', 'admin-view', 'torresdigital' ) => 'outline',
                    ),
                    'heading' => esc_html_x( 'Style', 'admin-view', 'torresdigital' ),
                    'description' => esc_html_x( 'Select accordion display style.', 'admin-view', 'torresdigital' ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'shape',
                    'value' => array(
                        esc_html_x( 'Rounded', 'admin-view', 'torresdigital' ) => 'rounded',
                        esc_html_x( 'Square', 'admin-view', 'torresdigital' ) => 'square',
                        esc_html_x( 'Round', 'admin-view', 'torresdigital' ) => 'round',
                    ),
                    'heading' => esc_html_x( 'Shape', 'admin-view', 'torresdigital' ),
                    'description' => esc_html_x( 'Select accordion shape.', 'admin-view', 'torresdigital' ),
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('classic','modern','flat','outline')
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'color',
                    'value' => getVcShared( 'colors-dashed' ),
                    'std' => 'grey',
                    'heading' => esc_html_x( 'Color', 'admin-view', 'torresdigital' ),
                    'description' => esc_html_x( 'Select accordion color.', 'admin-view', 'torresdigital' ),
                    'param_holder_class' => 'vc_colored-dropdown',
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('classic','modern','flat','outline')
                    ),
                ),
                array(
                    'type' => 'checkbox',
                    'param_name' => 'no_fill',
                    'heading' => esc_html_x( 'Do not fill content area?', 'admin-view', 'torresdigital' ),
                    'description' => esc_html_x( 'Do not fill content area with color.', 'admin-view', 'torresdigital' ),
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('classic','modern','flat','outline')
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'spacing',
                    'value' => array(
                        esc_html_x( 'None', 'admin-view', 'torresdigital' ) => '',
                        '1px' => '1',
                        '2px' => '2',
                        '3px' => '3',
                        '4px' => '4',
                        '5px' => '5',
                        '10px' => '10',
                        '15px' => '15',
                        '20px' => '20',
                        '25px' => '25',
                        '30px' => '30',
                        '35px' => '35',
                    ),
                    'heading' => esc_html_x( 'Spacing', 'admin-view', 'torresdigital' ),
                    'description' => esc_html_x( 'Select accordion spacing.', 'admin-view', 'torresdigital' ),
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('classic','modern','flat','outline')
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'gap',
                    'value' => array(
                        esc_html_x( 'None', 'admin-view', 'torresdigital' ) => '',
                        '1px' => '1',
                        '2px' => '2',
                        '3px' => '3',
                        '4px' => '4',
                        '5px' => '5',
                        '10px' => '10',
                        '15px' => '15',
                        '20px' => '20',
                        '25px' => '25',
                        '30px' => '30',
                        '35px' => '35',
                    ),
                    'heading' => esc_html_x( 'Gap', 'admin-view', 'torresdigital' ),
                    'description' => esc_html_x( 'Select accordion gap.', 'admin-view', 'torresdigital' ),
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('classic','modern','flat','outline')
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'c_align',
                    'value' => array(
                        esc_html_x( 'Left', 'admin-view', 'torresdigital' ) => 'left',
                        esc_html_x( 'Right', 'admin-view', 'torresdigital' ) => 'right',
                        esc_html_x( 'Center', 'admin-view', 'torresdigital' ) => 'center',
                    ),
                    'heading' => esc_html_x( 'Alignment', 'admin-view', 'torresdigital' ),
                    'description' => esc_html_x( 'Select accordion section title alignment.', 'admin-view', 'torresdigital' ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'autoplay',
                    'value' => array(
                        esc_html_x( 'None', 'admin-view', 'torresdigital' ) => 'none',
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',
                        '10' => '10',
                        '20' => '20',
                        '30' => '30',
                        '40' => '40',
                        '50' => '50',
                        '60' => '60',
                    ),
                    'std' => 'none',
                    'heading' => esc_html_x( 'Autoplay', 'admin-view', 'torresdigital' ),
                    'description' => esc_html_x( 'Select auto rotate for accordion in seconds (Note: disabled by default).', 'admin-view', 'torresdigital' ),
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('classic','modern','flat','outline')
                    ),
                ),
                array(
                    'type' => 'checkbox',
                    'param_name' => 'collapsible_all',
                    'heading' => esc_html_x( 'Allow collapse all?', 'admin-view', 'torresdigital' ),
                    'description' => esc_html_x( 'Allow collapse all accordion sections.', 'admin-view', 'torresdigital' ),
                ),
                // Control Icons
                array(
                    'type' => 'dropdown',
                    'param_name' => 'c_icon',
                    'value' => array(
                        esc_html_x( 'None', 'admin-view', 'torresdigital' ) => '',
                        esc_html_x( 'Chevron', 'admin-view', 'torresdigital' ) => 'chevron',
                        esc_html_x( 'Plus', 'admin-view', 'torresdigital' ) => 'plus',
                        esc_html_x( 'Triangle', 'admin-view', 'torresdigital' ) => 'triangle',
                    ),
                    'std' => 'plus',
                    'heading' => esc_html_x( 'Icon', 'admin-view', 'torresdigital' ),
                    'description' => esc_html_x( 'Select accordion navigation icon.', 'admin-view', 'torresdigital' ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'c_position',
                    'value' => array(
                        esc_html_x( 'Left', 'admin-view', 'torresdigital' ) => 'left',
                        esc_html_x( 'Right', 'admin-view', 'torresdigital' ) => 'right',
                    ),
                    'dependency' => array(
                        'element' => 'c_icon',
                        'not_empty' => true,
                    ),
                    'heading' => esc_html_x( 'Position', 'admin-view', 'torresdigital' ),
                    'description' => esc_html_x( 'Select accordion navigation icon position.', 'admin-view', 'torresdigital' ),
                ),
                // Control Icons END
                array(
                    'type' => 'textfield',
                    'param_name' => 'active_section',
                    'heading' => esc_html_x( 'Active section', 'admin-view', 'torresdigital' ),
                    'value' => 1,
                    'description' => esc_html_x( 'Enter active section number (Note: to have all sections closed on initial load enter non-existing number).', 'admin-view', 'torresdigital' ),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html_x( 'Extra class name', 'admin-view', 'torresdigital' ),
                    'param_name' => 'el_class',
                    'description' => esc_html_x( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'admin-view', 'torresdigital' ),
                ),
            )
        ));
    }

    private function overrideTtaTabs(){
        vc_map_update( 'vc_tta_tabs', array(
            'category' => $this->category,
            'params' => array(
                array(
                    'type' => 'textfield',
                    'param_name' => 'title',
                    'heading' => _x( 'Widget title', 'admin-view', 'torresdigital' ),
                    'description' => _x( 'Enter text used as widget title (Note: located above content element).', 'admin-view', 'torresdigital' ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'style',
                    'value' => array(
                        esc_html_x( 'Lapa 01', 'admin-view', 'torresdigital' ) => 'la-1',
                        esc_html_x( 'Lapa 02', 'admin-view', 'torresdigital' ) => 'la-2',
                        esc_html_x( 'Lapa 03', 'admin-view', 'torresdigital' ) => 'la-3',
                        esc_html_x( 'Lapa 04', 'admin-view', 'torresdigital' ) => 'la-4',
                        esc_html_x( 'Lapa 05', 'admin-view', 'torresdigital' ) => 'la-5',
                        esc_html_x( 'Lapa 06', 'admin-view', 'torresdigital' ) => 'la-6',
                        esc_html_x( 'Classic', 'admin-view', 'torresdigital' ) => 'classic',
                        esc_html_x( 'Modern', 'admin-view', 'torresdigital' ) => 'modern',
                        esc_html_x( 'Flat', 'admin-view', 'torresdigital' ) => 'flat',
                        esc_html_x( 'Outline', 'admin-view', 'torresdigital' ) => 'outline',
                    ),
                    'heading' => esc_html_x( 'Style', 'admin-view', 'torresdigital' ),
                    'description' => esc_html_x( 'Select tabs display style.', 'admin-view', 'torresdigital' ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'shape',
                    'value' => array(
                        esc_html_x( 'Rounded', 'admin-view', 'torresdigital' ) => 'rounded',
                        esc_html_x( 'Square', 'admin-view', 'torresdigital' ) => 'square',
                        esc_html_x( 'Round', 'admin-view', 'torresdigital' ) => 'round',
                    ),
                    'heading' => esc_html_x( 'Shape', 'admin-view', 'torresdigital' ),
                    'description' => esc_html_x( 'Select tabs shape.', 'admin-view', 'torresdigital' ),
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('classic','modern','flat','outline')
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'color',
                    'heading' => esc_html_x( 'Color', 'admin-view', 'torresdigital' ),
                    'description' => esc_html_x( 'Select tabs color.', 'admin-view', 'torresdigital' ),
                    'value' => getVcShared( 'colors-dashed' ),
                    'std' => 'grey',
                    'param_holder_class' => 'vc_colored-dropdown',
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('classic','modern','flat','outline')
                    ),
                ),

                array(
                    'type' => 'checkbox',
                    'param_name' => 'no_fill_content_area',
                    'heading' => esc_html_x( 'Do not fill content area?', 'admin-view', 'torresdigital' ),
                    'std' => 'true',
                    'description' => esc_html_x( 'Do not fill content area with color.', 'admin-view', 'torresdigital' ),
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('classic','modern','flat','outline')
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'spacing',
                    'value' => array(
                        esc_html_x( 'None', 'admin-view', 'torresdigital' ) => '',
                        '1px' => '1',
                        '2px' => '2',
                        '3px' => '3',
                        '4px' => '4',
                        '5px' => '5',
                        '10px' => '10',
                        '15px' => '15',
                        '20px' => '20',
                        '25px' => '25',
                        '30px' => '30',
                        '35px' => '35',
                    ),
                    'heading' => esc_html_x( 'Spacing', 'admin-view', 'torresdigital' ),
                    'description' => esc_html_x( 'Select tabs spacing.', 'admin-view', 'torresdigital' ),
                    'std' => '',
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('classic','modern','flat','outline')
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'gap',
                    'value' => array(
                        esc_html_x( 'None', 'admin-view', 'torresdigital' ) => '',
                        '1px' => '1',
                        '2px' => '2',
                        '3px' => '3',
                        '4px' => '4',
                        '5px' => '5',
                        '10px' => '10',
                        '15px' => '15',
                        '20px' => '20',
                        '25px' => '25',
                        '30px' => '30',
                        '35px' => '35',
                    ),
                    'heading' => esc_html_x( 'Gap', 'admin-view', 'torresdigital' ),
                    'description' => esc_html_x( 'Select tabs gap.', 'admin-view', 'torresdigital' ),
                    'std' => '',
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('classic','modern','flat','outline')
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'tab_position',
                    'value' => array(
                        esc_html_x( 'Top', 'admin-view', 'torresdigital' ) => 'top',
                        esc_html_x( 'Bottom', 'admin-view', 'torresdigital' ) => 'bottom',
                    ),
                    'heading' => esc_html_x( 'Position', 'admin-view', 'torresdigital' ),
                    'description' => esc_html_x( 'Select tabs navigation position.', 'admin-view', 'torresdigital' ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'alignment',
                    'value' => array(
                        esc_html_x( 'Left', 'admin-view', 'torresdigital' ) => 'left',
                        esc_html_x( 'Right', 'admin-view', 'torresdigital' ) => 'right',
                        esc_html_x( 'Center', 'admin-view', 'torresdigital' ) => 'center',
                    ),
                    'heading' => esc_html_x( 'Alignment', 'admin-view', 'torresdigital' ),
                    'description' => esc_html_x( 'Select tabs section title alignment.', 'admin-view', 'torresdigital' ),
                    'std' => 'center',
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'autoplay',
                    'value' => array(
                        esc_html_x( 'None', 'admin-view', 'torresdigital' ) => 'none',
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',
                        '10' => '10',
                        '20' => '20',
                        '30' => '30',
                        '40' => '40',
                        '50' => '50',
                        '60' => '60',
                    ),
                    'std' => 'none',
                    'heading' => esc_html_x( 'Autoplay', 'admin-view', 'torresdigital' ),
                    'description' => esc_html_x( 'Select auto rotate for tabs in seconds (Note: disabled by default).', 'admin-view', 'torresdigital' ),
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('classic','modern','flat','outline')
                    ),
                ),
                array(
                    'type' => 'textfield',
                    'param_name' => 'active_section',
                    'heading' => esc_html_x( 'Active section', 'admin-view', 'torresdigital' ),
                    'value' => 1,
                    'description' => esc_html_x( 'Enter active section number (Note: to have all sections closed on initial load enter non-existing number).', 'admin-view', 'torresdigital' ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'pagination_style',
                    'value' => array(
                        esc_html_x( 'None', 'admin-view', 'torresdigital' ) => '',
                        esc_html_x( 'Square Dots', 'admin-view', 'torresdigital' ) => 'outline-square',
                        esc_html_x( 'Radio Dots', 'admin-view', 'torresdigital' ) => 'outline-round',
                        esc_html_x( 'Point Dots', 'admin-view', 'torresdigital' ) => 'flat-round',
                        esc_html_x( 'Fill Square Dots', 'admin-view', 'torresdigital' ) => 'flat-square',
                        esc_html_x( 'Rounded Fill Square Dots', 'admin-view', 'torresdigital' ) => 'flat-rounded',
                    ),
                    'heading' => esc_html_x( 'Pagination style', 'admin-view', 'torresdigital' ),
                    'description' => esc_html_x( 'Select pagination style.', 'admin-view', 'torresdigital' ),
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('classic','modern','flat','outline')
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'pagination_color',
                    'value' => getVcShared( 'colors-dashed' ),
                    'heading' => esc_html_x( 'Pagination color', 'admin-view', 'torresdigital' ),
                    'description' => esc_html_x( 'Select pagination color.', 'admin-view', 'torresdigital' ),
                    'param_holder_class' => 'vc_colored-dropdown',
                    'std' => 'grey',
                    'dependency' => array(
                        'element' => 'pagination_style',
                        'not_empty' => true,
                    ),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html_x( 'Extra class name', 'admin-view', 'torresdigital' ),
                    'param_name' => 'el_class',
                    'description' => esc_html_x( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'admin-view', 'torresdigital' ),
                ),
                array(
                    'type' => 'css_editor',
                    'heading' => esc_html_x( 'CSS box', 'admin-view', 'torresdigital' ),
                    'param_name' => 'css',
                    'group' => esc_html_x( 'Design Options', 'admin-view', 'torresdigital' ),
                ),
            )
        ));
    }

    private function overrideTtaSection(){
        $shortcode_tag = 'vc_tta_section';
        $shortcode_object = vc_get_shortcode($shortcode_tag);
        $shortcode_params = $shortcode_object['params'];
        $i_type_idx = self::getParamIndex($shortcode_params,'i_type');
        $el_class_idx = self::getParamIndex($shortcode_params,'el_class');
        if($i_type_idx !== -1 && $el_class_idx !== -1){
            $el_class = $shortcode_params[$el_class_idx];
            $shortcode_params[$i_type_idx]['value'][esc_html_x('LaStudio Icon Outline', 'admin-view', 'torresdigital')] = 'la_icon_outline';
            $shortcode_params[$el_class_idx] = array (
                'type' => 'iconpicker',
                'heading' => _x( 'Icon', 'admin-view', 'torresdigital' ),
                'param_name' => 'i_icon_la_icon_outline',
                'value' => 'la-icon design-2_image',
                'settings' => array(
                    'emptyIcon' => false,
                    'type' => 'la_icon_outline',
                    'iconsPerPage' => 50,
                ),
                'dependency' => array(
                    'element' => 'i_type',
                    'value' => 'la_icon_outline',
                )
            );
            $shortcode_params[] = $el_class;
            vc_map_update($shortcode_tag , array(
                'params' => $shortcode_params
            ));
        }
    }

    private function overrideTtaTour(){
        vc_map_update( 'vc_tta_tour', array(
            'category' => $this->category,
            'params' => array(
                array(
                    'type' => 'dropdown',
                    'param_name' => 'style',
                    'value' => array(
                        esc_html_x( 'Lapa 01', 'admin-view', 'torresdigital' ) => 'la-1',
                    ),
                    'heading' => esc_html_x( 'Style', 'admin-view', 'torresdigital' ),
                    'description' => esc_html_x( 'Select tabs display style.', 'admin-view', 'torresdigital' ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'tab_position',
                    'value' => array(
                        esc_html_x( 'Left', 'admin-view', 'torresdigital' ) => 'left',
                        esc_html_x( 'Right', 'admin-view', 'torresdigital' ) => 'right',
                    ),
                    'heading' => esc_html_x( 'Position', 'admin-view', 'torresdigital' ),
                    'description' => esc_html_x( 'Select tour navigation position.', 'admin-view', 'torresdigital' ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'alignment',
                    'value' => array(
                        esc_html_x( 'Left', 'admin-view', 'torresdigital' ) => 'left',
                        esc_html_x( 'Right', 'admin-view', 'torresdigital' ) => 'right',
                        esc_html_x( 'Center', 'admin-view', 'torresdigital' ) => 'center',
                    ),
                    'heading' => esc_html_x( 'Alignment', 'admin-view', 'torresdigital' ),
                    'description' => esc_html_x( 'Select tabs section title alignment.', 'admin-view', 'torresdigital' ),
                    'std' => 'center',
                ),
                array(
                    'type' => 'hidden',
                    'param_name' => 'autoplay',
                    'std' => 'none',
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'controls_size',
                    'value' => array(
                        esc_html_x( 'Auto', 'admin-view', 'torresdigital' ) => '',
                        esc_html_x( 'Extra large', 'admin-view', 'torresdigital' ) => 'xl',
                        esc_html_x( 'Large', 'admin-view', 'torresdigital' ) => 'lg',
                        esc_html_x( 'Medium', 'admin-view', 'torresdigital' ) => 'md',
                        esc_html_x( 'Small', 'admin-view', 'torresdigital' ) => 'sm',
                        esc_html_x( 'Extra small', 'admin-view', 'torresdigital' ) => 'xs',
                    ),
                    'heading' => esc_html_x( 'Navigation width', 'admin-view', 'torresdigital' ),
                    'description' => esc_html_x( 'Select tour navigation width.', 'admin-view', 'torresdigital' ),
                ),

                array(
                    'type' => 'textfield',
                    'param_name' => 'active_section',
                    'heading' => esc_html_x( 'Active section', 'admin-view', 'torresdigital' ),
                    'value' => 1,
                    'description' => esc_html_x( 'Enter active section number (Note: to have all sections closed on initial load enter non-existing number).', 'admin-view', 'torresdigital' ),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html_x( 'Extra class name', 'admin-view', 'torresdigital' ),
                    'param_name' => 'el_class',
                    'description' => esc_html_x( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'admin-view', 'torresdigital' ),
                ),
                array(
                    'type' => 'css_editor',
                    'heading' => esc_html_x( 'CSS box', 'admin-view', 'torresdigital' ),
                    'param_name' => 'css',
                    'group' => esc_html_x( 'Design Options', 'admin-view', 'torresdigital' ),
                ),
            )
        ));
    }

    private function overrideVcSection(){
        vc_add_params('vc_section', array(
            array(
                'type' => 'dropdown',
                'heading' => _x('Section Behaviour', 'admin-view', 'torresdigital'),
                'param_name' => 'fp_auto_height',
                'admin_label' => true,
                'value' => array(
                    _x('Full Height', 'admin-view', 'torresdigital') => 'off',
                    _x('Auto Height', 'admin-view', 'torresdigital') => 'on',
                    _x('Responsive Auto Height', 'admin-view', 'torresdigital') => 'responsive',
                    _x('Top Fixed Header', 'admin-view', 'torresdigital') => 'fixed_top',
                    _x('Bottom Fixed Footer', 'admin-view', 'torresdigital') => 'fixed_bottom',
                ),
                'description' => _x('Select section row behaviour.', 'admin-view', 'torresdigital'),
                'group' => esc_html_x('One Page Settings', 'admin-view', 'torresdigital'),
            ),
            array(
                'type' => 'textfield',
                'class' => '',
                'heading' => _x('Anchor', 'admin-view', 'torresdigital'),
                'param_name' => 'fp_anchor',
                'admin_label'   => true,
                'value' => '',
                'description' => _x('Enter an anchor (ID).', 'admin-view', 'torresdigital'),
                'dependency' => array('element' => 'fp_auto_height', 'value' => array('off', 'on', 'responsive')),
                'group' => esc_html_x('One Page Settings', 'admin-view', 'torresdigital'),
            ),
            array(
                'type' => 'textfield',
                'class' => '',
                'heading' => _x('Tooltip', 'admin-view', 'torresdigital'),
                'param_name' => 'fp_tooltip',
                'dependency' => array('element' => 'fp_auto_height', 'value' => array('off', 'on', 'responsive')),
                'value' => '',
                'group' => esc_html_x('One Page Settings', 'admin-view', 'torresdigital'),
            ),
            array(
                'type' => 'checkbox',
                'class' => '',
                'heading' => _x('Rows as Slides', 'admin-view', 'torresdigital'),
                'param_name' => 'fp_column_slide',
                'dependency' => array('element' => 'fp_auto_height', 'value' => array('off', 'on', 'responsive')),
                'value' => '',
                'group' => esc_html_x('One Page Settings', 'admin-view', 'torresdigital'),
                'description' => _x('Enable if you want to show each row in this section as slides.', 'admin-view', 'torresdigital'),
            ),
            array(
                'type' => 'checkbox',
                'class' => '',
                'heading' => _x('No Scrollbars', 'admin-view', 'torresdigital'),
                'param_name' => 'fp_no_scrollbar',
                'dependency' => array('element' => 'fp_auto_height', 'value' => array('off', 'on', 'responsive')),
                'value' => '',
                'group' => esc_html_x('One Page Settings', 'admin-view', 'torresdigital'),
                'description' => _x('Enable if scrolloverflow is enabled but you do not want to show scrollbars for this section.', 'admin-view', 'torresdigital'),
            )
        ));
    }

    public static function getParamIndex($array, $attr){
        foreach ($array as $index => $entry) {
            if ($entry['param_name'] == $attr) {
                return $index;
            }
        }
        return -1;
    }

}