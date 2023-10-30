<?php
//on demarre la session php
require_once "../../includes/DB.php"; 
$sql1 = "SELECT * FROM speciality ORDER BY title ASC";
$query1 = $dbConnect->query($sql1);
$query1->execute();
$sql1_2 = "SELECT * FROM speciality ORDER BY title ASC";
$query1_2 = $dbConnect->query($sql1_2);
$query1_2->execute();
$sql1_3 = "SELECT * FROM speciality ORDER BY title ASC";
$query1_3 = $dbConnect->query($sql1_3);
$query1_3->execute();
if (!empty($_POST)) {
  if (
    isset($_POST["lastname"], $_POST["firstname"], $_POST["birthdate"], $_POST["email"], $_POST["nationality"], $_POST["codeName"], $_POST["userType"], $_POST["password"]) && !empty($_POST["lastname"]) && !empty($_POST["firstname"]) && !empty($_POST["birthdate"]) && !empty($_POST["email"]) && !empty($_POST["nationality"]) && !empty($_POST["codeName"])  && !empty($_POST["userType"]) && !empty($_POST["password"]) 
  ) {
   
    //le form est complet

    $lastname = strip_tags($_POST["lastname"]);
    $firstname = strip_tags($_POST["firstname"]);
    $birthdate = strip_tags($_POST["birthdate"]);
    $nationality = strip_tags($_POST["nationality"]);
    $codeName = strip_tags($_POST["codeName"]);
    $userType = strip_tags($_POST["userType"]);
    $createdAt = strip_tags($_POST["createdAt"]);
    $country = strip_tags($_POST["country"]);
    $speciality_us_id = strip_tags($_POST["speciality_us_id"]);
    $speciality_us_id2 = strip_tags($_POST["speciality_us_id2"]);
    $speciality_us_id3 = strip_tags($_POST["speciality_us_id3"]);
    
    require_once "../../includes/DB.php";

    $_SESSION["error"] = [];

    if (strlen($lastname) < 3) {
      $_SESSION["error"]["lastname"] = "Le nom est trop court";
    }
    if (strlen($firstname) < 3) {
      $_SESSION["error"]["firstname"] = "Le prénom est trop court";
    }

    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
      $_SESSION["error"][] = "Veuillez renseigner un email valide";
    }
    if ($_SESSION["error"] === []) {

      // hasher mdp
      $password = password_hash($_POST["password"], PASSWORD_ARGON2ID);


      $sql = "INSERT INTO user (lastname, firstname, birthdate, email,  nationality, codeName, userType, roles, password, createdAt, country) VALUES(:lastname, :firstname, :birthdate, :email, :nationality,:codeName, :userType, '[\"ROLE_USER\"]', '$password', :createdAt, :country)";

      $query = $dbConnect->prepare($sql);

      $query->bindValue(":lastname", $lastname, PDO::PARAM_STR);
      $query->bindValue(":firstname", $firstname, PDO::PARAM_STR);
      $query->bindValue(":birthdate", $birthdate, PDO::PARAM_STR);
      $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
      $query->bindValue(":nationality", $nationality, PDO::PARAM_STR);
      $query->bindValue(":codeName", $codeName, PDO::PARAM_STR);
      $query->bindValue(":userType", $userType, PDO::PARAM_STR);
      $query->bindValue(":createdAt", $createdAt, PDO::PARAM_STR);
      $query->bindValue(":country", $country, PDO::PARAM_STR);
      $query->execute();
      $query->closeCursor();


      //on recup id de nouvel utilisateur
      $user_id = $dbConnect->lastInsertId();

 
      $sql2 = "INSERT INTO user_one_speciality (user_oneSp_Id, speciality_us_id) VALUES('$user_id', '$speciality_us_id')";
      $query2 = $dbConnect->prepare($sql2);
      $query2->execute();
      if(isset($_POST["speciality_us_id2"])){
        $sql_in_3 = "INSERT INTO user_one_speciality (user_oneSp_Id, speciality_us_id) VALUES('$user_id', '$speciality_us_id2')";
        $query_in_3 = $dbConnect->prepare($sql_in_3);
        $query_in_3->execute();
      }
      if(isset($_POST["speciality_us_id3"])){
        $sql_in_4 = "INSERT INTO user_one_speciality (user_oneSp_Id, speciality_us_id) VALUES('$user_id', '$speciality_us_id3')";
        $query_in_4 = $dbConnect->prepare($sql_in_4);
        $query_in_4->execute();
      }

      echo "<p style=\"background: blue;\" id=\"message\" class=\"text-center  p-2 fw-4 fs-4 text-light\">Utilisateur ajouté sous le numéro " . $id . "</p>";
      echo "<p style=\"background: blue;\" class=\"text-center p-2 fw-4 fs-5 text-light\"><a href='user_new.php' class=\"text-info fs-4 fw-4\"> Retour à la page de la création</a></p>";
      header("Location: ../lists/usersAll.php");

?>
      <!-- <script>
  function backToPage() {
    let message =document.getElementById('message');
    message.style.display = 'none';
   window.location.href = "../lists/usersAll.php";
  }
setTimeout(backToPage, 8000);
  </script> -->
<?php
    }
  } else {
    $_SESSION["error"] = ["Veuillez remplir tous les champs"];
  }
}
$titre = "Add user";
include_once "../includes/admin_header.php";
include_once "../includes/admin_sidebar.php";

?>
<link href="../../style/style.css" rel="stylesheet" type="text/css">
<link rel="icon" href="../logo.png">

<style>
  input {
    font-size: 1.3em;
    margin-bottom: 10px;
  }

  label {
    width: 220px;

    color: #b2b2b5;
    padding: 5px;
  }
</style>
</head>
<div class="body_page_new py-4" id="userNew" style="height: auto;">

  <!-- <div class="container"> -->
  <div class="mt-4" style="margin-left: 30px;">
    <h1 class="mb-4">Ajouter un Utilisateur</h1>

    <!-- </div>  -->
    <?php
    if (isset($_SESSION["error"])) {
      foreach ($_SESSION["error"] as $message) {
    ?>
        <h5 style="color: red; background: yellow;"><?= $message ?></h5>
    <?php
      }
      unset($_SESSION["error"]);
    }

    ?>
    <form class="form" method="post" action="user_new.php">
      <div class="mb-3">
        <label for="lastname" class="form-label fw-bold my-2 fs-4">Nom</label>
        <input type="text" class="form-control w-25" name="lastname" id="lastname" value="">
      </div>

      <div class="mb-3">
        <label for="firstname" class="form-label fw-bold my-2 fs-4">Prénom</label>
        <input type="text" name="firstname" id="firstname" required class="form-control w-25">
      </div>
      <div class="mb-3">
        <label for="birthdate" class="form-label fw-bold my-2 fs-4">Date de naissance</label>
        <input type="date" name="birthdate" id="birthdate" placeholder="YYYY-MM-DD" required style="height: 2.2em;" class="form-control w-25">
      </div>
      <div class="mb-3">
        <label for="email" class="form-label fw-bold my-2 fs-4">Email</label>
        <input type="email" name="email" id="email" required class="form-control w-25">
      </div>
      <!-- ******************Nationalité****************** -->
      <div class="mb-3">
        <label for="nationality" class="form-label fw-bold my-2 fs-4">Nationalité</label>
        <br>
        <?php include_once "../lists/nationalities_list.php"; ?>
        <select name="nationality" id="nationality" class="fs-4" class="form-control" style="width: 447px;">
          <?php
          foreach ($nationalities as $nationality) {
            echo '<option value="' . $nationality["name"] . '" name="<?= $nationality["name"] ?>' . $nationality["name"] . '</option>';
          }
          ?>
        </select>
      </div>
      <!-- ******************Pays****************** -->
      <div class="mb-3">
        <label for="country" class="form-label fw-bold my-2 fs-4">Pays</label>
        <br>
        <?php include_once "../lists/countries_list.php"; ?>
        <select name="country" id="country" class="fs-4" class="form-control" style="width: 447px;">
          <?php
          foreach ($countries as $country) {
            echo '<option value="' . $country["name"] . '" name="<?= $country["name"] ?>' . $country["name"] . '</option>';
          }
          ?>
        </select>
      </div>
      <!-- ******************Codename****************** -->
      <div class="mb-3">
        <label for="codeName" class="form-label fw-bold my-2 fs-4">Nom de code</label>
        <input type="text" name="codeName" id="codeName" required class="form-control w-25">
      </div>
      <!-- ******************UserType****************** -->
      <label for="userType" class="form-label fw-bold my-2 fs-4">Type: </label>
      <br>
      <?php
      $userTypeArray = array("agent", "cible", "contact");

      foreach ($userTypeArray as $userType) {
      ?>
        <input type="radio" name="userType" value="<?php echo $userType ?>" class="choices" style="margin-left: 10px;" id="<?php echo $userType ?>"><span style="font-size: 1.3em; font-weight: bold; padding-left:2px;"><?php echo $userType ?></span>
      <?php
      }
      ?>

      <!-- **************Speciality 1***************** -->
      
      <div class="mb-3" id="agent_speciality" style="display: none;">
      <hr>
      <label for="speciality" class="form-label fw-bold mt-2 fs-4" style="display: none;" id="speciality_title">Spécialité 1</label><br>
      <select name="speciality_us_id" id="speciality"  class="fs-5 pb--2 pe-2" style="min-width: 330px; display: none;"> 
          <?php 
       while ($row = $query1->fetch(PDO::FETCH_ASSOC)) {
        $specialityId = $row["id"];
        $specialityTitle = $row["title"];
        echo "<option class=\"spec\"  value=".$specialityId." id=".$specialityTitle.">".$specialityTitle."</option>"; 
      }
          ?> 
          </select>
          </div>

      <button type="button" id="add_spec2" style="display: none;">Ajouter une spécialité</button>
         <!-- **************Speciality2***************** -->
        
         <div class="mb-3" id="agent_speciality2" style="display: none;">
         <hr>
      <label for="speciality2" class="form-label fw-bold mt-2 fs-4" style="display: none;" id="speciality_title2">Spécialité 2</label><br>
        
          <select name="speciality_us_id2" id="speciality2"  class="fs-5 pb--2 pe-2" style="min-width: 330px; display: none;">
          
          <?php 
        while ($row2 = $query1_2->fetch(PDO::FETCH_ASSOC)) {

          $specialityId2 = $row2["id"];
          $specialityTitle2 = $row2["title"];
          echo "<option class=\"spec\"  value=".$specialityId2." id=".$specialityTitle2.">".$specialityTitle2."</option>"; 
        }
          ?>
          
          </select>
          </div>
          <hr>
          <button type="button" id="add_spec3" style="display: none;">Ajouter une spécialité</button>
            <!-- **************Speciality3***************** -->
        
         <div class="mb-3" id="agent_speciality3" style="display: none;">
         <hr>
      <label for="speciality3" class="form-label fw-bold mt-2 fs-4" style="display: none;" id="speciality_title3">Spécialité 3</label><br>
        
          <select name="speciality_us_id3" id="speciality3"  class="fs-5 pb--2 pe-2" style="min-width: 330px; display: none;">
          
          <?php 
        while ($row3 = $query1_3->fetch(PDO::FETCH_ASSOC)) {

          $specialityId3 = $row3["id"];
          $specialityTitle3 = $row3["title"];
          echo "<option class=\"spec\"  value=".$specialityId3." id=".$specialityTitle3.">".$specialityTitle3."</option>"; 
        }
          ?>
          
          </select>
          </div>
         
      <!-- **************Password***************** -->
      <div class="mb-3">
        <label for="password" class="form-label fw-bold my-2 fs-5">Mot de passe</label>
        <input type="password" name="password" id="password" class="form-control w-25">
      </div>
      <!-- ******************************* -->
      <div class="mb-3 hidden">
        <label for="createdAt" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Date de réation</label>
        <input type="text" name="createdAt" id="createdAt" value="<?php echo date('Y-m-d'); ?>">
      </div>
      
      <?php
      include_once "btn_create.php";
      ?>
    </form>
    <div>

    </div>

    <script>
      let agent = document.getElementById("agent");
      let speciality = document.getElementById("speciality");
      let speciality_title = document.getElementById("speciality_title");
      let speciality_title2 = document.getElementById("speciality_title2");
      let speciality_title3 = document.getElementById("speciality_title3");
      let agent_speciality = document.getElementById("agent_speciality");
      let agent_speciality2 = document.getElementById("agent_speciality2");
      let agent_speciality3 = document.getElementById("agent_speciality3");
      let add_spec2_btn = document.getElementById("add_spec2");
      let add_spec3_btn = document.getElementById("add_spec3");
      let speciality2 = document.getElementById("speciality2");
      let speciality3 = document.getElementById("speciality3");
      let target = document.getElementById("cible");
      let contact = document.getElementById("contact");

      agent.addEventListener("click", function() {
        agent_speciality.style.display = "block";
        speciality_title.style.display = "block";
        speciality.style.display = "block";
        add_spec2_btn.style.display = "block";
      });

      add_spec2_btn.addEventListener("click", function() {
        agent_speciality2.style.display = "block";
        speciality_title2.style.display = "block";
        speciality2.style.display = "block";
        add_spec3_btn.style.display = "block";
      });
      add_spec3_btn.addEventListener("click", function() {
        agent_speciality3.style.display = "block";
        speciality_title3.style.display = "block";
        speciality3.style.display = "block";
      });

      target.addEventListener("click", function() {
        speciality_title.style.display = "none";
        agent_speciality.style.display = "none";
        list.style.display = "none";
      });
      contact.addEventListener("click", function() {
        speciality_title.style.display = "none";
        agent_speciality.style.display = "none";
        list.style.display = "none";
      });
    </script>

    <?php
    include_once "../includes/admin_footer.php";
    ?>