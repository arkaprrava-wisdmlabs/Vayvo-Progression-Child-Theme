<?php
/**
 * The Header for our theme.
 *
 * @package pro
 * @since pro 1.0
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-NV0HY4G0NJ"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-NV0HY4G0NJ');
</script>
</head>
<body <?php body_class(); ?>>
	<?php get_template_part( 'header/page', 'loader' ); ?>
	<div id="boxed-layout-pro" <?php progression_studios_page_title(); ?>>
		
		<div id="progression-studios-header-position">
		
		<div id="progression-studios-header-width">
				
				
				
				<?php if ( is_page() && is_page_template('page-landing.php') ) : ?>
					<?php get_template_part( 'header/landing', 'header' ); ?>
				<?php else: ?>
					
					<?php if (get_theme_mod( 'progression_studios_header_sticky', 'sticky-pro' ) == 'sticky-pro') : ?><div id="progression-sticky-header"><?php endif; ?>
					<header id="masthead-pro" class="progression-studios-site-header <?php echo esc_attr( get_theme_mod('progression_studios_nav_align', 'progression-studios-nav-left') ); ?>">
							<div id="logo-nav-pro">
						
								<div class="width-container-pro progression-studios-logo-container">
									<h1 id="logo-pro" class="logo-inside-nav-pro noselect"><?php progression_studios_logo(); ?></h1>
									<?php progression_studios_navigation(); ?>
								</div><!-- close .width-container-pro -->
								<?php get_template_part( 'header/search', 'desktop' ); ?>
							</div><!-- close #logo-nav-pro -->
							<?php get_template_part( 'header/mobile', 'navigation' ); ?>
					</header>
					<?php if (get_theme_mod( 'progression_studios_header_sticky', 'sticky-pro' ) == 'sticky-pro' ) : ?></div><!-- close #progression-sticky-header --><?php endif; ?>
					
				<?php endif; ?>
				
				
			</div><!-- close #progression-studios-header-width -->
			<div id="progression-studios-header-base-overlay"></div>
		</div><!-- close #progression-studios-header-position -->
