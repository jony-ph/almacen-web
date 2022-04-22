<?php require_once 'API/sessions/authorization.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuraciones</title>

    <link rel="stylesheet" href="src/assets/styles/settings.css">
</head>
<body>

    <?php include 'header.php'; ?>

    <main class="main">

        <div class="container mt-5">

            <h3 class="my-4">Configuraciones de usuario</h3>
            <ul>
                <li>
                    <a href="javascript:void(0)" id="update-password" class="m-5" data-bs-toggle="modal" data-bs-target="#update-password-modal">Cambiar contraseña</a>
                </li>
            </ul>
                
            <h3 class="my-4">Configuraciones de privilegios</h3>
            <div class="table-responsive">
                <table class="table table-hover mb-4" id="table-privileges">
                    <thead>
                        <tr class="table-dark">
                            <th colspan="3" class="text-center">Privilegios</th>
                        </tr>
                        <tr>
                            <th>Privilegio</th>
                            <th>Descripción</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#add-privilege-modal">Nuevo privilegio</button>

        </div>
        <!-- The Modal Password -->
        <div class="modal fade" id="update-password-modal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Cambiar contraseña</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="" method="POST" id="update-password-form">

                    <!-- Modal body -->
                    <div class="modal-body">
                    <div class="form-floating mb-3 mt-3">
                            <input type="password" class="form-control" id="current-password" placeholder="Contraseña actual" name="current-password">
                            <label for="current-password">Contraseña actual</label>
                        </div>

                        <div class="form-floating mb-3 mt-3">
                            <input type="password" class="form-control" id="new-password" placeholder="Nueva contraseña" name="new-password">
                            <label for="current-password">Nueva contraseña</label>
                        </div>

                        <div class="form-floating mb-3 mt-3">
                            <input type="password" class="form-control" id="confirm-password" placeholder="Confirmar contraseña" name="confirm-password">
                            <label for="confirm-password">Confirmar contraseña</label>
                        </div>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-success" data-bs-dismiss="modal" value="Cambiar contraseña">
                    </div>

                </form>

                </div>
            </div>
        </div>

        <!-- The Modal Update privilege -->
        <div class="modal fade" id="update-privilege-modal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Editar privilegios</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form action="" method="POST" id="update-privilege-form">

                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="form-floating mb-3 mt-3">
                                <input type="text" class="form-control" id="privilege-update" placeholder="Privilegio" name="privilege-update">
                                <label for="privilege-update">Privilegio</label>
                            </div>
                            <div class="form-floating mb-3 mt-3">
                                <textarea type="text" class="form-control" id="description-privilege-update" placeholder="Descripción" name="description-privilege-update"></textarea>
                                <label for="description-privilege-update">Descripción</label>
                            </div>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-success" data-bs-dismiss="modal" value="Guardar cambios">
                        </div>

                    </form>

                </div>
            </div>
        </div>

        <!-- The Modal add privilege -->
        <div class="modal fade" id="add-privilege-modal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Nuevo privilegio</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form action="" method="POST" id="add-privilege-form">

                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="form-floating mb-3 mt-3">
                                <input type="text" class="form-control" id="privilege-add" placeholder="Privilegio" name="privilege-add">
                                <label for="privilege-add">Privilegio</label>
                            </div>
                            <div class="form-floating mb-3 mt-3">
                                <textarea type="text" class="form-control" id="description-privilege-add" placeholder="Descripción" name="description-privilege-add"></textarea>
                                <label for="description-privilege-add">Descripción</label>
                            </div>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-success" data-bs-dismiss="modal" value="Guardar cambios">
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </main>

    <?php switch ($user) {
        case 1: ?>
            <script src="src/js/settings.js"></script>
        <?php break;

        case 2:?>
            <script src="src/js/other/settings.js"></script>
        <?php break;

        case 3:?>
            <script src="src/js/other/settings.js"></script>
        <?php break;
        
        default: ?>
            <script src="src/js/other/undefined.js"></script>
            <?php die();  
        }?>

</body>
</html>