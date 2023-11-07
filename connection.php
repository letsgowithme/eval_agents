<?php
//on demarre la session php
$connect=true;
session_start();
if(isset($_SESSION["user"])){
  header("Location: admin/main/admin_index.php");
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
  $sql = "SELECT * FROM  user  WHERE  email  = :email";
  $query = $dbConnect->prepare($sql);
  $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
  $query->execute();

   $user = $query->fetch();
  // if(!$user){
  // die("L'utilisateur et/ou le mot de passe est incorrect");
  // }
  // // on a user, on verif son mdp
  // if(!password_verify($_POST["password"], $user["password"])){
  //   die("L'utilisateur et/ou le mot de passe est incorrect");
  // }
  //user et mdp sont corrects
 //on ouvre la session, connecter le user
 
 //on socke dans $_Session les info de user masi pas mdp
 $_SESSION["user"] = [
  "id" => $user["id"],
  "email" => $user["email"],
  "roles" => $user["roles"]
 ];
 //on redirige vers la page de profil
 if($_SESSION["user"]){
  header("Location: admin/main/admin_index.php");
 }else{
  header("Location: index.php");
 }
 
 
  }
}
$titre = "Connexion";
include_once "includes/header.php";
include_once "includes/navbar.php";

?>
<link rel="stylesheet" href="style/style_in_ad.css">
<link rel="stylesheet" href="style/style.css">
</head>
<body class="body_page">
  <div  style="height: 85vh;">
  
<form method="post">
<div class="m-4 w-100 fw-bold">
   <div class=" ms-4">
    <label for="email" class="w-75 fs-4" style="color: #29292b;">Email</label>
    <input type="email" name="email" id="email" class="d-flex flex-start fs-4">
   </div>
   <div class=" ms-4">
    <label for="password" class="w-75 mt-2 fs-4"  style="color: #29292b;">Mot de passe</label>
    <input type="password" name="password" id="password" class="d-flex flex-start fs-4">
   </div>
   <div class=" ms-4">
   <button type="submit" class="btn btn-dark my-4 fs-4 fw-bold p-2" name="submit">Se connecter</button>
   </div>
</div>
  </form>
</div>
<?php
include_once "includes/footer.php";
?>