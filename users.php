<?php require_once 'API/sessions/authorization.php'; ?>

<?php 
	if ($_SESSION['privilege'] != 1) {
		header("Location: index.php");
		die('No tienes acceso');
	} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>

	<link rel="stylesheet" href="src/assets/styles/users.css">
</head>
<body>

	<?php include_once 'header.php' ?>

	<h3 class="text-center pt-5 pb-3" style="margin-top: 56px;">Usuarios</h3>

	<div class="container">

		<!-- <table class="table">
			<thead>
				<tr>
					<th>Código</th>
					<th>Nombre</th>
					<th>Usuario</th>
					<th>Email</th>
					<th>Privilegio</th>
				</tr>
			</thead>
			<tbody>
				<tr>
				</tr>
			</tbody>
		</table> -->

		<div class="container-users-table">

			<div class="table-responsive">
				<table class="table table-hover" id="table-users">
					<thead>
						<tr>
							<th>Código</th>
							<th>Nombre</th>
							<th>Usuario</th>
							<th>Email</th>
							<th>Privilegio</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>

			</div>

		</div>

		<button type="submit" name="register" id="register" class="btn btn-outline-primary mt-4" data-bs-toggle="modal" data-bs-target="#myModal">Registrar usuario</button>

	</div>


	<!-- The Modal -->
	<div class="modal fade" id="myModal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Registrar usuario</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>

				<!-- Modal body -->
				<div class="modal-body">
					
				<form action="" method="POST" class="mx-5" id="user-form" enctype="multipart/form-data">

					<div class="input-group py-2">
						<span class="input-group-text">&nbsp;&nbsp;&nbsp;Nombre&nbsp;&nbsp;</span>
						<input type="text" id="fullname" class="form-control" placeholder="Nombre completo" name="fullname">
					</div>

					<div class="input-group py-2">
						<span class="input-group-text">&nbsp;&nbsp;&nbsp;Usuario&nbsp;&nbsp;&nbsp;</span>
						<input type="text" id="username" class="form-control" placeholder="Nombre de usuario" name="username">
					</div>

					<div class="input-group py-2">
						<span class="input-group-text">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
						<input type="email" id="email" class="form-control" placeholder="Correo electrónico" name="email">
					</div>

					<div class="input-group py-2">
						<span class="input-group-text">Contraseña</span>
						<input type="password" id="psdw" class="form-control" placeholder="Contraseña" name="pswd">
					</div>

					<div class="input-group py-2">
						<span class="input-group-text">&nbsp;&nbsp;Privilegio&nbsp;</span>
						<select class="form-select" name="privilege" id="privilege">
						</select>
					</div>

					<div class="py-2 d-flex flex-column justify-content-center align-items-center border border-1" id="drop-area">
						<h2 class="mt-5" id="drop-title">Arrastra y suelta imágen</h2>
						<span class="my-3">Ó</span>
						<button class="btn btn-outline-primary mb-5" id="btn-image">Selecciona imagen</button>
						<input type="file" id="image" name="file-img" hidden>
					</div>
					<div id="preview"></div>

					<button type="submit" name="register" id="register" class="btn btn-primary my-2 w-100" data-bs-dismiss="modal">Registrar usuario</button>

					</form>



				</div>

			</div>
		</div>
	</div>

	<script src="src/js/sessions.js"></script>
    
</body>
</html>