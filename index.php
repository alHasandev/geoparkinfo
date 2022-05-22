<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Geopark Info - ULM Informasi Geografis</title>
  <!-- Favicon-->
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
  <!-- Font Awesome icons (free version)-->
  <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
  <!-- Google fonts-->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />

  <!-- Leaflet Modules-->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
  <!-- Make sure you put this AFTER Leaflet's CSS -->
  <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin="" defer></script>

  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="assets/css/styles.css" rel="stylesheet" />

  <!-- Local Modules -->
  <link rel="stylesheet" href="assets/css/main.css">
  <script src="assets/js/main.js" defer></script>
</head>

<body id="page-top">

  <!-- Content -->
  <?php

  // Control Layouts
  $topLayouts = [
    'layouts/navbar.php',
  ];
  $bottomLayouts = [
    'layouts/footer.php',
  ];

  // Control Page
  define('PAGE_DIR', 'pages');
  $page = @$_GET['page'] ?: 'home';
  $file = @$_GET['file'] ?: 'index';

  // Include top layouts
  foreach ($topLayouts as $layout) {
    if (file_exists($layout)) {
      include $layout;
    }
  }


  if (file_exists(PAGE_DIR . "/$page/$file.php")) {
    include PAGE_DIR . "/$page/$file.php";
  } else {
    include "layouts/page-not-found.php";
  }

  // Include bottom layouts
  foreach ($bottomLayouts as $layout) {
    if (file_exists($layout)) {
      include $layout;
    }
  }

  ?>
  <!-- /Content -->




  <!-- Bootstrap core JS-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Core theme JS-->
  <script src="assets/js/scripts.js"></script>
  <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
  <!-- * *                               SB Forms JS                               * *-->
  <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
  <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
  <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>