<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php
/**
 * woocommerce_before_single_product hook.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form();
	return;
}

$product_design = Lapa()->settings()->get('woocommerce_product_page_design', 1);
$site_layout = Lapa()->layout()->get_site_layout();

$class = 'la-p-single-wrap la-p-single-'. $product_design;

?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( $class, get_the_ID() ); ?>>

	<div class="row la-single-product-page vc_row"<?php if($site_layout == 'col-1c'): ?> data-vc-full-width="true" data-vc-stretch-content="false"<?php endif;?>>
		<div class="col-xs-12 col-sm-6 col-md-5 p-left product-main-image">
			<div class="p---large">
				<?php
				/**
				 * woocommerce_before_single_product_summary hook.
				 *
				 * @hooked woocommerce_show_product_sale_flash - 10
				 * @hooked woocommerce_show_product_images - 20
				 */
				do_action( 'woocommerce_before_single_product_summary' );

				?>
			</div>
		</div><!-- .product--images -->
		<div class="col-xs-12 col-sm-6 col-md-7 p-right product--summary">
			<div class="la-custom-pright">
				<div class="summary entry-summary">

					<?php
					/**
					 * woocommerce_single_product_summary hook.
					 *
					 * @hooked woocommerce_template_single_title - 5
					 * @hooked woocommerce_template_single_rating - 10
					 * @hooked woocommerce_template_single_price - 10
					 * @hooked woocommerce_template_single_excerpt - 20
					 * @hooked woocommerce_template_single_add_to_cart - 30
					 * @hooked woocommerce_template_single_meta - 50
					 */
					do_action( 'woocommerce_single_product_summary' );
					?>
				</div>

				<?php woocommerce_template_single_sharing(); ?>

			</div>
		</div><!-- .product-summary -->
	</div>
	<?php if($site_layout == 'col-1c'): ?>
		<div class="vc_row-full-width vc_clearfix"></div>
	<?php endif;?>
	<div class="row">
		<div class="col-xs-12">
			<?php
			/**
			 * woocommerce_after_single_product_summary hook.
			 *
			 * @hooked woocommerce_output_product_data_tabs - 10
			 * @hooked woocommerce_upsell_display - 15
			 * @hooked woocommerce_output_related_products - 20
			 */
			do_action( 'woocommerce_after_single_product_summary' );
			?>
		</div>
	</div>

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
