<?php if(get_field('hero_banner_image')):?>
	<section class="girt_fp-content-block girt_fp-hero" style="background-color:<?php the_field('hero_banner_background_colour'); ?>">
		<?php 
			$attachment_id = get_field('hero_banner_image');
			$size = "full";
			$image = wp_get_attachment_image_src( $attachment_id, $size );
		
			$attachment_id_small = get_field('hero_banner_image_mobile');
			$size_small = "full";
			$image_small = wp_get_attachment_image_src( $attachment_id_small, $size_small );
		?>
		<div class="girt_hero-banner-cont">
			<div class="girt_banner-image">
				<img class="girt_hero-img-mobile" src="<?php echo $image_small[0] ?>" alt="<?php the_field('hero_banner_title'); ?>">
				<img class="girt_hero-img-desktop" src="<?php echo $image[0] ?>" alt="<?php the_field('hero_banner_title'); ?>">
			</div>
			<div class="girt_hero-banner-content-wrap">
				<div class="girt_hero-banner-wrap">
					<div class="girt_hero-banner-left">
						<div class="girt_hero-banner-titles">
							<h1><?php the_field('hero_banner_title'); ?></h1>
							<h2><?php the_field('hero_banner_subtitle'); ?></h2>
						</div>
					</div>
					<div class="girt_hero-banner-right">
						<div class="girt_hero-banner-content">
							<?php the_field('hero_banner_content'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>