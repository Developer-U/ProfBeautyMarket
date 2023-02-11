<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}




// Удалим из корзины стандартный вывод кросс-сейлов
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');

// И добавим в самый низ
add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display', 5);



