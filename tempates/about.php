<?php
/*
Template Name: О компании
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

        <!-- first-screen -->        
        <section class="main-about about">
            <div class="about__container">
                <div class="about__title section-title">
                    <h1><?php the_title(); ?></h1>
                </div>
                <div class="about__body">
                    <div class="about__col">
                        <?php the_field('about_page_left'); ?>
                    </div>
                    <div class="about__img">
                        <?php
                        $aboutPageImg = get_field('about_page_image'); ?>
                        <img src="<?php echo esc_url($aboutPageImg['url']); ?>" alt="<?php echo esc_attr($aboutPageImg['alt']); ?>">
                    </div>
                    <div class="about__col">
                        <?php the_field('about_page_right'); ?>
                    </div>
                </div>
            </div>
        </section>       
        <!-- first-screen end-->

        <!-- advantages -->
        <?php get_template_part('template-parts/advantages'); ?>
        <!-- advantages end -->

        <!-- owner-speach -->
        <?php if( get_field('speach_heading') ): ?>
            <section class="main-about about speach">
                <div class="about__container">
                    <div class="about__title section-title">
                        <h2><?php the_field('speach_heading'); ?></h2>
                    </div>
                    <div class="about__body">
                        <div class="about__col">
                            <?php the_field('speach_left'); ?>
                        </div>
                        <div class="about__img">
                            <?php
                            $aboutPageImg = get_field('speach_image'); ?>
                            <img src="<?php echo esc_url($aboutPageImg['url']); ?>" alt="<?php echo esc_attr($aboutPageImg['alt']); ?>">
                        </div>
                        <div class="about__col">
                            <?php the_field('speach_right'); ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <!-- owner-speach-end -->

        <!-- map -->
        <?php get_template_part('template-parts/map'); ?>
            <!-- map end -->
        </div>

        <?php get_footer(); ?>
    </main>
</div>