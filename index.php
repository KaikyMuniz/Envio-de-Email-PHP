<?php
    require_once('src/PHPMailer.php');
    require_once('src/SMTP.php');
    require_once('src/Exception.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    $mail = new PHPMailer(true);

    try {
        // Diminui a segurança, mas necessário nesse pequeno projeto
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'seuemail@gmail.com';
        $mail->Password = 'sua senha';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->CharSet = 'utf8';

        $mail->setFrom('seuemail@gmail.com');
        $mail->addAddress('destinatario@gmail.com');

        $mail->isHTML(true);
        $mail->Subject = "Título do email";
        $mail->Body = "
        <html>
            <head>
                <meta charset='utf-8'>
            </head>
            <body>
                <h1>Olá mundo</h1>
                <p>Testando email</p>
            </body>
        </html>";
        $mail->AltBody = "Chegou um email";

        if($mail->send()) {
            echo "Email enviado!";
        }else{
            echo "Email não enviado";
        }
    } catch (Exception $e) {
        echo "Erro ao enviar mensagem {$mail->ErrorInfo}";
    }
?>