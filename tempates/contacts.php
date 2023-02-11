<?php
/*
Template Name: Контакты
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

        <!-- contacts -->
        <section class="contacts">
            <div class="contacts__container">
                <div class="contacts__title section-title">
                    <h1><?php the_title(); ?></h1>
                </div>
                <div class="contacts__body">
                    <div class="contacts__text">
                        <?php the_field('contacts_page_descr'); ?>
                    </div>
                    <div class="contacts__items">
                        <div class="contacts__item">
                            <div class="contacts__item-title">Линия консультаций</div>
                            <div class="contacts__item-text">
                                <?php the_field('contacts_page_cons_line'); ?>
                            </div>
                        </div>
                        <?php if( get_field('mail', 'options') ): ?>
                            <div class="contacts__item">
                                <div class="contacts__item-title">E-mail</div>
                                <div class="contacts__item-text"><a href="mailto:<?php the_field('mail', 'options'); ?>"><?php the_field('mail', 'options'); ?></a></div>
                            </div>
                        <?php endif; ?>

                        <?php if( get_field('vk_link', 'options') || get_field('telegram_link', 'options') || get_field('insta_link', 'options') ): ?>
                            <div class="contacts__item">
                                <div class="contacts__item-title">Наши страницы в соцсетях</div>

                                <div class="contacts__socials">
                                    <?php if( get_field('vk_link', 'options') ): ?>
                                        <a href="<?php the_field('vk_link', 'options'); ?>" class="contacts__socials-item socials-item">
                                            <svg class="footer-top__icon">
                                                <use xlink:href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/icons/icons.svg#svg-vk2"></use>                                                   
                                            </svg>
                                        </a>
                                    <?php endif; ?>
                                    
                                    <?php if( get_field('telegram_link', 'options') ): ?>
                                        <a href="https://t.me/<?php the_field('telegram_link', 'options'); ?>" class="contacts__socials-item socials-item">
                                            <svg>
                                                <use xlink:href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/icons/icons.svg#svg-telegram"></use>                                                   
                                            </svg>
                                        </a>
                                    <?php endif; ?>

                                    <?php if( get_field('insta_link', 'options') ): ?>
                                        <a href="<?php the_field('insta_link', 'options'); ?>" class="contacts__socials-item socials-item">
                                            <svg class="footer-top__icon">
                                                <use xlink:href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/icons/icons.svg#svg-insta2"></use>                                                   
                                            </svg>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if( get_field('phone_num_contacts1', 'options') || get_field('phone_num_contacts2', 'options') ): ?>
                            <div class="contacts__item">
                                <div class="contacts__item-title">Телефоны</div>
                                <div class="contacts__item-text">
                                    <p><a href="tel:<?php the_field('phone_link_contacts1', 'options'); ?>" ><?php the_field('phone_num_contacts1', 'options'); ?></a> <?php the_field('call_time_contacts1', 'options'); ?></p>
                                    <p><?php the_field('call_descr_contacts1', 'options'); ?></p>

                                    <p><a href="tel:<?php the_field('phone_link_contacts2', 'options'); ?>" ><?php the_field('phone_num_contacts2', 'options'); ?></a> <?php the_field('call_time_contacts2', 'options'); ?></p>
                                    <p><?php the_field('call_descr_contacts2', 'options'); ?></p>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if( get_field('contacts_page_zakupki') ): ?>
                            <div class="contacts__item">
                                <div class="contacts__item-title">Закупки</div>
                                <div class="contacts__item-text">
                                    <?php the_field('contacts_page_zakupki'); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="contacts__item">
                            <div class="contacts__item-title">Оставить заявку на консультацию</div>

                            <div class="contacts__form form">
                                <?php echo do_shortcode('[contact-form-7 id="131" title="Задать вопрос"]'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- contacts end -->

        <!-- map -->
				<?php get_template_part('template-parts/map'); ?>
				<!-- map end -->
			</div>

            <?php get_footer(); ?>
		</main>
    </div>