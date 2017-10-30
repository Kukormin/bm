$(document).ready(function(){
var touch = $('.mobile-menu');
	var menu = $('.main-menu');
	
	$(touch).on('click', function(e){
		e.preventDefault();
		menu.toggleClass('opened');
	});
	
});
 $(document).ready(function() {
  $('.owl-carousel').owlCarousel({
	items: 6,
	loop: false,
	nav:true,
	dots:false,
	margin: 5,
	navText : ["<div class='arrow-left'></div>","<div class='arrow-right'></div>"],
	callbacks: true,
	URLhashListener: true,
	autoplayHoverPause: true,
	startPosition: 'URLHash',
	responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:3,
            nav:false
        },
        1000:{
            items:5,
            nav:true,
            loop:false
        },
		1200:{
            items:6,
            nav:true,
            loop:false
        }
    }
  });
   $('.owl-carousel-2').owlCarousel({
	items: 1,
	loop: false,
	margin: 10,
	dots:false,
	callbacks: true,
	URLhashListener: true,
	autoplayHoverPause: true,
	startPosition: 'URLHash'
  });
   $('.sale-items-list').owlCarousel({
	items: 1,
	nav:true,
	navText : ["&#10229;","&#10230;"],
	dots:true,
	loop: false
  });
 $('.top-banner').owlCarousel({
	items: 1,
	nav:true,
	navText : ["<div class='arrow-left'></div>","<div class='arrow-right'></div>"],
	dots:true,
	loop: false
  });
  $('.new-items-slider').owlCarousel({
	items: 1,
	nav:true,
	navText : ["&#10229;","&#10230;"],
	dots:true,
	loop: false
  });
    $('.popular-goods-list').owlCarousel({
	items: 4,
	nav:true,
	navText : ["<div class='arrow-left'></div>","<div class='arrow-right'></div>"],
	dots:false,
	loop: true,
	autoplay:true,
	autoplayTimeout:3000,
	autoplayHoverPause:true,
	responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        450:{
			margin:15,
            items:2,
            nav:true
        },
        1000:{
            items:3,
            nav:true,
            loop:false
        },
		1200:{
            items:4,
            nav:true,
            loop:false
        }
    }
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
$(document).ready(function(){
	var touch = $('.mobile-menu');
	var menu = $('.main_menu');
	
	$(touch).on('click', function(e){
		e.preventDefault();
		menu.toggleClass('opened');
	});
	
	
	var touch_catalog = $('.catalog-menu');
	var menu_catalog = $('.catalog-hover');
	
	$(touch_catalog).on('click', function(e){
		e.preventDefault();
		menu_catalog.toggleClass('opened');
	});

	
	$('.mobile-menu').on('click', function() {
		$(this).toggleClass('toggled-on');
	});
	$('.catalog-menu').on('click', function() {
		$(this).toggleClass('toggled-on');
	});
	
	$("#popup-mail").fancybox({
		padding:0,
		 tpl: {
        closeBtn: '<a title="Close" class="fancybox-item fancybox-close myClose" href="javascript:;"></a>'
    }
	});
	$("#popup-call").fancybox({
		padding:0,
		 tpl: {
        closeBtn: '<a title="Close" class="fancybox-item fancybox-close myClose" href="javascript:;"></a>'
    }
	});
	
});

$(function() {
		$(window).scroll(function() {
			if($(this).scrollTop() != 0) {
			$('.toTop').fadeIn();
			} else {
			$('.toTop').fadeOut();
		}
	});
 
	$('.toTop').click(function() {
		$('body,html').animate({scrollTop:0},800);
	});
});
$(function() {
   $(".new-items-switch div:first-child a").addClass("active");
   $(".new-items-switch a").click(function() {
      $(".new-items-switch a").removeClass("active");
      $(this).addClass("active");
   });
});
