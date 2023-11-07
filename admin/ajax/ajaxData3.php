<?php
include_once("../../includes/DB.php");
if(!empty($_POST["countryList"])){
  $sql_s1 = "SELECT * FROM person WHERE country=:countryContact AND userTYPE='contact'";
  $query_s1 = $dbConnect->prepare($sql_s1);
  $query_s1->execute(["countryContact" => $_POST["countryList"]]);
  
  while ($row = $query_s1->fetch(PDO::FETCH_ASSOC)):
  echo "<option value=".$row["country"].">".$row["country"]." ".$row["firstname"]." ".$row["lastname"]."</option>";
  endwhile;
  $query_s1->closeCursor();
  }
  // *********************************************
  

    if(!empty($_POST["title"])){
      // ******
      $sql_s_s5 = "SELECT * FROM mission WHERE title=:title";
      $query_s_s5 = $dbConnect->prepare($sql_s_s5);
      $query_s_s5->execute(["title" => $_POST["title"]]);
      
      while ($row = $query_s_s5->fetch(PDO::FETCH_ASSOC)):
        if($row >= 1){
          ?>
          <script>
          alert('Le titre existe déjà');
          </script>
          <?php
      }else{
        $title = strip_tags($_POST["title"]);
      }
      endwhile;
      $query_s_s5->closeCursor();
      }
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
//  $query_s2->closeCursor();
// $query_s8->closeCursor();
    
    }
    // ***********************************
    if(!empty($_POST["change_target"])){
 
        $sql_s3 = "SELECT * FROM person WHERE userType ='cible'"; 
        $query_s3 = $dbConnect->query($sql_s3);
        $query_s3->execute();
        while ($row3 = $query_s3->fetch(PDO::FETCH_ASSOC)) :
          $targetId = $row3["id"];
          $target_nation = $row3["nationality"];
          $target_firstname = $row3["firstname"];
          $target_lastname = $row3["lastname"];
          
          echo "<option value=".$targetId.">".$target_firstname." - ".$target_lastname." ".$target_nation."</option>";
    endwhile;
 
  //  $query_s2->closeCursor();
  // $query_s8->closeCursor();
      
      }

  ?>