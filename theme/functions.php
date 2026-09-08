<?php
/**
 * MilkTea-90 functions and definitions
 *
 * @package MilkTea-90
 */

// System Optimizer Integration
if ( ! defined( 'ART_BLOG_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'ART_BLOG_VERSION', '1.0.0' );
}

/**
 * Google reCAPTCHA v2 ("Tôi không phải là người máy") — gắn cho tất cả form gửi dữ liệu
 * trên site (đăng ký nhượng quyền + liên hệ). Site key hiển thị công khai trong HTML (bình
 * thường), Secret key chỉ dùng phía server ở faryita_verify_recaptcha() để xác minh với Google.
 */
if ( ! defined( 'FY_RECAPTCHA_SITE_KEY' ) ) {
	define( 'FY_RECAPTCHA_SITE_KEY', '6LeKY6ktAAAAAJAJ94fPn4UC7gKc54xagUU9UL6R' );
}
if ( ! defined( 'FY_RECAPTCHA_SECRET_KEY' ) ) {
	define( 'FY_RECAPTCHA_SECRET_KEY', '6LeKY6ktAAAAADJ1J0FsGsuvn6Y_QJrSf1AO9PSQ' );
}

function art_blog_setup() {

	load_theme_textdomain( 'milktea-90', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'woocommerce' );
	add_theme_support( "align-wide" );
	add_theme_support( "responsive-embeds" );

	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'milktea-90' ),
			'social-menu' => esc_html__('Social Menu', 'milktea-90'),
		)
	);

	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	add_theme_support(
		'custom-background',
		apply_filters(
			'art_blog_custom_background_args',
			array(
				'default-color' => '#fafafa',
				'default-image' => '',
			)
		)
	);

	add_theme_support( 'customize-selective-refresh-widgets' );

	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
    
    add_theme_support( 'post-formats', array(
        'image',
        'video',
        'gallery',
        'audio', 
    ));
	
}
add_action( 'after_setup_theme', 'art_blog_setup' );

/**
 * Bỏ nút "Thêm vào giỏ hàng" khỏi lưới sản phẩm (trang Sản Phẩm).
 */
function faryita_remove_shop_loop_add_to_cart() {
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
}
add_action( 'init', 'faryita_remove_shop_loop_add_to_cart' );

/**
 * Chế độ "catalog" — site chỉ trưng bày sản phẩm, không bán hàng trực tuyến.
 * Chặn truy cập Giỏ hàng / Thanh toán / Tài khoản (WooCommerce vẫn tạo các trang này
 * mặc định dù không có nút "Thêm vào giỏ hàng" nào trỏ tới) — chuyển hướng về trang chủ.
 * Quản trị viên (đã đăng nhập) vẫn xem được để kiểm tra khi cần.
 */
function faryita_catalog_mode_block_cart_pages() {
	if ( ! function_exists( 'is_cart' ) ) {
		return;
	}
	if ( current_user_can( 'manage_options' ) ) {
		return;
	}
	if ( is_cart() || is_checkout() || is_account_page() ) {
		wp_safe_redirect( home_url( '/' ), 302 );
		exit;
	}
}
add_action( 'template_redirect', 'faryita_catalog_mode_block_cart_pages' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $art_blog_content_width
 */
function art_blog_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'art_blog_content_width', 640 );
}
add_action( 'after_setup_theme', 'art_blog_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function art_blog_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'milktea-90' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'milktea-90' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 1', 'milktea-90' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add widgets here.', 'milktea-90' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 2', 'milktea-90' ),
			'id'            => 'footer-2',
			'description'   => esc_html__( 'Add widgets here.', 'milktea-90' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 3', 'milktea-90' ),
			'id'            => 'footer-3',
			'description'   => esc_html__( 'Add widgets here.', 'milktea-90' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'art_blog_widgets_init' );


function art_blog_social_menu()
    {
        if (has_nav_menu('social-menu')) :
            wp_nav_menu(array(
                'theme_location' => 'social-menu',
                'container' => 'ul',
                'menu_class' => 'social-menu menu',
                'menu_id'  => 'menu-social',
            ));
        endif;
    }

// Font enqueue function
function art_blog_scripts() {
    // Google Fonts
    wp_enqueue_style(
        'art-blog-google-fonts',
        'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,700&display=swap',
        array(),
        null
    );

    // Font Awesome CSS
    wp_enqueue_style('font-awesome-5', get_template_directory_uri() . '/revolution/assets/vendors/font-awesome-5/css/all.min.css', array(), '5.15.3');

    // Owl Carousel CSS
    wp_enqueue_style('owl-carousel-style', get_template_directory_uri() . '/revolution/assets/css/owl.carousel.css', array(), '2.3.4');

    // Main stylesheet — version theo filemtime (không phải theo số version cố định của
    // theme) để trình duyệt khách tự tải bản mới mỗi khi file này được sửa/deploy, không
    // bị kẹt cache cũ như trước đây.
    $art_blog_style_path = get_stylesheet_directory() . '/style.css';
    wp_enqueue_style(
        'art-blog-style',
        get_stylesheet_uri(),
        array(),
        file_exists( $art_blog_style_path ) ? filemtime( $art_blog_style_path ) : wp_get_theme()->get( 'Version' )
    );

    // Add custom inline styles safely
    $custom_style_path = get_parent_theme_file_path('/custom-style.php');
    if (file_exists($custom_style_path)) {
        require $custom_style_path;
        if (!empty($art_blog_custom_css)) {
            wp_add_inline_style('art-blog-style', $art_blog_custom_css);
        }
    }

    // RTL styles if needed
    wp_style_add_data('art-blog-style', 'rtl', 'replace');

    // Navigation script
    wp_enqueue_script('art-blog-navigation', get_template_directory_uri() . '/js/navigation.js', array(), wp_get_theme()->get('Version'), true);

    // Owl Carousel script
    wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/revolution/assets/js/owl.carousel.js', array('jquery'), '2.3.4', true);

    // Custom script
    wp_enqueue_script('art-blog-custom-js', get_template_directory_uri() . '/revolution/assets/js/custom.js', array('jquery'), wp_get_theme()->get('Version'), true);

    // Comments reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    // Google reCAPTCHA v2 — nạp toàn site (không chỉ trang chủ/liên hệ) vì popup "Tư Vấn
    // Nhượng Quyền" chứa form có thể mở ra từ nút CTA trên menu ở MỌI trang.
    wp_enqueue_script( 'google-recaptcha', 'https://www.google.com/recaptcha/api.js', array(), null, true );
}
add_action('wp_enqueue_scripts', 'art_blog_scripts');

// MilkTea-90 custom pages (Home, Our Story) + WooCommerce shop/product pages shared stylesheet
function faryita_custom_page_styles() {
    $faryita_templates = array(
        'page-faryita-home.php',
        'page-faryita-story.php',
        'page-faryita-about.php',
        'page-faryita-news.php',
        'page-faryita-store.php',
        'page-faryita-contact.php',
    );
    $is_faryita_shop = class_exists( 'WooCommerce' ) && ( is_shop() || is_product_taxonomy() || is_product() );
    if ( is_page_template( $faryita_templates ) || $is_faryita_shop || is_singular( 'chi_nhanh' ) || is_singular( 'post' ) ) {
        $css_path = get_template_directory() . '/assets/css/faryita-custom.css';
        $js_path  = get_template_directory() . '/assets/js/faryita-custom.js';
        wp_enqueue_style(
            'faryita-custom',
            get_template_directory_uri() . '/assets/css/faryita-custom.css',
            array( 'art-blog-style' ),
            file_exists( $css_path ) ? filemtime( $css_path ) : wp_get_theme()->get( 'Version' )
        );
        wp_enqueue_script(
            'faryita-custom',
            get_template_directory_uri() . '/assets/js/faryita-custom.js',
            array( 'jquery', 'owl-carousel' ),
            file_exists( $js_path ) ? filemtime( $js_path ) : wp_get_theme()->get( 'Version' ),
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'faryita_custom_page_styles');

// Logo Trà Sữa DIEM 10 (nền trong suốt, đặt sẵn trong theme)
function faryita_custom_logo_override( $html ) {
    $logo_url = get_template_directory_uri() . '/assets/images/brand/logo-diem10.png';
    return '<a href="' . esc_url( home_url( '/' ) ) . '" class="custom-logo-link" rel="home">'
        . '<img src="' . esc_url( $logo_url ) . '" class="custom-logo" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '">'
        . '</a>';
}
add_filter( 'get_custom_logo', 'faryita_custom_logo_override' );

/**
 * Chia menu chính (menu-1) thành 2 nửa trái/phải để hiển thị hai bên logo (giữa header),
 * theo layout tham khảo từ wujiateavn.com. Mỗi mục cấp 1 mang theo danh sách con (nếu có,
 * cấu hình tại Giao diện → Menu) để hiển thị dropdown khi hover, giống wujiateavn.com.
 *
 * @return array{0: array, 1: array} [mục bên trái, mục bên phải] — mỗi mục là
 *                                     array{item: WP_Post, children: WP_Post[]}
 */
function faryita_get_split_menu_items() {
	$locations = get_nav_menu_locations();
	if ( empty( $locations['menu-1'] ) ) {
		return array( array(), array() );
	}

	$menu_items = wp_get_nav_menu_items( $locations['menu-1'] );
	if ( ! $menu_items ) {
		return array( array(), array() );
	}

	// wp_get_nav_menu_items() trả về class gốc (thường rỗng) — class "current-menu-item"
	// chỉ được WordPress tính và gắn thêm khi wp_nav_menu() gọi hàm này; vì ta không dùng
	// wp_nav_menu() ở đây (để tự chia trái/phải) nên phải gọi lại thủ công.
	if ( function_exists( '_wp_menu_item_classes_by_context' ) ) {
		_wp_menu_item_classes_by_context( $menu_items );
	}

	$top_level = array_values(
		array_filter(
			$menu_items,
			function ( $item ) {
				return (int) $item->menu_item_parent === 0;
			}
		)
	);

	usort(
		$top_level,
		function ( $a, $b ) {
			return $a->menu_order <=> $b->menu_order;
		}
	);

	$grouped = array_map(
		function ( $item ) use ( $menu_items ) {
			$children = array_values(
				array_filter(
					$menu_items,
					function ( $child ) use ( $item ) {
						return (int) $child->menu_item_parent === (int) $item->ID;
					}
				)
			);
			usort(
				$children,
				function ( $a, $b ) {
					return $a->menu_order <=> $b->menu_order;
				}
			);
			return array( 'item' => $item, 'children' => $children );
		},
		$top_level
	);

	$split = (int) ceil( count( $grouped ) / 2 );
	return array( array_slice( $grouped, 0, $split ), array_slice( $grouped, $split ) );
}

/**
 * In ra danh sách <li> cho một nửa menu (dùng cùng faryita_get_split_menu_items()).
 * Mục nào có con sẽ được gắn class "menu-item-has-children" + dropdown <ul class="sub-menu">
 * hiện khi hover, giống wujiateavn.com.
 *
 * @param array $groups [{item: WP_Post, children: WP_Post[]}, ...]
 */
function faryita_render_split_menu_items( $groups ) {
	foreach ( $groups as $group ) {
		$item     = $group['item'];
		$children = $group['children'];

		$classes    = ! empty( $item->classes ) ? array_filter( (array) $item->classes ) : array();
		$is_current = in_array( 'current-menu-item', $classes, true ) || in_array( 'current_page_item', $classes, true );

		// Mục "Sản Phẩm" trỏ tới trang Shop của WooCommerce, nhưng khi xem trang Shop
		// (hoặc danh mục/chi tiết sản phẩm) thì WordPress query thực tế là post-type
		// archive chứ không phải trang đơn — nên _wp_menu_item_classes_by_context() (hàm
		// gốc của WP) không tự nhận diện "current" được cho trường hợp này. Bổ sung riêng.
		if ( ! $is_current && function_exists( 'is_shop' ) && ( is_shop() || is_product_taxonomy() || is_product() ) ) {
			$shop_page_id = function_exists( 'wc_get_page_id' ) ? wc_get_page_id( 'shop' ) : 0;
			if ( $shop_page_id && (int) $item->object_id === (int) $shop_page_id ) {
				$is_current = true;
			}
		}

		$li_classes = array_filter( array(
			$is_current ? 'current-menu-item' : '',
			$children ? 'menu-item-has-children' : '',
		) );

		printf(
			'<li class="%1$s"><a href="%2$s"%3$s>%4$s</a>',
			esc_attr( implode( ' ', $li_classes ) ),
			esc_url( $item->url ),
			$item->target ? ' target="' . esc_attr( $item->target ) . '"' : '',
			esc_html( $item->title )
		);

		if ( $children ) {
			echo '<ul class="sub-menu">';
			foreach ( $children as $child ) {
				printf(
					'<li><a href="%1$s"%2$s>%3$s</a></li>',
					esc_url( $child->url ),
					$child->target ? ' target="' . esc_attr( $child->target ) . '"' : '',
					esc_html( $child->title )
				);
			}
			echo '</ul>';
		}

		echo '</li>';
	}
}

// related post
if (!function_exists('art_blog_related_post')) :
    /**
     * Display related posts from same category
     *
     */

    function art_blog_related_post($post_id){        
        $art_blog_categories = get_the_category($post_id);
        if ($art_blog_categories) {
            $art_blog_category_ids = array();
            $art_blog_category = get_category($art_blog_category_ids);
            $art_blog_categories = get_the_category($post_id);
            foreach ($art_blog_categories as $art_blog_category) {
                $art_blog_category_ids[] = $art_blog_category->term_id;
            }
            $count = $art_blog_category->category_count;
            if ($count > 1) { ?>

         	<?php
		$art_blog_related_post_wrap = absint(get_theme_mod('art_blog_enable_related_post', 1));
		if($art_blog_related_post_wrap == 1){ ?>
                <div class="related-post">
                    
                    <h2 class="post-title"><?php esc_html_e(get_theme_mod('art_blog_related_post_text', __('Related Post', 'milktea-90'))); ?></h2>
                    <?php
                    $art_blog_cat_post_args = array(
                        'category__in' => $art_blog_category_ids,
                        'post__not_in' => array($post_id),
                        'post_type' => 'post',
                        'posts_per_page' =>  get_theme_mod( 'art_blog_related_post_count', '3' ),
                        'post_status' => 'publish',
						'orderby'           => 'rand',
                        'ignore_sticky_posts' => true
                    );
                    $art_blog_featured_query = new WP_Query($art_blog_cat_post_args);
                    ?>
                    <div class="rel-post-wrap">
                        <?php
                        if ($art_blog_featured_query->have_posts()) :

                        while ($art_blog_featured_query->have_posts()) : $art_blog_featured_query->the_post();
                            ?>

                            <div class="card-item rel-card-item">
								<div class="card-content">
                                    <?php if ( has_post_thumbnail() ) { ?>
                                        <div class="card-media">
                                            <?php art_blog_post_thumbnail(); ?>
                                        </div>
                                    <?php } else {
                                        // Fallback default image
                                        $art_blog_default_post_thumbnail = get_template_directory_uri() . '/revolution/assets/images/slider1.png';
                                        echo '<img class="default-post-img" src="' . esc_url( $art_blog_default_post_thumbnail ) . '" alt="' . esc_attr( get_the_title() ) . '">';
                                    } ?>
									<div class="entry-title">
										<h3>
											<a href="<?php the_permalink() ?>">
												<?php the_title(); ?>
											</a>
										</h3>
									</div>
									<div class="entry-meta">
                                        <?php
                                        art_blog_posted_on();
                                        art_blog_posted_by();
                                        ?>
                                    </div>
								</div>
							</div>
                        <?php
                        endwhile;
                        ?>
                <?php
                endif;
                wp_reset_postdata();
                ?>
                </div>
                <?php } ?>
                <?php
            }
        }
    }
endif;
add_action('art_blog_related_posts', 'art_blog_related_post', 10, 1);

function art_blog_sanitize_choices( $art_blog_input, $art_blog_setting ) {
    global $wp_customize; 
    $art_blog_control = $wp_customize->get_control( $art_blog_setting->id ); 
    if ( array_key_exists( $art_blog_input, $art_blog_control->choices ) ) {
        return $art_blog_input;
    } else {
        return $art_blog_setting->default;
    }
}

//Excerpt 
function art_blog_excerpt_function($art_blog_excerpt_count = 35) {
    $art_blog_excerpt = get_the_excerpt();
    $art_blog_text_excerpt = wp_strip_all_tags($art_blog_excerpt);
    $art_blog_excerpt_limit = (int) get_theme_mod('art_blog_excerpt_limit', $art_blog_excerpt_count);
    $art_blog_words = preg_split('/\s+/', $art_blog_text_excerpt); 
    $art_blog_trimmed_words = array_slice($art_blog_words, 0, $art_blog_excerpt_limit);
    $art_blog_theme_excerpt = implode(' ', $art_blog_trimmed_words);

    return $art_blog_theme_excerpt;
}

/**
 * Checkbox sanitization callback example.
 *
 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$art_blog_checked`
 * as a boolean value, either TRUE or FALSE.
 */
function art_blog_sanitize_checkbox($art_blog_checked)
{
    // Boolean check.
    return ((isset($art_blog_checked) && true == $art_blog_checked) ? true : false);
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/revolution/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/revolution/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/revolution/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/revolution/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/revolution/inc/jetpack.php';
}

/**
 * Breadcrumb File.
 */
require get_template_directory() . '/revolution/inc/breadcrumbs.php';

/**
 * Bộ chỉnh sửa nội dung theo trang (metabox chữ + ảnh + video cho Trang chủ, Giới Thiệu...).
 */
require get_template_directory() . '/inc/page-content-fields.php';

/**
 * Bật/tắt phần Tin Tức toàn site (trang Tin Tức + mục "Bài Viết Mới" ở trang chủ).
 * Client tạm thời chưa có bài viết nên để FALSE — khi có bài, đổi 'fy_news_enabled'
 * trong Cài đặt > Tổng quan (ô "Hiển thị mục Tin Tức") hoặc sửa dòng dưới thành true.
 */
function fy_news_enabled() {
	$opt = get_option( 'fy_news_enabled', '0' );
	return (bool) apply_filters( 'fy_news_enabled', '1' === (string) $opt );
}

function fy_news_enabled_setting_init() {
	register_setting( 'general', 'fy_news_enabled', array(
		'type'              => 'string',
		'sanitize_callback' => static function ( $v ) { return '1' === (string) $v ? '1' : '0'; },
		'default'           => '0',
	) );
	add_settings_field(
		'fy_news_enabled',
		'Hiển thị mục Tin Tức',
		static function () {
			printf(
				'<label><input type="checkbox" name="fy_news_enabled" value="1" %s> Hiện trang Tin Tức và mục "Bài Viết Mới" ở trang chủ (bỏ chọn khi chưa có bài viết)</label>',
				checked( get_option( 'fy_news_enabled', '0' ), '1', false )
			);
		},
		'general'
	);
}
add_action( 'admin_init', 'fy_news_enabled_setting_init' );

/**
 * Bật/tắt popup khuyến mãi hiện lần đầu khách vào Trang chủ (chỉ hiện 1 lần/trình duyệt,
 * nhớ qua localStorage). Nội dung (tiêu đề/mô tả/ảnh/nút) sửa được ở khối "Popup Khuyến Mãi"
 * trong nội dung Trang chủ (wp-admin > Trang > Trang chủ).
 */
function fy_promo_popup_enabled() {
	$opt = get_option( 'fy_promo_popup_enabled', '1' );
	return (bool) apply_filters( 'fy_promo_popup_enabled', '1' === (string) $opt );
}

function fy_promo_popup_enabled_setting_init() {
	register_setting( 'general', 'fy_promo_popup_enabled', array(
		'type'              => 'string',
		'sanitize_callback' => static function ( $v ) { return '1' === (string) $v ? '1' : '0'; },
		'default'           => '1',
	) );
	add_settings_field(
		'fy_promo_popup_enabled',
		'Popup khuyến mãi',
		static function () {
			printf(
				'<label><input type="checkbox" name="fy_promo_popup_enabled" value="1" %s> Hiện popup khuyến mãi khi khách vào Trang chủ lần đầu</label>',
				checked( get_option( 'fy_promo_popup_enabled', '1' ), '1', false )
			);
		},
		'general'
	);
}
add_action( 'admin_init', 'fy_promo_popup_enabled_setting_init' );


//////////////////////////////////////////////   Function for Translation Error   //////////////////////////////////////////////////////
function art_blog_enqueue_function() {

    define('ART_BLOG_BUY_NOW',__('https://www.revolutionwp.com/products/art-blog-wordpress-theme','milktea-90'));

}
add_action( 'after_setup_theme', 'art_blog_enqueue_function' );

function art_blog_remove_customize_register() {
    global $wp_customize;

    $wp_customize->remove_setting( 'display_header_text' );
    $wp_customize->remove_control( 'display_header_text' );

}

add_action( 'customize_register', 'art_blog_remove_customize_register', 11 );

/************************************************************************************/
// //////////////////////////////////////////////

/**
 * WooCommerce custom filters
 */

// Bỏ tiêu đề mặc định của WooCommerce trên trang Shop/danh mục sản phẩm
// vì đã có hero "fy-page-hero-shop" riêng đảm nhiệm việc này (archive-product.php).
remove_action( 'woocommerce_shop_loop_header', 'woocommerce_product_taxonomy_archive_header', 10 );

// Bỏ breadcrumb mặc định của WooCommerce trên trang sản phẩm (chi tiết/Shop/danh mục) —
// theme không hiển thị breadcrumb ở các trang này nữa.
add_action(
	'wp',
	function () {
		if ( class_exists( 'WooCommerce' ) && ( is_product() || is_shop() || is_product_taxonomy() ) ) {
			remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
		}
	}
);

/**
 * Bỏ hẳn dòng "Hiển thị X–Y của Z kết quả" và ô "Sắp xếp mặc định" khỏi trang Shop/danh
 * mục sản phẩm — banner giờ chỉ còn breadcrumb + tiêu đề, không cần 2 khối này nữa.
 */
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

add_filter('loop_shop_columns', 'art_blog_loop_columns');

if (!function_exists('art_blog_loop_columns')) {

	function art_blog_loop_columns() {

		$art_blog_columns = get_theme_mod( 'art_blog_per_columns', 3 );

		return $art_blog_columns;
	}
}

/************************************************************************************/

add_filter( 'loop_shop_per_page', 'art_blog_per_page', 20 );

function art_blog_per_page( $art_blog_cols ) {

  	$art_blog_cols = get_theme_mod( 'art_blog_product_per_page', 9 );

	return $art_blog_cols;
}

/************************************************************************************/

add_filter( 'woocommerce_output_related_products_args', 'art_blog_products_args' );

function art_blog_products_args( $art_blog_args ) {

    $art_blog_args['posts_per_page'] = get_theme_mod( 'custom_related_products_number', 6 );

    $art_blog_args['columns'] = get_theme_mod( 'custom_related_products_number_per_row', 3 );

    return $art_blog_args;
}

/**
 * Bọc ảnh sản phẩm trong lưới (shop + sản phẩm liên quan) bằng 1 khung tròn cố định
 * kích thước, overflow:hidden — để hiệu ứng zoom khi hover phóng to ảnh BÊN TRONG khung
 * đó, không bao giờ tràn ra ngoài viền trang trí vẽ tay (circle-frame.png) dù zoom bao nhiêu.
 */
add_filter( 'woocommerce_product_get_image', 'faryita_wrap_loop_thumbnail_for_zoom' );

function faryita_wrap_loop_thumbnail_for_zoom( $fy_image ) {
	if ( ! $fy_image ) {
		return $fy_image;
	}
	if ( ! ( is_shop() || is_product_taxonomy() || is_product() ) ) {
		return $fy_image;
	}
	return '<span class="fy-thumb-clip">' . $fy_image . '</span>';
}

/************************************************************************************/

/**
 * Ô nhập "Thành phần" riêng cho từng sản phẩm, hiển thị ở khối "THÀNH PHẦN"
 * trên trang chi tiết sản phẩm (content-single-product.php).
 * Mỗi thành phần nhập trên 1 dòng, lưu vào post meta `_fy_ingredients`.
 */
function faryita_add_ingredients_metabox() {
	add_meta_box(
		'faryita_ingredients',
		__( 'Thành Phần (MilkTea-90)', 'milktea-90' ),
		'faryita_render_ingredients_metabox',
		'product',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'faryita_add_ingredients_metabox' );

function faryita_render_ingredients_metabox( $post ) {
	wp_nonce_field( 'faryita_save_ingredients', 'faryita_ingredients_nonce' );
	$fy_ingredients = get_post_meta( $post->ID, '_fy_ingredients', true );
	?>
	<p><?php esc_html_e( 'Mỗi thành phần nhập trên 1 dòng. Để trống nếu muốn dùng nội dung mặc định của theme.', 'milktea-90' ); ?></p>
	<textarea name="fy_ingredients" rows="5" style="width:100%;"><?php echo esc_textarea( $fy_ingredients ); ?></textarea>
	<?php
}

function faryita_save_ingredients_metabox( $post_id ) {
	if ( ! isset( $_POST['faryita_ingredients_nonce'] ) || ! wp_verify_nonce( $_POST['faryita_ingredients_nonce'], 'faryita_save_ingredients' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	if ( isset( $_POST['fy_ingredients'] ) ) {
		update_post_meta( $post_id, '_fy_ingredients', sanitize_textarea_field( wp_unslash( $_POST['fy_ingredients'] ) ) );
	}
}
add_action( 'save_post_product', 'faryita_save_ingredients_metabox' );

/************************************************************************************/

/**
 * Ô nhập "Lợi Ích Dinh Dưỡng" riêng cho từng sản phẩm: 1 ghi chú + 4 badge "Không...",
 * hiển thị ở khối "LỢI ÍCH DINH DƯỠNG" trên trang chi tiết sản phẩm.
 */
function faryita_nutrition_badges() {
	return array(
		'gluten_free'       => __( 'Không Gluten', 'milktea-90' ),
		'sugar_free'        => __( 'Không Đường Tinh Luyện', 'milktea-90' ),
		'preservative_free' => __( 'Không Chất Bảo Quản', 'milktea-90' ),
		'msg_free'          => __( 'Không Chất Tạo Ngọt Nhân Tạo / MSG', 'milktea-90' ),
	);
}

/**
 * Nhãn badge rút gọn 2 dòng dùng để hiển thị trong hình tròn ở trang chi tiết sản phẩm.
 */
function faryita_nutrition_badge_pill_lines() {
	return array(
		'gluten_free'       => array( 'Không', 'Gluten' ),
		'sugar_free'        => array( 'Không', 'Đường' ),
		'preservative_free' => array( 'Không', 'Chất Bảo Quản' ),
		'msg_free'          => array( 'Không', 'MSG' ),
	);
}

function faryita_add_nutrition_metabox() {
	add_meta_box(
		'faryita_nutrition',
		__( 'Lợi Ích Dinh Dưỡng (MilkTea-90)', 'milktea-90' ),
		'faryita_render_nutrition_metabox',
		'product',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'faryita_add_nutrition_metabox' );

function faryita_render_nutrition_metabox( $post ) {
	wp_nonce_field( 'faryita_save_nutrition', 'faryita_nutrition_nonce' );
	$fy_note = get_post_meta( $post->ID, '_fy_nutrition_note', true );
	?>
	<p><?php esc_html_e( 'Ghi chú lợi ích dinh dưỡng (để trống nếu không cần hiển thị đoạn ghi chú).', 'milktea-90' ); ?></p>
	<textarea name="fy_nutrition_note" rows="3" style="width:100%;"><?php echo esc_textarea( $fy_note ); ?></textarea>

	<p style="margin-top:16px;"><?php esc_html_e( 'Chọn các badge phù hợp với sản phẩm này:', 'milktea-90' ); ?></p>
	<?php foreach ( faryita_nutrition_badges() as $fy_key => $fy_label ) : ?>
		<label style="display:block;margin-bottom:6px;">
			<input type="checkbox" name="fy_badge_<?php echo esc_attr( $fy_key ); ?>" value="1" <?php checked( get_post_meta( $post->ID, '_fy_badge_' . $fy_key, true ), '1' ); ?> />
			<?php echo esc_html( $fy_label ); ?>
		</label>
	<?php endforeach; ?>
	<?php
}

function faryita_save_nutrition_metabox( $post_id ) {
	if ( ! isset( $_POST['faryita_nutrition_nonce'] ) || ! wp_verify_nonce( $_POST['faryita_nutrition_nonce'], 'faryita_save_nutrition' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	if ( isset( $_POST['fy_nutrition_note'] ) ) {
		update_post_meta( $post_id, '_fy_nutrition_note', sanitize_textarea_field( wp_unslash( $_POST['fy_nutrition_note'] ) ) );
	}
	foreach ( faryita_nutrition_badges() as $fy_key => $fy_label ) {
		update_post_meta( $post_id, '_fy_badge_' . $fy_key, isset( $_POST[ 'fy_badge_' . $fy_key ] ) ? '1' : '' );
	}
}
add_action( 'save_post_product', 'faryita_save_nutrition_metabox' );

/************************************************************************************/

/**
 * Thông tin cửa hàng (dùng cho trang "Cửa Hàng") - chỉnh sửa tại
 * Giao diện → Tùy biến → "Thông Tin Cửa Hàng (MilkTea-90)".
 */
function faryita_store_info_fields() {
	return array(
		'fy_store_name'    => array(
			'label'   => __( 'Tên cửa hàng', 'milktea-90' ),
			'default' => 'Trà Sữa DIEM 10',
			'type'    => 'text',
		),
		'fy_store_address' => array(
			'label'   => __( 'Địa chỉ', 'milktea-90' ),
			'default' => '366 Nguyễn Trãi, P. An Đông, TP. Hồ Chí Minh',
			'type'    => 'text',
		),
		'fy_store_hours'   => array(
			'label'   => __( 'Giờ mở cửa', 'milktea-90' ),
			'default' => '08:00 - 22:00 (Tất cả các ngày trong tuần)',
			'type'    => 'text',
		),
		'fy_store_phone'   => array(
			'label'   => __( 'Số điện thoại / Zalo', 'milktea-90' ),
			'default' => '0973285017',
			'type'    => 'text',
		),
		'fy_store_email'   => array(
			'label'   => __( 'Email liên hệ', 'milktea-90' ),
			'default' => 'lienhe@trasuadiem10.com',
			'type'    => 'email',
		),
	);
}

function faryita_store_customizer( $wp_customize ) {
	$wp_customize->add_section(
		'faryita_store_info',
		array(
			'title'    => __( 'Thông Tin Cửa Hàng (MilkTea-90)', 'milktea-90' ),
			'priority' => 200,
		)
	);

	foreach ( faryita_store_info_fields() as $fy_id => $fy_field ) {
		$wp_customize->add_setting(
			$fy_id,
			array(
				'default'           => $fy_field['default'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			$fy_id,
			array(
				'label'   => $fy_field['label'],
				'section' => 'faryita_store_info',
				'type'    => $fy_field['type'],
			)
		);
	}
}
add_action( 'customize_register', 'faryita_store_customizer' );

/************************************************************************************/

/**
 * Mạng xã hội: các nút tròn nổi (Phone, Zalo, Facebook, YouTube, TikTok...) lấy trực tiếp
 * từ menu điều hướng "Social Menu" (Giao diện → Menu → tạo menu, gán vào vị trí
 * "Social Menu", thêm link tùy chỉnh cho từng mạng xã hội). Icon tự nhận diện theo URL.
 */
function faryita_social_icon_for_url( $url ) {
	$url = strtolower( $url );
	if ( 0 === strpos( $url, 'tel:' ) ) {
		return array( 'icon' => 'fas fa-phone-alt', 'label' => 'phone' );
	}
	if ( false !== strpos( $url, 'facebook.com' ) || false !== strpos( $url, 'fb.com' ) ) {
		return array( 'icon' => 'fab fa-facebook-f', 'label' => 'facebook' );
	}
	if ( false !== strpos( $url, 'zalo.me' ) || false !== strpos( $url, 'zalo' ) ) {
		return array( 'icon' => '', 'label' => 'zalo' );
	}
	if ( false !== strpos( $url, 'youtube.com' ) || false !== strpos( $url, 'youtu.be' ) ) {
		return array( 'icon' => 'fab fa-youtube', 'label' => 'youtube' );
	}
	if ( false !== strpos( $url, 'tiktok.com' ) ) {
		// Glyph "fa-tiktok" dùng mã Unicode vùng riêng (\e07b) mà font Font Awesome 5 Brands
		// bundle trong theme không render được (hiện ô đen "notdef" thay vì icon) — dùng SVG
		// inline thay icon font để luôn hiển thị đúng, không phụ thuộc font nữa.
		return array( 'icon' => 'svg-tiktok', 'label' => 'tiktok' );
	}
	if ( false !== strpos( $url, 'instagram.com' ) ) {
		return array( 'icon' => 'fab fa-instagram', 'label' => 'instagram' );
	}
	if ( 0 === strpos( $url, 'mailto:' ) ) {
		return array( 'icon' => 'fas fa-envelope', 'label' => 'email' );
	}
	return array( 'icon' => 'fas fa-link', 'label' => 'link' );
}

function faryita_render_social_floating_bar() {
	if ( ! has_nav_menu( 'social-menu' ) ) {
		return;
	}
	$items = wp_get_nav_menu_items( wp_get_nav_menu_object( get_nav_menu_locations()['social-menu'] ) );
	if ( empty( $items ) ) {
		return;
	}
	?>
	<style>
		/* Khối đen tưởng là "lỗi icon TikTok" thực ra là nút "Về đầu trang" (.footer-go-to-top,
		   style.css — nền đen, bottom:30px/right:20-30px, chỉ hiện khi cuộn xuống nhờ class
		   .show) nằm CHỒNG vào đúng vị trí icon cuối (TikTok) của thanh mạng xã hội — z-index
		   thanh này cao hơn nên che hầu hết nút đen, chỉ lộ góc vuông ra ngoài viền tròn. Đẩy
		   thanh mạng xã hội lên cao hơn hẳn vùng nút đó (bottom 30–70px) để không còn chồng. */
		.fy-social-float{position:fixed;right:18px;bottom:84px;z-index:9999;display:flex;flex-direction:column;gap:10px}
		.fy-social-float a{width:48px;height:48px;border-radius:50%;background:#1877f2;color:#fff;display:flex;align-items:center;justify-content:center;box-shadow:0 6px 16px rgba(0,0,0,.25);text-decoration:none;font-size:20px;transition:transform .2s ease}
		.fy-social-float a:hover{transform:scale(1.08)}
		.fy-social-float .fy-social-zalo-text{font-size:12px;font-weight:800;font-style:normal;letter-spacing:-.5px}
		.fy-social-float .fy-social-svg{width:20px;height:20px;fill:currentColor}
		@media(max-width:600px){.fy-social-float{right:10px;bottom:78px}.fy-social-float a{width:42px;height:42px;font-size:17px}.fy-social-float .fy-social-svg{width:17px;height:17px}}
	</style>
	<div class="fy-social-float">
		<?php
		foreach ( $items as $item ) :
			$fy_info = faryita_social_icon_for_url( $item->url );
			// Bỏ nút kênh YouTube khỏi thanh nổi (yêu cầu client 08/2026) — vẫn giữ item trong
			// menu để dễ bật lại sau, chỉ không render.
			if ( 'youtube' === $fy_info['label'] ) {
				continue;
			}
			$fy_target = ( 0 === strpos( $item->url, 'tel:' ) || 0 === strpos( $item->url, 'mailto:' ) ) ? '' : ' target="_blank" rel="noopener"';
			?>
			<a href="<?php echo esc_url( $item->url ); ?>"<?php echo $fy_target; // phpcs:ignore ?> aria-label="<?php echo esc_attr( $item->title ); ?>" title="<?php echo esc_attr( $item->title ); ?>">
				<?php if ( 'zalo' === $fy_info['label'] ) : ?>
					<span class="fy-social-zalo-text">Zalo</span>
				<?php elseif ( 'svg-tiktok' === $fy_info['icon'] ) : ?>
					<svg class="fy-social-svg" viewBox="0 0 448 512" aria-hidden="true" focusable="false"><path fill="currentColor" d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/></svg>
				<?php else : ?>
					<i class="<?php echo esc_attr( $fy_info['icon'] ); ?>" aria-hidden="true"></i>
				<?php endif; ?>
			</a>
		<?php endforeach; ?>
	</div>
	<?php
}
add_action( 'wp_footer', 'faryita_render_social_floating_bar' );

/**
 * Popup "Tư Vấn Nhượng Quyền" — render 1 lần trong footer (toàn site) để nút CTA trên
 * menu (mọi trang) mở được, kể cả những trang không load faryita-custom.css/js.
 * JS đóng/mở viết inline ngay tại đây cho tự chứa, không phụ thuộc file JS enqueue có điều kiện.
 */
function faryita_render_franchise_modal() {
	$fy_form_bg = esc_url( get_template_directory_uri() . '/assets/images/brand/popup-bg.png' );
	?>
	<style>
	/* Popup + nút CTA header — CSS tự chứa (in ngay đây) để áp dụng trên MỌI trang, kể cả
	   những trang không load faryita-custom.css (chỉ enqueue có điều kiện trên 1 số template). */
	.fy-modal-overlay{--fy-yellow:#f6c945;--fy-cream:#fefaee;--fy-green:#0f7a44;--fy-orange:#59ad00;--fy-dark:#173226;position:fixed;inset:0;background:rgba(23,50,34,.65);display:flex;align-items:center;justify-content:center;padding:20px;z-index:100000;opacity:0;visibility:hidden;transition:opacity .25s ease}
	.fy-modal-overlay.is-open{opacity:1;visibility:visible}
	/* Bề rộng popup: 936px = 520px gốc × 1.8 (yêu cầu client 09/2026).
	   Nền: ảnh lá trà popup-bg.png (dùng chung cho tất cả popup — yêu cầu client 09/2026). */
	.fy-modal-box{background:#e4f0cf url("<?php echo $fy_form_bg; // phpcs:ignore WordPress.Security.EscapeOutput ?>") center center / cover no-repeat;border-radius:22px;padding:40px 44px;max-width:936px;width:100%;max-height:90vh;overflow-y:auto;position:relative;transform:translateY(20px);transition:transform .25s ease;box-sizing:border-box}
	.fy-modal-overlay.is-open .fy-modal-box{transform:translateY(0)}
	.fy-modal-close{position:absolute;top:14px;right:14px;width:32px;height:32px;border-radius:50%;border:none;background:#fefaee;color:#173226;font-size:20px;line-height:1;cursor:pointer;display:flex;align-items:center;justify-content:center;padding:0}
	.fy-modal-close:hover{background:#fff;box-shadow:inset 0 0 0 2px #173226}
	.fy-modal-title{font-size:22px;line-height:1.35;color:#173226;text-transform:uppercase;font-weight:800;text-align:center;margin:0 0 22px}
	body.fy-modal-open{overflow:hidden}
	/* Form nhượng quyền TRONG popup — copy tự chứa (giá trị y hệt .fy-franchise-* trong
	   faryita-custom.css) để popup mở ở trang nào cũng đồng bộ kiểu với form trang chủ/liên hệ,
	   kể cả các trang không load faryita-custom.css. Scope .fy-modal-overlay để không đụng trang khác. */
	.fy-modal-overlay .fy-franchise-form{display:flex;flex-direction:column;gap:22px;text-align:left}
	.fy-modal-overlay .fy-franchise-row{display:flex;gap:20px;flex-wrap:wrap}
	.fy-modal-overlay .fy-franchise-field{flex:1 1 180px;display:flex;flex-direction:column;gap:6px}
	.fy-modal-overlay .fy-franchise-field-full{width:100%;flex:0 0 auto}
	.fy-modal-overlay .fy-franchise-label{color:#173226;font-weight:800;font-size:11px;letter-spacing:.04em;text-transform:uppercase}
	.fy-modal-overlay .fy-franchise-control{width:100%;padding:12px 16px 12px 26px;border:1px solid #E2E8F0;border-radius:10px;font-size:14px;font-family:inherit;color:#173226;background-color:#fff;box-sizing:border-box;appearance:none}
	.fy-modal-overlay .fy-franchise-control:focus{outline:none;border-color:#0f7a44}
	.fy-modal-overlay select.fy-franchise-control{background-repeat:no-repeat;background-image:url("data:image/svg+xml;charset=UTF-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23173226' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");background-position:right 14px center;background-size:14px;padding-right:40px;cursor:pointer}
	.fy-modal-overlay .fy-franchise-textarea{border-radius:10px;resize:vertical;min-height:100px}
	.fy-modal-overlay .fy-franchise-consent{align-self:center;display:flex;align-items:center;gap:8px;font-size:13px;color:#173226;text-align:center}
	.fy-modal-overlay .fy-franchise-consent input{width:16px;height:16px;flex-shrink:0;accent-color:#0f7a44}
	.fy-modal-overlay .fy-franchise-recaptcha{align-self:center}
	.fy-modal-overlay .fy-franchise-submit{align-self:center;margin-top:2px;display:inline-flex;align-items:center;gap:8px;background:#0f7a44;color:#fff;font-weight:800;padding:9px 22px;border-radius:999px;border:none;cursor:pointer;font-size:13px;transition:background .2s ease,transform .15s ease}
	.fy-modal-overlay .fy-franchise-submit:hover{background:#f6c945;color:#173226;transform:translateY(-2px)}
	@media screen and (max-width:960px){.fy-modal-box{padding:32px 24px}}
	@media screen and (max-width:700px){.fy-modal-overlay .fy-franchise-row{flex-direction:column;gap:14px}.fy-modal-overlay .fy-franchise-field{flex:0 0 auto}.fy-modal-overlay .fy-franchise-form{gap:14px}}
	.fy-header-cta{display:none;align-items:center;background:#0f7a44;color:#fff;font-weight:800;font-size:13px;letter-spacing:.02em;text-transform:uppercase;text-decoration:none;padding:10px 20px;border-radius:999px;white-space:nowrap;transition:background .2s ease,transform .15s ease}
	.fy-header-cta:hover{background:#f6c945;transform:translateY(-2px);color:#173226}
	@media screen and (min-width:901px){.fy-header-cta{display:inline-flex;margin-left:14px}}
	/* Nút "Về đầu trang" (footer.php) đổi icon mũi tên thành ly trà sữa 🧋 — cỡ chữ 14px gốc
	   (style.css) quá nhỏ cho emoji, tăng lên cho rõ. Đặt ở đây (không phải faryita-custom.css)
	   vì nút này site-wide còn CSS kia chỉ load có điều kiện trên vài template. */
	.footer-go-to-top{font-size:20px}
	</style>
	<div class="fy-modal-overlay" id="fy-franchise-modal" aria-hidden="true">
		<div class="fy-modal-box" role="dialog" aria-modal="true" aria-labelledby="fy-franchise-modal-title">
			<button type="button" class="fy-modal-close" aria-label="Đóng">&times;</button>
			<h2 id="fy-franchise-modal-title" class="fy-modal-title">Tư Vấn Nhượng Quyền<br>Trà Sữa DIEM 10</h2>
			<?php faryita_render_franchise_form( 'popup' ); ?>
		</div>
	</div>
	<script>
	(function () {
		var modal = document.getElementById('fy-franchise-modal');
		if (!modal) { return; }
		function openModal(e) {
			if (e) { e.preventDefault(); }
			modal.classList.add('is-open');
			modal.setAttribute('aria-hidden', 'false');
			document.body.classList.add('fy-modal-open');
		}
		function closeModal() {
			modal.classList.remove('is-open');
			modal.setAttribute('aria-hidden', 'true');
			document.body.classList.remove('fy-modal-open');
		}
		document.querySelectorAll('[data-fy-open-franchise]').forEach(function (btn) {
			btn.addEventListener('click', openModal);
		});
		var closeBtn = modal.querySelector('.fy-modal-close');
		if (closeBtn) { closeBtn.addEventListener('click', closeModal); }
		modal.addEventListener('click', function (e) {
			if (e.target === modal) { closeModal(); }
		});
		document.addEventListener('keydown', function (e) {
			if (e.key === 'Escape') { closeModal(); }
		});
		<?php if ( isset( $_GET['fy_franchise'] ) ) : ?>
		if (!document.querySelector('#fy-franchise')) { openModal(); }
		<?php endif; ?>
	})();
	</script>
	<?php
}
add_action( 'wp_footer', 'faryita_render_franchise_modal' );

/************************************************************************************/

/**
 * Custom logo
 */

function art_blog_custom_css() {
?>
	<style type="text/css" id="custom-theme-colors" >
        :root {
           
            --art_blog_logo_width: <?php echo absint(get_theme_mod('art_blog_logo_width')); ?> ;   
        }
        .site-branding img {
            max-width:<?php echo esc_html(get_theme_mod('art_blog_logo_width')); ?>px ;    
        }         
	</style>
<?php
}
add_action( 'wp_head', 'art_blog_custom_css' );

function art_blog_custom_css_for_slider() {
    $art_blog_slider_enabled = get_theme_mod('art_blog_enable_slider', false);
    if ($art_blog_slider_enabled) {
        echo '<style type="text/css">
            .page-template-revolution-home .header-menu-box {
                position: absolute;
                width: 100%;
                z-index: 999;
                background: transparent;
                border: none;
            }
        </style>';
    }
}
add_action('wp_head', 'art_blog_custom_css_for_slider');

/************************************************************************************/

/**
 * Custom Post Type: Chi Nhánh (cửa hàng)
 * post_excerpt lưu địa chỉ đầy đủ, featured image là ảnh cửa hàng,
 * meta _fy_coming_soon đánh dấu chi nhánh "Sắp khai trương".
 */
function faryita_register_chi_nhanh_cpt() {
	register_post_type( 'chi_nhanh', array(
		'labels' => array(
			'name'               => 'Chi Nhánh',
			'singular_name'      => 'Chi Nhánh',
			'add_new_item'       => 'Thêm Chi Nhánh',
			'edit_item'          => 'Sửa Chi Nhánh',
			'all_items'          => 'Tất Cả Chi Nhánh',
			'menu_name'          => 'Chi Nhánh',
		),
		'public'       => true,
		'has_archive'  => false,
		'menu_icon'    => 'dashicons-store',
		'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
		'rewrite'      => array( 'slug' => 'chi-nhanh' ),
		'show_in_rest' => true,
	) );
}
add_action( 'init', 'faryita_register_chi_nhanh_cpt' );

function faryita_chi_nhanh_metabox() {
	add_meta_box( 'fy_chi_nhanh_meta', 'Trạng thái chi nhánh', 'faryita_chi_nhanh_metabox_html', 'chi_nhanh', 'side' );
}
add_action( 'add_meta_boxes', 'faryita_chi_nhanh_metabox' );

function faryita_chi_nhanh_metabox_html( $post ) {
	wp_nonce_field( 'fy_chi_nhanh_save', 'fy_chi_nhanh_nonce' );
	$coming_soon = get_post_meta( $post->ID, '_fy_coming_soon', true );
	?>
	<label>
		<input type="checkbox" name="fy_coming_soon" value="1" <?php checked( $coming_soon, '1' ); ?> />
		Sắp khai trương (Coming soon)
	</label>
	<?php
}

function faryita_chi_nhanh_save_meta( $post_id ) {
	if ( ! isset( $_POST['fy_chi_nhanh_nonce'] ) || ! wp_verify_nonce( $_POST['fy_chi_nhanh_nonce'], 'fy_chi_nhanh_save' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	update_post_meta( $post_id, '_fy_coming_soon', isset( $_POST['fy_coming_soon'] ) ? '1' : '' );
}
add_action( 'save_post_chi_nhanh', 'faryita_chi_nhanh_save_meta' );

/************************************************************************************/

/**
 * Trang "Liên Hệ": bảng riêng lưu thông tin khách gửi form + trang quản trị xem/xuất Excel.
 */
function faryita_contacts_table_name() {
	global $wpdb;
	return $wpdb->prefix . 'fy_contacts';
}

function faryita_maybe_create_contacts_table() {
	if ( get_option( 'fy_contacts_table_version' ) === '1.2' ) {
		return;
	}
	global $wpdb;
	$table           = faryita_contacts_table_name();
	$charset_collate = $wpdb->get_charset_collate();
	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	$sql = "CREATE TABLE $table (
		id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
		type VARCHAR(20) NOT NULL DEFAULT 'contact',
		name VARCHAR(190) NOT NULL,
		email VARCHAR(190) NOT NULL,
		phone VARCHAR(50) NOT NULL,
		address VARCHAR(255) NULL,
		message TEXT NULL,
		gender VARCHAR(10) NULL,
		region VARCHAR(190) NULL,
		created_at DATETIME NOT NULL,
		ip VARCHAR(45) NULL,
		PRIMARY KEY (id)
	) $charset_collate;";
	dbDelta( $sql );
	update_option( 'fy_contacts_table_version', '1.2' );
}
add_action( 'init', 'faryita_maybe_create_contacts_table' );

/**
 * Giới hạn số lần gửi form theo IP (lớp chống spam bổ sung, cùng với reCAPTCHA bên dưới).
 */
function faryita_fy_rate_limited( $bucket, $max = 3 ) {
	$ip  = sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ?? '' ) );
	$key = 'fy_rl_' . $bucket . '_' . md5( $ip );
	$count = (int) get_transient( $key );
	if ( $count >= $max ) {
		return true;
	}
	set_transient( $key, $count + 1, HOUR_IN_SECONDS );
	return false;
}

/**
 * Xác minh Google reCAPTCHA v2 phía server — gọi API siteverify của Google với token
 * ($_POST['g-recaptcha-response']) do widget "Tôi không phải là người máy" sinh ra ở form.
 * Trả false nếu thiếu token, gọi API lỗi, hoặc Google báo không hợp lệ (bot/hết hạn).
 */
function faryita_verify_recaptcha() {
	$token = isset( $_POST['g-recaptcha-response'] ) ? sanitize_text_field( wp_unslash( $_POST['g-recaptcha-response'] ) ) : '';
	if ( '' === $token ) {
		return false;
	}
	$response = wp_remote_post( 'https://www.google.com/recaptcha/api/siteverify', array(
		'timeout' => 10,
		'body'    => array(
			'secret'   => FY_RECAPTCHA_SECRET_KEY,
			'response' => $token,
			'remoteip' => sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ?? '' ) ),
		),
	) );
	if ( is_wp_error( $response ) ) {
		return false;
	}
	$body = json_decode( wp_remote_retrieve_body( $response ), true );
	return ! empty( $body['success'] );
}

/**
 * Xử lý submit form liên hệ (khách đã đăng nhập hoặc chưa đều đi qua admin-post.php).
 */
function faryita_handle_contact_submit() {
	$redirect = wp_get_referer() ? wp_get_referer() : home_url( '/lien-he/' );

	if ( ! isset( $_POST['fy_contact_nonce'] ) || ! wp_verify_nonce( $_POST['fy_contact_nonce'], 'fy_submit_contact' ) ) {
		wp_safe_redirect( add_query_arg( 'fy_contact', 'error', $redirect ) );
		exit;
	}

	// Honeypot chống spam bot: field ẩn, người dùng thật sẽ không điền.
	if ( ! empty( $_POST['fy_website'] ) ) {
		wp_safe_redirect( add_query_arg( 'fy_contact', 'success', $redirect ) );
		exit;
	}

	if ( ! faryita_verify_recaptcha() ) {
		wp_safe_redirect( add_query_arg( 'fy_contact', 'error', $redirect ) );
		exit;
	}

	$name    = sanitize_text_field( wp_unslash( $_POST['fy_name'] ?? '' ) );
	$email   = sanitize_email( wp_unslash( $_POST['fy_email'] ?? '' ) );
	$phone   = sanitize_text_field( wp_unslash( $_POST['fy_phone'] ?? '' ) );
	$address = sanitize_text_field( wp_unslash( $_POST['fy_address'] ?? '' ) );
	$message = sanitize_textarea_field( wp_unslash( $_POST['fy_message'] ?? '' ) );

	if ( '' === $name || '' === $phone || ! is_email( $email ) ) {
		wp_safe_redirect( add_query_arg( 'fy_contact', 'error', $redirect ) );
		exit;
	}

	global $wpdb;
	$wpdb->insert(
		faryita_contacts_table_name(),
		array(
			'type'       => 'contact',
			'name'       => $name,
			'email'      => $email,
			'phone'      => $phone,
			'address'    => $address,
			'message'    => $message,
			'created_at' => current_time( 'mysql' ),
			'ip'         => sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ?? '' ) ),
		)
	);

	faryita_send_contact_email( $name, $email, $phone, $address, $message );

	wp_safe_redirect( add_query_arg( 'fy_contact', 'success', $redirect ) );
	exit;
}

/**
 * Gửi email báo có liên hệ mới tới hộp thư cấu hình ở "Tùy biến" → "Thông tin cửa hàng"
 * (fy_store_email, mặc định lienhe@trasuadiem10.com). Lỗi gửi mail (host chặn SMTP...)
 * không chặn việc lưu liên hệ vào DB — dữ liệu vẫn xem được trong wp-admin.
 */
function faryita_send_contact_email( $name, $email, $phone, $address, $message ) {
	$to      = get_theme_mod( 'fy_store_email', 'lienhe@trasuadiem10.com' );
	$subject = sprintf( '[Liên hệ website] %s', $name );
	$body    = "Có một liên hệ mới từ website:\n\n"
		. "Họ tên: {$name}\n"
		. "Email: {$email}\n"
		. "Điện thoại: {$phone}\n"
		. ( $address ? "Địa chỉ: {$address}\n" : '' )
		. ( $message ? "Nội dung:\n{$message}\n" : '' );
	$headers = array( 'Reply-To: ' . $name . ' <' . $email . '>' );
	wp_mail( $to, $subject, $body, $headers );
}
add_action( 'admin_post_nopriv_fy_submit_contact', 'faryita_handle_contact_submit' );
add_action( 'admin_post_fy_submit_contact', 'faryita_handle_contact_submit' );

/**
 * Render form "Đăng ký nhượng quyền" — dùng chung cho section trang chủ và popup
 * (mở từ nút "Tư Vấn Nhượng Quyền" trên menu). $id_suffix để tránh trùng id giữa
 * 2 bản form cùng xuất hiện trên 1 trang (vd. trang chủ có cả section lẫn popup).
 */
function faryita_render_franchise_form( $id_suffix = '' ) {
	$form_id = 'fy-franchise-form' . ( $id_suffix ? '-' . $id_suffix : '' );
	$fy_franchise_status = isset( $_GET['fy_franchise'] ) ? sanitize_key( $_GET['fy_franchise'] ) : '';
	?>
	<?php if ( 'success' === $fy_franchise_status ) : ?>
		<div class="fy-contact-alert fy-contact-alert-success">Cảm ơn bạn đã quan tâm! Chúng tôi sẽ liên hệ lại sớm nhất.</div>
	<?php elseif ( 'error' === $fy_franchise_status ) : ?>
		<div class="fy-contact-alert fy-contact-alert-error">Vui lòng điền đầy đủ Họ tên, Email hợp lệ và Số điện thoại. Nếu bạn vừa gửi nhiều lần liên tiếp, vui lòng thử lại sau.</div>
	<?php endif; ?>

	<form class="fy-franchise-form" id="<?php echo esc_attr( $form_id ); ?>" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
		<input type="hidden" name="action" value="fy_submit_franchise">
		<?php wp_nonce_field( 'fy_submit_franchise', 'fy_franchise_nonce' ); ?>
		<input type="text" name="fy_website" class="fy-hp-field" tabindex="-1" autocomplete="off" aria-hidden="true">

		<div class="fy-franchise-row">
			<label class="fy-franchise-field">
				<span class="fy-franchise-label">Họ Và Tên</span>
				<input class="fy-franchise-control" type="text" name="fy_name" placeholder="Họ và tên" required>
			</label>
			<label class="fy-franchise-field">
				<span class="fy-franchise-label">Giới Tính</span>
				<select class="fy-franchise-control" name="fy_gender">
					<option value="Nam">Nam</option>
					<option value="Nữ">Nữ</option>
				</select>
			</label>
		</div>
		<div class="fy-franchise-row">
			<label class="fy-franchise-field">
				<span class="fy-franchise-label">Số Điện Thoại</span>
				<input class="fy-franchise-control" type="text" name="fy_phone" placeholder="Số điện thoại" required>
			</label>
			<label class="fy-franchise-field">
				<span class="fy-franchise-label">Email</span>
				<input class="fy-franchise-control" type="email" name="fy_email" placeholder="Email" required>
			</label>
		</div>
		<div class="fy-franchise-row">
			<label class="fy-franchise-field fy-franchise-field-full">
				<span class="fy-franchise-label">Khu Vực Muốn Đăng Ký</span>
				<input class="fy-franchise-control" type="text" name="fy_region" placeholder="Tỉnh thành">
			</label>
		</div>

		<label class="fy-franchise-consent">
			<input type="checkbox" name="fy_consent" required>
			<span>Tôi đồng ý với chính sách bảo mật</span>
		</label>

		<div class="fy-franchise-recaptcha g-recaptcha" data-sitekey="<?php echo esc_attr( FY_RECAPTCHA_SITE_KEY ); ?>"></div>

		<button type="submit" class="fy-franchise-submit">Đăng ký <span aria-hidden="true">→</span></button>
	</form>
	<?php
}

/**
 * Xử lý submit form "Đăng ký nhượng quyền" (trang chủ, gần footer).
 * Dùng chung bảng wp_fy_contacts với form liên hệ, chỉ khác cột `type`.
 */
function faryita_handle_franchise_submit() {
	$redirect = wp_get_referer() ? wp_get_referer() : home_url( '/' );

	if ( ! isset( $_POST['fy_franchise_nonce'] ) || ! wp_verify_nonce( $_POST['fy_franchise_nonce'], 'fy_submit_franchise' ) ) {
		wp_safe_redirect( add_query_arg( 'fy_franchise', 'error', $redirect ) . '#fy-franchise' );
		exit;
	}

	// Honeypot chống spam bot: field ẩn, người dùng thật sẽ không điền.
	if ( ! empty( $_POST['fy_website'] ) ) {
		wp_safe_redirect( add_query_arg( 'fy_franchise', 'success', $redirect ) . '#fy-franchise' );
		exit;
	}

	if ( ! faryita_verify_recaptcha() ) {
		wp_safe_redirect( add_query_arg( 'fy_franchise', 'error', $redirect ) . '#fy-franchise' );
		exit;
	}

	if ( faryita_fy_rate_limited( 'franchise' ) ) {
		wp_safe_redirect( add_query_arg( 'fy_franchise', 'error', $redirect ) . '#fy-franchise' );
		exit;
	}

	$name   = sanitize_text_field( wp_unslash( $_POST['fy_name'] ?? '' ) );
	$email  = sanitize_email( wp_unslash( $_POST['fy_email'] ?? '' ) );
	$phone  = sanitize_text_field( wp_unslash( $_POST['fy_phone'] ?? '' ) );
	$gender = sanitize_text_field( wp_unslash( $_POST['fy_gender'] ?? '' ) );
	$region = sanitize_text_field( wp_unslash( $_POST['fy_region'] ?? '' ) );

	if ( '' === $name || '' === $phone || ! is_email( $email ) ) {
		wp_safe_redirect( add_query_arg( 'fy_franchise', 'error', $redirect ) . '#fy-franchise' );
		exit;
	}

	global $wpdb;
	$wpdb->insert(
		faryita_contacts_table_name(),
		array(
			'type'       => 'franchise',
			'name'       => $name,
			'email'      => $email,
			'phone'      => $phone,
			'address'    => '',
			'message'    => '',
			'gender'     => $gender,
			'region'     => $region,
			'created_at' => current_time( 'mysql' ),
			'ip'         => sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ?? '' ) ),
		)
	);

	faryita_send_franchise_email( $name, $email, $phone, $gender, $region );

	wp_safe_redirect( add_query_arg( 'fy_franchise', 'success', $redirect ) . '#fy-franchise' );
	exit;
}
add_action( 'admin_post_nopriv_fy_submit_franchise', 'faryita_handle_franchise_submit' );
add_action( 'admin_post_fy_submit_franchise', 'faryita_handle_franchise_submit' );

/**
 * Gửi email báo có đăng ký tư vấn nhượng quyền mới, tới cùng hộp thư cấu hình ở
 * "Tùy biến" → "Thông tin cửa hàng" (fy_store_email) như form liên hệ. Lỗi gửi mail
 * không chặn việc lưu đăng ký vào DB — dữ liệu vẫn xem được trong wp-admin.
 */
function faryita_send_franchise_email( $name, $email, $phone, $gender, $region ) {
	$to      = get_theme_mod( 'fy_store_email', 'lienhe@trasuadiem10.com' );
	$subject = sprintf( '[Đăng ký nhượng quyền] %s', $name );
	$body    = "Có một đăng ký tư vấn nhượng quyền mới từ website:\n\n"
		. "Họ tên: {$name}\n"
		. "Email: {$email}\n"
		. "Điện thoại: {$phone}\n"
		. ( $gender ? "Giới tính: {$gender}\n" : '' )
		. ( $region ? "Khu vực muốn đăng ký: {$region}\n" : '' );
	$headers = array( 'Reply-To: ' . $name . ' <' . $email . '>' );
	wp_mail( $to, $subject, $body, $headers );
}

/**
 * Trang quản trị "Thông tin liên hệ".
 */
function faryita_contacts_admin_menu() {
	add_menu_page(
		'Thông tin liên hệ',
		'Thông tin liên hệ',
		'manage_options',
		'fy-contacts',
		'faryita_contacts_admin_page',
		'dashicons-email-alt',
		26
	);
}
add_action( 'admin_menu', 'faryita_contacts_admin_menu' );

function faryita_contacts_admin_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	global $wpdb;
	$table = faryita_contacts_table_name();

	if ( isset( $_GET['action'], $_GET['id'] ) && 'delete' === $_GET['action'] ) {
		$id = (int) $_GET['id'];
		check_admin_referer( 'fy_delete_contact_' . $id );
		$wpdb->delete( $table, array( 'id' => $id ) );
		echo '<div class="notice notice-success is-dismissible"><p>Đã xoá liên hệ.</p></div>';
	}

	$fy_type_filter = isset( $_GET['fy_type'] ) ? sanitize_key( $_GET['fy_type'] ) : '';
	if ( in_array( $fy_type_filter, array( 'contact', 'franchise' ), true ) ) {
		$rows = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table WHERE type = %s ORDER BY created_at DESC", $fy_type_filter ) );
	} else {
		$rows = $wpdb->get_results( "SELECT * FROM $table ORDER BY created_at DESC" );
	}
	$export_url  = wp_nonce_url( admin_url( 'admin-post.php?action=fy_export_contacts' ), 'fy_export_contacts' );
	$fy_labels   = array( 'contact' => 'Liên hệ', 'franchise' => 'Nhượng quyền' );
	?>
	<div class="wrap">
		<h1 class="wp-heading-inline">Thông tin liên hệ</h1>
		<a href="<?php echo esc_url( $export_url ); ?>" class="page-title-action">Xuất Excel</a>
		<hr class="wp-header-end">
		<ul class="subsubsub">
			<li><a href="<?php echo esc_url( admin_url( 'admin.php?page=fy-contacts' ) ); ?>" <?php echo '' === $fy_type_filter ? 'class="current"' : ''; ?>>Tất cả</a> |</li>
			<li><a href="<?php echo esc_url( admin_url( 'admin.php?page=fy-contacts&fy_type=contact' ) ); ?>" <?php echo 'contact' === $fy_type_filter ? 'class="current"' : ''; ?>>Liên hệ</a> |</li>
			<li><a href="<?php echo esc_url( admin_url( 'admin.php?page=fy-contacts&fy_type=franchise' ) ); ?>" <?php echo 'franchise' === $fy_type_filter ? 'class="current"' : ''; ?>>Nhượng quyền</a></li>
		</ul>
		<p><?php echo count( $rows ); ?> mục.</p>
		<table class="wp-list-table widefat fixed striped">
			<thead>
				<tr>
					<th style="width:9%">Loại</th>
					<th style="width:13%">Họ tên</th>
					<th style="width:15%">Email</th>
					<th style="width:9%">Điện thoại</th>
					<th style="width:7%">Giới tính</th>
					<th style="width:13%">Địa chỉ / Khu vực</th>
					<th>Nội dung</th>
					<th style="width:11%">Thời gian</th>
					<th style="width:6%">Thao tác</th>
				</tr>
			</thead>
			<tbody>
			<?php if ( $rows ) : ?>
				<?php foreach ( $rows as $r ) : ?>
					<tr>
						<td><?php echo esc_html( $fy_labels[ $r->type ] ?? $r->type ); ?></td>
						<td><?php echo esc_html( $r->name ); ?></td>
						<td><a href="mailto:<?php echo esc_attr( $r->email ); ?>"><?php echo esc_html( $r->email ); ?></a></td>
						<td><?php echo esc_html( $r->phone ); ?></td>
						<td><?php echo esc_html( $r->gender ); ?></td>
						<td><?php echo esc_html( $r->address ?: $r->region ); ?></td>
						<td><?php echo esc_html( $r->message ); ?></td>
						<td><?php echo esc_html( mysql2date( 'd/m/Y H:i', $r->created_at ) ); ?></td>
						<td>
							<a href="<?php echo esc_url( wp_nonce_url( admin_url( 'admin.php?page=fy-contacts&action=delete&id=' . $r->id ), 'fy_delete_contact_' . $r->id ) ); ?>"
								onclick="return confirm('Xoá mục này?');">Xoá</a>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php else : ?>
				<tr><td colspan="9">Chưa có thông tin nào được gửi.</td></tr>
			<?php endif; ?>
			</tbody>
		</table>
	</div>
	<?php
}

/**
 * Xuất danh sách liên hệ ra file Excel (.xls) - bảng HTML mà Excel mở trực tiếp được,
 * không cần thư viện ngoài.
 */
function faryita_export_contacts() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( 'Bạn không có quyền thực hiện thao tác này.' );
	}
	check_admin_referer( 'fy_export_contacts' );

	global $wpdb;
	$rows = $wpdb->get_results( 'SELECT * FROM ' . faryita_contacts_table_name() . ' ORDER BY created_at DESC' );

	nocache_headers();
	header( 'Content-Type: application/vnd.ms-excel; charset=utf-8' );
	header( 'Content-Disposition: attachment; filename=lien-he-' . gmdate( 'Y-m-d' ) . '.xls' );

	$fy_labels = array( 'contact' => 'Liên hệ', 'franchise' => 'Nhượng quyền' );

	echo "\xEF\xBB\xBF";
	echo '<table border="1"><tr>';
	foreach ( array( 'Loại', 'Họ tên', 'Email', 'Điện thoại', 'Giới tính', 'Địa chỉ / Khu vực', 'Nội dung', 'Thời gian', 'IP' ) as $h ) {
		echo '<th>' . esc_html( $h ) . '</th>';
	}
	echo '</tr>';
	foreach ( $rows as $r ) {
		echo '<tr>';
		echo '<td>' . esc_html( $fy_labels[ $r->type ] ?? $r->type ) . '</td>';
		echo '<td>' . esc_html( $r->name ) . '</td>';
		echo '<td>' . esc_html( $r->email ) . '</td>';
		echo '<td>' . esc_html( $r->phone ) . '</td>';
		echo '<td>' . esc_html( $r->gender ) . '</td>';
		echo '<td>' . esc_html( $r->address ?: $r->region ) . '</td>';
		echo '<td>' . esc_html( $r->message ) . '</td>';
		echo '<td>' . esc_html( mysql2date( 'd/m/Y H:i', $r->created_at ) ) . '</td>';
		echo '<td>' . esc_html( $r->ip ) . '</td>';
		echo '</tr>';
	}
	echo '</table>';
	exit;
}

/************************************************************************************/

/**
 * Sắp xếp thứ tự hiển thị sản phẩm (menu_order) ngay trong danh sách Sản phẩm ở wp-admin:
 * thêm cột "Thứ tự" hiện số + bấm tiêu đề cột để sắp xếp tăng/giảm. Bổ sung cho tính năng
 * kéo-thả có sẵn của WooCommerce (tab "Sắp xếp" trong Sản phẩm → Tất cả sản phẩm).
 */
function faryita_product_order_column( $columns ) {
	$new_columns = array();
	foreach ( $columns as $key => $label ) {
		$new_columns[ $key ] = $label;
		if ( 'name' === $key ) {
			$new_columns['fy_order'] = __( 'Thứ tự', 'milktea-90' );
		}
	}
	return $new_columns;
}
add_filter( 'manage_edit-product_columns', 'faryita_product_order_column' );

function faryita_product_order_column_content( $column, $post_id ) {
	if ( 'fy_order' === $column ) {
		printf(
			'<input type="number" class="fy-order-input" data-id="%1$d" value="%2$d" style="width:60px;text-align:center">',
			(int) $post_id,
			(int) get_post_field( 'menu_order', $post_id )
		);
	}
}
add_action( 'manage_product_posts_custom_column', 'faryita_product_order_column_content', 10, 2 );

/**
 * Cho phép sửa "Thứ tự" ngay trong ô số ở danh sách sản phẩm - gõ số mới rồi bấm ra
 * ngoài ô (blur) là tự lưu qua AJAX, không cần mở Quick Edit hay bấm nút Cập nhật.
 */
function faryita_product_order_inline_script() {
	if ( 'product' !== ( $_GET['post_type'] ?? '' ) ) {
		return;
	}
	$nonce = wp_create_nonce( 'fy_save_menu_order' );
	?>
	<style>.column-fy_order{width:80px !important;text-align:center}.fy-order-input.fy-saved{background:#e6f6ea}</style>
	<script>
	document.addEventListener('DOMContentLoaded', function () {
		document.querySelectorAll('.fy-order-input').forEach(function (input) {
			input.addEventListener('change', function () {
				var data = new URLSearchParams();
				data.append('action', 'fy_save_menu_order');
				data.append('nonce', '<?php echo esc_js( $nonce ); ?>');
				data.append('post_id', input.dataset.id);
				data.append('menu_order', input.value);
				fetch(ajaxurl, { method: 'POST', credentials: 'same-origin', body: data })
					.then(function (r) { return r.json(); })
					.then(function (res) {
						if (res && res.success) {
							input.classList.add('fy-saved');
							setTimeout(function () { input.classList.remove('fy-saved'); }, 1000);
						}
					});
			});
		});
	});
	</script>
	<?php
}
add_action( 'admin_footer-edit.php', 'faryita_product_order_inline_script' );

function faryita_ajax_save_menu_order() {
	check_ajax_referer( 'fy_save_menu_order', 'nonce' );
	if ( ! current_user_can( 'edit_products' ) ) {
		wp_send_json_error( 'no_permission' );
	}
	$post_id = (int) ( $_POST['post_id'] ?? 0 );
	$order   = (int) ( $_POST['menu_order'] ?? 0 );
	if ( ! $post_id || 'product' !== get_post_type( $post_id ) ) {
		wp_send_json_error( 'invalid_post' );
	}
	wp_update_post( array( 'ID' => $post_id, 'menu_order' => $order ) );
	wp_send_json_success();
}
add_action( 'wp_ajax_fy_save_menu_order', 'faryita_ajax_save_menu_order' );

function faryita_product_order_sortable_column( $columns ) {
	$columns['fy_order'] = 'menu_order';
	return $columns;
}
add_filter( 'manage_edit-product_sortable_columns', 'faryita_product_order_sortable_column' );

function faryita_product_order_column_css() {
	$screen = get_current_screen();
	if ( ! $screen || 'edit-product' !== $screen->id ) {
		return;
	}
	echo '<style>.column-fy_order{width:70px !important;text-align:center}.fy-menu-order{font-weight:700}</style>';
}
add_action( 'admin_head', 'faryita_product_order_column_css' );

function faryita_product_order_default_sort( $query ) {
	if ( ! is_admin() || ! $query->is_main_query() ) {
		return;
	}
	if ( 'product' !== $query->get( 'post_type' ) ) {
		return;
	}
	if ( ! $query->get( 'orderby' ) ) {
		$query->set( 'orderby', 'menu_order title' );
		$query->set( 'order', 'ASC' );
	}
}
add_action( 'pre_get_posts', 'faryita_product_order_default_sort' );
add_action( 'admin_post_fy_export_contacts', 'faryita_export_contacts' );

/************************************************************************************/

/**
 * Công tắc chế độ bảo trì — checkbox trong Cài đặt > Tổng quan. Khi bật, khách (chưa
 * đăng nhập hoặc không có quyền quản trị) sẽ thấy trang "Đang bảo trì" thay vì site thật;
 * admin vẫn xem/test bình thường.
 */
function faryita_maintenance_setting_init() {
	register_setting( 'general', 'fy_maintenance_mode', array(
		'type'              => 'boolean',
		'default'           => false,
		'sanitize_callback' => 'rest_sanitize_boolean',
	) );
	add_settings_field(
		'fy_maintenance_mode',
		'Chế độ bảo trì',
		'faryita_maintenance_setting_field',
		'general'
	);
}
add_action( 'admin_init', 'faryita_maintenance_setting_init' );

function faryita_maintenance_setting_field() {
	?>
	<label>
		<input type="checkbox" name="fy_maintenance_mode" value="1" <?php checked( get_option( 'fy_maintenance_mode' ), 1 ); ?>>
		Bật chế độ bảo trì (khách sẽ thấy trang "Đang bảo trì", quản trị viên vẫn xem được site bình thường)
	</label>
	<?php
}

function faryita_maintenance_mode_redirect() {
	if ( ! get_option( 'fy_maintenance_mode' ) ) {
		return;
	}
	if ( current_user_can( 'manage_options' ) ) {
		return;
	}
	// template_redirect không chạy trên wp-login.php/wp-admin nên admin luôn đăng nhập được.
	nocache_headers();
	header( 'HTTP/1.1 503 Service Temporarily Unavailable' );
	header( 'Retry-After: 3600' );
	header( 'Content-Type: text/html; charset=utf-8' );
	// Banner "Trà Sữa DIEM 10" — dùng làm ảnh nền toàn màn hình cho trang bảo trì (tự dựng
	// trang HTML riêng thay vì wp_die() mặc định để ảnh nền phủ hết viewport, không bị
	// khung #error-page của WP core bó lại).
	$fy_maint_banner = get_template_directory_uri() . '/assets/images/brand/shop-banner.jpg';
	?>
	<!DOCTYPE html>
	<html lang="vi">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Đang bảo trì — Trà Sữa DIEM 10</title>
		<style>
			html,body{margin:0;padding:0;min-height:100%;font-family:-apple-system,'Segoe UI',Roboto,Arial,sans-serif}
			.fy-maint{min-height:100vh;display:flex;align-items:center;justify-content:center;padding:24px;box-sizing:border-box;
				background:linear-gradient(rgba(15,50,34,.6),rgba(15,50,34,.6)),url('<?php echo esc_url( $fy_maint_banner ); ?>') center/cover no-repeat;}
			.fy-maint-card{background:rgba(255,255,255,.95);border-radius:20px;padding:48px 40px;max-width:480px;text-align:center;box-shadow:0 20px 50px rgba(0,0,0,.3)}
			.fy-maint-card h1{font-size:26px;color:#173226;margin:0 0 14px}
			.fy-maint-card p{font-size:16px;color:#555;margin:0;line-height:1.6}
		</style>
	</head>
	<body>
		<div class="fy-maint">
			<div class="fy-maint-card">
				<h1>Website đang bảo trì</h1>
				<p>Chúng tôi đang cập nhật để mang lại trải nghiệm tốt hơn. Vui lòng quay lại sau nhé!</p>
			</div>
		</div>
	</body>
	</html>
	<?php
	exit;
}
add_action( 'template_redirect', 'faryita_maintenance_mode_redirect' );

/************************************************************************************/

/**
 * Shortcode cho các cột footer (Thương hiệu / Thông tin liên hệ / Cửa Hàng) — dùng trong
 * widget "Custom HTML" ở Appearance > Widgets > Footer 1 / Footer 2 / Footer 3. Đọc cùng
 * theme_mod mà trang Liên Hệ đang dùng nên khi client cập nhật SĐT/email/địa chỉ qua
 * Customizer, footer tự cập nhật theo.
 */

/**
 * Cột 1 (Footer 1): giới thiệu ngắn + pháp nhân công ty trên 2 dòng (tên công ty / MST).
 * Địa chỉ đã chuyển sang cột "Thông Tin Liên Hệ" theo yêu cầu client 08/2026.
 */
function faryita_footer_brand_shortcode() {
	ob_start();
	?>
	<p>Trà Sữa DIEM 10 — Đậm vị trà, ngọt vị yêu thương.</p>
	<p class="fy-footer-legal">
		CÔNG TY TNHH QUẢN LÝ ẨM THỰC DIEM10<br>
		MST: 0319552502
	</p>
	<?php
	return ob_get_clean();
}
add_shortcode( 'fy_footer_brand', 'faryita_footer_brand_shortcode' );

function faryita_footer_contact_shortcode() {
	$phone   = get_theme_mod( 'fy_store_phone', '0973285017' );
	$email   = get_theme_mod( 'fy_store_email', 'lienhe@trasuadiem10.com' );
	$address = get_theme_mod( 'fy_store_address', '366 Nguyễn Trãi, P. An Đông, TP. Hồ Chí Minh' );
	ob_start();
	?>
	<h2 class="widget-title">Liên Hệ</h2>
	<p>
		<i class="fas fa-phone-alt" aria-hidden="true"></i>
		<a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a>
	</p>
	<p>
		<i class="fas fa-envelope" aria-hidden="true"></i>
		<a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a>
	</p>
	<?php if ( $address ) : ?>
	<p>
		<i class="fas fa-map-marker-alt" aria-hidden="true"></i>
		<?php echo esc_html( $address ); ?>
	</p>
	<?php endif; ?>
	<p><a href="<?php echo esc_url( home_url( '/lien-he/' ) ); ?>">Gửi liên hệ →</a></p>
	<?php
	return ob_get_clean();
}
add_shortcode( 'fy_footer_contact', 'faryita_footer_contact_shortcode' );

function faryita_footer_store_shortcode() {
	ob_start();
	?>
	<h2 class="widget-title">Cửa Hàng</h2>
	<p>Trà Sữa DIEM10 hiện có mặt tại nhiều tỉnh thành trên cả nước.</p>
	<p><a href="<?php echo esc_url( home_url( '/cua-hang/' ) ); ?>">Xem tất cả chi nhánh →</a></p>
	<?php
	return ob_get_clean();
}
add_shortcode( 'fy_footer_store', 'faryita_footer_store_shortcode' );

/**
 * Loại bỏ chức năng bình luận trên bài viết (Tin Tức) — đóng comment ở mọi nơi, không chỉ
 * ẩn ở template single.php, để không ai gửi được bình luận qua wp-comments-post.php.
 */
function faryita_disable_post_comments_support() {
	remove_post_type_support( 'post', 'comments' );
	remove_post_type_support( 'post', 'trackbacks' );
}
add_action( 'init', 'faryita_disable_post_comments_support', 100 );
add_filter( 'comments_open', '__return_false', 20 );
add_filter( 'pings_open', '__return_false', 20 );
add_filter( 'comments_array', '__return_empty_array', 10 );

function faryita_remove_comments_admin_menu() {
	remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'faryita_remove_comments_admin_menu' );

function faryita_remove_comments_admin_bar_node( $wp_admin_bar ) {
	$wp_admin_bar->remove_node( 'comments' );
}
add_action( 'admin_bar_menu', 'faryita_remove_comments_admin_bar_node', 999 );

/**
 * Tab lọc danh mục trên trang Sản Phẩm (trang Shop WooCommerce) — cho khách bấm chuyển
 * giữa Tất Cả / Trà Trái Cây / Trà Sữa / Topping ngay trên /san-pham/ (lọc qua query string
 * ?fy_cat=<slug>, không rời sang URL danh mục riêng), vẫn giữ phân trang 9 sản phẩm/trang.
 */
function faryita_shop_cat_tabs() {
	return array(
		'tra-trai-cay' => 'Trà Trái Cây',
		'tra-sua'      => 'Trà Sữa',
		'topping'      => 'Topping',
	);
}

function faryita_filter_shop_query_by_tab( $q ) {
	if ( ! is_shop() || ! $q->is_main_query() ) {
		return;
	}
	$fy_cat = isset( $_GET['fy_cat'] ) ? sanitize_title( wp_unslash( $_GET['fy_cat'] ) ) : '';
	if ( $fy_cat && array_key_exists( $fy_cat, faryita_shop_cat_tabs() ) ) {
		$q->set( 'product_cat', $fy_cat );
	}
}
add_action( 'woocommerce_product_query', 'faryita_filter_shop_query_by_tab' );

function faryita_render_shop_cat_tabs() {
	if ( ! is_shop() ) {
		return;
	}
	$fy_active = isset( $_GET['fy_cat'] ) ? sanitize_title( wp_unslash( $_GET['fy_cat'] ) ) : '';
	$fy_tabs   = faryita_shop_cat_tabs();
	$fy_base   = get_permalink( wc_get_page_id( 'shop' ) );
	?>
	<section class="fy-home fy-shop-cats">
		<div class="fy-container">
			<div class="fy-tabs fy-shop-tabs" role="tablist">
				<a href="<?php echo esc_url( $fy_base ); ?>" class="fy-tab-btn<?php echo '' === $fy_active ? ' is-active' : ''; ?>">Tất Cả</a>
				<?php foreach ( $fy_tabs as $fy_slug => $fy_label ) : ?>
					<a href="<?php echo esc_url( add_query_arg( 'fy_cat', $fy_slug, $fy_base ) ); ?>" class="fy-tab-btn<?php echo $fy_active === $fy_slug ? ' is-active' : ''; ?>"><?php echo esc_html( $fy_label ); ?></a>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php
}
