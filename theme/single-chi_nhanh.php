<?php
/**
 * Single: Chi Nhánh
 * Trang chi tiết 1 chi nhánh Trà Sữa DIEM 10, trình bày dạng bài viết (ảnh lớn + nội dung + bản đồ).
 *
 * @package MilkTea-90
 */
get_header();

while ( have_posts() ) :
	the_post();

	$fy_coming_soon = get_post_meta( get_the_ID(), '_fy_coming_soon', true );
	$fy_address     = get_the_excerpt();
	$fy_maps_query  = rawurlencode( get_the_title() . ', ' . $fy_address );
	?>

	<div class="fy-home">

		<section class="fy-page-hero fy-page-hero-shop">
			<div class="fy-container fy-reveal">
				<p class="fy-eyebrow">Trà Sữa DIEM10</p>
				<h1><?php the_title(); ?></h1>
			</div>
			<svg class="fy-wave fy-page-hero-shop-wave" viewBox="0 0 1200 120" preserveAspectRatio="none" aria-hidden="true">
				<path d="M0,50 C200,150 400,-50 600,50 C800,150 1000,-50 1200,50 L1200,120 L0,120 Z"></path>
			</svg>
		</section>

		<article class="fy-branch-post">
			<div class="fy-container">
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="fy-branch-post-photo">
						<?php the_post_thumbnail( 'large' ); ?>
					</div>
				<?php endif; ?>

				<div class="fy-branch-post-body">
					<h2><?php the_title(); ?></h2>

					<ul class="fy-branch-meta">
						<li>
							<i class="fas fa-map-marker-alt" aria-hidden="true"></i>
							<span><?php echo esc_html( $fy_address ); ?></span>
						</li>
						<?php if ( $fy_coming_soon ) : ?>
							<li>
								<i class="fas fa-clock" aria-hidden="true"></i>
								<span>Chi nhánh đang chuẩn bị khai trương, mời bạn quay lại sau nhé!</span>
							</li>
						<?php endif; ?>
					</ul>

					<?php
					$fy_content = get_the_content();
					if ( ! empty( $fy_content ) ) {
						echo '<div class="fy-desc">' . apply_filters( 'the_content', $fy_content ) . '</div>';
					}
					?>

					<a class="fy-btn" target="_blank" rel="noopener" href="https://www.google.com/maps/search/?api=1&query=<?php echo esc_attr( $fy_maps_query ); ?>">Chỉ Đường →</a>
					<br>
					<a class="fy-back-link" href="<?php echo esc_url( home_url( '/cua-hang/' ) ); ?>">← Xem tất cả chi nhánh</a>
				</div>

				<div class="fy-branch-post-map">
					<iframe
						src="https://www.google.com/maps?q=<?php echo esc_attr( $fy_maps_query ); ?>&output=embed"
						allowfullscreen loading="lazy"
						referrerpolicy="no-referrer-when-downgrade"
						title="<?php the_title_attribute(); ?>"></iframe>
				</div>
			</div>
		</article>

	</div>

	<?php
endwhile;

get_footer();
