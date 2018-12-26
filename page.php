	<?php get_header(); ?>

		<section id="content" class="col-xs-12 col-sm-12 col-md-9 col-md-push-3 col-lg-8 col-lg-push-4">
			<?php wp_reset_query(); ?>
			<?php // if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
		<!-- Хлебные крошки -->
<?php if ( function_exists('yoast_breadcrumb') ) {
	yoast_breadcrumb('<p id="breadcrumbs">','</p>');
} ?>
		
			<?php while (have_posts()) : the_post(); ?>
				<?php if(!is_front_page()){ 
						$pageName = get_post_meta(get_the_ID(), 'pageName', true);
						if($pageName == ''){$pageName = get_the_title(get_the_ID());}
					?>
					<h1><?php echo $pageName; ?></h1>
				<?php } ?>
				<?php the_content();?>
			<?php endwhile; ?>
				
			<div class="clear"></div>
		</section>
	<?php get_footer(); ?>


