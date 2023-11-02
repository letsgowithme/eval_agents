<?php
//on demarre la session php
$index=true;
$titre = "Delete";


include_once "../../includes/DB.php";         
include_once "../includes/admin_footer.php";

if(!empty($_GET["id"])){
  $sql1 =" DELETE FROM agents WHERE id_user_agent=:id";
  $query1 = $dbConnect->prepare($sql1); 
  $Execute = $query1->execute(["id"=>$_GET["id"]]);
  $sql1_1 = "DELETE FROM person WHERE id=:id";
  $query1_1 = $dbConnect->prepare($sql1_1); 
  $Execute = $query1_1->execute(["id"=>$_GET["id"]]);
  $query1_1->closeCursor();
  // echo '<h2 class="text-center" style="position:absolute; top: 20%; left: 50%;">Utilisateur supprimé<br><a href="../lists/usersAll.php">Retour vers la Liste d\'utilisateurs</h2>';
  header("Location: ../lists/usersAll.php");
}
if(!empty($_GET["idMission"])){
  $sql2 =" DELETE FROM mission_missionType WHERE mmt_missionId=:id";
  $query2 = $dbConnect->prepare($sql2); 
  $Execute = $query2->execute(["id"=>$_GET["idMission"]]);

  $sql2_2 =" DELETE FROM mission_agents WHERE ma_mission_id=:id";
  $query2_2 = $dbConnect->prepare($sql2_2); 
  $Execute = $query2_2->execute(["id"=>$_GET["idMission"]]);

  $sql2_3 =" DELETE FROM mission_contacts WHERE mc_mission_id=:id";
  $query2_3 = $dbConnect->prepare($sql2_3); 
  $Execute = $query2_3->execute(["id"=>$_GET["idMission"]]);

  $sql2_4 =" DELETE FROM mission_targets WHERE mt_mission_id=:id";
  $query2_4 = $dbConnect->prepare($sql2_4); 
  $Execute = $query2_4->execute(["id"=>$_GET["idMission"]]);

  $sql2_5 =" DELETE FROM mission_speciality WHERE mission_Id=:id";
  $query2_5 = $dbConnect->prepare($sql2_5); 
  $Execute = $query2_5->execute(["id"=>$_GET["idMission"]]);

  $sql2_6 =" DELETE FROM mission_hideouts WHERE missionId=:id";
  $query2_6 = $dbConnect->prepare($sql2_6); 
  $Execute = $query2_6->execute(["id"=>$_GET["idMission"]]);

  $sql2_1 = "DELETE FROM `mission` WHERE id=:id";
  $query2_1 = $dbConnect->prepare($sql2_1); 
  $Execute = $query2_1->execute(["id"=>$_GET["idMission"]]);
  $query2_1->closeCursor();
  echo '<h2 class="text-center" style="position:absolute; top: 20%; left: 50%;">Mission supprimée<br><a href="../lists/missions_adm.php">Retour vers la Liste de missions</h2>';
}
if(!empty($_GET["idHideout"])){
  $sql3 =" DELETE FROM mission_hideouts WHERE idHideout=:id";
  $query3 = $dbConnect->prepare($sql3); 
  $Execute = $query3->execute(["id"=>$_GET["idHideout"]]);
  $sql3_1 = "DELETE FROM `hideout` WHERE id=:id";
  $query3_1 = $dbConnect->prepare($sql3_1); 
  $Execute = $query3_1->execute(["id"=>$_GET["idHideout"]]);
  $query3_1->closeCursor();
  echo '<h2 class="text-center" style="position:absolute; top: 20%; left: 50%;">La planque supprimée<br><a href="../lists/hideouts.php">Retour vers la Liste de planques</h2>';
}
if(!empty($_GET["idSpeciality"])){
  $sql4 =" DELETE FROM mission_speciality WHERE mis_spec_id=:id";
  $query4 = $dbConnect->prepare($sql4); 
  $Execute = $query4->execute(["id"=>$_GET["idSpeciality"]]);
  $sql4_1 = "DELETE FROM `speciality` WHERE id=:id";
  $query4_1 = $dbConnect->prepare($sql4_1); 
  $Execute = $query4_1->execute(["id"=>$_GET["idSpeciality"]]);
  $query4_1->closeCursor();
  echo '<h2 class="text-center" style="position:absolute; top: 20%; left: 50%;">La spécialité supprimée<br><a href="../lists/specialities.php">Retour vers la Liste de spécialités</h2>';
}
if(!empty($_GET["idMissionType"])){
  $sql5 =" DELETE FROM mission_missionType WHERE mmt_missionTypeId=:id";
  $query5 = $dbConnect->prepare($sql5); 
  $Execute = $query5->execute(["id"=>$_GET["idMissionType"]]);
  $sql5_1 = "DELETE FROM `missionType` WHERE id=:id";
  $query5_1 = $dbConnect->prepare($sql5_1); 
  $Execute = $query5_1->execute(["id"=>$_GET["idMissionType"]]);
  $query5_1->closeCursor();
  echo '<h2 class="text-center" style="position:absolute; top: 20%; left: 50%;">Le type de mission supprimée<br><a href="../lists/missionTypes.php">Retour vers la Liste de types de mission</h2>';
}
include_once "../includes/admin_header.php";
include_once "../includes/admin_sidebar.php";
?>
