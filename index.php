<?php require_once 'API/sessions/authorization.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Jungla</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet"type="text/css" href="src/assets/styles/index.css">
  <link rel="stylesheet" href="src/assets/styles/history.css">


</head>
<body>
  
  <?php include_once 'header.php'; ?>
  <div id="root">
   <div id="main-page"></div>
  </div>

  <script src="src/js/router.js"></script>
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
      <?php
      
      die();  
  }?>

</body>
</html>