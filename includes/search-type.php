<?php

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

            <div class="result-search search-header__results js-scroll">
                <div class="preloader"><img src="' . get_template_directory_uri() . '/assets/images/loader.gif" class="loader" /></div>
                <div class="result-search-list search-header__list "></div>
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