<?php 
	 // Template Name: Подкатегория
 ?>

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

			<?php 
				$rrr = get_ancestors(get_the_ID(),'page');
				$posts = get_posts( array(
					'numberposts'=> 99, 
					'offset'=> 0,'orderby'=> 
					'menu_order','order'=> 
					'ASC','post_type' => 
					'page',
					'exclude'=>get_the_ID(),
					'post_parent'=> $rrr[0] 
					));
				if(count($posts) > 0){
					echo '<br><br><br><br><h3>СМОТРЕТЬ ДРУГИЕ РАЗДЕЛЫ:</h3><div class="catalog shortCatalog shortSubCatalog">';

					foreach($posts as $post){ 
						$catName = get_post_meta($post->ID, 'catName', true);
						if($catName == ''){$catName = get_the_title($post->ID);}
						?>
						<div class="catalogItemCont col-xs-12 col-sm-4 col-md-4 col-lg-4">
							<div class="catalogItem">
								<a href="<?php echo get_the_permalink($post->ID); ?>">
									<div class="catalogImg"><?php echo get_the_post_thumbnail( $post->ID, 'subCatalogThumb') ?></div>
									<p><?php echo $catName; ?></p>
								</a>
							</div>
						</div>
						<?php
					}
					echo '</div>';
				}
				?>


				
			<div class="clear"></div>
		</section>
	<?php get_footer(); ?>


