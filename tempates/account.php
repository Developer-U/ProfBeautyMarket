<?php
/*
Template Name: Личный кабинет
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

        <!-- account-enter -->
        <section class="account-enter">
            <div class="account-enter__container">
                <div class="account-enter__title section-title">
                    <h1><?php the_title(); ?></h1>
                </div>

                <?php do_action( 'woocommerce_before_customer_login_form' ); ?>
			    <?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>
                
                    <div class="account-enter__body">
                        <div class="account-enter__col">
                            <div id="customer_login" class="account-enter__form">
                                <div class="account-enter__form-title">Если вы ранее уже регистрировались на сайте</div>
                                <div class="account-enter__form-title">Вход по Email или Имени пользователя</div>
                                <?php wc_get_template('/includes/parts/wc-form-login.php'); ?>
                            </div>
                        </div>
                        
                        <div class="account-enter__col">
                            <div class="account-enter__form">
                                <div class="account-enter__form-title">Если вы впервые на сайте
                                    пройдите регистрацию
                                </div>
                                
                                <div class="form__tabs">
                                    <button type="button" class="form__tab" data-text="По телефону" data-path="tel">По телефону</button>
                                    <button type="button" class="form__tab" data-text="По email" data-path="email">По email</button>
                                </div>                            
                                
                                <article class="form-register" data-target="tel">
                                    <?php wc_get_template('/includes/parts/wc-form-register.php'); ?> 
                                </article>

                                <article class="form-register" data-target="email">                                
                                    <?php wc_get_template('/includes/parts/wc-form-register-email.php'); ?>
                                </article>                            
                            </div>
                        </div>
                    </div>

                <?php endif; ?>
                <?php do_action( 'woocommerce_after_customer_login_form' ); ?>  
            </div>
        </section>
        <!-- account-enter end -->

        <?php get_footer(); ?>
    </main>
</div>

<script>
    window.addEventListener('DOMContentLoaded', function(){
        
        // Проитерируем кнопки выбора табов
        document.querySelectorAll('.form__tab').forEach(function(tabsBtn){
            tabsBtn.addEventListener('click', function(event){
            event.preventDefault();           

            // Зададим константу атрибута data-path у кнопок
            const path = event.currentTarget.dataset.path;            

            // Проитерируем все ссылки и при клике снимем все активные значения
            document.querySelectorAll('.form__tab').forEach(function(oneTab){
                oneTab.classList.remove('_active');
                
            });

            // Соответствующей кнопке зададим активное значение
            document.querySelector(`[data-path='${path}']`).classList.add('_active');     
                

            // Итерируем табы и закрываем все открытые табы
            document.querySelectorAll('.form-register').forEach(function(tabContent){
                tabContent.classList.remove('_active');

                // Зададим в переменную первый Таб (в стилях делаем первый элемент открытым)        
                var firstPriceTab = document.querySelector('.form-register:first-of-type');

                // Соответственно при клике на любую кнопку его сразу закрываем
                firstPriceTab.style.display = 'none';

                // Закинем в переменную текущий Таб с соответствующим атрибутом data-target       
                var currentTab = document.querySelector(`[data-target="${path}"]`);

                // console.log(currentTab.getAttribute('data-target') );

                // console.log(firstPriceTab.getAttribute('data-target') );

                // Зададим условие: если атрибут data-target текущего таба соответствует первому Табу, то есть
                // если это и есть первый Таб, открываем его, если нет - держим закрытым и открываем соответствующий
                if(currentTab.getAttribute('data-target') == firstPriceTab.getAttribute('data-target')) {
                firstPriceTab.style.display = 'block';
                } else {
                firstPriceTab.style.display = 'none';

                currentTab.classList.add('_active');
                }

            });

                

                
            });

        });
    });
</script>