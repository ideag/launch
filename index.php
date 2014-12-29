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
				<span<?php echo get_theme_mod( 'logo' )?' class="logo"':''; ?>><?php echo get_theme_mod( 'name' ); ?></span>
			</div>
			<!-- Status: Change the numbers below to reflect your project status. -->
			<div class="status" style="width: <?php echo get_theme_mod( 'percent' ); ?>%;">
				<span><?php echo get_theme_mod( 'percent' ); ?>%</span>
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

<<<<<<< HEAD
			</div>
		</div>
		<?php wp_footer(); ?>
	</body>
</html>
=======
        <!-- Intro: Your intro text and MailChimp form. -->
        <div class="row" id="intro">
            <div class="content">

                <div id="pre-subscribe">
                    <div class="row" id="copy">
                        <h1>Some say, I build <strong>WordPress</strong> plugins with <strong>character</strong>.</h1>
                        <p>Check them out while I am building out this site.<br/>
                            <a href="http://arunas.co/gust" target="_blank">Gust</a>, 
                            <a href="http://arunas.co/tinycoffee" target="_blank">tinyCoffee</a>, 
                            <a href="http://arunas.co/tinyrelated" target="_blank">tinyRelated</a>, 
                            <a href="http://arunas.co/tinytoc" target="_blank">tinyTOC</a> and 
                            <a href="http://arunas.co/tinyip" target="_blank">tinyIP</a>
                        </p>
                        <p>I can build a plugin for you, too - just drop me a note via contacts below.</p>
                    </div>
<!--
                    <div class="row" id="subscribe">
                        <?php //the_tn_subscribe_form(2); ?>
                    </div>-->
                </div>
<!--
                <div id="post-subscribe">
                    <div class="row" id="copy">
                        <h1>Thanks for <strong>signing up</strong>. Check your email to <strong>confirm</strong> your subscription.</h1>
                    </div>
                </div>
-->
                <div class="row" id="social">
                    <a class="icon twitter" href="http://twitter.com/arunaswp"></a>
                    <a class="icon email" href="mailto:ask@aruno.lt"></a>
                    <a class="icon github" href="http://github.com/ideag"></a>
                </div>
            </div>
        </div>

        <!-- Required Scripts: Not too much needed for Launch. -->
        <script src="http://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
        <script src="<?php _t( 'assets/scripts/main.js' ); ?>"></script>
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
          ga('create', 'UA-5023255-26', 'auto');
          ga('send', 'pageview');
        </script>
    </body>
</html>
>>>>>>> 81c9cb57dc253926c669f7dfa8887a8a784e584f
