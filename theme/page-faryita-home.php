<?php
/**
 * Template Name: MilkTea-90 Home
 * Trang chủ Trà Sữa DIEM 10: hero, giới thiệu, sản phẩm, menu.
 *
 * Nội dung (chữ + ảnh + video) chỉnh trực tiếp ở màn hình sửa Trang → khối
 * "Nội dung Trang chủ" (xem theme/inc/page-content-fields.php). Trường để trống
 * thì dùng giá trị mặc định bên dưới.
 *
 * @package MilkTea-90
 */
get_header();

$fy_banner_url      = get_template_directory_uri() . '/assets/images/brand/shop-banner.jpg';
$fy_counter_url     = get_template_directory_uri() . '/assets/images/brand/shop-counter.jpg';
$fy_store_photo_url = get_template_directory_uri() . '/assets/images/brand/store-counter.jpg';

// Tab phân loại sản phẩm trang chủ — lấy sản phẩm WooCommerce thật theo tag, client tự
// gắn/đổi tag ngay trong wp-admin (Sản phẩm > Thẻ) mà không cần sửa code. Nhãn tab đổi
// được ở khối "Nội dung Trang chủ", slug (dùng để lọc theo tag) giữ cố định.
$fy_tabs = array(
	'yeu-thich' => fy_pc( 'products', 'tab1' ),
	'ban-chay'  => fy_pc( 'products', 'tab2' ),
	'hot-trend' => fy_pc( 'products', 'tab3' ),
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

$fy_menu = array();
for ( $fy_n = 1; $fy_n <= 4; $fy_n++ ) {
	$fy_menu[] = array(
		'emoji' => fy_pc( 'promo', "item{$fy_n}_emoji" ),
		'name'  => fy_pc( 'promo', "item{$fy_n}_name" ),
		'desc'  => fy_pc( 'promo', "item{$fy_n}_desc" ),
	);
}

$fy_features = array(
	fy_pc( 'strip', 'word1' ),
	fy_pc( 'strip', 'word2' ),
	fy_pc( 'strip', 'word3' ),
	fy_pc( 'strip', 'word4' ),
);

$fy_store_btn_url = fy_pc( 'store', 'button_url' );
$fy_store_btn_url = $fy_store_btn_url ? $fy_store_btn_url : home_url( '/cua-hang/' );
?>


<div class="fy-home">

	<section class="fy-hero">
		<div class="fy-blob fy-blob-1" aria-hidden="true"></div>
		<div class="fy-blob fy-blob-2" aria-hidden="true"></div>
		<div class="fy-hero-banner owl-carousel fy-hero-slider">
			<div class="item"><?php echo fy_pc_media( 'banner', 'slide1', $fy_banner_url, array( 'alt' => 'Không gian quán Trà Sữa Điểm 10', 'wrap_class' => 'fy-pc-media fy-hero-media' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
			<div class="item"><?php echo fy_pc_media( 'banner', 'slide2', $fy_counter_url, array( 'alt' => 'Quầy pha chế Trà Sữa Điểm 10', 'wrap_class' => 'fy-pc-media fy-hero-media' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
		</div>
		<svg class="fy-wave fy-hero-wave" viewBox="0 0 1200 120" preserveAspectRatio="none" aria-hidden="true">
			<path d="M0,50 C200,150 400,-50 600,50 C800,150 1000,-50 1200,50 L1200,120 L0,120 Z"></path>
		</svg>
	</section>

	<div class="fy-side-cta">
		<a href="#fy-products"><?php echo esc_html( fy_pc( 'intro', 'button' ) ); ?></a>
		<a href="<?php echo esc_url( home_url( '/lien-he' ) ); ?>">Liên Hệ</a>
	</div>

	<section class="fy-intro">
		<div class="fy-container fy-row">
			<div class="fy-col fy-reveal">
				<span class="fy-leaf" aria-hidden="true">🧋</span>
				<h2><?php echo esc_html( fy_pc( 'intro', 'heading1' ) ); ?><br><?php echo esc_html( fy_pc( 'intro', 'heading2' ) ); ?></h2>
				<p class="fy-desc"><?php echo esc_html( fy_pc( 'intro', 'desc' ) ); ?></p>
				<div class="fy-stats">
					<div><div class="fy-num"><?php echo esc_html( fy_pc( 'intro', 'stat1_num' ) ); ?></div><?php echo esc_html( fy_pc( 'intro', 'stat1_sub' ) ); ?></div>
					<div><div class="fy-num"><?php echo esc_html( fy_pc( 'intro', 'stat2_num' ) ); ?></div><?php echo esc_html( fy_pc( 'intro', 'stat2_sub' ) ); ?></div>
					<div><div class="fy-num"><?php echo esc_html( fy_pc( 'intro', 'stat3_num' ) ); ?></div><?php echo esc_html( fy_pc( 'intro', 'stat3_sub' ) ); ?></div>
				</div>
				<a class="fy-btn" href="#fy-products"><?php echo esc_html( fy_pc( 'intro', 'button' ) ); ?></a>
			</div>
			<div class="fy-col fy-visual-photo fy-reveal fy-reveal-d2">
				<div class="fy-wave-image">
					<?php echo fy_pc_media( 'intro', 'media', $fy_counter_url, array( 'alt' => 'Quầy pha chế Trà Sữa DIEM 10', 'wrap_class' => 'fy-pc-media fy-wave-media' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
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
			<h2 class="fy-reveal"><?php echo esc_html( fy_pc( 'products', 'heading' ) ); ?></h2>

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
			<h3><?php echo esc_html( fy_pc( 'promo', 'slogan' ) ); ?></h3>
		</div>
		<div class="fy-promo-right">
			<h2 class="fy-reveal"><?php echo esc_html( fy_pc( 'promo', 'heading' ) ); ?></h2>
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

	<section class="fy-story-text" id="fy-store-intro">
		<div class="fy-container fy-row">
			<div class="fy-col fy-reveal">
				<h2><?php echo esc_html( fy_pc( 'store', 'heading' ) ); ?></h2>
				<p class="fy-desc"><?php echo esc_html( fy_pc( 'store', 'desc' ) ); ?></p>
				<a class="fy-btn" href="<?php echo esc_url( $fy_store_btn_url ); ?>"><?php echo esc_html( fy_pc( 'store', 'button' ) ); ?></a>
			</div>
			<div class="fy-col fy-visual-photo fy-reveal fy-reveal-d2">
				<div class="fy-wave-image">
					<?php echo fy_pc_media( 'store', 'media', $fy_store_photo_url, array( 'alt' => 'Quầy pha chế Trà Sữa DIEM10', 'wrap_class' => 'fy-pc-media fy-wave-media' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
					<svg class="fy-wave" viewBox="0 0 1200 120" preserveAspectRatio="none" aria-hidden="true">
						<path d="M0,50 C250,10 450,90 700,45 C900,10 1050,90 1200,40 L1200,120 L0,120 Z"></path>
					</svg>
				</div>
			</div>
		</div>
	</section>

	<?php
	$fy_latest_posts = fy_news_enabled() ? new WP_Query( array(
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'posts_per_page' => 3,
		'orderby'        => 'date',
		'order'          => 'DESC',
		'no_found_rows'  => true,
	) ) : null;
	if ( $fy_latest_posts && $fy_latest_posts->have_posts() ) :
		?>
		<section class="fy-news" id="fy-latest-posts">
			<div class="fy-container">
				<h2 class="fy-reveal"><?php echo esc_html( fy_pc( 'news', 'news_heading' ) ); ?></h2>
				<div class="fy-news-grid">
					<?php while ( $fy_latest_posts->have_posts() ) : $fy_latest_posts->the_post(); ?>
						<article class="fy-news-card fy-reveal">
							<?php if ( has_post_thumbnail() ) : ?>
								<a class="fy-news-thumb" href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'medium_large' ); ?>
								</a>
							<?php endif; ?>
							<div class="fy-news-body">
								<span class="fy-news-date"><?php echo esc_html( get_the_date() ); ?></span>
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 20 ) ); ?></p>
								<a class="fy-news-more" href="<?php the_permalink(); ?>">Đọc Thêm →</a>
							</div>
						</article>
					<?php endwhile; ?>
				</div>
				<p style="text-align:center;margin-top:36px">
					<a class="fy-btn" href="<?php echo esc_url( home_url( '/tin-tuc/' ) ); ?>"><?php echo esc_html( fy_pc( 'news', 'news_button' ) ); ?></a>
				</p>
			</div>
		</section>
		<?php
		wp_reset_postdata();
	endif;
	?>

	<section class="fy-franchise" id="fy-franchise">
		<div class="fy-container fy-franchise-grid fy-reveal">
			<div class="fy-franchise-heading">
				<h2><?php echo fy_pc_nl2br( 'news', 'franchise_heading' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
			</div>

			<div class="fy-franchise-form-wrap">
				<?php faryita_render_franchise_form( 'home' ); ?>
			</div>
		</div>
	</section>

</div>

<?php
get_footer();
