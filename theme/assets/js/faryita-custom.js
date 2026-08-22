(function () {
	'use strict';

	function reveal() {
		var items = document.querySelectorAll('.fy-reveal');
		if (!items.length) {
			return;
		}
		if (!('IntersectionObserver' in window)) {
			items.forEach(function (el) {
				el.classList.add('is-visible');
			});
			return;
		}
		var io = new IntersectionObserver(
			function (entries) {
				entries.forEach(function (entry) {
					if (entry.isIntersecting) {
						entry.target.classList.add('is-visible');
						io.unobserve(entry.target);
					}
				});
			},
			{ threshold: 0.15, rootMargin: '0px 0px -40px 0px' }
		);
		items.forEach(function (el) {
			io.observe(el);
		});
	}

	function wishlistToggle() {
		document.addEventListener('click', function (e) {
			var btn = e.target.closest('.fy-wishlist-btn');
			if (!btn) {
				return;
			}
			e.preventDefault();
			btn.classList.toggle('is-active');
		});
	}

	function relatedProductsCarousel() {
		if (!window.jQuery || !window.jQuery.fn.owlCarousel) {
			return;
		}
		var $carousel = window.jQuery('.fy-related-carousel');
		if (!$carousel.length) {
			return;
		}
		$carousel.owlCarousel({
			loop: false,
			margin: 30,
			nav: true,
			dots: false,
			responsive: {
				0: { items: 1 },
				561: { items: 2 },
				901: { items: 3 },
				1101: { items: 4 }
			}
		});
	}

	function heroSlider() {
		if (!window.jQuery || !window.jQuery.fn.owlCarousel) {
			return;
		}
		var $slider = window.jQuery('.fy-hero-slider');
		if (!$slider.length || $slider.children().length < 2) {
			return;
		}
		$slider.owlCarousel({
			items: 1,
			loop: true,
			nav: false,
			dots: true,
			autoplay: true,
			autoplayTimeout: 45000,
			autoplayHoverPause: true,
			animateOut: 'fadeOut',
			mouseDrag: false
		});
	}

	function productTabs() {
		var tabs = document.querySelectorAll('.fy-tab-btn');
		if (!tabs.length) {
			return;
		}
		tabs.forEach(function (btn) {
			btn.addEventListener('click', function () {
				var target = btn.getAttribute('data-fy-tab');
				tabs.forEach(function (b) {
					b.classList.toggle('is-active', b === btn);
				});
				document.querySelectorAll('[data-fy-panel]').forEach(function (panel) {
					panel.hidden = panel.getAttribute('data-fy-panel') !== target;
				});
			});
		});
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', function () {
			reveal();
			wishlistToggle();
			relatedProductsCarousel();
			heroSlider();
			productTabs();
		});
	} else {
		reveal();
		wishlistToggle();
		relatedProductsCarousel();
		heroSlider();
		productTabs();
	}
})();
