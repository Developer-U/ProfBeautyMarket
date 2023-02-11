<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

if( is_shop() ): 
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
endif;


// Удаляем изображение товара на странице каталога, так как оно с неверными стилями
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

// Удаляем название товара на странице каталога, так как оно с неверными стилями
remove_all_actions( 'woocommerce_shop_loop_item_title' );

// Удалим стандартный вывод рейтинга, так как он не в том месте
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

// Удалим апсейлы, так как они не в том месте
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );



// Удалим слово Распродажа с карточки товара
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );

// Удалим стандартный вывод цен в карточке товара в категории (archive), так как он не устраивает
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);


// Отключим все ненужные поведения картинок в карточке
remove_theme_support( 'wc-product-gallery-zoom' );
remove_theme_support( 'wc-product-gallery-lightbox' );

// Удалим слово Распродажа у товара в карточке
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

// Удалим похожие товары в карточке (по дизайну они не нужны)
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );