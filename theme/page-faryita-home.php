<?php
/**
 * Template Name: Faryita Home
 * Trang chủ Trà Sữa Diễm 10: hero, giới thiệu, sản phẩm, menu.
 *
 * @package Art Blog
 */
get_header();

$fy_banner_url  = get_template_directory_uri() . '/assets/images/brand/shop-banner.jpg';
$fy_counter_url = get_template_directory_uri() . '/assets/images/brand/shop-counter.jpg';

$fy_img_dir = get_template_directory_uri() . '/assets/images/products/';

$fy_products = array(
	array( 'image' => $fy_img_dir . 'tra-luu-do-thach-dua.jpg', 'name' => 'Trà Lựu Đỏ Thạch Dừa', 'price' => '35.000₫', 'slug' => 'tra-luu-do-thach-dua' ),
	array( 'image' => $fy_img_dir . 'tra-xanh-lai-mat-ong.jpg', 'name' => 'Trà Xanh Lài Mật Ong', 'price' => '32.000₫', 'slug' => 'tra-xanh-lai-mat-ong' ),
	array( 'image' => $fy_img_dir . 'tra-dai-hong-bao.jpg',     'name' => 'Trà Đại Hồng Bào',     'price' => '35.000₫', 'slug' => 'tra-dai-hong-bao' ),
	array( 'image' => $fy_img_dir . 'hong-tra-latte.jpg',       'name' => 'Hồng Trà Latte',       'price' => '38.000₫', 'slug' => 'hong-tra-latte' ),
	array( 'image' => $fy_img_dir . 'dau-latte.jpg',            'name' => 'Dâu Latte',            'price' => '38.000₫', 'slug' => 'dau-latte' ),
	array( 'image' => $fy_img_dir . 'tran-chau-duong-den.jpg',  'name' => 'Trân Châu Đường Đen',  'price' => '36.000₫', 'old_price' => '40.000₫', 'sale' => true, 'slug' => 'tran-chau-duong-den' ),
);

$fy_menu = array(
	array( 'emoji' => '⚪', 'name' => 'Thạch Dừa',        'price' => '5.000₫', 'desc' => 'Giòn sần sật, thơm nhẹ vị dừa tự nhiên.' ),
	array( 'emoji' => '🟤', 'name' => 'Trân Châu Hoàng Kim', 'price' => '5.000₫', 'desc' => 'Trân châu dẻo dai, ngọt dịu, sợi vàng óng đẹp mắt.' ),
	array( 'emoji' => '🌰', 'name' => 'Hạt Nổ Củ Năng',   'price' => '5.000₫', 'desc' => 'Giòn tan trong miệng, topping được yêu thích nhất.' ),
	array( 'emoji' => '🥛', 'name' => 'Thủy Tinh Sữa',    'price' => '5.000₫', 'desc' => 'Béo mềm, tan nhẹ, hoà quyện cùng vị trà thơm.' ),
);

$fy_features = array( 'TRÀ THƠM ĐẬM VỊ', 'TOPPING ĐA DẠNG', 'TRÂN CHÂU DẺO DAI', 'PHỤC VỤ TẬN TÂM' );
?>


<div class="fy-home">

	<section class="fy-hero">
		<div class="fy-blob fy-blob-1" aria-hidden="true"></div>
		<div class="fy-blob fy-blob-2" aria-hidden="true"></div>
		<div class="fy-floaties" aria-hidden="true">
			<span class="fy-float-item fy-float-1">🍃</span>
			<span class="fy-float-item fy-float-2">🧋</span>
			<span class="fy-float-item fy-float-3">🍓</span>
			<span class="fy-float-item fy-float-4">🫧</span>
			<span class="fy-float-item fy-float-5">🍯</span>
		</div>
		<div class="fy-container">
			<p class="fy-eyebrow">Đậm Vị Trà – Ngọt Vị Yêu Thương</p>
			<h1>Trà Sữa Điểm 10</h1>
			<p>Trà sữa, trân châu và topping tươi mới pha chế mỗi ngày — nơi mỗi ly nước mang trọn tâm huyết gửi đến bạn.</p>
			<a class="fy-btn" href="#fy-products">Xem Menu</a>
			<div class="fy-hero-banner">
				<div class="fy-wave-image">
					<img src="<?php echo esc_url( $fy_banner_url ); ?>" alt="Không gian quán Trà Sữa Điểm 10">
					<svg class="fy-wave" viewBox="0 0 1200 120" preserveAspectRatio="none" aria-hidden="true">
						<path d="M0,40 C200,100 400,0 600,40 C800,80 1000,10 1200,50 L1200,120 L0,120 Z"></path>
					</svg>
				</div>
			</div>
		</div>
		<svg class="fy-wave fy-hero-wave" viewBox="0 0 1200 120" preserveAspectRatio="none" aria-hidden="true">
			<path d="M0,50 C200,150 400,-50 600,50 C800,150 1000,-50 1200,50 L1200,120 L0,120 Z"></path>
		</svg>
	</section>

	<div class="fy-side-cta">
		<a href="#fy-products">Xem Menu</a>
		<a href="<?php echo esc_url( home_url( '/lien-he' ) ); ?>">Liên Hệ</a>
	</div>

	<section class="fy-intro">
		<div class="fy-container fy-row">
			<div class="fy-col fy-reveal">
				<span class="fy-leaf" aria-hidden="true">🧋</span>
				<h2>Không Gian Ấm Cúng<br>Hương Trà Nồng Nàn</h2>
				<p class="fy-desc">Từ quầy pha chế đến từng góc nhỏ, Diễm 10 chăm chút để mỗi lần ghé quán đều là một trải nghiệm thư giãn, trọn vị.</p>
				<div class="fy-stats">
					<div><div class="fy-num">Trà Ngon</div>Nguyên liệu chọn lọc</div>
					<div><div class="fy-num">Giá Tốt</div>Hợp túi tiền mỗi ngày</div>
					<div><div class="fy-num">Uống Là Mê</div>Vị trà khó quên</div>
				</div>
				<a class="fy-btn" href="#fy-products">Xem Menu</a>
			</div>
			<div class="fy-col fy-visual-photo fy-reveal fy-reveal-d2">
				<div class="fy-wave-image">
					<img src="<?php echo esc_url( $fy_counter_url ); ?>" alt="Quầy pha chế Trà Sữa Diễm 10">
					<svg class="fy-wave" viewBox="0 0 1200 120" preserveAspectRatio="none" aria-hidden="true">
						<path d="M0,50 C250,10 450,90 700,45 C900,10 1050,90 1200,40 L1200,120 L0,120 Z"></path>
					</svg>
				</div>
				<div class="fy-badge" aria-hidden="true">
					<svg viewBox="0 0 200 200">
						<defs>
							<path id="fy-badge-circle" d="M100,100 m-75,0 a75,75 0 1,1 150,0 a75,75 0 1,1 -150,0" />
						</defs>
						<text font-size="12.5" font-weight="700" letter-spacing="1.5" fill="currentColor">
							<textPath href="#fy-badge-circle" startOffset="0%">100% TRÀ NGUYÊN CHẤT • 100% TRÀ NGUYÊN CHẤT •</textPath>
						</text>
					</svg>
					<span class="fy-badge-icon">🍃</span>
				</div>
			</div>
		</div>
	</section>

	<div class="fy-strip">
		<div class="fy-track">
			<?php for ( $r = 0; $r < 2; $r++ ) : ?>
				<?php foreach ( $fy_features as $f ) : ?>
					<span>★ <?php echo esc_html( $f ); ?></span>
				<?php endforeach; ?>
			<?php endfor; ?>
		</div>
	</div>

	<section class="fy-products" id="fy-products">
		<div class="fy-container">
			<h2 class="fy-reveal">Trà Sữa Đáng Thử Nhất</h2>
			<div class="fy-grid">
				<?php foreach ( $fy_products as $i => $p ) : ?>
					<?php
					$fy_product_link = ! empty( $p['slug'] ) ? home_url( '/san-pham/' . $p['slug'] . '/' ) : '';
					?>
					<a class="fy-card fy-reveal fy-reveal-d<?php echo esc_attr( ( $i % 5 ) + 1 ); ?>" href="<?php echo esc_url( $fy_product_link ); ?>">
						<div class="fy-circle">
							<?php if ( ! empty( $p['image'] ) ) : ?>
								<img src="<?php echo esc_url( $p['image'] ); ?>" alt="<?php echo esc_attr( $p['name'] ); ?>">
							<?php else : ?>
								<span aria-hidden="true"><?php echo esc_html( $p['emoji'] ); ?></span>
							<?php endif; ?>
							<?php if ( ! empty( $p['sale'] ) ) : ?>
								<span class="fy-sale">SALE</span>
							<?php endif; ?>
						</div>
						<h3><?php echo esc_html( $p['name'] ); ?></h3>
						<div>
							<span class="fy-price"><?php echo esc_html( $p['price'] ); ?></span>
							<?php if ( ! empty( $p['old_price'] ) ) : ?>
								<span class="fy-old"><?php echo esc_html( $p['old_price'] ); ?></span>
							<?php endif; ?>
						</div>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="fy-promo">
		<div class="fy-promo-left fy-reveal">
			<div class="fy-jar" aria-hidden="true">🧋</div>
			<h3>Đậm Vị Trà<br>Ngọt Vị Yêu Thương</h3>
		</div>
		<div class="fy-promo-right">
			<h2 class="fy-reveal">Topping Đa Dạng</h2>
			<?php foreach ( $fy_menu as $i => $m ) : ?>
				<div class="fy-menu-item fy-reveal fy-reveal-d<?php echo esc_attr( ( $i % 5 ) + 1 ); ?>">
					<div class="fy-menu-emoji" aria-hidden="true"><?php echo esc_html( $m['emoji'] ); ?></div>
					<div class="fy-menu-info">
						<div class="fy-menu-top">
							<h4><?php echo esc_html( $m['name'] ); ?></h4>
						</div>
						<p><?php echo esc_html( $m['desc'] ); ?></p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</section>

	<section class="fy-cta">
		<div class="fy-container fy-reveal">
			<h2>Sẵn sàng thưởng thức ly trà sữa đầu tiên?</h2>
			<a class="fy-btn" href="<?php echo esc_url( home_url( '/' ) ); ?>">Đặt Hàng Ngay</a>
		</div>
	</section>

</div>

<?php
get_footer();
