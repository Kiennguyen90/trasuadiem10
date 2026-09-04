<?php
/**
 * Bộ chỉnh sửa nội dung theo trang (MilkTea-90).
 *
 * Mỗi template tùy chỉnh (Trang chủ, Giới Thiệu, ...) khai báo một "schema" gồm nhiều
 * section, mỗi section có danh sách field: text / textarea / media (ảnh hoặc video).
 * Khi sửa Page dùng template đó, một metabox hiện ra cho phép client đổi chữ + ảnh + video
 * mà không cần đụng code. Template đọc giá trị qua fy_pc() / fy_pc_media(); trường nào trống
 * thì tự dùng nội dung mặc định (default) khai báo trong schema — không bao giờ vỡ layout.
 *
 * @package MilkTea-90
 */

defined( 'ABSPATH' ) || exit;

/**
 * ID trang đang hiển thị — dùng trong template kể cả khi không gọi the_post().
 */
function fy_pc_pid( $post_id = null ) {
	if ( $post_id ) {
		return (int) $post_id;
	}
	$id = get_the_ID();
	return $id ? (int) $id : (int) get_queried_object_id();
}

/* ============================================================================
 * 1. SCHEMA — khai báo các block chỉnh sửa cho từng template
 * ==========================================================================*/

/**
 * @return array<string,array> map: tên file template => cấu hình block.
 */
function fy_pc_schemas() {
	$img = get_template_directory_uri() . '/assets/images/brand/';

	$schemas = array(

		/* ---------------- TRANG CHỦ ---------------- */
		'page-faryita-home.php' => array(
			'title'    => 'Nội dung Trang chủ',
			'sections' => array(

				'banner' => array(
					'label'  => 'Banner (đầu trang)',
					'fields' => array(
						'slide1' => array( 'type' => 'media', 'label' => 'Slide 1 — ảnh hoặc video', 'default_url' => $img . 'shop-banner.jpg' ),
						'slide2' => array( 'type' => 'media', 'label' => 'Slide 2 — ảnh hoặc video', 'default_url' => $img . 'shop-counter.jpg' ),
					),
				),

				'intro' => array(
					'label'  => 'Khối "Không Gian Ấm Cúng"',
					'fields' => array(
						'heading1'  => array( 'type' => 'text', 'label' => 'Tiêu đề — dòng 1', 'default' => 'Không Gian Ấm Cúng' ),
						'heading2'  => array( 'type' => 'text', 'label' => 'Tiêu đề — dòng 2', 'default' => 'Hương Trà Nồng Nàn' ),
						'desc'      => array( 'type' => 'textarea', 'label' => 'Mô tả', 'default' => 'Từ quầy pha chế đến từng góc nhỏ, DIEM 10 chăm chút để mỗi lần ghé quán đều là một trải nghiệm thư giãn, trọn vị.' ),
						'stat1_num' => array( 'type' => 'text', 'label' => 'Chỉ số 1 — tiêu đề', 'default' => 'Trà Ngon' ),
						'stat1_sub' => array( 'type' => 'text', 'label' => 'Chỉ số 1 — mô tả', 'default' => 'Nguyên liệu chọn lọc' ),
						'stat2_num' => array( 'type' => 'text', 'label' => 'Chỉ số 2 — tiêu đề', 'default' => 'Giá Tốt' ),
						'stat2_sub' => array( 'type' => 'text', 'label' => 'Chỉ số 2 — mô tả', 'default' => 'Hợp túi tiền mỗi ngày' ),
						'stat3_num' => array( 'type' => 'text', 'label' => 'Chỉ số 3 — tiêu đề', 'default' => 'Uống Là Mê' ),
						'stat3_sub' => array( 'type' => 'text', 'label' => 'Chỉ số 3 — mô tả', 'default' => 'Vị trà khó quên' ),
						'button'    => array( 'type' => 'text', 'label' => 'Nhãn nút', 'default' => 'Xem Menu' ),
						'media'     => array( 'type' => 'media', 'label' => 'Ảnh / Video minh hoạ', 'default_url' => $img . 'shop-counter.jpg' ),
					),
				),

				'strip' => array(
					'label'  => 'Dải chữ chạy',
					'fields' => array(
						'word1' => array( 'type' => 'text', 'label' => 'Từ 1', 'default' => 'TRÀ THƠM ĐẬM VỊ' ),
						'word2' => array( 'type' => 'text', 'label' => 'Từ 2', 'default' => 'TOPPING ĐA DẠNG' ),
						'word3' => array( 'type' => 'text', 'label' => 'Từ 3', 'default' => 'TRÂN CHÂU DẺO DAI' ),
						'word4' => array( 'type' => 'text', 'label' => 'Từ 4', 'default' => 'PHỤC VỤ TẬN TÂM' ),
					),
				),

				'products' => array(
					'label'  => 'Mục "Trà Sữa Đáng Thử Nhất"',
					'fields' => array(
						'heading' => array( 'type' => 'text', 'label' => 'Tiêu đề', 'default' => 'Đồ Uống Đáng Thử Nhất' ),
						'tab1'    => array( 'type' => 'text', 'label' => 'Nhãn tab 1', 'default' => 'Yêu Thích' ),
						'tab2'    => array( 'type' => 'text', 'label' => 'Nhãn tab 2', 'default' => 'Bán Chạy' ),
						'tab3'    => array( 'type' => 'text', 'label' => 'Nhãn tab 3', 'default' => 'Hot Trend' ),
					),
				),

				'promo' => array(
					'label'  => 'Khối "Topping Đa Dạng"',
					'fields' => array(
						'slogan'       => array( 'type' => 'textarea', 'label' => 'Câu slogan (ô cam bên trái)', 'default' => 'Giữ vững tâm huyết về chất lượng, hỗ trợ hàng nghìn người khởi nghiệp cùng chia sẻ thành quả.' ),
						'heading'      => array( 'type' => 'text', 'label' => 'Tiêu đề (ô xanh bên phải)', 'default' => 'Topping Đa Dạng' ),
						'item1_emoji'  => array( 'type' => 'text', 'label' => 'Mục 1 — biểu tượng', 'default' => '⚪' ),
						'item1_name'   => array( 'type' => 'text', 'label' => 'Mục 1 — tên', 'default' => 'Thạch Dừa' ),
						'item1_desc'   => array( 'type' => 'text', 'label' => 'Mục 1 — mô tả', 'default' => 'Giòn sần sật, thơm nhẹ vị dừa tự nhiên.' ),
						'item2_emoji'  => array( 'type' => 'text', 'label' => 'Mục 2 — biểu tượng', 'default' => '🟤' ),
						'item2_name'   => array( 'type' => 'text', 'label' => 'Mục 2 — tên', 'default' => 'Trân Châu Hoàng Kim' ),
						'item2_desc'   => array( 'type' => 'text', 'label' => 'Mục 2 — mô tả', 'default' => 'Trân châu dẻo dai, ngọt dịu, sợi vàng óng đẹp mắt.' ),
						'item3_emoji'  => array( 'type' => 'text', 'label' => 'Mục 3 — biểu tượng', 'default' => '🌰' ),
						'item3_name'   => array( 'type' => 'text', 'label' => 'Mục 3 — tên', 'default' => 'Hạt Nổ Củ Năng Hồng' ),
						'item3_desc'   => array( 'type' => 'text', 'label' => 'Mục 3 — mô tả', 'default' => 'Củ năng bọc áo hồng, cắn nổ giòn tan, ngọt mát.' ),
						'item4_emoji'  => array( 'type' => 'text', 'label' => 'Mục 4 — biểu tượng', 'default' => '🥛' ),
						'item4_name'   => array( 'type' => 'text', 'label' => 'Mục 4 — tên', 'default' => 'Thủy Tinh Sữa Chua' ),
						'item4_desc'   => array( 'type' => 'text', 'label' => 'Mục 4 — mô tả', 'default' => 'Viên thủy tinh nhân sữa chua, chua ngọt béo nhẹ.' ),
					),
				),

				'store' => array(
					'label'  => 'Khối "Ghé Thăm Cửa Hàng Gần Bạn"',
					'fields' => array(
						'heading'    => array( 'type' => 'text', 'label' => 'Tiêu đề', 'default' => 'Ghé Thăm Cửa Hàng Gần Bạn' ),
						'desc'       => array( 'type' => 'textarea', 'label' => 'Mô tả', 'default' => 'Trà Sữa DIEM10 hiện có mặt tại nhiều tỉnh thành trên cả nước, sẵn sàng phục vụ bạn mỗi ngày với không gian ấm cúng và ly trà sữa đậm vị.' ),
						'button'     => array( 'type' => 'text', 'label' => 'Nhãn nút', 'default' => 'Xem Cửa Hàng →' ),
						'button_url' => array( 'type' => 'text', 'label' => 'Link nút (để trống = /cua-hang/)', 'default' => '' ),
						'media'      => array( 'type' => 'media', 'label' => 'Ảnh / Video minh hoạ', 'default_url' => $img . 'store-counter.jpg' ),
					),
				),

				'news' => array(
					'label'  => 'Mục "Bài Viết Mới" + Nhượng quyền',
					'fields' => array(
						'news_heading'      => array( 'type' => 'text', 'label' => 'Tiêu đề mục tin tức', 'default' => 'Bài Viết Mới' ),
						'news_button'       => array( 'type' => 'text', 'label' => 'Nhãn nút tin tức', 'default' => 'Xem Tất Cả Tin Tức →' ),
						'franchise_heading' => array( 'type' => 'textarea', 'label' => 'Tiêu đề khối nhượng quyền', 'default' => "Đăng Ký Tư Vấn Nhượng Quyền\nThương Hiệu" ),
					),
				),

				'testimonials' => array(
					'label'  => 'Mục "Khách Hàng Nói Gì Về Chúng Tôi"',
					'fields' => array(
						'heading'     => array( 'type' => 'text', 'label' => 'Tiêu đề', 'default' => 'Khách Hàng Nói Gì Về Chúng Tôi' ),
						'desc'        => array( 'type' => 'textarea', 'label' => 'Mô tả ngắn', 'default' => 'Cảm nhận thật từ những vị khách đã ghé thưởng thức tại Trà Sữa DIEM 10.' ),
						'item1_name'  => array( 'type' => 'text', 'label' => 'Khách 1 — tên', 'default' => 'Thùy Trang' ),
						'item1_role'  => array( 'type' => 'text', 'label' => 'Khách 1 — khu vực', 'default' => 'Khách hàng thân thiết — Q.5' ),
						'item1_quote' => array( 'type' => 'textarea', 'label' => 'Khách 1 — cảm nhận', 'default' => 'Trà đậm vị, trân châu dẻo vừa miệng, lại còn nhiều topping để đổi vị mỗi lần ghé. Mình ghé DIEM 10 gần như mỗi tuần!' ),
						'item2_name'  => array( 'type' => 'text', 'label' => 'Khách 2 — tên', 'default' => 'Quốc Huy' ),
						'item2_role'  => array( 'type' => 'text', 'label' => 'Khách 2 — khu vực', 'default' => 'Khách hàng — Bình Thạnh' ),
						'item2_quote' => array( 'type' => 'textarea', 'label' => 'Khách 2 — cảm nhận', 'default' => 'Nhân viên phục vụ nhanh, không gian quán sạch sẽ thoáng mát. Giá cả hợp lý mà chất lượng thì khỏi phải chê.' ),
						'item3_name'  => array( 'type' => 'text', 'label' => 'Khách 3 — tên', 'default' => 'Ngọc Hân' ),
						'item3_role'  => array( 'type' => 'text', 'label' => 'Khách 3 — khu vực', 'default' => 'Khách hàng — Tân Bình' ),
						'item3_quote' => array( 'type' => 'textarea', 'label' => 'Khách 3 — cảm nhận', 'default' => 'Mình đặc biệt thích vị trà sữa truyền thống ở đây, không quá ngọt và rất thơm. Sẽ tiếp tục ủng hộ DIEM 10 dài lâu.' ),
						'media'       => array( 'type' => 'media', 'label' => 'Ảnh khách hàng (cột bên phải)', 'default_url' => '' ),
					),
				),
			),
		),

		/* ---------------- GIỚI THIỆU ---------------- */
		'page-faryita-about.php' => array(
			'title'    => 'Nội dung trang Giới Thiệu',
			'sections' => array(

				'hero' => array(
					'label'  => 'Hero (đầu trang)',
					'fields' => array(
						'eyebrow' => array( 'type' => 'text', 'label' => 'Chữ nhỏ phía trên', 'default' => 'Về Chúng Tôi' ),
						'title'   => array( 'type' => 'text', 'label' => 'Tiêu đề lớn', 'default' => 'Giới Thiệu' ),
						'slogan'  => array( 'type' => 'textarea', 'label' => 'Slogan', 'default' => 'Giữ vững tâm huyết về chất lượng, hỗ trợ hàng nghìn người khởi nghiệp cùng chia sẻ thành quả.' ),
					),
				),

				'company' => array(
					'label'  => 'Khối giới thiệu công ty',
					'fields' => array(
						'heading' => array( 'type' => 'text', 'label' => 'Tiêu đề', 'default' => 'CÔNG TY TNHH QUẢN LÝ ẨM THỰC DIEM10' ),
						'para1'   => array( 'type' => 'textarea', 'label' => 'Đoạn 1', 'default' => 'DIEM10 có nguồn gốc từ Đài Loan, trụ sở chính đặt tại Thành phố Hồ Chí Minh, Việt Nam. Từ năm 2012, chúng tôi bắt đầu xây dựng chuỗi cung ứng trà sữa, trải qua hơn một thập kỷ phát triển, hiện đã hình thành hệ thống tích hợp bao gồm nghiên cứu phát triển, sản xuất, logistics, vận hành nhượng quyền, phục vụ hơn 500 cửa hàng đối tác trên toàn quốc.' ),
						'para2'   => array( 'type' => 'textarea', 'label' => 'Đoạn 2', 'default' => 'Chúng tôi tự xây dựng nhà máy sản xuất hiện đại, thực hiện nghiên cứu phát triển nguyên liệu độc lập, tự sản xuất và tự tiêu thụ. Cắt bỏ các khâu trung gian, kiểm soát chặt chẽ chất lượng từ nguồn, tối ưu chi phí, tạo nền tảng vững chắc cho các cửa hàng đối tác.' ),
						'media'   => array( 'type' => 'media', 'label' => 'Ảnh / Video (thay biểu tượng 🧋)', 'default_url' => '' ),
					),
				),

				'values' => array(
					'label'  => 'Khối "Nền Tảng Của DIEM10"',
					'fields' => array(
						'heading'     => array( 'type' => 'text', 'label' => 'Tiêu đề', 'default' => 'Nền Tảng Của DIEM10' ),
						'sub'         => array( 'type' => 'textarea', 'label' => 'Phụ đề', 'default' => 'Từ nhà máy đến ly trà sữa trên tay khách hàng, mọi khâu đều do DIEM10 tự vận hành.' ),
						'card1_icon'  => array( 'type' => 'text', 'label' => 'Ô 1 — biểu tượng', 'default' => '🏭' ),
						'card1_title' => array( 'type' => 'text', 'label' => 'Ô 1 — tiêu đề', 'default' => 'Tự Chủ Sản Xuất' ),
						'card1_desc'  => array( 'type' => 'textarea', 'label' => 'Ô 1 — mô tả', 'default' => 'Nhà máy hiện đại, tự nghiên cứu phát triển nguyên liệu, tự sản xuất và tự tiêu thụ.' ),
						'card2_icon'  => array( 'type' => 'text', 'label' => 'Ô 2 — biểu tượng', 'default' => '🔗' ),
						'card2_title' => array( 'type' => 'text', 'label' => 'Ô 2 — tiêu đề', 'default' => 'Chuỗi Cung Ứng Tích Hợp' ),
						'card2_desc'  => array( 'type' => 'textarea', 'label' => 'Ô 2 — mô tả', 'default' => 'Nghiên cứu phát triển, sản xuất, logistics và vận hành nhượng quyền trong một hệ thống.' ),
						'card3_icon'  => array( 'type' => 'text', 'label' => 'Ô 3 — biểu tượng', 'default' => '🏪' ),
						'card3_title' => array( 'type' => 'text', 'label' => 'Ô 3 — tiêu đề', 'default' => 'Hơn 500 Cửa Hàng Đối Tác' ),
						'card3_desc'  => array( 'type' => 'textarea', 'label' => 'Ô 3 — mô tả', 'default' => 'Phục vụ hơn 500 cửa hàng đối tác trên toàn quốc sau hơn một thập kỷ phát triển.' ),
					),
				),

				'philosophy' => array(
					'label'  => 'Khối "Triết Lý Kinh Doanh"',
					'fields' => array(
						'heading' => array( 'type' => 'text', 'label' => 'Tiêu đề', 'default' => 'Triết Lý Kinh Doanh' ),
						'para1'   => array( 'type' => 'textarea', 'label' => 'Đoạn 1', 'default' => 'Trà Sữa DIEM10 phát triển theo mô hình nhượng quyền, chú trọng tối ưu chi phí vận hành nhưng vẫn đảm bảo chất lượng và hương vị đặc trưng. Quy trình pha chế chuyên nghiệp, đồng nhất giúp tạo nên sự khác biệt và được khách hàng đón nhận trên khắp cả nước.' ),
						'para2'   => array( 'type' => 'textarea', 'label' => 'Đoạn 2', 'default' => 'DIEM10 không ngừng mở rộng hệ thống nhượng quyền, đồng hành cùng hàng nghìn đối tác trên hành trình khởi nghiệp, hướng đến mục tiêu đưa hương vị trà sữa chuẩn vị vươn xa hơn nữa.' ),
						'media'   => array( 'type' => 'media', 'label' => 'Ảnh / Video', 'default_url' => '' ),
					),
				),

				'timeline' => array(
					'label'  => 'Khối "Lịch Sử Hình Thành"',
					'fields' => array(
						'heading'     => array( 'type' => 'text', 'label' => 'Tiêu đề', 'default' => 'Lịch Sử Hình Thành' ),
						'item1_year'  => array( 'type' => 'text', 'label' => 'Mốc 1 — năm', 'default' => '2012' ),
						'item1_title' => array( 'type' => 'text', 'label' => 'Mốc 1 — tiêu đề', 'default' => 'Khởi Đầu Chuỗi Cung Ứng' ),
						'item1_desc'  => array( 'type' => 'textarea', 'label' => 'Mốc 1 — mô tả', 'default' => 'Bắt đầu xây dựng chuỗi cung ứng trà sữa với nguồn gốc từ Đài Loan.' ),
						'item2_year'  => array( 'type' => 'text', 'label' => 'Mốc 2 — năm', 'default' => 'Nhà Máy' ),
						'item2_title' => array( 'type' => 'text', 'label' => 'Mốc 2 — tiêu đề', 'default' => 'Tự Chủ Sản Xuất' ),
						'item2_desc'  => array( 'type' => 'textarea', 'label' => 'Mốc 2 — mô tả', 'default' => 'Xây dựng nhà máy hiện đại, tự nghiên cứu phát triển nguyên liệu độc lập.' ),
						'item3_year'  => array( 'type' => 'text', 'label' => 'Mốc 3 — năm', 'default' => 'Nhượng Quyền' ),
						'item3_title' => array( 'type' => 'text', 'label' => 'Mốc 3 — tiêu đề', 'default' => 'Mở Rộng Hệ Thống' ),
						'item3_desc'  => array( 'type' => 'textarea', 'label' => 'Mốc 3 — mô tả', 'default' => 'Vận hành mô hình nhượng quyền, đồng hành cùng các cửa hàng đối tác.' ),
						'item4_year'  => array( 'type' => 'text', 'label' => 'Mốc 4 — năm', 'default' => 'Hôm Nay' ),
						'item4_title' => array( 'type' => 'text', 'label' => 'Mốc 4 — tiêu đề', 'default' => 'Hơn 500 Cửa Hàng Đối Tác' ),
						'item4_desc'  => array( 'type' => 'textarea', 'label' => 'Mốc 4 — mô tả', 'default' => 'Hệ thống tích hợp nghiên cứu phát triển, sản xuất, logistics và vận hành nhượng quyền trên toàn quốc.' ),
					),
				),

				'cta' => array(
					'label'  => 'Khối kêu gọi (CTA) cuối trang',
					'fields' => array(
						'heading'    => array( 'type' => 'text', 'label' => 'Tiêu đề', 'default' => 'Đồng hành cùng DIEM10 trên hành trình khởi nghiệp trà sữa' ),
						'button'     => array( 'type' => 'text', 'label' => 'Nhãn nút', 'default' => 'Liên Hệ Tư Vấn' ),
						'button_url' => array( 'type' => 'text', 'label' => 'Link nút (để trống = /lien-he/)', 'default' => '' ),
					),
				),
			),
		),

		/* ---------------- CÂU CHUYỆN (OUR STORY) ---------------- */
		'page-faryita-story.php' => array(
			'title'    => 'Nội dung trang Câu Chuyện',
			'sections' => array(

				'hero' => array(
					'label'  => 'Hero (đầu trang)',
					'fields' => array(
						'eyebrow' => array( 'type' => 'text', 'label' => 'Chữ nhỏ phía trên', 'default' => 'Về DIEM10' ),
						'title'   => array( 'type' => 'text', 'label' => 'Tiêu đề lớn', 'default' => 'Câu Chuyện Của Chúng Tôi' ),
						'desc'    => array( 'type' => 'textarea', 'label' => 'Mô tả', 'default' => 'Từ một chuỗi cung ứng trà sữa khởi đầu tại Đài Loan đến hệ thống hơn 500 cửa hàng đối tác trên toàn quốc.' ),
					),
				),

				'opening' => array(
					'label'  => 'Khối mở đầu',
					'fields' => array(
						'heading' => array( 'type' => 'text', 'label' => 'Tiêu đề', 'default' => 'Bắt Đầu Từ Một Tâm Huyết Với Chất Lượng' ),
						'para1'   => array( 'type' => 'textarea', 'label' => 'Đoạn 1', 'default' => 'DIEM10 có nguồn gốc từ Đài Loan, trụ sở chính đặt tại Thành phố Hồ Chí Minh. Từ năm 2012, chúng tôi bắt đầu xây dựng chuỗi cung ứng trà sữa của riêng mình.' ),
						'para2'   => array( 'type' => 'textarea', 'label' => 'Đoạn 2', 'default' => 'Chúng tôi tự xây nhà máy, tự nghiên cứu phát triển nguyên liệu, tự sản xuất và tự tiêu thụ — cắt bỏ khâu trung gian, kiểm soát chất lượng từ nguồn để đồng hành cùng các cửa hàng đối tác.' ),
						'button'  => array( 'type' => 'text', 'label' => 'Nhãn nút', 'default' => 'Giá Trị Của Chúng Tôi' ),
						'media'   => array( 'type' => 'media', 'label' => 'Ảnh / Video (thay biểu tượng 🍹)', 'default_url' => '' ),
					),
				),

				'values' => array(
					'label'  => 'Khối "Giá Trị Cốt Lõi"',
					'fields' => array(
						'heading'      => array( 'type' => 'text', 'label' => 'Tiêu đề', 'default' => 'Giá Trị Cốt Lõi' ),
						'sub'          => array( 'type' => 'textarea', 'label' => 'Phụ đề', 'default' => 'Ba điều DIEM10 luôn giữ vững trong từng ly trà sữa.' ),
						'card1_icon'   => array( 'type' => 'text', 'label' => 'Ô 1 — biểu tượng', 'default' => '🌱' ),
						'card1_title'  => array( 'type' => 'text', 'label' => 'Ô 1 — tiêu đề', 'default' => 'Chất Lượng' ),
						'card1_desc'   => array( 'type' => 'textarea', 'label' => 'Ô 1 — mô tả', 'default' => 'Nguyên liệu do DIEM10 tự nghiên cứu và sản xuất, kiểm soát chặt chẽ từ nguồn.' ),
						'card2_icon'   => array( 'type' => 'text', 'label' => 'Ô 2 — biểu tượng', 'default' => '🤝' ),
						'card2_title'  => array( 'type' => 'text', 'label' => 'Ô 2 — tiêu đề', 'default' => 'Đồng Hành' ),
						'card2_desc'   => array( 'type' => 'textarea', 'label' => 'Ô 2 — mô tả', 'default' => 'Hỗ trợ hàng nghìn người khởi nghiệp cùng chia sẻ thành quả trên hành trình nhượng quyền.' ),
						'card3_icon'   => array( 'type' => 'text', 'label' => 'Ô 3 — biểu tượng', 'default' => '❤️' ),
						'card3_title'  => array( 'type' => 'text', 'label' => 'Ô 3 — tiêu đề', 'default' => 'Tận Tâm' ),
						'card3_desc'   => array( 'type' => 'textarea', 'label' => 'Ô 3 — mô tả', 'default' => 'Mỗi ly trà sữa được pha chế bằng sự trân trọng dành cho khách hàng.' ),
					),
				),

				'timeline' => array(
					'label'  => 'Khối "Hành Trình Phát Triển"',
					'fields' => array(
						'heading'     => array( 'type' => 'text', 'label' => 'Tiêu đề', 'default' => 'Hành Trình Phát Triển' ),
						'item1_year'  => array( 'type' => 'text', 'label' => 'Mốc 1 — năm', 'default' => '2012' ),
						'item1_title' => array( 'type' => 'text', 'label' => 'Mốc 1 — tiêu đề', 'default' => 'Khởi Đầu Chuỗi Cung Ứng' ),
						'item1_desc'  => array( 'type' => 'textarea', 'label' => 'Mốc 1 — mô tả', 'default' => 'Bắt đầu xây dựng chuỗi cung ứng trà sữa với nguồn gốc từ Đài Loan.' ),
						'item2_year'  => array( 'type' => 'text', 'label' => 'Mốc 2 — năm', 'default' => 'Nhà Máy' ),
						'item2_title' => array( 'type' => 'text', 'label' => 'Mốc 2 — tiêu đề', 'default' => 'Tự Chủ Sản Xuất' ),
						'item2_desc'  => array( 'type' => 'textarea', 'label' => 'Mốc 2 — mô tả', 'default' => 'Xây dựng nhà máy hiện đại, nghiên cứu phát triển nguyên liệu độc lập.' ),
						'item3_year'  => array( 'type' => 'text', 'label' => 'Mốc 3 — năm', 'default' => 'Nhượng Quyền' ),
						'item3_title' => array( 'type' => 'text', 'label' => 'Mốc 3 — tiêu đề', 'default' => 'Mở Rộng Hệ Thống' ),
						'item3_desc'  => array( 'type' => 'textarea', 'label' => 'Mốc 3 — mô tả', 'default' => 'Vận hành mô hình nhượng quyền, đồng hành cùng các cửa hàng đối tác.' ),
						'item4_year'  => array( 'type' => 'text', 'label' => 'Mốc 4 — năm', 'default' => 'Hôm Nay' ),
						'item4_title' => array( 'type' => 'text', 'label' => 'Mốc 4 — tiêu đề', 'default' => 'Hơn 500 Cửa Hàng Đối Tác' ),
						'item4_desc'  => array( 'type' => 'textarea', 'label' => 'Mốc 4 — mô tả', 'default' => 'Hệ thống tích hợp nghiên cứu phát triển, sản xuất, logistics và vận hành nhượng quyền trên toàn quốc.' ),
					),
				),

				'cta' => array(
					'label'  => 'Khối kêu gọi (CTA) cuối trang',
					'fields' => array(
						'heading'    => array( 'type' => 'text', 'label' => 'Tiêu đề', 'default' => 'Cùng DIEM10 thưởng thức ly trà sữa đậm vị' ),
						'button'     => array( 'type' => 'text', 'label' => 'Nhãn nút', 'default' => 'Xem Sản Phẩm' ),
						'button_url' => array( 'type' => 'text', 'label' => 'Link nút (để trống = /san-pham)', 'default' => '' ),
					),
				),
			),
		),

		/* ---------------- CỬA HÀNG ---------------- */
		'page-faryita-store.php' => array(
			'title'    => 'Nội dung trang Cửa Hàng',
			'sections' => array(

				'hero' => array(
					'label'  => 'Hero (đầu trang)',
					'fields' => array(
						'eyebrow' => array( 'type' => 'text', 'label' => 'Chữ nhỏ phía trên', 'default' => 'Trà Sữa DIEM10' ),
						'title'   => array( 'type' => 'text', 'label' => 'Tiêu đề lớn', 'default' => 'Cửa Hàng' ),
						'desc'    => array( 'type' => 'textarea', 'label' => 'Mô tả', 'default' => 'Trà Sữa Điểm 10 hiện có mặt tại nhiều tỉnh thành trên cả nước, tìm chi nhánh gần bạn nhất nhé.' ),
					),
				),

				'locator' => array(
					'label'  => 'Bộ tìm chi nhánh',
					'fields' => array(
						'search_placeholder' => array( 'type' => 'text', 'label' => 'Gợi ý ô tìm kiếm', 'default' => 'Nhập từ khoá tìm kiếm theo tên...' ),
						'all_provinces'      => array( 'type' => 'text', 'label' => 'Nhãn "toàn quốc"', 'default' => 'Toàn Quốc' ),
						'empty'              => array( 'type' => 'text', 'label' => 'Chưa có chi nhánh', 'default' => 'Chưa có chi nhánh nào được thêm.' ),
					),
				),
			),
		),

		/* ---------------- LIÊN HỆ ---------------- */
		'page-faryita-contact.php' => array(
			'title'    => 'Nội dung trang Liên Hệ',
			'sections' => array(

				'hero' => array(
					'label'  => 'Hero (đầu trang)',
					'fields' => array(
						'eyebrow' => array( 'type' => 'text', 'label' => 'Chữ nhỏ phía trên', 'default' => 'Trà Sữa DIEM10' ),
						'title'   => array( 'type' => 'text', 'label' => 'Tiêu đề lớn', 'default' => 'Liên Hệ' ),
						'desc'    => array( 'type' => 'textarea', 'label' => 'Mô tả', 'default' => 'Mọi ý kiến, góp ý hay câu hỏi của bạn đều rất quan trọng với chúng tôi.' ),
					),
				),

				'form' => array(
					'label'  => 'Khối biểu mẫu',
					'fields' => array(
						'heading'      => array( 'type' => 'text', 'label' => 'Tiêu đề', 'default' => 'Hỗ Trợ & Giải Đáp' ),
						'desc'         => array( 'type' => 'textarea', 'label' => 'Mô tả', 'default' => 'Để lại thông tin, đội ngũ Trà Sữa DIEM 10 sẽ liên hệ lại với bạn sớm nhất.' ),
						'submit_label' => array( 'type' => 'text', 'label' => 'Nhãn nút gửi', 'default' => 'Gửi Tin Nhắn' ),
					),
				),
			),
		),
	);

	/**
	 * Cho phép mở rộng schema ở nơi khác (Đợt 2: Câu Chuyện / Cửa Hàng / Liên Hệ).
	 */
	return apply_filters( 'fy_pc_schemas', $schemas );
}

/**
 * Lấy schema của template đang gán cho 1 trang (theo ID) — hoặc trang hiện tại.
 *
 * @param int|null $post_id
 * @return array|null
 */
function fy_pc_get_schema( $post_id = null ) {
	$post_id = fy_pc_pid( $post_id );
	if ( ! $post_id ) {
		return null;
	}
	$template = get_page_template_slug( $post_id );
	$schemas  = fy_pc_schemas();
	return isset( $schemas[ $template ] ) ? $schemas[ $template ] : null;
}

/* ============================================================================
 * 2. HELPER dùng trong template (front-end)
 * ==========================================================================*/

/**
 * Lấy giá trị text/textarea của 1 field, fallback về default trong schema.
 */
function fy_pc( $section, $field, $post_id = null ) {
	$post_id = fy_pc_pid( $post_id );
	$val     = get_post_meta( $post_id, "_fy_pc_{$section}_{$field}", true );
	if ( '' !== $val && null !== $val ) {
		return $val;
	}
	$schema = fy_pc_get_schema( $post_id );
	return isset( $schema['sections'][ $section ]['fields'][ $field ]['default'] )
		? $schema['sections'][ $section ]['fields'][ $field ]['default']
		: '';
}

/**
 * Giống fy_pc() nhưng đổi xuống dòng thành <br> (cho tiêu đề 2 dòng, slogan...).
 */
function fy_pc_nl2br( $section, $field, $post_id = null ) {
	return nl2br( esc_html( fy_pc( $section, $field, $post_id ) ) );
}

/**
 * Chuyển link YouTube/Vimeo sang URL nhúng (embed). Trả '' nếu không phải 2 nền tảng này
 * (khi đó coi như file video trực tiếp .mp4/.webm).
 */
function fy_pc_video_embed_url( $url ) {
	$url = trim( $url );
	if ( '' === $url ) {
		return '';
	}
	if ( preg_match( '~youtube\.com/watch\?v=([A-Za-z0-9_-]{6,})~', $url, $m )
		|| preg_match( '~youtu\.be/([A-Za-z0-9_-]{6,})~', $url, $m )
		|| preg_match( '~youtube\.com/shorts/([A-Za-z0-9_-]{6,})~', $url, $m )
		|| preg_match( '~youtube\.com/embed/([A-Za-z0-9_-]{6,})~', $url, $m ) ) {
		return 'https://www.youtube.com/embed/' . $m[1];
	}
	if ( preg_match( '~vimeo\.com/(?:video/)?(\d+)~', $url, $m ) ) {
		return 'https://player.vimeo.com/video/' . $m[1];
	}
	return '';
}

/**
 * Xuất HTML ảnh HOẶC video cho 1 field kiểu "media".
 * Ưu tiên: video (link) > ảnh (thư viện) > ảnh mặc định ($default_url) > rỗng.
 *
 * @param array $args alt, class, size, wrap_class
 */
function fy_pc_media( $section, $field, $default_url = '', $args = array() ) {
	$post_id = fy_pc_pid();
	$defaults = array( 'alt' => '', 'class' => '', 'size' => 'large', 'wrap_class' => 'fy-pc-media' );
	$args     = wp_parse_args( $args, $defaults );

	$video  = (string) get_post_meta( $post_id, "_fy_pc_{$section}_{$field}_video", true );
	$img_id = absint( get_post_meta( $post_id, "_fy_pc_{$section}_{$field}_img", true ) );

	if ( '' !== trim( $video ) ) {
		$embed = fy_pc_video_embed_url( $video );
		if ( $embed ) {
			return sprintf(
				'<div class="%s fy-pc-media-video fy-pc-media-embed"><iframe src="%s" title="%s" frameborder="0" loading="lazy" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>',
				esc_attr( $args['wrap_class'] ),
				esc_url( $embed ),
				esc_attr( $args['alt'] )
			);
		}
		// File video trực tiếp (.mp4...). Nếu field có kèm ảnh → dùng làm hình bìa (poster).
		$poster      = $img_id ? wp_get_attachment_image_url( $img_id, 'large' ) : '';
		$poster_attr = $poster ? ' poster="' . esc_url( $poster ) . '"' : '';
		return sprintf(
			'<div class="%s fy-pc-media-video"><video src="%s"%s controls playsinline preload="metadata"></video></div>',
			esc_attr( $args['wrap_class'] ),
			esc_url( $video ),
			$poster_attr
		);
	}

	if ( $img_id ) {
		$html = wp_get_attachment_image( $img_id, $args['size'], false, array(
			'class' => trim( 'fy-pc-media-img ' . $args['class'] ),
			'alt'   => $args['alt'],
		) );
		if ( $html ) {
			return $html;
		}
	}

	if ( $default_url ) {
		return sprintf(
			'<img class="%s" src="%s" alt="%s">',
			esc_attr( trim( 'fy-pc-media-img ' . $args['class'] ) ),
			esc_url( $default_url ),
			esc_attr( $args['alt'] )
		);
	}

	return '';
}

/**
 * Có phải field media này client đã đặt ảnh/video chưa? (để template quyết định
 * render media hay giữ biểu tượng emoji mặc định).
 */
function fy_pc_has_media( $section, $field, $post_id = null ) {
	$post_id = fy_pc_pid( $post_id );
	$video   = (string) get_post_meta( $post_id, "_fy_pc_{$section}_{$field}_video", true );
	$img_id  = absint( get_post_meta( $post_id, "_fy_pc_{$section}_{$field}_img", true ) );
	return ( '' !== trim( $video ) ) || $img_id > 0;
}

/* ============================================================================
 * 3. METABOX (admin)
 * ==========================================================================*/

function fy_pc_add_metabox( $post ) {
	// Chỉ thêm metabox của template đang gán cho trang này (không đổ 1 loạt box rỗng cho
	// mọi template). Sau khi client đổi mẫu + Cập nhật, box tương ứng sẽ xuất hiện.
	$template = get_page_template_slug( $post->ID );
	$schemas  = fy_pc_schemas();
	if ( ! isset( $schemas[ $template ] ) ) {
		return;
	}
	add_meta_box(
		'fy_pc_box',
		esc_html( $schemas[ $template ]['title'] ),
		'fy_pc_render_metabox',
		'page',
		'normal',
		'high',
		array( 'template' => $template )
	);
}
add_action( 'add_meta_boxes_page', 'fy_pc_add_metabox' );

function fy_pc_render_metabox( $post, $box ) {
	$template = isset( $box['args']['template'] ) ? $box['args']['template'] : get_page_template_slug( $post->ID );
	$schemas  = fy_pc_schemas();
	if ( empty( $schemas[ $template ]['sections'] ) ) {
		return;
	}

	wp_nonce_field( 'fy_pc_save', 'fy_pc_nonce' );
	fy_pc_print_metabox_style();

	foreach ( $schemas[ $template ]['sections'] as $sk => $section ) {
		echo '<details class="fy-pc-section" open><summary>' . esc_html( $section['label'] ) . '</summary>';
		echo '<div class="fy-pc-fields">';

		foreach ( $section['fields'] as $fk => $field ) {
			$type  = isset( $field['type'] ) ? $field['type'] : 'text';
			$label = isset( $field['label'] ) ? $field['label'] : $fk;

			echo '<div class="fy-pc-field fy-pc-field-' . esc_attr( $type ) . '">';
			echo '<label class="fy-pc-label">' . esc_html( $label ) . '</label>';

			if ( 'media' === $type ) {
				fy_pc_render_media_field( $post->ID, $sk, $fk, $field );
			} else {
				$value       = get_post_meta( $post->ID, "_fy_pc_{$sk}_{$fk}", true );
				$placeholder = isset( $field['default'] ) ? $field['default'] : '';
				$name        = "fy_pc[{$sk}][{$fk}]";

				if ( 'textarea' === $type ) {
					printf(
						'<textarea class="fy-pc-input widefat" name="%s" rows="3" placeholder="%s">%s</textarea>',
						esc_attr( $name ),
						esc_attr( $placeholder ),
						esc_textarea( $value )
					);
				} else {
					printf(
						'<input type="text" class="fy-pc-input widefat" name="%s" value="%s" placeholder="%s" />',
						esc_attr( $name ),
						esc_attr( $value ),
						esc_attr( $placeholder )
					);
				}
				if ( '' !== $placeholder ) {
					echo '<p class="fy-pc-hint">Để trống = dùng mặc định: “' . esc_html( wp_trim_words( $placeholder, 20 ) ) . '”</p>';
				}
			}

			echo '</div>';
		}

		echo '</div></details>';
	}
}

function fy_pc_render_media_field( $post_id, $sk, $fk, $field ) {
	$img_id   = absint( get_post_meta( $post_id, "_fy_pc_{$sk}_{$fk}_img", true ) );
	$video    = (string) get_post_meta( $post_id, "_fy_pc_{$sk}_{$fk}_video", true );
	$base     = "fy_pc[{$sk}][{$fk}]";
	$img_src  = $img_id ? wp_get_attachment_image_url( $img_id, 'medium' ) : '';
	$def_url  = isset( $field['default_url'] ) ? $field['default_url'] : '';

	echo '<div class="fy-pc-media" data-has="' . ( $img_id ? '1' : '0' ) . '">';

	echo '<div class="fy-pc-media-preview">';
	if ( $img_src ) {
		echo '<img src="' . esc_url( $img_src ) . '" alt="" />';
	} elseif ( $def_url ) {
		echo '<img src="' . esc_url( $def_url ) . '" alt="" class="fy-pc-media-default" /><span class="fy-pc-media-deftag">ảnh mặc định</span>';
	}
	echo '</div>';

	printf( '<input type="hidden" class="fy-pc-media-id" name="%s[img]" value="%s" />', esc_attr( $base ), esc_attr( $img_id ) );

	echo '<p class="fy-pc-media-buttons">';
	echo '<button type="button" class="button fy-pc-media-pick">Chọn ảnh</button> ';
	echo '<button type="button" class="button-link fy-pc-media-clear" ' . ( $img_id ? '' : 'style="display:none"' ) . '>Xoá ảnh</button>';
	echo '</p>';

	printf(
		'<input type="url" class="fy-pc-input widefat fy-pc-media-video" name="%s[video]" value="%s" placeholder="hoặc dán link video: YouTube / Vimeo / .mp4" />',
		esc_attr( $base ),
		esc_attr( $video )
	);
	echo '<p class="fy-pc-hint">Có link video → hiển thị video thay cho ảnh. Nếu chọn cả ảnh + video, ảnh sẽ là hình bìa (poster) hiện trước khi bấm play.</p>';

	echo '</div>';
}

function fy_pc_print_metabox_style() {
	static $done = false;
	if ( $done ) {
		return;
	}
	$done = true;
	?>
	<style>
		.fy-pc-section{border:1px solid #dcdcde;border-radius:6px;margin:0 0 10px;background:#fff}
		.fy-pc-section > summary{cursor:pointer;padding:10px 14px;font-weight:600;list-style:none;background:#f6f7f7;border-radius:6px}
		.fy-pc-section[open] > summary{border-bottom:1px solid #dcdcde;border-radius:6px 6px 0 0}
		.fy-pc-section > summary::-webkit-details-marker{display:none}
		.fy-pc-section > summary::before{content:"▸";margin-right:8px;color:#787c82}
		.fy-pc-section[open] > summary::before{content:"▾"}
		.fy-pc-fields{padding:14px;display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:14px 20px}
		.fy-pc-field-textarea,.fy-pc-field-media{grid-column:1/-1}
		.fy-pc-label{display:block;font-weight:600;margin:0 0 4px}
		.fy-pc-hint{color:#787c82;font-size:11px;margin:4px 0 0}
		.fy-pc-media-preview img{max-width:220px;max-height:150px;height:auto;border:1px solid #dcdcde;border-radius:4px;display:block;margin-bottom:6px}
		.fy-pc-media-preview img.fy-pc-media-default{opacity:.6}
		.fy-pc-media-deftag{font-size:11px;color:#787c82}
		.fy-pc-media-buttons{margin:6px 0}
		@media(max-width:782px){.fy-pc-fields{grid-template-columns:1fr}}
	</style>
	<?php
}

/* ============================================================================
 * 4. LƯU
 * ==========================================================================*/

function fy_pc_save( $post_id ) {
	if ( ! isset( $_POST['fy_pc_nonce'] ) || ! wp_verify_nonce( wp_unslash( $_POST['fy_pc_nonce'] ), 'fy_pc_save' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_page', $post_id ) ) {
		return;
	}

	$template = get_page_template_slug( $post_id );
	$schemas  = fy_pc_schemas();
	if ( empty( $schemas[ $template ]['sections'] ) ) {
		return;
	}

	$raw = isset( $_POST['fy_pc'] ) && is_array( $_POST['fy_pc'] ) ? wp_unslash( $_POST['fy_pc'] ) : array();

	foreach ( $schemas[ $template ]['sections'] as $sk => $section ) {
		foreach ( $section['fields'] as $fk => $field ) {
			$type = isset( $field['type'] ) ? $field['type'] : 'text';

			if ( 'media' === $type ) {
				$img   = isset( $raw[ $sk ][ $fk ]['img'] ) ? absint( $raw[ $sk ][ $fk ]['img'] ) : 0;
				$video = isset( $raw[ $sk ][ $fk ]['video'] ) ? esc_url_raw( trim( $raw[ $sk ][ $fk ]['video'] ) ) : '';
				fy_pc_update_meta( $post_id, "_fy_pc_{$sk}_{$fk}_img", $img ? (string) $img : '' );
				fy_pc_update_meta( $post_id, "_fy_pc_{$sk}_{$fk}_video", $video );
				continue;
			}

			$val = isset( $raw[ $sk ][ $fk ] ) ? $raw[ $sk ][ $fk ] : '';
			$val = ( 'textarea' === $type ) ? sanitize_textarea_field( $val ) : sanitize_text_field( $val );
			fy_pc_update_meta( $post_id, "_fy_pc_{$sk}_{$fk}", $val );
		}
	}
}
add_action( 'save_post_page', 'fy_pc_save' );

/**
 * Lưu meta, xoá hẳn khi rỗng để fy_pc() rơi về default.
 */
function fy_pc_update_meta( $post_id, $key, $value ) {
	if ( '' === $value || null === $value ) {
		delete_post_meta( $post_id, $key );
	} else {
		update_post_meta( $post_id, $key, $value );
	}
}

/* ============================================================================
 * 5. ASSET admin (media uploader + JS)
 * ==========================================================================*/

function fy_pc_admin_assets( $hook ) {
	if ( 'post.php' !== $hook && 'post-new.php' !== $hook ) {
		return;
	}
	$screen = get_current_screen();
	if ( ! $screen || 'page' !== $screen->post_type ) {
		return;
	}
	wp_enqueue_media();
	wp_enqueue_script(
		'fy-pc-admin',
		get_template_directory_uri() . '/assets/js/admin-page-content.js',
		array( 'jquery' ),
		filemtime( get_template_directory() . '/assets/js/admin-page-content.js' ),
		true
	);
}
add_action( 'admin_enqueue_scripts', 'fy_pc_admin_assets' );
