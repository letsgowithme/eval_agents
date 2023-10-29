<?php 
$mission_details=true;
if (!isset($_GET["id"]) || empty($_GET["id"])){
  header("Location: mission_details.php");
  exit;
}

$idMission = $_GET["id"];
require_once "includes/DB.php";
$sql = "SELECT * FROM mission WHERE id = '$idMission'";
$query = $dbConnect->query($sql);
$query->execute();
$mission = $query->fetch();

if(!$mission) {
    http_response_code(404);
    echo "Page non trouvée";
    exit;
}
$sql2 = "SELECT * FROM mission_missionType WHERE mmt_missionId='$idMission'";
$query2 = $dbConnect->query($sql2);
$query2->execute();
while ($row = $query2->fetch(PDO::FETCH_ASSOC)):
  $mmt_missionId = $row["mmt_missionId"];
  $mmt_missionTypeId = $row["mmt_missionTypeId"];
endwhile; 

 $sql3= "SELECT title FROM missionType WHERE id='$mmt_missionTypeId'";
 $query3 = $dbConnect->prepare($sql3);
$query3->execute();
$missionType = $query3->fetch();
$missionTypeTitle = $missionType[0];

$title = strip_tags($mission["title"]);
// afficher spécialities
$sql5 = "SELECT * FROM mission_speciality INNER JOIN speciality ON speciality.id = mission_speciality.mis_spec_id";
$query5 = $dbConnect->query($sql5);
$query5->execute();
while ($row = $query5->fetch(PDO::FETCH_ASSOC)):
  $mission_Id = $row["mission_Id"];
  $mis_spec_id = $row["mis_spec_id"];
  $specialityTitle = $row["title"];
endwhile;

$sql7 = "SELECT * FROM mission_agents, mission_contacts, mission_targets WHERE mission_agents.mA_mission_id='$idMission' AND mission_contacts.mc_mission_id='$idMission' AND mission_targets.mt_mission_id='$idMission'";
$query7 = $dbConnect->query($sql7);
$query7->execute();
 
  ?>


<div class="body_page_new py-4">
  <div>

<h1 class="text-white">Mission <strong><?= strip_tags($mission['title']) ?></strong> numéro  <?= strip_tags($mission['id']) ?></h1>

<table width="100%" border="2" cellspacing="5" cellpadding="15" style="background: #1c1c22; color: #b2b2b5; padding: 10px;" class="mt-4 w-75 fs-5">
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
<tr>
<td>Spécialité</td>
<td>
<?= $specialityTitle ?>
</td>
</tr>
<tr>
<td>Agents</td>
<td>
  <!-- recup les id des agents -->
<?php 
while ($row = $query7->fetch(PDO::FETCH_ASSOC)):
  $agents = unserialize($row["agents"]);
  $contacts = unserialize($row["contacts"]);
  $targets = unserialize($row["targets"]);
  foreach($contacts as $contact) :
    $user_contact = $contact.", ";
    $sql9 = "SELECT * FROM user WHERE id = '$user_contact'";
     $query9 = $dbConnect->prepare($sql9);
    $query9->execute();
  endforeach;
   
  foreach($targets as $target) :
    $user_target = $target.", ";
    $sql10 = "SELECT * FROM user WHERE id = '$user_target'";
    $query10 = $dbConnect->prepare($sql10);
   $query10->execute();
  endforeach;
  foreach ($agents as $agent):
    $agentId = $agent;
    // var_dump($agentId);
    $sql8= "SELECT * FROM user INNER JOIN user_speciality  ON user.id='$agentId' AND user_speciality.userId='$agentId'";
    $query8 = $dbConnect->prepare($sql8);
    $query8->execute();
    while($row = $query8->fetch(PDO::FETCH_ASSOC)):    
      $ag_id = $row["id"];
      $ag_lastname = $row["lastname"];
      $ag_firstname = $row["firstname"];
      $specialities = unserialize($row["user_specialities"]);  
      foreach($specialities as $speciality) :
       $user_spec = $speciality.", ";
      endforeach;
      echo $ag_firstname." ".$ag_lastname." - ". $user_spec."<br>";
  endwhile;  
  endforeach;
endwhile;
?>
</td>
<tr>
  <td>Contacts</td>
<td>
  <?php  while($row = $query9->fetch(PDO::FETCH_ASSOC)):   
      $cont_id = $row["id"];
      $cont_lastname = $row["lastname"];
      $cont_firstname = $row["firstname"];
    endwhile;
    echo $cont_lastname." ".$cont_firstname."<br>";
    ?>
</td>
</tr>
<tr>
<td>Cibles</td>
<td>
<?php  
     while($row = $query10->fetch(PDO::FETCH_ASSOC)):   
      $targ_id = $row["id"];
      $targ_lastname = $row["lastname"];
      $targ_firstname = $row["firstname"];
    endwhile;
    echo $targ_firstname." ".$targ_lastname."<br>";
    ?>
</td>
</tr>
 </td>
</tr>
</table>

</div>
</div>