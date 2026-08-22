<?php
/**
 * Template Name: Trà Sữa DIEM10
 * Trang Cửa Hàng - danh sách sản phẩm & trang chi tiết sản phẩm.
 *
 * @package MilkTea-90
 */
get_header();

$fy_shop_products = array(
	array(
		'slug'  => 'cam-vang',
		'emoji' => '🍊',
		'name'  => 'Cam Vàng',
		'cat'   => 'Nước Ép',
		'desc'  => 'Vị chua ngọt hài hoà từ cam tươi ép lạnh, mang lại cảm giác sảng khoái tức thì và bổ sung vitamin C dồi dào cho cơ thể.',
	),
	array(
		'slug'  => 'nho-tim',
		'emoji' => '🍇',
		'image' => get_template_directory_uri() . '/assets/images/products/nho-tim.jpg',
		'name'  => 'Nho Tím',
		'cat'   => 'Nước Ép',
		'desc'  => 'Ép từ những chùm nho tím chín mọng, vị ngọt đậm đà tự nhiên, giàu chất chống oxy hoá tốt cho tim mạch.',
	),
	array(
		'slug'  => 'dua-hau',
		'emoji' => '🍉',
		'name'  => 'Dưa Hấu',
		'cat'   => 'Nước Ép',
		'desc'  => 'Thanh mát và nhiều nước, Dưa Hấu là lựa chọn lý tưởng để giải nhiệt ngày hè mà vẫn nhẹ calo.',
	),
	array(
		'slug'  => 'dau-tay',
		'emoji' => '🍓',
		'name'  => 'Dâu Tây',
		'cat'   => 'Nước Ép',
		'desc'  => 'Hương dâu tây tươi ngọt dịu, ép lạnh giữ trọn màu sắc và dưỡng chất tự nhiên trong từng ngụm.',
	),
	array(
		'slug'  => 'xoai-nhiet-doi',
		'emoji' => '🥭',
		'name'  => 'Xoài Nhiệt Đới',
		'cat'   => 'Nước Ép',
		'sale'  => true,
		'desc'  => 'Xoài chín cây ép sánh mịn, vị ngọt đậm đà đặc trưng vùng nhiệt đới, giàu beta-caroten.',
	),
	array(
		'slug'  => 'viet-quat',
		'emoji' => '🫐',
		'name'  => 'Việt Quất',
		'cat'   => 'Nước Ép',
		'desc'  => 'Việt quất tươi giàu chất chống oxy hoá, vị chua ngọt nhẹ, tốt cho thị lực và tim mạch.',
	),
	array(
		'slug'  => 'chuoi-sua',
		'emoji' => '🍌',
		'name'  => 'Chuối Sữa',
		'cat'   => 'Sinh Tố',
		'desc'  => 'Sinh tố chuối sánh mịn hoà cùng sữa tươi, vị béo ngậy tự nhiên, cung cấp năng lượng tức thì.',
	),
	array(
		'slug'  => 'dua-bac-ha',
		'emoji' => '🍍',
		'name'  => 'Dứa Bạc Hà',
		'cat'   => 'Sinh Tố',
		'desc'  => 'Dứa tươi kết hợp lá bạc hà the mát, đánh thức vị giác với hương thơm sảng khoái.',
	),
	array(
		'slug'  => 'dua-sinh-to',
		'emoji' => '🥥',
		'name'  => 'Dừa Sinh Tố',
		'cat'   => 'Sinh Tố',
		'desc'  => 'Cốt dừa béo nhẹ xay sánh mịn, mang lại cảm giác dịu mát và bổ sung điện giải tự nhiên.',
	),
	array(
		'slug'  => 'detox-rau-xanh',
		'emoji' => '🥝',
		'name'  => 'Detox Rau Xanh',
		'cat'   => 'Detox',
		'desc'  => 'Hỗn hợp rau xanh và kiwi ép lạnh, giúp thanh lọc cơ thể nhẹ nhàng, giàu chất xơ.',
	),
	array(
		'slug'  => 'detox-ca-rot-gung',
		'emoji' => '🥕',
		'name'  => 'Detox Cà Rốt Gừng',
		'cat'   => 'Detox',
		'desc'  => 'Cà rốt tươi kết hợp gừng ấm nóng, hỗ trợ tiêu hoá và tăng cường sức đề kháng.',
	),
	array(
		'slug'  => 'detox-chanh-sa',
		'emoji' => '🍋',
		'name'  => 'Detox Chanh Sả',
		'cat'   => 'Detox',
		'desc'  => 'Chanh tươi và sả thơm nhẹ, vị chua thanh giúp tỉnh táo, hỗ trợ thanh lọc cơ thể mỗi sáng.',
	),
);

$fy_shop_filters = array( 'Tất Cả', 'Nước Ép', 'Sinh Tố', 'Detox' );

$fy_benefits_by_cat = array(
	'Nước Ép' => array( 'Ép Lạnh Tươi', 'Giàu Vitamin C', 'Không Chất Bảo Quản', '100% Trái Cây' ),
	'Sinh Tố' => array( 'Sánh Mịn Tự Nhiên', 'Giàu Chất Xơ', 'Không Đường Tinh Luyện', 'Năng Lượng Tức Thì' ),
	'Detox'   => array( 'Thanh Lọc Cơ Thể', 'Ít Calo', 'Giàu Chất Chống Oxy Hoá', 'Tươi Mỗi Ngày' ),
);

$fy_current_slug = isset( $_GET['san-pham'] ) ? sanitize_title( wp_unslash( $_GET['san-pham'] ) ) : '';
$fy_current_product = null;
if ( $fy_current_slug ) {
	foreach ( $fy_shop_products as $p ) {
		if ( $p['slug'] === $fy_current_slug ) {
			$fy_current_product = $p;
			break;
		}
	}
}

$fy_shop_url = home_url( '/cua-hang/' );
?>

<div class="fy-home">

<?php if ( $fy_current_product ) : ?>

	<section class="fy-page-hero fy-page-hero-shop">
		<div class="fy-container fy-reveal">
			<p class="fy-eyebrow">Trà Sữa DIEM10</p>
			<h1><?php echo esc_html( $fy_current_product['name'] ); ?></h1>
			<p class="fy-breadcrumb">
				<a href="<?php echo esc_url( $fy_shop_url ); ?>">Cửa Hàng</a>
				<span aria-hidden="true">/</span>
				<?php echo esc_html( $fy_current_product['cat'] ); ?>
				<span aria-hidden="true">/</span>
				<?php echo esc_html( $fy_current_product['name'] ); ?>
			</p>
		</div>
	</section>

	<section class="fy-detail">
		<div class="fy-container">
			<div class="fy-detail-grid fy-reveal">
				<div class="fy-detail-image">
					<div class="fy-circle fy-circle-lg">
						<?php if ( ! empty( $fy_current_product['image'] ) ) : ?>
							<img src="<?php echo esc_url( $fy_current_product['image'] ); ?>" alt="<?php echo esc_attr( $fy_current_product['name'] ); ?>">
						<?php else : ?>
							<span aria-hidden="true"><?php echo esc_html( $fy_current_product['emoji'] ); ?></span>
						<?php endif; ?>
						<?php if ( ! empty( $fy_current_product['sale'] ) ) : ?>
							<span class="fy-sale">SALE</span>
						<?php endif; ?>
					</div>
				</div>
				<div class="fy-detail-info">
					<span class="fy-cat"><?php echo esc_html( $fy_current_product['cat'] ); ?></span>
					<h2><?php echo esc_html( $fy_current_product['name'] ); ?></h2>
					<p class="fy-detail-desc"><?php echo esc_html( $fy_current_product['desc'] ); ?></p>

					<h4>Thành Phần</h4>
					<ul class="fy-ingredient-list">
						<li><?php echo esc_html( $fy_current_product['name'] ); ?> tươi, ép lạnh trong ngày</li>
						<li>Nước lọc tinh khiết</li>
						<li>Không đường tinh luyện, không chất bảo quản</li>
					</ul>

					<h4>Lợi Ích</h4>
					<div class="fy-benefit-chips">
						<?php foreach ( $fy_benefits_by_cat[ $fy_current_product['cat'] ] as $b ) : ?>
							<span class="fy-chip"><?php echo esc_html( $b ); ?></span>
						<?php endforeach; ?>
					</div>

					<a class="fy-btn" href="<?php echo esc_url( $fy_shop_url ); ?>">← Quay Lại Cửa Hàng</a>
				</div>
			</div>
		</div>
	</section>

<?php else : ?>

	<section class="fy-page-hero fy-page-hero-shop">
		<div class="fy-container fy-reveal">
			<p class="fy-eyebrow">Trà Sữa DIEM10</p>
			<h1>Cửa Hàng</h1>
			<p>Chọn cho mình ly nước ép, sinh tố hay detox yêu thích — tất cả đều tươi mới mỗi ngày.</p>
		</div>
	</section>

	<section class="fy-products">
		<div class="fy-container">
			<div class="fy-shop-filter fy-reveal">
				<?php foreach ( $fy_shop_filters as $i => $f ) : ?>
					<span class="<?php echo 0 === $i ? 'is-active' : ''; ?>"><?php echo esc_html( $f ); ?></span>
				<?php endforeach; ?>
			</div>
			<div class="fy-grid">
				<?php foreach ( $fy_shop_products as $i => $p ) : ?>
					<?php $fy_product_url = esc_url( add_query_arg( 'san-pham', $p['slug'], $fy_shop_url ) ); ?>
					<div class="fy-card fy-card-bordered fy-reveal fy-reveal-d<?php echo esc_attr( ( $i % 5 ) + 1 ); ?>">
						<div class="fy-card-media">
							<a class="fy-media-link" href="<?php echo $fy_product_url; ?>" aria-label="Xem <?php echo esc_attr( $p['name'] ); ?>"></a>
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
							<div class="fy-card-actions">
								<a class="fy-icon-btn" href="<?php echo $fy_product_url; ?>" title="Xem chi tiết"><i class="fas fa-shopping-bag"></i></a>
								<button class="fy-icon-btn fy-wishlist-btn" type="button" title="Yêu thích"><i class="fas fa-heart"></i></button>
								<a class="fy-icon-btn" href="<?php echo $fy_product_url; ?>" title="Xem nhanh"><i class="fas fa-search"></i></a>
							</div>
						</div>
						<span class="fy-cat"><?php echo esc_html( $p['cat'] ); ?></span>
						<h3><a href="<?php echo $fy_product_url; ?>"><?php echo esc_html( $p['name'] ); ?></a></h3>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="fy-cta">
		<div class="fy-container fy-reveal">
			<h2>Không tìm thấy hương vị yêu thích?</h2>
			<a class="fy-btn" href="<?php echo esc_url( home_url( '/lien-he' ) ); ?>">Liên Hệ Đặt Riêng</a>
		</div>
	</section>

<?php endif; ?>

</div>

<?php
get_footer();
