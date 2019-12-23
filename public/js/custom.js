// JavaScript Document


$(window).on('load', function() {
	
	"use strict";
					
	/*----------------------------------------------------*/
	/*	Preloader
	/*----------------------------------------------------*/
	
	var preloader = $('#loader-wrapper'),
		loader = preloader.find('.loader-inner');
		loader.fadeOut();
		preloader.delay(400).fadeOut('slow');
			
//	$(window).stellar({});
	
});


$(document).ready(function() {
		
	"use strict";


	/*----------------------------------------------------*/
	/*	Animated Scroll To Anchor
	/*----------------------------------------------------*/
	
	// $('.header a[href^="#"], .page a.btn[href^="#"], .page a.internal-link[href^="#"]').on('click', function (e) {
		
	// 	e.preventDefault();

	// 	var target = this.hash,
	// 		$target = jQuery(target);

	// 	$('html, body').stop().animate({
	// 		'scrollTop': $target.offset().top - 60 // - 200px (nav-height)
	// 	}, 'slow', 'easeInSine', function () {
	// 		window.location.hash = '1' + target;
	// 	});
		
	// });


	/*----------------------------------------------------*/
	/*	Hero Slider
	/*----------------------------------------------------*/
	if($('.slider').length > 0){
		$('.slider').slider({
			full_width: false,
			interval:5000,
			transition:700,
			draggable: false,
		});
	}  
	
	
	
	/*----------------------------------------------------*/
	/*	ScrollUp
	/*----------------------------------------------------*/
	
	$.scrollUp = function (options) {

		// Defaults
		var defaults = {
			scrollName: 'scrollUp', // Element ID
			topDistance: 600, // Distance from top before showing element (px)
			topSpeed: 800, // Speed back to top (ms)
			animation: 'fade', // Fade, slide, none
			animationInSpeed: 200, // Animation in speed (ms)
			animationOutSpeed: 200, // Animation out speed (ms)
			scrollText: '', // Text for element
			scrollImg: false, // Set true to use image
			activeOverlay: false // Set CSS color to display scrollUp active point, e.g '#00FFFF'
		};

		var o = $.extend({}, defaults, options),
			scrollId = '#' + o.scrollName;

		// Create element
		$('<a/>', {
			id: o.scrollName,
			href: '#top',
			title: o.scrollText
		}).appendTo('body');
		
		// If not using an image display text
		if (!o.scrollImg) {
			$(scrollId).text(o.scrollText);
		}

		// Minium CSS to make the magic happen
		$(scrollId).css({'display':'none','position': 'fixed','z-index': '2147483647'});

		// Active point overlay
		if (o.activeOverlay) {
			$("body").append("<div id='"+ o.scrollName +"-active'></div>");
			$(scrollId+"-active").css({ 'position': 'absolute', 'top': o.topDistance+'px', 'width': '100%', 'border-top': '1px dotted '+o.activeOverlay, 'z-index': '2147483647' });
		}

		// Scroll function
		$(window).on('scroll', function(){	
			switch (o.animation) {
				case "fade":
					$( ($(window).scrollTop() > o.topDistance) ? $(scrollId).fadeIn(o.animationInSpeed) : $(scrollId).fadeOut(o.animationOutSpeed) );
					break;
				case "slide":
					$( ($(window).scrollTop() > o.topDistance) ? $(scrollId).slideDown(o.animationInSpeed) : $(scrollId).slideUp(o.animationOutSpeed) );
					break;
				default:
					$( ($(window).scrollTop() > o.topDistance) ? $(scrollId).show(0) : $(scrollId).hide(0) );
			}
		});

		// To the top
		$(scrollId).on('click', function(event){
			$('html, body').animate({scrollTop:0}, o.topSpeed);
			event.preventDefault();
		});

	};
	
	$.scrollUp();


	/*----------------------------------------------------*/
	/*	Services Rotator
	/*----------------------------------------------------*/

	var owl = $('.services-holder');
		owl.owlCarousel({
			items: 4,
			loop:true,
			autoplay:true,
			navBy: 1,
			autoplayTimeout: 4500,
			autoplayHoverPause: false,
			smartSpeed: 1500,
			responsive:{
				0:{
					items:1
				},
				767:{
					items:1
				},
				768:{
					items:2
				},
				991:{
					items:3
				},
				1000:{
					items:4
				}
			}
	});


	/*----------------------------------------------------*/
	/*	Portfolio Grid
	/*----------------------------------------------------*/

	$('.grid-loaded').imagesLoaded(function () {

		// filter items on button click
		$('.gallery-filter').on('click', 'button', function () {
			var filterValue = $(this).attr('data-filter');
			$grid.isotope({
			  filter: filterValue
			});
		});

		// change is-checked class on buttons
		$('.gallery-filter button').on('click', function () {
			$('.gallery-filter button').removeClass('is-checked');
			$(this).addClass('is-checked');
			var selector = $(this).attr('data-filter');
			$grid.isotope({
			  filter: selector
			});
			return false;
		});

		// init Isotope
		var $grid = $('.masonry-wrap').isotope({
			itemSelector: '.gallery-item',
			percentPosition: true,
			transitionDuration: '0.7s',
			masonry: {
			  // use outer width of grid-sizer for columnWidth
			  columnWidth: '.gallery-item',
			}
		});
		
	});


	/*----------------------------------------------------*/
	/*	Single Image Lightbox
	/*----------------------------------------------------*/
			
	$('.image-link').magnificPopup({
	  type: 'image'
	});	





	/*----------------------------------------------------*/
	/*	Statistic Counter
	/*----------------------------------------------------*/

	$('.count-element').each(function () {
		$(this).appear(function() {
			$(this).prop('Counter',0).animate({
				Counter: $(this).text()
			}, {
				duration: 4000,
				easing: 'swing',
				step: function (now) {
					$(this).text(Math.ceil(now));
				}
			});
		},{accX: 0, accY: 0});
	});


	/*----------------------------------------------------*/
	/*	Testimonials Rotator
	/*----------------------------------------------------*/

	var owl = $('.reviews-holder');
		owl.owlCarousel({
			items: 3,
			loop:true,
			autoplay:true,
			navBy: 1,
			autoplayTimeout: 4500,
			autoplayHoverPause: false,
			smartSpeed: 1500,
			responsive:{
				0:{
					items:1
				},
				767:{
					items:1
				},
				768:{
					items:2
				},
				991:{
					items:3
				},
				1000:{
					items:3
				}
			}
	});


	$('#datetimepicker').datetimepicker();



});