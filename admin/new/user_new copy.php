<?php
//on demarre la session php
session_start();
// if(isset($_SESSION["user"])){
// header("Location: profil.php");
// }
if(!empty($_POST)){
  if(isset($_POST["lastname"], $_POST["firstname"], $_POST["birthdate"], $_POST["email"], $_POST["password"], $_POST["nationality"], $_POST["codeName"]) && !empty($_POST["lastname"]) && !empty($_POST["firstname"]) && !empty($_POST["birthdate"]) && !empty($_POST["email"]) &&!empty($_POST["password"]) &&!empty($_POST["nationality"]) &&!empty($_POST["codeName"])
  ){
   
  
//le form est complet
// $speciality = [];
$lastname = strip_tags($_POST["lastname"]);
$firstname = strip_tags($_POST["firstname"]);
$birthdate = strip_tags($_POST["birthdate"]);
$nationality = strip_tags($_POST["nationality"]);
$codeName = strip_tags($_POST["codeName"]);
$userType = strip_tags($_POST["userType"]);
$speciality = strip_tags($_POST["speciality"]);

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


$sql = "INSERT INTO `user`(`lastname`, `firstname`, `birthdate`, `email`, `password`, `roles`, `nationality`, `codeName`, `userType`, `speciality`) VALUES(:lastname, :firstname, :birthdate, :email, '$password', '[\"ROLE_USER\"]', :nationality,:codeName, :userType, :speciality)";

$query = $dbConnect->prepare($sql);
 
$query->bindValue(":lastname", $lastname, PDO::PARAM_STR);
$query->bindValue(":firstname", $firstname, PDO::PARAM_STR);
$query->bindValue(":birthdate", $birthdate, PDO::PARAM_STR);
$query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
$query->bindValue(":nationality", $nationality, PDO::PARAM_STR);
$query->bindValue(":codeName", $codeName, PDO::PARAM_STR);
$query->bindValue(":userType", $userType, PDO::PARAM_STR);
$query->bindValue(":speciality", $speciality, PDO::PARAM_STR);
$query->execute();
//on recup id de nouvel utilisateur
$id = $dbConnect->lastInsertId();
//on connecte user

 //on socke dans $_Session les info de user masi pas mdp
 $_SESSION["user"] = [
  "id" => $id,
  "lastname" => $lastname,
  "firstname" => $firstname,
  "birthdate" => $birthdate,
  "email" => $_POST["email"],
  "nationality" => $nationality,
  "codeName" => $codeName,
  "roles" => ["ROLE_USER"],
  "userType" => $userType,
  "speciality" => $speciality,
 ];
 echo "<p style=\"background: blue;\" class=\"text-center p-2 fw-4 fs-3 text-light\">Personne ajoutée sous le numéro ". $id."</p>";
// echo "<p style=\"background: blue;\" class=\"text-center p-2 fw-4 fs-5 text-light\">Retour à la page de création dans 5 seconds.<br> Sinon appuyez sur le lien : <a href='user_new.php' class=\"text-info fs-4 fw-4\"> Retour</a></p>";
 
?>
<script>
  function backToPage() {
    window.location.href = "user_new.php";
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
<h1>Créer une personne</h1>    
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
   <div class="mb-3">
    <label for="password" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Mot de passe</label>
    <input type="password" name="password" id="password">
   </div>

   <div class="mb-3">
    <label for="nationality" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Nationalité</label>
    <?php include_once "../../nationalities_list.php"; ?>
    <select name="nationality" id="nationality">
      <?php
    foreach ($nationalities as $nationality) {
      echo '<option value="'.$nationality["name"].'" name="<?= $nationality["name"] ?>'.$nationality["name"].'</option>';
  }
    ?>
    </select>
   </div>
   <div class="mb-3">
    <label for="codeName" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Nom de code</label>
    <input type="text" name="codeName" id="codeName">
   </div>

   <div class="mb-3">
    <label for="userType" class="form-label fw-bold my-2 fs-5" style="color: #01013d;">Type</label>
    <select name="userType" id="userType">
      <option value="Choisir">Choisir: </option>
      <option value="Agent" name="agent" id="agent">Agent</option>
      <option value="Target" name="target">Cible</option>
      <option value="Contact" name="contact">Contact</option>
    </select>
   </div>
      
   <?php include_once('../../specialities_chbox.php'); ?>
   
   
   <button type="submit" class="btn-info my-4 fs-5 fw-bold" name="submit">Créer</button>
</form>
<div>
<button type="button" class="login my-4 fs-4 fw-bold" data-toggle="tooltip" data-placement="top">
  <a href="../admin_index.php">Admin</a>
</button>
</div>
</div>
          
<?php
include_once "../../includes/admin_footer.php";
?>
