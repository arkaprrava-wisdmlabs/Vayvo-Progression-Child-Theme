<?php
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
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

	<?php do_action( 'woocommerce_before_main_content' ); ?>
	
	<?php
	$your_shop_page = get_post( wc_get_page_id( 'shop' ) );
	if ( apply_filters( 'woocommerce_show_page_title', true ) && $your_shop_page  ) : ?>
		<div id="page-title-pro">
				<div id="progression-studios-page-title-container">
					<div class="width-container-pro">
					<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
					<?php if(get_post_meta($your_shop_page->ID, 'progression_studios_sub_title', true)): ?><h4 class="progression-sub-title"><?php echo esc_html( get_post_meta($your_shop_page->ID, 'progression_studios_sub_title', true) );?></h4><?php endif; ?>
					</div><!-- close .width-container-pro -->
				</div><!-- close #progression-studios-page-title-container -->
				<div class="clearfix-pro"></div>
				<div id="page-title-overlay-image"></div>
		</div><!-- #page-title-pro -->
		<?php else: ?>
			<div id="page-title-pro">
				<div id="progression-studios-page-title-container">
					<div class="width-container-pro">
						<h1 class="page-title"><?php esc_html_e( 'Shop', 'vayvo-progression' ); ?></h1>
					</div><!-- #progression-studios-page-title-container -->
					<div class="clearfix-pro"></div>
				</div><!-- close .width-container-pro -->
				<div id="page-title-overlay-image"></div>
			</div><!-- #page-title-pro -->
	<?php endif; ?>
	
	<div id="content-pro">
		
			<?php while ( have_posts() ) : the_post(); ?>

				<?php wc_get_template_part( 'content', 'single-product' ); ?>

			<?php endwhile; // end of the loop. ?>	

			<?php do_action( 'woocommerce_after_main_content' ); ?>
		

	</div><!-- #content-pro -->

<?php get_footer( 'shop' );
/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */