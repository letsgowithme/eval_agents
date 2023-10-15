<?php
//on demarre la session php
session_start();
// if(isset($_SESSION["user"])){
// header("Location: profil.php");
// }



if(!empty($_POST)){
  if(isset($_POST["lastname"], $_POST["firstname"], $_POST["birthdate"], $_POST["email"], $_POST["nationality"], $_POST["codeName"] , $_POST["userType"], $_POST["password"]) && !empty($_POST["lastname"]) && !empty($_POST["firstname"]) && !empty($_POST["birthdate"]) && !empty($_POST["email"]) &&!empty($_POST["nationality"]) &&!empty($_POST["codeName"])  &&!empty($_POST["userType"]) &&!empty($_POST["password"])
  ){
   if($_POST["specialities"]){
    $specialitiesArr = [];
    for($i =0; $i < count($_POST['specialities']);$i++){
      $speciality = $_POST['specialities'][$i];
      $specialitiesArr[] = $speciality;
    }
    $specialities = implode(",", $specialitiesArr);
   }
  
//le form est complet

$lastname = strip_tags($_POST["lastname"]);
$firstname = strip_tags($_POST["firstname"]);
$birthdate = strip_tags($_POST["birthdate"]);
$nationality = strip_tags($_POST["nationality"]);
$codeName = strip_tags($_POST["codeName"]);
$userType = strip_tags($_POST["userType"]);
$createdAt = strip_tags($_POST["createdAt"]);

require_once "../../includes/DB.php";

$_SESSION["error"] = [];

if(strlen($lastname) < 3){
  $_SESSION["error"]["lastname"] = "Le nom est trop court";
}
if(strlen($firstname) < 3){
  $_SESSION["error"]["firstname"] = "Le prénom est trop court";
}

if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
  $_SESSION["error"][] = "Veuillez renseigner un email valide";
}
if($_SESSION["error"] === []){

// hasher mdp
$password = password_hash($_POST["password"], PASSWORD_ARGON2ID);


$sql = "INSERT INTO `user`(`lastname`, `firstname`, `birthdate`, `email`,  `nationality`, `codeName`, `userType`,  `specialities`, `roles`, `password`, `createdAt`) VALUES(:lastname, :firstname, :birthdate, :email, :nationality,:codeName, :userType, :specialities, '[\"ROLE_USER\"]', '$password', :createdAt)";

$query = $dbConnect->prepare($sql);

$query->bindValue(":lastname", $lastname, PDO::PARAM_STR);
$query->bindValue(":firstname", $firstname, PDO::PARAM_STR);
$query->bindValue(":birthdate", $birthdate, PDO::PARAM_STR);
$query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
$query->bindValue(":nationality", $nationality, PDO::PARAM_STR);
$query->bindValue(":codeName", $codeName, PDO::PARAM_STR);
$query->bindValue(":userType", $userType, PDO::PARAM_STR);
 $query->bindValue(":specialities", $specialities, PDO::PARAM_STR);
 $query->bindValue(":createdAt", $createdAt, PDO::PARAM_STR);

 $query->execute();

//on recup id de nouvel utilisateur
$id = $dbConnect->lastInsertId();


 //on socke dans $_Session les info de user masi pas mdp
//  $_SESSION["user"] = [
//   "id" => $id,
//   "lastname" => $lastname,
//   "firstname" => $firstname,
//   "birthdate" => $birthdate,
//   "email" => $_POST["email"],
//   "nationality" => $nationality,
//   "codeName" => $codeName,
//   "userType" => $userType,
//   "specialities" => $speciality,
//   "roles" => ["ROLE_USER"],
//   "createdAt" => $createdAt,
  
//  ];
 echo "<p style=\"background: blue;\" id=\"message\" class=\"text-center  p-2 fw-4 fs-4 text-light\">Personne ajoutée sous le numéro ". $id."</p>";
echo "<p style=\"background: blue;\" class=\"text-center p-2 fw-4 fs-5 text-light\"><a href='user_new.php' class=\"text-info fs-4 fw-4\"> Retour à la page de la création</a></p>";
// header("Location: usersAll.php");
 
?>
<script>
  function backToPage() {
    let message =document.getElementById('message');
    message.style.display = 'none';
   window.location.href = "../lists/usersAll.php";
  }
setTimeout(backToPage, 4000);
  </script>
 <?php
}
}else{
  $_SESSION["error"] = ["Veuillez remplir tous les champs"];
  }
  
 }
$titre = "Inscription";
include_once "../../includes/admin_header.php";
include_once "../../includes/admin_navbar.php";
?>
  <link href="../../style/style.css" rel="stylesheet" type="text/css">
  <link rel="icon" href="../logo.png">


<body class="body_home body_page">
<div class="container">
<div class="d-flex justify-content-between mt-4">
<h1>Ajouter une personne</h1>    
<button class="btn border" style="background: lightgray;"><a class="fs-4" style="font-weight: bold; color:darkblue; text-decoration: none;" aria-current="page" href="../admin_index.php" id="up">Admin</a></button>
</div> 
<?php
 if(isset($_SESSION["error"])){
  foreach ($_SESSION["error"] as $message) {
    ?>
    <h5 style="color: red; background: yellow;"><?= $message ?></h5>
    <?php
  }
  unset($_SESSION["error"]);
 }

?>   
<form method="post">
<div class="mb-3">
<label for="lastname" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Nom</label>
    <input type="text" name="lastname" id="lastname">
   </div>
   <div class="mb-3">
    <label for="firstname" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Prénom</label>
    <input type="text" name="firstname" id="firstname">
   </div>
   <div class="mb-3">
    <label for="birthdate" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Date de naissance</label>
    <input type="date" name="birthdate" id="birthdate" placeholder="YYYY-MM-DD">
   </div>
   <div class="mb-3">
    <label for="email" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Email</label>
    <input type="email" name="email" id="email" >
   </div>
   <!-- ******************Nationalité****************** -->
   <div class="mb-3">
    <label for="nationality" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Nationalité</label>
    <?php include_once "../lists/nationalities_list.php"; ?>
    <select name="nationality" id="nationality">
      <?php
    foreach ($nationalities as $nationality) {
      echo '<option value="'.$nationality["name"].'" name="<?= $nationality["name"] ?>'.$nationality["name"].'</option>';
  }
    ?>
    </select>
   </div>
   <!-- ******************Codename****************** -->
   <div class="mb-3">
    <label for="codeName" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Nom de code</label>
    <input type="text" name="codeName" id="codeName">
   </div>
<!-- ******************UserType****************** -->
<label for="userType" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Type: </label>
<?php 
$userTypeArray = array("agent", "cible", "contact");

foreach ($userTypeArray as $userType) {
  ?>
    <input type="radio" name="userType" value="<?php echo $userType ?>" class="choices" style="margin-left: 10px;" id="<?php echo $userType ?>"><span style="font-size: 1.1em; font-weight: bold; padding-left:2px;"><?php echo $userType ?></span>
  <?php
}
?>
 
 <!-- **************Specialities***************** -->
  <div class="mb-3 d-flex" id="agent_speciality" style="display: none;">
   <h5 class="form-label fw-bold mb-2 fs-5 me-2" style="color: #01013d; display: none;" id="speciality_title">Spécialité</h5>
<div class="specialities_list" id="specialities_list" style="display: none;">
   <?php include_once('../lists/specialities_chbox.php');  
   ?>
</div>
</div>

  <!-- **************Password***************** --> 
<div class="mb-3">
    <label for="password" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Mot de passe</label>
    <input type="password" name="password" id="password">
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
</div>
<script>
    let agent = document.getElementById("agent");
    let list = document.getElementById("specialities_list");
    let speciality_title = document.getElementById("speciality_title");
    let agent_speciality = document.getElementById("agent_speciality");
    let target = document.getElementById("cible");
    let contact = document.getElementById("contact");
   
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
include_once "../../includes/admin_footer.php";
?>
