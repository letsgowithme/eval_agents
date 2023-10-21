<?php
  require_once "../../includes/DB.php";

$up_id = $_GET["id"];
$up_nationality = $_GET["nationality"];
if(isset($_POST["submit"])){

  //   if($_GET["specialities"]){
  //   $specialitiesArr = [];
  //   for($i =0; $i < count($_GET['specialities']);$i++){
  //     $speciality = $_POST['specialities'][$i];
  //     $specialitiesArr[] = $speciality;
  //   }   
  //   $specialities = implode(",", $specialitiesArr);
   
  // }else{
  //   $specialitiesArr = [];
  //   $specialities = implode(",", $specialitiesArr);
  // }

  $lastname = $_POST["lastname"];
  $firstname = $_POST["firstname"];
  $birthdate = $_POST["birthdate"];
  $email = $_POST["email"];
  $nationality = $_POST["nationality"];
  $codeName = $_POST["codeName"];
  $userType = $_POST["userType"];
  $specialities = $_POST["specialities"];

    $sql = "UPDATE `user` SET lastname='$lastname', firstname='$firstname', birthdate='$birthdate', email='$email', nationality='$nationality', codeName='$codeName', userType='$userType', specialities='$specialities' WHERE id='$up_id'";

    $query = $dbConnect->query($sql); 
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
// require_once "../../includes/DB.php";
$sql = "SELECT * FROM `user` WHERE `id` = '$up_id'";
$query = $dbConnect->query($sql);

while($row = $query->fetch()){
  $id = $row["id"];
  $lastname = $row["lastname"];
  $firstname = $row["firstname"];
  $birthdate = $row["birthdate"];
  $email = $row["email"];
  $nationality = $row["nationality"];
  $codeName = $row["codeName"];
  $userType = $row["userType"];
  $specialities = $row["specialities"];
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
    <input type="text" name="nationality" id="nationality" value="<?php echo $nationality ?>"><button type="button" id="change_nationality_btn" onclick="change_nationality()">Changer</button>
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
 <!-- ********************Specialities*********************** -->
 <div class="mb-3 mt-3 d-flex" id="agent_speciality">
   <h5 class="form-label fw-bold mb-2 fs-5 me-2" style="color: #01013d;" id="speciality_title">Spécialité</h5>
   <div class="d-flex flex-column bg-light"> 
    <!-- afficher les specialités de l'Utilisateur -->
   <?php
  $specialities = explode(",", $specialities); 
  for($i = 0; $i < count($specialities); $i++){
    echo '<option name="user_specialities[]" value="' . $specialities[$i] . '" class="user_specialities">' . $specialities[$i] . '</option>';
  }

?>
</div>
<div class="d-flex flex-row">
  <div><button onclick="myFunction()" class="mx-2" id="change_speciality" type="button">Changer</button>
</div>
<!-- afficher la liste de specialités -->
</div> 

<div class="specialities_list mb-4" id="specialities_list" style="display: none;">
   <?php include_once('../lists/specialities_chbox.php');
   $specialitiesArray[] = $speciality;
   $specialities = implode(',', $specialitiesArray);

   ?> 
 </div>

</div>
<div id="warning_messages">
<div><span style="color: red; font-weight: bold; font-size: 1.2em;">Attention, les anciennes spécialités seront remplacées par de nouvelles!</span></div>
<div><span style="color: gdarkgray; font-weight: bold; font-size: 1em;">Si vous souhaitez conserver les anciennes spécialités, merci de cocher à nouveau les cases!</span></div>
</div>


   <button type="submit" class="btn-info my-4 fs-5 fw-bold" name="submit">Enregistrer</button>
</form>
<div>
<button type="button" class="login my-4 fs-4 fw-bold" data-toggle="tooltip" data-placement="top">
  <a href="../admin_index.php">Tableau de bord</a>
</button>
</div>
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
