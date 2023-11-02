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
        
        
        echo "<option value=".$row["nationality"].">".$user_speciality." - ".$row["firstname"]." ".$row["lastname"]." - ".$row["nationality"]."</option>";
      

     
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
    if(!empty($_POST["speciality"])){
      $us_specArr = [];
      $spec = $_POST["speciality"];
      $specId = intval($spec);
    //  ************************
    $sql3= "SELECT title FROM speciality WHERE id='$specId'";
$query3 = $dbConnect->prepare($sql3);
$query3->execute();
$specTitleAll = $query3->fetch();
$specTitle = $specTitleAll[0];
// *************************
    $sql_s2 = "SELECT * FROM person WHERE id!=:agentId AND userTYPE='agent'";
    $query_s2 = $dbConnect->prepare($sql_s2);
    $query_s2->execute(["agentId" => $_POST["speciality"]]);
    
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
        $us_speciality =$user_speciality;
        $us_specArr[]= $user_speciality;
      
        if($specTitle == $us_speciality){
        echo "<option value=".$agentId.">".$user_speciality." - ".$row["firstname"]." ".$row["lastname"]." - ".$row["nationality"]."</option>";
      
      }      
    endforeach;
         
          // echo '<pre>';
          // var_dump($specTitle);
          // echo '</pre>';
        
    endwhile;
  
endwhile;

    $query_s2->closeCursor();
$query_s8->closeCursor();
    
    }

  ?>