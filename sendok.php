<?php
 //  require_once './mail/class.phpmailer.php';
	

   $adminMail = $_POST['f_Admin'];
   
   

   $type = '=?UTF-8?B?'.$_POST['f_Form'].'?=';
   
   
   $titleAdmin = $type;
   $siteName = 'ПРОМИСКОЖ';
   $lettFrom = 'ПРОМИСКОЖ';
   $subject = 'Новая заявка '.$_SERVER['HTTP_HOST'];
   
   
	
	$order_email_message='Поступила новая заявка!<br/>
						Детали:<br/>
						<strong>Название формы: </strong>'.$_POST['f_Form'].'<br/>';

	if(isset($_POST['f_Name'])){$order_email_message = $order_email_message.'<strong>Имя отправителя: </strong>'.$_POST['f_Name'].'<br/>';}
	if(isset($_POST['f_Phone'])){$order_email_message = $order_email_message.'<strong>Телефон отправителя: </strong>'.$_POST['f_Phone'].'<br/>';}
	if(isset($_POST['f_Email'])){$order_email_message = $order_email_message.'<strong>E-mail отправителя: </strong>'.$_POST['f_Email'].'<br/>';}

	if(isset($_POST['f_Org'])){$order_email_message = $order_email_message.'<strong>Организации: </strong>'.$_POST['f_Org'].'<br/>';}
	if(isset($_POST['f_Adress'])){$order_email_message = $order_email_message.'<strong>Адрес: </strong>'.$_POST['f_Adress'].'<br/>';}
	if(isset($_POST['f_Text'])){$order_email_message = $order_email_message.'<strong>Сообщение: </strong>'.$_POST['f_Text'].'<br/>';}
	$order_email_message = $order_email_message.'<br/>';
	
	
	if(isset($_COOKIE['utm_medium']))$order_email_message = $order_email_message.'<strong>utm_medium:</strong> '.$_COOKIE['utm_medium'].'<br/>';
	if(isset($_COOKIE['utm_source']))$order_email_message = $order_email_message.'<strong>utm_source:</strong> '.$_COOKIE['utm_source'].'<br/>';
	if(isset($_COOKIE['utm_campaign']))$order_email_message = $order_email_message.'<strong>utm_campaign:</strong> '.$_COOKIE['utm_campaign'].'<br/>';
	if(isset($_COOKIE['utm_term']))$order_email_message = $order_email_message.'<strong>utm_term:</strong> '.$_COOKIE['utm_term'].'<br/>';
	if(isset($_COOKIE['utm_content']))$order_email_message = $order_email_message.'<strong>utm_content:</strong> '.$_COOKIE['utm_content'].'<br/>';

	
	$to= $siteName. "<".$adminMail.">";
		$message = '
		<html>
		<head>
		 <title>'.$titleAdmin.'</title>
		</head>
		<body>'.$order_email_message.'</body>
		</html>';
		
		$headers = '';
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		$headers .= 'From: '.$lettFrom.' <'.$adminMail.'>' . "\r\n";

		mail($adminMail, $subject, $message, $headers);
?>

