window.addEventListener('DOMContentLoaded', function(){ 

    document.querySelectorAll('.js-scroll').forEach(el => {
      new SimpleBar(el), {
        autoHide: false,
        scrollbarMaxSize: 300
      }
    });
    
    const swiperMain = new Swiper('.main-slider__container', {      
      slidesPerView: 1,
      spaceBetween: 10,
      initialSlide: 3,
      // autoplay:true,
      speed: 1000,
      loop: true,      
      pagination: {
          el: ".main-slider__pagination",
          clickable: true
      }           
           
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
    

    
    let addWindowScrollEvent = false;
    setTimeout((() => {
        if (addWindowScrollEvent) {
            let windowScroll = new Event("windowScroll");
            window.addEventListener("scroll", (function(e) {
                document.dispatchEvent(windowScroll);
            }));
        }
    }), 0);
    window.onload = function() {
        if (document.body.classList.contains("transition_disabled")) document.body.classList.remove("transition_disabled");
    };
    document.addEventListener("click", clickDocument);
    function clickDocument(e) {
        const el = e.target;
        if (el.classList.contains("icon-menu")) document.documentElement.classList.toggle("menu-open");
        if (el.closest(".menu__close")) document.documentElement.classList.remove("menu-open");
        if (!el.closest(".search-header")) {
            if (document.querySelector(".search-header").classList.contains("_active")) document.querySelector(".search-header").classList.remove("_active");
            if (document.documentElement.classList.contains("search-open")) document.documentElement.classList.remove("search-open");
        }
        if (el.closest(".header__search-icon")) {
            const search = document.querySelector(".search-header");
            if (search) {
                search.classList.add("_active");
                document.documentElement.classList.add("search-open");
            }
        }
        if (el.closest(".search-header__close")) {
            const search = document.querySelector(".search-header");
            if (search) {
                search.classList.remove("_active");
                document.documentElement.classList.remove("search-open");
            }
        }
        if (el.closest(".favorite-add")) el.closest(".favorite-add").classList.toggle("_active");
        if (el.classList.contains("products-collection__tabs-btn")) {
            const tabs = document.querySelectorAll(".products-collection__tabs-btn");
            const tabs2 = document.querySelectorAll(".categories-filter__item");
            const tabFilter = el.dataset.tab;
            tabs.forEach((tab => {
                if (tab.classList.contains("_active")) tab.classList.remove("_active");
            }));
            el.classList.add("_active");
            tabs2.forEach((tab => {
                if (tab.classList.contains("_selected")) tab.classList.remove("_selected");
                if (tab.dataset.tab === tabFilter) tab.classList.add("_selected");
            }));
        }
        if (el.classList.contains("categories-filter__item")) {
            const tabs = document.querySelectorAll(".categories-filter__item");
            const products = document.querySelectorAll(".main-products-collection .products-collection__item");
            const tabFilter = el.dataset.category;
            tabs.forEach((tab => {
                if (tab.classList.contains("_active")) tab.classList.remove("_active");
            }));
            el.classList.add("_active");
            products.forEach((product => {
                if (product.classList.contains("_active")) product.classList.remove("_active");
                if (product.dataset.category === tabFilter) product.classList.add("_active");
            }));
        }
        if (el.classList.contains("cookies__button")) el.closest(".cookies").classList.add("_hide");
        if (el.classList.contains("form__tab")) {
            const tabs = el.closest(".form__tabs").querySelectorAll(".form__tab");
            const form = el.closest(".form");
            tabs.forEach((tab => {
                if (tab.classList.contains("_active")) tab.classList.remove("_active");
            }));
            el.classList.add("_active");
            // if ("tel" === el.dataset.tab) {
            //     form.querySelector('[data-inp="tel"]').classList.remove("_hide");
            //     form.querySelector('[data-inp="email"]').classList.add("_hide");
            // }
            // if ("email" === el.dataset.tab) {
            //     form.querySelector('[data-inp="email"]').classList.remove("_hide");
            //     form.querySelector('[data-inp="tel"]').classList.add("_hide");
            // }
        }
        if (el.closest(".sort-options__title")) {
            const sort = el.closest(".sort-options");
            sort.classList.toggle("_active");
        }
        if (el.closest(".sort-options__label")) {
            const label = el.closest(".sort-options__label");
            label.querySelector("span").textContent;
            const sort = el.closest(".sort-options");
            const title = sort.querySelector(".sort-options__title span");
            if (sort.classList.contains("_active")) sort.classList.remove("_active");
            title.textContent = label.querySelector("span").textContent;
        }
        if (el.closest(".quantity-options__title")) {
            const sort = el.closest(".quantity-options");
            sort.classList.toggle("_active");
        }
        if (el.closest(".quantity-options__label")) {
            const label = el.closest(".quantity-options__label");
            label.querySelector("span").textContent;
            const sort = el.closest(".quantity-options");
            const title = sort.querySelector(".quantity-options__title span");
            if (sort.classList.contains("_active")) sort.classList.remove("_active");
            title.textContent = label.querySelector("span").textContent;
        }
    }
    const sortInputs = document.querySelectorAll(".sort-options input");
    if (sortInputs) {
        const optTitle = document.querySelector(".sort-options__title span");
        sortInputs.forEach((input => {
            if (input.checked) {
                const text = input.nextElementSibling.querySelector("span").textContent;
                optTitle.textContent = text;
            }
        }));
    }
    const quantityInputs = document.querySelectorAll(".quantity-options input");
    if (quantityInputs) {
        const optTitle = document.querySelector(".quantity-options__title span");
        quantityInputs.forEach((input => {
            if (input.checked) {
                const text = input.nextElementSibling.querySelector("span").textContent;
                optTitle.textContent = text;
            }
        }));
    }
    const searchInput = document.querySelector(".search-header__input");
    const searchResults = document.querySelector(".search-header__results");
    searchInput.addEventListener("input", (function() {
        if ("" != this.value) searchResults.classList.add("_active");
        if ("" === this.value) searchResults.classList.remove("_active");
    }));
    document.querySelectorAll(".input").forEach((input => {
        input.addEventListener("input", (function(e) {
            if ("" != input.value) input.classList.add("_form-active"); else if ("" === input.value) input.classList.remove("_form-active");
        }));
    }));
    document.querySelectorAll(".form__data input").forEach((input => {
        input.addEventListener("input", (function(e) {
            if ("" != input.value) input.closest(".form__data").querySelector(".form__data-icons").classList.add("_active"); else if ("" === input.value) input.closest(".form__data").querySelector(".form__data-icons").classList.remove("_active");
        }));
    }));

    
    

    
    // const swiperBrands = new Swiper('.brands__list', {      
    //   slidesPerView: 'auto',
    //   spaceBetween: 0,
    //   speed: 800,
    //   loop: true,
    //   observer: true, 
    //   observeParents: true,     
    //   // navigation: {
    //   //     prevEl: '.brands__arrow-prev',
    //   //     nextEl: '.brands__arrow-next',
    //   // }, 
    //   navigation: {
    //     nextEl: '.swiper-button-next',
    //     prevEl: '.swiper-button-prev',
    //   },         
           
    // });

    $('.brands__list-wrapper').slick({
      infinite: true,
      slidesToShow: 5,
      slidesToScroll:1,
      dots:false,
      responsive: [
    {
      breakpoint: 1399,
      settings: {
        slidesToShow: 4,
       
      }
    },{
      breakpoint: 992,
      settings: {
        slidesToShow: 3,
      }   
    },{
      breakpoint: 767,
      settings: {
        slidesToShow: 2,
      } 
        
    }]
    });

    // Функция добавления товара в корзине и в каталоге товара
    // Задаём глобальные переменные
    
    // Проитерируем все родители элементов, где есть и цена и кол-во	
    let priceBoxes = document.querySelectorAll('.product-card .cart_item');
    
    
  
    priceBoxes.forEach(function(priceBox){
        let prodPrice = priceBox.querySelector('.price-first'); // Изначальная цена
        let cartPrice = priceBox.querySelector('.product-subtotal'); // Цена на товар в корзине
        let prodPriceForNumber = prodPrice.innerText;
        let prodPriceNumber = parseInt(prodPriceForNumber.replace(/\D/g, ''));
        let value = priceBox.querySelector('input[type="number"]').value;
        let subtotal = prodPriceNumber * value;          
        let btns = priceBox.querySelectorAll('.quantity__button');  
            
        
        
        btns.forEach(function(btn){
            btn.addEventListener('click', function(e){
                e.preventDefault();  
                let currency = priceBox.querySelector( '.inner' );
                if(currency) {
                  currency.style.display = 'none';
                }
                                    
                let qty = priceBox.querySelector( 'input[type="number"]' );               
                let val = parseInt( qty.value );		
                var min = parseInt( qty.getAttribute( 'min' ) ),
                max = parseInt( qty.getAttribute( 'max' ) ),
                step = parseInt( qty.getAttribute( 'step' ) );  
                
                if(btn.classList.contains('plus')) {
                                            
                    if ( max && ( max <= val ) ) {
                        qty.value = max;
                    } else {				
                        qty.value = (val + step);                                
                        // value - итоговое количество 
                        value = val + step;                             
                        
                        // Каждый раз при изменении глобальных переменных в локальной функции
                        // вызываем функцию пересчёта
                        recount();                               
                    }
                } else {
                    if ( min && ( min >= val ) ) {
                        qty.value = min;
                    } else if ( val > 1 ) {
                        qty.value = (val - step);
                        value = val - step;				
                        
                        // Каждый раз при изменении глобальных переменных в локальной функции
                        // вызываем функцию пересчёта
                        recount();
                    }
                }                      
            
            });                   
            
    
            // Собственно, сама функция пересчёта
            const recount = () => {		
                // Расчёт итоговой стоимости
                subtotal = prodPriceNumber * value;
    
                if(cartPrice) {
                  cartPrice.textContent = subtotal + '₽';
                } else {
                  prodPrice.textContent = subtotal + '₽';
                }
                
                // // Посчитаем общее количество заказов в корзине и их ценник
                // let allBoxes = document.getElementsByClassName('product-subtotal'); // Все item с итоговыми ценами
                // let allBoxesArray = Array.from(allBoxes); // Создаём массив 
                // let allBoxesValue = allBoxesArray.map(t => {return t.innerText.replace(/\D/g, '')}); // Получаем значение в массиве без пробела, чтобы вычислить чистое число
                
                
                // // console.log(allBoxesValue[0]); // Это например, первый item, вернее - его subtotal
                // let sum = 0;
                // for (i = 0; i < allBoxesValue.length; i++) {
                //   sum += parseInt(allBoxesValue[i]); // Создаём цикл и получаем сумму всех заказов
                // }
                // console.log(sum);

                // // Далее получим значение Подытог в корзине
                // let podytog = document.querySelector('.shop_table .cart-subtotal .amount bdi');
                // podytog.textContent = sum + '₽';

                // // Значение общий итог в корзине
                // let totalItog = document.querySelector('.shop_table .order-total .amount bdi');
                // totalItog.textContent = sum + '₽'; 
                          
                // // Далее получим значение Подытог на странице checkout
                // let podytogCheck = document.querySelector('.woocommerce-checkout-review-order-table .cart-subtotal .amount bdi');
                // podytogCheck.textContent = sum + '₽';
                
            }

            
            
        }); 
    }); 

    
    

    
    // плавающий блок в сайдбаре
    $(function() {
        var $window = $(window);
        var $sidebar = $(".header__wrapper"); // Внутренний блок в сайдбаре
        var $sidebarTop = $sidebar.position().top; // Расстояние от верха до сайдбара
        var $sidebarHeight = $sidebar.height(); // Высота сайдбара
        var $footer = $('.footer'); 
        var $footerTop = $footer.position().top; // Расстояние от верха до футера
      
        $window.scroll(function(event) {
          $sidebar.addClass("fixed"); // При начале скролла переводим сайдбар в fixed
          var $scrollTop = $window.scrollTop(); // Сколько уже проскроллили от верха
          var $topPosition = Math.max(32, $sidebarTop - $scrollTop); // Верхняя точка сайдбара -
          // это максимальное из 2-х значений (32px или разность (расст до сайдбара - сколько отскроллили))         
        
          // Когда нужно отклеить сайдбар при приближении к футеру
          if ($scrollTop + $sidebarHeight > $footerTop) {
            // если сколько отскроллили сверху + высота сайдбара становится больше чем расстояние от верха до футера
            var $topPosition = Math.min($topPosition, $footerTop - $scrollTop - $sidebarHeight);
             
            
          }
      
          $sidebar.css("top", $topPosition);

          
        });
      });

    
    // Сортировка товаров
    let items = document.querySelectorAll('.sort-options__item');
    let firstItem = document.querySelector('.sort-options__item:first-of-type');
    let secondItem = document.querySelector('.sort-options__item:nth-of-type(2)');
    let thirdItem = document.querySelector('.sort-options__item:nth-of-type(3)');
    let lastItem = document.querySelector('.sort-options__item:last-of-type');
    // firstItem.classList.add('active');
    let url = document.URL; // При загрузке страницы определим текущий URL
    let urlId = url.substr(url.length - 4); // Получим последние 4 символа URL   
    if(urlId == 'rity') {
      firstItem.classList.add('active');
    } else if(urlId == 'date') {
      secondItem.classList.add('active');
    } else if(urlId == 'rice') {
      thirdItem.classList.add('active');
    } else if(urlId == 'desc') {
      lastItem.classList.add('active');
    }
    items.forEach(function(item){
        item.addEventListener('click', function(event){
          event.preventDefault();          
                  // items.forEach(function(itemOne){      
            
          //   itemOne.classList.remove('active');      
            
           
          // });         

          if(this == firstItem) {
            firstItem.classList.add('active');
          } else {
            firstItem.classList.remove('active');
          }

          let itemLink = this.querySelector('a'); 

          if(itemLink.getAttribute('href') == '?orderby=price-desc') {                
            window.location.href = url + '/?orderby=price-desc';
            this.classList.add('active');
            
          } else if(itemLink.getAttribute('href') == '?orderby=price') {
            window.location.href = url + '/?orderby=price';
            this.classList.add('active');
          } else if(itemLink.getAttribute('href') == '?orderby=popularity') {
            window.location.href = url + '/?orderby=popularity';
            this.classList.add('active');
          } else if(itemLink.getAttribute('href') == '?orderby=date') {
            window.location.href = url + '/?orderby=date';
            this.classList.add('active');
          }
        });
    });

    // Добавим в контейнер ценника разницу цен и выведем в карточке товара
    var prodItem = document.querySelectorAll('.product-item'); // Итерируем все карточки
    prodItem.forEach(function(eachProdItem) {   
     
      // Выведем цену и скидочную цену
      var salePrice = eachProdItem.querySelector('.product-item__price-new p').innerText; // текущая цена
      var regular = eachProdItem.querySelector('.product-item__price-old');

      if( regular ) { // Добавляем контейнер с разностью цен только если есть акционная и старая цена
        var regularPrice = eachProdItem.querySelector('.product-item__price-old p').innerText; // старая цена
        var minus = regularPrice - salePrice; // разность цен
        var minusCont = eachProdItem.querySelector('.product-item__discount'); // контейнер для разности
      
        minusCont.innerText = ('-'+ minus + '₽');   // Добавляем разность цен  
      }
       
    });

    

   // Хитрый код компоновки виджета в сайдбаре и открытия содержимого по кнопке
   let parent = document.querySelector('.category__sidebar'); // Общий для всех article контейнер

   if(parent) {
    let filterCont1 = document.querySelector('.widget.wpc_smart_price_filter'); // Фильтры товара(содержимое №2)
    let priceBlock = document.querySelector('#block-22'); // Кнопка (содержимое №1)
    filterCont1.classList.add('filters-item__body'); // Добавим содержимому новый класс
    let priceRange = document.querySelector('#block-22'); // Ползунок цены
 
    let filterBody = document.createElement('div'); // Создадим обёртку для содержимого
    filterBody.classList.add('section-body'); 
    
    let buttonFor = document.querySelector('#execphp-8'); // Кнопка
    buttonFor.classList.add('section-btn');
    // Создадим общий блок №1
    var oneBlock = document.createElement('article');
    oneBlock.classList.add('section-article');
    parent.append(oneBlock);
    oneBlock.append(buttonFor); // В один блок включим кнопку блока
    oneBlock.append(filterBody); // В один блок включим Body - содержимое
    filterBody.append(priceBlock);
    filterBody.append(priceRange); // Добавим в тело ползунок    
    filterBody.append(filterCont1);
    

    // Присвоим стили для блока №2
    let buttonFor2 = document.querySelector('#execphp-10'); // Кнопка
    buttonFor2.classList.add('section-btn');
    let bodyFor2 = document.querySelector('#block-26'); // Body
    bodyFor2.classList.add('section-body');
    var oneBlock2 = document.createElement('article'); // Контейнер 2
    oneBlock2.classList.add('section-article');
    parent.append(oneBlock2); // Добавим в общий контейнер
    oneBlock2.append(buttonFor2); // В один блок включим кнопку блока
    oneBlock2.append(bodyFor2); // В один блок включим Body - содержимое

    // Присвоим стили для блока №3
    let buttonFor3 = document.querySelector('#execphp-11'); // Кнопка
    buttonFor3.classList.add('section-btn');
    let bodyFor3 = document.querySelector('#block-24'); // Body
    bodyFor3.classList.add('section-body');
    var oneBlock3 = document.createElement('article'); // Контейнер 3
    oneBlock3.classList.add('section-article');
    parent.append(oneBlock3); // Добавим в общий контейнер
    oneBlock3.append(buttonFor3); // В один блок включим кнопку блока
    oneBlock3.append(bodyFor3); // В один блок включим Body - содержимое

    // Присвоим стили для блока №4
    let buttonFor4 = document.querySelector('#execphp-12'); // Кнопка
    buttonFor4.classList.add('section-btn');
    let bodyFor4 = document.querySelector('#block-27'); // Body
    bodyFor4.classList.add('section-body');
    var oneBlock4 = document.createElement('article'); // Контейнер 4
    oneBlock4.classList.add('section-article');
    parent.append(oneBlock4); // Добавим в общий контейнер
    oneBlock4.append(buttonFor4); // В один блок включим кнопку блока
    oneBlock4.append(bodyFor4); // В один блок включим Body - содержимое

    // Присвоим стили для блока №5
    let buttonFor5 = document.querySelector('#execphp-13'); // Кнопка
    buttonFor5.classList.add('section-btn');
    let bodyFor5 = document.querySelector('#block-28'); // Body
    bodyFor5.classList.add('section-body');
    var oneBlock5 = document.createElement('article'); // Контейнер 5
    oneBlock5.classList.add('section-article');
    parent.append(oneBlock5); // Добавим в общий контейнер
    oneBlock5.append(buttonFor5); // В один блок включим кнопку блока
    oneBlock5.append(bodyFor5); // В один блок включим Body - содержимое

    // Поменяем порядок блока №6 - статьи (закинем его вниз)
    let oneBlock6 = document.querySelector('#execphp-14');
    parent.append(oneBlock6);

     
    // Открытие блоков в сайдбаре
    var sections = $('.section-article'); // итерируем все артиклы
    sections.each(function(){
        var sectionBtn = $(this).find('button'); // Кнопка в текущем артикле
        var sectionBody = $(this).find('.section-body'); // Содержимое в текущем артикле
        var sectionArrow = $(this).find('.section-img'); // Стрелочка в текущем артикле     
        sectionBtn.click(function(){
          sectionBody.slideToggle('slow');
          sectionArrow.toggleClass('opened');
        });
    });
   }
    

    const swiper = new Swiper('.category__tags-list', {            
      loop: true,
      slidesPerView: "auto",
      spaceBetween: 10,
      autoHeight: false,
      speed: 800,
      freeMode: false,     
      navigation: {
          nextEl: '.category__tags-arrow-next',
          prevEl: '.category__tags-arrow-prev',
        },      
    });


    // Открытие / скрытие фильтров в мобильной версии
    let filterBtn = $('.filters-btn');
    let filterCont = $('.category__sidebar');

    filterBtn.on('click', function(){
      filterCont.slideToggle('slow');

      
    });

    // Manual trigger		

    $( document.body ).on( 'select2:select', '#billing_country, #billing_city, #billing_state', function( e ) {
      $( document.body ).trigger( 'update_checkout' );
    } );

    // Уменьшим в определенных блоках высоту текста
   
        var str = $('.hide-low').html();
        str2 = str.substr(0,60) + '...';//к примеру, если величина блока 60 символов.
      $('.hide-low').html(str2);
   

    console.log('.result_item p');
  

  
    


  // Открытие скрытого текста в блоке Отзывы reviews 
  let reviews = document.querySelectorAll('.main-reviews__item'); // Все отзывы
    reviews.forEach(function(oneContent){  // Итерируем блоки (отзывы) 
      
      // Определяем контейнер, текст и кнопки внутри текущего блока
      const contain = oneContent.querySelector('.main-reviews__item-text'); // контейнер с текстом
      const content = oneContent.querySelector('.main-reviews__text'); // сам текст отзыва
      const btn = oneContent.querySelector('.main-reviews__item-more'); // кнопка читать больше
      const btnClose = oneContent.querySelector('.main-reviews__item-less'); // кнопка скрыть

            
      const heightOfContent = content.getBoundingClientRect().height; // вычисляем высоту текста

      if(heightOfContent >= 101) { // если высота становится более 101px, добавляем кнопку читать далее                  
          
        btn.classList.add('open');
        
        btn.addEventListener('click', function(){
          this.classList.remove('open');

          content.classList.add('open');

          btnClose.classList.add('open'); 
        });      

      } else {   // в обратном случае скрываем кнопку  
        btn.classList.remove('open');         
      }    

      btnClose.addEventListener('click', function(){
          this.classList.remove('open');

          content.classList.remove('open');
            
          btn.classList.add('open');     
        });    
    });


    
    
});

