<?php

    session_start();

    if( isset($_SESSION['username']) || isset($_SESSION['email']) ){
        header('Location: index.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cambiar contraseña</title>

  <link rel="stylesheet" href="src/assets/styles/login.css">

</head>
<body>
  
  <?php include_once 'header.php'; ?>

  <main class="main d-flex align-items-center">
        <div class="d-flex row justify-content-center border p-5 mx-auto shadow-sm col-md-5" style="border-radius:10px;">
            
            <div class="mx-auto text-center">
                <img src="src/assets/images/logo-jungla.png" alt="Jungla logo">
            </div>

            <form action="" method="POST" id="reset-pass-form">
                <div class="mb-4 mt-5">
                    <input type="email" class="form-control" id="email-reset" placeholder="Correo electrónico o usuario" name="email-reset">
                </div>
                <input type="submit" class="btn btn-primary form-control mb-3" value="Enviar código">
            </form>

            <a href="index.php" class="btn btn-link form-control mb-3">Cancelar</a>

            <div class="alert alert-danger fade show" id ="login-alert" hidden>
            </div>
        </div>
    </main>

    <script src="src/js/reset.js"></script>

</body>
</html>