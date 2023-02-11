window.addEventListener('DOMContentLoaded', function(){ 
    // Табы в блоке выбора потолков на главной странице

  // Проитерируем кнопки выбора табов
  document.querySelectorAll('.products-collection__tabs-btn').forEach(function(tabsBtn){

    // Зададим в переменную первую кнопку (в стилях делаем первый элемент активным)        
    var firstPriceBtn = document.querySelector('.products-collection__tabs-btn:first-of-type');

    // И зададим активное значение
    firstPriceBtn.classList.add('_active');
    
    tabsBtn.addEventListener('click', function(event){
      event.preventDefault();

      // Зададим константу атрибута data-path у кнопок
      const path = event.currentTarget.dataset.path;

      // Проитерируем все ссылки и при клике снимем все активные значения
      document.querySelectorAll('.products-collection__tabs-btn').forEach(function(oneTab){
        oneTab.classList.remove('_active');
      });   
      
      firstPriceBtn.classList.remove('_active');

      // Соответствующей кнопке зададим активное значение
      document.querySelector(`[data-path='${path}']`).classList.add('_active');      
        

      // Итерируем табы и закрываем все открытые табы
      document.querySelectorAll('.products-collection__items').forEach(function(tabContent){
        tabContent.classList.remove('_active');

        // Зададим в переменную первый Таб (в стилях делаем первый элемент открытым)        
        var firstPriceTab = document.querySelector('.products-collection__items:first-of-type');

        // Соответственно при клике на любую кнопку его сразу закрываем
        firstPriceTab.style.display = 'none';

        // Закинем в переменную текущий Таб с соответствующим атрибутом data-target       
        var currentTab = document.querySelector(`[data-target="${path}"]`);

        // console.log(currentTab.getAttribute('data-target') );

        // console.log(firstPriceTab.getAttribute('data-target') );

        // Зададим условие: если атрибут data-target текущего таба соответствует первому Табу, то есть
        // если это и есть первый Таб, открываем его, если нет - держим закрытым и открываем соответствующий
        if(currentTab.getAttribute('data-target') == firstPriceTab.getAttribute('data-target')) {
          firstPriceTab.style.display = 'grid';
        } else {
          firstPriceTab.style.display = 'none';
  
          currentTab.classList.add('_active');
        }

      });

      

      
    });

  });
});