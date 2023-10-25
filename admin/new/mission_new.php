<?php 
require_once "../../includes/DB.php";
$sql = "SELECT * FROM missionType";
$query = $dbConnect->prepare($sql);
$query->execute();

$sql2 = "SELECT * FROM `speciality` ORDER BY `title` ASC";
$query2 = $dbConnect->query($sql2);
$query2->execute();

$sql3 = "SELECT id, firstname, lastname, specialities FROM `user` WHERE userType=\"agent\" ORDER BY `lastname` ASC";
$query3 = $dbConnect->query($sql3);
$query3->execute();

//on traite le formulaire
if(!empty($_POST)){
  if(isset($_POST["title"], $_POST["description"], $_POST["startDate"], $_POST["endDate"], $_POST["country"], $_POST["missionStatus"], $_POST["codeName"], $_POST["mmt_missionTypeId"]) &&!empty($_POST["title"]) &&!empty($_POST["description"]) &&!empty($_POST["startDate"]) &&!empty($_POST["endDate"]) &&!empty($_POST["country"]) &&!empty($_POST["missionStatus"]) &&!empty($_POST["codeName"]) &&!empty($_POST["mmt_missionTypeId"])){
   


$title = strip_tags($_POST["title"]);
$description = strip_tags($_POST["description"]);
$startDate = strip_tags($_POST["startDate"]);
$endDate = strip_tags($_POST["endDate"]);
$country = strip_tags($_POST["country"]);
$missionStatus = strip_tags($_POST["missionStatus"]);
$codeName = strip_tags($_POST["codeName"]);
$mmt_missionTypeId = strip_tags($_POST["mmt_missionTypeId"]);
$specialityId = strip_tags($_POST["speciality"]);
$agents = serialize($_POST["agents"]);
var_dump($agents);
// ***************************************************

$sql4 = "INSERT INTO `mission`(`title`, `description`, `startDate`, `endDate`, `country`, `missionStatus`, `codeName`) 
VALUES(:title, :description, :startDate, :endDate, :country, :missionStatus, :codeName)";

$query4 = $dbConnect->prepare($sql4);

$query4->bindValue(':title', $title, PDO::PARAM_STR);
$query4->bindValue(':description', $description, PDO::PARAM_STR);
$query4->bindValue(':startDate', $startDate, PDO::PARAM_STR);
$query4->bindValue(':endDate', $endDate, PDO::PARAM_STR);
$query4->bindValue(':country', $country, PDO::PARAM_STR);
$query4->bindValue(':missionStatus', $missionStatus, PDO::PARAM_STR);
$query4->bindValue(':codeName', $codeName, PDO::PARAM_STR);

if(!$query4->execute()){
  die("Failed to insert INTO `mission`");
}
$id = $dbConnect->lastInsertId();

// Remplir table mission_misionType
$mmt_missionId = $dbConnect->lastInsertId();

$sql5 = "INSERT INTO mission_missionType (mmt_missionId, mmt_missionTypeId) VALUES('$mmt_missionId', '$mmt_missionTypeId');";
$query5 = $dbConnect->prepare($sql5);
$query5->execute();


$sql6 = "INSERT INTO mission_speciality (mission_Id, mis_spec_id) VALUES('$mmt_missionId', '$specialityId');";
$query6 = $dbConnect->prepare($sql6);
$query6->execute();

$sql7 = "INSERT INTO mission_agents (mA_mission_id, agents) VALUES('$mmt_missionId', '$agents');";
$query7 = $dbConnect->prepare($sql7);
$query7->execute();




// header("Location: ../lists/missions_adm.php");
echo "<p>La mission ajoutée sous le numéro ". $id."</p>";
echo "<a href='mission_new.php'>Retour</a>";
exit;

  }else{
    die("Le formulaire est incomplet");
  }
}
// }

include_once "../includes/admin_header.php";
include_once "../includes/admin_sidebar.php";
$titre = "Mission";
?>
<link rel="stylesheet" href="../../style/style_in_ad.css">
<link rel="stylesheet" href="../../style/style.css">
</head>
<div class="body_page_new py-4">
 

<h1>Ajouter une mission</h1>  
 
        <form class="form" action="mission_new.php" method="post">
          <div class="mb-3">
            <label for="title" class="form-label fw-bold my-2 fs-4 text-light">Titre</label>
            <input type="text" class="form-control" style="max-width: 400px;"  name="title" id="title" value="" required>
          </div>
          
          <label for="description" class="form-label fw-bold my-2 fs-4 text-light" >Déscription</label>
          <div class="mb-3">
            <textarea id="description" name="description" rows="5" cols="44">
            </textarea>
          </div>

          <div class="mb-3">
            <label for="startDate" class="form-label fw-bold my-2 fs-4 text-light">Date de debut</label>
            <input type="date" class="form-control" style="max-width: 400px;" name="startDate" id="startDate" value="" required>
          </div>
          <div class="mb-3">
            <label for="endDate" class="form-label fw-bold my-2 fs-4 text-light">Date de la fin</label>
            <input type="date" class="form-control" style="max-width: 400px;" name="endDate" id="endDate" value="" required>
          </div>

         <?php include_once "../lists/countries.php"; ?>
         <?php include_once "../lists/statuses.php"; ?>
         
          <div class="mb-3">
            <label for="codeName" class="form-label fw-bold my-2 fs-4 text-light">Nome de code</label>
            <input type="text" class="form-control"  style="max-width: 400px;" name="codeName" id="codeName" value="" required>
          </div>
          
         <!-- ************missionType de La mission************** -->
           <label for="missionType" class="form-label fw-bold my-2 fs-4 text-light">Type de mission</label>
           <select class="form-control"  style="max-width: 400px;" name="mmt_missionTypeId" required>
           <?php 
           
           while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $mt_id = $row["id"];
            $mt_title = $row["title"];
            echo "<option value=".$mt_id."><span>".$mt_title."</span></option>";
          }
         ?>      
           </select>

          <!-- ****************Speciality******************* -->
          <div class="mb-3 d-flex mt-4">
          <label for="speciality" class="form-label fw-bold mb-2 fs-4 me-2" style="color: #01013d; width: 120px;">Spécialité</label>
        
          <select name="speciality" id="speciality"  class="fs-5 pb--2 pe-2" style="min-width: 330px;">
            
          <?php 
       foreach($query2->fetchAll(PDO::FETCH_ASSOC) as $tab){ 
        $specialityId = $tab["id"];
        $speciality = $tab["title"];
        echo "<option value=".$specialityId.">".$speciality."</option>"; }
          ?>
          </select>
          </div>
 <!-- ****************Agents******************* -->
        <div class="mb-3 d-flex mt-4">
          <label for="agent" class="form-label fw-bold mb-2 fs-4 me-2" style="color: #01013d; width: 120px;">Agents</label>
          <select name="agents[]" multiple="multiple" id="agent" class="fs-5 pb--2 pe-2" style="min-width: 330px;">
            
          <?php 
       foreach($query3->fetchAll(PDO::FETCH_ASSOC) as $tab){ 
        // var_dump($query3->fetchAll(PDO::FETCH_ASSOC));
        $agentId = $tab["id"];
        $lastname = $tab["lastname"];
        $firstname = $tab["firstname"];
        $agentSpeciality = $tab["specialities"];
       
        echo "<option class=\"py-1\" value=".$agentId.">".$lastname." ". $firstname.": ". $agentSpeciality."</option>"; }
          ?>
          </select>
          </div>
          <!-- ************************************** -->
      

          
            <?php 
            // include_once('../lists/agents_list.php');
            ?>
            <?php include_once('../lists/contacts_list.php');?>
            <?php include_once('../lists/targets_list.php');?>
       
          <?php
                  include_once "btn_create.php";
                  ?>
        </form>
        </div>
        <script>
function toggleList() {
  var toggleBtn = document.getElementById("toggleBtn"); 
  var specialities_list = document.getElementById("specialities_list");
  if (specialities_list.style.display === "none") {
    specialities_list.style.display = "block";
  } else if(specialities_list.style.display === "block") {
    specialities_list.style.display = "none";
  }
}
        </script>
        <?php
        $query->closeCursor();
        $query2->closeCursor();
        $query3->closeCursor();
  
        include_once "../includes/admin_footer.php";
        ?>
