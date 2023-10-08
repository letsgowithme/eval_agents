<?php 
//on demarre la session php
session_start();
require_once "includes/DB.php";

$sql = "SELECT * FROM `nationality`";


//on exec la requete
// $requete = $dbConnect->prepare($sql);
// $requete->bindValue(1, $title, PDO::PARAM_STR);
// $requete->bindValue(1, $_POST["nationalityName"]);
$requete = $dbConnect->query($sql);
$requete->execute();
$nations = $requete->fetchALL(PDO::FETCH_ASSOC);

include_once "includes/header.php";
include_once "includes/navbar.php";
$titre = "Nationalité";
?>

</head>
<body class="body_page">
  <div class="container">
  <button type="button" class="login my-4" data-toggle="tooltip" data-placement="top"><a href="nationality.php">Créer la nationalité</button>
<h1>La liste de nationalités</h1>
<section>
<?php foreach($nations as $nation): ?>

    <h4><a href="nation.php?id=<?= $nation["id"] ?>"><?= strip_tags($nation['title']) ?></a></h>
    </h4>
  
  <?php endforeach; ?>
  </section>
<div class="text-center fs-4 fw-bold">
<button type="button" class="login my-4" data-toggle="tooltip" data-placement="top"><a href="index.php">Accueil</button>
</div>
</div>

<?php 
include_once "includes/footer.php"; 
?> 