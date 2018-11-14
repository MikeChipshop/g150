<?php /* Template Name: Events Test */ ?>
<?php get_header(); ?>
<section class="girt_fp-content-block girt_fp-hero">
	<div class="girt_hero-content" style="background:url(<?php bloginfo('stylesheet_directory'); ?>/img/banner-test.jpg) no-repeat center center;background-size:cover;">

	</div>
</section>
<section class="girt_event-landing-wrap">
	<div class="girt_wrap">
		<?php 
			
		?>
		<main>
			<h1>Event Listings</h1>
			<div id="response">
			<?php
				$today = date('Ymd');
				$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
				$eventargs = array(
					'post_type' => 'event',
					'meta_key'	=> 'event_date',
					'orderby'	=> 'meta_value_num',
					'order'		=> 'ASC',
					'posts_per_page' => -1,
            		'paged' => $paged,
					///'meta_query' => array(
						 //array(
							//'key'		=> 'event_date',
							//'compare'	=> '>=',
							//'value'		=> $today,
						//)
					//),
				);
			
				
			?>
				<?php $list=array();
$month = 12;
$year = 2014;

for($d=1; $d<=31; $d++)
{
    $time=mktime(12, 0, 0, $month, $d, $year);          
    if (date('m', $time)==$month)       
        $list[]=date('Y-m-d-D', $time);
} ?>
					<ul>
<?php 
	foreach($list as $item) {
		?>
						<li><?php
		echo $item;
							?></li><?php 
	}
?>
						
				</ul>
				
				<?php echo do_shortcode("[fullcalendar]"); ?>
			<?php $eventloop = new WP_Query( $eventargs ); if ( $eventloop->have_posts() ) : ?>
				<ul>
					<?php while ( $eventloop->have_posts() ) : $eventloop->the_post(); ?>
						<li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<div class="girt_event-excerpt-cont">
								<div class="girt_event-list-date">
									<?php
										$date = get_field('event_date', false, false);
										$date = new DateTime($date);
									?>
									<div class="girt_event-list-month"><?php echo $date->format('M'); ?></div>
									<div class="girt_event-list-day"><?php echo $date->format('d'); ?></div>
									<div class="girt_event-list-year"><?php echo $date->format('Y'); ?></div>
								</div>
								<div class="girt_event-list-title">
									<h2><?php the_title(); ?></h2>
								</div>
							</div>
							
						</li>
					<?php endwhile; ?>
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