<?php
/*
Template Name: Доставка и оплата
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

        <!-- delivery -->
        <section class="delivery text-block">
            <div class="text-block__container">
                <div class="text-block__title section-title">
                    <h1><?php the_title(); ?></h1>
                </div>
                <div class="text-block__body">
                    <div class="text-block__col">
                        <?php the_field('left_del-pay'); ?>
                    </div>
                    <div class="text-block__col">
                        <?php the_field('right_del-pay'); ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- delivery end -->

        <!-- payment -->
        <?php if( get_field('pay_methods_heading') ): ?>
            <section class="payment">
                <div class="payment__container">
                    <div class="payment__body">
                        <div class="payment__title section-title">
                            <h2><?php the_field('pay_methods_heading'); ?></h2>
                        </div>
                        <div class="payment__text">
                            <?php the_field('pay_methods_descr'); ?>
                        </div>
                        
                        <div class="payment__list">
                            <?php if( have_rows('add_new_pay_method') ): ?>
                            <?php while( have_rows('add_new_pay_method') ): the_row();
                                $payMethodImg = get_sub_field('pay_method_img');   
                                $payMethodName = get_sub_field('pay_method_name');
                                $payMethodText = get_sub_field('pay_method_text');                                                             
                            ?>

                                <div class="payment__item" style="background-image: url('<?php echo esc_url($payMethodImg['url']); ?>')">
                                    <div class="payment__item-title"><?= $payMethodName; ?></div>
                                    <div class="payment__item-text">
                                        <?= $payMethodText; ?>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!-- payment end -->

        <?php get_footer(); ?>
    </main>
</div>