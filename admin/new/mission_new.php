<?php 
//on demarre la session php

//on traite le formulaire
if(!empty($_POST)){
  if(isset($_POST["title"], $_POST["description"], $_POST["startDate"], $_POST["endDate"], $_POST["country"], $_POST["missionStatus"], $_POST["codeName"]) &&!empty($_POST["title"]) &&!empty($_POST["description"]) &&!empty($_POST["startDate"]) &&!empty($_POST["endDate"]) &&!empty($_POST["country"]) &&!empty($_POST["missionStatus"])&&!empty($_POST["codeName"])){
$title = strip_tags($_POST["title"]);
$description = strip_tags($_POST["description"]);
$startDate = strip_tags($_POST["startDate"]);
$endDate = strip_tags($_POST["endDate"]);
$country = strip_tags($_POST["country"]);
$missionStatus = strip_tags($_POST["missionStatus"]);
$codeName = strip_tags($_POST["codeName"]);

if(isset($_POST["agents"])){ 
  $agentsArr = [];
  for($i =0; $i < count($_POST['agents']);$i++){
    $agent = $_POST['agents'][$i];
    $agentsArr[] = $agent;
  }   

  $agents = implode(",", $agentsArr);
 

require_once "../../includes/DB.php";

$sql = "INSERT INTO `mission`(`title`, `description`, `startDate`, `endDate`, `country`, `missionStatus`, `codeName`) 
VALUES(:title, :description, :startDate, :endDate, :country, :missionStatus, :codeName)";

$query = $dbConnect->prepare($sql);

$query->bindValue(':title', $title, PDO::PARAM_STR);
$query->bindValue(':description', $description, PDO::PARAM_STR);
$query->bindValue(':startDate', $startDate, PDO::PARAM_STR);
$query->bindValue(':endDate', $endDate, PDO::PARAM_STR);
$query->bindValue(':country', $country, PDO::PARAM_STR);
$query->bindValue(':missionStatus', $missionStatus, PDO::PARAM_STR);
$query->bindValue(':codeName', $codeName, PDO::PARAM_STR);

if(!$query->execute()){
  die("Failed to insert INTO `mission`");
}
$id = $dbConnect->lastInsertId();

// Remplir table mission_agents
$mA_mission_id = $dbConnect->lastInsertId();

// $sql2 = "INSERT INTO `mission_agents` (`mA_mission_id`, `agents` VALUES('$mA_mission_id', :agents)";
// $query = $dbConnect->prepare($sql2);

// $query->bindValue(':mA_mission_id', $mA_mission_id, PDO::PARAM_INT);
// $query->bindValue(':agents', $agents, PDO::PARAM_STR);
// if(!$query->execute()){
//   die("Failed to insert INTO `mission_agents`");
// }
header("Location: ../../missions.php");
echo "<p>La mission ajoutée sous le numéro ". $id."</p>";
echo "<a href='mission_new.php'>Retour</a>";
exit;

  }else{
    die("Le formulaire est incomplet");
  }
}
}

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
            <label for="title" class="form-label fw-bold my-2 fs-4" style="color: #01013d;">Titre</label>
            <input type="text" class="form-control w-25" name="title" id="title" value="">
          </div>

          <label for="description" class="form-label fw-bold my-2 fs-4" style="color: #01013d;">Déscription</label>
          <div class="mb-3">
            <textarea id="description" name="description" rows="5" cols="44">
            </textarea>
          </div>

          <div class="mb-3">
            <label for="startDate" class="form-label fw-bold my-2 fs-4" style="color: #01013d;">Date de debut</label>
            <input type="date" class="form-control w-25" name="startDate" id="startDate" value="">
          </div>
          <div class="mb-3">
            <label for="endDate" class="form-label fw-bold my-2 fs-4" style="color: #01013d;">Date de la fin</label>
            <input type="date" class="form-control w-25" name="endDate" id="endDate" value="">
          </div>

         <?php include_once "../lists/countries.php"; ?>
         <?php include_once "../lists/statuses.php"; ?>
         
          <div class="mb-3">
            <label for="codeName" class="form-label fw-bold my-2 fs-4" style="color: #01013d;">Nome de code</label>
            <input type="text" class="form-control w-25" name="codeName" id="codeName" value="">
          </div>
         
            <?php include_once('../lists/missionTypes.php');?>
           
            <?php include_once('../lists/specialities.php');?>

            <?php include_once('../lists/agents_list.php');?>
            <?php include_once('../lists/contacts_list.php');?>
            <?php include_once('../lists/targets_list.php');?>
       
          <?php
                  include_once "btn_create.php";
                  ?>
        </form>
        </div>
        
        <?php
        include_once "../includes/admin_footer.php";
        ?>
