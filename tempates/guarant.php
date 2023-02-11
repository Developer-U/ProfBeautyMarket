<?php
/*
Template Name: Гарантия
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

        <!-- guarantee -->
        <section class="guarantee text-block">
            <div class="text-block__container">
                <div class="text-block__title section-title">
                    <h1><?php the_title(); ?></h1>
                </div>
                <div class="text-block__body">
                    <div class="text-block__col">
                        <?php the_field('left_guarant_text'); ?>
                    </div>
                    <div class="text-block__col">
                        <?php the_field('right_guarant_text'); ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- guarantee end -->

        <!-- Return and exchange -->
        <?php if( get_field('return_heading') ): ?>
            <section class="return text-block">
                <div class="text-block__container">
                    <div class="text-block__title section-title">
                        <h2><?php the_field('return_heading'); ?></h2>
                    </div>
                    <div class="text-block__body">
                        <div class="text-block__col">
                            <?php the_field('return_left'); ?>
                        </div>
                        <div class="text-block__col">
                            <?php the_field('return_right'); ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!-- Return and exchange end -->

        <?php get_footer(); ?>
    </main>
</div>