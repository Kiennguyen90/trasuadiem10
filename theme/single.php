<?php
/**
 * Single bài viết (Tin Tức) - style riêng Trà Sữa DIEM10.
 *
 * @package Art Blog
 */
get_header();

$fy_post_id = get_queried_object_id();

$fy_related_query = new WP_Query(
	array(
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'posts_per_page' => 5,
		'post__not_in'   => array( $fy_post_id ),
		'orderby'        => 'date',
		'order'          => 'DESC',
		'no_found_rows'  => true,
	)
);

while ( have_posts() ) :
	the_post();
	$fy_excerpt = get_the_excerpt();
	?>

	<div class="fy-home">

		<section class="fy-page-hero fy-page-hero-shop">
			<div class="fy-container fy-reveal">
				<p class="fy-eyebrow">Trà Sữa DIEM10</p>
				<h1><?php the_title(); ?></h1>
				<p class="fy-breadcrumb">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Trang Chủ</a>
					<span aria-hidden="true">/</span>
					<a href="<?php echo esc_url( home_url( '/tin-tuc/' ) ); ?>">Tin Tức</a>
					<span aria-hidden="true">/</span>
					<?php the_title(); ?>
				</p>
			</div>
			<svg class="fy-wave fy-page-hero-shop-wave" viewBox="0 0 1200 120" preserveAspectRatio="none" aria-hidden="true">
				<path d="M0,50 C200,150 400,-50 600,50 C800,150 1000,-50 1200,50 L1200,120 L0,120 Z"></path>
			</svg>
		</section>

		<section class="fy-post-section">
			<div class="fy-container fy-post-grid">

				<article class="fy-post-main">
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="fy-post-photo">
							<?php the_post_thumbnail( 'large' ); ?>
						</div>
					<?php endif; ?>

					<p class="fy-post-meta">
						<i class="fas fa-calendar-alt" aria-hidden="true"></i> <?php echo esc_html( get_the_date() ); ?>
						<span aria-hidden="true">·</span>
						<i class="fas fa-user" aria-hidden="true"></i> <?php the_author(); ?>
					</p>

					<?php if ( $fy_excerpt ) : ?>
						<div class="fy-post-intro"><?php echo esc_html( $fy_excerpt ); ?></div>
					<?php endif; ?>

					<div class="fy-post-content">
						<?php the_content(); ?>
					</div>

					<a class="fy-back-link" href="<?php echo esc_url( home_url( '/tin-tuc/' ) ); ?>">← Về Tin Tức</a>

					<?php
					if ( comments_open() || get_comments_number() ) :
						echo '<div class="fy-post-comments">';
						comments_template();
						echo '</div>';
					endif;
					?>
				</article>

				<aside class="fy-post-sidebar">
					<?php if ( $fy_related_query->have_posts() ) : ?>
						<div class="fy-post-sidebar-box">
							<h3>Bài Viết Liên Quan</h3>
							<ul class="fy-related-list">
								<?php while ( $fy_related_query->have_posts() ) : $fy_related_query->the_post(); ?>
									<li>
										<?php if ( has_post_thumbnail() ) : ?>
											<a class="fy-related-thumb" href="<?php the_permalink(); ?>">
												<?php the_post_thumbnail( 'thumbnail' ); ?>
											</a>
										<?php endif; ?>
										<div class="fy-related-body">
											<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
											<span><?php echo esc_html( get_the_date() ); ?></span>
										</div>
									</li>
								<?php endwhile; ?>
							</ul>
						</div>
					<?php endif; ?>
					<?php wp_reset_postdata(); ?>
				</aside>

			</div>
		</section>

	</div>

	<?php
endwhile;

get_footer();
