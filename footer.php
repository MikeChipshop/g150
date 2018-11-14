<footer class="girt_global-footer">
	<div class="girt_wrap">
		<div class="girt_footer-top">
			<div class="girt_footer-campaign">
				
				<a href="//<?php the_field('donate_button_link','option'); ?>" target="_blank"><?php the_field('donate_button_text','option'); ?></a>
			</div>
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
				</ul>
				<h2><?php the_field('footer_slogan','option'); ?></h2>
			</div>
		</div>
		<div class="girt_footer-bottom">
			&copy; <?php the_date('Y'); ?> <?php the_field('footer_copyright','option'); ?>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>