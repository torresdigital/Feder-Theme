<?php

/**
 * Lapa Theme Function
 *
 */

add_action( 'after_setup_theme', 'lapa_child_theme_setup' );
add_action( 'wp_enqueue_scripts', 'lapa_child_enqueue_styles', 20);

if( !function_exists('lapa_child_enqueue_styles') ) {
    function lapa_child_enqueue_styles() {
        wp_enqueue_style( 'lapa-child-style',
            get_stylesheet_directory_uri() . '/style.css',
            array( 'lapa-theme' ),
            wp_get_theme()->get('Version')
        );
    }
}

if( !function_exists('lapa_child_theme_setup') ) {
    function lapa_child_theme_setup() {
        load_child_theme_textdomain( 'lapa-child', get_stylesheet_directory() . '/languages' );
    }
}


/* Funções Torres Digital */

add_action( 'woocommerce_single_product_summary', 'Torres_Digital_show_sku', 5 );
function Torres_Digital_show_sku(){
global $product;
echo 'Referência do Produto: ' . $product->get_sku();
}

