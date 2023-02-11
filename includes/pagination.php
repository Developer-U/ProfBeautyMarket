<?php

/*
* Пагинация страниц на сайте через плагин PageNavi
*
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Заменяем стандартную пагинацию WooCommerce на постраничную  навигацию WP-PageNavi
 *
 */
remove_action('woocommerce_pagination', 'woocommerce_pagination', 10);
function woocommerce_pagination() {
		wp_pagenavi(); 		
	}
add_action( 'woocommerce_pagination', 'woocommerce_pagination', 10);