<?php get_header(); ?>
<div id="girt_gallery">
	<div class="girt_gallery-content">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div class="girt_gallery-content-wrap">
				<div class="girt_gallery-content-left">
					<?php if(get_field('gallery_image')): ?>
						<img src="<?php the_field('gallery_image'); ?>" alt="<?php the_title(); ?>">
					<?php endif; ?>
				</div>
				<div class="girt_gallery-content-right">
					<div class="girt_gallery-content-right-wrap">
						<h2><?php the_title(); ?></h2>
						<div class="rte">
							<?php the_content(); ?>
						</div>
						<div class="girt_gallery-content-right-wrap">
							<ul>
								<?php if(get_field('facebook_profile','option')): ?>
									<li>
										<?php
											$permalink = get_permalink();
											$find = array( 'http://', 'https://' );
											$replace = '';
											$output = str_replace( $find, $replace, $permalink );
										?>
										<a href="https://www.facebook.com/sharer/sharer.php?u=http%3A//<?php echo $output ; ?>" target="_blank">
											<span class="fa-stack fa-lg">
											  <i class="fa fa-circle fa-stack-2x"></i>
											  <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
											</span>
										</a>
									</li>
								<?php endif; ?>

								<?php if(get_field('twitter_profile','option')): ?>
									<li>
										<a href="https://twitter.com/home?status=http%3A//<?php echo $output ; ?>" target="_blank">
											<span class="fa-stack fa-lg">
											  <i class="fa fa-circle fa-stack-2x"></i>
											  <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
											</span>
										</a>
									</li>
								<?php endif; ?>

								<?php if(get_field('linkedin_profile','option')): ?>
									<li>
										<a href="https://www.linkedin.com/shareArticle?mini=true&url=http%3A//<?php echo $output ; ?>&title=&summary=<?php the_title(); ?>&source=" target="_blank">
											<span class="fa-stack fa-lg">
											  <i class="fa fa-circle fa-stack-2x"></i>
											  <i class="fa fa-linkedin fa-stack-1x fa-inverse"></i>
											</span>
										</a>
									</li>
								<?php endif; ?>
							</ul>
						</div>
					</div>
				</div>
				<button class="girt_close-gallery-item">Close X</button>
			</div>
		<?php endwhile; endif; ?>
	</div>	
</div>
<?php get_footer(); ?>