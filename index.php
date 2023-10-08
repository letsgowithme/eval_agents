<?php
//on demarre la session php
session_start();
$titre = "Accueil";
include_once "includes/header.php";
include_once "includes/navbar.php";

?>

<body class="body_home body_page">
<div class="container text-center d-flex flex-column w-50">
<h1>Agents kgb </h1>    


<button type="button" class="login my-4 fs-4 fw-bold" data-toggle="tooltip" data-placement="top"><a href="inscription.php" style="text-decoration: none;">Créer un agent</a>
</button>
 
<button type="button" class="login my-4 fs-4 fw-bold" data-toggle="tooltip" data-placement="top"><a href="nationalities.php" style="text-decoration: none;">Nationalités</a></button>
          
<?php


include_once "includes/footer.php";
?>
