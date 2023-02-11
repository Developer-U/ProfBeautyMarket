<?php
/*
*
*/
?>

    <!-- has question -->
    <?php if(get_field('cta_head', 'options') ): ?>
        <section class="has-question">
            <div class="has-question__container">
                <div class="has-question__body">
                    <div class="has-question__icon">
                        <svg>
                            <use xlink:href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/icons/icons.svg#svg-has-question"></use>
                        </svg>
                    </div>
                    <div class="has-question__col">
                        <h2 class="has-question__title"><?php the_field('cta_head', 'options'); ?></h2>
                        <div class="has-question__text"><?php the_field('cta_text', 'options'); ?></div>
                    </div>
                    <div id="ctaForm" class="has-question__form">
                        <?php echo do_shortcode('[contact-form-7 id="152" title="Форма подписки"]'); ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- has question end -->
    <? endif; 