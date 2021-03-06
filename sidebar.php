			<aside id="aside" class="col-xs-12 col-sm-12 col-md-3 col-md-pull-9 col-lg-4 col-lg-pull-8">
				<?
				$catalog = get_theme_option('category');
				if( $catalog != '0'){ ?>
					
					<div class="catMenu">
						<ul>
							<?php 
								$posts = get_posts( array(
									'numberposts'     => 99, 
									'offset'          => 0,
									'orderby'         => 'menu_order',
									'order'           => 'ASC',
									'post_type'		  => 'page',
									'include'	  => $catalog

								) );
								foreach($posts as $post){ 
									// setup_postdata($post); 
									?>
								   	<li class="parentLi">
								   		<a href="<?php echo get_the_permalink($post->ID); ?>"><?php echo get_the_title($post->ID);?></a>
								   		<?php 
								   			$posts2 = get_posts( array('numberposts'=>99,'offset'=>0,'orderby'=>'menu_order','order'=> 'ASC','post_type'=>'page','post_parent'=>$post->ID ));
								   			if(count($posts2) > 0){
								   				echo '<ul class="catChild">';
									   			foreach ($posts2 as $postTMP) {
									   			 	//setup_postdata($postTMP);
									   			 	?>
															<li><a href="<?php echo get_the_permalink($postTMP->ID); ?>"><?php echo get_the_title($postTMP->ID);?></a></li>
									   			 	<?php
									   			 } 
								   			 	echo '</ul>';
								   			}
								   		?>
										
									</li>
									<?php
								}
								// wp_reset_postdata();
							?>
						</ul>
					</div>
					<div class="center visible-xs visible-sm">
						<a href="#" class="btnRed showCatMenu " data-active="Скрыть меню категорий" data-passive="Показать меню категорий">Показать меню категорий</a>
						<br>
						<br>
					</div>
				<?php } ?>
				<div class="sideForm">
					<div class="formCont">
						<div class="formName">
							Закажите обратный звонок или задайте интересующий Вас вопрос
							<br><span><strong>*</strong> - поля для обязательного заполнения</span>
						</div>
						<?php echo do_shortcode('[contact-form-7 id="695" title="Вопрос на сайте"]') ?>
					</div>
				</div>
				<?php dynamic_sidebar( 'sidebar' ); ?>
			</aside>

		