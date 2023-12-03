<?php
$mission_details = true;
if (!isset($_GET["id"]) || empty($_GET["id"])) {
  header("Location: mission_details.php");
  exit;
}
$idMission = $_GET["id"];
require_once "includes/DB.php";
$sql = "SELECT * FROM mission WHERE id = '$idMission'";
$query = $dbConnect->query($sql);
$query->execute();
$mission = $query->fetch();
if (!$mission) {
  http_response_code(404);
  echo "Page non trouvée";
  exit;
}
$sql2 = "SELECT * FROM mission_missionType WHERE mmt_missionId='$idMission'";
$query2 = $dbConnect->query($sql2);
$query2->execute();
while ($row = $query2->fetch(PDO::FETCH_ASSOC)) :
  $mmt_missionId = $row["mmt_missionId"];
  $mmt_missionTypeId = $row["mmt_missionTypeId"];
endwhile;
$sql3 = "SELECT title FROM missionType WHERE id='$mmt_missionTypeId'";
$query3 = $dbConnect->prepare($sql3);
$query3->execute();
$missionType = $query3->fetch();
$missionTypeTitle = $missionType[0];
$title = $mission["title"];
// afficher spécialities
$sql5 = "SELECT * FROM mission_speciality WHERE mission_Id='$idMission'";
$query5 = $dbConnect->query($sql5);
$query5->execute();
while ($row = $query5->fetch(PDO::FETCH_ASSOC)) :
  $mission_Id = $row["mission_Id"];
  $specialityId = $row["mis_spec_id"];
endwhile;
$sql5_1 = "SELECT title FROM speciality WHERE id='$specialityId'";
$query5_1 = $dbConnect->prepare($sql5_1);
$query5_1->execute();
$speciality = $query5_1->fetch();
$specialityTitle = $speciality[0];
$sql7 = "SELECT * FROM mission_agents, mission_contacts, mission_targets, mission_hideouts WHERE mission_agents.ma_mission_id='$idMission' AND mission_contacts.mc_mission_id='$idMission' AND mission_targets.mt_mission_id='$idMission' AND mission_hideouts.missionId='$idMission'";
$query7 = $dbConnect->query($sql7);
$query7->execute();
$sql7_1 = "SELECT * FROM hideout";
$query7_1 = $dbConnect->query($sql7_1);
$query7_1->execute();
?>
<link rel="stylesheet" href="style/style_in_ad.css">
<link rel="stylesheet" href="style/style.css">
<link rel="icon" href="logo.png">
</head>
<div class="body_page_new py-2 body_details">
  <div>
    <h1 class="text-white mis_det_ttl">Mission <strong><?= $mission['title'] ?></strong> numéro <?= $mission['id'] ?></h1>
    <table border="2" cellspacing="5" cellpadding="15" style="background: #1c1c22; color: #b2b2b5; padding: 10px;" class="mt-4 fs-5 mis_details_table">
      <tr>
        <td class="hidden">Id</td>
        <td class="hidden"><?= $mission['idMission'] ?></td>
      </tr>
      <tr>
        <td class="text-light">Titre</td>
        <td class="corol-light"><?= $mission['title'] ?></td>
      </tr>
      <tr>
        <td>Déscription</td>
        <td><?= $mission['description'] ?></td>
      </tr>
      <tr>
        <td>Date de debut</td>
        <td><?= $mission['startDate'] ?></td>
      </tr>
      <tr>
        <td>Date de fin</td>
        <td><?= $mission['endDate'] ?></td>
      </tr>
      <tr>
        <td>Pays</td>
        <td><?= $mission['country'] ?></td>
      </tr>
      <tr>
        <td>Planques</td>
        <?php
        while ($row = $query7->fetch(PDO::FETCH_ASSOC)) :
          $hideouts = unserialize($row["mis_hideouts"]);
          $agents = unserialize($row["agents"]);
          $contacts = unserialize($row["contacts"]);
          $targets = unserialize($row["targets"]);
        ?>
          <td>
            <?php
            foreach ($hideouts as $hideout) :
              $hideoutId = $hideout;
              $sql9_1 = "SELECT * FROM hideout WHERE id = '$hideoutId'";
              $query9_1 = $dbConnect->prepare($sql9_1);
              $query9_1->execute();
              while ($row = $query9_1->fetch(PDO::FETCH_ASSOC)) :
                $hideout_id = $row["id"];
                $code = $row["code"];
                $city = $row["city"];
                $address = $row["address"];
                $country = $row["country"];
                $hideoutType = $row["hideoutType"];
              endwhile;
              echo $code . " " . $city . " " . $address . " " . $country . " " . $hideoutType . "<br>";
            endforeach;
            ?>
          </td>
      </tr>
      <tr>
        <td>Contacts</td>
        <td>
          <?php
          foreach ($contacts as $contact) :
            $user_contact = $contact;
            $sql9 = "SELECT * FROM person WHERE id = '$user_contact'";
            $query9 = $dbConnect->prepare($sql9);
            $query9->execute();
            while ($row = $query9->fetch(PDO::FETCH_ASSOC)) :
              $cont_id = $row["id"];
              $cont_lastname = $row["lastname"];
              $cont_firstname = $row["firstname"];
            endwhile;
            echo $cont_lastname . " " . $cont_firstname . "<br>";
          endforeach;
          ?>
        </td>
      </tr>
      <tr>
        <td>Status</td>
        <td><?= $mission['missionStatus'] ?></td>
      </tr>
      <tr>
        <td>Nome de code</td>
        <td><?= $mission['codeName'] ?></td>
      </tr>
      <tr>
        <td>Type de mission</td>
        <!-- ************missionType de La mission************** -->
        <td>
          <span class="hidden">
            <?= $mmt_missionTypeId ?>

          </span>
          <?= $missionTypeTitle ?>
        </td>
      </tr>
      <tr>
        <td>Spécialité requise</td>
        <td>
          <?= $specialityTitle ?>
        </td>
      </tr>
      <tr>
        <td>Agents</td>
        <td>
          <!-- recup les id des agents -->
          <?php
          $us_specArr = [];
          // while ($row = $query7->fetch(PDO::FETCH_ASSOC)):
          foreach ($agents as $agent) :
            $agentId = $agent;
            $sql8 = "SELECT * FROM person, agents WHERE person.id='$agentId' AND agents.id_user_agent='$agentId'";
            $query8 = $dbConnect->prepare($sql8);
            $query8->execute();
            while ($row = $query8->fetch(PDO::FETCH_ASSOC)) :
              $ag_id = $row["id"];
              $ag_lastname = $row["lastname"];
              $ag_firstname = $row["firstname"];
              $specialities = unserialize($row["specialities"]);
              foreach ($specialities as $speciality) :
                $user_spec = $speciality;
              endforeach;
              echo $ag_firstname . " " . $ag_lastname . " - " . $user_spec . "<br>";
            endwhile;
          endforeach;
          ?>
        </td>
      </tr>
      <tr>
        <td>Cibles</td>
        <td>
          <?php
          foreach ($targets as $target) :
            $user_target = $target;
            $sql10 = "SELECT * FROM person WHERE id = '$user_target'";
            $query10 = $dbConnect->prepare($sql10);
            $query10->execute();
          endforeach;
          while ($row = $query10->fetch(PDO::FETCH_ASSOC)) :
            $targ_id = $row["id"];
            $targ_lastname = $row["lastname"];
            $targ_firstname = $row["firstname"];
          endwhile;
          echo $targ_firstname . " " . $targ_lastname . "<br>";
          ?>
        <?php
        endwhile;
        ?>
        </td>
      </tr>
      </td>
      </tr>
    </table>
  </div>
  <div class="text-center my-2 btns">
  <button type="button" class="btn"><a href="#up" class="text-decoration-none btn_up">Vers le haut</a></button>
      </div>
      <?php
     if (!isset($_SESSION["user"])) {
      ?>
<div class="text-center my-2 btns">
  <button type="button" class="btn"><a href="index.php" class=" text-decoration-none btn_home">Accueil</a></button>
      </div>
      <?php
     }else {
      ?>
      <div class="text-center my-2 btns">
        <button type="button" class="btn"><a href="../main/admin_index.php" class="text-decoration-none btn_home">Accueil</a></button>
            </div>
            <?php

     }
     ?>
      
</div>