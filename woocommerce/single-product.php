<?php
/**
 * The Template for displaying all single products
 *

 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

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

				<div class="product-card">
					<?php
						/**
						 * woocommerce_before_main_content hook.
						 *
						 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
						 * @hooked woocommerce_breadcrumb - 20
						 */
						do_action( 'woocommerce_before_main_content' );
					?>

					<?php while ( have_posts() ) : the_post(); ?>							
							<?php wc_get_template_part( 'content', 'single-product' ); ?>
					<?php endwhile; // end of the loop. ?>
				</div>

					<?php
						/**
						 * woocommerce_after_main_content hook.
						 *
						 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
						 */
						do_action( 'woocommerce_after_main_content' );
					?>

					
				</div>
			
        </main>
	</div>


