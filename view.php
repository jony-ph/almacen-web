<?php require_once 'API/sessions/authorization.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product</title>

  <link rel="stylesheet" href="src/assets/styles/view.css">
</head>
<body>
  <?php include_once 'header.php'; ?>

  <main class="container d-flex align-items-center" id="main">
    <div class="card d-flex row justify-content-center border p-5 mx-auto shadow-sm col-md-5" style="width:400px">
      <!-- <img class="card-img-top" src="img_avatar1.png" alt="Card image"> -->
      <div class="card-body">
        <h4 class="card-title" id="id-pdt"></h4>
        <p class="card-text" id="nam"></p>
        <p class="card-text" id="dct"></p>
        <p class="card-text" id="amt"></p>
        <p class="card-text" id="ctg"></p>

        <a href="index.php" class="btn btn-link w-100">Volver</a>
    </div>
</div>
  </main>

  <script src="src/js/view.js"></script>

</body>
</html>