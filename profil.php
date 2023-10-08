<?php
session_start();
$titre = "Accueil";
include_once "includes/header.php";
include_once "includes/navbar.php";

?>
</head>
<body class="body_home body_page">
<div class="container text-center d-flex flex-column w-50">
<h1>Profil de <?= $_SESSION["user"]["lastname"] ?></h1> 
<h1>Connexion</h1>

<p>Nom: <?= $_SESSION["user"]["lastname"] ?></p>
<p>Prénom: <?= $_SESSION["user"]["firstname"] ?></p>
<p>Email: <?= $_SESSION["user"]["email"] ?></p>
<p>Date de naissance: <?= $_SESSION["user"]["birthdate"] ?></p>


          
<?php


include_once "includes/footer.php";
?>
