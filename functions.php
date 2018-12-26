<?php


$themename = "Промискож";
$shortname = str_replace(' ', '_', strtolower($themename));

function my_meta_box() {  
    add_meta_box(  
        'my_meta_box', // Идентификатор(id)
        'My Meta Box', // Заголовок области с мета-полями(title)
        'show_my_metabox', // Вызов(callback)
        'page', // Где будет отображаться наше поле, в нашем случае в Записях
        'normal',
        'high');
}  
add_action('add_meta_boxes', 'my_meta_box'); // Запускаем функцию

$meta_fields = array(  
    array(  
        'label' => 'Краткое название для каталога',  
        'desc'  => 'Это название будет выводиться при использовании шорткода [shortCatalog]',  
        'id'    => 'catName', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    ),
    array(  
        'label' => 'Альтернативный заголовок страницы',  
        'desc'  => 'Это название будет выводиться на странице в теге <h1>',  
        'id'    => 'pageName', // даем идентификатор.
        'type'  => 'text'  // Указываем тип поля.
    )

);

// Вызов метаполей  
function show_my_metabox() {  
global $meta_fields; // Обозначим наш массив с полями глобальным
global $post;  // Глобальный $post для получения id создаваемого/редактируемого поста
// Выводим скрытый input, для верификации. Безопасность прежде всего!
echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';  

    // Начинаем выводить таблицу с полями через цикл
    echo '<table class="form-table">';  
    foreach ($meta_fields as $field) {  
        // Получаем значение если оно есть для этого поля 
        $meta = get_post_meta($post->ID, $field['id'], true);  
        // Начинаем выводить таблицу
        echo '<tr> 
                <th><label for="'.$field['id'].'">'.$field['label'].'</label></th> 
                <td>';  
                switch($field['type']) {  
                    case 'text':  
    echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
        <br /><span class="description">'.$field['desc'].'</span>';  
break;
case 'textarea':  
    echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="60" rows="4">'.$meta.'</textarea> 
        <br /><span class="description">'.$field['desc'].'</span>';  
break;
case 'checkbox':  
    echo '<input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" ',$meta ? ' checked="checked"' : '','/>
        <label for="'.$field['id'].'">'.$field['desc'].'</label>';  
break;
// Всплывающий список  
case 'select':  
    echo '<select name="'.$field['id'].'" id="'.$field['id'].'">';  
    foreach ($field['options'] as $option) {  
        echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';  
    }  
    echo '</select><br /><span class="description">'.$field['desc'].'</span>';  
break;
                }
        echo '</td></tr>';  
    }  
    echo '</table>'; 
}

// Пишем функцию для сохранения
function save_my_meta_fields($post_id) {  
    global $meta_fields;  // Массив с нашими полями

    // проверяем наш проверочный код 
    if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))   
        return $post_id;  
    // Проверяем авто-сохранение 
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)  
        return $post_id;  
    // Проверяем права доступа  
    if ('page' == $_POST['post_type']) {  
        if (!current_user_can('edit_page', $post_id))  
            return $post_id;  
        } elseif (!current_user_can('edit_post', $post_id)) {  
            return $post_id;  
    }  

    // Если все отлично, прогоняем массив через foreach
    foreach ($meta_fields as $field) {  
        $old = get_post_meta($post_id, $field['id'], true); // Получаем старые данные (если они есть), для сверки
        $new = $_POST[$field['id']];  
        if ($new && $new != $old) {  // Если данные новые
            update_post_meta($post_id, $field['id'], $new); // Обновляем данные
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id, $field['id'], $old); // Если данных нету, удаляем мету.
        }  
    } // end foreach  
}  
add_action('save_post', 'save_my_meta_fields'); // Запускаем функцию сохранения


function shortPhone() {
    $data = '<div class="shortItem">
				<div class="shortText col-xs-12 col-sm-9 col-md-9 col-lg-9">
					'.get_theme_option("shortPhone").'
				</div>
				<div class="shortButtons col-xs-12 col-sm-3 col-md-3 col-lg-3">
					<a href="#modalCall" class="modal shortBut shortCall">Заказать звонок</a>
					<a href="#modalCall" class="modal shortBut shortAsk">Задать вопрос</a>
				</div>
			</div>';

	return $data;
}
function shortPrice() {
    $data = '<div class="shortItem ">
				<div class="shortText col-xs-12 col-sm-9 col-md-9 col-lg-9">
					'.get_theme_option("shortPrice").'
				</div>
				<div class="shortButtons col-xs-12 col-sm-3 col-md-3 col-lg-3">
					<a href="'.get_theme_option("shortPriceLink").'" class="shortBut shortPrice" target="_blank">Скачать прайс</a>
				</div>
			</div>';

	return $data;
}
function shortExample() {
    $data = '<div class="shortItem col-xs-12 col-sm-9 col-md-9 col-lg-9">
				<div class="shortText">
					'.get_theme_option("shortExample").'
				</div>
				<div class="shortButtons col-xs-12 col-sm-3 col-md-3 col-lg-3">
					<a href="#modalExample" class="modal shortBut shortExample">Заказать образцы</a>
				</div>
			</div>';

	return $data;
}

function shortCatalog() {
    $data ='';
    $catalog = get_theme_option('category');
	if($category!='0'){
		$data = '<div class="catalog shortCatalog">';
		$posts = get_posts( array('numberposts'=> 99,'offset'=> 0,'orderby'=> 'menu_order','order'=> 'ASC', 'post_type'=>'page', 'include'=> $catalog) );
			foreach($posts as $post){ 
				$catName = get_post_meta($post->ID, 'catName', true);
				if($catName == ''){$catName = get_the_title($post->ID);}
				$data .= '
					<div class="catalogItemCont col-xs-12 col-sm-3 col-md-3 col-lg-3">
						<div class="catalogItem ">
							<a href="'.get_the_permalink($post->ID).'">
								<div class="catalogImg">'.get_the_post_thumbnail( $post->ID, 'catalogThumb') .'</div>
								<p>'.$catName.'</p>
							</a>
						</div>
					</div>';
			}
	}
	$data .= '</div>'; 
	return $data;
}
function shortSubCatalog() {
    $data ='';
   // if(isset($attr['id'])){
    	// $catalog = $attr['id'];
    	 $catalog = get_the_ID();
    	
		if($catalog!='0'){
			$data = '<div class="catalog shortCatalog shortSubCatalog">';
			$posts = get_posts( array('numberposts'=> 99,'offset'=> 0,'orderby'=> 'menu_order','order'=> 'ASC', 'post_type'=>'page','post_parent'=> $catalog) );
				foreach($posts as $post){ 
					$catName = get_post_meta($post->ID, 'catName', true);
					if($catName == ''){$catName = get_the_title($post->ID);}
					$data .= '
						<div class="catalogItemCont col-xs-12 col-sm-4 col-md-4 col-lg-4">
							<div class="catalogItem">
								<a href="'.get_the_permalink($post->ID).'">
									<div class="catalogImg">'.get_the_post_thumbnail( $post->ID, 'catalogThumb') .'</div>
									<p>'.$catName.'</p>
								</a>
							</div>
						</div>';
				}
		}
		$data .= '</div>'; 
  // }
   
	return $data;
}



add_shortcode( 'shortPhone', 'shortPhone' );
add_shortcode( 'shortPrice', 'shortPrice' );
add_shortcode( 'shortExample', 'shortExample' );
add_shortcode( 'shortCatalog', 'shortCatalog' );
add_shortcode( 'shortSubCatalog', 'shortSubCatalog' );
add_filter('widget_text', 'do_shortcode');



add_action( 'widgets_init', 'register_my_widgets' );
function register_my_widgets(){
	
	register_sidebar(
		array(
			'id' => 'sidebar',
			'name' => __( 'sidebar' ),
			'description' => __( '' ),
			'before_widget' => '<div id="%1$s" class="widgetItem col-xs-10 col-xs-offset-1 col-sm-12 col-sm-offset-0 my_widget asideBlock %2$s">',
			'after_widget' => '</div><div class="clear"></div>',
			'before_title' => '<h3 class="my_widget-title">',
			'after_title' => '</h3>'
		)
	);
	

}
add_action( 'widgets_init', 'registriruem_sidebari' );
 
function registriruem_sidebari() {
/* Регистрируем 'primary' сайдбар. */

   /* Вы можете повторить функцию register_sidebar() для других виджетов, поле id должно быть уникальным (primary, secondary, moiwidget и так далее. */
}





function get_theme_option($option)
{
	global $shortname;
	return stripslashes(get_option($shortname . '_' . $option));
}

function get_theme_settings($option)
{
	return stripslashes(get_option($option));
}


function cats_to_select()
{
	$categories = get_categories('hide_empty=0');
	$categories_array[] = array('value'=>'0', 'title'=>'Select');
	foreach ($categories as $cat) {
		if($cat->category_count == '0') {
			$posts_title = 'No posts!';
		} elseif($cat->category_count == '1') {
			$posts_title = '1 post';
		} else {
			$posts_title = $cat->category_count . ' posts';
		}
		$categories_array[] = array('value'=> $cat->cat_ID, 'title'=> $cat->cat_name . ' ( ' . $posts_title . ' )');
	  }
	return $categories_array;
}
function posts_to_select()
{  
	$args = array( 'sort_order'=> 'ASC', 'sort_column' => 'post_title' );
	$postslist = get_pages( $args );
	foreach ( $postslist as $post ) :
		setup_postdata( $post ); 
		$posts_array[] = array('value'=> $post->ID, 'title'=> $post->post_title .' ('.$post->ID.')');	
	endforeach;   
	return $posts_array;
}


$options = array (
	/* ОБЩИЕ НАСТРОЙКИ */
	array ( "name" => "ОБЩИЕ НАСТРОЙКИ",
				"type" => "section"),
	array(	"type" => "open"),
	array(	"name" => "E-mail для заявок",
		"desc" => "",
		"id" => $shortname."_adminMail",
		"type" => "text",
		"std" => ''
		),
	array(	"name" => "Слоган в шапке",
		"desc" => "",
		"id" => $shortname."_slogan",
		"type" => "text",
		"std" => 'Гарантия минимальной цены'
		),
	array(	"name" => "Часы работы",
		"desc" => "",
		"id" => $shortname."_workTime",
		"type" => "text",
		"std" => 'Пн-Пт: с 9.00 до 17.00'
		),

	array(	"name" => "Телефон 1 Код",
		"desc" => "",
		"id" => $shortname."_phone-1-code",
		"type" => "text",
		"std" => '495'
		),
	array(	"name" => "Телефон 1 Номер",
		"desc" => "",
		"id" => $shortname."_phone-1",
		"type" => "text",
		"std" => '644-04-54'
		),
	array(	"name" => "Телефон 2 Код",
		"desc" => "",
		"id" => $shortname."_phone-2-code",
		"type" => "text",
		"std" => '495'
		),
	array(	"name" => "Телефон 2 Номер",
		"desc" => "",
		"id" => $shortname."_phone-2",
		"type" => "text",
		"std" => '507-35-35'
		),
	array(	"name" => "Ссылка для кнопки ENG",
		"desc" => "Должна начинаться с https:// (Пример: https://google.ru)",
		"id" => $shortname."_eng",
		"type" => "text",
		"std" => 'https://google.ru'
		),

	array(	"name" => "Копирайт",
		"desc" => "",
		"id" => $shortname."_copy",
		"type" => "text",
		"std" => 'iskozh © 1992-2015 '
		),
	array ( "type" => "close"),

	/* Каталог */
	array ( "name" => "Каталог",
				"type" => "section"),
	array(	"type" => "open"),
	/*array(	"name" => "Рубрика КАТАЛОГ",
			"desc" => "",
			"id" => $shortname."_category",
			"options" => posts_to_select(),
			"std" => "0",
			"type" => "select"),*/
	array(	"name" => "ID страниц каталога",
			"desc" => "Здесь нужно перечислить ID страниц, которые нужно вывести в каталоге. <br>
			<i>Пример: 1, 2, 3</i>
			<br> Порядок отображения задается в редакторе страницы в поле 'Порядок'",
			"id" => $shortname."_category",
			"std" => "",
			"type" => "text"),

	array ( "type" => "close"),
	/* SHORT CODE */
	array ( "name" => "Вставки в контент (Прайс, звонок, заказ образца)",
				"type" => "section"),
	array(	"type" => "open"),
	array(	"name" => "Звонок и вопрос",
			"desc" => 'В контент вставляется конструкцией [shortPhone] <br/>Дополнительно вставляются кнопки "Заказать звонок" и "Задать вопрос" ',
			"id" => $shortname."_shortPhone",
			"std" => "Позвоните нам по телефонам <span>+7 (495) 507-35-35</span> или <span>+7 (495) 644-04-54</span> 
					<br>и наши менеджеры с удовольствием ответят на любые вопросы",
			"type" => "textarea"),
	array(	"name" => "Заказать прайс",
			"desc" => 'В контент вставляется конструкцией [shortPrice] <br/>Дополнительно вставляются кнопки "Заказать прайс"',
			"id" => $shortname."_shortPrice",
			"std" => "Вы можете скачать наш прайс-лист",
			"type" => "textarea"),
	array(	"name" => "Ссылка для прайса",
			"desc" => 'Ссылка откроется в новом окне',
			"id" => $shortname."_shortPriceLink",
			"std" => "",
			"type" => "text"),

	array(	"name" => "Заказать образцы",
			"desc" => 'В контент вставляется конструкцией [shortExample] <br/>Дополнительно вставляются кнопки "Заказать образцы"',
			"id" => $shortname."_shortExample",
			"std" => "Вы можете заказать образцы виниловой матовой искусственной кожи для мебели, отправив нам заявку",
			"type" => "textarea"),


	array ( "type" => "close"),
	

	/* СКРИПТЫ */
	array ( "name" => "СКРИПТЫ",
				"type" => "section"),
	array(	"type" => "open"),	
	array(	"name" => "JavaScript код в шапке",
		"desc" => "",
		"id" => $shortname."_header",
		"type" => "textarea",
		"std" => ''
		),
	array(	"name" => "JavaScript код в футере",
		"desc" => "",
		"id" => $shortname."_footer",
		"type" => "textarea",
		"std" => ''
		),
	array(	"type" => "close")
);

function mytheme_add_admin() {
	global $themename, $shortname, $options;

	if ( $_GET['page'] == basename(__FILE__) ) {

		if ( 'save' == $_REQUEST['action'] ) {

				foreach ($options as $value) {
					update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }

				foreach ($options as $value) {
					if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }

				echo '<meta http-equiv="refresh" content="0;url=themes.php?page=functions.php&saved=true">';
				die;

		}
	}

	add_menu_page("Настройки ".$themename, "Настройки ".$themename, 'edit_themes', basename(__FILE__), 'mytheme_admin');
	//add_submenu_page(basename(__FILE__),"Слайдер","Слайдер",'edit_themes','submenu_1','sliders');  
}

if (!empty($_REQUEST["theme_license"])) {  } 
function theme_usage_message() {  }

function mytheme_admin_init() {

	global $themename, $shortname, $options;

	$get_theme_options = get_option($shortname . '_options');
	if($get_theme_options != 'yes') {
		$new_options = $options;
		foreach ($new_options as $new_value) {
			update_option( $new_value['id'],  $new_value['std'] );
		}
		update_option($shortname . '_options', 'yes');
	}
}

function check_theme_footer() {  } check_theme_footer();


if(!function_exists('get_sidebars')) {
	function get_sidebars()
	{

		 get_sidebar();
	}
}


function mytheme_admin() {

	global $themename, $shortname, $options;

	if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>Настройки '.$themename.' сохранены.</strong></p></div>';

?>
<div class="wrap">
<h2>Настройки темы <?php echo $themename; ?></h2>
<div style="border-bottom: 1px dotted #000; padding-bottom: 10px; margin: 10px;">Оставьте это поле пустым, если не хотите его отображать.</div>
<form method="post">



<?php foreach ($options as $value) {

	switch ( $value['type'] ) {

		case "open":
		?>
		<table width="100%" border="0" style=" padding:10px;">
			


		<?php break;

		case "close":
		?>

		</table><br />
		</div>
		</div>
		<div class="clear"></div>
		<br />

		<?php break;

		case "title":
		?>
		<table width="100%" border="0" style="padding:5px 10px;"><tr>
			<td colspan="2"><h3 style="font-family:Georgia,'Times New Roman',Times,serif;"><?php echo $value['name']; ?></h3></td>
		</tr>


		<?php break;

		case 'text':
		?>

		<tr>
			<td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
			<td width="80%"><input style="width:100%;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php echo get_theme_settings( $value['id'] ); ?>" /></td>
		</tr>

		<tr>
			<td><small><?php echo $value['desc']; ?></small></td>
		</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>
		
		<?php
		break;
		case "textareaMCE" :
		?>
		<tr>
			<td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
			<td width="80%"><?php if (get_settings($value['id']) != ""){
					$val = wpautop(get_settings($value['id']));}else {$val = $value["std"];};
				the_editor($val, $value['id'], '', false, 2, false); ?></td>

		</tr>

		<tr>
			<td><small><?php echo $value['desc']; ?></small></td>
		</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>	
            f
		<?php
		break;

		case 'textarea':
		?>

		<tr>
			<td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
			<td width="80%"><textarea name="<?php echo $value['id']; ?>" style="width:100%; height:140px;" type="<?php echo $value['type']; ?>" cols="" rows=""><?php echo get_theme_settings( $value['id'] ); ?></textarea></td>

		</tr>

		<tr>
			<td><small><?php echo $value['desc']; ?></small></td>
		</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

		<?php
		break;

		case 'select':
		?>
		<tr>
			<td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
			<td width="80%">
				<select style="width:240px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
					<?php
						foreach ($value['options'] as $option) { ?>
						<option value="<?php echo $option['value']; ?>" <?php if ( get_theme_settings( $value['id'] ) == $option['value']) { echo ' selected="selected"'; } ?>><?php echo $option['title']; ?></option>
						<?php } ?>
				</select>
			</td>
	   </tr>

	   <tr>
			<td><small><?php echo $value['desc']; ?></small></td>
	   </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

		<?php
		break;

		case "checkbox":
		?>
			<tr>
			<td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
				<td width="80%"><? if(get_theme_settings($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
						<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
						</td>
			</tr>

			<tr>
				<td><small><?php echo $value['desc']; ?></small></td>
		   </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

		<?php 		break;
					case "section" :
					$i++;
			?>

		<div class="rm_section">
				<div class="rm_title">
					<h3>
						<img src="<?php bloginfo('template_directory')?>/functions/images/trans.png" class="inactive" alt=""/>
						<?php echo $value['name']; ?>
					</h3>
					
					 <span class="submit">
							<input name="save<?php echo $i; ?>" type="submit" value="Сохранить" />
					 </span>
					<div class="clearfix"></div>
				</div>

				<div class="rm_options">
			<?php
					break;
					}
				}
			?>

<!--</table>-->

<p class="submit">
<input name="save" type="submit" value="Сохранить" />
<input type="hidden" name="action" value="save" />
</p>
</form>

<?php
}
function mytheme_add_init() {
	$file_dir = get_bloginfo('template_directory');
	wp_enqueue_style("functions", $file_dir."/functions/style.css", false, "1.0", "all");
	wp_enqueue_script("rm_script", $file_dir."/functions/script.js", false, "1.0");  
}
mytheme_admin_init();

function check_theme_header() { if (!(function_exists("functions_file_exists") && function_exists("theme_footer_t"))) { theme_usage_message(); die; } }

add_action('admin_menu', 'mytheme_add_admin');
add_action('admin_init', 'mytheme_add_init');
wp_enqueue_script('jquery-ui-sortable'); 

function sidebar_ads_125()
{
	 global $shortname;
	 $option_name = $shortname."_ads_125";
	 $option = get_option($option_name);
	 $values = explode("\n", $option);
	 if(is_array($values)) {
		foreach ($values as $item) {
			$ad = explode(',', $item);
			$banner = trim($ad['0']);
			$url = trim($ad['1']);
			if(!empty($banner) && !empty($url)) {
				echo "<a href=\"$url\" target=\"_new\"><img class=\"ad125\" src=\"$banner\" /></a> \n";
			}
		 }
	 }
}

if ( function_exists("add_theme_support") ) { add_theme_support("post-thumbnails"); }
add_image_size('slideThumb', 500, 340, true);
add_image_size('productThumb', 170, 140, true);
add_image_size('catalogThumb', 190, 121, true);
add_image_size('subCatalogThumb', 254, 122, true);


	if(function_exists('add_custom_background')) {
		add_custom_background();
	}

	if ( function_exists( 'register_nav_menus' ) ) {
		register_nav_menus(
			array(
			  'topMenu' => 'Главное меню',
			  'bottomMenuCenter' => 'Меню в футере по центру',
			  'bottomMenuRight' => 'Меню в футере справа'
			)
		);
	}
	
	
	// свой класс построения меню:  
	class magomra_walker_nav_menu extends Walker_Nav_Menu {  
	  
	// add classes to ul sub-menus  
	function start_lvl( &$output, $depth ) {  
		// depth dependent classes  
		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent  
		$display_depth = ( $depth + 1); // because it counts the first submenu as 0  
		$classes = array(  
			'sub-menu',  
			( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),  
			( $display_depth >=2 ? 'sub-sub-menu' : '' ),  
			'menu-depth-' . $display_depth  
			);  
		$class_names = implode( ' ', $classes );  
	  
		// build html  
		$output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";  
	}  
	  
	// add main/sub classes to li's and links  
	 function start_el( &$output, $item, $depth, $args ) {  
		global $wp_query;  
		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent  
	  
		// depth dependent classes  
		$depth_classes = array(  
			( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),  
			( $depth >=2 ? 'sub-sub-menu-item' : '' ),  
			( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),  
			'menu-item-depth-' . $depth  
		);  
		$depth_class_names = esc_attr( implode( ' ', $depth_classes ) );  
	  
		// passed classes  
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;  
		$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );  
	  
		// build html  
		$output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';  
	  
		// link attributes  
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';  
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';  
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';  
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';  
		$attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';  
	  
	
		$item_output = sprintf( '%1$s<a%2$s><div class="newsItemTop"></div><div class="newsItem"><div class="newsItemTriangle"><span></span></div><span class="newsItemName">%4$s</span><div class="leftSidebarTriangle"></div></div><div class="newsItemBottom"></div></a>',  
			$args->before,  
			$attributes,  
			$args->link_before,  
			apply_filters( 'the_title', $item->title, $item->ID ),  
			$args->link_after,  
			$args->after  
		);  
	  
		// build html  
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );  
	}  
	}  
	  
	// И там, где нужно выводим меню так:  
	function magomra_nav_menu( $menu_id ) {  
		// main navigation menu  
		$args = array(  
			'theme_location'    => '',  
			'container'     => 'div',  
			'container_id'      => 'top-navigation-primary',  
			'conatiner_class'   => 'top-navigation',  
			'menu_class'        => 'menu main-menu menu-depth-0 menu-even',   
			'echo'          => true,  
			'items_wrap'        => '<ul id="%1$s" class="%2$s">%3$s</ul>',  
			'depth'         => 10,   
			'walker'        => new magomra_walker_nav_menu  
		);  
	  
		// print menu  
	   // wp_nav_menu( $args );  
	}  	

	function kama_drussify_months( $date, $req_format ){
		// в формате есть "строковые" неделя или месяц
		if( ! preg_match('~[FMlS]~', $req_format ) ) return $date;
		$replace = array ( 
			"январь" => "января", "Февраль" => "февраля", "Март" => "марта", "Апрель" => "апреля", "Май" => "мая", "Июнь" => "июня", "Июль" => "июля", "Август" => "августа", "Сентябрь" => "сентября", "Октябрь" => "октября", "Ноябрь" => "ноября", "Декабрь" => "декабря", 
			"January" => "января", "February" => "февраля", "March" => "марта", "April" => "апреля", "May" => "мая", "June" => "июня", "July" => "июля", "August" => "августа", "September" => "сентября", "October" => "октября", "November" => "ноября", "December" => "декабря",	
			"Jan" => "янв.", "Feb" => "фев.", "Mar" => "март.", "Apr" => "апр.", "May" => "мая", "Jun" => "июня", "Jul" => "июля", "Aug" => "авг.", "Sep" => "сен.", "Oct" => "окт.", "Nov" => "нояб.", "Dec" => "дек.",	
			"Sunday" => "воскресенье", "Monday" => "понедельник", "Tuesday" => "вторник", "Wednesday" => "среда", "Thursday" => "четверг", "Friday" => "пятница", "Saturday" => "суббота",
			"Sun" => "вос.", "Mon" => "пон.", "Tue" => "вт.", "Wed" => "ср.", "Thu" => "чет.", "Fri" => "пят.", "Sat" => "суб.", "th" => "", "st" => "", "nd" => "", "rd" => "",		
		);
	   	return strtr( $date, $replace );
	}
	add_filter('date_i18n', 'kama_drussify_months', 11, 2);
	
	function new_excerpt_length($length) {
		return 40;
	}
	add_filter('excerpt_length', 'new_excerpt_length');
	function new_excerpt_more($more) {
		return '';
	}
	add_filter('excerpt_more', 'new_excerpt_more');
	/* 
		Обрезка текста - excerpt maxchar = количество символов. 
		text = какой текст обрезать (по умолчанию берется excerpt поста, если его нету, то content, если есть тег <!--more-->, то maxchar игнорируется и берется все, что до него, с сохранением HTML тегов ) 
		save_format = Сохранять перенос строк или нет. По умолчанию сохраняется. Если в параметр указать определенные теги, то они НЕ будут вырезаться из обрезанного текста (пример: save_format=<strong><a> ) 
		echo = выводить на экран или возвращать (return) для обработки. 
		П.с. Шоткоды вырезаются. Минимальное значение maxchar может быть 22. */ 
		function kama_excerpt( $args = '' ){
			global $post;
			
			$default = array( 'maxchar' => 250, 'text' => '', 'save_format' => false, 'more_text' => '...', 'echo' => true, );
			
			parse_str( $args, $_args );
			$args = array_merge( $default, $_args );
			extract( $args );
				
			if( ! $text ){
				$text = $post->post_excerpt ? $post->post_excerpt : $post->post_content;
				
				$text = preg_replace ("~\[/?.*?\]~", '', $text ); // убираем шоткоды, например:[singlepic id=3]
				
				// для тега <!--more-->
				if( ! $post->post_excerpt && strpos( $post->post_content, '<!--more-->') ){
					preg_match ('~(.*)<!--more-->~s', $text, $match );
					$text = trim( $match[1] );
					$text = str_replace("\r", '', $text );
					$text = preg_replace( "~\n\n+~s", "</p><p>", $text );
					$text = '<p>'. str_replace( "\n", '<br />', $text ) .' <a href="'. get_permalink( $post->ID ) .'#more-'. $post->ID .'">'. $more_text .'</a></p>';
					
					if( $echo ) return print $text;
					
					return $text;
				}
				elseif( ! $post->post_excerpt )
					$text = strip_tags( $text, $save_format );
			}	
			
			// Обрезаем
			if ( mb_strlen( $text ) > $maxchar ){
				$text = mb_substr( $text, 0, $maxchar );
				$text = preg_replace('@(.*)\s[^\s]*$@s', '\\1 ...', $text ); // убираем последнее слово, оно 99% неполное
			}
			
			// Сохраняем переносы строк. Упрощенный аналог wpautop()
			if( $save_format ){
				$text = str_replace("\r", '', $text );
				$text = preg_replace("~\n\n+~", "</p><p>", $text );
				$text = "<p>". str_replace ("\n", "<br />", trim( $text ) ) ."</p>";
			}
			
			//$out = preg_replace('@\*[a-z0-9-_]{0,15}\*@', '', $out); // удалить *some_name-1* - фильтр сммайлов
			
			if( $echo ) return print $text;
			
			return $text;
		}
		
		
	/***************************
		PAGINATION
	***************************/
	function wp_corenavi() {
		global $wp_query;
		$pages = '';
		$max = $wp_query->max_num_pages;
		if (!$current = get_query_var('paged')) $current = 1;
		$a['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));
		$a['total'] = $max;
		$a['current'] = $current;

		$total = 0; //1 - выводить текст "Страница N из N", 0 - не выводить
		$a['mid_size'] = 2; //сколько ссылок показывать слева и справа от текущей
		$a['end_size'] = 1; //сколько ссылок показывать в начале и в конце
		$a['prev_text'] = '<'; //текст ссылки "Предыдущая страница"
		$a['next_text'] = '>'; //текст ссылки "Следующая страница"

		if ($max > 1) echo '<div class="navigation">';
		if ($total == 1 && $max > 1) $pages = '<span class="pages">Страница ' . $current . ' из ' . $max . '</span>'."\r\n";
		echo $pages . paginate_links($a);
		if ($max > 1) echo '</div>';
	}

	/***************************
		# PAGINATION
	***************************/


	/***********************************
	СТРАНИЦА СЛАЙДЕРОВ
***********************************/
function sliders(){ 
if (isset($_POST["update_settings"])) {  
	$video_elements = array();  
	$max_id = esc_attr($_POST["landing_num_video"]);  
	$j = 0;
	for ($i = 0; $i < $max_id; $i ++) {  
		$field_name = "video-" . $j;  
		while(!isset($_POST[$field_name])){
			$j++;
			$field_name = "video-" . $j;  
		} 
		$video_elements[] = $_POST[$field_name];  
		$j++;		
	}  
	update_option("video_elements", $video_elements);  
	$num_video = esc_attr($_POST["landing_num_video"]);   	  
	update_option("landing_num_video", $num_video); 
	
	$opinion_elements = array();  
	$max_id = esc_attr($_POST["landing_num_opinion"]);  
	$j = 0;
	for ($i = 0; $i < $max_id; $i ++) {  
		$opinion_elements[$i]  = array();
		$field_name1 = "opinion-name-" . $j;
		$field_name2 = "opinion-select-" . $j;  		
		while(!isset($_POST[$field_name1])){
			$j++;
			$field_name1 = "opinion-name-" . $j; 
			$field_name2 = "opinion-select-" . $j;  			
		} 
		// Сделать многомерный массив
		$opinion_elements[$i][0] = $_POST[$field_name1];  
		$opinion_elements[$i][1] = $_POST[$field_name2];
		$j++;		
	}  
	update_option("opinion_elements", $opinion_elements);    	  
	update_option("landing_num_opinion", $max_id);	
	
	
	$example_elements = array();  
	$max_id = esc_attr($_POST["landing_num_example"]);  
	$j = 0;
	for ($i = 0; $i < $max_id; $i ++) {  
		$example_elements[$i]  = array();
		$field_name1 = "example-name-" . $j; 
		$field_name2 = "example-city-" . $j; 
		$field_name3 = "example-select-" . $j; 		
		while(!isset($_POST[$field_name1])){
			$j++;
			$field_name1 = "example-name-" . $j; 
			$field_name2 = "example-city-" . $j; 
			$field_name3 = "example-select-" . $j;  			
		} 
		$example_elements[$i][0] = $_POST[$field_name1];  
		$example_elements[$i][1] = $_POST[$field_name2];
		$example_elements[$i][2] = $_POST[$field_name3];
		$j++;		
	}  
	update_option("example_elements", $example_elements);    	  
	update_option("landing_num_example", $max_id);	
	?>  
		<div id="message" class="updated">Настройки сохранены</div>  
	<?php  
}  


?>
<div class="wrap rm_wrap">
    <h2>Настройки слайдеров</h2>

    <div class="rm_opts">
        <form method="post">
	
	<!--*************************************
		Слайды
	************************************* -->
	<div class="rm_section">
            <div class="rm_title">
                <h3>
                    <img src="<?php bloginfo('template_directory')?>/functions/images/trans.png" class="inactive" alt=""/>
                   КАТАЛОГ
                </h3>
					
				<span class="submit">
                    <input name="save1" type="submit" value="Сохранить" />
                </span>
                <div class="clearfix"></div>
            </div>
			
			
			
            <div class="rm_options" id="exampleList">	
				<p></p>
				<p>Изображения для категорий будет взято из миниатюр</p>
				<div id="exampleListInner">
					<?php $posts = get_posts(array(
						'numberposts'     => -1,
						'offset'          => 0,
						'category'        => '',
						'orderby'         => 'post_date',
						'order'           => 'DESC',
						'include'         => '',
						'exclude'         => '',
						'meta_key'        => '',
						'meta_value'      => '',
						'post_type'       => 'any',
						'post_mime_type'  => '',
						'post_parent'     => '',
						'post_status'     => ''
					)); ?> 
					<?php 
						$example_elements = get_option("example_elements");
						$num_example = get_option("landing_num_example");
						if($num_example == '')$num_example=0;
						$example_counter = 0; 
						if($num_example > 0){
							foreach($example_elements as $element) : ?>
								<div id="example-<?php echo $example_counter;?>" class="rm_input rm_textarea">
									<div class="label">
										<label for="example-<?php echo $example_counter; ?>">Слайд <?php echo $example_counter; ?></label>
									</div>
									<div class="text">
										
										<input type="text" value="<?php echo $element[0];?>" name="example-name-<?php echo $example_counter; ?>" placeholder="Заголовок" />
										<input type="text" value="<?php echo $element[1];?>" name="example-city-<?php echo $example_counter; ?>" placeholder="Подпись" />
										<?php $posts = get_posts(array(
											'numberposts'     => -1,
											'offset'          => 0,
											'category'        => '',
											'orderby'         => 'post_date',
											'order'           => 'DESC',
											'include'         => '',
											'exclude'         => '',
											'meta_key'        => '',
											'meta_value'      => '',
											'post_type'       => 'any',
											'post_mime_type'  => '',
											'post_parent'     => '',
											'post_status'     => 'publish'
										));  ?> 
										<select name="example-select-<?php echo $example_counter; ?>"> 
											<?php foreach ($posts as $post) : ?> 
											
												<option value="<?php echo $post->ID; ?>" <?php if($post->ID==$element[2]){?>selected="selected"<?php };?>> 
													<?php echo $post->post_title; ?> 
												</option> 
											<?php endforeach; ?> 
										</select> 
									</div>
									
									<small><a href="#" class="removeExample">Удалить</a></small>
									<div class="clearfix"></div>
								</div>
								<div class="clearfix"></div>	 
						<?php 
								$example_counter++; 
							endforeach; 
						}
						if($example_counter<$num_example)$num_example=$example_counter;
					?>  
					
				</div>
				<input type="hidden" id="landing_num_example" name="landing_num_example" value="<?php echo $num_example;?>" size="25" />
				<a href="#" id="add-example" class="button button-primary">Добавить слайд</a> 
			</div>
			
        </div>
	<div class="clear"></div>
    <br />	
	<!--******************************
		# СЛАЙДЕР ПРИМЕРЫ РАБОТ НИКОЛАЯ
	******************************-->
	<input type="hidden" name="update_settings" value="Y" />
	<input type="submit" value="Сохранить" class="button-primary">
	</form>
	<div id="videoExample" class="rm_input rm_textarea" style="display:none;">
		<label for="video1"></label>
		<textarea name="video"></textarea> 
		<small><a href="#" class="removeVideo">Удалить</a></small>
		<div class="clearfix"></div>
	</div>
	<div id="opinionExample" class="rm_input rm_textarea" style="display:none;">
		<div class="label">
			<label for="video1"></label>
		</div>
		<div class="text">
			<input type="text" value="" name="option-name" placeholder="Введите заголовок" />
			
			<select name="option-select"> 
				<?php foreach ($posts as $post) : ?> 
					<option value="<?php echo $post->ID; ?>"> 
						<?php echo $post->post_title; ?> 
					</option> 
				<?php endforeach; ?> 
			</select> 
		</div>
		
		<small><a href="#" class="removeOpinion">Удалить</a></small>
		<div class="clearfix"></div>
	</div>
	<div id="exampleExample" class="rm_input rm_textarea" style="display:none;">
		<div class="label">
			<label for="video1"></label>
		</div>
		<div class="text">
			<input type="text" value="" class="exampleName" name="example-name" placeholder="Введите заголовок" />
			<input type="text" value="" class="exampleCity" name="example-city" placeholder="Введите подпись" />
			<select name="example-select"> 
				<?php foreach ($posts as $post) : ?> 
					<option value="<?php echo $post->ID; ?>"> 
						<?php echo $post->post_title; ?> 
					</option> 
				<?php endforeach; ?> 
			</select> 
		</div>
		
		<small><a href="#" class="removeExample">Удалить</a></small>
		<div class="clearfix"></div>
	</div>
	</div>
</div>
<?php
}

/*
 * "Хлебные крошки" для WordPress
 * автор: Dimox
 * версия: 2015.05.21
*/
function dimox_breadcrumbs() {
	 /* === ОПЦИИ === */
	 $text['home'] = 'Промискож'; // текст ссылки "Главная"
	 $text['category'] = '%s'; // текст для страницы рубрики
	 $text['search'] = 'Результаты поиска по запросу "%s"'; // текст для страницы с результатами поиска
	 $text['tag'] = 'Записи с тегом "%s"'; // текст для страницы тега
	 $text['author'] = 'Статьи автора %s'; // текст для страницы автора
	 $text['404'] = 'Ошибка 404'; // текст для страницы 404
	 $text['page'] = '%s'; // текст 'Страница N'
	 $text['cpage'] = '%s'; // текст 'Страница комментариев N'

	 $delimiter = '›'; // разделитель между "крошками"
	 $delim_before = '<span class="divider hidden">'; // тег перед разделителем
	 $delim_after = '</span>'; // тег после разделителя
	 $show_home_link = 1; // 1 - показывать ссылку "Главная", 0 - не показывать
	 $show_on_home = 0; // 1 - показывать "хлебные крошки" на главной странице, 0 - не показывать
	 $show_title = 1; // 1 - показывать подсказку (title) для ссылок, 0 - не показывать
	 $show_current = 1; // 1 - показывать название текущей страницы, 0 - не показывать
	 $before = '<span class="current">'; // тег перед текущей "крошкой"
	 $after = '</span>'; // тег после текущей "крошки"
	 /* === КОНЕЦ ОПЦИЙ === */

	 global $post;
	 $home_link = home_url('/');
	 $link_before = '<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb">';
	 $link_after = '</span>';
	 $link_attr = ' itemprop="url"';
	 $link_in_before = '<span itemprop="title">';
	 $link_in_after = '</span>';
	 $link = $link_before . '<a href="%1$s"' . $link_attr . $link_in_before . '%2$s' . $link_in_after . '</a>' . $link_after;
	 $frontpage_id = get_option('page_on_front');
	 $parent_id = $post->post_parent;
	 $delimiter = ' ' . $delim_before . $delimiter . $delim_after . ' ';

	 if (is_home() || is_front_page()) {
		 if ($show_on_home == 1) echo '<div id="breadcrumbs"><a href="' . $home_link . '">' . $text['home'] . '</a></div>';
	 } else {

		 echo '<div id="breadcrumbs">';
		 if ($show_home_link == 1) echo sprintf($link, $home_link, $text['home']);

		 if ( is_category() ) {
			 $cat = get_category(get_query_var('cat'), false);
			 if ($cat->parent != 0) {
				 $cats = get_category_parents($cat->parent, TRUE, $delimiter);
				 $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
				 $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr  . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
				 if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
				 if ($show_home_link == 1) echo $delimiter;
				 echo $cats;
			 }
			 if ( get_query_var('paged') ) {
				 $cat = $cat->cat_ID;
				 echo $delimiter . sprintf($link, get_category_link($cat), get_cat_name($cat)) . $delimiter . $before . sprintf($text['page'], get_query_var('paged')) . $after;
			 } else {
			 	if ($show_current == 1) echo $delimiter . $before . sprintf($text['category'], single_cat_title('', false)) . $after;
			 }

		 } elseif ( is_search() ) {
			 if ($show_home_link == 1) echo $delimiter;
			 echo $before . sprintf($text['search'], get_search_query()) . $after;

		} elseif ( is_day() ) {
			 if ($show_home_link == 1) echo $delimiter;
			 echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			 echo sprintf($link, get_month_link(get_the_time('Y'), get_the_time('m')), get_the_time('F')) . $delimiter;
			 echo $before . get_the_time('d') . $after;

 		} elseif ( is_month() ) {
			 if ($show_home_link == 1) echo $delimiter;
			 echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			 echo $before . get_the_time('F') . $after;

 		} elseif ( is_year() ) {
			 if ($show_home_link == 1) echo $delimiter;
			 echo $before . get_the_time('Y') . $after;

 		} elseif ( is_single() && !is_attachment() ) {
			 if ($show_home_link == 1) echo $delimiter;
			 if ( get_post_type() != 'post' ) {
				 $post_type = get_post_type_object(get_post_type());
				 $slug = $post_type->rewrite;
				 printf($link, $home_link . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
				 if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;
			 } else {
				 $cat = get_the_category(); $cat = $cat[0];
				 $cats = get_category_parents($cat, TRUE, $delimiter);
				 if ($show_current == 0 || get_query_var('cpage')) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
				 $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr  . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
				 if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
				 echo $cats;
				 if ( get_query_var('cpage') ) {
				 echo $delimiter . sprintf($link, get_permalink(), get_the_title()) . $delimiter . $before . sprintf($text['cpage'], get_query_var('cpage')) . $after;
				 } else {
				 if ($show_current == 1) echo $before . get_the_title() . $after;
				 }
 			}

			 // custom post type
			} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
				 $post_type = get_post_type_object(get_post_type());
				 if ( get_query_var('paged') ) {
				 echo $delimiter . sprintf($link, get_post_type_archive_link($post_type->name), $post_type->label) . $delimiter . $before . sprintf($text['page'], get_query_var('paged')) . $after;
				 } else {
				 if ($show_current == 1) echo $delimiter . $before . $post_type->label . $after;
			 }

			 } elseif ( is_attachment() ) {
				 if ($show_home_link == 1) echo $delimiter;
				 $parent = get_post($parent_id);
				 $cat = get_the_category($parent->ID); $cat = $cat[0];
				 if ($cat) {
				 $cats = get_category_parents($cat, TRUE, $delimiter);
				 $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr  . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
				 if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
				 echo $cats;
				 }
				 printf($link, get_permalink($parent), $parent->post_title);
				 if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;

			 } elseif ( is_page() && !$parent_id ) {
				 if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;

			 } elseif ( is_page() && $parent_id ) {
				 if ($show_home_link == 1) echo $delimiter;
				 if ($parent_id != $frontpage_id) {
				 $breadcrumbs = array();
				 while ($parent_id) {
				 $page = get_page($parent_id);
				 if ($parent_id != $frontpage_id && $parent_id != get_theme_option("category")) {
				 $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
				 }
				 $parent_id = $page->post_parent;
				 }
				 $breadcrumbs = array_reverse($breadcrumbs);
				 for ($i = 0; $i < count($breadcrumbs); $i++) {
				 echo $breadcrumbs[$i];
				 if ($i != count($breadcrumbs)-1) echo $delimiter;
				 }
				 }
				 if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;

			 } elseif ( is_tag() ) {
 if ($show_current == 1) echo $delimiter . $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

 } elseif ( is_author() ) {
 if ($show_home_link == 1) echo $delimiter;
 global $author;
 $author = get_userdata($author);
 echo $before . sprintf($text['author'], $author->display_name) . $after;

 } elseif ( is_404() ) {
 if ($show_home_link == 1) echo $delimiter;
 echo $before . $text['404'] . $after;

 } elseif ( has_post_format() && !is_singular() ) {
 if ($show_home_link == 1) echo $delimiter;
 echo get_post_format_string( get_post_format() );
 }

 echo '</div><!-- .breadcrumbs -->';

 }
} // end dimox_breadcrumbs()








?>