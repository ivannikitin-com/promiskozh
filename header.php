<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title><?php wp_title(''); ?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<?php $path = get_bloginfo('template_directory'); ?>
	<link href="<?php echo $path; ?>/favicon.png" rel="shortcut icon" type="image/x-icon" />

	
	<link href='https://fonts.googleapis.com/css?family=PT+Sans:400,700&amp;subset=latin,cyrillic-ext,cyrillic' rel='stylesheet' type='text/css'>
	

	<link rel="stylesheet" href="<?php echo $path; ?>/libs/bootstrap/bootstrap-grid.min.css" />
	<link rel="stylesheet" href="<?php echo $path; ?>/libs/magnific/magnific-effect.css" />
	<link rel="stylesheet" href="<?php echo $path; ?>/libs/magnific/magnific-popup.css" />
	
	<link rel="stylesheet" href="<?php echo $path; ?>/style.css" />
	<link rel="stylesheet" href="<?php echo $path; ?>/css/media.css" />

	<!--[if lt IE 9]>
	<script src="<?php echo $path; ?>/libs/html5shiv/es5-shim.min.js"></script>
	<script src="<?php echo $path; ?>/libs/html5shiv/html5shiv.min.js"></script>
	<script src="<?php echo $path; ?>/libs/html5shiv/html5shiv-printshiv.min.js"></script>
	<script src="<?php echo $path; ?>/libs/respond/respond.min.js"></script>
	<![endif]-->

	<?php echo get_theme_option("header") ?>
	<?php wp_head(); ?>
	
	
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter47606875 = new Ya.Metrika({
                    id:47606875,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true,
                    trackHash:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/47606875" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	
	ga('create', 'UA-48087111-1', 'auto');
	ga('send', 'pageview');
</script>



</head>

<body class="body">
	
	<!-- HEADER -->
	<header id="header" class="section">
		<div class="container">
			<div class="row">
				<div class="logo col-xs-12 col-sm-4 col-md-3 col-lg-3">
					<a href="<?php bloginfo('url'); ?>"><img src="<?php echo $path; ?>/img/logo.png" alt=""></a>
				</div>
				<div class="slogan col-xs-12 col-sm-8 col-md-4 col-lg-5">
					<?php echo get_theme_option("slogan") ?>
				</div>
				<div class="headInfo col-xs-12 col-sm-12  col-md-5 col-md-offset-0 col-lg-4">
					<div class="headTime">
						<span class="sectionLeft">Часы работы</span>
						<span class="sectionRight"><?php echo get_theme_option("workTime") ?></span>
					</div>
					<div class="headPhones">
						<span class="sectionLeft">
							<a href="tel:+7 <?php echo get_theme_option('phone-1-code').' '.get_theme_option('phone-1')  ?> ">+7 <span>(<?php echo get_theme_option("phone-1-code") ?>)</span> <?php echo get_theme_option("phone-1") ?></a>
						</span>
						<span class="sectionRight">
							<a href="tel:+7 <?php echo get_theme_option('phone-2-code').' '.get_theme_option('phone-2')  ?> ">+7 <span>(<?php echo get_theme_option("phone-2-code") ?>)</span> <?php echo get_theme_option("phone-2") ?></a>
						</span>
					</div>
					<div class="headLang">
						<a href="<?php bloginfo('url'); ?>" class=" activeLang">РУС</a>
						<a href="<?php echo get_theme_option("eng") ?>">ENG</a>
					</div>
				</div>
			</div>
		</div>
	</header>
	<!-- # HEADER -->
	


	<!-- TOP MENU -->
	<div id='sandwich' class="sandwich hidden-md hidden-lg">
		<div class='sw-topper'></div>
		<div class='sw-bottom'></div>
		<div class='sw-footer'></div>
	</div>
	<div id="topMenu" class="section">
		<div class="container">
			<div class="row">
				<div id="topMenuCont" class="menuCont ">
					<div id="topMenuInner"><?php wp_nav_menu( 'depth=1&theme_location=topMenu&menu_id=pagemenu&outer-wrapper=&fallback_cb=menu_1_default'); ?></div>
				</div>
				<div id="topMenuCont2" class="menuCont visible-xs visible-sm">
					<ul>
						<li>
							<div id='' class="sandwich hidden-md hidden-lg">
								<div class='sw-topper'></div>
								<div class='sw-bottom'></div>
								<div class='sw-footer'></div>
							</div>
							<a href="#" class="sandLink">Меню</a></li>
					</ul>
				</div>

				<div class="searchCont ">
					<form role="search" method="get" id="searchform" class="searchform" action="<?php bloginfo('url'); ?>">
						<input value="" name="s" id="s" type="text" placeholder="Поиск...">
						<input id="searchsubmit" value="." type="submit">
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- # TOP MENU -->

	
	<?php 
	$mainFlag = false;
	if( is_front_page() ){
		$mainFlag = true;
	} else {
		$mainFlag = false;
	}
	?>

	<!-- WRAPPER -->
	<section id="wrapper" class="section">
		<div class="container">
			