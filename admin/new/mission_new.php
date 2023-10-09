<?php 
//on demarre la session php
session_start();
//on traite le formulaire
if(!empty($_POST)){
  if(isset($_POST["title"], $_POST["description"], $_POST["startDate"], $_POST["endDate"], $_POST["country"], $_POST["missionStatus"]) &&!empty($_POST["title"]) &&!empty($_POST["description"]) &&!empty($_POST["startDate"]) &&!empty($_POST["endDate"]) &&!empty($_POST["country"]) &&!empty($_POST["missionStatus"])){
$title = strip_tags($_POST["title"]);
$description = strip_tags($_POST["description"]);
$startDate = strip_tags($_POST["startDate"]);
$endDate = strip_tags($_POST["endDate"]);
$country = strip_tags($_POST["country"]);
$missionStatus = strip_tags($_POST["missionStatus"]);

require_once "../../includes/DB.php";

$sql = "INSERT INTO `mission`(`title`, `description`, `startDate`, `endDate`, `country`, `missionStatus`) VALUES(:title, :description, :startDate, :endDate, :country, :missionStatus)";

$query = $dbConnect->prepare($sql);

$query->bindValue(':title', $title, PDO::PARAM_STR);
$query->bindValue(':description', $description, PDO::PARAM_STR);
$query->bindValue(':startDate', $startDate, PDO::PARAM_STR);
$query->bindValue(':endDate', $endDate, PDO::PARAM_STR);
$query->bindValue(':country', $country, PDO::PARAM_STR);
$query->bindValue(':missionStatus', $missionStatus, PDO::PARAM_STR);

if(!$query->execute()){
  die("Failed to insert INTO `mission`");
}

//  mysql_insert_id();
// inserer dans les tables d'acssociation
// $sql = "INSERT INTO `mission_code_name`(`missionCN_mission_id`, `missionCN_code_name_id`) VALUES(:mysql_insert_id(), :missionCN_code_name_id)";
$id = $dbConnect->lastInsertId();

// header("Location: missions.php");
echo "<p>La mission ajoutée sous le numéro ". $id."</p>";
echo "<a href='mission_new.php'>Retour</a>";
exit;

  }else{
    die("Le formulaire est incomplet");
  }
}

include_once "../../includes/admin_header.php";
include_once "../../includes/admin_navbar.php";
$titre = "Mission";
?>
</head>
<body class="body_page">
  <div class="container">
    <h1>Ajouter une mission</h1>
        <form class="form" action="mission_new.php" method="post">
          <div class="mb-3">
            <label for="title" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Titre</label>
            <input type="text" class="form-control w-50" name="title" id="title" value="">
          </div>

          <label for="description" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Déscription</label>
          <div class="mb-3">
            <textarea id="description" name="description" rows="5" cols="33">
            </textarea>
          </div>

          <div class="mb-3">
            <label for="startDate" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Date de debut</label>
            <input type="date" class="form-control w-50" name="startDate" id="startDate" value="">
          </div>
          <div class="mb-3">
            <label for="endDate" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Date de la fin</label>
            <input type="date" class="form-control w-50" name="endDate" id="endDate" value="">
          </div>
          <label for="country" class="form-label fw-bold my-2 fs-5">Pays</label>
          <div class="mb-3">
              
              <?php include_once "../../countries_list.php"; ?>
              <select name="country" id="country">
                <?php
              foreach ($countries as $country) {
                echo '<option value="'.$country["name"].'" name="<?= $country["name"] ?>'.$country["name"].'</option>';
            }
              ?>
              </select>
          </div>
          <label for="missionStatus" class="form-label fw-bold my-2 fs-5">Status</label>
          <div class="mb-3">
              
              <?php include_once "../../mission_status_list.php"; ?>
              <select name="missionStatus" id="missionStatus">
                <?php
              foreach ($statuses as $status) {
                echo '<option value="'.$status["name"].'" name="<?= $status["name"] ?>'.$status["name"].'</option>';
            }
              ?>
              </select>
          </div>
          
  <button type="submit" class="btn btn-primary my-4 fs-4 fw-bold" name="Submit">Créer</button>
</form>

<div>
<button type="button" class="login my-4 fs-4 fw-bold" data-toggle="tooltip" data-placement="top">
  <a href="../admin_index.php">Admin</a>
</button>
</div>
<?php
include_once "../../includes/admin_footer.php";
?>
