;(function($) {
	'use strict';

	//=== Post Ticker
	var widgetPostTickerHandler = function($scope, $) {
		$scope.find('.benzo-post-ticker').each(function() {
			var selector = $(this),
				slider = selector.find('.post-ticker-slider'),
				arrows = selector.find('.post-ticker-arrows'),
				autoplay = selector.data('autoplay'),
				autoplay_time = selector.data('autoplay-time');
			slider.slick({
				infinite: true,
				autoplay: autoplay,
				autoplaySpeed: autoplay_time,
				slidesToShow: 3,
				arrows: true,
				prevArrow: '<button class="prev"><i class="far fa-long-arrow-alt-left"></i></button>',
				nextArrow: '<button class="next"><i class="far fa-long-arrow-alt-right"></i></button>',
				appendArrows: arrows,
				pauseOnHover: false,
				slidesToScroll: 1,
			});
		});
	};

	//=== Post Slider
	var widgetPostSlider = function($scope, $) {
		$scope.find('.benzo-post-boxes').each(function() {
			var selector = $(this),
				slider = selector.find('.benzo-post-slider'),
				arrowWrap = selector.find('.post-slider-arrows'),
				dotsWrap = selector.find('.post-slider-dots'),
				desktop_col = slider.data('desktop-column'),
				tab_col = slider.data('tab-column'),
				mobile_col = slider.data('mobile-column'),
				arrow = slider.data('arrow'),
				dots = slider.data('dots'),
				autoplay = slider.data('autoplay'),
				autoplay_time = slider.data('autoplay-time');
			slider.slick({
				infinite: true,
				arrows: arrow,
				dots: dots,
				autoplay: autoplay,
				autoplaySpeed: autoplay_time,
				slidesToShow: desktop_col,
				slidesToScroll: 1,
				prevArrow: '<button class="prev"><i class="far fa-long-arrow-alt-left"></i></button>',
				nextArrow: '<button class="next"><i class="far fa-long-arrow-alt-right"></i></button>',
				appendArrows: arrowWrap,
				appendDots: dotsWrap,
				responsive: [{
					breakpoint: 1025,
					settings: {
						slidesToShow: tab_col,
					}
				}, {
					breakpoint: 768,
					settings: {
						slidesToShow: mobile_col,
					}
				}],
			});
		});
	};

	//=== Benzo Counter
	var widgetCounterHandler = function($scope, $) {
		setTimeout(function() {
			elementorFrontend.waypoint($scope.find('.elementor-counter-number'), function() {
				var $number = $(this),
					data = $number.data();
				var decimalDigits = data.toValue.toString().match(/\.(.*)/);
				if(decimalDigits) {
					data.rounding = decimalDigits[1].length;
				}
				$number.numerator(data);
			});
		}, 150);
	};

	//=== Gallery Popup
	var widgetGalleryPopup = function($scope, $) {
		$scope.find('.benzo-image-gallery').each(function() {
			var selector = $(this),
				popupBtn = selector.find('.image-popup');
			popupBtn.magnificPopup({
				type: 'image',
				gallery: {
					enabled: true
				},
			});
		});
	};

	//=== Post Load More
	var widgetLoadMoreHandler = function($scope, $) {
		$scope.find('.has-ajax-load-more').each(function() {
			var selector = $(this),
				ajaxUrl = benzoLocalize.ajax_url,
				btnWrap = selector.find('.load-more-btn-wrap'),
				btn = selector.find('.load-more-btn'),
				row = selector.find('.row.append-ajax-posts'),
				data = selector.find('.ajax-load-data').data(),
				nonce = data.nonce,
				ajaxData = data.ajax_data,
				paged = 2;
			ajaxData.query.paged = paged;
			if(typeof data != 'undefined') {
				btn.on('click', function(event) {
					event.preventDefault();
					$.ajax({
						url: ajaxUrl,
						type: "POST",
						data: {
							action: "benzo_load_more_ajax",
							nonce: nonce,
							data: ajaxData,
						},
						beforeSend: function() {
							btnWrap.addClass('loading');
						},
						success: function(response) {
							if($.trim(response) != '') {
								row.append(response);
								paged++;
								ajaxData.query.paged = paged;
								btnWrap.removeClass('loading');
							} else {
								btnWrap.removeClass('loading');
								btnWrap.hide();
							}
						},
					});
					return false;
				});
			}
		});
	};

	//=== AJAX Post Tab
	var widgetPostTabHandler = function($scope, $) {
		$scope.find('.benzo-post-tab').each(function() {
			var selector = $(this),
				ajaxUrl = benzoLocalize.ajax_url,
				tabItem = selector.find('.post-tab-item'),
				filterWrap = selector.find('.post-filter-nav'),
				filterItem = filterWrap.find('li a'),
				data = selector.find('.ajax-load-data').data(),
				nonce = data.nonce,
				ajaxData = data.ajax_data;
			if(typeof data != 'undefined') {
				filterItem.on('click', function(event) {
					event.preventDefault();
					var cat_id = $(this).data('id');
					$.ajax({
						url: ajaxUrl,
						type: "POST",
						data: {
							action: "benzo_ajax_post_tab",
							nonce: nonce,
							data: ajaxData,
							cat_id: cat_id
						},
						beforeSend: function() {
							tabItem.empty();
							tabItem.append('<div class="loader"><span class="bounce1"></span><span class="bounce2"></span><span class="bounce3"></span></div>');
						},
						success: function(response) {
							tabItem.empty();
							tabItem.append(response);
						},
					});
					filterItem.removeClass('active');
					$(this).addClass("active");
					return false;
				});
			}
		});
	};

	//=== AJAX Post Tab
	var widgetOffcanvasToggle = function($scope, $) {
		$scope.find('.benzo-offcanvas').each(function() {
			var selector = $(this),
				toggle = selector.find('.offcanvas-toggle'),
				overly = selector.find('.offcanvas-overly'),
				close = selector.find('.offcanvas-close'),
				wrapper = selector.find('.benzo-offcanvas-wrapper');
			toggle.on('click', function(e) {
				wrapper.toggleClass('show-offcanvas');
			});
			overly.on('click', function(e) {
				wrapper.removeClass('show-offcanvas');
			});
			close.on('click', function(e) {
				wrapper.removeClass('show-offcanvas');
			});
		});
	};

	//=== Search Widget
	var widgetSearchHandler = function($scope, $) {
		$scope.find('.benzo-search-wrapper').each(function() {
			var selector = $(this),
				searchButton = selector.find('.search-btn');
			searchButton.on('click', function(e) {
				e.preventDefault();
				selector.toggleClass('show-search');
			});
		});
	};

	//=== Sticky Section
	var widgetSectionSticky = function($scope, $) {
		$.each($scope, function(index) {
			if($scope.hasClass('benzo-sticky')) {
				var topOffset = $scope.offset(),
					stickyHeight = $scope.outerHeight();
				$(this).after('<div class="benzo-sticky-gap" style="height: ' + stickyHeight + 'px; display: none;"></div>');
				$(window).on('scroll', function() {
					var scroll = $(window).scrollTop();
					if(scroll >= topOffset.top) {
						$scope.addClass('benzo-sticky-active');
						$('.benzo-sticky-gap').css('display', 'block');
					} else {
						$scope.removeClass('benzo-sticky-active');
						$('.benzo-sticky-gap').css('display', 'none');
					}
				});
			}
		});
	};

	/*-----------------------------
	===  Elementor JS Hooks ===
	------------------------------*/
	$(window).on("elementor/frontend/init", function() {
		elementorFrontend.hooks.addAction("frontend/element_ready/benzo-post-ticker.default", widgetPostTickerHandler);
		elementorFrontend.hooks.addAction("frontend/element_ready/benzo-post-slider.default", widgetPostSlider);
		elementorFrontend.hooks.addAction("frontend/element_ready/benzo-counter.default", widgetCounterHandler);
		elementorFrontend.hooks.addAction("frontend/element_ready/benzo-image-gallery.default", widgetGalleryPopup);
		elementorFrontend.hooks.addAction("frontend/element_ready/benzo-post-grid.default", widgetLoadMoreHandler);
		elementorFrontend.hooks.addAction("frontend/element_ready/benzo-masonry-posts.default", widgetLoadMoreHandler);
		elementorFrontend.hooks.addAction("frontend/element_ready/benzo-post-tab.default", widgetPostTabHandler);
		elementorFrontend.hooks.addAction("frontend/element_ready/benzo-offcanvas.default", widgetOffcanvasToggle);
		elementorFrontend.hooks.addAction("frontend/element_ready/benzo-search.default", widgetSearchHandler);
		elementorFrontend.hooks.addAction('frontend/element_ready/section', widgetSectionSticky);
	});
})(jQuery);