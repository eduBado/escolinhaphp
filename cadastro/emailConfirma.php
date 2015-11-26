<?php

function emailConfirma($email, $link) {
    // multiple recipients
    $to = '$email' . ', '; // notar a virgula
    $to .= 'edubado08@gmail.com';

// subject
    $subject = 'Confirmação de cadastro [nome do site]';

// message
    $message = "
<html>
<head>
 <title>Confirmação de cadastro [nome do site]</title>
</head>
        <body>
<h1>Confirmação de e-mail</h1>
<p> Recentemente o email $email foi cadastrado em nossa lista para se mandar informado 
    em nossa lista para se mandar informado com as últimas notícias do [nome do site]</p>
    <p>Para completar o cadastro, favor confirmar no link abaixo: </p>
    <br>
    <p>$link</p>
        </body>
</html>
";

// To send HTML mail, the Content-type header must be set
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; utf-8' . "\r\n";

// Additional headers
    $headers .= "To: $email" . "\r\n";
    $headers .= 'From: Nome do site <edubado08@gmail.com>';

// Mail it
    mail($to, $subject, $message, $headers);
}
