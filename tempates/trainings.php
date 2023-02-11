<?php
/*
Template Name: Обучения
*/
get_header();
?>

        <?php get_template_part('template-parts/page', 'header'); ?>
        <!-- breadcrumbs -->
        <div class="breadcrumbs">
            <div class="breadcrumbs__container">
                <?php
                    if ( function_exists('yoast_breadcrumb') ) {
                    yoast_breadcrumb( '<div class="breadcrumbs__list">','</div>' );
                    }
                ?>
            </div>
        </div>
        <!-- breadcrumbs end -->


        <!-- training -->
        <section class="training">
            <div class="training__container">
                <div class="training__title section-title">
                    <h1><?php the_title(); ?></h1>
                </div>

                <div class="training__tags">
                    <button type="button" class="training__tags-arrow training__tags-arrow-prev">
                        <svg>
                            <use xlink:href="img/icons/icons.svg#svg-arrow-left"></use>
                        </svg>
                    </button>
                    <div class="training__tags-list swiper">
                        <div class="training__tags-wrapper swiper-wrapper">
                            <div class="training__tags-item tags-item swiper-slide">
                                <div class="tags-item__checkbox">
                                    <input id="tag_1" data-error="" class="tags-item__input" type="checkbox" value="1" name="form[]">
                                    <label for="tag_1" class="tags-item__label"><span class="tags-item__text">Увлажнение</span></label>
                                </div>
                            </div>
                            <div class="training__tags-item tags-item swiper-slide">
                                <div class="tags-item__checkbox">
                                    <input id="tag_2" data-error="" class="tags-item__input" type="checkbox" value="2" name="form[]">
                                    <label for="tag_2" class="tags-item__label"><span class="tags-item__text">Очищение</span></label>
                                </div>
                            </div>
                            <div class="training__tags-item tags-item swiper-slide">
                                <div class="tags-item__checkbox">
                                    <input id="tag_3" data-error="" class="tags-item__input" type="checkbox" value="3" name="form[]">
                                    <label for="tag_3" class="tags-item__label"><span class="tags-item__text">Питание</span></label>
                                </div>
                            </div>
                            <div class="training__tags-item tags-item swiper-slide">
                                <div class="tags-item__checkbox">
                                    <input id="tag_4" data-error="" class="tags-item__input" type="checkbox" value="4" name="form[]">
                                    <label for="tag_4" class="tags-item__label"><span class="tags-item__text">Для тела</span></label>
                                </div>
                            </div>
                            <div class="training__tags-item tags-item swiper-slide">
                                <div class="tags-item__checkbox">
                                    <input id="tag_5" data-error="" class="tags-item__input" type="checkbox" value="5" name="form[]">
                                    <label for="tag_5" class="tags-item__label"><span class="tags-item__text">Для лица</span></label>
                                </div>
                            </div>
                            <div class="training__tags-item tags-item swiper-slide">
                                <div class="tags-item__checkbox">
                                    <input id="tag_6" data-error="" class="tags-item__input" type="checkbox" value="6" name="form[]">
                                    <label for="tag_6" class="tags-item__label"><span class="tags-item__text">Пилинги</span></label>
                                </div>
                            </div>
                            <div class="training__tags-item tags-item swiper-slide">
                                <div class="tags-item__checkbox">
                                    <input id="tag_7" data-error="" class="tags-item__input" type="checkbox" value="7" name="form[]">
                                    <label for="tag_7" class="tags-item__label"><span class="tags-item__text">Увлажнение</span></label>
                                </div>
                            </div>
                            <div class="training__tags-item tags-item swiper-slide">
                                <div class="tags-item__checkbox">
                                    <input id="tag_8" data-error="" class="tags-item__input" type="checkbox" value="8" name="form[]">
                                    <label for="tag_8" class="tags-item__label"><span class="tags-item__text">Очищение</span></label>
                                </div>
                            </div>
                            <div class="training__tags-item tags-item swiper-slide">
                                <div class="tags-item__checkbox">
                                    <input id="tag_9" data-error="" class="tags-item__input" type="checkbox" value="9" name="form[]">
                                    <label for="tag_9" class="tags-item__label"><span class="tags-item__text">Питание</span></label>
                                </div>
                            </div>
                            <div class="training__tags-item tags-item swiper-slide">
                                <div class="tags-item__checkbox">
                                    <input id="tag_10" data-error="" class="tags-item__input" type="checkbox" value="10" name="form[]">
                                    <label for="tag_10" class="tags-item__label"><span class="tags-item__text">Для тела</span></label>
                                </div>
                            </div>
                            <div class="training__tags-item tags-item swiper-slide">
                                <div class="tags-item__checkbox">
                                    <input id="tag_11" data-error="" class="tags-item__input" type="checkbox" value="11" name="form[]">
                                    <label for="tag_11" class="tags-item__label"><span class="tags-item__text">Для лица</span></label>
                                </div>
                            </div>
                            <div class="training__tags-item tags-item swiper-slide">
                                <div class="tags-item__checkbox">
                                    <input id="tag_12" data-error="" class="tags-item__input" type="checkbox" value="12" name="form[]">
                                    <label for="tag_12" class="tags-item__label"><span class="tags-item__text">Пилинги</span></label>
                                </div>
                            </div>
                            <div class="training__tags-item tags-item swiper-slide">
                                <div class="tags-item__checkbox">
                                    <input id="tag_12" data-error="" class="tags-item__input" type="checkbox" value="12" name="form[]">
                                    <label for="tag_12" class="tags-item__label"><span class="tags-item__text">Увлажнение</span></label>
                                </div>
                            </div>
                            <div class="training__tags-item tags-item swiper-slide">
                                <div class="tags-item__checkbox">
                                    <input id="tag_13" data-error="" class="tags-item__input" type="checkbox" value="13" name="form[]">
                                    <label for="tag_13" class="tags-item__label"><span class="tags-item__text">Очищение</span></label>
                                </div>
                            </div>
                            <div class="training__tags-item tags-item swiper-slide">
                                <div class="tags-item__checkbox">
                                    <input id="tag_14" data-error="" class="tags-item__input" type="checkbox" value="14" name="form[]">
                                    <label for="tag_14" class="tags-item__label"><span class="tags-item__text">Питание</span></label>
                                </div>
                            </div>
                            <div class="training__tags-item tags-item swiper-slide">
                                <div class="tags-item__checkbox">
                                    <input id="tag_15" data-error="" class="tags-item__input" type="checkbox" value="15" name="form[]">
                                    <label for="tag_15" class="tags-item__label"><span class="tags-item__text">Для тела</span></label>
                                </div>
                            </div>
                            <div class="training__tags-item tags-item swiper-slide">
                                <div class="tags-item__checkbox">
                                    <input id="tag_16" data-error="" class="tags-item__input" type="checkbox" value="16" name="form[]">
                                    <label for="tag_16" class="tags-item__label"><span class="tags-item__text">Для лица</span></label>
                                </div>
                            </div>
                            <div class="training__tags-item tags-item swiper-slide">
                                <div class="tags-item__checkbox">
                                    <input id="tag_17" data-error="" class="tags-item__input" type="checkbox" value="17" name="form[]">
                                    <label for="tag_17" class="tags-item__label"><span class="tags-item__text">Пилинги</span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="training__tags-arrow training__tags-arrow-next">
                        <svg>
                            <use xlink:href="img/icons/icons.svg#svg-arrow-right"></use>
                        </svg>
                    </button>
                </div>

                <div class="training__sort">
                    <span>Сортировать:</span>
                    <select data-class-modif="_sort" name="form[]" class="form">
                        <option value="1" selected>по дате проведения</option>
                        <option value="2">по алфавиту</option>
                    </select>
                </div>

                <div class="training__body">
                    <nav data-spollers="1400" class="training__menu">
                        <button type="button" data-spoller="" class="training__menu-title">
                            <span>Меню</span>
                            <svg>
                                <use xlink:href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/icons/icons.svg#svg-arrow-down"></use>
                            </svg>
                        </button>

                        <ul class="training__menu-list">
                        <?php 
                            $arg_cat = array(
                                'posts_per_page' => -1,
                                'orderby'      => 'name',
                                'order'        => 'DESC',
                                'hide_empty'   => 0,                                
                                'exclude'      => '',
                                'include'      => '',
                                'taxonomy'     => 'category',
                            );
                            $categories = get_categories( $arg_cat );
                            ?>                        
                            
                            <?php 
                            if( $categories ){
                            foreach( $categories as $cat ){
                                $query = new WP_Query($arg_posts);
                                $id = $cat->cat_ID;                           
                                ?>

                                <?php if ($query->have_posts() ) ?>
                                    <li class="training__menu-item"><a href="#" class="training__menu-link"><?php echo $cat->name; ?></a></li>

                                <?php		
                                }
                            }
                            ?>
                        </ul>
                    </nav>
                    
                    <div class="training__list">
                        <?php                       
                        $current = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

                        $arg_posts =  array(                                                                       
                            'order'        => 'DESC',
                            'posts_per_page' => 5,
                            'paged'          => $current,
                            'post_type' => 'trainings',
                            'post_status' => 'publish',
                                                        
                            'include'     => array(),
                            'exclude'     => array(),
                            'meta_key'    => '', 
                            
                        );
                        $query = new WP_Query($arg_posts);                                                  
                        ?>                                                                   
                            
                        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                            <div class="training__item training-item">
                                <div class="training-item__left">
                                    <a class="training-item__img" href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail( 'widgetfull' );?>
                                    </a>
                                    <div class="training-item__price">
                                        Стоимость: <span> Бесплатно</span>
                                    </div>
                                </div>

                                <div class="training-item__content">
                                    <div class="training-item__date"><?php the_date(); ?></div>
                                    <a href="#" class="training-item__title"><?php the_title(); ?></a>

                                    <div class="training-item__details">
                                        <?php the_content(); ?>
                                    </div>

                                    <div class="training-item__buttons">
                                        <button type="button" data-popup-open="kurs" class="training-item__button btn-purple-fill">записаться</button>
                                        <button type="button" data-popup-open="model" class="training-item__button btn-purple">стать моделью</button>
                                    </div>
                                </div>
                            </div>

                        <?php endwhile;
                        
                        echo paginate_links(
                            array(
                                'prev_next' => false, 
                                'end_size' => 2,
                                'mid_size' => 2,
                                'type' => 'list', 
                                'base' => site_url() . '/learn/%_%',                                 
                                'total' => $query->max_num_pages,
                                'current' => $current
                            )
                        ); 
                        
                        wp_reset_postdata()?> 
                    </div>
                </div>
            </div>
        </section>
        <!-- training end -->

        <?php get_footer(); ?>
    </main>
</div>

<script>
    window.addEventListener('DOMContentLoaded', function(){  
        let trainingOpen = $('.training__menu-title')
           ,trainingMenu = $('.training__menu-list')
           ,trainingMenuItem = $('.training__menu-item');

        trainingOpen.on('click', function(){
            trainingMenu.slideToggle('slow');
        });

        trainingMenuItem.on('click', function(e){
            e.preventDefault();
            trainingMenu.fadeOut('slow');
        });
    });
</script>