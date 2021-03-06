			
				<?php include (TEMPLATEPATH . '/sidebar.php'); ?>
			<div class="clear"></div>
		</div>
	</section>
	<!-- # WRAPPER -->

	<?php $path = get_bloginfo('template_directory'); ?>
	
	<!-- FOOTER -->
	<footer id="footer" class="section">
		<div class="container">
			<div class="footLogoCont col-xs-10 col-xs-offset-1 col-sm-12 col-sm-offset-0 col-md-3 col-lg-3">
				<div class="footLogo">
					<a href="<?php bloginfo('url'); ?>"><img src="<?php echo $path; ?>/img/footLogo.png" alt=""></a>
				</div>
				<div class="footCopy">
					<span>&copy;</span> <?php echo get_theme_option("copy") ?>
				</div>
			</div>
			
			<div class="footMenuCont col-xs-4 col-xs-offset-0 col-sm-4 col-sm-offset-0 col-md-3 col-lg-3"><?php wp_nav_menu( 'depth=1&theme_location=topMenu&menu_id=pagemenu&outer-wrapper=&fallback_cb=menu_1_default&menu_class=footMenu'); ?></div>
			<div class="footMenuCont col-xs-4 col-xs-offset-0 col-sm-4 col-sm-offset-0 col-md-3 col-lg-3"><?php wp_nav_menu( 'depth=1&theme_location=bottomMenuCenter&menu_id=pagemenu&outer-wrapper=&fallback_cb=menu_1_default&menu_class=footCatMenu'); ?></div>
			<div class="footMenuCont col-xs-4 col-xs-offset-0 col-sm-4 col-sm-offset-0 col-md-3 col-lg-3"><?php wp_nav_menu( 'depth=1&theme_location=bottomMenuRight&menu_id=pagemenu&outer-wrapper=&fallback_cb=menu_1_default&menu_class=footCatMenu'); ?></div>

			
			<div class="clear"></div>
		</div>
	</footer>
	<!-- # FOOTER -->
	

		
	<div class="hidden">
		<div id="modalCall" class="box-modal zoom-anim-dialog row">
			<span class="mfp-close">закрыть</span>
			<div class="formCont">
				<div class="formName">
					Закажите обратный звонок или задайте интересующий Вас вопрос
					<br><span><strong>*</strong> - поля для обязательного заполнения</span>
				</div>
				<?php echo do_shortcode('[contact-form-7 id="667" title="Обратный звонок"]') ?>
			</div>
		</div>
		<div id="modalExample" class="box-modal zoom-anim-dialog row">
			<span class="mfp-close">закрыть</span>
			<div class="formCont">
				<div class="formName">
					Получить образец
					<br><span><strong>*</strong> - поля для обязательного заполнения</span>
				</div>
				<form method="post" class="form" action="<?php echo get_bloginfo('template_directory'); ?>/sendok.php">
					<input type="text" name="f_Org" class="f_Org" placeholder="Организация">
					<input type="text" name="f_Adress" class="f_Adress" placeholder="Адрес">
					<input type="text" name="f_Name" class="f_Name f_required" placeholder="* Контактное лицо">
					<input type="text" name="f_Phone" class="f_Phone" placeholder="* Телефон">
					<input type="text" name="f_Email" class="f_Email" placeholder="* E-mail">
					
					<textarea name="f_Text" class="f_Text" placeholder="Ваше сообщение"></textarea>
					<input type="hidden" name="f_Admin" value="<?php echo get_theme_option('adminMail'); ?>">
					<input type="hidden" name="f_Form" value="Получить образец">
					<input type="submit" value="Отправить">
				</form>
			</div>
		</div>
		<div id="modalOk" class="box-modal zoom-anim-dialog row">
			<span class="mfp-close">закрыть</span>
			<div class="formCont">
				<div class="formName">
					Заявка успешно отправлена!
					
				</div>
				
			</div>
		</div>

	</div>
	
	<?php $path = get_bloginfo('template_directory'); ?>
	

	<script src="<?php echo $path; ?>/js/jquery.js"></script>
	<script src="<?php echo $path; ?>/js/jquery-ui.js"></script>
	<script src="<?php echo $path; ?>/libs/masked-input/jquery.maskedinput.min.js"></script>
	<script src="<?php echo $path; ?>/libs/magnific/jquery.magnific-popup.min.js"></script>
	<script src="<?php echo $path; ?>/js/common.js"></script>
	
	<?php
		wp_footer();
		echo get_theme_option("footer")  . "\n";
	?>
	
</body>
</html>

