<?php
require_once "../../includes/DB.php";

$up_id = $_GET["id"];
$sql_s1 = "SELECT * FROM `speciality` ORDER BY `title` ASC";
$query_s1 = $dbConnect->query($sql_s1);
$query_s1->execute();

$sql_s2 = "SELECT * FROM agents WHERE id_user_agent='$up_id'";
$query_s2 = $dbConnect->query($sql_s2);
$query_s2->execute();
$result_s2 = $query_s2->fetchAll();

if (isset($_POST["submit"])) {

  $lastname = strip_tags($_POST["lastname"]);
  $firstname = strip_tags($_POST["firstname"]);
  $birthdate = strip_tags($_POST["birthdate"]);
  $email = strip_tags($_POST["email"]);
  $nationality = strip_tags($_POST["nationality"]);
  $country = strip_tags($_POST["country"]);
  $codeName = strip_tags($_POST["codeName"]);
  $userType = strip_tags($_POST["userType"]);

  $speciality_us_id = strip_tags($_POST["speciality_us_id"]);
  $speciality_us_id2 = strip_tags($_POST["speciality_us_id2"]);
  $speciality_us_id3 = strip_tags($_POST["speciality_us_id3"]);

  $sql = "UPDATE user SET lastname='$lastname', firstname='$firstname', birthdate='$birthdate', email='$email', nationality='$nationality', codeName='$codeName', userType='$userType',  country='$country' WHERE id='$up_id'";

  $query = $dbConnect->prepare($sql);
  $Execute = $query->execute();
  // *************************************
 
    
    $sql_in_2 = "UPDATE user_one_speciality SET speciality_us_id='$speciality_us_id' WHERE user_oneSp_Id='$up_id'";
    $query_in_2 = $dbConnect->prepare($sql_in_2);
    $query->bindValue(':speciality_us_id', $speciality_us_id, PDO::PARAM_INT);
    $query_in_2->execute();
    $query_in_2->closeCursor();
    if(isset($_POST["speciality_us_id2"])){
    $speciality_us_id2 = strip_tags($_POST["speciality_us_id2"]);
    $sql_in_3 = "UPDATE user_one_speciality SET speciality_us_id='$speciality_us_id2' WHERE user_oneSp_Id='$up_id'";
    $query_in_3 = $dbConnect->prepare($sql_in_3);
    $query->bindValue(':speciality_us_id', $speciality_us_id2, PDO::PARAM_INT);
    $query_in_3->execute();
    $query_in_3->closeCursor();
    }
    if(isset($_POST["speciality_us_id3"])){
    $sql_in_4 = "UPDATE user_one_speciality SET speciality_us_id='$speciality_us_id3' WHERE user_oneSp_Id='$up_id'";
    $query_in_4 = $dbConnect->prepare($sql_in_4);
    $query->bindValue(':speciality_us_id', $speciality_us_id3, PDO::PARAM_INT);
    $query_in_4->execute();  
    $query_in_4->closeCursor();  
    }
  

  // ********************************
  if ($Execute) {
    echo "<p style=\"background: darkgrey;\" class=\"text-center fs-4 text-white p-2 ds-5\">Utilisateur modifié sous le numéro " . $up_id . "<a class=\"ms-2 fw-bold text-dark\" href='../lists/usersAll.php'>Retour</a></p>";
    header("Location: ../lists/usersAll.php");
  }
}

$titre = "Modifier l'utilisateur'";
include_once "../includes/admin_header.php";
include_once "../includes/admin_sidebar.php";
?>
<link href="../../style/style.css" rel="stylesheet" type="text/css">
<link rel="icon" href="../logo.png">
</head>
<div class="body_page_new py-4">

  <?php
  global $dbConnect;
  $sql_s3 = "SELECT * FROM `user` WHERE `id` = '$up_id'";
  $query_s3 = $dbConnect->query($sql_s3);

  while ($row = $query_s3->fetch()) {
    $id = $row["id"];
    $lastname = $row["lastname"];
    $firstname = $row["firstname"];
    $birthdate = $row["birthdate"];
    $email = $row["email"];

    $user_nationality = $row["nationality"];
    $user_country = $row["country"];
    $codeName = $row["codeName"];
    $user_userType = $row["userType"];
  }
  ?>

  <h1>Modifier l'utilisateur</h1>
  <form method="post" action="user_update.php?id=<?php echo $up_id; ?>">
    <input type="hidden" name="up_id" value="<?php echo $row["id"] ?>">
    <div class="mb-3">
      <!-- ***************lastname***************** -->
      <div class="mb-3">
        <label for="lastname" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Nom</label>
        <input type="text" class="form-control w-50" name="lastname" id="lastname" value="<?php echo $lastname ?>">
      </div>
      <!-- ***************firstname***************** -->
      <div class="mb-3 d-flex" style="align-items: start;">
        <label for="firstname" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Prénom</label>
        <input type="text" class="form-control w-50" name="firstname" id="firstname" value="<?php echo $firstname ?>">
      </div>
      <!-- ***************birthdate***************** -->
      <div class="mb-3 d-flex">
        <label for="birthdate" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Date de naissance</label>
        <input type="text" disabled name="birthdate" id="birthdate" placeholder="<?php echo $birthdate ?>" value="<?php echo $birthdate ?>">
        <input type="date" class="hidden" name="birthdate" id="birthdate" placeholder="<?php echo $birthdate ?>" value="<?php echo $birthdate ?>">

      </div>
      <!-- ***************email***************** -->
      <div class="mb-3 d-flex" style="align-items: start;">
        <label for="email" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Email</label>
        <input type="email" class="form-control w-50" name="email" id="email" value="<?php echo $email ?>">
      </div>

      <!-- **************nationality************* -->
      <div class="mb-3">
        <label for="nationality" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Nationalité</label>
        <input type="hidden" name="nationality" id="user_nationality" value="<?php echo $user_nationality ?>">
        <?php include_once "../lists/nationalities_list.php"; ?>
        <select name="nationality" id="nationality" class="fs-5">
          <?php
          foreach ($nationalities as $nationality) {
            $nationality_title = $nationality['name'];
            if ($nationality_title == $user_nationality) {
              $selected = "selected";
            } else {
              $selected = "";
            }
            echo "<option value=" . $nationality_title . " " . $selected . ">" . $nationality_title . "</option>";
          }

          ?>
      </div>
      </select>
    </div>
    <!-- **************Pays************* -->
    <div class="mb-3">
      <label for="country" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Pays</label>
      <input type="hidden" name="country" id="user_country" value="<?php echo $user_country ?>">
      <?php include_once "../lists/countries_list.php"; ?>
      <select name="country" id="country" class="fs-5">
        <?php
        foreach ($countries as $country) {
          $country_title = $country['name'];
          if ($country_title == $user_country) {
            $selected = "selected";
          } else {
            $selected = "";
          }
          echo "<option value=" . $country_title . " " . $selected . ">" . $country_title . "</option>";
        }

        ?>
    </div>
    </select>
</div>
<!-- ***************Codename****************** -->
<div class="mb-3">
  <label for="codeName" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Nom de code</label>
  <input type="text" name="codeName" id="codeName" value="<?php echo $codeName ?>">
</div>

<!-- ****************UserType*********************** -->
<label for="userType" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Type: </label>
<input type="text" name="userType" id="userType" value="<?php echo $user_userType ?>">
<button type="button" id="change_userType">Changer</button>
<div id="userTypeList" style="display: none;">
  <!------- afficher les type de l'Utilisateur ------>
  <?php
  $userTypeArray = array("agent", "cible", "contact");

  foreach ($userTypeArray as $userType) {
  ?>
    <input type="radio" name="userType" value="<?php echo $userType ?>" class="choices" style="margin-left: 10px;" id="<?php echo $userType ?>"><span style="font-size: 1.1em; font-weight: bold; padding-left:2px;"><?php echo $userType ?></span>
  <?php
  }
  ?>
</div>
</div>
<hr>
<!-- ************************************** -->
<?php
if ($user_userType == "agent") {
?>
  <!-- ********************Specialities of user*********************** -->
  <!-- Requete:select FROM user_one_speciality WHERE user_oneSp_Id='$up_id -->
  <?php
  $index = 1;
  $user_specARR = [];
  foreach ($result_s2 as $tab) :
    $speciality_user_id = $tab["speciality_us_id"];
    // requete2
    $sql_s2_2 = "SELECT * FROM speciality WHERE id = '$speciality_user_id'";
    $query_s2_2 = $dbConnect->query($sql_s2_2);
    $query_s2_2->execute();
    while ($row = $query_s2_2->fetch(PDO::FETCH_ASSOC)) :
      $speciality_us_Id = $row["id"];
      $user_specialityTitle = $row["title"];
      $speciality_us_Id = "$speciality_us_Id";
      echo "<input  class=\"user_spec\" id=\"speciality_user$index\" value=" . $speciality_us_Id . "><" . $user_specialityTitle . ">";
      $index = $index + 1;
    endwhile;
  endforeach;
  ?>
  <!-- *************************SPECIALTIY 1********************** -->
  <div class="mb-3" id="agent_speciality">

    <label for="speciality" class="form-label fw-bold mt-2 fs-4" id="speciality_title">Spécialité 1</label><br>
    <select name="speciality_us_id" id="speciality" class="fs-5 pb--2 pe-2" style="min-width: 330px;">
      <?php
      while ($row = $query_s1->fetch(PDO::FETCH_ASSOC)) :
        $speciality_us_id = $row["id"];
        $specialityTitle = $row["title"];

        // if ($specialityId == $speciality_us_Id) {
        //   $selected = "selected";
        // } else {
        //   $selected = "";
        // }
        echo "<option class=\"spec\"  name=" . $speciality_us_id ." value=" . $speciality_us_id . " id=" . $specialityTitle . ">" . $specialityTitle . "</option>";
      endwhile;
      ?><br>
    </select>
  </div>
  <!-- **************Speciality2***************** -->
  <div class="mb-3" id="agent_speciality2">
    <hr>
    <label for="speciality2" class="form-label fw-bold mt-2 fs-4" id="speciality_title2">Spécialité 2</label><br>
    <select name="speciality_us_id2" id="speciality2" class="fs-5 pb-2 pe-2" style="min-width: 330px;">
      <?php
      while ($row2 = $query_s1_2->fetch(PDO::FETCH_ASSOC)) {
        $specialityId2 = $row2["id"];
        $specialityTitle2 = $row2["title"];
       
        echo "<option class=\"spec\" name=" . $specialityId2 ." value=" . $specialityId2 . " id=" . $specialityTitle2 . ">" . $specialityTitle2 . "</option>";
      }
      ?>
    </select>
  </div>
  <!-- **************Speciality3***************** -->
  <div class="mb-3" id="agent_speciality3">
    <hr>
    <label for="speciality3" class="form-label fw-bold mt-2 fs-4" id="speciality_title3">Spécialité 3</label><br>
    <select name="speciality_us_id3" id="speciality3" class="fs-5 pb--2 pe-2" style="min-width: 330px; ">
      <?php
      while ($row3 = $query_s1_3->fetch(PDO::FETCH_ASSOC)) {
        $specialityId3 = $row3["id"];
        $specialityTitle3 = $row3["title"];
        
       
        echo "<option class=\"spec\" name=" . $specialityId3 ." value=" . $specialityId3 . " id=" . $specialityTitle3 . ">" . $specialityTitle3 . "</option>";
      }
      ?>
    </select>
  </div>
  <button type="submit" class="my-4 fs-5 fw-bold mx-4" id="btn_submit" name="submit">Enregistrer</button>
<?php
}
?>
</form>
</div>
<script>
    $(document).ready(function() {
      $user_spec1 = $("#speciality_user1");
      $user_spec2 = $("#speciality_user2");
      $user_spec3 = $("#speciality_user3");
      $("#speciality").val($user_spec1.val());
      $("#speciality2").val($user_spec2.val());
      $("#speciality3").val($user_spec3.val());
    });
  </script>
<script>
  function toggleList() {
    var change_country_btn = document.getElementById("change_country_btn");
    var countries_list = document.getElementById("countries_list");
    if (countries_list.style.display === "none") {
      countries_list.style.display = "block";
    } else if (countries_list.style.display === "block") {
      countries_list.style.display = "none";
    }
  }

  function change_nationality() {
    var change_nationality = document.getElementById("change_nationality");
    var nationalities_list = document.getElementById("nationalities_list");
    if (nationalities_list.style.display === "none") {
      nationalities_list.style.display = "block";
    } else if (nationalities_list.style.display === "block") {
      nationalities_list.style.display = "none";
    }
  }

  function change_speciality() {
    var change_speciality_btn = document.getElementById("change_speciality_btn");
    var specialities_list = document.getElementById("specialities_list");
    if (specialities_list.style.display === "none") {
      specialities_list.style.display = "block";
    } else if (specialities_list.style.display === "block") {
      specialities_list.style.display = "none";
    }
  }
</script>
<script>
  let change_userType = document.getElementById("change_userType");
  let userTypeList = document.getElementById("userTypeList");
  let user_userType = document.getElementById("user_userType");
  change_userType.addEventListener("click", function() {
    userTypeList.style.display = "block";
    specialities_list.style.display = "none";
    change_speciality.style.display = "none";
    agent_speciality.style.display = "none";

  });

  let userType = document.getElementById("userType");

  function toggleList() {
    var specialities_list = document.getElementById("specialities_list");
    if (specialities_list.style.display = "none") {
      specialities_list.style.display = "block";
    } else {
      specialities_list.style.display = "none";
    }
  }
  let agent = document.getElementById("agent");
  let list = document.getElementById("specialities_list");
  let speciality_title = document.getElementById("speciality_title");
  let agent_speciality = document.getElementById("agent_speciality");
  let target = document.getElementById("cible");
  let contact = document.getElementById("contact");
  let warning_messages = document.getElementById("warning_messages");
  if (userType.value == "cible" || userType.value == "contact") {
    specialities_list.style.display = "none";
    change_speciality.style.display = "none";
    speciality_title.style.display = "none";
    warning_messages.style.display = "none";
  }
  agent.addEventListener("click", function() {
    agent_speciality.style.display = "block";
    speciality_title.style.display = "block";
    list.style.display = "block";
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