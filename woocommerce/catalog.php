<?php
/*
Template Name: Страница каталога
*/

defined( 'ABSPATH' ) || exit;

get_header();
?>  
 
    <div class="wrapper">
        <?php get_sidebar(); ?>

        <main class="page">
            <?php get_template_part( 'template-parts/page', 'header' ); ?>

            <div class="page__wrap" data-bg-set="url('<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/green-bg.png') 1x, url('<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/green-bg@2x.png') 2x">
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

                <!-- catalog -->
                <section class="catalog">
                    <div class="catalog__container">
                        <div class="catalog__title section-title">
                            <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
                                <h1><?php woocommerce_page_title(); ?></h1>
                            <?php endif; ?>
                        </div>
                        <div class="catalog__body">
                            <?php estore_product_subcategories(); ?>
                        </div>
                    </div>
                </section>
                <!-- catalog end --> 
            </div>

            <?php get_footer(); ?>
        </main>
    </div>
  





