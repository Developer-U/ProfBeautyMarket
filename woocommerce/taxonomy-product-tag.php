<?php
/**
 * The Template for displaying products in a product tag. Simply includes the archive template
 *
 * E-store theme
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     4.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
?>

    <body class="transition_disabled">
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

                    <?php wc_get_template( 'archive-product.php' ); ?>
                </div>

                <div class="favorites__body">
                    <a href="/shop" class="favorites__button btn-purple">ПЕРЕЙТИ В КАТАЛОГ ТОВАРОВ</a>
                </div>

                <?php get_footer(); ?>
            </main>
        </div>
    </body>