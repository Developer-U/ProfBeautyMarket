<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


//------------ОБЩИЕ--------------

// Вывод товаров на апсейлах и пр


add_filter( 'jpeg_quality', 'my_filter_img' );
function my_filter_img( $quality ) {  
	return 100;
}

function get_total_reviews_count(){
    return get_comments(array(
        'status'   => 'approve',
        'post_status' => 'publish',
        'post_type'   => 'product',
        'count' => true
    ));
}





// Удалим те breadcrumbs, которые нас не устраивают

remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

add_action( 'after_setup_theme', 'estore_remove_wc_gallery_lightbox', 25 );
 
function estore_remove_wc_gallery_lightbox() { 
	remove_theme_support( 'wc-product-gallery-lightbox' );
}

add_action( 'after_setup_theme', 'estore_add_zoom', 5 );
function estore_add_zoom() { 
	add_theme_support( 'wc-product-gallery-zoom' );
}


// Переименуем фильтры сортировки товаров
add_filter( 'woocommerce_catalog_orderby', 'estore_rename_orderby_options' );

function estore_rename_orderby_options( $options ) {
   $options['date'] = __( 'Новинки', 'woocommerce' ); 
   $options['popularity'] = __( 'Популярные', 'woocommerce' );    
   $options['price'] = __( 'Сначала дешевые', 'woocommerce' );
   $options['price-desc'] = __( 'Сначала дорогие', 'woocommerce' );  
   return $options;
}

// Удалим фильтры сортировки, которые нам не нужны
add_filter( 'woocommerce_default_catalog_orderby_options', 'estore_remove_orderby_options' );
add_filter( 'woocommerce_catalog_orderby', 'estore_remove_orderby_options' );
 
function estore_remove_orderby_options( $sortby ) {

	unset( $sortby[ 'rating' ] ); // по рейтингу
    
 
	return $sortby; 
}


// Применить сортировку
add_filter( 'woocommerce_get_catalog_ordering_args', 'est_price' );
 
function est_price( $args ) {
 
	if ( isset( $_GET['orderby'] ) && 'price' == $_GET['orderby'] ) {
		$args['orderby'] = 'meta_value_num';
        $args['order'] = 'ASC';
        $args['meta_key'] = '_price';
	}
	return $args;
}

add_filter( 'woocommerce_get_catalog_ordering_args', 'est_price_desc' );
 
function est_price_desc( $args ) {
 
	if ( isset( $_GET['orderby'] ) && 'price-desc' == $_GET['orderby'] ) {
		$args['orderby'] = 'meta_value_num';
        $args['order'] = 'ASC';
        $args['meta_key'] = '_price';
	}
	return $args;
}






// ---------КАТАЛОГ------------

// На странице каталога стилизуем вывод товаров

// Добавим обёртку всему блоку с товаром
add_action( 'woocommerce_before_shop_loop_item', 'estore_product_wrapper_start', 40 );
function estore_product_wrapper_start() {
    if( !is_shop()): ?>
        <div class="product-item__body">                   
    <?php endif; ?>
<?php
}

add_action( 'woocommerce_after_shop_loop_item', 'estore_product_wrapper_end', 30 );
function estore_product_wrapper_end() {
    if( !is_shop()): ?>          
        </div>
    <?php endif; ?>
<?php
}

// Добавим вывод изображения товара в каталоге

add_action( 'woocommerce_before_shop_loop_item_title', 'estore_template_loop_product_thumbnail', 10 );
function estore_template_loop_product_thumbnail() {
    if( !is_shop() ): // так как товары в категории и каталоге уже выведены, это для апсейлов
        global $product;

        $image_size = apply_filters( 'single_product_archive_thumbnail_size', $size );
        $product_id = $product->get_id();
        $product_new = $product->get_attribute('new');
        $product_hit = $product->get_attribute('hit');
        $product_action = $product->get_attribute('action');

        $image = get_the_post_thumbnail_url( $product_id, $image_size ); //Получаем url картинки

        if ( $image ) {
            $image = str_replace( ' ', '%90', $image );
            $image_webp = str_replace( ['.png', '.jpg', '.jpeg', '.gif'], '.webp', $image );
            $link = get_the_permalink();
            echo '
            <div class="product-item__top">
                <button class="product-item__favorite-add favorite-add">
                    ' .do_shortcode('[ti_wishlists_addtowishlist]') . '
                    <svg>
                        <use xlink:href=" ' . esc_url( get_template_directory_uri() ) . '/assets/images/icons/icons.svg#svg-favorite-fill"></use>
                    </svg>
                </button>
                <div class="product-item__labels">';
                    if( $product_new ) {
                        echo '<div class="product-item__label new">'
                            . $product_new . 
                        '</div>';
                    } 
                    if( $product_hit ) {
                        echo '<div class="product-item__label hit">'
                            . $product_hit .
                        '</div>';
                    }
                    if( $product_action ) {
                        echo '<div class="product-item__label sale">'
                            . $product_action .
                        '</div>';
                    }
                echo '</div>
                <a href="' . $link . '" class="product-item__image">
                    <img src="' . esc_url($image) . '" alt="' . esc_attr( $product->get_name() ) . '">
                    </img>
                </a>
            </div>
        ';
        }
    endif; 
}

// Добавим вывод названия товара и описание товара. Это удобнее сделать одним хуком,
// так как они выводятся внутри одного блока

add_action( 'woocommerce_before_shop_loop_item_title', 'estore_template_loop_product_title', 10 );
function estore_template_loop_product_title() {
    if( !is_shop()):
        global $product;
        
        if ( ! is_a( $product, 'WC_Product' ) ) {
            $product = wc_get_product( get_the_id() );            
            $average = $product->get_average_rating();
            $product_id = get_the_ID();                      
            
        } ?>
        
        <div class="product-item__info">
            <div class="product-item__info-wrap">
                <div class="product-item__info-top">
                    <?php
                    if ( wc_product_sku_enabled() && ( $product->get_sku() ) ) { ?>
                        <div class="product-item__vendor-code"> <?php esc_html_e( 'SKU:', 'woocommerce' ); echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?> </div>
                    <?php } ?>

                    <!-- Выведем рейтинг товара - звёзды -->
                    <?php wc_get_template( 'single-product/rating.php' ); ?>
                    
                    <!-- Выведем число отзывов о товаре -->
                    <a href="<?php the_permalink() ?>#comments" class="product-item__review-link">
                        <svg>
                            <use xlink:href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/icons/icons.svg#svg-review"></use>
                        </svg>
                       
                        <?php comments_number('0', '1', '%'); ?>
                    </a>
                </div>
                
                <!-- Выводим название товара -->
                <a href="<?php the_permalink(); ?>">
                    <h3 class="catalog-list__heading"> <?= $product->get_name(); ?></h3>
                </a>
              
                <!-- Выводим цены на товар -->
                <div class="product-item__price">
                    <?php if($product->get_sale_price()): ?>
                        <span class="product-item__price-new">
                            <p class="price-first"><?php echo $product->get_sale_price();?></p>
                            &nbsp;<span class="inner">₽</span></span>
                        <span class="product-item__price-old">
                            <p class="price-first"><?php echo $product->get_regular_price();?></p>
                            &nbsp;<span class="inner">₽</span></span>
                        <div class="product-item__discount"></div>
                    <?php else: ?>
                        <span class="product-item__price-new">
                            <p class="price-first"><?php echo $product->get_regular_price();?></p>
                            &nbsp;<span class="inner">₽</span></span>
                    <?php endif; ?>
                </div>
            </div>

            
        </div> 
        
        
    <?php endif;    
}


//Нижние блоки страница Каталог
// На страницу Каталога после отзывов добавим текстовый блок
add_action( 'woocommerce_after_shop_loop', 'estore_add_catalog_text_block', 10 );
function estore_add_catalog_text_block() {
    if( is_shop()): 
        $catalogAboutHead = get_field('catalog-about-head', 'options');
        $catalogAboutLeft = get_field('catalog-about-left', 'options');
        $catalogAboutRight = get_field('catalog-about-right', 'options');	
        ?>	            
        
        <section class="post cat-post">
            <div class="container-fluid2  about__contain">
                <h2 class="faq__heading">
                    <?= $catalogAboutHead; ?>
                </h2>

                <div class="container about__box left-pad-zero row justify-content-between">
                    <div class="about__text col-lg-6 col-12">
                        <?= $catalogAboutLeft; ?>
                    </div>

                    <div class="about__text col-lg-6 col-12">
                        <?= $catalogAboutRight; ?>                   
                    </div>
                </div>
            </div>
        </section>
    <?php endif;
} 

// На страницу Каталога после текстового блока добавим блок Faq
add_action( 'woocommerce_after_shop_loop', 'estore_add_catalog_faq_block', 15 );
function estore_add_catalog_faq_block() {
    if( is_shop() ):      
        $catalogFaqHead = get_field('catalog-faq-head', 'options');            

        echo'
        <section class="faq">
            <div class="container ">
                <h2 class="faq__heading">'
                    . $catalogFaqHead .
                '</h2>

                <div class="faq__accords row">
                    <div id="accordion" class="faq__full row justify-content-between js-faqAccord">' ?>

                    <?php if( have_rows('new_catalog-faq_item', 'options') ): ?>
                    <?php while( have_rows('new_catalog-faq_item', 'options') ): the_row();
                    $catalogFaqName = get_sub_field('catalog-faq-name', 'options');
                    $catalogFaqDescr = get_sub_field('catalog-faq-descr', 'options'); ?> 
                        <div class="accordion-item">
                            <div class="accordion-header faq__subheading">
                                <div>
                                    <?= $catalogFaqName; ?>
                                </div>
                            </div>
                            
                            <div>
                                <p>
                                    <?= $catalogFaqDescr;?>
                                </p>
                            </div>
                        </div> 
                        

                    <?php endwhile; ?>
                    <?php endif;
                    '</div>
                </div>            
            </div>
        </section>';
    endif;
}


 


// На страницу Каталога после блока FAQ добавим CTA
add_action( 'woocommerce_after_shop_loop', 'estore_add_catalog_cta_block', 30 );
function estore_add_catalog_cta_block() {
    if( is_shop() ):      
        get_template_part('template-parts/block', 'cta');
    endif;
}


//----------КАТЕГОРИЯ-----------------


// Зарегистрируем сайдбар woocommerce

function register_woo_widgets(){
    register_sidebar( array(
        'name'       => "Woocommerce sidebar",
        'id'         => 'woo-left-sidebar',
        'description' => 'Фильтры на странице категории',
        'before_widget'  => '<div id="%1$s" class="widget %2$s">',
        'after_widget'   => '</div>',
        'before_title'   => '<h3 class="widget-title">',
        'after_title'    => '</h3>'
    ) );
}
add_action( 'widgets_init', 'register_woo_widgets' );


// Добавим сайдбар только на страницу категории

add_action( 'woocommerce_before_main_content', 'estore_add_sidebar', 50 );

function estore_add_sidebar() {
    if ( is_active_sidebar( 'woo-left-sidebar' ) && ( is_product_category() ) ) { ?>
        <div class="category__sidebar">         
            <?php dynamic_sidebar( 'woo-left-sidebar' ); ?>       
        </div>
    <?php }  
}




// Выведем метки товаров

function woocom_tags_list(){
    $args = array( 'hide_empty' => 0 );
    $terms = get_terms('product_tag', $args );
    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) { 
        $term_list = '<div class="category__tags-list swiper"><div class="category__tags-wrapper swiper-wrapper">';
        foreach ( $terms as $term ) {
        	$term_list .= '<div class="category__tags-item tags-item swiper-slide"><a class="tags-item__label" href="' . get_term_link( $term ) . '" title="'. $term->name .'">' . $term->name . '</a></div>';
 
        }
        $term_list .= '</div></div>'; 
        return $term_list;         
    }else{
    	return 'Тегов продуктов нет';
    }
}
add_shortcode( 'woocom_tags', 'woocom_tags_list' );


// Добавим общий контейнер, чтобы сайдбар был слева, контент - справа

add_action( 'woocommerce_before_main_content', 'estore_archive_wrapper_start', 40 );

function estore_archive_wrapper_start() {
    if( is_product_category() ): ?>
        <div class="category__body">   
    <?php endif; ?>             
<?php }

add_action( 'woocommerce_after_main_content', 'estore_archive_wrapper_end', 30 );

function estore_archive_wrapper_end() { 
    if( is_product_category() ): ?>
        </div>  
    <?php endif; ?>             
<?php }

// В этот общий контейнер поместим правый блок - контент
add_action( 'woocommerce_before_main_content', 'estore_archive_content_wrapper_start', 60 );

function estore_archive_content_wrapper_start() { ?>        
    <div class="category__content">
         
<?php }


add_action( 'woocommerce_after_main_content', 'estore_archive_content_wrapper_end', 25 );

function estore_archive_content_wrapper_end() { ?>
       
    </div>             
<?php }


// Удалим сортировку товаров, так как она не в том месте
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);


// Добавим сортировку в нужном месе
add_action('woocommerce_before_main_content', 'woocommerce_catalog_ordering', 45);


// Удалим notices
remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10);

// Удалим формулировку вывода товаров 
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);

// А затем вставим её в нужное место
add_action('woocommerce_before_main_content', 'woocommerce_result_count', 47);

// Добавим кнопку скрытия /открытия фильтров в мобильной версии
add_action('woocommerce_before_main_content', 'estore_add_filter_button', 35);

function estore_add_filter_button() {
    if( is_product_category() ):
        echo '<button type="button" class="category__sidebar-button btn-purple filters-btn">фильтры</button>';
    endif; 
} 

remove_filter( 'woocommerce_product_loop_start', 'woocommerce_maybe_show_product_subcategories');

// Добавим вывод товаров на страницу Категории. 
add_action( 'woocommerce_before_shop_loop', 'estore_category_product_wrapper_start', 30 );
function estore_category_product_wrapper_start() { ?>
    <div class="category__products products-collection__items">  
        <?php
            if ( wc_get_loop_prop( 'total' ) ) {
                while ( have_posts() ) {
                    the_post();

                    /**
                     * Hook: woocommerce_shop_loop.
                     */
                    do_action( 'woocommerce_shop_loop' );

                    wc_get_template_part( 'content', 'product' );
                     }
            }
        ?>
    </div>    
<?php }

// Так как кастомная кнопка "В корзину" для категории добавлена напрямую в content-product.php,
// удалим её штатный вывод.
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart',  );

// После товаров на сранце каегории добавим Популярные продукты
add_action('woocommerce_after_main_content', 'estore_add_popular_products', 15);

function estore_add_popular_products() {
    if( is_product_category() ): ?>
        <?php get_template_part('template-parts/popular', 'products');
    endif;
}

// После Популярных продуктов добавим Отзывы 
add_action('woocommerce_after_main_content', 'estore_add_category_reviews', 20);

function estore_add_category_reviews() {
    if( is_product_category()): 
        $cate = get_queried_object();
        $cateID = $cate->term_id;
        $mycat = 'product_cat_' . $cateID;

		$catAboutHead = get_field('cat-about-head', $mycat);	
        ?>

        <!-- reviews -->
        <section class="main-reviews">
            <div class="main-reviews__container">
                <div class="main-reviews__title section-title">
                    <h2><?= $catAboutHead; ?></h2>
                </div>
                <div class="main-reviews__body">
                    <div class="main-reviews__list">
                        <?php if( have_rows('new_cat_review', $cate) ): ?>
                        <?php while( have_rows('new_cat_review', $cate) ): the_row();
                        $catRevName = get_sub_field('cat-rev-name', $mycat);
                        $catRevImage = get_sub_field('cat-rev-image', $mycat);
                        $catRevRating = get_sub_field('cat-rev-rating', $mycat);
                        $catRevDate= get_sub_field('cat-rev-date', $mycat);
                        $catRevDescr= get_sub_field('cat-rev-descr', $mycat);
                        $dataId= get_sub_field('data-id', $mycat); ?>

                            <div class="main-reviews__item">
                                <div class="main-reviews__item-avatar">
                                    <img src="<?php echo esc_url($catRevImage['url']); ?>" alt="<?php echo esc_attr($catRevImage['alt']); ?>">
                                </div>
                                <div class="main-reviews__item-name"><?= $catRevName; ?></div>
                                <div class="main-reviews__item-rating rating">
                                    <?= $catRevRating; ?>
                                </div>
                                <div class="main-reviews__item-date"><?= $catRevDate; ?></div>
                                <div data-showmore class="main-reviews__item-text">
                                    <div class="main-reviews__text" data-text="<?= $dataId; ?>">
                                        <?= $catRevDescr; ?>
                                    </div>
                                    <button type="button" class="main-reviews__item-more" data-path="<?= $dataId; ?>"><span>Читать</span></button>

                                    <button type="button" class="main-reviews__item-less" data-close="<?= $dataId; ?>"><span>Скрыть</span></button>
                                </div>
                            </div>

                        <?php endwhile; ?>
                        <?php endif; ?>                        
                    </div>
                    <a href="/reviews" class="main-reviews__button btn-purple">все отзывы</a>
                </div>
            </div>
        </section>
        <!-- reviews end -->
    <?php endif; 
}


// После Отзывов добавим Вопрос-ответ 
add_action('woocommerce_after_main_content', 'estore_add_category_faq', 20);

function estore_add_category_faq() {
    if( is_product_category() ):
        $cate = get_queried_object();
        $cateID = $cate->term_id;
        $mycat = 'product_cat_' . $cateID;

		$catFaqHead = get_field('cat-faq-head', $mycat);	
        ?>
        <!-- faq -->
        <section class="main-faq faq">
            <div class="faq__container">
                <div class="faq__title section-title">
                    <h2><?= $catFaqHead; ?></h2>
                </div>
                <div class="faq__body">
                    <div data-spollers data-one-spoller class="faq__list">
                        <?php if( have_rows('new_cat_faq', $cate) ): ?>
                        <?php while( have_rows('new_cat_faq', $cate) ): the_row();
                        $catFaqQuestion = get_sub_field('cat-faq-quest', $mycat);
                        $catFaqAsk = get_sub_field('cat-faq-ask', $mycat);
                        ?>
                        <div class="faq__item" data-spoller-wrap>
                            <button type="button" data-spoller class="faq__item-title"><?= $catFaqQuestion; ?></button>
                            <div class="faq__item-body" hidden>
                                <p><?= $catFaqAsk; ?></p>
                            </div>
                        </div>
                        <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- faq end -->
    <?php endif;
}


// После FAQ добавим CTA
add_action('woocommerce_after_main_content', 'estore_add_category_cta', 25);
function estore_add_category_cta() {
    if( is_product_category()):
        get_template_part('template-parts/cta', 'block'); 
    endif;
}


// После CTA - уникальный текстовый блок
add_action('woocommerce_after_main_content', 'estore_add_category_text_block', 30);
function estore_add_category_text_block() {
    if( is_product_category() ):
        $cate = get_queried_object();
        $cateID = $cate->term_id;
        $mycat = 'product_cat_' . $cateID;

		$catTextHead = get_field('cat-text-head', $mycat);	
        $catTextLeft = get_field('cat-text-left', $mycat);
        $catTextRight = get_field('cat-text-right', $mycat);
        ?>

        <section class="text-block">
            <div class="text-block__container">
                <div class="text-block__title section-title">
                    <h2><?= $catTextHead; ?></h2>
                </div>
                <div class="text-block__body">
                    <div class="text-block__col">
                        <?= $catTextLeft; ?>
                    </div>
                    <div class="text-block__col">
                        <?= $catTextRight; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif;
}

// Добавим футер на сранцу каегории и подкаегории
add_action( 'woocommerce_after_main_content', 'estore_add_footer', 50 );

function estore_add_footer() {
    if(is_product_category() || is_product_taxonomy()) {
        get_footer();
    }
}


//---------КАРТОЧКА ТОВАРА------------

// Зададим общий контейнер всему содержимому

add_action( 'woocommerce_before_single_product', 'estore_wrapper_product_start', 5 );
function estore_wrapper_product_start() {
    if( is_product() ):
    ?>  
        <div class="product-card__container">            
               
    <?php endif; 
}

add_action( 'woocommerce_after_single_product', 'estore_wrapper_product_end', 5 );
function estore_wrapper_product_end() {
    if( is_product() ):
    ?>            
        </div>
           
    <?php endif;
}

// Зададим контейнер левому блоку с картинками
// Обрати внимание: в закрывающем теге также мы поставили woocommerce_before_single_product_summary,
// а не _after_, для того, чтобы левый и правый блоки стояли на одном уровне а не влетали друг в друга

add_action( 'woocommerce_before_single_product_summary', 'estore_wrapper_product_image_start', 5 );
function estore_wrapper_product_image_start() {
    ?>  
        <div class="product-card__col">
    <?php
}

add_action( 'woocommerce_before_single_product_summary', 'estore_wrapper_product_image_end', 25 );
function estore_wrapper_product_image_end() {
    ?>           
        </div>           
    <?php
}

// Добавим к товару всякие ништяки: Хит,Акция, Новинка, и сердечко - в избранные
add_action( 'woocommerce_before_single_product_summary', 'estore_add_product_flash', 10 );
function estore_add_product_flash() {
    global $product;

        $image_size = apply_filters( 'single_product_archive_thumbnail_size', $size );
        $product_id = $product->get_id();
        $product_new = $product->get_attribute('new');
        $product_hit = $product->get_attribute('hit');
        $product_action = $product->get_attribute('action');

    echo '  
        <div class="product-item__top">
            <button class="product-item__favorite-add favorite-add">
                ' .do_shortcode('[ti_wishlists_addtowishlist]') . '
                <svg>
                    <use xlink:href=" ' . esc_url( get_template_directory_uri() ) . '/assets/images/icons/icons.svg#svg-favorite-fill"></use>
                </svg>
            </button>
            <div class="product-item__labels">';
                if( $product_new ) {
                    echo '<div class="product-item__label new">'
                        . $product_new . 
                    '</div>';
                } 
                if( $product_hit ) {
                    echo '<div class="product-item__label hit">'
                        . $product_hit .
                    '</div>';
                }
                if( $product_action ) {
                    echo '<div class="product-item__label sale">'
                        . $product_action .
                    '</div>';
                }
            echo '</div>
        </div>';      
}

// Зададим контейнер правому блоку с описанием

add_action( 'woocommerce_before_single_product_summary', 'estore_wrapper_product_entry_start',25 );
function estore_wrapper_product_entry_start() {
    ?>  
        <div class="product-card__col cart_item">       
    <?php
}

add_action( 'woocommerce_after_single_product_summary', 'estore_wrapper_product_entry_end', 5 );
function estore_wrapper_product_entry_end() {
    ?>           
        </div> 
        
    <?php
}

// Удалим штатное название товара
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );

// Удалим цену из того места, где нам не нужно
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);

// Удалим штатный вывод артикула, так как не в том месте
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);


// Удалим вывод рейтинга по умолчанию, так как свой будем добавлять ниже
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );

// Добавим одним хуком добавим Название товара, артикул, стоимость, и логотип бренда справа 

add_action( 'woocommerce_single_product_summary', 'estore_add_product_price', 20 );
function estore_add_product_price() { 
        global $product;
        
        if ( ! is_a( $product, 'WC_Product' ) ) {
            $product = wc_get_product( get_the_id() );            
            $average = $product->get_average_rating();
            $product_id = get_the_ID();
        } ?>
        
        <div class="product-card__info product-item">
            <div class="product-card__descr">
                <h1 class="product-card__name"><?php the_title(); ?></h1>
                <?php
                    if ( wc_product_sku_enabled() && ( $product->get_sku() ) ) { ?>
                        <div class="product-card__vendor-code"> <?php esc_html_e( 'SKU:', 'woocommerce' ); echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?> </div>
                <?php } ?>
                
                <div class="product-card__stat">
                    <!-- Выведем рейтинг товара - звёзды -->
                    <?php wc_get_template( 'single-product/rating.php' ); ?>
                    
                    <!-- Выведем число отзывов о товаре -->
                    <a href="<?php the_permalink() ?>#comments" class="product-item__review-link">
                        <svg>
                            <use xlink:href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/icons/icons.svg#svg-review"></use>
                        </svg>
                       
                        <?php comments_number('0', '1', '%'); ?>
                    </a>
                </div>
                
                <!-- Выводим цены на товар -->
                <div class="product-card__price">
                    <?php if($product->get_sale_price()): ?>
                        <span class="product-item__price-new">
                            <p class="price-first"><?php echo $product->get_sale_price();?></p>
                            &nbsp;<span class="inner">₽</span></span>
                        </span>
                        <span class="product-item__price-old">
                            <p class="price-first"><?php echo $product->get_regular_price();?></p>
                            &nbsp;<span class="inner">₽</span></span>
                        </span>
                        <div class="product-item__discount"></div>
                    <?php else: ?>
                        <span class="product-item__price-new">
                            <p class="price-first"><?php echo $product->get_regular_price();?></p>
                            &nbsp;<span class="inner">₽</span></span>
                        </span>
                    <?php endif; ?>
                </div>

                
            </div>

            <div class="product-card__info-right">
                <?php                
                $productBrand = get_field('product_brand'); ?>
                <div class="product-card__brand">
                    <img src="<?php echo esc_url($productBrand['url']); ?>" alt="<?php echo esc_attr($productBrand['alt']); ?>">
                </div>
                <button data-popup-open="popup-call" type="button" class="product-card__ask">
                    <svg>
                        <use xlink:href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/icons/icons.svg#svg-question"></use>
                    </svg>
                    <span>Задать вопрос косметологу</span>
                </button> 
            </div> 
        </div> 
    <?php   
}

// Удалим краткое описание, так как оно тут не в тему
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);

// Вместо краткого описания добавим таблицу с доставкой и характеристиками
add_action( 'woocommerce_single_product_summary', 'estore_add_card_table_params', 30);

function estore_add_card_table_params() { ?>
    <div class="product-card__details">
    <?php
    global $product;

    $brand = $product -> get_attribute('brandby'); 
    $line = $product -> get_attribute('lineby');
    $obyom = $product -> get_attribute('obyom');
    $samovyvozAddress = get_field('samovyvoz_address');
    $samovyvozPrice = get_field('samovyvoz_price');
    $postamatDescr = get_field('postamat_descr');
    $postamatSrok = get_field('postamat_srok');
    $postamatPrice = get_field('postamat_price');
    $kurierDescr = get_field('kurier_descr');
    $kurierSrok = get_field('kurier_srok');
    $kurierPrice = get_field('kurier_price');
    ?>
    
        <div class="product-card__details-row">
            <?php if( !empty($brand) ): ?>
                <div class="product-card__details-item">                
                    <div class="product-card__details-label"><b>Бренд:</b></div>
                    <div class="product-card__details-value"><?= $brand; ?></div>
                </div>
            <?php endif; ?>
            <?php if( !empty($line) ): ?>
                <div class="product-card__details-item">
                    <div class="product-card__details-label"> <b>Линия:</b></div>
                    <div class="product-card__details-value"><?= $line; ?></div>
                </div>
            <?php endif; ?>
            <?php if( !empty($obyom) ): ?>
                <div class="product-card__details-item">
                    <div class="product-card__details-label"><b>Объём упаковки:</b></div>
                    <div class="product-card__details-value"><?= $obyom; ?></div>
                </div>
            <?php endif; ?>
        </div>
        <div class="product-card__details-row">
            <?php if( !empty($samovyvozAddress) ): ?>
                <div class="product-card__details-item">
                    <div class="product-card__details-title">Самовывоз</div>
                    <div class="product-card__details-value"><?= $samovyvozAddress; ?></div>
                    <div class="product-card__details-price"><b>Цена:</b> <span><?= $samovyvozPrice;?></span></div>
                </div>
            <?php endif; ?>
            <?php if( !empty($postamatDescr) ): ?>
                <div class="product-card__details-item">
                    <div class="product-card__details-title">Постамат</div>
                    <div class="product-card__details-value"><?= $postamatDescr; ?></div>
                    <div class="product-card__details-term"><b>Срок:</b> <?= $postamatSrok;?></div>
                    <div class="product-card__details-price"><b>Цена:</b><?= $postamatPrice; ?></div>
                </div>
            <?php endif; ?>
            <?php if( !empty($kurierDescr) ): ?>
                <div class="product-card__details-item">
                    <div class="product-card__details-title">Курьерская доставка</div>
                    <div class="product-card__details-value"><?= $kurierDescr; ?></div>
                    <div class="product-card__details-term"><b>Срок:</b><?= $kurierSrok; ?></div>
                    <div class="product-card__details-price"><b>Цена:</b><?= $kurierPrice; ?></div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php }

// Добавим наши кастомные кнопки изменения количества товара при добавлении в корзину
// Кнопка плюс
add_action( 'woocommerce_before_quantity_input_field', 'estore_quantity_plus', 35 );

function estore_quantity_plus() {
	echo '<button type="button" class="quantity__button quantity__button_plus plus">+</button>';
}

// Кнопка минус
add_action( 'woocommerce_before_quantity_input_field', 'estore_quantity_minus', 5 );

function estore_quantity_minus() {
	echo '<button type="button" class="quantity__button quantity__button_minus minus">-</button>';
}

// !!! А далее кнопку "Купить в один клик" справа добавм в файле для кнопки корзины /single-product/add-to-card/simple.php


// Табы (вкладки) на карточке товара

// Удалим таб Детали
add_action( 'woocommerce_product_tabs', 'estore_delete_additional_information', 25 );

function estore_delete_additional_information( $tabs ) { // не забываем в функции аргумент $tabs   
    unset( $tabs[ 'additional_information' ] );   
    
    return $tabs; // Не забываем вернуть массив на место
}

// Добавим Таб Применение
add_filter( 'woocommerce_product_tabs', 'estore_new_product_tab_primeneine', 25 );
 
function estore_new_product_tab_primeneine( $tabs ) {
    if( get_field('primenenie_left') || get_field('primenenie_right') ):
        $tabs[ 'primenenie' ] = array(
            'title' 	=> 'Применение',
            'priority' 	=> 15,
            'callback' 	=> 'estore_new_tab_content'
        );
    endif;   
	    return $tabs;
    
}
function estore_new_tab_content() { ?>
	<div class="product-tabs__body">
        <div class="product-tabs__description product-description">
            <div class="product-description__col">
                <?php the_field('primenenie_left'); ?>
            </div>
            <div class="product-description__col">
                <?php the_field('primenenie_right'); ?>
            </div>
        </div>
    </div>
<?php }


// Добавим Таб Доставка
add_filter( 'woocommerce_product_tabs', 'estore_new_product_tab_delivery', 25 );
 
function estore_new_product_tab_delivery( $tabs ) {
    if( get_field('delivery') ):
        $tabs[ 'delivery' ] = array(
            'title' 	=> 'Доставка',
            'priority' 	=> 40,
            'callback' 	=> 'estore_new_tab_delivery_content'
        );
    endif;   
	    return $tabs;
    
}
function estore_new_tab_delivery_content() { ?>
	<div class="product-tabs__body">        
        <?php the_field('delivery'); ?>            
    </div>
<?php }


// Добавим Таб Оплата
add_filter( 'woocommerce_product_tabs', 'estore_new_product_tab_payment', 25 );
 
function estore_new_product_tab_payment( $tabs ) {
    if( get_field('payment') ):
        $tabs[ 'payment' ] = array(
            'title' 	=> 'Оплата',
            'priority' 	=> 50,
            'callback' 	=> 'estore_new_tab_payment_content'
        );
    endif;   
	    return $tabs;
    
}
function estore_new_tab_payment_content() { ?>
	<div class="product-tabs__body">        
        <?php the_field('payment'); ?>            
    </div>
<?php }


// Вкладка Отзывы (шаблон - /single=product/review.php)

add_action('woocommerce_review_before', 'estore_review_gravatar_start', 5);

function estore_review_gravatar_start() {?>
    <div class="main-reviews__item-avatar">                                    
<?php }

add_action('woocommerce_review_before', 'estore_review_gravatar_end', 15);

function estore_review_gravatar_end() {?>
    </div>                                    
<?php }


// Добавим нижние блоки в карточку товара

// В карточку после блока FAQ добавим Апсейлы
add_action( 'woocommerce_after_single_product', 'woocommerce_upsell_display', 20 );


// На страницу Карточки товара после отзывов добавим текстовый блок
add_action('woocommerce_after_single_product', 'estore_add_product_text_block', 30);
function estore_add_product_text_block() {
        $productTextHead = get_field('product-text-head');	
        $productTextLeft = get_field('product-text-left');
        $productTextRight = get_field('product-text-right');
    if( is_product() && !empty($productTextHead)):
		
        ?>

        <section class="text-block">
            <div class="text-block__container">
                <div class="text-block__title section-title">
                    <h2><?= $productTextHead; ?></h2>
                </div>
                <div class="text-block__body">
                    <div class="text-block__col">
                        <?= $productTextLeft; ?>
                    </div>
                    <div class="text-block__col">
                        <?= $productTextRight; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif;
}

// Добавим футер в карточку товара
add_action( 'woocommerce_after_single_product', 'estore_add_product_footer', 50 );

function estore_add_product_footer() {
    if(is_product()) {
        get_footer();
    }
}


// Заменим надпись "Вам также может быть интересно..."
/*-------------- Change related products text -------------*/
add_filter( 'woocommerce_product_upsells_products_heading', 'single_related_text' );

function single_related_text(){
    return __('Вам понравятся', 'woocommerce');
}


// Заменим надпись в кросс-сейлах
/*-------------- Change related products text -------------*/
add_filter( 'woocommerce_product_cross_sells_products_heading', 'single_related_text_cross_sell' );

function single_related_text_cross_sell(){
    return 'С этим товаром часто смотрят';
}



