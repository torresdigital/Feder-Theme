<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

class Lapa_Init{

    public function __construct(){
        add_action( 'after_setup_theme', array( $this, 'load_textdomain' ) );
        add_action( 'after_setup_theme', array( $this, 'add_theme_supports' ) );
        add_action( 'after_setup_theme', array( $this, 'register_nav_menus' ) );
        add_action( 'after_setup_theme', array( $this, 'set_default_options' ) );

        add_action( 'widgets_init', array( $this, 'widget_init' ) );

    }

    public function load_textdomain(){
        load_theme_textdomain( 'torresdigital', Lapa::$template_dir_path . '/languages' );
        load_child_theme_textdomain( 'torresdigital', Lapa::$stylesheet_dir_path . '/languages' );
    }

    public function add_theme_supports(){
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'custom-header' );
        add_theme_support( 'custom-background' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'post-formats', array(
            'quote',
            'image',
            'video',
            'link',
            'audio',
            'gallery'
        ) );
        add_theme_support( 'woocommerce');
        add_theme_support( 'wc-product-gallery-zoom');
        add_theme_support( 'wc-product-gallery-lightbox');
    }

    public function register_nav_menus(){
        register_nav_menus( array(
            'main-nav'   => esc_attr_x( 'Main Navigation', 'admin-view', 'torresdigital' ),
            'mobile-nav' => esc_attr_x( 'Mobile Navigation', 'admin-view', 'torresdigital' ),
            'aside-nav'  => esc_attr_x( 'Aside Navigation', 'admin-view', 'torresdigital' ),
            'shop-category-nav'  => esc_attr_x( 'Category Navigation ( For header 7 )', 'admin-view', 'torresdigital' ),
        ) );
    }

    public function set_default_options(){
        $check_theme = get_option('lapa_has_init', false);
        if(!$check_theme || !get_option(Lapa()->get_option_name())){
            update_option(
                Lapa()->get_option_name(),
                json_decode('{"layout":"col-2cl","body_boxed":"no","body_max_width":"1230","main_full_width":"no","google_rich_snippets":"no","backtotop_btn":"no","text_color":"rgba(0,0,0,0.7)","heading_color":"#343538","primary_color":"#ef5619","secondary_color":"#343538","three_color":"#9d9d9d","border_color":"#e8e8e8","page_loading_animation":"on","page_loading_style":"3","page_loading_custom":"","body_font_size":"14px","font_source":"1","main_font":{"family":"Libre Franklin","variant":["300","300italic","regular","italic","700","700italic"],"font":"google"},"secondary_font":{"family":"Libre Franklin","variant":["regular"],"font":"google"},"highlight_font":{"family":"Playfair Display","variant":["regular","italic"],"font":"google"},"font_google_code":"","main_google_font_face":"","secondary_google_font_face":"","highlight_google_font_face":"","font_typekit_kit_id":"","main_typekit_font_face":"","secondary_typekit_font_face":"","highlight_typekit_font_face":"","heading_custom_font":"no","header_layout":"11","header_full_width":"no","header_transparency":"no","header_show_cart":"no","header_show_search":"yes","header_show_wishlist":"no","header_show_menu_account":"no","header_show_menu_hamburger":"no","enable_header_top":"no","header_background":{"image":"","repeat":"repeat","position":"left top","attachment":"","size":"","color":"#fff"},"header_text_color":"#343538","header_link_color":"#343538","header_link_hover_color":"#ef5619","mm_lv_1_color":"#343538","mm_lv_1_bg_color":"rgba(0,0,0,0)","mm_lv_1_hover_color":"#ef5619","mm_lv_1_hover_bg_color":"rgba(0,0,0,0)","header_top_background_color":"rgba(0,0,0,0)","header_top_text_color":"rgba(255,255,255,0.2)","header_top_link_color":"#fff","header_top_link_hover_color":"#ef5619","transparency_header_background":{"image":"","repeat":"repeat","position":"left top","attachment":"","size":"","color":"rgba(0,0,0,0)"},"transparency_header_text_color":"#fff","transparency_header_link_color":"#fff","transparency_header_link_hover_color":"#ef5619","transparency_mm_lv_1_color":"#fff","transparency_mm_lv_1_bg_color":"rgba(0,0,0,0)","transparency_mm_lv_1_hover_color":"#ef5619","transparency_mm_lv_1_hover_bg_color":"rgba(0,0,0,0)","transparency_header_top_background_color":"rgba(0,0,0,0)","transparency_header_top_text_color":"rgba(255,255,255,0.2)","transparency_header_top_link_color":"#fff","transparency_header_top_link_hover_color":"#ef5619","offcanvas_background":"#fff","offcanvas_text_color":"#343538","offcanvas_heading_color":"#343538","offcanvas_link_color":"#343538","offcanvas_link_hover_color":"#ef5619","mm_dropdown_bg":"#fff","mm_dropdown_link_color":"#8a8a8a","mm_dropdown_link_bg":"rgba(0,0,0,0)","mm_dropdown_link_hover_color":"#343538","mm_dropdown_link_hover_bg":"rgba(0,0,0,0)","mm_wide_dropdown_bg":"#fff","mm_wide_dropdown_heading_color":"#343538","mm_wide_dropdown_link_color":"#8a8a8a","mm_wide_dropdown_link_bg":"rgba(0,0,0,0)","mm_wide_dropdown_link_hover_color":"#343538","mm_wide_dropdown_link_hover_bg":"rgba(0,0,0,0)","header_mb_background":"#fff","header_mb_text_color":"#8a8a8a","mb_background":"#fff","mb_lv_1_color":"#343538","mb_lv_1_bg_color":"rgba(0,0,0,0)","mb_lv_1_hover_color":"#ef5619","mb_lv_1_hover_bg_color":"rgba(0,0,0,0)","mb_lv_2_color":"#343538","mb_lv_2_bg_color":"rgba(0,0,0,0)","mb_lv_2_hover_color":"#fff","mb_lv_2_hover_bg_color":"#ef5619","page_title_bar_layout":"1","page_title_bar_heading_color":"#343538","page_title_bar_text_color":"#8a8a8a","page_title_bar_link_color":"#8a8a8a","page_title_bar_link_hover_color":"#ef5619","page_title_bar_spacing":{"top":"30","bottom":"20"},"page_title_bar_spacing_tablet":{"top":"25","bottom":"25"},"page_title_bar_spacing_mobile":{"top":"25","bottom":"25"},"woo_override_page_title_bar":"off","woo_page_title_bar_layout":"hide","add_sidebars":{"1":{"sidebar_id":"Sidebar Shop Area","sidebar_desc":""}},"pages_sidebar":"","portfolio_sidebar":"","portfolio_archive_sidebar":"","posts_sidebar":"","blog_archive_sidebar":"","search_sidebar":"","products_sidebar":"","shop_sidebar":"sidebar-shop-area","footer_layout":"1col","footer_full_width":"no","enable_footer_copyright":"yes","footer_copyright":"<div class=\"row\"><div class=\"col-xs-12\"><div class=\"small text-uppercase text-center\">2018 Created by LaStudio</div></div></div>","footer_text_color":"#8a8a8a","footer_heading_color":"#343538","footer_link_color":"#8a8a8a","footer_link_hover_color":"#ef5619","footer_copyright_background_color":"#000","footer_copyright_text_color":"#fff","footer_copyright_link_color":"#fff","footer_copyright_link_hover_color":"#fff","layout_blog":"col-2cl","blog_small_layout":"off","page_title_bar_layout_blog_global":"on","blog_design":"grid_3","blog_post_column":{"xlg":"1","lg":"1","md":"1","sm":"1","xs":"1","mb":"1"},"featured_images_blog":"on","blog_thumbnail_size":"full","format_content_blog":"off","blog_content_display":"excerpt","blog_excerpt_length":"60","blog_masonry":"off","blog_pagination_type":"pagination","layout_single_post":"col-2cl","single_small_layout":"on","page_title_bar_layout_post_single_global":"off","featured_images_single":"on","blog_pn_nav":"off","blog_post_title":"off","blog_author_info":"off","blog_social_sharing_box":"off","blog_related_posts":"off","blog_related_design":"1","blog_related_by":"random","blog_related_max_post":"2","blog_comments":"on","layout_archive_product":"col-1c","catalog_mode":"off","catalog_mode_price":"off","active_shop_filter":"on","hide_shop_toolbar":"off","shop_catalog_display_type":"grid","shop_catalog_grid_style":"1","active_shop_masonry":"off","shop_masonry_column_type":"default","product_masonry_image_size":"shop_catalog","product_masonry_item_width":"270","product_masonry_item_height":"390","woocommerce_shop_page_columns":{"xlg":"4","lg":"4","md":"3","sm":"2","xs":"1","mb":"1"},"woocommerce_shop_masonry_columns":{"xlg":"4","lg":"4","md":"3","sm":"2","xs":"1","mb":"1"},"woocommerce_shop_masonry_custom_columns":{"md":"3","sm":"2","xs":"1","mb":"1"},"shop_masonry_item_gap":"30","enable_shop_masonry_custom_setting":"off","shop_masonry_item_setting":[{"size_name":"1x Width + 1x Height","width":"1","height":"1"}],"product_per_page_allow":"12,15,30","product_per_page_default":"12","woocommerce_enable_crossfade_effect":"on","woocommerce_toggle_grid_list":"on","woocommerce_show_rating_on_catalog":"on","woocommerce_show_quickview_btn":"on","woocommerce_show_wishlist_btn":"on","woocommerce_show_compare_btn":"on","layout_single_product":"col-1c","woocommerce_product_page_design":"2","product_sharing":"off","related_products":"on","related_product_title":"Related Products","related_product_subtitle":"Sed vitae eros a quam malesuada porttitor nec nec","related_products_columns":{"xlg":"4","lg":"4","md":"3","sm":"2","xs":"2","mb":"1"},"upsell_products":"on","upsell_product_title":"Up-Sells Products","upsell_product_subtitle":"Sed vitae eros a quam malesuada porttitor nec nec","upsell_products_columns":{"xlg":"4","lg":"4","md":"3","sm":"2","xs":"2","mb":"1"},"crosssell_products":"on","crosssell_product_title":"Related Products","crosssell_product_subtitle":"Sed vitae eros a quam malesuada porttitor nec nec","crosssell_products_columns":{"xlg":"4","lg":"4","md":"3","sm":"2","xs":"1","mb":"1"},"layout_archive_portfolio":"col-1c","main_full_width_archive_portfolio":"yes","main_space_archive_portfolio":{"top":"","bottom":""},"portfolio_display_type":"grid","portfolio_item_space":"0","portfolio_display_style":"1","portfolio_column":{"xlg":"4","lg":"4","md":"3","sm":"3","xs":"1","mb":"1"},"portfolio_per_page":"8","portfolio_thumbnail_size":"480x390","layout_single_portfolio":"col-1c","single_portfolio_design":"1","single_portfolio_nextprev":"on","social_links":{"1":{"title":"Facebook","icon":"fa fa-facebook","link":"#"},"2":{"title":"Twitter","icon":"fa fa-twitter","link":"#"},"3":{"title":"Pinterest","icon":"fa fa-pinterest-p","link":"#"}},"sharing_facebook":true,"sharing_twitter":true,"sharing_google_plus":true,"sharing_pinterest":true,"google_key":"","instagram_token":"","newsletter_popup_delay":"2000","popup_dont_show_text":"Do not show popup anymore","newsletter_popup_show_again":"1","newsletter_popup_content":"","enable_maintenance":"no","pages_global_sidebar":false,"portfolio_global_sidebar":false,"portfolio_archive_global_sidebar":false,"posts_global_sidebar":false,"blog_archive_global_sidebar":false,"products_global_sidebar":false,"shop_global_sidebar":false,"sharing_reddit":false,"sharing_linkedin":false,"sharing_tumblr":false,"sharing_vk":false,"sharing_email":false,"enable_newsletter_popup":false,"only_show_newsletter_popup_on_home_page":false,"disable_popup_on_mobile":false,"show_checkbox_hide_newsletter_popup":false,"header_mb_layout":"2","header_mb_component_1":{"1":{"type":"search_1"},"2":{"type":"primary_menu"}},"footer_space":{"padding_top":"50px", "padding_bottom": "10px"}}',true)
            );
            update_option('lapa_has_init', true);
        }
        remove_image_size('yith-woocompare-image');
        remove_image_size('medium_large');
        add_editor_style('editor-style.css');
    }

    public function widget_init(){
        register_widget('Lapa_Widget_Recent_Posts');
        register_widget('Lapa_Widget_Contact_Info');
        register_widget('Lapa_Widget_Twitter_Feed');

        if(class_exists('WC_Widget')){
            register_widget('Lapa_Widget_Product_Sort_By');
            register_widget('Lapa_Widget_Price_Filter_List');
            register_widget('Lapa_Widget_Product_Tag');
        }

        register_sidebar(array(
            'name'          => esc_attr_x( 'Sidebar Widget Area', 'admin-view', 'torresdigital' ),
            'id'            => 'sidebar-primary',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title"><span>',
            'after_title'   => '</span></h3>'
        ));
        register_sidebar(array(
            'name'          => esc_attr_x( 'Sidebar Shop Filter', 'admin-view', 'torresdigital' ),
            'id'            => 'sidebar-shop-filter',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title"><span>',
            'after_title'   => '</span></h3>'
        ));

        register_sidebar(array(
            'name'          => esc_attr_x( 'Aside Header Widget Area', 'admin-view', 'torresdigital' ),
            'id'            => 'aside-widget',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title"><span>',
            'after_title'   => '</span></h3>'
        ));

        register_sidebar(array(
            'name'          => esc_attr_x( 'Header Bottom Widget Area', 'admin-view', 'torresdigital' ),
            'desc'          => esc_attr_x( 'Apply for only header layout 5,7', 'admin-view', 'torresdigital' ),
            'id'            => 'header-sidebar-bottom',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title"><span>',
            'after_title'   => '</span></h3>'
        ));

        register_sidebar( array(
            'name'          => esc_attr_x( 'Footer Widget Area Column 1', 'admin-view', 'torresdigital' ),
            'id'            => 'f-col-1',
            'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-inner">',
            'after_widget'  => '</div></div>',
            'before_title'  => '<h3 class="widget-title"><span>',
            'after_title'   => '</span></h3>'
        ) );
        register_sidebar( array(
            'name'          => esc_attr_x( 'Footer Widget Area Column 2', 'admin-view', 'torresdigital' ),
            'id'            => 'f-col-2',
            'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-inner">',
            'after_widget'  => '</div></div>',
            'before_title'  => '<h3 class="widget-title"><span>',
            'after_title'   => '</span></h3>'
        ) );
        register_sidebar( array(
            'name'          => esc_attr_x( 'Footer Widget Area Column 3', 'admin-view', 'torresdigital' ),
            'id'            => 'f-col-3',
            'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-inner">',
            'after_widget'  => '</div></div>',
            'before_title'  => '<h3 class="widget-title"><span>',
            'after_title'   => '</span></h3>',
        ) );
        register_sidebar( array(
            'name'          => esc_attr_x( 'Footer Widget Area Column 4', 'admin-view', 'torresdigital' ),
            'id'            => 'f-col-4',
            'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-inner">',
            'after_widget'  => '</div></div>',
            'before_title'  => '<h3 class="widget-title"><span>',
            'after_title'   => '</span></h3>'
        ) );
        register_sidebar( array(
            'name'          => esc_attr_x( 'Footer Widget Area Column 5', 'admin-view', 'torresdigital' ),
            'id'            => 'f-col-5',
            'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-inner">',
            'after_widget'  => '</div></div>',
            'before_title'  => '<h3 class="widget-title"><span>',
            'after_title'   => '</span></h3>'
        ) );
        register_sidebar(array(
            'name'          => esc_attr_x( 'Custom Block Top', 'admin-view', 'torresdigital' ),
            'id'            => 'la-custom-block-top',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title"><span>',
            'after_title'   => '</span></h3>'
        ));
        register_sidebar(array(
            'name'          => esc_attr_x( 'Custom Block Inner Top', 'admin-view', 'torresdigital' ),
            'id'            => 'la-custom-block-inner-top',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title"><span>',
            'after_title'   => '</span></h3>'
        ));
        register_sidebar(array(
            'name'          => esc_attr_x( 'Custom Block Inner Bottom', 'admin-view', 'torresdigital' ),
            'id'            => 'la-custom-block-inner-bottom',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title"><span>',
            'after_title'   => '</span></h3>'
        ));
        register_sidebar(array(
            'name'          => esc_attr_x( 'Custom Block Bottom', 'admin-view', 'torresdigital' ),
            'id'            => 'la-custom-block-bottom',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title"><span>',
            'after_title'   => '</span></h3>'
        ));

        
        $dynamic_sidebar = Lapa()->settings()->get('add_sidebars');
        if(!empty($dynamic_sidebar)){
            foreach($dynamic_sidebar as $sidebar){
                if(empty($sidebar['sidebar_id'])){
                    continue;
                }
                register_sidebar(array(
                    'name'          => esc_html($sidebar['sidebar_id']),
                    'id'            => sanitize_title($sidebar['sidebar_id']),
                    'description'   => sprintf(_x('ID:{{%s}} ', 'admin-view', 'torresdigital'), sanitize_title($sidebar['sidebar_id'])) . (!empty($sidebar['sidebar_desc']) ? esc_html($sidebar['sidebar_desc']) : ''),
                    'before_widget' => '<div id="%1$s" class="widget %2$s">',
                    'after_widget'  => '</div>',
                    'before_title'  => '<h3 class="widget-title"><span>',
                    'after_title'   => '</span></h3>',
                ));
            }
        }
    }
}