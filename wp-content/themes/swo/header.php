<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif|Open+Sans+Condensed:300,700,300italic' rel='stylesheet' type='text/css' />
     <!-- Bootstrap -->
    <link href="<?php bloginfo('template_url'); ?>/css/theme.custom.css" rel="stylesheet" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php wp_enqueue_script( 'theme.functions', get_template_directory_uri() . '/js/theme.functions.js', array( 'jquery' ) ); ?>
    <link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-main">
  <div class="wrapper">
      
    <div class="logo in-bl left">
  		  <?php threza_the_custom_logo(); ?>
  	</div><!-- .site-branding -->
    <nav class="in-bl"> 
        <!-- <ul>
            <li><a href="">Product</a></li>
            <li><a href="">Community</a></li>
            <li><a href="">Contact Us</a></li>
        </ul> -->
        <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
    </nav>

    <div class="login right in-bl">
      <p>Are you a producer? Click below to sign in.</p>
      <button class="login-btn right">Login</button>
    </div>
  </div>
</header>
