<?php
/*
*
*/
?>

    <?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
        <div class="sort-options__item">
            <a href="?orderby=<?php echo esc_attr( $id );?>"><?php echo esc_html( $name )?></a>
        </div>
    <?php endforeach; ?>