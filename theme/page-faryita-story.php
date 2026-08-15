<?php
/**
 * Template Name: Faryita Our Story
 * Trang Câu Chuyện Của Chúng Tôi.
 *
 * @package Art Blog
 */
get_header();

$fy_values = array(
	array( 'icon' => '🌱', 'title' => 'Tươi Sạch',   'desc' => 'Trái cây được thu hoạch và ép trong ngày, không chất bảo quản.' ),
	array( 'icon' => '♻️', 'title' => 'Bền Vững',    'desc' => 'Hợp tác với nông trại hữu cơ địa phương, hạn chế rác thải nhựa.' ),
	array( 'icon' => '❤️', 'title' => 'Tận Tâm',     'desc' => 'Mỗi ly nước ép đều được pha chế bằng sự trân trọng dành cho khách hàng.' ),
);

$fy_timeline = array(
	array( 'year' => '2020', 'title' => 'Khởi Đầu Từ Một Quầy Nhỏ', 'desc' => 'Faryita bắt đầu từ một quầy nước ép nhỏ với mong muốn mang trái cây tươi đến gần hơn với mọi người.' ),
	array( 'year' => '2022', 'title' => 'Mở Rộng Nông Trại Đối Tác', 'desc' => 'Hợp tác cùng các nông trại hữu cơ để đảm bảo nguồn nguyên liệu ổn định, chất lượng quanh năm.' ),
	array( 'year' => '2024', 'title' => 'Đạt Chứng Nhận Hữu Cơ', 'desc' => 'Toàn bộ dòng sản phẩm chính thức đạt chứng nhận nguyên liệu hữu cơ 100%.' ),
	array( 'year' => '2026', 'title' => 'Faryita Hôm Nay', 'desc' => 'Tiếp tục hành trình mang đến những ly nước ép tươi ngon, tốt cho sức khỏe mỗi ngày.' ),
);
?>

<div class="fy-home">

	<section class="fy-page-hero">
		<div class="fy-container fy-reveal">
			<p class="fy-eyebrow">Về Faryita</p>
			<h1>Câu Chuyện Của Chúng Tôi</h1>
			<p>Từ tình yêu dành cho trái cây tươi đến thương hiệu nước ép hữu cơ được tin dùng mỗi ngày.</p>
		</div>
	</section>

	<section class="fy-story-text">
		<div class="fy-container fy-row">
			<div class="fy-col fy-reveal">
				<h2>Bắt Đầu Từ Một Ý Tưởng Đơn Giản</h2>
				<p class="fy-desc">Faryita ra đời từ mong muốn giản đơn: mang đến những ly nước ép trái cây tươi ngon, nguyên chất, không chất bảo quản cho mọi gia đình.</p>
				<p class="fy-desc">Chúng tôi tin rằng một ly nước ép ngon phải bắt đầu từ nguyên liệu tốt. Vì vậy, Faryita chọn hợp tác trực tiếp với các nông trại hữu cơ, thu hoạch và ép lạnh trong ngày để giữ trọn vitamin và hương vị tự nhiên.</p>
				<a class="fy-btn" href="#fy-values">Giá Trị Của Chúng Tôi</a>
			</div>
			<div class="fy-col fy-visual fy-reveal fy-reveal-d2" aria-hidden="true">🍹</div>
		</div>
	</section>

	<section class="fy-values" id="fy-values">
		<div class="fy-container">
			<h2 class="fy-reveal">Giá Trị Cốt Lõi</h2>
			<p class="fy-sub fy-reveal">Ba điều Faryita luôn giữ vững trong từng ly nước ép.</p>
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
			<h2 class="fy-reveal">Hành Trình Phát Triển</h2>
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
			<h2>Cùng Faryita thưởng thức vị ngọt từ thiên nhiên</h2>
			<a class="fy-btn" href="<?php echo esc_url( home_url( '/san-pham' ) ); ?>">Xem Sản Phẩm</a>
		</div>
	</section>

</div>

<?php
get_footer();
