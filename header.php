<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#e64349">
<meta name="theme-color" content="#e64349">
<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<header class="girt_global-header">
		<div class="girt_wrap">
			<div class="girt_main-logo">
				<a href="<?php bloginfo('url'); ?>">
					<img src="<?php bloginfo('stylesheet_directory'); ?>/img/logo_test.jpg" alt="<?php bloginfo('title'); ?> logo">
				</a>
			</div>
			<button class="girt_mobile-menu-toggle">
				<span id="nav-icon3">
				  <span></span>
				  <span></span>
				  <span></span>
				  <span></span>
				</span>
			</button>
			<nav class="girt_global-nav">
				<div class="girt_footer-social">
				<ul>
					
					<?php if(get_field('facebook_profile','option')): ?>
						<li>
							<a href="https://<?php the_field('facebook_profile','option'); ?>" target="_blank">
								<span class="fa-stack fa-lg">
								  <i class="fa fa-circle fa-stack-2x"></i>
								  <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
								</span>
							</a>
						</li>
					<?php endif; ?>
					
					<?php if(get_field('twitter_profile','option')): ?>
						<li>
							<a href="https://twitter.com/<?php the_field('twitter_profile','option'); ?>" target="_blank">
								<span class="fa-stack fa-lg">
								  <i class="fa fa-circle fa-stack-2x"></i>
								  <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
								</span>
							</a>
						</li>
					<?php endif; ?>
					
					<?php if(get_field('linkedin_profile','option')): ?>
						<li>
							<a href="https://<?php the_field('linkedin_profile','option'); ?>" target="_blank">
								<span class="fa-stack fa-lg">
								  <i class="fa fa-circle fa-stack-2x"></i>
								  <i class="fa fa-linkedin fa-stack-1x fa-inverse"></i>
								</span>
							</a>
						</li>
					<?php endif; ?>
					<?php if(get_field('instagram_profile','option')): ?>
						<li>
							<a href="https://<?php the_field('instagram_profile','option'); ?>" target="_blank">
								<span class="fa-stack fa-lg">
								  <i class="fa fa-circle fa-stack-2x"></i>
								  <i class="fa fa-instagram fa-stack-1x fa-inverse"></i>
								</span>
							</a>
						</li>
					<?php endif; ?>
					<li>
						<a class="girt_header-donate-button" href="//<?php the_field('donate_button_link','option'); ?>" target="_blank"><?php the_field('donate_button_text','option'); ?></a>
					</li>
				</ul>
			</div>
				<ul><?php wp_nav_menu( array('theme_location' => 'main_menu' )); ?></ul>
			</nav>
		</div>
	</header>