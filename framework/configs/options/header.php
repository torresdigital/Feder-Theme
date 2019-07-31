<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}


/**
 * Header settings
 *
 * @param array $sections An array of our sections.
 * @return array
 */
function lapa_options_section_header( $sections ) {
    $sections['header'] = array(
        'name'          => 'header_panel',
        'title'         => esc_html_x('Header', 'admin-view', 'torresdigital'),
        'icon'          => 'fa fa-arrow-up',
        'sections' => array(
            array(
                'name'      => 'header_layout_sections',
                'title'     => esc_html_x('Layout', 'admin-view', 'torresdigital'),
                'icon'      => 'fa fa-cog',
                'fields'    => array(
                    array(
                        'id'        => 'header_layout',
                        'title'     => esc_html_x('Header Layout', 'admin-view', 'torresdigital'),
                        'type'      => 'image_select',
                        'radio'     => true,
                        'class'     => 'la-radio-style',
                        'default'   => '1',
                        'desc'      => esc_html_x('Controls the general layout of the header.', 'admin-view', 'torresdigital'),
                        'options'   => Lapa_Options::get_config_header_layout_opts(true, false)
                    ),
                    array(
                        'id'        => 'header_full_width',
                        'type'      => 'radio',
                        'default'   => 'no',
                        'class'     => 'la-radio-style',
                        'title'     => esc_html_x('100% Header Width', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('Turn on to have the header area display at 100% width according to the window size. Turn off to follow site width.', 'admin-view', 'torresdigital'),
                        'options'   => Lapa_Options::get_config_radio_opts(false),
                        'info'      => esc_html_x('This option do not allow for header type 5,6', 'admin-view', 'torresdigital')
                    ),
                    array(
                        'id'        => 'header_transparency',
                        'type'      => 'radio',
                        'default'   => 'no',
                        'class'     => 'la-radio-style',
                        'title'     => esc_html_x('Header Transparency', 'admin-view', 'torresdigital'),
                        'options'   => Lapa_Options::get_config_radio_opts(false)
                    ),
                    array(
                        'id'        => 'header_sticky',
                        'type'      => 'radio',
                        'default'   => 'no',
                        'class'     => 'la-radio-style',
                        'title'     => esc_html_x('Enable Header Sticky', 'admin-view', 'torresdigital'),
                        'options'   => array(
                            'no'        => esc_html_x('Disable', 'admin-view', 'torresdigital'),
                            'auto'      => esc_html_x('Activate when scroll up', 'admin-view', 'torresdigital'),
                            'yes'       => esc_html_x('Activate when scroll up & down', 'admin-view', 'torresdigital')
                        )
                    )
                )
            ),
            array(
                'name'      => 'header_element_sections',
                'title'     => esc_html_x('Elements', 'admin-view', 'torresdigital'),
                'icon'      => 'fa fa-cog',
                'fields'    => array(

                    array(
                        'id'        => 'header_access_icon_1',
                        'type'      => 'group',
                        'wrap_class'=> 'group-disable-clone',
                        'title'     => esc_html_x('Header Access Element 01', 'admin-view', 'torresdigital'),
                        'button_title'    => esc_html_x('Add Element','admin-view', 'torresdigital'),
                        'accordion_title' => 'type',
                        'max_item'  => 5,
                        'fields'    => array(
                            array(
                                'id'        => 'type',
                                'type'      => 'select',
                                'title'     => esc_html_x('Type', 'admin-view', 'torresdigital'),
                                'default'   => 'text',
                                'options'  => array(
                                    'dropdown_menu'     => esc_html_x('Dropdown Menu', 'admin-view', 'torresdigital'),
                                    'aside_header'      => esc_html_x('Aside Header', 'admin-view', 'torresdigital'),
                                    'text'              => esc_html_x('Custom Text', 'admin-view', 'torresdigital'),
                                    'link_icon'         => esc_html_x('Icon with link', 'admin-view', 'torresdigital'),
                                    'link_text'         => esc_html_x('Text with link', 'admin-view', 'torresdigital'),
                                    'search_1'          => esc_html_x('Search box style 01', 'admin-view', 'torresdigital'),
                                    'cart'              => esc_html_x('Cart Icon', 'admin-view', 'torresdigital'),
                                    'wishlist'          => esc_html_x('Wishlist Icon', 'admin-view', 'torresdigital'),
                                    'compare'           => esc_html_x('Compare Icon', 'admin-view', 'torresdigital')
                                )
                            ),
                            array(
                                'id'            => 'icon',
                                'type'          => 'icon',
                                'default'       => 'fa fa-share',
                                'title'         => esc_html_x('Custom Icon', 'admin-view', 'torresdigital'),
                                'dependency'    => array( 'type', '!=', 'search_1|primary_menu' )
                            ),
                            array(
                                'id'            => 'text',
                                'type'          => 'text',
                                'title'         => esc_html_x('Custom Text', 'admin-view', 'torresdigital'),
                                'dependency'    => array( 'type', 'any', 'text,link_text' )
                            ),
                            array(
                                'id'            => 'link',
                                'type'          => 'text',
                                'default'       => '#',
                                'title'         => esc_html_x('Link (URL)', 'admin-view', 'torresdigital'),
                                'dependency'    => array( 'type', 'any', 'link_icon,link_text,cart,wishlist,compare' )
                            ),
                            array(
                                'id'            => 'menu_id',
                                'type'          => 'select',
                                'title'         => esc_html_x('Select the menu','admin-view', 'torresdigital'),
                                'class'         => 'chosen',
                                'options'       => 'tags',
                                'query_args'    => array(
                                    'orderby'   => 'name',
                                    'order'     => 'ASC',
                                    'taxonomies'=>  'nav_menu',
                                    'hide_empty'=> false
                                ),
                                'dependency'    => array( 'type', '==', 'dropdown_menu' )
                            ),
                            array(
                                'id'            => 'el_class',
                                'type'          => 'text',
                                'default'       => '',
                                'title'         => esc_html_x('Extra CSS class for item', 'admin-view', 'torresdigital')
                            )
                        )
                    ),

                    array(
                        'id'        => 'header_access_icon_2',
                        'type'      => 'group',
                        'wrap_class'=> 'group-disable-clone',
                        'title'     => esc_html_x('Header Access Element 02', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('Apply only for header type is 3,8 or 9', 'admin-view', 'torresdigital'),
                        'button_title'    => esc_html_x('Add Element','admin-view', 'torresdigital'),
                        'accordion_title' => 'type',
                        'max_item'  => 5,
                        'fields'    => array(
                            array(
                                'id'        => 'type',
                                'type'      => 'select',
                                'title'     => esc_html_x('Type', 'admin-view', 'torresdigital'),
                                'default'   => 'text',
                                'options'  => array(
                                    'dropdown_menu'     => esc_html_x('Dropdown Menu', 'admin-view', 'torresdigital'),
                                    'aside_header'      => esc_html_x('Aside Header', 'admin-view', 'torresdigital'),
                                    'text'              => esc_html_x('Custom Text', 'admin-view', 'torresdigital'),
                                    'link_icon'         => esc_html_x('Icon with link', 'admin-view', 'torresdigital'),
                                    'link_text'         => esc_html_x('Text with link', 'admin-view', 'torresdigital'),
                                    'search_1'          => esc_html_x('Search box style 01', 'admin-view', 'torresdigital'),
                                    'cart'              => esc_html_x('Cart Icon', 'admin-view', 'torresdigital'),
                                    'wishlist'          => esc_html_x('Wishlist Icon', 'admin-view', 'torresdigital'),
                                    'compare'           => esc_html_x('Compare Icon', 'admin-view', 'torresdigital')
                                )
                            ),
                            array(
                                'id'            => 'icon',
                                'type'          => 'icon',
                                'default'       => 'fa fa-share',
                                'title'         => esc_html_x('Custom Icon', 'admin-view', 'torresdigital'),
                                'dependency'    => array( 'type', '!=', 'search_1|primary_menu' )
                            ),
                            array(
                                'id'            => 'text',
                                'type'          => 'text',
                                'title'         => esc_html_x('Custom Text', 'admin-view', 'torresdigital'),
                                'dependency'    => array( 'type', 'any', 'text,link_text' )
                            ),
                            array(
                                'id'            => 'link',
                                'type'          => 'text',
                                'default'       => '#',
                                'title'         => esc_html_x('Link (URL)', 'admin-view', 'torresdigital'),
                                'dependency'    => array( 'type', 'any', 'link_icon,link_text,cart,wishlist,compare' )
                            ),
                            array(
                                'id'            => 'menu_id',
                                'type'          => 'select',
                                'title'         => esc_html_x('Select the menu','admin-view', 'torresdigital'),
                                'class'         => 'chosen',
                                'options'       => 'tags',
                                'query_args'    => array(
                                    'orderby'   => 'name',
                                    'order'     => 'ASC',
                                    'taxonomies'=>  'nav_menu',
                                    'hide_empty'=> false
                                ),
                                'dependency'    => array( 'type', '==', 'dropdown_menu' )
                            ),
                            array(
                                'id'            => 'el_class',
                                'type'          => 'text',
                                'default'       => '',
                                'title'         => esc_html_x('Extra CSS class for item', 'admin-view', 'torresdigital')
                            )
                        )
                    ),

                    array(
                        'id'        => 'enable_header_top',
                        'type'      => 'radio',
                        'default'   => 'no',
                        'class'     => 'la-radio-style',
                        'title'     => esc_html_x('Enable Header Top Area?', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('Show/Hide Header Top Area in the Header.', 'admin-view', 'torresdigital'),
                        'options'   => array(
                            'no'            => esc_html_x('Hide', 'admin-view', 'torresdigital'),
                            'yes'           => esc_html_x('Yes', 'admin-view', 'torresdigital'),
                            'custom'        => esc_html_x('Use Custom HTML', 'admin-view', 'torresdigital')
                        )
                    ),
                    array(
                        'id'        => 'header_top_elements',
                        'type'      => 'group',
                        'wrap_class'=> 'group-disable-clone',
                        'title'     => esc_html_x('Header Top Element', 'admin-view', 'torresdigital'),
                        'button_title'    => esc_html_x('Add Element','admin-view', 'torresdigital'),
                        'accordion_title' => 'type',
                        'max_item'  => 10,
                        'dependency'    => array('enable_header_top_yes', '==', true),
                        'fields'    => array(
                            array(
                                'id'        => 'type',
                                'type'      => 'select',
                                'title'     => esc_html_x('Type', 'admin-view', 'torresdigital'),
                                'options'  => array(
                                    'dropdown_menu'     => esc_html_x('Dropdown Menu', 'admin-view', 'torresdigital'),
                                    'text'              => esc_html_x('Custom Text', 'admin-view', 'torresdigital'),
                                    'link_icon'         => esc_html_x('Icon with link', 'admin-view', 'torresdigital'),
                                    'link_text'         => esc_html_x('Text with link', 'admin-view', 'torresdigital'),
                                    'search_1'          => esc_html_x('Search box style 01', 'admin-view', 'torresdigital'),
                                    'cart'              => esc_html_x('Cart Icon', 'admin-view', 'torresdigital'),
                                    'wishlist'          => esc_html_x('Wishlist Icon', 'admin-view', 'torresdigital'),
                                    'compare'           => esc_html_x('Compare Icon', 'admin-view', 'torresdigital')
                                )
                            ),
                            array(
                                'id'            => 'icon',
                                'type'          => 'icon',
                                'default'       => 'fa fa-share',
                                'title'         => esc_html_x('Custom Icon', 'admin-view', 'torresdigital'),
                                'dependency'    => array( 'type', '!=', 'search_1|primary_menu' )
                            ),
                            array(
                                'id'            => 'text',
                                'type'          => 'text',
                                'title'         => esc_html_x('Custom Text', 'admin-view', 'torresdigital'),
                                'dependency'    => array( 'type', 'any', 'text,link_text,dropdown_menu')
                            ),
                            array(
                                'id'            => 'link',
                                'type'          => 'text',
                                'default'       => '#',
                                'title'         => esc_html_x('Link (URL)', 'admin-view', 'torresdigital'),
                                'dependency'    => array( 'type', 'any', 'link_icon,link_text,cart,wishlist,compare' )
                            ),
                            array(
                                'id'            => 'menu_id',
                                'type'          => 'select',
                                'title'         => esc_html_x('Select the menu','admin-view', 'torresdigital'),
                                'class'         => 'chosen',
                                'options'       => 'tags',
                                'query_args'    => array(
                                    'orderby'   => 'name',
                                    'order'     => 'ASC',
                                    'taxonomies'=>  'nav_menu',
                                    'hide_empty'=> false
                                ),
                                'dependency'    => array( 'type', '==', 'dropdown_menu' )
                            ),
                            array(
                                'id'            => 'el_class',
                                'type'          => 'text',
                                'default'       => '',
                                'title'         => esc_html_x('Extra CSS class for item', 'admin-view', 'torresdigital')
                            )
                        )
                    ),
                    array(
                        'id'        => 'use_custom_header_top',
                        'type'      => 'code_editor',
                        'editor_setting'    => array(
                            'type' => 'text/html',
                            'codemirror' => array(
                                'indentUnit' => 2,
                                'tabSize' => 2
                            )
                        ),
                        'title'     => esc_html_x('Custom HTML For Header Top', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('Paste your custom HTML code here.', 'admin-view', 'torresdigital'),
                        'dependency'    => array('enable_header_top_custom', '==', true)
                    )
                )
            ),
            array(
                'name'      => 'header_default_styling_sections',
                'title'     => esc_html_x('Normal Styling', 'admin-view', 'torresdigital'),
                'icon'      => 'fa fa-paint-brush',
                'fields'    => array(
                    array(
                        'id'        => 'header_background',
                        'type'      => 'background',
                        'default'       => array(
                            'color' => '#fff'
                        ),
                        'title'     => esc_html_x('Background', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('for default header', 'admin-view', 'torresdigital'),
                    ),
                    array(
                        'id'        => 'header_text_color',
                        'type'      => 'color_picker',
                        'default'   => Lapa_Options::get_color_default('secondary_color'),
                        'title'     => esc_html_x('Text Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For default header', 'admin-view', 'torresdigital'),
                    ),
                    array(
                        'id'        => 'header_link_color',
                        'type'      => 'color_picker',
                        'default'   => Lapa_Options::get_color_default('secondary_color'),
                        'title'     => esc_html_x('Link Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For default header', 'admin-view', 'torresdigital'),
                    ),
                    array(
                        'id'        => 'header_link_hover_color',
                        'type'      => 'color_picker',
                        'default'   => Lapa_Options::get_color_default('primary_color'),
                        'title'     => esc_html_x('Link Hover Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For default header', 'admin-view', 'torresdigital'),
                    ),
                    array(
                        'id'        => 'mm_lv_1_color',
                        'type'      => 'color_picker',
                        'default'   => Lapa_Options::get_color_default('secondary_color'),
                        'title'     => esc_html_x('Menu Level 1 Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For default header', 'admin-view', 'torresdigital'),
                    ),
                    array(
                        'id'        => 'mm_lv_1_bg_color',
                        'type'      => 'color_picker',
                        'default'   => 'rgba(0,0,0,0)',
                        'title'     => esc_html_x('Menu Level 1 Background Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For default header', 'admin-view', 'torresdigital')
                    ),
                    array(
                        'id'        => 'mm_lv_1_hover_color',
                        'type'      => 'color_picker',
                        'default'   => Lapa_Options::get_color_default('primary_color'),
                        'title'     => esc_html_x('Menu Level 1 Hover Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For default header', 'admin-view', 'torresdigital')
                    ),
                    array(
                        'id'        => 'mm_lv_1_hover_bg_color',
                        'type'      => 'color_picker',
                        'default'   => 'rgba(0,0,0,0)',
                        'title'     => esc_html_x('Menu Level 1 Hover Background Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For default header', 'admin-view', 'torresdigital')
                    ),
                    array(
                        'type'    => 'notice',
                        'class'   => 'no-format la-section-title',
                        'content' => sprintf('<h3>%s</h3>', esc_html_x('Header Top Styling', 'admin-view', 'torresdigital'))
                    ),
                    array(
                        'id'        => 'header_top_background_color',
                        'type'      => 'color_picker',
                        'default'   => 'rgba(0,0,0,0)',
                        'title'     => esc_html_x('Header Top Background Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For default header top', 'admin-view', 'torresdigital'),
                    ),
                    array(
                        'id'        => 'header_top_text_color',
                        'type'      => 'color_picker',
                        'default'   => Lapa_Options::get_color_default('body_color'),
                        'title'     => esc_html_x('Header Top Text Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For default header top', 'admin-view', 'torresdigital'),
                    ),
                    array(
                        'id'        => 'header_top_link_color',
                        'type'      => 'color_picker',
                        'default'   => Lapa_Options::get_color_default('body_color'),
                        'title'     => esc_html_x('Header Top Link Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For default header top', 'admin-view', 'torresdigital'),
                    ),
                    array(
                        'id'        => 'header_top_link_hover_color',
                        'type'      => 'color_picker',
                        'default'   => Lapa_Options::get_color_default('primary_color'),
                        'title'     => esc_html_x('Header Top Link Hover Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For default header top', 'admin-view', 'torresdigital'),
                    )
                )
            ),
            array(
                'name'      => 'header_transparency_styling_sections',
                'title'     => esc_html_x('Transparency Styling', 'admin-view', 'torresdigital'),
                'icon'      => 'fa fa-paint-brush',
                'fields'    => array(
                    array(
                        'id'        => 'transparency_header_background',
                        'type'      => 'background',
                        'default'       => array(
                            'color' => 'rgba(0,0,0,0)'
                        ),
                        'title'     => esc_html_x('Background', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For transparency header', 'admin-view', 'torresdigital')
                    ),
                    array(
                        'id'        => 'transparency_header_text_color',
                        'type'      => 'color_picker',
                        'default'   => '#fff',
                        'title'     => esc_html_x('Text Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For transparency header', 'admin-view', 'torresdigital')
                    ),
                    array(
                        'id'        => 'transparency_header_link_color',
                        'type'      => 'color_picker',
                        'default'   => '#fff',
                        'title'     => esc_html_x('Link Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For transparency header', 'admin-view', 'torresdigital')
                    ),
                    array(
                        'id'        => 'transparency_header_link_hover_color',
                        'type'      => 'color_picker',
                        'default'   => Lapa_Options::get_color_default('primary_color'),
                        'title'     => esc_html_x('Link Hover Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For transparency header', 'admin-view', 'torresdigital')
                    ),
                    array(
                        'id'        => 'transparency_mm_lv_1_color',
                        'type'      => 'color_picker',
                        'default'   => '#fff',
                        'title'     => esc_html_x('Menu Level 1 Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For transparency header', 'admin-view', 'torresdigital')
                    ),
                    array(
                        'id'        => 'transparency_mm_lv_1_bg_color',
                        'type'      => 'color_picker',
                        'default'   => 'rgba(0,0,0,0)',
                        'title'     => esc_html_x('Menu Level 1 Background Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For transparency header', 'admin-view', 'torresdigital')
                    ),
                    array(
                        'id'        => 'transparency_mm_lv_1_hover_color',
                        'type'      => 'color_picker',
                        'default'   => Lapa_Options::get_color_default('primary_color'),
                        'title'     => esc_html_x('Menu Level 1 Hover Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For transparency header', 'admin-view', 'torresdigital')
                    ),
                    array(
                        'id'        => 'transparency_mm_lv_1_hover_bg_color',
                        'type'      => 'color_picker',
                        'default'   => 'rgba(0,0,0,0)',
                        'title'     => esc_html_x('Menu Level 1 Hover Background Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For transparency header', 'admin-view', 'torresdigital')
                    ),
                    array(
                        'type'    => 'notice',
                        'class'   => 'no-format la-section-title',
                        'content' => sprintf('<h3>%s</h3>', esc_html_x('Transparency Header Top Styling', 'admin-view', 'torresdigital'))
                    ),
                    array(
                        'id'        => 'transparency_header_top_background_color',
                        'type'      => 'color_picker',
                        'default'   => 'rgba(0,0,0,0)',
                        'title'     => esc_html_x('Header Top Background Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For transparency header top', 'admin-view', 'torresdigital'),
                    ),
                    array(
                        'id'        => 'transparency_header_top_text_color',
                        'type'      => 'color_picker',
                        'default'   => 'rgba(255,255,255,0.2)',
                        'title'     => esc_html_x('Header Top Text Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For transparency header top', 'admin-view', 'torresdigital'),
                    ),
                    array(
                        'id'        => 'transparency_header_top_link_color',
                        'type'      => 'color_picker',
                        'default'   => '#fff',
                        'title'     => esc_html_x('Header Top Link Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For transparency header top', 'admin-view', 'torresdigital'),
                    ),
                    array(
                        'id'        => 'transparency_header_top_link_hover_color',
                        'type'      => 'color_picker',
                        'default'   => Lapa_Options::get_color_default('primary_color'),
                        'title'     => esc_html_x('Header Top Link Hover Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For transparency header top', 'admin-view', 'torresdigital'),
                    )
                )
            ),
            array(
                'name'      => 'header_offcanvas_styling_sections',
                'title'     => esc_html_x('Aside Menu Styling', 'admin-view', 'torresdigital'),
                'icon'      => 'fa fa-paint-brush',
                'fields'    => array(
                    array(
                        'id'        => 'offcanvas_background',
                        'default'   => '#fff',
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Background Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For Aside Header', 'admin-view', 'torresdigital')
                    ),
                    array(
                        'id'        => 'offcanvas_text_color',
                        'default'   => Lapa_Options::get_color_default('secondary_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Text color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For Aside Header', 'admin-view', 'torresdigital')
                    ),
                    array(
                        'id'        => 'offcanvas_heading_color',
                        'default'   => Lapa_Options::get_color_default('heading_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Heading color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For Aside Header', 'admin-view', 'torresdigital')
                    ),
                    array(
                        'id'        => 'offcanvas_link_color',
                        'default'   => Lapa_Options::get_color_default('secondary_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Link color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For Aside Header', 'admin-view', 'torresdigital')
                    ),
                    array(
                        'id'        => 'offcanvas_link_hover_color',
                        'default'   => Lapa_Options::get_color_default('primary_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Link Hover color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For Aside Header', 'admin-view', 'torresdigital')
                    )
                )
            ),
            array(
                'name'      => 'header_megamenu_styling_sections',
                'title'     => esc_html_x('Mega Menu Styling', 'admin-view', 'torresdigital'),
                'icon'      => 'fa fa-paint-brush',
                'fields'    => array(
                    array(
                        'id'        => 'mm_dropdown_bg',
                        'default'   => '#fff',
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Background Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For type "DropDown"', 'admin-view', 'torresdigital')
                    ),
                    array(
                        'id'        => 'mm_dropdown_link_color',
                        'default'   => Lapa_Options::get_color_default('body_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Link Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For type "DropDown"', 'admin-view', 'torresdigital')
                    ),
                    array(
                        'id'        => 'mm_dropdown_link_bg',
                        'default'   => 'rgba(0,0,0,0)',
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Link Background Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For type "DropDown"', 'admin-view', 'torresdigital')
                    ),
                    array(
                        'id'        => 'mm_dropdown_link_hover_color',
                        'default'   => Lapa_Options::get_color_default('secondary_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Link Hover Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For type "DropDown"', 'admin-view', 'torresdigital')
                    ),
                    array(
                        'id'        => 'mm_dropdown_link_hover_bg',
                        'default'   => 'rgba(0,0,0,0)',
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Link Hover Background Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For type "DropDown"', 'admin-view', 'torresdigital')
                    ),
                    array(
                        'id'        => 'mm_wide_dropdown_bg',
                        'default'   => '#fff',
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Background Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For type "Wide"', 'admin-view', 'torresdigital')
                    ),
                    array(
                        'id'        => 'mm_wide_dropdown_heading_color',
                        'default'   => Lapa_Options::get_color_default('heading_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Heading Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For type "Wide"', 'admin-view', 'torresdigital')
                    ),
                    array(
                        'id'        => 'mm_wide_dropdown_link_color',
                        'default'   => Lapa_Options::get_color_default('body_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Link Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For type "Wide"', 'admin-view', 'torresdigital')
                    ),
                    array(
                        'id'        => 'mm_wide_dropdown_link_bg',
                        'default'   => 'rgba(0,0,0,0)',
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Link Background Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For type "Wide"', 'admin-view', 'torresdigital')
                    ),
                    array(
                        'id'        => 'mm_wide_dropdown_link_hover_color',
                        'default'   => Lapa_Options::get_color_default('secondary_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Link Hover Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For type "Wide"', 'admin-view', 'torresdigital')
                    ),
                    array(
                        'id'        => 'mm_wide_dropdown_link_hover_bg',
                        'default'   => 'rgba(0,0,0,0)',
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Link Hover Background Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For type "Wide"', 'admin-view', 'torresdigital')
                    )
                )
            ),
            array(
                'name'      => 'header_mobile_styling_sections',
                'title'     => esc_html_x('Header Mobile', 'admin-view', 'torresdigital'),
                'icon'      => 'fa fa-paint-brush',
                'fields'    => array(
                    array(
                        'id'        => 'header_mb_layout',
                        'title'     => esc_html_x('Header Mobile Layout', 'admin-view', 'torresdigital'),
                        'type'      => 'image_select',
                        'radio'     => true,
                        'class'     => 'la-radio-style',
                        'attributes'   => array(
                            'data-depend-id' => 'header_mb_layout',
                        ),
                        'default'   => '1',
                        'desc'      => esc_html_x('Controls the general layout of the header on mobile.', 'admin-view', 'torresdigital'),
                        'options'   => array(
                                '1' => Lapa::$template_dir_url . '/assets/images/theme_options/header-mobile-1.png',
                                '2' => Lapa::$template_dir_url . '/assets/images/theme_options/header-mobile-2.png',
                                '3' => Lapa::$template_dir_url . '/assets/images/theme_options/header-mobile-3.png',
                                '4' => Lapa::$template_dir_url . '/assets/images/theme_options/header-mobile-4.png'
                        )
                    ),
                    array(
                        'id'        => 'mm_mb_effect',
                        'default'   => '1',
                        'title'     => esc_html_x('Mobile Menu Transition Effect', 'admin-view', 'torresdigital'),
                        'desc'      => '<a target="_blank" href="//tympanus.net/Development/ResponsiveMultiLevelMenu/index.html">'. esc_html_x('See Demo', 'admin-view', 'torresdigital') .'</a>',
                        'type'      => 'select',
                        'options'   => array(
                            '1'        => esc_html_x('Effect 1', 'admin-view', 'torresdigital'),
                            '2'        => esc_html_x('Effect 2', 'admin-view', 'torresdigital'),
                            '3'        => esc_html_x('Effect 3', 'admin-view', 'torresdigital'),
                            '4'        => esc_html_x('Effect 4', 'admin-view', 'torresdigital'),
                            '5'        => esc_html_x('Effect 5', 'admin-view', 'torresdigital')
                        )
                    ),
                    array(
                        'id'        => 'header_mb_component_1',
                        'type'      => 'group',
                        'wrap_class'=> 'group-disable-clone',
                        'title'     => esc_html_x('Header Mobile Icon Component 01', 'admin-view', 'torresdigital'),
                        'button_title'    => esc_html_x('Add Icon Component ','admin-view', 'torresdigital'),
                        'accordion_title' => 'type',
                        'max_item'  => 5,
                        'fields'    => array(
                            array(
                                'id'        => 'type',
                                'type'      => 'select',
                                'title'     => esc_html_x('Type', 'admin-view', 'torresdigital'),
                                'options'  => array(
                                    'primary_menu'      => esc_html_x('Toggle Primary Menu', 'admin-view', 'torresdigital'),
                                    'dropdown_menu'     => esc_html_x('Dropdown Menu', 'admin-view', 'torresdigital'),
                                    'text'              => esc_html_x('Custom Text', 'admin-view', 'torresdigital'),
                                    'link_icon'         => esc_html_x('Icon with link', 'admin-view', 'torresdigital'),
                                    'link_text'         => esc_html_x('Text with link', 'admin-view', 'torresdigital'),
                                    'search_1'          => esc_html_x('Search box style 01', 'admin-view', 'torresdigital'),
                                    'cart'              => esc_html_x('Cart Icon', 'admin-view', 'torresdigital'),
                                    'wishlist'          => esc_html_x('Wishlist Icon', 'admin-view', 'torresdigital'),
                                    'compare'           => esc_html_x('Compare Icon', 'admin-view', 'torresdigital')
                                )
                            ),
                            array(
                                'id'            => 'icon',
                                'type'          => 'icon',
                                'default'       => 'fa fa-share',
                                'title'         => esc_html_x('Custom Icon', 'admin-view', 'torresdigital'),
                                'dependency'    => array( 'type', '!=', 'search_1|primary_menu' )
                            ),
                            array(
                                'id'            => 'text',
                                'type'          => 'text',
                                'title'         => esc_html_x('Custom Text', 'admin-view', 'torresdigital'),
                                'dependency'    => array( 'type', 'any', 'text,link_text' )
                            ),
                            array(
                                'id'            => 'link',
                                'type'          => 'text',
                                'default'       => '#',
                                'title'         => esc_html_x('Link (URL)', 'admin-view', 'torresdigital'),
                                'dependency'    => array( 'type', 'any', 'link_icon,link_text,cart,wishlist,compare' )
                            ),
                            array(
                                'id'            => 'menu_id',
                                'type'          => 'select',
                                'title'         => esc_html_x('Select the menu','admin-view', 'torresdigital'),
                                'class'         => 'chosen',
                                'options'       => 'tags',
                                'query_args'    => array(
                                    'orderby'   => 'name',
                                    'order'     => 'ASC',
                                    'taxonomies'=>  'nav_menu',
                                    'hide_empty'=> false
                                ),
                                'dependency'    => array( 'type', '==', 'dropdown_menu' )
                            ),
                            array(
                                'id'            => 'el_class',
                                'type'          => 'text',
                                'default'       => '',
                                'title'         => esc_html_x('Extra CSS class for item', 'admin-view', 'torresdigital')
                            )
                        )
                    ),
                    array(
                        'id'        => 'header_mb_component_2',
                        'type'      => 'group',
                        'wrap_class'=> 'group-disable-clone',
                        'title'     => esc_html_x('Header Mobile Icon Component 02', 'admin-view', 'torresdigital'),
                        'button_title'    => esc_html_x('Add Icon Component ','admin-view', 'torresdigital'),
                        'accordion_title' => 'type',
                        'dependency'    => array('header_mb_layout', 'any', '1,4'),
                        'max_item'  => 5,
                        'fields'    => array(
                            array(
                                'id'        => 'type',
                                'type'      => 'select',
                                'title'     => esc_html_x('Type', 'admin-view', 'torresdigital'),
                                'options'  => array(
                                    'primary_menu'      => esc_html_x('Toggle Primary Menu', 'admin-view', 'torresdigital'),
                                    'dropdown_menu'     => esc_html_x('Dropdown Menu', 'admin-view', 'torresdigital'),
                                    'text'              => esc_html_x('Custom Text', 'admin-view', 'torresdigital'),
                                    'link_icon'         => esc_html_x('Icon with link', 'admin-view', 'torresdigital'),
                                    'link_text'         => esc_html_x('Text with link', 'admin-view', 'torresdigital'),
                                    'search_1'          => esc_html_x('Search box style 01', 'admin-view', 'torresdigital'),
                                    'cart'              => esc_html_x('Cart Icon', 'admin-view', 'torresdigital'),
                                    'wishlist'          => esc_html_x('Wishlist Icon', 'admin-view', 'torresdigital'),
                                    'compare'           => esc_html_x('Compare Icon', 'admin-view', 'torresdigital')
                                )
                            ),
                            array(
                                'id'            => 'icon',
                                'type'          => 'icon',
                                'default'       => 'fa fa-share',
                                'title'         => esc_html_x('Custom Icon', 'admin-view', 'torresdigital'),
                                'dependency'    => array( 'type', '!=', 'search_1|primary_menu' )
                            ),
                            array(
                                'id'            => 'text',
                                'type'          => 'text',
                                'title'         => esc_html_x('Custom Text', 'admin-view', 'torresdigital'),
                                'dependency'    => array( 'type', 'any', 'text,link_text' )
                            ),
                            array(
                                'id'            => 'link',
                                'type'          => 'text',
                                'default'       => '#',
                                'title'         => esc_html_x('Link (URL)', 'admin-view', 'torresdigital'),
                                'dependency'    => array( 'type', 'any', 'link_icon,link_text,cart,wishlist,compare' )
                            ),
                            array(
                                'id'            => 'menu_id',
                                'type'          => 'select',
                                'title'         => esc_html_x('Select the menu','admin-view', 'torresdigital'),
                                'class'         => 'chosen',
                                'options'       => 'tags',
                                'query_args'    => array(
                                    'orderby'   => 'name',
                                    'order'     => 'ASC',
                                    'taxonomies'=>  'nav_menu',
                                    'hide_empty'=> false
                                ),
                                'dependency'    => array( 'type', '==', 'dropdown_menu' )
                            ),
                            array(
                                'id'            => 'el_class',
                                'type'          => 'text',
                                'default'       => '',
                                'title'         => esc_html_x('Extra CSS class for item', 'admin-view', 'torresdigital')
                            )
                        )
                    ),

                    array(
                        'id'        => 'enable_header_mb_footer_bar',
                        'type'      => 'radio',
                        'default'   => 'no',
                        'class'     => 'la-radio-style',
                        'title'     => esc_html_x('Enable Mobile Footer Bar?', 'admin-view', 'torresdigital'),
                        'options'   => array(
                            'no'            => esc_html_x('Hide', 'admin-view', 'torresdigital'),
                            'yes'           => esc_html_x('Yes', 'admin-view', 'torresdigital')
                        )
                    ),
                    array(
                        'id'        => 'header_mb_footer_bar_component',
                        'type'      => 'group',
                        'wrap_class'=> 'group-disable-clone',
                        'title'     => esc_html_x('Header Mobile Footer Bar Component', 'admin-view', 'torresdigital'),
                        'button_title'    => esc_html_x('Add Icon Component ','admin-view', 'torresdigital'),
                        'dependency'    => array('enable_header_mb_footer_bar_yes', '==', true),
                        'accordion_title' => 'type',
                        'max_item'  => 4,
                        'fields'    => array(
                            array(
                                'id'        => 'type',
                                'type'      => 'select',
                                'title'     => esc_html_x('Type', 'admin-view', 'torresdigital'),
                                'options'  => array(
                                    'dropdown_menu'     => esc_html_x('Dropdown Menu', 'admin-view', 'torresdigital'),
                                    'text'              => esc_html_x('Custom Text', 'admin-view', 'torresdigital'),
                                    'link_icon'         => esc_html_x('Icon with link', 'admin-view', 'torresdigital'),
                                    'search_1'          => esc_html_x('Search box style 01', 'admin-view', 'torresdigital'),
                                    'cart'              => esc_html_x('Cart Icon', 'admin-view', 'torresdigital'),
                                    'wishlist'          => esc_html_x('Wishlist Icon', 'admin-view', 'torresdigital'),
                                    'compare'           => esc_html_x('Compare Icon', 'admin-view', 'torresdigital')
                                )
                            ),
                            array(
                                'id'            => 'icon',
                                'type'          => 'icon',
                                'default'       => 'fa fa-share',
                                'title'         => esc_html_x('Custom Icon', 'admin-view', 'torresdigital'),
                                'dependency'    => array( 'type', '!=', 'search_1|primary_menu' )
                            ),
                            array(
                                'id'            => 'text',
                                'type'          => 'text',
                                'title'         => esc_html_x('Custom Text', 'admin-view', 'torresdigital'),
                                'dependency'    => array( 'type', 'any', 'text,link_text' )
                            ),
                            array(
                                'id'            => 'link',
                                'type'          => 'text',
                                'default'       => '#',
                                'title'         => esc_html_x('Link (URL)', 'admin-view', 'torresdigital'),
                                'dependency'    => array( 'type', '!=', 'search_1|primary_menu' )
                            ),
                            array(
                                'id'            => 'menu_id',
                                'type'          => 'select',
                                'title'         => esc_html_x('Select the menu','admin-view', 'torresdigital'),
                                'class'         => 'chosen',
                                'options'       => 'tags',
                                'query_args'    => array(
                                    'orderby'   => 'name',
                                    'order'     => 'ASC',
                                    'taxonomies'=>  'nav_menu',
                                    'hide_empty'=> false
                                ),
                                'dependency'    => array( 'type', '==', 'dropdown_menu' )
                            ),
                            array(
                                'id'            => 'el_class',
                                'type'          => 'text',
                                'default'       => '',
                                'title'         => esc_html_x('Extra CSS class for item', 'admin-view', 'torresdigital')
                            )
                        )
                    ),

                    array(
                        'id'        => 'header_mb_background',
                        'default'   => '#fff',
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Background Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For Mobile Header', 'admin-view', 'torresdigital')
                    ),
                    array(
                        'id'        => 'header_mb_text_color',
                        'default'   => Lapa_Options::get_color_default('body_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Text Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For Mobile Header', 'admin-view', 'torresdigital')
                    ),

                    array(
                        'id'        => 'header_mb_transparency_background',
                        'default'   => '#fff',
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Background Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For Mobile Transparency Header', 'admin-view', 'torresdigital')
                    ),

                    array(
                        'id'        => 'header_mb_transparency_text_color',
                        'default'   => Lapa_Options::get_color_default('body_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Text Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For Mobile Transparency Header', 'admin-view', 'torresdigital')
                    ),


                    array(
                        'type'    => 'notice',
                        'class'   => 'no-format la-section-title',
                        'content' => sprintf('<h3>%s</h3>', esc_html_x('Mobile Menu Styling', 'admin-view', 'torresdigital'))
                    ),
                    array(
                        'id'        => 'mb_background',
                        'default'   => '#fff',
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Background Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For Mobile Menu', 'admin-view', 'torresdigital')
                    ),
                    array(
                        'id'        => 'mb_lv_1_color',
                        'default'   => Lapa_Options::get_color_default('secondary_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Menu Level 1 Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For Mobile Menu', 'admin-view', 'torresdigital')
                    ),
                    array(
                        'id'        => 'mb_lv_1_bg_color',
                        'default'   => 'rgba(0,0,0,0)',
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Menu Level 1 Background Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For Mobile Menu', 'admin-view', 'torresdigital')
                    ),
                    array(
                        'id'        => 'mb_lv_1_hover_color',
                        'default'   => Lapa_Options::get_color_default('primary_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Menu Level 1 Hover Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For Mobile Menu', 'admin-view', 'torresdigital')
                    ),
                    array(
                        'id'        => 'mb_lv_1_hover_bg_color',
                        'default'   => 'rgba(0,0,0,0)',
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Menu Level 1 Hover Background Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For Mobile Menu', 'admin-view', 'torresdigital')
                    ),
                    array(
                        'id'        => 'mb_lv_2_color',
                        'default'   => Lapa_Options::get_color_default('secondary_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Menu Level 2 Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For Mobile Menu', 'admin-view', 'torresdigital')
                    ),
                    array(
                        'id'        => 'mb_lv_2_bg_color',
                        'default'   => 'rgba(0,0,0,0)',
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Menu Level 2 Background Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For Mobile Menu', 'admin-view', 'torresdigital')
                    ),
                    array(
                        'id'        => 'mb_lv_2_hover_color',
                        'default'   => '#fff',
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Menu Level 2 Hover Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For Mobile Menu', 'admin-view', 'torresdigital')
                    ),
                    array(
                        'id'        => 'mb_lv_2_hover_bg_color',
                        'default'   => Lapa_Options::get_color_default('primary_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Menu Level 2 Hover Background Color', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('For Mobile Menu', 'admin-view', 'torresdigital')
                    )
                )
            ),
            array(
                'name'      => 'header_extra_sections',
                'title'     => esc_html_x('Extra Setting', 'admin-view', 'torresdigital'),
                'icon'      => 'fa fa-cog',
                'fields'    => array(
                    array(
                        'id'        => 'header_height',
                        'type'      => 'slider',
                        'default'    => '100px',
                        'title'     => esc_html_x( '[Desktop] Header Container Height', 'admin-view', 'torresdigital' ),
                        'options'   => array(
                            'step'    => 1,
                            'min'     => 50,
                            'max'     => 200,
                            'unit'    => 'px'
                        )
                    ),
                    array(
                        'id'        => 'header_sticky_height',
                        'type'      => 'slider',
                        'default'    => '80px',
                        'title'     => esc_html_x( '[Desktop] Header Sticky Container Height', 'admin-view', 'torresdigital' ),
                        'options'   => array(
                            'step'    => 1,
                            'min'     => 50,
                            'max'     => 200,
                            'unit'    => 'px'
                        )
                    ),
                    array(
                        'id'        => 'header_sm_height',
                        'type'      => 'slider',
                        'default'    => '100px',
                        'title'     => esc_html_x( '[Tablet] Header Container Height', 'admin-view', 'torresdigital' ),
                        'options'   => array(
                            'step'    => 1,
                            'min'     => 50,
                            'max'     => 200,
                            'unit'    => 'px'
                        )
                    ),
                    array(
                        'id'        => 'header_sm_sticky_height',
                        'type'      => 'slider',
                        'default'    => '80px',
                        'title'     => esc_html_x( '[Tablet] Header Sticky Container Height', 'admin-view', 'torresdigital' ),
                        'options'   => array(
                            'step'    => 1,
                            'min'     => 50,
                            'max'     => 200,
                            'unit'    => 'px'
                        )
                    ),
                    array(
                        'id'        => 'header_mb_height',
                        'type'      => 'slider',
                        'default'    => '70px',
                        'title'     => esc_html_x( '[Mobile] Header Container Height', 'admin-view', 'torresdigital' ),
                        'options'   => array(
                            'step'    => 1,
                            'min'     => 50,
                            'max'     => 200,
                            'unit'    => 'px'
                        )
                    ),
                    array(
                        'id'        => 'header_mb_sticky_height',
                        'type'      => 'slider',
                        'default'    => '70px',
                        'title'     => esc_html_x( '[Mobile] Header Sticky Container Height', 'admin-view', 'torresdigital' ),
                        'options'   => array(
                            'step'    => 1,
                            'min'     => 50,
                            'max'     => 200,
                            'unit'    => 'px'
                        )
                    )
                )
            )
        )
    );
    return $sections;
}