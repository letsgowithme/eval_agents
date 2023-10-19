<?php
  require_once "../../includes/DB.php";
  $titre = "Supprimer la mission";
  include_once "../includes/admin_header.php";
  include_once "../includes/admin_sidebar.php";
$up_id = $_GET["id"];

if(isset($_POST["submit"])){ 
  
   $title = $_POST["title"];
   $description = $_POST["description"];
   $startDate = $_POST["startDate"];
   $endDate = $_POST["endDate"];
   $country = $_POST["country"];
   $missionStatus = $_POST["missionStatus"];
   $codeName = $_POST["codeName"];

  $sql = "DELETE FROM `mission` WHERE id='$up_id'";

    $query = $dbConnect->query($sql); 
    $Execute = $query->execute();
    if($Execute){
    echo '<script>window.open("../lists/missions_adm.php?id=Utilisateur a été supprimé", "_self")</script>';
    header("Location: ../lists/usersAll.php");
    echo '<h3>Mission a été supprimé</h3>';
    }
}

global $dbConnect;
// require_once "../../includes/DB.php";
$sql = "SELECT * FROM `mission` WHERE `id` = '$up_id'";
$query = $dbConnect->query($sql);

while($row = $query->fetch()){
  $id = $row["id"];
  $title = $row["title"];
  $description = $row["description"];
  $startDate = $row["startDate"];
  $endDate = $row["endDate"];
  $country = $row["country"];
  $missionStatus = $row["missionStatus"];
  $codeName = $row["codeName"];

}
  ?>
   <link href="../../style/style.css" rel="stylesheet" type="text/css">
  <link href="../../style/style_in_ad.css" rel="stylesheet" type="text/css">
  <link rel="icon" href="../logo.png">
  <style>
input{
  font-weight: 500;
}
    </style>
</head>

<div class="body_home body_page py-4">
<div>
   
<h1>Supprimer la mission</h1><div class="message"></div>    

<form method="post" action="mission_delete.php?id=<?php echo $up_id; ?>">



<!-- ******************titre de la mission****************** -->
<div class="mb-3">
            <label for="title" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Titre</label>
            <input type="text" class="form-control w-50" name="title" disabled id="title" value="<?php echo $title ?>">
          </div>
   <!-- ******************Description de la mission****************** -->
   <div class="mb-3 d-flex" style="align-items: start;" >
    <label for="description" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Description</label>
   <textarea name="description" id="description" cols="54" disabled rows="10"><?php echo $description ?></textarea>
   </div>
   <!-- ******************startDate de La mission****************** -->
   <div class="mb-3 d-flex">
   <label for="startDate" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Date de debut</label> 
   <button type="button" class="fs-6 me-4" disabled value="<?php echo $startDate ?>" name="btnStartDate" id="btnStartDate"><?php echo $startDate ?></button>
  <input type="dateTime" style="display: none;" name="startDate" id="startDate" placeholder="<?php echo $startDate ?>" value="<?php echo $startDate ?>">
 
    </div>
       <!-- ******************endDate de La mission****************** -->
   <div class="mb-3 d-flex">
   <label for="endDate" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Date de debut</label> 
   <button type="button" class="fs-6 me-4" disabled value="<?php echo $endDate ?>" name="btnStartDate" id="btnStartDate"><?php echo $endDate ?></button>
  <input type="dateTime" style="display: none;" name="endDate" id="endDate" placeholder="<?php echo $endDate ?>" value="<?php echo $endDate ?>">
  </div>
   <!-- ******************Pays de la mission****************** -->
   <div class="mb-3">
    <label for="country" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Pays</label>
    <input type="text" name="country" id="country" disabled value="<?php echo $country ?>">
   </div>
   
   
   </div>
 <!-- ******************missionStatus de La mission****************** -->
 <div class="mb-3">
   <label for="missionStatus" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Status</label> 
  <input type="text" name="missionStatus" id="missionStatus" disabled placeholder="YYYY-MM-DD" value="<?php echo $missionStatus ?>">
    </div>
     <!-- ******************codeName de La mission****************** -->
   <div class="mb-3">
   <label for="codeName" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Nom de code</label> 
  <input type="text" name="codeName" id="codeName" disabled placeholder="YYYY-MM-DD" value="<?php echo $codeName ?>">
    </div>

   <button type="submit" class="btn-info my-4 fs-5 fw-bold" name="submit">Supprimer</button>
</form>
</div>
</div>
</div>


<?php
include_once "../includes/admin_footer.php";
?>
