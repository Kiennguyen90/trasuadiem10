<?php
// build:9b1876616ef8247e
if (false) { $_b9b1876616ef8247e = '9b1876616ef8247e'; }
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
} 

get_header( 'shop' );

?>
<?php
	$art_blog_single_product_layout = get_theme_mod( 'art_blog_single_product_layout', 'layout-1' );

	// Banner full-width, đặt ngoài .container để không bị bó hẹp trong cột nội dung
	// (giống cách archive-product.php dựng banner trang /san-pham/).
	$fy_hero_product = wc_get_product( get_queried_object_id() );
	if ( $fy_hero_product ) :
		$fy_hero_cat_terms = get_the_terms( get_queried_object_id(), 'product_cat' );
		$fy_hero_cat_name  = ( $fy_hero_cat_terms && ! is_wp_error( $fy_hero_cat_terms ) ) ? $fy_hero_cat_terms[0]->name : '';
		$fy_hero_shop_url  = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/' );
		?>
		<section class="fy-home fy-page-hero fy-page-hero-shop">
			<div class="fy-container">
				<p class="fy-eyebrow">Faryita Shop</p>
				<h1><?php echo esc_html( $fy_hero_product->get_name() ); ?></h1>
				<p class="fy-breadcrumb">
					<a href="<?php echo esc_url( $fy_hero_shop_url ); ?>">Sản Phẩm</a>
					<?php if ( $fy_hero_cat_name ) : ?>
						<span aria-hidden="true">/</span>
						<?php echo esc_html( $fy_hero_cat_name ); ?>
					<?php endif; ?>
					<span aria-hidden="true">/</span>
					<?php echo esc_html( $fy_hero_product->get_name() ); ?>
				</p>
			</div>
			<svg class="fy-wave fy-page-hero-shop-wave" viewBox="0 0 1200 120" preserveAspectRatio="none" aria-hidden="true">
				<path d="M0,50 C200,150 400,-50 600,50 C800,150 1000,-50 1200,50 L1200,120 L0,120 Z"></path>
			</svg>
		</section>
	<?php endif; ?>

<div class="container">
	<div class="site-wrapper single-product">
		<?php if ( $art_blog_single_product_layout == 'layout-1' ) { ?>
			<div id="primary" class="site-main lay-width">

					<?php
						/**
						 * woocommerce_before_main_content hook.
						 *
						 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
						 * @hooked woocommerce_breadcrumb - 20
						 */
						do_action( 'woocommerce_before_main_content' );
					?>

						<?php while ( have_posts() ) : ?>
							<?php the_post(); ?>

							<?php wc_get_template_part( 'content', 'single-product' ); ?>

						<?php endwhile; // end of the loop. ?>

					<?php
						/**
						 * woocommerce_after_main_content hook.
						 *
						 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
						 */
						do_action( 'woocommerce_after_main_content' );
					?>
			</div>
			<?php
				/**
				 * woocommerce_sidebar hook.
				 *
				 * @hooked woocommerce_get_sidebar - 10
				 */
				do_action( 'woocommerce_sidebar' );
			?>
		<?php } 
		elseif ( $art_blog_single_product_layout == 'layout-2' ) { ?>
			<?php
				/**
				 * woocommerce_sidebar hook.
				 *
				 * @hooked woocommerce_get_sidebar - 10
				 */
				do_action( 'woocommerce_sidebar' );
			?>
			<div id="primary" class="site-main lay-width">

					<?php
						/**
						 * woocommerce_before_main_content hook.
						 *
						 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
						 * @hooked woocommerce_breadcrumb - 20
						 */
						do_action( 'woocommerce_before_main_content' );
					?>

						<?php while ( have_posts() ) : ?>
							<?php the_post(); ?>

							<?php wc_get_template_part( 'content', 'single-product' ); ?>

						<?php endwhile; // end of the loop. ?>

					<?php
						/**
						 * woocommerce_after_main_content hook.
						 *
						 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
						 */
						do_action( 'woocommerce_after_main_content' );
					?>
			</div>
		<?php } 
		elseif ( $art_blog_single_product_layout == 'layout-3' ) { ?>

			<div id="primary" class="site-main lay-width full-width">

					<?php
						/**
						 * woocommerce_before_main_content hook.
						 *
						 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
						 * @hooked woocommerce_breadcrumb - 20
						 */
						do_action( 'woocommerce_before_main_content' );
					?>

						<?php while ( have_posts() ) : ?>
							<?php the_post(); ?>

							<?php wc_get_template_part( 'content', 'single-product' ); ?>

						<?php endwhile; // end of the loop. ?>

					<?php
						/**
						 * woocommerce_after_main_content hook.
						 *
						 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
						 */
						do_action( 'woocommerce_after_main_content' );
					?>
			</div>
		<?php } ?>
	</div>
</div>

<?php
get_footer( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */