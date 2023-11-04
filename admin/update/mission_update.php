<?php

 
$titre = "Modifier la mission";
include_once "../includes/admin_header.php";
include_once "../includes/admin_sidebar.php";
require_once "../../includes/DB.php";

$idMission = $_GET["id"];

$sql6 = "SELECT * FROM mission, mission_speciality, mission_missionType WHERE mission.id='$idMission' AND mission_speciality.mission_Id='$idMission' AND mission_missionType.mmt_missionId='$idMission'";
$query6 = $dbConnect->query($sql6);
$query6->execute();

$sql = "SELECT * FROM missionType ORDER BY title ASC";
$query = $dbConnect->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

$sql1_1 = "SELECT * FROM speciality ORDER BY title ASC";
$query1_1 = $dbConnect->prepare($sql1_1);
$query1_1->execute();
$result1_1 = $query1_1->fetchAll(PDO::FETCH_ASSOC);

$sql_s3 = "SELECT * FROM person WHERE userType='agent' ORDER BY lastname ASC";
$query_s3 = $dbConnect->query($sql_s3);
$query_s3->execute();

$sql_s4 = "SELECT * FROM person WHERE userType='contact' ORDER BY lastname ASC";
$query_s4 = $dbConnect->query($sql_s4);
$query_s4->execute();

$sql_s5 = "SELECT * FROM person WHERE userType='cible'  ORDER BY lastname ASC";
$query_s5 = $dbConnect->query($sql_s5);
$query_s5->execute();

$sql7 = "SELECT * FROM mission_agents, mission_contacts, mission_targets, mission_hideouts  WHERE mission_agents.ma_mission_id='$idMission' AND mission_contacts.mc_mission_id='$idMission' AND mission_targets.mt_mission_id='$idMission' AND mission_hideouts.missionId='$idMission'";
$query7 = $dbConnect->query($sql7);
$query7->execute();

if (!empty($_POST["submit"])) {

  $title = $_POST["title"];
  $description = $_POST["description"];
  $startDate = $_POST["startDate"];
  $endDate = $_POST["endDate"];
  $country = $_POST["country"];
  $missionStatus = $_POST["missionStatus"];
  $codeName = $_POST["codeName"];
  $mmt_missionTypeId = strip_tags($_POST["mmt_missionTypeId"]);
  $mis_spec_id = strip_tags($_POST["mis_spec_id"]);
  $agents = serialize($_POST["agents"]);
  $contacts = serialize($_POST["contacts"]);
  $targets = serialize($_POST["targets"]);
  $mis_hideouts = serialize($_POST["mis_hideouts"]);

  // $startDate = strtotime ( $startDate ); echo date ( 'd/M/Y h:i:s' , $startDate );
  
var_dump (gettype($startDate));

  $sql4 = "UPDATE mission SET title='$title', description='$description', startDate='$startDate', endDate='$endDate', country='$country', missionStatus='$missionStatus', codeName='$codeName' WHERE id='$idMission'";
  $query4 = $dbConnect->query($sql4);
  $Execute4 = $query4->execute();
  // *******************************************
 
  var_dump($query4);
  // echo "<pre>";
  // echo print_r($Execute4);
  // echo "</pre>";
  

  

  if ($Execute4) {
    // header("Location: ../lists/missions_adm.php");
    echo "<p style=\"background: darkgrey; color: white; font-weight: bold;\" class=\"text-center p-2\">La mission modifiée sous le numéro " . $idMission .
    "<a class=\"fs-4 ms-3 text-bold text-dark\" href='../lists/missions_adm.php'>Retour</a></p>";
  }

  $sql5 = "UPDATE mission_missionType SET mmt_missionTypeId='$mmt_missionTypeId' WHERE mmt_missionId='$idMission'";
  $query5 = $dbConnect->query($sql5);
  $query5->execute();

  $sql_u3 = "UPDATE mission_speciality SET mis_spec_id='$mis_spec_id' WHERE mission_Id='$idMission'";
  $query_u3 = $dbConnect->query($sql_u3);
  $query_u3->execute();

  $sql_i4 = "UPDATE mission_agents SET  agents='$agents' WHERE ma_mission_id='$idMission'";
  $query_i4 = $dbConnect->prepare($sql_i4);
  $query_i4->execute();

  $sql_i5 = "UPDATE mission_contacts SET contacts='$contacts' WHERE  mc_mission_id='$idMission'";
  $query_i5 = $dbConnect->prepare($sql_i5);
  $query_i5->execute();

  $sql_i6 = "UPDATE mission_targets SET targets='$targets' WHERE  mt_mission_id='$idMission';";
  $query_i6 = $dbConnect->prepare($sql_i6);
  $query_i6->execute();

  $sql_i7 = "UPDATE mission_hideouts SET mis_hideouts='$mis_hideouts' WHERE  missionId='$idMission';";
  $query_i7 = $dbConnect->prepare($sql_i7);
  $query_i7->execute();


}

?>
<link href="../../style/style.css" rel="stylesheet" type="text/css">
<link href="../../style/style_in_ad.css" rel="stylesheet" type="text/css">
<link rel="icon" href="../logo.png">

<script>
  $(document).ready(function() {
    // $("#countryList").on("change", function(){
    //        var countryList = $("#countryList").val();
    //        var hideout = $("#hideout").val();
    //        if(countryList){
    //             $.ajax({
    //               type: "POST",
    //               url: "../ajax/ajaxData.php",
    //               data: 'countryList='+countryList,
    //               success:function(response){

    //             $("#hideout").html(response);
    //             }
    //             })
    //        }else{
    //         $("#hideout").html("<option value=''>Pas de planques dans ce pays></option>");
    //        }
    // });   
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
    $("#countryList").on("change", function() {
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
    $("#targets").on("change", function() {
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
    // $("#description").on("click", function(){
    //          var title = $("#title").val();
    //          if(title){
    //               $.ajax({
    //                 type: "POST",
    //                 url: "../ajax/ajaxData3.php",
    //                 data: 'title='+title,
    //                 success:function(response){
    //               //  alert(response);
    //               $("#title").html(response);
    //               }
    //               })
    //          }
    //   });   

    //  $("#speciality").on("click", function(){
    //     alert( $("#agents").val());
    //  });

    // afficher les agents avec specialité choisie
    $("#speciality").on("change", function() {
      var speciality = $("#speciality").val();
      var agents = $("#agents").val();
      if (speciality) {
        $.ajax({
          type: "POST",
          url: "../ajax/ajaxData2.php",
          data: 'speciality=' + speciality,
          success: function(response) {
            //  alert(response);

            $("#agents").html(response);
          }
        })
      } else {
        $("#agents").html("<option value=''>Pas d'agents avec la spécialité requise></option>");
      }
    });
    
  });
</script>
</head>
<?php
global $dbConnect;

while ($row = $query6->fetch(PDO::FETCH_ASSOC)) {
  $id = $row["id"];
  $title = $row["title"];
  $description = $row["description"];
  $startDate = $row["startDate"];
  $endDate = $row["endDate"];
  $user_country = $row["country"];
  $missionStatus = $row["missionStatus"];
  $codeName = $row["codeName"];
  $mis_spec_id = $row["mis_spec_id"];
  $mmt_missionTypeId = $row["mmt_missionTypeId"];
 
// var_dump($startDate);
}
?>
<div class="py-4 body_page_new">
  <div>

    <h1>Modifier la mission</h1>
    
    <form method="post" action="mission_update.php?id=<?php echo $idMission; ?>">
      <div class="mb-3">
        <!-- ******************titre de la mission****************** -->
        <div class="mb-3">
          <label for="title" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Titre</label>
          <input type="text" class="form-control w-50" name="title" id="title" value="<?php echo $title ?>">
        </div>
        <!-- ******************Description de la mission****************** -->
        <div class="mb-3 d-flex" style="align-items: start;">
          <label for="description" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Description</label>
          <textarea name="description" id="description" cols="54" rows="10"><?php echo $description ?></textarea>
        </div>
        <!-- ***********startDate de La mission************** -->
        <?php
        // $date =  new DateTime($startDate);
        // $newStartDate =  $date->format("d/m/Y");
        // $startDate = $newStartDate;
        ?>
        <div class="mb-3 d-flex">
          <label for="startDate" class="form-label fw-bold my-2 fs-5" style="color: #01013d; width: 140px;">Date de debut</label>
          <button type="button" class="fs-6 me-4" onclick="startDateBtn()" value="<?php echo $startDate ?>" name="btnStartDate" id="btnStartDate"><?php echo $startDate ?></button>
          <?php
    //       $startDate->format('Y-m-d');
    // var_dump($startDate);
          ?>
          <input type="date" style="display: none;" name="startDate" id="startDate" placeholder="<?php echo $startDate ?>" value="<?php echo $startDate ?>">
         

        </div>
        <!-- **************endDate de La mission************ -->
        <?php
        // $date2 =  new DateTime($endDate);
        // $newEndDate =  $date2->format("d/m/Y");
        // $endDate = $newEndDate;
        ?>

        <div class="mb-3 d-flex">
          <label for="endDate" class="form-label fw-bold my-2 fs-5" style="color: #01013d; width: 140px;">Date de fin</label>
          <button type="button" class="fs-6 me-4" onclick="endDateBtn()" value="<?php echo $endDate ?>" name="btnEndDate" id="btnEndDate"><?php echo $endDate ?></button>
          <input type="date" style="display: none;" name="endDate" id="endDate" placeholder="<?php echo $endDate ?>" value="<?php echo $row["endDate"] ?>">
        </div>

        <!-- **************Pays de la mission************* -->
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
      // hideouts de la mission
      $hideoutsArr = [];
      while ($row = $query7->fetch(PDO::FETCH_ASSOC)) :
        $agents = unserialize($row["agents"]);
        $contacts = unserialize($row["contacts"]);
        $targets = unserialize($row["targets"]);
        $hideouts = unserialize($row["mis_hideouts"]);

      ?>
        <?php
        foreach ($hideouts as $hideout) :
          $hideoutId = $hideout;
          $hideoutsArr[] = $hideoutId;
        ?>
          <input type="hidden" name="mission_mis_hideouts" value="<?php echo $hideoutId ?>">
        <?php
        endforeach;
        ?>
        <!-- ****************Hideouts******************* -->
        <div class="mb-3 d-flex mt-4">
          <label for="hideout" class="form-label fw-bold mb-2 fs-5 me-2" style="color: #01013d; width: 120px;">Planques</label>
          <select name="mis_hideouts[]" multiple="multiple" id="hideout" class="fs-5 pb--2 pe-2" style="min-width: 330px;">
            <!-- ****hideouts de la mission******* -->
            <?php
            $sql9_1 = "SELECT * FROM hideout";
            $query9_1 = $dbConnect->prepare($sql9_1);
            $query9_1->execute();
            while ($row = $query9_1->fetch(PDO::FETCH_ASSOC)) :
              $hideout_id = $row["id"];
              $code = $row["code"];
              $city = $row["city"];
              $address = $row["address"];
              $country = $row["country"];
              $hideoutType = $row["hideoutType"];

              if (in_array($hideout_id, $hideoutsArr)) {
                echo "<option class=\"py-1\" value=" . $hideout_id . " $selected>" . $code . " " . $city . " - " . $address . " " . $country . " " . $hideoutType . "</option><hr>";
              }
            endwhile;
            ?>
          </select>
        </div>
        <!-- **********CONTACTS OF MISSION********* -->
        <?php
        $contactsArr = [];
        foreach ($contacts as $contact) :
          $contactId = $contact;
          $contactsArr[] = $contactId;
        ?>
          <input type="hidden" name="mission_contacts" value="<?php echo $contactId ?>">
        <?php
        endforeach;
        ?>
        <!-- ****************Contacts******************* -->
        <div class="mb-3 d-flex mt-4">
          <label for="contacts" class="form-label fw-bold mb-2 fs-5 me-2" style="color: #01013d; width: 120px;">Contacts</label>

          <select name="contacts[]" multiple="multiple" id="contacts" class="fs-5 pb--2 pe-2" style="min-width: 330px;">

            <!-- recuperer que les agents -->
            <?php
            while ($row = $query_s4->fetch(PDO::FETCH_ASSOC)) :
              $contactId = $row["id"];
              $lastname = $row["lastname"];
              $firstname = $row["firstname"];
              $nation = $row["nationality"];
              if (in_array($contactId, $contactsArr)) {
                echo "<option class=\"py-1\" value=" . $contactId . " $selected>" . $firstname . " " . $lastname . " - " . $nation . "</option><hr>";
              }

            endwhile;
            ?>
          </select>
        </div>
        <!-- *****************************STATUS****************** -->
        <div class="mb-3 d-flex">
          <label for="status" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Status</label>
          <button type="button" name="missionStatus" class="fs-5 px-2 mx-2" id="currentStatus" value="<?php echo $missionStatus ?>"><?php echo $missionStatus ?></button>
       
        <select name="missionStatus" id="status" class="fs-5 w-25 hidden">
          <option value=""></option>;
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
    <input type="hidden" name="missionType" id="missionType" value="<?= $mmt_missionTypeId ?>" />
    <select class="form-control w-50" name="mmt_missionTypeId">
      <?php
        foreach ($result as $tab) {
          $mt_id = $tab['id'];
          $mt_title = $tab['title'];
          if ($mt_id == $mmt_missionTypeId) {
            $selected = "selected";
          } else {
            $selected = "";
          }
          echo "<option value=" . $mt_id . " " . $selected . ">" . $mt_title . "</option>";
        }
      ?>
    </select>
  </div>
  <!-- *******Targets of mission************* -->
  <?php
        $targetsArr = [];
        foreach ($targets as $target) :
          $targetId = $target;
          $targetsArr[] = $targetId;
  ?>
    <input type="hidden" name="mission_contacts" value="<?php echo $targetId ?>">
  <?php
        endforeach;
  ?>
  <!-- ***************Agents**************** -->
  <div class="mb-3 d-flex mt-4">
    <label for="targets" class="form-label fw-bold mb-2 fs-5 me-2" style="color: #01013d; width: 120px;">Cibles</label>
    <select name="targets[]" multiple="multiple" id="targets" class="fs-5 pb--2 pe-2" style="min-width: 330px;">

      <!-- recuperer que les agents -->
      <?php
        while ($row = $query_s5->fetch(PDO::FETCH_ASSOC)) :
          $targetId = $row["id"];
          $lastname = $row["lastname"];
          $firstname = $row["firstname"];
          $nation = $row["nationality"];
          if (in_array($targetId, $targetsArr)) {
            $selected  = "selected";
          } else {
            $selected = "";
          }
          echo "<option class=\"py-1\" value=" . $targetId . " $selected>" . $firstname . " " . $lastname . " - " . $nation . "</option><hr>";
        endwhile;
      ?>
    </select>
  </div>
  <!-- **********Specialité choix*********** -->
  <div class="mb-3">
    <h5 for="speciality" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Spécialité</h5>
    <input type="hidden" name="speciality" id="us_speciality" value="<?= $mis_spec_id ?>" />
    <select class="form-control w-50" id="speciality" name="mis_spec_id">
      <?php
        foreach ($result1_1 as $tab) {
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
        $mission_agentsArr = [];
        $mission_agents_infoArr = [];
        $mis_us_spec = [];

        foreach ($agents as $agent) :
          $mission_agentId = $agent;
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
      endwhile;
?>

<!-- *************All agents************ -->
<div class="mb-3 d-flex mt-4">
  <h5 for="agents" class="form-label fw-bold mb-2 fs-5 me-2" style="color: #01013d; width: 120px;">Agents</h5>
  <select name="agents[]" multiple="multiple" id="agents" class="fs-5 pb--2 pe-2" style="min-width: 330px;">
    <?php
    while ($row3 = $query_s3->fetch(PDO::FETCH_ASSOC)) :
      $agentId = $row3["id"];
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

            echo "<option class=\"py-1\" value=" . $agentId . $user_speciality . " $selected>" . $user_speciality . " -  " . $firstname . "  " . $lastname . " (" . $country . " - " . $nationality . ")" . "</option><hr>";
          }
        endforeach;
      endwhile;
    endwhile;
    ?>
  </select>
</div>
<!-- ************fin d'affichage******************** -->
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
$(document).ready(function () {
  $status =  $("#status").val();
  $currentStatus = $("#currentStatus").val();
  $("#currentStatus").on("click", function(){
    $("#status").addClass("visible");
    $("#status").on("change", function(){
      $("#currentStatus").val( $("#status").val());
      $currentStatus.addClass("hidden");
   
    });
  })
});
</script>
<?php
include_once "../includes/admin_footer.php";
?>