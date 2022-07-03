<head>
	<link rel="stylesheet" href="src/assets/styles/header.css">

	<!-- Latest compiled and minified CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<!-- Latest compiled JavaScript -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<header>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
        <div class="container-fluid">
			<a class="navbar-brand" href="index.php">
				<img src="src/assets/images/logo-jungla-x.png" alt="Jungla logo" id="logo-img">
			</a>

			<?php if( isset($_SESSION['username']) ||  isset($_SESSION['email'])){ ?>

			<input type="text" id="session-fullname" value="<?php echo $_SESSION['fullname']?>" hidden>
			<input type="text" id="session-username" value="<?php echo $_SESSION['username']?>" hidden>
			<input type="text" id="session-email" value="<?php echo $_SESSION['email']?>" hidden>
			<input type="text" id="session-image" value="<?php echo $_SESSION['image']?>" hidden>

			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="mynavbar">
				<ul class="navbar-nav me-auto">
					<li class="nav-item">
						<a class="nav-link" href="index.php">Inicio</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="history.php">Historial</a>
					</li>

					<?php if($_SESSION['privilege'] == 1){ ?>
					<li class="nav-item">
						<a class="nav-link" href="users.php">Usuarios</a>
					</li>
					<?php } ?>
					<li class="nav-item">
						<a class="nav-link" href="settings.php">Configuración</a>
					</li>
				</ul>

				<div class="dropdown me-3">
					<button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown">
					<?php echo $_SESSION['username'] ?>
					</button>
					<ul class="dropdown-menu dropdown-menu-end">
						<li><a class="dropdown-item disabled" href="#" id=""><?php echo $_SESSION['email'] ?></a></li>
						<li><a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#update-user-modal">Editar perfil</a></li>
						<li><a class="dropdown-item" href="API/sessions/logout.php">Cerrar sesión</a></li>
					</ul>
				</div>

				<a class="navbar-brand" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#show-user-image">
      				<img src="<?php echo $_SESSION['image']; ?>" alt="Avatar Logo" id="avatar-img"> 
    			</a>

			</div>
			<?php } ?>
	  	</div>
    </nav>

</header>

<?php if( isset($_SESSION['username']) ||  isset($_SESSION['email'])){ ?>

		<!-- Imagen de perfil -->
		<div class="modal fade" id="show-user-image">
			<div class="modal-dialog modal-lg modal-dialog-centered">
				<div class="modal-content">
					<img src="<?php echo $_SESSION['image']; ?>" alt="Avatar logo" class="w-100 h-100" style="object-fit: cover;">
				</div>
			</div>
		</div>

		<!-- Actualizar información de usuario -->
		<div class="modal fade" id="update-user-modal">
			<div class="modal-dialog modal-lg modal-dialog-centered">
				<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Actualizar información</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" id="close-user-form"></button>
				</div>

				<form action="" method="POST" id="user-update-form" enctype="multipart/form-data">
					<!-- Modal body -->
					<div class="modal-body d-flex justify-content-center flex-wrap-reverse">

						<div class="flex-fill">

							<div class="form-floating mb-3 mt-3">
								<input type="text" class="form-control" id="user-name" placeholder="Nombre" name="user-name">
								<label for="user-name">Nombre</label>
							</div>

							<div class="form-floating mt-3 mb-3">
								<input type="text" class="form-control" id="user-user" placeholder="Usuario" name="user-user">
								<label for="user-user">Usuario</label>
							</div>

							<div class="form-floating mb-3 mt-3">
								<input type="email" class="form-control" id="user-email" placeholder="Email" name="user-email">
								<label for="user-email">Email</label>
							</div>

						</div>

						<div class="flex-fill mx-5 shadow rounded-3" id="box">
							<img src="" alt="" class="w-100 h-100" id="image-btn">
							<div id="hover">
								<a class="hover-a" href="javascript:void(0)">Cambiar foto &nbsp;&nbsp;<i class="fa fa-image"></i></a>
							</div>
							<input type="file" name="user-image" id="user-image" hidden>
						</div>

					</div>

					<!-- Modal footer -->
					<div class="modal-footer">
						<input type="submit" class="btn btn-success" data-bs-dismiss="modal" name="user-update" id="<?php echo $_SESSION['user_code'] ?>" value="Guardar cambios">
					</div>

				</form>

				</div>
			</div>
		</div>
	
		<script src="src/js/user.js"></script>

<?php } ?>