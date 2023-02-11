<?php
/*
Template Name: Вакансии
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

        <!-- vacancies -->
        <section class="vacancies">
            <div class="vacancies__container">
                <div class="vacancies__title section-title">
                    <h1><?php the_title(); ?></h1>
                </div>
                <div class="vacancies__body">
                    <?php if( have_rows('add_new_department') ): ?>
                    <?php while( have_rows('add_new_department') ): the_row();
                        $departmentName = get_sub_field('department_name');         
                    ?>

                        <div class="vacancies__department">
                            <div class="vacancies__department-title"><?= $departmentName; ?></div>
                            <div data-spollers data-one-spoller class="vacancies__list js-faqAccord">

                            <?php if( have_rows('add_new_vacancy') ): ?>
                            <?php while( have_rows('add_new_vacancy') ): the_row();
                                $vacancy_type = get_sub_field('vacancy_name');  
                                $vacancyDescr = get_sub_field('vacancy_descr');       
                            ?>

                                <div data-spoller-wrap class="vacancies__item vacancies-item accordion-item">
                                    <button type="button" data-spoller class="vacancies-item__title accordion-header">
                                        <div>
                                            <?= $vacancy_type; ?>
                                        </div>
                                        <svg>
                                            <use xlink:href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/icons/icons.svg#svg-arrow-down"></use>
                                        </svg>
                                    </button>                                    

                                    <div class="vacancies-item__body" hidden>
                                        <div class="vacancies-item__text">
                                            <p>
                                                <?= $vacancyDescr; ?>
                                            </p>
                                        </div>
                                        <button type="button" data-name="<?= $vacancy_type; ?>" data-popup-open="popup-vacancy" class="vacancies-item__button btn-purple-fill">откликнуться</button>
                                    </div>
                                </div>

                            <?php endwhile; ?>
                            <?php endif; ?>
                                
                            </div>
                        </div>
                    
                    <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <!-- vacancies end -->

        <?php get_footer(); ?>
    </main>
</div>

<script>
    window.addEventListener('DOMContentLoaded', function(){
		$( ".js-faqAccord" ).accordion({
            collapsible: true,      
            heightStyle: 'content',
            active: false,           
            header: '> .accordion-item > .accordion-header',
            animate: { easing: 'linear', duration: 400 }
        });

        var vacantForm = document.querySelector('.vacancyFormFor form');                  
        vacantForm.classList.add('vacForm'); 
        

        $(function() {
        // Открытие / закрытие попапов
        //----- OPEN
            $('[data-popup-open]').on('click', function(e) {
                var targeted_popup_class = jQuery(this).attr('data-popup-open');
                $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);

                // При открытии попапа по вакансиям присвоим название нужной вакансии
                let popups = $('.popup__content'); // все попапы
                popups.each(function(){
                    let text = jQuery(this).find('.popup__title'); // добираемся до названия       
                    let vacancy_type = $(e.target).data('name'); // вычисляем название теккущей вакансии
                    let newtext = 'Откликнуться на вакансию <br>' + vacancy_type; //Добавляем в название       
                    text.html(newtext);                    
                });          
                

                let vacancy_type = $(e.target).data('name'); // вычисляем название теккущей вакансии
                $('.vacForm').on('submit', function(e) {
                    e.preventDefault();

                    // Получаем значение поля Имя клиента из формы Сontact Form7
                    var vacancy_client_name = document.querySelector('#vacancy_client_name');
                    var vacancy_name = vacancy_client_name.value;

                    // Получаем значение поля Телефон клиента из формы Сontact Form7
                    var vacancy_client_phone_field = document.querySelector('#vacancy_client_phone');
                    var vacancy_client_phone = vacancy_client_phone_field.value;                        

                    // Получаем значение поля Телефон клиента из формы Сontact Form7
                    var vacancy_file_field = document.querySelector('#field__file-2');
                    var vacancy_file = vacancy_file_field.value;                        

                    let data = {
                        vacancy_name,
                        vacancy_client_phone,
                        vacancy_type,
                        vacancy_file,
                        action: 'vacancy-ajax'            
                    }

                    $.ajax({
                        url: '/wp-content/themes/e-store/vacancy-post.php',
                        method: 'post',
                        dataType: 'json',
                        data: data,
                        success: function(data){
                        console.log(data);
                        }
                    });
                });
                
                e.preventDefault();
            });

            //----- CLOSE
            $('[data-popup-close]').on('click', function(e) {
                var targeted_popup_class = jQuery(this).attr('data-popup-close');
                $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);

                e.preventDefault();
            }); 


        });
        

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
                   
	});
</script>