<?php
if(!empty($_POST)){
  if(isset($_POST["lastname"], $_POST["firstname"], $_POST["birthdate"], $_POST["email"], $_POST["password"]) && !empty($_POST["lastname"]) && !empty($_POST["firstname"]) && !empty($_POST["birthdate"]) && !empty($_POST["email"]) &&!empty($_POST["password"])
 
  ){
   
//le form est complet
$lastname = strip_tags($_POST["lastname"]);
$firstname = strip_tags($_POST["firstname"]);
$birthdate = strip_tags($_POST["birthdate"]);

if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
  die("Veuillez renseigner un email valide");
}
// hasher mdp
$password = password_hash($_POST["password"], PASSWORD_ARGON2ID);
require_once "includes/DB.php";

$sql = "INSERT INTO `user`(`lastname`, `firstname`, `birthdate`, `email`, `password`, `roles`) VALUES(:lastname, :firstname, :birthdate, :email, '$password', '[\"ROLE_USER\"]')";

$query = $dbConnect->prepare($sql);
 
$query->bindValue(":lastname", $lastname, PDO::PARAM_STR);
$query->bindValue(":firstname", $firstname, PDO::PARAM_STR);
$query->bindValue(":birthdate", $birthdate, PDO::PARAM_STR);
$query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);

$query->execute();

}else{
  die("Veuillez remplir tous les champs");
  }
  
}


$titre = "Inscription";
include_once "includes/header.php";
include_once "includes/navbar.php";

?>

<body class="body_home body_page">
<div class="container text-center">
<h1>Inscrire un nouveau agent</h1>    

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
    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password">
   </div>
   <button type="submit" class="btn-info my-4 fs-5 fw-bold" name="submit">Créer</button>
</form>
<div>
<button type="button" class="login my-4 fs-4 fw-bold" data-toggle="tooltip" data-placement="top">
  <a href="index.php">Accueil</a>
</button>
</div>
</div>
          
<?php


include_once "includes/footer.php";
?>
