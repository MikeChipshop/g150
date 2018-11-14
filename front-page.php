<?php get_header(); ?>

<?php get_template_part( 'module', 'hero' ); ?>
<?php
	$tabargs = array(
		'post_type' => 'tab',
		'posts_per_page'=> -1,
		'orderby'=> 'title',
		'order' => 'ASC'
	);
?>
<?php $tabloop = new WP_Query($tabargs); ?>
<?php if ( $tabloop->have_posts() ) : ?>
	<section class="girt_fp-content-block girt_fp-timeline" id="girt_timeline">
			<h2>Girton College Timeline</h2>
		<ul>
			<?php while ( $tabloop->have_posts() ) : $tabloop->the_post(); ?>
				<li>
					<div class="girt_timeline-container">
						<a data-pjax href="<?php the_permalink(); ?>">
							<h2><?php the_title(); ?></h2>
							<?php $post_thumb = get_the_post_thumbnail_url(get_the_ID(),'full'); ?>
							<div class="girt_timeline-image"
								 style="background:url(<?php echo $post_thumb; ?>) no-repeat center center; background-size:cover;">
								<div class="girt_timeline-overlay"></div>
							</div>
						</a>
					</div>
				</li>
			<?php endwhile; ?>
			<?php wp_reset_postdata();  ?>
		</ul>
		<div id="girt_timeline-anchor"></div>
	</section>
<?php endif; ?>

<section class="girt_tab-content-placeholder">
	<div id="girt_tab-page-container"></div>
</section>
<section class="girt_fp-content-block girt_fp-news" id="girt_latest-news">
	<div class="girt_news-left">
		<div class="girt_fpnews-top-left"><!-- Top Left -->
			<h1>Latest News</h1>

			<?php if( have_rows('latest_news') ): ?>
				<ul>
					<?php while ( have_rows('latest_news') ) : the_row(); ?>
						<li class="girt_news-excerpt">
							<article>
								<div class="girt_news-excerpt-date">
									<div class="girt_date-day"><?php the_sub_field('latest_news_day'); ?></div>
									<div class="girt_date-month"><?php the_sub_field('latest_news_month'); ?></div>
								</div>
								<h2>
									<?php if(get_sub_field('latest_news_link')): ?>
										<a href="<?php the_sub_field('latest_news_link'); ?>" title="Visit" target="_blank">
									<?php endif; ?>
									<?php the_sub_field('latest_news_title'); ?>
									<?php if(get_sub_field('latest_news_link')): ?>
										</a>
									<?php endif; ?>
								</h2>
							</article>
						</li>
					<?php endwhile; wp_reset_postdata(); ?>
				</ul>
			<?php else: ?>
				<div class="girt_no-content">No content found</div>
			<?php endif; ?>
		</div>
		<div class="girt_fpnews-bottom-left"><!-- Bottom Left -->
			<h1>Forthcoming Events</h1>
			<?php
				$today = date('Ymd');
				$eventargs = array(
					'post_type' => 'event',
					'meta_key'	=> 'event_date',
					'orderby'	=> 'meta_value_num',
					'order'		=> 'ASC',
					'posts_per_page' => 4,
            		'paged' => $paged,
					'meta_query' => array(
						 array(
							'key'		=> 'event_date',
							'compare'	=> '>=',
							'value'		=> $today,
						)
					),
				);
			?>
			<?php $eventloop = new WP_Query($eventargs); ?>
			<?php if ( $eventloop->have_posts() ) : ?>
				<ul>
					<?php while ( $eventloop->have_posts() ) : $eventloop->the_post(); ?>
						<li class="girt_news-excerpt">
							<article>
								<?php
									$date = get_field('event_date', false, false);
									$date = new DateTime($date);
								?>
								<div class="girt_news-excerpt-date">
									<div class="girt_date-day"><?php echo $date->format('j'); ?></div>
									<div class="girt_date-month"><?php echo $date->format('M'); ?></div>
								</div>
								<h2>
									<?php if(get_field('event_show_more_button')): ?>
										<?php if(get_field('event_more_link_type') == 'morei'): ?>
											<a href="<?php the_permalink(); ?>">
										<?php else: ?>
											<a href="<?php the_field('more_externall_field'); ?>">
										<?php endif; ?>
											<?php the_title(); ?>
										</a>
									<?php else: ?>
										<?php the_title(); ?>
									<?php endif; ?>
								</h2>
							</article>
						</li>
					<?php endwhile; wp_reset_postdata(); ?>
				</ul>
			<?php else: ?>
				<div class="girt_no-content">No content found</div>
			<?php endif; ?>
		</div>
	</div>
	<div class="girt_news-right">
		<div class="girt_news-right-bottom">
			<article class="girt_news-right-top-right">
				<?php
					$attachment_id = get_field('fp_news_promo_box_image');
					$size = "full";
					$image = wp_get_attachment_image_src( $attachment_id, $size );
				?>
				<div class="girt_box-overlay" style="background:url(<?php echo $image[0] ?>) no-repeat center center;background-size:cover;">
					</div>
					<div class="girt_box-content">
						<h1>
							<?php if(get_field('fp_news_promo_box_link')): ?>
								<a href="<?php the_field('fp_news_promo_box_link'); ?>" target="_blank">
							<?php endif; ?>
								<?php the_field('fp_news_promo_box_title'); ?>
							<?php if(get_field('fp_news_promo_box_link')): ?></a><?php endif; ?>
						</h1>
						<div class="girt_news-promo-content"><?php the_field('fp_news_promo_box_content'); ?></div>
						<?php if(get_field('fp_news_promo_box_link')): ?>
							<a class="girt_news-block-link" href="<?php the_field('fp_news_promo_box_link'); ?>" target="_blank">
								<?php the_field('fp_news_promo_box_button_title'); ?> <span class="fa fa-caret-right" aria-hidden="true"></span>
							</a>
						<?php endif; ?>
					</div>
			</article>
		</div>
	</div>
</section>
<?php get_footer(); ?>
