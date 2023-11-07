<?php
include_once "../includes/admin_header.php";
include_once "../includes/admin_sidebar.php";
$titre = "Modifier la mission";
require_once "../../includes/DB.php";
$idMission = $_GET["id"];

$sql1 = "SELECT * FROM mission, mission_speciality, mission_missionType, mission_agents, mission_contacts, mission_targets, mission_hideouts WHERE mission.id='$idMission' AND mission_speciality.mission_Id='$idMission' AND mission_missionType.mmt_missionId='$idMission' AND mission_agents.ma_mission_id='$idMission' AND mission_contacts.mc_mission_id='$idMission' AND mission_targets.mt_mission_id='$idMission' AND mission_hideouts.missionId='$idMission'";
$query1 = $dbConnect->query($sql1);
$query1->execute();

$sql_s1 = "SELECT * FROM missionType ORDER BY title ASC";
$query_s1 = $dbConnect->prepare($sql_s1);
$query_s1->execute();
$result_s1 = $query_s1->fetchAll(PDO::FETCH_ASSOC);

$sql_s2 = "SELECT * FROM speciality ORDER BY title ASC";
$query_s2 = $dbConnect->prepare($sql_s2);
$query_s2->execute();
$result_s2 = $query_s2->fetchAll(PDO::FETCH_ASSOC);

$sql9_1 = "SELECT * FROM hideout";
$query9_1 = $dbConnect->prepare($sql9_1);
$query9_1->execute();

$sql_s3 = "SELECT * FROM person WHERE userType='agent' ORDER BY lastname ASC";
$query_s3 = $dbConnect->query($sql_s3);
$query_s3->execute();

$sql_s4 = "SELECT * FROM person WHERE userType='contact' ORDER BY lastname ASC";
$query_s4 = $dbConnect->query($sql_s4);
$query_s4->execute();

$sql_s5 = "SELECT * FROM person WHERE userType='cible'  ORDER BY lastname ASC";
$query_s5 = $dbConnect->query($sql_s5);
$query_s5->execute();


if (isset($_POST["submit"])) {
  $title = $_POST["title"];
  $description = $_POST["description"];
  $startDate = $_POST["startDate"];
  $endDate = $_POST["endDate"];
  $country = $_POST["country"];
  $codeName = $_POST["codeName"];

  if (isset($_POST["mmt_missionTypeId"]) && !empty($_POST["mmt_missionTypeId"])) {
    $mmt_missionTypeId = intval($_POST["mmt_missionTypeId"]);
  } else {
    $mmt_missionTypeId = intval($_POST["missionType"]);
  }

  if (isset($_POST["mis_spec_id"]) && !empty($_POST["mis_spec_id"])) {
    $mis_spec_id = intval($_POST["mis_spec_id"]);
  } else {
    $mis_spec_id = intval($_POST["mis_speciality"]);
  }
  if (isset($_POST["missionStatus"]) && !empty($_POST["missionStatus"])) {
    $missionStatus = $_POST["missionStatus"];
  } else {
    $missionStatus = $_POST["current_missionStatus"];
  }

  if (!empty($_POST["mis_hideouts"])) {
    $mis_hideouts = serialize($_POST["mis_hideouts"]);
    $sql_u4 = "UPDATE mission_hideouts SET mis_hideouts='$mis_hideouts' WHERE  missionId='$idMission'";
    $query_u4 = $dbConnect->prepare($sql_u4);
    $query_u4->execute();
  }

  if (!empty($_POST["contacts"])) {
    $contacts = serialize($_POST["contacts"]);
    $sql_u5 = "UPDATE mission_contacts SET contacts='$contacts' WHERE  mc_mission_id='$idMission'";
    $query_u5 = $dbConnect->prepare($sql_u5);
    $query_u5->execute();
  }

  if (!empty($_POST["targets"])) {
    $targets = serialize($_POST["targets"]);

    $sql_u6 = "UPDATE mission_targets SET targets='$targets' WHERE  mt_mission_id='$idMission'";
    $query_u6 = $dbConnect->prepare($sql_u6);
    $query_u6->execute();
  }

  if (!empty($_POST["agents"])) {
    $agents = serialize($_POST["agents"]);

    $sql_u7 = "UPDATE mission_agents SET  agents='$agents' WHERE ma_mission_id='$idMission'";
    $query_u7 = $dbConnect->prepare($sql_u7);
    $query_u7->execute();
  }

  $sq_up = "UPDATE mission SET title='$title', description='$description', startDate='$startDate', endDate='$endDate', country='$country', missionStatus='$missionStatus', codeName='$codeName' WHERE id='$idMission'";
  $query_up = $dbConnect->query($sq_up);
  $Execute_up = $query_up->execute();

  $sql_u1 = "UPDATE mission_missionType SET mmt_missionTypeId='$mmt_missionTypeId' WHERE mmt_missionId='$idMission'";
  $query_u1 = $dbConnect->prepare($sql_u1);
  $query_u1->execute();

  $sql_u3 = "UPDATE mission_speciality SET mis_spec_id='$mis_spec_id' WHERE mission_Id='$idMission'";
  $query_u3 = $dbConnect->prepare($sql_u3);
  $query_u3->execute();

  if ($Execute_up) {
    echo "<p style=\"background: darkgrey; color: white; font-weight: bold;\" class=\"text-center p-2\">La mission modifiée sous le numéro " . $idMission .
      "<a class=\"fs-4 ms-3 text-bold text-dark\" href='../lists/missions_adm.php'>Retour</a></p>";
  }
}
?>
<link href="../../style/style.css" rel="stylesheet" type="text/css">
<link href="../../style/style_in_ad.css" rel="stylesheet" type="text/css">
<link rel="icon" href="../logo.png">
<script></script>
<?php
?>
<script>
  $(document).ready(function() {
    $("#countryList").on("click", function() {
      var countryList = $("#countryList").val();
      var hideout = $("#hideout").val();
      if (countryList) {
        $.ajax({
          type: "POST",
          url: "../ajax/ajaxData.php",
          data: 'countryList=' + countryList,
          success: function(response) {

            $("#hideout").html(response);
          }
        })
      } else {
        $("#hideout").html("<option value=''>Pas de planques dans ce pays></option>");
      }
    });
    // ***************************************
    $("#countryList").on("click", function() {
      var countryList = $("#countryList").val();
      var contacts = $("#contacts").val();
      if (countryList) {
        $.ajax({
          type: "POST",
          url: "../ajax/ajaxData2.php",
          data: 'countryList=' + countryList,
          success: function(response) {

            $("#contacts").html(response);
          }
        })
      } else {
        $("#contacts").html("<option value=''>Pas de contacts dans ce pays></option>");
      }
    });
    //  *********************************************
    $("#targets").on("click", function() {
      var agents = $("#agents").val();
      var targets = $("#targets").val();
      if (targets) {
        $.ajax({
          type: "POST",
          url: "../ajax/ajaxData2.php",
          data: 'targets=' + targets,
          success: function(response) {
            // alert(response);
            $("#agents").html(response);
          }
        })
      } else {
        $("#agents").html("<option value=''>Pas d'agents requis></option>");
      }
    });
    // ****************************************************
    // afficher les agents avec specialité choisie
    $("#speciality").on("click", function() {
      var speciality = $("#speciality").val();
      var agents = $("#agents").val();
      if (speciality) {
        $.ajax({
          type: "POST",
          url: "../ajax/ajaxData2.php",
          data: 'speciality=' + speciality,
          success: function(response) {
            $("#agents").html(response);
          }
        })
      } else {
        $("#agents").html("<option value=''>Pas d'agents avec la spécialité requise></option>");
      }
    });
    //  *********************************************
    $("#change_target").on("click", function() {
      var targetsAll = $("#targets").val();
      if (change_target) {
        $.ajax({
          type: "POST",
          url: "../ajax/ajaxData3.php",
          data: 'change_target=' + change_target,
          success: function(response) {
            // alert(response);
            $("#targets").html(response);
          }
        })
      } else {
        $("#targets").html("<option value=''>Pas d'agents requis></option>");
      }
    });
  });
</script>
</head>
<?php
global $dbConnect;
while ($row = $query1->fetch(PDO::FETCH_ASSOC)) {
  $id = $row["id"];
  $title = $row["title"];
  $description = $row["description"];
  $startDate = $row["startDate"];
  $endDate = $row["endDate"];
  $user_country = $row["country"];
  $missionStatus = $row["missionStatus"];
  $codeName = $row["codeName"];
  $mis_spec_id = $row["mis_spec_id"];
  $mission_mmt_missionTypeId = intval($row["mmt_missionTypeId"]);
  $current_missionStatus = $row["missionStatus"];
  $hideouts = unserialize($row["mis_hideouts"]);
  $contacts = unserialize($row["contacts"]);
  $targets = unserialize($row["targets"]);
  $agents = unserialize($row["agents"]);
}
?>
<div class="py-4 body_page_new">
  <div>
    <?php
    ?>
    <h1>Modifier la mission numéro <?php echo $idMission; ?></h1>
    <form method="post" action="mission_update.php?id=<?php echo $idMission; ?>">
      <div class="mb-3">
        <!-- ************titre****************** -->
        <div class="mb-3">
          <label for="title" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Titre</label>
          <input type="text" class="form-control w-50" name="title" id="title" value="<?php echo $title ?>">
        </div>
        <!-- **********Description*************** -->
        <div class="mb-3 d-flex" style="align-items: start;">
          <label for="description" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Description</label>
          <textarea name="description" id="description" cols="54" rows="10"><?php echo $description ?></textarea>
        </div>
        <!-- ***********startDate de La mission************** -->
        <div class="mb-3 d-flex">
          <h5 for="startDate" class="form-label fw-bold my-2 fs-5" style="color: #01013d; width: 140px;">Date de debut</h5>
          <input type="text" name="current_startDate" id="mis_startDate" placeholder="<?php echo $startDate ?>" value="<?php echo $startDate ?>">
          <button type="button" class="fs-6 me-4" onclick="startDateBtn()" value="" name="btnStartDate" id="btnStartDate">Change</button>
          <input type="date" style="display: none;" name="startDate" id="startDate" placeholder="<?php echo $startDate ?>" value="<?php echo   $startDate ?>">
        </div>
        <!-- **************endDate de La mission************ -->
        <div class="mb-3 d-flex">
          <h5 for="endDate" class="form-label fw-bold my-2 fs-5" style="color: #01013d; width: 140px;">Date de fin</h5>
          <input type="text" name="current_endDate" id="mis_endDate" placeholder="<?php echo $endDate ?>" value="<?php echo $endDate ?>">
          <button type="button" class="fs-6 me-4" onclick="endDateBtn()" value="" name="btnEndDate" id="btnEndDate">Change</button>
          <input type="date" style="display: none;" name="endDate" id="endDate" placeholder="<?php echo $endDate ?>" value="<?php echo $endDate ?>">
        </div>
        <!-- *****************************STATUS****************** -->
        <div class="mb-3 d-flex">
          <label for="status" class="form-label fw-bold my-2 fs-5" style="color: #01013d; width: 120px;">Status</label>
          <button type="button" name="current_missionStatus" class="fs-5 px-2 mx-2" id="currentStatus" value="<?php echo $current_missionStatus ?>"><?php echo $current_missionStatus ?></button>

          <select name="missionStatus" id="status" class="fs-5 w-25 hidden">
            <!-- <option value=""></option>; -->
            <option value="En préparation">En préparation</option>;
            <option value="En cours">En cours</option>;
            <option value="Terminé">Terminé</option>;
            <option value="Échec">Échec</option>;
          </select>
        </div>
        <!-- ********codeName de La mission********* -->
        <div class="mb-3">
          <label for="codeName" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Nom de code</label>
          <input type="text" name="codeName" id="codeName" value="<?php echo $codeName ?>">
        </div>
        <!-- **********Type de mission*********** -->
        <div class="mb-3">
          <h5 for="missionType" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Type de mission</h5>
          <input type="hidden" name="missionType" id="missionType" value="<?= $mission_mmt_missionTypeId ?>" />
          <select class="form-control w-50" name="mmt_missionTypeId">
            <?php
            foreach ($result_s1 as $tab) {
              $mt_id = $tab['id'];
              $mt_title = $tab['title'];
              if ($mt_id == $mission_mmt_missionTypeId) {
                $selected = "selected";
              } else {
                $selected = "";
              }
              echo "<option value=" . $mt_id . " " . $selected . ">" . $mt_title . "</option>";
            }
            ?>
          </select>
        </div>
        <!-- ******Pays de la mission************* -->
        <div class="mb-3">
          <label for="countryList" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Pays</label>
          <input type="hidden" name="country" id="user_country" value="<?php echo $user_country ?>">
          <?php include_once "../lists/countries_list.php"; ?>
          <select name="country" id="countryList" class="fs-5">
            <?php
            foreach ($countries as $country) {
              $country_title = $country['name'];
              if ($country_title == $user_country) {
                $selected = "selected";
              } else {
                $selected = "";
              }
              echo "<option value=" . $country_title . " " . $selected . ">" . $country_title . "</option>";
            }
            ?>
        </div>
        </select>
      </div>
      <?php
      // *******hideouts de la mission*********
      $hideoutsArr = [];
      $contactsArr = [];
      $targetsArr = [];
      $mission_agentsArr = [];
      $mission_agents_infoArr = [];
      ?>
      <!-- ****hideouts de la mission******* -->
      <?php
      foreach ($hideouts as $hideout) :
        $hideoutId = intval($hideout);
        $hideoutsArr[] = $hideoutId;
      ?>
        <input type="hidden" name="mission_mis_hideouts" value="<?php echo $hideoutId ?>">
      <?php
      endforeach;
      ?>
      <!-- ****************Hideouts******************* -->
      <div class="mb-3 d-flex mt-4">
        <label for="hideout" class="form-label fw-bold mb-2 fs-5 me-2" style="color: #01013d; width: 120px;">Planques</label>
        <select name="mis_hideouts[]" multiple="multiple" id="hideout" class="fs-5   pe-2" style="min-width: 330px;">
          <?php
          while ($row = $query9_1->fetch(PDO::FETCH_ASSOC)) :
            $hideout_id = intval($row["id"]);
            $code = $row["code"];
            $city = $row["city"];
            $address = $row["address"];
            $country = $row["country"];
            $hideoutType = $row["hideoutType"];
            if (in_array($hideout_id, $hideoutsArr)) {
              echo "<option class=\"fs-6\" value=" . $hideout_id . " $selected>" . $code . " " . $city . " - " . $address . " " . $country . " " . $hideoutType . "</option><hr>";
            }
          endwhile;
          ?>
        </select>
      </div>
      <!-- **********Contacts OF MISSION********* -->
      <?php
      foreach ($contacts as $contact) :
        $m_contactId = intval($contact);
        $contactsArr[] = $m_contactId;
      ?>
        <input type="hidden" name="mission_contacts" value="<?php echo $m_contactId ?>">
      <?php
      endforeach;
      ?>
      <!-- ****************Contacts******************* -->
      <div class="mb-3 d-flex mt-4">
        <label for="contacts" class="form-label fw-bold mb-2 fs-5 me-2" style="color: #01013d; width: 120px;">Contacts</label>
        <select name="contacts[]" multiple="multiple" id="contacts" class="fs-5" style="min-width: 330px;">
          <?php
          while ($row4 = $query_s4->fetch(PDO::FETCH_ASSOC)) :
            $contactId = intval($row4["id"]);
            $lastname = $row4["lastname"];
            $firstname = $row4["firstname"];
            $nation = $row4["nationality"];
            if (in_array($contactId, $contactsArr)) {
              echo "<option class=\"fs-6\" value=" . $contactId . " $selected>" . $firstname . " " . $lastname . " - " . $nation . "</option><hr>";
            }

          endwhile;
          ?>
        </select>
      </div>
      <!-- **********TARGETS OF MISSION********* -->
      <?php
      foreach ($targets as $target) :
        $target_Id = intval($target);
        $targetsArr[] = $target_Id;
      ?>
        <input type="hidden" name="mission_targets" value="<?php echo $target_Id ?>">
      <?php
      endforeach;
      ?>
      <!-- ****************Targets******************* -->
      <div class="mb-3 d-flex mt-4">
        <label for="targets" class="form-label fw-bold mb-2 fs-5 me-2" style="color: #01013d; width: 120px;">Cibles</label>
        <button type="button" class="btn btn-primary" id="change_target">Changer</button>
        <select name="targets[]" multiple="multiple" id="targets" class="fs-5" style="min-width: 330px;">
          <?php
          while ($row = $query_s5->fetch(PDO::FETCH_ASSOC)) :
            $targetId = intval($row["id"]);
            $lastname = $row["lastname"];
            $firstname = $row["firstname"];
            $nation = $row["nationality"];
            if (in_array($targetId, $targetsArr)) {
              echo "<option class=\"fs-6\" value=" . $targetId . " $selected>" . $firstname . " " . $lastname . " - " . $nation . "</option><hr>";
            }
          endwhile;
          ?>
        </select>
      </div>
      <!-- **********Specialité choix*********** -->
      <div class="mb-3">
        <h5 for="speciality" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Spécialité</h5>
        <input type="hidden" name="mis_speciality" id="us_speciality" value="<?= $mis_spec_id ?>" />
        <select class="form-control w-50" id="speciality" name="mis_spec_id">
          <?php
          foreach ($result_s2 as $tab) {
            $ms_id = $tab['id'];
            $ms_title = $tab['title'];
            if ($ms_id == $mis_spec_id) {
              $selected = "selected";
            } else {
              $selected = "";
            }
            echo "<option value=" . $ms_id . " " . $selected . ">" . $ms_title . "</option>";
          }
          ?>
        </select>
      </div>
      <!-- ********AGENTS of mission************ -->
      <?php
      foreach ($agents as $agent) :
        $mission_agentId = intval($agent);
        $mission_agentsArr[] = $mission_agentId;
        $sql_s_s1 = "SELECT * FROM agents WHERE agents.id_user_agent = '$mission_agentId'";
        $query_s_s1 = $dbConnect->query($sql_s_s1);
        $query_s_s1->execute();
        while ($row = $query_s_s1->fetch(PDO::FETCH_ASSOC)) :
          $specialities = unserialize($row["specialities"]);
          foreach ($specialities as $user_spec) :
            $user_special = $user_spec;
            $mis_us_spec[] = $user_special;
          endforeach;
          $mis_ag_info = $mission_agentId . $user_special;
          $mission_agents_infoArr[] = $mis_ag_info;
      ?>
          <input type="hidden" name="mission_agents" value="<?php echo $mis_ag_info ?>">
      <?php
        endwhile;
      endforeach;
      ?>
      <!-- *************All agents************ -->
      <div class="mb-3 d-flex mt-4">
        <h5 for="agents" class="form-label fw-bold mb-2 fs-5 me-2" style="color: #01013d; width: 120px;">Agents</h5>
        <select name="agents[]" multiple="multiple" id="agents" class="fs-5   pe-2" style="min-width: 330px;">
          <?php
          while ($row3 = $query_s3->fetch(PDO::FETCH_ASSOC)) :
            $agentId = intval($row3["id"]);
            $lastname = $row3["lastname"];
            $firstname = $row3["firstname"];
            $nationality = $row3["nationality"];
            $country = $row3["country"];
            $sql_s8 = "SELECT * FROM agents WHERE id_user_agent = '$agentId'";
            $query_s8 = $dbConnect->query($sql_s8);
            $query_s8->execute();
            while ($row8 = $query_s8->fetch(PDO::FETCH_ASSOC)) :
              $specialities = unserialize($row8["specialities"]);
              foreach ($specialities as $user_spec) :
                $user_speciality = $user_spec;
                if (in_array($agentId . $user_speciality, $mission_agents_infoArr)) {

                  echo "<option class=\"fs-6\" value=" . $agentId . $user_speciality . " $selected>" . $user_speciality . " -  " . $firstname . "  " . $lastname . " (" . $country . " - " . $nationality . ")" . "</option><hr>";
                }
              endforeach;
            endwhile;
          endwhile;
          ?>
        </select>
      </div>
      <!-- *********fin d'affichage************ -->
      <?php
      include_once "../new/btn_create.php";
      ?>
    </form>
  </div>
</div>
</div>
<script>
  function startDateBtn() {
    var startDateBtn = document.getElementById("startDateBtn");
    var startDate = document.getElementById("startDate");
    if (startDate.style.display === "none") {
      startDate.style.display = "block";
    } else if (startDate.style.display === "block") {
      startDate.style.display = "none";
    }
  }

  function endDateBtn() {
    var endDateBtn = document.getElementById("endDateBtn");
    var endDate = document.getElementById("endDate");
    if (endDate.style.display === "none") {
      endDate.style.display = "block";
    } else if (endDate.style.display === "block") {
      endDate.style.display = "none";
    }
  }
</script>
<script>
  $(document).ready(function() {
    $status = $("#status").val();
    $currentStatus = $("#currentStatus").val();
    $("#currentStatus").on("click", function() {
      $("#status").addClass("visible");
      $("#status").on("change", function() {
        $("#currentStatus").val($("#status").val());
        $currentStatus.addClass("hidden");
      });
    })
  });
</script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<?php
include_once "../includes/admin_footer.php";
?>