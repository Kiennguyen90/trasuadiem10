<?php
/**
 * Template Name: MilkTea-90 Our Story
 * Trang Câu Chuyện Của Chúng Tôi.
 *
 * Nội dung (chữ + ảnh + video) chỉnh ở màn hình sửa Trang → khối "Nội dung trang
 * Câu Chuyện". Block soạn thảo thêm trong editor hiện ở vùng nội dung tự do giữa
 * khối mở đầu và "Giá Trị Cốt Lõi".
 *
 * @package MilkTea-90
 */
get_header();

$fy_cta_url = fy_pc( 'cta', 'button_url' );
$fy_cta_url = $fy_cta_url ? $fy_cta_url : home_url( '/san-pham' );

$fy_values = array();
for ( $fy_n = 1; $fy_n <= 3; $fy_n++ ) {
	$fy_values[] = array(
		'icon'  => fy_pc( 'values', "card{$fy_n}_icon" ),
		'title' => fy_pc( 'values', "card{$fy_n}_title" ),
		'desc'  => fy_pc( 'values', "card{$fy_n}_desc" ),
	);
}

$fy_timeline = array();
for ( $fy_n = 1; $fy_n <= 4; $fy_n++ ) {
	$fy_timeline[] = array(
		'year'  => fy_pc( 'timeline', "item{$fy_n}_year" ),
		'title' => fy_pc( 'timeline', "item{$fy_n}_title" ),
		'desc'  => fy_pc( 'timeline', "item{$fy_n}_desc" ),
	);
}
?>

<div class="fy-home">

	<section class="fy-page-hero">
		<div class="fy-container fy-reveal">
			<p class="fy-eyebrow"><?php echo esc_html( fy_pc( 'hero', 'eyebrow' ) ); ?></p>
			<h1><?php echo esc_html( fy_pc( 'hero', 'title' ) ); ?></h1>
			<p><?php echo esc_html( fy_pc( 'hero', 'desc' ) ); ?></p>
		</div>
	</section>

	<section class="fy-story-text">
		<div class="fy-container fy-row">
			<div class="fy-col fy-reveal">
				<h2><?php echo esc_html( fy_pc( 'opening', 'heading' ) ); ?></h2>
				<p class="fy-desc"><?php echo esc_html( fy_pc( 'opening', 'para1' ) ); ?></p>
				<p class="fy-desc"><?php echo esc_html( fy_pc( 'opening', 'para2' ) ); ?></p>
				<a class="fy-btn" href="#fy-values"><?php echo esc_html( fy_pc( 'opening', 'button' ) ); ?></a>
			</div>
			<div class="fy-col fy-visual fy-reveal fy-reveal-d2<?php echo fy_pc_has_media( 'opening', 'media' ) ? ' fy-visual--media' : ''; ?>"<?php echo fy_pc_has_media( 'opening', 'media' ) ? '' : ' aria-hidden="true"'; ?>>
				<?php
				if ( fy_pc_has_media( 'opening', 'media' ) ) {
					echo fy_pc_media( 'opening', 'media', '', array( 'alt' => 'Câu chuyện Trà Sữa DIEM10', 'wrap_class' => 'fy-pc-media fy-visual-media' ) ); // phpcs:ignore WordPress.Security.EscapeOutput
				} else {
					echo '🍹';
				}
				?>
			</div>
		</div>
	</section>

	<?php
	while ( have_posts() ) :
		the_post();
		if ( '' !== trim( get_the_content() ) ) :
			?>
			<section class="fy-page-content">
				<div class="fy-container fy-reveal">
					<?php the_content(); ?>
				</div>
			</section>
			<?php
		endif;
	endwhile;
	rewind_posts();
	?>

	<section class="fy-values" id="fy-values">
		<div class="fy-container">
			<h2 class="fy-reveal"><?php echo esc_html( fy_pc( 'values', 'heading' ) ); ?></h2>
			<p class="fy-sub fy-reveal"><?php echo esc_html( fy_pc( 'values', 'sub' ) ); ?></p>
			<div class="fy-values-grid">
				<?php foreach ( $fy_values as $i => $v ) : ?>
					<div class="fy-value-card fy-reveal fy-reveal-d<?php echo esc_attr( ( $i % 5 ) + 1 ); ?>">
						<div class="fy-icon" aria-hidden="true"><?php echo esc_html( $v['icon'] ); ?></div>
						<h3><?php echo esc_html( $v['title'] ); ?></h3>
						<p><?php echo esc_html( $v['desc'] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="fy-timeline">
		<div class="fy-container">
			<h2 class="fy-reveal"><?php echo esc_html( fy_pc( 'timeline', 'heading' ) ); ?></h2>
			<div class="fy-timeline-list">
				<?php foreach ( $fy_timeline as $i => $t ) : ?>
					<div class="fy-timeline-item fy-reveal fy-reveal-d<?php echo esc_attr( ( $i % 5 ) + 1 ); ?>">
						<div class="fy-year"><?php echo esc_html( $t['year'] ); ?></div>
						<h4><?php echo esc_html( $t['title'] ); ?></h4>
						<p><?php echo esc_html( $t['desc'] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="fy-cta">
		<div class="fy-container fy-reveal">
			<h2><?php echo esc_html( fy_pc( 'cta', 'heading' ) ); ?></h2>
			<a class="fy-btn" href="<?php echo esc_url( $fy_cta_url ); ?>"><?php echo esc_html( fy_pc( 'cta', 'button' ) ); ?></a>
		</div>
	</section>

</div>

<?php
get_footer();
