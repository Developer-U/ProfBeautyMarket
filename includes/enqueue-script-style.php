<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_action( 'wp_enqueue_scripts', 'estore_scripts' );
function estore_scripts() {
	wp_enqueue_style( 'slick-css', get_template_directory_uri() . '/assets/css/slick.css', array(), null, true);

	wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/assets/css/slick-theme.css', array('slick-css'), null, true);

	wp_enqueue_style( 'estore-swiper', get_template_directory_uri() . '/assets/css/swiper-bundle.min.css', array(), null, 'all');

	wp_enqueue_style( 'estore-fancybox-style', get_template_directory_uri() . '/assets/css/jquery.fancybox.min.css', array(), null, 'all');

	wp_enqueue_style( 'style', get_template_directory_uri() . '/assets/css/style.css', array(), null, 'all');	

	wp_enqueue_style( 'simplebar-style', get_template_directory_uri() . '/assets/css/simplebar.css', array(), null, 'all');

	wp_enqueue_style( 'estore-ajax', get_template_directory_uri() . '/assets/css/ajax.css', array(), true);

	wp_enqueue_style( 'media', get_template_directory_uri() . '/assets/css/media.css', array('style'), null, true);

	wp_enqueue_style( 'wishlist', get_template_directory_uri() . '/assets/css/wishlist.css', array('style'), null, true);

	
	// wp_enqueue_style( 'estore-bootstrap-style', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), null, 'all');
}

add_action( 'wp_enqueue_scripts', 'estore_styles' );
function estore_styles() {

	wp_enqueue_script( 'estore-jquery-js', get_template_directory_uri() . '/assets/js/jquery.min.js', array(), null, true );

	wp_enqueue_script( 'estore-jquery-min-js', get_template_directory_uri() . '/assets/js/jquery-ui.min.js', array('estore-jquery-js'), null, true );

	wp_enqueue_script( 'estore-ajax-search', get_template_directory_uri() . '/assets/js/ajax-search.js', array('estore-jquery-js'), false, true );

	wp_enqueue_script( 'estore-fancybox-js', get_template_directory_uri() . '/assets/js/fancybox.min.js', array('estore-jquery-js'), null, true );
	
	wp_enqueue_script( 'estore-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array('estore-jquery-js'), null, true );	

	wp_enqueue_script( 'estore-popups', get_template_directory_uri() . '/assets/js/popups.js', array('estore-jquery-js'), null, true );	

	wp_enqueue_script( 'estore-inputmask', get_template_directory_uri() . '/assets/js/jquery.inputmask.js', array('estore-jquery-js'), null, true );	

	wp_enqueue_script( 'estore-mask', get_template_directory_uri() . '/assets/js/mask.js', array('estore-inputmask'), null, true );

	wp_enqueue_script( 'estore-bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array('estore-jquery-js'), null, true );

	wp_enqueue_script( 'estore-simplebar-js', get_template_directory_uri() . '/assets/js/simplebar.min.js', array('estore-jquery-js'), null, true );

	wp_enqueue_script( 'estore-scrollmagic', get_template_directory_uri() . '/assets/js/scrollmagic.min.js', array('estore-jquery-js'), null, true );
	
	wp_enqueue_script( 'estore-sidebar', get_template_directory_uri() . '/assets/js/sidebar.js', array(), null, true );

	wp_enqueue_script( 'estore-swiper-js', get_template_directory_uri() . '/assets/js/swiper-bundle.min.js', array('estore-jquery-js'), true );

	// Подключаем аякс Почты
	wp_enqueue_script( 'ajax-mail', get_template_directory_uri() . '/assets/js/ajax-mail.js', array('estore-jquery-js'), null, true );


	// Подключаем скрипт формы поиска на сайте

	wp_enqueue_script( 'estore-search', get_template_directory_uri() . '/assets/js/ajax-search.js', array(), '20151215', true );

	// Перед скриптом добавляем данные

	wp_localize_script( 'estore-search', 'search_form', array(
		'url' => admin_url( 'admin-ajax.php' ),
		'nonce' => wp_create_nonce('search-nonce')
	) );


	// Подключаем аякс окна Купить в один клик (quick-view)
	wp_enqueue_script( 'ajax-quick', get_template_directory_uri() . '/assets/js/ajax-quick-view.js', array('estore-jquery-js'), null, true );

	// Перед скриптом добавляем данные
	wp_localize_script( 'ajax-quick', 'ajax_quick', array(
		'url' => admin_url( '/admin-ajax.php' ),
		'nonce' => wp_create_nonce('quick-nonce')
	) );

	wp_enqueue_script( 'tabs', get_template_directory_uri() . '/assets/js/tabs.js', array(), 'all', true );

    // wp_enqueue_script( 'estore-mainjs', get_template_directory_uri() . '/assets/js/app.js?_v=20221105020554', array(), 'all', true );

	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}