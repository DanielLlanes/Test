<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Prueba - <?php echo isset($title) ? $title : 'Prueba'; ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <script src="https://accounts.google.com/gsi/client" async></script>
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="App/Views/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="App/Views/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <script src="App/Views/assets/js/custom.js"></script>

  <!-- Template Main CSS File -->
  <link href="App/Views/assets/css/main.css" rel="stylesheet">

  <style>
    .card {
      box-shadow: -3px -3px 9px #aaa9a9a2,
        3px 3px 7px rgba(147, 149, 151, 0.671);
      border-color: rgba(255, 255, 255, 0);
    }

    .form-control:focus {
      color: var(--bs-body-color);
      background-color: var(--bs-body-bg);
      border-color: transparent;
      outline: 0;
      box-shadow: 0 0 0 0.25rem rgba(212, 213, 214, 0.25);
    }

    ::placeholder {
      color: rgb(175, 171, 171) !important;
      /* Cambia el color del texto del placeholder a rojo */
    }
  </style>

  <!-- =======================================================
  * Template Name: Append
  * Template URL: https://bootstrapmade.com/append-bootstrap-website-template/
  * Updated: Mar 17 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page" data-bs-spy="scroll" data-bs-target="#navmenu">

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container-fluid d-flex align-items-center justify-content-between">



    </div>
  </header><!-- End Header -->

  <main id="main">
    <?php echo isset($content) ? $content : ''; ?>
  </main>

  <!-- Scroll Top Button -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
  </div>

  <!-- Vendor JS Files -->
  <script src="App/Views/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="App/Views/assets/js/main.js"></script>



  <?php echo isset($scripts) ?>
</body>

</html>