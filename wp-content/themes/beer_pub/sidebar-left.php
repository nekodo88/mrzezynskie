<?php
    $beer_pub_sidebar_left = beer_pub_get_sidebar_left();
?>
<?php if ($beer_pub_sidebar_left && $beer_pub_sidebar_left != "none" && is_active_sidebar($beer_pub_sidebar_left)) : ?>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 left-sidebar active-sidebar"><!-- main sidebar -->
        <?php dynamic_sidebar($beer_pub_sidebar_left); ?>
    </div>
<?php endif; ?>


