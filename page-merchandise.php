<?php get_header(); ?>
<section class="girt_merchandise-wrap">
	<?php if(get_field('merchandise_hero_image')): ?>
		<div class="girt_merch-hero">
			<?php
				$attachment_id = get_field('merchandise_hero_image');
				$size = "full";
				$image = wp_get_attachment_image_src( $attachment_id, $size );
			?>
			<img src="<?php echo $image[0] ?>" alt="Girton Merchandise">
			<header class="girt_merchandise-header">
				<h1>Merchandise</h1>
			</header>
		</div>
	<?php else: ?>
		<header class="girt_merchandise-header">
			<h1>Merchandise</h1>
		</header>
	<?php endif; ?>
	
	<div class="girt_wrap">		
		<main class="girt_merchandise-main">
			<div class="girt_merch-intro">
				<?php the_field('merch_page_intro'); ?>
			</div>
			<?php 
				$prodargs = array(
					'post_type' => 'products',
					'posts_per_page'=> -1,
					'orderby'=> 'title',
					'order' => 'RAND'
				); 
			?>
			<?php $prodloop = new WP_Query($prodargs); ?>
			<?php if ( $prodloop->have_posts() ) : ?>
				<ul>
					<?php while ( $prodloop->have_posts() ) : $prodloop->the_post(); ?>
					<li>
						<div class="girt_product-item">
							<div class="girt_product-item-header">
								<div class="girt_product-item-image">
									<?php the_post_thumbnail('product-thumb'); ?>
								</div>
								<h2><?php the_title(); ?></h2>
							</div>
							<div class="girt_product-item-meta">
								<div class="girt_product-item-buy">
									<a target="_blank" href="<?php the_field('product_button_link'); ?>">Browse</a>
								</div>
							</div>
						</div>
					</li>
					<?php endwhile; ?>
				</ul>
			<?php else: ?>
				<div class="girt_no-content">
					<h2>Exclusive Anniversary Collection</h2>
					<p>Coming Soon</p>
				</div>
			<?php endif; ?>
		</main>
	</div>
</section>
<?php get_footer(); ?>