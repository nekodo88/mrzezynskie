
</div> <!-- End main-->
<footer class="footer">
    <div class="footer-wrapper">
        <div class="container">
            <div class="row footer-top">
                <div class="col-8">
                    <div class="menu-main-container menu-footer">
                        <?php
                        if (has_nav_menu('primary')) {
                            wp_nav_menu(array(
                                    'theme_location' => 'primary',
                                    'menu_class' => 'mega-menu',
                                    'items_wrap' =>  '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                )
                            );
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="footer-bottom row">
                <div class="col-8">
                    <div class="copyright">
                        <?php
                        $copyright =  get_theme_mod('copyright','<p class="text-center m-0">(C) All Rights Reserved. Charity Theme, Designed & Developed by<a href="#">Template.net</a></p>');;
                        if ( $copyright !='') : ?>
                            <?php echo wp_kses_post( $copyright); ?>
                        <?php endif;?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
</div> <!-- End page-->
<?php wp_footer(); ?>
</body>
</html>