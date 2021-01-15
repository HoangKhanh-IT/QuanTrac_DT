<?php
	/* Multiple recipients */
	$to = 'gisk37ussh@gmail.com';

	/* Subject */
	$subject = 'Báo cáo vượt ngưỡng trạm tự động';

	/* Message */
	$message = $_POST['content'];

	/* To send HTML mail, the Content-type header must be set */
	$headers[] = 'MIME-Version: 1.0';
	$headers[] = 'Content-type: text/html; charset=UTF-8';

	/* Additional headers */
	$headers[] = 'To: gisk37ussh@gmail.com';
	$headers[] = 'From: Hệ thống quan trắc tự động Đồng Tháp <gisk37ussh@gmail.com>';

	/* Mail it */
	mail($to, $subject, $message, implode("\r\n", $headers));
?>
