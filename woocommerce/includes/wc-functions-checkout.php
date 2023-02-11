<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Удалим вывод купонов на странице checkout
remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10);

// Удалим ненужные поля
add_filter( 'woocommerce_checkout_fields', 'estore_del_fields', 25 );
 
function estore_del_fields( $fields ) {
	// unset( $fields[ 'billing' ][ 'billing_state' ] ); // регион, штат

    unset( $fields[ 'billing' ][ 'billing_last_name' ] ); // поле Фамилия
    unset( $fields[ 'billing' ][ 'billing_company' ] ); // компания
    // unset( $fields[ 'billing' ][ 'billing_country' ] ); // страна
	unset( $fields[ 'billing' ][ 'billing_address_1' ] ); // адрес 1
	unset( $fields[ 'billing' ][ 'billing_address_2' ] ); // адрес 2
	unset( $fields[ 'billing' ][ 'billing_city' ] ); // город	
	unset( $fields[ 'billing' ][ 'billing_postcode' ] ); // почтовый индекс
	unset( $fields['shipping']['order_comments'] );	
	// unset( $fields[ 'order' ][ 'order_comments' ] ); // заметки к заказу

    return $fields;
}

// add_filter( 'woocommerce_checkout_fields' , 'wpbl_show_fields' );
 
// function wpbl_show_fields( $array ) {
    
//     // Выводим список полей, но только если пользователь имеет права админа
//     if( current_user_can( 'manage_options' ) ){
    
//         echo '<pre>';
//         print_r( $array);
//         echo '</pre>';
//     }
    
//     return $array;
// }

// Переименуем поля
add_filter( 'woocommerce_checkout_fields', 'estore_rename_fields', 25 );
 
function estore_rename_fields( $fields ) {
	// сначала переименовываем поле Имя
	$fields[ 'billing' ][ 'billing_first_name' ][ 'label' ] = 'Фамилия Имя Отчество';
	// добавляем плейсхолдер на поле Имя
	$fields[ 'billing' ][ 'billing_first_name' ][ 'placeholder' ] = 'Фамилия Имя Отчество';

    $fields[ 'billing' ][ 'billing_phone' ][ 'label' ] = 'Введите мобильный номер телефона*';
	// добавляем плейсхолдер на поле Имя
	$fields[ 'billing' ][ 'billing_phone' ][ 'placeholder' ] = 'Ваш телефон';

    $fields[ 'billing' ][ 'billing_email' ][ 'label' ] = 'Введите адрес эл. почты для получения чека и уведомлений*';
	// добавляем плейсхолдер на поле Имя
	$fields[ 'billing' ][ 'billing_email' ][ 'placeholder' ] = 'Ваш email';	

	
	return $fields;
 
}

// Добавляем поля
// add_action( 'woocommerce_after_checkout_billing_form', 'wpbl_select_field', 10 );
 
// Сохраняем поля
// add_action( 'woocommerce_checkout_update_order_meta', 'wpbl_save_fields' );
 



// Добавляем обёртку группе Доставка
add_action( 'woocommerce_after_checkout_billing_form', 'estore_delivery_start', 5 );
function estore_delivery_start() {
	echo '<div class="form__group">';
}

add_action( 'woocommerce_after_checkout_billing_form', 'estore_delivery_end', 25 );
function estore_delivery_end() {
	echo '</div>';
}

// добавим регионы
/**
 * @snippet       Регионы России для добавления в доставкее и на странице оформления заказа
 * @sourcecode    https://wpruse.ru/my-plugins/dobavit-regiony-dostavki-v-woocommerce/
 * @testedwith    WooCommerce 3.8
 * @author        Artem Abramovich
 * @see           https://ru.wordpress.org/plugins/wc-city-select/
 */
add_filter( 'woocommerce_states', 'awrr_states_russia' );
function awrr_states_russia( $states ) {

	$states['RU'] = array(
		'01' => 'Республика Адыгея',
		'02' => 'Республика Башкортостан',
		'03' => 'Республика Бурятия',
		'04' => 'Республика Алтай',
		'05' => 'Республика Дагестан',
		'06' => 'Республика Ингушетия',
		'07' => 'Республика Кабардино-Балкария',
		'08' => 'Республика Калмыкия',
		'09' => 'Республика Карачаево-Черкессия',
		'10' => 'Республика Карелия',
		'11' => 'Республика Коми',
		'12' => 'Республика Марий Эл',
		'13' => 'Республика Мордовия',
		'14' => 'Республика Саха',
		'15' => 'Республика Северная Осетия — Алания',
		'16' => 'Республика Татарстан',
		'17' => 'Республика Тыва',
		'18' => 'Удмуртская Республика',
		'19' => 'Республика Хакасия',
		'20' => 'Чеченская республика',
		'21' => 'Чувашская Республика',
		'22' => 'Алтайский край',
		'23' => 'Краснодарский край',
		'24' => 'Красноярский край',
		'25' => 'Приморский край',
		'26' => 'Ставропольский край',
		'27' => 'Хабаровский край',
		'28' => 'Амурская область',
		'29' => 'Архангельская область',
		'30' => 'Астраханская область',
		'31' => 'Белгородская область',
		'32' => 'Брянская область',
		'33' => 'Владимирская область',
		'34' => 'Волгоградская область',
		'35' => 'Вологодская область',
		'36' => 'Воронежская область',
		'37' => 'Ивановская область',
		'38' => 'Иркутская область',
		'39' => 'Калининградская область',
		'40' => 'Калужская область',
		'41' => 'Камчатский край',
		'42' => 'Кемеровская область',
		'43' => 'Кировская область',
		'44' => 'Костромская область',
		'45' => 'Курганская область',
		'46' => 'Курская область',
		'47' => 'Ленинградская область',
		'48' => 'Липецкая область',
		'49' => 'Магаданская область',
		'50' => 'Московская область',
		'51' => 'Мурманская область',
		'52' => 'Нижегородская область',
		'53' => 'Новгородская область',
		'54' => 'Новосибирская область',
		'55' => 'Омская область',
		'56' => 'Оренбургская область',
		'57' => 'Орловская область',
		'58' => 'Пензенская область',
		'59' => 'Пермский край',
		'60' => 'Псковская область',
		'61' => 'Ростовская область',
		'62' => 'Рязанская область',
		'63' => 'Самарская область',
		'64' => 'Саратовская область',
		'65' => 'Сахалинская область',
		'66' => 'Свердловская область',
		'67' => 'Смоленская область',
		'68' => 'Тамбовская область',
		'69' => 'Тверская область',
		'70' => 'Томская область',
		'71' => 'Тульская область',
		'72' => 'Тюменская область',
		'73' => 'Ульяновская область',
		'74' => 'Челябинская область',
		'75' => 'Забайкальский край',
		'76' => 'Ярославская область',
		'77' => 'Москва',
		'78' => 'Санкт-Петербург',
		'79' => 'Еврейская автономная область',
		'82' => 'Республика Крым',
		'83' => 'Ненецкий автономный округ',
		'86' => 'Ханты-Мансийский автономный округ — Югра',
		'87' => 'Чукотский автономный округ',
		'89' => 'Ямало-Ненецкий автономный округ',
		'92' => 'Севастополь',

	);

	return $states;
}

// Переместим поля из группы billing в группу order
// add_filter( 'woocommerce_checkout_fields', 'estore_move_to_order_group', 1000 );
 
function estore_move_to_order_group( $array ){
 
    // 1. Добавляем поле в новую группу
    $array['order'][ 'billing_country' ] = $array['billing'][ 'billing_country' ];
	$array['order'][ 'billing_state' ] = $array['billing'][ 'billing_state' ];
 
    // 2. Удаляем поле из предыдущей группы
    // unset( $array['billing'][ 'billing_country' ] );
	unset( $array['billing'][ 'billing_state' ] );
	
    
    // 3. Возвращаем полям прежний CSS классы
    $array['order'][ 'billing_country' ]['class'][0] = 'form-row-wide';
    $array['order'][ 'billing_state' ]['class'][0] = 'form-row-wide';
	$array[ 'order' ][ 'billing_state' ][ 'label' ] = 'Выберите область/регион для вычисления стоимости доставки';
	
 
    // Возвращаем обработанный массив
    return $array;
 
}

// После того, как мы удалили штатный комментарий к заказу (так как не в том месте),
// добавляем в нужном месте этьот комментарий
add_action( 'woocommerce_checkout_after_terms_and_conditions', 'estore_custom_checkout_field', 10 );
 
function estore_custom_checkout_field() {
	// выводим поле функцией woocommerce_form_field()
	woocommerce_form_field( 
		'billing_contactmethod', 
		array(
			'type'          => 'textarea', // text, textarea, select, radio, checkbox, password			
			'class'         => array( 'form__group' ), // массив классов поля
			'label'         => 'Комментарий к заказу',
			'label_class'   => 'form__title', // класс лейбла			
			
		)
	);
}














