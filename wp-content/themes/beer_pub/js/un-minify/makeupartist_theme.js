(function ($) {
    "use strict";
    //Global variable
    var $rtl = false;
    if(beer_pub_params.beer_pub_rtl=="yes"){
        $rtl = true;
    }
    // Check images loaded
   // Check images loaded
    $.fn.JAS_ImagesLoaded = function( callback ) {
        var JAS_Images = function ( src, callback ) {
            var img = new Image();
            img.onload = callback;
            img.src = src;
        };
        var images = this.find( "img" ).toArray().map( function( el ) {
            return el.src;
        });
        var loaded = 0;
        $( images ).each(function( i, src ) {
            JAS_Images( src, function() {
                loaded++;
                if ( loaded == images.length ) {
                    callback();
                }
            });
        });
    };

    function SetChildWidth(){
        $(".cate-menu > ul > li > ul").each(function(){
            var count_num = $(".cate-menu > ul > li > ul > li").size();
            $(this).addClass("menu-col"+count_num/2);
        });
        // alert('ok');
    }
    function beer_pub_AutocompleteSearch(){
        $(".search-form").each(function(){
            var url = beer_pub_params.ajax_url + "?action=beer_pub_search";
            var $this = $(this);                    
            var $post_type = ($(this).find( "input[name='post_type']" ).val()!='')?$(this).find( "input[name='post_type']" ).val():'';
            var s1 = [];
            // var s2 = [];
            $(this).find(" select" ).each(function(){
                $(this).on("change", function() {
                    s1.unshift({
                        tax: $(this).attr("name"), 
                        term: $(this).find(":selected").val()
                    });                                 
                    var categories =[];
                    var dup= [];
                    if(s1.length !== 0){
                        $.each(s1, function(index, value) {
                            if(typeof value !== "undefined"){
                                if ($.inArray(value.tax, categories) == -1) {
                                    categories.push(value.tax);
                                }else{
                                    dup.push(value.tax);
                                    s1.pop();
                                }
                            }
                        });
                    }
                });
                
            });

            $(this).find( "input[name='s']" ).autocomplete({
                    // source: url,
                    source: function( request, response ) {
                        var request_data = {
                            term: request.term,
                            post_type: $post_type,
                            tax: s1,
                            min_price: function(){
                                return $('.first_limit').text();                            
                            },
                            max_price: function(){
                                return $('.last_limit').text();                         
                            },                          
                        };                      
                        $.getJSON(beer_pub_params.ajax_url+'?&action=beer_pub_search', request_data, response);
                    },
                    appendTo: $this.parent(),
                    autoFocus: true,
                    delay: 500,
                    minLength: 3,
                    search: function( event, ui ) {
                        $this.find('.searchsubmit .fa-search').removeClass('fa-search').addClass('fa-spin fa-spinner');
                    },
                    response: function( event, ui ) {
                        $this.find('.searchsubmit .fa-spin').removeClass('fa-spin fa-spinner').addClass('fa-search');
                        $this.parent().toggleClass('s-no-result-found');
                        $this.parent().find('.search-no-results').remove();
                        $this.parent().append('<div class="search-no-results"><p>'+beer_pub_params.beer_pub_search_no_result+'</p></div>');
                    },
                    focus: function() {
                        return false;
                    },
            })
            .autocomplete( "instance" )._renderItem = function( ul, item ) {
                $this.parent().find('.search-no-results').remove();
                $this.parent().toggleClass('s-result-found').removeClass('s-no-result-found');
                var result =  "<div class='search-content'>" ;
                if(item.imgsrc!=''){
                    result += "<div class='search-img'><img src='"+item.imgsrc+"' alt='' /></div>";
                }
                result += "<div class='search-info'>";
                result += "<a href='"+item.link +"'>" + item.label + "</a>";    
                result += "</div>"+ "</div>";
              return $( "<li>" )
                .append( result )
                .appendTo( ul );
            };
            $(this).find( "input[name='s']" ).on('autocompleteselect', function (e, ui) {
                $this.parent().find('.ui-autocomplete').addClass('show');
                if($this.find('input[name="post_type"]').val()!='product'){
                    $this.parent().find('.ui-autocomplete').removeClass('show');
                };
            });
        });     
    }   
    //Like Count Gallery
    function LikeCountGallery() {
        $('body').on('click', '.beer_pub-post-like', function (event) {
            event.preventDefault();
            var heart = $(this);
            var post_id = heart.data("post_id");
            var like_type = heart.data('like_type') ? heart.data('like_type') : 'post';
            heart.html("<i id='icon-like' class='ion-android-favorite-outline'></i><i id='icon-spin' class='fab fa-spinner fa-spin'></i>");
            $.ajax({
                type: "post",
                url: ajax_var.url,
                data: "action=beer_pub-post-like&nonce=" + ajax_var.nonce + "&beer_pub_post_like=&post_id=" + post_id + "&like_type=" + like_type,
                success: function (count) {
                    var lecount = count.replace("already", "");
                    if(count == "0" || count == "1"){
                        lecount = "Like";
                    }else{
                        lecount = "Likes"
                    }
                    if (count.indexOf("already") !== -1)
                    {
                        heart.prop('title', beer_pub_params.beer_pub_like_text);
                        heart.removeClass("liked");
                        heart.html("<i id='icon-unlike' class='ion-android-favorite-outline'></i>" + " " + lecount);
                    }
                    else
                    {
                        heart.prop('title', beer_pub_params.beer_pub_unlike_text);
                        heart.addClass("liked");
                        heart.html("<i id='icon-like' class='ion-android-favorite-outline'></i>" + count + " " + lecount);
                    }
                }
            });
        });
        
    }
    
    // Check Browser
    function CheckBrowser() {
        //Check if Safari
        if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1) {
            $('html').addClass('safari');
        }
        //Check if MAC
         if(navigator.userAgent.indexOf('Mac')>1){
           $('html').addClass('safari');
         }
        // Add class IE
        var ms_ie = false;
        var ua = window.navigator.userAgent;
        var old_ie = ua.indexOf('MSIE ');
        var new_ie = ua.indexOf('Trident/');
        if ((old_ie > -1) || (new_ie > -1)) {
            ms_ie = true;
        }
        if ( ms_ie ) {
           jQuery('body').addClass('ie-11');
        }
        if(document.getElementById("defaultOpen")){
         // Get the element with id="defaultOpen" and click on it
            document.getElementById("defaultOpen").click();   
        }
        function is_Rirefox(){
         return /^((?!firefox).)*firefox/i.test(navigator.userAgent);
        }
        if(navigator.userAgent.indexOf('Firefox') > -1) {
            jQuery('body').addClass('firefox');
        }
    }
    function loadMore(){
        var $j = jQuery.noConflict();
        var $container = $j('.load-item');
        var $container_v1=$j('.load-item_v1');
        var i = 1;
        var paged = $('.load_more_button span').data('paged');
        var page = paged ? paged + 1 : 2;
        $j('.load_more_button a').off('click tap').on('click tap', function(e)  {
            e.preventDefault();
            var el = $(this);
            $j('.load_more_button a').append('<i class="fa fa-spinner fa-spin"></i>');
            el.addClass('hide-loadmore');
            var link = $j(this).attr('href');
            var $content = '.load-item';
            var  $content_v1 = '.load-item_v1';
            var $anchor = '.load_more_button a';
            var $next_href = $j($anchor).attr('href');
            $j.get(link+'', function(data){
                $j('.load-more').find('.fa-spin').remove();
                el.removeClass('hide-loadmore');
                var $new_content = $j($content, data).wrapInner('').html();
                var $new_content_v1 =  $j($content_v1, data).wrapInner('').html();
                $next_href = $j($anchor, data).attr('href');
                $container.append( $j( $new_content) ).isotope( 'reloadItems' ).isotope({ sortBy: 'original-order' });
                $container_v1.append( $j($new_content_v1) );

                setTimeout(function() {
                    $j('.load-item').isotope( 'layout');
                }, 400);

                if($j('.load_more_button p').attr('data-totalpage') > i) {
                    $j('.load_more_button a').attr('href', $next_href); // Change the next URL
                } else {
                    $j('.load_more_button').remove();
                }

            });
            i++;
        });
    }

    //Filter Isotop Window Load
    function FilterIsotopLoad() {
        $('.grid-isotope').isotope({
            itemSelector: '.grid-item',
            layoutMode: 'fitRows',
            getSortData: {
                name: '.grid-item',
            }
        });
        
        $('.gallery-entries-wrap').isotope({
            itemSelector: '.item',
            layoutMode: 'fitRows',
            getSortData: {
                name: '.item',
            }
        });
        $('.btn-filter').on( 'click', '.button', function() {
            var filterValue = $(this).attr('data-filter');
            container.isotope({ filter: filterValue });
        });
        $('.btn-filter').each( function( i, buttonGroup ) {
            var buttonGroup = $(buttonGroup);
            buttonGroup.on( 'click', '.button', function() {
                buttonGroup.find('.active').removeClass('active');
                $(this).addClass('active');
            });
        });
        
    }
    // Srcoll Top
    function ScrollTop() {
        if ($('.scroll-to-top').length) {
            $(window).scroll(function () {
                if ($(this).scrollTop() > $('#page:not(.fixed-header) .site-header').height() +40) {
                    if($('header').hasClass('header-bottom')){
                        $('.scroll-to-top').css({bottom: "90px"});
                    }else{
                        $('.scroll-to-top').css({bottom: "25px"});
                    }
                    
                } else {
                    $('.scroll-to-top').css({bottom: "-100px"});
                }
            });

            $('.scroll-to-top').click(function () {
                $('html, body').animate({scrollTop: '0px'}, 800);
                return false;
            });
        }
        if ($('.up-top').length) {
            $('.up-top').click(function () {
                $('html, body').animate({scrollTop: '0px'}, 800);
                return false;
            });
        }
    }

    // Funcition Click
    function beer_pub_click(){
        $('.btn-search').on('click', function(e){
            toggleFilter(this);
        });
        $('.current-open').on('click', function(e){
            toggleFilter(this);
        });
        // filter items on button click Gallery
        var $gridGallery = $('.isotope');
        $('.button-group').on( 'click', 'button', function() {
          var filterValueGallery = $(this).attr('data-filter');
          $gridGallery.isotope({ filter: filterValueGallery });
          $('.button-group button').removeClass('is-checked');
          $(this).addClass('is-checked');
          $(this).parent('gallery_header').addClass('is-checked');
            
        }); 
        
        // filter items on button click Blog
        var $grid = $('.grid-isotope');
        $('.button-group').on( 'click', 'button', function() {
          var filterValue = $(this).attr('data-filter');
          $grid.isotope({ filter: filterValue });
          $('.button-group button').removeClass('is-checked');
          
        }); 
    }
    // Submenu hover left
    function FixSubMenu(){
        $('.mega-menu > li:not(.megamenu)').mouseover(function(){
            var wapoMainWindowWidth = $(window).width();
            // checks if third level menu exist
            var subMenuExist = $(this).children('.sub-menu').length;
            if( subMenuExist > 0){
                var subMenuWidth = $(this).children('.sub-menu').width();
                var subMenuOffset = $(this).children('.sub-menu').parent().offset().left + subMenuWidth;
                // if sub menu is off screen, give new position
                if((subMenuOffset + subMenuWidth) > wapoMainWindowWidth){
                    var newSubMenuPosition = subMenuWidth;
                    $(this).addClass('left_side_menu');
                }else{
                    var newSubMenuPosition = subMenuWidth;
                    $(this).removeClass('left_side_menu');
                }
            }
        });
    }
    
    // Fix Height Content
    function HeightContent(){
        // Fix Height contact
        var wdw = $(window).width();
        if(wdw > 992){
            var heightSidebar = $('.active-sidebar').height(); 
            $('.contact-form').css('height', heightSidebar + 178 + 'px');   
        }
        // Fix Height Instagram
        $('.instagram-type6 .instagram-img').height($('.instagram-type6 .instagram-img').width());
        
        var heightHeader = $('.site-header').height();
        var heightFooter = $('footer').height();
        if($(window).width() < 992){
            if($('.site-header').hasClass('header-bottom')){
                $('footer').css('margin-bottom', heightHeader + 'px');
            }
        }
        if($(window).width() > 767){
            if($('#page').hasClass('footer-fixed')){
                $('#page').css('margin-bottom', heightFooter + 'px');
            }
        }
        
        // Fix Height menu vertical
        var height = $(window).height();
        var heightNav = $('.header-sidebar').height();
        var heightNavMenu = $('.mega-menu').height();   
        if( heightNav > height ){
            $('.header-ver').addClass('header-scroll');
        }
        if($(window).width() < 992){
            if( heightNavMenu > height ){
                $('.header-center').addClass('header-scroll');
            }
        }
    }
    // Menu
    function MainMenu(){
        $(".mega-menu .caret-submenu").on('click', function(e){
           $(this).toggleClass('active');
           $(this).siblings('.sub-menu').toggle(300);
        });
        
        //Add class category
        $('.widget_categories ul').each(function(){
            if($(this).hasClass('children')) {
                $(this).parent().addClass('cat-item-parent');
            } 
        }); 
        // Menu Category Sidebar  
        $("<p></p>").insertAfter(".widget_categories ul > li > a");
        var $p = $(".widget_categories ul > li p");
        $(".widget_categories ul > li:not(.current-cat):not(.current-cat-parent) p").append('<span><i class="fab fa-angle-right"></i></span>');
        $(".widget_categories ul > li.current-cat p").append('<span><i class="fab fa-angle-down"></i></span>');
        $(".widget_categories ul > li.current-cat-parent p").append('<span><i class="fab fa-angle-down"></i></span>');
        $(".widget_categories ul > li:not(.current-cat):not(.current-cat-parent) > ul").hide();

        $(".widget_categories ul > li").each(function () {
            if ($(this).find("ul > li").length == 0) {
                $(this).find('p').remove();
            }

        });

        $p.click(function () {
            var $accordion = $(this).nextAll('ul');

            if ($accordion.is(':hidden') === true) {

                $(".widget_categories ul > li > ul").slideUp();
                $accordion.slideDown();

                $p.find('span').remove();
                $p.append('<span><i class="fab fa-angle-right"></i></span>');
                $(this).find('span').remove();
                $(this).append('<span><i class="fab fa-angle-down"></i></span>');
            }
            else {
                $accordion.slideUp();
                $(this).find('span').remove();
                $(this).append('<span><i class="fab fa-angle-right"></i></span>');
            }
        });
        
        // Menu Lever 2
        $("<p></p>").insertAfter(".widget_categories ul > li > ul > li > a");
        var $pp = $(".widget_categories ul > li > ul > li p");
        $(".widget_categories ul > li >ul >li > ul").hide();
        $(".widget_categories ul > li > ul > li p").append('<span><i class="fab fa-angle-right"></i></span>');

        $(".widget_categories ul > li > ul > li").each(function () {
            if ($(this).find("ul > li").length == 0) {
                $(this).find('p').remove();
            }
        });

        $pp.click(function () {
            var $accordions = $(this).nextAll('ul');

            if ($accordions.is(':hidden') === true) {

                $(".widget_categories ul > li > ul > li > ul").slideUp();
                $accordions.slideDown();

                $pp.find('span').remove();
                $pp.append('<span><i class="fab fa-angle-right"></i></span>');
                $(this).find('span').remove();
                $(this).append('<span><i class="fab fa-angle-down"></i></span>');
            }
            else {
                $accordions.slideUp();
                $(this).find('span').remove();
                $(this).append('<span><i class="fab fa-angle-right"></i></span>');
            }
        });
        
        // Menu Lever 3
        $("<p></p>").insertAfter(".widget_categories ul > li > ul > li > ul > li > a");
        var $ppp = $(".widget_categories ul > li > ul > li > ul > li p");
        $(".widget_categories ul > li > ul > li > ul > li > ul").hide();
        $(".widget_categories ul > li > ul > li > ul > li p").append('<span><i class="fab fa-angle-right"></i></span>');
        
        $(".widget_categories ul > li > ul > li > ul > li").each(function () {
            if ($(this).find("ul > li").length == 0) {
                $(this).find('p').remove();
            }
        });
        
        $ppp.click(function () {
            var $accordions = $(this).nextAll('ul');

            if ($accordions.is(':hidden') === true) {

                $(".widget_categories ul > li > ul > li > ul > li > ul").slideUp();
                $accordions.slideDown();

                $ppp.find('span').remove();
                $ppp.append('<span><i class="fab fa-angle-right"></i></span>');
                $(this).find('span').remove();
                $(this).append('<span><i class="fab fa-angle-down"></i></span>');
            }
            else {
                $accordions.slideUp();
                $(this).find('span').remove();
                $(this).append('<span><i class="fab fa-angle-right"></i></span>');
            }
        });
        
        // Vertical Menu
        var $bdy = $('html');
        $('.open-menu-mobile').on('click',function(e){
            $('.overlay').addClass('overlay-menu');
            if($bdy.hasClass('openmenu')) {
                jsAnimateMenu2('close');
            } else {
                jsAnimateMenu2('open');
            }
        });
        $('.close-menu-mobile').on('click',function(e){
            if($bdy.hasClass('openmenu')) {
                jsAnimateMenu2('close');
            } else {
              jsAnimateMenu2('open');
            }
        });
        
        $('a[href$="#"]').on('click', function(e){
            e.preventDefault();
        });
        
        $('.overlay').on('click', function(){
            if($('html').hasClass('openmenu')){
                $('html').removeClass('openmenu');
            }
        });
    }
    
    //Validate Form
    function ValidateForm(){
        if(beer_pub_params.beer_pub_valid_form == 'yes'){
          $('#commentform').validate();
        }
    }   
    //Animation
    function CssAnimation(){
        if(beer_pub_params.beer_pub_animation == 'yes'){
            $('.animated').appear(function() {
                var item = $(this);
                var animation = item.data('animation');
                if ( !item.hasClass('visible') ) {
                    var animationDelay = item.data('animation-delay');
                    if ( animationDelay ) {
                        setTimeout(function(){
                            item.addClass( animation + " visible" );
                        }, animationDelay);
                    } else {
                        item.addClass( animation + " visible" );
                    }
                }
            });
        }
    }       

    // Fix Height Content
    function HeightContentResize() {
        var h = $(window).height();

        var heightHeader = $('.site-header').height();
        var heightFooter = $('footer').height();
        var wdw = $(window).width();
        if($(window).width() < 992){
            if($('.site-header').hasClass('header-bottom')){
                $('footer').css('margin-bottom', heightHeader + 'px');
            }
        }
        if(wdw > 992){
            var heightSidebar = $('.active-sidebar').height(); 
            $('.contact-form').css('height', heightSidebar + 178 + 'px');   
        }
        if($(window).width() > 767){
            if($('#page').hasClass('footer-fixed')){
                $('#page').css('margin-bottom', heightFooter + 'px');
            }
        }

        // Instagram fix height
        $('.instagram-type6 .instagram-img').height($('.instagram-type6 .instagram-img').width());
        
        // Fix height header vertical
        var height = $(window).height();
        var heightNav = $('.header-sidebar').height();
        var heightNavMenu = $('.mega-menu').height();
        
        if( heightNav > height ){
            $('.header-ver').addClass('header-scroll');
        }
        if($(window).width() < 992){
            if( heightNavMenu > height ){
                $('.header-center').addClass('header-scroll');
            }
        }
    }

	/*Does something when user scrolls to it OR
	Does it when user has reached the bottom of the page and hasn't triggered the function yet
	animation info skill*/
	function checkScroll(element){
        if (element.length) {
            var element_position = element.offset().top;
            var screen_height = $(window).height();
            var activation_offset = 0.5;//determines how far up the the page the element needs to be before triggering the function
            var activation_point = element_position - (screen_height * activation_offset);
            var max_scroll_height = $('body').height() - screen_height - 5;//-5 for a little bit of buffer
            var y_scroll_pos = window.pageYOffset;
            var element_in_view = y_scroll_pos > activation_point;
            var has_reached_bottom_of_page = max_scroll_height <= y_scroll_pos && !element_in_view;
            if(element_in_view || has_reached_bottom_of_page ) return true;
        }
	}
    
    function beer_pub_animate(){
        if(checkScroll($('.block-welcome'))==true)
           {
                $('.skill-item').each(function(i){
					var width_progress = $(this).find('.progress .progress-bar').attr('aria-valuenow');
                    setTimeout(function(){
                        $('skill-item .progress .progress-bar').eq(i).addClass('is_run');
                        
                    },200);
					$(this).find('.progress .progress-bar').css("width", width_progress+"%");
                })
            }
        if(checkScroll($('.block-experience'))==true){
            $('.block-experience .experience-list ul li').addClass('fadeInUp');
        }
        if(checkScroll($('.block-edu'))==true){
            $('.block-edu .block-edu-list ul li').addClass('fadeInUp');
        }
        if(checkScroll($('.block-portfolio'))==true){
            $('.block-portfolio .title-homepage').addClass('fadeInUp');
            $('.block-portfolio  p').addClass('fadeInUp');
        }
        if(checkScroll($('.block-blog'))==true){
            $('.block-blog .blog-list ul li:nth-child(2n+1)').addClass('fadeInLeft');
            $('.block-blog .blog-list ul li:nth-child(2n+2)').addClass('fadeInRight');
        }
    }
    $(window).on('scroll', function() {
       beer_pub_animate();
    });
    /**
     * DOMready event.
     */
    $( document ).ready( function() {
        LikeCountGallery();
        CheckBrowser();
        beer_pub_click();
        seoizRemoveActive();
        HeightContent();
        MainMenu();
        FixSubMenu();
        ValidateForm();
        CssAnimation();  
        SetChildWidth();
        beer_pub_AutocompleteSearch();
        FilterIsotopLoad();
        loadMore();
    });
    $(window).resize(function () {
        HeightContentResize();
        loadMore();
        if($(window).width() < 992){
            seoizRemoveActive();
        }
    });
    $(window).load(function() {
        ScrollTop();
        FilterIsotopLoad();
        beer_pub_animate();
        loadMore();
    });
		
	$('.testimonial-slider').slick({
		infinite: true,
		dots: false,
        slidesToShow: 1,
        slidesToScroll: 1,
		prevArrow: $('.prev'),
		nextArrow: $('.next'),
	});	

})(jQuery);

function jsAnimateMenu2(tog) {
    if(tog == 'open') {
      jQuery('html').addClass('openmenu');
    }
    if(tog == 'close') {
      jQuery('html').removeClass('openmenu');
    }
}       
// Active Search
function toggleFilter(obj){
    if(jQuery(window).width() < 1199){
        if(jQuery(obj).parent().find('> .content-filter').hasClass('active')){
            jQuery(obj).parent().find('> .content-filter').removeClass('active');  
            jQuery(obj).removeClass('btn-active');                         
        }else{
            jQuery('.btn-search, .languges-flags > a').removeClass('btn-active');
            jQuery('.content-filter').removeClass('active');
            jQuery(obj).parent().find(' > .content-filter').addClass('active');   
            jQuery(obj).addClass('btn-active');           
        }
    }
}

