<?php
/**
 * Template Name: Faryita Cửa Hàng
 * Trang thông tin cửa hàng (địa chỉ, giờ mở cửa, bản đồ) - theo style riêng của Faryita Shop.
 *
 * @package Art Blog
 */
get_header();

$fy_store_name    = get_theme_mod( 'fy_store_name', 'Trà Sữa Diễm 10' );
$fy_store_address = get_theme_mod( 'fy_store_address', '123 Đường Nguyễn Văn A, Phường 1, Quận 1, TP. Hồ Chí Minh' );
$fy_store_hours   = get_theme_mod( 'fy_store_hours', '08:00 - 22:00 (Tất cả các ngày trong tuần)' );
$fy_store_phone   = get_theme_mod( 'fy_store_phone', '0900 000 000' );
$fy_store_email   = get_theme_mod( 'fy_store_email', 'lienhe@faryita.vn' );
$fy_maps_query    = rawurlencode( $fy_store_name . ', ' . $fy_store_address );
?>

<div class="fy-home">

	<section class="fy-page-hero fy-page-hero-shop">
		<div class="fy-container fy-reveal">
			<p class="fy-eyebrow">Faryita Shop</p>
			<h1>Cửa Hàng</h1>
			<p>Ghé thăm Faryita để thưởng thức những ly nước tươi ngon mỗi ngày.</p>
		</div>
		<svg class="fy-wave fy-page-hero-shop-wave" viewBox="0 0 1200 120" preserveAspectRatio="none" aria-hidden="true">
			<path d="M0,50 C200,150 400,-50 600,50 C800,150 1000,-50 1200,50 L1200,120 L0,120 Z"></path>
		</svg>
	</section>

	<section class="fy-store">
		<div class="fy-container">
			<div class="fy-store-grid">
				<div class="fy-store-info">
					<h2><?php echo esc_html( $fy_store_name ); ?></h2>
					<ul class="fy-store-meta">
						<li>
							<i class="fas fa-map-marker-alt" aria-hidden="true"></i>
							<span><?php echo esc_html( $fy_store_address ); ?></span>
						</li>
						<li>
							<i class="fas fa-clock" aria-hidden="true"></i>
							<span><?php echo esc_html( $fy_store_hours ); ?></span>
						</li>
						<li>
							<i class="fas fa-phone-alt" aria-hidden="true"></i>
							<span><a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $fy_store_phone ) ); ?>"><?php echo esc_html( $fy_store_phone ); ?></a></span>
						</li>
						<li>
							<i class="fas fa-envelope" aria-hidden="true"></i>
							<span><a href="mailto:<?php echo esc_attr( $fy_store_email ); ?>"><?php echo esc_html( $fy_store_email ); ?></a></span>
						</li>
					</ul>
					<a class="fy-btn" target="_blank" rel="noopener" href="https://www.google.com/maps/search/?api=1&query=<?php echo esc_attr( $fy_maps_query ); ?>">Chỉ Đường →</a>
				</div>
				<div class="fy-store-map">
					<iframe
						src="https://www.google.com/maps?q=<?php echo esc_attr( $fy_maps_query ); ?>&output=embed"
						width="100%" height="100%" style="border:0;"
						allowfullscreen loading="lazy"
						referrerpolicy="no-referrer-when-downgrade"
						title="<?php echo esc_attr( $fy_store_name ); ?>"></iframe>
				</div>
			</div>
		</div>
	</section>

</div>

<?php
get_footer();
