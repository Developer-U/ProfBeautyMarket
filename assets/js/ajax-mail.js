jQuery(document).ready(function ($) {

    $('#productForm').submit(function() {
		var formData = new FormData();               
        var product = $('.popup__product-name').html();
        var userPhone = $('#phoneNumber').val();        
        		
		//не забываем проверить поля на заполнение		
        //присоединяем поля и файл, если есть
        if(userPhone !== "") {
            formData.append('phone', userPhone);         
            formData.append('product', product);
        }

        $.ajax({
            url: "https://pbm.u0618804.plsk.regruhosting.ru/mailing.php/",
            type: "POST",
            dataType : "json", 
            cache: false,
            contentType: false,
            processData: false,  
            data: formData, //указываем что отправляем		
            success: function(msg) {
                let result = "";
                if(msg == 'Message has been sent') {  
                    result='<div class="ok"><h3>Спасибо за Вашу заявку!<br />Мы с Вами свяжемся в ближайшее время.</h3></div>'; 
                                
                }
                else {result = msg;} 
                    $('.popup__content .note').css('opacity', 1);
                    $('.note').html(result);                    
                                  
                    $("#productForm").find('input').each(function() {
                    $(this).val('');
                    });   
                    
                    setTimeout(function() {
                    $('.popup__content .note').css('opacity', 0);
                    $('#popup-one-click.popup').removeClass('popup_show');
                    $(document.documentElement).removeClass('popup-show');
                    $(document.documentElement).removeClass("lock");
                    }, 2500);               
                
            }
        });

        // Получаем значение поля Количество продукта (остальные поля уже определены в начале этого файла)
        let value = $('#popup-one-form input[title="Qty"]').val();
        
        let data = {
            userPhone,
            product,
            value,                    
            action: 'product-zayavka-ajax'            
        }

        $.ajax({
            url: '/wp-content/themes/e-store/product-zayavka-post.php',
            method: 'post',
            dataType: 'json',
            data: data,
            success: function(data){
            console.log(data);
            }
        });

		return false;        

	});
});