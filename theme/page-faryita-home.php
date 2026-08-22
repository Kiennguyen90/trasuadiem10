<?php
/**
 * Template Name: MilkTea-90 Home
 * Trang chủ Trà Sữa DIEM 10: hero, giới thiệu, sản phẩm, menu.
 *
 * @package MilkTea-90
 */
get_header();

$fy_banner_url  = get_template_directory_uri() . '/assets/images/brand/shop-banner.jpg';
$fy_counter_url = get_template_directory_uri() . '/assets/images/brand/shop-counter.jpg';

// Tab phân loại sản phẩm trang chủ — lấy sản phẩm WooCommerce thật theo tag, client tự
// gắn/đổi tag ngay trong wp-admin (Sản phẩm > Thẻ) mà không cần sửa code.
$fy_tabs = array(
	'yeu-thich' => 'Yêu Thích',
	'ban-chay'  => 'Bán Chạy',
	'hot-trend' => 'Hot Trend',
);
$fy_tab_products = array();
if ( class_exists( 'WooCommerce' ) ) {
	foreach ( $fy_tabs as $fy_tag_slug => $fy_tab_label ) {
		$fy_tab_products[ $fy_tag_slug ] = wc_get_products( array(
			'status'  => 'publish',
			'limit'   => 8,
			'orderby' => 'menu_order',
			'order'   => 'ASC',
			'tag'     => array( $fy_tag_slug ),
		) );
	}
}

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
		<div class="fy-hero-banner owl-carousel fy-hero-slider">
			<div class="item"><img src="<?php echo esc_url( $fy_banner_url ); ?>" alt="Không gian quán Trà Sữa Điểm 10"></div>
			<div class="item"><img src="<?php echo esc_url( $fy_counter_url ); ?>" alt="Quầy pha chế Trà Sữa Điểm 10"></div>
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
				<p class="fy-desc">Từ quầy pha chế đến từng góc nhỏ, DIEM 10 chăm chút để mỗi lần ghé quán đều là một trải nghiệm thư giãn, trọn vị.</p>
				<div class="fy-stats">
					<div><div class="fy-num">Trà Ngon</div>Nguyên liệu chọn lọc</div>
					<div><div class="fy-num">Giá Tốt</div>Hợp túi tiền mỗi ngày</div>
					<div><div class="fy-num">Uống Là Mê</div>Vị trà khó quên</div>
				</div>
				<a class="fy-btn" href="#fy-products">Xem Menu</a>
			</div>
			<div class="fy-col fy-visual-photo fy-reveal fy-reveal-d2">
				<div class="fy-wave-image">
					<img src="<?php echo esc_url( $fy_counter_url ); ?>" alt="Quầy pha chế Trà Sữa DIEM 10">
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

			<div class="fy-tabs" role="tablist">
				<?php $fy_first_tab = true; foreach ( $fy_tabs as $fy_tag_slug => $fy_tab_label ) : ?>
					<button type="button" class="fy-tab-btn<?php echo $fy_first_tab ? ' is-active' : ''; ?>" data-fy-tab="<?php echo esc_attr( $fy_tag_slug ); ?>"><?php echo esc_html( $fy_tab_label ); ?></button>
					<?php $fy_first_tab = false; endforeach; ?>
			</div>

			<?php $fy_first_tab = true; foreach ( $fy_tabs as $fy_tag_slug => $fy_tab_label ) : ?>
				<div class="fy-grid" data-fy-panel="<?php echo esc_attr( $fy_tag_slug ); ?>" <?php echo $fy_first_tab ? '' : 'hidden'; ?>>
					<?php
					$fy_tab_items = $fy_tab_products[ $fy_tag_slug ] ?? array();
					if ( $fy_tab_items ) :
						foreach ( $fy_tab_items as $i => $fy_product ) :
							$fy_image_id  = $fy_product->get_image_id();
							$fy_image_url = $fy_image_id ? wp_get_attachment_image_url( $fy_image_id, 'medium' ) : wc_placeholder_img_src();
							?>
							<a class="fy-card fy-reveal fy-reveal-d<?php echo esc_attr( ( $i % 5 ) + 1 ); ?>" href="<?php echo esc_url( $fy_product->get_permalink() ); ?>">
								<div class="fy-circle">
									<img src="<?php echo esc_url( $fy_image_url ); ?>" alt="<?php echo esc_attr( $fy_product->get_name() ); ?>">
									<?php if ( $fy_product->is_on_sale() ) : ?>
										<span class="fy-sale">SALE</span>
									<?php endif; ?>
								</div>
								<h3><?php echo esc_html( $fy_product->get_name() ); ?></h3>
							</a>
						<?php endforeach;
					else :
						?>
						<p style="grid-column:1/-1;text-align:center;color:#6b6b6b">Chưa có sản phẩm trong danh mục này.</p>
					<?php endif; ?>
				</div>
				<?php $fy_first_tab = false; endforeach; ?>
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

	<section class="fy-franchise" id="fy-franchise">
		<div class="fy-container fy-franchise-grid fy-reveal">
			<div class="fy-franchise-heading">
				<h2>Đăng Ký Tư Vấn Nhượng Quyền Thương Hiệu</h2>
			</div>

			<div class="fy-franchise-form-wrap">
				<?php faryita_render_franchise_form( 'home' ); ?>
			</div>
		</div>
	</section>

</div>

<?php
get_footer();
