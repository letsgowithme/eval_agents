<?php
//on demarre la session php
session_start();
$index=true;
$titre = "Accueil";
include_once "includes/header.php";
include_once "includes/navbar.php";
?>
<body class="body_home body_page">
<div class="container text-center d-flex flex-column w-50" style="height: 87vh;">
<h1 class="mt-4">Bienvenue sur le site des agents secrets</h1> 
</div>           
<?php
include_once "includes/footer.php";
?>
