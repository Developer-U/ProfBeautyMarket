<?php
/*
Template Name: Оформление заказа
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

                <!-- checkout -->
                <section class="checkout">
                    <div class="checkout__container">
                        <div class="checkout__title section-title">
                            <?php if(is_order_received_page() ): ?>
                                <h1>Спасибо за заказ</h1>
                            <?php else: ?>
                                <h1>Оформление заказа</h1>
                            <?php endif; ?>
                        </div>

                        <?php if(is_order_received_page() ): ?>
                            <div class="checkout-success__descr">
                                <?php if( have_rows('new_thankyou_item', 'options') ): ?>
                                <?php while( have_rows('new_thankyou_item', 'options') ): the_row();
                                $thankImage = get_sub_field('thankyou_item_image', 'options');
                                $thankDescr = get_sub_field('thankyou_item-descr', 'options');
                                ?> 
                                    <div class="checkout-success__descr-item" style="background-image: url('<?php echo esc_url($thankImage['url']); ?>')">
                                        <div>
                                            <?= $thankDescr; ?>
                                        </div>
                                    </div>
                                    
                                <?php endwhile; ?>
                                <?php endif; ?>      
							</div>
                        <?php endif; ?>
                        <div class="checkout__body cart_item">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </section>

                <?php get_template_part('template-parts/popular', 'products'); ?>
            </div>

            <?php get_footer(); ?>
        </main>
    </div>
  