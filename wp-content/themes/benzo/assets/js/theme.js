; (function($) {
	'use strict';

	/*==========  background  ==========*/
	$("[data-background]").each(function() {
		$(this).css("background-image", "url(" + $(this).attr("data-background") + ")")
	});
 
	/*==========  Hero Slider One ==========*/
	let sliderActive1 = '.hero-slider-active';
	let sliderInit1 = new Swiper(sliderActive1, {
		slidesPerView: 1,
		loop: true,
		spaceBetween: 0,
		autoplay: {
			delay: 9000,
		},
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
	});

	/*==========  Hero Slider Two ==========*/
	let sliderActive2 = '.hero-slider-active2';
	let sliderInit2 = new Swiper(sliderActive2, {
		slidesPerView: 1,
		loop: true,
		spaceBetween: 0,
		effect: 'fade',
		fadeEffect: {
			crossFade: true
		},
		autoplay: {
			delay: 5000,
		},
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
	});

	/*==========  CounterUp ==========*/
	$('.counter').counterUp({
		delay: 10,
		time: 1000
	});

	/*==========  Services Slider ==========*/
	const service = new Swiper(".services-two-active", {
		// Default parameters
		slidesPerView: 3,
		spaceBetween: 20,
		loop: true,
		navigation: {
			nextEl: ".services-button-next",
			prevEl: ".services-button-prev",
		},
		// Responsive breakpoints
		breakpoints: {	
			'1400': {
				slidesPerView: 3,
			},
			'1200': {
				slidesPerView: 3,
			},
			'992': {
				slidesPerView: 3,
				spaceBetween: 10,
			},
			'768': {
				slidesPerView: 3,
			},
			'576': {
				slidesPerView: 3,
			},
			'0': {
				slidesPerView: 3,
			},
		},
	});


	/*==========  Testimonial One Slider ==========*/
	const testimonial = new Swiper(".testimonial-active", {
		// Default parameters
		slidesPerView: 3,
		spaceBetween: 30,
		centeredSlides: true,
		loop: true,
		pagination: {
			el: ".pagination",
			clickable: true,
		},
		// Responsive breakpoints
		breakpoints: {	
			'1400': {
				slidesPerView: 3,
			},
			'1200': {
				slidesPerView: 3,
			},
			'992': {
				slidesPerView: 2,
				spaceBetween: 15,
				centeredSlides: false,
			},
			'768': {
				slidesPerView: 2,
				centeredSlides: false,
				spaceBetween: 15,
			},
			'576': {
				slidesPerView: 1,
			},
			'0': {
				slidesPerView: 1,
			},
		},
	});


/*==========  Testimonial Two Slider ==========*/
	$('.myslider').slick({
		vertical: true,
		verticalSwiping: true,
		slidesToShow: 2,
		slidesToScroll: 2,
		arrows: false,
		dots: true,
			
		});

	/*==========  Brand Slider  ==========*/
	var swiper = new Swiper(".band-active", {
		loop: true,
		speed: 1500,
		spaceBetween: 30,
		autoplay: {
			delay: 3500,
		},
		breakpoints: {
			0: {
				slidesPerView: 3
			},
			575: {
				slidesPerView: 4
			},
			992: {
				slidesPerView: 5
			},
			1200: {
				slidesPerView: 5
			},
		}
	});

	/*==========  Skills Bar  ==========*/
	jQuery('.progress-bar').each(function() {
		jQuery(this).find('.progress-content').animate({
		  width:jQuery(this).attr('data-percentage')
		},2000);
		
		jQuery(this).find('.progress-number-mark').animate(
		  {left:jQuery(this).attr('data-percentage')},
		  {
		   duration: 2000,
		   step: function(now, fx) {
			 var data = Math.round(now);
			 jQuery(this).find('.percent').html(data + '%');
		   }
		});  
	  });

	/*==========  Nice Select ==========*/
	  $('.skill-select-info select, .contact-info-select select').niceSelect();


	/**
	 * Post Media Gallery
	 */
	function postMediaGallery() {
		var slide = $('.gallery-slider-active');
		slide.slick({
			infinite: true,
			slidesToShow: 1,
			slidesToScroll: 1,
			autoplay: false,
			autoplaySpeed: 5000,
			speed: 500,
			arrows: true,
			fade: false,
			dots: false,
			swipe: true,
			nextArrow: '<button class="slick-arrow next-arrow"><i class="far fa-angle-right"></i></button>',
			prevArrow: '<button class="slick-arrow prev-arrow"><i class="far fa-angle-left"></i></button>',
		});
	}

	/**
	 * Post Media video
	 */
	function postMediaVideo() {
		var popupButton = $('.post-media-video, .popup-video')
		popupButton.magnificPopup({
			type: 'iframe',
		});
	}

	/**
	 * Quantity Increase/Decrease Button
	 */
	function quantityIncreaseDecrease() {
		$(document).on('click', '.quantity .increase, .quantity .decrease', function() {

			// Get values
			var $qty = $(this).siblings('.qty'),
				currentVal = parseFloat($qty.val()),
				max = parseFloat($qty.attr('max')),
				min = parseFloat($qty.attr('min')),
				step = $qty.attr('step');

			// Format values
			if (!currentVal || currentVal === '' || currentVal === 'NaN') {
				currentVal = 0;
			}
			if (max === '' || max === 'NaN') {
				max = '';
			}
			if (min === '' || min === 'NaN') {
				min = 0;
			}
			if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN') {
				step = 1;
			}

			// Change the value
			if ($(this).is('.increase')) {

				if (max && (
						max == currentVal || currentVal > max
					)) {
					$qty.val(max);
				} else {
					$qty.val(currentVal + parseFloat(step));
				}

			} else {

				if (min && (
						min == currentVal || currentVal < min
					)) {
					$qty.val(min);
				} else if (currentVal > 0) {
					$qty.val(currentVal - parseFloat(step));
				}

			}

			// Trigger change event.
			$qty.trigger('change');
		});

		$(document).on('blur', '.quantity .qty', function() {
			var $qty = $(this),
				currentVal = parseFloat($qty.val()),
				max = parseFloat($qty.attr('max'));

			if (max !== '' && max !== 'NaN' && currentVal > max) {
				$(this).val(max);
			}
		});
	}

	/**
	 * Related Product Slider
	 */
	function relatedProductSlider() {
		$('.related-slider-active').slick({
			infinite: true,
			arrows: false,
			dots: false,
			speed: 300,
			slidesToShow: 4,
			slidesToScroll: 1,
			responsive: [{
				breakpoint: 1024,
				settings: {
					slidesToShow: 2,
				}
			}, {
				breakpoint: 768,
				settings: {
					slidesToShow: 1,
				}
			}]
		});
	}

	/**
	 * Nav Menu
	 */
	function navMenu() {
		$('.benzo-nav-menu').each(function() {
			const selector = $(this),
				navMenu = selector.find('.primary-menu'),
				navToggler = selector.find('.navbar-toggler'),
				slidePanel = selector.find('.slide-panel-wrapper'),
				slideOverly = selector.find('.slide-panel-overly'),
				panelClose = selector.find('.slide-panel-close'),
				showPanel = 'show-panel',
				breakpoint = $(this).data('breakpoint');

			navMenu.find("li a").each(function() {
				if ($(this).children('.submenu-toggler').length < 1) {
					if ($(this).next().length > 0) {
						$(this).append('<span class="submenu-toggler"><i class="far fa-angle-down"></i></span>');
					}
				}
			});

			navToggler.on('click', function(e) {
				slidePanel.addClass(showPanel);
				e.preventDefault();
			});

			panelClose.on('click', function(e) {
				e.preventDefault();
				slidePanel.removeClass(showPanel);
			});

			slideOverly.on('click', function(e) {
				e.preventDefault();
				slidePanel.removeClass(showPanel);
			});

			slidePanel.find('.submenu-toggler').on('click', function(e) {
				e.preventDefault();

				$(this).parent().parent().siblings().children('ul.sub-menu').slideUp();
				$(this).parent().next('ul.sub-menu').stop(true, true).slideToggle(350);

				$(this).toggleClass('sub-menu-open');
			});

			function breakpointCheck() {
				var winWidth = window.innerWidth;

				if (winWidth <= breakpoint) {
					selector.addClass('breakpoint-on');
				} else {
					selector.removeClass('breakpoint-on');
				}
			}
			breakpointCheck();

			$(window).on('resize', function() {
				breakpointCheck();
			});
		});
	}

	/**
	 * Site Popup
	 */
	function popup() {
		var popup_delay = $(".benzo-popup-wrapper").data('delay') * 3000;
		var delay = (popup_delay) ? popup_delay : 3000;

		if ($(".benzo-popup-wrapper").length > 0) {
			setTimeout(function() {
				$(".benzo-popup-wrapper").addClass("show-popup");
				document.body.setAttribute("style", "overflow:hidden;");
			}, delay);


			$('.benzo-popup-wrapper .popup-close, .benzo-popup-wrapper .popup-overly').on('click', function() {
				if (!$(".benzo-popup-wrapper").hasClass('editing')) {
					$(".benzo-popup-wrapper").removeClass('show-popup');
				}
				document.body.setAttribute("style", "overflow:auto;");
			})
		}
	}

	/**
	 * Preloader
	 */
	function preloader() {
		if ($('.site-preloader').length) {
			$('.site-preloader').delay(300).fadeOut(900);
		}
	}

	/** ==== Document Ready ==== */
	$(document).ready(function() {
		postMediaGallery();
		postMediaVideo();
		quantityIncreaseDecrease();
		relatedProductSlider();
		navMenu();
		popup()
	});

	/** ==== Window Load ==== */
	$(window).on('load', function() {
		preloader();
	});

	/** ==== Elementor Js Hook ==== */
	$(window).on("elementor/frontend/init", function() {
		elementorFrontend.hooks.addAction("frontend/element_ready/benzo-nav-menu.default", function() {
			if (window.elementorFrontend.isEditMode()) {
				navMenu();
			}
		});
	});
})(jQuery);