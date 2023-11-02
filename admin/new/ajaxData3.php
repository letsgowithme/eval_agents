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
  // if(!empty($_POST["speciality"])){

  //   $sql_s2 = "SELECT * FROM agents WHERE specialities=:agentSpec";
  //   $query_s2 = $dbConnect->prepare($sql_s2);
  //   $query_s2->execute(["agentSpec" => $_POST["speciality"]]);
  //   while ($row = $query_s2->fetch(PDO::FETCH_ASSOC)):
  //   //   $specialities = unserialize($row["specialities"]);
  //   //   foreach ($specialities as $user_speciality) :
  //   //   echo $user_speciality.", ";
  //   //  endforeach; 
  //   $sql_s2 = "SELECT * FROM person, agents WHERE person.id=agents.id_user_agent";
  //   $query_s2 = $dbConnect->prepare($sql_s2);
  //   $query_s2->execute();
  //   while ($row = $query_s2->fetch(PDO::FETCH_ASSOC)):
     
  //     $agentId = $row["id"];
  //      $ag_nation = $row["nationality"];
  //      $ag_firstname = $row["firstname"];
  //      $ag_lastname = $row["lastname"];
  //      $specialities = unserialize($row["specialities"]);
  //     foreach ($specialities as $user_speciality) :
  //     echo $user_speciality.", ";
  //    if($_POST["speciality"] == $user_speciality){
  //     echo "<option value=".$user_speciality.">".$user_speciality." ".$row["firstname"]." ".$row["lastname"]." ".$row["nationality"]." ".$user_speciality."</option>";
  //    }
    
  //     endforeach;
  //   endwhile;
  //   endwhile;
  //   }

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
    

  ?>