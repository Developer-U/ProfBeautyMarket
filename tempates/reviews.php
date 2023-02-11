<?php
/*
Template Name: Отзывы
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


        <!-- reviews -->
        <section class="reviews">
            <div class="reviews__container">
                <div class="reviews__title section-title">
                    <h1><?php the_title(); ?></h1>
                </div>
                <div class="reviews__body">
                    <div class="reviews__content">
                        <ul class="reviews__list">

                        <?php if( have_rows('add_new_review_page') ): ?>
                        <?php while( have_rows('add_new_review_page') ): the_row();
                            $reviewPhoto = get_sub_field('review_photo');   
                            $reviewDate = get_sub_field('review_date'); 
                            $reviewRating = get_sub_field('review_rating'); 
                            $reviewName = get_sub_field('review_name');      
                            $reviewText = get_sub_field('review_text'); 
                            $expertPhoto = get_sub_field('expert_photo');    
                            $expertName = get_sub_field('expert_name');  
                            $expertText = get_sub_field('expert_text');                                                 
                        ?>

                            <li class="reviews__item">
                                <article class="review">
                                    <div class="review__wrap">
                                        <div class="review__right">
                                            <div class="review__avatar">                                                
                                                <img src="<?php echo esc_url($reviewPhoto['url']); ?>" alt="<?php echo esc_attr($reviewPhoto['alt']); ?>">
                                            </div>
                                            <div class="review__info">
                                                <div class="review__date"><?= $reviewDate; ?></div>
                                                <div class="review__name"><?= $reviewName; ?></div>
                                                <div class="review__rating rating">
                                                    <?= $reviewRating; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="review__text">
                                            <?= $reviewText;?>
                                            <div class="review__images">
                                                <div class="review__img">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>

                                <?php if( !empty($expertText) ): ?>
                                    <ul class="reviews__children">
                                        <li class="reviews__item">
                                            <article class="review">
                                                <div class="review__top">
                                                    <div class="review__avatar">
                                                        <img src="<?php echo esc_url($expertPhoto['url']); ?>" alt="<?php echo esc_attr($expertPhoto['alt']); ?>">
                                                    </div>
                                                    <div class="review__info">
                                                        <div class="review__name"><?= $expertName; ?></div>
                                                    </div>
                                                </div>
                                                <div class="review__text">
                                                    <? $expertText; ?>
                                                </div>
                                            </article>
                                        </li>
                                    </ul>
                                <?php endif; ?>
                            </li>
                            
                            <?php endwhile; ?>
                            <?php endif; ?>  
                        </ul>
                        <div class="reviews__pagging pagging">
                            <ul class="pagging__list">
                                <li class="pagging__item">
                                    <a href="" class="pagging__link">1</a>
                                </li>
                                <li class="pagging__item">
                                    <a href="" class="pagging__link">2</a>
                                </li>
                                <li class="pagging__item">
                                    <a href="" class="pagging__link">3</a>
                                </li>
                                <li class="pagging__item">
                                    <a href="" class="pagging__link _active">4</a>
                                </li>
                                <li class="pagging__item">
                                    <a href="" class="pagging__link">5</a>
                                </li>
                                <li class="pagging__item">
                                    <a href="" class="pagging__link">...</a>
                                </li>
                                <li class="pagging__item">
                                    <a href="" class="pagging__link">8</a>
                                </li>
                                <li class="pagging__item">
                                    <a href="" class="pagging__link">9</a>
                                </li>
                                <li class="pagging__item">
                                    <a href="" class="pagging__link">10</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="reviews__col">
                        <div class="reviews__col-title"><?php the_field('ploshadka-heading', 'options'); ?></div>
                        <div class="reviews__sites">

                            <?php if( have_rows('add_new_ploshadka_item', 'options') ): ?>
                            <?php while( have_rows('add_new_ploshadka_item', 'options') ): the_row();
                                $ploshadkaLogo = get_sub_field('ploshadka_logo', 'options');   
                                $ploshadkaName = get_sub_field('ploshadka_name', 'options'); 
                                $ploshadkaLink = get_sub_field('ploshadka_link', 'options'); 
                            ?>

                                <a href="<?= $ploshadkaLink; ?>" class="reviews__sites-item">
                                    <div class="reviews__sites-img">
                                        <img src="<?php echo esc_url($ploshadkaLogo['url']); ?>" alt="<?php echo esc_attr($ploshadkaLogo['alt']); ?>">
                                    </div>
                                    <span><?= $ploshadkaName; ?></span>
                                </a>

                            <?php endwhile; ?>
                            <?php endif; ?> 
                            
                        </div>
                        <div class="reviews__form">
                            <div class="reviews__form-title">Уважаемый посетитель</div>
                            <div class="reviews__form-text">
                                Если у Вас еще остались вопросы, можете задать их через форму обратной связи.
                                Мы ответим на указанный e-mail.
                            </div>

                            <div id="revCtaForForm" class="form">
                                <?php echo do_shortcode('[contact-form-7 id="403" title="Оставить отзыв"]'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- reviews end -->

        <?php get_footer(); ?>
    </main>
</div>

<script>
    window.addEventListener('DOMContentLoaded', function(){ 
       // Присвоим форме ID
       var reviewsForm = document.querySelector('#revCtaForForm form');
        reviewsForm.setAttribute('id','reviewsForm');

        const reviewsFormFor = document.querySelector('#revCtaForForm');            
       
        // Функционал прикрепить файл input file

        let fields = document.querySelectorAll('.field__file');
        // console.log(fields);
        Array.prototype.forEach.call(fields, function (input) {
        let label = input.nextElementSibling,
            labelVal = document.querySelector('.field__file-fake').innerText;                
    
            input.addEventListener('change', function (e) {
                let countFiles = '';
                if (this.files && this.files.length >= 1)
                countFiles = this.files.length;
        
                if (countFiles) {
                    document.querySelector('.field__file-fake').innerText = 'Файл прикреплён';
                    document.querySelector('.field__file-fake').classList.add('field__file-fake-get');
                    document.querySelector('.field__file-button').classList.add('field__file-button-get');
                }  else {
                    document.querySelector('.field__file-fake').innerText = labelVal;
                }
                
            });
        });
          

        // Аякс отправки данных в админку
        $('#reviewsForm').on('submit', function(e) {
            e.preventDefault();

            // Получаем значение поля Имя клиента из формы Сontact Form7
            var reviews_client_name = document.querySelector('#client_review_name');
            var reviews_name = reviews_client_name.value;           
            
            // Получаем значение поля Текст отзыва из формы Сontact Form7
            var reviews_text_field = document.querySelector('#client_review_text');
            var reviews_text = reviews_text_field.value; 

            // Получаем значение поля Email клиента из формы Сontact Form7
            var reviews_email_field = document.querySelector('#client_review_email');
            var reviews_email = reviews_email_field.value;                        

            let data = {
                reviews_name,               
                reviews_text,               
                reviews_email,
                action: 'reviews-ajax'            
            }

            $.ajax({
                url: '/wp-content/themes/e-store/reviews-post.php',
                method: 'post',
                dataType: 'json',
                data: data,
                success: function(data){
                console.log(data);
                }
            });
        });
        
    });
</script>