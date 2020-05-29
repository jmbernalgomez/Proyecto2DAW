<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1 user-scalable=no">
        <title>ENVIO DE DATOS</title>
        <link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    </head>
<body>

<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../functions/mails/Exception.php';
require '../functions/mails/PHPMailer.php';
require '../functions/mails/SMTP.php';

$destino = $_POST['email'];
$asunto = "Restablecer password";

$token = bin2hex(random_bytes(64));


// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'noreplykonema@gmail.com';                     // SMTP username
    $mail->Password   = '12345678!.';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('noreplykonema@gmail.com', 'Konema | Plataforma de videos');
    $mail->addAddress($destino);

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $asunto;
    $mail->Body    = "<h2 style='border-bottom: 6px solid #2abf88; padding-bottom: 5px;'>Restablecer contraseña</h2>
                      <p>Para poder restablecer su contraseña haga click en el siguiente enlace:</p>
                      <a href='http://www.jmbernal.es.mialias.net/jmproyecto/restablecer_pass_form.php?token=$token&email=$destino' style='background: #2abf88; color:white; border: none; padding: 10px; font-weight: bold; text-decoration:none;'>¡Click aquí!</a>
                      <p>Una vez que cambie su contraseña ya podrá ingresar a nuestra plataforma con ésta. Le recordamos que puede guardar su contraseña en algún sitio privado para no olvidarla.</p>
                      ";

    $mail->send();
    header("Location: ../../index.php");
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}



?>

</body>
</html>