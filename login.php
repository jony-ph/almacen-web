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
    <title>Inicio</title>
</head>
<body>

    <?php include_once 'header.php'; ?>

    <div class="border p-5 d-flex row justify-content-center w-50 mx-auto shadow-sm h-100" style="margin-top:25vh; border-radius:10px;">
        <h1 class="text-center">Almacén</h1>

        <!-- <img src="src/assets/images/Jungla.png" alt="Logo de Jungla"> -->

        <form action="" method="POST" id="login-form">
            <div class="mb-4 mt-5">
                <input type="text" class="form-control" id="user" placeholder="Correo electrónico o usuario" name="user">
            </div>
            <div class="mb-4">
                <input type="password" class="form-control" id="pswd" placeholder="Contraseña" name="pswd">
            </div>
            <input type="submit" class="btn btn-primary form-control mb-3" value="Iniciar sesión">

        </form>

        <div class="alert alert-danger fade show" id ="login-alert" hidden>
        </div>
    </div>

    <script src="src/js/login.js"></script>

</body>
</html>