<?php
include_once("../../includes/DB.php");
if(!empty($_POST["countryList"])){
  $sql_s1 = "SELECT * FROM person WHERE country=:countryContact AND userTYPE='contact'";
  $query_s1 = $dbConnect->prepare($sql_s1);
  $query_s1->execute(["countryContact" => $_POST["countryList"]]);
  
  while ($row = $query_s1->fetch(PDO::FETCH_ASSOC)):
  echo "<option value=".$row["country"].">".$row["firstname"]." ".$row["lastname"]." (".$row["country"].")</option>";
  endwhile;
  $query_s1->closeCursor();
  }
  // *********************************************
  if(!empty($_POST["targets"])){
    $sql_s2 = "SELECT * FROM person WHERE nationality!=:agentNationality AND userTYPE='agent'";
    $query_s2 = $dbConnect->prepare($sql_s2);
    $query_s2->execute(["agentNationality" => $_POST["targets"]]);
    
    while ($row = $query_s2->fetch(PDO::FETCH_ASSOC)):
      $agentId = $row["id"];
       $ag_nation = $row["nationality"];
       $ag_firstname = $row["firstname"];
       $ag_lastname = $row["lastname"];
       
      $sql_s8 = "SELECT * FROM agents WHERE id_user_agent = '$agentId'"; 
      $query_s8 = $dbConnect->query($sql_s8);
      $query_s8->execute();
      while ($row8 = $query_s8->fetch(PDO::FETCH_ASSOC)) :
        $specialities = unserialize($row8["specialities"]);
        foreach ($specialities as $user_speciality) :
        echo $user_speciality.", ";
         
        echo "<option value=".$agentId.">".$user_speciality." - ".$row["firstname"]." ".$row["lastname"]." - ".$row["nationality"]."</option>";
      

     
    endforeach;
    endwhile;
  
endwhile;
    $query_s2->closeCursor();
$query_s8->closeCursor();
    
    }

if(!empty($_POST["title"])){
  // ******
  $sql_s_s5 = "SELECT * FROM missionType WHERE title=:title";
  $query_s_s5 = $dbConnect->prepare($sql_s_s5);
  $query_s_s5->execute(["title" => $_POST["title"]]);
  
  while ($row = $query_s_s5->fetch(PDO::FETCH_ASSOC)):
    if($row >= 1){
      ?>
      <script>
      alert('Le type existe déjà');
      </script>
      <?php
  }else{
    $title = strip_tags($_POST["title"]);
  }
  endwhile;
  $query_s_s5->closeCursor();
  }
  // **********************************************
//     if(!empty($_POST["speciality"])){
//       $us_specArr = [];
//       $specId = $_POST["speciality"];
     
//       // $sql_s9 = "SELECT title FROM speciality WHERE id = '$specId'"; 
//       // $query_s9 = $dbConnect->query($sql_s9);
//       // $query_s9->execute();
//       // $row9 = $query_s9->fetch(PDO::FETCH_ASSOC); 
//       //   $specTitle = $row9["title"];
      
//     $sql_s2 = "SELECT * FROM person WHERE id=:agentId AND userTYPE='agent'";
//     $query_s2 = $dbConnect->prepare($sql_s2);
//     $query_s2->execute(["agentId" => $_POST["speciality"]]);
//     while ($row = $query_s2->fetch(PDO::FETCH_ASSOC)):
//       $agentId = $row["id"];
//        $ag_nation = $row["nationality"];
//        $ag_firstname = $row["firstname"];
//        $ag_lastname = $row["lastname"];
       
//       $sql_s8 = "SELECT * FROM agents WHERE id_user_agent = '$agentId'"; 
//       $query_s8 = $dbConnect->query($sql_s8);
//       $query_s8->execute();
//       while ($row8 = $query_s8->fetch(PDO::FETCH_ASSOC)) :
//         $specialities = unserialize($row8["specialities"]);      
//         foreach ($specialities as $user_speciality) :
//         $us_speciality = $user_speciality;
//         $sql_s9 = "SELECT id FROM speciality WHERE title = '$us_speciality'"; 
//       $query_s9 = $dbConnect->query($sql_s9);
//       $query_s9->execute();
//       $row9 = $query_s9->fetch(PDO::FETCH_ASSOC); 
//         $us_specialityId = $row9["id"];
//         // *******************     
//         // $us_specArr[]= $us_speciality;
//         if($specId == $us_specialityId)
//               {
//         echo "<option value=".$agentId." name=".$us_specialityId.">".$us_speciality." - ".$row["firstname"]." ".$row["lastname"]." - ".$row["nationality"]."</option>";
//       }      
//       //  echo '<pre>';
//       //   print_r($specId);
//       //   echo '</pre>';
   
//           endforeach;
//     endwhile;
// endwhile;


//     $query_s2->closeCursor();
// $query_s8->closeCursor();
    
//     }
if(!empty($_POST["speciality"])){
  // $us_specArr = [];
  $sql_s22 = "SELECT * FROM agents WHERE specialities=:ag_specialities";
  $query_s22 = $dbConnect->prepare($sql_s22);
  $query_s22->execute(["ag_specialities" => $_POST["speciality"]]);
  
  while ($row = $query_s22->fetch(PDO::FETCH_ASSOC)):
    $agentId = $row["id_user_agent"];
    $specialities = unserialize($row["specialities"]);
  
    $sql_s8 = "SELECT * FROM person WHERE id = '$agentId'"; 
     $query_s8 = $dbConnect->query($sql_s8);
     $query_s8->execute();
     while ($row8 = $query_s8->fetch(PDO::FETCH_ASSOC)) :
      $agentId = $row["id"];
      $ag_nation = $row["nationality"];
      $ag_firstname = $row["firstname"];
      $ag_lastname = $row["lastname"];

    foreach ($specialities as $user_spec) :
     $user_speciality = $user_spec;

      $sql_s9 = "SELECT id FROM speciality WHERE title = '$user_speciality'"; 
      $query_s9 = $dbConnect->query($sql_s9);
      $query_s9->execute();
      $row9 = $query_s9->fetch(PDO::FETCH_ASSOC); 
       $us_spec_id = $row9["id"];

    // if($_POST["speciality"] == $us_spec_id){  
      echo "<option value=".$_POST["speciality"]."</option>";
      // echo "<option value=".$agentId.">".$user_speciality." - ".$row["firstname"]." ".$row["lastname"]." - ".$row["nationality"]."</option>";

    // }
  endforeach;
  endwhile;
endwhile;
//   $query_s2->closeCursor();
// $query_s8->closeCursor();
  
  }
  ?>