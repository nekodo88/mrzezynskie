<?php
$contactShow = get_theme_mod('contact_show','yes');



$Mapcontact = get_theme_mod('map_contact','<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14900.820008282744!2d105.78794855!3d20.984417999999998!3m2!1i1024!2i768!4f13.1!4m3!3e6!4m0!4m0!5e0!3m2!1svi!2s!4v1553584360760" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>');
$contactdesc = get_theme_mod('desc_contact','<a href="mailto:info@craftbeerpub.com">info@craftbeerpub.com</a>
                                <p>Craft Beer Pub  LLC</p>
                                <p>85 Broad Street</p>
                                <p>28th Floor</p>
                                <p>New York, NY 10004</p>
                                <a href="tel:8001233456">(800) 123 - 3456</a>');
?>
<?php if($contactShow):?>
<section id="contact">
    <div class="container-fluid">
        <div class="row">
            <div class="col-8 p-0">
                <div class="wrap-contact">
                    <?php echo $Mapcontact?>
                    <div class="container">
                    <div class="inner-contact">
                        <div class="wrap-contact-content">
                             <?php echo $contactdesc?>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif?>