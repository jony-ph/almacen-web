<?php
// Varios destinatarios
$to  = $email . ',';

// Título
$title = 'Restablecer contraseña';

// Código
$code = rand(10000, 99999);

// Mensaje
$message = '
<html>
<head>
  <title>Restablecer contraseña</title>
</head>
<body>
  <h1>Jungla almacén</h1>

  <div style="text-align:center;">
    <p>Ingrese el siguiente código para confirmar que usted es quién desea cambiar su contraseña. </p>
    <p>Código de confirmación:</p>
    <h3>'.$code.'</h3>

    <p>Ingresa al link para confirmar el código:
     <a href="https://junglalmacen.com/verification_code.php?email='.$to.'&token='.$token.'">Confirmar código</a>
    </p>
  </div>

  <p>Si usted no envio este código, ignore este correo.</p>
</body>
</html>
';

// Para enviar un correo HTML, debe establecerse la cabecera Content-type
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// headers adicionales
// $headers .= 'To: <'.$to.'>' . "\r\n";
// $headers .= 'From: Restablecer contraseña <soporte@junglalmacen.com>' . "\r\n";
// $headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
// $headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";

// Enviarlo
$issend = false;
if ( mail($to, $title, $message, $headers) ){
  $issend = true;
}