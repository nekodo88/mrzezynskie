(function($){
    function one_page_scroll(){
        $('.main-menu .mega-menu > li.menu-item > a,.menu-footer li a').click(function(e){
            e.preventDefault();
            console.log(1);
            if($('body').hasClass('home')){
                var href=$(this).attr('href');
                href=href.split('#');
                if(href.length>1){
                    var top=0;
                    if(!$('header.header').hasClass('sticky')){
                        $('header.header').addClass('sticky');
                    }

                    if(href[1]==''){
                        top=0;
                    }else{top=$('#'+href[1]).offset().top - $('header.header').outerHeight();}

                    $('body,html').animate({scrollTop:top},'300',function(){
                        window.location.hash = '#'+href[1];
                    });
                }else{
                    location.href=$(this).attr('href');
                }
            }else{
                location.href=$(this).attr('href');
            }
        });

        $(window).scroll(function(){
            if($(window).scrollTop()>50){
                if(!$('header.header').hasClass('sticky')){
                    $('header.header').addClass('sticky');
                }
                var h=$('header.header').outerHeight();
                $('header.header').next().css('margin-top',h);
            }else{
                $('header.header').removeClass('sticky');
                $('header.header').next().css('margin-top','');

            }
        });
    }

    function mobile_menu() {
        //reponsive open menu button click
        $('.open-menu-mobile').click(function (e) {
            e.preventDefault();
            $(this).closest('.main-menu').find('#site-navigation').addClass('open');
        })

        //reponsive close menu button click
        $('.close-menu-mobile').click(function (e) {
            e.preventDefault();
            $(this).closest('#site-navigation').removeClass('open');
        })
        //reponsive close menu button click
        $('.hide-mobile').click(function (e) {
            e.preventDefault();
            $(this).closest('#site-navigation').removeClass('open');
        })
    }
    function skills(){
        $(".bar").each(function () {
            $(this).find(".bar-inner").animate({
                width: $(this).attr("data-width")
            }, 2000)
        });
    }
    function portfolio_slider(){
        $('.portfolio_slider').slick({
            dots: true,
            prevArrow: false,
            nextArrow: false,
            infinite: true,
            speed: 300,
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: false
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 320,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    }
    function carousel() {
        $('.wrap-rate-slide').slick({
            dots: false,
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            slidesToScroll: 1,
            nextArrow:  ' <li class="next"></li>',
            prevArrow:  ' <li class="prev"></li>',
            responsive: [
                {
                    breakpoint: 575,
                    settings: {
                        arrows: false
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    }
    function scroll() {
        jQuery(document).ready(function () {
            var header_height = jQuery('.header-top').height();
            jQuery(window).scroll(function(){
                if (jQuery(window).scrollTop() >= header_height) {
                    jQuery('header').addClass('menu-fix');
                    // jQuery('body').css('padding-top',header_height);
                }
                else {
                    jQuery('header').removeClass('menu-fix');
                    // jQuery('body').css('padding-top','0');
                }
            });
            jQuery('.open-menu-mobile i').on('click',function () {
                jQuery('.main-navigation').addClass('open');
            })
            jQuery('.close-menu-mobile i').on('click',function () {
                jQuery('.main-navigation').removeClass('open');
            })
        });
    }
    function silder_header() {
        $('.slide-top').slick({
            dots: true,
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            responsive: [
                {
                    breakpoint: 575,
                    settings: {
                        arrows: false
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    }

    function init(){
        one_page_scroll();
        mobile_menu();
        // portfolio_slider();
        // skills();
        carousel();
        silder_header();
        // scroll();
    }

    $(document).ready(function () {
        init();
    });
})(jQuery);