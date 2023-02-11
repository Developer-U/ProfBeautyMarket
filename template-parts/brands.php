<?php 
/*
 * Блок Бренды
 * 
 * 
 */

 if( get_field('brands_heading', 'options') ): ?>
    <section class="main-brands brands">
        <div class="brands__container">
            <div class="brands__title section-title">
                <h2><?php the_field('brands_heading', 'options'); ?></h2>
            </div>
           
                
                <div class="brands__list">
                    <div class="brands__list-wrapper">
                        
                        <?php if( have_rows('add_new_brand', 'options') ): ?>
                        <?php while( have_rows('add_new_brand', 'options') ): the_row();
                            $brandLogo = get_sub_field('brand_logo', 'options');   
                            $brandLink = get_sub_field('brand_link', 'options');     
                        ?>
                            <div>
                                <?php if( !empty($brandLink) ): ?>
                                    <a href="<?= $brandLink; ?>">
                                        <img src="<?php echo esc_url($brandLogo['url']); ?>" alt="<?php echo esc_attr($brandLogo['alt']); ?>">
                                    </a>
                                <?php else: ?>
                                    <img src="<?php echo esc_url($brandLogo['url']); ?>" alt="<?php echo esc_attr($brandLogo['alt']); ?>">
                                <?php endif; ?>
                            </div>
                            
                        <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
                
            
        </div>
    </section>
<?php endif; ?>