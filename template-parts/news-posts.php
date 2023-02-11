<?php
/**
 * Блок "Новости и статьи"
 * 
 */
?>

<?php if( get_field('posts-news-head', 'options') ): ?>
    <section class="main-news">
        <div class="main-news__container">
            <div class="main-news__title section-title">
                <h2><?php the_field('posts-news-head', 'options'); ?></h2>
            </div>
            <div class="main-news__body">
                <div class="main-news__list">
                    <?php
                    // выведем из типа постов articles только новости
                    $news = get_posts( array(
                        'numberposts' => 6,
                        'category'    => 0,
                        'orderby'     => 'date',
                        'order'       => 'DESC',
                        'include'     => array(),
                        'exclude'     => array(),
                        'meta_key'    => '',
                        'meta_value'  => 'Статья',
                        'post_type'   => 'articles',
                        'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                    ) );

                    global $post; ?>

                    <?php if( $news) { ?>
                    <?php foreach( $news as $post ){
                        setup_postdata( $post );
                    ?>

                        <div class="main-news__item">
                            <div class="main-news__item-img">
                                <?php $article_img_url = get_the_post_thumbnail_url( get_the_ID(), 'full' ); ?>
                                <img src="<?= $article_img_url; ?>" alt="">
                            </div>
                            <div class="main-news__item-body">
                                <div class="main-news__item-date"><?php echo get_the_date(); ?></div>
                                <a href="<?php the_permalink(); ?>" class="main-news__item-title"><?php the_title(); ?></a>
                                <div class="main-news__item-text"><?php the_excerpt(); ?></div>
                            </div>
                        </div>
                    
                    <?php }                         
                
                    } else { ?>
                        <div class="main-news__item"></div>
                    <?php }                  
                    
                    wp_reset_postdata(); // сброс
                    ?> 
                </div>
                <a href="/blog" class="main-news__button btn-purple">все новости</a>
            </div>
        </div>
    </section>
<?php endif; ?>