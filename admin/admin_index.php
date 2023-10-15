<?php
//on demarre la session php
session_start();
$titre = "Accueil";
include_once "includes/admin_header.php";
include_once "includes/admin_navbar.php";

?>
 <link href="../style/style.css" rel="stylesheet" type="text/css">
  <link rel="icon" href="../logo.png">
</head>
<body class="body_home body_page">
<div class="container text-center d-flex flex-column w-50">
<h1>Administration</h1>
<!-- <button class="btn border" style="background: lightgray;"><a 
class="fs-6" style="font-weight: bold; color:darkslategrey; text-decoration: none;" 
aria-current="page" href="admin_index.php" id="up">Admin</a></button>    -->


<!-- <button type="button" class="login my-4 fs-4 fw-bold" data-toggle="tooltip" data-placement="top"><a href="admin/inscription.php" style="text-decoration: none;">Créer un agent</a>
</button>
  -->

          
<?php


include_once "includes/admin_footer.php";
?>
