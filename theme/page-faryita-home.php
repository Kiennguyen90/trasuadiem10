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

// Khối "Topping Đa Dạng" — lấy sản phẩm thật trong danh mục "Topping" (client thêm/sửa
// ngay trong wp-admin > Sản phẩm). Chưa có sản phẩm topping nào thì rơi về danh sách
// biểu tượng mặc định ($fy_menu) khai báo ở khối "Nội dung Trang chủ".
$fy_topping_products = array();
if ( class_exists( 'WooCommerce' ) ) {
	$fy_topping_products = wc_get_products( array(
		'status'   => 'publish',
		'limit'    => 3,
		'orderby'  => 'menu_order',
		'order'    => 'ASC',
		'category' => array( 'topping' ),
	) );
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
		<div class="fy-hero-banner owl-carousel fy-hero-slider">
			<div class="item"><?php echo fy_pc_media( 'banner', 'slide1', $fy_banner_url, array( 'alt' => 'Không gian quán Trà Sữa Điểm 10', 'wrap_class' => 'fy-pc-media fy-hero-media' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
			<div class="item"><?php echo fy_pc_media( 'banner', 'slide2', $fy_counter_url, array( 'alt' => 'Quầy pha chế Trà Sữa Điểm 10', 'wrap_class' => 'fy-pc-media fy-hero-media' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
		</div>
	</section>

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
			<?php if ( $fy_topping_products ) : ?>
				<?php foreach ( $fy_topping_products as $i => $fy_top ) :
					$fy_top_img = $fy_top->get_image_id() ? wp_get_attachment_image_url( $fy_top->get_image_id(), 'thumbnail' ) : '';
					?>
					<a class="fy-menu-item fy-reveal fy-reveal-d<?php echo esc_attr( ( $i % 5 ) + 1 ); ?>" href="<?php echo esc_url( $fy_top->get_permalink() ); ?>">
						<div class="fy-menu-emoji" aria-hidden="true">
							<?php if ( $fy_top_img ) : ?>
								<img src="<?php echo esc_url( $fy_top_img ); ?>" alt="<?php echo esc_attr( $fy_top->get_name() ); ?>" loading="lazy">
							<?php else : ?>🧋<?php endif; ?>
						</div>
						<div class="fy-menu-info">
							<div class="fy-menu-top">
								<h4><?php echo esc_html( $fy_top->get_name() ); ?></h4>
							</div>
							<?php $fy_top_desc = $fy_top->get_short_description(); ?>
							<?php if ( $fy_top_desc ) : ?>
								<p><?php echo esc_html( wp_strip_all_tags( $fy_top_desc ) ); ?></p>
							<?php endif; ?>
						</div>
					</a>
				<?php endforeach; ?>
			<?php else : ?>
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
			<?php endif; ?>
			<?php
			// get_term_link() trả về WP_Error nếu danh mục "topping" chưa tồn tại (vd. site
			// chưa có danh mục sản phẩm nào) — esc_url() không nhận WP_Error, gây fatal
			// TypeError. Fallback về trang Sản Phẩm khi đó.
			$fy_topping_link = get_term_link( 'topping', 'product_cat' );
			if ( is_wp_error( $fy_topping_link ) ) {
				$fy_topping_link = get_permalink( wc_get_page_id( 'shop' ) );
			}
			?>
			<p class="fy-promo-more fy-reveal">
				<a href="<?php echo esc_url( $fy_topping_link ); ?>">Xem tất cả topping →</a>
			</p>
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

	<?php
	// Mục "Khách Hàng Nói Gì Về Chúng Tôi" — lấy cảm hứng bố cục từ mục "Cảm nhận của khách
	// hàng" trên wujiateavn.com: lưới thẻ trắng (sao vàng + trích dẫn + avatar chữ cái đầu),
	// nằm ngay trước khối đăng ký nhượng quyền. Nội dung khách hàng sửa được qua wp-admin.
	$fy_testimonials = array();
	for ( $fy_t = 1; $fy_t <= 3; $fy_t++ ) {
		$fy_t_name = fy_pc( 'testimonials', "item{$fy_t}_name" );
		if ( '' === $fy_t_name ) {
			continue;
		}
		$fy_testimonials[] = array(
			'name'    => $fy_t_name,
			'role'    => fy_pc( 'testimonials', "item{$fy_t}_role" ),
			'quote'   => fy_pc( 'testimonials', "item{$fy_t}_quote" ),
			// function_exists guard: một số host tắt extension mbstring — tránh fatal
			// "Call to undefined function mb_strtoupper()" khiến cả trang chủ die trắng.
			'initial' => function_exists( 'mb_strtoupper' ) && function_exists( 'mb_substr' )
				? mb_strtoupper( mb_substr( $fy_t_name, 0, 1 ) )
				: strtoupper( substr( $fy_t_name, 0, 1 ) ),
		);
	}
	?>
	<?php if ( $fy_testimonials ) : ?>
		<section class="fy-testimonials" id="fy-testimonials">
			<div class="fy-container">
				<h2 class="fy-reveal"><?php echo esc_html( fy_pc( 'testimonials', 'heading' ) ); ?></h2>
				<p class="fy-testimonials-desc fy-reveal"><?php echo esc_html( fy_pc( 'testimonials', 'desc' ) ); ?></p>

				<div class="fy-testimonials-layout">
					<?php // Lưới cảm nhận -> slider hiển thị 2 thẻ/lần + nút điều hướng tròn (kiểu
					// owl-carousel đã dùng cho hero/sản phẩm liên quan), theo mẫu "Cảm nhận của
					// khách hàng" wujiateavn.com. Không gắn fy-reveal ở đây: owl-carousel nhân bản
					// (clone) thẻ để loop, IntersectionObserver của fy-reveal không theo kịp bản
					// clone -> thẻ bị kẹt ở opacity:0 khi trượt tới. ?>
					<div class="fy-testimonials-grid fy-testimonials-carousel owl-carousel">
						<?php foreach ( $fy_testimonials as $i => $fy_t_item ) : ?>
							<div class="fy-testimonial-card">
								<div class="fy-testimonial-quote" aria-hidden="true">&ldquo;</div>
								<div class="fy-testimonial-stars" aria-hidden="true">★★★★★</div>
								<p class="fy-testimonial-text"><?php echo esc_html( $fy_t_item['quote'] ); ?></p>
								<div class="fy-testimonial-author">
									<div class="fy-testimonial-avatar" aria-hidden="true"><?php echo esc_html( $fy_t_item['initial'] ); ?></div>
									<div>
										<strong><?php echo esc_html( $fy_t_item['name'] ); ?></strong>
										<span><?php echo esc_html( $fy_t_item['role'] ); ?></span>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>

					<?php // Cột ảnh bên phải — client tự gắn ảnh khách hàng thật qua wp-admin (Trang chủ >
					// Mục "Khách Hàng Nói Gì Về Chúng Tôi" > Ảnh khách hàng); để trống thì hiện khung chờ. ?>
					<div class="fy-testimonials-media fy-reveal fy-reveal-d2">
						<?php if ( fy_pc_has_media( 'testimonials', 'media' ) ) : ?>
							<?php echo fy_pc_media( 'testimonials', 'media', '', array( 'alt' => 'Khách hàng Trà Sữa DIEM 10', 'wrap_class' => 'fy-pc-media fy-testimonials-photo' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
						<?php else : ?>
							<div class="fy-testimonials-placeholder" aria-hidden="true">
								<span class="fy-testimonials-placeholder-icon">🖼️</span>
								<p>Ảnh khách hàng<br>sẽ hiển thị ở đây</p>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>

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
