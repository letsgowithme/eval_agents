<?php 
include_once("../../includes/DB.php");
if(!empty($_POST["countryList"])){
$sql_s_s1 = "SELECT * FROM hideout WHERE country=:countryChoice ORDER BY city ASC";
$query_s_s1 = $dbConnect->prepare($sql_s_s1);
$query_s_s1->execute(["countryChoice" => $_POST["countryList"]]);

while ($row = $query_s_s1->fetch(PDO::FETCH_ASSOC)):
echo "<option value=".$row["country"].">".$row["country"]." ".$row["city"]." ".$row["hideoutType"]."</option>";
endwhile;
$query_s_s1->closeCursor();
}
// *********************************************************
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
  // *********************************************************
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

// if(!empty($_POST["speciality"])){
//   $sql_s3 = "SELECT * FROM user, user_one_speciality  WHERE user.id=user_oneSp_Id"; 
//           $query_s3 = $dbConnect->query($sql_s3);
//           $query_s3->execute();
//        while($row = $query_s3->fetch(PDO::FETCH_ASSOC)):
//         $agentId = $row["id"];
//         $lastname = $row["lastname"];
//         $firstname = $row["firstname"];   
//         $user_spec_id = $row["speciality_us_id"];
     
//           $sql_s3_1 = "SELECT * FROM speciality WHERE id = '$speciality_us_id'";
//           $query_s3_1 = $dbConnect->query($sql_s3_1);
//           $query_s3_1->execute();
         
//           while($row = $query_s3_1->fetch(PDO::FETCH_ASSOC)): 
//             $speciality_user_id = $row['speciality_us_id'];

//           echo "<option class=\"py-1 user_spec\"  value=".$agentId." ".$selected." ".">".$speciality_user_id." - ".$firstname." ".$lastname."</option><hr>"; 

//           endwhile;
//          endwhile;
// }

// if(!empty($_POST["speciality"])){
//   $sql_s_s2 = "SELECT * FROM mission_agents WHERE mission_agents.agents=:agentsToChoose";
//   $query_s_s2 = $dbConnect->prepare($sql_s_s2);
//   $query_s_s2->execute(["agentsToChoose" => $_POST["speciality"]]);
  
//   while ($row = $query_s_s2->fetch(PDO::FETCH_ASSOC)):
//     $agents = unserialize($row["agents"]);
//     foreach ($agents as $agent) {
//      $agentId = $agent;
//   echo "<option value=".$agentId.">".$agentId." ".$row["city"]." ".$row["hideoutType"]."</option>";
//     }
//   endwhile;
//   $query_s_s1->closeCursor();
//   }
?>