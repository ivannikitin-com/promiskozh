<?php get_header(); ?>

		<section id="content" class="col-xs-12 col-sm-12 col-md-9 col-md-push-3 col-lg-8 col-lg-push-4">
			<?php 
				$category = get_the_category();
			 ?>
			<h1><?php echo get_cat_name($category[0]->cat_ID); ?></h1>
			<?php wp_reset_query(); ?>

			<?php while (have_posts()) : the_post(); ?>
				<div class="newsItem">
					<h3>
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h3>
					<p><?php kama_excerpt('maxchar=400'); ?></p>
					<div class="aRight">
						<a href="<?php the_permalink(); ?>" class="showMore">Читать далее</a> 
					</div>
					<div class="clear"></div>
				</div>
			<?php endwhile; ?>
					

				<div class="clear"></div>

				<!-- PAGINTAION -->
				<div id="pagination" class=" <?php if(is_single()){echo 'hideComm';} ?>">
					<?php if (function_exists('wp_corenavi')) wp_corenavi(); ?>
				</div>
				<!-- PAGINTAION -->
			
			<div class="clear"></div>
		</section>
	
	

	<?php get_footer(); ?>


