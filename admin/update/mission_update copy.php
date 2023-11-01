<?php
$titre = "Modifier la mission";
include_once "../includes/admin_header.php";
include_once "../includes/admin_sidebar.php";
require_once "../../includes/DB.php";

$idMission = $_GET["id"];

$sql6 = "SELECT * FROM mission, mission_speciality, mission_agents, mission_contacts, mission_targets, mission_missionType WHERE mission.id='$idMission' AND mission_speciality.mission_Id='$idMission' AND mission_agents.mA_mission_id='$idMission' AND mission_contacts.mc_mission_id='$idMission' AND mission_targets.mt_mission_id='$idMission' AND mmt_missionId='$idMission'";
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

$sql_s3 = "SELECT * FROM user INNER JOIN user_speciality ON user.id=user_speciality.userId  ORDER BY lastname ASC"; 
$query_s3 = $dbConnect->query($sql_s3);
$query_s3->execute();
$result_s3 = $query_s3->fetchAll(PDO::FETCH_ASSOC);
// contacts
$sql_s4 = "SELECT * FROM user WHERE userType='contact' ORDER BY lastname ASC"; 
$query_s4 = $dbConnect->query($sql_s4);
$query_s4->execute();
// targets
$sql_s5 = "SELECT * FROM user WHERE userType='cible'  ORDER BY lastname ASC"; 
$query_s5 = $dbConnect->query($sql_s5);
$query_s5->execute();

// $sql1_2 = "SELECT * FROM user WHERE userType='agent'";
// $query1_2 = $dbConnect->prepare($sql1_2);
// $query1_2->execute();
// $result1_2 = $query1_2->fetchAll(PDO::FETCH_ASSOC);

$sql7 = "SELECT * FROM mission_agents, mission_contacts, mission_targets  WHERE mission_agents.mA_mission_id='$idMission' AND mission_contacts.mc_mission_id='$idMission' AND mission_targets.mt_mission_id='$idMission'";
$query7 = $dbConnect->query($sql7);
$query7->execute();

// end missionType

//     echo '<pre>';
// var_dump($mis_agentId);
// echo '</pre>';
            
if (!empty($_POST["submit"])) {

  // if(isset($_POST["ms_id"])){
  //   $mis_spec_id = $row($_POST["ms_id"]);
  //   $sql_u1 = "UPDATE mission_speciality SET mis_spec_id='$ms_id' WHERE mission_Id='$idMission'";
  //   $query_u1 = $dbConnect->prepare($sql_u1); 
  //   $query_u1->execute();
  
  //   }elseif(isset($_GET["speciality"])){
  //     $mis_spec_id = $mission_spec_id;
  //   $sql_u1 = "UPDATE mission_speciality SET mis_spec_id='$mission_spec_id' WHERE mission_Id='$idMission'";
  //   $query_u1 = $dbConnect->prepare($sql_u1); 
  //   $query_u1->execute();
  //   }
  $title = $_POST["title"];
  $description = $_POST["description"];
  $startDate = $_POST["startDate"];
  $endDate = $_POST["endDate"];
  $country = $_POST["country"];
  $missionStatus = $_POST["missionStatus"];
  $codeName = $_POST["codeName"];
  $mmt_missionTypeId = strip_tags($_POST["mmt_missionTypeId"]);
  // $mis_spec_id = strip_tags($_POST["mis_spec_id"]);
  $agents = serialize($_POST["agents"]);
  $contacts = serialize($_POST["contacts"]);
  $targets = serialize($_POST["targets"]);

  $sql4 = "UPDATE mission SET title='$title', description='$description', startDate='$startDate', endDate='$endDate', country='$country', missionStatus='$missionStatus', codeName='$codeName' WHERE id='$idMission'";

  $query4 = $dbConnect->query($sql4);
  $Execute = $query4->execute();
  if ($Execute) {
    echo "<p style=\"background: darkgrey; color: white; font-weight: bold;\" class=\"text-center p-2\">La mission modifiée sous le numéro " . $idMission .
      "<a class=\"fs-4 ms-3 text-bold text-dark\" href='../lists/missions_adm.php'>Retour</a></p>";

    // header("Location: ../lists/missions_adm.php");


  }
  $sql5 = "UPDATE mission_missionType SET mmt_missionTypeId='$mmt_missionTypeId' WHERE mmt_missionId='$idMission'";
  $query5 = $dbConnect->query($sql5);
  $Execute = $query5->execute();

  $sql_u3 = "UPDATE mission_speciality SET mis_spec_id='$mis_spec_id' WHERE mission_Id='$idMission'";
  $query_u3 = $dbConnect->query($sql_u3);
  $Execute = $query_u3->execute();

  $sql_i4 = "UPDATE mission_agents SET  agents='$agents' WHERE mA_mission_id='$idMission'";
$query_i4 = $dbConnect->prepare($sql_i4);
$query_i4->execute();

$sql_i5 = "UPDATE mission_contacts SET contacts='$contacts' WHERE  mc_mission_id='$idMission'";
$query_i5 = $dbConnect->prepare($sql_i5);
$query_i5->execute();

$sql_i6 = "UPDATE mission_targets SET targets='$targets' WHERE  mt_mission_id='$idMission';";
$query_i6 = $dbConnect->prepare($sql_i6);
$query_i6->execute();

}


?>
<link href="../../style/style.css" rel="stylesheet" type="text/css">
<link href="../../style/style_in_ad.css" rel="stylesheet" type="text/css">
<link rel="icon" href="../logo.png">
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
  $agents = unserialize($row["agents"]);
  $mission_contacts = unserialize($row["contacts"]);
  $mission_targets = unserialize($row["targets"]);
  $mmt_missionTypeId = $row["mmt_missionTypeId"];
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
        <div class="mb-3 d-flex">
          <label for="startDate" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Date de debut</label>
          <button type="button" class="fs-6 me-4" onclick="startDateBtn()" value="<?php echo $startDate ?>" name="btnStartDate" id="btnStartDate"><?php echo $startDate ?></button>
          <input type="dateTime" style="display: none;" name="startDate" id="startDate" placeholder="<?php echo $startDate ?>" value="<?php echo $startDate ?>">


        </div>
        <!-- **************endDate de La mission************ -->
        <div class="mb-3 d-flex">
          <label for="endDate" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Date de debut</label>
          <button type="button" class="fs-6 me-4" onclick="endDateBtn()" value="<?php echo $endDate ?>" name="btnStartDate" id="btnStartDate"><?php echo $endDate ?></button>
          <input type="dateTime" style="display: none;" name="endDate" id="endDate" placeholder="<?php echo $endDate ?>" value="<?php echo $endDate ?>">
        </div>
        <!-- **************Pays de la mission************* -->
        <div class="mb-3">
          <label for="country" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Pays</label>
          <input type="hidden" name="country" id="user_country" value="<?php echo $user_country ?>">
          <?php include_once "../lists/countries_list.php"; ?>
          <select name="country" id="country" class="fs-5">
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
      <!-- **********missionStatus de La mission*********** -->
      <div class="mb-3">
        <label for="missionStatus" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Status</label>
        <input type="text" name="missionStatus" id="missionStatus" value="<?php echo $missionStatus ?>">
      </div>
      <!-- ***********codeName de La mission************ -->
      <div class="mb-3">
        <label for="codeName" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Nom de code</label>
        <input type="text" name="codeName" id="codeName" value="<?php echo $codeName ?>">
      </div>
      <!-- **********Type de mission*********** -->
      <div class="mb-3">
        <label for="missionType" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Type de mission</label>
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
 <!-- **********Specialité choix*********** -->
 <div class="mb-3">
        <label for="speciality" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Spécialité</label>
        <input type="hidden" name="speciality" id="speciality" value="<?= $mis_spec_id ?>" />
        <select class="form-control w-50" name="mis_spec_id">
          <?php
          foreach ($result1_1 as $tab) {
            $ms_id = $tab['id'];
            $ms_title = $tab['title'];
            if ($ms_id == $mis_spec_id) {
              $selected = "selected";
            } else {
              $selected = "";
            }
            echo "<option value=".$ms_id." ".$selected.">" . $ms_title . "</option>";
          }
          ?>
        </select>
      </div>
      <!-- type=\"hidden\" -->
       <!-- **************Agents all******************* -->
       <!-- SELECT * FROM mission_agents, mission_contacts, mission_targets  WHERE mission.. ='$idMission -->
       <?php 
          while ($row = $query7->fetch(PDO::FETCH_ASSOC)):
            $mis_agents = unserialize($row["agents"]);            
            foreach ($mis_agents as $agent):   
              $mis_agentId = $agent." ";  

              $sql8s= "SELECT * FROM user INNER JOIN user_speciality  ON user.id='$mis_agentId' AND user_speciality.userId='$mis_agentId'";
            $query8s = $dbConnect->prepare($sql8s);
            $query8s->execute();
            while($row = $query8s->fetch(PDO::FETCH_ASSOC)):
              $us_miss_id = $row["id"];
              $specialities = unserialize($row["user_specialities"]);  
              foreach($specialities as $speciality) :
              $user_spec = $speciality." ";
              endforeach;
                  ?>
              <input  type="" name="agents" id="agent" value="<?= $us_miss_id ?>"/>
             
              <?php
              endwhile;
            endforeach;
      endwhile;
      ?>
       <div class="mb-3">
    
        <label for="agents" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Agents</label>
    
       <select class="form-control w-50 fs-5 pb--2 pe-2" multiple="multiple" name="agents[]" id="agents">   
        <?php
          foreach($result_s3 as $tab):
            $agent_id = $tab['id'];
            $agent_firstname = $tab['firstname'];
            $agent_lastname = $tab['lastname'];
            $agent_nation = $tab['nationality'];
           
            $agent_specialities = unserialize($tab['user_specialities']);
               foreach($agent_specialities as $speciality):
               $agent_speciality = $speciality;
              //  foreach ($mis_agents as $agent):
              //   $mis_agentId = $agent;  
               
            if ($agent_id == $us_miss_id) {
              // if($agent_speciality == $user_spec){
                $selected = "selected";
              } else {
                $selected = "";
              } 
              // }
           
         
            // echo '<pre>';
            // var_dump($result_s3);
            // echo '</pre>';
            
           echo "<option class=\"py-1\" value=" .$agent_id." ".$selected.">".$agent_speciality.": ". $agent_firstname." ".$agent_lastname." - ".$agent_nation."- id: ".$agent_id."</option>";
          //  endforeach;
          endforeach;
        endforeach;
          // echo '<pre>';
          // var_dump($mission_agents);
          // echo '</pre>';
         
          ?>
        </select>
      </div>
          <!-- ************************************** -->
          <!-- ****************Contacts******************* -->
        <div class="mb-3 d-flex mt-4">
          <label for="contacts" class="form-label fw-bold mb-2 fs-5 me-2" style="color: #01013d; width: 120px;">Contacts</label>
          <select name="contacts[]" multiple="multiple" id="contacts" class="fs-5 pb--2 pe-2" style="min-width: 330px;">

            <!-- recuperer que les agents -->
          <?php 
       while($row = $query_s4->fetch(PDO::FETCH_ASSOC)):
        $contactId = $row["id"];
        $lastname = $row["lastname"];
        $firstname = $row["firstname"];   
        $nation = $row["nationality"];
        echo "<option class=\"py-1\" value=".$contactId.">".$firstname." ".$lastname." - ".$nation."</option><hr>"; 
      endwhile;
          ?>
          </select>
          </div>
          <!-- ****************Targets******************* -->
        <div class="mb-3 d-flex mt-4">
          <label for="targets" class="form-label fw-bold mb-2 fs-5 me-2" style="color: #01013d; width: 120px;">Cibles</label>
          <select name="targets[]" multiple="multiple" id="targets" class="fs-5 pb--2 pe-2" style="min-width: 330px;">

            <!-- recuperer que les agents -->
          <?php 
       while($row = $query_s5->fetch(PDO::FETCH_ASSOC)):
        $targetId = $row["id"];
        $lastname = $row["lastname"];
        $firstname = $row["firstname"];   
        $nation = $row["nationality"];
         echo "<option class=\"py-1\" value=".$targetId.">".$firstname." ".$lastname." - ".$nation."</option><hr>"; 
      endwhile;
          ?>
          </select>
          </div>
          
      


<!-- ************fin d'affichage******************** -->
      <button type="submit" class="btn-info my-4 fs-5 fw-bold" name="submit">Enregistrer</button>
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
  <?php
  include_once "../includes/admin_footer.php";
  ?>