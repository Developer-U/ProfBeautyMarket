<?php
/*
Template Name: Вопрос-ответ
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

        <!-- faq -->
        <section class="page-faq faq">
            <div class="faq__container">
                <div class="faq__title section-title">
                    <h2><?php the_title(); ?></h2>
                </div>
                <div class="faq__body">
                    <div class="faq__row">
                        <div data-spollers data-one-spoller class="faq__list js-faqAccord">
                            <!-- Section -->
                            <?php if( have_rows('add_faq_page') ): ?>
                            <?php while( have_rows('add_faq_page') ): the_row(); 
                            $faqPageQuestion = get_sub_field('faq_page_question');          
                            $faqPageAnswer = get_sub_field('faq_page_answer');
                            ?>

                                <div class="faq__item accordion-item">
                                    <div class="faq__item-title accordion-header faq-accord__subheading">
                                        <div>
                                            <?= $faqPageQuestion; ?>
                                        </div>                                        
                                    </div>
                                    
                                    <div class="faq__item-body">
                                        <p>
                                            <?= $faqPageAnswer; ?>
                                        </p>                                        
                                    </div>
                                </div>

                            <?php endwhile; ?>
                            <?php endif; ?> 
                        </div>
                        <div class="faq__col">
                            <div class="faq__form">
                                <div class="faq__form-title">Уважаемый посетитель!</div>
                                <div class="faq__form-text">
                                    Если у Вас еще остались вопросы, можете задать их через форму обратной связи.
                                    Мы ответим на указанный e-mail.
                                </div>

                                <div class="form">
                                    <?php echo do_shortcode('[contact-form-7 id="131" title="Задать вопрос"]'); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- faq end -->

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