<?php
/*
*  Блок отображеня статей в сайдбаре
*/
?>

    <div class="category__sidebar-articles sidebar-articles">
        <h3 class="sidebar-articles__title">Статьи</h3>

        <?php
        // параметры по умолчанию
        $sidear_posts = get_posts( array(
            'numberposts' => 2,                            
            'orderby'     => 'date',
            'order'       => 'DESC',            
            'meta_key'    => '',      
            'meta_value'  => 'Статья',
            'post_type'   => 'articles',
            'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
        ) );

        global $post; ?>

        <?php if( $sidear_posts) { ?>
        <?php foreach( $sidear_posts as $post ){
            setup_postdata( $post );
        ?>

        <article class="sidebar-articles__item" data-article="<?php the_field('article_type'); ?>">
            <div class="sidebar-articles__item-img">
                <?php echo get_the_post_thumbnail( $id, 'full', array() ); ?>             
            </div>
            <div class="sidebar-articles__item-content">
                <div class="sidebar-articles__item-date"><?php the_date(); ?></div>
                <a href="<?php the_permalink();?>" class="sidebar-articles__item-title"><?php the_title(); ?></a>
                <p><?php the_excerpt(); ?> </p>
            </div>
        </article>
        
        <?php }
            } else { ?>
                <p class="news__subheading"></p>
            <?php }                  
            
            wp_reset_postdata(); // сброс
            ?>
    </div>