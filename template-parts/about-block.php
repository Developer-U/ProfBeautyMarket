<?php
/**
 * Блок О компании
 * 
 */
?>

<?php if( get_field('about_heading', 'options') ): ?>
    <section class="main-about about">
        <div class="about__container">
            <div class="about__title section-title">
                <h2><?php the_field('about_heading', 'options'); ?></h2>
            </div>
            <div class="about__body">
                <div class="about__col">
                    <?php the_field('about_left', 'options'); ?>
                </div>
                <div class="about__img">
                    <?php
                    $aboutImg = get_field('about_image', 'options'); ?>
                    <img src="<?php echo esc_url($aboutImg['url']); ?>" alt="<?php echo esc_attr($aboutImg['alt']); ?>">
                </div>
                <div class="about__col">
                    <?php the_field('about_right', 'options'); ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>