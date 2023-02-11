<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Переименуем поля
add_filter( 'woocommerce_account_menu_items', 'estore_rename_menu', 25 );
 
function estore_rename_menu( $menu_links ){
 
	$menu_links[ 'dashboard' ] = 'Профиль'; 
	$menu_links[ 'edit-account' ] = 'Личные данные'; 
	
 
	return $menu_links;
 
}

// Добавим новый пункт в меню в Личном кабинете, чтобы открывалось справа

/*
 * Step 1. Add Link to My Account menu
 */
add_filter ( 'woocommerce_account_menu_items', 'estore_cert_link', 40 );
function estore_cert_link( $menu_links ){
 
	$menu_links = array_slice( $menu_links, 0, 5, true ) 
	+ array( 'documents' => 'Документы' )
	+ array_slice( $menu_links, 5, NULL, true );
 
	return $menu_links;
 
}
/*
 * Step 2. Register Permalink Endpoint
 */
add_action( 'init', 'estore_add_endpoint' );
function estore_add_endpoint() {
 
	// WP_Rewrite is my Achilles' heel, so please do not ask me for detailed explanation
	add_rewrite_endpoint( 'documents', EP_PAGES );
 
}
/*
 * Step 3. Content for the new page in My Account, woocommerce_account_{ENDPOINT NAME}_endpoint
 */


/*
 * Step 4
 */
// Go to Settings > Permalinks and just push "Save Changes" button.



// когда пользователь сам редактирует свой профиль
add_action( 'show_user_profile', 'estore_show_profile_fields' );
// когда чей-то профиль редактируется админом например
add_action( 'edit_user_profile', 'estore_show_profile_fields' );
 
function estore_show_profile_fields( $user ) {
 
	// выводим заголовок для наших полей
 	echo '<h3>Дополнительная информация</h3>';
 
	// поля в профиле находятся в рамметке таблиц <table>
 	echo '<table class="form-table">';
 
        // добавляем поле   
        
        $documents = get_user_meta( $user->ID, 'documents', true ); ?>
        <tr><th><label for="city">Документы</label></th>

        <?php
        if($documents): 
        foreach($documents as $key=> $document):?>
             
            <td><img src=" <?php echo $document['url']; ?>"></td>
                
            
        <?php
        endforeach;
        endif; ?>
        </tr> 
        <?php   
 	
 
 	echo '</table>';
 
}


add_action( 'woocommerce_account_documents_endpoint', 'estore_my_account_endpoint_content' );
function estore_my_account_endpoint_content() { ?>
    <div style="width:300px">        
       

       <?php
       $documents = get_user_meta( get_current_user_id(), 'documents', true );
       if($documents): 
        foreach($documents as $key=> $document):
            print_r($document); ?>

            <img src=" <?php echo $document['url']; ?>">
            
        <?php
        endforeach;
       endif;
       ?>
       

        <form enctype="multipart/form-data" action="" method="POST" class="upload_doc">
            <?php wp_nonce_field( 'my_file_upload', 'fileup_nonce' ); ?>
            <label for="file">Прикрепите фото</label>
            <input id="file" name="my_file_upload" type="file" />
            <input type="submit" value="Загрузить файл" />
        </form>
    </div>
	
<?php }

add_action('wpcf7_before_send_mail', 'estore_form_data', 10, 3);

function estore_form_data($form, $abort, $submition) {
    error_log( print_r( $_FILES, 1 ) );
}

// скрипт
add_action( 'wp_footer', 'ajax_file_upload_jscode' );

// AJAX обработчик
add_action( 'wp_ajax_'.'ajax_fileload',        'ajax_file_upload_callback' );
add_action( 'wp_ajax_nopriv_'.'ajax_fileload', 'ajax_file_upload_callback' );

// HTML код формы
function ajax_file_upload_html( $text ){
	// выходим не наша страница...
	if( $GLOBALS['post']->post_name !== 'ajax_file_upload' )
		return $text;

	return $text .= '
		<input type="file" multiple="multiple" accept="image/*">
		<button class="upload_files">Загрузить файл</button>
		<div class="ajax-reply"></div>
	';
}

// JS код
function ajax_file_upload_jscode(){
	?>
	<script>
		jQuery(document).ready(function($){

			// ссылка на файл AJAX  обработчик
			var ajaxurl = '<?= admin_url('admin-ajax.php') ?>';
			var nonce   = '<?= wp_create_nonce('uplfile') ?>';

			var files; // переменная. будет содержать данные файлов

			// заполняем переменную данными, при изменении значения поля file
			$('input[type=file]').on('change', function(){
				files = this.files;

                console.log(files);
			});

			// обработка и отправка AJAX запроса при клике на кнопку upload_files
			$('.upload_doc').on( 'submit', function( event ){

				event.stopPropagation(); // остановка всех текущих JS событий
				event.preventDefault();  // остановка дефолтного события для текущего элемента - клик для <a> тега

				// ничего не делаем если files пустой
				if( typeof files == 'undefined' ) return;

				// создадим данные файлов в подходящем для отправки формате
				var data = new FormData();
				$.each( files, function( key, value ){
					data.append( key, value );
				});

                

				// добавим переменную идентификатор запроса
				data.append( 'action', 'ajax_fileload' );
				data.append( 'nonce', nonce );
				

				var $reply = $('.ajax-reply');

                console.log(data);

				// AJAX запрос
				$reply.text( 'Загружаю...' );
				$.ajax({
					url         : ajaxurl,
					type        : 'POST',
					data        : data,
					cache       : false,
					dataType    : 'json',
					// отключаем обработку передаваемых данных, пусть передаются как есть
					processData : false,
					// отключаем установку заголовка типа запроса. Так jQuery скажет серверу что это строковой запрос
					contentType : false,
					// функция успешного ответа сервера
					success     : function( respond, status, jqXHR ){
						// ОК
						if( respond.success ){
							$.each( respond.data, function( key, val ){
								$reply.append( '<p>'+ val +'</p>' );
							} );
						}
						// error
						else {
							$reply.text( 'ОШИБКА: ' + respond.error );
						}
					},
					// функция ошибки ответа сервера
					error: function( jqXHR, status, errorThrown ){
						$reply.text( 'ОШИБКА AJAX запроса: ' + status );
					}

				});

			});

		})
	</script>
	<?php
}

// обработчик AJAX запроса
function ajax_file_upload_callback(){
	check_ajax_referer( 'uplfile', 'nonce' ); // защита

	if( empty($_FILES) )
		wp_send_json_error( 'Файлов нет...' );

	$post_id = (int) $_POST['post_id'];

	// ограничим размер загружаемой картинки
	$sizedata = getimagesize( $_FILES['upfile']['tmp_name'] );
	$max_size = 2000;
	if( $sizedata[0]/*width*/ > $max_size || $sizedata[1]/*height*/ > $max_size )
		wp_send_json_error( __('Картинка не может быть больше чем '. $max_size .'px в ширину или высоту...','km') );

	// обрабатываем загрузку файла
	require_once ABSPATH . 'wp-admin/includes/image.php';
	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/media.php';

	// фильтр допустимых типов файлов - разрешим только картинки
	add_filter( 'upload_mimes', function( $mimes ){
		return [
			'jpg|jpeg|jpe' => 'image/jpeg',
			'gif'          => 'image/gif',
			'png'          => 'image/png',
		];
	} );

	$uploaded_imgs = array();
    
    print_r( $_FILES );

	foreach( $_FILES as $file_id => $data ) {

		$file = & $_FILES['my_file_upload'];

        print_r( $file_id );
        print_r( $data );

        $overrides = [ 'test_form' => false ];

        $movefile = wp_handle_upload( $data, $overrides );

        if ( $movefile && empty($movefile['error']) ) {

            $uploaded_imgs[] = $movefile;

            print_r( $movefile );
        } 
	}

    $user_id = get_current_user_id();

    update_user_meta( $user_id, 'documents', $uploaded_imgs );

	wp_send_json_success( $uploaded_imgs );

    

}

