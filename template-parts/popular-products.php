<?php
/*
* Блок вывода Популярных товаров (по атрибуту Хит)
*/
?>

    <!-- popuplar-products -->  
    <section class="popuplar-products">
        <div class="popuplar-products__container">
            <div class="popuplar-products__title section-title">
                <h2>Популярные товары</h2>
            </div>

            <div class="products-collection__items">
                <?php  
                $hit = ''; //Хит
            
                if (isset($_REQUEST['hit'])) {
                    $hit = $_REQUEST['hit'];
                } 
                $attribute = 'hit';
                $value = 'hit_yes';                             
                $args = array(
                    'numberposts' => 8,
                    'post_type' => 'product',
                    'tax_query' => array(
                        array(
                            'taxonomy'      => 'pa_' . $attribute,
                            'terms'         => $value,
                            'field'         => 'slug',
                            'operator'      => 'IN'
                            )
                        ),
                    
                    'posts_per_page' => 8,                
                );
                    global $product;
                    
                    $prod_query = new WP_Query( $args );
                    
                    if ($prod_query->have_posts()) :
                    
                    while ($prod_query->have_posts()) :
                    
                    $prod_query->the_post();
                    
                    $product = get_product( $prod_query->post->ID );  
                
                        wc_get_template_part( 'content', 'product' ); ?>

                    <?php endwhile; ?>

                    <?php endif; ?>
                
                <?php wp_reset_query(); // Remember to reset
                ?>
            </div>
        <div>
    <section>