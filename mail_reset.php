<?php
// Varios destinatarios
$to  = $email;

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
  <h1>Jungla almac&#233;n</h1>

  <div style="text-align:center;">
    <p>Ingrese el siguiente c&#243;digo para confirmar que usted es qui&#233;n desea cambiar su contraseña. </p>
    <p>C&#243;digo de confirmaci&#243;n:</p>
    <h3>'.$code.'</h3>

    <p>Ingresa al link para confirmar el c&#243;digo:
     <a href="https://junglalmacen.com/verification_code.php?email='.$to.'&token='.$token.'">Confirmar c&#243;digo</a>
    </p>
  </div>

  <p>Si usted no envi&#243 este c&#243;digo, ignore este correo.</p>
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