<?php include_once 'API/sessions/authorization.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial</title>

    <link rel="stylesheet" href="src/assets/styles/history.css">
</head>
<body>
    <?php include_once 'header.php'; ?>

    <main class="container" id="main">

        <h2 class="text-center my-5">Entradas</h2>

        <div class="table-responsive">

            <table class="table table-hover" id="entries-table">
                <thead>
                    <tr>
                        <th>No. Entrada</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Entregó</th>
                        <th>Recibió</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            
        </div>

        <h2 class="text-center my-5">Salidas</h2>

        <div class="table-responsive">

            <table class="table table-hover mb-5" id="outputs-table">
                <thead>
                    <tr>
                        <th>No. Salida</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Entregó</th>
                        <th>Recibió</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

        </div>


        <!-- The Modal update entry -->
        <div class="modal fade" id="entry-modal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                <form action="" method="POST" id="entry-form">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Modificar entradas</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">

                        <div class="form-floating mb-3 mt-3">
								<input type="text" class="form-control" id="product-entry" placeholder="Producto" name="product-entry">
								<label for="product-entry">Producto</label>
							</div>

							<div class="form-floating mt-3 mb-3">
								<input type="number" class="form-control" id="amount-entry" placeholder="Cantidad" name="amount-entry">
								<label for="amount-entry">Cantidad</label>
							</div>

							<div class="form-floating mb-3 mt-3">
								<input type="text" class="form-control" id="delivered-entry" placeholder="Entregó" name="delivered-entry">
								<label for="delivered-entry">Entregó</label>
                        </div>
                    
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-danger" data-bs-dismiss="modal" value="Guardar cambios">
                    </div>
                </form>

                </div>
            </div>
        </div>


        <!-- The Modal update output-->
        <div class="modal fade" id="output-modal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                <form action="" method="POST" id="output-form">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Modificar salidas</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        
                        <div class="form-floating mb-3 mt-3">
								<input type="text" class="form-control" id="product-output" placeholder="Producto" name="product-output">
								<label for="product-output">Producto</label>
							</div>

							<div class="form-floating mt-3 mb-3">
								<input type="number" class="form-control" id="amount-output" placeholder="Cantidad" name="amount-output">
								<label for="amount-output">Cantidad</label>
							</div>

							<div class="form-floating mb-3 mt-3">
								<input type="text" class="form-control" id="received-output" placeholder="Recibió" name="received-output">
								<label for="received-output">Recibió</label>
                        </div>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-danger" data-bs-dismiss="modal" value="Guardar cambios">
                    </div>
                </form>

                </div>
            </div>
        </div>


    </main>

    <?php switch ($user) {
        case 1: ?>
            <script src="src/js/history.js"></script>
        <?php break;

        case 2:?>
            <script src="src/js/other/history.js"></script>
        <?php break;

        case 3:?>
            <script src="src/js/other/history.js"></script>
        <?php break;
        
        default: ?>
            <script src="src/js/other/undefined.js"></script>
            <?php die();  
        }?>
    
</body>
</html>