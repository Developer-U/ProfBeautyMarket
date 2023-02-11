jQuery(document).ready(function ($) {
    $('[data-click]').on('click', function(){
        var productId = $(this).attr('data-click');        

        var data = {
            id: productId,
            action: 'ajax_quick_view',            
            nonce: ajax_quick.nonce
        };        
        
        $.ajax({
            url: ajax_quick.url,
            data: data,
            type: 'POST',
            dataType: 'json',
            beforeSend:function(xhr){
                $('#popup-one-click #popup-one-form').text('Загрузка');
             },
            success: function(data) {              
                $('#popup-one-form').html(data.product);

                let value = $('#popup-one-form input[title="Qty"]').val(); 
                let prodPrice = $('#popup-one-form .popup__product-price span').html();
                let priceTotal = prodPrice * value;
                let btns = $('#popup-one-form .calc__btn');
                // console.log(value);   
                // console.log(prodPrice);  
                // console.log(priceTotal); 
                // console.log(btns);        
                
                btns.each(function(){
                    $(this).on('click', function() {
                        var qty = $('#popup-one-form input[title="Qty"]'),
                        value = parseInt( qty.val() ),
                        min = parseInt( qty.attr( 'min' ) ),
                        max = parseInt( qty.attr( 'max' ) ),
                        step = parseInt( qty.attr( 'step' ) );
            
                        // Функция присвоения переменной в поле итоговой цены
                        const recount = () => {		
                            // Расчёт итоговой стоимости							     
                            $('#popup-one-form .popup__product-price span').html(priceTotal);	
                        }
                                        
                        // дальше меняем значение количества в зависимости от нажатия кнопки Плюс и минус
                        if ( $( this ).is( '.plus' ) ) {
                            if ( max && ( max <= value ) ) {
                                qty.val( max );
                            } else {				
                                qty.val( value + step );
            
                                value = value + step;
                                priceTotal = prodPrice * value;
                                recount();                             
                                
                            }
                        } else {
                            if ( min && ( min >= value ) ) {
                                qty.val( min );
                            } else if ( value > 1 ) {
                                qty.val( value - step );
    
                                value = value - step;
                                priceTotal = prodPrice * value;
                                recount();                                 
                            }
                        }
            
                                              
                        
                    });
                });
                
                
            }
        });
    });  
});