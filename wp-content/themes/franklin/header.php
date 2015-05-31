<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<title><?php wp_title('|', true, 'right'); ?></title>
    <meta charset="<?php bloginfo('charset'); ?>" />           
    <meta name="viewport" content="width=device-width, initial-scale=1">   
    <link rel="profile" href="http://gmpg.org/xfn/11" />        
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />    
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header role="banner">
	<div id="top-bar" role="navigation">
		<div class="container">
			<div class="row">
				<div id="site-description" class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
					<p><?php bloginfo('description'); ?></p>
				</div>	
				<div class="col-sm-12 col-md-12 col-lg-6">			
					<form id="header-search" role="search" method="get" class="search-form form-inline" action="<?php echo home_url( '/' ); ?>">									
						<input type="search" class="search-field" value="" name="s" />				
						<button type="submit"><span class="glyphicon glyphicon-search"></span></button>
					</form>					
					<?php wp_nav_menu(array('theme_location' => 'secondary','items_wrap' => '<ul>%3$s</ul>','container' => 'false','depth' => 1,'fallback_cb' => 'false')); ?>					
				</div>		
			</div>
		</div>
	</div>
	<div id="bot-bar" class="container">
		<div class="row">
			<div id="logo" class="col-md-12 col-lg-3">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only"><?php _e('Toggle navigation', 'franklin'); ?></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>	
				<?php if (get_theme_mod('franklin_logo_setting')): ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src='<?php echo esc_url(get_theme_mod('franklin_logo_setting')); ?>' alt='<?php echo esc_attr(get_bloginfo('name', 'display')); ?>'></a>
				<?php else:	?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo('name'); ?></a>
				<?php endif; ?>	
			</div>
			<div id="primary-menu" class="col-md-12 col-lg-9" role="navigation">
				<div class="collapse navbar-collapse">
					<?php wp_nav_menu(array('theme_location' => 'primary','depth' => 2,'container' => 'false','fallback_cb' => 'false')); ?>
				</div>
			</div>
		</div>
	</div>
</header>
<div id="content" class="container">