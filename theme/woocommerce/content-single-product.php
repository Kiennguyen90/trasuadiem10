<?php
/**
 * Nội dung trang chi tiết sản phẩm - theo style riêng của Trà Sữa DIEM10.
 *
 * @package Art Blog
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! $product instanceof WC_Product ) {
	$product = wc_get_product( get_the_ID() );
}

if ( ! $product ) {
	return;
}

$fy_cat_terms = get_the_terms( get_the_ID(), 'product_cat' );
$fy_cat_name  = ( $fy_cat_terms && ! is_wp_error( $fy_cat_terms ) ) ? $fy_cat_terms[0]->name : '';
$fy_shop_url  = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/' );

// Thành phần: ưu tiên nội dung nhập riêng cho sản phẩm (meta `_fy_ingredients`),
// nếu chưa nhập thì dùng nội dung mặc định của theme.
$fy_ingredients_raw = get_post_meta( get_the_ID(), '_fy_ingredients', true );
if ( $fy_ingredients_raw ) {
	$fy_ingredients = array_filter( array_map( 'trim', explode( "\n", $fy_ingredients_raw ) ) );
} else {
	$fy_ingredients = array(
		get_the_title() . ' tươi, chuẩn bị trong ngày',
		'Nước lọc tinh khiết',
		'Không đường tinh luyện, không chất bảo quản',
	);
}

// Lợi ích dinh dưỡng: ghi chú + các badge "Không..." được tick riêng cho từng sản phẩm.
$fy_nutrition_note = get_post_meta( get_the_ID(), '_fy_nutrition_note', true );
$fy_active_badges  = array();
foreach ( faryita_nutrition_badge_pill_lines() as $fy_badge_key => $fy_badge_lines ) {
	if ( get_post_meta( get_the_ID(), '_fy_badge_' . $fy_badge_key, true ) ) {
		$fy_active_badges[ $fy_badge_key ] = $fy_badge_lines;
	}
}
$fy_has_nutrition_block = $fy_nutrition_note || $fy_active_badges;

// Thông tin thêm: tái sử dụng Thuộc tính (Attributes) + Cân nặng/Kích thước có sẵn của WooCommerce.
$fy_visible_attributes = array_filter( $product->get_attributes(), 'wc_attributes_array_filter_visible' );
$fy_has_addinfo        = $product->has_weight() || $product->has_dimensions() || $fy_visible_attributes;
?>


<?php
/*
 * Lưu ý: banner (fy-page-hero-shop) được render riêng trong woocommerce/single-product.php,
 * NẰM NGOÀI khối .container/#primary — để full-width và sát menu, giống trang /san-pham/.
 * Không đặt banner ở đây vì nơi này bị bó hẹp trong cột nội dung (68% width, có margin-top).
 */
?>

<div class="fy-home">

	<section class="fy-detail">
		<div class="fy-container">
			<div class="fy-detail-grid">
				<div class="fy-detail-image">
					<div class="fy-detail-photo">
						<?php if ( has_post_thumbnail() ) : ?>
							<?php the_post_thumbnail( 'large' ); ?>
						<?php else : ?>
							<img src="<?php echo esc_url( wc_placeholder_img_src( 'large' ) ); ?>" alt="<?php the_title_attribute(); ?>">
						<?php endif; ?>
						<?php if ( $product->is_on_sale() ) : ?>
							<span class="fy-sale">SALE</span>
						<?php endif; ?>
					</div>
				</div>
				<div class="fy-detail-info">
					<?php if ( $fy_cat_name ) : ?>
						<span class="fy-cat"><?php echo esc_html( $fy_cat_name ); ?></span>
					<?php endif; ?>
					<h2><?php the_title(); ?></h2>

					<?php if ( $product->get_short_description() ) : ?>
						<div class="fy-detail-desc fy-detail-desc-short"><?php echo wp_kses_post( wpautop( $product->get_short_description() ) ); ?></div>
					<?php endif; ?>

					<h4>Thành Phần</h4>
					<ul class="fy-ingredient-list">
						<?php foreach ( $fy_ingredients as $fy_ingredient ) : ?>
							<li><?php echo esc_html( $fy_ingredient ); ?></li>
						<?php endforeach; ?>
					</ul>

					<a class="fy-btn fy-btn-outline" href="<?php echo esc_url( $fy_shop_url ); ?>">← Quay Lại Sản Phẩm</a>
				</div>
			</div>
		</div>
	</section>

	<section class="fy-product-info">
		<div class="fy-container">
			<div class="fy-info-grid">
				<div class="fy-info-main">

					<?php if ( get_the_content() ) : ?>
						<h3 class="fy-info-title">Mô Tả</h3>
						<div class="fy-detail-desc fy-detail-desc-full"><?php the_content(); ?></div>
					<?php endif; ?>

					<?php if ( $fy_has_nutrition_block ) : ?>
						<h3 class="fy-info-title">Lợi Ích Dinh Dưỡng</h3>
						<?php if ( $fy_nutrition_note ) : ?>
							<p class="fy-nutrition-note"><?php echo esc_html( $fy_nutrition_note ); ?></p>
						<?php endif; ?>
						<?php if ( $fy_active_badges ) : ?>
							<div class="fy-badge-row">
								<?php foreach ( $fy_active_badges as $fy_badge_lines ) : ?>
									<span class="fy-badge-pill">
										<?php foreach ( $fy_badge_lines as $fy_badge_line ) : ?>
											<span><?php echo esc_html( $fy_badge_line ); ?></span>
										<?php endforeach; ?>
									</span>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					<?php endif; ?>

				</div>

				<?php if ( $fy_has_addinfo ) : ?>
					<div class="fy-info-side">
						<div class="fy-addinfo-card">
							<h3 class="fy-info-title">Thông Tin Thêm</h3>
							<?php wc_display_product_attributes( $product ); ?>
						</div>
					</div>
				<?php endif; ?>

			</div>
		</div>
	</section>

	<?php
	$fy_related_ids = wc_get_related_products( $product->get_id(), get_theme_mod( 'custom_related_products_number', 8 ), $product->get_upsell_ids() );
	if ( $fy_related_ids ) :
		_prime_post_caches( $fy_related_ids );
		?>
		<section class="fy-products fy-related-products">
			<div class="fy-container archive-product">
				<h2>Sản Phẩm Liên Quan</h2>
				<ul class="products fy-related-carousel owl-carousel owl-theme">
					<?php
					foreach ( $fy_related_ids as $fy_related_id ) {
						$fy_related_product = wc_get_product( $fy_related_id );
						if ( ! $fy_related_product || ! $fy_related_product->is_visible() ) {
							continue;
						}
						setup_postdata( $GLOBALS['post'] = get_post( $fy_related_id ) );
						wc_get_template_part( 'content', 'product' );
					}
					wp_reset_postdata();
					?>
				</ul>
			</div>
		</section>
	<?php endif; ?>

</div>
