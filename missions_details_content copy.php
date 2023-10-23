<?php 
$mission_details=true;
//on demarre la session php

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


?>
<div class="body_page_new py-4">
  <div>

<h1 class="text-white">Mission <strong><?= strip_tags($mission['title']) ?></strong> numéro  <?= strip_tags($mission['id']) ?></h1>

<table width="100%" border="2" cellspacing="5" cellpadding="15" style="background: #1c1c22; color: #b2b2b5; padding: 10px;" class="mt-4 w-75">
<tr>
<td class="hidden">Id</td>
<td class="hidden"><?= strip_tags($mission['id']) ?></td>
</tr>
<tr>
<td class="w-25">Titre</td>
<td class="w-50"><?= strip_tags($mission['title']) ?></td>
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
<tr>
<td>Type de mission</td>
<td><?= strip_tags($mission['missionType']) ?></td>
</tr>
</table>

</div>
</div>