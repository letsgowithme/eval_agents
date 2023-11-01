<?php
//on demarre la session php
require_once "../../includes/DB.php"; 
if (!empty($_POST)) {
  if (
    isset($_POST["lastname"], $_POST["firstname"], $_POST["birthdate"], $_POST["nationality"],  $_POST["country"], $_POST["userType"], $_POST["codeName"]) && !empty($_POST["lastname"]) && !empty($_POST["firstname"]) && !empty($_POST["birthdate"]) && !empty($_POST["nationality"]) && !empty($_POST["country"]) && !empty($_POST["userType"])&& !empty($_POST["codeName"])
  ) {
   
    //le form est complet

    $lastname = strip_tags($_POST["lastname"]);
    $firstname = strip_tags($_POST["firstname"]);
    $birthdate = strip_tags($_POST["birthdate"]);
    $nationality = strip_tags($_POST["nationality"]);
    $country = strip_tags($_POST["country"]);
    $userType = strip_tags($_POST["userType"]);
    $codeName = strip_tags($_POST["codeName"]);
    require_once "../../includes/DB.php";

    $_SESSION["error"] = [];

        if (strlen($lastname) < 3) {
          $_SESSION["error"]["lastname"] = "Le nom est trop court";
        }
        if (strlen($firstname) < 3) {
          $_SESSION["error"]["firstname"] = "Le prénom est trop court";
        }
        if ($_SESSION["error"] === []) {



      $sql = "INSERT INTO person (lastname, firstname, birthdate,  nationality, country, userType, codeName) VALUES(:lastname, :firstname, :birthdate, :nationality, :country, :userType, :codeName)";

      $query = $dbConnect->prepare($sql);

      $query->bindValue(":lastname", $lastname, PDO::PARAM_STR);
      $query->bindValue(":firstname", $firstname, PDO::PARAM_STR);
      $query->bindValue(":birthdate", $birthdate, PDO::PARAM_STR);
      $query->bindValue(":nationality", $nationality, PDO::PARAM_STR);
      $query->bindValue(":country", $country, PDO::PARAM_STR);
      $query->bindValue(":userType", $userType, PDO::PARAM_STR);
      $query->bindValue(":codeName", $codeName, PDO::PARAM_STR);
      $query->execute();
      $query->closeCursor();

      //on recup id de nouvel utilisateur
      $user_id = $dbConnect->lastInsertId();

      echo "<script>
      alert('Personne ajoutée')</script>";
      header("Location: ../lists/usersAll.php");
    
  } else {
    $_SESSION["error"] = ["Veuillez remplir tous les champs"];
  }
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
<script>
    $(document).ready(function(){
      btn_submit = $("#btn_submit");
      $("#btn_submit").on("click", function(){
            //  var email = $("#email");
             var codeName = $("#codeName").val();
             if(btn_submit){
                  $.ajax({
                    type: "POST",
                    url: "ajaxData.php",
                    data: 'codeName='+codeName,
                    success:function(response){
                  //  alert(response);
                  $("#codeName").html(response);
                  }
                  })
            
              
             }
      });     
    });    
    </script>
</head>
<div class="body_page_new py-4" id="userNew" style="height: auto;">

  <!-- <div class="container"> -->
  <div class="mt-4" style="margin-left: 30px;">
    <h1 class="mb-4">Ajouter un Contact ou une Cible</h1>

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
    <form class="form" method="post">
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
      <hr>
    <!-- ******************userType****************** -->
    <h5 class="form-label fw-bold mt-4 fs-5">Type: </h5>
      <br>
        <input type="radio" name="userType" value="contact" class="choices form-label fw-bold mb-2 fs-5"  style="margin-left: 10px;" id="contact"><span style="font-size: 1.3em; font-weight: bold; padding-left:2px;">Contact</span>      
        <br>
        <input type="radio" name="userType" value="target" class="choices form-label fw-bold my-2 fs-5"  style="margin-left: 10px;" id="target"><span style="font-size: 1.3em; font-weight: bold; padding-left:2px;">Cible</span> 
        <hr>
        <!-- ******************Codename****************** -->
       <div id="contact_secion">
        <div class="mb-3">
        <label for="codeName" class="form-label fw-bold my-2 fs-5">Nom de code</label>
        <input type="text" name="codeName" id="codeName" required class="form-control w-25">
      </div>
      </div>
      <?php
      include_once "btn_create.php";
      ?>
    </form>
    <div>
    </div>
    <?php
    include_once "../includes/admin_footer.php";
    ?>