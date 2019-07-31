<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}


/**
 * Additional code settings
 *
 * @param array $sections An array of our sections.
 * @return array
 */
function lapa_options_section_additional_code( $sections )
{
    $sections['additional_code'] = array(
        'name'          => 'additional_code_panel',
        'title'         => esc_html_x('Additional Code', 'admin-view', 'torresdigital'),
        'icon'          => 'fa fa-code',
        'fields'        => array(
            array(
                'id'        => 'google_key',
                'type'      => 'text',
                'title'     => esc_html_x('Google API Key', 'admin-view', 'torresdigital'),
                'desc'      => esc_html_x('Type your Google API Key here.', 'admin-view', 'torresdigital')
            ),
            array(
                'id'        => 'instagram_token',
                'type'      => 'text',
                'title'     => esc_html_x('Instagram Access Token', 'admin-view', 'torresdigital'),
                'desc'      => esc_html_x('In order to display your photos you need an Access Token from Instagram.', 'admin-view', 'torresdigital'),
                'info'      => sprintf(
                    __('<a target="_blank" href="%s">Click here</a> to get your API', 'torresdigital'),
                    '//la-studioweb.com/tools/instagram-token/'
                )
            ),
            array(
                'id'        => 'la_custom_css',
                'type'      => 'code_editor',
                'editor_setting'    => array(
                    'type' => 'text/css',
                    'codemirror' => array(
                        'indentUnit' => 2,
                        'tabSize' => 2
                    )
                ),
                'wrap_class'=> 'hidden-on-customize',
                'class'     => 'la-customizer-section-large',
                'title'     => esc_html_x('Custom CSS', 'admin-view', 'torresdigital'),
                'desc'      => esc_html_x('Paste your custom CSS code here.', 'admin-view', 'torresdigital'),
            ),
            array(
                'id'        => 'header_js',
                'type'      => 'code_editor',
                'editor_setting'    => array(
                    'type' => 'text/javascript',
                    'codemirror' => array(
                        'indentUnit' => 2,
                        'tabSize' => 2
                    )
                ),
                'title'     => esc_html_x('Header Javascript Code', 'admin-view', 'torresdigital'),
                'desc'      => esc_html_x('Paste your custom JS code here. The code will be added to the header of your site.', 'admin-view', 'torresdigital')
            ),
            array(
                'id'        => 'footer_js',
                'type'      => 'code_editor',
                'editor_setting'    => array(
                    'type' => 'text/javascript',
                    'codemirror' => array(
                        'indentUnit' => 2,
                        'tabSize' => 2
                    )
                ),
                'title'     => esc_html_x('Footer Javascript Code', 'admin-view', 'torresdigital'),
                'desc'     => esc_html_x('Paste your custom JS code here. The code will be added to the footer of your site.', 'admin-view', 'torresdigital')
            )
        )
    );
    return $sections;
}