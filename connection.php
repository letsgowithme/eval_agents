<?php
//on demarre la session php
session_start();
if(isset($_SESSION["user"])){
header("Location: profil.php");
}

if(!empty($_POST)){
  if(isset($_POST["email"], $_POST["password"]) && !empty($_POST["email"]) &&!empty($_POST["password"])
  ){
   //on verifie un email en etat
   if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
    die("Ce n'est pas un email valide");
  }
  require_once "includes/DB.php";
  //on verifie si un email existe dans DB
  $sql = "SELECT * FROM `user` WHERE `email` = :email";
  $query = $dbConnect->prepare($sql);

  $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);

  $query->execute();

  $user = $query->fetch();
  if(!$user){
  die("L'utilisateur et/ou le mot de passe est incorrect");
  }
  // on a user, on verif son mdp
  if(!password_verify($_POST["password"], $user["password"])){
    die("L'utilisateur et/ou le mot de passe est incorrect");
  }
  //user et mdp sont corrects
 //on ouvre la session, connecter le user
 
 //on socke dans $_Session les info de user masi pas mdp
 $_SESSION["user"] = [
  "id" => $user["id"],
  "lastname" => $user["lastname"],
  "firstname" => $user["firstname"],
  "birthdate" => $user["birthdate"],
  "email" => $user["email"],
  "roles" => $user["roles"]
 ];
 //on redirige vers la page de profil
 if($_SESSION["user"]["roles"] > 4){
  header("Location: admin/admin_index.php");
 }else{
  header("Location: profil.php");
 }
 
 
  }
}
$titre = "Connexion";
include_once "includes/header.php";
include_once "includes/navbar.php";

?>
</head>
<body class="body_page">
  
<form method="post">
<div class="m-4 w-100 fw-bold">
   <div class=" ms-4">
    <label for="email" class="w-75">Email</label>
    <input type="email" name="email" id="email" class="d-flex flex-start">
   </div>
   <div class=" ms-4">
    <label for="password" class="w-75 mt-2">Mot de passe</label>
    <input type="password" name="password" id="password" class="d-flex flex-start">
   </div>
   <div class=" ms-4">
   <button type="submit" class="btn-dark my-4 fs-5 fw-bold p-2" name="submit">Se connecter</button>
   </div>
</div>
  </form>
<?php
include_once "includes/footer.php";
?>