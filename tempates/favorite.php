<?php
/*
Template Name: Избранное
*/

defined( 'ABSPATH' ) || exit;

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

        <!-- favorite -->
        <section class="favorites">
            <div class="favorites__container">
                <div class="catalog__title section-title">                                
                    <h1><?php the_title(); ?></h1>                                
                </div>
                
                <?php the_content(); ?>

                <div class="favorites__body">
                    <a href="/shop" class="favorites__button btn-purple">ПЕРЕЙТИ В КАТАЛОГ ТОВАРОВ</a>
                </div>
            </div>
        </section>
    </div>    

    <?php get_footer(); ?>
</main>
</div>
