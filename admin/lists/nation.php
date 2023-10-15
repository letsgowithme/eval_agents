<?php 
//on demarre la session php
session_start();
//on verifie s'il ya un id
if (!isset($_GET["id"]) || empty($_GET["id"])){
  header("Location: nationality.php");
  exit;
}

$id = $_GET["id"];
require_once "includes/DB.php";
$sql = "SELECT * FROM `nationality` WHERE id = :id";
$requete = $dbConnect->prepare($sql);
$requete->bindValue(":id", $id, PDO::PARAM_INT);
$requete->execute();
$nation = $requete->fetch();

if(!$nation) {
    http_response_code(404);
    echo "Page non trouvée";
    exit;
}
//ici on a la nationalité

$titre = strip_tags($nation["title"]);

include_once "includes/header.php";
include_once "includes/navbar.php";

?>
</head>
<body class="body_page">
  <div class="container">
<h2>Nationalité</h2>
<section>
    <h4>
      <?= strip_tags($nation['title']) ?>
    </h4>
  
  </section>
<div class="text-center fs-4 fw-bold">
<button type="button" class="login my-4" data-toggle="tooltip" data-placement="top"><a href="index.php">Accueil</button>
</div>
</div>

<?php 
include_once "includes/footer.php"; 
?> 