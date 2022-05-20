<?php require_once 'API/sessions/authorization.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet"type="text/css" href="src/assets/styles/index.css">

</head>

<body>
    <?php include_once 'header.php'; ?>

    <div class="d-flex flex-wrap all">

        <div class="sidebar">

            <button class="list-group-item w-100" data-bs-toggle="collapse" data-bs-target="#categories" title="¡Click!"> <b>Categorias</b> </button>

            <div class="list-group collapse show" id="categories">
            </div>

            <form action="" method="POST" class="my-5 px-2" id="add-category">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Nueva categoría" name="category" id="new-category">
                    <button class="btn btn-outline-primary" type="submit"><i class="fa fa-plus"></i></button>
                </div>
            </form>

        </div>

    <div class="container-fluid p-5" id="main">

        <!-- Carousel -->
        <div id="demo" class="carousel slide mb-5" data-bs-ride="carousel">

            <!-- Indicators/dots -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
            </div>

            <!-- The slideshow/carousel -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="src/assets/images/img1.jpg" alt="Los Angeles" class="d-block w-100 carousel-img">
                    <div class="carousel-caption">
                        <h3>Jungla</h3>
                        <p>Almacena tus productos y lleva un mejor control.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="src/assets/images/img2.jpg" alt="Chicago" class="d-block w-100 carousel-img">
                    <div class="carousel-caption">
                        <h3>Simple</h3>
                        <p>Interfaz sencilla para todos los usuarios.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="src/assets/images/img3.jpg" alt="New York" class="d-block w-100 carousel-img">
                    <div class="carousel-caption">
                        <h3>Desarrollo</h3>
                        <p>HTML, Bootstrap, JavaScript, PHP.</p>
                    </div>
                </div>
            </div>

            <!-- Left and right controls/icons -->
            <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>

        </div>

        <h3 class="text-center my-5" id="title">Todo</h3>
        
        <div class="search">
            <form action="" method="GET" id="search-form">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search" name="search" id="search">
                    <button class="btn btn btn-primary px-5" type="submit"><i class="fa fa-search"></i></button>
                </div>
            </form>
        </div>

        <div class="table-responsive">

            <table class="table table-hover my-5" id="table-records">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Categoría</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

        </div>

        <div class="d-flex">

            <div class="letters me-3">
                <kbd><a href="#" style="text-decoration: none; color: #ffffff;" data-bs-toggle="modal" data-bs-target="#modal-add-record">Registrar entrada</a><kbd>
            </div>

            <div class="letters">
                <kbd><a href="#" style="text-decoration: none; color: #ffffff;" data-bs-toggle="modal" data-bs-target="#modal-new-product">Nuevo producto</a><kbd>
            </div>

        </div>
    </div>

    <!-- Modal nuevo producto -->
    <div class="modal fade" id="modal-new-product">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Nuevo producto</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <form action="" method="POST" id="product-form">

                <div class="modal-body">

                    <div class="form-floating my-3">   
                        <input type="number" class="form-control" id="new-product-code" name="new-product-code" placeholder="Código">
                        <label for="new-product-code" class="form-label">Código</label>
                    </div>

                    <div class="form-floating my-3">   
                        <input type="text" class="form-control" id="new-product-name" name="new-product-name" placeholder="Nombre del producto">
                        <label for="new-product-name" class="form-label">Nombre de producto</label>
                    </div>

                    <div class="form-floating my-3">   
                        <textarea type="text" class="form-control" name="new-product-description" id="new-product-description" placeholder="Descripción"></textarea>
                        <label for="new-product-description" class="form-label">Descripción</label>
                    </div>

                    <div class="form-floating my-3">  
                        <select class="form-select" name="new-product-category" id="new-product-category">
                        </select>
                        <label for="new-product-category" class="form-label">Categoría</label>
                    </div>


                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <input type="submit" class="btn btn-success" data-bs-dismiss="modal" value="Guardar">
                </div>
                
            </form>

            </div>
        </div>
    </div>


    <!-- Modal entradas -->
    <div class="modal fade" id="modal-add-record">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Entrada</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <form action="" method="POST" id="entry-form">

                <div class="modal-body">

                    <div class="form-floating my-3">   
                        <select class="form-select" name="product-entry" id="product-entry">
                        </select>
                        <label for="product-entry" class="form-label">Código</label>
                    </div>

                    <div class="form-floating my-3">
                        <input type="number" class="form-control" id="amount-entry" name="amount-entry" placeholder="Cantidad">
                        <label for="amount-entry" class="form-label">Cantidad</label>
                    </div>

                    <div class="form-floating my-3">
                        <input type="text" class="form-control" id="delivered-entry" name="delivered-entry" placeholder="Entregó">
                        <label for="delivered-entry" class="form-label">Entregó</label>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <input type="submit" class="btn btn-success" data-bs-dismiss="modal" value="Guardar">
                </div>
                
            </form>

            </div>
        </div>
    </div>

    <!-- Modal actualizar registros -->
    <div class="modal fade" id="modal-update-record">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Actualizar producto</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <form  action="" method="POST" id="update-form">

                <div class="modal-body">

                    <div class="form-floating my-3">    
                        <input type="text" class="form-control" name="code-update" id="code-update" placeholder="Código">
                        <label for="code-update" class="form-label">Código</label>
                    </div>

                    <div class="form-floating my-3">    
                        <input type="text" class="form-control" name="update-name" id="product-update" placeholder="Nombre">
                        <label for="product-update" class="form-label">Nombre</label>
                    </div>
     
                    <div class="form-floating my-3">    
                        <textarea type="text" class="form-control" name="update-description" id="description-update" placeholder="Descripción"></textarea>
                        <label for="description-update" class="form-label">Descripción</label>
                    </div>

                    <div class="form-floating my-3">  
                        <input type="number" class="form-control" name="update-amount" id="amount-update" placeholder="Cantidad">
                        <label for="amount-update" class="form-label">Cantidad</label>
                    </div>

                    <div class="form-floating my-3">  
                        <select class="form-select" name="update-category" id="category-update">
                        </select>
                        <label for="category-update" class="form-label">Categoría</label>
                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <input type="submit" class="btn btn-success" data-bs-dismiss="modal" value="Guardar">
                </div>
                
            </form>

            </div>
        </div>
    </div>

    <!-- Modal de entrega -->
    <div class="modal fade" id="modal-delivery">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Entrega</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="" method="POST" id="output-form">
                <!-- Modal body -->
                <div class="modal-body">
                                    
                    <div class="form-floating my-3">
                        <input type="text" class="form-control" placeholder="Producto" id="product-output" name="product-output" readonly>
                        <label for="product-delivery" class="form-label">Producto</label>
                    </div>
                    <div class="form-floating my-3">
                        <input type="number" class="form-control" placeholder="Cantidad" id="amount-output" name="amount-output">
                        <label for="amount-delivery" class="form-label">Cantidad</label>
                    </div>

                    <div class="form-floating my-3">
                        <input type="text" class="form-control" placeholder="Producto" id="recived-output" name="recived-output">
                        <label for="recived-output class="form-label">Recibe</label>
                    </div>
                
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                        <input type="submit" class="btn btn-success" data-bs-dismiss="modal" value="Entregar">
                </div>

            </form>

            </div>
        </div>
    </div>


    <!-- The Modal -->
    <div class="modal fade" id="category-update-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Editar categoría</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="" method="POST" id="category-update-form">
                <!-- Modal body -->
                <div class="modal-body">

                    <div class="form-floating my-3">
                        <input type="text" class="form-control" placeholder="Categoría" id="category-update-name" name="category-update-name">
                        <label for="category-update-name">Categoría</label>
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


    </div>

    <!-- Scripts -->

    <?php switch ($user) {
        case 1: ?>
            <script src="src/js/consultas.js" type="module"></script>
        <?php break;

        case 2:?>
            <script src="src/js/other/index_w.js" type="module"></script>
        <?php break;

        case 3:?>
            <script src="src/js/other/index_r.js" type="module"></script>
        <?php break;
        
        default: ?>
            <script src="src/js/other/undefined.js"></script>
            <?php die();  
        }?>
</body>

</html>
