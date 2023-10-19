<?php 
$user_details=true;
//on demarre la session php
session_start();
//on verifie s'il ya un id
if (!isset($_GET["id"]) || empty($_GET["id"])){
  header("Location: user_details.php");
  exit;
}

$id = $_GET["id"];
require_once "../../includes/DB.php";
$sql = "SELECT * FROM `user` WHERE id = :id";
$query = $dbConnect->prepare($sql);
$query->bindValue(":id", $id, PDO::PARAM_INT);
$query->execute();
$row = $query->fetch();

if(!$row) {
    http_response_code(404);
    echo "Page non trouvée";
    exit;
}
//ici on a la nationalité



include_once "../../includes/header.php";
include_once "../../includes/navbar.php";

?>
<link rel="stylesheet" href="../../style/style.css">
</head>
<body class="body_page">
  <div class="container">
    <div class="d-flex justify-content-between mt-3">
<h1 style="color: #1c1c22;">Utilisateur numéro  <?= strip_tags($row['id']) ?></h1>
<div class="mt-2">
<button class="btn border" style="background: lightgray;"><a 
class="fs-6" style="font-weight: bold; color:darkslategrey; text-decoration: none;" 
aria-current="page" href="../lists/usersAll.php" id="up">Utilisateurs</a></button>
   
<button class="btn border" style="background: lightgray;"><a 
class="fs-6" style="font-weight: bold; color:darkslategrey; text-decoration: none;" 
aria-current="page" href="../admin_index.php" id="up">Tableau de bord</a></button>
</div>
</div>
<table width="100%" border="2" cellspacing="5" cellpadding="15" style="background: #1c1c22; color: #b2b2b5; padding: 10px;" class="mt-4">
<tr class="text-center">
<td class="w-50 text-center">Nom</td>
<td><?= strip_tags($row['lastname']) ?></td>
</tr>
<tr class="text-center">
<td>Prénom</td>
<td><?= strip_tags($row['firstname']) ?></td>
</tr>
<tr class="text-center">
<td>Date de naissance</td>
<td><?= strip_tags($row['birthdate']) ?></td>
</tr>
<tr class="text-center">
<td>Email</td>
<td><?= strip_tags($row['email']) ?></td>
</tr>
<tr class="text-center">
<td>Nationalité</td>
<td><?= strip_tags($row['nationality']) ?></td>
</tr>
<tr class="text-center">
<td>Nom de code</td>
<td><?= strip_tags($row['codeName']) ?></td>
</tr>

<tr class="text-center">
<td>Type</td>
<td><?= strip_tags($row['userType']) ?></td>
</tr>
<tr class="text-center">
<td>Specialitiés</td>
<td><?= strip_tags($row['specialities']) ?></td>
</tr>
<tr>

</table>

<div class="text-center fs-4 fw-bold">
<button type="button" class="login my-4" data-toggle="tooltip" data-placement="top"><a href="index.php">Accueil</button>
</div>
</div>

<?php 
include_once "../../includes/footer.php"; 
?> 