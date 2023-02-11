<?php
/*
* Header
*/
?>
    <div class="wrapper">
		<?php get_sidebar(); ?>

		<main class="page">
            <div class="page__header page-header">
                <div class="page-header__container">
                    <div class="page-header__top">
                        <div class="page-header__top-wrap">
                            <button type="button" data-popup-open="popup-location" class="page-header__item location">
                                <svg>
                                    <use xlink:href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/icons/icons.svg#svg-marker"></use>
                                </svg>
                                <span><?php echo do_shortcode('[wt_geotargeting get="city"]'); ?></span>
                            </button>
                        

                            <div class="page-header__item page-header__address">
                                <svg>
                                    <use xlink:href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/icons/icons.svg#svg-flag"></use>
                                </svg>
                                <span><?php the_field('address', 'options'); ?></span>
                            </div>
                            <div class="page-header__item page-header__work-hours">
                                <svg>
                                    <use xlink:href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/icons/icons.svg#svg-clock"></use>
                                </svg>
                                <span><?php the_field('work_time', 'options'); ?></span>
                            </div>
                            <button data-popup-open="popup-call" class="page-header__button btn-purple">ЗАПИСЬ К КОСМЕТОЛОГУ</button>
                        </div>
                    </div>

                    <?php estore_primary_menu(); ?>
                </div>
            </div>

            <div class="action-buttons">
                <button type="button" data-popup-open="popup-call" class="action-buttons__button btn-green-svg">
                    <svg>
                        <use xlink:href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/icons/icons.svg#svg-calendar"></use>
                    </svg>
                </button>
                <button type="button" data-popup-open="kurs" class="action-buttons__button btn-pirple-svg">
                    <svg>
                        <use xlink:href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/icons/icons.svg#svg-hat"></use>
                    </svg>
                </button>
            </div>

            <div class="page__wrap" style="background-image: url('<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/green-bg.png')">

            