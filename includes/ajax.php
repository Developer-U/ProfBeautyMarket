<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Переопределяем стандартный поиск и создаём свой поиск
add_filter('get_search_form', 'estore_search_form');
function estore_search_form($form) {
	$form = '
		<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
			<input type="text" value="' . get_search_query() . '" name="s" class="search-input" id="s" placeholder="Введите нужный товар" />
		</form>
		<div class="result-search">
			<div class="preloader"><img src=" ' . get_template_directory_uri() . '/assets/images/loader.gif" class="loader" /></div>
			<div class="result-search-list"></div>
		</div>
	';
	return $form;
}

function est_search_action_callback(){
	$args = array(
		's' => $_POST['term'],
		'posts_per_page' => 12
	);
	$the_query = new WP_Query($args);
	if ($the_query->have_posts()) {
		while ($the_query->have_posts()) {
			$the_query->the_post();
?>
    <div class="result_item clear">
        <?php
            if(has_post_thumbnail()) {
                the_post_thumbnail(array('class'=>'post_thumbnail'));
            } else {
        ?>
                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/icons/sprite.svg#magnifier" />
        <?php } ?>
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        <?php the_excerpt();?>
    </div>
<?php
		}
	} else {
?>
	<div class="result_item">
		<span class="not_found">Ничего не найдено, попробуйте другой запрос</span>
	</div>
<?php
	}
	exit;
}
add_action('wp_ajax_nopriv_search-ajax','est_search_action_callback');
add_action('wp_ajax_search-ajax','est_search_action_callback');


add_action( 'wp_ajax_ajax_quick_view', 'estore_quick_view_product_callback' );
add_action( 'wp_ajax_nopriv_ajax_quick_view', 'estore_quick_view_product_callback' );
function estore_quick_view_product_callback(){
	
	if ( ! wp_verify_nonce( $_POST['nonce'], 'quick-nonce' ) ) {
		wp_die( 'Данные отправлены с левого адреса' );
	}
	$product = wc_get_product(esc_attr($_POST['id']));
	ob_start();
	?>

		<div class="popup__body">
			<div class="popup__title">Заполните форму <br> и мы Вам перезвоним</div>
			<div class="popup__product-list">
				<div class="popup__product-item">			
					<div class="popup__product-img">
					<?php
					$attachment_id = get_post_thumbnail_id( $product->get_id() );
					$product_thumb = wp_get_attachment_image_url( $attachment_id, 'shop_single');
					?>
						<img src="<?php echo $product_thumb; ?>" alt="">
					</div>

					<a href="#" class="popup__product-name"><?php echo $product->get_name(); ?></a>
					<div class="popup__product-bot">
						<div data-quantity class="popup__product-quantity quantity">
							<button type="button" class="quantity__button quantity__button_minus calc__btn minus"></button>
							<div class="quantity__input">
								<input readonly autocomplete="off" type="number" title="Qty" min="1" max="1000" step="1" value="1">
							</div>
							<button type="button" class="quantity__button quantity__button_plus calc__btn plus"></button>
						</div>
						<div class="popup__product-price">
							<?php if($product->get_sale_price()): 
								echo '<span>' . $product->get_sale_price() . '</span>₽'; ?>
							<?php else:
								echo '<span>' . $product->get_regular_price() . '</span>₽'; ?>
							<?php endif; ?>
						</div>
					</div>

					
				</div>
			</div>
		</div>

	<?php 
	$data['product'] = ob_get_clean();
	wp_send_json($data);
	// И в конце убиваем весь процесс аякса
	wp_die();
}