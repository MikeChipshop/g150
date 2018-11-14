<?php /* Template Name: Multi Events Landing */ ?>
<?php get_header(); ?>
<?php if(get_field('event_banner_type',24) === "single"): ?>
	<?php if(get_field('event_hero_banner_image',24)): ?>
		<section class="girt_fp-content-block girt_fp-hero event-lists">
			<?php
				$attachment_id = get_field('event_hero_banner_image',24);
				$size = "full";
				$image = wp_get_attachment_image_src( $attachment_id, $size );
			?>
			<img src="<?php echo $image[0] ?>" alt="Girton Events">
			<?php if(get_field('event_hero_banner_image_title',24)): ?>
				<div class="girt_slider-title">
					<h1><?php the_field('event_hero_banner_image_title',24); ?></h1>
				</div>
			<?php endif; ?>
			</div>
		</section>
	<?php endif; ?>

<?php else: ?>

	<section class="girt_fp-content-block girt_fp-hero event-lists">
		<ul id="lightSlider">
			<?php if( have_rows('banner_slider',24) ): ?>
				<?php  while ( have_rows('banner_slider',24) ) : the_row(); ?>
					<li>
						<a href="<?php the_sub_field('event_hero_slider_link'); ?>">
							<?php
								$attachment_id = get_sub_field('event_hero_slider_image');
								$size = "full";
								$image = wp_get_attachment_image_src( $attachment_id, $size );
							?>
							<img src="<?php echo $image[0] ?>" alt="Girton Events">
							<?php if(get_sub_field('event_hero_slider_title')): ?>
								<div class="girt_slider-title">
									<h1><?php the_sub_field('event_hero_slider_title'); ?></h1>
								</div>
							<?php endif; ?>
						</a>
					</li>
				<?php endwhile; ?>
			<?php endif; ?>
		</ul>
	</section>

<?php endif; ?>
<section class="girt_event-landing-wrap">
	<div class="girt_wrap">
		<aside>

			<h1>Filter Events</h1>
			<div class="girt_clear-fields">
				<a href="<?php bloginfo('url'); ?>/events">Clear all fields</a>
			</div>
			
			<div class="girt_event-category-filter active">
				<h2><div>Event Day</div></h2>
				<?php
					$terms = get_terms( array(
						'taxonomy' => 'event-type',
						'hide_empty' => false,
						'parent'   => 0
					) );
				?>
				<ul>
					
					<li><a href="<?php bloginfo('url'); ?>/events/" title="Go to all events">Back To All Events</a></li>
					
						<li>
							<div>
								<input name="friday-check" class="styled-checkbox" id="friday-check" type="checkbox" checked>
								<label for="friday-check">Friday</label>
							</div>
						</li>
						<li>
							<div>
								<input name="saturday-check" class="styled-checkbox" id="saturday-check" type="checkbox" checked>
								<label for="saturday-check">Saturday</label>
							</div>
						</li>
						<li>
							<div>
								<input name="sunday-check" class="styled-checkbox" id="sunday-check" type="checkbox" checked>
								<label for="sunday-check">Sunday</label>
							</div>
						</li>
				</ul>
			</div>
			<div class="girt_event-calendar-filter">
				<h2><div>Events Calendar</div></h2>
				<div class="girt_calendar-wrap">
					<?php echo do_shortcode("[fullcalendar]"); ?>
				</div>
			</div>
		</aside>
		<?php

		?>
		<main>
			<h1>Girton150 Festival Event Listings</h1>
			<div id="response">
			<?php
				$today = date('Ymd');
				$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
				$eventargs = array(
					'post_type' => 'multi',
					'order'				=> 'ASC',
					'orderby'			=> 'meta_value_num',
					'meta_key'			=> 'multi_day_event_start',
					'meta_type'			=> 'DATETIME'
					
				);


			?>
			<?php $eventloop = new WP_Query( $eventargs ); if ( $eventloop->have_posts() ) : ?>
				<ul>
					<?php while ( $eventloop->have_posts() ) : $eventloop->the_post(); ?>
						<li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<div class="girt_event-excerpt-cont">
								<div class="girt_event-list-date">
									<?php
										$date = get_field('multi_day_event_start', false, false);
										$date = new DateTime($date);
									
										$date_end = get_field('multi_day_event_end', false, false);
										$date_end = new DateTime($date_end);
									?>
									<?php if(get_field('multi_day_event_start')): ?>
										<div class="girt_event-list-month"><?php echo $date->format('l'); ?></div>
										<div class="girt_event-list-day"><?php echo $date->format('j'); ?></div>
										<div class="girt_event-list-year"><?php echo $date->format('F Y'); ?></div>
										
										<?php if(get_field('multi_day_event_end')): ?>
											<div class="girt_to">~ to ~</div>
											<div class="girt_event-list-month"><?php echo $date_end->format('l'); ?></div>
											<div class="girt_event-list-day"><?php echo $date_end->format('j'); ?></div>
											<div class="girt_event-list-year"><?php echo $date_end->format('F Y'); ?></div>
										<?php endif; ?>
									<?php else: ?>
										<div class="girt_event-list-day">TBC</div>
									<?php endif; ?>
								</div>
								<div class="girt_event-list-title">
									<h2><?php the_title(); ?></h2>
									<?php if(get_field('multi_day_event_description')): ?>
										<div class="girt_parent-multi-excerpt">
											<?php the_field('multi_day_event_description'); ?>
											
										</div>
									<?php if(get_field('multi_book_now_button_link')): ?>
										<a class="girt_multi-book-button" href="<?php the_field('multi_book_now_button_link'); ?>" target="_blank"><?php the_field('multi_book_now_button_text'); ?></a>
									<?php endif; ?>
									<?php endif; ?>
									<div class="girt_event-content-cont-multi show">
										<?php 
										
											// Set parent ID variable
											$parentid = get_the_ID();
										
											//Setup loop args and add to variable beeatch
											$args = array(
												'post_type' => 'event',
												'posts_per_page' => -1,
												'meta_query' => array(
													array(
														'key'		=> 'multi_day_event_selection',
														'compare'	=> '=',
														'value'		=> $parentid,														
													),
												),
												'order'	=> 'ASC',
												'orderby' => 'meta_value_num',
												'meta_key' => 'event_date',
												'meta_type'	=> 'DATETIME'
											);
											$event_posts = get_posts($args); 
										
											// Loop through posts	
											if($event_posts):
											$i = 0;
											foreach($event_posts as $post) : 
												$i++;
												setup_postdata( $post ); 
	
												$dayofweekinit = get_field('event_date', false, false);
												$dayofweekinit = new DateTime($dayofweekinit);
												$dayofweek = $dayofweekinit->format('l');
												$dayofweektwo = $dayofweekinit->format('l');
												$eventdatetime = $dayofweekinit->format('jS F Y');
										
												$timestartinit = get_field('event_start_time', false, false);
												$timestartinit = new DateTime($timestartinit);
												$starttime = $timestartinit->format('H:i');
										
												$timeendinit = get_field('event_end_time', false, false);
												$timeendinit = new DateTime($timeendinit);
												$endtime = $timeendinit->format('H:i');
		
												// Only show posts with the 'State' custom field		
												// Set the day of this post
												$current_day = $dayofweek.$parentid;
												// If this post doesn't have the same 'State' as the last one, 
												// let's give this one a heading and open the ul
												if ($current_day != $previous_day) { 
													
													// $previous_state isn't set until the end of this foreach, so the first one doesn't have this variable
													// If this isn't the first list, close the last list's ul
													if (!isset($previous_day)):
														echo '';
													elseif ( $current_day != $previous_day):
														if($i == 1): 
														else:
															echo '</ul>'; 
														endif;
													endif; 
											?>
														<h1 class="girt_multi-day-title-<?php echo $dayofweektwo; ?> show"><?php echo $dayofweektwo; ?></h1>
														
										<ul class="girt_multi-day girt_multi-day-<?php echo $dayofweektwo; ?>">
												<?php } ?>

												<li class="girt_multi-day-item-<?php echo $i; ?>">
													<h3><span><?php echo $starttime; ?> - <?php echo $endtime; ?></span><?php the_title(); ?></h3>
													<h4><?php echo $eventdatetime; ?></h4>
													<?php if(get_field('event_excerpt')): ?>
														<div class="girt_multi-excerpt">
															<div class=" multi">
																<?php the_field('event_excerpt'); ?>
															</div>
														</div>
													<?php endif; ?>
													<?php if(get_field('event_content')): ?>
													<a href="<?php the_permalink(); ?>" class="girt_multi-read-more">
														Read More
													</a>
													<?php endif; ?>
												</li>						

												<?php 
													// Remember, we closed the <ul> before the <li>'s, clever huh?
													// Set the 'State' of the this post, to compare to the next post
													$previous_day = $current_day;//$dayofweek.$parentid;
															
												?>
											<?php endforeach; wp_reset_postdata(); ?>
											<?php else: ?>
											<h3>No Confirmed Events</h2>
											<ul><li></li>
											<?php endif; ?>
										</ul>
									</div>
								</div>
								
							</div>
							
						</li>
					<?php endwhile; wp_reset_postdata(); ?>
				</ul>
			<nav class="girt_custom-pagination">
				<?php pagination_bar( $eventloop ); ?>
			</nav>
			<?php wp_reset_postdata(); ?>
			<?php endif; ?>
			</div>
		</main>
	</div>
</section>
<?php get_footer(); ?>
