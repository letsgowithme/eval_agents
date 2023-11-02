<?php 
include_once("../../includes/DB.php");
if(!empty($_POST["countryList"])){
$sql_s_s1 = "SELECT * FROM hideout WHERE country=:countryChoice ORDER BY city ASC";
$query_s_s1 = $dbConnect->prepare($sql_s_s1);
$query_s_s1->execute(["countryChoice" => $_POST["countryList"]]);

while ($row = $query_s_s1->fetch(PDO::FETCH_ASSOC)):
echo "<option value=".$row["country"].">".$row["address"]." ".$row["city"]." ".$row["country"]." -  ".$row["hideoutType"]."</option>";


endwhile;
$query_s_s1->closeCursor();
}

// *******************email unique verification********************************
if(!empty($_POST["email"])){
  $sql_s_s2 = "SELECT * FROM agents WHERE email=:email";
  $query_s_s2 = $dbConnect->prepare($sql_s_s2);
  $query_s_s2->execute(["email" => $_POST["email"]]);
  
  while ($row = $query_s_s2->fetch(PDO::FETCH_ASSOC)):
    if($row >= 1){
      ?>
      <script>
      alert('Email existe déjà');
      </script>
      <?php

  }else{
     
    $email = strip_tags($_POST["email"]);
  }
  endwhile;

  $query_s_s2->closeCursor();
  }
  // ********************codeName unique verification*****************************
if(!empty($_POST["codeName"])){
  $sql_s_s3 = "SELECT * FROM person WHERE codeName=:codeName";
  $query_s_s3 = $dbConnect->prepare($sql_s_s3);
  $query_s_s3->execute(["codeName" => $_POST["codeName"]]);
  
  while ($row = $query_s_s3->fetch(PDO::FETCH_ASSOC)):
    if($row >= 1){
      ?>
      <script>
      alert('Le nom de code déjà existe');
      </script>
      <?php

  }else{
     
    $codeName = strip_tags($_POST["codeName"]);
  }
  endwhile;

  $query_s_s3->closeCursor();
  } 

  if(!empty($_POST["title"])){
    $sql_s_s4 = "SELECT * FROM speciality WHERE title=:title";
    $query_s_s4 = $dbConnect->prepare($sql_s_s4);
    $query_s_s4->execute(["title" => $_POST["title"]]);
    
    while ($row = $query_s_s4->fetch(PDO::FETCH_ASSOC)):
      if($row >= 1){
        ?>
        <script>
        alert('La spécialité existe déjà');
        </script>
        <?php
  
    }else{
       
      $title = strip_tags($_POST["title"]);
    }
    endwhile;
  
    $query_s_s4->closeCursor();
  }
// 

// if(!empty($_POST["speciality"])){
//   $us_specialities = [];
//   $sql2 = "SELECT * FROM agents WHERE agents.specialities=:spec_agentsToChoose";
//   $query2 = $dbConnect->prepare($sql2);
//   $query2->execute(["spec_agentsToChoose" => $_POST["speciality"]]);
  
//   while ($row = $query2->fetch(PDO::FETCH_ASSOC)):
//     $id_user_agent = $row["id_user_agent"];
//     $specialities = unserialize($row["specialities"]);
//     foreach ($specialities as $speciality) {
//      $specialityId = $speciality.",";
//      $us_specialities[] = $specialityId;
//      if(in_array($_POST["speciality"], $us_specialities)){
          
//       $selected  = "selected";
//     }else {
//       $selected = "";
//     }
//   echo "<option value=".$specialityId.". $selected>".$id_user_agent." ".$specialityId."</option>";
//     }
//   endwhile;
//   $query2->closeCursor();
//   }
// ?>