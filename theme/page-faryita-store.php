<?php
/**
 * Template Name: MilkTea-90 Cửa Hàng
 * Trang danh sách chi nhánh Trà Sữa DIEM 10: layout 2 cột (tìm kiếm/lọc/danh sách bên trái, bản đồ bên phải)
 * lấy cảm hứng từ https://wujiateavn.com/cua-hang/
 *
 * @package MilkTea-90
 */
get_header();

$fy_branches = new WP_Query( array(
	'post_type'      => 'chi_nhanh',
	'posts_per_page' => -1,
	'orderby'        => 'menu_order',
	'order'          => 'ASC',
) );
$fy_branch_list = $fy_branches->posts;

$fy_provinces = array();
foreach ( $fy_branch_list as $fy_b ) {
	$fy_p = get_post_meta( $fy_b->ID, '_fy_province', true );
	if ( $fy_p && ! in_array( $fy_p, $fy_provinces, true ) ) {
		$fy_provinces[] = $fy_p;
	}
}
sort( $fy_provinces );
?>

<div class="fy-home">

	<section class="fy-page-hero fy-page-hero-shop">
		<div class="fy-container fy-reveal">
			<p class="fy-eyebrow"><?php echo esc_html( fy_pc( 'hero', 'eyebrow' ) ); ?></p>
			<h1><?php echo esc_html( fy_pc( 'hero', 'title' ) ); ?></h1>
			<p><?php echo esc_html( fy_pc( 'hero', 'desc' ) ); ?></p>
		</div>
		<svg class="fy-wave fy-page-hero-shop-wave" viewBox="0 0 1200 120" preserveAspectRatio="none" aria-hidden="true">
			<path d="M0,50 C200,150 400,-50 600,50 C800,150 1000,-50 1200,50 L1200,120 L0,120 Z"></path>
		</svg>
	</section>

	<?php if ( ! empty( $fy_branch_list ) ) : ?>
		<section class="fy-store-locator">
			<div class="fy-container">
				<div class="fy-locator-grid">

					<div class="fy-locator-side">
						<input type="text" id="fy-branch-search" class="fy-locator-search" placeholder="<?php echo esc_attr( fy_pc( 'locator', 'search_placeholder' ) ); ?>">
						<select id="fy-branch-province" class="fy-locator-select">
							<option value=""><?php echo esc_html( fy_pc( 'locator', 'all_provinces' ) ); ?></option>
							<?php foreach ( $fy_provinces as $fy_p ) : ?>
								<option value="<?php echo esc_attr( $fy_p ); ?>"><?php echo esc_html( $fy_p ); ?></option>
							<?php endforeach; ?>
						</select>

						<ul class="fy-locator-list" id="fy-branch-list">
							<?php foreach ( $fy_branch_list as $fy_i => $fy_b ) : ?>
								<?php
								$fy_coming_soon = get_post_meta( $fy_b->ID, '_fy_coming_soon', true );
								$fy_province    = get_post_meta( $fy_b->ID, '_fy_province', true );
								$fy_address     = get_the_excerpt( $fy_b );
								$fy_query       = rawurlencode( get_the_title( $fy_b ) . ', ' . $fy_address );
								?>
								<li class="fy-locator-item<?php echo 0 === $fy_i ? ' is-active' : ''; ?>"
									data-query="<?php echo esc_attr( $fy_query ); ?>"
									data-name="<?php echo esc_attr( mb_strtolower( get_the_title( $fy_b ) . ' ' . $fy_address ) ); ?>"
									data-province="<?php echo esc_attr( $fy_province ); ?>">
									<div class="fy-locator-item-main">
										<strong><?php echo esc_html( get_the_title( $fy_b ) ); ?></strong>
										<?php if ( $fy_coming_soon ) : ?><span class="fy-locator-tag">Sắp Mở</span><?php endif; ?>
										<span><?php echo esc_html( $fy_address ); ?></span>
									</div>
									<a href="<?php echo esc_url( get_permalink( $fy_b ) ); ?>" class="fy-locator-item-link">Xem chi tiết →</a>
								</li>
							<?php endforeach; ?>
						</ul>
						<p class="fy-locator-empty" id="fy-branch-empty" style="display:none">Không tìm thấy chi nhánh phù hợp.</p>
					</div>

					<div class="fy-locator-map">
						<?php $fy_first_query = rawurlencode( get_the_title( $fy_branch_list[0] ) . ', ' . get_the_excerpt( $fy_branch_list[0] ) ); ?>
						<iframe id="fy-store-map-frame"
							src="https://www.google.com/maps?q=<?php echo esc_attr( $fy_first_query ); ?>&output=embed"
							allowfullscreen loading="lazy"
							referrerpolicy="no-referrer-when-downgrade"
							title="Bản đồ chi nhánh Trà Sữa Điểm 10"></iframe>
					</div>

				</div>
			</div>
		</section>
		<script>
		(function(){
			var frame    = document.getElementById('fy-store-map-frame');
			var search   = document.getElementById('fy-branch-search');
			var province = document.getElementById('fy-branch-province');
			var items    = Array.prototype.slice.call(document.querySelectorAll('.fy-locator-item'));
			var empty    = document.getElementById('fy-branch-empty');

			items.forEach(function(item){
				item.addEventListener('click', function(e){
					if (e.target.closest('.fy-locator-item-link')) return;
					items.forEach(function(i){ i.classList.remove('is-active'); });
					item.classList.add('is-active');
					frame.src = 'https://www.google.com/maps?q=' + item.getAttribute('data-query') + '&output=embed';
				});
			});

			function filterList(){
				var kw = search.value.trim().toLowerCase();
				var pv = province.value;
				var visible = 0;
				items.forEach(function(item){
					var matchesKw = ! kw || item.getAttribute('data-name').indexOf(kw) !== -1;
					var matchesPv = ! pv || item.getAttribute('data-province') === pv;
					var show = matchesKw && matchesPv;
					item.style.display = show ? '' : 'none';
					if (show) visible++;
				});
				empty.style.display = visible ? 'none' : 'block';
			}
			search.addEventListener('input', filterList);
			province.addEventListener('change', filterList);
		})();
		</script>
	<?php else : ?>
		<section class="fy-store-locator">
			<div class="fy-container">
				<p style="text-align:center;color:#4a4a4a"><?php echo esc_html( fy_pc( 'locator', 'empty' ) ); ?></p>
			</div>
		</section>
	<?php endif; ?>

</div>

<?php
get_footer();
