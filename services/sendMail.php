<?php
// $to      = 'wiwadh.c@ku.th';
// $subject = 'the subject';
// $message = "
//     <h1>hello</h1>
// HOw are You?
// ";
function sendMail($receiver, $subject, $message) {
    $headers = 'From: webwut.event@gmail.com' . "\r\n" .
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    
    mail($receiver, $subject, $message, $headers);
}
?>