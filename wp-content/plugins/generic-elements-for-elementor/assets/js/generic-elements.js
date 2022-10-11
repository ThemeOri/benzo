(function ($) {
	"use strict";

	// menu-last class
	$(".generic-main-menu nav > ul > li").slice(-4).addClass("menu-last");

	// data - background
	$("[data-background]").each(function () {
		$(this).css("background-image", "url(" + $(this).attr("data-background") + ")")
	});

	$("[data-width]").each(function () {
		$(this).css("width", $(this).attr("data-width"));
	});

	$("[data-left]").each(function () {
		$(this).css("left", $(this).attr("data-left"));
	});


	/*------------------------------------
		Slider
	--------------------------------------*/
	function mainSlider($data) {

		let active = $data.find(".bd-slider-active");
		let autoplay = parseInt(active.attr('autoplay-speed'));

		// data - background
		$("[data-background]").each(function () {
			$(this).css("background-image", "url(" + $(this).attr("data-background") + ")")
		});

		if (jQuery(".bd-slider-active").length > 0) {

			let sliderActive1 = '.bd-slider-active';
			let sliderInit1 = new Swiper(sliderActive1, {
				// Optional parameters
				slidesPerView: 1,
				slidesPerColumn: 1,
				paginationClickable: true,
				loop: true,
				effect: 'fade',

				autoplay: {
					delay: autoplay,
				},

				// If we need pagination
				pagination: {
					el: '.t-swiper-pagination',
					// type: 'fraction',
					// clickable: true,
				},

				// Navigation arrows
				navigation: {
					nextEl: '.swiper-button-next',
					prevEl: '.swiper-button-prev',
				},

				a11y: false
			});


			if (jQuery(".bd-slider-active").data('swipper_autoplay_stop') == '') {
				sliderInit1.autoplay.stop();
			}


			function animated_swiper(selector, init) {
				let animated = function animated() {
					$(selector + ' [data-animation]').each(function () {
						let anim = $(this).data('animation');
						let delay = $(this).data('delay');
						let duration = $(this).data('duration');

						$(this).removeClass('anim' + anim)
							.addClass(anim + ' animated')
							.css({
								webkitAnimationDelay: delay,
								animationDelay: delay,
								webkitAnimationDuration: duration,
								animationDuration: duration
							})
							.one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
								$(this).removeClass(anim + ' animated');
							});
					});
				};
				animated();
				// Make animated when slide change
				init.on('slideChange', function () {
					$(sliderActive1 + ' [data-animation]').removeClass('animated');
				});
				init.on('slideChange', animated);
			}
			animated_swiper(sliderActive1, sliderInit1);
		}
	}

	// team activation
	function teamActive(data) {

		let active = data.find(".bd-team-active");
		let autoplay = parseInt(active.attr('autoplay-speed'));
		let autoplay_toggle = active.attr('autoplay_stop');


		if (jQuery(".bd-team-active").length > 0) {
			let portfolio = new Swiper('.bd-team-active', {
				slidesPerView: 1,
				spaceBetween: 30,
				// direction: 'vertical',
				loop: true,
				autoplay: {
					delay: autoplay,
				},

				// If we need pagination
				pagination: {
					el: '.team-pagination',
					clickable: true,
				},

				// Navigation arrows
				navigation: {
					nextEl: '.brand-button-next',
					prevEl: '.brand-button-prev',
				},

				// And if we need scrollbar
				scrollbar: {
					el: '.swiper-scrollbar',
				},
				breakpoints: {
					550: {
						slidesPerView: 2,
					},
					768: {
						slidesPerView: 2,
					},
					1200: {
						slidesPerView: 3,
					},
				}
			});

			if (autoplay_toggle == 'yes') {
				portfolio.autoplay.start();
			} else {
				portfolio.autoplay.stop();
			}
		}


	}

	function testimonialActive($data) {

		let active = $data.find(".testimonial-nav");

		let autoplay = active.attr('autoplay-toggle');

		let auto_speed = parseInt(active.attr('tes-speed'));

		// Testimonial Active
		var swiper = new Swiper(".testimonial-nav", {
			spaceBetween: 10,
			slidesPerView: 3,
			loop: true,

			allowTouchMove: false,
			autoplay: {
				delay: auto_speed,
			},
			infinite: true,

			speed: 100,
			centeredSlides: true,
			freeMode: true,
			watchSlidesProgress: true,
		});
		var swiper2 = new Swiper(".testimonial-text", {
			spaceBetween: 10,
			loop: true,
			infinite: true,
			autoplay: {
				delay: auto_speed,
			},
			navigation: {
				nextEl: ".swiper-button-next",
				prevEl: ".swiper-button-prev",
			},
			thumbs: {
				swiper: swiper,
			},
		});

		if (autoplay == 'yes') {
			swiper.autoplay.start();
			swiper2.autoplay.start();
		} else {
			swiper.autoplay.stop();
			swiper2.autoplay.stop();
		}
	}

	function brandActive() {
		// brand activation

		if (jQuery(".bd-brand-active").length > 0) {

			let brand = new Swiper('.bd-brand-active', {
				slidesPerView: 2,
				spaceBetween: 30,
				//rtl: rtl_setting,
				// direction: 'vertical',
				loop: true,
				autoplay: {
					delay: 5000,
				},

				// If we need pagination
				pagination: {
					el: '.swiper-pagination',
					clickable: true,
				},

				// Navigation arrows
				navigation: {
					nextEl: '.brand-button-next',
					prevEl: '.brand-button-prev',
				},

				// And if we need scrollbar
				scrollbar: {
					el: '.swiper-scrollbar',
				},
				breakpoints: {
					550: {
						slidesPerView: 3,
					},
					768: {
						slidesPerView: 4,
					},
					1200: {
						slidesPerView: 5,
					},
					1400: {
						slidesPerView: 6,
					}
				}
			});
		}
	}


	function instagramActive(data) {

		let active = data.find(".instagram-active");
		let autoplay = parseInt(active.attr('autoplay-speed'));
		let autoplay_toggle = active.attr('autoplay_stop');

		const swiper = new Swiper(".instagram-active", {
			// Default parameters
			slidesPerView: 6,
			spaceBetween: 30,
			loop: true,
			autoplay: {
				delay: autoplay,
			},
			// Responsive breakpoints
			breakpoints: {
				// when window width is >= 320px
				540: {
					slidesPerView: 1,
				},
				768: {
					slidesPerView: 2,
				},
				992: {
					slidesPerView: 4,
				},
				1200: {
					slidesPerView: 6,
				},
			},

		});
		if (autoplay_toggle == 'yes') {
			swiper.autoplay.start();
		} else {
			swiper.autoplay.stop();
		}
	}


	function skillActive() {
		// data - background
		$("[data-background]").each(function () {
			$(this).css("background-image", "url(" + $(this).attr("data-background") + ")")
		});

		$("[data-width]").each(function () {
			$(this).css("width", $(this).attr("data-width"));
		});

		$("[data-left]").each(function () {
			$(this).css("left", $(this).attr("data-left"));
		});

		$("[data-right]").each(function () {
			$(this).css("right", $(this).attr("data-right"));
		});

		new WOW().init();
	}

	function videoActive() {

		// data - background
		$("[data-background]").each(function () {
			$(this).css("background-image", "url(" + $(this).attr("data-background") + ")")
		});

		/* magnificPopup img view */
		$('.popup-image,.insta-thumb a').magnificPopup({
			type: 'image',
			gallery: {
				enabled: true
			}
		});

		/* magnificPopup video view */
		$('.popup-video').magnificPopup({
			type: 'iframe'
		});

	}


	// FunFact Active
	function funfactActive() {
		$('.counter').counterUp({
			delay: 10,
			time: 1000
		});
	}


	// Meanmenu Activation For Mobile
	function menuActive() {
		// meanmenu
		$('#generic-mobile-menu').meanmenu({
			meanMenuContainer: '.generic-mobile-menu',
			meanScreenWidth: "1199"
		});

		//mobile side menu
		$('.side-toggle').on('click', function () {
			$('.side-info').addClass('info-open');
			$('.offcanvas-overlay').addClass('overlay-open');
		})

		$('.side-info-close,.offcanvas-overlay').on('click', function () {
			$('.side-info').removeClass('info-open');
			$('.offcanvas-overlay').removeClass('overlay-open');
		})

		//sidebar menu
		$('.side-toggle1').on('click', function () {
			$('.side-info1').addClass('info-open1');
			$('.offcanvas-overlay1').addClass('overlay-open1');
		})

		$('.side-info-close1,.offcanvas-overlay1').on('click', function () {
			$('.side-info1').removeClass('info-open1');
			$('.offcanvas-overlay1').removeClass('overlay-open1');
		})
	}




	$(window).on("elementor/frontend/init", function () {
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/generic-slider.default",
			mainSlider
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/generic-team.default",
			teamActive
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/generic-testimonial.default",
			testimonialActive
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/generic-instagram.default",
			instagramActive
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/generic-skill.default",
			skillActive
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/generic-videoinfo.default",
			videoActive
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/generic-fun-factor.default",
			funfactActive
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/brand-pro.default",
			brandActive
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/generic-navigation-menu.default",
			menuActive
		);
	});

})(jQuery);