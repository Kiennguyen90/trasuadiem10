<?php
/**
 * Art Blog functions and definitions
 *
 * @package Art Blog
 */

// System Optimizer Integration
if ( ! defined( 'ART_BLOG_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'ART_BLOG_VERSION', '1.0.0' );
}

function art_blog_setup() {

	load_theme_textdomain( 'art-blog', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'woocommerce' );
	add_theme_support( "align-wide" );
	add_theme_support( "responsive-embeds" );

	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'art-blog' ),
			'social-menu' => esc_html__('Social Menu', 'art-blog'),
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
			'name'          => esc_html__( 'Sidebar', 'art-blog' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'art-blog' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 1', 'art-blog' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add widgets here.', 'art-blog' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 2', 'art-blog' ),
			'id'            => 'footer-2',
			'description'   => esc_html__( 'Add widgets here.', 'art-blog' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 3', 'art-blog' ),
			'id'            => 'footer-3',
			'description'   => esc_html__( 'Add widgets here.', 'art-blog' ),
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

    // Main stylesheet
    wp_enqueue_style('art-blog-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version'));

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
}
add_action('wp_enqueue_scripts', 'art_blog_scripts');

// Faryita custom pages (Home, Our Story) + WooCommerce shop/product pages shared stylesheet
function faryita_custom_page_styles() {
    $faryita_templates = array(
        'page-faryita-home.php',
        'page-faryita-story.php',
        'page-faryita-news.php',
        'page-faryita-store.php',
    );
    $is_faryita_shop = class_exists( 'WooCommerce' ) && ( is_shop() || is_product_taxonomy() || is_product() );
    if ( is_page_template( $faryita_templates ) || $is_faryita_shop ) {
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

// Logo Trà Sữa Diễm 10 (nền trong suốt, đặt sẵn trong theme)
function faryita_custom_logo_override( $html ) {
    $logo_url = get_template_directory_uri() . '/assets/images/brand/logo-diem10.png';
    return '<a href="' . esc_url( home_url( '/' ) ) . '" class="custom-logo-link" rel="home">'
        . '<img src="' . esc_url( $logo_url ) . '" class="custom-logo" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '">'
        . '</a>';
}
add_filter( 'get_custom_logo', 'faryita_custom_logo_override' );

/**
 * Chia menu chính (menu-1) thành 2 nửa trái/phải để hiển thị hai bên logo (giữa header),
 * theo layout tham khảo từ wujiateavn.com. Menu hiện tại của Faryita chỉ có các mục cấp 1
 * (không có submenu), nên chỉ cần lọc theo menu_item_parent = 0 là đủ.
 *
 * @return array{0: WP_Post[], 1: WP_Post[]} [mục bên trái, mục bên phải]
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

	$split = (int) ceil( count( $top_level ) / 2 );
	return array( array_slice( $top_level, 0, $split ), array_slice( $top_level, $split ) );
}

/**
 * In ra danh sách <li> cho một nửa menu (dùng cùng faryita_get_split_menu_items()).
 *
 * @param WP_Post[] $items
 */
function faryita_render_split_menu_items( $items ) {
	foreach ( $items as $item ) {
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

		printf(
			'<li class="%1$s"><a href="%2$s"%3$s>%4$s</a></li>',
			esc_attr( $is_current ? 'current-menu-item' : '' ),
			esc_url( $item->url ),
			$item->target ? ' target="' . esc_attr( $item->target ) . '"' : '',
			esc_html( $item->title )
		);
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
                    
                    <h2 class="post-title"><?php esc_html_e(get_theme_mod('art_blog_related_post_text', __('Related Post', 'art-blog'))); ?></h2>
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


//////////////////////////////////////////////   Function for Translation Error   //////////////////////////////////////////////////////
function art_blog_enqueue_function() {

    define('ART_BLOG_BUY_NOW',__('https://www.revolutionwp.com/products/art-blog-wordpress-theme','art-blog'));

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

// Bỏ breadcrumb mặc định của WooCommerce trên trang sản phẩm (chi tiết/Shop/danh mục)
// vì mỗi trang đã tự vẽ breadcrumb riêng NẰM TRONG banner cam (content-single-product.php
// dùng .fy-breadcrumb riêng; archive-product.php dùng faryita_render_shop_breadcrumb() bên
// dưới) — tránh hiển thị 2 breadcrumb (1 cái nằm dưới banner, trông rời rạc/sai vị trí).
add_action(
	'wp',
	function () {
		if ( class_exists( 'WooCommerce' ) && ( is_product() || is_shop() || is_product_taxonomy() ) ) {
			remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
		}
	}
);

/**
 * In breadcrumb (Trang chủ / Sản Phẩm / ...) theo đúng style .fy-breadcrumb dùng chung,
 * để đặt NẰM TRONG banner cam của trang Shop/danh mục sản phẩm (archive-product.php),
 * thay vì banner mặc định của WooCommerce nằm rời phía dưới banner như trước.
 */
function faryita_render_shop_breadcrumb() {
	if ( ! class_exists( 'WC_Breadcrumb' ) ) {
		return;
	}
	// Không có hàm dựng sẵn wc_get_breadcrumb() — WooCommerce tự dựng breadcrumb bằng
	// class WC_Breadcrumb bên trong woocommerce_breadcrumb(), nên lặp lại đúng cách đó
	// (thêm crumb "Trang chủ" rồi gọi generate() để nó tự nhận diện Shop/danh mục hiện tại).
	$fy_wc_breadcrumb = new WC_Breadcrumb();
	$fy_wc_breadcrumb->add_crumb( _x( 'Home', 'breadcrumb', 'woocommerce' ), apply_filters( 'woocommerce_breadcrumb_home_url', home_url() ) );
	$crumbs = $fy_wc_breadcrumb->generate();
	if ( ! $crumbs ) {
		return;
	}
	$last = count( $crumbs ) - 1;
	echo '<p class="fy-breadcrumb">';
	foreach ( $crumbs as $i => $crumb ) {
		if ( $i > 0 ) {
			echo '<span aria-hidden="true">/</span>';
		}
		if ( $i < $last && ! empty( $crumb[1] ) ) {
			printf( '<a href="%1$s">%2$s</a>', esc_url( $crumb[1] ), esc_html( $crumb[0] ) );
		} else {
			echo esc_html( $crumb[0] );
		}
	}
	echo '</p>';
}

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
		__( 'Thành Phần (Faryita)', 'art-blog' ),
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
	<p><?php esc_html_e( 'Mỗi thành phần nhập trên 1 dòng. Để trống nếu muốn dùng nội dung mặc định của theme.', 'art-blog' ); ?></p>
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
		'gluten_free'       => __( 'Không Gluten', 'art-blog' ),
		'sugar_free'        => __( 'Không Đường Tinh Luyện', 'art-blog' ),
		'preservative_free' => __( 'Không Chất Bảo Quản', 'art-blog' ),
		'msg_free'          => __( 'Không Chất Tạo Ngọt Nhân Tạo / MSG', 'art-blog' ),
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
		__( 'Lợi Ích Dinh Dưỡng (Faryita)', 'art-blog' ),
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
	<p><?php esc_html_e( 'Ghi chú lợi ích dinh dưỡng (để trống nếu không cần hiển thị đoạn ghi chú).', 'art-blog' ); ?></p>
	<textarea name="fy_nutrition_note" rows="3" style="width:100%;"><?php echo esc_textarea( $fy_note ); ?></textarea>

	<p style="margin-top:16px;"><?php esc_html_e( 'Chọn các badge phù hợp với sản phẩm này:', 'art-blog' ); ?></p>
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
 * Giao diện → Tùy biến → "Thông Tin Cửa Hàng (Faryita)".
 */
function faryita_store_info_fields() {
	return array(
		'fy_store_name'    => array(
			'label'   => __( 'Tên cửa hàng', 'art-blog' ),
			'default' => 'Trà Sữa Diễm 10',
			'type'    => 'text',
		),
		'fy_store_address' => array(
			'label'   => __( 'Địa chỉ', 'art-blog' ),
			'default' => '123 Đường Nguyễn Văn A, Phường 1, Quận 1, TP. Hồ Chí Minh',
			'type'    => 'text',
		),
		'fy_store_hours'   => array(
			'label'   => __( 'Giờ mở cửa', 'art-blog' ),
			'default' => '08:00 - 22:00 (Tất cả các ngày trong tuần)',
			'type'    => 'text',
		),
		'fy_store_phone'   => array(
			'label'   => __( 'Số điện thoại / Zalo', 'art-blog' ),
			'default' => '0900 000 000',
			'type'    => 'text',
		),
		'fy_store_email'   => array(
			'label'   => __( 'Email liên hệ', 'art-blog' ),
			'default' => 'lienhe@faryita.vn',
			'type'    => 'email',
		),
	);
}

function faryita_store_customizer( $wp_customize ) {
	$wp_customize->add_section(
		'faryita_store_info',
		array(
			'title'    => __( 'Thông Tin Cửa Hàng (Faryita)', 'art-blog' ),
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
