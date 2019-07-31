<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}


/**
 * MetaBox
 *
 * @param array $sections An array of our sections.
 * @return array
 */
function lapa_metaboxes_section_product( $sections )
{
    $sections['product'] = array(
        'name'      => 'post',
        'title'     => esc_html_x('Product', 'admin-view', 'torresdigital'),
        'icon'      => 'laicon-file',
        'fields'    => array(
            array(
                'type'          => 'heading',
                'wrap_class'    => 'small-heading',
                'content'       => esc_html_x('For post format QUOTE', 'admin-view', 'torresdigital')
            ),
            array(
                'id'            => 'format_quote_content',
                'type'          => 'textarea',
                'title'         => esc_html_x('Quote Content', 'admin-view', 'torresdigital')
            ),
            array(
                'id'            => 'format_quote_author',
                'type'          => 'text',
                'title'         => esc_html_x('Quote Author', 'admin-view', 'torresdigital')
            ),
            array(
                'id'            => 'format_quote_background',
                'type'          => 'color_picker',
                'title'         => esc_html_x('Quote Background Color', 'admin-view', 'torresdigital'),
                'default'       => '#343538'
            ),
            array(
                'id'            => 'format_quote_color',
                'type'          => 'color_picker',
                'title'         => esc_html_x('Quote Text Color', 'admin-view', 'torresdigital'),
                'default'       => '#fff'
            ),

            array(
                'type'          => 'heading',
                'wrap_class'    => 'small-heading',
                'content'       => esc_html_x('For post format LINK', 'admin-view', 'torresdigital')
            ),
            array(
                'id'            => 'format_link',
                'type'          => 'text',
                'title'         => esc_html_x('Custom Link', 'admin-view', 'torresdigital')
            ),

            array(
                'type'          => 'heading',
                'wrap_class'    => 'small-heading',
                'content'       => esc_html_x('For post format VIDEO & AUDIO', 'admin-view', 'torresdigital')
            ),
            array(
                'id'            => 'format_embed',
                'type'          => 'textarea',
                'title'         => esc_html_x('Embed Code', 'admin-view', 'torresdigital'),
                'desc'          => esc_html_x('Insert Youtube or Vimeo or Audio embed code.', 'admin-view', 'torresdigital'),
                'sanitize'      => false
            ),
            array(
                'id'             => 'format_embed_aspect_ration',
                'type'           => 'select',
                'title'          => esc_html_x('Embed aspect ration', 'admin-view', 'torresdigital'),
                'options'        => array(
                    'origin'        => 'origin',
                    '169'           => '16:9',
                    '43'            => '4:3',
                    '235'           => '2.35:1'
                )
            ),
            array(
                'type'          => 'heading',
                'wrap_class'    => 'small-heading',
                'content'       => esc_html_x('For post format GALLERY', 'admin-view', 'torresdigital')
            ),
            array(
                'id'            => 'format_gallery',
                'type'          => 'gallery',
                'title'         => esc_html_x('Gallery Images', 'admin-view', 'torresdigital')
            )
        )
    );
    return $sections;
}