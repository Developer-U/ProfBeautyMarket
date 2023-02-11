<?php
/*
Template Name: Блог
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

        <!-- blog -->
        <section class="blog">
            <div class="blog__container">
                <div class="blog__title section-title">
                    <h1><?php the_title(); ?></h1>
                </div>
                <div data-tabs class="blog__body">
                    <nav data-tabs-titles class="blog__tabs">
                        <button type="button" class="blog__tab js-all" data-text="Все публикации">Все публикации</button>
                        <button type="button" class="blog__tab js-articles" data-text="Статьи">Статьи</button>
                        <button type="button" class="blog__tab js-news" data-text="Новости">Новости</button>
                        <button type="button" class="blog__tab js-bonus" data-text="Акции">Акции</button>
                    </nav>
                    <div data-tabs-body class="blog__content">
                        <div class="blog__wrap">
                            <div class="blog__list">

                            <?php
                            // параметры по умолчанию
                            $blog_posts = get_posts( array(
                                'numberposts' => -1,                            
                                'orderby'     => 'date',
                                'order'       => 'ASC',
                                'include'     => array(),
                                'exclude'     => array(),
                                'meta_key'    => '',
                                'meta_value'  =>'',
                                'post_type'   => 'articles',
                                'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                            ) );

                            global $post; ?>

                            <?php if( $blog_posts) { ?>
                            <?php foreach( $blog_posts as $post ){
                                setup_postdata( $post );
                            ?>
                                <div class="blog__item blog-item" data-article="<?php the_field('article_type'); ?>">
                                    <a href="<?php the_permalink(); ?>" class="blog-item__title"><?php the_title(); ?></a>
                                    <!-- <div class="blog-item__info">
                                        <div class="blog-item__author"> Автор: <?php the_field('article_author'); ?></div>
                                    </div> -->
                                    <div class="blog-item__img">
                                        <?php echo get_the_post_thumbnail( $id, 'full' ); ?>
                                    </div>
                                    <div class="blog-item__text">
                                        <?php the_excerpt(); ?> 
                                    </div>
                                </div>

                                <?php }
                            } else { ?>
                                <p class="news__subheading">Посты не добавлены</p>
                            <?php }                  
                            
                            wp_reset_postdata(); // сброс
                            ?>
                            </div>
                            <!-- <div class="pagging">
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
                            </div> -->
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>
        <!-- blog end -->

        <script>
            window.addEventListener('DOMContentLoaded', function(){

            // Функционал открытия нужных публикаций в Блоге и пагинации вкладок

            // Зададим переменные кнопок и статей

            var allArt = document.querySelector('.js-all') // Кнопка все публикации
            ,articlesArt = document.querySelector('.js-articles') // Кнопка статьи
            ,newsArt = document.querySelector('.js-news') // Кнопка новости
            ,actionsArt = document.querySelector('.js-bonus') // Кнопка акции
            ,postArticle = document.querySelectorAll(`[data-article]`) // Все публикации
            ,postMoreBtn = document.querySelector('.js-postMore'); // Кнопка добавить публикации (все)
            
            allArt.classList.add('_tab-active');

            // Все кнопки фильтрации
            var allBtnsFilt = document.querySelectorAll('.blog__tab');

            // Все статьи 
            var allArticles = document.querySelectorAll(`[data-article='Статья'] `);
            
            // Все новости
            var allNews = document.querySelectorAll(`[data-article='Новость'] `);

            // Все акции
            var allActions = document.querySelectorAll(`[data-article='Акция'] `);

            // Применяем функцию filers - фильтрация вкладок в самом начале
            filers();

            function filers() { // Объявляем функцию фильтрации вкладок

                // Открытие статей
                articlesArt.addEventListener('click', function(e){
                    e.preventDefault();

                    allBtnsFilt.forEach(function(everyBtnFilt){
                        everyBtnFilt.classList.remove('_tab-active');
                    });

                    articlesArt.classList.add('_tab-active');

                    allNews.forEach(function(eachNews){  //Отключаем новости       
                        eachNews.style.display = 'none';                        
                    });
                    
                    allActions.forEach(function(eachAction){  //Отключаем акции
                        eachAction.style.display = 'none';
                    });

                    allArticles.forEach(function(eachArticle){  //Включаем статьи
                        eachArticle.style.display = 'block';
                    });               
                    
                    // Зададим в переменную кнопки на всех табах и отключим все кнопки "добавить ещё..."
                    var btns = document.querySelectorAll('.button-for-more');
                    btns.forEach(function(allBtns){
                        allBtns.style.display = 'none';
                    });

                    var articlesMoreBtn = document.createElement('button'); // Создаём кнопку Добавить статьи           

                    articlesMoreBtn.classList.add('button-for-more'); // Присваиваем её стили

                    articlesMoreBtn.innerText = 'Больше статей';  // Задаём ей текст

                    var CurrentArticles = document.querySelector('[data-article="Статья"]'); // Все статьи

                    var articlesCont = document.querySelector('.blog__wrap');  // Обратимся к родителю статей

                    if(allArticles.length > 4) {  // Добавляем кнопку, если статей больше 4
                        articlesCont.append(articlesMoreBtn);
                    }

                    for(let i=4; i<allArticles.length; i++) {
                        allArticles[i].style.display = 'none'; // Скрывааем все статьи, что больше i=4                
                    }   

                    var countD = 4; //Установим счётчик 
            
                    articlesMoreBtn.addEventListener('click', function(){
                
                        countD += 1;

                        if(countD <= allArticles.length) {
                            for(let i=0; i<countD; i++) {
                                allArticles[i].style.display = 'block'; // При клике на кнопку добавляем статьи по одной
                            }
                            
                            // console.log(countD);
                            // console.log(allArticles);

                            // Когда число добавляемых статей равняется всему числу статей, скрываем кнопку
                            if(countD == allArticles.length) {
                                articlesMoreBtn.style.display = 'none';
                            }

                            filers();
                        }
                    }); 
                    
                    document.querySelectorAll('.blog__tab').forEach(function(eachLink){
                        eachLink.classList.remove('_tab-active');
                    });

                    articlesArt.classList.add('_tab-active');
                });


                // Открытие Новостей
                newsArt.addEventListener('click', function(e){
                    e.preventDefault();
                    
                    allBtnsFilt.forEach(function(everyBtnFilt){
                        everyBtnFilt.classList.remove('_tab-active');
                    });

                    newsArt.classList.add('_tab-active');

                    allArticles.forEach(function(eachArticle2){
                        eachArticle2.style.display = 'none';
                    });

                    allActions.forEach(function(eachAction2){
                        eachAction2.style.display = 'none';
                    });

                    allNews.forEach(function(eachNews2){         
                        eachNews2.style.display = 'block';                    
                    });

                    var btns = document.querySelectorAll('.button-for-more');
                    btns.forEach(function(allBtns){
                        allBtns.style.display = 'none';
                    });                       
                    
                    var newsMoreBtn = document.createElement('button');            

                    newsMoreBtn.classList.add('button-for-more');

                    newsMoreBtn.innerText = 'Больше новостей';

                    var CurrentNews = document.querySelector('[data-article="Новость"]');

                    var newsCont = document.querySelector('.blog__wrap');  
                    
                    if(allNews.length > 4) {                
                        newsCont.append(newsMoreBtn);
                    }
                    
                    for(let i=4; i<allNews.length; i++) {
                        allNews[i].style.display = 'none';
                    }            

                    var countD = 4; //Установим счётчик 
            
                    newsMoreBtn.addEventListener('click', function(){
                
                        countD += 1;

                        if(countD <= allNews.length) {
                            for(let i=0; i<countD; i++) {
                                allNews[i].style.display = 'block';
                            } 

                            if(countD == allNews.length) {
                                newsMoreBtn.style.display = 'none';
                            }

                            filers();
                        }
                    }); 
                    
                    document.querySelectorAll('.blog__tab').forEach(function(eachLink2){
                        eachLink2.classList.remove('_tab-active');
                    });

                    this.classList.add('_tab-active');
                });


                // Открытие Акций
                actionsArt.addEventListener('click', function(e){
                    e.preventDefault();
                    
                    allBtnsFilt.forEach(function(everyBtnFilt){
                        everyBtnFilt.classList.remove('_tab-active');
                    });

                    actionsArt.classList.add('_tab-active');        
                    

                    allArticles.forEach(function(eachArticle3){
                        eachArticle3.style.display = 'none';
                    });

                    allNews.forEach(function(eachNews3){
                        eachNews3.style.display = 'none';
                    });

                    allActions.forEach(function(eachAction3){         
                        eachAction3.style.display = 'block';                      
                    });           

                    var btns = document.querySelectorAll('.button-for-more');
                    btns.forEach(function(allBtns){
                        allBtns.style.display = 'none';
                    });

                    var actionsMoreBtn = document.createElement('button');            

                    actionsMoreBtn.classList.add('button-for-more');

                    actionsMoreBtn.innerText = 'Больше акций';

                    var actionsCurrent = document.querySelector('[data-article="Акция"]');

                    var actionsCont = document.querySelector('.blog__wrap');  

                    if(allActions.length > 4) {                
                        actionsCont.append(actionsMoreBtn);
                    }

                    for(let i=4; i<allActions.length; i++) {
                        allActions[i].style.display = 'none'; 
                    }   

                    var countD = 4; //Установим счётчик 
            
                    actionsMoreBtn.addEventListener('click', function(){
                
                        countD += 1;

                        if(countD <= allActions.length) {
                            for(let i=0; i<countD; i++) {
                                allActions[i].style.display = 'block';
                            }
                            
                            if(countD == allActions.length) {
                                actionsMoreBtn.style.display = 'none';
                            }

                            filers();
                        }
                    });               
                    
                    
                    document.querySelectorAll('.blog__tab').forEach(function(eachLink3){
                        eachLink3.classList.remove('_tab-active');
                    });

                    this.classList.add('_tab-active');           
                    
                });

                // Открытие всех публикаций
                allArt.addEventListener('click', function(e){
                    e.preventDefault(); 
                    
                    allBtnsFilt.forEach(function(everyBtnFilt){
                        everyBtnFilt.classList.remove('_tab-active');
                    });

                    allArt.classList.add('_tab-active');

                    allArticles.forEach(function(eachArticle){  
                        eachArticle.style.display = 'block';                  
                    });
                        
                    allNews.forEach(function(eachNews2){         
                        eachNews2.style.display = 'block';                  
                    });

                    allActions.forEach(function(eachAction3){         
                        eachAction3.style.display = 'block';                       
                    });            
                                
                    addFilters();
                    
                    document.querySelectorAll('.blog__tab').forEach(function(eachLink3){
                        eachLink3.classList.remove('_tab-active');
                    });

                    this.classList.add('_tab-active');        
                });
            }  
            
            
            // Добавление Блоков статей (все публикации)

            addFilters();

            function addFilters() {
                var btns = document.querySelectorAll('.button-for-more');
                btns.forEach(function(allBtns){
                    allBtns.style.display = 'none';
                });

                var postsMoreBtn = document.createElement('button');            

                postsMoreBtn.classList.add('button-for-more');

                postsMoreBtn.innerText = 'Больше публикаций';

                var postsCurrent = document.querySelector('[data-article]');

                var postsCont = document.querySelector('.blog__wrap');  

                if(postArticle.length > 4) {                
                    postsCont.append(postsMoreBtn);
                }

                for(let i=4; i<postArticle.length; i++) {
                    postArticle[i].style.display = 'none';             
                }

                var countD = 4; //Установим счётчик - при клике на кнопку будет добавляться ещё 1 блок отзывов
                postsMoreBtn.addEventListener('click', function(){        
                    countD += 1;

                    if(countD <= postArticle.length) {
                        for(let i=0; i<countD; i++) {
                            postArticle[i].style.display = 'block';

                       

                            if(countD == postArticle.length) {
                                postsMoreBtn.style.display = 'none';
                            }
                        } 
                    }            
                }); 
            }
        });    
        </script>

        <?php get_footer(); ?>
    </main>
</div>