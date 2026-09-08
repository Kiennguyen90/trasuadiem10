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
			nav: true,
			navText: [
				'<i class="fas fa-chevron-left" aria-hidden="true"></i><span class="screen-reader-text">Ảnh trước</span>',
				'<i class="fas fa-chevron-right" aria-hidden="true"></i><span class="screen-reader-text">Ảnh sau</span>'
			],
			dots: false,
			autoplay: true,
			autoplayTimeout: 45000,
			autoplayHoverPause: true,
			animateOut: 'fadeOut',
			mouseDrag: false
		});
	}

	function testimonialsCarousel() {
		if (!window.jQuery || !window.jQuery.fn.owlCarousel) {
			return;
		}
		var $carousel = window.jQuery('.fy-testimonials-carousel');
		if (!$carousel.length) {
			return;
		}
		$carousel.owlCarousel({
			loop: $carousel.children().length > 2,
			margin: 24,
			nav: true,
			navText: [
				'<i class="fas fa-chevron-left" aria-hidden="true"></i><span class="screen-reader-text">Cảm nhận trước</span>',
				'<i class="fas fa-chevron-right" aria-hidden="true"></i><span class="screen-reader-text">Cảm nhận sau</span>'
			],
			dots: false,
			responsive: {
				0: { items: 1 },
				700: { items: 2 }
			}
		});
	}

	function promoPopup() {
		var overlay = document.getElementById('fy-promo-popup');
		if (!overlay) {
			return;
		}
		var STORAGE_KEY = 'fy_promo_popup_seen';
		var alreadySeen;
		try {
			alreadySeen = window.localStorage.getItem(STORAGE_KEY);
		} catch (e) {
			alreadySeen = null; // localStorage bị chặn (private mode...) — cứ hiện popup, không chặn trải nghiệm.
		}
		if (alreadySeen) {
			return;
		}

		function closePopup() {
			overlay.classList.remove('is-open');
			document.removeEventListener('keydown', onKeydown);
		}
		function onKeydown(e) {
			if (e.key === 'Escape') {
				closePopup();
			}
		}

		var closeBtn = overlay.querySelector('.fy-promo-popup-close');
		if (closeBtn) {
			closeBtn.addEventListener('click', closePopup);
		}
		overlay.addEventListener('click', function (e) {
			if (e.target === overlay) {
				closePopup();
			}
		});
		document.addEventListener('keydown', onKeydown);

		setTimeout(function () {
			overlay.classList.add('is-open');
			try {
				window.localStorage.setItem(STORAGE_KEY, '1');
			} catch (e) {
				// bỏ qua — không có localStorage thì popup sẽ hiện lại mỗi lần vào trang, chấp nhận được.
			}
		}, 700);
	}

	function mobileHeaderSpacer() {
		var page = document.getElementById('page');
		if (!page) {
			return;
		}
		function sync() {
			document.documentElement.style.setProperty('--fy-header-h', page.offsetHeight + 'px');
		}
		sync();
		window.addEventListener('resize', sync);
		window.addEventListener('orientationchange', sync);
		if ('ResizeObserver' in window) {
			new ResizeObserver(sync).observe(page);
		}
		// Nguồn chính để bắt menu mobile mở/đóng (đổi chiều cao #page): gọi trực
		// tiếp trong click handler của nút toggle, không chỉ dựa vào ResizeObserver
		// — sync() ngay lập tức rồi sync() lại sau khi transition max-height của
		// #primary-menu (.35s, xem style.css) chạy xong để lấy đúng chiều cao cuối.
		var toggleBtn = document.querySelector('#site-navigation .menu-toggle');
		if (toggleBtn) {
			toggleBtn.addEventListener('click', function () {
				sync();
				setTimeout(sync, 380);
			});
		}
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
			testimonialsCarousel();
			promoPopup();
			mobileHeaderSpacer();
			productTabs();
		});
	} else {
		reveal();
		wishlistToggle();
		relatedProductsCarousel();
		heroSlider();
		testimonialsCarousel();
		promoPopup();
		mobileHeaderSpacer();
		productTabs();
	}
})();
