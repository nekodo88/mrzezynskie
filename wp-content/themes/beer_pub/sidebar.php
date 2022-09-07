<?php
    $beer_pub_sidebar_left = beer_pub_get_sidebar_left();
    $beer_pub_sidebar_right = beer_pub_get_sidebar_right();

    ?>
<?php if ($beer_pub_sidebar_left && is_active_sidebar($beer_pub_sidebar_left)) : ?>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 left-sidebar "><!-- main sidebar -->
        <?php dynamic_sidebar($beer_pub_sidebar_left); ?>
    </div>
<?php endif; ?>
<?php if ($beer_pub_sidebar_right && is_active_sidebar($beer_pub_sidebar_right)) : ?>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 right-sidebar"><!-- main sidebar -->
        <?php dynamic_sidebar($beer_pub_sidebar_right); ?>
    </div>
<?php endif; ?>





