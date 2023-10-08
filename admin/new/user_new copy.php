<?php
//on demarre la session php
session_start();
// if(isset($_SESSION["user"])){
// header("Location: profil.php");
// }
if(!empty($_POST)){
  if(isset($_POST["lastname"], $_POST["firstname"], $_POST["birthdate"], $_POST["email"], $_POST["password"]) && !empty($_POST["lastname"]) && !empty($_POST["firstname"]) && !empty($_POST["birthdate"]) && !empty($_POST["email"]) &&!empty($_POST["password"])
  ){
   
//le form est complet
$lastname = strip_tags($_POST["lastname"]);
$firstname = strip_tags($_POST["firstname"]);
$birthdate = strip_tags($_POST["birthdate"]);

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
require_once "../../includes/DB.php";
// //afficher les nationalités
// $sql_nation = "SELECT * FROM `nationality`";
// $requete_nation = $dbConnect->query($sql_nation);
// $requete_nation->execute();
// $nationalities = $requete->fetchALL(PDO::FETCH_ASSOC);


// $sql_nationality = "INSERT INTO `user_nationality`(`nationality_id`) VALUES(:nationality_id)";
// $query = $dbConnect->prepare($sql_nationality);
// $query->bindValue(":nationality_id", $nationality["id"], PDO::PARAM_INT);


$sql = "INSERT INTO `user`(`lastname`, `firstname`, `birthdate`, `email`, `password`, `roles`) VALUES(:lastname, :firstname, :birthdate, :email, '$password', '[\"ROLE_USER\"]')";

$query = $dbConnect->prepare($sql);
 
$query->bindValue(":lastname", $lastname, PDO::PARAM_STR);
$query->bindValue(":firstname", $firstname, PDO::PARAM_STR);
$query->bindValue(":birthdate", $birthdate, PDO::PARAM_STR);
$query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);


$query->execute();
//on recup id de nouvel utilisateur
$id = $dbConnect->lastInsertId();
//on connecte user

 //on socke dans $_Session les info de user masi pas mdp
 $_SESSION["user"] = [
  "id" => $user,
  "lastname" => $lastname,
  "firstname" => $firstname,
  "birthdate" => $birthdate,
  "email" => $_POST["email"],
  // "nationality_id" => $nationality_id,
  "roles" => ["ROLE_USER"]
 ];
 //on redirige vers la page de profil
//  header("Location: index.php");
}
$sql_nationality = "INSERT INTO `user_nationality`(`user_id`, `nationality_id`) VALUES('$id', :nationality_id)";
$query = $dbConnect->prepare($sql_nationality);
$query->bindValue(":user_id", $_SESSION["user"]["id"], PDO::PARAM_INT);
$query->bindValue(":nationality_id", $nationality["id"], PDO::PARAM_INT);

$query->execute();
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
<div class="container text-center">
<h1>Inscrire un nouveau agent</h1>    
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
   <div>
    <label for="lastname">Nom</label>
    <input type="text" name="lastname" id="lastname">
   </div>
   <div>
    <label for="firstname">Prénom</label>
    <input type="text" name="firstname" id="firstname">
   </div>
   <div>
    <label for="birthdate">Date de naissance</label>
    <input type="date" name="birthdate" id="birthdate" placeholder="YYYY-MM-DD">
   </div>
   <div>
    <label for="email">Email</label>
    <input type="email" name="email" id="email" >
   </div>
   <div>
    <div>
      <?php
   include_once "../../nationalities.php";
   ?>
    </div>
  
    
    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password">
   </div>
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
