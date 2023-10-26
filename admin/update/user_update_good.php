<?php
  require_once "../../includes/DB.php";

$up_id = $_GET["id"];


$sql_s1 = "SELECT * FROM `speciality` ORDER BY `title` ASC";
$query_s1 = $dbConnect->query($sql_s1);
$query_s1->execute();




if(isset($_POST["submit"])){

  if(isset($_POST["user_specialities"])){
    $specialities = serialize($_POST["user_specialities"]);
    $sql_u1 = "UPDATE user_speciality SET user_specialities='$specialities' WHERE userId='$up_id'";
    $query_u1 = $dbConnect->prepare($sql_u1); 
    $query_u1->execute();
  
    }elseif(isset($_GET["user_specialities"])){
      $specialities = $user_specialities;
      // $specialities = serialize($_POST["user_specialities"]);
    $sql_u1 = "UPDATE user_speciality SET user_specialities='$specialities' WHERE userId='$up_id'";
    $query_u1 = $dbConnect->prepare($sql_u1); 
    $query_u1->execute();
    }else{
      $specialities = "";
    }

  $lastname = $_POST["lastname"];
  $firstname = $_POST["firstname"];
  $birthdate = $_POST["birthdate"];
  $email = $_POST["email"];
  $nationality = $_POST["nationality"];
  $codeName = $_POST["codeName"];
  $userType = $_POST["userType"];
 


    $sql = "UPDATE user SET lastname='$lastname', firstname='$firstname', birthdate='$birthdate', email='$email', nationality='$nationality', codeName='$codeName', userType='$userType' WHERE id='$up_id'";

    $query = $dbConnect->prepare($sql); 
    $Execute = $query->execute();
    if($Execute){
      echo "<p style=\"background: darkgrey;\" class=\"text-center fs-4 text-white p-2 ds-5\">Utilisateur modifié sous le numéro ". $up_id."<a class=\"ms-2 fw-bold text-dark\" href='../lists/usersAll.php'>Retour</a></p>";
     
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

$sql_s2 = "SELECT * FROM user_speciality WHERE userId='$up_id'";
$query_s2 = $dbConnect->query($sql_s2);
// require_once "../../includes/DB.php";
$sql_s3 = "SELECT * FROM `user` WHERE `id` = '$up_id'";
$query_s3 = $dbConnect->query($sql_s3);

while($row = $query_s3->fetch()){
  $id = $row["id"];
  $lastname = $row["lastname"];
  $firstname = $row["firstname"];
  $birthdate = $row["birthdate"];
  $email = $row["email"];
  $up_nationality = $row["nationality"];
  $codeName = $row["codeName"];
  $userType = $row["userType"];

}


  ?>
<div>
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
   <div class="mb-3 d-flex" style="align-items: start;" >
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
       <div class="mb-3 d-flex" style="align-items: start;" >
    <label for="email" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Email</label>
    <input type="email" class="form-control w-50" name="email" id="email" value="<?php echo $email ?>">
   </div>
   <!-- ***************nationality**************** -->
   <div class="mb-3">
    <label for="nationality" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Nationalité</label>
    <input type="text" name="nationality" id="nationality" value="<?php echo $up_nationality ?>">
    <button type="button" id="change_nationality_btn" onclick="change_nationality()">Changer</button>
   </div>
   <div id="nationalities_list" style="display: none;">
       <?php include_once "../lists/nationalities_list.php"; ?>
    <select name="nationalities_list" id="nationalities_list" class="fs-5">
      <?php
    foreach ($nationalities as $nationality) {
      echo '<option value="'.$nationality["name"].'" name="<?= $country["name"] ?>'.$nationality["name"].'</option>';
  }
    ?>
    </select>
   </div>
   <!-- ***************Codename****************** -->
   <div class="mb-3">
    <label for="codeName" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Nom de code</label>
    <input type="text" name="codeName" id="codeName" value="<?php echo $codeName ?>">
   </div>
   
<!-- ****************UserType*********************** -->
<label for="userType" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Type: </label>
<input type="text" name="userType" id="userType" value="<?php echo $userType ?>">
<button type="button" id="change_userType">Changer</button>
<div id="userTypeList" style="display: none;">
<!------- afficher les type de l'Utilisateur ------>
<?php 
$userTypeArray = array("agent", "cible", "contact");

foreach ($userTypeArray as $userType) {
  ?>
    <input type="radio" name="userType" value="<?php echo $userType ?>" 
    class="choices" style="margin-left: 10px;" id="<?php echo $userType ?>"><span 
    style="font-size: 1.1em; font-weight: bold; padding-left:2px;"><?php echo $userType ?></span>
  <?php
}
?>
 </div>
 <!-- ********************Specialities of user*********************** -->
 <div class="mb-3 mt-3 d-flex" id="agent_speciality">
   <h5 class="form-label fw-bold mb-2 fs-5 me-2" style="color: #01013d;" id="speciality_title">Spécialité</h5>
    <!-- afficher les specialités de l'Utilisateur -->
   <div class="d-flex flex-column bg-light text-dark"> 
   
    <?php
  while ($row = $query_s2->fetch(PDO::FETCH_ASSOC)) :
            $specialities = unserialize($row["user_specialities"]);
           
            foreach($specialities as $speciality) :
              echo $speciality ? $speciality."<br/>" : "";
              endforeach;
  endwhile;
  ?>
</div>
<div class="d-flex flex-row">
  <div><button onclick="change_speciality()" class="mx-2" id="change_speciality_btn" type="button">Changer</button>
</div>
<!-- afficher la liste de specialités -->
</div> 

<div class="specialities_list mb-4" id="specialities_list" style="display: block;">
<?php
        while ($row = $query_s1->fetch(PDO::FETCH_ASSOC)) {
           $specialityId = $row["id"];
          $specialityTitle = $row["title"];
          // $user_specialities = $row["user_specialities"];
          ?>
          <input type="checkbox" name="user_specialities[]" value="<?php echo $specialityTitle ?>" class="choices mx-2"><?php echo $specialityTitle ?><br>

        <?php
        }
          ?>
 </div>

</div>
<div id="warning_messages">
<div><span style="color: red; font-weight: bold; font-size: 1.2em;">Attention, les anciennes spécialités seront remplacées par de nouvelles!</span></div>
<div><span style="color: gdarkgray; font-weight: bold; font-size: 1em;">Si vous souhaitez conserver les anciennes spécialités, merci de cocher à nouveau les cases!</span></div>
</div>


   <button type="submit" class="btn-info my-4 fs-5 fw-bold" name="submit">Enregistrer</button>
</form>

</div>
<script>
  function toggleList() {
  var change_country_btn = document.getElementById("change_country_btn"); 
  var countries_list = document.getElementById("countries_list");
  if (countries_list.style.display === "none") {
    countries_list.style.display = "block";
  } else if(countries_list.style.display === "block") {
    countries_list.style.display = "none";
  }
}
function change_nationality() {
  var change_nationality = document.getElementById("change_nationality"); 
  var nationalities_list = document.getElementById("nationalities_list");
  if (nationalities_list.style.display === "none") {
    nationalities_list.style.display = "block";
  } else if(nationalities_list.style.display === "block") {
    nationalities_list.style.display = "none";
  }
}
function change_speciality() {
  var change_speciality_btn = document.getElementById("change_speciality_btn"); 
  var specialities_list = document.getElementById("specialities_list");
  if (specialities_list.style.display === "none") {
    specialities_list.style.display = "block";
  } else if(specialities_list.style.display === "block") {
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
    function toggleList(){
      var specialities_list = document.getElementById("specialities_list");
        if(specialities_list.style.display = "none"){
          specialities_list.style.display = "block";
        }else{
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
    if(userType.value == "cible" || userType.value == "contact"){
      specialities_list.style.display = "none";
      change_speciality.style.display = "none";
      speciality_title.style.display = "none";
      warning_messages.style.display = "none";
    }
    agent.addEventListener("click", function () {
      agent_speciality.style.display = "block";
      speciality_title.style.display = "block";
      list.style.display = "block";
    });

    target.addEventListener("click", function () {
      speciality_title.style.display = "none";
      agent_speciality.style.display = "none";
      list.style.display = "none";
    });
    contact.addEventListener("click", function () {
      speciality_title.style.display = "none";
      agent_speciality.style.display = "none";
      list.style.display = "none";
    });
  </script>
<?php
include_once "../includes/admin_footer.php";
?>
