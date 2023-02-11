<?php

/*
 * Подключение настроек темы
 */
require get_template_directory() . '/includes/theme-settings.php';
/*
 * Подключение области виджетов
 */
require get_template_directory() . '/includes/widget-areas.php';
/*
 * Подключение скриптов и стилей
 */
require get_template_directory() . '/includes/enqueue-script-style.php';
/*
 * Вспомогательные функции
 */
require get_template_directory() . '/includes/helpers.php';

/*
 * Добавим произвольные типы записей
 */
require get_template_directory() . '/includes/post-types.php';

/*
 * Файл навигации (меню на сайте)
 */
require get_template_directory() . '/includes/navigations.php';

/*
 * Файл пагинации на страницах
 */
require get_template_directory() . '/includes/pagination.php';



/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/includes/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/includes/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/includes/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/includes/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/includes/woocommerce.php';
	require get_template_directory() . '/woocommerce/includes/wc-functions.php';
	require get_template_directory() . '/woocommerce/includes/wc-functions-remove.php';
	require get_template_directory() . '/woocommerce/includes/wc-functions-cart.php';
	require get_template_directory() . '/woocommerce/includes/wc-functions-checkout.php';
	require get_template_directory() . '/woocommerce/includes/wc-functions-account.php';
}


/**
 * Подключаем обработчик Ajax.
 */
require get_template_directory() . '/includes/ajax.php';


// Зарегистрируем сайдбар

function register_my_sidebar(){
	register_sidebar( array(
		'name' => 'Основной сайдбар сайта',
		'id' => 'main-sidebar',
		'description' => 'Выводится на всех страницах'		
	) );
}
add_action( 'widgets_init', 'register_my_sidebar' );


// Добавим Страницу опций на ACF PRO options_theme

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Основные настройки',
		'menu_title'	=> 'Контакты',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

	acf_add_options_page(array(
		'page_title' 	=> 'Идентичные блоки',
		'menu_title'	=> 'Идентичные блоки',
		'icon_url' => 'dashicons-table-col-after',
		'menu_slug'	=> 'theme-general-blocks',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

	acf_add_options_page(array(
		'page_title' 	=> 'Список городов',
		'menu_title'	=> 'Города',
		'icon_url' => 'dashicons-admin-site-alt',
		'menu_slug'	=> 'theme-general-settings3',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

	
}

/**
 * TimePicker for Contact Form 7
 * Shortcode [text mytime_do id:timepicker]
 */
add_action( 'wp_footer', function() { ?>
	<script>
	jQuery(function ($) {
	$('#timepicker').prop('type', 'time');
	});
	</script>
	<?php } );

## Регистрируем шорткод поля ACF вид потолка для передачи в CF7
add_action('init', function(){
    add_shortcode('pricing_title', function(){
        return get_sub_field('pricing_article_head', 'options');
    });
});

## Регистрируем шорткод поля ACF вид вакансии для передачи в CF7
add_action('init', function(){
    add_shortcode('vacancy_type', function(){
        return get_sub_field('vacancy_name');
    });
});

## Регистрируем шорткод поля ACF вид готового решения для передачи в CF7
add_action('init', function(){
    add_shortcode('solution_type', function(){
        return get_sub_field('solution_gal_head', 'options');
    });
});


## Регистрируем шорткод поля ACF название товара в карточке для передачи в CF7
add_action('init', function(){
    add_shortcode('product_title', function(){
		$product = wc_get_product(esc_attr($_POST['id']));	    	
        return $product->get_name();;
    });
});


## Определение шаблона для страницы Каталога catalog.php
add_filter( 'woocommerce_template_loader_files','estore_catalog_template_file', 10, 1 );
 
function estore_catalog_template_file($default_file){
    if( is_shop()){
        $default_file[] = WC()->template_path() .'catalog.php';
    }
 
    return $default_file;
}



// Подключение нового типа произвольного поля - видео

add_action('acf/register_fields', 'my_register_fields');

function my_register_fields()
{
    include_once('/wp-content/plugins/acf-field-video/acf-video.php');
}

// Удалим тип постов post по умлочанию

function remove_default_post_type($args, $postType) {
    if ($postType === 'post') {
        $args['public']                = false;
        $args['show_ui']               = false;
        $args['show_in_menu']          = false;
        $args['show_in_admin_bar']     = false;
        $args['show_in_nav_menus']     = false;
        $args['can_export']            = false;
        $args['has_archive']           = false;
        $args['exclude_from_search']   = true;
        $args['publicly_queryable']    = false;
        $args['show_in_rest']          = false;
    }

    return $args;
}
add_filter('register_post_type_args', 'remove_default_post_type', 0, 2);


// Редактируем размер изображений Woocommerce



function size_of_category_thumb($u)
{
	return array(600, 600,true);
}
add_filter('subcategory_archive_thumbnail_size', 'size_of_category_thumb');

function size_of_product_thumb($u)
{
	return array(750, 940,true);
}
add_filter('single_product_archive_thumbnail_size', 'size_of_product_thumb');



/**
 * @snippet Добавляет ссылку на дублирование поста в админку
 * 
 */
// Функция создает дубликат поста в виде черновика и редиректит на его страницу редактирования
function true_duplicate_post_as_draft(){
 
	if( empty( $_GET[ 'post' ] ) ) {
		wp_die( 'Нечего дублировать!' );
	}
 
	// проверка одноразовых чисел, куда без неё
	if ( ! isset( $_GET[ 'true_duplicate_nonce' ] ) || ! wp_verify_nonce( $_GET[ 'true_duplicate_nonce' ], basename( __FILE__ ) ) ) {
		return;
	}
 
	// получаем ID оригинального поста
	$post_id = absint( $_GET[ 'post' ] );
 
	// затем получили объект поста
	$post = get_post( $post_id );
 
	/*
	 * если вы не хотите, чтобы текущий автор был автором нового поста
	 * тогда замените следующие две строчки на: $new_post_author = $post->post_author;
	 * при замене этих строк автор будет копироваться из оригинального поста
	 */
	$current_user = wp_get_current_user();
	$new_post_author = $current_user->ID;
 
	/*
	 * если пост существует, создаем его дубликат
	 */
	if ( $post ) {
 
		// массив данных нового поста
		$args = array(
			'comment_status' => $post->comment_status,
			'ping_status'    => $post->ping_status,
			'post_author'    => $new_post_author,
			'post_content'   => $post->post_content,
			'post_excerpt'   => $post->post_excerpt,
			'post_parent'    => $post->post_parent,
			'post_name'      => $post->post_name,
			'post_password'  => $post->post_password,
			'post_status'    => 'draft', // черновик, если хотите сразу публиковать - замените на publish
			'post_title'     => $post->post_title,
			'post_type'      => $post->post_type,
			'to_ping'        => $post->to_ping,
			'menu_order'     => $post->menu_order
		);
 
		// создаем пост при помощи функции wp_insert_post()
		$new_post_id = wp_insert_post( $args );
 
		// присваиваем новому посту все элементы таксономий (рубрики, метки и т.д.) старого
		$taxonomies = get_object_taxonomies( $post->post_type ); // возвращает массив названий таксономий, используемых для указанного типа поста, например array("category", "post_tag");
		foreach ( $taxonomies as $taxonomy ) {
			$post_terms = wp_get_object_terms( $post_id, $taxonomy, array( 'fields' => 'slugs' ) );
			wp_set_object_terms( $new_post_id, $post_terms, $taxonomy, false );
		}
 
		// дублируем все произвольные поля
		$post_meta = get_post_meta( $post_id );
		if( $post_meta ) {
			foreach ( $post_meta as $meta_key => $meta_values ) {
				if( '_wp_old_slug' == $meta_key ) { // это лучше не трогать
					continue;
				}
				foreach ( $meta_values as $meta_value ) {
					add_post_meta( $new_post_id, $meta_key, $meta_value );
				}
			}
		}
 
		// и наконец, перенаправляем пользователя на страницу редактирования нового поста
		wp_safe_redirect( add_query_arg( array( 'action' => 'edit', 'post' => $new_post_id ), admin_url( 'post.php' ) ) );
		exit;
	} else {
		wp_die( 'Ошибка создания поста, не могу найти оригинальный пост с ID=: ' . $post_id );
	}
}
 
add_action( 'admin_action_true_duplicate_post_as_draft', 'true_duplicate_post_as_draft' );
 
// Добавляем ссылку дублирования поста для post_row_actions
add_filter( 'post_row_actions', 'true_duplicate_post_link', 10, 2 );
function true_duplicate_post_link( $actions, $post ) {
	if ( current_user_can( 'edit_posts' ) ) {
		$actions[ 'duplicate' ] = '<a href="' . wp_nonce_url( add_query_arg( array( 'action' => 'true_duplicate_post_as_draft', 'post' => $post->ID ), 'admin.php' ), basename(__FILE__), 'true_duplicate_nonce' ) . '">Дублировать</a>';
	}
	return $actions;
}

add_filter( 'articles_row_actions', 'true_duplicate_post_link', 10, 2);

add_filter('redirect_canonical','custom_disable_redirect_canonical');
function custom_disable_redirect_canonical($redirect_url) {
    if (is_paged() && is_singular()) $redirect_url = false;
    return $redirect_url;
}

//произвольные типы записей в виджете "свежих записей" start
function estore_custom_posts_in_recent_posts($params) {
    $params['post_type'] = array('post', 'articles');
    return $params;
}
add_filter('widget_posts_args', 'estore_custom_posts_in_recent_posts');
//произвольные типы записей в виджете "свежих записей" end

// Добавим фильтр чтобы переопределить текущий шаблон темы для поля поиска по сайту

add_filter('get_search_form', 'ba_search_form');
function ba_search_form($form) {
    $form = '
        <form role="search" method="get" id="searchform" class="search search-header__form" action="' . home_url( '/' ) . '">  
            <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="Найти..." class="search-header__input search-input">                        
             
            <button type="submit" class="search-header__button btn-purple">найти</button>                            
            </button>

            <button type="button" class="search-header__close for-form__close js-closeSearch">
                <svg>
                    <use xlink:href="' . get_template_directory_uri() . '/assets/images/icons/icons.svg#svg-close"></use>
                </svg>
            </button>

            <div class="result-search search-header__results">
                <div class="preloader"><img src="' . get_template_directory_uri() . '/assets/images/loader.gif" class="loader" /></div>
                <div class="result-search-list search-header__list"></div>
            </div>
        </form>
        
    ';
    return $form;
}


// Сам обработчик поиска на сайте

function ba_ajax_search(){
    $args = array(
        's' => $_POST['term'],
        'posts_per_page' => 5
    );
    $the_query = new WP_Query($args);
    if ($the_query->have_posts()) {
        while ($the_query->have_posts()) {
            $the_query->the_post();
?>
            <div class="result_item clear">
                
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
add_action('wp_ajax_nopriv_ba_ajax_search','ba_ajax_search');
add_action('wp_ajax_ba_ajax_search','ba_ajax_search');


// удаляем стандартный фильтр
remove_filter( 'authenticate', 'wp_authenticate_username_password', 20, 3 );
 
// и добавляем собственный
add_filter( 'authenticate', 'login_by_email', 20, 3 );
 
function login_by_email( $user, $username, $password ) {
	// если введен логин, то сразу авторизуем, минуя лишние запросы
	if ( is_email( $username ) ) {
		// получаем ID пользователя 
		if ( ! empty( $username ) )
			$user = get_user_by( 'email', $username );
 
		// подбираем соответствующее емейлу имя пользователя (логин)
		if ( isset( $user->user_login, $user ) )
			$username = $user->user_login;
 
	}
	return wp_authenticate_username_password( NULL, $username, $password );
}



add_action( 'show_user_profile', 'true_show_profile_fields' );
// когда чей-то профиль редактируется админом например
add_action( 'edit_user_profile', 'true_show_profile_fields' );
 
function true_show_profile_fields( $user ) {
 
	// выводим заголовок для наших полей
 	echo '<h3>Дополнительная информация</h3>';
 
	// поля в профиле находятся в рамметке таблиц <table>
 	echo '<table class="form-table">';
 
 	// добавляем поле город
	$user_rang = get_the_author_meta( 'user_rang[]', $user->ID );
 	echo '<h3>' . esc_attr( $user_rang ) . ' </h3>' ;
 
	
 	echo '</table>';
 
}


/* register our custom tab */
add_filter('um_profile_tabs', 'ui_custom_tab', 1000 );
function ui_custom_tab( $tabs ) {
    $tabs['codeskills'] = array(
        'name' => 'Code Skills',
        'icon' => 'um-faicon-pencil',
        'custom' => true
    );  
    return $tabs;
}

/* add the tab's content */
add_action('um_profile_content_codeskills_default', 'ui_codeskills_tab_content');
function ui_codeskills_tab_content( $args ) {
    $id = um_profile_id();
    $skills = get_user_meta( $id, 'skills', true );
    
    if ( ! empty ($skills) ) { 
        echo '<div class="um-item">'.$skills.'</div>';
    }
}


/*
 * Добавление колонки ID пользователя
 */
function true_user_id_column( $columns ) {
	$columns['user_id'] = 'ID';
	return $columns;
}
add_filter('manage_users_columns', 'true_user_id_column');
 
/*
 * Заполнение колонки
 */
function true_user_id_column_content($value, $column_name, $user_id) {
	if ( 'user_id' == $column_name )
		return $user_id;
	return $value;
}
add_action('manage_users_custom_column',  'true_user_id_column_content', 10, 3);
 
/*
 * Оформление колонки (необязательно)
 */
function true_user_id_column_style(){
	echo '<style>.column-user_id{width: 5%}</style>';
}
add_action('admin_head-users.php',  'true_user_id_column_style');