(function($) {
    // Selectric
    // function selectricGforms() {
    //     $('.gform_wrapper select').selectric({
    //         disableOnMobile: false,
    //         nativeOnMobile: false,
    //         responsive: true,
    //         maxHeight: 264
    //     });
    // }
    //selectricGforms();
    // Slick - Global settings
    var slick_previous = '<button class="slick-arrow--previous"><i class="fas fa-chevron-left" aria-hidden="true"></i><span class="screen-reader-text">Previous</span></button>';
    var slick_next = '<button class="slick-arrow--next"><i class="fas fa-chevron-right" aria-hidden="true"></i><span class="screen-reader-text">Next</span></button>';
    // Slick - Single Slide 
    $('.js-slick-single').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        arrows: true,
        prevArrow: slick_previous,
        nextArrow: slick_next,
        dots: false,
        speed: 600,
        cssEase: 'ease-in-out',
        lazyLoad: 'ondemand'
    });
    $('.hero').slick({
        dots: false,
        arrows: true,
        infinite: true,
        prevArrow: slick_previous,
        nextArrow: slick_next,
        speed: 500,
        fade: true,
        cssEase: 'linear',
        responsive: [{
            breakpoint: 1140,
            settings: {
                arrows: false,
            },
        }, ]
    });
    $('.js-slick-single img').load(function() {
        $(this).addClass('slick-loaded');
        $(this).prev('.spinner').fadeOut().remove();
    });
    // Toggle offscreen menu
    $('.js-nav-toggle').click(function(e) {
        e.preventDefault();
        $(this).toggleClass('hamburger--active');
        $('.offscreen').toggleClass('offscreen--active');
        $('body').toggleClass('body--offscreen-active');
    });
    // Superfish dropdown
    $('.nav--primary').superfish();
    // Close nav on anchor click
    $('.offscreen a[href^="#"]').click(function(event) {
        $('.js-nav-toggle').trigger("click");
    });
    // Smooth scroll for anchor links
    $('.js-link-anchor, .js-link-anchor a').click(function() {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top
                }, 1000);
                return false;
            }
        }
    });
    // Magnific Popup - Standard
    $('.js-magnific-popup').magnificPopup({
        type: 'inline',
        closeBtnInside: true,
        closeMarkup: '<button title="%title%" type="button" class="mfp-close"></button>',
        midClick: true
    });
    // Magnific Popup - Video
    $('.js-magnific-video').magnificPopup({
        type: 'inline',
        midClick: true,
        callbacks: {
            open: function() {
                // Play video on open
                $(this.content).find('video')[0].play();
                var p = $(this.content).find('video')[0].player;
                p.setPlayerSize();
                p.setControlsSize();
            },
            close: function() {
                // Reset video on close
                $(this.content).find('video')[0].load();
            }
        }
    });
    // Magnific Popup - Ajax
    $('.js-magnific-ajax').magnificPopup({
        type: 'ajax',
        closeBtnInside: true,
        closeOnContentClick: false,
        closeOnBgClick: false,
        // removalDelay: 800, // Delay removal for animation
        tLoading: '<div class="spinner"></div>',
    });
    // Infinite Scroll
    // Infinite Scroll - Settings
    $container = $('.js-infinite-parent');
    $container.infiniteScroll({
        path: '.nav--pagination a',
        append: '.js-infinite-item',
        history: false,
        checkLastPage: true,
        scrollThreshold: 200
    });
    // Infinite Scroll - Loaded
    $container.on('append.infiniteScroll', function(event, response, path, items) {
        $('.js-match-height').matchHeight();
    });
    // Infinite Scroll - Last Page
    $container.on('last.infiniteScroll', function(event, response, path) {
        $('.nav-pagination').fadeOut().remove();
    });
    // Equal Heights
    $('.js-match-height').matchHeight();

    $('.gfield').matchHeight({
        property: 'min-height'
    });
    // Sticky header
    var headerHeight = $('.header').outerHeight();
    if ($(window).scrollTop() >= headerHeight) {
        $('.header').addClass('header--sticky');
    }
    $(window).scroll(function() {
        var sticky = $('.header'),
            scroll = $(window).scrollTop();
        if (scroll >= headerHeight) sticky.addClass('header--sticky');
        else sticky.removeClass('header--sticky');
    });
    // Accordion
    $('.accordion__item__content').hide(); // Close all accordions
    $('.js-accordion-toggle').click(function(e) {
        e.preventDefault();
        var accordion_id = $(this).data('target');
        if ($(this).parent().hasClass('accordion__item--active')) { // If the accordion is already open
            $('.accordion__item').removeClass('accordion__item--active');
            $('.accordion__item__content').slideUp();
            $(this).parent().removeClass('accordion__item--active');
            $('#' + accordion_id).slideUp();
        } else { // Else if the accordion is not open
            $('.accordion__item').removeClass('accordion__item--active');
            $('.accordion__item__content').slideUp();
            $(this).parent().addClass('accordion__item--active');
            $('#' + accordion_id).slideDown();
        }
    });
    // Responsive videos
    $('.js-fitvids').fitVids();
    // Lazy Loading images
    var bLazy = new Blazy({
        selector: '.b-lazy',
        loadInvisible: true,
        offset: 200,
        success: function(element) {
            $(element).prev('.spinner').fadeOut().remove();
        }
    });
    // Gravity Forms
    // $(document).bind('gform_post_render', function() {
    //     selectricGforms();
    // });


    // Bind to the resize event of the window object
    $(window).on("load resize", function() {
        var cs = $('.cherished__square').width();
        $('.cherished__square').css({ 'height': cs + 'px' });

        // var tl = $('.tab__label').outerWidth();
        // $('.tab__label').css({ 'height': tl + 'px' });


        var headContact = $('.header__contact').outerHeight(true);
        var header = $('.header').outerHeight(true);
        var totalHead = headContact + header;
        $('.offscreen').css({ 'top': totalHead });

        // Invoke the resize event immediately
    }).resize();

    $('.donations__amount-button a').click(function(e) {
        e.preventDefault();
        $value = $(this).attr("data-donation");
        $(".custom-donation-input").val($value);
    });

    $('.charitable__form').click(function(e) {
        e.preventDefault();

        var formDiv = ".charitable-fieldset-form-details";

        $(formDiv).slideDown();
        $('.charitable-submit-field').slideDown();
        $('#charitable-gateway-fields').slideDown();

        $('html, body').animate({
            'scrollTop': $(formDiv).offset().top
        }, 2000);

    });

    $('.donations__amount-button').click(function(e) {
        var screen = $(window);
        if (screen.width() < 1050) {
            $('html, body').animate({
                'scrollTop': $('#charitable_field_recurring_donation').offset().top
            }, 2000);
        }

    });

    // var $buttonMinus = $('.qty_button.minus');
    // var $buttonPlus = $('.qty_button.plus');

    // $buttonMinus.click(function() {
    //     var $counter = $(this).parent().find('.prodCount');
    //     if ($counter.val() >0) {
    //         $counter.val(parseInt($counter.val()) - 1); // `parseInt` converts the `value` from a string to a number
    //     }
    // });

    // $buttonPlus.click(function() {
    //     var $counter = $(this).parent().find('.prodCount');
    //     $counter.val(parseInt($counter.val()) + 1); // `parseInt` converts the `value` from a string to a number
    // });

})(jQuery);
// WP Facet - when content changes
(function($) {
    $(document).on('facetwp-refresh', function() { // Before Filtering
        // Animate
        $('.facetwp-template').animate({ opacity: 0 }, 500);
    });
    $(document).on('facetwp-loaded', function() { // Finished Filtering
        // Animate template in
        $('.facetwp-template').animate({ opacity: 1 }, 500);
        // Initialize lazy loading
        //var bLazy = new Blazy();
        if (FWP.loaded) {
            $('html, body').animate({
                scrollTop: $('.facet-controls').offset().top
            }, 500);
        }
    });

    //Add data-column to all thead tables
    // Take TH and add it to each TD

    $("table").each(function(index) {
        var arr = [];
        $("th", this).each(function(index) {
            var value = $(this).text();
            arr.push(value);
        });
        var i;
        for (i = 0; i < arr.length; ++i) {
            spot = i - 1;
            $("tbody td:nth-child(" + i + ")", this).attr('data-column', arr[spot]);
        }
    });

    //close charity signup box on page load
    $(window).on("load", function() {
        if ($('#charitable-donation-login-form').length) {
            $('#charitable-donation-login-form').addClass('charitable-hidden');
        }
    });
})(jQuery);