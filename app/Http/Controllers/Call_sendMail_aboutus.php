<?php
    /* Multiple recipients */
    $to = 'gisk37ussh@gmail.com';

    /* Subject */
    $subject = 'Phản hồi phía người dùng';

    /* Message */
    $message = $_POST['content'];

    /* To send HTML mail, the Content-type header must be set */
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/html; charset=UTF-8';

    /* Additional headers */
    $headers[] = 'To: gisk37ussh@gmail.com';
    $headers[] = 'From: Người dùng '.$_POST['firstName'].' '.$_POST['lastName'].'<'.$_POST['email'].'>';

    /* Mail it */
    mail($to, $subject, $message, implode("\r\n", $headers));
?>
