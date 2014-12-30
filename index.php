<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<?php wp_head(); ?>
	</head>
	<body <?php body_class() ?>>
		<!-- Header: Your site logo, tagline and project status. -->
		<header class="row" id="header">
			<div class="content">
				<!-- Logo & Tagline: Delete "class="logo"" to remove the logo or upload your own logo to "assets/images". -->
				<span<?php echo get_theme_mod( 'logo' )?' class="logo"':''; ?>><?php echo get_bloginfo( 'name', 'display' ); ?></span>
			</div>
			<!-- Status: Change the numbers below to reflect your project status. -->
			<div class="status" style="width: <?php echo get_theme_mod( 'percent', launch::$options['percent'] ); ?>%;">
				<span><?php echo get_theme_mod( 'percent', launch::$options['percent'] ); ?>%</span>
			</div>
		</header>
		<div class="row" id="intro">
			<div class="content">
<?php
	// Main loop: heading, text, subscriptipon form
	if ( have_posts() ) :
		while ( have_posts() ) : the_post();
			get_template_part( 'content', 'front' );
		endwhile;
	endif;
	// Social Links Menu
	$args = array(
		'theme_location' => 'social',
		'container' => 'div',
		'container_class' => 'row',
		'container_id' => 'social',
		'echo' => true,
		'fallback_cb' => false,
		'items_wrap' => "\n".'%3$s'."\t\t\t\t",
		'depth' => 1,
		'walker' => new launch_walker()
	);
	$args = apply_filters( 'launch_menu', $args );
	wp_nav_menu( $args );
?>

			</div>
		</div>
		<?php wp_footer(); ?>
	</body>
</html>