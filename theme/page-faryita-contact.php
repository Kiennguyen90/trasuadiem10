<?php
/**
 * Template Name: Faryita Liên Hệ
 * Trang liên hệ: form gửi thông tin khách hàng + thông tin cửa hàng.
 *
 * @package Art Blog
 */
get_header();

$fy_store_name  = get_theme_mod( 'fy_store_name', 'Trà Sữa DIEM 10' );
$fy_store_phone = get_theme_mod( 'fy_store_phone', '0900 000 000' );
$fy_store_email = get_theme_mod( 'fy_store_email', 'lienhe@faryita.vn' );
$fy_store_hours = get_theme_mod( 'fy_store_hours', '08:00 - 22:00 (Tất cả các ngày trong tuần)' );

$fy_status = isset( $_GET['fy_contact'] ) ? sanitize_key( $_GET['fy_contact'] ) : '';
?>

<div class="fy-home">

	<section class="fy-page-hero fy-page-hero-shop">
		<div class="fy-container fy-reveal">
			<p class="fy-eyebrow">Trà Sữa DIEM10</p>
			<h1>Liên Hệ</h1>
			<p>Mọi ý kiến, góp ý hay câu hỏi của bạn đều rất quan trọng với <?php echo esc_html( $fy_store_name ); ?>.</p>
		</div>
		<svg class="fy-wave fy-page-hero-shop-wave" viewBox="0 0 1200 120" preserveAspectRatio="none" aria-hidden="true">
			<path d="M0,50 C200,150 400,-50 600,50 C800,150 1000,-50 1200,50 L1200,120 L0,120 Z"></path>
		</svg>
	</section>

	<section class="fy-store">
		<div class="fy-container">
			<div class="fy-contact-grid">

				<div class="fy-contact-form-wrap">
					<h2>Hỗ Trợ &amp; Giải Đáp</h2>
					<p class="fy-desc">Để lại thông tin, đội ngũ <?php echo esc_html( $fy_store_name ); ?> sẽ liên hệ lại với bạn sớm nhất.</p>

					<?php if ( 'success' === $fy_status ) : ?>
						<div class="fy-contact-alert fy-contact-alert-success">Cảm ơn bạn! Chúng tôi đã nhận được thông tin và sẽ liên hệ lại sớm nhất.</div>
					<?php elseif ( 'error' === $fy_status ) : ?>
						<div class="fy-contact-alert fy-contact-alert-error">Vui lòng điền đầy đủ Họ tên, Email hợp lệ và Số điện thoại.</div>
					<?php endif; ?>

					<form class="fy-franchise-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
						<input type="hidden" name="action" value="fy_submit_contact">
						<?php wp_nonce_field( 'fy_submit_contact', 'fy_contact_nonce' ); ?>
						<input type="text" name="fy_website" class="fy-hp-field" tabindex="-1" autocomplete="off" aria-hidden="true">

						<div class="fy-franchise-row">
							<label class="fy-franchise-field">
								<span class="fy-franchise-label">Họ &amp; Tên</span>
								<input class="fy-franchise-control" type="text" name="fy_name" placeholder="Họ và tên" required>
							</label>
							<label class="fy-franchise-field">
								<span class="fy-franchise-label">Email</span>
								<input class="fy-franchise-control" type="email" name="fy_email" placeholder="Email" required>
							</label>
						</div>
						<div class="fy-franchise-row">
							<label class="fy-franchise-field">
								<span class="fy-franchise-label">Địa Chỉ</span>
								<input class="fy-franchise-control" type="text" name="fy_address" placeholder="Địa chỉ">
							</label>
							<label class="fy-franchise-field">
								<span class="fy-franchise-label">Số Điện Thoại</span>
								<input class="fy-franchise-control" type="text" name="fy_phone" placeholder="Số điện thoại" required>
							</label>
						</div>
						<label class="fy-franchise-field fy-franchise-field-full">
							<span class="fy-franchise-label">Nội Dung</span>
							<textarea class="fy-franchise-control fy-franchise-textarea" name="fy_message" rows="4" placeholder="Nhập nội dung chi tiết của bạn"></textarea>
						</label>

						<button type="submit" class="fy-franchise-submit">Gửi Tin Nhắn <span aria-hidden="true">→</span></button>
					</form>
				</div>

				<div class="fy-contact-info-card">
					<h3><?php echo esc_html( $fy_store_name ); ?></h3>
					<ul class="fy-store-meta">
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
						<li>
							<i class="fas fa-store" aria-hidden="true"></i>
							<span><a href="<?php echo esc_url( home_url( '/cua-hang/' ) ); ?>">Xem danh sách chi nhánh →</a></span>
						</li>
					</ul>
				</div>

			</div>
		</div>
	</section>

</div>

<?php
get_footer();
