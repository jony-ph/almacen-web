<?php

    session_start();

    if( isset($_SESSION['username']) || isset($_SESSION['email']) ){
        header('Location: index.php');
    }

    if( isset($_GET['email'], $_GET['token']) ) {
        $email = $_GET['email'];
        $token = $_GET['token'];
    } else {
        header("Location: login.php");
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
            <div class="mt-4">
                <p>La contraseña debe contener: </p>
                <ul>
                    <li>Más de 8 caracteres</li>
                    <li>Al menos una letra mayúscula</li>
                    <li>Al menos una letra minúscula</li>
                    <li>Al menos un caracter especial</li>
                    <li>Al menos un número</li>
                </ul>
            </div>

            <form action="" method="POST" id="change-password">
                <div class="mb-4 mt-3">
                    <input type="password" class="form-control" id="f-new-password" placeholder="Nueva contraseña" name="f-new-password">
                </div>
                <div class="mb-4 mt-3">
                    <input type="password" class="form-control" id="f-confirm-password" placeholder="Confirmar contraseña" name="f-confirm-password">
                </div>
                <input type="hidden" id="email" name="email" value="<?php echo $email ?>">
                <input type="hidden" id="token" name="token" value="<?php echo $token ?>">
                
                <input type="submit" class="btn btn-primary form-control mb-3" value="Guardar cambios">
            </form>

            <a href="index.php" class="btn btn-link form-control mb-3">Cancelar</a>

            <div class="alert alert-danger fade show" id ="login-alert" hidden>
            </div>
        </div>
    </main>

    <script src="src/js/change_pass.js" type="module"></script>

</body>
</html>