<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}


/**
 * Portfolio settings
 *
 * @param array $sections An array of our sections.
 * @return array
 */
function lapa_options_section_portfolio( $sections )
{
    $sections['portfolio'] = array(
        'name' => 'portfolio_panel',
        'title' => esc_html_x('Portfolio', 'admin-view', 'torresdigital'),
        'icon' => 'fa fa-th',
        'sections' => array(
            array(
                'name'      => 'portfolio_label_section',
                'title'     => esc_html_x('Label Setting', 'admin-view', 'torresdigital'),
                'icon'      => 'fa fa-check',
                'fields'    => array(
                    array(
                        'id'        => 'portfolio_custom_name',
                        'type'      => 'text',
                        'default'   => 'Portfolios',
                        'title'     => esc_html_x('Portfolio Name', 'admin-view', 'torresdigital'),
                    ),
                    array(
                        'id'        => 'portfolio_custom_name2',
                        'type'      => 'text',
                        'default'   => 'Portfolio',
                        'title'     => esc_html_x('Portfolio Singular Name', 'admin-view', 'torresdigital'),
                    ),
                    array(
                        'id'        => 'portfolio_custom_slug',
                        'type'      => 'text',
                        'default'   => 'portfolio',
                        'title'     => esc_html_x('Portfolio Slug', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('When you change the portfolio slug, please remember go to Setting -> Permalinks and click to Save Changes button once again', 'admin-view', 'torresdigital'),
                    ),

                    array(
                        'id'        => 'portfolio_cat_custom_name',
                        'type'      => 'text',
                        'default'   => 'Portfolio Categories',
                        'title'     => esc_html_x('Portfolio Category Name', 'admin-view', 'torresdigital'),
                    ),

                    array(
                        'id'        => 'portfolio_cat_custom_name2',
                        'type'      => 'text',
                        'default'   => 'Portfolio Category',
                        'title'     => esc_html_x('Portfolio Category Singular Name', 'admin-view', 'torresdigital'),
                    ),
                    array(
                        'id'        => 'portfolio_cat_custom_slug',
                        'type'      => 'text',
                        'default'   => 'portfolio-category',
                        'title'     => esc_html_x('Portfolio Category Slug', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('When you change the portfolio slug, please remember go to Setting -> Permalinks and click to Save Changes button once again', 'admin-view', 'torresdigital'),
                    ),

                    array(
                        'id'        => 'portfolio_skill_custom_name',
                        'type'      => 'text',
                        'default'   => 'Portfolio Skills',
                        'title'     => esc_html_x('Portfolio Skill Name', 'admin-view', 'torresdigital'),
                    ),
                    array(
                        'id'        => 'portfolio_skill_custom_name2',
                        'type'      => 'text',
                        'default'   => 'Portfolio Skill',
                        'title'     => esc_html_x('Portfolio Skill Singular Name', 'admin-view', 'torresdigital'),
                    ),
                    array(
                        'id'        => 'portfolio_skill_custom_slug',
                        'type'      => 'text',
                        'default'   => 'portfolio-skill',
                        'title'     => esc_html_x('Portfolio Skill Slug', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('When you change the portfolio slug, please remember go to Setting -> Permalinks and click to Save Changes button once again', 'admin-view', 'torresdigital'),
                    )
                )
            ),
            array(
                'name'      => 'portfolio_general_section',
                'title'     => esc_html_x('General Setting', 'admin-view', 'torresdigital'),
                'icon'      => 'fa fa-check',
                'fields'    => array(
                    array(
                        'id'        => 'layout_archive_portfolio',
                        'type'      => 'image_select',
                        'title'     => esc_html_x('Archive Portfolio Layout', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('Controls the layout of archive portfolio page', 'admin-view', 'torresdigital'),
                        'default'   => 'col-1c',
                        'radio'     => true,
                        'options'   => Lapa_Options::get_config_main_layout_opts(true, false)
                    ),
                    array(
                        'id'        => 'main_full_width_archive_portfolio',
                        'type'      => 'radio',
                        'class'     => 'la-radio-style',
                        'default'   => 'inherit',
                        'title'     => esc_html_x('100% Main Width', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('[Portfolio] Turn on to have the main area display at 100% width according to the window size. Turn off to follow site width.', 'admin-view', 'torresdigital'),
                        'options'   => Lapa_Options::get_config_radio_opts()
                    ),
                    array(
                        'id'            => 'main_space_archive_portfolio',
                        'type'          => 'spacing',
                        'title'         => esc_html_x('Custom Main Space', 'admin-view', 'torresdigital'),
                        'desc'          => esc_html_x('[Portfolio]Leave empty if you not need', 'admin-view', 'torresdigital'),
                        'unit' 	        => 'px'
                    ),
                    array(
                        'id'        => 'portfolio_display_type',
                        'default'   => 'grid',
                        'title'     => esc_html_x('Display Type as', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('Controls the type display of portfolio for the archive page', 'admin-view', 'torresdigital'),
                        'type'      => 'select',
                        'options'   => array(
                            'grid'           => esc_html_x('Grid', 'admin-view', 'torresdigital'),
                            'masonry'        => esc_html_x('Masonry', 'admin-view', 'torresdigital')
                        )
                    ),
                    array(
                        'id'        => 'portfolio_item_space',
                        'default'   => '0',
                        'title'     => esc_html_x('Item Padding', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('Select gap between item in grids', 'admin-view', 'torresdigital'),
                        'type'      => 'select',
                        'options'   => array(
                            '0'         => esc_html_x('0px', 'admin-view', 'torresdigital'),
                            '5'          => esc_html_x('5px', 'admin-view', 'torresdigital'),
                            '10'         => esc_html_x('10px', 'admin-view', 'torresdigital'),
                            '15'         => esc_html_x('15px', 'admin-view', 'torresdigital'),
                            '20'         => esc_html_x('20px', 'admin-view', 'torresdigital'),
                            '25'         => esc_html_x('25px', 'admin-view', 'torresdigital'),
                            '30'         => esc_html_x('30px', 'admin-view', 'torresdigital'),
                            '35'         => esc_html_x('35px', 'admin-view', 'torresdigital'),
                            '40'         => esc_html_x('40px', 'admin-view', 'torresdigital'),
                            '45'         => esc_html_x('45px', 'admin-view', 'torresdigital'),
                            '50'         => esc_html_x('50px', 'admin-view', 'torresdigital'),
                            '55'         => esc_html_x('55px', 'admin-view', 'torresdigital'),
                            '60'         => esc_html_x('60px', 'admin-view', 'torresdigital'),
                            '65'         => esc_html_x('65px', 'admin-view', 'torresdigital'),
                            '70'         => esc_html_x('70px', 'admin-view', 'torresdigital'),
                            '75'         => esc_html_x('75px', 'admin-view', 'torresdigital'),
                            '80'         => esc_html_x('80px', 'admin-view', 'torresdigital'),
                        )
                    ),
                    array(
                        'id'        => 'portfolio_display_style',
                        'default'   => '1',
                        'title'     => esc_html_x('Select Style', 'admin-view', 'torresdigital'),
                        'type'      => 'select',
                        'options'   => array(
                            '1'           => esc_html_x('Style 01', 'admin-view', 'torresdigital'),
                            '2'           => esc_html_x('Style 02', 'admin-view', 'torresdigital'),
                            '3'           => esc_html_x('Style 03', 'admin-view', 'torresdigital'),
                            '4'           => esc_html_x('Style 04', 'admin-view', 'torresdigital'),
                            '5'           => esc_html_x('Style 05', 'admin-view', 'torresdigital'),
                            '6'           => esc_html_x('Style 06', 'admin-view', 'torresdigital'),
                            '7'           => esc_html_x('Style 07', 'admin-view', 'torresdigital'),
                            '8'           => esc_html_x('Style 08', 'admin-view', 'torresdigital')
                        )
                    ),
                    array(
                        'id'        => 'portfolio_column',
                        'type'      => 'column_responsive',
                        'title'     => esc_html_x('Portfolio Column', 'admin-view', 'torresdigital'),
                        'default'   => array(
                            'xlg' => 3,
                            'lg' => 3,
                            'md' => 2,
                            'sm' => 2,
                            'xs' => 1,
                            'mb' => 1
                        )
                    ),
                    array(
                        'id'        => 'portfolio_per_page',
                        'type'      => 'number',
                        'default'   => 10,
                        'attributes'=> array(
                            'min' => 1,
                            'max' => 100
                        ),
                        'title'     => esc_html_x('Total Portfolio will be display in a page', 'admin-view', 'torresdigital')
                    ),
                    array(
                        'id'        => 'portfolio_thumbnail_size',
                        'type'      => 'text',
                        'default'   => 'full',
                        'title'     => esc_html_x('Portfolio Thumbnail size', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).', 'admin-view', 'torresdigital')
                    )
                )
            ),
            array(
                'name'      => 'single_portfolio_general_section',
                'title'     => esc_html_x('Portfolio Single', 'admin-view', 'torresdigital'),
                'icon'      => 'fa fa-check',
                'fields'    => array(
                    array(
                        'id'        => 'layout_single_portfolio',
                        'type'      => 'image_select',
                        'title'     => esc_html_x('Single Portfolio Layout', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('Controls the layout of portfolio detail page', 'admin-view', 'torresdigital'),
                        'default'   => 'col-1c',
                        'radio'     => true,
                        'options'   => Lapa_Options::get_config_main_layout_opts(true, false)
                    ),
                    array(
                        'id'        => 'single_portfolio_nextprev',
                        'type'      => 'radio',
                        'class'     => 'la-radio-style',
                        'default'   => 'on',
                        'title'     => esc_html_x('Show Next / Previous Portfolio', 'admin-view', 'torresdigital'),
                        'desc'      => esc_html_x('Turn on to display next/previous portfolio', 'admin-view', 'torresdigital'),
                        'options'   => Lapa_Options::get_config_radio_onoff(false)
                    )
                )
            )
        )
    );
    return $sections;
}