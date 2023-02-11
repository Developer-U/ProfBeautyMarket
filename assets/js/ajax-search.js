jQuery(function($){
    var searchTerm = '';    
    // console.log($('.search-input'));

    $('.search-input').keydown(function(){
        searchTerm = $.trim($(this).val());        
    });
        
    $('.search-input').keyup(function(){
        if ($.trim($(this).val()) != searchTerm) { // Если новое значение не равно старому, идем дальше
            searchTerm = $.trim($(this).val());
            // console.log(searchTerm);
            if(searchTerm.length > 2){ // Если введено больше 2-х символов, идем дальше
                $.ajax({
                    url : 'https://pbm.u0618804.plsk.regruhosting.ru/wp-admin/admin-ajax.php', // Ссылка на AJAX обработчик WP
                    type: 'POST', // Отправляем данные методом POST
                    data: {
                        'action' : 'ba_ajax_search', // Вызываемое действие, которое мы описали в functions.php
                        'term' : searchTerm // Отправляемые данные поля ввода
                    },
                    beforeSend: function() { // Перед отправкой данных
                        $('.result-search .result-search-list').fadeOut(); // Скроем блок результатов
                        $('.result-search .result-search-list').empty(); // Очистим блок результатов
                        $('.result-search .preloader').show(); // Покажем загрузчик
                    },
                    success: function(result) { // После выполнения поиска
                        $('.result-search .preloader').hide(); // Скроем загрузчик
                        $('.result-search .result-search-list').fadeIn().html(result); // Покажем блок результатов и добавим в него полученные данные
                    }
                });
            }
        }
    });
    
    $('.search-input').focusin(function() {
        $('.result-search').fadeIn();
    })
    
    $(document).mouseup(function(e) {
        if ((!$('.result-search').is(e.target) && $('.result-search').has(e.target).length === 0) && (!$('.search-input').is(e.target) && $('.search-input').has(e.target).length === 0)) {
            $('.result-search').fadeOut();
        }
    });
});
