<?php
//on demarre la session php
$index=true;
$titre = "Delete";
include_once "../includes/admin_header.php";
include_once "../includes/admin_sidebar.php";
include_once "../../includes/DB.php";         
include_once "../includes/admin_footer.php";

if(!empty($_GET["id"])){
  $sql = "DELETE FROM user WHERE id=:id";
  $query = $dbConnect->prepare($sql); 
  $Execute = $query->execute(["id"=>$_GET["id"]]);
  $query->closeCursor();
  echo '<h2 class="text-center" style="position:absolute; top: 20%; left: 50%;">Utilisateur supprimé<br><a href="../lists/usersAll.php">Retour vers la Liste d\'utilisateurs</h2>';
}
if(!empty($_GET["idMission"])){
  $sql =" DELETE FROM mission_missionType WHERE mmt_missionId=:id";
  $query = $dbConnect->prepare($sql); 
  $Execute = $query->execute(["id"=>$_GET["idMission"]]);

 $sql2 = "DELETE FROM `mission` WHERE id=:id";
  $query2 = $dbConnect->prepare($sql2); 
  $Execute = $query2->execute(["id"=>$_GET["idMission"]]);
  $query2->closeCursor();
  echo '<h2 class="text-center" style="position:absolute; top: 20%; left: 50%;">Mission supprimée<br><a href="../lists/missions_adm.php">Retour vers la Liste de missions</h2>';
}
if(!empty($_GET["idHideout"])){
  $sql = "DELETE FROM `hideout` WHERE id=:id";
  $query = $dbConnect->prepare($sql); 
  $  $Execute = $query->execute(["id"=>$_GET["idHideout"]]);
  $query->closeCursor();
  echo '<h2 class="text-center" style="position:absolute; top: 20%; left: 50%;">La planque supprimée<br><a href="../lists/hideouts.php">Retour vers la Liste de planques</h2>';
}
if(!empty($_GET["idSpeciality"])){
  $sql = "DELETE FROM `speciality` WHERE id=:id";
  $query = $dbConnect->prepare($sql); 
  $Execute = $query->execute(["id"=>$_GET["idSpeciality"]]);
  $query->closeCursor();
  echo '<h2 class="text-center" style="position:absolute; top: 20%; left: 50%;">La spécialité supprimée<br><a href="../lists/specialities.php">Retour vers la Liste de planques</h2>';
}
if(!empty($_GET["idMissionType"])){
  $sql = "DELETE FROM `missionType` WHERE id=:id";
  $query = $dbConnect->prepare($sql); 
  $  $Execute = $query->execute(["id"=>$_GET["isMissionType"]]);
  $query->closeCursor();
  echo '<h2 class="text-center" style="position:absolute; top: 20%; left: 50%;">Le type de mission supprimée<br><a href="../lists/hideouts.php">Retour vers la Liste de types de mission</h2>';
}
?>
