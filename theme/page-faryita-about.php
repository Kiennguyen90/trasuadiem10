<?php
/**
 * Template Name: MilkTea-90 Giới Thiệu
 * Trang Giới Thiệu doanh nghiệp — CÔNG TY TNHH QUẢN LÝ ẨM THỰC DIEM10.
 *
 * Nội dung (chữ + ảnh + video) chỉnh ở màn hình sửa Trang → khối "Nội dung trang
 * Giới Thiệu". Ngoài ra mọi block soạn thảo (ảnh, đoạn văn...) thêm trong trình
 * soạn thảo sẽ hiện ở vùng "nội dung tự do" giữa phần giới thiệu công ty và CTA.
 *
 * @package MilkTea-90
 */
get_header();

$fy_cta_url = fy_pc( 'cta', 'button_url' );
$fy_cta_url = $fy_cta_url ? $fy_cta_url : home_url( '/lien-he/' );

$fy_highlights = array();
for ( $fy_n = 1; $fy_n <= 3; $fy_n++ ) {
	$fy_highlights[] = array(
		'icon'  => fy_pc( 'values', "card{$fy_n}_icon" ),
		'title' => fy_pc( 'values', "card{$fy_n}_title" ),
		'desc'  => fy_pc( 'values', "card{$fy_n}_desc" ),
	);
}
?>

<div class="fy-home">

	<section class="fy-page-hero">
		<div class="fy-container fy-reveal">
			<p class="fy-eyebrow"><?php echo esc_html( fy_pc( 'hero', 'eyebrow' ) ); ?></p>
			<h1><?php echo esc_html( fy_pc( 'hero', 'title' ) ); ?></h1>
			<p><?php echo esc_html( fy_pc( 'hero', 'slogan' ) ); ?></p>
		</div>
	</section>

	<section class="fy-story-text">
		<div class="fy-container fy-row">
			<div class="fy-col fy-reveal">
				<h2><?php echo esc_html( fy_pc( 'company', 'heading' ) ); ?></h2>
				<p class="fy-desc"><?php echo esc_html( fy_pc( 'company', 'para1' ) ); ?></p>
				<p class="fy-desc"><?php echo esc_html( fy_pc( 'company', 'para2' ) ); ?></p>
			</div>
			<div class="fy-col fy-visual fy-reveal fy-reveal-d2<?php echo fy_pc_has_media( 'company', 'media' ) ? ' fy-visual--media' : ''; ?>"<?php echo fy_pc_has_media( 'company', 'media' ) ? '' : ' aria-hidden="true"'; ?>>
				<?php
				if ( fy_pc_has_media( 'company', 'media' ) ) {
					echo fy_pc_media( 'company', 'media', '', array( 'alt' => 'CÔNG TY TNHH QUẢN LÝ ẨM THỰC DIEM10', 'wrap_class' => 'fy-pc-media fy-visual-media' ) ); // phpcs:ignore WordPress.Security.EscapeOutput
				} else {
					echo '🧋';
				}
				?>
			</div>
		</div>
	</section>

	<?php
	while ( have_posts() ) :
		the_post();
		$fy_editor = trim( get_the_content() );
		if ( '' !== $fy_editor ) :
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

	<section class="fy-values">
		<div class="fy-container">
			<h2 class="fy-reveal"><?php echo esc_html( fy_pc( 'values', 'heading' ) ); ?></h2>
			<p class="fy-sub fy-reveal"><?php echo esc_html( fy_pc( 'values', 'sub' ) ); ?></p>
			<div class="fy-values-grid">
				<?php foreach ( $fy_highlights as $i => $h ) : ?>
					<div class="fy-value-card fy-reveal fy-reveal-d<?php echo esc_attr( ( $i % 5 ) + 1 ); ?>">
						<div class="fy-icon" aria-hidden="true"><?php echo esc_html( $h['icon'] ); ?></div>
						<h3><?php echo esc_html( $h['title'] ); ?></h3>
						<p><?php echo esc_html( $h['desc'] ); ?></p>
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
