<?php 
$mission_details=true;
if (!isset($_GET["id"]) || empty($_GET["id"])){
  header("Location: mission_details.php");
  exit;
}

$idMission = $_GET["id"];
require_once "includes/DB.php";
$sql = "SELECT * FROM `mission` WHERE id = :id";
$query = $dbConnect->prepare($sql);
$query->bindValue(":id", $idMission, PDO::PARAM_INT);
$query->execute();
$mission = $query->fetch();

if(!$mission) {
    http_response_code(404);
    echo "Page non trouvée";
    exit;
}
$sql = "SELECT * FROM mission_missionType WHERE mmt_missionId='$idMission'";
$query = $dbConnect->prepare($sql);
$query->execute();
while ($row = $query->fetch(PDO::FETCH_ASSOC)):
  $mmt_missionId = $row["mmt_missionId"];
  $mmt_missionTypeId = $row["mmt_missionTypeId"];
endwhile;
 $sql = "SELECT title FROM missionType WHERE id='$mmt_missionTypeId'";
 $query = $dbConnect->prepare($sql);
$query->execute();
$missionType = $query->fetch();
$missionTypeTitle = $missionType[0];

$title = strip_tags($mission["title"]);

?>
<div class="body_page_new py-4">
  <div>

<h1 class="text-white">Mission <strong><?= strip_tags($mission['title']) ?></strong> numéro  <?= strip_tags($mission['id']) ?></h1>

<table width="100%" border="2" cellspacing="5" cellpadding="15" style="background: #1c1c22; color: #b2b2b5; padding: 10px;" class="mt-4 w-75">
<tr>
<td class="hidden">Id</td>
<td class="hidden"><?= strip_tags($mission['idMission']) ?></td>
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
  <!-- ************missionType de La mission************** -->

  <td>
    <span class="hidden">
      <?= $mmt_missionTypeId ?>
    </span>
    <?= $missionTypeTitle ?></td>


</tr>
</table>

</div>
</div>