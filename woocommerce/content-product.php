<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

		global $product;

		// Ensure visibility.
		if ( empty( $product ) || ! $product->is_visible() ) {
			return;
		}
		?>

		<article class="products-collection__item product-item"<?php wc_product_class( '', $product ); ?>>
			<?php
			/**
			 * Hook: woocommerce_before_shop_loop_item.
			 *
			 * @hooked woocommerce_template_loop_product_link_open - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item' );

			/**
			 * Hook: woocommerce_before_shop_loop_item_title.
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );

			/**
			 * Hook: woocommerce_shop_loop_item_title.
			 *
			 * @hooked woocommerce_template_loop_product_title - 10
			 */
			do_action( 'woocommerce_shop_loop_item_title' );

			/**
			* Hook: woocommerce_after_shop_loop_item_title.
			*
			* @hooked woocommerce_template_loop_rating - 5
			* @hooked woocommerce_template_loop_price - 10
			*/
			do_action( 'woocommerce_after_shop_loop_item_title' );

			/**
			* Hook: woocommerce_after_shop_loop_item.
			*
			* @hooked woocommerce_template_loop_product_link_close - 5
			* @hooked woocommerce_template_loop_add_to_cart - 10
			*/
			do_action( 'woocommerce_after_shop_loop_item' );

			?>
			<div class="product-item__info-buttons">
				<a class="product-item__buy btn-purple " href="<?php echo $product->add_to_cart_url() ?>" value="<?php echo esc_attr( $product->get_id() ); ?>" data-product_id="<?php echo get_the_ID(); ?>" data-product_sku="<?php echo esc_attr($sku) ?>" aria-label="Add “<?php the_title_attribute() ?>” to your cart">
					В корзину
				</a>
				
				<button type="button" data-popup-open="popup-one-click" data-click="<?php echo($product->get_id() ); ?>" class="product-item__one-click btn-one-click">
					<svg>
						<use xlink:href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/icons/icons.svg#svg-one-click"></use>
					</svg>
				</button>
			</div>
			
			
	</article>
