<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}


/**
 * Social Media settings
 *
 * @param array $sections An array of our sections.
 * @return array
 */
function lapa_options_section_social_media( $sections )
{
    $sections['social_media'] = array(
        'name'          => 'social_panel',
        'title'         => esc_html_x('Social Media', 'admin-view', 'torresdigital'),
        'icon'          => 'fa fa fa-share-alt',
        'sections' => array(
            array(
                'name'      => 'social_link_sections',
                'title'     => esc_html_x('Social Media Links', 'admin-view', 'torresdigital'),
                'icon'      => 'fa fa-share-alt',
                'fields'    => array(
                    array(
                        'id'        => 'social_links',
                        'type'      => 'group',
                        'title'     => esc_html_x('Social Media Links', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('Social media links use a repeater field and allow one network per field. Click the "Add" button to add additional fields.', 'admin-view', 'torresdigital'),
                        'button_title'    => esc_html_x('Add','admin-view', 'torresdigital'),
                        'accordion_title' => 'title',
                        'max_item'  => 10,
                        'fields'    => array(
                            array(
                                'id'        => 'title',
                                'type'      => 'text',
                                'default'   => esc_html_x('Title', 'admin-view', 'torresdigital'),
                                'title'     => esc_html_x('Title', 'admin-view', 'torresdigital')
                            ),
                            array(
                                'id'        => 'icon',
                                'type'      => 'icon',
                                'default'   => 'fa fa-share',
                                'title'     => esc_html_x('Custom Icon', 'admin-view', 'torresdigital')
                            ),
                            array(
                                'id'        => 'link',
                                'type'      => 'text',
                                'default'   => '#',
                                'title'     => esc_html_x('Link (URL)', 'admin-view', 'torresdigital')
                            )
                        )
                    )
                )
            ),
            array(
                'name'      => 'social_sharing_sections',
                'title'     => esc_html_x('Social Sharing Box', 'admin-view', 'torresdigital'),
                'icon'      => 'fa fa-share-square-o',
                'fields'    => array(
                    array(
                        'id'        => 'sharing_facebook',
                        'type'      => 'switcher',
                        'default'   => false,
                        'title'     => esc_html_x('Facebook', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('Turn on to display Facebook in the social share box.', 'admin-view', 'torresdigital')
                    ),
                    array(
                        'id'        => 'sharing_twitter',
                        'type'      => 'switcher',
                        'default'   => false,
                        'title'     => esc_html_x('Twitter', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('Turn on to display Twitter in the social share box.', 'admin-view', 'torresdigital')
                    ),
                    array(
                        'id'        => 'sharing_reddit',
                        'type'      => 'switcher',
                        'default'   => false,
                        'title'     => esc_html_x('Reddit', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('Turn on to display Reddit in the social share box.', 'admin-view', 'torresdigital')
                    ),
                    array(
                        'id'        => 'sharing_linkedin',
                        'type'      => 'switcher',
                        'default'   => false,
                        'title'     => esc_html_x('LinkedIn', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('Turn on to display LinkedIn in the social share box.', 'admin-view', 'torresdigital')
                    ),
                    array(
                        'id'        => 'sharing_google_plus',
                        'type'      => 'switcher',
                        'default'   => false,
                        'title'     => esc_html_x('Google+', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('Turn on to display Google+ in the social share box.', 'admin-view', 'torresdigital')
                    ),
                    array(
                        'id'        => 'sharing_tumblr',
                        'type'      => 'switcher',
                        'default'   => false,
                        'title'     => esc_html_x('Tumblr', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('Turn on to display Tumblr in the social share box.', 'admin-view', 'torresdigital')
                    ),
                    array(
                        'id'        => 'sharing_pinterest',
                        'type'      => 'switcher',
                        'default'   => false,
                        'title'     => esc_html_x('Pinterest', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('Turn on to display Pinterest in the social share box.', 'admin-view', 'torresdigital')
                    ),
                    array(
                        'id'        => 'sharing_vk',
                        'type'      => 'switcher',
                        'default'   => false,
                        'title'     => esc_html_x('VK', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('Turn on to display VK in the social share box.', 'admin-view', 'torresdigital')
                    ),
                    array(
                        'id'        => 'sharing_email',
                        'type'      => 'switcher',
                        'default'   => false,
                        'title'     => esc_html_x('Email', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('Turn on to display Email in the social share box.', 'admin-view', 'torresdigital')
                    )
                )
            )
        )
    );
    return $sections;
}