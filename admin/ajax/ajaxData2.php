<?php
include_once("../../includes/DB.php");
if(!empty($_POST["countryList"])){
  $selected = "";
  $sql_s1 = "SELECT * FROM person WHERE country=:countryContact AND userTYPE='contact'";
  $query_s1 = $dbConnect->prepare($sql_s1);
  $query_s1->execute(["countryContact" => $_POST["countryList"]]);
  
  while ($row = $query_s1->fetch(PDO::FETCH_ASSOC)):
  echo "<option value=".$row["id"]." ".$selected.">".$row["firstname"]." ".$row["lastname"]." (".$row["country"].")</option>";
  endwhile;
  $query_s1->closeCursor();
  }
  // *********************************************
  if(!empty($_POST["targets"])){
    $targetId = intval($_POST["targets"]);
   

    $sql_s8_1 = "SELECT nationality FROM person WHERE id = '$targetId'"; 
    $query_s8_1 = $dbConnect->query($sql_s8_1);
    $query_s8_1->execute();
    $nationsAll = $query_s8_1->fetch();
    $target_nation = $nationsAll[0];
    
      
    $selected = "";
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

        if($target_nation != $ag_nation):
        foreach ($specialities as $user_speciality) :
        echo $user_speciality.", ";
        
        echo "<option value=".$agentId.">".$user_speciality." - ".$row["firstname"]." ".$row["lastname"]." - ".$row["nationality"]."</option>";
       endforeach;
      endif;
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
  // *********************Post SPeciality*************************
  if(!empty($_POST["speciality"])){
    $userSpec = [];
    $specialityId = intval($_POST["speciality"]);
   
    $sql5 = "SELECT title FROM speciality WHERE id = '$specialityId'"; 
    $query5 = $dbConnect->query($sql5);
    $query5->execute();
    $specinfo = $query5->fetch();
    $specialityTitle = $specinfo[0];
    $selected = "";

    $sql6 = "SELECT * FROM person WHERE userType = 'agent'"; 
    $query6 = $dbConnect->query($sql6);
    $query6->execute();
    while ($row6 = $query6->fetch(PDO::FETCH_ASSOC)):
      $agentId = $row6["id"];
       $ag_nation = $row6["nationality"];
       $ag_firstname = $row6["firstname"];
       $ag_lastname = $row6["lastname"];

    $sql7 = "SELECT * FROM agents WHERE  id_user_agent = '$agentId'";
    $query7 = $dbConnect->prepare($sql7);
    $query7->execute();
      while ($row7 = $query7->fetch(PDO::FETCH_ASSOC)) :
        $specialities = unserialize($row7["specialities"]);
        foreach ($specialities as $user_spec) :
        $user_speciality = $user_spec;
       
        if($user_speciality == $specialityTitle){
          echo "<option value=".$agentId.">".$user_speciality." - ".$ag_firstname." ".$ag_lastname." - ".$ag_nation."</option>";
        }
      // echo '<pre>';
      // var_dump($user_speciality);
      // echo '</pre>';
    endforeach;
  endwhile;
endwhile;
 $query6->closeCursor();
$query7->closeCursor();
    
    }
    // if(!empty($_POST["btn_submit"])){
    
    //   if (!empty($_POST["submit"])) {

    //     $title = $_POST["title"];
    //     $description = $_POST["description"];
    //     $startDate = $_POST["startDate"];
    //     $endDate = $_POST["endDate"];
    //     $country = $_POST["country"];
    //     $missionStatus = $_POST["missionStatus"];
    //     $codeName = $_POST["codeName"];
    //     $mmt_missionTypeId = strip_tags($_POST["mmt_missionTypeId"]);
    //     $mis_spec_id = strip_tags($_POST["mis_spec_id"]);
    //     $agents = serialize($_POST["agents"]);
    //     $contacts = serialize($_POST["contacts"]);
    //     $targets = serialize($_POST["targets"]);
    //     $mis_hideouts = serialize($_POST["mis_hideouts"]);
      
    //     $sql4 = "UPDATE mission SET title='$title', description='$description', startDate='$startDate', endDate='$endDate', country='$country', missionStatus='$missionStatus', codeName='$codeName' WHERE id='$idMission'";
    //     $query4 = $dbConnect->query($sql4);
    //     $Execute4 = $query4->execute();
    //     // *******************************************
       
      
     
      
    //     echo "<pre>";
    //     echo var_dump($Execute4);
    //     echo "</pre>";
        
      
    //   }
    //   }