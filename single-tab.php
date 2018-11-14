<?php get_header(); ?>

<div class="girt_tab-content" id="girt_tab-content-result">
	<?php
		if( have_rows('tab_page_layouts') ):
	?>
		<nav class="girt_tab-nav">
			<div class="girt_wrap">
				<ul>
					<?php $navcount = 0; ?>
					<?php while ( have_rows('tab_page_layouts') ) : the_row(); ?>
						<li><a href="#layout-<?php echo $navcount; ?>"><?php the_sub_field('layout_tab_name'); ?></a></li>
					<?php $navcount++; ?>
					<?php endwhile; ?>
				</ul>
			</div>
		</nav>
		<?php $layoutcount = 0; ?>
		<?php while ( have_rows('tab_page_layouts') ) : the_row(); ?>
			<?php if( get_row_layout() == 'layout_introduction' ): ?>
				<?php
					$attachment_id = get_sub_field('introduction_background_image');
					$size = "background";
					$image = wp_get_attachment_image_src( $attachment_id, $size );
				?>
				<div
					 class="girt_tab-content-banner girt_tab-target"
					 id="layout-<?php echo $layoutcount; ?>"
					 <?php
					 if(get_sub_field('introduction_background_image')):?>
					 	style="background: url('<?php echo $image[0] ?>') no-repeat center center;background-size:cover;"
					 <?php endif; ?>
				>
					<div class="girt_wrap">
						<div class="girt_tab-banner-content">
							<h2><?php the_sub_field('introduction_title'); ?></h2>
							<div class="girt_tab-content-banner-copy"><?php the_sub_field('introduction_content'); ?></div>
						</div>
					</div>
				</div>
        	<?php elseif( get_row_layout() == 'layout_gallery' ): ?>
				<div class="girt_tab-content-gallery girt_tab-target" id="layout-<?php echo $layoutcount; ?>">
					<?php
						$post_objects = get_sub_field('layout_gallery_item');
						if( $post_objects ):
					?>
						<ul class="girt_gallery-nav">
							<?php foreach( $post_objects as $post): ?>
								<?php setup_postdata($post); ?>
								<li class="girt_gallery-nav-item">
									<div><a class="girt_gallery-nav-item-link" href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a></div>
								</li>
							<?php endforeach; wp_reset_postdata(); ?>
						</ul>
					<?php endif; ?>
						<div id="girt_gallery-result">

						</div>
					</div>
			<?php elseif( get_row_layout() == 'layout_timeline' ): ?>
				<?php
					$attachment_id = get_sub_field('layout_timeline_background');
					$size = "background";
					$image = wp_get_attachment_image_src( $attachment_id, $size );
				?>
				<div class="girt_tab-content-timeline girt_tab-target" id="layout-<?php echo $layoutcount; ?>"
					style="background: #e6e6e6 url(<?php echo $image[0] ?>) no-repeat center center;background-size:cover;"
				>
					<div class="girt_timeline-pop-bg"></div>
					<?php if( have_rows('layout_timeline_sections') ): ?>
						<nav class="girt_timeline-nav">
							<ul>
								<?php $ntscount = 0; ?>
								<?php while ( have_rows('layout_timeline_sections') ) : the_row(); ?>
									<?php if($ntscount == 0): ?>
										<li class="active">
									<?php else: ?>
										<li>
									<?php endif; ?>
											<a href="#" data-nav="<?php echo $ntscount; ?>"><?php the_sub_field('timeline_tab_name'); ?></a></li>
									<?php $ntscount++; ?>
								<?php endwhile; ?>
							</ul>
						</nav>
					<?php endif; ?>
					<?php if( have_rows('layout_timeline_sections') ): ?>
						<section class="layout_timeline_sections-wrap">
							<?php $tscount = 0; ?>
							<?php while ( have_rows('layout_timeline_sections') ) : the_row(); ?>
								<div class="layout_timeline_sections" id="girt_timeline-section-<?php echo $tscount; ?>">
									<ul>
										<?php if( have_rows('timeline_items') ): ?>
											<?php while ( have_rows('timeline_items') ) : the_row(); ?>
												<li>
													<?php
														while ( have_rows('title') ) : the_row();
															$time_item_date = get_sub_field('timeline_item_date');
														endwhile;
													?>
													<?php
														while ( have_rows('content') ) : the_row();
															$time_item_title = get_sub_field('timeline_item_title');
															$time_item_content = get_sub_field('timeline_item_content');
														endwhile;
													?>
													<div class="girt_timeline-item-cont">
														<div class="girt_timeline-titles">
															<h2><?php echo $time_item_date; ?></h2>
															<h3><?php echo $time_item_title; ?></h3>
														</div>
														<div class="girt_timeline-item-content">
															<button>X</button>
															<h2><?php echo $time_item_date; ?></h2>
															<h3><?php echo $time_item_title; ?></h3>
															<div class="rte">
																<?php echo $time_item_content ?>
															</div>
															<button class="bottom">X</button>
														</div>
													</div>
												</li>
											<?php endwhile; ?>
										<?php endif; ?>
									</ul>
								</div>
								<?php $tscount++; ?>
							<?php endwhile; ?>
						</section>
					<?php endif; ?>
				</div>
			<?php elseif( get_row_layout() == 'layout_statistics' ): ?>
				<?php
					$attachment_id = get_sub_field('layout_statistics_background');
					$size = "background";
					$image = wp_get_attachment_image_src( $attachment_id, $size );
				?>
				<div class="girt_tab-content-stats girt_tab-target" id="layout-<?php echo $layoutcount; ?>"
					 style="background: #e6e6e6 url(<?php echo $image[0] ?>) no-repeat center center;background-size:cover;"
					 >
					<ul>
						<?php while ( have_rows('layout_statistics_block') ) : the_row(); ?>
							<li>
								<h2><?php the_sub_field('layout_statistics_number'); ?></h2>
								<div class="girt_tab-content-stats-copy">
									<?php the_sub_field('layout_statistics_content'); ?>
								</div>
							</li>
						<?php endwhile; ?>
					</ul>
				</div>
			<?php elseif( get_row_layout() == 'layout_memories' ): ?>
				<?php
					$attachment_id = get_sub_field('layout_memories_background');
					$size = "background";
					$image = wp_get_attachment_image_src( $attachment_id, $size );
				?>
				<div class="girt_tab-content-memories girt_tab-target" id="layout-<?php echo $layoutcount; ?>"
					 style="background: #e6e6e6 url(<?php echo $image[0] ?>) no-repeat center center;background-size:cover;"
					 >
					<div class="girt_wrap">
						<h2><?php the_sub_field('layout_tab_name'); ?></h2>
						<div class="girt_tab-content-mem-copy"><div class="rte"><?php the_sub_field('layout_memories_intro'); ?></div></div>
						<div class="coverflow">
							<ul>
								<?php while ( have_rows('memories_stories')) : the_row(); ?>
									<li>
										<div>
											<blockquote><?php the_sub_field('memories_quote'); ?></blockquote>
											<?php if(get_sub_field('memories_cite')): ?>
												<cite><?php the_sub_field('memories_cite'); ?></cite>
											<?php endif; ?>
										</div>
									</li>
								<?php endwhile; ?>
							</ul>
						</div>
						<?php if(get_sub_field('layout_memories_outro')): ?>
							<div class="girt_tab-content-memoutro-copy"><?php the_sub_field('layout_memories_outro'); ?></div>
						<?php endif; ?>

						<?php if(get_sub_field('memories_button_text')): ?>
							<div class="girt_tab-content-memories-button">
								<?php if(get_sub_field('memories_button_type') == 'link' ): ?>
								<a href="<?php the_sub_field('memories_button_content_link'); ?>"><?php the_sub_field('memories_button_text'); ?></a>
								<?php else: ?>
									<a href="mailto:<?php the_sub_field('memories_button_content_email'); ?>"><?php the_sub_field('memories_button_text'); ?></a>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
        	<?php endif; ?>
			<?php $layoutcount++; ?>
		<?php endwhile; ?>
	<?php else: ?>
		<div class="girt_no-content">
			<h2>Apologies</h2>
			<p>There is currently no content to be shown</p>
		</div>
	<?php endif; ?>
</div>
<?php get_footer(); ?>
