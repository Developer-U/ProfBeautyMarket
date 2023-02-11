<?php
/***
 * 
 * Блок с картой
 * 
 */?>

 <?php if( get_field('map_center_zoom', 'options') ): ?>
    <section id="map" class="main-map map map">
    </section>

    <script type="text/javascript"> 
        ymaps.ready(init);

        function init() {
            var myMap = new ymaps.Map('map', {
                center: [<?php the_field('map_center_coords', 'options'); ?>],
                zoom: <?php the_field('map_center_zoom', 'options'); ?>,
                controls: ['zoomControl']
            }, {
                searchControlProvider: 'yandex#search'
            });

                // Ширина активного окна устройства:
            var availableScreenWidth = window.screen.availWidth;

            if(availableScreenWidth >= '600') {
                var placemark = new ymaps.Placemark(myMap.getCenter(), {
                <?php $mapBalImg = get_field('map_baloon_image', 'options'); ?>
                // Зададим содержимое заголовка балуна.
                balloonContentHeader: '',

                // Зададим содержимое основной части балуна.
                balloonContentBody: `
                <div class="baloon__header icon-content">
                    <figure class="baloon__image icon-content__image">
                        <img src="<?php echo esc_url($mapBalImg['url']); ?>">
                    </figure>
                    <div class="icon-content__wrap">
                        <div class="icon-content__title"><?php the_field('map_baloon_heading', 'options'); ?></div>
                        <p class="icon-content__address"><?php the_field('map_baloon_address', 'options'); ?></p>
                        <div class="icon-content__contacts">                            
                            <a href="tel:<?php the_field('phone_link', 'options'); ?>" class="icon-content__phone"><?php the_field('phone_num', 'options'); ?></a>                            
                            <a href="mailto:<?php the_field('mail', 'options'); ?>" class="icon-content__mail" target="_blank"><?php the_field('mail', 'options'); ?></a>
                        </div>
                        <div class="icon-content__work-time">
                            <?php the_field('map_baloon_worktime', 'options'); ?>
                        </div>
                    </div>                  
                </div>`,
                
                // Зададим содержимое всплывающей подсказки.
                hintContent: '<?php the_field('map_baloon_name', 'options'); ?>'
            });
            } else {
                var myPlacemark = new ymaps.GeoObject({
                    geometry: {
                        type: "Point",
                        coordinates: [<?php the_field('map_baloon_mark_coords', 'options'); ?>]
                    }
                });

                myMap.geoObjects.add(myPlacemark);
            }
            // Добавим метку на карту.
            myMap.geoObjects.add(placemark);
            // Откроем балун на метке.
            placemark.balloon.open();

            myMap.behaviors.disable('scrollZoom');
        }
    </script>
<?php endif; ?>