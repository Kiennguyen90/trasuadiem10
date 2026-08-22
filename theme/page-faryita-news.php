<?php
/**
 * Template Name: MilkTea-90 Tin Tức
 * Trang danh sách bài viết (Tin Tức) - theo style riêng của MilkTea-90.
 *
 * @package MilkTea-90
 */
get_header();

$fy_paged = max( 1, (int) get_query_var( 'paged' ), (int) get_query_var( 'page' ) );

$fy_news_query = new WP_Query(
	array(
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'posts_per_page' => 9,
		'paged'          => $fy_paged,
	)
);
?>

<div class="fy-home">

	<section class="fy-page-hero fy-page-hero-shop">
		<div class="fy-container fy-reveal">
			<p class="fy-eyebrow">Trà Sữa DIEM10</p>
			<h1>Tin Tức</h1>
			<p>Cập nhật tin tức, khuyến mãi và câu chuyện mới nhất từ Trà Sữa DIEM10.</p>
		</div>
		<svg class="fy-wave fy-page-hero-shop-wave" viewBox="0 0 1200 120" preserveAspectRatio="none" aria-hidden="true">
			<path d="M0,50 C200,150 400,-50 600,50 C800,150 1000,-50 1200,50 L1200,120 L0,120 Z"></path>
		</svg>
	</section>

	<section class="fy-news">
		<div class="fy-container">
			<?php if ( $fy_news_query->have_posts() ) : ?>
				<div class="fy-news-grid">
					<?php while ( $fy_news_query->have_posts() ) : $fy_news_query->the_post(); ?>
						<article class="fy-news-card">
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

				<?php
				$fy_pagination_links = paginate_links(
					array(
						'total'     => $fy_news_query->max_num_pages,
						'current'   => $fy_paged,
						'prev_text' => '←',
						'next_text' => '→',
					)
				);
				?>
				<?php if ( $fy_pagination_links ) : ?>
					<nav class="fy-pagination"><?php echo wp_kses_post( $fy_pagination_links ); ?></nav>
				<?php endif; ?>

			<?php else : ?>
				<p class="fy-news-empty">Chưa có bài viết nào.</p>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
		</div>
	</section>

</div>

<?php
get_footer();
