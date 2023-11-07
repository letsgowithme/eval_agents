<?php
$titre = "Modifier l'utilisateur'";
include_once "../includes/admin_header.php";
include_once "../includes/admin_sidebar.php";
require_once "../../includes/DB.php";
set_time_limit(1);
$up_id = $_GET["id"];
$sql_s2 = "SELECT * FROM speciality ORDER BY title ASC";
$query_s2 = $dbConnect->query($sql_s2);
$query_s2->execute();
$sql_s3 = "SELECT specialities FROM agents WHERE id_user_agent='$up_id'";
$query_s3 = $dbConnect->query($sql_s3);
$query_s3->execute();
$sql_s4 = "SELECT code_id FROM agents WHERE id_user_agent='$up_id'";
$query_s4 = $dbConnect->query($sql_s4);
$query_s4->execute();
if (isset($_POST["submit"])) {
  if (isset($_POST["userType"]) && !empty($_POST["userType"])) {
    $userType = strip_tags($_POST["userType"]);
  } else {
    $userType = strip_tags($_POST["user_userType"]);
  }
  if (isset($_POST["code_id"]) && !empty($_POST["code_id"])) {
    $code_id = strip_tags($_POST["code_id"]);
  }
  $lastname = strip_tags($_POST["lastname"]);
  $firstname = strip_tags($_POST["firstname"]);
  $birthdate = strip_tags($_POST["birthdate"]);
  $nationality = strip_tags($_POST["nationality"]);
  $country = strip_tags($_POST["country"]);
  $codeName = strip_tags($_POST["codeName"]);
  if (isset($_POST["specialities"]) && !empty($_POST["specialities"])) {
    $specialities = serialize($_POST["specialities"]);
    $sql_in_2 = "UPDATE agents SET specialities='$specialities', code_id='$code_id' WHERE id_user_agent='$up_id'";
    $query_in_2 = $dbConnect->prepare($sql_in_2);
    $query_in_2->execute();
    $query_in_2->closeCursor();
  }
  $sql = "UPDATE person SET lastname='$lastname', firstname='$firstname', birthdate='$birthdate', nationality='$nationality',  country='$country',  userType='$userType', codeName='$codeName' WHERE id='$up_id'";
  $query = $dbConnect->prepare($sql);
  $Execute = $query->execute();
  if ($Execute) {
    echo "<p style=\"background: darkgrey;\" class=\"text-center fs-4 text-white p-2 ds-5\">Utilisateur modifié sous le numéro " . $up_id . "<a class=\"ms-2 fw-bold text-dark\" href='../lists/usersAll.php'>Retour</a></p>";
    "<a class=\"fs-4 ms-3 text-bold text-dark\" href='../lists/usersAll.php'>Retour</a></p>";
  }
}
?>
<link href="../../style/style.css" rel="stylesheet" type="text/css">
<link rel="icon" href="../logo.png">
</head>
<div class="body_page_new py-4">
  <?php
  global $dbConnect;
  $sql_s1 = "SELECT * FROM person WHERE id='$up_id'";
  $query_s1 = $dbConnect->query($sql_s1);
  $query_s1->execute();
  while ($row = $query_s1->fetch()) {
    $id = $row["id"];
    $lastname = $row["lastname"];
    $firstname = $row["firstname"];
    $birthdate = $row["birthdate"];
    $user_nationality = $row["nationality"];
    $user_country = $row["country"];
    $codeName = $row["codeName"];
    $user_userType = $row["userType"];
  }
  while ($row2 = $query_s3->fetch(PDO::FETCH_ASSOC)) :
    $user_specialities = unserialize($row2["specialities"]);
  endwhile;
  ?>
  <h1>Modifier l'utilisateur</h1>
  <form method="post" action="user_update.php?id=<?php echo $up_id; ?>">
    <input type="hidden" name="up_id" value="<?php echo $id ?>">
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
<h5 for="userType" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Type: </h5>
<input type="text" name="user_userType" id="user_userType" value="<?php echo $user_userType ?>">
<button type="button" id="change_userType_btn" class="my-4">Changer</button>
<!-- ******************userType****************** -->
<div id="userTypeList" class="hidden">
  <input type="radio" name="userType" value="agent" class="choices form-label fw-bold mb-2 fs-5" style="margin-left: 10px;" id="agent"><span style="font-size: 1.3em; font-weight: bold; padding-left:2px;">Agent</span>
  <input type="radio" name="userType" value="contact" class="choices form-label fw-bold mb-2 fs-5" style="margin-left: 10px;" id="contact"><span style="font-size: 1.3em; font-weight: bold; padding-left:2px;">Contact</span>
  <input type="radio" name="userType" value="cible" class="choices form-label fw-bold my-2 fs-5" style="margin-left: 10px;" id="target"><span style="font-size: 1.3em; font-weight: bold; padding-left:2px;">Cible</span>
  <hr>
</div>
</div>
<?php
if ($user_userType == 'agent') :
?>
  <!-- ********************Specialities*********************** -->
  <div id="agent_speciality">
    <h5 class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Spécialité: </h5>
    <?php
    $user_specialityArr = [];
    foreach ($user_specialities as $user_spec) :
      $user_speciality = $user_spec;
      echo "<input type=\"\" value=" . $user_speciality . " name=\"user_specialities[]\"><br/>";
      $user_specialityArr[] = $user_speciality;
    endforeach;
    ?>
    <div class="specialities_list fs-4 form-control w-25">
      <?php
      while ($row1 = $query_s2->fetch(PDO::FETCH_ASSOC)) :
        $checked = "";
        $specialityId = $row1["id"];
        $speciality = $row1["title"];
        if (in_array($speciality, $user_specialityArr)) {
          $checked  = "checked";
        } else {
          $checked = "";
        }
      ?>
        <input type="checkbox" <?php echo $checked ?> name="specialities[]" value="<?php echo $speciality ?>" class="choices mx-2"><?php echo $speciality ?><br>
      <?php
      endwhile;
      ?>
    </div>
    <!-- ***************Code d'identification****************** -->
    <div class="mb-3">
      <?php
      while ($row4 = $query_s4->fetch()) :
        $code_id = $row4["code_id"];
      ?>
        <label for="code_id" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Nom de code</label>
        <input type="text" name="code_id" id="code_id" value="<?php echo $code_id ?>">
      <?php
      endwhile;
      ?>
    </div>
  </div>
<?php endif; ?>
<!-- </div> -->
<button type="submit" class="my-4 fs-5 fw-bold mx-4" id="btn_submit" name="submit">Enregistrer</button>
</form>
</div>
<script>
  $(document).ready(function() {

    if ($("#userType1").val() == "agent") {
      $("#agent_speciality").addClass("visible");
    } else {
      $("#agent_speciality").removeClass("visible");
    }
  });
</script>
<script>
  $(document).ready(function() {
    $("#change_userType_btn").on("click", function() {
      $("#userTypeList").addClass("visible");
    });
    $("#agent").on("click", function() {
      $("#agent_speciality").addClass("visible");
    });

    $("#contact").on("click", function() {
      $("#agent_speciality").addClass("hidden");
    });
    $("#target").on("click", function() {
      $("#agent_speciality").addClass("hidden");
    });
  });
</script>
<?php
include_once "../includes/admin_footer.php";
?>