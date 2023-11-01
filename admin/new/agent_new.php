<?php
//on demarre la session php
require_once "../../includes/DB.php"; 
$sql_s1 = "SELECT * FROM speciality ORDER BY title ASC";
$query_s1 = $dbConnect->query($sql_s1);
$query_s1->execute();

if (!empty($_POST)) {
  if (
    isset($_POST["lastname"], $_POST["firstname"], $_POST["birthdate"], $_POST["nationality"],  $_POST["country"], $_POST["userType"], $_POST["codeName"], $_POST["specialities"], $_POST["code_id"]) && !empty($_POST["lastname"]) && !empty($_POST["firstname"]) && !empty($_POST["birthdate"]) && !empty($_POST["nationality"]) && !empty($_POST["country"]) && !empty($_POST["userType"])&& !empty($_POST["codeName"]) && !empty($_POST["specialities"]) && !empty($_POST["code_id"]) 
  ) {
   
    //le form est complet

    $lastname = strip_tags($_POST["lastname"]);
    $firstname = strip_tags($_POST["firstname"]);
    $birthdate = strip_tags($_POST["birthdate"]);
    $nationality = strip_tags($_POST["nationality"]);
    $country = strip_tags($_POST["country"]);
    $userType = strip_tags($_POST["userType"]);
    $codeName = strip_tags($_POST["codeName"]);
    $specialities = serialize($_POST["specialities"]);
    $code_id = strip_tags($_POST["code_id"]);
   
  
      
    
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

      $sql2 = "INSERT INTO agents (id_user_agent, specialities, code_id) VALUES('$user_id', '$specialities', '$code_id')";
      $query2 = $dbConnect->prepare($sql2);
      $query2->execute();
      $query2->closeCursor();
      var_dump($query2);
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
<!-- <script>
    $(document).ready(function(){
      $("#btn_submit").on("click", function(){
            //  var email = $("#email");
             var codeName = $("#codeName").val();
             if(codeName){
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
    </script> -->
</head>
<div class="body_page_new py-4" id="userNew" style="height: auto;">

  <!-- <div class="container"> -->
  <div class="mt-4" style="margin-left: 30px;">
    <h1 class="mb-4">Ajouter une Personne</h1>

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
    <form class="form" method="post" action="agent_new.php">
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
      <!-- ******************userType****************** -->
  
   <h5 class="form-label fw-bold my-2 fs-4">Type: </h5>
      <br>
        <input type="radio" name="userType" value="agent" class="choices"  style="margin-left: 10px;" id="agent">Agent<span style="font-size: 1.3em; font-weight: bold; padding-left:2px;"></span>     

        <!-- ******************codeName****************** -->
  
  <div class="mb-3">
        <label for="codeName" class="form-label fw-bold my-2 fs-4">Nom de code</label>
        <input type="text" name="codeName" id="codeName" required class="form-control w-25">
      </div>


  <!-- ******************code_id****************** -->
  
  <div class="mb-3">
        <label for="code_id" class="form-label fw-bold my-2 fs-4">Code d'identification</label>
        <input type="text" name="code_id" id="code_id" required class="form-control w-25">
      </div>
   
      <!-- **************Specialities***************** -->
      
      <div class="mb-3" id="agent_speciality">
        <h5 class="form-label fw-bold mb-2 fs-4 me-2 mt-4" id="speciality_title">Spécialité</h5>
        <div class="specialities_list fs-4 form-control w-25" id="specialities_list">
        <?php
        while ($row = $query_s1->fetch(PDO::FETCH_ASSOC)) {
          $specialityId = $row["id"];
          $speciality = $row["title"];
          ?>
          <input type="checkbox" name="specialities[]" value="<?php echo $speciality ?>" class="choices mx-2"><?php echo $speciality ?><br>

        <?php
        }
          ?>

        </div>
      </div>

      <!-- ******************************* -->
      <?php
      include_once "btn_create.php";
      ?>
    </form>
    <div>

    </div>

   

    <?php
    include_once "../includes/admin_footer.php";
    ?>