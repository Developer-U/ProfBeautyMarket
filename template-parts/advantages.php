<?php
/*
* Блок Преимущества
*/
?>

    <section class="main-advantages advantages">
        <div class="advantages__container">
            <div class="advantages__list">
                <?php if( have_rows('add_new_advantage_main', 'options') ): ?>
                <?php while( have_rows('add_new_advantage_main', 'options') ): the_row();
                    $advMainName = get_sub_field('advantage_main_name', 'options');   
                    $advMainIcon = get_sub_field('advantage_main_icon', 'options');   
                    $advMainDescr = get_sub_field('advantage_main_descr', 'options');                                                         
                ?>

                    <div class="advantages__item" style="background-image: url('<?php echo esc_url($advMainIcon['url']); ?>')">
                        <div class="advantages__item-title"><?= $advMainName; ?></div>
                        <div class="advantages__item-text"><?= $advMainDescr; ?></div>
                    </div>

                <?php endwhile; ?>
                <?php endif; ?>							
            </div>
        </div>
    </section>
