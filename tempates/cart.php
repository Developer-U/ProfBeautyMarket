<?php
/*
Template Name: Корзина
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

                <!-- cart -->
                <section class="cart">
                    <div class="cart__container">
                        <div class="cart__title section-title">                                
                            <h1><?php the_title(); ?></h1>                                
                        </div>
                        
                        <div class="cart__container">
                            
                            <?php the_content(); ?>
                        </div>                            
                    </div>
                </section>
            </div>                

            <?php get_footer(); ?>
        </main>
    </div>

    <script>
        // Сделаем автообновление корзины и кнопки плюс и минус	
        $( 'body' ).on( 'click', 'button.plus, button.minus', function() { // Все кнопки            

            // Глобальные переменные кнопок
            var qty = $(this).parent().find( 'input' ),
                val = parseInt( qty.val() ),
                min = parseInt( qty.attr( 'min' ) ),
                max = parseInt( qty.attr( 'max' ) ),
                step = parseInt( qty.attr( 'step' ) );            

            // дальше меняем значение количества в зависимости от нажатия кнопки
            if ( $( this ).is( '.plus' ) ) {
                if ( max && ( max <= val ) ) {
                    qty.val( max );
                } else {
                    qty.val( val + step );
                }
            } else {
                if ( min && ( min >= val ) ) {
                    qty.val( min );
                } else if ( val > 1 ) {
                    qty.val( val - step );
                }
            }

            // Автообновление корзины
            // Стандартную кнопку "Обновить корзину скрываем"
            qty.change();
            $( '[name="update_cart"]' ).trigger( 'click' );

        });
        
    </script>


