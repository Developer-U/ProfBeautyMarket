<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package estore
 */
defined( 'ABSPATH' ) || exit;


?>

<article id="post-<?php the_ID(); ?>" class="products-collection__item product-item">
	<?php	
	
	// $post = get_post( $post );
	 		
	if ( $post->post_type === 'product' ): 

		wc_get_template_part( 'content', 'product' ); ?>
		
	<?php else: ?>

		<div class="like-news__item">
			<div class="like-news__item-img">
				<?php echo get_the_post_thumbnail( $id, 'full' ); ?>
			</div>
			<div class="like-news__item-body">
				<div class="like-news__item-date"><?php the_date(); ?></div>
				<a href="<?php the_permalink(); ?>" class="like-news__item-title"><?php the_title(); ?></a>
				<div class="like-news__item-text"><?php the_excerpt(); ?></div>
				<a href="<?php the_permalink(); ?>" class="search-mare btn-purple">Подробнее</a>
			</div>
		</div>

	<?php endif; ?>
		
	
</article><!-- #post-<?php the_ID(); ?> -->
