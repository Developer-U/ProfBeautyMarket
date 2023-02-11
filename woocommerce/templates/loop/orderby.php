<?php
/**
 * Show options for ordering
 * Шаблон определяет вывод сортировки товаров
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		Moiseev Yury
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


?>
<form class="sort-options__body" method="get" aria-label="<?php esc_attr_e( 'Shop order', 'woocommerce' ); ?>">
	
    <?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
        <div class="sort-options__item">
            <a href="?orderby=<?php echo esc_attr( $id );?>"><?php echo esc_html( $name )?></a>
        </div>
    <?php endforeach; ?>
    
    <?php wc_query_string_form_fields( null, array( 'orderby', 'submit', 'paged', 'product-page' ) ); ?>
</form>