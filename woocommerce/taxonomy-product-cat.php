<?php
/**
 * The Template for displaying products in a product category. Simply includes the archive template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/taxonomy-product-cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
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
            </main>
        </div>
    </body>


