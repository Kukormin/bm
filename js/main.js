$(document).ready(function() {
    var touch = $('.mobile-menu');
    var menu = $('.main-menu');


    $(touch).on('click', function(e) {
        e.preventDefault();
        menu.toggleClass('opened');
    });


});
$(document).mouseup(function(e) {
    var div = $('.main_menu,.mobile-menu');
    var m_menu = $('.main_menu');
    var m_close = $('.mobile-menu');
    if (!div.is(e.target) && div.has(e.target).length === 0) {
        m_menu.removeClass('opened');
        m_close.removeClass('toggled-on');
    }
});

$(document).ready(function() {
    $('.owl-carousel').length && $('.owl-carousel').owlCarousel({
        items: 6,
        loop: true,
        nav: true,
        dots: false,
        margin: 5,
        navText: ["<div class='arrow-left'></div>", "<div class='arrow-right'></div>"],
        callbacks: true,
        URLhashListener: true,
        autoplayHoverPause: true,
        startPosition: 'URLHash',
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            600: {
                items: 3,
                nav: false
            },
            1000: {
                items: 5,
                nav: true
            },
            1200: {
                items: 6,
                nav: true
            }
        }
    });
    $('.owl-carousel-2').length && $('.owl-carousel-2').owlCarousel({
        items: 1,
        loop: false,
        margin: 10,
        dots: false,
        callbacks: true,
        URLhashListener: true,
        autoplayHoverPause: true,
        startPosition: 'URLHash'
    });
    $('.sale-items-list').length && $('.sale-items-list').owlCarousel({
        items: 1,
        nav: true,
        loop: true,
        navText: ["&#10229;", "&#10230;"],
        dots: true
    });

    $('.new-items-slider').length && $('.new-items-slider').owlCarousel({
        items: 1,
        nav: true,
        navText: ["&#10229;", "&#10230;"],
        dots: true,
        loop: true
    });
    $('.sec-list-items').length && $('.sec-list-items').owlCarousel({
        items: 1,
        nav: true,
        navText: ["&#10229;", "&#10230;"],
        dots: true,
        loop: true
    });
    $('.popular-goods-list').length && $('.popular-goods-list').owlCarousel({
        items: 4,
        nav: true,
        navText: ["<div class='arrow-left'></div>", "<div class='arrow-right'></div>"],
        dots: false,
        loop: true,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            450: {
                margin: 15,
                items: 2,
                nav: true
            },
            1000: {
                items: 3,
                nav: true
            },
            1200: {
                items: 4,
                nav: true
            }
        }
    });


    /*$('.product-slider__wrap').owlCarousel({
        items: 1,
        dots: true
    });*/
    $('.product-slider__wrap').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        prevArrow: false,
        nextArrow: false,
        asNavFor: '.product-slider__pager-items',
    });
    $('.product-slider__pager-items').slick({
        vertical: true,
        slidesToShow: 5,
        slidesToScroll: 1,
        infinite: true,
        swipe: true,
        prevArrow: $('.product-slider__prev'),
        nextArrow: $('.product-slider__next'),
        asNavFor: '.product-slider__wrap',
        focusOnSelect: true,
        draggable: true,
        responsive: [
            {
                breakpoint: 650,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 1,
                    infinite: true,
                    vertical: false,
                    prevArrow: false,
                    nextArrow: false,
                    centerMode: true,
                    centerPadding: '5px'
                },
            },
            {
                breakpoint: 430,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    infinite: true,
                    vertical: false,
                    prevArrow: false,
                    nextArrow: false,
                    centerMode: true,
                    centerPadding: '3px'
                },
            },
            {
                breakpoint: 345,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    infinite: true,
                    vertical: false,
                    prevArrow: false,
                    nextArrow: false,
                    centerMode: true,
                    centerPadding: '5px'
                },
            }
        ]
    });


    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.slider-nav'
    });
    $('.slider-nav').slick({
        slidesToShow: 7,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        arrows: true,
        dots: false,
        focusOnSelect: true
    });
    $(".new-items-switch>div:first-child>a").focus();
});
$(document).ready(function() {
    var touch = $('.mobile-menu');
    var menu = $('.main_menu');

    $(touch).on('click', function(e) {
        e.preventDefault();
        menu.toggleClass('opened');
    });


    var touch_catalog = $('#catalog-menu1');
    var menu_catalog = $('.catalog-hover');

    $(touch_catalog).on('click', function(e) {
        e.preventDefault();
        menu_catalog.toggleClass('opened');
    });


    $('.mobile-menu').on('click', function() {
        $(this).toggleClass('toggled-on');
    });
    $('#catalog-menu1').on('click', function() {
        $(this).toggleClass('toggled-on');
    });

    $("#popup-mail").fancybox({
        padding: 0,
        tpl: {
            closeBtn: '<a title="Close" class="fancybox-item fancybox-close myClose" href="javascript:;"></a>'
        }
    });
    $("#popup-call").fancybox({
        padding: 0,
        tpl: {
            closeBtn: '<a title="Close" class="fancybox-item fancybox-close myClose" href="javascript:;"></a>'
        }
    });

    /***********TABS********************/


    var n;
    $(".tabs-panel>a").on("click", function() {
        n = $(this).parents(".property-tabs"), $(this).tabs(n);
    }), jQuery.fn.tabs = function(n) {
        $(this).addClass("active").siblings().removeClass("active"), n.find(".tab").eq($(this).index()).show(1, function() {
            $(this).addClass("open-tab")
        }).siblings(".tab").hide(1, function() {
            $(this).removeClass("open-tab")
        })
    }



    /***********TABS END********************/

});

$(document).ready(function() {
    $(window).scroll(function() {
        if ($(this).scrollTop() != 0) {
            $('.search-fix').fadeIn();
        } else {
            $('.search-fix').fadeOut();
        }
    });
    $(window).scroll(function() {
        if ($(this).scrollTop() != 0) {
            $('.toTop').fadeIn();
        } else {
            $('.toTop').fadeOut();
        }
    });

    $('.toTop').click(function() {
        $('body,html').animate({ scrollTop: 0 }, 800);
    });

    $(".main-nav").sticky({ topSpacing: 0, zIndex: '1000' });
});
$(document).ready(function() {
    $(".new-items-switch div:first-child a").addClass("active");
    $(".new-items-switch a").click(function() {
        $(".new-items-switch a").removeClass("active");
        $(this).addClass("active");
    });
});

$(document).ready(function() {
    $(".tabs input").click(function(e) {
        e.preventDefault();
        $(".tabs input").removeClass('active');
        $(this).addClass('active');
    })
});
$(document).ready(function() {
    $(".tabs input.list").click(function(e) {
        e.preventDefault();
        $(".tabs input").removeClass('active');
        $('.tabs input.list').addClass('active');
    })
});
/*$(function() {
  $(".tabs .kmv").click(function(e) {
    e.preventDefault();
    $(".tabs .kmv").removeClass('active');
     $(".tabs .maps").removeClass('active');
    $(this).addClass('active');
  })
});
$(function() {
  $(".tabs .stav").click(function(e) {
    e.preventDefault();
    $(".tabs .stav").removeClass('active');
    $(".tabs .maps").removeClass('active');
    $(this).addClass('active');
  })
});*/
$(document).ready(function($) {


    function doAnimations(elems) {

        var animEndEv = 'webkitAnimationEnd animationend';

        elems.each(function() {
            var $this = $(this),
                $animationType = $this.data('animation');
            $this.addClass($animationType).one(animEndEv, function() {
                $this.removeClass($animationType);
            });
        });
    }


    var $myCarousel = $('.top-banner'),
        $firstAnimatingElems = $myCarousel.find('.item-banner:first').find("[data-animation ^= 'animated']");



    $myCarousel.length && $myCarousel.owlCarousel({
        items: 1,
        animateOut: 'fadeOut',
        autoplay: true,
        autoplayTimeout: 7000,
        nav: true,
        navText: ["<div class='arrow-left'></div>", "<div class='arrow-right'></div>"],
        dots: true,
        loop: true,
        rewindNav: true,
        autoplayHoverPause: true

    });


    doAnimations($firstAnimatingElems);


    $myCarousel.on('changed.owl.carousel', function(event) {
        var $animatingElems = $(event.target).find("[data-animation ^= 'animated']");
        doAnimations($animatingElems);
    });

});
$(document).ready(function() {
    var submitIcon = $('.top-section .searchbox-icon');
    var inputBox = $('.top-section .searchbox-input');
    var searchBox = $('.top-section .searchbox');
    var isOpen = false;
    submitIcon.click(function() {

        if (isOpen == false) {
            searchBox.addClass('searchbox-open');
            inputBox.focus();
            isOpen = true;
        } else {
            searchBox.removeClass('searchbox-open');
            inputBox.focusout();
            isOpen = false;
        }
    });
    submitIcon.mouseup(function() {
        return false;
    });
    searchBox.mouseup(function() {
        return false;
    });
    $(document).mouseup(function() {
        if (isOpen == true) {
            $('.top-section .searchbox-icon').css('display', 'block');
            submitIcon.click();
        }
    });
});


$(document).ready(function() {
    var submitIcon2 = $('.search-fix .searchbox-icon');
    var inputBox2 = $('.search-fix .searchbox-input');
    var searchBox2 = $('.search-fix .searchbox');
    var isOpen = false;
    submitIcon2.click(function() {

        if (isOpen == false) {
            searchBox2.addClass('searchbox-open');
            inputBox2.focus();
            isOpen = true;
        } else {
            searchBox2.removeClass('searchbox-open');
            inputBox2.focusout();
            isOpen = false;
        }
    });
    submitIcon2.mouseup(function() {
        return false;
    });
    searchBox2.mouseup(function() {
        return false;
    });
    $(document).mouseup(function() {
        if (isOpen == true) {
            $('.search-fix .searchbox-icon').css('display', 'block');
            submitIcon2.click();
        }
    });
});

function buttonUp() {
    var inputVal = $('.top-section .searchbox-input').val();
    inputVal = $.trim(inputVal).length;
    if (inputVal !== 0) {
        $('.top-section .search-link').css('display', 'none');
    } else {
        $('.top-section .searchbox-input').val('');
        $('.top-section .search-link').css('display', 'block');
    }
    var inputVal2 = $('.search-fix .searchbox-input').val();
    inputVal2 = $.trim(inputVal2).length;
    if (inputVal2 !== 0) {
        $('.search-fix .search-link').css('display', 'none');
    } else {
        $('.search-fix .searchbox-input').val('');
        $('.search-fix .search-link').css('display', 'block');
    }
};



$(document).ready(function() {
    $("select.catalog-search").each(function() {
        var sb = new SelectBox({
            selectbox: $(this),
            height: 150,
            width: 200
        });
    });

});

$(document).ready(function() {
    $('a#m_search_form').click(function(event) {
        event.preventDefault();
        $('#overlay').fadeIn(400,
            function() {
                $('#modal_search_form')
                    .css('display', 'block')
                    .animate({ opacity: 1, top: '0%' }, 200);
            });
    });

    $('#modal_close, #overlay').click(function() {
        $('#modal_search_form')
            .animate({ opacity: 0, top: '0%' }, 200,
                function() {
                    $(this).css('display', 'none');
                    $('#overlay').fadeOut(400);
                }
            );
    });

    $('.image-clicked').on('click',function (e) {
        e.preventDefault();
        var content = $(this).attr('src');
        $.fancybox.open("<img src='"+content+"'>");
    });
    $('.owl-certificate').owlCarousel({
        items: 6,
        loop: true,
        nav: true,
        dots: false,
        margin: 5,
        navText: ["<div class='arrow-left'></div>", "<div class='arrow-right'></div>"],
        callbacks: true,
        URLhashListener: true,
        autoplayHoverPause: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            600: {
                items: 1,
                nav: false
            },
            1000: {
                items: 2,
                nav: true
            },
            1200: {
                items: 4,
                nav: true
            }
        }
    });
});
