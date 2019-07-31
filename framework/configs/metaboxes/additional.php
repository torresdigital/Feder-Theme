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
function lapa_metaboxes_section_additional( $sections )
{
    $query_args = array(
        'post_type'    => 'la_block',
        'orderby'   => 'title',
        'order'     => 'ASC',
        'posts_per_page' => 20
    );
    $sections['additional'] = array(
        'name'      => 'additional',
        'title'     => esc_html_x('Additional', 'admin-view', 'torresdigital'),
        'icon'      => 'laicon-file-add',
        'fields'    => array(
            array(
                'type'    => 'content',
                'content' => sprintf(
                    '<a href="%s" onclick="window.open(this.href, this.target, \'height=400,width=400\'); return false">%s</a>',
                    esc_url(Lapa::$template_dir_url . '/assets/images/theme_options/block-layout.jpg'),
                    esc_html_x('Click to here to look the block\'s position', 'admin-view', 'torresdigital')
                ),
            ),
            array(
                'id'            => 'block_content_top',
                'type'          => 'autocomplete',
                'title'         => esc_html_x('Additional Block Content Top', 'admin-view', 'torresdigital'),
                'class'         => 'single',
                'query_args'    => $query_args,
                'attributes' => array(
                    'placeholder' => esc_html_x('Enter the block name...', 'admin-view', 'torresdigital')
                )
            ),
            array(
                'id'            => 'block_content_inner_top',
                'type'          => 'autocomplete',
                'title'         => esc_html_x('Additional Block Content Inner Top', 'admin-view', 'torresdigital'),
                'class'         => 'single',
                'query_args'    => $query_args,
                'attributes' => array(
                    'placeholder' => esc_html_x('Enter the block name...', 'admin-view', 'torresdigital')
                )
            ),
            array(
                'id'            => 'block_content_inner_bottom',
                'type'          => 'autocomplete',
                'title'         => esc_html_x('Additional Block Content Inner Bottom', 'admin-view', 'torresdigital'),
                'class'         => 'single',
                'query_args'    => $query_args,
                'attributes' => array(
                    'placeholder' => esc_html_x('Enter the block name...', 'admin-view', 'torresdigital')
                )
            ),
            array(
                'id'            => 'block_content_bottom',
                'type'          => 'autocomplete',
                'title'         => esc_html_x('Additional Block Content Bottom', 'admin-view', 'torresdigital'),
                'class'         => 'single',
                'query_args'    => $query_args,
                'attributes' => array(
                    'placeholder' => esc_html_x('Enter the block name...', 'admin-view', 'torresdigital')
                )
            )
        )
    );
    return $sections;
}