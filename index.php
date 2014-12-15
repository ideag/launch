<!DOCTYPE html>
<html>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <!-- Title: Change the title and description to suit your needs. -->
        <title><?php echo wp_title(); ?><?php bloginfo( 'title' ); ?></title>
        <!-- Description: Change the title and description to suit your needs. -->
        <meta name="description" content="<?php bloginfo( 'description' ); ?>">
        <!-- Viewport Meta: Just taming mobile devices like iPads and iPhones. -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Google Fonts: The default font for this template. -->
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700' rel='stylesheet' type='text/css'>
        <!-- Styles: The primary styles for this template. -->
        <link rel="stylesheet" href="<?php _t( 'assets/styles/normalize.css' ); ?>">
        <link rel="stylesheet" href="<?php _t( 'assets/styles/main.css' ); ?>">
        <link rel="stylesheet" href="<?php _t( 'assets/styles/mobile.css' ); ?>">
        <link rel="stylesheet" href="<?php _t( 'assets/styles/theme.css' ); ?>">
        <!-- Favicon: Change to whatever you like within the "assets/images" folder. -->
        <link rel="shortcut icon" href="<?php _t( 'assets/images/favicon.ico' ); ?>" type="image/x-icon" />
    </head>
    <body>
        <!-- Header: Your site logo, tagline and project status. -->
        <header class="row" id="header">
            <div class="content">
                <!-- Logo & Tagline: Delete "class="logo"" to remove the logo or upload your own logo to "assets/images". -->
                <span class="logo"> <strong>Arūnas</strong> Liuiza</span>
            </div>
            <!-- Status: Change the numbers below to reflect your project status. -->
            <div class="status" style="width: 10%;">
                <span>10%</span>
            </div>
        </header>

        <!-- Intro: Your intro text and MailChimp form. -->
        <div class="row" id="intro">
            <div class="content">

                <div id="pre-subscribe">
                    <div class="row" id="copy">
                        <h1>Some say, I build <strong>WordPress</strong> plugins with <strong>character</strong>.</h1>
                        <p>Check them out while I am building out this site.<br/>
                            <a href="http://tiny.lt/gust" target="_blank">Gust</a>, 
                            <a href="http://tiny.lt/tinycoffee" target="_blank">tinyCoffee</a>, 
                            <a href="http://tiny.lt/tinyrelated" target="_blank">tinyRelated</a>, 
                            <a href="http://tiny.lt/tinytoc" target="_blank">tinyTOC</a> and 
                            <a href="http://tiny.lt/tinyip" target="_blank">tinyIP</a>
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
