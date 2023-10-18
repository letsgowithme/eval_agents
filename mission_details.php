<?php 
$mission_details=true;
//on demarre la session php
session_start();
//on verifie s'il ya un id
if (!isset($_GET["id"]) || empty($_GET["id"])){
  header("Location: mission_details.php");
  exit;
}

$id = $_GET["id"];
require_once "includes/DB.php";
$sql = "SELECT * FROM `mission` WHERE id = :id";
$query = $dbConnect->prepare($sql);
$query->bindValue(":id", $id, PDO::PARAM_INT);
$query->execute();
$mission = $query->fetch();

if(!$mission) {
    http_response_code(404);
    echo "Page non trouvée";
    exit;
}
//ici on a la nationalité

$title = strip_tags($mission["title"]);

include_once "includes/header.php";
include_once "includes/navbar.php";

?>
</head>
<body class="body_page">
  <div class="container">
    <div class="d-flex justify-content-between">
<h1 style="color: #1c1c22;">Mission numéro  <?= strip_tags($mission['id']) ?></h1><button class="btn border" style="background: lightgray;"><a 
class="fs-6" style="font-weight: bold; color:darkslategrey; text-decoration: none;" 
aria-current="page" href="missions.php" id="up">Missions</a></button>
</div>
<table width="100%" border="2" cellspacing="5" cellpadding="15" style="background: #1c1c22; color: #b2b2b5; padding: 10px;" class="mt-4">
<tr>
<td class="w-25">Titre</td>
<td><?= strip_tags($mission['title']) ?></td>
</tr>
<tr>
<td>Déscription</td>
<td><?= strip_tags($mission['description']) ?></td>
</tr>
<tr>
<td>Date de debut</td>
<td><?= strip_tags($mission['startDate']) ?></td>
</tr>
<tr>
<td>Date de fin</td>
<td><?= strip_tags($mission['endDate']) ?></td>
</tr>
<tr>
<td>Pays</td>
<td><?= strip_tags($mission['country']) ?></td>
</tr>
<tr>
<td>Status</td>
<td><?= strip_tags($mission['missionStatus']) ?></td>
</tr>
<tr>
<td>Nome de code</td>
<td><?= strip_tags($mission['codeName']) ?></td>
</tr>
</table>

<div class="text-center fs-4 fw-bold">
<button type="button" class="login my-4" data-toggle="tooltip" data-placement="top"><a href="index.php">Accueil</button>
</div>
</div>

<?php 
include_once "includes/footer.php"; 
?> 