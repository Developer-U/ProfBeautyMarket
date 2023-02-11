<?php
/*
Template Name: Карта сайта
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

        <!-- sitemap -->
        <section class="sitemap">
            <div class="sitemap__container">
                <div class="sitemap__title section-title">
                    <h1><?php the_title(); ?></h1>
                </div>
                <div data-spollers="600" class="sitemap__items">
                    <?php if( have_rows('add_new_site-map_item') ): ?>
                    <?php while( have_rows('add_new_site-map_item') ): the_row();
                        $siteMapItemName = get_sub_field('site-map_item_name');          
                    ?>

                        <div class="sitemap__col">
                            <div class="sitemap__item">
                                <button type="button" data-spoller class="sitemap__label">
                                    <span><?= $siteMapItemName; ?></span>
                                    <svg>
                                        <use xlink:href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/icons/icons.svg#svg-arrow-down"></use>
                                    </svg>
                                </button>
                                <ul class="sitemap__list">
                                    <?php if( have_rows('add_new_site-map_list') ): ?>
                                    <?php while( have_rows('add_new_site-map_list') ): the_row();
                                        $siteMapListName = get_sub_field('site-map_list_name');    
                                        $siteMapListLink = get_sub_field('site-map_list_link');      
                                    ?>

                                        <li class="sitemap__list-item"><a href="<?= $siteMapListLink; ?>" class="sitemap__list-link"><?= $siteMapListName; ?></a></li>

                                    <?php endwhile; ?>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            
                        </div>
                    
                    <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <!-- sitemap end -->

        <?php get_footer(); ?>
    </main>
</div>