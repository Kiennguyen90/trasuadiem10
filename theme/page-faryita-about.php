<?php
/**
 * Template Name: MilkTea-90 Giới Thiệu
 * Trang Giới Thiệu doanh nghiệp — CÔNG TY TNHH QUẢN LÝ ẨM THỰC DIEM10.
 *
 * @package MilkTea-90
 */
get_header();

$fy_slogan = 'Giữ vững tâm huyết về chất lượng, hỗ trợ hàng nghìn người khởi nghiệp cùng chia sẻ thành quả.';

$fy_highlights = array(
	array( 'icon' => '🏭', 'title' => 'Tự Chủ Sản Xuất', 'desc' => 'Nhà máy hiện đại, tự nghiên cứu phát triển nguyên liệu, tự sản xuất và tự tiêu thụ.' ),
	array( 'icon' => '🔗', 'title' => 'Chuỗi Cung Ứng Tích Hợp', 'desc' => 'Nghiên cứu phát triển, sản xuất, logistics và vận hành nhượng quyền trong một hệ thống.' ),
	array( 'icon' => '🏪', 'title' => 'Hơn 500 Cửa Hàng Đối Tác', 'desc' => 'Phục vụ hơn 500 cửa hàng đối tác trên toàn quốc sau hơn một thập kỷ phát triển.' ),
);
?>

<div class="fy-home">

	<section class="fy-page-hero">
		<div class="fy-container fy-reveal">
			<p class="fy-eyebrow">Về Chúng Tôi</p>
			<h1>Giới Thiệu</h1>
			<p><?php echo esc_html( $fy_slogan ); ?></p>
		</div>
	</section>

	<section class="fy-story-text">
		<div class="fy-container fy-row">
			<div class="fy-col fy-reveal">
				<h2>CÔNG TY TNHH QUẢN LÝ ẨM THỰC DIEM10</h2>
				<p class="fy-desc">DIEM10 có nguồn gốc từ Đài Loan, trụ sở chính đặt tại Thành phố Hồ Chí Minh, Việt Nam. Từ năm 2012, chúng tôi bắt đầu xây dựng chuỗi cung ứng trà sữa, trải qua hơn một thập kỷ phát triển, hiện đã hình thành hệ thống tích hợp bao gồm nghiên cứu phát triển, sản xuất, logistics, vận hành nhượng quyền, phục vụ hơn 500 cửa hàng đối tác trên toàn quốc.</p>
				<p class="fy-desc">Chúng tôi tự xây dựng nhà máy sản xuất hiện đại, thực hiện nghiên cứu phát triển nguyên liệu độc lập, tự sản xuất và tự tiêu thụ. Cắt bỏ các khâu trung gian, kiểm soát chặt chẽ chất lượng từ nguồn, tối ưu chi phí, tạo nền tảng vững chắc cho các cửa hàng đối tác.</p>
			</div>
			<div class="fy-col fy-visual fy-reveal fy-reveal-d2" aria-hidden="true">🧋</div>
		</div>
	</section>

	<section class="fy-values">
		<div class="fy-container">
			<h2 class="fy-reveal">Nền Tảng Của DIEM10</h2>
			<p class="fy-sub fy-reveal">Từ nhà máy đến ly trà sữa trên tay khách hàng, mọi khâu đều do DIEM10 tự vận hành.</p>
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
			<h2>Đồng hành cùng DIEM10 trên hành trình khởi nghiệp trà sữa</h2>
			<a class="fy-btn" href="<?php echo esc_url( home_url( '/lien-he/' ) ); ?>">Liên Hệ Tư Vấn</a>
		</div>
	</section>

</div>

<?php
get_footer();
