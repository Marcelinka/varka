<?php

add_action('wp_ajax_mail_order', 'mail_order'); // wp_ajax_request_name
add_action('wp_ajax_nopriv_mail_order', 'mail_order'); // wp_ajax_request_name

function mail_order() {
	$fileBase64 = $_POST['fileContent'];
	$person = array(
		'name' => $_POST['name'],
		'email' => $_POST['email'],
		'phone' => $_POST['phone']
	);
	$message = 'success';

	if($fileBase64) {
		$file_data = base64_decode($fileBase64);
	}
	
	//$file_name_test = get_home_path() . "wp-content/uploads/temp/order.pdf";
	$i = 1;
	do {
		$file_name = get_home_path() . "wp-content/uploads/temp/order-". $i .".pdf";
		//$file_name = "order-".$i.".pdf";
		$i++;
	} while( file_exists($file_name) );

	add_filter( 'wp_mail_content_type', 'set_html_content_type' );
	function set_html_content_type() {
		return 'text/html';
	}

	if( file_put_contents($file_name, $file_data) ) {
		//$mail_to = get_field('global_email', 'options');
		$mail_to = 'miss.knigomanka@gmail.com';
		$mail_content = '<p>Имя: '.$person['name'].'</p><p>Почта: '.$person['email'].'</p>Телефон: '.$person['phone'].'</p>';
		//$mail_content = 'Сообщение';
		if( !wp_mail($mail_to, 'Заказ', $mail_content, '', $file_name) ) {
			$message = 'send_mail_error';
		}

		unlink($file_name);
	} else {
		$message = 'create_file_error';
	}

	remove_filter( 'wp_mail_content_type', 'set_html_content_type' );

	$response = array(
		'message' => $message
	);
	echo json_encode($response);
	wp_die();
}