<?php
/*
Template Name: Главная страница
*/
get_header();
?>

				<?php get_template_part('template-parts/page', 'header'); ?>
				<!-- main slider -->
				<section class="main-slider">
					<div class="main-slider__container swiper">						
						<div class="main-slider__wrapper swiper-wrapper">
							<?php  
							$the_first = ''; // Атрибут на главную
						
							if (isset($_REQUEST['for_the_first'])) {
								$the_first = $_REQUEST['for_the_first'];
							} 
							$attribute = 'for_the_first';
							$value = 'yes'; 

							$args = array(
								'numberposts' => -1,
								'post_type' => 'product',					
								'meta_key'    => '',					                 
								'meta_value' => '',
								'tax_query' => array(
									array(
										'taxonomy'      => 'pa_' . $attribute,
										'terms'         => $value,
										'field'         => 'slug',
										'operator'      => 'IN'
										)
									),
								'posts_per_page' => -1,
								'suppress_filters' => true
							);

							global $product;
							
							$prod_query = new WP_Query( $args );
							
							if ($prod_query->have_posts()) :
							
							while ($prod_query->have_posts()) :
							
							$prod_query->the_post();
							
							$product = get_product( $prod_query->post->ID );  ?>
								<div class="main-slider__slide swiper-slide">
									<div class="main-slider__slide-img">
										<?php echo get_the_post_thumbnail( $id, 'full', array('') ); ?>
									</div>
									<div class="main-slider__slide-content slide-content">
										<div class="slide-content__info">
											<?php if( get_field('product_brand')):
												$productBrand = get_field('product_brand'); ?>
												<div class="slide-content__brand">
													<img src="<?php echo esc_url($productBrand['url']); ?>" alt="<?php echo esc_attr($productBrand['alt']); ?>">
												</div>
											<?php endif; ?>
											<h2 class="slide-content__title"><?php the_title(); ?></h2>
											<p class="slide-content__text">
												<?php the_excerpt(); ?>
											</p>
											<a href="<?php the_permalink(); ?>" class="slide-content__button btn-purple-fill">подробнее</a>
										</div>

										<div class="slide-content__properties">
											<?php if( have_rows('add_new_product_param') ): ?>
											<?php while( have_rows('add_new_product_param') ): the_row();
												$prodParamImg = get_sub_field('product_param_img');   
												$prodParamName = get_sub_field('product_param_name');                                                            
											?>
												<div class="slide-content__properties-item" style="background-image: url('<?php echo esc_url($prodParamImg['url']); ?>')">
													<span><?= $prodParamName; ?></span>
												</div>
												
											<?php endwhile; ?>
											<?php endif; ?>
										</div>								
									</div>
								</div>

							<?php endwhile; ?>

							<?php endif; ?>									

							<?php wp_reset_query(); // Remember to reset
							?>								
						</div>

						<div class="main-slider__pagination"></div>
					</div>
				</section>
				<!-- main slider end -->

				<!-- advantages -->
				<?php get_template_part('template-parts/advantages'); ?>
				<!-- advantages end -->

				<!-- collection -->
				<section class="main-products-collection products-collection">
					<div class="products-collection__container">
						<div class="products-collection__header">
							<div class="products-collection__tabs">
								<button class="products-collection__tabs-btn" type="button" data-path="one" data-text="УХОД ЗА ЛИЦОМ" data-tab="face-care"><?php echo get_the_category_by_id(20); ?></button>
								<button class="products-collection__tabs-btn" type="button" data-path="two" data-text="УХОД ЗА ТЕЛОМ" data-tab="body-care"><?php echo get_the_category_by_id(21); ?></button>
								<button class="products-collection__tabs-btn" type="button" data-path="three" data-text="ИНЪЕКЦИОННЫЕ ПРЕПАРАТЫ" data-tab="injection-preparation"><?php echo get_the_category_by_id(22); ?></button>
							</div>
						</div>
						<div class="products-collection__categories-filter categories-filter">
							<button type="button" class="categories-filter__arrow categories-filter__arrow-prev">
								<svg>
									<use xlink:href="img/icons/icons.svg#svg-arrow-left"></use>
								</svg>
							</button>
							<div class="categories-filter__list swiper">
								<div class="categories-filter__wrapper swiper-wrapper">
									<button class="categories-filter__item swiper-slide _selected _active" data-tab="face-care" data-category="cream">Кремы</button>
									<button class="categories-filter__item swiper-slide _selected" data-tab="face-care" data-category="capsules">Капсулы</button>
									<button class="categories-filter__item swiper-slide _selected" data-tab="face-care" data-category="gels">Гели</button>
									<button class="categories-filter__item swiper-slide" data-tab="body-care" data-category="capsules">Капсулы</button>
									<button class="categories-filter__item swiper-slide" data-tab="body-care" data-category="capsules">Капсулы</button>
									<button class="categories-filter__item swiper-slide" data-tab="body-care" data-category="capsules">Капсулы</button>
									<button class="categories-filter__item swiper-slide" data-tab="body-care" data-category="capsules">Капсулы</button>
									<button class="categories-filter__item swiper-slide" data-tab="injection-preparation" data-category="gels">Гели</button>
									<button class="categories-filter__item swiper-slide" data-tab="injection-preparation" data-category="gels">Гели</button>
									<button class="categories-filter__item swiper-slide" data-tab="injection-preparation" data-category="gels">Гели</button>
									<button class="categories-filter__item swiper-slide" data-tab="injection-preparation" data-category="gels">Гели</button>
									<button class="categories-filter__item swiper-slide" data-tab="injection-preparation" data-category="gels">Гели</button>
									<button class="categories-filter__item swiper-slide" data-tab="injection-preparation" data-category="gels">Гели</button>
									<button class="categories-filter__item swiper-slide" data-tab="injection-preparation" data-category="gels">Гели</button>
									<button class="categories-filter__item swiper-slide" data-tab="injection-preparation" data-category="gels">Гели</button>
									<button class="categories-filter__item swiper-slide" data-tab="injection-preparation" data-category="gels">Гели</button>
									<button class="categories-filter__item swiper-slide" data-tab="injection-preparation" data-category="gels">Гели</button>
									<button class="categories-filter__item swiper-slide" data-tab="injection-preparation" data-category="gels">Гели</button>
									<button class="categories-filter__item swiper-slide" data-tab="injection-preparation" data-category="gels">Гели</button>
									<button class="categories-filter__item swiper-slide" data-tab="injection-preparation" data-category="gels">Гели</button>
									<button class="categories-filter__item swiper-slide" data-tab="injection-preparation" data-category="gels">Гели</button>
									<button class="categories-filter__item swiper-slide" data-tab="injection-preparation" data-category="gels">Гели</button>
									<button class="categories-filter__item swiper-slide" data-tab="injection-preparation" data-category="gels">Гели</button>
									<button class="categories-filter__item swiper-slide" data-tab="injection-preparation" data-category="gels">Гели</button>
									<button class="categories-filter__item swiper-slide" data-tab="injection-preparation" data-category="gels">Гели</button>
									<button class="categories-filter__item swiper-slide" data-tab="injection-preparation" data-category="gels">Гели</button>
									<button class="categories-filter__item swiper-slide" data-tab="injection-preparation" data-category="gels">Гели</button>
								</div>
							</div>
							<button type="button" class="categories-filter__arrow categories-filter__arrow-next">
								<svg>
									<use xlink:href="img/icons/icons.svg#svg-arrow-right"></use>
								</svg>
							</button>
						</div>

						<!-- Товары категории уход за лицом -->
						<article class="products-collection__items" data-target="one">
							<?php 					                           
								$args = array(
									'numberposts' => 12,
									'post_type' => 'product',
									'post_status'   => 'publish',
									'tax_query' => array(
										array(
											'taxonomy'      => 'product_cat',									
											'field'         => 'slug',
											'terms'         => 'uhod_za_lizom',									
											)
										),
									
									'posts_per_page' => 12,                
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
						</article>

						<!-- Товары категории уход за телом -->
						<article class="products-collection__items" data-target="two">
							<?php 					                           
								$args = array(
									'numberposts' => 12,
									'post_type' => 'product',
									'post_status'   => 'publish',
									'tax_query' => array(
										array(
											'taxonomy'      => 'product_cat',									
											'field'         => 'slug',
											'terms'         => 'uhod_za_telom',									
											)
										),
									
									'posts_per_page' => 12,                
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
						</article>

						<!-- Товары категории инъекцтонные препараты -->
						<article class="products-collection__items" data-target="three">
							<?php 					                           
								$args = array(
									'numberposts' => 12,
									'post_type' => 'product',
									'post_status'   => 'publish',
									'tax_query' => array(
										array(
											'taxonomy'      => 'product_cat',									
											'field'         => 'slug',
											'terms'         => 'inyection_preparat',									
											)
										),
									
									'posts_per_page' => 12,                
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
						</article>
					</div>
				</section>
				<!-- collection end -->

				<!-- brands -->
				<?php get_template_part('template-parts/brands'); ?>
				<!-- brands end -->

				<!-- reviews -->
				<?php if( get_field('main_reviews_heading') ): ?>
					<section class="main-reviews">
						<div class="main-reviews__container">
							<div class="main-reviews__title section-title">
								<h2><?php the_field('main_reviews_heading'); ?></h2>
							</div>
							<div class="main-reviews__body">
								<div class="main-reviews__list">
									<?php if( have_rows('new_main_review') ): ?>
									<?php while( have_rows('new_main_review') ): the_row();
									$mainRevName = get_sub_field('main-rev-name');
									$mainRevImage = get_sub_field('main-rev-image');
									$mainRevRating = get_sub_field('main-rev-rating');
									$mainRevDate= get_sub_field('main-rev-date');
									$mainRevDescr= get_sub_field('main-rev-descr');?>								

										<div class="main-reviews__item">
											<div class="main-reviews__item-avatar">
												<img src="<?php echo esc_url($mainRevImage['url']); ?>" alt="<?php echo esc_attr($mainRevImage['alt']); ?>">
											</div>
											<div class="main-reviews__item-name"><?= $mainRevName; ?></div>
											<div class="main-reviews__item-rating rating">
												<?= $mainRevRating; ?>
											</div>
											<div class="main-reviews__item-date"><?= $mainRevDate; ?></div>
											<div class="main-reviews__item-text">
												<div class="main-reviews__text" >
													<?= $mainRevDescr; ?>
												</div>
												<button type="button" class="main-reviews__item-more" ><span>Читать</span></button>

												<button type="button" class="main-reviews__item-less" ><span>Скрыть</span></button>
											</div>
										</div>

									<?php endwhile; ?>
									<?php endif; ?>                        
								</div>
								<a href="/reviews" class="main-reviews__button btn-purple">все отзывы</a>
							</div>
						</div>
					</section>
				<?php endif; ?>
				<!-- reviews end -->

				<section class="main-promotions promotions">
					<div class="promotions__container">
						<div class="promotions__body">
						
							<div class="promotions__item">
								<?php  
								$presentation = ''; // Презентация на главной №1
							
								if (isset($_REQUEST['presentation'])) {
									$presentation = $_REQUEST['presentation'];
								} 
								$attribute = 'presentation';
								$value = 'presentation1'; 

								$args1 = array(
									'numberposts' => 1,
									'post_type' => 'product',					
									'meta_key'    => '',					                 
									'meta_value' => '',
									'tax_query' => array(
										array(
											'taxonomy'      => 'pa_' . $attribute,
											'terms'         => $value,
											'field'         => 'slug',
											'operator'      => 'IN'
											)
										),
									'posts_per_page' => 1,
									'suppress_filters' => true
								);
								global $product;                    
								$prod_query = new WP_Query( $args1 );
								
								if ($prod_query->have_posts()) :
								
								while ($prod_query->have_posts()) :
								
								$prod_query->the_post();
								
								$product = get_product( $prod_query->post->ID );  
								?>
									<a class="promotions__img" href="<?php the_permalink(); ?>">
										<?php echo get_the_post_thumbnail( $id, 'full', array('') ); ?>
									</a>
									<div class="promotions__item-info info-promotion">
										<a class="info-promotion__title" href="<?php the_permalink(); ?>">
											<?php the_field('short_name'); ?>
										</a> 									
										<div class="info-promotion__descr hide-low"><?php the_excerpt(); ?></div>
										<div class="info-promotion__price"><?php echo $product->get_price(); ?>&nbsp;₽</div>
									</div>
								<?php endwhile; ?>
	
								<?php endif; ?>
                
								<?php wp_reset_query(); // Remember to reset
								?>
							</div>

							<div class="promotions__item">
							<?php  
								$presentation = ''; // Презентация на главной №1
							
								if (isset($_REQUEST['presentation'])) {
									$presentation = $_REQUEST['presentation'];
								} 
								$attribute = 'presentation';
								$value = 'presentation2'; 

								$args2 = array(
									'numberposts' => 1,
									'post_type' => 'product',					
									'meta_key'    => '',					                 
									'meta_value' => '',
									'tax_query' => array(
										array(
											'taxonomy'      => 'pa_' . $attribute,
											'terms'         => $value,
											'field'         => 'slug',
											'operator'      => 'IN'
											)
										),
									'posts_per_page' => 1,
									'suppress_filters' => true
								);
								global $product;                    
								$prod_query = new WP_Query( $args2 );
								
								if ($prod_query->have_posts()) :
								
								while ($prod_query->have_posts()) :
								
								$prod_query->the_post();
								
								$product = get_product( $prod_query->post->ID );  
								?>
								<a class="promotions__img" href="<?php the_permalink(); ?>">
									<?php echo get_the_post_thumbnail( $id, 'full', array('') ); ?>
								</a>
								<div class="promotions__item-info info-promotion">
									<a class="info-promotion__title" href="<?php the_permalink(); ?>">
										<?php the_field('short_name'); ?>
									</a>
									<div class="info-promotion__descr hide-low"><?php the_excerpt(); ?></div>
									<div class="info-promotion__price"><?php echo $product->get_price(); ?>&nbsp;₽</div>
								</div>
								<?php endwhile; ?>
	
								<?php endif; ?>
                
								<?php wp_reset_query(); // Remember to reset
								?>
							</div>

							<div class="promotions__item">

							<?php  
								$presentation = ''; // Презентация на главной №3
							
								if (isset($_REQUEST['presentation'])) {
									$presentation = $_REQUEST['presentation'];
								} 
								$attribute = 'presentation';
								$value = 'presentation3'; 

								$args3 = array(
									'numberposts' => 1,
									'post_type' => 'product',					
									'meta_key'    => '',					                 
									'meta_value' => '',
									'tax_query' => array(
										array(
											'taxonomy'      => 'pa_' . $attribute,
											'terms'         => $value,
											'field'         => 'slug',
											'operator'      => 'IN'
											)
										),
									'posts_per_page' => 1,
									'suppress_filters' => true
								);
								global $product;                    
								$prod_query = new WP_Query( $args3 );
								
								if ($prod_query->have_posts()) :
								
								while ($prod_query->have_posts()) :
								
								$prod_query->the_post();
								
								$product = get_product( $prod_query->post->ID );  
								?>

								<a class="promotions__img" href="<?php the_permalink(); ?>">
									<?php echo get_the_post_thumbnail( $id, 'full', array('') ); ?>
								</a>
								
								<div class="promotions__item-info info-promotion">
									<a class="info-promotion__title" href="<?php the_permalink(); ?>">
										<?php the_field('short_name'); ?>
									</a>
									<div class="info-promotion__descr hide-low"><?php the_excerpt(); ?></div>
									<div class="info-promotion__price"><?php echo $product->get_price(); ?>&nbsp;₽</div>
								</div>
								<?php endwhile; ?>
	
								<?php endif; ?>
                
							<?php wp_reset_query(); // Remember to reset
							?>
							</div>

							<div class="promotions__item">

							<?php  
								$presentation = ''; // Презентация на главной №1
							
								if (isset($_REQUEST['presentation'])) {
									$presentation = $_REQUEST['presentation'];
								} 
								$attribute = 'presentation';
								$value = 'presentation4'; 

								$args4 = array(
									'numberposts' => 1,
									'post_type' => 'product',					
									'meta_key'    => '',					                 
									'meta_value' => '',
									'tax_query' => array(
										array(
											'taxonomy'      => 'pa_' . $attribute,
											'terms'         => $value,
											'field'         => 'slug',
											'operator'      => 'IN'
											)
										),
									'posts_per_page' => 1,
									'suppress_filters' => true
								);
								global $product;                    
								$prod_query = new WP_Query( $args4 );
								
								if ($prod_query->have_posts()) :
								
								while ($prod_query->have_posts()) :
								
								$prod_query->the_post();
								
								$product = get_product( $prod_query->post->ID );  
								?>

								<a class="promotions__img" href="<?php the_permalink(); ?>">
									<?php echo get_the_post_thumbnail( $id, 'full', array('') ); ?>
								</a>
								
								<div class="promotions__item-info info-promotion">
									<a class="info-promotion__title" href="<?php the_permalink(); ?>">
										<?php the_field('short_name'); ?>
									</a>
									<div class="info-promotion__descr hide-low"><?php the_excerpt(); ?></div>
									<div class="info-promotion__price"><?php echo $product->get_price(); ?>&nbsp;₽</div>
								</div>
								<?php endwhile; ?>
	
								<?php endif; ?>
                
							<?php wp_reset_query(); // Remember to reset
							?>
							</div>
						</div>
					</div>
				</section>

				<!-- news -->
				<?php get_template_part('template-parts/news', 'posts'); ?>
				<!-- news end -->

				<!-- faq -->
				<?php if( get_field('faq_main_haeding') ): ?>
					<section class="main-faq faq">
						<div class="faq__container">
							<div class="faq__title section-title">
								<h2><?php the_field('faq_main_haeding');?></h2>
							</div>
							<div class="faq__body">
								<div data-spollers data-one-spoller class="faq__list js-faqAccord">
									<!-- Section -->
									<?php if( have_rows('add_faq_main') ): ?>
									<?php while( have_rows('add_faq_main') ): the_row(); 
									$faqMainQuestion = get_sub_field('faq_main_question');          
									$faqMainAnswer = get_sub_field('faq_main_answer');
									?>
										<div class="faq__item accordion-item">
											<div class="faq__item-title accordion-header faq-accord__subheading">
												<div>
													<?= $faqMainQuestion; ?>
												</div>                                        
											</div>
											
											<div class="faq__item-body">
												<p>
													<?= $faqMainAnswer; ?>
												</p>                                        
											</div>
										</div>

									<?php endwhile; ?>
									<?php endif; ?> 
								</div>
							</div>
						</div>
					</section>
				<?php endif; ?>
				<!-- faq end -->

				<!-- has question -->
				<?php get_template_part('template-parts/cta', 'block');?>
				<!-- has question end -->

				<!-- about -->
				<?php get_template_part('template-parts/about', 'block'); ?>
				<!-- about end -->

				<!-- map -->
				<?php get_template_part('template-parts/map'); ?>
				<!-- map end -->
			</div>

            <?php get_footer(); ?>
		</main>
    </div>

	
<script>
    window.addEventListener('DOMContentLoaded', function(){
		$( ".js-faqAccord" ).accordion({
            collapsible: true,      
            heightStyle: 'content',           
            header: '> .accordion-item > .accordion-header',
            animate: { easing: 'linear', duration: 400 }
        });
	});
</script>
